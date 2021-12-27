<?php

/* @var $this yii\web\View */

$this->title = 'Panache Store';
?>
<style type="text/css">
    th,td{
        font-size: 15px ;
    }
</style>
        
       
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                                    <?php  $key=array_search(date('m'),array_column($sale_monthly_summary,'month'));
                                    if($key===false){
                                        $this_sales=0;
                                    }else{
                                        $this_sales=$sale_monthly_summary[$key]['amount'];
                                    }
                                    ?>
                                    <h4 class="m-t-0 text-info">₹ <?= $this_sales; ?></h4></div>
                                <div class="spark-chart">
                                    <div id="monthchart"></div>
                                </div>
                            </div>
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                                    <?php  $key=array_search(date('m')-1,array_column($sale_monthly_summary,'month'));
                                    if($key===false){
                                        $last_sales=0;
                                    }else{
                                        $last_sales=$sale_monthly_summary[$key]['amount'];
                                    }
                                    ?>
                                    <h4 class="m-t-0 text-primary">₹ <?= $last_sales; ?></h4></div>
                                <div class="spark-chart">
                                    <div id="lastmonthchart"></div>
                                </div>
                            </div>
                            <div class="">
                                <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
<div class="row">
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-info"><i class="ti-wallet"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-light">₹ <?php echo (($booking_this_month['numb_booking']>0)?number_format($booking_this_month['total']):0)?></h3>
                        <h5 class="text-muted m-b-0">Booking(<?= $booking_this_month['numb_booking'] ?>)</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-warning"><i class="mdi mdi-cellphone-link"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">₹ <?php echo (($payment_cash['total']>0)?number_format($payment_cash['total']):0)?></h3>
                        <h5 class="text-muted m-b-0">Cash</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-primary"><i class="mdi mdi-cart-outline"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">₹ <?php echo (($deposite_amt['total']>0)?number_format($deposite_amt['total']):0)?></h3>
                        <h5 class="text-muted m-b-0">Deposite</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-danger"><i class="mdi mdi-bullseye"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">₹ <?php echo (($expense['total']>0)?number_format($expense['total']):0)?></h3>
                        <h5 class="text-muted m-b-0">Ad. Expense</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>


<div class="row">
    <div class="col-lg-6 col-md-5">
<div class="card">
    <div class="card-body bg-danger">
        <h4 class="text-white card-title">Upcoming Deliveries </h4>
        <h6 class="card-subtitle text-white m-b-0 op-5">Next 3days</h6>
    </div>
    <div class="card-body">
        <div class="message-box contact-box">

            <div class="message-widget contact-widget" style=" height: 510px;  overflow: auto;">
                <?php
                foreach ($model_delivarys as $key => $model_delivary) { ?>
                    <!-- Message -->
                    <a href="index.php?r=booking/delivery&id=<?= $model_delivary->booking_id ?>">
                        <div class="user-img"> <span class="round"><?= date_format(date_create($model_delivary->pickup_date),"d/M") ?></span> </div>
                        <div class="mail-contnet">
                            <h5><?= $model_delivary->customer->name ?></h5> <span class="mail-desc"><?= $model_delivary->customer->contact_nos ?></span></div>
                    </a>

                   <!-- <article class="media event">
                        <a class="pull-left date">
                            <p class="month"><?/*= date_format(date_create($model_delivary->pickup_date),"M") */?></p>
                            <p class="day"><?/*= date_format(date_create($model_delivary->pickup_date),"d") */?></p>
                        </a>
                        <div class="media-body">
                            <a class="title" href="index.php?r=booking/delivery&id=<?/*= $model_delivary->booking_id */?>"><?/*= $model_delivary->customer->name */?></a>
                            <p><?/*= $model_delivary->customer->contact_nos */?></p>
                        </div>
                    </article>-->
                <?php }
                if(sizeof($model_delivarys)==0){

                    ?>
                    <p class="day">No Item to Delivery</p>
                    <?php
                }
                ?>





            </div>
        </div>
    </div>
