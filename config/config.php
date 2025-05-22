<?php
session_start();

session_set_cookie_params([
    'lifetime' => 0,                      
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => isset($_SERVER['HTTPS']), 
    'httponly' => true,                  
    'samesite' => 'Strict'               
]);

define('BASE_URL', 'http://localhost/quizbuzz/');

date_default_timezone_set('Asia/Dhaka');

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('APP_NAME', 'QuizBuzz Online Quiz Platform');
define('ALLOWED_ROLES', ['admin', 'teacher', 'student']);

spl_autoload_register(function ($class) {
    $paths = ['../model/', '../helpers/', '../controller/'];
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
