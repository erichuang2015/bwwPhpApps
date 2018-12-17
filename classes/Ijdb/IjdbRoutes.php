<?php
namespace Ijdb;

class IjdbRoutes implements \Ninja\Routes
{
	private $jokesTable;
	private $authorsTable;
	private $spartacusSettingsTable;
	private $pyramidUserMaxTable;
	private $photosTable;
	private $authentication;

	public function __construct()
	{
		include __DIR__ . '/../../includes/DatabaseConnection.php';

		$this->jokesTable = new \Ninja\DatabaseTable($pdo, 'joke', 'id');
		$this->authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id');
		$this->spartacusSettingsTable = new \Ninja\DatabaseTable($pdo, 'spartacus_setting', 'id');
		$this->pyramidUserMaxTable = new \Ninja\DatabaseTable($pdo, 'pyramid_user_max', 'id');
		$this->photosTable = new \Ninja\DatabaseTable($pdo, 'photo', 'id');
		$this->authentication = new \Ninja\Authentication($this->authorsTable, 'email', 'password');
	}

	public function getRoutes() : array
	{
		$jokeController = new \Ijdb\Controllers\Joke($this->jokesTable, $this->authorsTable, $this->authentication);
		$authorController = new \Ijdb\Controllers\Register($this->authorsTable);
		$loginController = new \Ijdb\Controllers\Login($this->authentication);
		$spartacusController = new \Ijdb\Controllers\Spartacus($this->authorsTable, $this->spartacusSettingsTable, $this->authentication);
		$horoscopeController = new \Ijdb\Controllers\Horoscope();
		$runSpeedCalculatorController = new \Ijdb\Controllers\RunSpeedCalculator();
		$fitnessCalculatorController = new \Ijdb\Controllers\FitnessCalculator();
		$distanceconverterController = new \Ijdb\Controllers\DistanceConverter();
		$pyramidController = new \Ijdb\Controllers\Pyramid($this->authorsTable, $this->pyramidUserMaxTable, $this->authentication);
		$photosController = new \Ijdb\Controllers\Photos($this->authorsTable, $this->photosTable, $this->authentication);
		$myaccountController = new \Ijdb\Controllers\MyAccount($this->authorsTable, $this->authentication);

		$routes = [
			'author/register' => [
				'GET' => [
					'controller' => $authorController,
					'action' => 'registrationForm' //the action is the function to call in the controller
				],
				'POST' => [
					'controller' => $authorController,
					'action' => 'registerUser'
				]
			],
			'author/success' => [
				'GET' => [
					'controller' => $authorController,
					'action' => 'success'
				]
			],
			'joke/edit' => [
				'POST' => [
					'controller' => $jokeController,
					'action' => 'saveEdit'
				],
				'GET' => [
					'controller' => $jokeController,
					'action' => 'edit'
				],
				'login' => true

			],
			'joke/delete' => [
				'POST' => [
					'controller' => $jokeController,
					'action' => 'delete'
				],
				'login' => true
			],
			'joke/list' => [ // joke/list is the url or the form action
				'GET' => [
					'controller' => $jokeController,
					'action' => 'list'
				]
			],
			'login/error' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'error'
				]
			],
			'login/success' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'success'
				]
			],
			'logout' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'logout'
				]
			],
			'login' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'loginForm'
				],
				'POST' => [
					'controller' => $loginController,
					'action' => 'processLogin'
				]
			],
			'spartacus' => [
				'GET' => [
					'controller' => $spartacusController,
					'action' => 'render'
				],
				'POST' => [
					'controller' => $spartacusController,
					'action' => 'saveSettings'
				]
			],
			'spartacus/exercise' => [
				'GET' => [
					'controller' => $spartacusController,
					'action' => 'renderExercises'
				]
			],
			'horoscope' => [
				'GET' => [
					'controller' => $horoscopeController,
					'action' => 'render'
				]
			],
			'runspeedcalculator' => [
				'GET' => [
					'controller' => $runSpeedCalculatorController,
					'action' => 'render'
				]
			],
			'fitnesscalculator' => [
				'GET' => [
					'controller' => $fitnessCalculatorController,
					'action' => 'render'
				]
			],
			'distanceconverter' => [
				'GET' => [
					'controller' => $distanceconverterController,
					'action' => 'render'
				]
			],
			'pyramid' => [
				'GET' => [
					'controller' => $pyramidController,
					'action' => 'render'
				],
				'POST' => [
					'controller' => $pyramidController,
					'action' => 'save1RM'
				]
			],
			'pyramid/table' => [
				'GET' => [
					'controller' => $pyramidController,
					'action' => 'renderExercises'
				]
			],
			'photos' => [
				'GET' => [
					'controller' => $photosController,
					'action' => 'render'
				],
				'POST' => [
					'controller' => $photosController,
					'action' => 'processUserRequest'
				],
				'login' => true
			],
			'photos/upload' => [
				'GET' => [
					'controller' => $photosController,
					'action' => 'renderUploadForm'
				],
				'POST' => [
					'controller' => $photosController,
					'action' => 'savePhoto'
				],
				'login' => true
			],
			'photos/slideshow' => [
				'GET' => [
					'controller' => $photosController,
					'action' => 'renderSlideShow'
				],
				'login' => true
			],
			'myaccount' => [
				'GET' => [
					'controller' => $myaccountController,
					'action' => 'render'
				],
				'POST' => [
					'controller' => $myaccountController,
					'action' => 'processUserRequest'
				],
				'login' => true
			],
			'myaccount/changepassword' =>  [
				'GET' => [
					'controller' => $myaccountController,
					'action' => 'renderChangePassword'
				],
				'POST' => [
					'controller' => $myaccountController,
					'action' => 'changePassword'
				],
				'login' => true
			],
			'myaccount/passwordchangesuccess' => [
				'GET' => [
					'controller' => $myaccountController,
					'action' => 'renderPasswordChangeSuccess'
				],
				// 'POST' => [
				// 	'controller' => $myaccountController,
				// 	'action' => 'processUserRequest'
				// ],
				// 'login' => true
			],
			'' => [
				'GET' => [
					'controller' => $jokeController,
					'action' => 'home'
				]
			]
		];

		return $routes;
	}

	public function getAuthentication() : \Ninja\Authentication
	{
		return $this->authentication;
	}

}