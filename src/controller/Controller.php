<?php
/**
 * @codeCoverageIgnore
 */
// IL FAUT QUE CA DEGAGE, IL DOIT CHARGER PAR AUTOLOAD
include_once("./models/Generator.php");
class Controller
{
	public function __construct()
	{
		global $rep, $views; // nécessaire pour utiliser variables globales

		// on démarre ou reprend la session si necessaire (préférez utiliser un modèle pour gérer vos session ou cookies)
		session_start();

		//on initialise un tableau d'error
		$dVueEreur = array();

		try {
			if(isset($_REQUEST['action'])){
				$action = $_REQUEST['action'];
			}else{
				$action = NULL;
			}

			switch ($action) {
				//pas d'action, on r�initialise 1er appel
				case NULL:
					$this->Reinit();
					break;
				case "goToLoadImages":
					$this->GoToLoadImages($dVueEreur);
					break;
				case "viewsUploaded":
					$this->UploadViews($dVueEreur);
					break;
				case "goBackToDashboard":
					$this->GoBackToDashboard();
					break;
				case "goBackToDashboardFromMap":
					$this->GoBackToDashboardFromMap();
					break;
				case "editView":
					$this->EditView();
					break;
				case "updateProjectName":
					$this->UpdateProjectName($dVueEreur);
					break;
				case "deleteView":
					$this->DeleteView();
					break;
				case "editMap":
					$this->editMap();
					break;
				case "changeMap":
					$this->ChangeMap();
					break;
				case "addSign":
					$this->AddSign();
					break;
				case "generate":
					$this->Generate($dVueEreur);
					break;
				case "deleteElement":
					$this->DeleteViewElement();
					break;
				case "deleteMapElement":
					$this->DeleteMapElement();
					break;
				case "selectedElementChanged":
					$this->SelectedElementChanged();
					break;
				case "addWaypoint":
					$this->AddViewWaypoint();
					break;
				case "addMapWaypoint":
					$this->AddMapWaypoint();
					break;
				case "deleteMap":
					$this->DeleteMap();
					break;
				case "selectedMapElementChanged":
					$this->SelectedMapElementChanged();
					break;
				case "createTimeline":
					$this->CreateTimeline();
					break;
				case "changeTimeline":
					$this->ChangeTimeline();
					break;
				case "deleteTimeline":
					$this->DeleteTimeline();
					break;
				case "editTimeline":
					$this->EditTimeline();
					break;
				case "editTimelineView":
					$this->EditTimelineView();
					break;
				case "changeDate":
					$this->ChangeDate();
					break;
				case "import":
					$this->importJsonData();
					break;
				case "loadJsonFile":
					$this->loadDataFromJson();
					break;
				case "changeCameraRotation":
					$this->ChangeCameraRotation();
					break;
				//mauvaise action
				default:
					$dVueEreur[] = "This php action doesn't exist";
					require_once($rep . $views['error']);
					break;
			}
		} catch (PDOException $e) {
			//si error BD, pas le cas ici
			$dVueEreur[] = "A database error occurred";
			require_once($rep . $views['error']);

		} catch (Exception $e2) {
			$dVueEreur[] = "An unexpected error occurred";
			require_once($rep . $views['error']);
		}
		//fin
		exit(0);
	}//fin constructeur

	private function Reinit()
	{
		global $rep, $views; // nécessaire pour utiliser variables globales
		if(isset($_SESSION['panorama'])){
			unset($_SESSION['panorama']);
		}
		require_once($rep . $views['home']);
	}

	private function GoToLoadImages(array $dVueEreur)
	{
		global $rep, $views;
		if(isset($_SESSION['panorama'])){
			unset($_SESSION['panorama']);
		}
		require_once($rep . $views['upload']);
	}

