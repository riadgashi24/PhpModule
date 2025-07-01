<?php
session_start();
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['agent', 'admin'])) {
    header("Location: login.php");
    exit;
}
include("include/config.php");

// Get property ID
$property_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch property and check ownership
$stmt = $conn->prepare("SELECT * FROM properties WHERE id = ? AND user_id = ?");
$stmt->execute([$property_id, $_SESSION['user_id']]);
$property = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$property) {
    echo "<div style='max-width:500px;margin:40px auto;text-align:center;'>Property not found or access denied.</div>";
    exit;
}

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
    $status = $_POST['status'];

    // Update property
    $update = $conn->prepare("UPDATE properties SET title=?, description=?, price=?, location=?, property_type=?, bedrooms=?, bathrooms=?, area=?, status=? WHERE id=? AND user_id=?");
    $update->execute([
        $title, $description, $price, $location, $property_type, $bedrooms, $bathrooms, $area, $status, $property_id, $_SESSION['user_id']
    ]);

    // Handle image upload (optional)
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imgName = uniqid('property_', true) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imgPath = 'assets/img/properties/' . $imgName;
        move_uploaded_file($_FILES['image']['tmp_name'], $imgPath);

        // Insert new image path into property_images table
        $imgStmt = $conn->prepare("INSERT INTO property_images (property_id, file_path) VALUES (?, ?)");
        $imgStmt->execute([$property_id, $imgPath]);
    }

    $message = "Property updated successfully!";
    // Refresh property data
    $stmt->execute([$property_id, $_SESSION['user_id']]);
    $property = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fetch images for this property
$imgStmt = $conn->prepare("SELECT id, file_path FROM property_images WHERE property_id = ? ORDER BY id ASC");
$imgStmt->execute([$property_id]);
$images = $imgStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Property</title>
    <link href="assets/css/main.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .edit-property-container {
            max-width: 500px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 32px 48px 24px 28px;
        }
        h2 { text-align: center; color: #2c3e50; margin-bottom: 24px; }
        .form-control, textarea, select {
            margin-bottom: 18px;
            border-radius: 6px;
            border: 1px solid #ced4da;
            padding: 10px 12px;
            width: 100%;
            font-size: 15px;
        }
        textarea { min-height: 80px; resize: vertical; }
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
        .btn-primary:hover { background: #0056b3; }
        .alert-success {
            background: #28a745;
            color: #fff;
            padding: 10px 14px;
            border-radius: 6px;
            margin-bottom: 18px;
            text-align: center;
        }
        label { font-weight: 500; margin-bottom: 6px; display: block; }
        .back-link { display: block; text-align: center; margin-top: 18px; color: #007bff; text-decoration: none; }
        .property-images { margin-bottom: 18px; }
        .property-images img { max-width: 100px; margin-right: 10px; border-radius: 6px; border: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="edit-property-container">
        <h2>Edit Property</h2>
        <?php if ($message): ?><div class="alert-success"><?php echo $message; ?></div><?php endif; ?>
        <form method="post" enctype="multipart/form-data" autocomplete="off">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($property['title']); ?>" required class="form-control">

            <label for="description">Description</label>
            <textarea name="description" id="description" required class="form-control"><?php echo htmlspecialchars($property['description']); ?></textarea>

            <label for="price">Price</label>
            <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($property['price']); ?>" required class="form-control" step="0.01" min="0">

            <label for="location">Location</label>
            <input type="text" name="location" id="location" value="<?php echo htmlspecialchars($property['location']); ?>" required class="form-control">

            <label for="property_type">Property Type</label>
            <select name="property_type" id="property_type" class="form-control" required>
                <option value="house" <?php if($property['property_type']=='house') echo 'selected'; ?>>House</option>
                <option value="apartment" <?php if($property['property_type']=='apartment') echo 'selected'; ?>>Apartment</option>
                <option value="commercial" <?php if($property['property_type']=='commercial') echo 'selected'; ?>>Commercial</option>
            </select>

            <label for="bedrooms">Bedrooms</label>
            <input type="number" name="bedrooms" id="bedrooms" value="<?php echo htmlspecialchars($property['bedrooms']); ?>" required class="form-control" min="0">

            <label for="bathrooms">Bathrooms</label>
            <input type="number" name="bathrooms" id="bathrooms" value="<?php echo htmlspecialchars($property['bathrooms']); ?>" required class="form-control" min="0">

            <label for="area">Area (m²)</label>
            <input type="number" name="area" id="area" value="<?php echo htmlspecialchars($property['area']); ?>" required class="form-control" min="0">

            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="for sale" <?php if($property['status']=='for sale') echo 'selected'; ?>>For Sale</option>
                <option value="for rent" <?php if($property['status']=='for rent') echo 'selected'; ?>>For Rent</option>
                <option value="sold" <?php if($property['status']=='sold') echo 'selected'; ?>>Sold</option>
                <option value="rented" <?php if($property['status']=='rented') echo 'selected'; ?>>Rented</option>
            </select>

            <label for="image">Add Image (optional)</label>
            <input type="file" name="image" id="image" accept="image/*" class="form-control">

            <div class="property-images">
                <?php if ($images): ?>
                    <label>Existing Images:</label>
                    <?php foreach ($images as $img): ?>
                        <img src="<?php echo htmlspecialchars($img['file_path']); ?>" alt="Property Image">
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn-primary">Update Property</button>
        </form>
        <a href="agent-dashboard.php" class="back-link">&larr; Back to Dashboard</a>
    </div>
</body>
</html>