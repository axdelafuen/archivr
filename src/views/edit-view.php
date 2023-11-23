<head>
    <title>View edition</title>
    <link rel="stylesheet" href="views/styles/edit-view.css">
    <link rel="icon" type="image/*" href="views/assets/images/map.png">

    <script src="views/scripts/editView.js"></script>
    <script src=".template/script.js"></script>
    <script src="https://aframe.io/releases/1.4.0/aframe.min.js"></script>
    <script src="https://unpkg.com/aframe-look-at-component@0.8.0/dist/aframe-look-at-component.min.js"></script>
</head>

<div class="hud">
    <h3>Edit your view : <?php echo $_SESSION['selected_view']->getName(); ?></h3>

    <h4>Add in a timeline : </h4>

    <form method="post"></form>
        <select name="changeTimeline" require onchange="this.form.submit()">
            <option>--Add timeline--</option>
            <?php
            foreach ($_SESSION['panorama']->getTimelines() as $timeline){
                echo $timeline;
            }
            ?>
        </select>
        <?php
        if(isset($_SESSION['selected_element'])){
            echo '<input class="elementPositionX" type="hidden" name="elementPositionX" value="'.$_SESSION['selected_element']->getPosition()->getX() .'">';
            echo '<input class="elementPositionY" type="hidden" name="elementPositionY" value="'.$_SESSION['selected_element']->getPosition()->getY() .'">';
            echo '<input class="elementPositionZ" type="hidden" name="elementPositionZ" value="'.$_SESSION['selected_element']->getPosition()->getZ() .'">';
            if(get_class($_SESSION['selected_element']) == "Waypoint") {
                echo '<input class="elementScale" type="hidden" name="elementScale" value="'.$_SESSION['selected_element']->getScaleInt() .'">';
            }
        }
        ?>
        <input type="hidden" name="action" value="changeTimeline">
    </form>

    <h4>Create a timeline : </h4>

    <form  method="post">
        <input type="text" placeholder="Your timeline's name" name="timelineName" required/>
        <input type="submit" value="Create !">
        <input type="hidden" name="action" value="createTimeline">

        <?php
        if(isset($_SESSION['selected_element'])){
            echo '<input class="elementPositionX" type="hidden" name="elementPositionX" value="'.$_SESSION['selected_element']->getPosition()->getX() .'">';
            echo '<input class="elementPositionY" type="hidden" name="elementPositionY" value="'.$_SESSION['selected_element']->getPosition()->getY() .'">';
            echo '<input class="elementPositionZ" type="hidden" name="elementPositionZ" value="'.$_SESSION['selected_element']->getPosition()->getZ() .'">';
            if(get_class($_SESSION['selected_element']) == "Waypoint") {
                echo '<input class="elementScale" type="hidden" name="elementScale" value="'.$_SESSION['selected_element']->getScaleInt() .'">';
            }
        }
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
            if(get_class($_SESSION['selected_element']) == "Waypoint") {
                echo '<input class="elementScale" type="hidden" name="elementScale" value="'.$_SESSION['selected_element']->getScaleInt() .'">';
            }
        }
        ?>
        <input type="hidden" name="action" value="goBackToDashboard">
    </form>
</div>

<div class="hud elements p-2">
    <h3>Edit your view's elements</h3>
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
            echo '<input class="elementPositionZ" type="hidden" name="elementPositionZ" value="'.$_SESSION['selected_element']->getPosition()->getZ() .'">';
            if(get_class($_SESSION['selected_element']) == "Waypoint") {
                echo '<input class="elementScale" type="hidden" name="elementScale" value="'.$_SESSION['selected_element']->getScaleInt() .'">';
            }}
        ?>
        <input type="hidden" name="action" value="selectedElementChanged">
    </form>

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

            <?php
            $element = $_SESSION['selected_element'];
            if(get_class($element) == "Waypoint"){
                echo '
                        <div>
                        <input type="range" min="0" max="2" value="' . $element->getScaleInt() . '" step="0.005" class="slider" name="scale" id="scale" oninput="sliderChangedScale(this, \'' . $element->getId() . '\'), changeScale()">
                        Scale: <span>' . $element->getScaleInt() . '</span>
                        </div>
                    ';
            }
            ?>
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
            echo '<input class="elementPositionZ" type="hidden" name="elementPositionZ" value="'.$_SESSION['selected_element']->getPosition()->getZ() .'">';
            if(get_class($_SESSION['selected_element']) == "Waypoint") {
                echo '<input class="elementScale" type="hidden" name="elementScale" value="'.$_SESSION['selected_element']->getScaleInt() .'">';
            }
        }
        ?>
    </form>

    <h4>Add a waypoint to :</h4>

    <form  method="post">
        <select name="destinationView" required onchange="this.form.submit()">
            <option>--Create waypoint--</option>
            <?php
            foreach ($_SESSION['panorama']->getViews() as $view){
                if($view != $_SESSION['selected_view']){
                    echo "<option value='".$view->getPath()."'>".$view->getName()."</option>";
                }
            }
            ?>
        </select>

        <input type="hidden" name="action" value="addWaypoint">

        <?php
        if(isset($_SESSION['selected_element'])){
            echo '<input class="elementPositionX" type="hidden" name="elementPositionX" value="'.$_SESSION['selected_element']->getPosition()->getX() .'">';
            echo '<input class="elementPositionY" type="hidden" name="elementPositionY" value="'.$_SESSION['selected_element']->getPosition()->getY() .'">';
            echo '<input class="elementPositionZ" type="hidden" name="elementPositionZ" value="'.$_SESSION['selected_element']->getPosition()->getZ() .'">';
            if(get_class($_SESSION['selected_element']) == "Waypoint") {
                echo '<input class="elementScale" type="hidden" name="elementScale" value="'.$_SESSION['selected_element']->getScaleInt() .'">';
            }}
        ?>
    </form>
</div>

<a-scene id="preview" embedded>

    <?php echo '<a-sky src=".datas/'. $_SESSION['panorama']->getId().'/'.$_SESSION['selected_view']->getPath().'" ></a-sky>'?>

     <!-- Caméra Rig -->
     <a-entity id="player" position="0 0 0">
        <!-- Caméra -->
        <a-entity position="0 -1.6 0" id="camera" cursor="rayOrigin: mouse">
          <a-camera wasd-controls-enabled="false" look-controls>
            <a-cursor id="cursor" color="white" position="0 0 -0.2" scale="0.25 0.25 0.25"
              animation__click="property: scale; startEvents: click; from: 0.1 0.1 0.1; to: 0.25 0.25 0.25; dur: 150">
            </a-cursor>
          </a-camera>
        </a-entity>
      </a-entity>

    <?php
    $elementId = 1;
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
            <a-entity position="<?php echo $element->getPosition()->getPosition() ?>" look-at="[camera]" id="<?php echo $element->getId() ?>" scale="<?php echo $element->getScale() ?>">
                <a-entity gltf-model=".template/direction_arrow/scene.gltf" id="model"
                animation__2="property: position; from: 0 0 0; to: 0 -1 0; dur: 1000; easing: linear; dir: alternate; loop: true" animationcustom
                look-at="#pointer<?php echo $elementId ?>">
                </a-entity>
                <a-entity id="pointer<?php echo $elementId ?>"  animation__2="property: position; from: 3 0 1; to: 3 -1.0 1; dur: 1000; easing: linear; dir: alternate;loop: true">
                </a-entity>
            </a-entity>
            <?php
        }
    }
    ?>
</a-scene>