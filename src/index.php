<?php

//load config
require_once(__DIR__.'/config/config.php');

//load autoloader
require_once(__DIR__.'/config/Autoload.php');
Autoload::load();

if(!empty(getenv("DEPLOYED"))){
    echo '<base href="https://codefirst.iut.uca.fr/containers/archivr-archivr/">';
}

$cont = new Controller();
?>