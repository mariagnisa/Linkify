<?php

require_once __DIR__.'/../lib/functions.php';
require_once __DIR__.'/../views/head.php';

if (!isset($_GET['post'])) {
  header('Location:../views/home.php');
  die();
}

$postId = $_GET['post'];
$post = executeGetQuery($db, "SELECT * FROM posts WHERE id = '$postId'", true);

 $date = $post['published'];
 $date= date("l jS \of F Y");?>
   <div class="profile-posts">
     <img src="../assets/img/avatars/avatar<?php echo $post['uid'] ?>.jpg" alt="avatar">
     <a href="<?php echo $post['link']; ?>">
     <div class="post-title"><?php echo $post['title']; ?></div>
     </a>
     <div class="post-content"><?php echo $post['content']; ?></div>
     <div class="post-published"><?php echo 'Published ' . $date; ?></div>
   </div>

   <div class="comment-form">
     <form action="../lib/comments.php" method="post">
        <input type="text" name="comment" placeholder="Write comment"><br>
        <button type="button" name="comment-form-button">Comment</button>
     </form>
   </div>
<?php  require_once __DIR__.'/../views/footer.php';  ?>
