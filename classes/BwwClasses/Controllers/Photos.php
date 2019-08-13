<?php
namespace BwwClasses\Controllers;

use \utilityClasses\Authentication;
use \utilityClasses\DatabaseTable;
use UtilityClasses\Utils;

class Photos
{
    private $authentication;
    private $usersTable;
    private $photosTable;

    public function __construct(DatabaseTable $usersTable, DatabaseTable $photosTable, Authentication $authentication)
    {
        $this->usersTable = $usersTable;
        $this->photosTable = $photosTable;
        $this->authentication = $authentication;
    }

    public function render()
    {
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');

        $loggedIn = $this->authentication->isLoggedIn();
        $userImages = [];

        if (isset($_POST['delete'])) {
            // print_r($_POST['delete']); die;
            $this->deletePhoto($_POST['id']);
        } else if (isset($_POST['rotate'])) {
            // print_r($_POST['rotate']);die;
            $this->rotatePhoto($_POST['id']);
        }

        Utils::initializeLanguage(); // call static method in Utils class to ensure the language is set
        $lang = '';
        //Add the proper set of strings depending on if Spanish or English is requested
        if ($_SESSION['language'] == 'english') {
            $path = __DIR__ . '/../../../public/locale/english/photos.json';
            $lang = 'english';
        } else {
            $path = __DIR__ . '/../../../public/locale/spanish/photos.json';
            $lang = 'spanish';
        }

        $content = file_get_contents($path);
        $content = json_decode($content, true);

        if ($loggedIn) {
            $user = $this->authentication->getUser();
            $photos = [];
            $userImages = $this->photosTable->find('userid', $user['id']); // get all of this user's images
            foreach ($userImages as $photo) {
                $photos[] = [
                    'id' => (int)$photo['id'],
                    'userid' => (int)$photo['userid'],
                    'caption' => (string)$photo['caption'],
                    'name' => (string)$photo['name'],
                    'directory' => (string)$photo['img_dir'],
                ];
            }

            return [
                'template' => 'photos.html.php',
                'title' => $content['title'],
                'variables' => [
                    'loggedIn' => $loggedIn,
                    'photos' => $photos,
                    'content' => $content,//all the strings on the page
                    'language' => $lang//add the language variable to the page for the hidden input value
                ]
            ];
        } else {
            return [
                'template' => 'photos.html.php',
                'title' => $content['title'],
                'variables' => [
                    'loggedIn' => $loggedIn,
                    'content' => $content,//all the strings on the page
                    'language' => $lang//add the language variable to the page for the hidden input value
                ]
            ];
        }
    }

    public function processUserRequest()
    {
        if (isset($_POST['english']) || isset($_POST['spanish'])) {
            if (isset($_POST['english'])) {
                $_SESSION['language'] = 'english';
            } else {
                $_SESSION['language'] = 'spanish';
            }
            $page = $this->render();
            return $page;
        } else if (isset($_POST['choice'])) {
            switch ((int)$_POST['choice']) {
                case 1:
                    header("location: /photos/upload");
                    break;
                case 2:
                    header("location: /photos/slideshow");
                    break;
            }
        } else {
            $this->render();
        }
    }

    public function renderUploadForm()
    {
        return [
            'template' => 'photosupload.html.php', //Todo: photosupload translations
            'title' => 'Photo Gallery - Upload',
        ];
    }

