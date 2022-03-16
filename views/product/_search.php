<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 0
        ],
    ]); ?>
  
      <tr>
      <th scope="col"><?= $form->field($model, 'id') ?></th>
      <th scope="col"><?= $form->field($model, 'name') ?></th>
      <th scope="col"><?= $form->field($model, 'description') ?></th>
      <th scope="col" colspan="3"><?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?></th>
    </tr>

  
  
<!-- <div class="row">  
  <div class="col-lg-2">
  <?#= $form->field($model, 'id') ?>
  </div>
  <div class="col-lg-4">
    
  </div>
  <div class="col-lg-2">
    <?#= $form->field($model, 'quantity_in_stock') ?>
  </div>
  <div class="col-lg-2">
    <?#= $form->field($model, 'unit_price') ?>
  </div>


    <div class="form-group col-lg-2">
      <div col-lg-12><label>&nbsp;</label></div>
        <?#= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?#= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>
  </div> -->

    <?php ActiveForm::end(); ?>

</div>
