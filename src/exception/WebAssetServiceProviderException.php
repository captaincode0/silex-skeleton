<?php
	namespace Skeleton\Exception;

	class WebAssetServiceProviderException extends \Exception{
		public function __construct($message = "The WebAssetServiceProvider can't be builded, because it needs to be an existent path", $code = 101, \Exception $previous = null){
			parent::__construct($message, $code, $previous);
		}

		public function __toString(){
			return __class__."[{$this->code}]: {$this->message}";
		}
	}