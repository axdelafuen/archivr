<head>
    <title>View edition</title>
    <link rel="stylesheet" href="views/styles/edit-view.css">
</head>

<div class="hud">
    <h3>Edit your view : <?php echo $_SESSION['selected_view']->getName(); ?></h3>
    <form  method="post">
        <label>
            <select name="selectedElementChanged" require onchange="this.form.submit()">
                <option>--Change element--</option>
                <?php
                foreach ($_SESSION['selected_view']->getElements() as $element){
                    if($element != $_SESSION['selected_element']){
                        if(get_class($element)=="Sign"){
                            echo "<option value='".$element->getId()."'>Sign : ".$element->getContent()."</option>";
                        }
                        elseif(get_class($element)=="Waypoint"){
                            echo "<option value='".$element->getId()."'>Waypoint : ".$element->getViewName()."</option>";
                        }
                    }
                }
                ?>
            </select>
        </label>
        <?php
        if(isset($_SESSION['selected_element'])){
        echo '<input class="elementPositionX" type="hidden" name="elementPositionX" value="'.$_SESSION['selected_element']->getPosition()->getX() .'">';
        echo '<input class="elementPositionY" type="hidden" name="elementPositionY" value="'.$_SESSION['selected_element']->getPosition()->getY() .'">';
        echo '<input class="elementPositionZ" type="hidden" name="elementPositionZ" value="'.$_SESSION['selected_element']->getPosition()->getZ() .'">';}
        ?>
        <input type="hidden" name="action" value="selectedElementChanged">
    </form>

    <!-- TEMP -->
    --- <br>

    <?php

    if(isset($_SESSION['selected_element'])){

        $element = $_SESSION['selected_element'];

        if(get_class($element)=="Sign"){
            echo "Sign : ";
            echo $element->getContent();
        }
        elseif(get_class($element)=="Waypoint"){
            echo "Waypoint : ";
            echo $element->getViewName();
        }
        ?>
        <div id="positionSliders">
            <div>
                <input type="range" min="-2" max="2" value="<?php echo $element->getPosition()->getX() ?>" step="0.05" class="slider" name="positionX" id="positionX" oninput="sliderChanged(this, '<?php echo $element->getId(); ?>'), sliderChangedX()">
                X: <span><?php echo $element->getPosition()->getX() ?></span>
            </div>
            <div>
                <input type="range" min="-2" max="2" value="<?php echo $element->getPosition()->getY() ?>" step="0.05" class="slider" name="positionY" id="positionY" oninput="sliderChanged(this, '<?php echo $element->getId(); ?>'), sliderChangedY()">
                Y: <span><?php echo $element->getPosition()->getY() ?></span>
            </div>
            <div>
                <input type="range" min="-2" max="2" value="<?php echo $element->getPosition()->getZ() ?>" step="0.05" class="slider" name="positionZ" id="positionZ" oninput="sliderChanged(this, '<?php echo $element->getId(); ?>'), sliderChangedZ()">
                Z: <span><?php echo $element->getPosition()->getZ() ?></span>
            </div>
        </div>

        <div class="element-edit">
            <form  method="post">
                <input type="submit" value="Delete">
                <?php echo '<input type="hidden" name="selected_element" value="'.$element->getId().'">';?>
                <input type="hidden" name="action" value="deleteElement">
            </form>
        </div>
    <?php
    }
?>

        <h4>Add a sign :</h4>

        <form  method="post">
            <input type="text" placeholder="Your sign content" name="signContent" required/>
            <input type="submit" value="Create !">
            <input type="hidden" name="action" value="addSign">

            <?php
            if(isset($_SESSION['selected_element'])){
                echo '<input class="elementPositionX" type="hidden" name="elementPositionX" value="'.$_SESSION['selected_element']->getPosition()->getX() .'">';
                echo '<input class="elementPositionY" type="hidden" name="elementPositionY" value="'.$_SESSION['selected_element']->getPosition()->getY() .'">';
                echo '<input class="elementPositionZ" type="hidden" name="elementPositionZ" value="'.$_SESSION['selected_element']->getPosition()->getZ() .'">';}
            ?>
        </form>

        <h4>Add a waypoint :</h4>

        Chose destination :

        <form  method="post">
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

            <?php
            if(isset($_SESSION['selected_element'])){
                echo '<input class="elementPositionX" type="hidden" name="elementPositionX" value="'.$_SESSION['selected_element']->getPosition()->getX() .'">';
                echo '<input class="elementPositionY" type="hidden" name="elementPositionY" value="'.$_SESSION['selected_element']->getPosition()->getY() .'">';
                echo '<input class="elementPositionZ" type="hidden" name="elementPositionZ" value="'.$_SESSION['selected_element']->getPosition()->getZ() .'">';}
            ?>
        </form>

    <h4>Delete this view :</h4>

    <form  method="post">
        <input type="submit" value="Delete">
        <input type="hidden" name="action" value="deleteView">
    </form>

    <h4>Exit edition :</h4>

    <form  method="post">
        <input type="submit" value="Save and go back">
        <?php
        if(isset($_SESSION['selected_element'])) {
            echo '<input type="hidden" name="selected_element" value="' . $_SESSION['selected_element']->getId() . '">';
            echo '<input class="elementPositionX" type="hidden" name="elementPositionX" value="'.$_SESSION['selected_element']->getPosition()->getX() .'">';
            echo '<input class="elementPositionY" type="hidden" name="elementPositionY" value="'.$_SESSION['selected_element']->getPosition()->getY() .'">';
            echo '<input class="elementPositionZ" type="hidden" name="elementPositionZ" value="'.$_SESSION['selected_element']->getPosition()->getZ() .'">';
        }
        ?>
        <input type="hidden" name="action" value="goBackToDashboard">
    </form>
</div>

<a-scene id="preview" embedded>
    <a-assets>
        <img id="arrow" src="views/assets/images/arrow.png">
    </a-assets>

    <?php echo '<a-sky src=".datas/'. $_SESSION['panorama']->getId().'/'.$_SESSION['selected_view']->getPath().'" ></a-sky>'?>

    <a-entity>
        <a-camera id="camera" position="0 0 0" rotation="0 -180 0" look-controls="true" wasd-controls-enabled="false"></a-camera>
    </a-entity>

    <?php
    foreach ($_SESSION['selected_view']->getElements() as $element) {
        if (get_class($element) == "Sign") {
            ?>
             <a-entity id="<?php echo $element->getId() ?>" position="<?php echo $element->getPosition()->getPosition() ?>"
              look-at="[camera]"
              text="value: <?php echo $element->getContent() ?>; align:center">
            </a-entity>
            <?php
        } elseif (get_class($element) == "Waypoint") {
            ?>
             <a-entity id="<?php echo $element->getId() ?>" position="<?php echo $element->getPosition()->getPosition() ?>"
                look-at="#camera" text="value: <?php echo $element->getViewName()?>">
            </a-entity>
            <?php
        }
    }
    ?>
</a-scene>

<script src="views/scripts/editView.js"></script>