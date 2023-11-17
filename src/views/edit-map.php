<head>
    <title>Map edition</title>
    <link rel="stylesheet" href="views/styles/edit-view.css">
</head>

<div class="hud">

    <h3>Edit your map : <?php echo $_SESSION['selected_view']->getName(); ?></h3>

    <!-- TEMP -->
    --- <br>

    <?php
    foreach ($_SESSION['selected_view']->getElements() as $element)
    {
        if(get_class($element)=="Waypoint"){
            echo "Waypoint : ";
            echo $element->getViewName();
        }
        ?>
        <br> --- <br>
    <?php }?>

    <h4>Add a waypoint :</h4>

    Chose destination :

    <form  method="post">
        <select name="destinationView" required>
            <?php
            foreach ($_SESSION['panorama']->getViews() as $view){
                echo "<option value='".$view->getPath()."'>".$view->getName()."</option>";
            }
            ?>
        </select>

        <input type="submit" value="Create !">
        <input type="hidden" name="action" value="addMapWaypoint">
    </form>

    <h4>Save editions :</h4>

    <form  method="post">
        <input type="submit" value="Save">
        <input type="hidden" name="action" value="saveEdit">
    </form>

    <h4>Delete map :</h4>

    <form  method="post">
        <input type="submit" value="Delete">
        <input type="hidden" name="action" value="deleteMap">
    </form>

    <h4>Cancel edition :</h4>

    <form  method="post">
        <input type="submit" value="Go back">
        <input type="hidden" name="action" value="goBackToDashboard">
    </form>

</div>


<div>
        <?php echo '<img src="./.datas/'. $_SESSION["panorama"]->getId() ."/". $_SESSION["selected_view"]->getPath() .'" alt="map" class="map-preview">'?>
</div>