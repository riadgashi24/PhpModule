<?php
include('../includes/header.php');
?>
<div class="container min-vh-100 d-flex flex-column justify-content-center" style="max-width: 400px; margin: auto;">
    <h1 class="text-center">Login</h1>
    <form action="/PhpModule/real-estate-agency/public/login.php" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

