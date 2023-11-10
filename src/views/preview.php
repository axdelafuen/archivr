<html>
<head>
    <title>Panorama Generator</title>
    <script src="https://aframe.io/releases/1.4.0/aframe.min.js"></script>
</head>

<body>
<h3>Preview</h3>

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