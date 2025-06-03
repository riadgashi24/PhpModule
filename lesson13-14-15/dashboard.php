<?php
   include_once('include/config.php'); 
  session_start();
  if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
  }
  // Shto këtë nëse nuk e ke ruajtur user_id në sesion
  if (!isset($_SESSION['user_id'])) {
    // Merr user_id nga databaza sipas username
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = :username LIMIT 1");
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $_SESSION['user_id'] = $row['id'];
    }
  }


  $sql = "SELECT * FROM users";
  $selectUsers = $conn->prepare($sql);
  $selectUsers->execute();
  $users = $selectUsers->fetchAll();
?>

<?php include("include/header.php"); ?>

<style> 
  body {
    padding-top: 56px; /* Shton hapesire lart per navbar-in fixed */
  }
  table{
    border: 1px solid black;
    border-collapse: collapse;
  }
  tr,td,th{
    border: 1px solid black;   
  }
  td{
    padding: 10px;
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
            <a class="nav-link active" href="dashboard.php">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php?id=<?= isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id']) : '' ?>">
              <span data-feather="file"></span>
              Edit Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php?id=<?= isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id']) : '' ?>">
              <span data-feather="file"></span>
              Products
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>  

      <div>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Username</th>
              <th>Name</th>
              <th>Surname</th>
              <th>Email</th>
              <th>Update</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user): ?>
            <tr> 
              <td><?= htmlspecialchars($user['id']) ?></td>
              <td><?= htmlspecialchars($user['username']) ?></td>
              <td><?= htmlspecialchars($user['name']) ?></td> 
              <td><?= htmlspecialchars($user['surname']) ?></td> 
              <td><?= htmlspecialchars($user['email']) ?></td>
              <td>
                <a href='logic/delete.php?id=<?= $user['id'] ?>' onclick="return confirm('Are you sure?')">Delete</a> | 
                <a href='profile.php?id=<?= $user['id'] ?>'>Update</a>
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