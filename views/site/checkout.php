<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\AuthAccess;
use yii\helpers\Url;


?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">Your order is completed.</p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Order N: <?=$ordernumber?></h2>
                <p>
                  
                </p>
                <p><a class="btn btn-outline-secondary" href="<?=url::to('/site/index')?>">Home</a></p>
            </div>
           
        </div>

    </div>
</div>
