<?php

namespace app\controllers;

use Yii;
use app\components\Helper;
use app\models\TClick;
use app\models\TLink;
use app\models\THash;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new Tlink();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGo($hash = null)
    {
        if (is_null($hash)) {
            throw new \yii\web\HttpException(404, 'Page Not Found');
        }

        $search = THash::find()->where('hash = :hash', [
            ':hash' => $hash
        ])->one();

        if ($search) {
            $model = new TClick();
            $model->id_link = $search->link->id;
            $model->click_date = date('Y-m-d H:i:s');
            $model->click_ip = Helper::getClientIP();
            $model->browser = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "Undefined";
            $model->save(false);

            header("Location: " . $search->link->link, true, 301);
            die();
        } else {
            throw new \yii\web\HttpException(404, 'Page Not Found');
        }
    }

}
