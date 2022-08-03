<?php

namespace backend\controllers;

use backend\models\BookingHeader;
use backend\models\CustomerMaster;
use backend\models\PaymentMaster;
use yii\helpers\ArrayHelper;

class PaymentSettlController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model= new BookingHeader();
        $customer_model = new CustomerMaster();
$payment_methods=array();
 $payment_models=[new PaymentMaster()];
 $Received_array=array();
 $paid_array=array();
        return $this->render('create',[
            'customer_model' => $customer_model,
            'model' => $model,
            'payment_models'=>$payment_models
        ]);
    }

    public function actionGetPaymentdetails(){
        $customer_id = $_GET['customer_id'];
        $booking_header= BookingHeader::find()->select(['booking_id','booking_date','pickup_date','rent_amount','deposite_amount','order_status','net_value','discount','issues_penalty'])->where(['customer_id'=>$customer_id,'order_status'=>'Open'])->createCommand()->queryAll();
$open_booking_id = ArrayHelper::getColumn($booking_header, 'booking_id');
        $payment_items=PaymentMaster::find()->select(['date','type','mode_of_payment','amount'])->where(['booking_id'=>$open_booking_id])->createCommand()->queryAll();
return json_encode(['booking_details'=>$booking_header,'payment_details'=>$payment_items]);
         /*$this->renderAjax('payment_details',
            ['booking_header'=>$booking_header,
            'payment_items'=>$payment_items
            ]);*/
    }

}
