<?php

require_once __DIR__.'/../lib/functions.php';
require_once __DIR__.'/../views/head.php';

if (!isset($_GET['post'])) {
  header('Location:../views/home.php');
  die();
}

$postId = $_GET['post'];
$post = executeGetQuery($db, "SELECT * FROM posts WHERE id = '$postId'", true);
$comments = executeGetQuery($db, "SELECT * FROM comments");

 $date = $post['published'];
 $date= date("l jS \of F Y");?>
   <div class="posts">
     <img class="posts-avatar" src="../assets/img/avatars/avatar<?php echo $post['uid'] ?>.jpg" alt="avatar">
     <a href="<?php echo $post['link']; ?>">
     <div class="post-title"><?php echo $post['title']; ?></div>
     </a>
     <div class="post-content"><?php echo $post['content']; ?></div>
     <div class="post-published"><?php echo 'Published ' . $date; ?></div>
   </div>

   <div class="comment-form">
     <form action="../lib/comments.php" method="post">
        <input type="hidden" name="postId" value="<?php echo $post['id']?>">
        <input type="text" name="comment" placeholder="Write comment"><br>
        <button type="submit" name="comment-form-button">Comment</button>
     </form>
   </div>

   <h3>Comments</h3>

   <?php
   foreach ($comments as $comment):
     $date = $comment['published'];
     $date= date("l jS \of F Y");?>
       <div class="post-comments">
         <img src="../assets/img/avatars/avatar<?php echo $comment['uid'] ?>.jpg" alt="avatar">
         <div class="comment"><?php echo $comment['comment']; ?></div>
         <div class="comment-published"><?php echo 'Published ' . $date; ?></div>
       </div>
   <?php
     endforeach;
    ?>
<?php  require_once __DIR__.'/../views/footer.php';  ?>
