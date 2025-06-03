<?php
include_once('include/config.php');
session_start();

if (!isset($_GET['id'])) {
    header('Location: product_dashboard.php');
    exit();
}
$id = intval($_GET['id']);
$sql = "SELECT * FROM products WHERE id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header('Location: product_dashboard.php');
    exit();
}
?>

<?php include("include/header.php"); ?>

<div class="container mt-5">
    <h2>Edit Product</h2>
    <form action="logic/edit_product.php" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($product['title']) ?>" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" required><?= htmlspecialchars($product['description']) ?></textarea>
        </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="<?= htmlspecialchars($product['quantity']) ?>" required>
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?= htmlspecialchars($product['price']) ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update Product</button>
    </form>
</div>

<?php include("include/footer.php"); ?>