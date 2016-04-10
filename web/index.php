<?php
	ini_set("display_errors", 1);

	require_once __DIR__."/../vendor/autoload.php";
	require __DIR__."/../src/controllers/ControllersLoader.php";
	require __DIR__."/../src/services/ServicesLoader.php";
	$app = require __DIR__."/../src/app.php";
	require __DIR__."/../src/main-controllers.php";
	$app->run(); 

