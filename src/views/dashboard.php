<html>
<head>
    <title>Panorama Generator</title>
</head>

<body>
<h3>Dashboard</h3>

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

?>

</body>
</html>