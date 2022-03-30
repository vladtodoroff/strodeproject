<?

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
?>

<section class="h-100" style="background-color: #eee;">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
        </div>

        
<?    // Use should use  the ListView Here. It's much better for rendering the partion View. Example see more view->product->index.php
        if (isset($modal)):
?> 
        <div class="d-flex justify-content-between align-items-center mb-4">
          <form action="<?=url::to('/site/clearcart')?>" method="post"><button  class="btn btn-outline-warning  btn-lg">clear</button></form>
        </div>
<?
        
        $i = $total = 0;
        foreach ($modal as $cart) 
    {
          $total += $qt[$i]*$cart->unit_price;
        ?>  
        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img1.webp"
                  class="img-fluid rounded-3" alt="Cotton T-shirt">
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2"><a href="<?=url::to(['/product/view', 'id'=> $cart->id])?>"><?=$cart->name?></a></p>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                <button class="btn btn-link px-2 qtchange qtdown">

                        
                   <img src="/img/dash-circle.svg"/>
                </button>

                <input min="0" name="quantity" value="<?=$qt[$i]?>" type="number"
                  class="form-control form-control-sm quantity" data-id="<?=$cart->id?>" data-number="<?=$i?>"/> <!-- Example how to use Jquery + data attribute, See more: https://api.jquery.com/data/ -->

                <button class="btn btn-link px-2 qtchange qtup">

                        
                  <img src="/img/plus-circle.svg"/>
                  <i class="bi bi-plus"></i>
                </button>
              </div>
              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1 text-right">
                <h5 class="mb-0">£<?=$cart->unit_price?></h5>
              </div>
              <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                <!-- Need to integrate the remove product fron cart. The same way like Quantity change. See SietController->actionClearcart() -->
                <a href="#!" class="text-danger"><img src="/img/dash-circle.svg"/></a>
              </div>
            </div>
          </div>
        </div>
<?
        ++$i;}?>
        <div class="card mb-5">
          <div class="row d-flex justify-content-between align-items-center">
            <div class="col-lg-6">
              &nbsp;
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 offset-lg-1">
              <p class="mb-20 mt-20  d-flex align-items-center ">
                <span class="small text-muted me-2">Order total:</span>  <span class="lead fw-normal">£<span id="total"><?=$total?></span></span>
              </p>
             </div>

            </div>
        </div>
        
        <div class="card">
          <div class="card-body">
            <!-- PayPal integration See more info: https://developer.paypal.com/demo/checkout/#/pattern/client-->
            <div id="paypal-button-container"></div>
            <!-- This is w/o Payment processor -add just for test CheckOut process->
<!--             <form action="<?=url::to('/site/checkout')?>" method="post">
              <button type="submit" class="btn btn-warning btn-block btn-lg">Proceed to Pay</button>  
            </form> -->
            
          </div>
        </div>
<? endif;?>
        
        
        
      </div>
    </div>
  </div>

</section>
<?
$this->registerJsFile(
    'https://www.paypal.com/sdk/js?client-id=test&currency=GBP',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

  $this->registerJsFile(
    '@web/js/cart.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);


// These are just for example. More info https://www.yiiframework.com/doc/api/2.0/yii-web-view  
//   $this->registerJs(' 
//     $(document).ready(function(){
//          $(\'.classname\').hide();
// });', \yii\web\View::POS_READY);

//   $this->registerJsVar('test',25, \yii\web\View::POS_READY)
  ?>