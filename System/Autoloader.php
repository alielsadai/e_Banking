<?php
    function __autoload($className) {
        if (in_array($className, ['Database', 'ModelInterface', 'Controller', 'Session', 'Misc'])) {
            require_once 'system/' . $className . '.php';
        } elseif (preg_match('/^([A-Z][a-z]+)+Model$/', $className)) {
            require_once 'app/models/' . $className . '.php';
        } elseif (preg_match('/^([A-Z][a-z]+)+Controller$/', $className)) {
            require_once 'app/controllers/' . $className . '.php';
        }  elseif ($className == 'Configuration') {
            require_once $className . '.php';
        }
    }
