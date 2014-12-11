<?php

namespace app\controllers;

use app\models\Ranking;
use app\models\Team;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\forms\LoginForm;
use app\models\forms\ContactForm;
use app\models\Player;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $aRankings = Ranking::find()->all();
        $aShortRankings = $this->getShortRanking($aRankings);
        $dNextMatch = $this->getNextMatch();
        $dNextMatchTime = new \DateTime($dNextMatch->matchTime);
        $dNextMatchTime = $dNextMatchTime->format('Y/m/d H:i:s');

        return $this->render('index', ['aShortRankings' => $aShortRankings, 'sNextMatchTime' => $dNextMatchTime]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $bIsPresent = $model->getUser()->isPresentOnNextMatch();
            return $this->render('index');
        }
        else {
            return $this->render(
                'login', [
                    'model' => $model,
                ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    private function getShortRanking($aRankings)
    {
        usort(
            $aRankings, function ($aRankingB, $aRankingA) {
                if ($aRankingA->gamesWon == $aRankingB->gamesWon) {
                    if ($aRankingA->gamesDraw == $aRankingB->gamesDraw) {
                        return 0;
                    }
                    else return $aRankingA->gamesDraw - $aRankingB->gamesDraw;
                }
                else return $aRankingA->gamesWon - $aRankingB->gamesWon;
            });
        $iDevaldoPos = 2;

        foreach ($aRankings as $iKey => $oRanking) {
            if ($oRanking->teamId == 1) {
                $iDevaldoPos = $iKey;
            }
        }
        $aShortRankings = array();
        for ($i = 0; $i < 7; $i++) {
            if ((($iDevaldoPos - 3 + $i)) >= 0 && (($iDevaldoPos - 3 + $i) < count($aRankings))) {
                $aShortRankings[$iDevaldoPos - 3 + $i] = $aRankings[$iDevaldoPos - 3 + $i];
            }
        }
        return $aShortRankings;
    }

    private function getNextMatch()
    {
        $dDateNow = new \DateTime();
        $oTeam = Team::findOne(['name' => 'Devaldo rojo']);
        $aAwayMatches = $oTeam->awayGames;// meest recent tot naar laatste
        $aHomeMatches = $oTeam->homeGames;
        usort(
            $aHomeMatches, function ($oMatchB, $oMatchA) {
                $dMatchA = new \DateTime($oMatchA->matchTime);
                $dMatchB = new \DateTime($oMatchB->matchTime);
                $dDateDiff = $dMatchA->diff($dMatchB);
                $iHours = $dDateDiff->format('%R%a')*24;
                $iHours += $dDateDiff->h;
                return $iHours;
            });
        usort(
            $aAwayMatches, function ($oMatchB, $oMatchA) {
                $dMatchA = new \DateTime($oMatchA->matchTime);
                $dMatchB = new \DateTime($oMatchB->matchTime);
                $dDateDiff = $dMatchA->diff($dMatchB);
                $iHours = $dDateDiff->format('%R%a')*24;
                $iHours += $dDateDiff->h;
                return $iHours;
            });
        $i = 0;
        do {
            $dMatchDate = new \DateTime($aAwayMatches[$i]->matchTime);
            $dDateDiff = $dDateNow->diff($dMatchDate);
            $iHours = $dDateDiff->format('%R%a')*24;
            $iHours += $dDateDiff->h;
            if ($iHours > 0) {
                $oMatchAway = $aAwayMatches[$i];
            }
            $i++;
        } while ($iHours < 0 && $i < count($aAwayMatches)+1);
        $i = 0;
        do {
            $dMatchDate = new \DateTime($aHomeMatches[$i]->matchTime);
            $dDateDiff = $dDateNow->diff($dMatchDate);
            $iHours = $dDateDiff->format('%R%a')*24;
            $iHours += $dDateDiff->h;
            if ($iHours > 0) {
                $oMatchHome = $aHomeMatches[$i];
            }
            $i++;
        } while ($iHours < 0 && $i < (count($aHomeMatches)+1));

        if (!isset($oMatchAway))
        {
            if (!isset($oMatchHome))
            {
                // geen volgende match

            }
            else
            {
                $oMatch = $oMatchHome;
            }

        }
        else
        {
            if (!isset($oMatchHome))
            {
                $oMatch = $oMatchAway;
            }
            else
            {
                $dHomeMatch = new \DateTime($oMatchHome->matchTime);
                $dAwayMatch = new \DateTime($oMatchAway->matchTime);
                $dDateDiff = $dHomeMatch->diff($dAwayMatch);
                $iHours = $dDateDiff->format('%R%a')*24;
                $iHours += $dDateDiff->h;
                if ($iHours > 0)
                {
                    $oMatch = $oMatchHome;
                }
                else
                {
                    $oMatch = $oMatchAway;
                }
            }

        }
        return isset($oMatch) ? $oMatch : 'Geen volgende match';

    }
}
