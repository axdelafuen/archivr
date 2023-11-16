<title>Dashboard : <?php echo $_SESSION['panorama']->getName(); ?></title>

<h3>Dashboard : <?php echo $_SESSION['panorama']->getName(); ?></h3>

<form method="post">
    <input type="submit" value="Generate your diaporama">
    <input type="hidden" name="action" value="generate">
</form>

Add new images :

<form method="post" enctype="multipart/form-data">
    <input type="file" name="views[]" required multiple accept="image/*">
    <input type="submit" value="Upload">
    <input type="hidden" name="action" value="viewsUploaded">
</form>

<?php
$panorama = $_SESSION['panorama'];

echo "Edit your images :";

foreach ($panorama->getViews() as $view){
    echo '
        <form method="post">        
            <input src="./.datas/'.$panorama->getId() ."/". $view->getPath() .'" type="image">
            <input type="hidden" name="selected_view" value="'.$view->getPath().'">
            <input type="hidden" name="action" value="editView">
        </form>
    ';
}

if ($panorama->isMap())
{
?>
    Change the map :

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="map" required multiple accept="image/*">
        <input type="submit" value="Upload">
        <input type="hidden" name="action" value="changeMap">
    </form>

<?php

    echo "Edit your map :";

    echo '
            <form method="post">
                <input src="./.datas/'. $panorama->getId() ."/". $panorama->getMap()->getPath() .'" type="image">
                <input type="hidden" name="selected_view" value="'. $panorama->getMap()->getPath() .'">
                <input type="hidden" name="action" value="editMap">
            </form>
        ';
}
?>