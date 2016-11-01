<?php
	namespace Skeleton\Exception;

	class ApplicationSetUpServiceProviderException extends \Exception{
		public function __construct($message = "The application can't be configured corectly", $code = 100, \Exception $previous = null){
			parent::__construct($message, $code, $previous);
		}

		public function __toString(){
			return __class__."[{$this->code}]: {$this->message}";
		}
	}