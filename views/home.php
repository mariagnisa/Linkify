<?php

require_once __DIR__.'/../lib/functions.php';
require_once __DIR__.'/../views/head.php';

if (isset($_SESSION['error'])) {
  print_r($_SESSION['error']);
  unset($_SESSION['error']);
}

if (isset($_SESSION['message'])) {
  print_r($_SESSION['message']);
  unset($_SESSION['message']);
}

$uid = $_SESSION['loginUser']['uid'];

$posts = executeGetQuery($db, "SELECT * FROM posts");
 ?>

<h3>A place to rule them all</h3>
  <div class="post">
    <form action="/../lib/posts.php" method="post">
      <input type="text" name="title" placeholder="Title"><br>
      <textarea name="description" placeholder="Description"></textarea><br>
      <input type="url" name="link" placeholder="Your link"><br>
      <button type="submit" name="postButton">Share</button>
    </form>
  </div>
<?php
foreach ($posts as $post):
  $date = $post['published'];
  $date= date("l jS \of F Y");?>
    <div class="posts">
      <?php if ($post['uid'] === $uid): ?>
              <img class="posts-edit" src="../assets/img/edit.png" alt="Edit">
      <?php endif; ?>
      <img class="posts-avatar" src="../assets/img/avatars/avatar<?php echo $post['uid'] ?>.jpg" alt="avatar">
      <a href="<?php echo $post['link']; ?>">
      <div class="post-title"><?php echo $post['title']; ?></div>
      </a>
      <div class="post-content"><?php echo $post['content']; ?></div>
      <div class="post-published"><?php echo 'Published ' . $date; ?></div>
      <div class="comment-button">
        <a href="../views/viewPost.php?post=<?php echo $post['id'] ?>">Comments</a>
      </div>
    </div>
<?php
  endforeach;
 ?>

<?php  require_once __DIR__.'/../views/footer.php';  ?>
