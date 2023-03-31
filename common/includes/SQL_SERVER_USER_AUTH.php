<?php

require_once("constants.php");

 global $oraclehostname;

 global $oracleusername ;

 global $oraclepassword ;

 global $oracledatabase ;



// Connect to the Oracle database
$conn = oci_connect($oracleusername, $oraclepassword, "$oraclehostname");

if( $conn ) {
     return $conn;
}else{
     echo "Connection could not be established.<br />";
     die( print_r( oci_error(), true));
}



?>