<?php

namespace BwwClasses;

class BwwRoutes implements \utilityClasses\Routes
{
    private $usersTable;
    private $usersVerifyTable;
    private $spartacusSettingsTable;
    private $pyramidUserMaxTable;
    private $photosTable;
    private $exerciseTypesTable;
    private $mailTable;
    private $shoppingCategoriesTable;
    private $shoppingItemsTable;
    private $todoPriorityTable;
    private $todoSortTable;
    private $todoTable;
    private $buildingLevelsTable;
    private $buildingUnitsAllowedTable;
    private $mainUnitsTable;
    private $todoFrequencyTable;
    private $authentication;

    public function __construct()
    {

        include __DIR__ . '/../../includes/DatabaseConnection.php';
        $this->usersTable = new \utilityClasses\DatabaseTable($pdo, 'user', 'id');
        $this->usersVerifyTable = new \utilityClasses\DatabaseTable($pdo, 'user_verify', 'id');
        $this->spartacusSettingsTable = new \utilityClasses\DatabaseTable($pdo, 'spartacus_setting', 'id');
        $this->pyramidUserMaxTable = new \utilityClasses\DatabaseTable($pdo, 'pyramid_user_max', 'id');
        $this->photosTable = new \utilityClasses\DatabaseTable($pdo, 'photo', 'id');
        $this->exerciseTypesTable = new \utilityClasses\DatabaseTable($pdo, 'exercise_types', 'id');
        $this->mailTable = new \utilityClasses\DatabaseTable($pdo, 'mail', 'id');
        $this->shoppingCategoriesTable = new \utilityClasses\DatabaseTable($pdo, 'shopping_categories', 'id');
        $this->shoppingItemsTable = new \utilityClasses\DatabaseTable($pdo, 'shopping_items', 'id');
        $this->todoPriorityTable = new \utilityClasses\DatabaseTable($pdo, 'todo_priority', 'priority_id');
        $this->todoFrequencyTable = new \utilityClasses\DatabaseTable($pdo, 'todo_frequency', 'frequency_id');
        $this->todoSortTable = new \utilityClasses\DatabaseTable($pdo, 'todo_sort', 'id');
        $this->todoTable = new \utilityClasses\DatabaseTable($pdo, 'todos', 'id');
        $this->buildingLevelsTable = new \utilityClasses\DatabaseTable($pdo, 'building_levels', 'LevelName');
        $this->buildingUnitsAllowedTable = new \utilityClasses\DatabaseTable($pdo, 'building_units_allowed', 'id');
        $this->mainUnitsTable = new \utilityClasses\DatabaseTable($pdo, 'main_units', 'Unit_Key');
        $this->authentication = new \utilityClasses\Authentication($this->usersTable, 'email', 'password', $this->usersVerifyTable, $this->mailTable);
    }

