<?php
include('../Database/Database.php');
$obj=new query();

$cus_id='';
$code='';
$prod='';
$qut=1;
$id='';


$customer=$obj->getData('user','*');
$product=$obj->getData('product','*','','pro_id','asc');

if(isset($_GET['id']) && $_GET['id']!=''){
    $id=$obj->get_safe_str($_GET['id']);
    $condition_arr=array('inv_id'=>$id);
    $result=$obj->getData('invoice','*',$condition_arr);
    $cus_id=$result['0']['cus_id'];
    $code=$result['0']['inv_code'];
    $prod=$result['0']['prod_id'];
    $prod= implode(',',$prod);
    $qut=$result['0']['prod_qut'];
    $qut= implode(',',$qut);
}

if(isset($_POST['submit'])){
//    $prod =$obj->get_safe_str($_POST['product']);
//    die(var_dump($prod));
    //    $prods=implode(',', $prod);
    $prod =  implode(',',$_POST['product']);
    $code=$obj->get_safe_str($_POST['code']);
    $cus_id=$obj->get_safe_str($_POST['customer']);
    $qut= implode(',',$_POST['quantity']);
    $condition_arr=array('inv_code'=>$code,'cus_id'=>$cus_id,'prod_id'=>$prod,'prod_qut'=>$qut);

    if($id==''){
        $obj->insertData('invoice', $condition_arr);
    }else{
        $obj->updateData('invoice',$condition_arr,'pro_id',$id);
    }

    header('location:invoices.php');

//        <script>
//           window.location.href='products.php';
//        </script>

}
?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .container{margin-top:100px;}
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Add Invoices</strong> </div>
        <div class="card-body">
            <div class="col-sm-6">
                <form method="post">
                    <div class="form-group">
                        <label>Create Invoice</label>
                        <div class="form-group">
                            <label>Invoice Code <span class="text-danger">*</span></label>
                            <input type="text" name="code" id="code" class="form-control" placeholder="Enter Product code" required  value="<?php echo $code?>">
                        </div>
                        <div >
                            <label>Select Customer Name </label>
                            <select name="customer">
                                <?php
                                foreach ($customer as $cus){
                                ?>
                                    <option  value="<?php echo $cus["id"];?>"><?php echo $cus["name"];?></option>
                                <?php

                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Product </label>
                        <div>
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <td></td>
                                </tr>
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th> </th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Quantity</th>
                                    </tr>

                                </thead>
                                <?php
                                if(isset($product['0'])){
                                    $i=0;
                                    foreach($product as $list){
                                        $i++;
                                        ?>
                                        <tr>
                                            <td><input onclick="test(<?php echo $list['pro_rate']?>, <?php echo $list['pro_id']?>,<?php echo $i ?>)" id="<?php echo $list['pro_id']?>" name="product[]" value="<?php echo $list['pro_id']?>" type="checkbox" ></td>
                                            <td><?php echo $list['pro_name']?></td>
                                            <td><?php echo $list['pro_rate']?></td>
                                            <th><input oninput="test(<?php echo $list['pro_rate']?>, <?php echo $list['pro_id']?>,<?php echo $i ?>)" required readonly type="number" name="quantity[]" id="quantity<?php echo $list['pro_id']?>" class="form-control"  placeholder="Quantity" value="<?php echo $list['pro_qut']?>" ></th>
                                        </tr>
                                        <?php

                                    } } else {?>
                                    <tr>
                                        <td colspan="6" align="center">No Records Found!</td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <div class="form-group">
                        <input type="number" id="proqut" name="proqut" hidden>
                        <label>Products Price </label>
                        <input readonly type="number" name="price" id="price" class="form-control" placeholder="Products price" >
                    </div>
                    <div class="form-group">
                        <a href="invoices.php" class="btn btn-danger"> Back </a>
                        <button type="submit" name="submit" value="submquantityfunit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let array = new Array();
    let sum=0;
    let q=0;
    let arr;
    function test(rate, id, i)
    {
        let check= document.getElementById(id).checked;
        let b='quantity'+ id;
        q =document.getElementById(b).value;
        console.log("q", q);

        if(check)
        {
            array[i] = +rate * +q;
            document.getElementById(b).removeAttribute("readonly");
        }
        else
        {
            array[i] = 0;
            document.getElementById(b).setAttribute("readonly","readonly");
        }
        arr=0;
        for (let i = 1; i < array.length; i++) {
            arr = arr + array[i];
        }
        document.getElementById("price").value = arr;
        document.getElementById("proqut").value = array.length -1;
    }

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

</body>
</html>