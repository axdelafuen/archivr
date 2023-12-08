<?php

class Controller
{
	public function __construct()
	{
		global $rep, $views;

		session_start();

		$errorList = array();

		try {
			$action = $_REQUEST['action'] ?? null;

			switch ($action) {
				case null:
					$this->goHome();
					break;
				case "goToLoadImages":
					$this->goToLoadImages();
					break;
				case "goToTutorial":
					$this->goToTutorial();
					break;
				case "viewsUploaded":
					$this->uploadViews();
					break;
				case "goBackToDashboard":
					$this->goBackToDashboard();
					break;
				case "goBackToDashboardFromMap":
					$this->goBackToDashboardFromMap();
					break;
				case "editView":
					$this->editView();
					break;
				case "updateProjectName":
					$this->updateProjectName();
					break;
				case "deleteView":
					$this->deleteView();
					break;
				case "editMap":
					$this->editMap();
					break;
				case "changeMap":
					$this->changeMap();
					break;
				case "addSign":
					$this->addSign();
					break;
				case "generate":
					$this->generate();
					break;
				case "deleteElement":
					$this->deleteViewElement();
					break;
				case "deleteMapElement":
					$this->deleteMapElement();
					break;
				case "selectedElementChanged":
					$this->selectedElementChanged();
					break;
				case "addWaypoint":
					$this->addViewWaypoint();
					break;
				case "addMapWaypoint":
					$this->addMapWaypoint();
					break;
				case "deleteMap":
					$this->deleteMap();
					break;
				case "selectedMapElementChanged":
					$this->selectedMapElementChanged();
					break;
				case "createTimeline":
					$this->createTimeline();
					break;
				case "changeTimeline":
					$this->changeTimeline();
					break;
				case "deleteTimeline":
					$this->deleteTimeline();
					break;
				case "editTimeline":
					$this->editTimeline();
					break;
				case "editTimelineView":
					$this->editTimelineView();
					break;
				case "changeDate":
					$this->changeDate();
					break;
				case "import":
					$this->importJsonData();
					break;
				case "loadJsonFile":
					$this->loadDataFromJson();
					break;
				case "changeCameraRotation":
					$this->changeCameraRotation();
					break;
				case "addAssetImported":
					$this->addAssetImported();
					break;
				default:
					$errorList[] = "This php action doesn't exist";
					require_once($rep . $views['error']);
					break;
			}
		} catch (PDOException $e) {
			$errorList[] = "A database error occurred";
			require_once($rep . $views['error']);

		} catch (Exception $e2) {
			$errorList[] = "An unexpected error occurred";
			require_once($rep . $views['error']);
		}
		exit(0);
	}

	private function goHome()
	{
		global $rep, $views;
		if (isset($_SESSION['panorama'])) {
			unset($_SESSION['panorama']);
		}
		require_once($rep . $views['home']);
	}

	private function goToLoadImages()
	{
		global $rep, $views;
		if (isset($_SESSION['panorama'])) {
			unset($_SESSION['panorama']);
		}
		require_once($rep . $views['upload']);
	}

	private function goToTutorial()
	{
		global $rep, $views;

		require_once($rep.$views['tutorial']);
	}

	private function goBackToDashboard()
	{
		global $rep, $views;

		if (isset($_SESSION['selected_element'])) {
			if (isset($_REQUEST['elementPositionX']) && isset($_REQUEST['elementPositionY']) && isset($_REQUEST['elementPositionZ'])) {
				$_SESSION['selected_element']->setPositionXYZ(floatval($_REQUEST['elementPositionX']), floatval($_REQUEST['elementPositionY']), floatval($_REQUEST['elementPositionZ']));
			}
            if (isset($_REQUEST['elementRotationX']) && isset($_REQUEST['elementRotationY']) && isset($_REQUEST['elementRotationZ'])) {
                $_SESSION['selected_element']->setRotationXYZ(floatval($_REQUEST['elementRotationX']), floatval($_REQUEST['elementRotationY']), floatval($_REQUEST['elementRotationZ']));
            }
			if (isset($_REQUEST['elementScale'])) {
				$_SESSION['selected_element']->setScale(floatval($_REQUEST['elementScale']));
			}
		}

		if (isset($_SESSION['selected_view'])) {
			unset($_SESSION['selected_view']);
		}
		if (isset($_SESSION['selected_timeline'])) {
			unset($_SESSION['selected_timeline']);
		}

		require_once ($rep.$views['dashboard']);
	}

