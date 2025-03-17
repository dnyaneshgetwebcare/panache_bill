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
                          <p class="card-category">Women</p>
                          <h4 class="card-title"><?= $women; ?></h4>
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
                          <p class="card-category">Men</p>
                          <h4 class="card-title"><?= $mens ?></h4>
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
                          <p class="card-category">Jewellary</p>
                          <h4 class="card-title"><?= $jewellary ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

  <div class="row">
    <?php
    foreach ($item_master as $item) {
      $rent_amount = 0;
    $number_of_times = 0;
    $upcoming_booking = 0;
    $upcoming_booking_times = 0;

      ?>
    <div class="col-md-4">
                <div class="card card-profile">
                  <div class="card-header" style="background-image: url('assets/img/blogpost.jpg')">
                  </div>
                  <div class="card-body">
                    <div class="user-profile text-center">
                      <div class="name"> <?php echo $item['name']; ?></div>
                    </div>

                    <div class="title">Booking</div>
                    <div class="card-list py-4" style="overflow: auto;max-height: 300px; min-height: 300px">

                        <?php
                        if(isset($booking_details[$item['id']])){
                        $product_bookings = $booking_details[$item['id']];
                      //  echo "<pre>"; print_r($booking_details);die;

                        foreach ($product_bookings as $booking) {
                          $actual_rent = $booking['amount'];
                          if($booking['status'] == 'Returned'){
                            $rent_amount += $actual_rent;
                            $number_of_times++;
                          }else{
                            $upcoming_booking +=$actual_rent;
                            $upcoming_booking_times++;
                          }

                          ?>
                          <div class="item-list">
											<div class="avatar">
												<span class="round">14/Apr</span>
											</div>
											<div class="info-user ms-3">
												<div class="username"><?= $booking['customer_name']; ?></div>
												<div class="status"><?= Yii::$app->formatter->asDate($booking['pickup_date'],'d-MM-yy');
                          ?> >>  <?= Yii::$app->formatter->asDate($booking['pickup_date'],'d-MM-yy');
                          ?></div>
											</div>
                            <span> <?= thousandsCurrencyFormat($actual_rent) ?> </span>
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
                        <div class="number"><?= $number_of_times ?></div>
                        <div class="title">Nos Times</div>
                      </div>
                      <div class="col">
                        <div class="number"><?= thousandsCurrencyFormat($rent_amount)  ?></div>
                        <div class="title">Total Earned</div>
                      </div>
                      <div class="col">
                        <div class="number"><?= $upcoming_booking  ?></div>
                        <div class="title">Upcoming</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    <?php } ?>
  </div>
</div>
<?php function thousandsCurrencyFormat($num) {

  if($num>1000) {

        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];

        return $x_display;

  }

  return $num;
}  ?>
