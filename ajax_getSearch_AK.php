<?php

      include_once("common/includes/constants.php");; 
      include_once("common/includes/oracle_function.php");
      include_once("common/includes/functions.php");
      include_once("common/includes/common.php"); 
      include_once("common/includes/admin_session.php");
      include_once("common/includes/english_admin.php");
      include_once("common/includes/SQL_SERVER_USER_AUTH.php");

      global $oracledatabase;


error_reporting(0);   
        header('Content-Type:application/json');
        
        $ask = addslashes($_GET['ask']);


if($ask == 'get_deatils')
{
    $barcode=$_REQUEST['barcode'];
 //,Mascon.Get_Reworkremarks AS REMARKS 

    

    $sql_qa_check = "SELECT * FROM $oracledatabase.".tbl_calibration." WHERE $oracledatabase.".tbl_calibration.".MRD_PROD_SL_NO = '{$barcode}' ";
    $ret_qa = db_query($sql_qa_check);
    $ret_qa1 = db_query($sql_qa_check);

    $data_qa = db_fetch_array($ret_qa);


    if($data_qa)
    {
        __REDIRECT:

        $sql = "SELECT $oracledatabase.".tbl_calibration.".* ,$oracledatabase.".tbl_calibration_sub.".* FROM $oracledatabase.".tbl_calibration."
        INNER JOIN  $oracledatabase.".tbl_calibration_sub." ON $oracledatabase.".tbl_calibration_sub.".MRDQA_PROD_SL_NO = $oracledatabase.".tbl_calibration.".MRD_PROD_SL_NO WHERE $oracledatabase.".tbl_calibration_sub.".MRDQA_PROD_SL_NO = '{$barcode}' ";  	  
    
        
        $res = db_query($sql);
        $res1 = db_query($sql);
        
        $data2 = db_fetch_array($res1);
       
      
        
    
                    $result = "";
                    $i=1;
                    $check++;
                
                    if($data2)
                    {
                       
                        $remarks = "SELECT Mascon.Get_Reworkremarks('$barcode') as remarks FROM dual";
                        $res_remark = db_query($remarks);

                        $remarks_data = db_fetch_object($res_remark);
    
    
                        $result .="<thead>  
                        
                                    <tr>
                                    <td>SL NO </td>
                                    <td>Job No </td>
                                    <td>Model No </td>
                                    <td>Valve Size </td>
                                    <td>Body Rating</td>
                                    <td>End Connection</td>
                                    <td>Act Type</td>
                                    <td>Act Size</td>
                                    <td>Tag No</td>
                                    <td>Remarks</td>
    
                                    </tr>
                        
                                </thead> <tbody> " ;
    
    
                        while($data = db_fetch_object($res))
                        {
    
                            // print_r($remarks_data->REMARKS); exit;
                          
                            if($data->MRDQA_CERTIFIED_QA_DATE !='')
                            {
                                $flag =1;
                                $qa_date = $data->MRDQA_CERTIFIED_QA_DATE;
                            }
                          
                           
                             $result .= "<tr> <td> $i</td>
                                                 
                                        <td> $data->MRH_JOB_NUMBER </td>   
                                        <td> $data->MRH_MODEL_NO </td>   
                                        <td> $data->MRH_VALVE_SIZE </td>   
                                        <td> $data->MRH_BODY_RATING </td>   
                                        <td> $data->MRH_END_CONN </td>   
                                        <td> $data->MRH_ACT_TYPE </td>   
                                        <td> $data->MRH_ACT_SIZE </td>   
                                        <td> $data->MRD_TAG_NO </td>   
                                        <td> $remarks_data->REMARKS </td>   
    
                                       </tr>";
                           
                        $i++;
    
                        }
                        // exit;
    
                        if($flag == 1)
                        {
                            $result .="<tr><td colspan='9' align='center'><font color='red'> Already Stamped on ".$qa_date." </font></td></tr> ";
                        }
    
                        $result .= "</tbody>";
                        
                    }
                    else
                    {
                        $qa_data = db_fetch_object($ret_qa1);
                        $qa_insert ="INSERT INTO MRPCVJOBDTL_QA (MRDQA_JOB_NUMBER,MRDQA_JOB_SL_NO,MRDQA_PROD_SL_NO) VALUES ('{$qa_data->MRH_JOB_NUMBER}','{$qa_data->MRD_JOB_SL_NO}','{$qa_data->MRD_PROD_SL_NO}')"; 

                        $qa_res = db_query($qa_insert);

                        if($qa_res)
                        {
                            goto __REDIRECT;
                        }
                     
                    }        
                 }

                else
                {
                    $result = 0;
                }

                echo $result; 
                exit;
}