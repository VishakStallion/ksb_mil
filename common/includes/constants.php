<?php 


// Replace these values with your actual database credentials
$oraclehostname = 'EDP';
$oracleusername = 'mil';
$oraclepassword = 'mil';
$oracledatabase = 'mil';


define("tbl_usermaster","LOGINUSERMASTER");

        define("tbl_device_master","device_master");
        define("tbl_permission","permission");
        define("tbl_calibration","mrpcvjobhdr_qa");
		define("tbl_calibration_sub","mrpcvjobdtl_qa");
		define("tbl_stamping_log","QASTAMPINGLOG");


		
		
        define("fld_admin_id","admin_id");
        define("fld_admin_username","admin_username");
        define("fld_admin_pwd","admin_pwd");
		define("fld_admin_del","User_Del");


//error_reporting(0);
set_time_limit(300);
ini_set('max_execution_time', 300); //300 seconds
date_default_timezone_set("Asia/Kolkata");
?>