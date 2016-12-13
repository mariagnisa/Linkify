<?php
require_once __DIR__.'/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //check if the input fields are not empty
  if ($_POST['username'] !== "" && $_POST['password'] !== "") {

    if ($uid = loginUser($db, $_POST['username'], $_POST['password'])) {
      session_start();
      //store the logged in users uid
      $_SESSION['loginUser'] = [
      'uid' => $uid
      ];
    }
  } else {
    //if missing fields
    session_start();
    $_SESSION['error'] = 'Please fill out all fields.';
  }

  header('Location: /');
  die();
}


 ?>
