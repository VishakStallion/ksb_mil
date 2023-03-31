<?php
// // include("common/includes/constants.php");
include("common/includes/oracle_function.php");
//     // include("common/includes/functions.php");
//     // include("common/includes/common.php");
    include("common/includes/admin_session.php");  
    include("common/includes/allstripslashes.php"); 
	include("common/includes/english_admin.php"); 
	include_once("common/includes/Charts.php");
    include 'common/conf/init.php'; 
	include_once("common/includes/license_functions.php");
	include_once("common/includes/SQL_SERVER_USER_AUTH.php");

// error_reporting(1);




$msg = $_GET['msg'];
$act=$_REQUEST['act'];




?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KSB MIL | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='icon' href='dist/img/favicon.ico' type='image/x-icon' sizes="16x16" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="dist/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
   body.login-page{
            background-image: url("dist/img/ksb-bg.jpg");
            background-size: cover ;

        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-card-body">
    <h3 align="center">
		<a href="index.php">
                    <img src="dist/img/logo.svg"
           alt="Wip Logo" width="210px" height="40px" class="brand-image">
    
    </a>
		
	</h3>
  </div>
  
           

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Login in to your account</p>

      <form  method="post" action="login_validation.php">
	  <input type="hidden" name="act" id="act" value="<?=$act?>">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="login_email" value="<?php echo $_COOKIE["user"]; ?>" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="login_password" value="<?php echo $_COOKIE["pwd"]; ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
		
          <div class="col-8">
           <div class="icheck-primary">
               <input type="checkbox" id="remember" name="remember"  <?php if(!empty($_COOKIE["user"])){ echo "checked";}?> >
              <label for="remember">
                Remember Me
              </label>
            </div> 
			</div>
			
          
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Log In</button>
          </div>
		  
          <!-- /.col -->
        </div>
					<div class="input-group m-b-3" align="center">
                        	<?php if($msg) echo '<b style="color:red;font-size:14px">' . $msg . '</b>' ?>
                            </div>

		
		
      </form>
<br>
	 <div align="center"> <small >Copyright © 2019 <a href="https://www.stallionglobal.com/">Stallion Systems & Solutions</a></small> </div>
    </div>
    <!-- /.login-card-body -->
	
  </div>
  
</div>
<!-- /.login-box -->
    
   
	


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>

