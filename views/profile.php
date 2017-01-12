<?php

require_once __DIR__.'/../lib/functions.php';
require_once __DIR__.'/../views/head.php';

$uid = $_SESSION['loginUser']['uid'];

$user = executeGetQuery($db, "SELECT * FROM users WHERE id = '$uid'", true);
$posts = executeGetQuery($db, "SELECT * FROM posts WHERE uid = '$uid'");

 ?>

<div class="profile-info">
  <h3>Profile</h3>
  <div class="profile-username">
    <?php echo $user['username']; ?>
  </div>
  <div class="profile-name">
    <?php echo $user['name']; ?>
  </div>
  <div class="profile-bio">
    <?php echo $user['bio']; ?>
  </div>
</div>
<br>
  <?php

  foreach ($posts as $post):
    $date = strtotime($post['published']);
    $date = date("l jS \of F Y", $date);
    if ($post['uid'] === $uid && sizeof($post) != 0):?>
      <div class="profile-posts">
        <a href="<?php echo $post['link']; ?>">
        <div class="post-title"><?php echo $post['title']; ?></div>
        </a>
        <div class="post-content"><?php echo $post['content']; ?></div>
        <div class="post-published"><?php echo 'Published ' . $date; ?></div>
      </div>
  <?php endif;
    endforeach;

      if (sizeof($posts) == 0): ?>
        <div class="profile-empty-posts">
          <p>No posts yet! What are you waiting for?</p>
        </div>
<?php die();
        endif;
?>

<?php  require_once __DIR__.'/../views/footer.php';  ?>
