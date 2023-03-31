<?php

      include_once("common/includes/constants.php"); 
      include_once("common/includes/oracle_function.php");
      include_once("common/includes/functions.php");
      include_once("common/includes/common.php"); 
      include_once("common/includes/admin_session.php");
      include_once("common/includes/english_admin.php");
      include_once("common/includes/SQL_SERVER_USER_AUTH.php");

 global $oracledatabase ;
      
$userid = addslashes($_POST['userid']);

if(!$userid) {
	header("location:permission&errmsg=Select a user");
	exit();
}


$columns = array('M1', 'M2', 'M3', 'P1');


array_walk($columns, function($item,$key){
	global $permission;
	$permission[$item] = isset($_POST[$item]); // no needed to take values. If checkbox checked, it will come in $_POST
});

foreach ($permission as $key=>$value) {
	$update_contents[] = "$key='".intval($value==1)."'";
	
}
// print_r($update_contents); exit;

$update_contents = implode(',', $update_contents); 


// $SQL_update = "MERGE INTO $oracledatabase.".tbl_permission." AS target
// USING (SELECT '$userid' AS user_id) AS source ON (target.user_id = source.user_id)
// WHEN MATCHED THEN 
//   UPDATE SET target. $update_contents   ";
  // echo $SQL_update; exit;

$SQL_update = "UPDATE  $oracledatabase.".tbl_permission." SET $update_contents WHERE USER_ID ='$userid'  ";

$res = db_query($SQL_update);

if(!$res){
	// $e = mysql_error();
	header("location:permission?errmsg=Update failed.&ucode={$userid}");
	exit;
}
header("location:permission?msg=Permission updated successfully&ucode={$userid}");