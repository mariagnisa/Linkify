<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__.'/../lib/functions.php';

  //check if the user is logged in
  if (!checkUserLogin($db)) {
      header('Location: /');
      die();
  }

    $location = 'Location: /';

    if (isset($_GET['profile'])) {
        $location = 'Location: /profile';
    }

  //if the save button is clicked
  if (isset($_POST['editButton'])) {
      $title = $_POST['editTitle'];
      $content = $_POST['editContent'];
      $url = $_POST['editLink'];
      $postId = $_POST['postId'];
      $date = date('Y-m-d H:i:s');

    //check if the fields are empty, if they are throw error
    if (empty($title) || empty($content) || empty($url)) {
        $_SESSION['error'] = 'Please fill in all fields.';
        header($location);
        die();
    }

    // Remove all illegal characters from the url
    $url = filter_var($url, FILTER_SANITIZE_URL);

    //validate the link to be a url, if not throw error
    if (filter_var($url, FILTER_VALIDATE_URL) === false) {
        $_SESSION['error'] = 'Please provide a valid url link.';
        header($location);
        die();
    }

    //escape all data
    $title = mysqli_real_escape_string($db, $title);
      $content = mysqli_real_escape_string($db, $content);
      $url = mysqli_real_escape_string($db, $url);

    //if everything is good, update post to db, otherwise throw error
    if (!executePosts($db, "UPDATE posts SET title = '$title', content = '$content', link = '$url', published = '$date' WHERE id = '$postId'")) {
        $_SESSION['error'] = 'Something went wrong with the database request ->'.mysqli_errors($db);
        header($location);
        die();
    } else {
        $_SESSION['message'] = 'Your post has been updated.';
    }

      header($location);
      die();
  }

  //if the delete button is clicked
  if (isset($_POST['deleteButton'])) {
      $postId = $_POST['postId'];

    //deletes the specific post otherwise throw an error
    if (!executePosts($db, "DELETE FROM posts WHERE id = '$postId'")) {
        $_SESSION['error'] = 'Something went wrong with the database request ->'.mysqli_errors($db);
        header($location);
        die();
    } else {
        $_SESSION['message'] = 'Your post has been deleted.';
    }

      header($location);
      die();
  }
}
