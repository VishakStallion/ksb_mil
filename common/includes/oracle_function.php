<?php

	require_once("SQL_SERVER_USER_AUTH.php");

	 $conn = oci_connect("mil", "mil", "ksbmiltest");

error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);

function db_query($result)
{
	global $conn;

	 $a=oci_parse($conn,$result);		
	 oci_execute($a);
	 return $a;
}


function db_query_insert($result)
{
	global $conn;
	// return sqlsrv_query($conn,$result,array(), array("Scrollable"=>"static"));
	$a=oci_parse($conn,$result);		
	$commit = oci_parse($conn, "COMMIT");	
	$r=oci_execute($commit);
	return $a;
	
}

function db_query_row($result)
{
	global $conn;
	// return sqlsrv_query($conn,$result,array(), array("Scrollable"=>"static"));
	$a=oci_parse($conn,$result);		
	$r=oci_execute($a);
	 return $r;
	
}

function db_fetch_object($result)
{

	// return sqlsrv_fetch_object($result);
	return oci_fetch_object($result);
}

function db_fetch_array($result)
{
	// return sqlsrv_fetch_array($result);
	return oci_fetch_array($result,OCI_BOTH);
}

function db_num_rows($result)
{
	// return sqlsrv_num_rows($result);
	return oci_num_rows($result);
}

// function db_insert_id($result)
// {
// 	// get the inserted ID value
// 	// return sqlsrv_query($conn, "SELECT SCOPE_IDENTITY()")->fetch()['computed'];
            
// }
function db_fetch_row($r)
	{
		$s=oci_fetch_row($r);
		
		//$s=mysql_fetch_row($r);
		return $s;
	}

?>