<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
  .card-profile .card-body {
    padding-top: 20px !important;
}
  .container-fluid {
    padding: 0 30px 0px 30px !important;
}
</style>
<div class="site-about">
    <div class="row row-card-no-pd">
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-5">
                        <div class="icon-big text-center">
                          <i class="icon-pie-chart text-warning"></i>
                        </div>
                      </div>
                      <div class="col-7 col-stats">
                        <div class="numbers">
                          <p class="card-category">Number</p>
                          <h4 class="card-title">150GB</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-5">
                        <div class="icon-big text-center">
                          <i class="icon-wallet text-success"></i>
                        </div>
                      </div>
                      <div class="col-7 col-stats">
                        <div class="numbers">
                          <p class="card-category">Revenue</p>
                          <h4 class="card-title">$ 1,345</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-5">
                        <div class="icon-big text-center">
                          <i class="icon-close text-danger"></i>
                        </div>
                      </div>
                      <div class="col-7 col-stats">
                        <div class="numbers">
                          <p class="card-category">Errors</p>
                          <h4 class="card-title">23</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-5">
                        <div class="icon-big text-center">
                          <i class="icon-social-twitter text-primary"></i>
                        </div>
                      </div>
                      <div class="col-7 col-stats">
                        <div class="numbers">
                          <p class="card-category">Followers</p>
                          <h4 class="card-title">+45K</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

  <div class="row">
    <?php foreach ($item_master as $item) { ?>
    <div class="col-md-4">
                <div class="card card-profile">
                  <div class="card-header" style="background-image: url('assets/img/blogpost.jpg')">
                  </div>
                  <div class="card-body">
                    <div class="user-profile text-center">
                      <div class="name"> <?php echo $item['name']; ?></div>
                    </div>

                    <div class="title">Booking</div>
                    <div class="card-list" style="overflow: scroll;max-height: 300px; min-height: 300px">

                        <?php
                        if(isset($booking_details[$item['id']])){
                        $product_bookings = $booking_details[$item['id']];
                      //  echo "<pre>"; print_r($booking_details);die;
                        foreach ($product_bookings as $booking) {

                          ?>
                            <div class="item-list">
                        <div class="info-user ms-3">
                          <div class="username"><?= $booking['customer_name']; ?></div>
                          <div class="status"><?= Yii::$app->formatter->asDate($booking['pickup_date'],'d-MM-yy');
                          ?> >>  <?= Yii::$app->formatter->asDate($booking['pickup_date'],'d-MM-yy');
                          ?></div>
                        </div>
                                </div>
                        <?php }
                        }else{
                          echo "NO Items";
                        }
                        ?>


                    </div>

                  </div>
                  <div class="card-footer">
                    <div class="row user-stats text-center">
                      <div class="col">
                        <div class="number">125</div>
                        <div class="title">Post</div>
                      </div>
                      <div class="col">
                        <div class="number">25K</div>
                        <div class="title">Followers</div>
                      </div>
                      <div class="col">
                        <div class="number">134</div>
                        <div class="title">Following</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    <?php } ?>
  </div>
</div>
