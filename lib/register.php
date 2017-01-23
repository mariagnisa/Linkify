<?php

require_once __DIR__.'/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //check if all fileds are filled in, if not throw an error
  if ($_POST['fullname'] !== "" && $_POST['username'] !== "" && $_POST['email'] !== "" && $_POST['password'] !== "" && $_POST['repeatPass'] !== "") {
    registerNewUser($db, $_POST['fullname'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['repeatPass']);
  } else {
    $_SESSION['error'] = 'Please fill in all fields to continue your registration.';
    header('Location: /');
    die();
  }
  header('Location: /');
  die();
}

 ?>
