<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>.navbar-nav > li > a {
            padding-top: 10px;
            padding-bottom: 10px;
            line-height: 51px;
        }</style>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
		<?php
		?>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
						<?php echo Html::a(
							'<img src="pictures/logo/Soccer-Ball-Devil.png" width="15%"/>   Devaldo rojo',
							['site/index'],
							['class' => 'navbar-brand']
						); ?>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right" style="">
						<li> <?php echo Html::a(
								'Players',
								['player/index']
							); ?></li>
						<li> <?php echo Html::a(
								'Gyms',
								['gym/index']
							); ?></li>
						<li> <?php echo Html::a(
								'Ranking',
								['ranking/index']
							); ?></li>
						<li> <?php echo Html::a(
								'Statistieken',
								['statistics/index']
							); ?></li>
						<li> <?php echo Html::a(
								'Matches',
								['match/index']
							); ?></li>

						<?php if (Yii::$app->user->isGuest) : ?>
							<li> <?php echo Html::a(
									'Login',
									['site/login']
								); ?></li>
						<?php endif;
						if (!Yii::$app->user->isGuest) :?>
							<li>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" > <img class="img-circle" src="pictures/players/<?php echo Yii::$app->user->identity->username ?>.PNG" width="25%"/> <?php echo Yii::$app->user->identity->username ?></a>
								<ul class="dropdown-menu" role="menu">
									<li> <?php echo Html::a(
											'Logout',
											['site/logout'],
											['data-method' => 'post']
										); ?></li>
									<li> <?php echo Html::a(
											'Change profile',
											['player/edit-player', 'playerId' => Yii::$app->user->id]
										); ?></li>
								</ul>
							</li>
						<?php endif ?>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
        <div  style="margin-top: 40px">
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
