<?php

/*
 ██████╗ █████╗ ██████╗ ████████╗ █████╗ ██╗███╗   ██╗
██╔════╝██╔══██╗██╔══██╗╚══██╔══╝██╔══██╗██║████╗  ██║
██║     ███████║██████╔╝   ██║   ███████║██║██╔██╗ ██║
██║     ██╔══██║██╔═══╝    ██║   ██╔══██║██║██║╚██╗██║
╚██████╗██║  ██║██║        ██║   ██║  ██║██║██║ ╚████║
 ╚═════╝╚═╝  ╚═╝╚═╝        ╚═╝   ╚═╝  ╚═╝╚═╝╚═╝  ╚═══╝
                                                      
         ██████╗ ██████╗ ██████╗ ███████╗             
        ██╔════╝██╔═══██╗██╔══██╗██╔════╝             
        ██║     ██║   ██║██║  ██║█████╗               
        ██║     ██║   ██║██║  ██║██╔══╝               
        ╚██████╗╚██████╔╝██████╔╝███████╗             
         ╚═════╝ ╚═════╝ ╚═════╝ ╚══════╝             
                 
                 SILEX SKELETON                                     
*/
	use Silex\Application;
	use Silex\Provider\TwigServiceProvider;
	use Silex\Provider\UrlGeneratorServiceProvider;
	use Silex\Provider\MonologServiceProvider;
	use Skeleton\Services\WebAssetServiceProvider;
	use Skeleton\Services\ApplicationSetUpServiceProvider;


	class MyApplicationClass extends Application{
		use Application\TwigTrait;
		use Application\UrlGeneratorTrait;
		use Application\MonologTrait;

		public function __construct(array $values = array()){
			parent::__construct($values);

			$this->register(new UrlGeneratorServiceProvider());
			
			$this->register(new TwigServiceProvider(), array(
				"twig.path" => __DIR__."/../views"
			));
			
			$this->register(new MonologServiceProvider, array(
				"monolog.logfile" => __DIR__."/../var/log/webapp-text-logger"
			));
		}
	}

	$app = new MyApplicationClass();

	$app->register(new ApplicationSetUpServiceProvider(), array(
			"setup.localprefix" => "://silexskeleton.herokuap.com/",
			"setup.remoteprefix" => "://silexskeleton.herokuap.com/",
			"setup.hashttps" => false,
			"setup.islocal" => true,
			"setup.debug" => true
		)
	);

	$app["debug"] = $app["configurator"]->hasDebug();

	$app["webasset.path"] = "assets";
	$app["webasset.appendurl"] = false;

	$app->register(new WebAssetServiceProvider());

	return $app;
