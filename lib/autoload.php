<?php

spl_autoload_register(function($class) {
	$path = str_replace(
		DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR,
		DIRECTORY_SEPARATOR,
		__DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) 
	) . '.php';

	if (file_exists($path)) {
		include $path;
	} else {
		return false;
	}
});