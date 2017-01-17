<?php

require_once __DIR__.'/../lib/functions.php';
require_once __DIR__.'/../views/head.php';

//Checks if the user id is set, if not the user will be thrown back to previous page
if (!isset($_GET['user'])) {
  header('Location: /home');
  die();
}

//Get the right user id from post
$userName = $_GET['user'];

//Fetch data from the logged in user
$user = executeGetQuery($db, "SELECT * FROM users WHERE username = '$userName'", true);
//Fetch all posts from the specifik user
$posts = executeGetQuery($db, "SELECT p.*, (SELECT username FROM users WHERE id = p.uid) as name FROM posts p ORDER BY published DESC");

?>

<div class="profile-intro">
  <h2>Profile info</h2>
</div>
<div class="profile-info">
  <?php //Checks if the user have any uploaded profile avatar or not
  if (!userImage($_SERVER['DOCUMENT_ROOT']."/assets/img/avatars", $user['id'])): ?>
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
  <h3><?php echo $userName; ?>s posts</h3>
</div>
<?php
foreach ($posts as $post):
  $date = strtotime($post['published']);
  $date = date("l jS \of F Y", $date);
  //Checks if the user have any posts, if there are some print all of them
  if ($post['uid'] === $uid && sizeof($post) != 0):?>
  <!-- Adding the post id-->
  <div class="postid<?php echo $post['id']; ?> profile-posts">
    <a href="<?php echo $post['link']; ?>">
      <div class="profile-post-title"><h3><?php echo $post['title']; ?></h3></div>
    </a>
    <div class="profile-post-content"><?php echo $post['content']; ?></div>
    <div class="profile-post-published"><?php echo 'Published ' . $date; ?></div>
  </div>
<?php endif; ?>
<?php endforeach;

//If the user have not made any posts, show message
if (sizeof($posts) == 0): ?>
<div class="profile-empty-posts">
  <p>No posts yet!</p>
</div>
<?php die();
endif;
?>

<?php  require_once __DIR__.'/../views/footer.php';  ?>
