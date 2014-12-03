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


	echo '<h3> Ranking </h3>';
	echo '<div class="table-bordered" id="fields">';
	echo '<div padding-top: 15px">';
	foreach ($aRankings as $i => $oRanking)
	{
		echo '<div class="row">';
		echo $form->field($oRanking, "[$i]teamId")->hiddenInput()->label('');
		echo \app\models\Team::findOne(['teamId' => $oRanking->teamId])->name;
		echo $form->field($oRanking, "[$i]gamesWon", ['options' => ['class' => 'col-lg-2']])->label('Gewonnen');
		echo $form->field($oRanking, "[$i]gamesDraw", ['options' => ['class' => 'col-lg-2']])->label('Gelijk');
		echo $form->field($oRanking, "[$i]gamesLost", ['options' => ['class' => 'col-lg-2']])->label('Verloren');
		echo $form->field($oRanking, "[$i]goalsAgainst", ['options' => ['class' => 'col-lg-2']])->label('Tegen goals');
		echo $form->field($oRanking, "[$i]goalsMade", ['options' => ['class' => 'col-lg-2']])->label('Gemaakte goals');
		echo '</div>';

	}
	echo '</div>';
	echo '</div>';
	?>


	<div class="form-group">
		<div class="col-lg-offset-1 col-lg-11">
			<?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
		</div>
	</div>

	<?php ActiveForm::end(); ?>
</div>
