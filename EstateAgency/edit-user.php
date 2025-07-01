<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include("include/config.php");

// Get user ID
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch user
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "<div style='max-width:500px;margin:40px auto;text-align:center;'>User not found.</div>";
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];
    $password = $_POST['password'];

    // Check for duplicate username/email (excluding current user)
    $check = $conn->prepare("SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?");
    $check->execute([$username, $email, $user_id]);
    if ($check->fetch()) {
        $message = '<div class="alert-danger" style="background:#e74c3c;color:#fff;padding:10px 14px;border-radius:6px;margin-bottom:18px;text-align:center;">Username or email already exists.</div>';
    } else {
        if ($password) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE users SET username=?, email=?, password_hash=?, role=? WHERE id=?");
            $update->execute([$username, $email, $password_hash, $role, $user_id]);
        } else {
            $update = $conn->prepare("UPDATE users SET username=?, email=?, role=? WHERE id=?");
            $update->execute([$username, $email, $role, $user_id]);
        }
        $message = '<div class="alert-success" style="background:#28a745;color:#fff;padding:10px 14px;border-radius:6px;margin-bottom:18px;text-align:center;">User updated successfully!</div>';
        // Refresh user data
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link href="assets/css/main.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .edit-user-container {
            max-width: 400px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 32px 28px 24px 28px;
        }
        h2 { text-align: center; color: #2c3e50; margin-bottom: 24px; }
        .form-control, select {
            margin-bottom: 18px;
            border-radius: 6px;
            border: 1px solid #ced4da;
            padding: 10px 12px;
            width: 100%;
            font-size: 15px;
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
        .btn-primary:hover { background: #0056b3; }
        label { font-weight: 500; margin-bottom: 6px; display: block; }
        .back-link { display: block; text-align: center; margin-top: 18px; color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="edit-user-container">
        <h2>Edit User</h2>
        <?php echo $message; ?>
        <form method="post" autocomplete="off">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required class="form-control">

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required class="form-control">

            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="customer" <?php if($user['role']=='customer') echo 'selected'; ?>>Customer</option>
                <option value="agent" <?php if($user['role']=='agent') echo 'selected'; ?>>Agent</option>
                <option value="admin" <?php if($user['role']=='admin') echo 'selected'; ?>>Admin</option>
            </select>

            <label for="password">New Password (leave blank to keep current)</label>
            <input type="password" name="password" id="password" class="form-control">

            <button type="submit" class="btn-primary">Update User</button>
        </form>
        <a href="admin-dashboard.php" class="back-link">&larr; Back to Dashboard</a>
    </div>
</body>
</html>