	private function GoBackToDashboard()
	{
		global $rep, $views;

		if(isset($_SESSION['selected_element'])){
			if(isset($_REQUEST['elementPositionX']) and isset($_REQUEST['elementPositionY']) and isset($_REQUEST['elementPositionZ'])){
				$_SESSION['selected_element']->setPositionXYZ(floatval($_REQUEST['elementPositionX']), floatval($_REQUEST['elementPositionY']),floatval($_REQUEST['elementPositionZ']));
			}
            if(isset($_REQUEST['elementRotationX']) and isset($_REQUEST['elementRotationY']) and isset($_REQUEST['elementRotationZ'])){
                $_SESSION['selected_element']->setRotationXYZ(floatval($_REQUEST['elementRotationX']), floatval($_REQUEST['elementRotationY']),floatval($_REQUEST['elementRotationZ']));
            }
			if(isset($_REQUEST['elementScale'])){
				$_SESSION['selected_element']->setScale(floatval($_REQUEST['elementScale']));
			}
		}

		if(isset($_SESSION['selected_view'])){
			unset($_SESSION['selected_view']);
		}
		if(isset($_SESSION['selected_timeline'])){
			unset($_SESSION['selected_timeline']);
		}

		require_once ($rep.$views['dashboard']);
	}

	private function GoBackToDashboardFromMap()
	{
		global $rep, $views;

		if(isset($_SESSION['selected_element'])){
			$_SESSION['selected_element']->setPositionXY(floatval($_REQUEST['elementPositionX']), floatval($_REQUEST['elementPositionY']));
			if(isset($_REQUEST['elementScale'])){
				$_SESSION['selected_element']->setScale(floatval($_REQUEST['elementScale']));
			}
		}

		unset($_SESSION['selected_view']);

		require_once ($rep.$views['dashboard']);
	}

	private function UploadViews(array $dVueEreur)
	{
		global $rep, $views;
		if (!file_exists("./.datas")) {
			mkdir("./.datas");
		}

		if(isset($_SESSION['panorama'])){
			$panorama = $_SESSION['panorama'];
			unset($_SESSION['panorama']);
		}
		else{
			$projectName=Validation::val_texte($_POST['projectName']);
			if (!isset($projectName)) {
				$dVueEreur[]='nom de projet invalide';
				require_once($rep . $views['error']);
			}
			else{

				$panorama = new Panorama($projectName);
			}
			if (!file_exists("./.datas/".$panorama->getId())) {
				mkdir("./.datas/".$panorama->getId());
			}

			if(!empty($_FILES['map']['name'])){
				move_uploaded_file($_FILES['map']['tmp_name'], "./.datas/".$panorama->getId()."/". $_FILES['map']['name']);
				$panorama->setMap(new Map($_FILES['map']['name']));
			}
		}

		$currentAmountViews = count($panorama->getViews());

		for($i = 0; $i < count($_FILES['views']['name']); $i++){
			move_uploaded_file($_FILES['views']['tmp_name'][$i], "./.datas/". $panorama->getId()."/". $_FILES['views']['name'][$i]);
			$panorama->addView($i+$currentAmountViews, new View($_FILES['views']['name'][$i]));
		}

		$_SESSION['panorama'] = &$panorama;

		require_once($rep . $views['dashboard']);
	}

	private function EditView()
	{
		global $rep, $views;

		$selected_view = $_REQUEST['selected_view'];

		$_SESSION['selected_view'] = $_SESSION['panorama']->getViewByPath($selected_view);

		if(!isset($_SESSION['selected_view']) or empty($_SESSION['selected_view']))
		{
			require_once $rep.$views['error'];
		}
		else{
			if(count($_SESSION['selected_view']->getElements()) > 0){
				$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
			}
			else{
				unset($_SESSION['selected_element']);
			}
			require_once ($rep.$views['editView']);
		}
	}

	private function UpdateProjectName($dVueEreur)
	{
		global $rep, $views;

		$projectName=Validation::val_texte($_POST['projectName']);

		if (!isset($projectName)) {
			$dVueEreur[]='nom de projet invalide';
			require_once($rep . $views['error']);
		}
		else{
			$_SESSION['panorama']->setName($projectName);
			require_once ($rep.$views['dashboard']);
		}

	}

	private function DeleteView(){
		global $rep, $views;

		if(isset($_SESSION['selected_timeline'])){
			$_SESSION['selected_timeline']->removeView($_SESSION['selected_view']);
		}
		else{
			$_SESSION['panorama']->removeView($_SESSION['selected_view']);
		}

		unset($_SESSION['selected_view']);

		require_once($rep . $views['dashboard']);
	}

