<?php
session_start();
//The path to the image folder
$uploads = '../assets/img/avatars/';

//if the image folder don´t exist, one is created
if(!file_exists($uploads)) {
  mkdir($uploads);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $imageData = $_FILES['profileImg'];
  $tmp = $imageData["tmp_name"];

  //check if image file is fake or not. If fake throw an error
  $check = getimagesize($tmp);
  if ($check == false) {
    $_SESSION['error'] = 'File is not a image.';
    header('Location: ../views/settings.php');
    die();
  }
  // Check file size. If too big throw an error
  if ($imageData['size'] > 500000) {
    $_SESSION['error'] = 'Your file is to big, please choose a smaller one.';
    header('Location: ../views/settings.php');
    die();
  }
  //checks file format (jpg), if correct, upload avatar. If not throw an error
  if (exif_imagetype($tmp) === 2) {
    $ext = strrchr($imageData['name'], '.');
    $uid = $_SESSION['loginUser']['uid'];
    $newName = 'avatar' . $uid . $ext;
    move_uploaded_file($tmp, "../assets/img/avatars/$newName");
    $_SESSION['message'] = 'You have succecfully uploaded your profile picture';
    header('Location: ../views/settings.php');
    die();
  } else {
    $_SESSION['error'] = 'You have to choose a valid .jpg file.';
    header('Location: ../views/settings.php');
    die();
  }
}
?>
