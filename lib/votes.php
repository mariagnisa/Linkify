<?php

session_start();

require_once __DIR__.'/../lib/functions.php';

//check if the user is logged in
if (!checkUserLogin($db)) {
  header('Location: /');
  die();
}

$postId = $_GET['post'];
$vote = $_GET['vote'];
$uid = $_SESSION['loginUser']['uid'];

$currentVote = executeGetQuery($db, "SELECT * FROM votes WHERE post_id = '$postId' AND uid = '$uid'", true);

if ($vote == 'up') {
  if (isset($currentVote)) {
    if ($currentVote['vote_up'] === '1') {
      $_SESSION['error'] = 'You have already voted up on this post.';
      header('Location: /');
      die();
    } else {
      $currentVoteId = $currentVote['id'];
      executePosts($db, "UPDATE votes SET vote_up = TRUE WHERE id = '$currentVoteId'");
      $_SESSION['message'] = 'You have now changed your vote.';
      header('Location: /');
      die();
    }
  } else {
    if (!executePosts($db, "INSERT INTO votes (vote_up, post_id, uid) VALUES (TRUE, '$postId', '$uid')")) {
      $_SESSION['error'] = 'Something went wrong with the database request.';
      header('Location: /');
      die();
    } else {
      $_SESSION['message'] = 'Your vote has been registered.';
      header('Location: /');
      die();
    }
  }
} elseif ($vote == 'down') {
  if (isset($currentVote)) {
    var_dump($currentVote);
    if ($currentVote['vote_up'] === '0') {
      $_SESSION['error'] = 'You have already voted up on this post.';
      header('Location: /');
      die();
    } else {
      $currentVoteId = $currentVote['id'];
      executePosts($db, "UPDATE votes SET vote_up = FALSE WHERE id = '$currentVoteId'");
      $_SESSION['message'] = 'You have now changed your vote.';
      header('Location: /');
      die();
    }
  } else {
    if (!executePosts($db, "INSERT INTO votes (vote_up, post_id, uid) VALUES (FALSE, '$postId', '$uid')")) {
      $_SESSION['error'] = 'Something went wrong with the database request.';
      header('Location: /');
      die();
    } else {
      $_SESSION['message'] = 'Your vote has been registered.';
      header('Location: /');
      die();
    }
  }
}



?>
