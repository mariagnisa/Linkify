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
      if (executeGetQuery($db, "SELECT id FROM users WHERE email = '$email'", true)) {
          $validEmail = false;
      }
  }
  return $validEmail;
}

//Validates username against the db
function validateUsername($db, $username) {

  if (executeGetQuery($db, "SELECT id FROM users WHERE username = '$username'", true)) {
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

    //validate email
    if (!validateEmail($db, $email)) {
      session_start();
      $_SESSION['error'] = 'The email you provided was invalid or already in use';
      return false;
    }

    //validate username
    if (!validateUsername($db, $username)) {
      session_start();
      $_SESSION['error'] = 'The username you provided is already in use.';
      return false;
    }

    // Hash password
    $password = password_hash($password, PASSWORD_BCRYPT);

    //check if registration succeded
    session_start();
    if (!executePosts($db, "INSERT INTO users (email, name, password, username) VALUES ('$email', '$name', '$password', '$username')")) {
      $_SESSION['error'] = 'Failed to registrate.';
      return false;
    } else {
      $_SESSION['message'] = 'You are now registrated. Please login in to continue.';
      return true;
    }
}

//validates a user against db and if correct, the user logs into linkify
function LoginUser($db, $username, $password) {
  //Escapes username and password
  list($username, $password) = escapeData($db, [$username, $password]);

  //Fetch the user based on username or email
  $user = executeGetQuery($db, "SELECT * FROM users WHERE email = '$username' OR username = '$username'", true);
  if ($user) {
    //if username is matched in db, validate password
    if (password_verify($password, $user['password'])) {
      return $user['id'];
    }
  }
  session_start();
  $_SESSION['error'] = 'Invalid username, email or password';
  return false;
}


 ?>
