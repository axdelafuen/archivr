<head>
    <title>Dashboard : <?php echo $_SESSION['panorama']->getName(); ?></title>
    <link rel="stylesheet" href="views/styles/dashboard.css">
</head>

<form method="post">
    <div class="dashboard-proj-name">
        <h3>Dashboard : </h3>
        <input type="text" placeholder="My amazing panorama" name="projectName" value="<?php echo $_SESSION['panorama']->getName()?>">
        <input type="submit" value="Update">
        <input type="hidden" name="action" value="updateProjectName">
    </div>
</form>

<br>

Add new images :

<form method="post" enctype="multipart/form-data">
    <input type="file" name="views[]" required multiple accept="image/*">
    <input type="submit" value="Upload">
    <input type="hidden" name="action" value="viewsUploaded">
</form>

<?php
$panorama = $_SESSION['panorama'];

echo "Edit your images :";
?>

<div class="dashboard-views">

<?php
    foreach ($panorama->getViews() as $view){
        echo '
        <div class="dashboard-views-container">
            <form method="post" class="dashboard-views-form">        
                <input src="./.datas/'.$panorama->getId() ."/". $view->getPath() .'" type="image" class="views-display">
                <input type="hidden" name="selected_view" value="'.$view->getPath().'">
                <input type="hidden" name="action" value="editView">
            </form>
        ';
        echo $view->getName();
        echo '</div>';
    }
?>
</div>

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