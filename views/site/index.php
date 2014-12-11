<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
use yii\helpers\Html;

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                <div class="row table-bordered" style="height: 150px">
                    <p>Sponsors</p>
                </div>
                <div class="row table-bordered" style="height: 150px">
                    <p>latje trap + carousel</p>
                </div>
            </div>
            <div class="col-lg-8 col-sm-8 col-md-8 col-xs-8">
                <div class="row table-bordered" style="height: 400px">
                    <p>Logo</p>
                </div>
                <div class="row table-bordered" style="height: 150px">
                    <p>biografie</p>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                <div class="row table-bordered" style="height: 300px">
                    <table>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Team</th>
                            <th>Played</th>
                            <th>Won</th>
                            <th>Lose</th>
                            <th>Draw</th>
                            <th>+</th>
                            <th>-</th>
                            <th>Points</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php
                            foreach ($aShortRankings as $iCounter => $oRanking):?>
                            <td><?php echo $iCounter + 1 ?></td>
                            <td><?php echo \app\models\Team::findOne(['teamId' => $oRanking->teamId])->name ?></td>
                            <td><?php echo $oRanking->calculateMatchPlayed() ?></td>
                            <td><?php echo $oRanking->gamesWon ?></td>
                            <td><?php echo $oRanking->gamesLost ?></td>
                            <td><?php echo $oRanking->gamesDraw ?></td>
                            <td><?php echo $oRanking->goalsMade ?></td>
                            <td><?php echo $oRanking->goalsAgainst ?></td>
                            <td><?php echo $oRanking->calculatePoints() ?></td>
                        </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div id="clock" class="row table-bordered" style="height: 150px">

                </div>
            </div>
        </div>

    </div>
<?php
$this->registerJs(
    '$("document").ready(function(){
     $("#clock").countdown("' . $sNextMatchTime . '").on("update.countdown", function(event) {
       var $this = $(this).html(event.strftime(""
     + "<span>%-w</span> week%!w "
     + "<span>%-d</span> day%!d "
     + "<span>%H</span> hr "
     + "<span>%M</span> min "
     + "<span>%S</span> sec"));
 });
     });'
);



