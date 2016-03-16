<?php

class Hello extends RestWork {
	function action() {
		$this->generateSuccessResponse("HELLO WORLD!");
	}
}

return new Hello();