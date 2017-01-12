<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once __DIR__.'/functions.php';

  unset($_SESSION['message']);
  unset($_SESSION['error']);

  //check if the user is logged in
  if (!checkUserLogin($db)) {
    header('Location: /');
    die();
  }

  $comment = $_POST['comment'];
  $user = $_SESSION['loginUser']['uid'];
  $postId = $_POST['postId'];
  $date = date('Y-m-d H:i:s');


  //check if the field is not empty, if error
  if (empty($comment)) {
    $_SESSION['error'] = 'Please fill in fields.';
    header('Location: /');
    die();
  }

  //escape data
  $comment = mysqli_real_escape_string($db, $_POST['comment']);

  //if everything is good, put into db, else error
  if (!executePosts($db, "INSERT INTO comments (comment, published, uid, posts_id) VALUES ('$comment', '$date', '$user', '$postId')")) {
    $_SESSION['error'] = 'Something went wrong with the database request.';
    header('Location: ../views/viewPost.php');
    die();
  } else {
    $_SESSION['message'] = 'Your comment has been uploaded.';
  }

  header('Location: ../views/viewPost.php');
  die();
}



 ?>