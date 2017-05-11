<?php

$title = (isset($title)) ? $title:'Linkify';
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta http-equiv="cache-control" content="max-age=0" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
  <meta http-equiv="pragma" content="no-cache" />

  <title> <?php echo $title; ?></title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/10up-sanitize.css/4.1.0/sanitize.min.css">
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/authenication.css">
  <link rel="stylesheet" href="/assets/css/home.css">
  <link rel="stylesheet" href="/assets/css/settings.css">
  <link rel="stylesheet" href="/assets/css/profile.css">
  <link rel="stylesheet" href="/assets/css/viewPost.css">
  <link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
  <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.ico">
  <script src="/assets/js/main.js"> </script>
</head>
<body>
  <?php require_once __DIR__.'/header.php';

  if (isset($_SESSION['error'])) {
      ?>
    <div class="error">
      <?php  print_r($_SESSION['error']); ?>
    </div>
    <?php unset($_SESSION['error']);
  }

  if (isset($_SESSION['message'])) {
      ?>
    <div class="message">
      <?php  print_r($_SESSION['message']); ?>
    </div>
    <?php unset($_SESSION['message']);
  }

  ?>
