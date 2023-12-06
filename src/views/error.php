<head>
    <title>Error</title>
</head>

<h1>ERROR !</h1>
<?php
if (isset($dVueEreur)) {
foreach ($dVueEreur as $value){
    echo $value;
}
}
?>

<form>
    <input type="submit" value="Go back home page...">
    <input type="hidden" name="action" value=<?php NULL?>>
</form>
