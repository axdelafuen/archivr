<head>
    <title>View edition</title>
    <link rel="stylesheet" href="views/styles/edit-view.css">
    <link rel="icon" type="image/*" href="views/assets/images/map.png">

    <script src="views/scripts/editView.js"></script>
    <script src="https://aframe.io/releases/1.4.0/aframe.min.js"></script>
    <script src="https://unpkg.com/aframe-look-at-component@0.8.0/dist/aframe-look-at-component.min.js"></script>
    <script src=".template/scripts/script.js"></script>
</head>

<div class="hud-left">
    <h3>Edit your view : <?php echo $_SESSION['selected_view']->getName(); ?></h3>

    <h4>Change timeline : </h4>

    <form method="post">
        <select name="changeTimeline" require onchange="this.form.submit()">
            <option>--Add timeline--</option>
            <?php
            foreach ($_SESSION['panorama']->getTimelines() as $timeline){
                if(!$timeline->isView($_SESSION['selected_view'])) {
                    echo "<option value='" . $timeline->getId() . "'>" . $timeline->getName() . "</option>";
                }
            }
            ?>
        </select>
        <?php
        foreach ($_SESSION['panorama']->getTimelines() as $timeline){
            if($timeline->isView($_SESSION['selected_view'])) {
                echo "Actual timeline : ".$timeline->getName();
            }
        }
        if(isset($_SESSION['selected_element'])){
            echo '<input class="elementPositionX" type="hidden" name="elementPositionX" value="'.$_SESSION['selected_element']->getPosition()->getX() .'">';
            echo '<input class="elementPositionY" type="hidden" name="elementPositionY" value="'.$_SESSION['selected_element']->getPosition()->getY() .'">';
            echo '<input class="elementPositionZ" type="hidden" name="elementPositionZ" value="'.$_SESSION['selected_element']->getPosition()->getZ() .'">';
            if(get_class($_SESSION['selected_element']) == "Waypoint" || get_class($_SESSION['selected_element']) == "AssetImported") {
                echo '<input class="elementScale" type="hidden" name="elementScale" value="'.$_SESSION['selected_element']->getScaleInt() .'">';
            }
            echo '<input class="elementRotationX" type="hidden" name="elementRotationX" value="'.$_SESSION['selected_element']->getRotation()->getX().'">';
            echo '<input class="elementRotationY" type="hidden" name="elementRotationY" value="'.$_SESSION['selected_element']->getRotation()->getY().'">';
            echo '<input class="elementRotationZ" type="hidden" name="elementRotationZ" value="'.$_SESSION['selected_element']->getRotation()->getZ().'">';
        }
        ?>
        <input type="hidden" name="action" value="changeTimeline">
    </form>

    <h4>Change view's date : </h4>

    <form  method="post">
        <input type="number" min="-3000" max="10000" name="changedDate" value="<?php if($_SESSION['selected_view']->isDate()){echo $_SESSION['selected_view']->getDate();} else{echo '';} ?>" required>
        <?php
        if(isset($_SESSION['selected_element'])) {
            echo '<input type="hidden" name="selected_element" value="' . $_SESSION['selected_element']->getId() . '">';
            echo '<input class="elementPositionX" type="hidden" name="elementPositionX" value="'.$_SESSION['selected_element']->getPosition()->getX() .'">';
            echo '<input class="elementPositionY" type="hidden" name="elementPositionY" value="'.$_SESSION['selected_element']->getPosition()->getY() .'">';
            echo '<input class="elementPositionZ" type="hidden" name="elementPositionZ" value="'.$_SESSION['selected_element']->getPosition()->getZ() .'">';
            if(get_class($_SESSION['selected_element']) == "Waypoint" || get_class($_SESSION['selected_element']) == "AssetImported") {
                echo '<input class="elementScale" type="hidden" name="elementScale" value="'.$_SESSION['selected_element']->getScaleInt() .'">';
            }
            echo '<input class="elementRotationX" type="hidden" name="elementRotationX" value="'.$_SESSION['selected_element']->getRotation()->getX().'">';
            echo '<input class="elementRotationY" type="hidden" name="elementRotationY" value="'.$_SESSION['selected_element']->getRotation()->getY().'">';
            echo '<input class="elementRotationZ" type="hidden" name="elementRotationZ" value="'.$_SESSION['selected_element']->getRotation()->getZ().'">';
        }
        ?>
        <input type="submit" value="Update">
        <input type="hidden" name="action" value="changeDate">
    </form>

    <h4>Default camera rotation : </h4>

    <form method="post">
        <input type="submit" value="Set rotation" onclick="setCameraRotation()">
        <?php
            echo '<input class="cameraRotationX" type="hidden" name="camera_rotation_x" value="'.$_SESSION['selected_view']->getCameraRotation()->getX() .'">';
            echo '<input class="cameraRotationY" type="hidden" name="camera_rotation_y" value="'.$_SESSION['selected_view']->getCameraRotation()->getY() .'">';
            echo '<input class="cameraRotationZ" type="hidden" name="camera_rotation_z" value="'.$_SESSION['selected_view']->getCameraRotation()->getZ() .'">';
        ?>
        <input type="hidden" name="action" value="changeCameraRotation">
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
            if(get_class($_SESSION['selected_element']) == "Waypoint" || get_class($_SESSION['selected_element']) == "AssetImported") {
                echo '<input class="elementScale" type="hidden" name="elementScale" value="'.$_SESSION['selected_element']->getScaleInt() .'">';
            }
            echo '<input class="elementRotationX" type="hidden" name="elementRotationX" value="'.$_SESSION['selected_element']->getRotation()->getX().'">';
            echo '<input class="elementRotationY" type="hidden" name="elementRotationY" value="'.$_SESSION['selected_element']->getRotation()->getY().'">';
            echo '<input class="elementRotationZ" type="hidden" name="elementRotationZ" value="'.$_SESSION['selected_element']->getRotation()->getZ().'">';
        }
        ?>
        <input type="hidden" name="action" value="goBackToDashboard">
    </form>
