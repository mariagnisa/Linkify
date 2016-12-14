<?php

$loggedin = isset($_SESSION["loginUser"]);
 ?>

<header>
  <div class="navbar">
    <div class="logo">
      <h3>linkify</h3>
    </div>

      <?php if (!$loggedin): ?>
      <button type="button" name="login-button" class="login-button">Login</button>
      <button type="button" name="register-button" class="register-button">Sign up</button>
    <?php else: ?>
      <div class="logout-button">
        <a href="../lib/logout.php">Logout</a>
      </div>
    <?php endif; ?>


  </div>


</header>