    public function savePhoto()
    {
        if (empty($_FILES['userfile']['tmp_name'][0])) {
            $error = "You did not select a file.  Please try again.";
            return [
                'template' => 'photosupload.html.php', //Todo: photosupload translations
                'title' => "Photo Gallery Upload - Error",
                'variables' => [
                    'error' => $error
                ],
            ];
        }
        $temporaryImgName = $_FILES['userfile']['tmp_name'][0];
        $imageData = getimagesize($temporaryImgName);
        $ext = image_type_to_extension($imageData[2]);
        $ext = strtolower($ext);
        // Pick a file extension
        if ($ext != '.jpg' && $ext != '.jpeg' && $ext != '.png') {
            $error = "Please upload only jpg or png files.  Other file types are not supported.";
            return [
                'template' => 'photosupload.html.php', //Todo: photosupload translations
                'title' => "Photo Gallery Upload - Error",
                'variables' => [
                    'error' => $error
                ],
            ];
        }

        $name = time() . $_SERVER['REMOTE_ADDR'] . $ext;

        // The complete path/filename
        $filename = __DIR__ . '/../../../public/uploads/' . $name;
        $check = (int)$_FILES['userfile']['size'][0]; // get file size
        // Copy the file (if it is deemed safe) All this function (is_uploaded_file) does is return TRUE if the filename it’s passed as a parameter ($_FILES['userfile']['tmp_name'] in this case) was in fact uploaded as part of a form submission.
        if ((!is_uploaded_file($_FILES['userfile']['tmp_name'][0])) || $check <= 0 || $check > 4194304) {
            $error = "File size cannot exceed 4MB!";
            return [
                'template' => 'photosupload.html.php', //Todo: photosupload translations
                'title' => "Photo Gallery Upload - Error",
                'variables' => [
                    'error' => $error
                ],
            ];
        } else {
            $user = $this->authentication->getUser();
            $photoData = [];
            $photoData['userid'] = (int)$user['id'];
            $photoData['caption'] = $_POST['caption']; // Todo: add some logic to prevent user input from exceeding 100 chars for caption.
            $photoData['name'] = $name;
            $photoData['img_dir'] = $filename;
            $this->photosTable->save($photoData);
            copy($_FILES['userfile']['tmp_name'][0], $filename);
            header('location: /photos');
        }
    }

    private function deletePhoto($id)
    {
        $user = $this->authentication->getUser();

        $photo = $this->photosTable->findById($id);

        if ($photo['userid'] != $user['id']) {
            return;
        }

        $this->photosTable->delete($id);
        unlink($photo['img_dir']); // Todo: add an error message for if this fails
        header('location: /photos');
    }

    private function rotatePhoto($id)
    {
        $user = $this->authentication->getUser();

        $photo = $this->photosTable->findById($id);

        if ($photo['userid'] != $user['id']) {
            return;
        }

        $degrees = 90;
        $filename = $photo['img_dir'];

        // Get the file extension
        $info = getimagesize($photo['img_dir']);
        $extension = image_type_to_extension($info[2]);

        $newName = time() . $_SERVER['REMOTE_ADDR'] . $extension;
        $newDirName = __DIR__ . '/../../../public/uploads/' . $newName;

        //update the DB
        $photoData = [];
        $photoData['id'] = (int)$photo['id'];
        $photoData['userid'] = (int)$user['id'];
        $photoData['caption'] = $photo['caption'];
        $photoData['name'] = $newName;
        $photoData['img_dir'] = $newDirName;
        $this->photosTable->save($photoData);

        //Possible extensions .png .jpeg
        if ($extension == ".jpeg") {
            // Load
            $source = imagecreatefromjpeg($filename);
            // Rotate
            $rotate = imagerotate($source, $degrees, 0);
            imagejpeg($rotate, $newDirName);
        } else {
            $source = imagecreatefrompng($filename);
            // Rotate
            $rotate = imagerotate($source, $degrees, 0);
            imagepng($rotate, $newDirName);
        }
        unlink($filename); // delete the old image and add an error message for if this fails
        // Free the memory
        imagedestroy($source);
        imagedestroy($rotate);
        header('location: /photos');
    }

    public function renderSlideShow()
    {
        $loggedIn = $this->authentication->isLoggedIn();
        $userImages = [];

        if ($loggedIn) {
            $user = $this->authentication->getUser();
            $photos = [];
            $userImages = $this->photosTable->find('userid', $user['id']); // get all of this user's images
            foreach ($userImages as $photo) {
                $photos[] = [
                    'id' => (int)$photo['id'],
                    'userid' => (int)$photo['userid'],
                    'caption' => (string)$photo['caption'],
                    'name' => (string)$photo['name'],
                    'directory' => (string)$photo['img_dir'],
                ];
            }
            return [
                'template' => 'slideshow.html.php', //Todo: slideshow translations
                'title' => 'Photo Gallery - Slideshow',
                'variables' => [
                    'loggedIn' => $loggedIn,
                    'photos' => $photos,
                ],
            ];
        } else {
            return [
                'template' => 'slideshow.html.php', //Todo: slideshow translations
                'title' => 'Photo Gallery - Slideshow',
                'variables' => [
                    'loggedIn' => $loggedIn,
                ],
            ];
        }
    }
}