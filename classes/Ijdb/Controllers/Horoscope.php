<?php
namespace Ijdb\Controllers;

// use \Ninja\DatabaseTable;
// use \Ninja\Authentication;

class Horoscope
{
	// private $authentication;
	// private $authorsTable;
	// private $spartacusSettingsTable;
	// private $difficultyLevel;

	public function __construct()
	{
		// $this->authorsTable = $authorsTable;
		// $this->spartacusSettingsTable = $spartacusSettingsTable;
		// $this->authentication = $authentication;
	}

	public function render()
	{
		// $loggedIn = $this->authentication->isLoggedIn();
		
		// if($loggedIn){
		// 	$gladiator = $this->authentication->getUser();
		// 	$settings = $this->spartacusSettingsTable->findById($gladiator['id']);
		// }

		return [
		 'template' => 'horoscope.html.php',
		 'title' => 'Horoscope Generator'
		];
	}

	// public function saveSettings()
	// {
	// 	$gladiator = $this->authentication->getUser();
	// 	$loggedIn = $this->authentication->isLoggedIn();
	// 	// if (isset($_GET['id'])) {

	// 	$settings = [];
	// 	$settings = $_POST['settings'];
	// 	$_SESSION['difficultyLvl'] = $settings['difficultyLvl'];//setting session var for difficulty lvl because renderExercises will need this value even if not saving to DB.
	// 	// if the user is logged in save their selections for future use.
	// 	if ($loggedIn) {
	// 		$settings['id'] = (int)$gladiator['id'];
	// 		$settings['difficultyLvl'] = (int)$settings['difficultyLvl'];
	// 		$settings['lightWeight'] = (int)$settings['lightWeight'];
	// 		$settings['heavyWeight'] = (int)$settings['heavyWeight'];
	// 		$this->spartacusSettingsTable->save($settings);
	// 	}
	// 	header('location: /spartacus/exercise');
	// }

	// public function renderExercises()
	// {
	// 	return [
	// 	 'template' => 'spartacusexercise.html.php',
	// 	 'title' => 'Spartacus Workout',
	// 	 'variables' => [
	// 	  'difficultyLevel' => $_SESSION['difficultyLvl']
	// 	 ]
	// 	];
	// }
}