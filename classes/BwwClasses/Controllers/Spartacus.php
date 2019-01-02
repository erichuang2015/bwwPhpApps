<?php
namespace BwwClasses\Controllers;

use \utilityClasses\DatabaseTable;
use \utilityClasses\Authentication;

class Spartacus
{
	private $authentication;
	private $usersTable;
	private $spartacusSettingsTable;

	public function __construct(DatabaseTable $usersTable, DatabaseTable $spartacusSettingsTable, Authentication $authentication)
	{
		$this->usersTable = $usersTable;
		$this->spartacusSettingsTable = $spartacusSettingsTable;
		$this->authentication = $authentication;
	}

	public function render()
	{
		$loggedIn = $this->authentication->isLoggedIn();
		
		if($loggedIn){
			$gladiator = $this->authentication->getUser();
			$settings = $this->spartacusSettingsTable->findById($gladiator['id']);
		}
		// print_r($settings['difficultyLvl']); die;
		return [
		 'template' => 'spartacus.html.php',
		 'title' => 'Spartacus Workout',
		 'variables' => [
		  'loggedIn' => $loggedIn,
		  'settings' => $settings ?? null
		 ]
		];
	}

	public function saveSettings()
	{
		$gladiator = $this->authentication->getUser();
		$loggedIn = $this->authentication->isLoggedIn();

		$settings = [];
		$settings = $_POST['settings'];
		$_SESSION['difficultyLvl'] = $settings['difficultyLvl'];//setting session var for difficulty lvl because renderExercises will need this value even if not saving to DB.
		// if the user is logged in save their selections for future use.
		if ($loggedIn) {
			$settings['id'] = (int)$gladiator['id'];
			$settings['difficultyLvl'] = (int)$settings['difficultyLvl'];
			$settings['lightWeight'] = (int)$settings['lightWeight'];
			$settings['heavyWeight'] = (int)$settings['heavyWeight'];
			$this->spartacusSettingsTable->save($settings);
		}
		header('location: /spartacus/exercise');
	}

	public function renderExercises()
	{
		// print_r($_SESSION['difficultyLvl']); die;
		return [
		 'template' => 'spartacusexercise.html.php',
		 'title' => 'Spartacus Workout',
		 'variables' => [
		  'difficultyLevel' => $_SESSION['difficultyLvl']
		 ]
		];
	}
}