<?php
// include("common/includes/constants.php");



// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
$serverName = "localhost"; 
$connectionInfo = array( "Database"=>"KSB_MILL");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

//error_reporting(0);
set_time_limit(300);
ini_set('max_execution_time', 300); //300 seconds
date_default_timezone_set("Asia/Kolkata");



if( $conn ) {
    return $conn;
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>