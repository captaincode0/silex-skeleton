<?php
	namespace Skeleton\Services;

	use Silex\Application;
	use Silex\ServiceProviderInterface;
	use Skeleton\Exception\WebAssetServiceProviderException;

	/**
	 * @service: WebAssetServiceProvider
	 * @desc: append the function asset to twig template language
	 * @params:
	 * 		-webasset.appendurl [bool]: true if you want to append the url.
	 * 		-webasset.path [string]: path to 
	 */

	class WebAssetServiceProvider implements ServiceProviderInterface{
		public function register(Application $app){
			$app["twig"] = $app->extend("twig", function($twig, $app){
				$twig->addFunction(new \Twig_SimpleFunction("asset", function($asset) use($app){
					if($app["webasset.appendurl"]){
						$application_url = $app["configurator"]->getUrl();

						//return the asset url
						return $application_url."web/".$app["webasset.path"].$app["request_stack"]->getMasterRequest()->getBasePath()."/".ltrim($asset, "/");
					}
					else
						return "web/".ltrim(rtrim($app["webasset.path"], "/"), "/")."/".ltrim($asset, "/");
				}));

				return $twig;
			});
		}

		public function boot(Application $app){
			try{
				if(!isset($app["webasset.appendurl"])
					|| !isset($app["webasset.path"]))
					throw new WebAssetServiceProviderException("WebAssetServiceProviderException: The provider needs all parameters to work");

				if(!is_bool($app["webasset.appendurl"])
					|| !is_string($app["webasset.path"]))
					throw new WebAssetServiceProviderException("WebAssetServiceProviderException: The provider needs that parameter webasset.appendurl be a boolean type and webasset.path be a string type");
			}
			catch(WebAssetServiceProviderException $ex){
				if($app["monolog"])
					$app["monolog"]->addCritical($ex->getMessage());
			}
		}
	}