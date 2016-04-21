<?php

include dirname(__FILE__).'/bootshell.php';
use \ranktt\Ranktt;

/*
// load wordpress
define('WP_USE_THEMES', true);
require(WEBROOT.'/wp-blog-header.php');
exit;
*/

// 404
header(Ranktt::g($_SERVER,'SERVER_PROTOCOL','HTTP/1.1').' 404 Not Found');
exit;
