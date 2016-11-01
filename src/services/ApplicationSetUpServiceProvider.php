<?php 
	namespace Skeleton\Services;

	use Silex\Application;
	use Silex\ServiceProviderInterface;
	use Skeleton\Services\ApplicationSetUp;
	use Skeleton\Exception\ApplicationSetUpServiceProviderException;

	/**
	 * @service: ApplicationSetUpServiceProvider
	 * @desc: configure the application global variables
	 * @params
	 * 		-setup.localprefix: local application url prefix.
	 * 		-setup.remoteprefix: remote application url prefix.
	 * 		-setup.debug: set the application debug.
	 * 		-setup.islocal: flag for run the application in a local runtime environment.
	 * 		-setup.hashttps: flag to build the application url to be used in WebAssetServiceProvider.
	 */

	class ApplicationSetUpServiceProvider implements ServiceProviderInterface{
		public function register(Application $app){
			$app["configurator"] = $app->share(function() use($app){
				return new ApplicationSetUp(
					$app["setup.localprefix"],
					$app["setup.remoteprefix"],
					$app["setup.hashttps"],
					$app["setup.islocal"],
					$app["setup.debug"]
				);
			});
		}

		public function boot(Application $app){
			$app->share(function() use($app){
				try{
					if(!isset($app["setup.localprefix"])
						|| !isset($app["setup.remoteprefix"])
						|| !isset($app["setup.debug"])
						|| !isset($app["setup.islocal"])
						|| !isset($app["setup.hashttps"]))
						throw new ApplicationSetUpServiceProviderException("ApplicationSetUpServiceProviderException: All parameters need to be setted in the service");

					if(!is_string($app["setup.localprefix"])
						|| !is_string($app["setup.remoteprefix"]))
						throw new ApplicationSetUpServiceProviderException("ApplicationSetUpServiceProviderException: The parameters setup.localprefix and setup.remoteprefix need to be string data type");

					if(!is_bool($app["setup.debug"])
						|| !is_bool($app["setup.islocal"])
						|| !is_bool($app["setup.hashttps"]))
						throw new ApplicationSetUpServiceProviderException("ApplicationSetUpServiceProviderException: The parameters setup.islocal, setup.debug and setup.hashttp need to be booolean data type");

				}
				catch(ApplicationSetUpServiceProviderException $ex){
					if($app["monolog"])
						$app["monolog"]->addCritical($ex->getMessage());
				}

			});
		}
	}