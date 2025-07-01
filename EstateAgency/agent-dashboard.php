<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'agent') {
    header("Location: login.php");
    exit;
}
include("include/config.php");

// Fetch properties added by this agent
$propStmt = $conn->prepare("SELECT * FROM properties WHERE user_id = ? ORDER BY created_at DESC");
$propStmt->execute([$_SESSION['user_id']]);
$properties = $propStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Agent Dashboard</title>
    <link href="assets/css/main.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .dashboard-container {
            max-width: 950px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 32px 28px 24px 28px;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }
        .dashboard-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .btn {
            padding: 8px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: background 0.2s;
            border: none;
            display: inline-block;
        }
        .btn-add {
            background: #28a745;
            color: #fff;
        }
        .btn-add:hover {
            background: #218838;
        }
        .btn-logout {
            background: #e74c3c;
            color: #fff;
        }
        .btn-logout:hover {
            background: #c0392b;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background: #fafbfc;
        }
        th, td {
            padding: 12px 10px;
            border: 1px solid #e1e4e8;
            text-align: left;
        }
        th {
            background: #f4f4f4;
            color: #333;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .no-properties {
            text-align: center;
            color: #888;
            font-size: 17px;
            padding: 30px 0;
        }
        @media (max-width: 700px) {
            .dashboard-container { padding: 12px 2px; }
            table, th, td { font-size: 13px; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['role']); ?>!</h1>
        <div class="dashboard-actions">
            <a href="add-property.php" class="btn btn-add">+ Add New Property</a>
            <a href="logout.php" class="btn btn-logout">Logout</a>
        </div>

        <h2 style="margin-bottom:18px;">Your Properties</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Type</th>
                <th>Price</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            <?php if ($properties): ?>
                <?php foreach ($properties as $prop): ?>
                <tr>
                    <td><?php echo htmlspecialchars($prop['id']); ?></td>
                    <td><?php echo htmlspecialchars($prop['title']); ?></td>
                    <td><?php echo htmlspecialchars($prop['property_type']); ?></td>
                    <td>$<?php echo number_format($prop['price']); ?></td>
                    <td><?php echo htmlspecialchars($prop['status']); ?></td>
                    <td><?php echo htmlspecialchars($prop['created_at']); ?></td>
                    <td>
                        <a href="edit-property.php?id=<?php echo $prop['id']; ?>" class="btn btn-add" style="padding:4px 10px;font-size:13px;">Edit</a>
                        <a href="delete-property.php?id=<?php echo $prop['id']; ?>" class="btn btn-logout" style="padding:4px 10px;font-size:13px;" onclick="return confirm('Are you sure you want to delete this property?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" class="no-properties">No properties found.</td></tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>