<?php
namespace Ijdb\Controllers;

class DistanceConverter
{
	public function __construct()
	{
	}

	public function render()
	{
		return [
		 'template' => 'distanceconverter.html.php',
		 'title' => 'Distance Converter'
		];
	}
}