</div>
    </div>
    <div class="col-lg-6 col-md-5">
        <div class="card">
            <div class="card-body bg-danger">
                <h4 class="text-white card-title">Upcoming Returns </h4>
                <h6 class="card-subtitle text-white m-b-0 op-5">Next 3days</h6>
            </div>
            <div class="card-body">
                <div class="message-box contact-box">

                    <div class="message-widget contact-widget" style=" height: 510px;  overflow: auto;">
                        <?php
                        foreach ($model_returns as $key => $model_return) { ?>
                            <!-- Message -->
                            <a href="index.php?r=booking/return-item&id=<?= $model_return->booking_id ?>">
                                <div class="user-img"> <span class="round"><?= date_format(date_create($model_return->return_date),"d/M") ?></span> </div>
                                <div class="mail-contnet">
                                    <h5><?= $model_return->customer->name ?></h5> <span class="mail-desc"><?= $model_return->customer->contact_nos ?></span></div>
                            </a>


                        <?php }
                        if(sizeof($model_returns)==0){

                            ?>
                            <p class="day">No Item to Return</p>
                            <?php
                        }
                        ?>





                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <!--<select class="custom-select pull-right">
                    <option selected="">January</option>
                    <option value="1">February</option>
                    <option value="2">March</option>
                    <option value="3">April</option>
                </select>-->
                <h4 class="card-title">Monthly Summary(<?= date('Y'); ?>)</h4>
                <div class="table-responsive m-t-20">
                    <table class="table stylish-table full-color-table full-red-table hover-table">
                        <thead>
                        <tr>

                            <th>Month</th>
                            <th>Total Sales</th>
                            <th>Pending</th>
                             <th>New Customer</th>
                             <th>Nos. Invoice</th>
                              <th>Total Purchase</th>
                              <th>Total Expense</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($sale_monthly_summary as $sales_summary){
                            ?>
                            <tr>

                                <td><?=  date('F', mktime(0, 0, 0, $sales_summary['month'], 10));?></td>

                                <td><?= $sales_summary['amount'];?></td>
                                <td><?= $sales_summary['pending_amount'];?></td>
                                <td><?= isset($cust_list[$sales_summary['month']])?$cust_list[$sales_summary['month']]:'-';?></td>
                                <td><?= isset($invoice_list[$sales_summary['month']])?$invoice_list[$sales_summary['month']]:'-';?></td>
                                <td><?= $sales_summary['total_purchase'];?></td>
                                <td><?= $sales_summary['total_expense'];?></td>
                            </tr>
                        <?php
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap">
                                    <div>
                                        <h3 class="card-title">Sales</h3>
                                      
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <ul class="list-inline m-b-0">
                                            <li>
                                                <h6 class="text-muted text-success"><i class="fa fa-circle font-10 m-r-10 "></i>Total Sales</h6> </li>
                                          

                                        </ul>
                                    </div>
                                    
                                </div> 
                                <div class="campaign ct-charts"></div>
                            <!--     <div class="row text-center">
                                    <div class="col-lg-4 col-md-4 m-t-20"><h1 class="m-b-0 font-light">5098</h1><small>Total Sent</small></div>
                                    <div class="col-lg-4 col-md-4 m-t-20"><h1 class="m-b-0 font-light">4156</h1><small>Mail Open Rate</small></div>
                                    <div class="col-lg-4 col-md-4 m-t-20"><h1 class="m-b-0 font-light">1369</h1><small>Click Rate</small></div>
                                </div> -->
                            </div>
                        </div>    
                    </div>    
                     <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript">
    
 $(document).ready(function() {
    "use strict";
    // ============================================================== 
    // Newsletter
    // ============================================================== 
    var series_sales=<?= json_encode($total_sales); ?>;
    var chart = new Chartist.Line('.campaign', {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug','Sept','Oct','Noc','Dec'],
          series: [
          series_sales
          ]}, {
          low: 0,
        //  high: 28,
          showArea: true,
          fullWidth: true,
          plugins: [
            Chartist.plugins.tooltip()
          ],
            axisY: {
            onlyInteger: true
            , scaleMinSpace: 40    
            , offset: 20
            , labelInterpolationFnc: function (value) {
                return (value / 1) + 'k';
            }
        },
        });

        // Offset x1 a tiny amount so that the straight stroke gets a bounding box
        // Straight lines don't get a bounding box 
        // Last remark on -> http://www.w3.org/TR/SVG11/coords.html#ObjectBoundingBox
        chart.on('draw', function(ctx) {  
          if(ctx.type === 'area') {    
            ctx.element.attr({
              x1: ctx.x1 + 0.001
            });
          }
        });

        // Create the gradient definition on created event (always after chart re-render)
        chart.on('created', function(ctx) {
          var defs = ctx.svg.elem('defs');
          defs.elem('linearGradient', {
            id: 'gradient',
            x1: 0,
            y1: 1,
            x2: 0,
            y2: 0
          }).elem('stop', {
            offset: 0,
            'stop-color': 'rgba(255, 255, 255, 1)'
          }).parent().elem('stop', {
            offset: 1,
            'stop-color': 'rgba(38, 198, 218, 1)'
          });
        });
    
            
    var chart = [chart];

    // ============================================================== 
    // This is for the animation
    // ==============================================================
    
    for (var i = 0; i < chart.length; i++) {
        chart[i].on('draw', function(data) {
            if (data.type === 'line' || data.type === 'area') {
                data.element.animate({
                    d: {
                        begin: 500 * data.index,
                        dur: 500,
                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                        to: data.path.clone().stringify(),
                        easing: Chartist.Svg.Easing.easeInOutElastic
                    }
                });
            }
            if (data.type === 'bar') {
                data.element.animate({
                    y2: {
                        dur: 500,
                        from: data.y1,
                        to: data.y2,
                        easing: Chartist.Svg.Easing.easeInOutElastic
                    },
                    opacity: {
                        dur: 500,
                        from: 0,
                        to: 1,
                        easing: Chartist.Svg.Easing.easeInOutElastic
                    }
                });
            }
        });
    }
    

    
});

</script>
                <!-- Row -->

                <!-- Row -->
   
