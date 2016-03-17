<?php

class Hello extends RestWork {
	function action() {
		if(!$this->checkAccessToken($_GET['token'])) {
			$this->generateErrorResponse("INVALID ACCESS TOKEN");
		}

		$this->generateSuccessResponse("HELLO WORLD!");
	}
}

return new Hello();