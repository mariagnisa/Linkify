<?php
require 'functions.php';

$loggedInUser = checkUserLogin($db);
 ?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Linkify</title>
  </head>
  <body>
  <p>Hej </p>
  <?php
    //checks if a user has a active session
    if ($loggedInUser) {
      //if active session, the user will come to home page
      require('views/home.php');
    } else {
      //otherwise user will come to authenication page for login/register
      require('authenication.php');
    }
   ?>
  </body>
</html>
