<head>
    <title>View edition</title>
    <link rel="stylesheet" href="views/styles/edit-view.css">
</head>

<h3>Edit your view : <?php echo $_SESSION['selected_view']->getName(); ?></h3>

<!-- TEMP -->
<br> DEBUG <br> --- <br> <br>

<?php

foreach ($_SESSION['selected_view']->getElements() as $element)
{
    if(get_class($element)=="Sign"){
        echo "sign : ";
        echo $element->getContent();
        echo " / pos : ".$element->getPosition()->getPosition();
    }
    elseif(get_class($element)=="Waypoint"){
        echo "waypoint : ";
        echo $element->getViewName();
        echo " / pos : ".$element->getPosition()->getPosition();
    }
    ?>
    <div class="positionSliders">
        <div>
            <input type="range" min="-10" max="10" value="<?php echo $element->getPosition()->getX() ?>" step="0.1" class="slider" id="positionX" oninput="sliderChanged(this)">
            <p>X: <span id="valueX"><?php echo $element->getPosition()->getX() ?></span></p>
        </div>

        <div>
            <input type="range" min="-10" max="10" value="0" step="0.1" class="slider" id="positionY">
            <p>Y: <span id="valueY">0</span></p>
        </div>
        <div>
            <input type="range" min="-10" max="10" value="-10" step="0.1" class="slider" id="positionZ">
            <p>Y: <span id="valueZ">-10</span></p>
        </div>


    </div>
<?php

    echo '<br><br>';
}

?>

<br> --- <br> <br>

<h4>Add a sign :</h4>

<form>
    <input type="text" placeholder="Your sign content" name="signContent" required/>
    <input type="submit" value="Create !">
    <input type="hidden" name="action" value="addSign">
</form>

<h4>Add a waypoint :</h4>

Chose destination :

<form>
    <select name="destinationView" required>
        <?php
        foreach ($_SESSION['panorama']->getViews() as $view){
            if($view != $_SESSION['selected_view']){
                echo "<option value='".$view->getPath()."'>".$view->getName()."</option>";
            }
        }
        ?>
    </select>

    <input type="submit" value="Create !">
    <input type="hidden" name="action" value="addWaypoint">
</form>

<h4>Save editions :</h4>

<form>
    <input type="submit" value="Save">
    <input type="hidden" name="action" value="saveEdit">
</form>

<h4>Delete this view :</h4>

<form>
    <input type="submit" value="Delete">
    <input type="hidden" name="action" value="deleteView">
</form>

<h4>Cancel edition :</h4>

<form>
    <input type="submit" value="Go back">
    <input type="hidden" name="action" value="goBackToDashboard">
</form>

<br>

<h3>Preview : </h3>

<a-scene id="preview" embedded>
    <a-assets>
        <img id="arrow" src="views/assets/images/arrow.png">
    </a-assets>

    <?php echo "<a-sky src=./.datas/". $_SESSION['panorama']->getId(). "/" .$_SESSION['selected_view']->getPath()."></a-sky>";?>

    <a-entity id="cam" camera position="0 0 0" wasd-controls look-controls>

    </a-entity>
</a-scene>

<script src="views/scripts/editView.js"></script>