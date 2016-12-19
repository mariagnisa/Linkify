<?php

$loggedin = isset($_SESSION["loginUser"]);
 ?>

<header>
  <div class="navbar">

    <?php if (!$loggedin): ?>
      <div class="logo">
        <h3>linkify</h3>
      </div>
      <button type="button" name="login-button" class="login-button">Login</button>
      <button type="button" name="register-button" class="register-button">Sign up</button>
    <?php else: ?>
      <div class="logo">
        <a href="/views/home.php"><h3>linkify</h3></a>
      </div>
      <div class="logout-button">
        <a href="/../lib/logout.php">Logout</a>
      </div>
      <div class="account-button">
        <a href="/views/settings.php">Account</a>
      </div>

      <a href="/views/profile.php">
      <img class="profile" src="/../assets/img/avatars/avatar<?php echo $_SESSION['loginUser']['uid'] ?>.jpg" alt="avatar">
      </a>
    <?php endif; ?>
  </div>


</header>
