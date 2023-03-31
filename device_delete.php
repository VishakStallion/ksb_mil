<?php

    include_once("common/includes/constants.php");
    include_once("common/includes/constants.php");
    include_once("common/includes/oracle_function.php"); 
    include_once("common/includes/functions.php");
    include_once("common/includes/common.php"); 
    include_once("common/includes/admin_session.php");
    include_once("common/includes/english_admin.php");

      $device_id=$_REQUEST['device_id'];
      
 global $oracledatabase ;
     
      
      $sql1="UPDATE $oracledatabase.".tbl_device_master." SET DEVICE_DEL=1 WHERE DEVICE_ID='{$device_id}' ";
      $res1=db_query($sql1);
      
      if(!$res1){
          $errmsg="Error";
          goto __REDIRECT;
      }
      else
      {
          $msg="Device Deleted Successfully";
          goto __REDIRECT;
      }

      __REDIRECT:
          
          if($errmsg){
                    header("location:device?&errmsg=$errmsg&page=$page");
                    exit;
          }
          else{
                    header("location:device?&msg=$msg&page=$page");
                    exit;
          }