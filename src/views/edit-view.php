<head>
    <title>View edition</title>
    <link rel="stylesheet" href="views/styles/edit-view.css">
    <script src="views/scripts/editView.js"></script>
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

<!-- TEMP -->
<br> --- <br> <br>

<?php

foreach ($_SESSION['selected_view']->getElements() as $element)
{
    echo "<br>";
    var_dump(get_class($element));
    echo "<br>";
    if(get_class($element)=="Sign"){ ////////////////// N'AFFICHE PAS LE CONTENT !!
        echo "oui : ";
        echo $element->getContent();
    }
    else{
        echo $element->getId();
    }

}

?>

<br> --- <br> <br>

<form>
    <input type="submit" value="Add a sign">
    <input type="hidden" name="action" value="addSign">
</form>

<form>
    <input type="submit" value="Add a waypoint">
    <input type="hidden" name="action" value="addWaypoint">
</form>

<!-- TEMP -->

<a-scene id="preview" embedded>
    <a-assets>
        <img id="arrow" src="views/assets/images/arrow.png">
    </a-assets>

    <?php echo "<a-sky src=./.datas/". $_SESSION['panorama']->getId(). "/" .$_SESSION['selected_view']->getPath()."></a-sky>";?>

    <a-entity id="cam" camera position="0 0 0" wasd-controls look-controls>
        <!-- TEST !!!!
        <a-entity id="hud" position="0 -0.35 -0.5" scale="0.3 0.3 0.3" opacity="0.8" align="center">
            <a-text value="Add a waypoint" align="center" width="3"></a-text>
        </a-entity>
        TEST !!!!-->
    </a-entity>
</a-scene>