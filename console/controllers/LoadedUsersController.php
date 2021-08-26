<?php

namespace console\controllers;

use common\components\UsersLoader;
use common\models\LoadedUsers;
use common\models\LoadedUsersSearch;
use yii\helpers\Console;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class LoadedUsersController extends \yii\console\Controller
{
	protected function strToConsole($xsText){
		echo mb_convert_encoding($xsText, 'cp850', 'utf-8')."\n";
	}


    public function actionLoad()
    {
		$this->strToConsole('A adatok áttöltése elindult (loaded-users/load) ...');
    	$oLoader = new UsersLoader();
    	$nLoaded = $oLoader->reset()->loadUsers();
        $this->strToConsole("A program futása befejezödött. Az áttöltött felhasználók száma:".$nLoaded);
        if ($oLoader->errorMsg) {
	        $this->strToConsole($oLoader->errorMsg);
		}
    }
}
