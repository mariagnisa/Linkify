<?php

require_once __DIR__.'/../lib/functions.php';
require_once __DIR__.'/../views/head.php';

$uid = $_SESSION['loginUser']['uid'];

//Fetch data from the logged in user
$user = executeGetQuery($db, "SELECT * FROM users WHERE id = '$uid'", true);
//Fetch all posts from the logged in user
$posts = executeGetQuery($db, "SELECT * FROM posts WHERE uid = '$uid'");

?>

<div class="profile-intro">
  <h3>Profile info</h3>
</div>
<div class="profile-info">
  <p>Username: <?php echo $user['username']; ?> </p>
  <p>Fullname: <?php echo $user['name']; ?> </p>
  <p>Bio: <?php echo $user['bio']; ?> </p>
  <p style="font-style: italic">If you want to change your settings please visit your account page to update them.</p>
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
  if ($post['uid'] === $uid && sizeof($post) != 0):?>
  <div class="profile-posts">
    <a href="<?php echo $post['link']; ?>">
      <div class="profile-post-title"><?php echo $post['title']; ?></div>
    </a>
    <div class="profile-post-content"><?php echo $post['content']; ?></div>
    <div class="profile-post-published"><?php echo 'Published ' . $date; ?></div>
  </div>
<?php endif;
endforeach;
//If the user have not made any posts, show message
if (sizeof($posts) == 0): ?>
<div class="profile-empty-posts">
  <p>No posts yet! What are you waiting for?</p>
</div>
<?php die();
endif;
?>

<?php  require_once __DIR__.'/../views/footer.php';  ?>
