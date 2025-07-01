<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include("include/config.php");

// Fetch all users
$stmt = $conn->prepare("SELECT id, username, email, role, created_at FROM users ORDER BY created_at DESC");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all properties
$propStmt = $conn->prepare("SELECT p.*, u.username FROM properties p LEFT JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC");
$propStmt->execute();
$properties = $propStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="assets/css/main.css" rel="stylesheet">
    <style>
        .dashboard-container { max-width: 1100px; margin: 40px auto; }
        h2 { margin-top: 30px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { padding: 10px 8px; border: 1px solid #ddd; }
        th { background: #f4f4f4; }
        .actions a { margin-right: 8px; }
        .btn { padding: 4px 12px; border-radius: 4px; text-decoration: none; }
        .btn-edit { background: #007bff; color: #fff; }
        .btn-delete { background: #e74c3c; color: #fff; }
        .btn-add { background: #28a745; color: #fff; margin-bottom: 12px; display: inline-block; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Admin Dashboard</h1>
        <p>
            <a href="add-user.php" class="btn btn-add">Add New User</a>
            <a href="logout.php" class="btn btn-delete" style="float:right;">Logout</a>
        </p>

        <h2>Users</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
                <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                <td class="actions">
                    <a href="edit-user.php?id=<?php echo $user['id']; ?>" class="btn btn-edit">Edit</a>
                    <a href="delete-user.php?id=<?php echo $user['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <h2>Properties</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Agent</th>
                <th>Type</th>
                <th>Price</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($properties as $prop): ?>
            <tr>
                <td><?php echo htmlspecialchars($prop['id']); ?></td>
                <td><?php echo htmlspecialchars($prop['title']); ?></td>
                <td><?php echo htmlspecialchars($prop['username']); ?></td>
                <td><?php echo htmlspecialchars($prop['property_type']); ?></td>
                <td>$<?php echo number_format($prop['price']); ?></td>
                <td><?php echo htmlspecialchars($prop['status']); ?></td>
                <td><?php echo htmlspecialchars($prop['created_at']); ?></td>
                <td class="actions">
                    <a href="edit-property.php?id=<?php echo $prop['id']; ?>" class="btn btn-edit">Edit</a>
                    <a href="delete-property.php?id=<?php echo $prop['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this property?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>