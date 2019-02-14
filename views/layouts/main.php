<?php
$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->csrfToken;

use yii\helpers\Html;
use yii\widgets\Menu;

/* @var $this \yii\web\View */
/* @var $content string */

\yii\web\YiiAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
	<?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/railscasts.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->request->getBaseUrl() ?>/css/global.css">
    <link rel="stylesheet" href="<?= Yii::$app->request->getBaseUrl() ?>/css/site.css">
    <link rel="stylesheet" href="<?= Yii::$app->request->getBaseUrl() ?>/css/custom.css">
    <link rel="author" href="<?= Yii::$app->request->getBaseUrl() ?>/humans.txt">
    <link rel="shortcut icon" href="<?= Yii::$app->request->getBaseUrl() ?>/favicon.ico">
    <meta name="keywords" content="defyma, save, share, shorten, short, shorturl, link" />
    <meta name="description" content="Get free & open source short URL from go.defyma.com" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div id="loading">
        <img src="<?= Yii::$app->request->getBaseUrl() ?>/img/eclipse.svg">
    </div>

    <nav>
        <div class="logo">
            <a href="https://go.defyma.com">
                go.defyma.com
            </a>
        </div>
        <ul class="menu">
            <div class="menu__item toggle"><span></span></div>
            <li class="menu__item"><a href="https://github.com/defyma/go.defyma.com" class="link link--dark"><i class="fa fa-github"></i> Github</a></li>
        </ul>
    </nav>

    <?= $content ?>

    <footer class="footer">
        go.defyma.com | URL Shortener
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="<?= Yii::$app->request->getBaseUrl() ?>/js/query.js"></script>
    <script type="text/javascript" src="<?= Yii::$app->request->getBaseUrl() ?>/js/js.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
