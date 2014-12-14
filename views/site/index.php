<?php
\app\assets\IndexAsset::register($this);
/* @var $this yii\web\View */
$this->title = 'Home';
?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-sm-4 col-md-4 col-xs-4">
                <div class="row table-bordered" style="height: 150px">
                    <p>Sponsors</p>
                </div>
                <div class="row table-bordered" style="height: 150px">
                    <p>latje trap + carousel</p>
                </div>
            </div>
            <div class="col-lg-7 col-sm-4 col-md-4 col-xs-4">
                <div class="row table-bordered" style="height: 400px">
                    <p>Logo</p>
                </div>
                <div class="row table-bordered" style="height: 150px">
                    <p>biografie</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-4 col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-image">
                                <img class="img" src="pictures/bg/KlassementBg.jpg" height="80px" width="100%">
                                <span class="card-title">Klassement</span>
                            </div>

                            <div class="card-content">
                                <table>
                                    <thead>
                                    <tr>
                                        <th width="8%">#</th>
                                        <th width="72%">Team</th>
                                        <th width="15%">Pl</th>
                                        <th width="5%">Pts</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <?php
                                        foreach ($aShortRankings as $iCounter => $oRanking):?>
                                        <td><?php echo $iCounter + 1 ?></td>
                                        <td><?php echo \app\models\Team::findOne(['teamId' => $oRanking->teamId])->name ?></td>
                                        <td><?php echo $oRanking->calculateMatchPlayed() ?></td>
                                        <td><?php echo $oRanking->calculatePoints() ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div  class="row">
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-content" id = "clock">
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
$this->registerJs(
    '$("document").ready(function(){
     $("#clock").countdown("' . $sNextMatchTime . '").on("update.countdown", function(event) {
       var $this = $(this).html(event.strftime(""
       +"<h4>Volgende match in: </h4>"
     + "<span>%-d</span> day%!d "
     + "<span>%H</span> hr "
     + "<span>%M</span> min "
     + "<span>%S</span> sec"));
 });
     });'
);



