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
          <input type="checkbox" name="remember" class="remember-checkbox" checked>
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

    <?php
    $posts = executeGetQuery($db, "SELECT * FROM posts");
    foreach ($posts as $post):
      $date = strtotime($post['published']);
      $date = date("l jS \of F Y", $date);?>
      <div class="posts">
        <img class="posts-avatar" src="../assets/img/avatars/avatar<?php echo $post['uid'] ?>.jpg" alt="avatar">
        <a href="<?php echo $post['link']; ?>">
          <div class="post-title"><?php echo $post['title']; ?></div>
        </a>
        <div class="post-content"><?php echo $post['content']; ?></div>
        <div class="post-published"><?php echo 'Published ' . $date; ?></div>
      </div>
    <?php
    endforeach;
    ?>

<?php  require_once __DIR__.'/../views/footer.php';  ?>
