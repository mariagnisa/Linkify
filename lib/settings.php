<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once __DIR__.'/functions.php';

  //check if the user is logged in
  if (!checkUserLogin($db)) {
    header('Location: /');
    die();
  }

  $save = $_POST['saveButton'];
  //check if the save button is clicked
  if ($save) {

    unset($_SESSION['message']);
    unset($_SESSION['error']);

    //validate email
    if (!filter_var($_POST['changeEmail'], FILTER_VALIDATE_EMAIL)) {
      $_SESSION['error'] = 'The email you provided was invalid';
      header('Location: ../views/settings.php');
      die();
    }

    //check if email and password inputs are empty
    if (empty($_POST['changeEmail']) || empty($_POST["confirmPassword"])) {
      $_SESSION['error'] = 'Missing fields.';
      header('Location: ../views/settings.php');
      die();
    }

    //validate password, checks which user through session
    if (!validateUserPassword($db, $_SESSION['loginUser']['uid'], $_POST['confirmPassword'])) {
      $_SESSION['error'] = 'Invalid password.';
      header('Location: ../views/settings.php');
      die();
    }

    $uid = $_SESSION['loginUser']['uid'];
    //Escape data for security
    $email = mysqli_real_escape_string($db, $_POST['changeEmail']);
    $bio = mysqli_real_escape_string($db, $_POST['changeText']);

    //the sql beginning for update email and bio, password further below
    $updateSql = "UPDATE users SET email = '$email', bio = '$bio'";

    //if new password is not empty, checks if repeat password is filled in
    if(!empty($_POST['newPassword'])) {
      if (empty($_POST['repeatPassword'])) {
        $_SESSION['error'] = 'Please repeat your password.';
        header('Location: ../views/settings.php');
        die();
      }
      $newPassword = $_POST['newPassword'];
      $repeatPassword = $_POST['repeatPassword'];

      //checks if the new passwords match, if not error
      if (!($newPassword === $repeatPassword)) {
        $_SESSION['error'] = 'Passwords do not match. Please try again.';
        header('Location: ../views/settings.php');
        die();
      }
      //hash the new password
      $password = password_hash($newPassword, PASSWORD_BCRYPT);
      //adding password to the sql update
      $updateSql = $updateSql . ", password = '$password'";
    }
    //the end for the sql update statement,
    $whereClause =  " WHERE id = '$uid'";

    //change email or password, if not error
    if (!executePosts($db, $updateSql.$whereClause)) {
      $_SESSION['error'] = 'Something went wrong with the database request.';
    } else {
      $_SESSION['message'] = 'Your settings has been updated';
    }
    header('Location: ../views/settings.php');
    die();
  }
}
 ?>
