<html>
<head>
    <title>Panorama Generator</title>
    <script src="https://aframe.io/releases/1.4.0/aframe.min.js"></script>
</head>

<body>
<h1>Preview</h1>

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

<form>
    <input type="submit" value="Go back">
    <input type="hidden" name="action" value="goBackToDashboard">
</form>

<div>
    <a-scene embedded>
        <?php echo "<a-sky src=./.datas/".$_SESSION['selected_view']."></a-sky>"?>
    </a-scene>
</div>

</body>
</html>