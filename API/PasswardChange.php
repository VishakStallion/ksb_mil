<?php
	error_reporting(0);
    set_time_limit(0);
    ini_set('memory_limit','5G');
    date_default_timezone_set("Asia/Kolkata");

    include_once("../common/includes/functions.php");
    include_once("../common/includes/oracle_function.php"); 
	include_once("../common/includes/common.php"); 
	include_once("../ommon/includes/english_admin.php");
    global $oracledatabase ;



    header('Content-Type: application/json');  

    // $headers = getallheaders();
    
  

    $headers['Authorization']=$_SERVER['HTTP_AUTHORIZATION'];

    $today=date('Y-m-d');
    $now=date('Y-m-d H:i:s');


    $json_content = file_get_contents('php://input'); 
    $json=json_decode($json_content,true);

    $content=array();
    $message=array();


    if($headers['Authorization']=='Basic YWRtaW46YWRtaW5AMTIz')
    {

    if($json != '' ){
    
      
            $user_name =$json['username'];
            $password=$json['password'];
            $newpassword=$json['newpassword'];

            if(!$user_name || !$password || !$newpassword )
            {
                $message[]=array('Code'=>401,'Status'=>'Body Missing against');
                goto __REDIRECT;              
               
            }
           

            
            $sql_user = "SELECT USER_ID FROM $oracledatabase.".tbl_usermaster." WHERE LOGIN_NAME = '{$user_name}' AND USERM_PASSWD = SYSTEM.wordencode('{$password}') ";	  
            $res_user = db_query_row($sql_user);
            if(!db_num_rows($res_user))
            {
                $message[]=array('Code'=>401,'Status'=>'Invalid User');
                goto __REDIRECT;     
            }
            $data = db_fetch_object($res_user);
                       
             $sql2="UPDATE $oracledatabase.".tbl_usermaster." SET USERM_PASSWD= SYSTEM.wordencode('{$newpassword}') WHERE USER_ID='{$data->USER_ID}'  "; 
            $res2=db_query($sql2);
                if(!$res2)
                {                       
                   $message[]=array('Code'=>401,'Status'=>'Updation Failed');
                   goto __REDIRECT; 
                 }
                  
               
             $message[]=array('USER_ID' => $data->USER_ID,'Code'=>200,'Status'=>'Success');
             goto __REDIRECT; 
                     
    
    
    }
}
else {
    // Return a 404 error if the Auth Failes
    $message[]=array('Code'=>404,'Status'=>'Authorization Error');
    goto __REDIRECT; 

}


__REDIRECT:

    $respose=array('Message'=>$message);
    echo json_encode($respose);
    exit;


?>



    