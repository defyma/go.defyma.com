<?php
/**
 * UrlController.php
 *
 * @Author: Defy M Aminuddin <http://defyma.com>
 * @Email:  defyma85@gmail.com
 * @Filename: UrlController.php
 */

namespace app\controllers;

use app\components\Helper;
use app\models\THash;
use app\models\TLink;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class UrlController
 * @package app\controllers
 */
class UrlController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['POST','GET', 'OPTIONS'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age' => 3600,
                ],
            ],

        ]);
    }

    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result_link = null;

        $req = Yii::$app->request;
        if (!$req->isPost && !$req->isGet) {
            header("HTTP/1.0 405 Method Not Allowed");
            die('Method Not Allowed');
        }

        $type = $req->get('type', "");
        $link = $req->get('link', "");
        $hash = $req->get('hash', "");

        $type = Helper::cleanParam($type);
        $link = Helper::cleanParam($link);
        $hash = Helper::cleanParam($hash);

        $validate = Helper::validateParam([
            'type' => $type
        ]);

        if ($validate['status'] == "error")
            return $validate;

        $allowedType = ['short', 'decrypt'];
        if (!in_array($type, $allowedType))
            return [
                'status' => 'error',
                'message' => 'Status only "short" or "decrypt"'
            ];

        if($type === "short") {
            if (!$req->isPost) {
                header("HTTP/1.0 405 Method Not Allowed");
                die('Method Not Allowed');
            }

            $validate = Helper::validateParam([
                'link' => $link
            ]);
            if ($validate['status'] == "error")
                return $validate;

            if(Helper::validateUrl($link)) {

                $search = TLink::find()->where('link = :link', [
                    ':link' => $link
                ])->one();

                if($search) {
                    $hash = Helper::getUniqueStringFromID($search->id);
                    $result_link = Yii::$app->params['domain'] . $hash;
                } else {
                    $transaction = Yii::$app->db->beginTransaction();

                    $new_link = new TLink();
                    $new_link->link = $link;
                    $new_link->created_date = date('Y-m-d H:i:s');
                    $new_link->created_ip = Helper::getClientIP();
                    if($new_link->save()) {

                        $hash = Helper::getUniqueStringFromID($new_link->id);
                        $mdl_hash = new THash();
                        $mdl_hash->hash = $hash;
                        $mdl_hash->id_link = $new_link->id;

                        if($mdl_hash->save()) {
                            $transaction->commit();

                            $result_link = Yii::$app->params['domain'] . $hash;
                        } else {
                            $transaction->rollBack();
                            return [
                                'status' => 'error',
                                'message' => 'Internal error, please try again. (2) '
                            ];
                        }

                    } else {
                        $transaction->rollBack();
                        return [
                            'status' => 'error',
                            'message' => 'Internal error, please try again. (1) '
                        ];
                    }
                }
            } else {
                return [
                    'status' => 'error',
                    'message' => '['.$link.'] is not valid url'
                ];
            }

        } else {
            if (!$req->isGet) {
                header("HTTP/1.0 405 Method Not Allowed");
                die('Method Not Allowed');
            }

            $validate = Helper::validateParam([
                'hash' => $hash
            ]);
            if ($validate['status'] == "error")
                return $validate;

            $search = THash::find()->where('hash = :hash', [
                ':hash' => $hash
            ])->one();

            if($search) {
                $result_link = $search->link->link;
            } else {
                return [
                    'status' => 'error',
                    'message'=> 'Invalid Hash or Link was removed'
                ];
            }

        }

        return [
            'status' => 'success',
            'message'=> 'success',
            'link' => $result_link
        ];
    }

}