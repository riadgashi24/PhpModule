<?php
  include_once "config.php";
  if(empty($_SESSION['username'])){
    header('Location: login.php');
  } 


$sql = "SELECT * FROM users";
$selectUsers = $conn -> prepare($sql);
$selectUsers -> execute();

$users_data = $selectUsers -> fetch();

?>
<?php include("header.php")?>
<style>
table, tr,th,td{
  border: 1px, solid,black;
}
table, tr,td{
  border-collapse: collapse;
}
td{
  padding: 15px;
}
</style>

<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Welcome <i><?php echo $_SESSION['username']?> </i></a>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="logout.php">Sign out</a>
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
              <?php foreach ($users_data as $user_data) { ?>
                <a class="nav-link" href="profile.php?id=<?= $user_data['id']; ?>">
                  <?php } ?>
                  <span data-feather="file"></span>
                  Edit Profile
                </a>
            </li>
          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <?php
        include_once "config.php";
        $getUsers = $conn -> prepare("SELECT * FROM users");
        $getUsers -> execute();
        $users = $getUsers -> fetchAll();
        ?>
        <table>
        <thead>
            <th>id</th>
            <th>name</th>
            <th>surname</th>
            <th>email</th>
            <th>delete</th>
            <th>update</th>
        </thead>

        <tbody>
            <?php
                foreach($users as $user){
            ?>
            <tr>
                <td>
                    <?=$user['id']?>
                </td>
                <td>
                    <?=$user['name']?>
                </td>
                <td>
                    <?=$user['surname']?>
                </td>
                <td>
                    <?=$user['email']?>
                </td>
                <td>
                    <?= "<a href='delete.php?id=$user[id]'>Delete</a>"?>
                </td>
                <td>
                    <?= "<a href='update.php?id=$user[id]'>Update</a>"?>
                </td>
            </tr>
        <?php
                }
        ?>
        </tbody>
    </table>
      </main>
    </div>
  </div>
  <?php include("footer.php")?>