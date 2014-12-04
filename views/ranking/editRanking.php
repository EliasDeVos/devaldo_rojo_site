<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $oMatchModel app\models\forms\MatchForm */

?>
<div class="site-login">

    <p>Vul de match gegevens in</p>

    <?php $form = ActiveForm::begin([
        'id' => 'ranking-form',
        'action' => Url::to(['ranking/save-ranking']),
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
        ],
    ]);

    ?>
    <h3> Ranking </h3>

    <div class="table-bordered" id="fields">
        <div style="padding-top: 15px">
            <?php
            foreach ($aRankings as $i => $oRanking) {
                ?> <h4> <?php echo \app\models\Team::findOne(['teamId' => $oRanking->teamId])->name; ?></h4>
                <div class="row"> <?php
                    echo $form->field($oRanking, "[$i]teamId")->hiddenInput()->label('');
                    echo $form->field($oRanking, "[$i]gamesWon", ['options' => ['class' => 'col-lg-2']])->label('Gewonnen');
                    echo $form->field($oRanking, "[$i]gamesDraw", ['options' => ['class' => 'col-lg-2']])->label('Gelijk');
                    echo $form->field($oRanking, "[$i]gamesLost", ['options' => ['class' => 'col-lg-2']])->label('Verloren');
                    echo $form->field($oRanking, "[$i]goalsAgainst", ['options' => ['class' => 'col-lg-2']])->label('Tegen goals');
                    echo $form->field($oRanking, "[$i]goalsMade", ['options' => ['class' => 'col-lg-2']])->label('Gemaakte goals');
                    ?> </div>
            <?php

            }
            ?>
        </div>
    </div>


    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
