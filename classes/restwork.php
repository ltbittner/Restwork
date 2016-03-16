<?php

class RestWork {

	public function generateSuccessResponse($response){
		$response = array(
		"status" => "success",
		"response" => $response
		);

		echo json_encode($response);
		die();
	}

	public function generateErrorResponse($response){
		$response = array(
		"status" => "error",
		"response" => $response
		);

		echo json_encode($response);
		die();
	}

}