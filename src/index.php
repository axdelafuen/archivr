<?php
//si controller pas objet
//  header('Location: controller/controller.php');

//si controller objet

//chargement config
require_once(__DIR__.'/config/config.php');

//chargement autoloader pour autochargement des classes
require_once(__DIR__.'/config/Autoload.php');
Autoload::load();

echo '
    <h1>Panorama Generator</h1>
        <ul>
            <li>
                <form method="post">
                    <input type="submit" value="Home">
                    <input type="hidden" name="action">
                </form>
            </li>
            <li>
                <form method="post">
                    <input type="submit" value="New project">
                    <input type="hidden" name="action" value="goToLoadImages">
                </form>
            </li>
            <li>
                <form method="post">
                    <input type="submit" value="Tutorial">
                    <input type="hidden" name="action" value="goToTutorial">
                </form>
            </li>
            <li>
                <form method="post">
                    <input type="submit" value="About">
                    <input type="hidden" name="action" value="goToAbout">
                </form>
            </li>
        </ul>
';

$cont = new Controller();

?> 