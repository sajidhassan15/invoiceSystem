<?php
include('../Database/Database.php');
$obj=new query();

$name='';
$address='';
$phone_no='';
$id='';

if(isset($_GET['id']) && $_GET['id']!=''){
	$id=$obj->get_safe_str($_GET['id']);
	$condition_arr=array('id'=>$id);
	$result=$obj->getData('user','*',$condition_arr);
	$name=$result['0']['name'];
	$address=$result['0']['address'];
	$phone_no=$result['0']['phone_no'];
}

if(isset($_POST['submit'])){
	$name=$obj->get_safe_str($_POST['name']);
    $address=$obj->get_safe_str($_POST['address']);
	$phone_no=$obj->get_safe_str($_POST['phone_no']);

	$condition_arr=array('name'=>$name,'address'=>$address,'phone_no'=>$phone_no);
	
	if($id==''){
        $obj->insertData('user', $condition_arr);
	}else{
		$obj->updateData('user',$condition_arr,'id',$id);
	}

	header('location:users.php');
	?>
<!--	<script>-->
<!--	window.location.href='users.php';-->
<!--	</script>-->
    <?php
}
?>
<!doctype html>
<html lang="en-US" xmlns="http://www.w3.org/1999/html">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Add Customer</title>
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
            <div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Add Customer</strong> </a></div>
            <div class="card-body">
               <div class="col-sm-6">
                  <h5 class="card-title">Fields with <span class="text-danger">*</span> are mandatory!</h5>
                  <form method="post">
                     <div class="form-group">
                        <label>First Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter First name" required value="<?php echo $name?>">
                     </div>
                     <div class="form-group">
                        <label>Address <span class="text-danger">*</span></label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Enter address" required value="<?php echo $address?>">
                     </div>
                     <div class="form-group">
                        <label>Mobile <span class="text-danger">*</span></label>
                        <input type="tel" class="tel form-control" name="phone_no" id="phone_no"  placeholder="Enter mobile" required value="<?php echo $phone_no?>">
                     </div>
                     <div class="form-group">
<!--                         <button type="button" <a href="users.php"  <i class="btn btn-danger"> </i></a>Back  </button>-->
                         <a href="users.php" class="btn btn-danger"> Back </a>
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