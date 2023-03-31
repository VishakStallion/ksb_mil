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

        // print_r($_POST); exit;

        $barcode = $_POST['barcode'];
        $user = $_SESSION['SESS_STU_ADMINID'];
        $current_date=date('d-M-Y H:i:s');

        $year = date('Y');

        $file=$_FILES['img']['tmp_name'];
        //
        $ext=pathinfo($_FILES['img']['name'],PATHINFO_EXTENSION);


        $filename = trim($barcode.'-1'.'.'.$ext);
        // $originalFilename = $_FILES['img']['name'];
        // $renamed = rename($originalFilename, $filename);


        $sql = "Select  Mrh_So_No   From    Mrpcvjobhdr_Qa, Mrpcvjobdtl_Qa  
        Where   Mrh_Job_Number  = Mrdqa_Job_Number  And     Mrdqa_Prod_Sl_No = '{$barcode}' ";
        $res = db_query($sql);

        $data_so_no = db_fetch_object($res);
        
        $Mrh_So_No = $data_so_no->MRH_SO_NO;
      //  $Mrh_So_No = 'AA001';

         // FTP server details
         $ftp_host = '10.9.22.30'; 
         $ftp_user = 'ftpqa';
         $ftp_pass = 'Stallion@2023';
  
        // File details

       
        $sql_ftp = "select mil.mrpcvjobhdr_qa.SO_SERIES,mil.qastampingsopath.SO_PATH from mil.mrpcvjobhdr_qa 
INNER JOIN mil.qastampingsopath on mil.qastampingsopath.SO_SERIES=mil.mrpcvjobhdr_qa.SO_SERIES where mil.mrpcvjobhdr_qa.MRD_PROD_SL_NO = '{$barcode}' ";

$res_ftp = db_query($sql_ftp);

$ftp_data = db_fetch_object($res_ftp);

    $ftp_folder = $ftp_data->SO_PATH;

       

        $first_character = substr($Mrh_So_No, 0, 1);
    
        // echo $first_character  ; exit;
        
        $destination_folder  = "/$ftp_folder/$Mrh_So_No/10. Photos/";
    

        // echo  $destination_folder ; exit;

        // Connect to FTP server
        $conn_id = ftp_connect($ftp_host) or die("Could not connect to $ftp_host");

        // Login to FTP server
        $login = ftp_login($conn_id, $ftp_user, $ftp_pass);


        if (!$conn_id || !$login) {
            die("FTP Connection Failed");
        }
      


           
        if($file)
        {
          
            $move="dist/img/";
            $destination_path = $destination_folder.$filename;
            // $move=$move.$filename;

            $path = $destination_folder; //the path where the file is located

            $oldfile = $filename; //the file you are looking for
    
            $check_file_exist = $path.$oldfile; //combine string for easy use
    
            $contents_on_server = ftp_nlist($conn_id, $path); //Returns an array of filenames from the specified directory on success or FALSE on error. 
          
            // echo $contents_on_server; exit;
    
          
            $suffix = 2;
                
    
                
    
                while (in_array($check_file_exist, $contents_on_server)) {
                       
                                $check_file_exist = $destination_folder.$barcode.'-'.$suffix++.'.'.$ext;
                  
                    }
                    $destination_path = $check_file_exist;
            

        // echo $destination_folder; exit;

        $sql2 = "SELECT * FROM $oracledatabase.".tbl_calibration_sub." WHERE MRDQA_PROD_SL_NO = '{$barcode}'  ";  	  
    
        $res2 = db_query($sql2);
        $data2 = db_fetch_object($res2);

        // print_r($data2);exit;


        if($data2->MRDQA_CERTIFIED_QA_DATE=='')
        {
            $sql_user = "SELECT USER_NAME FROM $oracledatabase.".tbl_usermaster."  WHERE USER_ID='{$user}' ";
            $res_user = db_query($sql_user);
    
            $data_user = db_fetch_object($res_user);
    
            try {
                $sql1 = "UPDATE $oracledatabase.".tbl_calibration_sub." SET MRDQA_CERTIFIED_QA_DATE = TO_DATE('{$current_date}', 'DD-Mon-YYYY HH24:MI:SS'),MRDQA_QA_CLEARED_BY='{$data_user->USER_NAME}'  WHERE MRDQA_PROD_SL_NO ='{$barcode}' "; 
                $a=oci_parse($conn,$sql1);		
                $r=oci_execute($a); 
				
				 $sql22="SELECT MAX(ID) as ID FROM $oracledatabase.".tbl_stamping_log."  ";

                        $res22=db_query($sql22);
            
                        $id=db_fetch_object($res22);
            
                        $id = $id->ID+1;


                        $sql12 = "INSERT INTO  $oracledatabase.".tbl_stamping_log." (ID,USER_ID,INSERT_DATE,VALVE_SL_NO) VALUES('{$id}','{$user}',TO_DATE('{$current_date}', 'DD-Mon-YYYY HH24:MI:SS'),'{$barcode}')  "; 
                        $res12=oci_parse($conn,$sql12);		
                        $r12=oci_execute($res12); 

                
                if ($r === false) {
                    throw new Exception("Error executing SQL statement: " . oci_error($a)['message']);
                }
                            
                $msg .= " Stamping Completed";
        
                
            } catch (Exception $e) {
                // Code to handle exception goes here
                $errmsg= "Caught exception: " . $e->getMessage();
                goto __REDIRECT;
            }

        }    


            // echo $destination_path; exit;
        
            // Change to destination folder
            if (ftp_chdir($conn_id, $destination_folder)) {
                // Move file to destination folder
                if (ftp_put($conn_id, $destination_path, $file, FTP_BINARY)) {

                    $msg.= " Image Added Successfully!";
                    goto __REDIRECT;
                } else {
                    $errmsg =  "Error moving file.";
                    goto __REDIRECT;
                }
            } else {
                $errmsg =  "Directory Not Found.";
                goto __REDIRECT;
            }
             

            
        }



        __REDIRECT:

          

        if($errmsg){

                  header("location:calibration?&errmsg=$errmsg&page=$page");

                  exit;

        }

        else{

                  header("location:calibration?&msg=$msg&page=$page");

                  exit;

        }

        