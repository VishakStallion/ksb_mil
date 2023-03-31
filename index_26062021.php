<?php
include("common/includes/constants.php");
include("common/includes/functions.php");
include("common/includes/common.php");
include("common/includes/admin_session.php");
include("common/includes/allstripslashes.php");
include("common/includes/english_admin.php");
include_once("common/includes/Charts.php");
include 'common/conf/init.php';
//include_once("common/includes/license_functions.php");

date_default_timezone_set("Asia/Kolkata");


$msg = $_GET['msg'];
$sesver = $_SESSION['SESS_STU_ADMINID']; //echo $sesver;  
$lictype = $_SESSION['LIC_TYPE'];
$sql = "select * from `usermaster` where `user_id`='$sesver'"; //echo $sql;
$ret = mysql_query($sql);
$row = mysql_fetch_object($ret);
$scode = $row->Site_Code; //echo $scode."<br>"; 
$_SESSION['SESS_USER_TYPE']=$row->user_type;
$usertype = $row->user_type; //echo $rcode."<br>";  
$dcode = $row->Dep_Code; //echo $dcode."<br>";   
$lcode = $row->Loc_Id; //echo $lcode."<br>";    
$ecode = $row->Emp_Code; //echo $ecode."<br>";    
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
            $sql = "select * from `permission` where `user_id`='$sesver'";
            $ret = mysql_query($sql);
            $row = mysql_fetch_object($ret);

            $sql1 = "SELECT * FROM `configuration` WHERE 1=1";
            $res1 = mysql_query($sql1);
            $data1 = mysql_fetch_object($res1);

            $sql = "SELECT * FROM configuration";
            $res = mysql_query($sql);
            $data = mysql_fetch_object($res);
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

 <!--                   
 <link rel="stylesheet" href="css/pqselect.min.css" />
