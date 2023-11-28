<?php

class Utils{
    public static function idGenerator(string $content):string{
        return uniqid($content, true);
    }

    public static function prompt($prompt_msg):string{
        echo("<script type='text/javascript'> var answer = prompt('".$prompt_msg."'); </script>");

        $answer = "<script type='text/javascript'> document.write(answer); </script>";
        return($answer);
        }

    public static function delete_directory($dir)
    {
      if (!file_exists($dir)) {
        return true;
      }

      if (!is_dir($dir)) {
        return unlink($dir);
      }

      foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
          continue;
        }

        if (!Utils::delete_directory($dir . DIRECTORY_SEPARATOR . $item)) {
          return false;
        }
      }

      return rmdir($dir);
    }

    public static function directory_copy($sourceDirectory, $destinationDirectory){
        mkdir($destinationDirectory);

        foreach (scandir($sourceDirectory) as $item) {
            if($item != "." && $item != '..'){
                copy($sourceDirectory . DIRECTORY_SEPARATOR . $item, $destinationDirectory . DIRECTORY_SEPARATOR . $item);
            }
        }
    }
}

?>