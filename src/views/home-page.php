<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" type="image/*" href="views/assets/images/map.png">
    <link rel="stylesheet" href="./views/styles/home.css">
    <title>Panorama Generator</title>
</head>
<body class="bg-light">
<?php
// load navbar
require_once(__DIR__.'/templates/navbar.html');
?>
    <div class="container-fluid w-100 h-100 mt-5">
        <div class="mb-3">
            <h1 class="text-center font-weight-bold">Welcome to ArchiVR</h1>
            <p class="text-center mb-5">Create your own virtual 3D visit</p>
        </div>
        <div class="row justify-content-around h-100">
            <div class="col-sm-3 align-self-center bg-white shadow p-0 homeRounded">
                <div class="container p-0">
                    <img class="homeImgRadius img-responsive w-100" src="./views/assets/images/puy-de-dome-02.jpg">
                </div>
                <h3 class="ml-4 mt-3 font-weight-bold">Create your own panorama</h3>
                <h5 class="ml-4 mb-4">Add your 360° images to create VR 3D visit</h5>
            </div>
            <div class="col-sm-3 align-self-center bg-white shadow p-0 homeRounded">
                <div class="container p-0">
                    <img class="homeImgRadius img-responsive w-100" src="./views/assets/images/puy-de-dome-02.jpg">
                </div>
                <h3 class="ml-4 mt-3 font-weight-bold">Import a template</h3>
                <h5 class="ml-4 mb-4">See 3D creation from people around the world</h5>
            </div>
            <div class="col-sm-3 align-self-center bg-white shadow p-0 homeRounded">
                <div class="container p-0">
                    <img class="homeImgRadius img-responsive w-100" src="./views/assets/images/puy-de-dome-02.jpg">
                </div>
                <h3 class="ml-4 mt-3 font-weight-bold">See a tutorial</h3>
                <h5 class="ml-4 mb-4">And learn how to use ArchiVR generator</h5>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>