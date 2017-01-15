<?php

require_once __DIR__.'/../lib/functions.php';
require_once __DIR__.'/../views/head.php';

?>

<div class="login-wrapper">
  <!-- Login form -->
  <form action="../lib/login.php" method="post">
    <input type="text" name="username" placeholder="Email or username">
    <input type="password" name="password" placeholder="Password">
    <button type="submit" class="login">Log in</button>
    <input type="checkbox" name="remember" checked>
    <label for="remember-checkbox">Remember me</label>
  </form>
</div>
<div class="register-wrapper">
  <!-- Register form -->
  <form action="../lib/register.php" method="post">
    <input type="text" name="fullname" placeholder="Full name">
    <input type="text" name="username" placeholder="Username">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <input type="password" name="repeatPass" placeholder="Repeat password">
    <button type="submit" class="register">Register for Linkify</button>
  </form>
</div>

<div class="public-intro">
  <h2>A place to rule them all.</h2>
  <h4>Join or login to get the most of this page.</h4>
</div>

<?php
$posts = executeGetQuery($db, "SELECT * FROM posts ORDER BY published DESC");

//Show all posts, order by published date
foreach ($posts as $post):
  $date = strtotime($post['published']);
  $date = date("l jS \of F Y", $date);?>
  <div class="public-posts">
    <img class="public-posts-avatar" src="../assets/img/avatars/avatar<?php echo $post['uid'] ?>.jpg" alt="avatar">
    <a href="<?php echo $post['link']; ?>">
      <div class="public-post-title"><h3><?php echo $post['title']; ?></h3></div>
    </a>
    <div class="public-post-content"><?php echo $post['content']; ?></div>
    <div class="public-post-published"><?php echo 'Published ' . $date; ?></div>
  </div>
  <?php
endforeach;
?>

<?php  require_once __DIR__.'/../views/footer.php';  ?>
