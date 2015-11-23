<?php
    require('php/init.php');

    // Get Request
    $request = new Request(array('restful' => false));

    //echo "<P>request: " . $request->to_string();

    error_log ("\r\r" . '$_POST = ' . json_encode($_POST), 3, '/var/www/app_php.log');
    error_log ("\r\r" . '$_REQUEST = ' .  json_encode($_REQUEST), 3, '/var/www/app_php.log');
    error_log ("\r\r" . '$_GET = ' .  json_encode($_GET), 3, '/var/www/app_php.log');
    error_log ("\r\r" . '$request = ' . json_encode($request), 3, '/var/www/app_php.log');

    // Get Controller
    require('php/app/controllers/' . $request->controller . '.php');
    $controller_name = ucfirst($request->controller);
    $controller = new $controller_name;
    $callback = $_GET['callback'];

    // Dispatch request
    $result = $controller->dispatch($request);
    if ($callback) {
        $result = $callback . '(' . $result . ');';
    }

    echo $result;

