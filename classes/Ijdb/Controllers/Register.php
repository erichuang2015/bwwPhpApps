<?php
namespace Ijdb\Controllers;
use \Ninja\DatabaseTable;

class Register {
	private $usersTable;

	public function __construct(DatabaseTable $usersTable) {
		$this->usersTable = $usersTable;
		// print_r($this->usersTable); die;
	}

	public function registrationForm() {
		return ['template' => 'register.html.php', 
				'title' => 'Register an account'];
	}


	public function success() {
		return ['template' => 'registersuccess.html.php', 
			    'title' => 'Registration Successful'];
	}

	public function registerUser() {
		$author = $_POST['author'];
		

		//Assume the data is valid to begin with
		$valid = true;
		$errors = [];

		//But if any of the fields have been left blank, set $valid to false
		if (empty($author['fname'])) {
			$valid = false;
			$errors[] = 'First name cannot be blank';
		}

		if (empty($author['lname'])) {
			$valid = false;
			$errors[] = 'Last name cannot be blank';
		}

		if (empty($author['email'])) {
			$valid = false;
			$errors[] = 'Email cannot be blank';
		}
		else if (filter_var($author['email'], FILTER_VALIDATE_EMAIL) == false) {
			$valid = false;
			$errors[] = 'Invalid email address';
		}
		else { //if the email is not blank and valid:
			//convert the email to lowercase
			$author['email'] = strtolower($author['email']);

			//search for the lowercase version of `$author['email']`
			if (count($this->usersTable->find('email', $author['email'])) > 0) {
				$valid = false;
				$errors[] = 'That email address is already registered';
			}
		}

		if (empty($author['password'])) {
			$valid = false;
			$errors[] = 'Password cannot be blank';
		}

		if (empty($author['firstanswer'])) {
			$valid = false;
			$errors[] = 'YOu must provide an answer for the first recovery question.';
		}
		else{
			//convert the answer to lowercase
			$author['firstanswer'] = strtolower($author['firstanswer']);
		}

		if (empty($author['secondanswer'])) {
			$valid = false;
			$errors[] = 'YOu must provide an answer for the second recovery question.';
		}
		else{
			//convert the answer to lowercase
			$author['secondanswer'] = strtolower($author['secondanswer']);
		}

		if (empty($author['thirdanswer'])) {
			$valid = false;
			$errors[] = 'YOu must provide an answer for the third recovery question.';
		}
		else{
			//convert the answer to lowercase
			$author['thirdanswer'] = strtolower($author['thirdanswer']);
		}

		//If $valid is still true, no fields were blank and the data can be added
		if ($valid == true) {
			//Hash the password and recovery question answers before saving it in the database
			$author['password'] = password_hash($author['password'], PASSWORD_DEFAULT);
			$author['firstanswer'] = password_hash($author['firstanswer'], PASSWORD_DEFAULT);
			$author['secondanswer'] = password_hash($author['secondanswer'], PASSWORD_DEFAULT);
			$author['thirdanswer'] = password_hash($author['thirdanswer'], PASSWORD_DEFAULT);


			//When submitted, the $author variable now contains a lowercase value for email and recover question answers
			//and a hashed password and recovery question answers
			$this->usersTable->save($author);

			header('Location: /author/success');
		}
		else {
			//If the data is not valid, show the form again
			return ['template' => 'register.html.php', 
				    'title' => 'Register an account',
				    'variables' => [
				    	'errors' => $errors,
				    	'author' => $author
				    ]
				   ]; 
		}
	}
}