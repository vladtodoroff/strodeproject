<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);

Yii::$app->name = "Strode Store";
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>
<?#=@$_SERVER['REMOTE_ADDR']?>
<header>
    <?php
  $cart = "";
$session = yii::$app->session;
if ($session['cart'] !== null && is_array($session['cart']) )  $cart = '(' . count($session['cart']).')';

  
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Strode', 'url' => ['/site/strode']],
            ['label' => 'Contact', 'url' => ['/site/contact']],

            Yii::$app->user->isGuest ? ['label' => 'SignUp', 'url' => ['/site/signup']] : "",
            !Yii::$app->user->isGuest ? ['label' => 'Products', 'url' => ['/product/index']] : "",
            
            (!Yii::$app->user->isGuest && Yii::$app->session['urole'] == 10) ? (
            ['label' => 'Admin', 'url' => ['#'],
             'template' => '<a href="{url} >" {label}</a>',
              'items' => 
             [
               ['label' => 'Product', 'url' => '/product/index'],
               ['label' => 'User', 'url' => '/user/index'],
               ['label' => 'Something else', 'url' => '#'],
               
             ],
            
            ]
            
            
            ) : "",
            // Shoping card
            !Yii::$app->user->isGuest ? ['label' => 'Cart '.$cart, 'url' => ['/site/cart']] : "",
            //
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
                
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ' R:'.Yii::$app->session['urole'].')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; Strode <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
