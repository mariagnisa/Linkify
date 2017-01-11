<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once __DIR__.'/../lib/functions.php';

  //check if the user is logged in
  if (!checkUserLogin($db)) {
    header('Location: /');
    die();
  }

  $save = $_POST['editButton'];
  $delete = $_POST['deleteButton'];

  //if the save button is clicked
  if (isset($save)) {
    $title = $_POST['editTitle'];
    $content = $_POST['editContent'];
    $url = $_POST['editLink'];
    $postId = $_POST['postId'];
    $date = date('Y-m-d H:i:s');

    //check if the fields are empty, if error
    if (empty($title) || empty($content) || empty($url)) {
      $_SESSION['error'] = 'Please fill in all fields.';
      header('Location: /');
      die();
    }

    // Remove all illegal characters from the url
    $url = filter_var($url, FILTER_SANITIZE_URL);

    //validate the link to be a url
    if (filter_var($url, FILTER_VALIDATE_URL) === false) {
      $_SESSION['error'] = 'Please provide a valid url link.';
      header('Location: /');
      die();
    }

    //escape data
    $title = mysqli_real_escape_string($db, $title);
    $content = mysqli_real_escape_string($db, $content);
    $url = mysqli_real_escape_string($db, $url);

    //if everything is good, update post to db, otherwise throw error
    if (!executePosts($db, "UPDATE posts SET title = '$title', content = '$content', link = '$url', published = '$date' WHERE id = '$postId'")) {
      $_SESSION['error'] = 'Something went wrong with the database request.';
      header('Location: /');
      die();
    } else {
      $_SESSION['message'] = 'Your post has been updated.';
    }

    header('Location: /');
    die();
  }

  //if the delete button is clicked
  if (isset($delete)) {
    $postId = $_POST['postId'];

  //deletes the specifik post otherwise throw an error
    if (!executePosts($db, "DELETE FROM posts WHERE id = '$postId'")) {
      $_SESSION['error'] = 'Something went wrong with the database request.';
      header('Location: /');
      die();
    } else {
      $_SESSION['message'] = 'Your post has been deleted.';
    }

    header('Location: /');
    die();
  }
}


 ?>
