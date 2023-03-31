<?php

function sql_srv_connect(){
	global $SQLSrvserverName;
	global $SQLSrvDatabase;
	global $SQLSrvUID;
	global $SQLSrvPWD;
	
	$connection = sqlsrv_connect($SQLSrvserverName,array("Database"=>$SQLSrvDatabase, "UID"=>$SQLSrvUID, "PWD"=>$SQLSrvPWD, "ReturnDatesAsStrings" => true));
	
	return $connection;
}
?>