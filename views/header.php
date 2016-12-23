<?php
session_start();
$loggedin = checkUserLogin($db);

if ($loggedin) {
  $uid = $_SESSION["loginUser"]['uid'];
  $user = executeGetQuery($db, "SELECT id FROM users WHERE id = '$uid'", true);
}
 ?>

<header>
  <div class="navbar">

    <?php
     if (!$loggedin): ?>
      <div class="logo">
        <h2>linkify</h2>
      </div>
      <button type="button" name="login-button" class="login-button">Login</button>
      <button type="button" name="register-button" class="register-button">Sign up</button>
    <?php else: ?>
      <div class="logo">
        <a href="/views/home.php"><h2>linkify</h2></a>
      </div>
      <div class="logout-button">
        <a href="/../lib/logout.php">Logout</a>
      </div>
      <div class="account-button">
        <a href="/views/settings.php">Account</a>
      </div>

      <?php if (!hasImage($_SERVER['DOCUMENT_ROOT']."/assets/img/avatars")): ?>
              <a href="/views/profile.php">
                <div class="profile">
                  <p class="profile-text">Profile</p>
                </div>
              </a>
        <?php else: ?>
              <a href="/views/profile.php">
              <img class="profile" src="../assets/img/avatars/avatar<?php echo $user['id'] ?>.jpg" alt="avatar">
              </a>
      <?php endif; ?>
    <?php endif; ?>
  </div>

</header>
