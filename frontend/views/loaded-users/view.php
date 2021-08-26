<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LoadedUsers */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Loaded Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="loaded-users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Módosítás', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Törlés', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Valóban törölni akarod?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

	<?php
		echo Html::img($model->picture);
	?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'age',
            'city',
            'country',
            'email:email',
            'picture',
        ],
    ]) ?>

</div>
