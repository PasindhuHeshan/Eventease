<?php
    if (!isset($title)) {
        $title = 'EventEase';
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="<?=ROOT ?>/assets/css/global.css">
</head>

<body>
    <header class="header">
        <div class="logo">
            <img src="<?=ROOT ?>/assets/img/logo.png" alt="">
        </div>
        <div class="header-controls">
            <button type="button" class="btn ctrl">Login</button>
            <button type="button" class="btn ctrl">Register</button>
            <div class="profile"></div>
        </div>
    </header>
    <div class="content-wrapper">

    