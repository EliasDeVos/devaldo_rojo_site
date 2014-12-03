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

	echo '<div class="row">';
	echo $form->field($oMatchModel, 'homeTeamId', ['options' => ['class' => 'col-lg-3']])->dropDownList(ArrayHelper::map(Team::find()->all(), 'teamId', 'name'))->label('Home team');
	echo $form->field($oMatchModel, 'awayTeamId', ['options' => ['class' => 'col-lg-3']])->dropDownList(ArrayHelper::map(Team::find()->all(), 'teamId', 'name'))->label('Away team');
	echo '<h3 style="float: left"> Goals </h3>';
	echo '<div class="table-bordered col-lg-4" id="fields">';
	echo '<div style="float: right;padding-top: 15px">';
	echo '<span id="add" class="glyphicon glyphicon-plus">';
	echo '</div>';
	foreach ($aGoals as $i => $oGoalModel)
	{
		echo $form->field($oGoalModel, "[$i]playerId", ['options' => ['class' => 'col-lg-12']])->dropDownList(ArrayHelper::map(\app\models\Player::find()->all(), 'playerId', 'firstName'))->label('Speler');
	}
	echo '</div>';
	echo '</div>';
	echo '<div class="row">';
	echo $form->field($oMatchModel, 'homeTeamGoals', ['options' => ['class' => 'col-lg-3']])->label('Home team goals');
	echo $form->field($oMatchModel, 'awayTeamGoals', ['options' => ['class' => 'col-lg-3']])->label('Away team goals');
	echo '</div>';
	echo '<div class="row">';

	echo $form->field($oMatchModel, 'matchTime', ['options' => ['class' => 'col-lg-3']])->widget(DateTimePicker::className(), ['attribute' => 'dateTime', 'options' => ['placeholder' => 'Enter match date', 'readonly' => 'TRUE'],
		'pluginOptions' => [
			'autoClose' => true
		]]);
	echo $form->field($oMatchModel, 'gymId', ['options' => ['class' => 'col-lg-3']])->dropDownList(ArrayHelper::map(Gym::find()->all(), 'gymId', 'name'))->label('Gym');
	echo $form->field($oMatchModel, 'seasonId', ['options' => ['class' => 'col-lg-3']])->dropDownList(ArrayHelper::map(Season::find()->all(), 'seasonId', 'year'))->label('Seizoen');
	echo $form->field($oMatchModel, 'matchId', ['options' => ['class' => 'col-lg-3']])->hiddenInput()->label('');
	echo '</div>';

	?>


	<div class="form-group">
		<div class="col-lg-offset-1 col-lg-11">
			<?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
		</div>
	</div>

	<?php ActiveForm::end(); ?>
</div>