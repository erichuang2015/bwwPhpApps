<?php
namespace Ijdb\Controllers;

use \Ninja\DatabaseTable;
use \Ninja\Authentication;

class Pyramid
{
    private $authentication;
	private $usersTable;
    private $pyramidUserMaxTable;
    
	public function __construct(DatabaseTable $usersTable, DatabaseTable $pyramidUserMaxTable, Authentication $authentication)
	{
        $this->usersTable = $usersTable;
		$this->pyramidUserMaxTable = $pyramidUserMaxTable;
		$this->authentication = $authentication;
	}

	public function render()
	{
        $loggedIn = $this->authentication->isLoggedIn();
        $userData = [];
        if($loggedIn){
			$user = $this->authentication->getUser();
            $userData = $this->pyramidUserMaxTable->findById($user['id']);
            return [
                'template' => 'pyramid.html.php',
                'title' => 'Pyramid Workout',
                'variables' => [
                   'max' => (double)$userData["max"] ?? NULL
                  ]
               ];
		}
        return [
		 'template' => 'pyramid.html.php',
         'title' => 'Pyramid Workout',
         'variables' => [
            'max' => 10
           ]
		];
    }
    
    public function save1RM()
	{
		$user = $this->authentication->getUser();
		$loggedIn = $this->authentication->isLoggedIn();
		// if (isset($_GET['id'])) {
        $pyramidData = [];
		// if the user is logged in save their selections for future use.
		if ($loggedIn) {
			$pyramidData ['id'] = (int)$user['id'];
			$pyramidData ['max'] = (double)$_POST['max'];
			$this->pyramidUserMaxTable->save($pyramidData);
		}
        $_SESSION['max'] = (double)$_POST['max'];
        header('location: /pyramid/table');
    }

    public function renderExercises()
	{
        $max = $_SESSION['max'];
        $fiftyFivePercent = 0.55;
        $sixtyFivePercent = 0.65;
        $seventyFivePercent = 0.75;
        $eightyFivePercent = 0.85;
        $eightyEightInHalfPercent = 0.885;
        $ninetyTwoInHalfPercent = 0.925;

        $tenReps = round($max * $fiftyFivePercent, 2);
        $eightReps = round($max * $sixtyFivePercent, 2);
        $sixReps = round($max * $seventyFivePercent, 2);
        $fourReps = round($max * $eightyFivePercent, 2);
        $threeReps = round($max * $eightyEightInHalfPercent, 2);
        $twoReps = round($max * $ninetyTwoInHalfPercent, 2);

        return [
            'template' => 'pyramidtable.html.php',
            'title' => 'Pyramid Workout Table',
            'variables' => [
             'tenReps' => $tenReps,
             'eightReps' => $eightReps,
             'sixReps' => $sixReps,
             'fourReps' => $fourReps,
             'threeReps' => $threeReps,
             'twoReps' => $twoReps
            ]
           ];
	}
}