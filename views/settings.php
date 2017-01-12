<?php

require_once __DIR__.'/../lib/functions.php';
require_once __DIR__.'/../views/head.php';


$uid = $_SESSION['loginUser']['uid'];

$user = executeGetQuery($db, "SELECT * FROM users WHERE id = '$uid'", true);

 ?>

<h1>Account settings</h1>
<hr>

<div class="change-settings">
  <h3>Change email</h3>
  <form action="../lib/settings.php" method="POST">
    <input type="text" name="changeEmail" value="<?php echo $user['email']; ?>"> <br>


  <h3>Change password</h3>
    <input type="password" name="newPassword" placeholder="New password"><br>
    <input type="password" name="repeatPassword" placeholder="Repeat password"><br>


  <h3>Change bio</h3>
    <textarea name="changeText" class="change-text"><?php echo $user['bio']; ?></textarea>

  <hr>
  <h4>Save settings</h4>
    <input type="password" name="confirmPassword" placeholder="Password"><br>
    <button type="submit" name="saveButton" value="1">Save</button>
  </form>
</div>

<div class="profile-img">
  <form action="../lib/updateimg.php" method="post" enctype="multipart/form-data">
    <h3>Upload profile image</h3>
      <input type="file" name="profileImg" accept=".jpg">
      <br/>
      <button type="submit" name="avatarButton">Upload</button>
  </form>
  <?php
   if (hasImage("../assets/img/avatars")): ?>
          <img src="../assets/img/avatars/avatar<?php echo $user['id'] ?>.jpg" alt="avatar">
          <?php else: ?>
            <div class="empty-avatar">
                <p>Your new avatar is waiting</p>
            </div>
  <?php endif; ?>

</div>

<?php  require_once __DIR__.'/footer.php';  ?>
