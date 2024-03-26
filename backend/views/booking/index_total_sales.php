<?php

use yii\helpers\Html;
use backend\models\BookingHeader;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\date\DatePicker;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BookingHeaderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
//$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
  td,th{
    font-size: 15px; 
}

</style>
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<div class="booking-header-index">

    <!-- <h1><?php // Html::encode($this->title) ?></h1> -->

  <!--   <p>
        <?php // Html::a('Create Booking', ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </p> -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0"><?= $this->title ?></h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Order</a></li>
                            <li class="breadcrumb-item active"><?= $this->title ?></li>
                        </ol>
                    </div>
                     <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-l-10 hidden-md-down">
                                <div class="chart-text">
                                   <div class="col-md-12">
                                     <div class="form-group">
                                       <?php $month_array=array("01"=>"Jan","02"=>"Feb","03"=>"Mar","04"=>"Apr","05"=>"May","06"=>"June","07"=>"July","08"=>"Aug","09"=>"Sept","10"=>"Oct","11"=>"Nov","12"=>"Dec",);
                                       $year_array= range(date('Y')-5,date('Y')+1,1);
                                       $select_month=isset($_GET['month'])?$_GET['month']:date('m');
                                      // echo $select_month;die;
                                       $select_year=isset($_GET['year'])?$_GET['year']:date('Y');
                                       ?>
                                      
                                        <label class="control-label text-right col-md-2"></label> 
                                <div class="col-md-3"> 
                                       <select name="month" id='month' class="form-control">
                                          <option>Select Month</option>
                                         <?php foreach ($month_array as $key => $month) {
                                              ?> 
                                      <option value="<?= $key; ?>" <?= ($key==$select_month)?'selected':''; ?>><?= $month; ?>
                                      </option>
                                              <?php 
                                            } ?>
                                            
                                        </select>
                                    </div>
                                      <div class="col-md-3"> 
                                  <select name="year" id='year' class="form-control">
                                          <option>Select Month</option>
                                         <?php foreach ($year_array as $key => $year) {
                                              ?> 
                                      <option value="<?= $year; ?>" <?= ($year==$select_year)?'selected':''; ?>><?= $year; ?>
                                      </option>
                                              <?php 
                                            } ?>
                                            
                                        </select>
                                      </div>
                                      <div class="col-md-2"> 
                                        <button type="button" onclick="set_month_filter()"; class="btn btn-inverse">Apply</button>
                                      </div>
                                      <div class="col-md-2"> 
                                        <?= Html::a('Clear', ['sales-item'], ['class' => 'btn btn-success pull-right']) ?>
                                      </div>
                                  </div>
                                  </div>
                              </div>
                            </div>
                          
                            
                          
                        </div>
                    </div>
                </div>
<div class="card-group" style="margin-bottom: 30px">
  <?php //foreach ($item_summary as $key => $item_sum) {
    # code...
     if($is_admin){
   ?>
                    <div class="card">
                        <div class="card-body">
                           <div class="d-flex flex-row">
                                  <div class="round round-lg align-self-center round-info"><i class="mdi mdi-cellphone-link"></i></div>
                                  <div class="m-l-10 align-self-center">
                                    <h3>₹ <?= number_format($booking_header_summmary['total_rent']) ?></h3>
                                    <h6 class="card-subtitle">Sales</h6>
                                   </div>
                               
                            </div>
                        </div>
                    </div>  

                    <div class="card">
                        <div class="card-body">
                           <div class="d-flex flex-row">
                                  <div class="round round-lg align-self-center round-success"><i class="ti-wallet"></i></div>
                                  <div class="m-l-10 align-self-center">
                                   <h3>₹ <?= number_format($booking_header_summmary['total_paid']) ?></h3>
                                    <h6 class="card-subtitle">Paid</h6>
                                   </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                           <div class="d-flex flex-row">
                                  <div class="round round-lg align-self-center round-primary"><i class=" ti-stats-down"></i></div>
                                  <div class="m-l-10 align-self-center">
                                    <h3>₹ <?= number_format($booking_header_summmary['total_deposite_amount']) ?></h3>
                                    <h6 class="card-subtitle">Deposite</h6>
                                   </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                           <div class="d-flex flex-row">
                                  <div class="round round-lg align-self-center round-warning"><i class="ti-bar-chart"></i></div>
                                  <div class="m-l-10 align-self-center">
                                 
                                    <h3>₹ <?= number_format($booking_header_summmary['total_extra_amount']) ?></h3>
                                    <h6 class="card-subtitle"> Fines</h6></div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                           <div class="d-flex flex-row">
                                  <div class="round round-lg align-self-center round-danger"><i class="ti-stats-up"></i></div>
                                  <div class="m-l-10 align-self-center">
                               
                                  
                                    <h3>₹ <?= number_format($booking_header_summmary['total_pending']) ?></h3>
                                    <h6 class="card-subtitle">Pending</h6>
                                  
                           
                            </div>
                        </div>
                    </div>
                  </div>
                  
                    
                      
                   
                    
                
<?php }
  // } ?>

