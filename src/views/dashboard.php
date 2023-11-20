<head>
    <title>Dashboard : <?php echo $_SESSION['panorama']->getName(); ?></title>
    <link rel="stylesheet" href="views/styles/dashboard.css">
</head>

<div class="mt-5">
    <div class="text-center">

    </div>
    <div class="d-flex justify-content-around">

    <div>
        <h5 class="font-weight-bold">Project's name</h5>
        <form method="post">
            <div class="d-flex">
                <input class="form-control" type="text" placeholder="My amazing panorama" name="projectName" value="<?php echo $_SESSION['panorama']->getName()?>">
                <button type="submit" class="btn btn-primary mb-3">Update</button>
                <input type="hidden" name="action" value="updateProjectName">
            </div>
        </form>
    </div>


        <h1 class="font-weight-bold">Dashboard</h1>

        <div>
            <p> Your Panorama will start on :</p>
            <div class="d-flex">
                <form method="post">
                    <select class="form-control" name="firstView" required>
                        <?php
                        foreach ($_SESSION['panorama']->getViews() as $view){
                            echo "<option value='".$view->getPath()."'>".$view->getName()."</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" class="mb-3 btn btn-primary">Generate your Panorama</button>
                    <input type="hidden" name="action" value="generate">
                </form>
            </div>

        </div>
    </div>

    <div>
        <h5 class="font-weight-bold">Add new images :</h5>

        <form method="post" enctype="multipart/form-data">
            <input type="file" name="views[]" required multiple accept="image/*">
            <input type="submit" value="Upload">
            <input type="hidden" name="action" value="viewsUploaded">
        </form>

        <div class="row">
            <?php
            $panorama = $_SESSION['panorama'];

            foreach ($panorama->getViews() as $view){
            ?>

            <div class="col-sm-3 align-self-center bg-white shadow p-0 divRounded mt-3">
                <div class="p-0">
                    <?php
                    echo '<form method="post">        
                        <input src="./.datas/'.$panorama->getId() ."/". $view->getPath() .'" type="image" class="w-100 imgRounded">
                        <input type="hidden" name="selected_view" value="'.$view->getPath().'">
                        <input type="hidden" name="action" value="editView">
                    </form>';
                    ?>
                </div>
                <h5 class="ml-4 mb-4 pb-4 pt-3"><?php echo $view->getName(); ?></h5>
            </div>
            <?php
            }
            ?>

        </div>
    </div>

    <div>
        Change the map :

        <form method="post" enctype="multipart/form-data" class="dashboard-map">
            <input type="file" name="map" required multiple accept="image/*">
            <input type="submit" value="Upload">
            <input type="hidden" name="action" value="changeMap">
        </form>

        <?php
        if ($panorama->isMap())
        {
            echo "Edit your map :";

            echo '
                <form method="post" class="dashboard-map-form">
                    <input src="./.datas/'. $panorama->getId() ."/". $panorama->getMap()->getPath() .'" type="image" class="map-display">
                    <input type="hidden" name="selected_view" value="'. $panorama->getMap()->getPath() .'">
                    <input type="hidden" name="action" value="editMap">
                </form>
            ';
        }
        ?>
    </div>



</div>
