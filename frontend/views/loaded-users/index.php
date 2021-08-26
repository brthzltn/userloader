<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LoadedUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Áttöltött felhasználók';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loaded-users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
			echo Html::a('Áttöltés', ['load'], ['class' => 'btn btn-success']);
			if (isset($loadedUsersCount) ) {
				echo 'Legutóbb áttöltött felhaszálók:'.$loadedUsersCount;
			}
			if (isset($loadedError) ) {
				echo Html::tag('span',$loadedError,['style'=>'color:red; margin-left:20px;']) ;
			}
		?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'age',
            'country',
            'city',
            ['attribute'=>'picture',
				'value'=> function($model){
    				return Html::img($model->picture);
				},
				'format' => 'html'],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
