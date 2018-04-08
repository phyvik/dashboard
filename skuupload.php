<?php

include_once('database.php');
ini_set('display_errors', '1');
error_reporting(E_ALL);

if (isset($_SESSION['emp']) != 'goodmeals') {
 // header('Location: http://localhost/goodmeals/index.php');
}

if (isset($_REQUEST['logout']) == 'goodmeals') {
  unset($_SESSION['emp']);
 // header('Location:  http://localhost/goodmeals/index.php');
}

if(isset($_REQUEST['submit']) == 'Submit'){

  $data['mealstype'] = $_REQUEST['mealtype'];
  if($_REQUEST['mealtype'] == 1){
	$data['meals'] = $_REQUEST['stdmealitem'];
  }else if($_REQUEST['mealtype'] == 2){
	$data['meals'] = $_REQUEST['spmealitems'];
  }
  $data['sku'] = $_REQUEST['sku'];
  $data['vid'] = $_REQUEST['vendor'];
  $data['mealorigin'] = $_REQUEST['meals_origin'];
  $data['price'] = $_REQUEST['price'];
  $data['imageurl'] = "http://$_SERVER[HTTP_HOST]/goodmeals/uploads/".$_FILES['mealimage']['name'];

  insertskumeal($data);

  $target_dir = './uploads/';
  $target_file = $target_dir . basename($_FILES['mealimage']['name']);
  $uploadOk = 1;

  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image

	 $check = getimagesize($_FILES['mealimage']['tmp_name']);
	 if($check !== false) {
		if (move_uploaded_file($_FILES['mealimage']['tmp_name'], $target_file)) {

		} else {
		   echo 'Sorry, there was an error uploading your file.';
		}
		$uploadOk = 1;
	 } else {
		echo 'File is not an image.';
		$uploadOk = 0;
	 }
}

?>
<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
<meta name='description' content=''>
<meta name='author' content=''>
<title>Good meals</title>
<!-- Bootstrap core CSS -->
<link href='vendor/bootstrap/css/bootstrap.min.css' rel='stylesheet'>

<!-- Custom fonts for this template -->
<link rel='stylesheet' href='vendor/font-awesome/css/font-awesome.min.css'>
<link rel='stylesheet' href='vendor/simple-line-icons/css/simple-line-icons.css'>
<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Muli' rel='stylesheet'>

<!-- Plugin CSS -->
<link rel='stylesheet' href='device-mockups/device-mockups.min.css'>

<!-- Custom styles for this template -->
<link href='css/new-age.min.css' rel='stylesheet'>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js' ></script>

<style>
hr.style-seven {
overflow: visible;
height: 30px;
border-style: solid;
border-color: black;
border-width: 1px 0 0 0;
border-radius: 20px;
}
hr.style-seven:before {
display: block;
content: '';
height: 30px;
margin-top: -31px;
border-style: solid;
border-color: black;
border-width: 0 0 1px 0;
border-radius: 20px;
}
</style>


<script type='text/javascript'>

	function submitResult() {
	  
	   if ( confirm('Are you sure you want to Submit ?') == false ) {
		  return false ;
	   } else {
		  var x = checkvalidity(); 
		  if(checkvalidity()){
			  return true;
		  }else {
			  return false;
		  }
	   }
	}
	
	function checkvalidity(){
			var name_meals = document.getElementById("name_meals").value;
			if(name_meals == 1){ 
				var mealsdata = document.getElementById("stdmealdata").value;
			}else if(name_meals == 2){ 
				var mealsdata = document.getElementById("splmealdata").value;
			}else{
				alert("Please mention Standard or Special meal");
				return false;
			} 
			
			var vendor = document.getElementById("vendor").value;
			if(vendor == -1){
				alert("Select Vendor");
				return false;
			}
			
			var meals_origin = document.getElementById("meals_origin").value;
			
			var sku = document.getElementById("sku").value;
			if(sku == -1){
				alert("Select Meal Type");
				return false;
			}
			
			var price = document.getElementById("price").value;
			if(price < 1){
				alert("Select valid Price for the Meal");
				return false;
			}
			var file, img; 
			if ((file = this.files[0])) {
				img = new Image();
				img.onload = function() {
					if( this.width != "810" || this.height != "600" ){
						alert("Enter Image of size - 810w-600h");
						return false;
					}
				};
				img.onerror = function() {
					alert( "not a valid file: " + file.type);
					return false;
				}; 			
			}
			return true;
	}
	
	
	
	function checkmeal(){

		var selectedval = document.getElementById("name_meals").value;
		if(selectedval == 2){
			document.getElementById("stdmeals").style.display = "none";
			document.getElementById("splmeals").style.display = "inline";
		}else if(selectedval == 1){
			document.getElementById("stdmeals").style.display = "inline";
			document.getElementById("splmeals").style.display = "none";
		}else if(selectedval == -1){
			alert("Please Select Meal Type");
			document.getElementById("stdmeals").style.display  = "none";
			document.getElementById("splmeals").style.display = "none";
		}
	}
 
	function readURL(input) {
            if (input.files && input.files[0]) { 
                var reader = new FileReader();  
                  reader.onload = function (e) {
					  str = "<img src='"+e.target.result+"' alt='"+input.files[0].name+"'>";
					  
					  document.getElementById('imagetd').innerHTML = str;
					   
					  var output = document.getElementById('imagedemo');
					  output.src = e.target.result;
                  };
                  reader.readAsDataURL(input.files[0]);
            }   
        } 
