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
        'short_url',
        [
            'attribute' => 'created_date',
            'contentOptions' => ['class' => 'td-center']
        ],
        'original_url',
        [
            'attribute' => 'click',
            'contentOptions' => ['class' => 'td-center']
        ],
    ],
]); ?>

<?php \yii\widgets\Pjax::end(); ?>