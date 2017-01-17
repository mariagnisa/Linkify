<?php

require_once __DIR__.'/../lib/functions.php';
require_once __DIR__.'/../views/head.php';

$uid = $_SESSION['loginUser']['uid'];

//Fetch all data from logged in user
$user = executeGetQuery($db, "SELECT * FROM users WHERE id = '$uid'", true);
?>

<div class="settings-intro">
  <h2>Account settings</h2>
  <hr>
</div>

<div class="settings-container">
  <div class="change-settings">
    <h3>Change email</h3>
    <form action="/../lib/settings.php" method="post">
      <input type="text" name="changeEmail" value="<?php echo $user['email']; ?>"> <br>

      <h3>Change password</h3>
      <input type="password" name="newPassword" placeholder="New password"><br>
      <input type="password" name="repeatPassword" placeholder="Repeat password"><br>

      <h3>Change bio</h3>
      <textarea name="changeText"><?php echo $user['bio']; ?></textarea>
      <br>
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
    //Checks if the logged in user have uploaded any profile avatar, if not show empty avatar
    if (hasImage("../assets/img/avatars")): ?>
    <img src="../assets/img/avatars/avatar<?php echo $user['id'] ?>.jpg" alt="avatar">
  <?php else: ?>
    <img src="../assets/img/noavatar.jpg" alt="avatar">
  <?php endif; ?>
</div>
</div>
<?php  require_once __DIR__.'/footer.php';  ?>
