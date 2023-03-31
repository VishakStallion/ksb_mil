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
    
    // print_r($_SERVER); exit;

    // $headers = getallheaders();

    $headers['Authorization']=$_SERVER['HTTP_AUTHORIZATION'];


    $today=date('Y-m-d');
    $now=date('Y-m-d H:i:s');


    $json_content = file_get_contents('php://input'); 
    $json=json_decode($json_content,true);

    // print_r($json) ; exit;

    $content=array();
    $message=array();

    // $data = $json['data'];

    if($headers['Authorization']=='Basic YWRtaW46YWRtaW5AMTIz')
    {

        if($json != '' ){
                
            
                $user_name =$json['username'];
                $password=$json['password'];
                $device=$json['device'];
            

                
                $sql_user = "SELECT user_id FROM $oracledatabase.".tbl_usermaster." WHERE LOING_NAME = '{$user_name}' AND USERM_PASSWD =SYSTEM.wordencode('{$password}') ";			  
                $res_user = db_query_row($sql_user); 
                
                if(!db_num_rows($res_user))
                {
                    $message[]=array('Code'=>401,'Status'=>'Invalid User');
                    goto __REDIRECT;
                }
                $data = db_fetch_object($res_user);

                $sql_dv = "SELECT device_id,status FROM $oracledatabase.".tbl_device_master." WHERE device_name= '$device' AND device_del = 0 ";
                $res_dv = db_query_row($sql_dv);
                    if(!db_num_rows($res_dv))
                    {
                        $message[]=array('Code'=>401,'Status'=>'Invalid Device');
                        goto __REDIRECT;
                    }
                    
                    $data2 = db_fetch_object($res_dv);
                
                    $message[]=array('USER_ID' => $data->USER_ID,'DEVICE_ID' =>$data2->DEVICE_ID,'Code'=>200,'Status'=>'Success');
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



    