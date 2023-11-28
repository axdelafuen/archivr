<?php

class GeneratorPanorama{
    public static function generateHtml($panoramaName, $body):string{
      $page = '
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>'.$panoramaName.'</title>
    <script src="https://aframe.io/releases/1.4.0/aframe.min.js"></script>
    <script src="https://unpkg.com/aframe-look-at-component@0.8.0/dist/aframe-look-at-component.min.js"></script>
      <script src="https://unpkg.com/aframe-template-component@3.2.1/dist/aframe-template-component.min.js"></script>
      <script src="script/script.js"></script>
  </head>

  <body>
    <a-scene>

      <!-- Caméra Rig -->
      <a-entity id="player" position="0 0 0">
        <!-- Caméra -->
        <a-entity position="0 -1.6 0" cursor="rayOrigin: mouse">
          <a-camera wasd-controls-enabled="false" look-controls id="camera">
            <a-cursor id="cursor" color="white" position="0 0 -0.2" scale="0.25 0.25 0.25"
              animation__click="property: scale; startEvents: click; from: 0.1 0.1 0.1; to: 0.25 0.25 0.25; dur: 150">
            </a-cursor>
          </a-camera>
        </a-entity>
      </a-entity>

      <a-entity id="base">
        '.$body.'
      </a-entity>
    </a-scene>
  </body>
</html>
      ';

      return $page;
    }

    public static function createDirectory($panorama, $fisrtView){

      $basePath = "./.datas/out";
      $folders = array('assets', 'assets/images', 'assets/sounds', '/script', '/templates', '/assets/models');
      $panoramaId = $panorama->getId();

      $elements = array();
      foreach($panorama->getViews() as $view){
        $template = GeneratorPanorama::generateBase($view);
        array_push($elements, $template);
        if($template->name == explode('.', $fisrtView)[0].'.html'){
          $firstViewBody = $template->body;
        }
      }

      $page = GeneratorPanorama::generateHtml($panorama->getName(), $firstViewBody);

      $images = GeneratorPanorama::getImages($panorama);

      if($panorama->isMap()){
        $map = GeneratorPanorama::generateMap($panorama->getMap());
        touch($basePath.'/templates/'.$map->name);
        file_put_contents($basePath.'/templates/'.$map->name, $map->body);
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

      copy('./.template/blueWaypoint.png', './.datas/out/assets/images/blueWaypoint.png');
      copy('./.template/sky.png', './.datas/out/assets/images/sky.png');
      copy('./.template/script.js', './.datas/out/script/script.js');
      Utils::directory_copy('./.template/direction_arrow', './.datas/out/assets/models/direction_arrow');

      GeneratorPanorama::createJsonFile($panorama);
      GeneratorPanorama::generateZip($panorama->getName());
    }

    public static function createJsonFile($panorama){
      $path = './.datas/out/.holder.json';
      $json = json_encode($panorama, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
      touch($path);
      file_put_contents($path, $json);
    }

    public static function generateZip($panoramaName){
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

    public static function getImages($panorama):array{
      $images = scandir('./.datas/'.$panorama->getId());
      $images = array_slice($images, 2, count($images));
      return $images;
    }

    public static function generateBase($view):Template{
      $path = $view->getPath();
      $template = new Template();

      $body = '<a-sky id="skybox" src="./assets/images/'.$path.'" animationcustom></a-sky>
      ';

      $elementId = 1;

      foreach($view->getElements() as $element){
        if(get_class($element) == 'Sign'){
          $body .= '
            <a-entity position="'.strval($element->getPosition()).'" rotation="' . strval($element->getRotation()) . '" text="value: '.$element->getContent().'; align: center" animationcustom"></a-entity>
          ';
        }else{
          $path = explode('.', $element->getView()->getPath())[0].'.html';
        
          $body .= '
            <a-entity position="' . strval($element->getPosition()) . '" rotation="' . strval($element->getRotation()) . '" scale="' . $element->getScale() . '">
            <a-entity gltf-model="./assets/models/direction_arrow/scene.gltf" id="model"
              animation__2="property: position; from: 0 0 0; to: 0 -1 0; dur: 1000; easing: linear; dir: alternate; loop: true" animationcustom
              onclick="goTo(\'templates/' . $path . '\')"
              look-at="#pointer' . $elementId .'">
            </a-entity>
              <a-entity id="pointer' . $elementId . '"  animation__2="property: position; from: 3 0 1; to: 3 -1.0 1; dur: 1000; easing: linear; dir: alternate;loop: true">
              </a-entity>
            </a-entity>
          ';
        }
        $elementId += 1;
      }

      $template->body = $body;
      $template->name = explode('.', $view->getPath())[0].'.html';

      return $template;
    }

    public static function generateMap($map):Template{
      $path = $map->getPath();
      $template = new Template();

      $body = '<a-sky id="skybox" src="assets/images/sky.png" animationcustom></a-sky>';

      $body .= '<a-image src="assets/images/' . $path . '" position="0 0 -0.6" width="2.1"></a-image>';

      foreach($map->getElements() as $element){
        $elementPath = explode('.', $element->getView()->getPath())[0].'.html';
        $element->getPosition()->setZ(-0.5);
        $body .= '
          <a-image onclick="goTo(\'templates/' . $elementPath . '\')" animationcustom  position="' . strval($element->getPosition()) . '" src="assets/images/blueWaypoint.png" color="#FFFFFF" rotation="0 90 0" look-at="#camera" height="0.1" width="0.1" map></a-image>
        ';
      }

      $template->name = explode('.', $path)[0] . '.html';
      $template->body = $body;

      return $template;
    }




    public static function loadFromFile($data){
      $panorama = new Panorama($data['name']);
      $array_views = array();

      foreach($data['views'] as $view){
        $array_views[$view['path']] = new View($view['path']); 
      }

      foreach($data['views'] as $view){
        $array_element = array();
        foreach($view['elements'] as $element){
          $tmp = null;
          if(isset($element['destination'])){
            foreach($array_views as $key => $value){
              if($key == $element['destination']){
                $tmp = new Waypoint($value);
                $tmp->set($element);
                break;
              }
            }
          } else {
            $tmp = new Sign($element['content']);
            $tmp->set($element);
          }
          array_push($array_element, $tmp);
        }
        foreach($array_views as $key => $value){
          if($key == $view['path']){
            $value->set($array_element);
          }
        }
      }

      if(isset($data['map'])){
        $map =  new Map($data['map']['path']);
        $waypoint_array = array();
        foreach($data['map']['elements'] as $element) {
          foreach($array_views as $key => $value) {
            if($key == $element['destination']){
              $waypoint = new Waypoint($value);
              $waypoint->set($element);
              array_push($waypoint_array, $waypoint);
              break;
            }
          }
        }
        $map->set($waypoint_array);
        $panorama->setMap($map);
      }

      $views = array();
      foreach($array_views as $key => $value){
        array_push($views, $value);
      }

      $panorama->setViews($views);
      $panorama->set($data['id']);

      return $panorama;
    }
}

?>