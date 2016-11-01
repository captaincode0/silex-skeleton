<?php 
	namespace Skeleton\HTTPControllers;

	use Silex\Application;
	use Silex\ControllerProviderInterface;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;

	/**
	 * @httpcontroller: main
	 * @desc: return the main page of this application.
	 */

	class MainHTTPController implements ControllerProviderInterface{
		public function connect(Application $app){
			$controllers = $app["controllers_factory"];

			$controllers->get("/", function() use($app){
				return $app["twig"]->render("index.html.twig");
			})
				->bind("index");

			$controllers->after(function(Request $request, Response $response, Application $app){
				$response->headers->set("content-type", "text/html");
			});

			return $controllers;
		}
	}