</script>

</head>

<body id='page-top'>
<!-- Navigation -->
<nav class='navbar navbar-expand-lg navbar-light fixed-top' id='mainNav'>
<div class='container'>

	<a class='navbar-brand js-scroll-trigger' href=''>
	<img src='http://goodmeals.in/assets/img/logo.png' height='90px;' alt='Good Meals' />
	</a>

	<button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse'
			data-target='#navbarResponsive' aria-controls='navbarResponsive' aria-expanded='false'
			aria-label='Toggle navigation'>
		Menu
		<i class='fa fa-bars'></i>
	</button>
	<div class='collapse navbar-collapse' id='navbarResponsive'>
		<ul class='navbar-nav ml-auto'>
			<li class='nav-item'>
				<a class='nav-link js-scroll-trigger' href='#dashboard'>Dashboard</a>
			</li>
			<li class='nav-item'>
				<a class='nav-link js-scroll-trigger' href='#demo'>Preview</a>
			</li>

		   <?php if (isset($_SESSION['emp']) == 1) { ?>
			   <li class='nav-item'>
				   <a class='nav-link js-scroll-trigger' href='?logout=1'>LogOut</a>
			   </li>
		   <? } ?>

		</ul>
	</div>
</div>
</nav>

<header class='masthead' style='min-height:200px; height:auto;'>
<div class='container h-100'>
	<div class='row h-100'>
		<div class='col-lg-12 my-auto'>
			<div class='header-content mx-auto' style='margin-top:100px'>
				<h1 class='mb-5' style='text-align:center;'> Dashboard for daily upload of SKUs in the meal ! </h1>
			</div>
		</div>
	</div>
</div>
</header>

<section class='download bg-primary text-center' id='dashboard'>
<div class='container'>
	<div class='row'>
		<div class='col-md-8 mx-auto'>
				<div class='panel panel-default'>
					<div class='panel-heading'>
						Please fill the following details
					</div>
					<hr class='style-seven'>
					<div class='panel-body'>
						<div class='row'>
							<div class='col-lg-8 mx-auto'>
<form role='form' method='POST' enctype='multipart/form-data' name='skuform'>
		<div class='form-group'>
			<label> Name of the meal </label>
			<div class='form-group'>
				<label for='Select'> </label>
				<select class='form-control' id='name_meals' name='mealtype' onChange='checkmeal();'>
					<option value='-1'>Name of the meal </option>
					<option value='1'>Standard Meals</option>
					<option value='2'>Special Meals</option>
				</select>
			</div>
		</div>

		<div class='form-group' id='stdmeals' style='display:none'>
			<label> Select Standard meal </label>
			<div class='form-group'>
				<label for='Select'> </label>
				<select name='stdmealitem' id='stdmealdata' class='form-control' required>
					<option value='-1'>Select any Standard Meal</option>

					<option value='sm1'>Standard Meal1</option>
					<option value='sm2'>Standard Meal2</option>
					<option value='sm3'>Standard Meal3</option>
					<option value='sm4'>Standard Meal4</option>

				</select>
			</div>
		</div>

		<div class='form-group' id='splmeals' style='display:none'>
			<label> Enter Comma Seperated Special meal </label>
			<textarea  required name='spmealitems' id="splmealdata" class='form-control' rows='3'> </textarea>
		</div>

		<div class='form-group'>
			<label>Select Vender Name </label>
			<select class='form-control' id='vendor' name='vendor' required>
				<option value='-1'>Select Some Vendor</option>
			   <?php
				  $vendor = getvenderlist(); 
				  foreach($vendor as $key => $val){
					 echo "<option value='".$key."'>".$val."</option>";
				  }
				  
			   ?>
			</select>
		</div>

		<div class='form-group'>
			<label>Meal Origin</label>
			<input class='form-control' required id="meals_origin" name='meals_origin' type='textarea' placeholder='North / South Indian Meals'/>
		</div>

		<div class='form-group'>
			<label>Select Meal Type </label>
			<select class='form-control' id="sku" name='sku'  required >
				<option value='-1'>Select Meal Type</option>
			   <?php
				  $mealtype['nv'] = 'North Indian Veg';
				  $mealtype['nnv'] = 'North Indian Non Veg';
				  $mealtype['sv'] = 'South Indian Veg';
				  $mealtype['snv'] = 'South Indian Non Veg';
				  $mealtype['cv'] = 'Chines Meals Veg';
				  $mealtype['cnv'] = 'Chines Meals Non Veg';

				  foreach($mealtype as $key => $val){
					 echo '<option value='.$key.'>'.$val.'</option>';
				  }
			   ?>
			</select>
		</div>

		<div class='form-group'>
			<label>Price per Unit</label>
			<input class='form-control' id='price' name='price'
				  type='number' placeholder='Price for Meals' required />
		</div> 
		<div class='form-group'>
			<label>Upload Meal Image</label>
			<input type='file' id='mealimage' name='mealimage' onchange="readURL(this);"   required >
		</div>
		<input type='submit' name='submit' value='Submit' class='btn btn-default' onclick='return submitResult();' />

	</form>
	<hr class='style-seven'>
	<button class='btn-success btn' onClick='return ShowPreview();' > Show Preview </button>
							</div>
						</div>
						<!-- /.row (nested) -->
					</div>
					<!-- /.panel-body -->
				</div>
				<!-- /.panel -->
		</div>
	</div>