	private function DeleteMap(){
		global $rep, $views;

		$_SESSION['panorama']->removeMap();

		unset($_SESSION['selected_view']);

		require_once($rep . $views['dashboard']);
	}

	private function EditMap(){
		global $rep, $views;

		$selected_view = $_REQUEST['selected_view'];

		if($selected_view == $_SESSION['panorama']->getMap()->getPath())
		{
			$_SESSION['selected_view'] = $_SESSION['panorama']->getMap();
			if(count($_SESSION['selected_view']->getElements()) > 0){
				$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
			}
			else{
				unset($_SESSION['selected_element']);
			}
			require_once ($rep.$views['editMap']);
		}
		else{
			require_once $rep.$views['error'];
		}
	}

	private function AddSign()
	{
		global $rep, $views;

		$_SESSION['selected_view']->addElement(new Sign($_REQUEST['signContent']));

		if(isset($_SESSION['selected_element'])){
			$_SESSION['selected_element']->setPositionXYZ(floatval($_REQUEST['elementPositionX']), floatval($_REQUEST['elementPositionY']),floatval($_REQUEST['elementPositionZ']));
			$_SESSION['selected_element']->setRotationXYZ(floatval($_REQUEST['elementRotationX']), floatval($_REQUEST['elementRotationY']),floatval($_REQUEST['elementRotationZ']));
			if(isset($_REQUEST['elementScale'])){
				$_SESSION['selected_element']->setScale(floatval($_REQUEST['elementScale']));
			}
		}

		if(count($_SESSION['selected_view']->getElements()) > 0){
			$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
		}
		else{
			unset($_SESSION['selected_element']);
		}

		require_once ($rep.$views['editView']);
	}

	private function AddWaypoint()
	{
		global $rep,$views;

		if(!isset($_REQUEST['destinationView'])){
			require_once $rep.$views['error'];
		}

		if($_SESSION['panorama']->getViewByPath($_REQUEST['destinationView'])){
			$_SESSION['selected_view']->addElement(new Waypoint($_SESSION['panorama']->getViewByPath($_REQUEST['destinationView'])));
		}
		else if($_SESSION['panorama']->getTimelineById($_REQUEST['destinationView'])){
			$_SESSION['selected_view']->addElement(new Waypoint($_SESSION['panorama']->getTimelineById($_REQUEST['destinationView'])));
		}
		else{
			require_once $rep.$views['error'];
		}

		if(isset($_SESSION['selected_element'])){
			$_SESSION['selected_element']->setPositionXYZ(floatval($_REQUEST['elementPositionX']), floatval($_REQUEST['elementPositionY']),floatval($_REQUEST['elementPositionZ']));
			$_SESSION['selected_element']->setRotationXYZ(floatval($_REQUEST['elementRotationX']), floatval($_REQUEST['elementRotationY']),floatval($_REQUEST['elementRotationZ']));
			if(isset($_REQUEST['elementScale'])){
				$_SESSION['selected_element']->setScale(floatval($_REQUEST['elementScale']));
			}
		}

		if(count($_SESSION['selected_view']->getElements()) > 0){
			$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
		}
		else{
			unset($_SESSION['selected_element']);
		}
	}

	private function AddViewWaypoint()
	{
		global $rep,$views;
		$this->AddWaypoint();
		require_once ($rep.$views['editView']);
	}

	private function AddMapWaypoint()
	{
		global $rep,$views;
		$this->AddWaypoint();
		require_once ($rep.$views['editMap']);
	}

	private function DeleteViewElement()
	{
		global $rep, $views;

		$elementId = $_REQUEST['selected_element'];

		if(!isset($elementId) or empty($elementId)){
			require_once ($rep.$views['error']);
		}
		else{
			$element = $_SESSION['selected_view']->getElementById($elementId);
			if($element != null){
				$_SESSION['selected_view']->removeElement($element);
				if(count($_SESSION['selected_view']->getElements()) > 0){
					$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
				}
				else{
					unset($_SESSION['selected_element']);
				}
				require_once($rep.$views['editView']);
			}
			else{
				require_once ($rep.$views['error']);
			}
		}
	}

