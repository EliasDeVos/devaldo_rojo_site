<?php
\app\assets\PlayerAsset::register($this);
$this->title = 'Players';
use kartik\widgets\StarRating;

?>
<div class="row">
    <?php
    foreach ($aPlayers as $oPlayer) : ?>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="title">
                    <img class="img-circle" src="pictures/players/<?php echo $oPlayer->firstName ?>.PNG" width="11%"/>
                    <?php echo $oPlayer->firstName;
                    echo ' ';
                    echo $oPlayer->lastName ?>
                </div>
                <div class="content">
                    <label>
                        Positie
                    </label>
                    <br>
                    <?php echo $oPlayer->preferredPosition; ?>
                    <br>
                    <label>Doelpunten</label>
                    <br>
                    8
                    <!--<?php
                    echo StarRating::widget([
                        'name' => 'rating_1',
                        'value' => $oPlayer->condition,

                        'pluginOptions' => [
                            'size'=>'xs',
                            'readonly' => true,
                            'showClear' => false,
                            'showCaption' => false,
                            'glyphicon' => false,
                        ],
                    ]);?>
                    <?php
                    echo StarRating::widget([
                        'name' => 'rating_2',
                        'value' => $oPlayer->speed,

                        'pluginOptions' => [
                            'size'=>'xs',
                            'readonly' => true,
                            'showClear' => false,
                            'showCaption' => false,
                            'glyphicon' => false,
                        ],
                    ]);?>-->
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>