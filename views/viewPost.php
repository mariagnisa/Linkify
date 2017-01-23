<?php

require_once __DIR__.'/../lib/functions.php';

if (!checkUserLogin($db)) {
  header('Location: /');
}

require_once __DIR__.'/../views/head.php';

//Checks if the post id is set, if not the user will be thrown back to previous page
if (!isset($_GET['post'])) {
  header('Location: /home');
  die();
}

//Get the right post id from comment link
$postId = $_GET['post'];
//Fetch the specifik post
$post = executeGetQuery($db, "SELECT * FROM posts WHERE id = '$postId'", true);
//Fetch all comments to the specific post
$comments = executeGetQuery($db, "SELECT * FROM comments INNER JOIN users ON (comments.uid = users.id) WHERE posts_id = '$postId' ORDER BY published DESC");

$date = strtotime($post['published']);
$date = date("l jS \of F Y", $date);?>
<div class="view-posts">
  <?php //Checks if the user have any uploaded profile avatar or not
  if (!userImage($_SERVER['DOCUMENT_ROOT']."/assets/img/avatars", $post['uid'])): ?>
  <img class="view-posts-avatar" src="../assets/img/noavatar.jpg" alt="avatar">
<?php else: ?>
  <img class="view-posts-avatar" src="../assets/img/avatars/avatar<?php echo $post['uid']; ?>.jpg" alt="avatar">
<?php endif; ?>
<a href="<?php echo $post['link']; ?>">
  <div class="view-post-title"><h3><?php echo $post['title']; ?></h3></div>
</a>
<div class="view-post-content"><?php echo $post['content']; ?></div>
<div class="view-post-published"><?php echo 'Published ' . $date; ?></div>
</div>

<!-- Share comment form -->
<div class="comment-form">
  <form action="../lib/comments.php" method="post">
    <!-- Sending the specific post id -->
    <input type="hidden" name="postId" value="<?php echo $post['id']; ?>">
    <input type="text" name="comment" placeholder="Write comment"><br>
    <button type="submit" id="commentButton" name="comment-form-button">Comment</button>
  </form>
</div>

<div class="comment-intro">
  <h3>Comments</h3>
</div>

<?php
//Prints all comments
foreach ($comments as $comment):
  $date = strtotime($comment['published']);
  $date = date("l jS \of F Y", $date);?>
  <div class="post-comments">
    <?php //Checks if the user have any uploaded profile avatar or not
    if (!userImage($_SERVER['DOCUMENT_ROOT']."/assets/img/avatars", $comment['uid'])): ?>
    <a href="/profile/<?php echo $comment['username']; ?>">
      <img src="../assets/img/noavatar.jpg" alt="avatar">
    </a>
  <?php else: ?>
    <a href="/profile/<?php echo $comment['username']; ?>">
      <img src="../assets/img/avatars/avatar<?php echo $comment['uid']; ?>.jpg" alt="avatar">
    </a>
  <?php endif; ?>
  <div class="comment"><?php echo $comment['comment']; ?></div>
  <div class="comment-published"><?php echo 'Published ' . $date; ?></div>
</div>
<?php
endforeach;

//If there is no comments
if (sizeof($comments) == 0): ?>
<div class="post-comment-empty">
  <p>No comments yet! Be the first one to write what you think!</p>
</div>
<?php die();
endif;

?>
<?php  require_once __DIR__.'/../views/footer.php';  ?>
