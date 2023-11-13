<html>
<head>
    <title>Panorama Generator</title>
</head>

<body>
    <h3>Load an image</h3>

    <form method="post" enctype="multipart/form-data">

        Select your 360 images :
        <input type="file" name="views[]" required multiple accept="image/*">
    <br> <!-- A RETIRER QUAND LE CSS SERA FAIT -->
    <br> <!-- A RETIRER QUAND LE CSS SERA FAIT -->
        Select your map :
        <input type="file" name="map" required accept="image/*">
    <br> <!-- A RETIRER QUAND LE CSS SERA FAIT -->
    <br> <!-- A RETIRER QUAND LE CSS SERA FAIT -->
        <input type="submit" value="Upload">
        <input type="hidden" name="action" value="viewsUploaded">
    </form>

</body>
</html>