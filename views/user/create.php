<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usertable */

$this->title = 'Create Usertable';
$this->params['breadcrumbs'][] = ['label' => 'Usertables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usertable-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
