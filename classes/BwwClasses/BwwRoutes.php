<?php
namespace BwwClasses;

class BwwRoutes implements \utilityClasses\Routes
{
	private $usersTable;
	private $spartacusSettingsTable;
	private $pyramidUserMaxTable;
	private $photosTable;
	private $authentication;

	public function __construct()
	{
		
		include __DIR__ . '/../../includes/DatabaseConnection.php';
		$this->usersTable = new \utilityClasses\DatabaseTable($pdo, 'user', 'id');
		$this->spartacusSettingsTable = new \utilityClasses\DatabaseTable($pdo, 'spartacus_setting', 'id');
		$this->pyramidUserMaxTable = new \utilityClasses\DatabaseTable($pdo, 'pyramid_user_max', 'id');
		$this->photosTable = new \utilityClasses\DatabaseTable($pdo, 'photo', 'id');
		$this->authentication = new \utilityClasses\Authentication($this->usersTable, 'email', 'password');
	}

	public function getRoutes() : array
	{
		$authorController = new \BwwClasses\Controllers\Register($this->usersTable);
		$loginController = new \BwwClasses\Controllers\Login($this->authentication);
		$spartacusController = new \BwwClasses\Controllers\Spartacus($this->usersTable, $this->spartacusSettingsTable, $this->authentication);
		$horoscopeController = new \BwwClasses\Controllers\Horoscope();
		$runSpeedCalculatorController = new \BwwClasses\Controllers\RunSpeedCalculator();
		$fitnessCalculatorController = new \BwwClasses\Controllers\FitnessCalculator();
		$distanceconverterController = new \BwwClasses\Controllers\DistanceConverter();
		$pyramidController = new \BwwClasses\Controllers\Pyramid($this->usersTable, $this->pyramidUserMaxTable, $this->authentication);
		$photosController = new \BwwClasses\Controllers\Photos($this->usersTable, $this->photosTable, $this->authentication);
		$myaccountController = new \BwwClasses\Controllers\MyAccount($this->usersTable, $this->authentication);

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
				]
			],
			'myaccount/passwordrecovery' => [
				'GET' => [
					'controller' => $myaccountController,
					'action' => 'renderPasswordRecovery'
				],
				'POST' => [
					'controller' => $myaccountController,
					'action' => 'recoverPassword'
				],
			],			
			'' => [
				'GET' => [
					'controller' => $myaccountController,
					'action' => 'home'
				]
			]
		];

		return $routes;
	}

	public function getAuthentication() : \utilityClasses\Authentication
	{
		return $this->authentication;
	}

}