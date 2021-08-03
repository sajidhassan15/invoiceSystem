<?php
include('../Database/Database.php');
$obj=new query();

if(isset($_GET['id']) && $_GET['id']!='') {
    $id = $obj->get_safe_str($_GET['id']);
    $condition_arr = array('inv_id' => $id);
    $result = $obj->getData('invoice', '*', $condition_arr);
    $icode = $result['0']['inv_code'];
    $code = $result['0']['cus_id'];
    $prod = $result['0']['prod_id'];
    $prod = explode(',',$prod);
    $quantity = $result['0']['prod_qut'];
    $quantity = explode(',',$quantity);
    $condition_arr = array('id' => $code);
    $customer =  $obj->getData('user', '*', $condition_arr);
    $cus_name = $customer['0']['name'];
    $cus_address = $customer['0']['address'];
    $phone_no = $customer['0']['phone_no'];
}
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h2>Invoice</h2><h3 class="pull-right"><?php echo  "Invoice Code ". $icode?> </h3>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Billed To:</strong>
                        <br>
                        <?php echo $cus_name ?> <br>
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Shipped To:</strong><br>
                        <?php echo  nl2br("$cus_address \n $phone_no ") ?> <br>
                    </address>
                </div>
            </div>
<!--            <div class="row">-->
<!--                <div class="col-xs-6">-->
<!--                    <address>-->
<!--                        <strong>Payment Method:</strong><br>-->
<!--                        --><?php //echo  "customer Phone no " ?><!-- <br>-->
<!--                    </address>-->
<!--                </div>-->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td><strong>SNO.</strong></td>
                                <td><strong>Item</strong></td>
                                <td class="text-center"><strong>Price</strong></td>
                                <td class="text-center"><strong>Quantity</strong></td>
                                <td class="text-right"><strong>Totals</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $id=1;
                            foreach ($prod as $pro)
                                    {
                                        $condition=array('pro_id'=>$pro);
                                        $result=$obj->getData('product','*',$condition,'pro_id','asc');
                                        if(isset($result['0'])){
                                            foreach($result as $list)
                                            { ?>
                                                <tr>
                                                    <td><?php echo $id?></td>
                                                    <td><?php echo $list['pro_name']?></td>
                                                    <td><?php echo $list['pro_rate']?></td>
                                                    <td><?php echo $quantity[$id-1] ?></td>
                                                    <td><?php echo $a = $list['pro_rate'] * $quantity[$id-1] ?></td>
                                                    <td><?php  $b += $a  ?></td>
                                                </tr>
                                                <?php
                                                $id++;
                                            }
                                        }
                                        else {?>
                                            <tr>
                                                <td colspan="6" align="center">No Records Found!</td>
                                            </tr>
                                        <?php }
                                    }?>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Total</strong></td>
                                <td class="no-line text-right"><?php echo $b?></td>
                            </tr>
                            </tbody>

                        </table>

                    </div>
                    <button onclick="window.print();">Print</button>
                </div>
            </div>
        </div>
    </div>
</div>