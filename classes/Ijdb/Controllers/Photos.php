<?php
namespace Ijdb\Controllers;

// include composer autoload
// include '/vendor/autoload.php';
//require __DIR__ . '/vendor/autoload.php';
use \Ninja\Authentication;
use \Ninja\DatabaseTable;

// import the Intervention Image Manager Class
// use \vendor\intervention\image\src\Intervention\Image\ImageManager;
// use Intervention\Image\ImageManagerStatic as Image
// use Intervention\Image\ImageManagerStatic as Image;

class Photos
{
    private $authentication;
    private $authorsTable;
    private $photosTable;
    // private $manager;

    public function __construct(DatabaseTable $authorsTable, DatabaseTable $photosTable, Authentication $authentication)
    {
        $this->authorsTable = $authorsTable;
        $this->photosTable = $photosTable;
        $this->authentication = $authentication;
        // create an image manager instance with favored driver
        // $this->$manager = new ImageManager(array('driver' => 'imagick'));
        // Image::configure(array('driver' => 'imagick'));
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
                    'name' => (string) $photo['name'],
                    'directory' => (string) $photo['img_dir'],
                ];
            }

            return [
                'template' => 'photos.html.php',
                'title' => 'Photo Gallery',
                'variables' => [
                    'loggedIn' => $loggedIn,
                    'photos' => $photos,
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
        
        // print_r($_FILES['userfile']['name'][0]); die;  // print name of the actual file from user's computer
        // print_r($_FILES['userfile']['type'][0]); die;  // print the type of file to get ext
        // print_r($_FILES['userfile']['tmp_name'][0]); die; // print the temp name that php gave the file
        // print_r($_FILES['userfile']['error'][0]); die; // print the error produced by the file
        // print_r($_FILES['userfile']['size'][0]); die; // print the file size
        //print_r($_SERVER['DOCUMENT_ROOT']); die; // prints out as: /home/vagrant/Code/bwwPhpApps/public 
        // print_r(__DIR__ . '/../../../uploads/hello.jpg'); die;

        // Pick a file extension
        if ($_FILES['userfile']['type'][0] == "image/jpeg") {
            $ext = '.jpg';
        } else if ($_FILES['userfile']['type'][0] == "image/png") {
            $ext = '.png';
        } else {
            $error = "Please upload only jpg or png files.  Other file types are not supported.";
            return ['template' => 'loginerror.html.php', 'title' => $error];
        }

        $name = $_FILES['userfile']['name'][0] . time() . $_SERVER['REMOTE_ADDR'] . $ext;
        // return ['template' => 'loginerror.html.php', 'title' => 'Original Name: ' . $_FILE['userfile']['name'] . '!'];
        
        // The complete path/filename
        // $filename = 'classes/Ijdb/Controllers/uploads' . time() . $_SERVER['REMOTE_ADDR'] . $ext;
        $filename = __DIR__ . '/../../../public/uploads/' . $name;

        // Copy the file (if it is deemed safe) All this function (is_uploaded_file) does is return TRUE if the filename it’s passed as a parameter ($_FILES['userfile']['tmp_name'] in this case) was in fact uploaded as part of a form submission.
        if (!is_uploaded_file($_FILES['userfile']['tmp_name'][0]) or !copy($_FILES['userfile']['tmp_name'][0], $filename)) {
            $error = "Could not  save file as $filename!";
            return ['template' => 'loginerror.html.php', 'title' => 'Could not  save file as ' . $filename . '!'];
            // include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
            // exit();
        } else {
            $check = (int)$_FILES['userfile']['size'][0];
            if ($check > 0 & $check < 2097152) {

                // $image = $_FILES['userfile']['tmp_name'];
                // $imgContent = addslashes(file_get_contents($image));

                $user = $this->authentication->getUser();
                $photoData = [];
                $photoData['userid'] = (int) $user['id'];
                $photoData['caption'] = $_POST['caption'];
                $photoData['name'] = $name;
                $photoData['img_dir'] = $filename;
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