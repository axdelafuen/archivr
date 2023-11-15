<head>
    <title>View edition</title>
    <link rel="stylesheet" href="views/styles/edit-view.css">
</head>

<h3>Edit your view : <?php echo $_SESSION['selected_view']->getName(); ?></h3>

<form>
    <input type="submit" value="Go back">
    <input type="hidden" name="action" value="goBackToDashboard">
</form>

<form>
    <input type="submit" value="Delete">
    <input type="hidden" name="action" value="deleteView">
</form>

<div class="preview">
    <a-scene embedded>
        <a-assets>
            <img id="arrow" src="views/assets/images/arrow.png">
        </a-assets>

        <?php echo "<a-sky src=./.datas/". $_SESSION['panorama']->getId(). "/" .$_SESSION['selected_view']->getPath()."></a-sky>";?>

        <a-entity camera position="0 0 0" wasd-controls look-controls>
            <a-entity id="hud" position="0 -0.35 -0.5" scale="0.3 0.3 0.3" opacity="0.8" align="center">
                <a-text value="Add a navigation point" align="center" width="3"></a-text>
            </a-entity>
        </a-entity>
    </a-scene>
</div>