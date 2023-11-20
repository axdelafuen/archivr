<?php
include("./models/Generator.php");
class Controller
{
	function __construct()
	{
		global $rep, $views; // nécessaire pour utiliser variables globales

		// on démarre ou reprend la session si necessaire (préférez utiliser un modèle pour gérer vos session ou cookies)
		session_start();

		//on initialise un tableau d'erreur
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
					$this->Generate();
					break;
				case "deleteElement":
					$this->DeleteElement();
					break;
				case "selectedElementChanged":
					$this->SelectedElementChanged();
					break;
				case "addWaypoint":
					$this->AddWaypoint();
					break;
				case "addMapWaypoint":
					$this->AddMapWaypoint();
					break;

				//mauvaise action
				default:
					$dVueEreur[] = "This php action doesn't exist";
					require($rep . $views['error']);
					break;
			}
		} catch (PDOException $e) {
			//si erreur BD, pas le cas ici
			$dVueEreur[] = "A database error occurred";
			require($rep . $views['erreur']);

		} catch (Exception $e2) {
			$dVueEreur[] = "An unexpected error occurred";
			require($rep . $views['erreur']);
		}
		//fin
		exit(0);
	}//fin constructeur

	function Reinit()
	{
		global $rep, $views; // nécessaire pour utiliser variables globales
		if(isset($_SESSION['panorama'])){
			unset($_SESSION['panorama']);
		}
		require($rep . $views['home']);
	}

	function GoToLoadImages(array $dVueEreur)
	{
		global $rep, $views;
		if(isset($_SESSION['panorama'])){
			unset($_SESSION['panorama']);
		}
		require($rep . $views['upload']);
	}

	function GoBackToDashboard()
	{
		global $rep, $views;

		if(isset($_REQUEST['selected_element'])){
			$_SESSION['selected_element']->setPositionXYZ(floatval($_REQUEST['elementPositionX']), floatval($_REQUEST['elementPositionY']),floatval($_REQUEST['elementPositionZ']));
		}

		unset($_SESSION['selected_view']);

		require ($rep.$views['dashboard']);
	}

	function UploadViews(array $dVueEreur)
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
				require($rep . $views['erreur']);
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

		require($rep . $views['dashboard']);
	}

	function EditView()
	{
		global $rep, $views;

		$selected_view = $_REQUEST['selected_view'];

		//unset($_SESSION['selected_view']);

		$_SESSION['selected_view'] = $_SESSION['panorama']->getViewByPath($selected_view);

		if(!isset($_SESSION['selected_view']) or empty($_SESSION['selected_view']))
		{
			require $rep.$views['error'];
		}
		else{
			if(count($_SESSION['selected_view']->getElements()) > 0){
				$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
			}
			else{
				unset($_SESSION['selected_element']);
			}
			require ($rep.$views['editView']);
		}
	}

	function UpdateProjectName($dVueEreur)
	{
		global $rep, $views;

		$projectName=Validation::val_texte($_POST['projectName']);

		if (!isset($projectName)) {
			$dVueEreur[]='nom de projet invalide';
			require($rep . $views['erreur']);
		}
		else{
			$_SESSION['panorama']->setName($projectName);
			require ($rep.$views['dashboard']);
		}

	}

	function DeleteView(){
		global $rep, $views;

		if(count($_SESSION['panorama']->getViews()) <= 1){
			echo "<script>alert(\"Upload at least two images, to delete one.\")</script>";
			require ($rep.$views['editView']);
		}
		else {

			$_SESSION['panorama']->removeView($_SESSION['selected_view']);

			unset($_SESSION['selected_view']);

			require($rep . $views['dashboard']);
		}
	}

	function EditMap(){
		global $rep, $views;

		$selected_view = $_REQUEST['selected_view'];

		//unset($_SESSION['selected_view']);

		if($selected_view == $_SESSION['panorama']->getMap()->getPath())
		{
			$_SESSION['selected_view'] = $_SESSION['panorama']->getMap();
			require ($rep.$views['editMap']);
		}
		else{
			require $rep.$views['error'];
		}
	}

	function AddSign()
	{
		global $rep, $views;

		$_SESSION['selected_view']->addElement(new Sign($_REQUEST['signContent']));

		if(count($_SESSION['selected_view']->getElements()) > 0){
			$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
		}
		else{
			unset($_SESSION['selected_element']);
		}

		require ($rep.$views['editView']);
	}

	function AddWaypoint()
	{
		global $rep,$views;

		$_SESSION['selected_view']->addElement(new Waypoint($_SESSION['panorama']->getViewByPath($_REQUEST['destinationView'])));

		if(count($_SESSION['selected_view']->getElements()) > 0){
			$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
		}
		else{
			unset($_SESSION['selected_element']);
		}

		//echo $_REQUEST['destinationView'];
		require ($rep.$views['editView']);
	}

	function DeleteElement()
	{
		global $rep, $views;

		$elementId = $_REQUEST['selected_element'];

		if(!isset($elementId) or empty($elementId)){
			require ($rep.$views['error']);
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
				require($rep.$views['editView']);
			}
			else{
				require ($rep.$views['error']);
			}
		}
	}

	function SelectedElementChanged()
	{
		global $rep, $views;

		$_SESSION['selected_element'] = $_SESSION['selected_view']->getElementById($_REQUEST['selectedElementChanged']);

		require($rep.$views['editView']);
	}

	function AddMapWaypoint()
	{
		global $rep,$views;

		$_SESSION['selected_view']->addElement(new Waypoint($_SESSION['panorama']->getViewByPath($_REQUEST['destinationView'])));
		//echo $_REQUEST['destinationView'];
		require ($rep.$views['editMap']);
	}

	function ChangeMap()
	{
		global $rep, $views;

		$panorama = $_SESSION['panorama'];
		move_uploaded_file($_FILES['map']['tmp_name'], "./.datas/". $panorama->getId() ."/". $_FILES['map']['name']);
		$panorama->setMap(new Map($_FILES['map']['name']));

		require($rep . $views['dashboard']);
	}

	function Generate(){
		global $rep, $views;

		$panorama = $_SESSION['panorama'];
		$fisrtView = $_REQUEST['firstView'];

		GeneratorPanorama::createDirectory($panorama, $fisrtView);

		require($rep . $views['download']);
	}

}//fin class

?>
