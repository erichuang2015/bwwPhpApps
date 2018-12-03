<?php
namespace Ijdb\Controllers;

use \Ninja\Authentication;
use \Ninja\DatabaseTable;
// import the Intervention Image Manager Class
use \vendor\Intervention\Image\ImageManager;

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
        $userImages = [];

        if ($loggedIn) {
            $user = $this->authentication->getUser();
            $photos = [];
            $userImages = $this->photosTable->find('userid', $user['id']); // get all of this user's images
            // if($userImages->num_rows > 0){
            //     $imgData = $userImages->fetch_assoc();
            // }
            foreach ($userImages as $photo) {
                $photos[] = [
                    'id' => (int) $photo['id'],
                    'userid' => (int) $photo['userid'],
                    'caption' => (string) $photo['caption'],
                    'image' => 'data:image/jpeg;base64,'.base64_encode($photo['image']->load())
                ];
            }
            
            return [
                'template' => 'photos.html.php',
                'title' => 'Photo Gallery',
                'variables' => [
                    'loggedIn' => $loggedIn,
                    'photos' => $photos
                ],
            ];
        } else {
            return [
                'template' => 'photos.html.php',
                'title' => 'Photo Gallery',
                'variables' => [
                    'loggedIn' => $loggedIn,
                ],
            ];
        }
    }

    public function processUserRequest()
    {
        switch ((int) $_POST['choice']) {
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
    }

    public function renderUploadForm()
    {
        return [
            'template' => 'photosupload.html.php',
            'title' => 'Photo Gallery - Upload',
        ];
    }

    public function savePhoto()
    {
        // if (preg_match('/^image/p?jpeg$/i', $_FILES['image']['type']) or preg_match('/^image/(x-)?png$/i', $_FILES['image']['type'])) {
        //     // Pick a file extension
        //     if (preg_match('/^image/p?jpeg$/i', $_FILES['image']['type'])) {
        //         $ext = '.jpg';
        //     } else if (preg_match('/^image/(x-)?png$/i',
        //         $_FILES['upload']['type'])) {
        //         $ext = '.png';
        //     } else {
        //         $ext = '.unknown';
        //     }

        // The complete path/filename
        // $filename = 'C:/uploads/' . time() . $_SERVER['REMOTE_ADDR'] . $ext;

        // Copy the file (if it is deemed safe)
        if (!is_uploaded_file($_FILES['image']['tmp_name'])) {
            $error = "Could not  save file as $filename!";
            return ['template' => 'loginerror.html.php', 'title' => 'Could not  save file as $filename!'];
            // include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
            // exit();
        } else {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $image = $_FILES['image']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));

                $user = $this->authentication->getUser();
                $photoData = [];
                $photoData['userid'] = (int) $user['id'];
                $photoData['caption'] = $_POST['caption'];
                $photoData['image'] = base64_decode($imgContent);
                $this->photosTable->save($photoData);
                //do query to save the data then redirect
                header('location: /photos');
            } else {
                return ['template' => 'loginerror.html.php', 'title' => 'Please select an image file to upload.'];
            }
        }
        // } else {
        //     // $error = 'Please submit a JPEG, GIF, or PNG image file.';
        //     return ['template' => 'loginerror.html.php', 'title' => 'Please submit a JPEG or PNG image file'];
        // }
    }

// Todos: add methods for delete and slideshow below:
}