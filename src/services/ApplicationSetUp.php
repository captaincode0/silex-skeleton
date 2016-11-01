<?php
	namespace Skeleton\Services;

	/**
	 * @class: ApplicationSetUp.
	 * @desc. Contains all the global variables of silex application
	 */
	class ApplicationSetUp{
		/**
		 * [$productionprefix the local url prefix that refers to the virtual host]
		 * @var [string]
		 */
		private $productionprefix;

		/**
		 * [$remoteprefix the remote url prefix that refers tho the virtual host]
		 * @var [string]
		 */
		private $remoteprefix;

		/**
		 * [$hashttps https flag]
		 * @var [bool]
		 */
		private $hashttps;

		/**
		 * [$url the url parsed]
		 * @var [string]
		 */
		private $url;

		/**
		 * [$islocal check if the application is running in a local environment]
		 * @var [bool]
		 */
		private $islocal;

		/**
		 * [$hasdebug check if the application need to debug errors]
		 * @var [bool]
		 */
		private $hasdebug;

		/**
		 * [__construct description]
		 * @param [string] $productionprefix 
		 * @param [string] $remoteprefix     
		 * @param [bool] $hashttps         
		 * @param [bool] $islocal          
		 * @param [bool] $hasdebug         
		 */
		public function __construct($productionprefix, $remoteprefix, $hashttps, $islocal, $hasdebug){
			$this->productionprefix = $productionprefix;
			$this->remoteprefix = $remoteprefix;
			$this->hashttps = (bool) $hashttps;
			$this->islocal = (bool) $islocal;
			$this->hasdebug = (bool) $hasdebug;
			$this->url = ($this->hashttps)?"https":"http";
			$this->url .= ($this->islocal)?$this->productionprefix:$this->remoteprefix; 
		}

		/**
		 * [hasHttps]
		 * @return bool
		 */
		public function hasHttps(){
			return $this->hashttps;
		}

		/**
		 * [hasDebug]
		 * @return bool 
		 */
		public function hasDebug(){
			return $this->hasdebug;
		}

		/**
		 * [isLocal]
		 * @return bools
		 */
		public function isLocal(){
			return $this->islocal;
		}

		/**
		 * [getUrl]
		 * @return string
		 */
		public function getUrl(){
			return $this->url;
		}

	}