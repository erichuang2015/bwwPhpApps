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
            $_SESSION['userDatas'] = $userDatas;
            $_SESSION['exerciseTypes'] = $exerciseTypes ?? NULL;
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

    public function processUserRequest()
    {
        $exerciseId = (isset($_POST['exerciseId'])) ? (int)$_POST['exerciseId'] : -1;
        $recordId = (isset($_POST['recordId'])) ? (int)$_POST['recordId'] : NULL;
        $max = (isset($_POST['max'])) ? (double)$_POST['max'] : 0;


        if(isset($_POST['maxNotLogged'])){
            $maxNotLogged =  (double)$_POST['maxNotLogged'];
        }

        if (isset($_POST['newExerciseTxtInput'])){
            $newExerciseName = (string)$_POST['newExerciseTxtInput'];
            $this->saveNewExercise($newExerciseName);
        }
        else{
            $this->save1RM($exerciseId, $recordId, $max, $maxNotLogged);
        }
    }

    private function saveNewExercise($newExerciseName){
        $user = $this->authentication->getUser();
        $userId = (int)$user['id'];
        $newExerciseData = [];
        $newExerciseData['exercise_name'] = $newExerciseName;
        $newExerciseData['author_id'] = $userId;
        $this->exerciseTypesTable->save($newExerciseData);
        header('location: /pyramid');
    }

    private function save1RM($exerciseId, $recordId, $max, $maxNotLogged)
	{
		$user = $this->authentication->getUser();
        $loggedIn = $this->authentication->isLoggedIn();
        // print_r($_POST['exerciseId']);die;
		// if (isset($_GET['id'])) {
        $pyramidData = [];
		// if the user is logged in save their selections for future use.
		if ($loggedIn) {
            if($exerciseId == -1)
            {
                $error = "You did not select an exercise.  Please try again.";
                return ['template' => 'pyramid.html.php',
                    'title' => "Photo Gallery Upload - Error",
                    'variables' => [
                        'loggedIn' => $loggedIn,
                        'userDatas' => $_SESSION['userDatas'],
                        'exerciseTypes' => $_SESSION['exerciseTypes'],
                        'error' => $error
                    ],
                ];
            }


            $pyramidData['id'] = $recordId;
			$pyramidData['user_id'] = (int)$user['id'];
            $pyramidData['max'] = $max;
            $pyramidData['exercise_type'] = $exerciseId;
            $this->pyramidUserMaxTable->save($pyramidData);
            $_SESSION['max'] = $max;
            $theExercise = $this->exerciseTypesTable->findById($exerciseId);
            $_SESSION['exerciseName'] = $theExercise['exercise_name'];
        }
        else{
            $_SESSION['max'] = $maxNotLogged;
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