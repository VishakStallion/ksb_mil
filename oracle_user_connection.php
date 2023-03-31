<?php

// Create connection to Oracle
$conn = oci_connect("mil", "mil", "ksbmiltest");

if (!$conn) {
  
$m = oci_error();
  

$query = oci_parse($conn, "INSERT INTO permission (USER_ID,M1,M2,P1) VALUES(44,1,1,1)");
	$result = oci_execute($query);

    if ($result) {
        echo "Data added Successfully !";
        exit();
}
else{
echo "Error !";
        exit();
}

}
else {
  
print "Connected to Oracle DB!";

}

// Close the Oracle connection

oci_close($conn);
?>
