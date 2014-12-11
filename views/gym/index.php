<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>
    <div class="container">
        <div class="col-xs-12 col-md-4 col-lg-4">
            <div class="panel-group" id="accordion" aria-multiselectable="true">
                <?php foreach ($aGyms as $oGym) : ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" id="<?php echo $oGym->gymId ?>">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion"
                                   href="<?php echo '#collapse' . $oGym->gymId ?>"
                                   aria-expanded="true" aria-controls="<?php echo 'collapse' . $oGym->gymId ?>">
                                    <?php echo $oGym->name ?>
                                </a>
                            </h4>
                        </div>
                        <div id="<?php echo 'collapse' . $oGym->gymId ?>" class="panel-collapse collapse"
                             role="tabpanel"
                             aria-labelledby="<?php echo 'heading' . $oGym->gymId ?>">
                            <div class="panel-body" id="gyms">
                                <?php
                                echo 'Adress: ' . $oGym->street . ' ' . $oGym->houseNumber . '<br>';
                                echo 'Stad: ' . $oGym->city . ' ' . $oGym->postalCode . '<br>';
                                if (!Yii::$app->user->isGuest) :
                                    echo Html::a(
                                        'Navigate',
                                        ['gym/navigate', 'iGymId' => $oGym->gymId],
                                        [
                                            'data-pjax' => '#google_maps',
                                            'class' => 'btn btn-default'
                                        ]);
                                endif;
                                ?>
                            </div>
                        </div>

                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php Pjax::begin(['id' => 'google_maps', 'linkSelector' => '#gyms a']); ?>
        <div id="google_maps" class=" col-xs-12 col-md-12 col-lg-8">
            <?php if (Yii::$app->user->isGuest) : ?>
                Log je in om de route te kunnen bepalen naar de gym
            <?php endif ?>
            <?php if (!Yii::$app->user->isGuest) : ?>
                Klik op navigeer om de kortste weg te vinden naar de sporthal
            <?php endif ?>
        </div>
    </div>
<?php Pjax::end();
