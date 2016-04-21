<?php
namespace ranktt\controllers;

use \ranktt\Ranktt;
use \ranktt\core\ApiControllerAbstract;
//use \ranktt\controllers\Exception as ApiControllerException;

class App extends ApiControllerAbstract {

	public function getAppVersion(){
		// @todo: cache this
		$gitHash = str_replace("\n",'',`git rev-parse HEAD`);
		return array('git_hash'=>$gitHash);
	}

}
