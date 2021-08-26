<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

$sUrl = Yii::$app->params['source_url'];
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Felhasználó áttöltő program!</h1>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-6">
                <h2>Leírás</h2>

                <p>A program a <?= \yii\helpers\Html::encode($sUrl) ?> címről tölt át felhasználókat,
                    egyszerre 10-et, illetve hiba esetén egyet sem.
				</p>

                <p>A Felhasználók menüpontban jeleníthetjük meg az áttöltött felhasználókat, illetve innen tudunk áttöltést
					indítani.
				</p>

                <p>Áttöltés idítására lehetőség van parancssorból is a run_loaduser.bat (run_loaduser.sh) parancsfájl segítségével.
				</p>

            </div>
            <div class="col-lg-3">
            </div>
        </div>

    </div>
</div>
