<?php

require_once __DIR__.'/lib/functions.php';
require_once __DIR__.'/views/head.php';

$loggedInUser = checkUserLogin($db);

$title = 'Linkify';

//checks if a user has a active session
if ($loggedInUser) {
    //if active session, the user will come to home page
  require_once __DIR__.'/views/home.php';
} else {
    //otherwise user will come to authenication page for login/register
  require_once __DIR__.'/views/authenication.php';
}

?>

<?php require_once __DIR__.'/views/footer.php'; ?>
