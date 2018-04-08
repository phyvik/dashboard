<?php

include_once('/home/ubuntu/webhooks/dashboarddb.php');
ini_set('display_errors', '1');
error_reporting(E_ALL);

if (isset($_SESSION['emp']) != 'goodmeals') {
  header('Location: http://goodmeals.in/dashboard/index.php');
}

if (isset($_REQUEST['logout']) == 'goodmeals') {
  unset($_SESSION['emp']);
  header('Location:  http://goodmeals.in/dashboard/index.php');
}
 
if(isset($_REQUEST['submit']) == 'DELETE'){
	 deletemeals($_REQUEST['delmeal']);
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
	  
	   if ( confirm('Are you sure you want to DELETE ?') == false ) {
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
				<h1 class='mb-5' style='text-align:center;'> Dashboard for DELETE uploaded SKUs in the meal ! </h1>
			</div>
		</div>
	</div>
</div>
</header>

<section class='download bg-primary text-center' id='dashboard'>
<div class='container'>
	<div class='row'> 	
	 <div class="card mx-auto col-lg-12"  >
        <div class="card-header">
          <i class="fa fa-table"></i> Select the Meal Item to delete </div>
        <div class="card-body">
          <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
			 <div class="row">
					<div class="col-lg-12">
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
							
							<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 100px;"> Action </th>
						</tr>
					  </thead>
					  <tbody>
					 
						<tr role="row" class="odd" id="table">
							 <?php  
								
					  $mealtype['nv'] = 'North Indian Veg';
					  $mealtype['nnv'] = 'North Indian Non Veg';
					  $mealtype['sv'] = 'South Indian Veg';
					  $mealtype['snv'] = 'South Indian Non Veg';
					  $mealtype['cv'] = 'Chines Meals Veg';
					  $mealtype['cnv'] = 'Chines Meals Non Veg';
					  
								$tabledata = getmealsdata();
								foreach($tabledata as $key=>$val){
									echo "<tr>";
			
			
	if($val['sku'] == 1){
			echo "<td>Standard Meals</td>";
		}else{
			echo "<td>Special Meals</td>";
		}
		echo "<td>".$val['meal']."</td>";
		
		$vlist = getvenderlist();
		echo "<td>".$vlist[$val['vendorId']]."</td>"; 
		echo "<td>".$val['mealorigin']."</td>";
		echo "<td> ".$mealtype[strtolower($val['sku'])]."</td>";  
		echo "<td>".$val['price']."</td>";
		echo "<td><img style='width:90px;'src='".$val['imageurl']."'/>";
		echo "<td> <form action='#' method='POST' name='deleteform'>
				   <input type='hidden' value='".$val['id']."' name='delmeal'>
				   <input class='btn btn-success onClick='submitResult()' type='submit' name='submit' value='DELETE'>
				   </td>";
		echo "</tr>";
								}//End for
	?> 
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
