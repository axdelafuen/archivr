<?php

class GeneratorTest{
    static function generateHtml($panoramaName):string{
      $page = '
        <!doctype html>
        <html>
          <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>'.$panoramaName.'</title>
            <script src="https://aframe.io/releases/1.4.0/aframe.min.js"></script>
            <script src="https://unpkg.com/aframe-look-at-component@0.8.0/dist/aframe-look-at-component.min.js"></script>
              <script src="https://unpkg.com/aframe-template-component@3.2.1/dist/aframe-template-component.min.js"></script>
              <script src="template.js"></script>
          </head>

          <body>
            <a-scene>
              <a-assets>
                <img id="fleche" src="./assets/images/fleche.png" height="357" width="367" alt=""/>
              </a-assets>

              <!-- Caméra Rig -->
              <a-entity id="player" position="0 0 0">
                <!-- Caméra -->
                  <a-entity position="0 1.6 0" look-controls id="camera" camera="userHeight: 1.6"cursor="rayOrigin: mouse">
                  <a-cursor id="cursor" color="white" position="0 0 -0.2" scale="0.25 0.25 0.25"
                    animation__click="property: scale; startEvents: click; from: 0.1 0.1 0.1; to: 0.25 0.25 0.25; dur: 150">
                </a-cursor>
              </a-entity>

              <a-entity id="base">
                <a-box color="pink" position="0 1 -3" onclick="goTo()"  animationcustom class="clickable"></a-box>
                <a-sky src="assets/images/sky.png" animationcustom ></a-sky>
              </a-entity>
            </a-scene>
          </body>
        </html>
      ';

      return $page;
    }

    static function createDirectory($panorama){
      $basePath = "./.datas/out";
      $folders = array('assets', 'assets/images', 'assets/sounds', '/script', '/templates');
      $panoramaId = $panorama->getId();

      $page = GeneratorTest::generateHtml($panorama->getName());

      $images = GeneratorTest::getImages($panorama);
      
      $elements = array();
      foreach($panorama->getViews() as $view){
        array_push($elements, GeneratorTest::generateBase($view));
      }

      if(!file_exists($basePath)){
        mkdir($basePath);
      }else{
        Utils::delete_directory($basePath);
        mkdir($basePath);
      }

      foreach($folders as $folder){
        mkdir($basePath.'/'.$folder);
      }

      touch($basePath.'/index.html');
      file_put_contents($basePath.'/index.html',$page);

      foreach($elements as $element){
        touch($basePath.'/templates/'.$element->name);
        file_put_contents($basePath.'/templates/'.$element->name, $element->body);
      }

      foreach($images as $image){
        copy('./.datas/'.$panoramaId.'/'.$image, $basePath.'/assets/images/'.$image);
      }

      copy('./.template/script.js', './.datas/out/script/script.js');

      GeneratorTest::generateZip($panorama->getName());
    }

    static function generateZip($panoramaName){

      if(!file_exists('./.datas/zip')){
        mkdir('./.datas/zip');
      }

      // Get real path for our folder
      $rootPath = realpath('./.datas/out');

      // Initialize archive object
      $zip = new ZipArchive();
      $zip->open('./.datas/zip/'.$panoramaName.'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

      // Create recursive directory iterator
      /** @var SplFileInfo[] $files */
      $files = new RecursiveIteratorIterator(
          new RecursiveDirectoryIterator($rootPath),
          RecursiveIteratorIterator::LEAVES_ONLY
      );

      foreach ($files as $name => $file)
      {
          // Skip directories (they would be added automatically)
          if (!$file->isDir())
          {
              // Get real and relative path for current file
              $filePath = $file->getRealPath();
              $relativePath = substr($filePath, strlen($rootPath) + 1);

              // Add current file to archive
              $zip->addFile($filePath, $relativePath);
          }
      }

      // Zip archive will be created only after closing object
      $zip->close();
    }

    static function getImages($panorama):array{
      $images = scandir('./.datas/'.$panorama->getId());
      $images = array_slice($images, 2, count($images));
      return $images;
    }

    static function generateBase($view):Template{
      $path = $view->getPath();
      $template = new Template();

      $body = '<a-sky id="skybox" src="./assets/images/'.$path.'" animationcustom></a-sky>
      ';

      foreach($view->getElements() as $element){
        if(get_class($element) == 'Sign'){
          $body .= '
            <a-entity position="'.strval($element->getPosition()).'" look-at="#camera">
              <a-plane  animationcustom color="black" width="5" text="value: '.$element->getContent().';align:center"></a-plane>
            </a-entity>
          ';
        }else{
          $path = explode('.', $element->getDestinationt()->getPath())[0].'.html';
          $body .= '
            <a-image onclick="goTo("./templates/'.$path.'")"
            position="'.strval($element->getPosition()).'" src="assets/fleche.png"  color="#FFFFFF" animationcustom></a-image>
          ';
        }
      }

      $template->body = $body;
      $template->name = explode('.', $view->getPath())[0].'.html';

      return $template;
    }

    static function loadFromFile(){

    }
}

?>