	private function goBackToDashboardFromMap()
	{
		global $rep, $views;

		if (isset($_SESSION['selected_element'])) {
			$_SESSION['selected_element']->setPositionXY(floatval($_REQUEST['elementPositionX']), floatval($_REQUEST['elementPositionY']));
			if (isset($_REQUEST['elementScale'])) {
				$_SESSION['selected_element']->setScale(floatval($_REQUEST['elementScale']));
			}
		}

		unset($_SESSION['selected_view']);

		require_once ($rep.$views['dashboard']);
	}

	private function uploadViews()
	{
		global $rep, $views, $errorList;
		if (!file_exists("./.datas")) {
			mkdir("./.datas");
		}

		if (isset($_SESSION['panorama'])) {
			$panorama = $_SESSION['panorama'];
			unset($_SESSION['panorama']);
		} else{
			$projectName=Validation::valTexte($_POST['projectName']);
			if (!isset($projectName)) {
				$errorList[]='nom de projet invalide';
				require_once($rep . $views['error']);
                return;
			} else {
				$panorama = new Panorama($projectName);
			}

			if (!file_exists("./.datas/".$panorama->getId())) {
				mkdir("./.datas/".$panorama->getId());
			}

			if (!empty($_FILES['map']['name'])) {
				move_uploaded_file($_FILES['map']['tmp_name'], "./.datas/".$panorama->getId()."/". $_FILES['map']['name']);
				$panorama->setMap(new Map($_FILES['map']['name']));
			}
		}

		$currentAmountViews = count($panorama->getViews());

		for ($i = 0; $i < count($_FILES['views']['name']); $i++) {
			move_uploaded_file($_FILES['views']['tmp_name'][$i], "./.datas/". $panorama->getId()."/". $_FILES['views']['name'][$i]);
			$panorama->addView($i+$currentAmountViews, new View($_FILES['views']['name'][$i]));
		}

		$_SESSION['panorama'] = &$panorama;

		require_once($rep . $views['dashboard']);
	}

	private function editView()
	{
		global $rep, $views;

		$selectedView = $_REQUEST['selected_view'];

		$_SESSION['selected_view'] = $_SESSION['panorama']->getViewByPath($selectedView);

		if (!isset($_SESSION['selected_view']) || empty($_SESSION['selected_view'])) {
			require_once $rep.$views['error'];
		} else {
			if (count($_SESSION['selected_view']->getElements()) > 0) {
				$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
			} else {
				unset($_SESSION['selected_element']);
			}
			require_once ($rep.$views['editView']);
		}
	}

	private function updateProjectName()
	{
		global $rep, $views, $errorList;

		$projectName=Validation::valTexte($_POST['projectName']);

		if (!isset($projectName)) {
			$errorList[]='nom de projet invalide';
			require_once($rep . $views['error']);
		} else {
			$_SESSION['panorama']->setName($projectName);
			require_once ($rep.$views['dashboard']);
		}
	}

	private function deleteView()
	{
		global $rep, $views;

		if (isset($_SESSION['selected_timeline'])) {
			$_SESSION['selected_timeline']->removeView($_SESSION['selected_view']);
		} else {
			$_SESSION['panorama']->removeView($_SESSION['selected_view']);
		}

		unset($_SESSION['selected_view']);

		require_once($rep . $views['dashboard']);
	}

	private function deleteMap()
	{
		global $rep, $views;

		$_SESSION['panorama']->removeMap();

		unset($_SESSION['selected_view']);

		require_once($rep . $views['dashboard']);
	}

	private function editMap()
    {
		global $rep, $views;

		$selectedView = $_REQUEST['selected_view'];

		if ($selectedView == $_SESSION['panorama']->getMap()->getPath()) {
			$_SESSION['selected_view'] = $_SESSION['panorama']->getMap();
			if (count($_SESSION['selected_view']->getElements()) > 0) {
				$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
			} else {
				unset($_SESSION['selected_element']);
			}
			require_once ($rep.$views['editMap']);
		} else {
			require_once $rep.$views['error'];
		}
	}

