<?php

    //Load Config
    require_once 'config/config.php';

    //Load Helpers
    require_once 'helpers/general_helper.php';
    require_once 'helpers/session_helper.php';

    //Autoload Core Libraries
    // spl_autoload_register(function($className){
    //     require_once 'libraries/' . $className . '.php';
    // });

    require_once 'libraries/Core.php';
    require_once 'libraries/Controller.php';
    require_once 'libraries/Database.php';

    //Addon libraries
    require_once "../vendor/autoload.php";
    require_once "libraries/xlsxwriter.class.php";
    