	private function DeleteMapElement()
	{
		global $rep, $views;

		$elementId = $_REQUEST['selected_element'];

		if(!isset($elementId) or empty($elementId)){
			require_once ($rep.$views['error']);
		}
		else{
			$element = $_SESSION['selected_view']->getElementById($elementId);
			if($element != null){
				$_SESSION['selected_view']->removeElement($element);
				if(count($_SESSION['selected_view']->getElements()) > 0){
					$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
				}
				else{
					unset($_SESSION['selected_element']);
				}
				require_once($rep.$views['editMap']);
			}
			else{
				require_once ($rep.$views['error']);
			}
		}
	}

	private function SelectedElementChanged()
	{
		global $rep, $views;

		if(isset($_SESSION['selected_element'])){
			$_SESSION['selected_element']->setPositionXYZ(floatval($_REQUEST['elementPositionX']), floatval($_REQUEST['elementPositionY']),floatval($_REQUEST['elementPositionZ']));
			$_SESSION['selected_element']->setRotationXYZ(floatval($_REQUEST['elementRotationX']), floatval($_REQUEST['elementRotationY']),floatval($_REQUEST['elementRotationZ']));
			if(isset($_REQUEST['elementScale'])){
				$_SESSION['selected_element']->setScale(floatval($_REQUEST['elementScale']));
			}
		}

		$_SESSION['selected_element'] = $_SESSION['selected_view']->getElementById($_REQUEST['selectedElementChanged']);

		require_once($rep.$views['editView']);
	}

	private function SelectedMapElementChanged()
	{
		global $rep, $views;

		if(isset($_SESSION['selected_element'])){
			$_SESSION['selected_element']->setPositionXY(floatval($_REQUEST['elementPositionX']), floatval($_REQUEST['elementPositionY']));
			if(isset($_REQUEST['elementScale'])){
				$_SESSION['selected_element']->setScale(floatval($_REQUEST['elementScale']));
			}
		}

		$_SESSION['selected_element'] = $_SESSION['selected_view']->getElementById($_REQUEST['selectedMapElementChanged']);

		require_once($rep.$views['editMap']);
	}

	private function ChangeMap()
	{
		global $rep, $views;

		$panorama = $_SESSION['panorama'];
		move_uploaded_file($_FILES['map']['tmp_name'], "./.datas/". $panorama->getId() ."/". $_FILES['map']['name']);
		$panorama->setMap(new Map($_FILES['map']['name']));

		require_once($rep . $views['dashboard']);
	}
	private function Generate($dVueErreur){
		global $rep, $views;

		$panorama = $_SESSION['panorama'];
		$fisrtView = $_REQUEST['firstView'];

		foreach($panorama->getTimelines() as $timeline){
			foreach($timeline->getViews() as $view){
				if(!$view->isDate()){
					$dVueErreur['date'] = "Add a date to every views on your timelines";
					require_once($rep . $views["dashboard"]);
				}
			}
		}

		GeneratorPanorama::createDirectory($panorama, $fisrtView);

		require_once($rep . $views['download']);
	}
	private function CreateTimeline()
	{
		global $rep, $views;

		$timelineName=Validation::val_texte($_POST['timelineName']);
		if (!isset($timelineName)) {
			$dVueEreur[]='error in timeline name';
			require_once($rep . $views['error']);
		}
		if(!isset($_SESSION['panorama']) or empty($_SESSION['panorama'])){
			$dVueEreur[]='projet inexistant';
			require_once($rep . $views['error']);
		}

		$_SESSION['panorama']->addTimeline(new Timeline($timelineName));

		require_once ($rep.$views['dashboard']);
	}

