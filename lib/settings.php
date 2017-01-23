<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once __DIR__.'/functions.php';

  //check if the user is logged in
  if (!checkUserLogin($db)) {
    header('Location: /');
    die();
  }

  //check if the save button is clicked
  if ($_POST['saveButton']) {

    //check if password is empty, if it is throw an error
    if (empty($_POST['confirmPassword'])) {
      $_SESSION['error'] = 'Please fill in password to save.';
      header('Location: /account');
      die();
    }

    //check if inputs are empty, if they are throw an error
    if (empty($_POST['changeEmail']) && empty($_POST['changeUsername']) && empty($_POST['newPassword']) && empty($_POST['repeatPassword']) && empty($_POST['changeText'])) {
      $_SESSION['error'] = 'Please fill in some fields to change.';
      header('Location: /account');
      die();
    }

    //validate password, checks which user through session. If wrong password, throw an error
    if (!validateUserPassword($db, $_SESSION['loginUser']['uid'], $_POST['confirmPassword'])) {
      $_SESSION['error'] = 'Invalid password. Please try again';
      header('Location: /account');
      die();
    }

    $uid = $_SESSION['loginUser']['uid'];

    //checks if email input is not empty
    if (!empty($_POST['changeEmail'])) {
      //Escape data for security
      $email = mysqli_real_escape_string($db, $_POST['changeEmail']);

      //validate email, if invalid throw an error
      if (!validateEmail($db, $email)) {
        $_SESSION['error'] = 'The email you provided was invalid or already in use';
        header('Location: /account');
        die();
      }

      //Update the email
      if (!updateUser($db, $uid, $email, 'email')) {
        $_SESSION['error'] = 'Something went wrong with the request';
        header('Location: /account');
        die();
      }
    }

    //checks if username input is not empty
    if (!empty($_POST['changeUsername'])) {
      //Escape data for security
      $username = mysqli_real_escape_string($db, $_POST['changeUsername']);

      //validate username, if already in use throw an error
      if (!validateUsername($db, $username)) {
        $_SESSION['error'] = 'The username you provided is already in use';
        header('Location: /account');
        die();
      }

      //Update the username
      if (!updateUser($db, $uid, $username, 'username')) {
        $_SESSION['error'] = 'Something went wrong with the request';
        header('Location: /account');
        die();
      }
    }

    //checks if bio input is not empty
    if (!empty($_POST['changeText'])) {
      //Escape data for security
      $bio = mysqli_real_escape_string($db, $_POST['changeText']);

      //Update bio
      if (!updateUser($db, $uid, $bio, 'bio')) {
        $_SESSION['error'] = 'Something went wrong with the request';
        header('Location: /account');
        die();
      }
    }

    //If the new password input is not empty
    if(!empty($_POST['newPassword'])) {
      //If new password is filled in and not the repeat password, throw an error
      if (empty($_POST['repeatPassword'])) {
        $_SESSION['error'] = 'Please repeat your password.';
        header('Location: /account');
        die();
      }
      $newPassword = $_POST['newPassword'];
      $repeatPassword = $_POST['repeatPassword'];

      //checks if the new passwords matches, if not throw an error
      if (!($newPassword === $repeatPassword)) {
        $_SESSION['error'] = 'Passwords do not match. Please try again.';
        header('Location: /account');
        die();
      }
      //Escape password
      $newPassword = mysqli_real_escape_string($db, $newPassword);

      //hash the new password
      $password = password_hash($newPassword, PASSWORD_BCRYPT);

      //Update the password
      if (!updateUser($db, $uid, $password, 'password')) {
        $_SESSION['error'] = 'Something went wrong with the request';
        header('Location: /account');
        die();
      }
    }

    $_SESSION['message'] = 'Your settings has been updated';
    header('Location: /account');
    die();
  }
}
?>
