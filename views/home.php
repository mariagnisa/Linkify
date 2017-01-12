<?php

require_once __DIR__.'/../lib/functions.php';
require_once __DIR__.'/../views/head.php';

$uid = $_SESSION['loginUser']['uid'];

$posts = executeGetQuery($db, "SELECT p.*, (SELECT COUNT(*) FROM votes WHERE post_id = p.id AND vote_up = TRUE) as votes FROM posts p ORDER BY votes DESC, published DESC");

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
  $date = strtotime($post['published']);
  $date = date("l jS \of F Y", $date);?>
  <div class="postid<?php echo $post['id'] ?> posts">
    <?php if (!($post['uid'] === $uid)): ?>
      <a href="../lib/votes.php?vote=up&post=<?php echo $post['id'] ?>">
      <img class="posts-arrow-up" src="../assets/img/arrow-up.png" alt="up arrow"></a>
      <?php echo $post['votes']; ?>
      <a href="../lib/votes.php?vote=down&post=<?php echo $post['id'] ?>">
      <img class="posts-arrow-down" src="../assets/img/arrow-down.png" alt="down arrow"></a>
    <?php endif; ?>
    <?php if ($post['uid'] === $uid): ?>
      <img class="postid<?php echo $post['id'] ?> posts-edit" src="../assets/img/edit.png" alt="Edit">
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

  <div class="postid<?php echo $post['id'] ?> edit-post">
    <img class="postid<?php echo $post['id'] ?> edit-post-cross" src="../assets/img/cross.png" alt="cross">
    <form action="../lib/updatePosts.php" method="post">
      <input type="hidden" name="postId" value="<?php echo $post['id'] ?>">
      <input type="text" name="editTitle" value="<?php echo $post['title']; ?>">
      <textarea name="editContent"><?php echo $post['content']; ?></textarea>
      <input type="url" name="editLink" value="<?php echo $post['link']; ?>">
      <button class="edit-post-save" type="submit" name="editButton">Save changes</button>
      <button class="edit-post-delete" type="submit" name="deleteButton">Delete post</button>
    </form>
  </div>
  <?php
endforeach;
?>




<?php  require_once __DIR__.'/../views/footer.php';  ?>
