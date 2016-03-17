<?php

class AccessToken extends RestWork {
	function action() {
		$token = $this->getAccessToken();
		$this->generateSuccessResponse($token);
	}
}

return new AccessToken();