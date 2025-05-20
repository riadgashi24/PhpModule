<?php include("header.php") ?>

  <div class="d-flex flex-column justify-content-center align-items-center h-100">
  <form class="form-signin w-25" action="loginLogic.php" method="post">
    <h1 class="text-center text-primary">Login</h1>

    <div class="mb-3">
      <label for="inputEmail" class="sr-only">Username</label>
      <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="username" required autofocus>
    </div>
    <div class="mb-3">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
    <small>Don't have account ? <a href="signup.php">Sign Up</a></small>

    <p class="mt-5 mb-3 text-muted">Digital School &copy; 2025</p>
  </form>
  </div>

  <?php include("footer.php") ?>
