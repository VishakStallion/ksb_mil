<?php
include("common/includes/constants.php");
include("common/includes/oracle_function.php");
include("common/includes/functions.php");
include("common/includes/common.php");
include("common/includes/admin_session.php");
include("common/includes/expire.php");
include("common/includes/allstripslashes.php");
include("common/includes/english_admin.php");
include_once("common/includes/Charts.php");
include 'common/conf/init.php';

 global $oracledatabase ;

date_default_timezone_set("Asia/Kolkata");

error_reporting(0);
$msg = $_GET['msg'];
$sesver = $_SESSION['SESS_STU_ADMINID']; //echo $sesver;  
$lictype = $_SESSION['LIC_TYPE'];
$sql = "select * from $oracledatabase.".tbl_usermaster." where user_id='$sesver'"; 
//echo $sql; exit;
$ret = db_query($sql);

$row = db_fetch_object($ret);
$scode = $row->Site_Code; //echo $scode."<br>"; 
$_SESSION['SESS_USER_TYPE']=$row->STATUS;
$usertype = $row->STATUS; //echo $rcode."<br>";  
$admin_username = $row->username; //echo $ecode."<br>";
//exit();
//if session expired
if (empty($_SESSION['SESS_STU_ADMINID'])) { 
    //show login page     
    header("Location:login.php?act=$act");
    exit;
}

