<?php

require_once __DIR__.'/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //check if all fileds are filled in
  if ($_POST['fullname'] !== "" && $_POST['username'] !== "" && $_POST['email'] !== "" && $_POST['password'] !== "") {
    registerNewUser($db, $_POST['fullname'], $_POST['username'], $_POST['email'], $_POST['password']);
  } else {
    session_start();
    echo 'missing fileds';
  }
  header('Location: /');
  die();
}


 ?>
