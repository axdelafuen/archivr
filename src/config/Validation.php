<?php

class Validation
{

    public static function val_action($action)
    {

        if (!isset($action)) {
            throw new Exception('pas d\'action');
            //on pourrait aussi utiliser
            //$action = $_GET['action'] ?? 'no';
            // This is equivalent to:
            //$action =  if (isset($_GET['action'])) $action=$_GET['action']  else $action='no';
        }
    }

    public static function val_texte(string $texte)
    {
        return filter_var($texte, FILTER_SANITIZE_SPECIAL_CHARS);
    }

}

?>

        