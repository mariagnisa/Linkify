<?php

$loggedin = checkUserLogin($db);

if ($loggedin) {
    $uid = $_SESSION["loginUser"]['uid'];
    $user = executeGetQuery($db, "SELECT id FROM users WHERE id = '$uid'", true);
}
?>
<header>
  <div class="navbar">

    <?php
    //If the user is not logged in, show login and register options
    if (!$loggedin): ?>
    <div class="logo">
      <h2>linkify</h2>
    </div>
    <button type="button" name="login-button" class="login-button">Login</button>
    <button type="button" name="register-button" class="register-button">Sign up</button>
    <?php
    // If the user is logged in, show buttons with links to different pages
  else: ?>
  <div class="logo">
    <a href="/home"><h2>linkify</h2></a>
  </div>
  <div class="logout-button">
    <a href="/logout">Logout</a>
  </div>
  <div class="account-button">
    <a href="/account">Account</a>
  </div>

  <?php //Checks if the user have any uploaded profile avatar or not
  if (!hasImage($_SERVER['DOCUMENT_ROOT']."/assets/img/avatars")): ?>
  <a href="/profile">
    <img class="profile-avatar" src="../assets/img/noavatar.jpg" alt="avatar">
  </a>
<?php else: ?>
  <a href="/profile">
    <img class="profile-avatar" src="../assets/img/avatars/avatar<?php echo $user['id'] ?>.jpg" alt="avatar">
  </a>
<?php endif; ?>
<?php endif; ?>
</div>

<div class="cookie-box">
  <div class="cookie-box-p">
    <p>This website uses <a href="https://www.cookielaw.org/the-cookie-law">cookies</a> to ensure you get the best experience on our website.</p>
  </div>
  <button class="cookie-box-button" type="button" name="button">Accept</button>
</div>

</header>

<div class="wrapper">
