<?php

namespace backend\controllers;

use Yii;
use backend\models\PaymentMaster;
use backend\models\CustomerMaster;
use backend\models\PaymentMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;
/**
 * PaymentController implements the CRUD actions for PaymentMaster model.
 */
class PaymentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','view','create','update','delete','payment-report','payment-search'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PaymentMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
         $date=(isset($_GET['month'])&&isset($_GET['year']))?$_GET['month'].'-'.$_GET['year']:date('m-Y');
        $searchModel = new PaymentMasterSearch();
         $searchModel->month_year_filter=$date;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
       // $date=date('m-Y');
        $payment_summarys = PaymentMaster::find()->select(['sum(amount) as total','mode_of_payment'])->where('DATE_FORMAT(date, "%m-%Y") = "'. $date.'"')->groupby(['mode_of_payment'])->createCommand()->queryAll();
        //print_r($payment_summarys);die;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'payment_summarys' => $payment_summarys,
        ]);
    }

    /**
     * Displays a single PaymentMaster model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

public function actionPaymentSearch()
 {
    
    $model = new PaymentMasterSearch();
    $customer_master=(ArrayHelper::map(CustomerMaster::find()->all(), 'id', 'name'));
    
    return $this->render('payment_search', [
      'model' => $model,
      'array_payment_status'=>[ 'Advance' => 'Advance', 'Per-payment' => 'Per-payment',  'Final-Payment' => 'Final-Payment', 'Return-Deposit' => 'Return-Deposit','Cancel-Charge'=>'Cancel-Charge','Other-Charges'=>'Other-Charges','Return-Payment'=>'Return-Payment'],
      'customer_master'=>$customer_master,
      'array_payment_mode'=>[ 'Cash' => 'Cash', 'Google Pay' => 'Google Pay', 'Phone Pe' => 'Phone Pe', 'Bank Transfer' => 'Bank Transfer', 'Paytm' => 'Paytm', 'Other' => 'Other','Credit'=>'Credit','Deposit'=>'Deposit' ],
    ]);
  }

public function actionPaymentReport()
{
    $searchModel = new PaymentMasterSearch();
   // $searchModel->month_year_filter=$date;
    //$searchModel->pagination= false;
   // $dataProvider = $searchModel->searchReport(Yii::$app->request->queryParams);



        //$model = new BillingItem();
        
        
       
        //echo '<pre>';print_r(Yii::$app->request->post());die;
        if(!isset(Yii::$app->request->queryParams['PaymentMasterSearch']) && !isset(Yii::$app->request->post()['PaymentMasterSearch']) && !isset(Yii::$app->request->queryParams['sort']) ){
            //&& !isset(Yii::$app->request->post()['export_type']) && !isset($_GET['no_page'])
            return $this->redirect(['payment/payment-search']);
        }

       /* if(isset($_GET['no_page']) && $_GET['no_page']==1){ // Get Final PageSummary
            $total_details = $searchModel->searchTotalRebate(Yii::$app->request->post());
            return json_encode(array('total_details'=>$total_details));
        }
*/
        /*if(isset(Yii::$app->request->post()['export_type'])){ // For Full Export
            $searchModel->attributes = Yii::$app->request->post();
            Yii::$app->request->queryParams = array('PaymentMasterSearch' => $searchModel);
        }*/
       // $searchModel->COMPANY_CODE = $company_code;
        if(isset(Yii::$app->request->post()['PaymentMasterSearch'])){

         /*   if($model->hasAttribute('CONSIGNMENT_ORDER')){
                $searchModel->CONSIGNMENT_ORDER = isset(Yii::$app->request->post()['PaymentMasterSearch']['CONSIGNMENT_ORDER'])?Yii::$app->request->post()['PaymentMasterSearch']['CONSIGNMENT_ORDER']:'';
            }*/

            /*if($model->hasAttribute('TECHNICIAN_ID')){
                $searchModel->TECHNICIAN_ID = isset(Yii::$app->request->post()['BillingItemSearch']['technician'])?Yii::$app->request->post()['BillingItemSearch']['technician']:'';
            }
*/
            $dataProvider = $searchModel->searchReport(Yii::$app->request->post());
            Yii::$app->request->queryParams=Yii::$app->request->post();
        }else{
         /*   if($model->hasAttribute('CONSIGNMENT_ORDER')){
                $searchModel->CONSIGNMENT_ORDER = isset(Yii::$app->request->queryParams['PaymentMasterSearch']['CONSIGNMENT_ORDER'])?Yii::$app->request->queryParams['PaymentMasterSearch']['CONSIGNMENT_ORDER']:'';
            }
            if($model->hasAttribute('TECHNICIAN_ID')){
                $searchModel->TECHNICIAN_ID = isset(Yii::$app->request->queryParams['BillingItemSearch']['technician'])?Yii::$app->request->queryParams['BillingItemSearch']['technician']:'';
            }*/
            $dataProvider = $searchModel->searchReport(Yii::$app->request->queryParams);
        }








         return $this->render('payment_report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'payment_summarys' => $payment_summarys,
        ]);

}
    /**
     * Creates a new PaymentMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PaymentMaster();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->payment_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PaymentMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->payment_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PaymentMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PaymentMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PaymentMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PaymentMaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
