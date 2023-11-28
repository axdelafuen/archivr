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
    <div class="d-flex justify-content-around">

        <h1 class="font-weight-bold">Edit timeline : <?php echo $_SESSION['selected_timeline']->getName() ?></h1>

        <form  method="post">
            <input type="submit" value="Go back">
            <input type="hidden" name="action" value="goBackToDashboard">
        </form>
    </div>

        <div class="mb-5">
            <div class="d-flex flex-row flex-wrap justify-content-around">
                <?php
                $timeline = $_SESSION['selected_timeline'];
                if(count($timeline->getViews()) > 0){
                    foreach ($timeline->getViews() as $view){
                        ?>
                        <div class="align-self-center bg-white shadow p-0 divRounded mt-3">
                            <div class="p-0">
                                <?php
                                echo '<form method="post">        
                                <input src="./.datas/'.$_SESSION['panorama']->getId() ."/". $view->getPath() .'" type="image" class="w-100 imgRounded">
                                <input type="hidden" name="selected_view" value="'.$view->getPath().'">
                                <input type="hidden" name="action" value="editTimelineView">
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

        <div class="mb-5">
            <div class="ml-3">
                <div class="d-flex align-items-center mb-3">
                    <h5 class="m-0 mr-3">Delete this timeline</h5>
                    <form method="post" class="m-0">
                        <button class="btn btn-secondary" type="submit">Delete</button>
                        <input type="hidden" name="selectedTimeline" value=" <?php $timeline->getId() ?>">
                        <input type="hidden" name="action" value="deleteTimeline">
                    </form>
                </div>
            </div>
        </div>
</div>
</body>
