<?php
require_once __DIR__.'/lib/functions.php';

$loggedInUser = checkUserLogin($db);
 ?>

<html>
  <head>
    <?php
    $title = 'Linkify';
    require_once __DIR__.'/views/head.php';
     ?>
  </head>
  <body>
  <?php
  require_once __DIR__.'/views/header.php';
    //checks if a user has a active session
    if ($loggedInUser) {
      //if active session, the user will come to home page
      require_once __DIR__.'/views/home.php';
    } else {
      //otherwise user will come to authenication page for login/register
      require_once __DIR__.'/views/authenication.php';
    }
   ?>
   <div class="cookie-box">
    <p>This website uses <a href="https://www.cookielaw.org/the-cookie-law">cookies</a> to ensure you get the best experience on our website.</p>
  <button class="cookie-box-button" type="button" name="button">Accept</button>
  </div>
  </body>
</html>
