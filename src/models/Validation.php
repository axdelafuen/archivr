<?php

class Validation
{
    public static function valAction($action)
    {
        if (!isset($action)) {
            throw new InvalidArgumentException('pas d\'action');
        }
    }

    public static function valTexte(string $texte)
    {
        return filter_var($texte, FILTER_SANITIZE_SPECIAL_CHARS);
    }

}


        