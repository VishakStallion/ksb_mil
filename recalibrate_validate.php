<?php

      include_once("common/includes/constants.php");
      include_once("common/includes/constants.php"); 
      include_once("common/includes/oracle_function.php");
      include_once("common/includes/functions.php");
      include_once("common/includes/common.php"); 
      include_once("common/includes/admin_session.php");
      include_once("common/includes/english_admin.php");
      include_once("common/includes/SQL_SERVER_USER_AUTH.php");

      global $oracledatabase;

        // print_r($_GET); exit;

        $barcode = $_GET['barcode'];

        $user = $_SESSION['SESS_STU_ADMINID'];

        $current_date=date('d-M-Y H:i:s');

        $sql2 = "SELECT * FROM $oracledatabase.".tbl_calibration_sub." WHERE MRDQA_PROD_SL_NO = '{$barcode}'  ";  	  
    
        $res2 = db_query($sql2);
        $data2 = db_fetch_object($res2);

        // print_r($data2);exit;


        // if($data2->MRDQA_CERTIFIED_QA_DATE!='')
        // {
            try {
          
                $sql1 = "UPDATE $oracledatabase.".tbl_calibration_sub." SET MRDQA_LOOSE_ITEMS_CLEARED_DT = TO_DATE('{$current_date}', 'DD-Mon-YYYY HH24:MI:SS') WHERE MRDQA_PROD_SL_NO ='{$barcode}' "; 
                $a=oci_parse($conn,$sql1);		
                $r=oci_execute($a); 
                
                if ($r === false) {
                    throw new Exception("Error executing SQL statement: " . oci_error($a)['message']);
                }
                
                $msg = "Item Loose Stamping Completed";
                goto __REDIRECT;
                
            } catch (Exception $e) {
                // Code to handle exception goes here
                $errmsg= "Caught exception: " . $e->getMessage();
                goto __REDIRECT;
            }

        // }
          
            
       
        __REDIRECT:

          

        if($errmsg){

                  header("location:cam?&errmsg=$errmsg&page=$page");

                  exit;

        }

        else{

                  header("location:cam?&msg=$msg&page=$page");

                  exit;

        }

        