</div>
</section>

<section class='features' >
<div class='container'>
	 <div class='row mx-auto' id='demo'  style='display:none;'>
	 
		<div class="row mx-auto" >
			<div class="col-md-3 g-py-20 mx-auto">
				<div class="u-shadow-v1-5 g-mx-10 g-my-10">
					<img class="img-fluid w-100" id='imagedemo' src="" alt="">
				</div>
				<h2 class="text-uppercase" style='font-size: 20px;font-weight: bold;margin-top:  10px;text-align: center;' id='demotxt'> </h2>
				<div>
					<a href="#">
						<button class="btn btn-success" style='text-align:center;' type="button">Book Now</button>
					</a>
				</div>	
			</div> 
		</div>
		
	 
	 <div class="card mx-auto col-lg-12"  >
        <div class="card-header">
          <i class="fa fa-table"></i> Preview of given input </div>
        <div class="card-body">
          <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
			 <div class="row">
					<div class="col-sm-12">
						<table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
					  <thead>
						<tr role="row">
							<th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 100px;">Name of Meal</th>
							<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 100px;">Meal Value</th>
							<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 100px;">Vendor Name</th>
							<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 100px;">Meals Origin</th>
							<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 100px;">Meals Type</th>
							<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 100px;">Price</th>
							<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 100px;">Image</th>
						</tr>
					  </thead>
					  <tbody>
						<tr role="row" class="odd" id="table">
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td id='imagetd'></td>
						</tr>
					</tbody>
					</table>
				</div>
			</div>
			</div>
          </div>
        </div>

      </div>

	 </div>
</div>

</section> 
<footer>
<div class='container'>
	<p>&copy; Your Website 2018. All Rights Reserved.</p>
	<ul class='list-inline'>
		<li class='list-inline-item'>
			<a href='#'>Privacy</a>
		</li>
		<li class='list-inline-item'>
			<a href='#'>Terms</a>
		</li>
		<li class='list-inline-item'>
			<a href='#'>FAQ</a>
		</li>
	</ul>
</div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src='vendor/jquery/jquery.min.js'></script>
<script src='vendor/bootstrap/js/bootstrap.bundle.min.js'></script>

<!-- Plugin JavaScript -->
<script src='vendor/jquery-easing/jquery.easing.min.js'></script>

<!-- Custom scripts for this template -->
<script src='js/new-age.min.js'></script>

<script>
function ShowPreview(){ 
		  
		var name_meals = document.getElementById("name_meals").value;
		if(name_meals == 1){ 
			var mealsdata = document.getElementById("stdmealdata").value;
		}else if(name_meals == 2){ 
			var mealsdata = document.getElementById("splmealdata").value;
		}else{
			alert("Please mention Standard or Special meal");
		} 
		var vendor = document.getElementById("vendor").value;
		var meals_origin = document.getElementById("meals_origin").value;
		var sku = document.getElementById("sku").value;
		var price = document.getElementById("price").value;
		
		var e = document.getElementById("mealimage");
		var fileName = e.files[0].name; 
		
		var textdemo = document.getElementById("demotxt");
		textdemo.innerHTML = meals_origin+" @"+price;
		
		document.getElementById("demo").style.display = "block";
		 
		var str = "<td >"+name_meals+"</td><td>"+mealsdata+"</td><td>"+vendor+"</td> <td>"+meals_origin+"</td><td>"+sku+"</td><td>"+price+"</td><td>"+fileName+"</td>";
		
		document.getElementById("table").innerHTML = str;
		
	}
</script>

</body>

</html>
