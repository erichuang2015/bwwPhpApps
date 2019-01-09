<?php
namespace BwwClasses\Controllers;

use \utilityClasses\DatabaseTable;
use \utilityClasses\Authentication;

class Pyramid
{
    private $authentication;
	private $usersTable;
    private $pyramidUserMaxTable;
    private $exerciseTypesTable;

	public function __construct(DatabaseTable $usersTable, DatabaseTable $pyramidUserMaxTable, DatabaseTable $exerciseTypesTable, Authentication $authentication)
	{
        $this->usersTable = $usersTable;
        $this->pyramidUserMaxTable = $pyramidUserMaxTable;
        $this->exerciseTypesTable = $exerciseTypesTable;
		$this->authentication = $authentication;
	}

	public function render()
	{
        $loggedIn = $this->authentication->isLoggedIn();
        $userDatas = [];
        if($loggedIn){
			$user = $this->authentication->getUser();
            $userDatas = $this->pyramidUserMaxTable->find('user_id', $user['id']);
            $exerciseTypes = [];
            $exercises = $this->exerciseTypesTable->findAll(); // get all exercise types
            // print_r($exercises);die;
            foreach ($exercises as $exercise) {
                // print_r($exercise['author_id']);die;
                if($user['id'] != $exercise['author_id'] && $exercise['author_id'] != 0)
                {
                    // print_r("Continuing");
                    continue;
                }
                // print_r("inserting exercise data");die;
                $exerciseTypes[] = [
                    'id' => (int)$exercise['id'],
                    'exerciseName' => (string)$exercise['exercise_name']
                ];
            }
            return [
                'template' => 'pyramid.html.php',
                'title' => 'Pyramid Workout',
                'variables' => [
                    'loggedIn' => $loggedIn,
                    'userDatas' => $userDatas,
                    'exerciseTypes' => $exerciseTypes ?? NULL
                  ]
               ];
		}
        return [
		 'template' => 'pyramid.html.php',
         'title' => 'Pyramid Workout',
         'variables' => [
            'loggedIn' => $loggedIn,
            'max' => 100
           ]
		];
    }

    public function save1RM()
	{
		$user = $this->authentication->getUser();
        $loggedIn = $this->authentication->isLoggedIn();
        // print_r($_POST['recordId']);die;
		// if (isset($_GET['id'])) {
        $pyramidData = [];
		// if the user is logged in save their selections for future use.
		if ($loggedIn) {
            $pyramidData['id'] = (int)$_POST['recordId'] ?? NULL;
			$pyramidData['user_id'] = (int)$user['id'];
            $pyramidData['max'] = (double)$_POST['max'];
            $pyramidData['exercise_type'] = (int)$_POST['exerciseId'];
            $this->pyramidUserMaxTable->save($pyramidData);
            $_SESSION['max'] = (double)$_POST['max'];
            $theExercise = $this->exerciseTypesTable->findById((int)$_POST['exerciseId']);
            $_SESSION['exerciseName'] = $theExercise['exercise_name'];
        }
        else{
            $_SESSION['max'] = (double)$_POST['maxNotLogged'];
        }
        header('location: /pyramid/table');
    }

    public function renderExercises()
	{
        $loggedIn = $this->authentication->isLoggedIn();
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
             'twoReps' => $twoReps,
             'exerciseName' => $_SESSION['exerciseName'] ?? NULL
            ]
           ];
	}
}