<link rel="stylesheet" href="css/pqselect.dev.css" />
<link rel="stylesheet" href="css/pqselect.bootstrap.dev.css" />
<link rel="stylesheet" href="css/pqselect.bootstrap.min.css" />
                     <script src="js/pqselect.min.js"></script>
                     <script src="js/pqselect.dev.js"></script> -->

                    <style>

                        body {
                            /* default is 1rem or 16px */
                            font-size: 15px;
                        }

                        .navbar-custom {
                            background-color: #475466;
                        }

                    </style>
                    <link rel='icon' href='dist/img/<?php echo $data->favicon; ?>' type='image/x-icon' sizes="16x16" />
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
                        <aside class="main-sidebar sidebar-dark-primary elevation-4">
                            <!-- Brand Logo -->


                            
                             <a href="index.php" class="brand-link logo-switch">
                                <img src="dist/img/bgimg1578637681.jpg" alt="AdminLTE Docs Logo Small" class="brand-image-xl logo-xs">
                                <img src="dist/img/<?php echo $data1->icon; ?>" alt="AdminLTE Docs Logo Large" class="brand-image-xs logo-xl" style="left: 12px">
                            </a>


                            <!-- Sidebar -->
                            <div class="sidebar">
                                <!-- Sidebar user panel (optional) -->
                                <!-- Sidebar Menu -->

                                <nav class="mt-2">
                                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                        <!-- Add icons to the links using the .nav-icon class
                                             with font-awesome or any other icon font library -->
                                        <!-- <li class="nav-item has-treeview menu-open">
                                            <a href="dashbord" class="nav-link <?php if ($act == "dashbord") { ?>active<?php } ?>">

                                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                                <p>
                                                    Dashboard
                                                </p>
                                            </a>

                                        </li> -->

                                        <?php
                                        if ($act == "vendor" or $act == "addvendor" or $act == "vendorloc" or $act == "addvendorloc" or $act == "asnuser" or $act == "addasnuser" or
                                                $act == "branch" or $act == "addbranch" or $act == "location" or $act == "addlocation" or $act == "item" or $act == "additem" or $act == "bin" or
                                                $act == "binadd" or $act == "user" or $act == "adduser" or $act == "reason" or $act == "reasonadd" or $act == "line" or $act == "addline"
                                                or $act == "partnolink" or $act == "addpartnolink" or $act == "party" or $act == "partyadd" or $act == "category" or $act == "addcategory" or $act == "subcategory" or $act == "addsubcategory" or $act == "uom" or $act == "adduom" or $act== "customer" 
                                                or $act=="addcustomer" or $act=="receipe" or $act=="addreceipe" or $act=="mrp") {
                                            $cls = 1;
                                        }
                                        if ($row->m1 == 1 or $row->m2 == 1 or $row->m3 == 1 or $row->m4 == 1 or $row->m5 == 1 or $row->m6 == 1 or $row->m7 == 1 or $row->m8 == 1 or $row->m9 == 1
                                                or $row->m10 == 1 or $row->m11 == 1 or $row->m16 == 1 or $row->m12 == 1 or $row->m13 == 1 or $row->m14 ==1) {
                                            ?>


                                            <li class="nav-item has-treeview <?php if ($cls == 1) { ?>menu-open<?php } ?>">
                                                <a href="#" class="nav-link <?php if ($cls == 1) { ?>active<?php } ?>">
                                                    <i class="nav-icon fa fa-book"></i>
                                                    <p>
                                                        Master
                                                        <i class="fas fa-angle-left right"></i>
                                                    </p>
                                                </a>
                                                <ul class="nav nav-treeview p-1 " >

                                                    <?php if ($row->m1 == 1) { ?>


                                                        <li class="nav-item " ><a href="vendor"  class="nav-link <?php if ($act == "vendor" or $act == "addvendor") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;Vendor Master</p>  </a></li><?php } ?>


                                                    <!-- <?php if ($row->m2 == 1) { ?>
                                                        <li class="nav-item"><a href="vendorloc"  class="nav-link <?php if ($act == "vendorloc" or $act == "addvendorloc") { ?>active<?php } ?>">  <i class="fa fa-chevron-circle-right"></i><p style="font-size:14px">&nbsp;&nbsp;Vendor Location Master</p> </a></li><?php } ?> -->


                                                    <?php if ($row->m4 == 1) { ?>
                                                        <li class="nav-item"><a href="branch"  class="nav-link <?php if ($act == "branch" or $act == "addbranch") { ?>active<?php } ?>">  <i class="fa fa-chevron-circle-right"></i><p style="font-size:14px">&nbsp;&nbsp;Branch Master</p> </a></li><?php } ?>

                                                    <?php if ($row->m5 == 1) { ?>
                                                        <li class="nav-item"><a href="location"  class="nav-link <?php if ($act == "location" or $act == "addlocation") { ?>active<?php } ?>">  <i class="fa fa-chevron-circle-right"></i><p style="font-size:14px">&nbsp;&nbsp;Storage Location Master</p> </a></li><?php } ?>

                                                    <?php if ($row->m6 == 1) { ?>
                                                        <li class="nav-item"><a href="bin"  class="nav-link <?php if ($act == "bin" or $act == "binadd") { ?>active<?php } ?>">  <i class="fa fa-chevron-circle-right"></i><p style="font-size:14px">&nbsp;&nbsp;Bin Master</p> </a></li><?php } ?>
                                                        
                                                    <?php if ($row->m3 == 1) { ?>
                                                        <li class="nav-item"><a href="category"  class="nav-link <?php if ($act == "category" or $act == "addcategory") { ?>active<?php } ?>">  <i class="fa fa-chevron-circle-right"></i><p style="font-size:14px">&nbsp;&nbsp; Category Master</p> </a></li><?php } ?> 
                                                        
                                                        <?php if ($row->m12 == 1) { ?>
                                                        <li class="nav-item"><a href="subcategory"  class="nav-link <?php if ($act == "subcategory" or $act == "addsubcategory") { ?>active<?php } ?>">  <i class="fa fa-chevron-circle-right"></i><p style="font-size:14px">&nbsp;&nbsp; Sub Category Master</p> </a></li><?php } ?> 
                                                        
                                                        <?php if ($row->m13 == 1) { ?>
                                                        <li class="nav-item"><a href="uom"  class="nav-link <?php if ($act == "uom" or $act == "adduom") { ?>active<?php } ?>">  <i class="fa fa-chevron-circle-right"></i><p style="font-size:14px">&nbsp;&nbsp; UOM Master</p> </a></li><?php } ?> 

                                                    <?php if ($row->m7 == 1) { ?>
                                                        <li class="nav-item"><a href="item"  class="nav-link <?php if ($act == "item" or $act == "additem") { ?>active<?php } ?>">  <i class="fa fa-chevron-circle-right"></i><p style="font-size:14px">&nbsp;&nbsp;Item Master</p> </a></li><?php } ?>

                                                        <?php if ($row->m14 == 1) { ?>
                                                        <li class="nav-item"><a href="customer"  class="nav-link <?php if ($act == "customer" or $act == "addcustomer") { ?>active<?php } ?>">  <i class="fa fa-chevron-circle-right"></i><p style="font-size:14px">&nbsp;&nbsp;Customer Master</p> </a></li><?php } ?>

                                                    <?php if ($row->m8 == 1) { ?>
                                                        <li class="nav-item"><a href="user"  class="nav-link <?php if ($act == "user" or $act == "adduser") { ?>active<?php } ?>">  <i class="fa fa-chevron-circle-right"></i><p style="font-size:14px">&nbsp;&nbsp;User Master</p> </a></li><?php } ?>

                                                    <?php if ($row->m9 == 1) { ?>
                                                        <li class="nav-item"><a href="reason"  class="nav-link <?php if ($act == "reason" or $act == "reasonadd") { ?>active<?php } ?>">  <i class="fa fa-chevron-circle-right"></i><p style="font-size:14px">&nbsp;&nbsp;Reason Master</p> </a></li><?php } ?>

                                                    
                                                        
                                                        <?php if ($row->m10 == 1) { ?>


                                                        <li class="nav-item " ><a href="receipe"  class="nav-link <?php if ($act == "receipe" or $act == "addreceipe") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;Receipe Master</p>  </a></li><?php } ?>
														
														
														
                                                        <?php if ($row->m11 == 1) { ?>


                                                        <li class="nav-item " ><a href="mrp"  class="nav-link <?php if ($act == "mrp") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;Mrp Master</p>  </a></li><?php } ?>



                                                   <!--  <?php if ($row->m11 == 1) { ?>
                                                        <li class="nav-item"><a href="partnolink"  class="nav-link <?php if ($act == "partnolink" or $act == "addpartnolink") { ?>active<?php } ?>">  <i class="fa fa-chevron-circle-right"></i><p style="font-size:14px">&nbsp;&nbsp;BOM Master</p> </a></li><?php } ?>

                                                    <?php if ($row->m16 == 1) { ?>
                                                        <li class="nav-item"><a href="party"  class="nav-link <?php if ($act == "party" or $act == "partyadd") { ?>active<?php } ?>">  <i class="fa fa-chevron-circle-right"></i><p style="font-size:14px">&nbsp;&nbsp;Party Master</p> </a></li><?php } ?> -->


                                                </ul>
                                            </li>

                                            <?php
                                        }

                                        if ($act == "qc" or $act == "gate_entry_with_asn" or $act == "gate_entry_without_asn" or $act == "rm" 
                                                or $act == "GRN" or $act == "grn_edit" or $act == "productionentry" or $act == "productionclosing" or $act == "barcodegen" 
                                                or $act == "Routecard_entry" or $act == "Outward_picklist_generation" or $act == "gate_entry_against_osp"
                                                or $act == "osp_inward_lot_generation" or $act == "dispatch_entry"  or $act == "dispatch_gate_entry" 
                                                or $act == "osp_inward_gate_entry" or $act== "rejection_entry" or $act== "production_inline_rejection_entry"
                                                or $act=="jobcard_entry" or  $act=="OSPOutward_entry" or $act=="material_issue_cancel" or $act=="dispatch_cancel" or $act=="dispatch_manual_close") {
                                            $cls = 2;
                                        }
                                        if ($row->i1 == 1 or $row->i2 == 1 or $row->i3 == 1 or $row->i4 == 1 or $row->i5 == 1 or $row->i6 == 1 or $row->i7 == 1 or $row->i8 == 1 or $row->i9 == 1
                                                or $row->i10 == 1 or $row->i11 == 1 or $row->i12 == 1 or $row->i13 == 1 or $row->i14 == 1 or $row->i15 == 1 or $row->i16 == 1 or $row->i17 == 1 or $row->i18 == 1) {
                                            ?>


                                            <li class="nav-item has-treeview <?php if ($cls == 2) { ?>menu-open<?php } ?>">
                                                <a href="#" class="nav-link <?php if ($cls == 2) { ?>active<?php } ?>">
                                                    <i class="nav-icon fa fa-book"></i>
                                                    <p>
                                                        Transaction
                                                        <i class="right fas fa-angle-left"></i>
                                                    </p>
                                                </a>
                                                <ul class="nav nav-treeview p-1 " >

                                                    

                                                    <?php if ($row->i5 == 1) { ?>  
                                                        
                                                        <li class="nav-item"><a href="GRN"  class="nav-link <?php if ($act == "GRN" or $act == "grn_edit") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp; GRN </p>  </a></li><?php } ?>

                                                     <?php if ($row->i1 == 1) { ?> 
                                                        <li class="nav-item " ><a href="qc"  class="nav-link <?php if ($act == "qc") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp; QC Confirmation </p>  </a></li><?php } ?> 

                                                  

                                                    <?php if ($row->i8 == 1) { ?>    <!-- Aswin 18/06/2020 -->
                                                        <li class="nav-item"><a href="Routecard_entry"  class="nav-link <?php if ($act == "Routecard_entry") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp; Material Issue Entry </p>  </a></li><?php } ?>

                                                    <?php if ($row->i6 == 1) { ?>    
                                                        <li class="nav-item"><a href="productionentry"  class="nav-link <?php if ($act == "productionentry") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp; Production Entry </p>  </a></li><?php } ?>
                                                        
                                                                                             <?php if ($row->i17 == 1) { ?>    
                                                        <li class="nav-item"><a href="production_inline_rejection_entry"  class="nav-link <?php if ($act == "production_inline_rejection_entry") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp; Inline Rejection Entry </p>  </a></li><?php } ?> 

                                                           <?php if ($row->i9 == 1) { ?>    
                                                        <li class="nav-item"><a href="productionclosing"  class="nav-link <?php if ($act == "productionclosing") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp; Production Closing </p>  </a></li><?php } ?>

                     
    
                                                     <?php if ($row->i12 == 1) { ?>    <!-- Anjali 15/09/2020 -->
                                                        <li class="nav-item"><a href="dispatch_entry"  class="nav-link <?php if ($act == "dispatch_entry") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Dispatch Entry</p>  </a></li><?php } ?>
                                                        
                                                          <?php if ($row->i10 == 1) { ?>    
                                                        <li class="nav-item"><a href="material_issue_cancel"  class="nav-link <?php if ($act == "material_issue_cancel") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Material Issue Cancel </p>  </a></li><?php } ?>    
                                                        
                                                        
                                                     <?php if ($row->i11 == 1) { ?> 
                                                        <li class="nav-item"><a href="dispatch_cancel"  class="nav-link <?php if ($act == "dispatch_cancel") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px"> Dispatch Cancel</p>  </a></li><?php } ?> 
                                                        
                                                         <?php if ($row->i14 == 1) { ?>    
                                                        <li class="nav-item"><a href="dispatch_manual_close"  class="nav-link <?php if ($act == "dispatch_manual_close") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Dispatch Manual Close </p>  </a></li><?php } ?>  
                                                        
                                                   <!--   <?php if ($row->i13 == 1) { ?>    
                                                        <li class="nav-item"><a href="dispatch_gate_entry"  class="nav-link <?php if ($act == "dispatch_gate_entry") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Dispatch Gate Entry </p>  </a></li><?php } ?>    -->
                                                        
                                                        
                                                    <!-- <?php if ($row->i7 == 1) { ?> //SAJEER 26/06/2020 
                                                        <li class="nav-item"><a href="barcodegen"  class="nav-link <?php if ($act == "barcodegen") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px"> Barcode And Lot no Generation </p>  </a></li><?php } ?> -->
                                                        
                                                       <!--  <?php if ($row->i18 == 1) { ?>    
                                                        <li class="nav-item"><a href="OSPOutward_entry"  class="nav-link <?php if ($act == "despatchOutward_entry") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;OSP Outward Entry </p>  </a></li><?php } ?>  -->

                                                    <?php if ($row->i10 == 1) { ?>    <!-- SAJEER 29/06/2020 -->
                                                        <!--<li class="nav-item"><a href="Outward_picklist_generation"  class="nav-link <?php if ($act == "Outward_picklist_generation") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp; OSP Picklist Generation </p>  </a></li>--> <?php } ?>


                                                   <!--  <?php if ($row->i9 == 1) { ?>   
                                                        <li class="nav-item"><a href="gate_entry_against_osp"  class="nav-link <?php if ($act == "gate_entry_against_osp") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;OSP Outward Gate Entry </p>  </a></li><?php } ?> -->
<!-- 
                                                    <?php if ($row->i14 == 1) { ?>  
                                                        <li class="nav-item"><a href="osp_inward_gate_entry"  class="nav-link <?php if ($act == "osp_inward_gate_entry") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;OSP Inward Gate Entry </p>  </a></li><?php } ?>
 -->
                                                    <!-- <?php if ($row->i11 == 1) { ?>   
                                                        <li class="nav-item"><a href="osp_inward_lot_generation"  class="nav-link <?php if ($act == "osp_inward_lot_generation") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;OSP Inward Entry </p>  </a></li><?php } ?>
 -->
                                                    
                                                    
                                                       
                                                       
                                                        <!-- <?php if ($row->i18 == 1) { ?>    
                                                        <li class="nav-item"><a href="jobcard_entry"  class="nav-link <?php if ($act == "jobcard_entry") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Job Order Entry </p>  </a></li><?php } ?> -->

                                                     
													
                                                         

                                                </ul> 
                                            </li>
                                            <?php
                                        }

                            if (       
                                       $act == "rpo_report" 
                                    or $act == "rpo_report_detailed"
                                    or $act == "rpo_report_summary"

                                    or $act == "rpo_pending_report"
                                    or $act == "rpo_pending_report_summary"
                                    or $act == "rpo_pending_report_detailed"

                                    or $act == "production_confirmation_report"
                                    or $act == "production_confirmation_report_summary"
                                    or $act == "production_confirmation_report_detailed"

                                      or $act == "rm_return_scan_report"
                                or $act == "rm_return_scan_report_summary"
                                  or $act == "rm_return_scan_report_item"
                                   or $act == "rm_return_scan_report_detailed"

                                    or $act == "dispatch_order_report"
                                    or $act == "dispatch_order_report_summary"
                                    or $act == "dispatch_order_report_detailed"

                                    or $act == "dispatch_order_pending_report"
                                    or $act == "dispatch_order_pending_report_summary"
                                    or $act == "dispatch_order_pending_report_detailed"

                                    or $act == "dispatch_plan_report"
                                    or $act == "dispatch_plan_report_summary"
                                    or $act == "dispatch_plan_report_detailed"

                                    or $act == "dispatch_scan_sel"
                                    or $act == "dispatch_scan_summary"
                                    or $act == "dispatch_scan_detailed"

                                    or $act == "dispatch_scan_pending"
                                    or $act == "dispatch_scan_pending_summary"
                                    or $act == "dispatch_scan_pending_detailed"

                                    or $act == "dispatch_conf_scan"
                                    or $act == "dispatch_conf_scan_summary"
                                    or $act == "dispatch_conf_scan_detailed"

                                    or $act == "dispatch_conf_scan_pend"
                                    or $act == "dispatch_conf_scan_pend_summary"
                                    or $act == "dispatch_conf_scan_pend_detailed"
                                    or $act == "qc_confirmation"
                                    or $act == "qc_confirmation_summary"
                                    or $act == "qc_confirmation_detailed"


                                    or $act == "barcode_history"
                                    or $act == "barcode_history_detailed"

                                
                                    or $act == "grnreport" 
                                    or $act == "grn_report_summary" 
                                    or $act == "grn_report_detailed" 
                                     or $act == "grn_report_itemwise" 

                                    or $act == "bin_to_bin_rpt"
                                    or $act == "bin_to_bin_summary" 
                                    or $act == "bin_to_bin_detailed" 
                                    

                                    or $act == "stockreport" 

                                    or $act == "route_card_report" 
                                    or $act == "route_cardreport_summary" 
                                    or $act == "route_cardreport_detailed" 

                                    or $act == "production_report"
                                    or $act == "production_report_summary" 
                                    or $act == "production_report_detailed"

									or $act == "production_pending_report"
                                    or $act == "production_pending_report_summary" 
                                    or $act == "production_pending_report_detailed"

                                    or $act == "storage_scan_rpt" 

                                    or $act == "production_scan_rpt"
                                    or $act == "production_scan_detailed" 

                                    or $act == "route_card_scan_report" 
                                    or $act == "route_card_scan_report_summary" 
                                    or $act == "route_card_scan_report_detailed"

                                    or $act == "dispatch_entry_report" 
                                    or $act == "dispatch_entry_report_summary" 
                                    or $act == "dispatch_entry_report_detailed" 

                                    or $act == "rejection_scan_report" 
                                    or $act == "rejection_scan_report_summary" 
                                    or $act == "rejection_scan_report_detailed"
                                    or $act == "rejection_scan_report_itemwise"

                                     

                                    or $act == "rejection_scan_confirmation_report" 
                                    or $act == "rejection_scan_confirmation_report_summary"
                                    or $act == "rejection_scan_confirmation_report_detailed"

                                    or $act == "rejection_scan_confmtn_pendg_report" 
                                    or $act == "rejection_scan_confmtn_pendg_report_summary"
                                    or $act == "rejection_scan_confmtn_pendg_report_detailed" 

                                    or $act=="material_issue_report" 
                                    or $act=="material_issue_report_summary" 
                                    or $act=="material_issue_report_detailed"
                                    or $act=="routecard_picklist"

                                    or $act=="material_issue_scan_report" 
                                    or $act=="material_issue_scan_report_summary" 
                                    or $act=="material_issue_scan_report_detailed"
									
									or $act=="material_issue_pendg_report" 
                                    or $act=="material_issue_pendg_report_summary" 
                                    or $act=="material_issue_pendg_report_detailed"
									
									or $act=="rejection_inline_report" 
                                    or $act=="rejection_inline_report_summary" 
                                    or $act=="rejection_inline_report_detailed"
									
									 or $act=="rejection_inline_scan_report" 
                                    or $act=="rejection_inline_scan_report_summary" 
                                    or $act=="rejection_inline_scan_report_detailed"
									
									


                                                ) {

                                            $cls = 3;
                                        }
                                        if ($row->r1 == 1 or $row->r2 == 1 or $row->r3 == 1 or $row->r4 == 1 or $row->r5 == 1 or $row->r6 == 1 or $row->r7 == 1 or $row->r8 == 1 or $row->r9 == 1
                                                or $row->r10 == 1 or $row->r11 == 1 or $row->r12 == 1 or $row->r13 == 1 or $row->r14 == 1 or $row->r15 == 1 or $row->r16 == 1 or $row->r17 == 1
                                                or $row->r18 == 1 or $row->r19 == 1 or $row->r20 == 1 or $row->r21 == 1 or $row->r22 == 1 or $row->r23 == 1 or $row->r24 == 1 or $row->r25 == 1
                                                or $row->r26 == 1 or $row->r27 == 1 or $row->r28 == 1 or $row->r31 == 1  or $row->r32== 1  or $row->r33 == 1 or $row->r34 == 1 or $row->r35 == 1 or $row->r36 == 1 or $row->r37 == 1 or $row->r38 == 1 or $row->r39 == 1) {
                                            ?>

                                            <li class="nav-item has-treeview <?php if ($cls == 3) { ?>menu-open<?php } ?>">
                                                <a href="#" class="nav-link <?php if ($cls == 3) { ?>active<?php } ?>">
                                                    <i class="nav-icon fa fa-book"></i>
                                                    <p>
                                                        Reports
                                                        <i class="fas fa-angle-left right"></i>
                                                    </p>
                                                </a>

                                                <ul class="nav nav-treeview p-1 " >
                                               

                                                    <?php if ($row->r2 == 1) { ?>    
                                                        <li class="nav-item"><a href="grnreport"  class="nav-link <?php if ($act == "grnreport" or $act == "grn_report_detailed" or $act == "grn_report_summary" or $act == "grn_report_itemwise") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp; GRN Report </p>  </a></li><?php } ?>

                                                   <?php if ($row->r8 == 1) { ?>   
                                                        <li class="nav-item"><a href="stockreport"  class="nav-link <?php if ($act == "stockreport") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Stock Report </p>  </a></li><?php } ?>

                                                          <?php if ($row->r20 == 1) { ?>   
                                                        <li class="nav-item"><a href="barcode_history"  class="nav-link <?php if ($act == "barcode_history" or $act == "barcode_history_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Barcode History Report </p>  </a></li><?php } ?>
                                                    
                                                    <?php if ($row->r17 == 1) { ?>   
                                                        <li class="nav-item"><a href="storage_scan_rpt"  class="nav-link <?php if ($act == "storage_scan_rpt") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Storage Scan Report </p>  </a></li><?php } ?>

                                                          <?php if ($row->r15 == 1) { ?>   
                                                        <li class="nav-item"><a href="bin_to_bin_rpt"  class="nav-link <?php if ($act == "bin_to_bin_rpt" or $act == "bin_to_bin_summary" or $act == "bin_to_bin_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Bin To Bin Stock Transfer Report </p>  </a></li><?php } ?>

                                                         <?php if ($row->r19 == 1) { ?>   
                                                        <li class="nav-item"><a href="qc_confirmation"  class="nav-link <?php if ($act == "qc_confirmation" or $act == "qc_confirmation_summary" or $act == "qc_confirmation_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;QC Confirmation Report </p>  </a></li><?php } ?>
                                                        
														 <?php if ($row->r38 == 1) { ?>   
                                                        <li class="nav-item"><a href="rpo_report"  class="nav-link <?php if ($act == "rpo_report" or $act=='rpo_report_summary' or $act=='rpo_report_detailed') { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp; RPO  Report </p>  </a></li><?php } ?>


                                                         <?php if ($row->r39 == 1) { ?>   
                                                        <li class="nav-item"><a href="rpo_pending_report"  class="nav-link <?php if ($act == "rpo_pending_report" or $act == "rpo_pending_report_summary" or $act == "rpo_pending_report_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp; RPO Pending  Report </p>  </a></li><?php } ?>
                                                          
													<?php if ($row->r35 == 1) { ?>   
                                                     <li class="nav-item"><a href="material_issue_report"  class="nav-link <?php if ($act == "material_issue_report" or $act == "material_issue_report_summary" or $act == "material_issue_report_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Material Issue Report </p>  </a></li><?php } ?>
                                                   
												    <?php if ($row->r36 == 1) { ?>    
                                                     <li class="nav-item"><a href="material_issue_scan_report"  class="nav-link <?php if ($act == "material_issue_scan_report" or $act == "material_issue_scan_report_summary" or $act == "material_issue_scan_report_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Material Issue Scan Report </p>  </a></li><?php } ?>
													 
													 
													   <?php if ($row->r37 == 1) { ?>   
                                                     <li class="nav-item"><a href="material_issue_pendg_report"  class="nav-link <?php if ($act == "material_issue_pendg_report" or $act == "material_issue_pendg_report_summary" or $act == "material_issue_pendg_report_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Material Issue Pending Report </p>  </a></li><?php } ?>
													 
                                                   
													 

                                                    <?php if ($row->r12 == 1) { ?>   
                                                        <li class="nav-item"><a href="production_report"  class="nav-link <?php if ($act == "production_report" or $act == "production_report_summary" or $act == "production_report_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp; Production Entry Report </p>  </a></li><?php } ?>
														
													 <?php if ($row->r22 == 1) { ?>   
                                                        <li class="nav-item"><a href="production_pending_report"  class="nav-link <?php if ($act == "production_pending_report" or $act == "production_pending_report_summary" or $act == "production_pending_report_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp; Production Scan Pending Report </p>  </a></li><?php } ?>

                                                    <?php if ($row->r18 == 1) { ?>   
                                                        <li class="nav-item"><a href="production_confirmation_report"  class="nav-link <?php if ($act == "production_confirmation_report" or $act == "production_confirmation_report_summary" or $act == "production_confirmation_report_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp; Production Scan  Report </p>  </a></li><?php } ?>

                                                         <?php if ($row->r5 == 1) { ?>   
                                                        <li class="nav-item"><a href="rm_return_scan_report"  class="nav-link <?php if ($act == "rm_return_scan_report" or $act == "rm_return_scan_report_summary" or $act == "rm_return_scan_report_detailed" or $act=="rm_return_scan_report_item") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp; RM Return Scan  Report </p>  </a></li><?php } ?>


														<?php if ($row->r32 == 1) { ?>   
                                                        <li class="nav-item"><a href="rejection_scan_report"  class="nav-link <?php if ($act == "rejection_scan_report" or $act == "rejection_scan_report_summary" or $act == "rejection_scan_report_detailed" or $act == "rejection_scan_report_itemwise") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Rejection Scan Report </p>  </a></li><?php } ?>
                                                                                                            
                                                     
                                                       <?php if ($row->r33 == 1) { ?>    <!-- SAJEER 18/09/2020 -->
                                                    <li class="nav-item"><a href="rejection_inline_report"  class="nav-link <?php if ($act == "rejection_inline_report" or $act == "rejection_inline_report_summary" or $act == "rejection_inline_report_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Inline Rejection Report </p>  </a></li><?php } ?>
													 
													  <?php if ($row->r34 == 1) { ?>   
                                                    <li class="nav-item"><a href="rejection_inline_scan_report"  class="nav-link <?php if ($act == "rejection_inline_scan_report" or $act == "rejection_inline_scan_report_summary" or $act == "rejection_inline_scan_report_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Inline Rejection Scan Report </p>  </a></li><?php } ?>
                                                     
                                                           <?php if ($row->r6 == 1) { ?>   
                                                     <li class="nav-item"><a href="dispatch_order_report"  class="nav-link <?php if ($act == "dispatch_order_report" or $act == "dispatch_order_report_summary" or $act == "dispatch_order_report_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Dispatch Order Report </p>  </a></li><?php } ?>
													 
													 
													 
													  <?php if ($row->r7 == 1) { ?>   
                                                     <li class="nav-item"><a href="dispatch_order_pending_report"  class="nav-link <?php 
                                                     if ($act == "dispatch_order_pending_report"or $act == "dispatch_order_pending_report_summary" or $act == "dispatch_order_pending_report_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Dispatch Pending Order Report </p>  </a></li><?php } ?>

                                                     <?php if ($row->r9 == 1) { ?>   
                                                     <li class="nav-item"><a href="dispatch_plan_report"  class="nav-link <?php if ($act == "dispatch_plan_report" or $act == "dispatch_plan_report_summary" or $act == "dispatch_plan_report_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Dispatch Plan Report </p>  </a></li><?php } ?>

                                                 

                                                      <?php if ($row->r10 == 1) { ?>   
                                                     <li class="nav-item"><a href="dispatch_scan_sel"  class="nav-link <?php 
                                                     if ($act == "dispatch_scan_sel"or $act == "dispatch_scan_summary" or $act == "dispatch_scan_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Dispatch Scan Report </p>  </a></li><?php } ?>


                                                      <?php if ($row->r14 == 1) { ?>   
                                                     <li class="nav-item"><a href="dispatch_scan_pending"  class="nav-link <?php 
                                                     if ($act == "dispatch_scan_pending"or $act == "dispatch_scan_pending_summary" or $act == "dispatch_scan_pending_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Dispatch Scan Pending Report </p>  </a></li><?php } ?>



													
                                                      <?php if ($row->r11 == 1) { ?>   
                                                     <li class="nav-item"><a href="dispatch_conf_scan"  class="nav-link <?php 
                                                     if ($act == "dispatch_conf_scan"or $act == "dispatch_conf_scan_summary" or $act == "dispatch_conf_scan_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Dispatch Confirmation Scan Report </p>  </a></li><?php } ?>

                                                      <?php if ($row->r13 == 1) { ?>   
                                                     <li class="nav-item"><a href="dispatch_conf_scan_pend"  class="nav-link <?php 
                                                     if ($act == "dispatch_conf_scan_pend"or $act == "dispatch_conf_scan_pend_summary" or $act == "dispatch_conf_scan_pend_detailed") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;&nbsp;Dispatch Confirmation Scan Pending Report </p>  </a></li><?php } ?>
                                                        
                                                        
														
                                                </ul>	

                                            </li>
                                            <?php
                                        }

                                        if ($act == "permission" or $act == "addpermission" or $act == "changepassword" or $act == "opening_stock" or $act == "reprint") {
                                            $cls = 4;
                                        }
                                        if ($row->p1 == 1 or $row->p2 == 1 or $row->p3 == 1 or $row->p4 == 1) {
                                            ?>
                                            <li class="nav-item has-treeview <?php if ($cls == 4) { ?>menu-open<?php } ?>">
                                                <a href="#" class="nav-link <?php if ($cls == 4) { ?>active<?php } ?>">
                                                    <i class="nav-icon fa fa-book"></i>
                                                    <p>
                                                        Utilities
                                                        <i class="fas fa-angle-left right"></i>
                                                    </p>
                                                </a>

                                                <ul class="nav nav-treeview p-1 " >
                                                    <?php if ($row->p1 == 1) { ?>
                                                        <li class="nav-item " ><a href="permission"  class="nav-link <?php if ($act == "permission" or $act == "addpermission") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;User Permission</p>  </a></li><?php } ?>

                                                    <?php if ($row->p2 == 1) { ?>
                                                        <li class="nav-item " ><a href="changepassword"  class="nav-link <?php if ($act == "changepassword") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;Change Password</p>  </a></li><?php } ?>
														
														 <?php if ($row->p3 == 1) { ?>
                                                        <li class="nav-item " ><a href="opening_stock"  class="nav-link <?php if ($act == "opening_stock") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;Opening Stock</p>  </a></li><?php } ?>
														
														
														 <?php if ($row->p4 == 1) { ?>
                                                        <li class="nav-item " ><a href="reprint"  class="nav-link <?php if ($act == "reprint") { ?>active<?php } ?>"> <i class="fa fa-chevron-circle-right"></i> <p style="font-size:14px">&nbsp;Barcode Reprint</p>  </a></li><?php } ?>
                                                </ul> 
                                            </li>
                                        <?php } ?>
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
//            case "dashbord": 
//	  	if($row->m1==1)  
//                {
//                    include("welcome.php");
//		}
//	    break; 
                                //vendor master
                                case "vendor":
                                    if ($row->m1 == 1) {
                                        include("vendor.php");
                                    }
                                    break;

                                case "addvendor":
                                    if ($row->m1 == 1) {
                                        include("vendor_add.php");
                                    }
                                    break;


                                //branch master
                                case "branch":
                                    if ($row->m4 == 1) {
                                        include("branch.php");
                                    }
                                    break;

                                case "addbranch":
                                    if ($row->m4 == 1) {
                                        include("branch_add.php");
                                    }
                                    break;

                                //location master
                                case "location":
                                    if ($row->m5 == 1) {
                                        include("location.php");
                                    }
                                    break;

                                case "addlocation":
                                    if ($row->m5 == 1) {
                                        include("location_add.php");
                                    }
                                    break;

                                //bin master
                                case "bin":
                                    if ($row->m6 == 1) {
                                        include("bin.php");
                                    }
                                    break;

                                case "binadd":
                                    if ($row->m6 == 1) {
                                        include("bin_add.php");
                                    }
                                    break;
						
						//Category master
                                case "category":
                                    if ($row->m3 == 1) {
                                        include("category.php");
                                    }
                                    break;

                                case "addcategory":
                                    if ($row->m3 == 1) {
                                        include("category_add.php");
                                    }
                                    break;
									
						//Sub Category master
                                case "subcategory":
                                    if ($row->m12 == 1) {
                                        include("subcategory.php");
                                    }
                                    break;

                                case "addsubcategory":
                                    if ($row->m12 == 1) {
                                        include("subcategory_add.php");
                                    }
                                    break;
									
									//UOM master
                                case "uom":
                                    if ($row->m13 == 1) {
                                        include("uom.php");
                                    }
                                    break;

                                case "adduom":
                                    if ($row->m13 == 1) {
                                        include("uom_add.php");
                                    }
                                    break;
									
						
                                //item master
                                case "item":
                                    if ($row->m7 == 1) {
                                        include("item.php");
                                    }
                                    break;

                                case "additem":
                                    if ($row->m7 == 1) {
                                        include("item_add.php");
                                    }
                                    break;

                                case "customer":
                                    if ($row->m14 == 1) {
                                        include("customer.php");
                                    }
                                    break;
                                case "addcustomer":
                                    if ($row->m14 == 1) {
                                        include("customer_add.php");
                                    }
                                    break;

                                //user master
                                case "user":
                                    if ($row->m8 == 1) {
                                        include("user.php");
                                    }
                                    break;

                                case "adduser":
                                    if ($row->m8 == 1) {
                                        include("user_add.php");
                                    }
                                    break;


                                // reason master
                                case "reason":
                                    if ($row->m9 == 1) {
                                        include("reason.php");
                                    }
                                    break;

                                case "reasonadd":
                                    if ($row->m9 == 1) {
                                        include("reason_add.php");
                                    }
                                    break;

							//receipe master
								case "receipe":
                                    if ($row->m10 == 1) {
                                        include("receipe.php");
                                    }
                                    break;

                                case "addreceipe":
                                    if ($row->m10 == 1) {
                                        include("receipe_add.php");
                                    }
                                    break;

                                case "mrp":
                                    if ($row->m11 == 1) {
                                        include("mrp.php");
                                    }
                                    break;

                                //TRANSACTION
                                //qc checking
                                case "qc":
                                    if ($row->i1 == 1) {
                                        include("qc.php");
                                    }
                                    break;

                                // //gate entry with ASN 
                                // case "gate_entry_with_asn":
                                //     if ($row->i2 == 1) {
                                //         include("gate_entry_with_asn.php");
                                //     }
                                //     break;

                                // //gate entry with out ASN

                                // case "gate_entry_without_asn":
                                //     if ($row->i3 == 1) {
                                //         include("gate_entry_without_asn.php");
                                //     }
                                //     break;

                                //RM repacking
                                /*case "rm":
                                    if ($row->i4 == 1) {
                                        include("rm.php");
                                    }
                                    break;*/

                                case "GRN":
                                    if ($row->i5 == 1) {
                                        include("grn.php");
                                    }
                                    break;
                                    
                                     case "grn_edit":
                                    if ($row->i5 == 1) {
                                        include("grn_edit.php");
                                    }
                                    break;

                                //Production Entry
                                case "productionentry":
                                    if ($row->i6 == 1) {
                                        include("productionentry.php");
                                    }
                                    break;
                                    //production closing

                                    case "productionclosing":
                                    if ($row->i9 == 1) {
                                        include("production_closing.php");
                                    }
                                    break;

                                    
                                     //Production Rejection Entry
                                case "production_inline_rejection_entry":
                                    if ($row->i17 == 1) {
                                        include("production_inline_rejection_entry.php");
                                    }
                                    break;
                                

                                //Barcode Gen
                           /*     case "barcodegen":
                                    if ($row->i7 == 1) {
                                        include("barcodegen.php");
                                    }
                                    break;*/

                                //route card entry
                                case "Routecard_entry":
                                    if ($row->i8 == 1) {
                                        include("routecard_entry.php");
                                    }
                                    break;

                                //Outward Picklist Gen
                              /*  case "Outward_picklist_generation":
                                    if ($row->i10 == 1) {
                                        include("Outward_picklist_generation.php");
                                    }
                                    break;


                                //gate entry Against OSP

                                case "gate_entry_against_osp":
                                    if ($row->i9 == 1) {
                                        include("gate_entry_against_osp.php");
                                    }
                                    break;

                                // OSP INWARD LOT GEN

                                case "osp_inward_lot_generation":
                                    if ($row->i11 == 1) {
                                        include("osp_inward_lot_generation.php");
                                    }
                                    break;
*/

                                  // DISPATCH Entry

                                case "dispatch_entry":
                                    if ($row->i12 == 1) {
                                        include("dispatch_entry.php");
                                    }
                                    break;

	 						 case "material_issue_cancel":
                                    if ($row->i10 == 1) {
                                        include("material_issue_cancel.php");
                                    }
                                    break;
							  case "dispatch_cancel":
                                    if ($row->i11 == 1) {
                                        include("dispatch_cancel.php");
                                    }
                                    break;
							  case "dispatch_manual_close":
                                    if ($row->i14 == 1) {
                                        include("dispatch_manual_close.php");
                                    }
                                    break;

                                // DISPATCH GATE ENTRY

                            /*    case "dispatch_gate_entry":
                                    if ($row->i13 == 1) {
                                        include("dispatch_gate_entry.php");
                                    }
                                    break;


                                //OSP inward gate entry

                                case "osp_inward_gate_entry":
                                    if ($row->i14 == 1) {
                                        include("osp_inward_gate_entry.php");
                                    }
                                    break;
                                //Rejection Entry
                                case "rejection_entry":
                                    if ($row->i15 == 1) {
                                        include("rejection_entry.php");
                                    }
                                    break;
                                    
                                    case "jobcard_entry":
                                    if ($row->i16 == 1) {
                                        include("jobcard_entry.php");
                                    }
                                    break;


								case "OSPOutward_entry":
                                    if ($row->i18 == 1) {
                                        include("OSP_outward_entry.php");
                                    }
                                    break;

*/

                                //REPORTS
                                

                                //grn report
                                case "grnreport":
                                    if ($row->r2 == 1) {
                                        include("grnreport.php");
                                    }
                                    break;

                                case "grn_report_summary":
                                    if ($row->r2 == 1) {
                                        include("grnreport_summary.php");
                                    }
                                    break;

                                case "grn_report_detailed":
                                    if ($row->r2 == 1) {
                                        include("grnreport_detailed.php");
                                    }
                                    break;
                                    case "grn_report_itemwise":
                                    if ($row->r2 == 1) {
                                        include("grnreport_itemwise.php");
                                    }
                                    break;

                                    


                                //Storage Scan Report

                                case "storage_scan_rpt":
                                    if ($row->r17 == 1) {
                                        if ($mod == 'View')
                                            include("storage_scan_summary.php");
                                        else if ($mod == "Detailed")
                                            include("storage_scan_detailed.php");
                                        else
                                            include("storage_scan_select.php");
                                    }
                                    break;



                                    //rpo report
                                case "rpo_report":
                                    if ($row->r38 == 1) {
                                        include("rpo_report.php");
                                    }
                                    break;

                                case "rpo_report_summary":
                                    if ($row->r38 == 1) {
                                        include("rpo_report_summary.php");
                                    }
                                    break;

                                case "rpo_report_detailed":
                                    if ($row->r38 == 1) {
                                        include("rpo_report_detailed.php");
                                    }
                                    break;

                                    //rpo pending report
                                case "rpo_pending_report":
                                    if ($row->r39 == 1) {
                                        include("rpo_pending_report.php");
                                    }
                                    break;

                                case "rpo_pending_report_summary":
                                    if ($row->r39 == 1) {
                                        include("rpo_pending_report_summary.php");
                                    }
                                    break;

                                case "rpo_pending_report_detailed":
                                    if ($row->r39 == 1) {
                                        include("rpo_pending_report_detailed.php");
                                    }
                                    break;


                                    //Production Report
                                case "production_report":
                                    if ($row->r12 == 1) {
                                        include("production_report_sel.php");
                                    }
                                    break;

                                case "production_report_summary":
                                    if ($row->r12 == 1) {
                                        include("production_report_summary.php");
                                    }
                                    break;

                                case "production_report_detailed":
                                    if ($row->r12 == 1) {
                                        include("production_report_detailed.php");
                                    }
                                    break;

                                    //Production Confirmation Report

                                    case "production_confirmation_report":
                                    if ($row->r18 == 1) {
                                        include("production_confirmation_report.php");
                                    }
                                    break;

                                case "production_confirmation_report_summary":
                                    if ($row->r18 == 1) {
                                        include("production_confirmation_report_summary.php");
                                    }
                                    break;

                                case "production_confirmation_report_detailed":
                                    if ($row->r18 == 1) {
                                        include("production_confirmation_report_detailed.php");
                                    }
                                    break;
 
                                //RM Return Scan Report

                                    case "rm_return_scan_report":
                                    if ($row->r5 == 1) {
                                        include("rm_return_scan_report.php");
                                    }
                                    break;

                                case "rm_return_scan_report_summary":
                                    if ($row->r5 == 1) {
                                        include("rm_return_scan_report_summary.php");
                                    }
                                     case "rm_return_scan_report_item":
                                    if ($row->r5 == 1) {
                                        include("rm_return_scan_report_item.php");
                                    }
                                     case "rm_return_scan_report_detailed":
                                    if ($row->r5 == 1) {
                                        include("rm_return_scan_report_detailed.php");
                                    }

                                    
                                    
                                    break;


                                //stock report

                                case "stockreport":
                                    if ($row->r8 == 1) {
                                        if ($mod == 'View')
                                            include("stockreport_view.php");
                                        else if ($mod == "Detailed")
                                            include("stockreport_detailed.php");
                                        else if ($mod == "Binwise")
                                            include("stockreport_binwise.php");
                                        else
                                            include("stockreport_sel.php");
                                    }
                                    break;


                                     //Dispatch Plan Report

                                     case "dispatch_plan_report":
                                    if ($row->r9 == 1) {
                                        include("dispatch_plan_report.php");
                                    }
                                    break;

                                case "dispatch_plan_report_summary":
                                    if ($row->r9 == 1) {
                                        include("dispatch_plan_report_summary.php");
                                    }
                                    break;

                                case "dispatch_plan_report_detailed":
                                    if ($row->r9 == 1) {
                                        include("dispatch_plan_report_detailed.php");
                                    }
                                    break;

                                //Dispatch Order Report

                                     case "dispatch_order_report":
                                    if ($row->r6 == 1) {
                                        include("dispatch_order_report.php");
                                    }
                                    break;

                                case "dispatch_order_report_summary":
                                    if ($row->r6 == 1) {
                                        include("dispatch_order_report_summary.php");
                                    }
                                    break;

                                case "dispatch_order_report_detailed":
                                    if ($row->r6 == 1) {
                                        include("dispatch_order_report_detailed.php");
                                    }
                                    break;

                                    //Dispatch Pending Order Report

                                     case "dispatch_order_pending_report":
                                    if ($row->r7 == 1) {
                                        include("dispatch_order_pending_report.php");
                                    }
                                    break;

                                case "dispatch_order_pending_report_summary":
                                    if ($row->r7 == 1) {
                                        include("dispatch_order_pending_report_summary.php");
                                    }
                                    break;

                                case "dispatch_order_pending_report_detailed":
                                    if ($row->r7 == 1) {
                                        include("dispatch_order_pending_report_detailed.php");
                                    }
                                    break;

                                //Dispatch Scan Report
                                case "dispatch_scan_sel":
                                    if ($row->r10 == 1) {
                                       
                                        include("dispatch_scan_sel.php");
                                   }
                                    break;


                                case "dispatch_scan_detailed":
                                    if ($row->r10 == 1) {
                                        include("dispatch_scan_detailed.php");
                                    }
                                    break;

                                case "dispatch_scan_summary":
                                    if ($row->r10 == 1) {
                                        include("dispatch_scan_summary.php");
                                    }
                                    break;

    //Bin to bin transfer
                                case "bin_to_bin_rpt":
                                    if ($row->r15 == 1) {
                                       
                                        include("bin_to_bin_rpt.php");
                                   }
                                    break;


                                case "bin_to_bin_detailed":
                                    if ($row->r15 == 1) {
                                        include("bin_to_bin_detailed.php");
                                    }
                                    break;

                                case "bin_to_bin_summary":
                                    if ($row->r15 == 1) {
                                        include("bin_to_bin_summary.php");
                                    }
                                    break;



                                //Dispatch Scan Pending Report
                                case "dispatch_scan_pending":
                                    if ($row->r14 == 1) {
                                       
                                        include("dispatch_scan_pending.php");
                                   }
                                    break;


                                case "dispatch_scan_pending_detailed":
                                    if ($row->r14 == 1) {
                                        include("dispatch_scan_pending_detailed.php");
                                    }
                                    break;

                                case "dispatch_scan_pending_summary":
                                    if ($row->r14 == 1) {
                                        include("dispatch_scan_pending_summary.php");
                                    }
                                    break;


                                    //Dispatch Confirmation Scan Report
                                case "dispatch_conf_scan":
                                    if ($row->r11 == 1) {
                                       
                                        include("dispatch_conf_scan.php");
                                   }
                                    break;


                                case "dispatch_conf_scan_detailed":
                                    if ($row->r11 == 1) {
                                        include("dispatch_conf_scan_detailed.php");
                                    }
                                    break;

                                case "dispatch_conf_scan_summary":
                                    if ($row->r11 == 1) {
                                        include("dispatch_conf_scan_summary.php");
                                    }
                                    break;



                                    //Dispatch Confirmation Scan Pending Report
                                case "dispatch_conf_scan_pend":
                                    if ($row->r13 == 1) {
                                       
                                        include("dispatch_conf_scan_pend.php");
                                   }
                                    break;


                                case "dispatch_conf_scan_pend_detailed":
                                    if ($row->r13 == 1) {
                                        include("dispatch_conf_scan_pend_detailed.php");
                                    }
                                    break;

                                case "dispatch_conf_scan_pend_summary":
                                    if ($row->r13 == 1) {
                                        include("dispatch_conf_scan_pend_summary.php");
                                    }
                                    break;

                                //Production Scan Report

                                case "production_scan_rpt":
                                    if ($row->r18 == 1) {
                                        if ($mod == 'Summary')
                                            include("production_scan_summary.php");
                                        else
                                            include("production_scan_select.php");
                                    }
                                    break;


                                case "production_scan_detailed":
                                    if ($row->r18 == 1) {
                                        include("production_scan_detailed.php");
                                    }
                                    break;

                                    //QC Confirmation report

                                case "qc_confirmation":
                                    if ($row->r19 == 1) {
                                       
                                        include("qc_confirmation_sel.php");
                                   }
                                    break;


                                case "qc_confirmation_summary":
                                    if ($row->r19 == 1) {
                                        include("qc_confirmation_summary.php");
                                    }
                                    break;

                                case "qc_confirmation_detailed":
                                    if ($row->r19 == 1) {
                                        include("qc_confirmation_detailed.php");
                                    }
                                    break;


                                     //Barcode History report

                                case "barcode_history":
                                    if ($row->r20 == 1) {
                                       
                                        include("barcode_history_sel.php");
                                   }
                                    break;


                                case "barcode_history_detailed":
                                    if ($row->r20 == 1) {
                                        include("barcode_history_detailed.php");
                                    }
                                    break;

                                






                                //Production Rejection Report


                               /* case "production_report_detailed":
                                    if ($row->r12 == 1) {
                                        include("production_report_detailed.php");
                                    }
                                    break;

                                case "production_rejection_report":
                                    if ($row->r31 == 1) {
                                        include("production_rejection_report.php");
                                    }
                                    break;

                                 case "production_rejection_report_detailed":
                                    if ($row->r31 == 1) {
                                        include("production_rejection_report_detailed.php");
                                    }
                                    break;*/

              
/*
                             
                                /* Production Pending Report */
                                case "production_pending_report":
                                    if ($row->r22 == 1) {
                                        include("production_pending_report_sel.php");
                                    }
                                    break;

                                case "production_pending_report_summary":
                                    if ($row->r22 == 1) {
                                        include("production_pending_report_summary.php");
                                    }
                                    break;

                                case "production_pending_report_detailed":
                                    if ($row->r22 == 1) {
                                        include("production_pending_report_detailed.php");
                                    }
                                    break;


                                //dispatch pending report

                                case "dispatch_pending_sel":
                                    if ($row->r23 == 1) {
                                        if ($mod == 'SUMMARY')
                                            include("dispatch_pending_summary.php");
                                        else
                                            include("dispatch_pending_sel.php");
                                    }
                                    break;


                                case "dispatch_pending_detailed":
                                    if ($row->r23 == 1) {
                                        include("dispatch_pending_detailed.php");
                                    }
                                    break;

                               

                                    
                                 /*OSP Inward Report --Anjali*/

                                    case "osp_inward_report_sel":
                                    if ($row->r24 == 1) {
                                        include("osp_inward_report_sel.php");
                                    }
                                    break;

                                  case "osp_inward_report_summary":
                                    if ($row->r24 == 1) {
                                        include("osp_inward_report_summary.php");
                                    }
                                    break;

                                    case "osp_inward_report_detailed":
                                    if ($row->r24 == 1) {
                                        include("osp_inward_report_detailed.php");
                                    }
                                    break;
   
                                    
                                    /* OSP Inward Scan report--Anju */
                                case "osp_inward_scan_report":
                                    if ($row->r25 == 1) {
                                        include("osp_inward_scan_report_select.php");
                                    }
                                    break;

                                case "osp_inward_scan_report_summary":
                                    if ($row->r25 == 1) {
                                        include("osp_inward_scan_report_summary.php");
                                    }
                                    break;

                                case "osp_inward_scan_report_detailed":
                                    if ($row->r25 == 1) {
                                        include("osp_inward_scan_report_detailed.php");
                                    }
                                    break;







                                    
                                    //despatch entry report

                                    case "dispatch_entry_report":
                                        if ($row->r27 == 1) {
                                            include("dispatch_entry_report_select.php");
                                        }
                                        break;
    
                                    case "dispatch_entry_report_summary":
                                        if ($row->r27 == 1) {
                                            include("dispatch_entry_report_summary.php");
                                        }
                                        break;
    
                                    case "dispatch_entry_report_detailed":
                                        if ($row->r27 == 1) {
                                            include("dispatch_entry_report_detailed.php");
                                        }
                                        break;
    
                                  
                                    





																	         //rejection scan report
                                case "rejection_scan_report":
                                    if ($row->r32 == 1) {
                                        include("rejection_scan_report_sel.php");
                                    }
                                    break;

                                case "rejection_scan_report_summary":
                                    if ($row->r32 == 1) {
                                        include("rejection_scan_report_summary.php");
                                    }
                                    break;

                                case "rejection_scan_report_detailed":
                                    if ($row->r32 == 1) {
                                        include("rejection_scan_report_detailed.php");
                                    }
                                    break;
                                    case "rejection_scan_report_itemwise":
                                    if ($row->r32 == 1) {
                                        include("rejection_scan_itemwisereport.php");
                                    }
                                    break;
                                    

					

							//inline rejection report
							 case "rejection_inline_report":
                                    if ($row->r33 == 1) {
                                        include("rejection_inline_report.php");
                                    }
                                    break;

                                case "rejection_inline_report_summary":
                                    if ($row->r33 == 1) {
                                        include("rejection_inline_report_summary.php");
                                    }
                                    break;

                                case "rejection_inline_report_detailed":
                                    if ($row->r33 == 1) {
                                        include("rejection_inline_report_detailed.php");
                                    }
                                    break;
									
									//inline rejection scan report
							 case "rejection_inline_scan_report":
                                    if ($row->r34 == 1) {
                                        include("rejection_inline_scan_report.php");
                                    }
                                    break;

                                case "rejection_inline_scan_report_summary":
                                    if ($row->r34 == 1) {
                                        include("rejection_inline_scan_report_summary.php");
                                    }
                                    break;

                                case "rejection_inline_scan_report_detailed":
                                    if ($row->r34 == 1) {
                                        include("rejection_inline_scan_report_detailed.php");
                                    }
                                    break;
									
									

								case "material_issue_report":
                                    if ($row->r35 == 1) {
                                        include("material_issue_report_sel.php");
                                    }
                                    break;

                                case "material_issue_report_summary":
                                    if ($row->r35 == 1) {
                                        include("material_issue_report_summary.php");
                                    }
                                    break;

                                case "material_issue_report_detailed":
                                    if ($row->r35== 1) {
                                        include("material_issue_report_detailed.php");
                                    }
                                    break;

                                    case "routecard_picklist":
                                    if ($row->r35== 1) {
                                        include("routecard_picklist.php");
                                    }
                                    break;

                                    
										      
                                case "material_issue_scan_report":
                                    if ($row->r36 == 1) {
                                        include("material_issue_scan_report_sel.php");
                                    }
                                    break;

                                case "material_issue_scan_report_summary":
                                    if ($row->r36 == 1) {
                                        include("material_issue_scan_report_summary.php");
                                    }
                                    break;

                                case "material_issue_scan_report_detailed":
                                    if ($row->r36 == 1) {
                                        include("material_issue_scan_report_detailed.php");
                                    }
                                    break;



							 case "material_issue_pendg_report":
                                    if ($row->r37 == 1) {
                                        include("material_issue_pendg_report_sel.php");
                                    }
                                    break;

                                case "material_issue_pendg_report_summary":
                                    if ($row->r37 == 1) {
                                        include("material_issue_pendg_report_summary.php");
                                    }
                                    break;

                                case "material_issue_pendg_report_detailed":
                                    if ($row->r37 == 1) {
                                        include("material_issue_pendg_report_detailed.php");
                                    }
                                    break;














                                        
                                    
                                //UTILITY
                                //permission 

                                case "permission":
                                    if ($row->p1 == 1) {
                                        include("permission.php");
                                    }
                                    break;

                                case "changepassword":
                                    if ($row->p2 == 1) {
                                        include("changepassword.php");
                                    }
                                    break;

                                //CONFIGURATION

                                case "configuration":
                                    include("configuration.php");
                                    break;

                                case "config_edit":
                                    include("config_edit.php");
                                    break;

								//opening stock loading
								 case "opening_stock":
                                    if ($row->p3 == 1) {
                                        include("opening_stock_add.php");
                                    }
                                    break;

                                //barcode reprint
								
								case "reprint":
                                    if ($row->p3 == 1) {
                                        include("barcode_reprint.php");
                                    }
                                    break;
									

                                // default:
                                //     include("welcome.php");
                                //     break;
                            }
                            ?>
                        </div>



                        <footer class="main-footer">
                            <small>Copyright © 2020 <a href="https://www.stallionglobal.com/">Stallion Systems & Solutions</a>.
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