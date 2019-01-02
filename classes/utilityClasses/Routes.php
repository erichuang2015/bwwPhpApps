<?php
namespace UtilityClasses;

interface Routes {
	public function getRoutes(): array;
	public function getAuthentication(): \UtilityClasses\Authentication;
}