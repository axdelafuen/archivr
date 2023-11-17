<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="views/styles/home.css">
    <link rel="icon" type="image/*" href="views/assets/images/map.png">
    <script src="https://aframe.io/releases/1.4.0/aframe.min.js"></script>
    <script src="https://unpkg.com/aframe-look-at-component@0.8.0/dist/aframe-look-at-component.min.js"></script>
</head>
<body>

<?php

//load config
require_once(__DIR__.'/config/config.php');

//load autoloader
require_once(__DIR__.'/config/Autoload.php');
Autoload::load();

// load navbar
require_once(__DIR__.'/views/templates/navbar.html');

$cont = new Controller();
?>
</body>
</html>