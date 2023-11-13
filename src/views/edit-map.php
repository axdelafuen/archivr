<html>
<head>
    <title>Panorama Generator</title>
    <script src="https://aframe.io/releases/1.4.0/aframe.min.js"></script>
</head>

<body>
<h3>Edit your map</h3>

<form>
    <input type="submit" value="Go back">
    <input type="hidden" name="action" value="goBackToDashboard">
</form>

<div>
        <?php echo '<img src="./.datas/'. $_SESSION["panorama"]->getMap()->getPath() .'" alt="map">'?>
</div>

</body>
</html>