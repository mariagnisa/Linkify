<?php
session_start();
//The path to the image folder
$uploads = '../assets/img/avatars/';

//if the image folder don´t exist, one is created
if(!file_exists($uploads)) {
  mkdir($uploads);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (empty($_FILES['profileImg']['name'])) {
    $_SESSION['error'] = 'Please, provide a image.';
    header('Location: /account');
    die();
  }
  $imageData = $_FILES['profileImg'];
  $tmp = $imageData["tmp_name"];

  //check if image file is fake or not. If fake throw an error
  $check = getimagesize($tmp);
  if ($check == false) {
    $_SESSION['error'] = 'File is not a image.';
    header('Location: /account');
    die();
  }
  // Check file size. If too big throw an error
  if ($imageData['size'] > 500000) {
    $_SESSION['error'] = 'Your file is to big, please choose a smaller one.';
    header('Location: /account');
    die();
  }
  //checks file format (jpg/jpeg), if correct, upload avatar. If not throw an error
  if (exif_imagetype($tmp) === 2) {
    $uid = $_SESSION['loginUser']['uid'];
    $newName = 'avatar' . $uid . '.jpg';
    move_uploaded_file($tmp, "../assets/img/avatars/$newName");
    $_SESSION['message'] = 'You have succecfully uploaded your profile picture';
    header('Location: /account');
    die();
  } else {
    $_SESSION['error'] = 'You have to choose a valid .jpg file.';
    header('Location: /account');
    die();
  }
}
?>
