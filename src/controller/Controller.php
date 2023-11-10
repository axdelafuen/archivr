<?php

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
			$action = $_REQUEST['action'];

			switch ($action) {
				//pas d'action, on r�initialise 1er appel
				case NULL:
					$this->Reinit();
					break;

				case "goToLoadImages":
					$this->GoToLoadImages($dVueEreur);
					break;

				case "viewsUploaded":
					$this->UploadViews();
					break;

				case "goBackToDashboard":
					require ($rep.$views['dashboard']);
					break;

				case "previewView":
					$this->StartPreview();
					break;

				case "changeMap":
					$this->ChangeMap();
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

	function UploadViews()
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
			$panorama = new Panorama();
			move_uploaded_file($_FILES['map']['tmp_name'], "./.datas/" . $_FILES['map']['name']);
			$panorama->setMap(new Map($_FILES['map']['name']));
		}

		$currentAmountViews = count($panorama->getViews());

		for($i = 0; $i < count($_FILES['views']['name']); $i++){
			move_uploaded_file($_FILES['views']['tmp_name'][$i], "./.datas/" . $_FILES['views']['name'][$i]);
			$panorama->addView($i+$currentAmountViews, new View($_FILES['views']['name'][$i]));
		}

		$_SESSION['panorama'] = $panorama;

		require($rep . $views['dashboard']);
	}

	function StartPreview()
	{
		global $rep, $views;

		$_SESSION['selected_view'] = $_REQUEST['selected_view'];

		require ($rep.$views['preview']);
	}

	function ChangeMap()
	{
		global $rep, $views;

		$panorama = $_SESSION['panorama'];
		move_uploaded_file($_FILES['map']['tmp_name'], "./.datas/" . $_FILES['map']['name']);
		$panorama->setMap(new Map($_FILES['map']['name']));

		require($rep . $views['dashboard']);
	}

}//fin class

?>
