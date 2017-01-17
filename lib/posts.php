<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once __DIR__.'/functions.php';

  //check if the user is logged in
  if (!checkUserLogin($db)) {
    header('Location: /');
    die();
  }

  $title = $_POST['title'];
  $user = $_SESSION['loginUser']['uid'];
  $description = $_POST['description'];
  $link = $_POST['link'];
  $date = date('Y-m-d H:i:s');

  //check if the fields are empty, if error
  if (empty($title) || empty($description) || empty($link)) {
    $_SESSION['error'] = 'Please fill in all fields.';
    header('Location: /');
    die();
  }

  // Remove all illegal characters from the url
  $link = filter_var($link, FILTER_SANITIZE_URL);

  //validate the link to be a url
  if (filter_var($link, FILTER_VALIDATE_URL) === false) {
    $_SESSION['error'] = 'Please provide a valid url link.';
    header('Location: /');
    die();
  }

  //escape data
  $title = mysqli_real_escape_string($db, $_POST['title']);
  $description = mysqli_real_escape_string($db, $_POST['description']);
  $link = mysqli_real_escape_string($db, $_POST['link']);

  //if everything is good, insert into db, else throw an error
  if (!executePosts($db, "INSERT INTO posts (title, content, link, published, uid) VALUES ('$title', '$description', '$link', '$date', '$user')")) {
    $_SESSION['error'] = 'Something went wrong with the database request ->' . mysqli_errors($db);
    header('Location: /');
    die();
  } else {
    $_SESSION['message'] = 'Your post has been uploaded.';
  }

  header('Location: /');
  die();
}

?>