	private function addSign()
	{
		global $rep, $views;

		$_SESSION['selected_view']->addElement(new Sign($_REQUEST['signContent']));

		if (isset($_SESSION['selected_element'])) {
			$_SESSION['selected_element']->setPositionXYZ(floatval($_REQUEST['elementPositionX']), floatval($_REQUEST['elementPositionY']), floatval($_REQUEST['elementPositionZ']));
			$_SESSION['selected_element']->setRotationXYZ(floatval($_REQUEST['elementRotationX']), floatval($_REQUEST['elementRotationY']), floatval($_REQUEST['elementRotationZ']));
			if (isset($_REQUEST['elementScale'])) {
				$_SESSION['selected_element']->setScale(floatval($_REQUEST['elementScale']));
			}
		}

		if (count($_SESSION['selected_view']->getElements()) > 0) {
			$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
		} else {
			unset($_SESSION['selected_element']);
		}

		require_once ($rep.$views['editView']);
	}

	private function addWaypoint()
	{
		global $rep,$views;

		if (!isset($_REQUEST['destinationView'])) {
			require_once $rep.$views['error'];
		}

		if ($_SESSION['panorama']->getViewByPath($_REQUEST['destinationView'])) {
			$_SESSION['selected_view']->addElement(new Waypoint($_SESSION['panorama']->getViewByPath($_REQUEST['destinationView'])));
		} elseif ($_SESSION['panorama']->getTimelineById($_REQUEST['destinationView'])) {
			$_SESSION['selected_view']->addElement(new Waypoint($_SESSION['panorama']->getTimelineById($_REQUEST['destinationView'])));
		} else {
			require_once $rep.$views['error'];
		}

		if (isset($_SESSION['selected_element'])) {
			$_SESSION['selected_element']->setPositionXYZ(floatval($_REQUEST['elementPositionX']), floatval($_REQUEST['elementPositionY']),floatval($_REQUEST['elementPositionZ']));
			$_SESSION['selected_element']->setRotationXYZ(floatval($_REQUEST['elementRotationX']), floatval($_REQUEST['elementRotationY']),floatval($_REQUEST['elementRotationZ']));
			if (isset($_REQUEST['elementScale'])) {
				$_SESSION['selected_element']->setScale(floatval($_REQUEST['elementScale']));
			}
		}

		if (count($_SESSION['selected_view']->getElements()) > 0) {
			$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
		} else {
			unset($_SESSION['selected_element']);
		}
	}

	private function addViewWaypoint()
	{
		global $rep,$views;
		$this->AddWaypoint();
		require_once ($rep.$views['editView']);
	}

	private function addMapWaypoint()
	{
		global $rep,$views;
		$this->AddWaypoint();
		require_once ($rep.$views['editMap']);
	}

	private function deleteViewElement()
	{
		global $rep, $views;

		$elementId = $_REQUEST['selected_element'];

		if (!isset($elementId) || empty($elementId)) {
			require_once ($rep.$views['error']);
		} else {
			$element = $_SESSION['selected_view']->getElementById($elementId);
			if ($element != null) {
				$_SESSION['selected_view']->removeElement($element);
				if (count($_SESSION['selected_view']->getElements()) > 0) {
					$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
				} else {
					unset($_SESSION['selected_element']);
				}
				require_once($rep.$views['editView']);
			} else {
				require_once ($rep.$views['error']);
			}
		}
	}

	private function deleteMapElement()
	{
		global $rep, $views;

		$elementId = $_REQUEST['selected_element'];

		if (!isset($elementId) || empty($elementId)) {
			require_once ($rep.$views['error']);
		} else {
			$element = $_SESSION['selected_view']->getElementById($elementId);
			if ($element != null) {
				$_SESSION['selected_view']->removeElement($element);
				if (count($_SESSION['selected_view']->getElements()) > 0) {
					$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
				} else {
					unset($_SESSION['selected_element']);
				}
				require_once($rep.$views['editMap']);
			} else {
				require_once ($rep.$views['error']);
			}
		}
	}

	private function selectedElementChanged()
	{
		global $rep, $views;

		if (isset($_SESSION['selected_element'])) {
			$_SESSION['selected_element']->setPositionXYZ(floatval($_REQUEST['elementPositionX']), floatval($_REQUEST['elementPositionY']),floatval($_REQUEST['elementPositionZ']));
			$_SESSION['selected_element']->setRotationXYZ(floatval($_REQUEST['elementRotationX']), floatval($_REQUEST['elementRotationY']),floatval($_REQUEST['elementRotationZ']));
			if (isset($_REQUEST['elementScale'])) {
				$_SESSION['selected_element']->setScale(floatval($_REQUEST['elementScale']));
			}
		}

		$_SESSION['selected_element'] = $_SESSION['selected_view']->getElementById($_REQUEST['selectedElementChanged']);

		require_once($rep.$views['editView']);
	}

