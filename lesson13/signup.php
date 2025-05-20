<?php include("header.php") ?>

  <div class="signup d-flex flex-column justify-content-center align-items-center h-100">
    <form action="register.php" method="post" class="signin w-25">
      <h1 class="h33 mb-3 font-weight-normal">Please sign up</h1>
      <label for="inputEmail" class="sr-only">Name</label>
      <input type="text" id="inputEmail" class="form-control" placeholder="name" name="name" required autofocus>

      <label for="inputEmail" class="sr-only">Surname</label>
      <input type="text" id="inputEmail" class="form-control" placeholder="surname" name="surname" required autofocus>

      <label for="inputEmail" class="sr-only">Username</label>
      <input type="text" id="inputEmail" class="form-control" placeholder="username" name="username" required autofocus>

      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="email" name="email" required autofocus>

      <label for="inputEmail" class="sr-only">Password</label>
      <input type="password" id="inputEmail" class="form-control" placeholder="password" name="password" required autofocus>

      <button type="submit" class="btn btn-lg btn-primary btn-block" name="submit ">Sign Up</button>
    </form>
  </div>
  


  <?php include("footer.php") ?>
