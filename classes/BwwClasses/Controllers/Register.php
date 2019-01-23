<?php
namespace BwwClasses\Controllers;
use \utilityClasses\DatabaseTable;

class Register {
	private $usersTable;
	private $usersVerifyTable;

	public function __construct(DatabaseTable $usersTable, DatabaseTable $usersVerifyTable) {
		$this->usersTable = $usersTable;
		$this->usersVerifyTable = $usersVerifyTable;
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
		$user = $_POST['user'];


		//Assume the data is valid to begin with
		$valid = true;
		$errors = [];

		//But if any of the fields have been left blank, set $valid to false
		if (empty($user['fname'])) {
			$valid = false;
			$errors[] = 'First name cannot be blank';
		}

		if (empty($user['lname'])) {
			$valid = false;
			$errors[] = 'Last name cannot be blank';
		}

		if (empty($user['email'])) {
			$valid = false;
			$errors[] = 'Email cannot be blank';
		}
		else if (filter_var($user['email'], FILTER_VALIDATE_EMAIL) == false) {
			$valid = false;
			$errors[] = 'Invalid email address';
		}
		else { //if the email is not blank and valid:
			//convert the email to lowercase
			$user['email'] = strtolower($user['email']);

			//search for the lowercase version of `$user['email']`
			if (count($this->usersTable->find('email', $user['email'])) > 0) {
				$valid = false;
				$errors[] = 'That email address is already registered';
			}
		}

		if (empty($user['password'])) {
			$valid = false;
			$errors[] = 'Password cannot be blank';
		}

		if (empty($user['firstanswer'])) {
			$valid = false;
			$errors[] = 'YOu must provide an answer for the first recovery question.';
		}
		else{
			//convert the answer to lowercase
			$user['firstanswer'] = strtolower($user['firstanswer']);
		}

		if (empty($user['secondanswer'])) {
			$valid = false;
			$errors[] = 'YOu must provide an answer for the second recovery question.';
		}
		else{
			//convert the answer to lowercase
			$user['secondanswer'] = strtolower($user['secondanswer']);
		}

		if (empty($user['thirdanswer'])) {
			$valid = false;
			$errors[] = 'YOu must provide an answer for the third recovery question.';
		}
		else{
			//convert the answer to lowercase
			$user['thirdanswer'] = strtolower($user['thirdanswer']);
		}

		//If $valid is still true, no fields were blank and the data can be added
		if ($valid == true) {
			//Hash the password and recovery question answers before saving it in the database
			$user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
			$user['firstanswer'] = password_hash($user['firstanswer'], PASSWORD_DEFAULT);
			$user['secondanswer'] = password_hash($user['secondanswer'], PASSWORD_DEFAULT);
			$user['thirdanswer'] = password_hash($user['thirdanswer'], PASSWORD_DEFAULT);

			$code=substr(md5(mt_rand()),0,15); // generate a random code to send user so they can validate their email address before registering

			//When submitted, the $user variable now contains a lowercase value for email and recover question answers
			//and a hashed password and recovery question answers
			$this->usersTable->save($user);

			header('Location: /user/success');
		}
		else {
			//If the data is not valid, show the form again
			return ['template' => 'register.html.php',
				    'title' => 'Register an account',
				    'variables' => [
				    	'errors' => $errors,
				    	'user' => $user
				    ]
				   ];
		}
	}
}