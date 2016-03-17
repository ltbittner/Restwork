<?php

class RestWork {

	public function generateSuccessResponse($response){
		$this->_setHeaders();
		$response = array(
			"status" => "success",
			"response" => $response
		);

		echo json_encode($response);
		die();
	}

	public function generateErrorResponse($response){
		$this->_setHeaders();
		$response = array(
			"status" => "error",
			"response" => $response
		);

		echo json_encode($response);
		die();
	}

	public function getAccessToken() {
		$token = $this->_generateToken();
		$_SESSION['access_token'] = $token;
		return $token;
	}

	public function checkAccessToken($token) {
		if($_SESSION['access_token'] == $token) {
			return true;
		}

		return false;
	}

	private function _setHeaders() {
		$config = include('config/settings.php');
		if($config['cross_domain']) {
			header('Access-Control-Allow-Origin: ' . $config['requesting_domain']);
			header('Access-Control-Allow-Headers: X-Requested-With');
			header('Access-Control-Allow-Credentials: true');
		} else {
			header('Access-Control-Allow-Origin: *');
  			header('Access-Control-Allow-Headers: X-Requested-With');
		}
	}

	private function _formatForResponse($d) {
	    if (is_array($d)) 
	        foreach ($d as $k => $v) 
	            $d[$k] = utf8ize($v);

	     else if(is_object($d))
	        foreach ($d as $k => $v) 
	            $d->$k = utf8ize($v);

	     else 
	        return utf8_encode($d);

	    return $d;
	}

	private function _generateToken() {
		$possible = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789');
		$s = "";

		for($i = 0; $i < 15; $i++) {
			$s .= $possible[rand(0, count($possible))];
		}

		return $s;
	}

}













