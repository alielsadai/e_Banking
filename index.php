<?php
//    print_r($_SERVER['REQUEST_URI']);
//    exit;
    ob_start();
    
    require_once 'system/Autoloader.php';
    require_once 'system/Classes/PHPExcel.php';
    require_once 'system/Classes/PHPExcel/Writer/Excel2007.php';
    require_once 'system/GlobalFunctions.php';
    Session::begin();
    
    $Request = substr($_SERVER['REQUEST_URI'], strlen(Configuration::PATH));

    $Routes = require_once 'Routes.php';
    
    $Arguments = [];
    $FoundRoute = null;
    
    foreach ($Routes as $Route) {
        if (preg_match($Route['Pattern'], $Request, $Arguments)) {
            $FoundRoute = $Route;
            break;
        }
    }
    
//    print_r($FoundRoute);
//    exit();
    
    
    unset($Arguments[0]);
    $Arguments= array_values($Arguments);;
    
    
    $controllerPath = 'app/controllers/' . $FoundRoute['Controller'] . 'Controller.php';

    if(!file_exists($controllerPath)){
        die('Controller class does not exist!');
    }
    
    #executing the selected class
    require_once $controllerPath;
    
    $controllerName = $FoundRoute['Controller'] . 'Controller';
    $worker = new $controllerName;
    
    if(!method_exists($worker, $FoundRoute['Method'])){
        die('This controller does not have the requested method!');
    }
    
    
    $methodName = $FoundRoute['Method'];

    call_user_func_array([$worker, $methodName], $Arguments);
    
    #getting data
    $DATA = $worker->getData();
    
    #loading templates of teh requested method
    require_once 'app/views/' . $FoundRoute['Controller'] . '/' . $FoundRoute['Method']  . '.php';