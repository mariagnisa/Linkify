<?php
require_once __DIR__.'/../lib/functions.php';
require_once __DIR__.'/../views/head.php';
 ?>

<h3>A place to rule them all</h3>

<form action="/../lib/posts.php" method="post">
  <input type="text" name="title" placeholder="Title"><br>
  <textarea name="description" placeholder="Description"></textarea><br>
  <input type="url" name="link" placeholder="Your link"><br>
  <button type="submit" name="postButton">Send</button>
</form>



<?php  require_once __DIR__.'/../views/footer.php';  ?>
