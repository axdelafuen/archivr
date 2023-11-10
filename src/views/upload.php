<html>
<head>
    <title>Panorama Generator</title>
</head>

<body>
    <h1>Load an image</h1>

    <ul>
        <li>
            <form>
                <input type="submit" value="Home">
                <input type="hidden" name="action" value=<?php NULL?>>
            </form>
        </li>
        <li>
            <form>
                <input type="submit" value="Load an image">
                <input type="hidden" name="action" value="goToLoadImages">
            </form>
        </li>
        <li>
            <form>
                <input type="submit" value="Tutorial">
                <input type="hidden" name="action" value="goToTutorial">
            </form>
        </li>
        <li>
            <form>
                <input type="submit" value="About">
                <input type="hidden" name="action" value="goToAbout">
            </form>
        </li>
    </ul>

    Sélectionner vos images :

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="views[]" required multiple>
        <input type="submit" value="Upload">
        <input type="hidden" name="action" value="viewsUploaded">
    </form>

</body>
</html>