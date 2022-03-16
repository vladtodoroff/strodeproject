<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use app\models\AuthAccess;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <? if (AuthAccess::checkRole("Admin"))  echo Html::a('Create Products', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php #Pjax::begin(); ?>

    
  <table class="table">
    <thead >
<!--       <tr>
        <th scope="col">ID</th>
        <th scope="col">Product name</th>
        <th scope="col">Description</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
        <th scope="col"></th>
      </tr> -->
  
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    </thead>
    
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_product_item',
        'layout' => '<tbody>{items}</tbody></table><nav>{pager}</nav>',
        'pager' => [
          'options' => [
            'tag' => 'ul',
            'class' => 'pagination justify-content-center',
            'id' => 'pager-container',
          ],
          //First option value
          'firstPageLabel' => 'first',
          //Last option value
          'lastPageLabel' => 'last',
          //Previous option value
          'prevPageLabel' => 'previous',
          //Next option value
          'nextPageLabel' => 'next',
          //Current Active option value
          'activePageCssClass' => 'page-active',
          //Max count of allowed options
          'maxButtonCount' => 3,

          // Css for each options. Links
          'linkOptions' => ['class' => 'page-link'],
          'disabledPageCssClass' => 'd-none',

          // Customzing CSS class for navigating link
          'pageCssClass' => ['class' => 'page-item'],
          'prevPageCssClass' => 'page-back',
          'nextPageCssClass' => 'page-next',
          'firstPageCssClass' => 'page-first',
          'lastPageCssClass' => 'page-last',
          ],

    ]) ?>
    
  
  
  
    <?#= GridView::widget([
//         'dataProvider' => $dataProvider,
//         'filterModel' => $searchModel,
//         'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],

//             'id',
//             'name',
//             'description',
//             'quantity_in_stock',
//             'unit_price',

//             ['class' => 'yii\grid\ActionColumn'],
//         ],
//     ]); 
  ?>

    <?php #Pjax::end(); ?>

</div>
