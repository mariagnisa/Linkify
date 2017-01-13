<?php

require_once __DIR__.'/../lib/functions.php';
require_once __DIR__.'/../views/head.php';

$uid = $_SESSION['loginUser']['uid'];

//Get all posts and votes that are up(true), order by votes number and published date
$posts = executeGetQuery($db, "SELECT p.*, (SELECT COUNT(*) FROM votes WHERE post_id = p.id AND vote_up = TRUE) as votes FROM posts p ORDER BY votes DESC, published DESC");

?>
<div class="home-intro">
  <h3>A place to rule them all</h3>
</div>

<!-- Share post form -->
<div class="share-post">
  <form action="/../lib/posts.php" method="post">
    <input type="text" name="title" placeholder="Title"><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <input type="url" name="link" placeholder="Your link"><br>
    <button type="submit" name="postButton">Share</button>
  </form>
</div>

<?php
//prints all posts and votes
foreach ($posts as $post):
  //Convert datetime to specific date format
  $date = strtotime($post['published']);
  $date = date("l jS \of F Y", $date);?>

  <!-- Adding the post id to parent div-->
  <div class="postid<?php echo $post['id'] ?> posts">
    <?php //Only show voting system on other posts, not the logged in users posts
     if (!($post['uid'] === $uid)):
       //Sending two querys with vote, which vote and the post id ?>
      <a href="../lib/votes.php?vote=up&post=<?php echo $post['id'] ?>">
      <img class="posts-arrow-up" src="../assets/img/arrow-up.png" alt="up arrow"></a>
      <a href="../lib/votes.php?vote=down&post=<?php echo $post['id'] ?>">
      <img class="posts-arrow-down" src="../assets/img/arrow-down.png" alt="down arrow"></a>
    <?php endif; ?>
     <div class="posts-vote">
       <?php //print votes
       echo $post['votes']; ?>
     </div>

    <?php //Show edit options for the logged in users posts
     if ($post['uid'] === $uid):
       //Adding the post id so the right post can be edited ?>
      <img class="postid<?php echo $post['id']; ?> posts-edit" src="../assets/img/edit.png" alt="Edit">
    <?php endif; ?>
    <img class="posts-avatar" src="../assets/img/avatars/avatar<?php echo $post['uid']; ?>.jpg" alt="avatar">
    <a href="<?php echo $post['link']; ?>">
      <div class="posts-title"><?php echo $post['title']; ?></div>
    </a>
    <div class="posts-content"><?php echo $post['content']; ?></div>
    <div class="posts-published"><?php echo 'Published ' . $date; ?></div>
    <div class="comment-button">
      <!-- Sending the post id-->
      <a href="../views/viewPost.php?post=<?php echo $post['id']; ?>">Comments</a>
    </div>
  </div>

  <!-- Adding the post id to parent div-->
  <div class="postid<?php echo $post['id']; ?> edit-post">
    <!-- Adding the post id so when closed, right post is shown-->
    <img class="postid<?php echo $post['id']; ?> edit-post-cross" src="../assets/img/cross.png" alt="cross">
    <form action="../lib/updatePosts.php" method="post">
      <input type="hidden" name="postId" value="<?php echo $post['id']; ?>">
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
