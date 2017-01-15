<?php

session_start();

require_once __DIR__.'/../lib/functions.php';

//check if the user is logged in
if (!checkUserLogin($db)) {
  header('Location: /');
  die();
}

//Fetch the specific post id
$postId = $_GET['post'];
//Fetch the specific vote request, up or down
$vote = $_GET['vote'];
$uid = $_SESSION['loginUser']['uid'];

//Get the specific post and the logged in user
$currentVote = executeGetQuery($db, "SELECT * FROM votes WHERE post_id = '$postId' AND uid = '$uid'", true);

//If the user pressed vote up
if ($vote == 'up') {
  //Checks if the user has already voted (up)
  if (isset($currentVote)) {
    //If the user has voted the same before, throw an error
    if ($currentVote['vote_up'] === '1') {
      $_SESSION['error'] = 'You have already voted up on this post.';
      header('Location: /');
      die();
    } else {
      //If the user has voted, but voted down before, the vote is updated
      $currentVoteId = $currentVote['id'];
      executePosts($db, "UPDATE votes SET vote_up = TRUE WHERE id = '$currentVoteId'");
      $_SESSION['message'] = 'You have now changed your vote.';
      header('Location: /');
      die();
    }
  } else {
    //If the user has not voted before, and all good with db request, insert vote.
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
} //If the user pressed vote down
elseif ($vote == 'down') {
  //Checks if the user has already voted (down)
  if (isset($currentVote)) {
    //If the user has voted the same before, throw an error
    if ($currentVote['vote_up'] === '0') {
      $_SESSION['error'] = 'You have already voted up on this post.';
      header('Location: /');
      die();
    } else {
      //If the user has voted, but voted up before, the vote is updated
      $currentVoteId = $currentVote['id'];
      executePosts($db, "UPDATE votes SET vote_up = FALSE WHERE id = '$currentVoteId'");
      $_SESSION['message'] = 'You have now changed your vote.';
      header('Location: /');
      die();
    }
  } else {
    //If the user has not voted before, and all good with db request, insert vote.
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
