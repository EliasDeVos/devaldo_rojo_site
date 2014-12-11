<?php
use yii\helpers\Html;
use app\models\Team;
use app\models\Gym;

?>
<div class="container">
    <h1 style="float: left"> Match Overzicht voor <?php echo $sTeamFromUser ?></h1>
    <?php
    if (Yii::$app->user->can('admin')) :
        echo Html::a('Add', ['match/edit-match'], ['class' => 'btn btn-default', 'style' => 'float: right']);
    endif ?>
    <div class="row">
        <?php
        foreach ($aMatches as $oMatch) :?>
            <div class="col-xs-12 col-md-11 col-sm-12  col-lg-11">
                <ul class="event-list" >
                    <li>
                        <time class="<?php echo $oMatch['resultaat'] ?>">
                    <span class="day"><?php
                        $datetime = new DateTime($oMatch['matchTime']);
                        echo $datetime->format('d');
                        ?></span>
                    <span class="month">
                        <?php
                        echo $datetime->format('M');
                        ?>

                    </span>
                        </time>
                        <div class="info">
                            <div class="row">
                                <div class="col-lg-3 col-lg-offset-1 col-sm-4">
                                    <h3 class="title"><?php echo Team::findOne(['teamId' => $oMatch['homeTeamId']])->name ?></h3>
                                </div>
                                <div class="col-sm-1">
                                    <h3 class="title">-</h3>
                                </div>
                                <div class="col-lg-3 col-lg-offset-1 col-sm-4">
                                    <h3 class="title"><?php echo Team::findOne(['teamId' => $oMatch['awayTeamId']])->name ?></h3>
                                </div>
                                <div class="col-lg-1  col-sm-1 ">
                                    <h3 class="title"><?php echo $oMatch['homeTeamGoals'] ?></h3>
                                </div>
                                <div class="col-lg-1 col-sm-1">
                                    <h3 class="title">-</h3>
                                </div>
                                <div class="col-lg-1 col-sm-1">
                                    <h3 class="title"><?php echo $oMatch['awayTeamGoals'] ?></h3>
                                </div>
                            </div>
                            <ul>
                                <?php $oMatch = \app\models\Match::findOne(['matchId' => $oMatch['matchId']]); ?>
                                <li style="width:10%;"
                                    data-toggle="tooltip" data-placement="right"
                                    title="<?php
                                    foreach ($oMatch->goals as $oPlayer) {
                                        echo \app\models\Player::findOne(['playerId' => $oPlayer->playerId])->firstName . "\n";
                                    }
                                    ?>"><span class="fa fa-futbol-o"></span> <?php
                                    echo count($oMatch->goals);
                                    ?> </li>
                                <li style="width:70%; margin:0 auto" >
                                    <span
                                        class="fa fa-home"></span><?php echo '  ' . Gym::findOne(['gymId' => $oMatch->gymId])->name ?>
                                </li>
                                <li style="width:20%;" data-toggle="tooltip" data-placement="left"
                                    title="<?php
                                    foreach ($oMatch->playerPresence as $oPlayer) {
                                        echo \app\models\Player::findOne(['playerId' => $oPlayer->playerId])->firstName . "\n";
                                    }
                                    ?>"><span class="fa fa-male"></span> <?php echo count($oMatch->playerPresence) ?>
                                </li>
                            </ul>

                        </div>

                    </li>

                </ul>

            </div>

            <div class="col-md-1" style="padding-top: 40px">
                <?php

                if (Yii::$app->user->can('admin')) :
                    echo Html::a('Edit', ['match/edit-match', 'matchId' => $oMatch['matchId']], ['class' => 'btn btn-default', 'style' => 'float: right']);
                endif ?>
            </div>
        <?php endforeach ?>
    </div>

</div>