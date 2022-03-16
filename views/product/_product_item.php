<? 
/*
* Product view
*  Yii::$app->formatter->asRelativeTime($model->datetime)
 @var $model \app\models\Products
 */
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
 ?>


<tr>
  <th scope="row" style="max-width:20px"><?=$model->id?></th>
  <td><a href="<?=url::to(['/product/view', 'id'=> $model->id])?>"><?=html::encode($model->name)?></a></td>
  <td><?=StringHelper::truncateWords(html::encode($model->description), 5)?></td>
  <td><?=$model->quantity_in_stock?></td>
  <td>£<?=$model->unit_price?></td>
  <td><a href="<?=url::to(['/product/view', 'id'=> $model->id])?>">VIEW</a> </td>
</tr>

