<?php
require_once('classes/restwork.php');
require_once('classes/request.php');

$config = include('config/settings.php');

header('Access-Control-Allow-Origin: ' . $config['requesting_domain']);
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Credentials: true');


$requestHandler = new RequestHandler();

$requestHandler->handleRequest();

$endpoint = $requestHandler->getEndpoint();

$api = require($endpoint);
$api->action();







