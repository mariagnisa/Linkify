<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__.'/functions.php';

  //check if the user is logged in
  if (!checkUserLogin($db)) {
      header('Location: /');
      die();
  }

    $comment = $_POST['comment'];
    $user = $_SESSION['loginUser']['uid'];
    $postId = $_POST['postId'];
    $date = date('Y-m-d H:i:s');

  //check if the field is not empty, if throw an error
  if (empty($comment)) {
      $_SESSION['error'] = 'Please fill in fields.';
      header("Location: /post/$postId");
      die();
  }

  //escape data
  $comment = mysqli_real_escape_string($db, $comment);

  //if everything is good, insert into db, else throw an error
  if (!executePosts($db, "INSERT INTO comments (comment, published, uid, posts_id) VALUES ('$comment', '$date', '$user', '$postId')")) {
      $_SESSION['error'] = 'Something went wrong with the database request.';
      header("Location: /post/$postId");
      die();
  } else {
      $_SESSION['message'] = 'Your comment has been uploaded.';
  }

    header("Location: /post/$postId");
    die();
}
