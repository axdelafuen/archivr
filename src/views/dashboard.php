<head>
    <title>Dashboard : <?php echo $_SESSION['panorama']->getName(); ?></title>
    <link rel="icon" type="image/*" href="views/assets/images/map.png">
    <link rel="stylesheet" href="views/styles/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php
// load navbar
require_once(__DIR__.'/templates/navbar.html');
?>
<div class="mt-5">
    <div class="text-center">

    </div>
    <div class="d-flex justify-content-around">

    <div>
        <h5 class="font-weight-bold">Project's name</h5>
        <form method="post">
            <div class="d-flex">
                <input id="projectName" class="form-control" type="text" placeholder="My amazing panorama" name="projectName" value="<?php echo $_SESSION['panorama']->getName()?>">
                <button id="updateProjectName" type="submit" class="btn btn-primary mb-3">Update</button>
                <input id="updateProjectNameSubmit" type="hidden" name="action" value="updateProjectName">
            </div>
        </form>
    </div>


        <h1 class="font-weight-bold">Dashboard</h1>

        <div>
            <p> Your Panorama will start on :</p>
            <div class="d-flex flex-column">
                <form method="post">
                    <select class="form-control" name="firstView" required>
                        <?php
                        foreach ($_SESSION['panorama']->getViews() as $view){
                            echo "<option value='".$view->getPath()."'>".$view->getName()."</option>";
                        }
                        foreach ($_SESSION['panorama']->getTimelines() as $timeline){
                            echo "<option value='".$timeline->getId()."'>".$timeline->getName()."</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" class="mb-3 btn btn-primary">Generate your Panorama</button>
                    <input type="hidden" name="action" value="generate">
                </form>
                <?php 
                    if(isset($errorList['date'])){
                        echo '<p class="text-danger">' . $errorList['date'] .' </p>';
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="mb-5 ml-3">
        <div class="d-flex">
            <div>
                <h5 class="font-weight-bold">Add new images :</h5>
                <div class="d-flex justify-content-between mr-5">
                    <form method="post" enctype="multipart/form-data"">
                        <div class="d-flex">
                            <input class="form-control" type="file" name="views[]" required multiple accept="image/*" onchange="this.form.submit()">
                            <input type="hidden" name="action" value="viewsUploaded">
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <h5 class="font-weight-bold">Create a timeline :</h5>
                <div class="d-flex justify-content-between mr-5">
                    <form method="post">
                        <div class="d-flex">
                            <input class="form-control" type="text" name="timelineName" required>
                            <button class="btn btn-secondary" type="submit">Create</button>
                            <input type="hidden" name="action" value="createTimeline">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="d-flex flex-row flex-wrap justify-content-around">
            <?php
            $panorama = $_SESSION['panorama'];

            foreach ($panorama->getTimelines() as $timeline) {
                $timelineMdl = new TimelineModel($timeline);
                if(count($timeline->getViews()) > 0){
            ?>
                    <div class="align-self-center bg-white shadow p-0 divRounded mt-3">
                        <div class="p-0">
                            <?php
                            echo '<form method="post">
                            <input src="./.datas/'.$panorama->getId() ."/". $timelineMdl->getFirstView()->getPath().'" type="image" class="w-100 imgRounded">   
                            <input type="hidden" name="selected_timeline" value="'.$timeline->getId().'">
                            <input type="hidden" name="action" value="editTimeline">
                        </form>';
                            ?>
                        </div>
                        <h5 class="ml-4 mb-2 pb-4 pt-3">Timeline : <?php echo $timeline->getName(); ?></h5>
                    </div>
            <?php
                }
            }
            if(count($panorama->getViews()) > 0){
                foreach ($panorama->getViews() as $view){
                ?>
                <div class="align-self-center bg-white shadow p-0 divRounded mt-3">
                    <div class="p-0">
                        <?php
                        echo '<form method="post">        
                            <input src="./.datas/'.$panorama->getId() ."/". $view->getPath() .'" type="image" class="w-100 imgRounded">
                            <input type="hidden" name="selected_view" value="'.$view->getPath().'">
                            <input type="hidden" name="action" value="editView">
                        </form>';
                        ?>
                    </div>
                    <h5 class="ml-4 mb-2 pb-4 pt-3">View : <?php echo $view->getName(); ?></h5>
                </div>
                <?php
                }
            }
            ?>

        </div>
    </div>

    <div class="mb-3">
        <div class="ml-3">
            <h5 class="font-weight-bold">Change the map :</h5>
            <div class="row">
                <form method="post" enctype="multipart/form-data" class="dashboard-map">
                    <div class="d-flex col-md-12">
                        <input class="form-control" type="file" name="map" required multiple accept="image/*" onchange="this.form.submit()">
                        <input type="hidden" name="action" value="changeMap">
                    </div>
                </form>
            </div>
        </div>

        <?php
        if ($panorama->getMap() !== null)
        {?>
        <div class="d-flex justify-content-center">
            <div class="align-self-center bg-white shadow p-0 divMapRounded mt-3">
                <div class="p-0">
                <?php echo '
                    <form method="post" class="dashboard-map-form">
                        <input src="./.datas/'. $panorama->getId() ."/". $panorama->getMap()->getPath() .'" type="image" class="w-100 imgMapRounded">
                        <input type="hidden" name="selected_view" value="'. $panorama->getMap()->getPath() .'">
                        <input type="hidden" name="action" value="editMap">
                    </form>
                ';?>
                </div>
                <h5 class="ml-4 mb-2 pb-4 pt-3"><?php echo $panorama->getMap()->getName(); ?></h5>
            <?php
            }
            ?>
            </div>
        </div>
    </div>
    <div class="mb-5">
        <div class="ml-3">
            <?php
            if(!empty($panorama->getTimelines())){
                ?>
                 <h5 class="font-weight-bold">Manage your timelines :</h5>
                <?php
                 foreach ($panorama->getTimelines() as $timeline){
                     ?>
                         <div class="d-flex align-items-center mb-3">
                             <h5 class="m-0 mr-3"><?php echo $timeline->getName() ?></h5>
                             <form method="post" class="m-0">
                                 <button class="btn btn-secondary" type="submit">Delete</button>
                                 <input type="hidden" name="selected_timeline" value="<?php echo $timeline->getId() ?>">
                                 <input type="hidden" name="action" value="deleteTimeline">
                             </form>
                         </div>
                     <?php
                 }
            }
            ?>
        </div>
    </div>
</div>
</body>
