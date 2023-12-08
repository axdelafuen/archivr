<head>
    <title>Error</title>
</head>

<h1>ERROR !</h1>
<?php
if (isset($errorList)) {
foreach ($errorList as $value){
    echo $value."<br>";
}
}
?>

<form>
    <input type="submit" value="Go back home page...">
    <input type="hidden" name="action" value=<?php NULL?>>
</form>
