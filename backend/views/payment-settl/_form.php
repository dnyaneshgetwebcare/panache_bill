<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use backend\models\BookingItem;
use yii\helpers\Url;
use kartik\date\DatePicker;
use kartik\popover\PopoverX;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use backend\models\PaymentMaster;

?>
<?php
/*$tax_active_string=($model_company->TAX_ACTIVE==1)?'':'display:none';
$sales_departmnet_string=($model_company->MULTI_SALES_DEPARTMENT==1)?'':'display:none';
$sales_location_string=($model_company->MULTI_SALES_LOCATION==1)?'':'display:none';*/
?>
<!-- <script src="js/sweetalert.min.js"></script> -->
<style type="text/css">
    /*  .table-bordered>tbody>tr>td,.table-bordered>thead>tr>th{
  border:1px solid #eee !important;
 }*/
    .form-group {
        margin-bottom: 0px;
    }

    .page-titles {
        margin-bottom: 10px !important;
    }

    .form-control {
        font-size: 15px;
        font-weight: 500;
    }

    th {
        font-size: 15px;
    }

    .customtab2 li a.nav-link.active {
        background-color: #fc4b6c;
    }

    .control-label {
        font-size: small;
        font-weight: 500;
    }

    .dropdown-item {
        font-size: 15px;
    }

    .panel {
        margin-bottom: 0px !important;
    }

    .list-main-tab .list-main-tab-heading {
        padding: 0px !important;
        background: #fff !important;
        /*  box-shadow: 0px 1px 2px #a5a0a0 !important;*/
        border-bottom: 2px solid #aaa !important;
    }

    .nav-pills li > a:hover {
        background: #eee !important;
        color: #000 !important;
        border-bottom: 2px solid #eee;
    }

    .nav-pills > li.active > a {
        background: none !important;
        color: #4285f4 !important;
        border-bottom: 2px solid #4285f4;
    }

    .nav-pills > li.active > a:hover {
        background-color: #f8f8f8 !important;
    }

    .nav-pills > li > a {
        border-radius: 0px;
        padding: 6px 16px 6px 16px !important;
        font-size: 12px;
        font-family: 'Roboto', sans-serif;
        text-transform: uppercase;
        font-weight: 550 !important;
        color: #616161;
        letter-spacing: .05em;
    }

    .item_autocomplete .autocomplete_data {
        width: 80% !important;
    }

    #sales_items_tab .table-bordered > tbody > tr > td .form-group {
        margin: 0px !important;
    }

    #sales_items_tab .table-bordered > tbody > tr > td select {
        padding-left: 7px;
        margin: 1px !important;
        padding-right: 1px;
    }

    #sales_items_tab .table > tbody > tr > td {
        vertical-align: top !important;
        color: #555;
    }

    #sales_items_tab .table > tbody > tr > td {
        overflow: visible !important;
    }

    #sales_items_tab .table-bordered > tbody > tr > td {
        border: none !important;
        border-bottom: 1px solid #f4f4f4 !important;
        border-top: 1px solid #f4f4f4 !important;
        padding: 12px 0px 12px 10px !important;
    }

    .glyphicon-pencil, .glyphicon-trash {
        /*color: #c9e4ea;*/
        color: transparent;

    }

    .error-summary {
        color: #a94442;
        background: #efd4d4;
        border-left: 3px solid #eed3d7;
        padding: 10px 20px;
        /*    margin: 0 15px 15px 15px;*/
    }

    .ui-widget-content, .autocomplete {
        border: 1px solid #aaaaaa !important;
        background: #ffffff url("images/ui-bg_flat_75_ffffff_40x100.png") 50% 50% repeat-x !important;
        color: #222222 !important;
        max-height: 150px !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        font-size: 11px !important;
        padding-left: 0px;
    }

    .ui-menu-item, .autocomplete li {
        position: relative !important;
        margin: 0 !important;
        padding: 3px 1em 3px .4em !important;
    }

    .ui-menu-item, .autocomplete li, .ui-widget {
        cursor: pointer !important;
        min-height: 0 !important;
        list-style-image: url("data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7") !important;
    }

    .ui-widget, .autocomplete li {
        font-family: Verdana, Arial, sans-serif !important;
    }

    .ui-menu-item div:hover, .autocomplete li:hover {
        background: #337ab7 !important;
        font-weight: normal !important;
        color: #fff !important;
    }

    .autocomplete {;
        position: absolute;
        z-index: 3;
        margin-top: -4px
    }

    .autocomplete li {
        padding: 3px 0em 3px 0em;
        border: none !important;
    }

    .item_autocomplete .autocomplete_data {
        width: 80% !important;
    }

    .autocomplete {
        margin-top: 2px;
        width: 85%

    }

    .autocomplete li {
        width: 100%;
    }

    .number input[type="text"] {
        text-align: right;
    }

    input[readonly], input[readonly="readonly"], input[disabled], select[disabled] {
        cursor: not-allowed;
        background: transparent !important;
    }

    .number input[type="text"]:hover {
        background: #F9F9F9 !important;
        border-bottom: 1px solid #aaa;
    }

