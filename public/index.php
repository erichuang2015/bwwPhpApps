<?php
try {
	
	include __DIR__ . '/../includes/autoload.php';
	
	// include composer autoload
	include __DIR__ . '/../vendor/autoload.php';

	$route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

	$entryPoint = new \Ninja\EntryPoint($route, $_SERVER['REQUEST_METHOD'], new \Ijdb\IjdbRoutes());
	//print_r($entryPoint); die;
	$entryPoint->run();
} catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
		$e->getFile() . ':' . $e->getLine();

	include __DIR__ . '/../templates/layout.html.php';
}
