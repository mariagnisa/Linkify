<?php

require_once __DIR__.'/../lib/functions.php';

if (!checkUserLogin($db)) {
    header('Location: /');
}
require_once __DIR__.'/../views/head.php';

$uid = $_SESSION['loginUser']['uid'];

//Fetch data from the logged in user
$user = executeGetQuery($db, "SELECT * FROM users WHERE id = '$uid'", true);
//Fetch all posts from the logged in user
$posts = executeGetQuery($db, "SELECT * FROM posts WHERE uid = '$uid' ORDER BY published DESC");

?>

<div class="profile-intro">
  <h2>Profile info</h2>
</div>
<div class="profile-info">
  <?php //Checks if the user have any uploaded profile avatar or not
  if (!userImage($_SERVER['DOCUMENT_ROOT'].'/assets/img/avatars', $user['id'])): ?>
  <img class="profile-info-avatar" src="../assets/img/noavatar.jpg" alt="avatar">
<?php else: ?>
  <img class="profile-info-avatar" src="../assets/img/avatars/avatar<?php echo $user['id']; ?>.jpg" alt="avatar">
<?php endif; ?>
  <p>Username: <?php echo $user['username']; ?> </p>
  <p>Fullname: <?php echo $user['name']; ?> </p>
  <p>Bio: <?php echo $user['bio']; ?> </p>
  <hr>
</div>
<br>
<div class="profile-posts-intro">
  <h3>Your posts</h3>
</div>
<?php
foreach ($posts as $post):
  $date = strtotime($post['published']);
  $date = date("l jS \of F Y", $date);
  //Checks if the user have any posts, if there are some print all of them
  if ($post['uid'] === $uid && count($post) !== 0):?>
  <!-- Adding the post id-->
  <div class="postid<?php echo $post['id']; ?> profile-posts">
    <img class="postid<?php echo $post['id']; ?> profile-edit" src="../assets/img/edit.png" alt="Edit">
    <a href="<?php echo $post['link']; ?>">
      <div class="profile-post-title"><h3><?php echo $post['title']; ?></h3></div>
    </a>
    <div class="profile-post-content"><?php echo $post['content']; ?></div>
    <div class="profile-post-published"><?php echo 'Published '.$date; ?></div>
  </div>
<?php endif; ?>

<!-- Adding the post id -->
<div class="postid<?php echo $post['id']; ?> profile-edit-post">
  <!-- Adding the post id so when closed, right post is shown-->
  <img class="postid<?php echo $post['id']; ?> profile-edit-post-cross" src="../assets/img/cross.png" alt="cross">
  <form action="../lib/updatePosts.php?profile=true" method="post">
    <input type="hidden" name="postId" value="<?php echo $post['id']; ?>">
    <input type="text" name="editTitle" value="<?php echo $post['title']; ?>">
    <textarea name="editContent"><?php echo $post['content']; ?></textarea>
    <input type="url" name="editLink" value="<?php echo $post['link']; ?>">
    <button class="profile-edit-post-save" type="submit" name="editButton">Save changes</button>
    <button class="profile-edit-post-delete" type="submit" name="deleteButton">Delete post</button>
  </form>
</div>
<?php endforeach;

//If the user have not made any posts, show message
if (count($posts) === 0): ?>
<div class="profile-empty-posts">
  <p>No posts yet! What are you waiting for?</p>
</div>
<?php die();
endif;
?>

<?php  require_once __DIR__.'/../views/footer.php'; ?>
