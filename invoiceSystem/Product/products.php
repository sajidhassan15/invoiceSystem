<?php
include('../Database/Database.php');
$obj=new query();

if(isset($_GET['type']) && $_GET['type']=='delete'){
    $id=$obj->get_safe_str($_GET['pro_id']);
    $condition_arr=array('pro_id'=>$id);
    $obj->deleteData('product', $condition_arr);
}

$result=$obj->getData('product','*','','pro_id','asc');
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
        <a href="../index.php" class="btn btn-success">Home</a>
        <div class="card-header"><i class="fa fa-fw fa-globe"></i> <strong>Products</strong>  <a href="manage-products.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-plus-circle"></i> Add Product</a></div>
    </div>
    <hr>
    <div>
        <table class="table table-striped table-bordered">
            <thead>
            <tr class="bg-primary text-white">
                <th>SR#</th>
                <th>ID</th>
                <th>Name</th>
                <th>Code</th>
                <th>Price</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($result['0'])){
                $id=1;
                foreach($result as $list){
                    ?>
                    <tr>
                        <td><?php echo $id?></td>
                        <td><?php echo $list['pro_id']?></td>
                        <td><?php echo $list['pro_name']?></td>
                        <td><?php echo $list['pro_code']?></td>
                        <td><?php echo $list['pro_rate']?></td>
                        <td align="center">
                            <a href="manage-products.php?id=<?php echo $list['pro_id']?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Edit</a> |
                            <a href="?type=delete&pro_id=<?php echo $list['pro_id']?>" class="text-danger"><i class="fa fa-fw fa-trash"></i> Delete</a>
                        </td>

                    </tr>
                    <?php
                    $id++;
                } } else {?>
                <tr>
                    <td colspan="6" align="center">No Records Found!</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>