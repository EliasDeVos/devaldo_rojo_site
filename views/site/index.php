<?php
\app\assets\IndexAsset::register($this);
/* @var $this yii\web\View */
$this->title = 'Home';
?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-sm-4 col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <h1> Sponsors</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-image">
                                <img class="img" style="background-color: #009688" height="80px" width="100%">
                                <span class="card-title">Latje trap</span>
                            </div>
                            <div class="card-content">
                                    <span style="float: left; width: 35px;margin-top: -9px; text-align: center;">
                                        <img class="img-circle img-responsive" src="pictures/players/Elias.PNG"></span>

                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="3" aria-valuemin="0"
                                         aria-valuemax="10" style="width: 30%;">
                                        3
                                    </div>
                                </div>
                                <div>
                                    <span style="float: left; width: 35px; margin-top:-9px;text-align: center;">
                                        <img class="img-circle img-responsive"
                                             src="pictures/players/Frederique.PNG"></span>

                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="3" aria-valuemin="0"
                                             aria-valuemax="10" style="width: 20%;">
                                            2
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-sm-4 col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-image">
                                <img class="img" src="pictures/bg/KlassementBg.jpg" height="280px" width="100%">
                                <span class="card-title">Logo hier</span>
                            </div>

                            <div class="card-content">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac eros neque. Nulla
                                laoreet enim justo, non varius enim vestibulum quis. In mauris risus, dapibus ac
                                tristique ullamcorper, tincidunt at ipsum. Etiam consequat auctor nunc, et pellentesque
                                felis tempus in. Sed iaculis metus ac odio molestie, ut blandit sapien consequat.
                                Vestibulum pharetra consectetur velit et maximus. Suspendisse id ultrices enim. Nullam
                                pulvinar auctor pretium. Mauris eget facilisis tortor. Nulla ante nibh, faucibus in
                                dignissim aliquam, vehicula ut tellus. Nunc quam ipsum, rutrum in venenatis sed, viverra
                                nec turpis. Curabitur nec purus ut nibh condimentum lobortis. Phasellus lacinia purus ut
                                libero placerat finibus. Cras tempus in massa vel ornare. Proin eget nisi sed ligula
                                commodo fermentum. Aliquam dictum finibus augue id interdum.

                                Suspendisse ut consequat arcu. Nunc pulvinar laoreet metus, a volutpat sem aliquet a.
                                Fusce placerat vel dolor eget interdum. Donec congue viverra diam in ultrices. Nunc
                                ultricies venenatis scelerisque. Duis a nunc erat. Nunc et nunc sem. Nunc sollicitudin
                                nisl a elit scelerisque, sit amet accumsan odio eleifend.

                                Phasellus euismod dictum eros, nec dictum dui. Duis mattis, libero id maximus tincidunt,
                                quam mauris porttitor enim, at efficitur metus dui ut risus. Donec interdum blandit
                                vulputate. Integer sit amet vehicula nisi. Donec aliquam pulvinar erat, a commodo nisi
                                gravida eget. Fusce eget tincidunt enim. Maecenas sed egestas quam, eget ornare magna.
                                Ut a velit ut odio placerat ultrices id ac ligula. Duis vitae aliquet velit. Cras
                                aliquam mauris sit amet nulla mollis, at euismod odio fermentum. Fusce porta sem vel
                                semper mollis. Mauris pharetra laoreet libero eu vulputate.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-sm-4 col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-image">
                                <img class="img" style="background-color: #b0120a" height="80px" width="100%">
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
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-content" style="background-color: #03a9f4;color: #ffffff" id="clock">
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



