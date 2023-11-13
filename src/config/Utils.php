<?php

class Utils{
    static function idGenerator(string $content):string{
        return uniqid($content, true);
    }
}

?>