    public function getRoutes(): array
    {
        $registerController = new \BwwClasses\Controllers\Register($this->usersTable, $this->usersVerifyTable, $this->mailTable);
        $loginController = new \BwwClasses\Controllers\Login($this->authentication);
        $spartacusController = new \BwwClasses\Controllers\Spartacus($this->usersTable, $this->spartacusSettingsTable, $this->authentication);
        $horoscopeController = new \BwwClasses\Controllers\Horoscope();
        $runSpeedCalculatorController = new \BwwClasses\Controllers\RunSpeedCalculator();
        $fitnessCalculatorController = new \BwwClasses\Controllers\FitnessCalculator();
        $distanceconverterController = new \BwwClasses\Controllers\DistanceConverter();
        $pyramidController = new \BwwClasses\Controllers\Pyramid($this->usersTable, $this->pyramidUserMaxTable, $this->exerciseTypesTable, $this->authentication);
        $photosController = new \BwwClasses\Controllers\Photos($this->usersTable, $this->photosTable, $this->authentication);
        $myaccountController = new \BwwClasses\Controllers\MyAccount($this->usersTable, $this->authentication, $this->usersVerifyTable);
        $shoppingListController = new \BwwClasses\Controllers\ShoppingList($this->shoppingCategoriesTable, $this->shoppingItemsTable, $this->authentication);
        $todoListController = new \BwwClasses\Controllers\TodoList($this->todoPriorityTable, $this->todoSortTable, $this->todoTable, $this->authentication, $this->buildingLevelsTable, $this->buildingUnitsAllowedTable, $this->mainUnitsTable, $this->todoFrequencyTable);
        $aboutController = new \BwwClasses\Controllers\About();

        $routes = [
            'user/register' => [
                'GET' => [
                    'controller' => $registerController,
                    'action' => 'registrationForm', //the action is the function to call in the controller
                ],
                'POST' => [
                    'controller' => $registerController,
                    'action' => 'storeUserData',
                ],
            ],
            'user/registersuccess' => [
                'GET' => [
                    'controller' => $registerController,
                    'action' => 'success',
                ],
            ],
            'user/registerverifycode' => [
                'GET' => [
                    'controller' => $registerController,
                    'action' => 'renderConfirmationEmailNotification',
                ],
                'POST' => [
                    'controller' => $registerController,
                    'action' => 'registerUser',
                ],
            ],
            'login/error' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'error',
                ],
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'changeLanguageFromErrorPg'
                ]
            ],
            'login/success' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'success',
                ],
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'changeLanguageFromSuccess'
                ]
            ],
            'logout' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'logout',
                ],
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'changeLanguageFromLogOut',
                ],
            ],
            'login' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'loginForm',
                ],
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'processUserRequest',
                ],
            ],
            'spartacus' => [
                'GET' => [
                    'controller' => $spartacusController,
                    'action' => 'render',
                ],
                'POST' => [
                    'controller' => $spartacusController,
                    'action' => 'saveSettings',
                ],
            ],
            'spartacus/exercise' => [
                'GET' => [
                    'controller' => $spartacusController,
                    'action' => 'renderExercises',
                ],
            ],
            'horoscope' => [
                'GET' => [
                    'controller' => $horoscopeController,
                    'action' => 'render',
                ],
                'POST' => [
                    'controller' => $horoscopeController,
                    'action' => 'changeLanguage'
                ]
            ],
            'runspeedcalculator' => [
                'GET' => [
                    'controller' => $runSpeedCalculatorController,
                    'action' => 'render',
                ],
                'POST' => [
                    'controller' => $runSpeedCalculatorController,
                    'action' => 'changeLanguage'
                ]
            ],
            'fitnesscalculator' => [
                'GET' => [
                    'controller' => $fitnessCalculatorController,
                    'action' => 'render'
                ],
                'POST' => [
                    'controller' => $fitnessCalculatorController,
                    'action' => 'changeLanguage'
                ]
            ],
            'distanceconverter' => [
                'GET' => [
                    'controller' => $distanceconverterController,
                    'action' => 'render',
                ],
                'POST' => [
                    'controller' => $distanceconverterController,
                    'action' => 'changeLanguage'
                ]
            ],
            'pyramid' => [
                'GET' => [
                    'controller' => $pyramidController,
                    'action' => 'render',
                ],
                'POST' => [
                    'controller' => $pyramidController,
                    'action' => 'processUserRequest',
                ],
            ],
            'pyramid/table' => [
                'GET' => [
                    'controller' => $pyramidController,
                    'action' => 'renderExercises',
                ],
                'POST' => [
                    'controller' => $pyramidController,
                    'action' => 'changeLanguage',
                ]
            ],
            'photos' => [
                'GET' => [
                    'controller' => $photosController,
                    'action' => 'render',
                ],
                'POST' => [
                    'controller' => $photosController,
                    'action' => 'processUserRequest',
                ],
                'login' => true,
            ],
            'photos/upload' => [
                'GET' => [
                    'controller' => $photosController,
                    'action' => 'renderUploadForm',
                ],
                'POST' => [
                    'controller' => $photosController,
                    'action' => 'savePhoto',
                ],
                'login' => true,
            ],
            'photos/slideshow' => [
                'GET' => [
                    'controller' => $photosController,
                    'action' => 'renderSlideShow',
                ],
                'POST' => [
                    'controller' => $photosController,
                    'action' => 'changeLangFromSlideShow',
                ],
                'login' => true,
            ],
            'myaccount' => [
                'GET' => [
                    'controller' => $myaccountController,
                    'action' => 'render',
                ],
                'POST' => [
                    'controller' => $myaccountController,
                    'action' => 'processUserRequest',
                ],
                'login' => true,
            ],
            'myaccount/changepassword' => [
                'GET' => [
                    'controller' => $myaccountController,
                    'action' => 'renderChangePassword',
                ],
                'POST' => [
                    'controller' => $myaccountController,
                    'action' => 'determineChangeLanguageOrPassword',
                ],
                'login' => true,
            ],
            'myaccount/passwordchangesuccess' => [
                'GET' => [
                    'controller' => $myaccountController,
                    'action' => 'renderPasswordChangeSuccess',
                ],
                'POST' => [
                    'controller' => $myaccountController,
                    'action' => 'changeLanguageFromPasswordSuccess',
                ]
            ],
            'myaccount/passwordrecovery' => [
                'GET' => [
                    'controller' => $myaccountController,
                    'action' => 'renderPasswordRecovery',
                ],
                'POST' => [
                    'controller' => $myaccountController,
                    'action' => 'determineChangeLanguageOrRecoverPassword'
                ],
            ],
            'myaccount/passwordrecoveryreset' => [
                'GET' => [
                    'controller' => $myaccountController,
                    'action' => 'renderReplaceLostPassword',
                ],
                'POST' => [
                    'controller' => $myaccountController,
                    'action' => 'determineCreateNewPasswordOrChangeLang'
                ]
            ],
            'myaccount/recoverpasswordemailsent' => [
                'GET' => [
                    'controller' => $myaccountController,
                    'action' => 'renderRecoverPwEmailSent',
                ],
                'POST' => [
                    'controller' => $myaccountController,
                    'action' => 'changeRecoveryPwEmailSentLanguage'
                ]
            ],
            'shoppinglist' => [
                'GET' => [
                    'controller' => $shoppingListController,
                    'action' => 'render',
                ],
                'POST' => [
                    'controller' => $shoppingListController,
                    'action' => 'processUserRequest',
                ],
                'login' => true,
            ],
            'todolist' => [
                'GET' => [
                    'controller' => $todoListController,
                    'action' => 'render',
                ],
                'POST' => [
                    'controller' => $todoListController,
                    'action' => 'processUserRequest',
                ],
                'login' => true,
            ],
            'about' => [
                'GET' => [
                    'controller' => $aboutController,
                    'action' => 'render',
                ],
                'POST' => [
                    'controller' => $aboutController,
                    'action' => 'changeLanguage',
                ]
            ],
            '' => [
                'GET' => [
                    'controller' => $myaccountController,
                    'action' => 'home',
                ],
                'POST' => [
                    'controller' => $myaccountController,
                    'action' => 'changeHomePageLanguage',
                ]
            ],
        ];

        return $routes;
    }

    public function getAuthentication(): \utilityClasses\Authentication
    {
        return $this->authentication;
    }
}