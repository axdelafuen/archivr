<head>
    <title>Download</title>
    <link rel="icon" type="image/*" href="views/assets/images/map.png">
</head>
<body>
<h3>Download your Panorama</h3>

<?php
$zipName = str_replace(" ","_", $_SESSION['panorama']->getName());
?>

<a href=<?php echo "./.datas/zip/".$zipName.".zip"?> download>Click here to download</a>
</body>