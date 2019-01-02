<?php
namespace BwwClasses\Controllers;

class RunSpeedCalculator
{
	public function __construct()
	{
	}

	public function render()
	{
		return [
		 'template' => 'runspeedcalculator.html.php',
		 'title' => 'Run Speed Calculator'
		];
	}
}