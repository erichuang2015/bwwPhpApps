<?php
namespace BwwClasses\Controllers;

class FitnessCalculator
{
	public function __construct()
	{ }

	public function render()
	{
		return [
			'template' => 'fitnesscalculator.html.php',
			'title' => 'Fitness Calculator'
		];
	}
}