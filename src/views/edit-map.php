<title>Map edition</title>

<h3>Edit your map</h3>

<form>
    <input type="submit" value="Go back">
    <input type="hidden" name="action" value="goBackToDashboard">
</form>

<div>
        <?php echo '<img src="./.datas/'. $_SESSION["panorama"]->getId() ."/". $_SESSION["selected_view"] .'" alt="map">'?>
</div>