</div>


    <div class="row">
                    <div class="col-12" style="overflow: auto;">
                        <div class="card" style="width: 130%; ">
                            <div class="card-body">

<div class="table-responsive m-t-40">
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       'filterModel' => $searchModel,
         'showFooter' => true,
       // 'floatHeader'=>true,
         //'tableOptions' => ['class' => 'table m-t-30 table-hover contact-list'],
         'tableOptions' => [ 'id' => 'example','class' => 'display nowrap table table-hover table-striped table-bordered','style'=>'height:200px;'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn','headerOptions' => ['style' => 'width:5%'],],
          [ 'attribute'=>'booking_id',
             'headerOptions' => ['style' => 'width:5%'],
             'header'=>'#'
            ],
            [
              'attribute' => 'payment_status',
              'headerOptions' => ['style' => 'width:5%'],
              'label' => 'Payment',
              'filter'=>Html::activeDropDownList($searchModel, 'payment_status',(array(''=>'Select','0'=>'Unpaid','1'=>'Paid')),['class'=>'form-control']),
              'format' => 'html',
              'value' => function ($model, $key, $index, $grid){
                if ($model->payment_status=='0') {
                  //return $model->GOODS_ISSUE_STATUS;
                  return '<img src="img/icons/close-icon.png" style="height:18px" title="Unpaid">';
                } else {
                  // $age = '<span  style="color:#604c4c;font-size: 11px;background: #DFF0D8"><b>CLOSED</b></span>';
                   return '<img src="img/icons/open-icon.png" style="height:19px" title="Paid">';
                  //return $age;
                } 
              },
            ],
            //'booking_id',
            
             [
              'attribute'=>'booking_date',
              'headerOptions' => ['style' => 'width:10%'],
              'value'=> function($model, $key, $index, $grid){
                return Yii::$app->formatter->asDate($model->booking_date,'dd-MM-yyyy');
               },
                    'filter'=>DatePicker::widget([
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'booking_date',
                    'model' => $searchModel,                   
                     //'disabled' =>($readonly_GOODS_header)?$readonly_GOODS_header:$readonly_closed_string,
                     'options' => [
                         'placeholder' => 'dd-mm-yyyy',
                     ],
                     'pluginOptions' => [
                         'autoclose'=>true,
                         'format' => 'dd-mm-yyyy',
                         //'todayHighlight'=>true,
                     ]
                 ]),
            ],
           //'booking_date',
            [ 
              'attribute'=>'customer_name',
              'format'=>'raw',
             'headerOptions' => ['style' => 'width:15%'],
             'value' => function($model, $key, $index, $grid){
                 return Html::a( $model->customer->name, ['booking/update','id' => $model->booking_id], ['title' => 'View','class'=>'link_cust']);
                },
            ],
            [
              'attribute'=>'pickup_date',
              'headerOptions' => ['style' => 'width:10%'],
              'value'=> function($model, $key, $index, $grid){
                return Yii::$app->formatter->asDate($model->pickup_date,'dd-MM-yyyy');
               },
                    'filter'=>DatePicker::widget([
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'pickup_date',
                    'model' => $searchModel,                   
                     //'disabled' =>($readonly_GOODS_header)?$readonly_GOODS_header:$readonly_closed_string,
                     'options' => [
                         'placeholder' => 'dd-mm-yyyy',
                     ],
                     'pluginOptions' => [
                         'autoclose'=>true,
                         'format' => 'dd-mm-yyyy',
                         //'todayHighlight'=>true,
                     ]
                 ]),
            ],
            [
              'attribute'=>'return_date',
              'headerOptions' => ['style' => 'width:10%'],
              'value'=> function($model, $key, $index, $grid){
                return Yii::$app->formatter->asDate($model->return_date,'dd-MM-yyyy');
               },
                   'filter'=>DatePicker::widget([
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'return_date',
                    'model' => $searchModel,                   
                     //'disabled' =>($readonly_GOODS_header)?$readonly_GOODS_header:$readonly_closed_string,
                     'options' => [
                         'placeholder' => 'dd-mm-yyyy',
                     ],
                     'pluginOptions' => [
                         'autoclose'=>true,
                         'format' => 'dd-mm-yyyy',
                         //'todayHighlight'=>true,
                     ]
                 ]),
                            'footer' => "<b>Total</b>",
            ],
            //'pickup_date',
            //'picked_date',
            //'return_date',
            //'returned_date',
             [ 'attribute'=>'net_value',
             'headerOptions' => ['style' => 'width:8%'],
             'format'=>['decimal',0],
             'footer' => BookingHeader::getTotal($dataProvider->models, 'net_value'),
            ],
           
            [ 'attribute'=>'deposite_amount',
             'headerOptions' => ['style' => 'width:8%'],
             'format'=>['decimal',0],
             'header'=>'Deposite Amt',
             'footer' => BookingHeader::getTotal($dataProvider->models, 'deposite_amount'),
            ],
            [ 'attribute'=>'refunded',
                'headerOptions' => ['style' => 'width:8%'],
                'format'=>['decimal',0],
                'header'=>'Refund',
                'footer' => BookingHeader::getTotal($dataProvider->models, 'refunded'),
            ],
            [ 'attribute'=>'extra_amount',
                'headerOptions' => ['style' => 'width:8%'],
                'format'=>['decimal',0],
                'header'=>'Extra Amount',
                'footer' => BookingHeader::getTotal($dataProvider->models, 'extra_amount'),
            ],
            [ 'attribute'=>'net_value',
                'headerOptions' => ['style' => 'width:8%'],
                'format'=>['decimal',0],
                'header'=>'Pending',
                'value'=>function($data){
                    return $data->net_value- $data->paid_amount;
                },
                'footer' => BookingHeader::getTotalPending($dataProvider->models),
            ],
            //'discount',
            //'deposite_applicable',
           // 'deposite_amount',
            //'payment_status',
           
            //'deposite_status',
            //'order_status',
            //'status',
           [ 'attribute'=>'status',
             'headerOptions' => ['style' => 'width:7%'],
             'filter'=>Html::activeDropDownList($searchModel, 'status',(array(''=>'Select','Booked'=>'Booked','Picked'=>'Picked','Pending'=>'Pending','Returned'=>'Returned')),['class'=>'form-control']),
            ],
            ['class' => 'yii\grid\ActionColumn','template'=>' {update}{delete}',
            'headerOptions' => ['style' => 'width:8%'],],
        ],
        'toolbar'=>[
            [
            'content'=>
                Html::button('<i class="fas fa-plus"></i>', [
                    'type'=>'button', 
                    'title'=>'Add Book', 
                    'class'=>'btn btn-success'
                ]) . ' '.
                Html::a('<i class="fas fa-redo"></i>', ['grid-demo'], [
                    'class' => 'btn btn-secondary btn-default', 
                    'title' =>  'Reset Grid'
                ]),
        ],
            '{export}',
            ],
            
            
    ]); ?>
</div>
</div>
</div>
</div>
</div>

</div>
<script type="text/javascript">
  function set_month_filter() {
var month=$('#month').val();
var year=$('#year').val();
//alert("<?= Url::base(); ?>");
 window.location.href = "<?= Url::base(); ?>/index.php?r=booking/index-sales&month="+month+"&year="+year;
}
</script>
<!--<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>-->