<?php

 ?>

<h1>Account settings</h1>
<hr>

<div class="change-settings">
  <h3>Change email</h3>
  <form action="../lib/settings.php" method="post">
    <input type="text" name="change-email" placeholder="New email"> <br>
    <button type="submit" name="email-button">Submit</button>
  </form>

  <h3>Change password</h3>
  <form action="../lib/settings.php" method="post">
    <input type="password" name="new-password" placeholder="New password"><br>
    <input type="password" name="repeat-password" placeholder="Repeat password"><br>
    <button type="submit" name="password-button">Submit</button>
  </form>

  <h3>Change details</h3>
  <form action="../lib/settings.php" method="post">
    <textarea autofocus class="change-text" name="change-details"></textarea>
  </form>

  <h3>Upload profile image</h3>


  <hr>
  <h4>Save settings</h4>
  <form action="../lib/settings.php" method="post">
    <input type="password" name="confirm-password-1" placeholder="Password"><br>
    <input type="password" name="confirm-password-2" placeholder="Repeat password"><br>
    <button type="submit" name="save-button">Submit</button>
  </form>
</div>
