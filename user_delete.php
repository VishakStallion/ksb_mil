<?php

    include_once("common/includes/constants.php");
    include_once("common/includes/constants.php");
    include_once("common/includes/oracle_function.php"); 
    include_once("common/includes/functions.php");
    include_once("common/includes/common.php"); 
    include_once("common/includes/admin_session.php");
    include_once("common/includes/english_admin.php");

      $userid=$_REQUEST['User_Code'];
      
     
      
      $sql1="UPDATE $oracledatabase.".tbl_usermaster." SET User_Del=1 WHERE user_id='{$userid}'";
      $res1=db_query($sql1);
      
      if(!$res1){
          $errmsg="Error";
          goto __REDIRECT;
      }
      else
      {
          $msg="User Deleted Successfully";
          goto __REDIRECT;
      }

      __REDIRECT:
          
          if($errmsg){
                    header("location:user?&errmsg=$errmsg&page=$page");
                    exit;
          }
          else{
                    header("location:user?&msg=$msg&page=$page");
                    exit;
          }