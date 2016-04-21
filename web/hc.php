<?php
if (!defined('WEBROOT'))
	exit;

use \ranktt\Ranktt;

//checkDb();

header('Content-Type: text/plain');
echo 'OK';

function checkDb(){
	try {
		$db = new mysqli(Ranktt::getConfig('DB_HOST'), Ranktt::getConfig('DB_USER'), Ranktt::getConfig('DB_PASSWORD'), Ranktt::getConfig('DB_NAME'), Ranktt::getConfig('DB_PORT'));
		if (!empty($db->connect_error))
			throw new \Exception('Error connecting to DB. Errno: '.$db->connect_errno);
		$req = $db->query('show tables');
		if (!$req)
			throw new \Exception('Error querying DB');
		$r = $req->fetch_assoc();
		if (!($r && current($r)))
			throw new \Exception('Expecting at least one table');
	} catch (\Exception $e) {
		errorOut('db', $e->getMessage()."\n".$e->getTraceAsString());
	}
}

function errorOut($errorKey, $error){
	header('HTTP/1.1 503 Service Unavailable');
	header('X-Error-Key: '.$errorKey);
	header('Retry-After: 60');
	echo $error;
	exit;
}
