<?php
require('database.php');


function errorMessage($sgl, $queryException) {
  echo '<pre>';
  echo $sgl;
  echo "\n\n\n";

  die(sprintf('Something went wrong when executing query. Reason: %s', $queryException->getMessage()));
}

//validates email, both format and against the db
function validateEmail($db, $email) {
  $validEmail = true;

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $validEmail = false;
  } else {
      if (executeQuery($db, "SELECT id FROM users WHERE email = '$email'", true)) {
          $validEmail = false;
      }
  }
  return $validEmail;
}

//Validates username against the db
function validateUsername($db, $username) {

  if (executeQuery($db, "SELECT id FROM users WHERE username = '$username'", true)) {
    return false;
  }
  return true;
}

//Escape special characters for security. return array of values
function escapeData($db, $items) {

  foreach ($items as $i => $item) {
        $items[$i] = mysqli_real_escape_string($db, $item);
    }
    return $items;
}

//Insert new user to the database and validates username and email against the db
function registerNewUser($db, $name, $username, $email, $password) {
  // Escape all the data received from the user
    list($name, $username, $email, $password) = escapeData($db, [$name, $username, $email, $password]);


}


 ?>
