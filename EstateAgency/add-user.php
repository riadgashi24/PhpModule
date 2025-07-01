<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include("include/config.php");

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validate
    if (!$username || !$email || !$password || !$role) {
        $message = '<div class="alert alert-danger">All fields are required.</div>';
    } else {
        // Check if username or email exists
        $check = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1");
        $check->execute([$username, $email]);
        if ($check->fetch()) {
            $message = '<div class="alert alert-danger">Username or email already exists.</div>';
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, role, created_at) VALUES (?, ?, ?, ?, NOW())");
            $stmt->execute([$username, $email, $password_hash, $role]);
            $message = '<div class="alert alert-success">User added successfully!</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <link href="assets/css/main.css" rel="stylesheet">
    <style>
        .add-user-container { max-width: 400px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); padding: 32px 28px 24px 28px; }
        h2 { text-align: center; margin-bottom: 24px; }
        .form-control { margin-bottom: 18px; border-radius: 6px; border: 1px solid #ced4da; padding: 10px 12px; }
        .btn-primary { width: 100%; padding: 10px 0; border-radius: 6px; background: #007bff; border: none; font-weight: 600; font-size: 16px; transition: background 0.2s; }
        .btn-primary:hover { background: #0056b3; }
        .alert { margin-bottom: 18px; padding: 10px 14px; border-radius: 6px; color: #fff; text-align: center; }
        .alert-success { background: #28a745; }
        .alert-danger { background: #e74c3c; }
        .back-link { display: block; text-align: center; margin-top: 18px; color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="add-user-container">
        <h2>Add New User</h2>
        <?php echo $message; ?>
        <form method="post" autocomplete="off">
            <input type="text" name="username" placeholder="Username" required class="form-control">
            <input type="email" name="email" placeholder="Email" required class="form-control">
            <input type="password" name="password" placeholder="Password" required class="form-control">
            <select name="role" class="form-control" required>
                <option value="">Select Role</option>
                <option value="customer">Customer</option>
                <option value="agent">Agent</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
        <a href="admin-dashboard.php" class="back-link">&larr; Back to Dashboard</a>
    </div>
</body>
</html>