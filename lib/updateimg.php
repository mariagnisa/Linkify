<?php
session_start();
$uploads = '../assets/img/avatars/';

//if the image folder dont exist, then create one
if(!file_exists($uploads)) {
      mkdir($uploads);
    }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $imageData = $_FILES['profileImg'];

  $tmp = $imageData["tmp_name"];

   if (exif_imagetype($tmp) === 2) {
     $ext = strrchr($imageData['name'], ".");
     $uid = $_SESSION['loginUser']['uid'];
     $newName = 'avatar' . $uid . $ext;
     move_uploaded_file($tmp, "../assets/img/avatars/$newName");
     $_SESSION['message'] = 'You have succecfully uploaded '.$newName;
     header('Location: ../views/settings.php');
     die();
   } else {
     $_SESSION['error'] = 'You have to choose a valid .jpg file.';
     header('Location: ../views/settings.php');
     die();
   }
}
 ?>