</div>

<div class="hud-right elements p-2">
    <h3>Edit your view's elements</h3>
    <form  method="post">
        <label>
            <select name="selectedElementChanged" require onchange="this.form.submit()">
                <option>--Change element--</option>
                <?php
                foreach ($_SESSION['selected_view']->getElements() as $element)
                {
                    if($element != $_SESSION['selected_element'])
                    {
                        if(get_class($element)=="Sign")
                        {
                            echo "<option value='".$element->getId()."'>Sign : ".$element->getContent()."</option>";
                        }
                        elseif(get_class($element)=="Waypoint")
                        {
                            echo "<option value='".$element->getId()."'>Waypoint : ".$element->getViewName()."</option>";
                        }
                        elseif(get_class($element)=="AssetImported")
                        {
                            echo "<option value='".$element->getId()."'>Custom asset : ".$element->getName()."</option>";
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
            if(get_class($_SESSION['selected_element']) == "Waypoint" || get_class($_SESSION['selected_element']) == "AssetImported") {
                echo '<input class="elementScale" type="hidden" name="elementScale" value="'.$_SESSION['selected_element']->getScaleInt() .'">';
            }
            echo '<input class="elementRotationX" type="hidden" name="elementRotationX" value="'.$_SESSION['selected_element']->getRotation()->getX().'">';
            echo '<input class="elementRotationY" type="hidden" name="elementRotationY" value="'.$_SESSION['selected_element']->getRotation()->getY().'">';
            echo '<input class="elementRotationZ" type="hidden" name="elementRotationZ" value="'.$_SESSION['selected_element']->getRotation()->getZ().'">';
        }

        ?>  
        <input type="hidden" name="action" value="selectedElementChanged">
    </form>

    <?php

    if(isset($_SESSION['selected_element']))
    {
        $element = $_SESSION['selected_element'];

        if(get_class($element)=="Sign")
        {
            echo "Sign : ";
            echo $element->getContent();
        }
        elseif(get_class($element)=="Waypoint")
        {
            echo "Waypoint : ";
            echo $element->getViewName();
        }
        elseif(get_class($element)=="AssetImported")
        {
            echo "Custom asset : ";
            echo $element->getName();
        }
        ?>
        <div id="positionSliders">
            Position:
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

            <?php
            $element = $_SESSION['selected_element'];
            ?>
            <div id="rotationSliders">
            Rotation:
            <div>
                <input type="range" min="-180" max="180" value="<?php echo $element->getRotation()->getX() ?>" step="1" class="slider" name="rotationX" id="rotationX" oninput="sliderChangedRotation(this, '<?php echo $element->getId(); ?>'), changeRotationX()">
                X: <span><?php echo $element->getRotation()->getX() ?></span>
            </div>
            <div>
                <input type="range" min="-180" max="180" value="<?php echo $element->getRotation()->getY() ?>" step="1" class="slider" name="rotationY" id="rotationY" oninput="sliderChangedRotation(this, '<?php echo $element->getId(); ?>'), changeRotationY()">
                Y: <span><?php echo $element->getRotation()->getY() ?></span>
            </div>
            <div>
                <input type="range" min="-180" max="180" value="<?php echo $element->getRotation()->getZ() ?>" step="1" class="slider" name="rotationZ" id="rotationZ" oninput="sliderChangedRotation(this, '<?php echo $element->getId(); ?>'), changeRotationZ()">
                Z: <span><?php echo $element->getRotation()->getZ() ?></span>
            </div>
        </div>
        <?php
                if(get_class($element) == "Waypoint" || get_class($element) == "AssetImported"){
                    echo '
                    Scale:
                        <div>
                        <input type="range" min="0" max="2" value="' . $element->getScaleInt() . '" step="0.005" class="slider" name="scale" id="scale" oninput="sliderChangedScale(this, \'' . $element->getId() . '\'), changeScale()">
                        Scale: <span>' . $element->getScaleInt() . '</span>
                        </div>
                    ';
            }
            ?>

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
            
            echo '<input class="elementRotationX" type="hidden" name="elementRotationX" value="'.$_SESSION['selected_element']->getRotation()->getX().'">';
            echo '<input class="elementRotationY" type="hidden" name="elementRotationY" value="'.$_SESSION['selected_element']->getRotation()->getY().'">';
            echo '<input class="elementRotationZ" type="hidden" name="elementRotationZ" value="'.$_SESSION['selected_element']->getRotation()->getZ().'">';
            if(get_class($_SESSION['selected_element']) == "Waypoint" || get_class($_SESSION['selected_element']) == "AssetImported") {
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
            foreach ($_SESSION['panorama']->getTimelines() as $timeline)
            {
                if(!isset($_SESSION['selected_timeline']) or $timeline != $_SESSION['selected_timeline']) {
                    echo "<option value='" . $timeline->getId() . "'>" . $timeline->getName() . "</option>";
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
            if(get_class($_SESSION['selected_element']) == "Waypoint" || get_class($_SESSION['selected_element']) == "AssetImported") {
                echo '<input class="elementScale" type="hidden" name="elementScale" value="'.$_SESSION['selected_element']->getScaleInt() .'">';
            }
            echo '<input class="elementRotationX" type="hidden" name="elementRotationX" value="'.$_SESSION['selected_element']->getRotation()->getX().'">';
            echo '<input class="elementRotationY" type="hidden" name="elementRotationY" value="'.$_SESSION['selected_element']->getRotation()->getY().'">';
            echo '<input class="elementRotationZ" type="hidden" name="elementRotationZ" value="'.$_SESSION['selected_element']->getRotation()->getZ().'">';
        }
        ?>
    </form>

    <h4>Add a custom asset (.gtlf / .zip) :</h4>

    <form  method="post" enctype="multipart/form-data">
        <input class="form-control" type="file" name="assetImported" accept=".gltf,.zip" onchange="this.form.submit()">

        <input type="hidden" name="action" value="addAssetImported">

        <?php
        if(isset($_SESSION['selected_element'])){
            echo '<input class="elementPositionX" type="hidden" name="elementPositionX" value="'.$_SESSION['selected_element']->getPosition()->getX() .'">';
            echo '<input class="elementPositionY" type="hidden" name="elementPositionY" value="'.$_SESSION['selected_element']->getPosition()->getY() .'">';
            echo '<input class="elementPositionZ" type="hidden" name="elementPositionZ" value="'.$_SESSION['selected_element']->getPosition()->getZ() .'">';
            if(get_class($_SESSION['selected_element']) == "Waypoint" || get_class($_SESSION['selected_element']) == "AssetImported") {
                echo '<input class="elementScale" type="hidden" name="elementScale" value="'.$_SESSION['selected_element']->getScaleInt() .'">';
            }
            echo '<input class="elementRotationX" type="hidden" name="elementRotationX" value="'.$_SESSION['selected_element']->getRotation()->getX().'">';
            echo '<input class="elementRotationY" type="hidden" name="elementRotationY" value="'.$_SESSION['selected_element']->getRotation()->getY().'">';
            echo '<input class="elementRotationZ" type="hidden" name="elementRotationZ" value="'.$_SESSION['selected_element']->getRotation()->getZ().'">';
        }
        ?>
    </form>
</div>

<a-scene id="preview" embedded>

    <?php echo '<a-sky src=".datas/'. $_SESSION['panorama']->getId().'/'.$_SESSION['selected_view']->getPath().'" ></a-sky>'?>

        <a-entity position="0 -1.6 0" id="camera" rotation="<?php echo $_SESSION['selected_view']->getCameraRotation(); ?>" cursor="rayOrigin: mouse">
          <a-camera wasd-controls-enabled="false" look-controls id="a-camera">
          </a-camera>
        </a-entity>

    <?php
    $elementId = 1;
    foreach ($_SESSION['selected_view']->getElements() as $element) {
        if (get_class($element) == "Sign")
        {
            ?>
             <a-entity id="<?php echo $element->getId() ?>" position="<?php echo $element->getPosition()->getPosition() ?>"
              rotation="<?php echo $element->getRotation()->getRotation() ?>"
              text="value: <?php echo $element->getContent() ?>; align:center; side:double">
            </a-entity>
            <?php
        } elseif (get_class($element) == "Waypoint")
        {
            ?>
            <a-entity position="<?php echo $element->getPosition()->getPosition() ?>" rotation="<?php echo $element->getRotation()->getRotation() ?>" id="<?php echo $element->getId() ?>" scale="<?php echo $element->getScale() ?>">
                <a-entity gltf-model=".template/direction_arrow/scene.gltf" id="model"
                animation__2="property: position; from: 0 0 0; to: 0 -1 0; dur: 1000; easing: linear; dir: alternate; loop: true" animationcustom
                look-at="#pointer<?php echo $elementId ?>">
                </a-entity>
                <a-entity id="pointer<?php echo $elementId ?>"  animation__2="property: position; from: 3 0 1; to: 3 -1.0 1; dur: 1000; easing: linear; dir: alternate;loop: true">
                </a-entity>
            </a-entity>
            <?php
        }
        elseif (get_class($element) == "AssetImported")
        {
            ?>
            <a-entity position="<?php echo $element->getPosition()->getPosition() ?>" rotation="<?php echo $element->getRotation()->getRotation() ?>" id="<?php echo $element->getId() ?>" scale="<?php echo $element->getScale() ?>">
                <a-entity gltf-model=".datas/<?php echo $_SESSION['panorama']->getId()."/".$element->getPath()."/".$element->getModel() ?>">
                </a-entity>
            </a-entity>
            <?php
        }
    }
    ?>
</a-scene>
