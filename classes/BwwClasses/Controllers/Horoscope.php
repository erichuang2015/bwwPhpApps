<?php
namespace BwwClasses\Controllers;

class Horoscope
{
	public function __construct()
	{
	}

	public function render()
	{
		return [
		 'template' => 'horoscope.html.php',
		 'title' => 'Horoscope Generator'
		];
	}
}