	private function ChangeTimeline()
	{
		global $rep, $views;

		if(!isset($_SESSION['panorama']) or empty($_SESSION['panorama'])){
			$dVueEreur[]='projet inexistant';
			require_once($rep . $views['error']);
		}

		$timeline = $_SESSION['panorama']->getTimelineById($_POST['changeTimeline']);

		if(!$timeline){
			$dVueEreur[]='timeline inexistante';
			require_once($rep . $views['error']);
		}

		if(!isset($_SESSION['selected_view']) or empty($_SESSION['selected_view'])){
			require_once($rep . $views['error']);
		}

		if(count($timeline->getViews()) >= 4){
			echo "<script>alert(\"Only four views can be added to a timeline ! \")</script>";
			require_once $rep.$views['editView'];
			return;
		}

		$timeline->addView($_SESSION['selected_view']);


		if($_SESSION['panorama']->isView($_SESSION['selected_view'])){
			$_SESSION['panorama']->removeView($_SESSION['selected_view']);
		}
		if(isset($_SESSION['selected_timeline'])){
			if($_SESSION['selected_timeline']->isView($_SESSION['selected_view'])){
				$_SESSION['selected_timeline']->removeView($_SESSION['selected_view']);
			}
		}

		$_SESSION['selected_timeline'] = $timeline;
		require_once ($rep.$views['editView']);
	}

	private function DeleteTimeline()
	{
		global $rep, $views;

		if(!isset($_SESSION['panorama']) or empty($_SESSION['panorama'])){
			$dVueEreur[]='projet inexistant';
			require_once($rep . $views['error']);
		}

		$_SESSION['panorama']->removeTimeline($_SESSION['panorama']->getTimelineById($_REQUEST['selected_timeline']));

		unset($_SESSION['selected_timeline']);

		require_once ($rep.$views['dashboard']);
	}

	private function EditTimeline(){
		global $rep, $views;

		if(!isset($_SESSION['panorama']) or empty($_SESSION['panorama'])){
			require_once($rep . $views['error']);
		}
		if(!isset($_POST['selected_timeline']) or empty($_POST['selected_timeline'])){
			require_once($rep . $views['error']);
		}

		$_SESSION['selected_timeline'] = $_SESSION['panorama']->getTimelineById($_POST['selected_timeline']);

		require_once ($rep.$views['editTimeline']);
	}

	private function EditTimelineView()
	{
		global $rep, $views;

		$selected_view = $_REQUEST['selected_view'];

		$_SESSION['selected_view'] = $_SESSION['selected_timeline']->getViewByPath($selected_view);

		if(!isset($_SESSION['selected_view']) or empty($_SESSION['selected_view']))
		{
			require_once $rep.$views['error'];
		}
		else{
			if(count($_SESSION['selected_view']->getElements()) > 0){
				$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
			}
			else{
				unset($_SESSION['selected_element']);
			}
			require_once ($rep.$views['editView']);
		}
	}

	private function ChangeDate()
	{
		global $rep, $views;

		if(!isset($_REQUEST['changedDate']))
		{
			require_once $rep.$views['error'];
			return;
		}

		$_SESSION['selected_view']->setDate($_REQUEST['changedDate']);

		require_once($rep.$views['editView']);
	}

	private function importJsonData(){
		global $rep, $views;

		require_once($rep . $views['import']);
	}

	private function loadDataFromJson(){
		global $rep, $views;

		$json = file_get_contents($_FILES['jsonFile']['tmp_name']);
		$data = json_decode($json, true);

		$panorama = GeneratorPanorama::loadFromFile($data);
		$_SESSION['panorama'] = &$panorama;
		
		require_once($rep . $views['dashboard']);
	}

	private function ChangeCameraRotation()
	{
		global $rep,$views;

		if(!isset($_SESSION['selected_view']))
		{
			require_once ($rep.$views['error']);
			return;
		}

		if(!isset($_REQUEST['camera_rotation_x']) or !isset($_REQUEST['camera_rotation_y']) or !isset($_REQUEST['camera_rotation_z']))
		{
			require_once ($rep.$views['error']);
			return;
		}

		$_SESSION['selected_view']->setCameraRotation(floatval($_REQUEST['camera_rotation_x']), floatval($_REQUEST['camera_rotation_y']), floatval($_REQUEST['camera_rotation_z']));

		require_once ($rep.$views['editView']);
	}

}//fin class

?>
