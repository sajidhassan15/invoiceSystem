<?php
include('../Database/Database.php');
$obj=new query();

$name='';
$code='';
$rate='';
$id='';

if(isset($_GET['id']) && $_GET['id']!=''){
    $id=$obj->get_safe_str($_GET['id']);
    $condition_arr=array('pro_id'=>$id);
    $result=$obj->getData('product','*',$condition_arr);
    $name=$result['0']['pro_name'];
    $code=$result['0']['pro_code'];
    $rate=$result['0']['pro_rate'];
}

if(isset($_POST['submit'])){
    $name=$obj->get_safe_str($_POST['name']);
    $code=$obj->get_safe_str($_POST['code']);
    $rate=$obj->get_safe_str($_POST['rate']);

    $condition_arr=array('pro_name'=>$name,'pro_code'=>$code,'pro_rate'=>$rate);

    if($id==''){
        $obj->insertData('product', $condition_arr);
    }else{
        $obj->updateData('product',$condition_arr,'pro_id',$id);
    }

    header('location:products.php');
    ?>
<!--    <script>-->
<!--        window.location.href='products.php';-->
<!--    </script>-->
    <?php
}
?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
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
        <div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Add Product</strong> </div>
        <div class="card-body">
            <div class="col-sm-6">
                <h5 class="card-title">Fields with <span class="text-danger">*</span> are mandatory!</h5>
                <form method="post">
                    <div class="form-group">
                        <label>Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Product name" required value="<?php echo $name?>">
                    </div>
                    <div class="form-group">
                        <label>Product Code <span class="text-danger">*</span></label>
                        <input type="text" name="code" id="code" class="form-control" placeholder="Enter Product Code" required value="<?php echo $code?>">
                    </div>
                    <div class="form-group">
                        <label>Product Price <span class="text-danger">*</span></label>
                        <input type="text" name="rate" id="rate" class="form-control" placeholder="Enter Product price" required value="<?php echo $rate?>">
                    </div>
                    <div class="form-group">
                        <a href="products.php" class="btn btn-danger"> Back </a>
                        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>