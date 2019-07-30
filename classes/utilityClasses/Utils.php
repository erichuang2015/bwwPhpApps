<?php

namespace UtilityClasses;


class Utils
{
    public static function initializeLanguage()
    {
        if(!isset($_SESSION['language'])){
            $_SESSION['language'] = 'english';
        }
    }
}