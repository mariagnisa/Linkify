<?php
require_once __DIR__.'/lib/functions.php';

$loggedInUser = checkUserLogin($db);
 ?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Linkify</title>
    <script src="/assets/js/main.js"></script>
  </head>
  <body>
  <?php
    //checks if a user has a active session
    if ($loggedInUser) {
      //if active session, the user will come to home page
      require_once __DIR__.'/views/home.php';
    } else {
      //otherwise user will come to authenication page for login/register
      require_once __DIR__.'/views/authenication.php';
    }
   ?>
   <div class="alertbox">
    <p>This website uses <a href="https://www.cookielaw.org/the-cookie-law">cookies</a> to ensure you get the best experience on our website.</p>
  <button class="button" type="submit" name="button">Accept</button>
  </div>
  </body>
</html>
