<?php
session_start();
include("include/config.php");

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Allow both agent and admin to log in
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND (role = 'agent' OR role = 'admin') LIMIT 1");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true); // Security: prevent session fixation
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        // Redirect based on role
        if ($user['role'] === 'admin') {
            header("Location: admin-dashboard.php");
        } else {
            header("Location: agent-dashboard.php");
        }
        exit;
    } else {
        $error = "Invalid credentials or not authorized.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Agent/Admin Login</title>
    <link href="assets/css/main.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 60px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 32px 28px 24px 28px;
        }
        .login-title {
            font-weight: 700;
            margin-bottom: 24px;
            text-align: center;
            color: #2c3e50;
        }
        .form-control {
            margin-bottom: 18px;
            border-radius: 6px;
            border: 1px solid #ced4da;
            padding: 10px 12px;
        }
        .btn-primary {
            width: 100%;
            padding: 10px 0;
            border-radius: 6px;
            background: #2eca6a;
            color: #fff;
            cursor: pointer;
            border: none;
            font-weight: 600;
            font-size: 16px;
            transition: background 0.2s;
        }
        .btn-primary:hover {
            background:rgb(39, 173, 91);
        }
        .alert {
            margin-bottom: 18px;
            padding: 10px 14px;
            border-radius: 6px;
            color: #fff;
            background: #e74c3c;
            text-align: center;
        }
        .login-footer {
            text-align: center;
            margin-top: 18px;
            color: #888;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-title">Agent / Admin Login</div>
        <?php if ($error): ?><div class="alert"><?php echo $error; ?></div><?php endif; ?>
        <form method="post" autocomplete="off">
            <input type="text" name="username" placeholder="Username" required class="form-control" autofocus>
            <input type="password" name="password" placeholder="Password" required class="form-control">
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <div class="login-footer">
            Only agents and admins can log in.<br>
            <a href="index.php" style="color:#007bff;text-decoration:none;">&larr; Back to Home</a>
        </div>
    </div>
</body>
</html>