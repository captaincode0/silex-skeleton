<?php
	use Silex\Application;
	use Silex\Provider\TwigServiceProvider;
	use Silex\Provider\UrlGeneratorServiceProvider;
	use Silex\Provider\HttpFragmentServiceProvider;
	use Silex\Provider\MonologServiceProvider;

	class MyApplicationClass extends Application{
		use Application\TwigTrait;
		use Application\UrlGeneratorTrait;
		use Application\MonologTrait;

		public function __construct(array $values = array()){
			parent::__construct($values);

			//deploy application
			$this["debug"]=true;
			$this["production"]=true;
			$this["https"]=false;
			$this["asset.url"]=false;
			$this["override"]=false;
			$this["prefix-production.host"]="://silexskeleton.herokuapp.com/";
			$this["prefix.host"]="://www.myhost.com/myapp/";
			$this["host"] = ($this["production"])?$this["prefix-production.host"]:$this["prefix.host"];
			$this["host"] = ($this["https"])?"https".$this["host"]:"http".$this["host"];

			//register framework service providers
			$this->register(new UrlGeneratorServiceProvider());
			$this->register(new HttpFragmentServiceProvider());
			
			$this->register(new TwigServiceProvider(), array(
				"twig.path" => __DIR__."/../views"
			));

			/*
			$this->register(new MonologServiceProvider, array(
				"monolog.logfile" => __DIR__."/../var/log/webapp-text-logger"
			));*/

			$this["twig"] = $this->extend("twig", function($twig, $app){
				$twig->addFunction(new \Twig_SimpleFunction("asset", function($asset) use($app){
					if($app["asset.url"] 
						&& !$app["override"])
						return $app["host"]."web".$app["request_stack"]->getMasterRequest()->getBasePath()."/".ltrim($asset, "/");

					if($app["asset.url"]
						&& $app["override"])
						return $app["host"].$app["request_stack"]->getMasterRequest()->getBasePath()."/".ltrim($asset, "/");

					if(!$app["asset.url"])
						return ltrim($asset, "/");
 				}));
				return $twig;
			}); 
		}
	}

	return new MyApplicationClass();
