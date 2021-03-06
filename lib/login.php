<?php

require_once __DIR__.'/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //check if the input fields are not empty
  if ($_POST['username'] !== '' && $_POST['password'] !== '') {
      if ($uid = loginUser($db, $_POST['username'], $_POST['password'])) {
          //store the logged in users uid
      $_SESSION['loginUser'] = array(
        'uid' => $uid,
      );
          setcookie('username', $_POST['username'], time() + (86400 * 30), '/');
          setcookie('password', $_POST['password'], time() + (86400 * 30), '/');
      }
  } else {
      //if missing fields throw an error
    $_SESSION['error'] = 'Please fill in all fields.';
      header('Location: /');
      die();
  }

    header('Location: /');
    die();
}
