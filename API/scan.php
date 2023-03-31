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

    // print_r($json) ; exit;

    $content=array();
    $message=array();

    // $data = $json['data'];

    if($headers['Authorization']=='Basic YWRtaW46YWRtaW5AMTIz')
    {

    if($json != '' ){
            

         $barcode=$json['barcode'];
         $device=$json['device'];        
         $user_name =$json['username'];
           

            $flag =0;
            $sql = "SELECT $oracledatabase.".tbl_calibration.".* ,$oracledatabase.".tbl_calibration_sub.".* FROM $oracledatabase.".tbl_calibration."
            INNER JOIN  $oracledatabase.".tbl_calibration_sub." ON $oracledatabase.".tbl_calibration_sub.".MRDQA_JOB_NUMBER = $oracledatabase.".tbl_calibration.".Mrh_Job_Number WHERE $oracledatabase.".tbl_calibration.".MRDQA_PROD_SL_NO = '{$barcode}' ";  	  
            $res = db_query_row($sql); 
            
            if(!db_num_rows($res))
            {
               
                $message[]=array('Code'=>401,'Status'=>'Invalid Barcode');
                goto __REDIRECT;
          
            }
            $data = db_fetch_array($res);
            // print_r($data-);
            // echo  date($data->current_date->format('Y-m-d'));
            //  exit;

            if($data['MRDQA_CERTIFIED_QA_DATE'] =='')
            {
                $flag =1;
            }
           
            $message[]=array('calibration' => $flag,$data,'Code'=>200,'Status'=>'Success');
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



    