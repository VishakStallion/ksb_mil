<?php
/***************************************************************************/
/*     PROGRAMMER     :  SREE                                               */
/*     SCRIPT NAME    :  common.php                                        */
/*     CREATED ON     :  05/JUN/2008                                       */
/*                                                                         */
/*     Common procedures to be included in every file                      */
/***************************************************************************/

        //----------establish database connection-----------
       /* $dbobj = new database();
        $dbobj->connection($dbhost,$dbuser,$dbpassword,$dbname);*/

        
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


        error_reporting(0);

        $alpha_arr                = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");

        //global $recordcountperpage;
        global $recordcountperpage;
        $recordcountperpage        =        10;


        

         


	
        

?>