if (empty($_SESSION['SESS_STU_ADMINID'])) {
    //show login page     
    header("Location:login.php?act=$act");
    exit;
} else {
    session_start();

    $inactive = 1200 * 3;
    if (isset($_SESSION['timeout'])) {
        $session_life = time() - $_SESSION['timeout'];
        if ($session_life > $inactive) {
            session_destroy();
            header("Location: login.php?msg=Your session expired!!&act=$act");
        } else {
            $_SESSION['timeout'] = time();
            $sql = "select * from $oracledatabase.".tbl_permission." where user_id='$sesver' and ROWNUM=1 ";
            // ECHO $sql; exit;
            $ret = db_query($sql);            
            $row = db_fetch_object($ret);
		
            // print_r($row); exit;
            // $sql1 = "SELECT * FROM configuration WHERE 1=1";
            // $res1 = db_query($sql1);
            // $data1 = db_fetch_object($res1);

            // $sql = "SELECT * FROM configuration";
            // $res = db_query($sql);
            // $data = db_fetch_object($res);
            ?>



            <!DOCTYPE html>
            <html>
                <head>
                    <?php include('index_head.php'); ?>
                    <!--for date picker-->
                    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


                    <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
                    <!--for date picker-->
                     <script src="formvalidate.js"></script>



                    <style>

                        body {
                            /* default is 1rem or 16px */
                            font-size: 15px;
                        }

                        .navbar-custom {
                            background-color: #00569d;
                            
                        }
                        .nav-link:hover
                        {
                            cursor: pointer;
                            color: #00569d;
                        }
						
						
						/* Chrome, Safari, Edge, Opera */
							input::-webkit-outer-spin-button,
							input::-webkit-inner-spin-button {
							  -webkit-appearance: none;
							  margin: 0;
							}

							
									
							blink {
	  -webkit-animation: 2s linear infinite condemned_blink_effect; /* for Safari 4.0 - 8.0 */
	  animation: 1s linear infinite condemned_blink_effect;
	}

	/* for Safari 4.0 - 8.0 */
	@-webkit-keyframes condemned_blink_effect {
	  0% {
		visibility: hidden;
	  }
	  50% {
		visibility: hidden;
	  }
	  100% {
		visibility: visible;
	  }
	}

	@keyframes condemned_blink_effect {
	  0% {
		visibility: hidden;
	  }
	  50% {
		visibility: hidden;
	  }
	  100% {
		visibility: visible;
	  }
	}

    .alert.ml-auto::before {
                        content: "";
                        display: inline-block;
                        width: 16px;
                        height: 16px;
                        background-image: url("dist/img/sign_error.png");
                        background-size: cover;
                        margin-right: 8px;
     }
                    </style>
                    <link rel='icon' href='dist/img/favicon.ico' type='image/x-icon' sizes="16x16" />
                </head>

                <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
                    <div class="wrapper">

                        <!-- Navbar -->


                        <nav class="main-header navbar navbar-expand navbar-white navbar-light navbar-custom">
                            <!-- Left navbar links -->
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars" style="color:white;"></i></a>
                                </li>

                            </ul>
							 
                            <?php
                        if ($days_left < 30) {
                            if ($days_left == 0) $days_left_in_words = "<b>today</b>";
                            else $days_left_in_words = "in <b>$days_left</b> days";
                        ?>
                            <div class="alert ml-auto" style="background: #ffeee2; padding: 1px 0;" role="alert">
                                <span class="expiration-msg">
                                    This software will expire <?= $days_left_in_words ?>. Contact Stallion team.
                                </span>
                            </div>


                        <?php
                        }
                         ?>


                            <!-- Right navbar links -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Messages Dropdown Menu -->
                                <!-- <li class="nav-item dropdown ">
                                    <a class="nav-link" data-toggle="dropdown" href="#">
                                        <i class="far fa-comments" style="color:white;"></i>

                                    </a>
                                </li>
                                 Notifications Dropdown Menu
                                <li class="nav-item dropdown">
                                    <a class="nav-link" data-toggle="dropdown" href="#">
                                        <i class="far fa-bell " style="color:white;"></i>
                                    </a>
                                </li> -->
                                <li class="nav-item dropdown user-menu ">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                        <img src="dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
                                        <span class="d-none d-md-inline text-white"><?php echo $admin_username ?></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right ">
                                        <!-- User image -->
                                        <li class="user-header bg-white">
                                            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

                                            <p>
                                                <?php echo $admin_username ?> - <?php echo ($usertype == 1) ? 'Administrator' : 'Standard User' ?>
                                          <!--   <small>Member since Nov. 2012</small> -->
                                            </p>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer text-center">
                                           <!-- <a href="#" class="btn btn-default btn-flat">Profile</a>-->
                                            <a href="logout.php" class="btn btn-default btn-flat float-none">Sign out</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <!-- /.navbar -->

                        <!-- Main Sidebar Container -->
                        <aside class="main-sidebar bg-white elevation-4">
                            <!-- Brand Logo -->


                            
                             <a href="index.php" class="brand-link logo-switch">
                                <img src="dist/img/favicon.ico" alt="AdminLTE Docs Logo Small" class="brand-image-xl logo-xs">
                                <img src="dist/img/logo.svg" alt="AdminLTE Docs Logo Large" class="brand-image-xs logo-xl" style="left: 12px">
                            </a>


                            <!-- Sidebar -->
                            <div class="sidebar">
                                <!-- Sidebar user panel (optional) -->
                                <!-- Sidebar Menu -->

                                <nav class="mt-2">
                                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                        

                                        <?php
                                        if ($act == "device" or $act == "adddevice" or $act == "permission" or $act == "addpermission" or
                                               $act == "user" or $act == "adduser" or $act== "calibration" or $act== "cam" ) {
                                            $cls = 1;
                                        }
                                        
                                        if ($row->M1 == 1 or $row->M2 == 1 or $row->M3 == 1  or $row->P1 == 1 ) {
                                            ?>



                                            <?php if ($row->M1 == 1) { ?>

                                            <li class="nav-item " ><a href="device"  class="nav-link mt-3 <?php if ($act == "device" or $act == "adddevice") { ?>active   <?php } ?>" <?php if ($act == "device" or $act == "adddevice") { ?>style="background-color: #00569d;"   <?php } ?>> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;Device Master</p>  </a></li><?php } ?>

                                            <?php if ($row->M2 == 1) { ?>
                                            <li class="nav-item"><a href="user"  class="nav-link <?php if ($act == "user" or $act == "adduser") { ?>active  <?php } ?>" <?php if ($act == "user" or $act == "adduser") { ?>style="background-color: #00569d;"   <?php } ?>>  <i class="fa fa-chevron-circle-right"></i><p style="font-size:14px">&nbsp;&nbsp;User Master</p> </a></li><?php } ?>

                                            <?php if ($row->M3 == 1) { ?>
                                            <li class="nav-item"><a href="calibration"  class="nav-link <?php if ($act == "calibration" or $act == "addcalibration") { ?>active  <?php } ?>" <?php if ($act == "calibration" or $act == "addcalibration") { ?>style="background-color: #00569d;"   <?php } ?>>  <i class="fa fa-chevron-circle-right"></i><p style="font-size:14px">&nbsp;&nbsp;Stamping</p> </a></li><?php } ?>


                                            <?php if ($row->P1 == 1) { ?>
                                            <li class="nav-item " ><a href="permission"  class="nav-link <?php if ($act == "permission" or $act == "addpermission") { ?>active <?php } ?>"  <?php if ($act == "permission" or $act == "addpermission") { ?>style="background-color: #00569d;"   <?php } ?> > <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;User Permission</p>  </a></li><?php } ?>


                                      

                                            <?php
                                        }

                                       

                                       ?>
                                </nav>
                                <!-- /.sidebar-menu -->
                            </div>
                            <!-- /.sidebar -->
                        </aside>



                        <div class="content-wrapper">
                            <?php
                            switch ($act) {

                                //MASTERS
                                //dashboard
        //    case "dashbord": 
	  	// if($row->m1==1)  
        //        {
        //            include("welcome.php");
		// }
	    // break; 
                                //vendor master
                                case "device":
                                    if ($row->M1 == 1) {
                                        include("device.php");
                                    }
                                    break;

                                case "adddevice":
                                    if ($row->M1 == 1) {
                                        include("device_add.php");
                                    }
                                    break;


                               

                                //user master
                                case "user":
                                    if ($row->M2 == 1) {
                                        include("user.php");
                                    }
                                    break;

                                case "adduser":
                                    if ($row->M2 == 1) {
                                        include("user_add.php");
                                    }
                                    break;

                                    case "calibration":
                                        if ($row->M3 == 1) {
                                            include("calibration.php");
                                        }                                       
                                        break;
    
                                        case "cam":
                                            if ($row->M3 == 1) {
                                                include("cam.php");
                                            }                                       
                                            break;

                                    //UTILITY
                                //permission 

                                case "permission":
                                    if ($row->P1 == 1) {
                                        include("permission.php");
                                    }
                                    break;

                                case "changepassword":
                                    if ($row->P2 == 1) {
                                        include("changepassword.php");
                                    }
                                    break;

                              

                                
									

                                /*default:
                                     include("welcome.php");
                                     break; */
                            }
                            ?>
                        </div>



                        <footer class="main-footer">
                            <small>Copyright © 2023 <a href="https://www.stallionglobal.com/">Stallion Systems & Solutions</a>.
                                All rights reserved.</small>



                        </footer>

                        <!-- Control Sidebar -->
                        <aside class="control-sidebar control-sidebar-dark">
                            <!-- Control sidebar content goes here -->
                        </aside>
                        <!-- /.control-sidebar -->
                    </div>

                </body>
                <script>
                    $("form#quickfilter #search-btn").click(function (event) {
                        $("form#quickfilter input[name='q']").triggerHandler('keyup');
                    });
                    $("form#quickfilter input[name='q']").keyup(function (event) {

                        if (event.keyCode == 27) {
                            $(this).val("");
                        }

                        var userneeds = $(this).val().toLowerCase();
                        var sidebarLi = $('.sidebar-menu').find('li');

                        // hide all first..
                        $(".treeview.menu-open").removeClass('menu-open').find('.treeview-menu').hide();
                        $(".sidebar-menu>li,.treeview-menu>li").hide();

                        // search
                        var anythingFound = false;
                        for (var i = 0; i < sidebarLi.length; i++) {
                            var $li = $(sidebarLi[i]);
                            var aText = $li.find('a:first').text().toLowerCase();
                            if (aText.indexOf(userneeds) !== -1) {
                                $li.parents('.treeview').addClass('menu-open').show();
                                $li.parents('.treeview-menu').show();
                                $li.show();
                                anythingFound = true;
                            }
                        }
                        if (userneeds === '') {
                            $(".sidebar-menu>li").show();
                        }
                    });
                    $(document).ready(function () {
                        $('[data-href="<?php echo $act ?>"]').css('color', '#e8e8e8');
                    });

                </script>

            </html>
            <?php
        }
    }
}
?>

<!--<script src="plugins/jquery/jquery.min.js"></script>-->
<script src="plugins/select2/js/select2.full.min.js"></script>