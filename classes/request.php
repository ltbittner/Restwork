<?php

class RequestHandler {

	private $endpoint = "";

	public function handleRequest() {
		if($this->_isPreflight()) {
			$this->_setPreflightHeaders();
		}

		$this->_setEndpoint($this->_getRoutes());
	}

	public function handleEndpoints() {
		if(!$this->_endPointExists()) {
			$this->_endpointDoesntExist();
		}
	}

	private function _endpointDoesntExist() {
		$response = array(
			"status" => "error",
			"response" => "API endpoint does not exist"
		);

		echo json_encode($response);
		die();
	}

	private function _endPointExists() {
		if(file_exists($this->getEndpoint())) {
			return true;
		}
		return false;
	}

	public function getEndpoint(){

		return $this->endpoint;
	}

	private function _setEndpoint($params) {
		$pathBase = 'actions/' . $_SERVER['REQUEST_METHOD'] . '/';
		$endpoint = "";
		foreach($params as $path) {
			$endpoint .= $path . '/';
		}

		$trimmedEndpoint = rtrim($endpoint, '/');
		$this->endpoint = $pathBase . $trimmedEndpoint . '.php';
	}

	private function _isPreflight() {
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
			return true;
		}

		return false;
	}

	private function _setPreflightHeaders() {

	}

	private function _getRoutes() {
		$base_url = $this::_getCurrentUri();
		$params = array();
		$routes = explode('/', $base_url);
		foreach($routes as $route){
		  if(trim($route) != '')
		    array_push($params, $route);
		}

		return $params;
	}


	private function _getCurrentUri(){
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
		if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
		$uri = '/' . trim($uri, '/');
		return $uri;
	}
}