</style>


<?php
//echo (Yii::$app->session->hasFlash('success'));die;


$active_div = true;
$order_status = ($model->booking_id != '') && ($model->status == 'Closed' || $model->status == 'Deleted') ? true : false;
$label_select = 'SELECT';
$form = ActiveForm::begin(['enableClientValidation' => false, 'id' => 'booking_header_form', 'options' => ['class' => 'disable-submit-buttons', 'onSubmit' => 'return clientShowLoader()']]);
?>
<div class="row">
    <div class="card col-lg-12">

        <div class="card-body">
            <div class="col-lg-12">
                <div class="error-summary-sales alert alert-danger" id="errors_test1" style="display: none;"><p><i
                                class="fa fa-close pull-right" onclick="$(&quot;#errors_test1&quot;).hide()"></i><h5
                            class="text-danger"><b><i class="fa fa-exclamation-triangle"></i> <?= 'ERRORS'; ?>:</b>
                    </h5></p>
                    <hr class="custom_error_hr">
                    <div id="error_display_sales" class="custom_error"></div>
                </div>
            </div>
            <input type="hidden" name="booking_sms" id="booking_sms" value="0">
            <?php echo $form->field($model, 'customer_id')->hiddenInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => $model->attributeLabels()['customer_id'], 'autocomplete' => "off", 'id' => "hidden_id"])->label(false);
            echo $form->field($customer_model, 'id')->hiddenInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => $model->attributeLabels()['customer_id'], 'autocomplete' => "off"])->label(false);
            echo $form->field($model, 'order_status')->hiddenInput(['maxlength' => true, 'class' => 'form-control'])->label(false);
            echo $form->field($model, 'status')->hiddenInput(['maxlength' => true, 'class' => 'form-control'])->label(false);
            ?>
            <!-- Row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-body">
                        <h5 class="box-title">Customer</h5>
                        <hr class="m-t-0">
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label text-left col-md-2">Name</label>
                                    <div class="col-md-8" style="padding-left: 0px!important; margin-left: -12px;">
                                        <?php


                                        echo $form->field($customer_model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control text_first', 'placeholder' => 'Search by Name/Contact nos or Create New', 'autocomplete' => "off", 'readonly' => true])->label(false); ?>
                                        <!-- <div class="form-group field-customermastersearch-name">

                            <input type="text" id="customermastersearch-name" class="form-control text_first"  placeholder="Search by Name/Contact nos or Create New" autocomplete="off" style="display: none;" onkeyup="customerchange(this.value,this.id)">
                            </div>     <div id='customer_autodata' style="background-color:black">

                                        </div>-->


                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-info" onclick="showsearch()"><span
                                                    class="fa fa-edit"></span></button>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-left col-md-3"
                                           style="padding-right: 0px !important">Mobile No.</label>
                                    <div class="col-md-9">
                                        <?php echo $form->field($customer_model, 'contact_nos')->textInput(['maxlength' => true, 'onfocusin' => '$("#customer_autodata").hide();', 'class' => 'form-control text_first', 'placeholder' => $customer_model->attributeLabels()['contact_nos'], 'autocomplete' => "off"])->label(false); ?>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-left col-md-3">Email ID</label>
                                    <div class="col-md-9">
                                        <?php echo $form->field($customer_model, 'email_id')->textInput(['maxlength' => true, 'class' => 'form-control text_first', 'onfocusin' => '$("#customer_autodata").hide();', 'placeholder' => $customer_model->attributeLabels()['email_id'], 'autocomplete' => "off"])->label(false); ?>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-left col-md-3"
                                           style="padding-right: 0px !important">Reference</label>
                                    <div class="col-md-9">
                                        <?= $form->field($customer_model, 'reference')->dropDownList(['None' => 'None', 'FaceBook' => 'FaceBook', 'Instagram' => 'Instagram', 'Google' => 'Google', 'Friend' => 'Friend',], ['class' => 'form-control text_first',])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-left col-md-3" style="padding-right: 0px">Addrs
                                        Grp</label>
                                    <div class="col-md-9">
                                        <?php // $form->field($customer_model, 'cust_group')->dropDownList([ 'None' => 'None', 'Photographer' => 'Photographer', 'Model' => 'Model', 'Friend' => 'Friend', ], ['class'=>'form-control text_first'])->label(false) ?>
                                        <?= $form->field($customer_model, 'address_group')->dropDownList(array(), ['class' => 'form-control text_first'])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label id="customer_bal" class="control-label text-left col-md-12"
                                           style="padding-right: 0px !important;color: green;font-weight: bold;font-size: large;">
                                        <?php if (isset($bal_amount) && $bal_amount != 0) {
                                            echo "Available Balance : " . $bal_amount;
                                        } ?>
                                    </label>

                                </div>
                            </div>
                            <!--/span-->
                            <!--  <div class="col-md-6">
                                  <div class="form-group row">
                                      <label class="control-label text-left col-md-3" style="padding-right: 0px">Addrs Grp</label>
                                      <div class="col-md-9">

                                      </div>
                                  </div>
                              </div>-->
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <hr class="m-t-0">

                    </div>


                </div>
                <div class="col-lg-4">


                    <div class="form-body">

                        <!--/row-->

                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table-bordered table table-striped table-color-full" >
                                    <tr>
                                        <td><b>Rent</b></td>
                                        <td><span id="total_rent">0</span></td>

                                    </tr>
                                     <tr>
                                        <td><b>Deposite</b></td>
                                        <td><span id="total_dep">0</span></td>

                                    </tr>
                                      <tr>
                                        <td><b>Paid</b></td>
                                        <td><span id="total_paid">0</span></td>

                                    </tr>
                                    <tr>
                                        <td><b>Return</b></td>
                                        <td><span id="total_return">0</span></td>

                                    </tr>
                                     <tr>
                                        <td><b>Balance</b></td>
                                        <td><span id="total_bal">0</span></td>

                                    </tr>
                                </table>
                            </div>
                        </div>


                        <!--/row-->
                    </div>


                </div>

            </div>
            <!-- Row -->


            <!-- <div class="row" style="margin-top:0px !important;padding-bottom:0px !important">
    <div class="col-lg-4 panel panel-default">
        <div class="panel-body" style="padding-bottom:0px !important">

            <div class="tab-content">

                <div class="col-lg-12">
                    <div class="row right_section">

                        <div class="form-group cust-group">
                            <label class="col-lg-5 control-label" style="text-align: left"> <?php // $model->attributeLabels()['booking_date'] ?> </label>
                            <div class="col-lg-6 form-group">
                                <?php // $model['booking_date']=($model['booking_date'] !='')?Yii::$app->formatter->asDate($model['booking_date'],'dd-MM-Y'):date('d-m-Y');

            /*echo DatePicker::widget([
                'name' => 'BookingHeader[booking_date]',

                'type' => DatePicker::TYPE_INPUT,
                'value'=> $model['booking_date'],
                //'disabled' =>($readonly_GOODS_header)?$readonly_GOODS_header:$readonly_closed_string,
                'options' => [
                    'placeholder' => 'dd-mm-yyyy',
                ],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd-mm-yyyy'
                ]
            ]);*/ ?>

                            </div>
                        </div>
                    </div>
                    <div class="row right_section">

                        <div class="form-group cust-group">
                            <label class="col-lg-5 control-label" style="text-align: left"> <?php // $model->attributeLabels()['pickup_date'] ?> </label>
                            <div class="col-lg-6 form-group">
                                <?php //$model['pickup_date']=($model['pickup_date'] !='')?Yii::$app->formatter->asDate($model['pickup_date'],'dd-MM-Y'):date('d-m-Y');

            /* echo DatePicker::widget([
                 'name' => 'BookingHeader[pickup_date]',

                 'type' => DatePicker::TYPE_INPUT,
                 'value'=> $model['pickup_date'],
                 //'disabled' =>($readonly_GOODS_header)?$readonly_GOODS_header:$readonly_closed_string,
                 'options' => [
                     'placeholder' => 'dd-mm-yyyy',
                 ],
                 'pluginOptions' => [
                     'autoclose'=>true,
                     'format' => 'dd-mm-yyyy'
                 ]
             ]);*/ ?>

                            </div>
                        </div>
                    </div>
                    <div class="row right_section">

                        <div class="form-group cust-group">
                            <label class="col-lg-5 control-label" style="text-align: left"> <?php // $model->attributeLabels()['return_date'] ?> </label>
                            <div class="col-lg-6 form-group">
                                <?php //$model['return_date']=($model['return_date'] !='')?Yii::$app->formatter->asDate($model['return_date'],'dd-MM-Y'):date('d-m-Y');

            /*echo DatePicker::widget([
                'name' => 'BookingHeader[return_date]',

                'type' => DatePicker::TYPE_INPUT,
                'value'=> $model['return_date'],
                //'disabled' =>($readonly_GOODS_header)?$readonly_GOODS_header:$readonly_closed_string,
                'options' => [
                    'placeholder' => 'dd-mm-yyyy',
                ],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd-mm-yyyy'
                ]
            ]);*/ ?>
<?php // echo $form->field($model, 'booking_id')->hiddenInput(['maxlength' => true,'class'=>'form-control text_first','placeholder'=> $model->attributeLabels()['booking_id'],'autocomplete'=>"off"])->label(false);?>
                            </div>
                        </div>
                    </div>
                 

                </div>

            </div>
        </div>
        
    </div>
    
</div>
 -->


            <div class="col-lg-12" style="padding-left: 0px">
                <!--<div class="list-main-tab">
                    <div class="list-main-tab-heading" id="matetialServiceTab">
                        <ul class="nav nav-tabs customtab2" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#component_pills"
                                                    role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span>
                                    <span class="hidden-xs-down" style="font-size: 14px;">Items</span></a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#operation-pills"
                                                    role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span>
                                    <span style="font-size: 14px;" class="hidden-xs-down">Payment</span></a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#measure-pills" role="tab"><span
                                            class="hidden-sm-up"><i class="ti-email"></i></span> <span
                                            style="font-size: 14px;" class="hidden-xs-down">Measurment</span></a></li>
                        </ul>
                        <!--   <ul class="nav nav-tabs customtab2">
                            <li class="active upper_tabs"><a href="#component_pills" data-toggle="tab" aria-expanded="true" id="composite">Items</a>
                             </li>
                            <li class="upper_tabs"><a href="#operation-pills" data-toggle="tab" aria-expanded="true" id="expense">Payment</a>
                              </li>
                              <li class="upper_tabs"><a href="#measure-pills" data-toggle="tab" aria-expanded="true" id="expense">Measurment</a>
                              </li>
                            </ul> -->
            </div>

        </div>
        <div>
            <div class="tab-content master-main-tab"> <!-- General Tab-->
                <div class="tab-pane fade active in" id="component_pills">


                </div>
                <div class="tab-pane fade" id="operation-pills">


                </div>


            </div>
        </div>
    </div>
    <!--              <div class="row" style="margin:0px" >
          <div class="col-lg-12">
             <div class="col-lg-6">


              </div>
          </div>
        </div> -->
</div>
</div>

</div>
<div class="row" >
    <div class="col-lg-12" id="cust_payment_details">
<?php echo $this->render('payment_details',['booking_header'=>array(),
            'payment_items'=>array()]);  ?>
    </div>
</div>
<div class="row" style="position: fixed;bottom: 0;width: 100%; z-index:1500">

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">

                <button type="button" onclick="submitForm()"
                        class="btn btn-info save_submit" <?= ($model->order_status == 'Closed' || $model->order_status == 'Deleted' || $model->order_status == 'Cancelled') ? 'disabled' : ''; ?>
                        data-toggle="tooltip" data-original-title="Save"><img src="img/icons/save.png"
                                                                              style="height:12px"> Save
                </button>

                <?php if (($model->booking_id != '') && $model->order_status == 'Open' && $model->status == 'Booked') { ?>
                    <button type="button" class="btn btn-warning btn-square" style="margin-right: 10px"
                            title="Cancel Booking" onclick="cancelBooking()">Cancel Booking
                    </button>
                <?php } ?>
                <?php if (($model->booking_id != '') && $model->order_status == 'Open' && $model->status == 'Booked' && ($model->paid_amount == 0 || $model->paid_amount == '')) { ?>
                    <button type="button" class="btn btn-danger btn-square" style="margin-right: 10px"
                            title="Delete Booking" onclick="deleteBooking('<?= $model->booking_id ?>','1')">Delete
                    </button>
                <?php } ?>
                <!-- <button type="button" class="btn btn-warning" onclick="send_invoice()" data-toggle="tooltip" data-original-title="Send">Send Invoice</button> -->


            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    var order_status = '<?= $order_status ?>';
    $(window).load(function () {
        // PAGE IS FULLY LOADED
        // FADE OUT YOUR OVERLAYING DIV
        $('.overlay').hide();
    })
    $(document).ready(function () {
        $('.overlay').show();




        /* $('.cancel_class').on('ifChecked', function(event){
            //$('.deposite_applicable_class').iCheck('uncheck');
            cancelBooking();
        });*/
        /*  $('.add-house').click(function() {
           alert();
              // body...
          });*/
        // $('#mdate').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
        $('.temp_change_company').unbind().click(function () {
            // $('#vendor_data_div').toggle();

            $('#search_customer').toggle();
            $('.arrow-img').toggle();
            $('#customermaster-name').focus();

            customerchange('', 'customermaster-name');

        });
        $("#customer_sales").removeClass('even-strip');

        $('.popover-customer').unbind().click(function () {
            $('.other_edit').show();
            $('.other_customer_editable').addClass('edit_background');
        });

        $('.popover-down').unbind().click(function () {
            $('.billing_edit').show();
            $('#billing_address').addClass('edit_background');
        });
        $('.popover-down-delivery').unbind().click(function () {
            $('.delivery_edit').show();
            $('#delivery_address').addClass('edit_background');
        });

        $("#bookingitem-0-test").hide();
        $("#paymentmaster-0-test").hide();
        $('.desc .temp_change_item').unbind().click(function () {
            var customer_id = $("#hidden_id").val();

            select_item_function($(this));

        });


        $('.item_details_lable .glyphicon-remove').unbind().click(function () {

            removeRow($(this));
            //$(this).closest('.temp_change_item').();
            // $(this).closest('td.other_quantity').hide();
            //  $('.name_input_field').show();
        });
        $('.item_details_lable .glyphicon-pencil').unbind().click(function () {
            updateItemRow($(this));
        });


    });


    function showView(id, name, flag = 0) {

        saved_flag = true;
        $('#cust_details').html(name);
        $('.arrow-img').hide();
        $('#customer_autodata').hide();
        $('#pModal').modal('hide');
        $('.overlay-back').hide();
        $('.cust_icon').show();

        $('#hidden_id').val(id);
        $('#customermaster-id').val(id);
        $.ajax({
            url: '<?php echo Yii::$app->request->baseUrl . '/index.php?r=booking/customer-details' ?>',
            type: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function (data) {

                 console.log(data);
                $("#customer_bal").html("");
                $("#customermaster-contact_nos").val(data['contact_nos']);
                $("#customermaster-email_id").val(data['email_id']);
                $("#customermaster-name").val(name);
                $("#customermaster-cust_group").val(data['cust_group']);
                $("#customermaster-reference").val(data['reference']);
                if (data['bal'] != 0) {
                    swal("Available Balance: " + data['bal']);
                    $("#customer_bal").html("Available Balance: " + data['bal']);
                }
payment_details(id);
            },
            error: function (jqXhr, textStatus, errorThrown) {
                if (errorThrown == 'Forbidden') {
                    alert(you_dont_have_access_label);
                }
            }
        });

    }


    function updateItemRow(obj) {
        saved_flag = true;
        // obj.closest('.item_details_lable').hide();
        //    obj.closest('.item_details_lable').siblings('.name_input_field').find('input').val('');
        //    obj.closest('.item_details_lable').siblings('.name_input_field').find('.form-group input[type="text"]').attr('autofocus', 'true');
        //    obj.closest('.item_details_lable').siblings('.name_input_field').show();
        //     obj.closest('.item_details_lable').siblings('.other').hide();
        //     obj.closest('.item_details_lable').siblings('.other').hide();
        //     obj.closest('.item_details_lable').parent('.desc').find('.temp_change_item_row').show();
        //     var row_id=obj.closest('.item_details_lable').parent('.desc').parent('.sales-item').attr('id');
        //     console.log(obj)
        //      // select_item_function(obj);

        //  flushAllColumn(row_id);


        $('.overlay-back').show();
        // obj.closest('.item_details_lable').parent('.desc').find('.search_row').find('.add_button a').html('Update');
        //  obj.closest('.item_details_lable').parent('.desc').find('.search_row').find('.add_button a').attr('title','Update');
        //  obj.closest('.item_details_lable').parent('.desc').find('.search_row').find('.add_button a').attr('data-original-title','Update');

        obj.closest('.item_details_lable').parent('.desc').find('.search_row').slideDown();
        obj.closest('.item_details_lable').parent('.desc').find('.search_field').slideDown();
        var new_id = (obj.closest('.item_details_lable').parent('.desc').find('.search_field').attr('id'));
        var id = "#" + new_id;
        var id = obj.closest('.item_details_lable').parent('.desc').find('.search_row').children('.other_details_data').attr('id');


        // var n = id.lastIndexOf('-');
        // var item_type=$(id.substring(0,n+1)+'item_type').val();
        // var material_no=$(id.substring(0,n+1)+'material_no').val();
        // var description=$(id.substring(0,n+1)+'description').val();
        // var description_new=$(id.substring(0,n+1)+'description_new').val();
        // var warehouse=id.substring(0,n+1)+'warehouse';

        // if($(id.substring(0,n+1)+'item_type').val()=='OTH'){
        //  $('.seach_button').hide();
        // } else {
        //  $('.seach_button').show();
        //  $(warehouse).show();
        // }

        // if(description!=description_new){
        //   $(id.substring(0,n+1)+'description_new').val(description);
        //   // alert($("#"+id.substring(0,n+1)+'item_type').val())
        //   $(id.substring(0,n+1)+'item_type_temp').val($(id.substring(0,n+1)+'item_type').val());
        //   selectgoodservitem(material_no,description,new_id);
        // }


        // change_display_item_details(item_type,id);
        OpenItemPopup(id);
        //no use
        //    obj.closest('.arrow-img').toggle();
        //     obj.parent('.row').siblings('.search_row').children('.name_input_field').find('.auto_search').focus();
        //       var id= obj.parent('.row').siblings('.search_row').children('.name_input_field').find('.auto_search').attr('id');

        //     changeitemdetails('',id);
        $('html, body').animate({
            'scrollTop': obj.closest('.item_details_lable').parent('.desc').find('.search_row').position().top + 250
        }, 100);


    }

    function advance_search_sider() {

        saved_flag = true;
        $.ajax({
            url: '<?php echo Yii::$app->request->baseUrl . '/index.php?r=booking/advance-search' ?>',
            type: 'post',
            /*  data:{
                  type:BUSINESS_PARTNER_TYPE,
                  module_chng:module_chng,
              },*/
            success: function (data) {

                // $('#pModal_search').modal('show');
                // $('#modalContent_search').html(data);
                // $(".modal-footer button").hide()
                $('.sidebar-modal .tab-content').html(data);
                $(".sidebar-modal").show('slide');
                $(".overlay-back").show();
            },
            error: function (jqXhr, textStatus, errorThrown) {
                if (errorThrown == 'Forbidden') {
                    alert(you_dont_have_access_label);
                }
            }
        });

    }

    function save_new_customer() {

        saved_flag = true;
        $.ajax({
            url: "<?php echo \Yii::$app->getUrlManager()->createUrl('customer/quick-create') ?>",
            dataType: 'json',
            type: 'post',
            data: $("#quick_customer :input").serialize(),
            /*data:{
                term:val,
                id:id_pass,
            },*/
            success: function (data) {

                var return_err = '';
                var cleaned = removeDuplicates(data['errors']);
                for (var key in cleaned) {
                    return_err += key + "<br>";
                }
                console.log(return_err)
                if (return_err != '') {
                    alert(return_err)
                } else {
                    alert("Successful")
                    showView(data['customer_id'], data['customer_name'])
                }
            },
            error: function (jqXhr, textStatus, errorThrown) {
                //alert(errorThrown);
                //console.log( errorThrown );
                if (errorThrown == 'Forbidden') {
                    alert(you_dont_have_access_label);
                }
            }
        });

    }

    function add_new_customer() {

        saved_flag = true;
        $.ajax({
            url: "<?php echo \Yii::$app->getUrlManager()->createUrl('customer/quick-create') ?>",
            dataType: 'html',
            type: 'get',
            /*data:{
                term:val,
                id:id_pass,
            },*/
            success: function (data) {
                $('.overlay-back').show();
                console.log(data)
                $('#pModal_search').modal('show');
                $('#modalContent').html(data);
                $('.modal-header').html("<h4>Add Customer</h4> <button type='button' class='close pull-right' onClick='closeCustomer()'>x</button>");


            },
            error: function (jqXhr, textStatus, errorThrown) {
                //alert(errorThrown);
                //console.log( errorThrown );
                if (errorThrown == 'Forbidden') {
                    alert(you_dont_have_access_label);
                }
            }
        });

    }

    function customerchange(val, id_pass, flag = 0) {
        saved_flag = true;
        $.ajax({
            url: "<?php echo \Yii::$app->getUrlManager()->createUrl('booking/customer-autocomplete') ?>",
            dataType: 'json',
            type: 'get',
            data: {
                term: val,
                id: id_pass,
            },
            success: function (data, textStatus, jQxhr) {

                var n = data['id_pass'].lastIndexOf('-');
                var result1 = '#customer_autodata';


                var data_new = '<ul class="autocomplete add_new_autocomplete" >';
                data_new += '<li style="color: #337AB7; font-weight: bold !important;" onClick="add_new_customer()">+ New Customer </li>';
                for (i = 0; i < data['customer_data'].length; i++) {
                    data_new += '<li onClick="showView(\'' + data['customer_data'][i]['id'] + '\',\'' + data['customer_data'][i]['name'] + '\',' + flag + ')">' + data['customer_data'][i]['name'] + '</li>';
                }
                data_new += '</ul>';
                if (flag == 1) {
                    $('.customer_autodata_show').show();
                    $('.customer_autodata_show').html(data_new);
                    $(".customer_sales_data").removeClass('even-strip');
                    $('.customer_sales_data').parent('.row').removeClass('billimg-edit');
                } else {
                    //alert(result1);
                    $(result1).show();
                    $('.add_new_autocomplete').css('display', '');
                    $(result1).html(data_new);
                    $("#customer_sales").removeClass('even-strip');
                    $('#customer_sales').parent('.row').removeClass('billimg-edit');
                }

            },
            error: function (jqXhr, textStatus, errorThrown) {
                //alert(errorThrown);
                //console.log( errorThrown );
                if (errorThrown == 'Forbidden') {
                    alert(you_dont_have_access_label);
                }
            }
        });
    }

    function select_item_function(obj) {
        if (order_status) {
            return;
        }
        saved_flag = true;
        obj.parent('.row').siblings('.search_row').children('.search_field').hide();
        $('.overlay-back').show();
        obj.parent('.row').siblings('.search_row').slideDown();
        obj.parent('.row').siblings('.search_row').children('.search_field').slideDown();
        var id = obj.parent('.row').siblings('.search_row').children('.other_details_data').attr('id');

        OpenItemPopup(id);
        // obj.closest('.arrow-img').toggle();
        //  obj.parent('.row').siblings('.search_row').children('.name_input_field').find('.auto_search').focus();
        //    var id= obj.parent('.row').siblings('.search_row').children('.other_details_data').find('.auto_search').attr('id');

        //  changeitemdetails('',id);
        //      $('html, body').animate({
        //     'scrollTop' :obj.parent('.row').siblings('.search_row').position().top
        // });
        $('html, body').animate({
            'scrollTop': obj.parent('.row').siblings('.search_row').position().top + 250
        });
    }

    function OpenItemPopup(id) {
        saved_flag = true;

        var n = id.lastIndexOf('-');
        var item_id = $("#" + id.substring(0, n + 1) + 'product_id').val();
        var description = $("#" + id.substring(0, n + 1) + 'description').val();
        var item_type = $("#" + id.substring(0, n + 1) + 'item_type').val();
        var item_category = $("#" + id.substring(0, n + 1) + 'item_category').val();
        // var service_catelog_id=$("#"+id.substring(0,n+1)+'item_type').service_catelog_id();


        $.ajax({
            url: "<?php echo \Yii::$app->getUrlManager()->createUrl('booking/item-details-popup') ?>",
            dataType: 'html',
            type: 'post',
            data: {
                id: id,
                item_type: item_type,
                item_category: item_category,
                description: description,
                item_id: item_id,
            },
            success: function (data, textStatus, jQxhr) {
                $("#" + id).html(data);

                // obj.parent('.row').siblings('.search_row').children('.name_input_field').find('.auto_search').focus();


                // changeitemdetails('',"itemselection-description");

                // var n = data['id'].lastIndexOf('-');
                // var tax="#"+data['id'].substring(0,n+1)+'tax_details';
                // var tax_rate="#"+data['id'].substring(0,n+1)+'tax_rate';
                // var tax_code="#"+data['id'].substring(0,n+1)+'tax_code';
                // var tax_process="#"+data['id'].substring(0,n+1)+'tax_process';
                // var tax_process_old="#"+data['id'].substring(0,n+1)+'tax_process_old';
                // $(tax_process_old).val($(tax_process).val());


            },
            error: function (jqXhr, textStatus, errorThrown) {
                if (errorThrown == 'Forbidden') {
                    alert(you_dont_have_access_label);
                }
                //console.log( errorThrown );
            }
        });
    }

    function cancel_check() {
        alert();
    }


    function removeDuplicates(json_all) {
        var arr = [];
        $.each(json_all, function (index, value) {
            arr[value] = (value);
        });
        return arr;
    }

    function showsearch() {
        $('.overlay-back').show();
        $('#pModal').modal('show');
        $('#modalContent').html('<div class="form-group field-customermastersearch-name"><input type="text" id="customermastersearch-name" class="form-control text_first"  placeholder="Search by Name/Contact nos or Create New" autocomplete="off" onkeyup="customerchange(this.value,this.id)"></div>    <div id="customer_autodata" style="background-color:black"></div>');
        $('.modal-header').html("<h4>Select Customer</h4> <button type='button' class='btn btn-info' onClick='add_new_customer()'>+New</button> <button type='button' class='close pull-right' onClick='closeCustomer()'>x</button>");
        //$("#customermastersearch-name").show();
        //$("#customermaster-name").hide();
    }

    function closeCustomer() {
        $('.overlay-back').hide();
        $('#pModal').modal('hide');
    }

    function submitForm() {


        $.ajax({
            url: $('#booking_header_form').attr('action'),
            type: 'post',
            dataType: 'json',
            data: $("#booking_header_form").serialize(),
            beforeSend: function () {
                $(".overlay").show();
            },
            complete: function () {
                $(".overlay").hide();

            },
            success: function (data) {
                // console.log(data)
                $('.form-control').removeClass("errors_color");
                var html = "";
                var cleaned = removeDuplicates(data['errors']);

                // console.log(cleaned);
                for (var key in data['errors']) {
                    $('#' + key).addClass("errors_color");
                }
                for (var key in cleaned) {
                    html += key + "<br>";
                }
                $("html, body").animate({scrollTop: 0}, "slow");
                if (html != '') {
                    test_submit = 0;
                    $(".error-summary-sales").show();
                    $("#error_display_sales").html(html);
                } else {
                    $(".error-summary-sales").hide();
                }
                $('#redirect_saved_changes').hide();
            },
            error: function (jqXhr, textStatus, errorThrown) {
                //  alert(errorThrown);
                test_submit = 1;
                if (errorThrown == 'Forbidden') {
                    alert(you_dont_have_access_label);
                }
            }
        });


        // wait(3000);
        //test_submit=0;


    }

    function change_mode() {
        // body...
        $.ajax({
            url: "<?php echo \Yii::$app->getUrlManager()->createUrl('booking/get_balance') ?>",
            type: 'post',
            dataType: 'json',
            data: {
                customer_id: customer_id,

            },
            beforeSend: function () {
                $(".overlay").show();
            },
            complete: function () {
                $(".overlay").hide();

            },
            success: function (data) {
                console.log(data);
                //window.location.reload();
            },
            error: function (jqXhr, textStatus, errorThrown) {

            }
        });
    }
 function payment_details(customer_id) {
        // body...
   /*  var td_data="";
     for (var i = 0; i < 10; i++) {
         td_data+="<tr><td>"+i+"</td>";
         td_data+="<td> test"+i+"</td>";
         td_data+="<td> test"+i+"</td>";
         td_data+="<td> test"+i+"</td>";
         td_data+="<td> test"+i+"</td>";
         td_data+="</tr>";
     }
     $("#inv_table tbody").html(td_data);*/
        $.ajax({
            url: "<?php echo \Yii::$app->getUrlManager()->createUrl('payment-settl/get-paymentdetails') ?>",
            type: 'get',
            dataType: 'json',
            data: {
                customer_id: customer_id,

            },
            beforeSend: function () {
                $(".overlay").show();
            },
            complete: function () {
                $(".overlay").hide();

            },
            success: function (data) {
                console.log(data)
             if(data['booking_details']!=undefined){
                 var booking_dt=data['booking_details'];
                 var td_data="";
                 var total_rent=0;
                 var total_deposit=0;
                     for (var i = 0; i < booking_dt.length ; i++) {
                           console.log(booking_dt);
                           var booking_id= booking_dt[i]['booking_id'];
                           var rent_amount=booking_dt[i]['rent_amount'];
                           var deposite= booking_dt[i]['deposite_amount'];
                           total_deposit += Number(deposite);
                           total_rent +=Number(rent_amount);
                          td_data+='<tr><td> <input type="checkbox" style="position: inherit;opacity: initial;" class="invoice_list_class check" onchange="calculate_amount()" value="'+booking_id+'" id="invcheck_'+i+'" > </td>';
                           td_data+="<td> "+booking_id+"</td>";
                           td_data+="<td> "+booking_dt[i]['pickup_date']+"</td>";
                           td_data+="<td> "+rent_amount+" <input type='text' id='bookingrent_"+i+"' value="+rent_amount+" ></td>";
                           td_data+="<td> "+deposite+" <input type='text' id='bookingdep_"+i+"' value="+deposite+" ></td>";
                           td_data+="</tr>";

                 }
                     if(booking_dt.length==0){
                         td_data+="<tr><td colspan='4'></td></tr>";
                     }
                      td_data+="<tr><td colspan='3'>Total</td>";

                     td_data+="<td> "+total_rent+"</td>";
                     td_data+="<td> "+total_deposit+"</td>";
                     td_data+="</tr>";
                     $("#inv_table tbody").html(td_data);

             }
                //window.location.reload();
            },
            error: function (jqXhr, textStatus, errorThrown) {

            }
        });
    }
    function calculate_amount(){
        $(".invoice_list_class").each(function () {
            var rent_amount=0;
                var dep=0;
            if(this.checked){

                var id_array= this.id.split("_");

                var rent_amt_id="bookingrent_"+id_array[1];
                var dep_amt_id="bookingdep_"+id_array[1];
                rent_amount+=Number($("#"+rent_amt_id).val());
                dep+=Number($("#"+dep_amt_id).val());

            }
            $("#total_rent").html(rent_amount);
            $("#total_dep").html(dep);

        });
    }
    function add_total_payment() {
        var paid_amount = 0;
        var refund = 0;
        var return_amount = 0;
        var cancellation_charges = 0;
        var other_charges = 0;
        var comman_option = '<option value="Cash" selected="">Cash</option><option value="Google Pay">Google Pay</option><option value="Phone Pe">Phone Pe</option><option value="Bank Transfer">Bank Transfer</option><option value="Paytm">Paytm</option><option value="Other">Other</option>';
        var deposite_option = '<option value="Deposit" selected="">Deposit</option>';
        for (i = 0; i < count_item_payment; i++) {
            var amount_val = $("#paymentmaster-" + i + "-amount").val();
            var type_payment = $("#paymentmaster-" + i + "-type").val();

            if (type_payment == "Return-Deposit") {
                refund = +refund + +Number(amount_val);
            } else if (type_payment == "Cancel-Charge") {
                cancellation_charges = +cancellation_charges + +Number(amount_val);
                //paid_amount=+paid_amount + +Number(amount_val);
            } else if (type_payment == "Return-Payment") {
                return_amount = +return_amount + +Number(amount_val);
                paid_amount = +paid_amount - +Number(amount_val);
            } else if (type_payment == "Other-Charges") {
                other_charges = +other_charges + +Number(amount_val);
                // paid_amount=+paid_amount + +Number(amount_val);
            } else {
                paid_amount = +paid_amount + +Number(amount_val);
            }

            if (type_payment == "Cancel-Charge" || type_payment == "Other-Charges") {

                $("#paymentmaster-" + i + "-mode_of_payment").empty().append(deposite_option);
            } else {
                if ($("#paymentmaster-" + i + "-mode_of_payment").val() == 'Deposit') {
                    $("#paymentmaster-" + i + "-mode_of_payment").empty().append(comman_option);
                }
            }
        }

        var net_value = Number($("#sub_total").val());
        var deposit_amount = $("#total_deposite_amount").val()
        $("#return_amount").val(return_amount);
        $("#cancellation_charges").val(cancellation_charges);
        $("#other_charges").val(other_charges);
        $("#paid_amount").val(paid_amount);
        $("#pending_amount").val(net_value - ((paid_amount) - cancellation_charges));
        $("#display_pending").html("Amount: " + $("#pending_amount").val());
        $("#refunded").val(refund);
        $("#refund_dis").val(refund + '/' + deposit_amount);
    }

</script>
   