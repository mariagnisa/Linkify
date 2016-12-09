<?php
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //check if the input fields are not empty
  if ($_POST['username'] !== "" && $_POST['password'] !== "") {

    if ($uid = LoginUser($db, $_POST['username'], $_POST['password'])) {
      session_start();
      $_SESSION['login'] = [
      'uid' => $uid
      ];
    }
  } else {
    //if missing fields
    session_start();
    $_SESSION['error'] = 'Please fill out all fields.';
  }
  header('Location: views/home.php');
  die();
}


 ?>
