<?php

class Utils{
    static function idGenerator(string $content):string{
        return uniqid($content, true);
    }

    static function prompt($prompt_msg):string{
        echo("<script type='text/javascript'> var answer = prompt('".$prompt_msg."'); </script>");

        $answer = "<script type='text/javascript'> document.write(answer); </script>";
        return($answer);
        }
}

?>