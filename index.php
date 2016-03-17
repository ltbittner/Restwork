<?php


if(!session_id()) {
    session_start();
}


require_once('classes/restwork.php');
require_once('classes/request.php');
require_once('classes/utility.php');

$config = include('config/settings.php');




$requestHandler = new RequestHandler();

$requestHandler->handleRequest();

//Won't make it past here if the request is sketchy

$endpoint = $requestHandler->getEndpoint();

$api = require($endpoint);
$api->action();







