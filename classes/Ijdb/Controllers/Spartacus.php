<?php
namespace Ijdb\Controllers;

use \Ninja\DatabaseTable;

class Spartacus
{
    // private $authentication;
	private $authorsTable;

	public function __construct(DatabaseTable $authorsTable)
	{
		$this->authorsTable = $authorsTable;
	}

	public function render()
	{
		return ['template' => 'spartacus.html.php', 'title' => 'Spartacus Workout', 'loggedIn' => null];
	}
}