	private function selectedMapElementChanged()
	{
		global $rep, $views;

		if (isset($_SESSION['selected_element'])) {
			$_SESSION['selected_element']->setPositionXY(floatval($_REQUEST['elementPositionX']), floatval($_REQUEST['elementPositionY']));
			if (isset($_REQUEST['elementScale'])) {
				$_SESSION['selected_element']->setScale(floatval($_REQUEST['elementScale']));
			}
		}

		$_SESSION['selected_element'] = $_SESSION['selected_view']->getElementById($_REQUEST['selectedMapElementChanged']);

		require_once($rep.$views['editMap']);
	}

	private function changeMap()
	{
		global $rep, $views;

		$panorama = $_SESSION['panorama'];
		move_uploaded_file($_FILES['map']['tmp_name'], "./.datas/". $panorama->getId() ."/". $_FILES['map']['name']);
		$panorama->setMap(new Map($_FILES['map']['name']));

		require_once($rep . $views['dashboard']);
	}
	private function generate()
	{
		global $rep, $views, $errorList;

		$panorama = $_SESSION['panorama'];
		$firstView = $_REQUEST['firstView'];

		foreach ($panorama->getTimelines() as $timeline) {
			foreach ($timeline->getViews() as $view) {
				if (!$view->isDate()) {
					$errorList[] = "Add a date to every views on your timelines";
					require_once($rep . $views["dashboard"]);
				}
			}
		}
		GeneratorPanorama::createDirectory($panorama, $firstView);

		require_once($rep . $views['download']);
	}
	private function createTimeline()
	{
		global $rep, $views, $errorList;

		$timelineName=Validation::valTexte($_POST['timelineName']);

		if (!isset($timelineName)) {
			$errorList[]='error in timeline name';
			require_once($rep . $views['error']);
		}

		if (!isset($_SESSION['panorama']) || empty($_SESSION['panorama'])) {
			$errorList[]='projet inexistant';
			require_once($rep . $views['error']);
		}

		$_SESSION['panorama']->addTimeline(new Timeline($timelineName));

		require_once ($rep.$views['dashboard']);
	}

	private function changeTimeline()
	{
		global $rep, $views, $errorList;

		if (!isset($_SESSION['panorama']) || empty($_SESSION['panorama'])) {
			$errorList[]='projet inexistant';
			require_once($rep . $views['error']);
		}

		$timeline = $_SESSION['panorama']->getTimelineById($_POST['changeTimeline']);

		if (!$timeline) {
			$errorList[]='timeline inexistante';
			require_once($rep . $views['error']);
		}

		if (!isset($_SESSION['selected_view']) || empty($_SESSION['selected_view'])) {
			require_once($rep . $views['error']);
		}

		if (count($timeline->getViews()) >= 4) {
			echo "<script>alert(\"Only four views can be added to a timeline ! \")</script>";
			require_once $rep.$views['editView'];
			return;
		}

		$timeline->addView($_SESSION['selected_view']);


		if ($_SESSION['panorama']->isView($_SESSION['selected_view'])) {
			$_SESSION['panorama']->removeView($_SESSION['selected_view']);
		}
		if (isset($_SESSION['selected_timeline']) && $_SESSION['selected_timeline']->isView($_SESSION['selected_view'])) {
            $_SESSION['selected_timeline']->removeView($_SESSION['selected_view']);
		}

		$_SESSION['selected_timeline'] = $timeline;
		require_once ($rep.$views['editView']);
	}

	private function deleteTimeline()
	{
		global $rep, $views, $errorList;

		if (!isset($_SESSION['panorama']) || empty($_SESSION['panorama'])) {
			$errorList[]='projet inexistant';
			require_once($rep . $views['error']);
		}

		$_SESSION['panorama']->removeTimeline($_SESSION['panorama']->getTimelineById($_REQUEST['selected_timeline']));

		unset($_SESSION['selected_timeline']);

		require_once ($rep.$views['dashboard']);
	}

	private function editTimeline(){
		global $rep, $views;

		if (!isset($_SESSION['panorama']) || empty($_SESSION['panorama'])) {
			require_once($rep . $views['error']);
		}
		if (!isset($_POST['selected_timeline']) || empty($_POST['selected_timeline'])) {
			require_once($rep . $views['error']);
		}

		$_SESSION['selected_timeline'] = $_SESSION['panorama']->getTimelineById($_POST['selected_timeline']);

		require_once ($rep.$views['editTimeline']);
	}

