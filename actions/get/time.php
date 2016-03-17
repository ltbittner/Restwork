<?php

class TimeEndpoint extends RestWork {
	function action() {
		$this->generateSuccessResponse($_SESSION['number_of_requests']);
	}
}

return new TimeEndpoint();