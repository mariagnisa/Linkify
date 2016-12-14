<?php

require_once __DIR__.'/../lib/functions.php';

$error = '';
if (isset($_SESSION['error'])) {
  $error = $_SESSION['error'];
}

$message = '';
if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
}

if ($error) {
  print $error;
  unset($_SESSION['error']);
}

if ($message) {
  print $message;
  unset($_SESSION['message']);
}

 ?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  <div class="wrapper">

    <div class="introduction-wrapper">


    </div>

    <div class="login-wrapper">
        <!-- Login form -->
        <form action="../lib/login.php" method="post">
          <input type="text" name="username" placeholder="Email or username">
          <input type="password" name="password" placeholder="Password">
          <button type="submit" class="login">Log in</button>
          <input type="checkbox" name="remember" class="remember-checkbox" checked>
          <label for="remember-checkbox">Remember me</label>
        </form>
    </div>
    <div class="../lib/register-wrapper">
        <!-- Register form -->
        <form action="register.php" method="post">
            <input type="text" name="fullname" placeholder="Full name">
            <input type="text" name="username" placeholder="Username">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <button type="submit" class="register">Register for Linkify</button>
        </form>
    </div>

  </div>

  </body>
</html>
