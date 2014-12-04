<?php
use app\models\Gym;
use app\models\Season;
use app\models\Team;
use kartik\widgets\DatePicker;
use kartik\widgets\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $oMatchModel app\models\forms\MatchForm */

$this->title = 'Match';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Vul de match gegevens in</p>

    <?php $form = ActiveForm::begin([
        'id' => 'match-form',
        'action' => Url::to(['match/save-match']),
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
        ],
    ]);
    ?>
    <div class="col-lg-9 col-md-8 col-sm-8">
        <div class="row">
            <?php echo $form->field($oMatchModel, 'homeTeamId', ['options' => ['class' => 'col-lg-4']])->dropDownList(ArrayHelper::map(Team::find()->all(), 'teamId', 'name'))->label('Home team');
            echo $form->field($oMatchModel, 'awayTeamId', ['options' => ['class' => 'col-lg-4']])->dropDownList(ArrayHelper::map(Team::find()->all(), 'teamId', 'name'))->label('Away team'); ?>
        </div>
        <div class="row">
            <?php
            echo $form->field($oMatchModel, 'homeTeamGoals', ['options' => ['class' => 'col-lg-4']])->label('Home team goals');
            echo $form->field($oMatchModel, 'awayTeamGoals', ['options' => ['class' => 'col-lg-4']])->label('Away team goals');
            ?>
        </div>
        <div class="row">
            <?php
            echo $form->field($oMatchModel, 'matchTime', ['options' => ['class' => 'col-lg-4']])->widget(DateTimePicker::className(), ['attribute' => 'dateTime', 'options' => ['placeholder' => 'Enter match date', 'readonly' => 'TRUE'],
                'pluginOptions' => [
                    'autoClose' => true
                ]]);
            echo $form->field($oMatchModel, 'gymId', ['options' => ['class' => 'col-lg-3']])->dropDownList(ArrayHelper::map(Gym::find()->all(), 'gymId', 'name'))->label('Gym');
            echo $form->field($oMatchModel, 'seasonId', ['options' => ['class' => 'col-lg-3']])->dropDownList(ArrayHelper::map(Season::find()->all(), 'seasonId', 'year'))->label('Seizoen');
            ?>
        </div>
        <div class="row">
            <?php
            echo $form->field($oMatchModel, 'matchId')->hiddenInput()->label('');
            ?>
        </div>
        <div class="row">
            <?php
                echo $form->field($oMatchModel, "present")->checkboxList(ArrayHelper::map(\app\models\Player::find()->all(), 'playerId', 'firstName'))->label('Aanwezigheden');

            ?>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
                </div>
            </div>
        </div>


    </div>
    <div class="col-lg-3 table-bordered">
        <h3 style="float: left"> Goals </h3>

        <div id="fields">
            <div style="float: right;padding-top: 15px">
	<span id="add" class="glyphicon glyphicon-plus">
            </div>
            <?php
            foreach ($aGoals as $i => $oGoalModel) {
                echo $form->field($oGoalModel, "[$i]playerId", ['options' => ['class' => 'col-lg-12']])->dropDownList(ArrayHelper::map(\app\models\Player::find()->all(), 'playerId', 'firstName'))->label('Speler');
            }
            ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
</div>