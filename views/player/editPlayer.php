<?php


use kartik\widgets\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

\app\assets\PlayerFormAsset::register($this);

$this->title = 'edit player';
?>
<div class="site-login">
	<h1><?= Html::encode($this->title) ?></h1>

	<?php $form = ActiveForm::begin([
		'id' => 'player-form',
		'options' => ['class' => 'form-horizontal'],
		'action' => Url::to(['player/save-player']),
	]);
	echo '<h3>Adres</h3>';
	echo "<div class='row'>";
	echo $form->field($oPlayerModel, 'street', ['options' => ['class' => 'col-lg-3']])->label('straat') . $form->field($oPlayerModel, 'houseNumber', ['options' => ['class' => 'col-lg-3']])->label('huisnummer');
	echo "</div>";
	echo "<div class='row'>";
	echo $form->field($oPlayerModel, 'postalCode', ['options' => ['class' => 'col-lg-3']])->label('postcode') . $form->field($oPlayerModel, 'city', ['options' => ['class' => 'col-lg-3']])->label('Stad');
	echo "</div>";
	echo "<div class='row'>";
	echo $form->field($oPlayerModel, 'isInjured', ['options' => ['class' => 'col-lg-5 checkbox']])->checkbox()->label('is geblesseerd');
	echo "</div>";
	echo "<div class='row'>";
	echo $form->field($oPlayerModel, 'password', ['options' => ['class' => 'col-lg-3']])->label('wachtwoord');
	echo $form->field($oPlayerModel, 'email', ['options' => ['class' => 'col-lg-3']])->label('email');
	echo "</div>";
	echo "<div class='row'>";
	echo $form->field($oPlayerModel, 'gsmNumber', ['options' => ['class' => 'col-lg-3']])->label('gsm nummer');
	echo $form->field($oPlayerModel, 'playerId')->hiddenInput()->label('');
	echo "</div>";

	?>
	<div class="form-group" style="margin-top: 50px">
		<div class="col-lg-offset-1 col-lg-11">
			<?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
		</div>
	</div>

	<?php ActiveForm::end(); ?>
</div>
