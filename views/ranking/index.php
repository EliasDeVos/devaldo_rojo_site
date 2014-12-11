<?php
use yii\helpers\Html;

?>
<div class="container">
    <div class="well">
        <?php
        if (Yii::$app->user->can('admin')) {
            echo Html::a('Edit', ['ranking/edit-ranking'], ['class' => 'btn btn-default', 'style' => 'float: right']);
        }
        ?>
        <table class="table">
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
                foreach ($aRankings as $iCounter => $oRanking):?>
                <td><?php echo $iCounter + 1 ?></td>
                <td><?php echo $oRanking['teamName'] ?></td>
                <td><?php echo $oRanking['gamesPlayed'] ?></td>
                <td><?php echo $oRanking['gamesWon'] ?></td>
                <td><?php echo $oRanking['gamesLost'] ?></td>
                <td><?php echo $oRanking['gamesDraw'] ?></td>
                <td><?php echo $oRanking['goalsMade'] ?></td>
                <td><?php echo $oRanking['goalsAgainst'] ?></td>
                <td><?php echo $oRanking['points'] ?></td>
            </tr>
            <?php endforeach ?>


            </tbody>
        </table>
    </div>
</div>