<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'agent') {
    header("Location: login.php");
    exit;
}
include("include/config.php");

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $location = trim($_POST['location']);
    $property_type = $_POST['property_type'];
    $bedrooms = intval($_POST['bedrooms']);
    $bathrooms = intval($_POST['bathrooms']);
    $area = intval($_POST['area']);
    $status = 'for sale'; // Use allowed enum value

    // Insert property
    $stmt = $conn->prepare("INSERT INTO properties (user_id, title, description, price, location, property_type, bedrooms, bathrooms, area, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->execute([
        $_SESSION['user_id'], $title, $description, $price, $location, $property_type, $bedrooms, $bathrooms, $area, $status
    ]);
    $property_id = $conn->lastInsertId();

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imgName = uniqid('property_', true) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imgPath = 'assets/img/properties/' . $imgName;
        move_uploaded_file($_FILES['image']['tmp_name'], $imgPath);

        // Insert image path into property_images table
        $imgStmt = $conn->prepare("INSERT INTO property_images (property_id, file_path) VALUES (?, ?)");
        $imgStmt->execute([$property_id, $imgPath]);
    }

    $message = "Property added successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Property</title>
    <link href="assets/css/main.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .add-property-container {
            max-width: 500px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 23px 48px 26px 28px;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 24px;
        }
        .form-control, textarea, select {
            margin-bottom: 18px;
            border-radius: 6px;
            border: 1px solid #ced4da;
            padding: 10px 12px;
            width: 100%;
            font-size: 15px;
        }
        textarea {
            min-height: 80px;
            resize: vertical;
        }
        .btn-primary {
            width: 100%;
            padding: 12px 0;
            border-radius: 6px;
            background: #007bff;
            border: none;
            font-weight: 600;
            font-size: 16px;
            transition: background 0.2s;
            color: #fff;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .alert-success {
            background: #28a745;
            color: #fff;
            padding: 10px 14px;
            border-radius: 6px;
            margin-bottom: 18px;
            text-align: center;
        }
        label {
            font-weight: 500;
            margin-bottom: 6px;
            display: block;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="add-property-container">
        <h2>Add New Property</h2>
        <?php if ($message): ?><div class="alert-success"><?php echo $message; ?></div><?php endif; ?>
        <form method="post" enctype="multipart/form-data" autocomplete="off">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" placeholder="Title" required class="form-control">

            <label for="description">Description</label>
            <textarea name="description" id="description" placeholder="Description" required class="form-control"></textarea>

            <label for="price">Price</label>
            <input type="number" name="price" id="price" placeholder="Price" required class="form-control" step="0.01" min="0">

            <label for="location">Location</label>
            <input type="text" name="location" id="location" placeholder="Location" required class="form-control">

            <label for="property_type">Property Type</label>
            <select name="property_type" id="property_type" class="form-control" required>
                <option value="">Select Type</option>
                <option value="house">House</option>
                <option value="apartment">Apartment</option>
                <option value="commercial">Commercial</option>
            </select>

            <label for="bedrooms">Bedrooms</label>
            <input type="number" name="bedrooms" id="bedrooms" placeholder="Bedrooms" required class="form-control" min="0">

            <label for="bathrooms">Bathrooms</label>
            <input type="number" name="bathrooms" id="bathrooms" placeholder="Bathrooms" required class="form-control" min="0">

            <label for="area">Area (m²)</label>
            <input type="number" name="area" id="area" placeholder="Area (m²)" required class="form-control" min="0">

            <label for="image">Image</label>
            <input type="file" name="image" id="image" accept="image/*" class="form-control">

            <button type="submit" class="btn btn-primary">Add Property</button>
        </form>
        <a href="agent-dashboard.php" class="back-link">&larr; Back to Dashboard</a>
    </div>
</body>
</html>