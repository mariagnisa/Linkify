<?php
require_once __DIR__.'/database.php';

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
function registerNewUser($db, $name, $username, $email, $password, $repeatPass) {
  // Escape all the data received from the user
  list($name, $username, $email, $password, $repeatPass) = escapeData($db, [$name, $username, $email, $password, $repeatPass]);

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

  //checks if the passwords matches, if not error
  if (!($password === $repeatPass)) {
    $_SESSION['error'] = 'Passwords do not match. Please try again.';
    header('Location: /');
    die();
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
function loginUser($db, $username, $password) {
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

//check if a user is logged in through an active session
function checkUserLogin($db) {

  if (!isset($_SESSION['loginUser'])) {
    return false;
  }
  return true;
}

function validateUserPassword($db, $uid, $password) {
  $hash = executeGetQuery($db, "SELECT password FROM users WHERE id = '$uid'", true)['password'];
  return password_verify($password, $hash);
}

function hasImage($imageFolder) {
  //$imageFolder = "../assets/img/avatars";
  $imageLink = "avatar" . $_SESSION['loginUser']['uid'] . ".jpg";
  $images = scandir($imageFolder);
  foreach ($images as $image) {
    if ($image === $imageLink) {
      return true;
    }
  }
  return false;
}
?>
