<?php

namespace frontend\controllers;

use common\components\UsersLoader;
use common\models\LoadedUsers;
use common\models\LoadedUsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * LoadedUsersController implements the CRUD actions for LoadedUsers model.
 */
class LoadedUsersController extends Controller
{

    /**
     * Lists all LoadedUsers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LoadedUsersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        // Ha egyenesen az index oldalra jövünk, akkor az alábbi paraméterek nem léteznek
		// így az index view nem rendereli a betöltéssel kapcsolatosinformációs szövegeket.
		$nLoadedUsersCount = \Yii::$app->request->get('loadedUsersCount');
		$sLoadedError = \Yii::$app->request->get('loadedError');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'loadedUsersCount' => $nLoadedUsersCount,
			'loadedError' => $sLoadedError,
        ]);
    }

	/**
	 * Az áttöltést végző action.
	 * @return string
	 */
    public function actionLoad()
    {
    	$oLoader = new UsersLoader();
    	$nLoaded = $oLoader->reset()->loadUsers();

    	// Átirányítás index-re, hogy oldal esetleges frissítésekor ne töltsön be ismét 10 felhasználót.
		return $this->redirect(['index', 'loadedUsersCount' => $nLoaded, 'loadedError' => $oLoader->errorMsg]);
    }


    /**
     * Displays a single LoadedUsers model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing LoadedUsers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LoadedUsers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LoadedUsers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LoadedUsers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LoadedUsers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
