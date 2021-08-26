<?php

namespace common\components;

use common\models\LoadedUsers;
use Yii;
use yii\base\Exception;
use yii\helpers\Json;
use yii\httpclient\Client;

class UsersLoader
{
	const ERROR_TEXT = 'Hiba az adatok áttöltése közben! (Lsd.: log, [USERS_LOADER])';
	const LOADABLE_USERS_COUNT = 10;
	public $result = null;
	public $errorMsg;

	public function reset(){
		$this->result=true;
		$this->errorMsg=null;
		return $this;
	}

	/**
	 * A kapott tömb alapján (ami egy felhasználó adatait tartalmazza) elvégzi a
	 * felhasználó adatbázisba írását.
	 * @param $xaData
	 */
	protected function saveToDb($xaData){
		$oModel = new LoadedUsers();
		$oModel->name = $xaData['name']['last']. ' ' . $xaData['name']['first'];
 		$oModel->age = $xaData['dob']['age'];
		$oModel->city = $xaData['location']['city'];
		$oModel->country  = $xaData['location']['country'];
		$oModel->email = $xaData['email'];
		$oModel->salt = $xaData['login']['salt'];
		$oModel->password = $xaData['login']['sha256'];
		$oModel->picture = $xaData['picture']['large'];
		$bResult = $oModel->save();
		if (!$bResult) {
			$this->error(static::ERROR_TEXT, implode(', ', $oModel->errors));
		}
	}

	/**
	 * Az áttekinthetőség és karbantarthatóság miatt.
	 * @param $xsMsgToPage
	 * @param $xsMsgToLog
	 */
	protected function error($xsMsgToPage, $xsMsgToLog){
		$this->result = false;
		$this->errorMsg = $xsMsgToPage;
		Yii::error($xsMsgToLog, 'USERS_LOADER');
	}

	/**
	 * Egy darab felhazsnálót lekédrez és adatbázisba ment.
	 */
	public function loadOneUser(){
		$sUrl = Yii::$app->params['source_url'];
		$client = new Client();
		try {
			$response = $client->createRequest()
				->setMethod('GET')
				->setUrl($sUrl)
				->send();
			if ($response->isOk) {
				$aResult = Json::decode($response->content);
				$this->saveToDb($aResult['results'][0]);
			}
			else{
				$this->error(static::ERROR_TEXT, 'Hiba');
			}
		}
		catch (Exception $e) {
				$this->error(static::ERROR_TEXT, $e->getMessage() );
		}
	}

	/**
	 * 10 felhasználót áttölt és adatbázisba ír
	 * Az egész egy tranzakcióban fut, mivel a feladat 10 felhasználó áttöltése,
	 * ezért a 10 felhasználót egy csomagnak tekintem.
	 *
	 * @return int
	 */
	public function loadUsers(){
		$oTransaction = Yii::$app->getDb()->beginTransaction();
		for ($i = 0 ; $i < static::LOADABLE_USERS_COUNT ; $i++ ) {
			$this->loadOneUser();
			if (!$this->result) {
				break;
			}
		}
		if (!$this->result) {
			$oTransaction->rollBack();
			return 0;
		}
		else{
			$oTransaction->commit();
		}
		return $i;
	}
}
