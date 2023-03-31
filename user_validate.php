<?php

      include_once("common/includes/constants.php");
      include_once("common/includes/constants.php");
      include_once("common/includes/oracle_function.php"); 
      include_once("common/includes/functions.php");
      include_once("common/includes/common.php"); 
      include_once("common/includes/admin_session.php");
      include_once("common/includes/english_admin.php");
      
      $page=$_REQUEST['page'];
      $mod=$_REQUEST['mod'];
     
 global $oracledatabase ;

      
      $edit=$_REQUEST['userid'];
      $main_username=$_REQUEST['main_username'];
      $username=$_REQUEST['username'];
      $designation=$_REQUEST['designation'];
      $password = addslashes($_REQUEST['password']);
      $cpassword=addslashes($_REQUEST['cpassword']);
      $locationid=$_REQUEST['locationid'];
      $permissiontype=$_REQUEST['permissiontype'];
      
      
      if (!$username || !$main_username  ){
         
          $errmsg="Please Fill All The Mandatory Fields";
          goto __REDIRECT;
      }
      if(!$edit && $password=='')
	{
        header("location: index.php?act=".$act."&error_msg=Fill all mandatory fields and try again");
		exit();
	}
	if($edit && isset($_POST['check'])==true && $password=='')
	{
        header("location: index.php?act=".$act."&error_msg=Fill all mandatory fields and try again");
		exit();
	}
	if($password == $cpassword)
    {
        $user_password=$password;
	}
	else
    {
		header("location: index.php?act=".$act."&mod=add&error_msg=Password Mismatch");
		exit();
	}
	
     
      
      if($edit){
       
          $sql="SELECT * FROM $oracledatabase.".tbl_usermaster." WHERE USER_ID!='{$edit}'  AND LOGIN_NAME='{$main_username}' ";
          $res=db_query_row($sql);
      
          if(db_num_rows($res)){
              $errmsg="User already exist";
              goto __REDIRECT;
          }
          
          
          
          $sql2="UPDATE $oracledatabase.".tbl_usermaster."
                     SET USER_NAME = '{$main_username}',
                     LOGIN_NAME='{$username}'
                    ";

        if(isset($_REQUEST['check'])==true)
        $sql2.= ",USERM_PASSWD=SYSTEM.wordencode('$password') ";    
        $sql2.=   " WHERE USER_ID='{$edit}'";
            
            $sql2.= " ";
            //    echo $sql2;
            //    exit; 
          $res2=db_query($sql2);
          
          if(!$res2){
              $errmsg="Unable To Modify";
              goto __REDIRECT;
          }
              $msg="User Modified Successfully";
              goto __REDIRECT;
      }
      else{
          
          if($mod=='edit'){
              $errmsg="Error";
              goto __REDIRECT;
          }
          
          $sql="SELECT * FROM $oracledatabase.".tbl_usermaster." WHERE USER_NAME='{$main_username}' ";
          $res=db_query_row($sql);
          if(db_num_rows($res)){
              $errmsg="User Already Exist";
              goto __REDIRECT;
          }
          
          $sql22="SELECT MAX(USER_ID) as user_id FROM $oracledatabase.".tbl_usermaster."  ";

          $res22=db_query($sql22);

          $id=db_fetch_object($res22);

          $user_id = $id->USER_ID+1;
         
          
          $sql2="INSERT INTO $oracledatabase.".tbl_usermaster."(USER_ID,USER_NAME,LOGIN_NAME,USERM_PASSWD,STATUS) 
                  VALUES ('{$user_id}','{$main_username}','{$username}',SYSTEM.wordencode('{$user_password}'),'A')  ";   

                //   echo $sql2 ; exit;
           $res2=db_query($sql2); 

        

          if(!$res2){
              $errmsg="Unable To Create User";
              goto __REDIRECT;
          }
       
             $sql3="INSERT INTO $oracledatabase.".tbl_permission." (USER_ID,M1,M2,P1) VALUES('$user_id',0,0,0) ";            
             db_query($sql3);

              $msg="User Added Successfully";
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