<?php
namespace Ijdb\Controllers;

use \Ninja\DatabaseTable;
use \Ninja\Authentication;

class Photos
{
    private $authentication;
	private $authorsTable;
    private $photosTable;
    
	public function __construct(DatabaseTable $authorsTable, DatabaseTable $photosTable, Authentication $authentication)
	{
        $this->authorsTable = $authorsTable;
		$this->photosTable = $photosTable;
		$this->authentication = $authentication;
	}

	public function render()
	{
        $loggedIn = $this->authentication->isLoggedIn();
        // $userData = [];

        
        // if($loggedIn){
		// 	$user = $this->authentication->getUser();
        //     $userData = $this->pyramidUserMaxTable->findById($user['id']);
        //     return [
        //         'template' => 'pyramid.html.php',
        //         'title' => 'Pyramid Workout',
        //         'variables' => [
        //            'max' => (double)$userData["max"] ?? NULL
        //           ]
        //        ];
		// }
        return [
		 'template' => 'photos.html.php',
         'title' => 'Photo Gallery',
         'variables' => [
            'loggedIn' => $loggedIn
           ]
		];
    }

    public function processUserRequest()
	{
        switch((int)$_POST['choice'])
        {
            case 1:
            header("location: /photos/upload");
            break;
            case 2:
            header("location: /photos/delete");
            // $userChoice = "location: /photos/delete";
            break;
            case 3:
            header("location: /photos/slideshow");
            // $userChoice = "location: /photos/slideshow";
            break;
        }
        // header("location: /photos/upload");
        // header($userChoice);
    }
    
    public function renderUploadForm()
	{
        return [
            'template' => 'photosupload.html.php',
            'title' => 'Photo Gallery - Upload'
           ];
	}
    
    public function savePhoto()
	{
        //do query to save the data
        header('location: /photos');
    }
    
    // Todos: add methods for delete and slideshow below:
}