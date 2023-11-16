<title>Panorama Generator</title>

<h3>Load an image</h3>

<form method="post" enctype="multipart/form-data">
    Your project's name :
    <input type="text" placeholder="My amazing panorama" name="projectName" required/>
<br> <!-- A RETIRER QUAND LE CSS SERA FAIT -->
<br> <!-- A RETIRER QUAND LE CSS SERA FAIT -->
    Select your 360 images :
    <input type="file" name="views[]" required multiple accept="image/*">
<br> <!-- A RETIRER QUAND LE CSS SERA FAIT -->
<br> <!-- A RETIRER QUAND LE CSS SERA FAIT -->
    Select your map :
    <input type="file" name="map" accept="image/*">
<br> <!-- A RETIRER QUAND LE CSS SERA FAIT -->
<br> <!-- A RETIRER QUAND LE CSS SERA FAIT -->
    <input type="submit" value="Upload">
    <input type="hidden" name="action" value="viewsUploaded">
</form>