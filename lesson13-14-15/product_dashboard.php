<?php
  include_once('include/config.php'); 
  session_start();
  if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
  }
  if (!isset($_SESSION['user_id'])) {
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = :username LIMIT 1");
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $_SESSION['user_id'] = $row['id'];
    }
  }

  // Merr produktet nga databaza
  $sql = "SELECT * FROM products";
  $selectProducts = $conn->prepare($sql);
  $selectProducts->execute();
  $products = $selectProducts->fetchAll();
?>

<?php include("include/header.php"); ?>

<style> 
  body {
    padding-top: 56px; 
  }
  table{
    border: 1px solid black;
    border-collapse: collapse;
    width: 100%;
  }
  th, td{
    border: 1px solid black;   
    padding: 10px;
    text-align: left;
  }
</style>

<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Welcome, <i> <?php echo htmlspecialchars($_SESSION['username']); ?> </i></a>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="logic/logout.php">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php?id=<?= htmlspecialchars($_SESSION['user_id']) ?>">
              <span data-feather="user"></span>
              Edit Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="product_dashboard.php">
              <span data-feather="box"></span>
              Products <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Product Dashboard</h1>
        <a href="addProduct.php" class="btn btn-success">Add Product</a>
      </div>  

      <div>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Description</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product): ?>
            <tr> 
              <td><?= htmlspecialchars($product['id']) ?></td>
              <td><?= htmlspecialchars($product['title']) ?></td>
              <td><?= htmlspecialchars($product['description']) ?></td> 
              <td><?= htmlspecialchars($product['quantity']) ?></td> 
              <td><?= htmlspecialchars($product['price']) ?></td>
              <td>
                <a href='logic/delete_product.php?id=<?= $product['id'] ?>' onclick="return confirm('Are you sure?')">Delete</a> | 
                <a href='edit_product_form.php?id=<?= $product['id'] ?>'>Update</a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<?php include("include/footer.php"); ?>