	private function editTimelineView()
	{
		global $rep, $views;

		$selectedView = $_REQUEST['selected_view'];

		$_SESSION['selected_view'] = $_SESSION['selected_timeline']->getViewByPath($selectedView);

		if (!isset($_SESSION['selected_view']) || empty($_SESSION['selected_view'])) {
			require_once $rep.$views['error'];
		} else {
			if (count($_SESSION['selected_view']->getElements()) > 0) {
				$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
			} else {
				unset($_SESSION['selected_element']);
			}
			require_once ($rep.$views['editView']);
		}
	}

	private function changeDate()
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

	private function importJsonData()
	{
		global $rep, $views;

		require_once($rep . $views['import']);
	}

	private function loadDataFromJson()
	{
		global $rep, $views;

		$json = file_get_contents($_FILES['jsonFile']['tmp_name']);
		$data = json_decode($json, true);

		$panorama = GeneratorPanorama::loadFromFile($data);
		$_SESSION['panorama'] = &$panorama;
		
		require_once($rep . $views['dashboard']);
	}

	private function changeCameraRotation()
	{
		global $rep,$views;

		if (!isset($_SESSION['selected_view'])) {
			require_once ($rep.$views['error']);
			return;
		}

		if (!isset($_REQUEST['camera_rotation_x']) || !isset($_REQUEST['camera_rotation_y']) || !isset($_REQUEST['camera_rotation_z'])) {
			require_once ($rep.$views['error']);
			return;
		}

		$_SESSION['selected_view']->setCameraRotation(floatval($_REQUEST['camera_rotation_x']), floatval($_REQUEST['camera_rotation_y']), floatval($_REQUEST['camera_rotation_z']));

		require_once ($rep.$views['editView']);
	}

	private function addAssetImported()
	{
		global $rep, $views, $errorList;

		if (!file_exists("./.datas")) {
			mkdir("./.datas");
		}
		if (!isset($_SESSION['panorama']) || !isset($_SESSION['selected_view'])) {
			$errorList[] = "Session expired";
			require_once $rep . $views['error'];
			return;
		}

		if (!empty($_FILES['assetImported']['name'])) {
			$fileName = $_FILES['assetImported']['name'];
			if (!move_uploaded_file($_FILES['assetImported']['tmp_name'], "./.datas/" . $_SESSION['panorama']->getId() . "/" . $fileName)) {
				$errorList[] = "file cannot be uploaded";
				$errorList[] = $fileName;
				$errorList[] = $_FILES['assetImported']['error'];
				require_once $rep.$views['error'];
				return;
			}
			if (strtolower(substr(strrchr($fileName, "."), 1)) == "zip") {
				$zip = new ZipArchive;
				$res = $zip->open("./.datas/" . $_SESSION['panorama']->getId() . "/" . $fileName);
				if ($res === true) {
					$zip->extractTo("./.datas/" . $_SESSION['panorama']->getId() . "/" . explode(".", $fileName)[0] . "/");
					$zip->close();
				} else {
					$errorList[] = "unzip error";
					require_once $rep.$views['error'];
					return;
				}
				$modelFileName = "";
				foreach (scandir("./.datas/" . $_SESSION['panorama']->getId() . "/" . explode(".", $fileName)[0]) as $file) {
					if (strtolower(substr(strrchr($file, "."), 1)) == "gltf") {
						$modelFileName = $file;
					}
				}
				if ($modelFileName == "") {
					$errorList[] = "no gtlf file in your zip";
					require_once $rep.$views['error'];
					return;
				}
				$_SESSION['selected_view']->addElement(new AssetImported(explode('.', $fileName)[0], $modelFileName));
				unlink("./.datas/" . $_SESSION['panorama']->getId() . "/" . $fileName);
			} elseif (strtolower(substr(strrchr($_FILES['assetImported']['name'], "."), 1)) == "gltf") {
				$_SESSION['selected_view']->addElement(new AssetImported(explode(".", $_FILES['assetImported']['name'])[0], $_FILES['assetImported']['name']));
			} else {
				$errorList[] = "Bad file extension";
				require_once $rep.$views['error'];
				return;
			}
		} else {
			$errorList[] = "File not found";
			require_once $rep.$views['error'];
			return;
		}

		if (count($_SESSION['selected_view']->getElements()) > 0) {
			$_SESSION['selected_element'] = $_SESSION['selected_view']->getElements()[0];
		} else {
			unset($_SESSION['selected_element']);
		}

		require_once $rep.$views['editView'];
	}

}
