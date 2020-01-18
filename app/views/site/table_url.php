<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

\yii\widgets\Pjax::begin([
    'id' => 'pjax-link-gridview',
    'enablePushState' => false,
    'enableReplaceState' => false,
    'timeout' => 100000,
]);
?>

<?= GridView::widget([
    'id' => 'link-gridview',
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered table-custom'
    ],
    'filterUrl' => ['/site'],
    'columns' => [
        [
            'attribute' => 'short_url',
            'format' => 'raw',
            'contentOptions' => [
                'style' => 'max-width: 150px;'
            ],
            'value' => function($mdl) {
                $hash = explode('/', $mdl->short_url);
                $hash = end($hash);
                return '
                    <a id="'.$hash.'" href="https://'.$mdl->short_url.'" target="_blank">' . $mdl->short_url .'</a>
                ';
            }
        ],
        [
            'label' => '',
            'format' => 'raw',
            'contentOptions' => [
                'style' => 'max-width: 30px;'
            ],
            'value' => function ($model) {
                $hash = explode('/', $model->short_url);
                $hash = end($hash);
                return '
                    <a href="javascript:void(0)" onclick="GO_DEFYMA_COM.cp(\''.$hash.'\')" title="copy">
                        <img src="'.Yii::$app->request->getBaseUrl().'/img/cp.svg" style="width: 16px">
                    </a>
                ';
            }
        ],
        [
            'attribute' => 'created_date',
            'contentOptions' => ['class' => 'td-center']
        ],
        [
            'attribute' => 'original_url',
            'contentOptions' => [
                'style' => 'max-width: 300px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;'
            ],
            'format' => 'raw',
            'value' => function($mdl) {
                return '<a href="'.$mdl->original_url.'" target="_blank">' . $mdl->original_url .'</a>';
            }
        ],
//        'original_url',
        [
            'attribute' => 'click',
            'contentOptions' => ['class' => 'td-center']
        ],
    ],
]); ?>

<?php \yii\widgets\Pjax::end(); ?>