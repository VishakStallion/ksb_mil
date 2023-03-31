<?php


include_once("common/includes/constants.php");
include_once("common/includes/oracle_function.php"); 
include_once("common/includes/functions.php");
include_once("common/includes/common.php"); 
include_once("common/includes/admin_session.php");
include_once("common/includes/english_admin.php");

 global $oracledatabase ;
      

      $page=$_REQUEST['page'];

      $mod=$_REQUEST['mod'];

    //  print_r($_POST);exit;
      

      $edit=$_REQUEST['device_id'];

      $device=$_REQUEST['device'];

      $permission=$_REQUEST['permission'];

    
      

      if($device==''  or  $permission==''){

                    $errmsg="Please Fill all mandatory fields";

                    goto __REDIRECT;

      }

      

      

      if($edit){

          

          $sql="SELECT * FROM $oracledatabase.".tbl_device_master."  WHERE DEVICE_NAME='$device' AND DEVICE_ID!='$edit' AND DEVICE_DEL=0";

          $res=db_query_row($sql);
       
        //   echo sqlsrv_num_rows($res); exit;

          if(db_num_rows($res)){

              $errmsg="Device already exist";

              goto __REDIRECT;

          }

          

          $sql1="UPDATE $oracledatabase.".tbl_device_master." SET DEVICE_NAME='{$device}',STATUS ='{$permission}' WHERE DEVICE_ID='{$edit}' ";

          $res1=db_query($sql1);

        $current_date=date('d-M-Y');

        
    //      $sql1 = " UPDATE $oracledatabase.".tbl_calibration_sub." SET MRDQA_CERTIFIED_QA_DATE = to_date('{$current_date}','dd-mon-yyyy')  WHERE MRDQA_PROD_SL_NO ='20002654'  ";  
    //     // exit;
    //    $res1=db_query($sql1);


          if(!$res1){

              $errmsg="Unable to Modify";

              goto __REDIRECT;

          }

          else{

              $msg="Device Modified Successfully";

              goto __REDIRECT;

          }

          

      }

      else{

          

          $sql2="SELECT * FROM $oracledatabase.".tbl_device_master."  WHERE  DEVICE_NAME='$device' AND DEVICE_DEL=0 ";

          $res2=db_query_row($sql2);

          if(db_num_rows($res2)){

              $errmsg="Device already exist";

              goto __REDIRECT;

          }

          $sql22="SELECT MAX(DEVICE_ID) as device_id FROM $oracledatabase.".tbl_device_master."  ";

          $res22=db_query($sql22);

          $id=db_fetch_object($res22);

          $device_id = $id->DEVICE_ID+1;
          

          $sql3="INSERT INTO $oracledatabase.".tbl_device_master." (DEVICE_ID,DEVICE_NAME,STATUS,DEVICE_DEL) 

                  VALUES('{$device_id}','{$device}','{$permission}',0) ";

                  
        //   echo $sql3; exit;
          $res3=db_query($sql3);

          if(!$res3){

              $errmsg="Unable to Add";

              goto __REDIRECT;

          }

          else{

              $msg="Device Added successfully";

              goto __REDIRECT;

          }

          

          

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

