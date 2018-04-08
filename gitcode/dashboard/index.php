<?php 
ini_set("display_errors", "1");
error_reporting(E_ALL);

if(isset($_SESSION['emp']) == "goodmeals"){
	$_SESSION['emp'] = "goodmeals"; 
	header("Location: http://localhost/goodmeals/skuupload.php");
}

if(isset($_REQUEST['submit']) == "Login"){ 
	if($_REQUEST['uname'] == "goodmeals" && $_REQUEST['password'] == "secret123"){
		$_SESSION['emp'] = "goodmeals";
		header("Location: http://localhost/goodmeals/skuupload.php");		 
	}
} 
if(isset($_GET['logout'])==1){
	unset($_SESSION['emp']);
	header('Location:  http://localhost/goodmeals/index.php');
}
 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
		<title>New Age - Start Bootstrap Theme</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="device-mockups/device-mockups.min.css">

    <!-- Custom styles for this template -->
    <link href="css/new-age.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Start Bootstrap</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#download">Download</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#features">Features</a>
            </li>
			<?php if(isset($_SESSION['emp']) == 1){ ?>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="?logout=1">LogOut</a>
            </li>
			<? } ?>
          </ul>
        </div>
      </div>
    </nav>

    <header class="masthead">
      <div class="container h-100">
        <div class="row h-100">
          <div class="col-lg-7 my-auto">
            <div class="header-content mx-auto">
              <h1 class="mb-5"> Login!</h1>
			  
			  
<div class="card card-login mx-auto mt-5">
      <div class="card-header" style='color:#000;'>Sign In to Use Dashboard</div>
      <div class="card-body">
        <form name="loginform" action="#" method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">User Name </label>
            <input class="form-control" 
					name="uname" 
					id="exampleInputEmail1" 
					type="text" 
					aria-describedby="emailHelp"
					placeholder="Enter User name" 
					required 
					/></input>
          </div>
		  
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input  class="form-control"  
					name="password" 
					id="exampleInputPassword1" 
					type="password" 
					placeholder="Password"
					required
					/></input>
          </div>
		  
          <br/> 
          <input type="submit" class="btn btn-primary btn-block" name="submit" value="Login"></input>
		  
        </form>
		
         
      </div>
    </div>
	         </div>
          </div>
          <div class="col-lg-5 my-auto">
            <div class="device-container">
              <div class="device-mockup iphone6_plus portrait white">
                <div class="device">
                  <div class="screen mx-auto" style='background:#FFF;'>
				  
                    <img src="http://goodmeals.in/assets/img/logo.png" class="img-fluid" alt="" style='width:120px; text-align:center;margin-left: 30%;;'>
					<br>
					<img src="http://goodmeals.in/assets/img/SIV.jpg" class="img-fluid" alt="" style="padding-top:10px">
					
					<img src="http://goodmeals.in/assets/img/NIV.jpg" class="img-fluid" alt="" style="padding-top:10px">
					
                  </div>
                  <div class="button">
                    <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <footer>
      <div class="container">
        <p>&copy; Your Website 2018. All Rights Reserved.</p>
        <ul class="list-inline">
          <li class="list-inline-item">
            <a href="#">Privacy</a>
          </li>
          <li class="list-inline-item">
            <a href="#">Terms</a>
          </li>
          <li class="list-inline-item">
            <a href="#">FAQ</a>
          </li>
        </ul>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/new-age.min.js"></script>

  </body>

</html>
