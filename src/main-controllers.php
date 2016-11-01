<?php
	use Skeleton\HTTPControllers\MainHTTPController;

	//mount one application controller
	$app->mount("/", new MainHTTPController());