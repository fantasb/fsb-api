<?php
namespace ranktt;

use \ranktt\Ranktt;
use \ranktt\Api;

class Router {

	private static $routes = array(
		'' => 'home.php',
		'/hc' => 'hc.php',
		'/id' => 'id.php',
		'/test' => 'test.php',
	);
	private static $redirects = array(
	);
	private static $apiPath = '/api';

	public static function route($request, $requestMethod='GET'){

		if (strpos($request, self::$apiPath) === 0) {
			Api::request( substr($request, strlen(self::$apiPath)+1), $requestMethod );
			exit;
		}

		if (isset(self::$routes[$request])) {
			self::go(self::$routes[$request]);
		}

		if (isset(self::$redirects[$request])) {
			self::redirect(self::$redirects[$request]);
		}

	}

	private static function go($where){
		include WEBROOT.'/'.$where;
		exit;
	}

	private static function redirect($where){
		header('HTTP/1.1 301 Moved Permanently');
		header("Location: $where");
		exit;
	}

}
