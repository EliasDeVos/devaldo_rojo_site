<?php
\app\assets\PlayerAsset::register($this);
$this->title = 'Players';
use kartik\widgets\StarRating;

?>
<div class="container">
    <div class="row">
        <?php
        foreach ($aPlayers as $oPlayer) : ?>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="card">
                    <div class="title">
                        <img class="img-circle" src="pictures/players/<?php echo $oPlayer->firstName ?>.PNG"
                             width="15%"/>
                        <?php echo $oPlayer->firstName;
                        echo ' ';
                        echo $oPlayer->lastName ?>

                        <?php if ($oPlayer->isInjured) : ?>
                            <i class="fa fa-ambulance"></i>
                        <?php endif; ?>

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
                        <?php echo count($oPlayer->goals) ?>
                        <br>
                        <label>Wedstrijden</label>
                        <br>
                        <?php echo count($oPlayer->matches) ?>
                        <br>
                        <label>Rugnummer</label>
                        <br>
                        <?php echo $oPlayer->playerId ?>


                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>