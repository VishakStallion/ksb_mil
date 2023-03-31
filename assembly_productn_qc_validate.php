<?php
include_once("common/includes/constants.php");  
include_once("common/includes/functions.php");
include_once("common/includes/common.php"); 
include_once("common/includes/admin_session.php");
include_once("common/includes/english_admin.php");
date_default_timezone_set("Asia/Kolkata");

if(empty($_SESSION['SESS_STU_ADMINID']))
{        
	 //show login page     
	 header("Location:login.php?act=$act");      
	 exit;        
}
//echo "<pre>";print_r($_REQUEST);exit;
$m					=	$_REQUEST['m'];
$sm					=	$_REQUEST['sm'];
$entryBy			=	$_SESSION['SESS_STU_ADMINID'];

$qcDt				=	date("Y-m-d",strtotime($_POST['date']));
$fg_item			=	$_REQUEST['fg_item'];
$qc_no				=	$_REQUEST['qc_no'];
$fg_item_serial		=	trim($_REQUEST['fg_item_serial']);
$qc_status			=	$_REQUEST['qc_status'];
$remarksall			=	$_REQUEST['remarksall'];
$qc_production_id	=	$_REQUEST['production_id'];
$entry_DaTe			=	date("Y-m-d H:i:s");
$qcstatus_array_size 	=	sizeof($qc_status);
$qc_started_at		=	$_REQUEST['timestamp'];



if(!$qc_no || !$qcDt || !$fg_item_serial)
{
	header("location:index.php?m=$m&sm=$sm&act=assemby_prductn_qc&msg=Please fill all mandatory fields&page=$page");
}

mysql_query('START TRANSACTION;');
mysql_query('SET autocommit=0;');
	
	
//check fg item qc parameters
if($fg_item>0){
	$check= mysql_query("select * from assembly_qc_parameters 
						inner join assembly_qc_parameters_sub on assembly_qc_parameters_sub.qc_para_id=assembly_qc_parameters.qc_id and assembly_qc_parameters_sub.sub_Status='0'
						where assembly_qc_parameters.FG_Item_Id='{$fg_item}' and Status='0'");
	$qc_para_count = mysql_num_rows($check);
	if($qc_para_count>0/* && mysql_num_rows($check)==$qc_status_size*/)
	{
		$check1=mysql_query("select * from assembly_productn_qc where qc_status='0' and qc_approval_status='1' and qc_fgitem_serial='$fg_item_serial' and qc_fgitem='$fg_item'");
		if(mysql_num_rows($check1)>0){
			$error_msg="FG serial number is already qc approved or Invalid FG item.Please check the details..";
			goto _REDIRECT;
		}
		else
		{

				$_sel3=mysql_query("select st_store.Store_Id from assembly_production inner join st_store on st_store.Branch_id=assembly_production.billing_branch
				where fg_serial_no='$fg_item_serial' and production_status='Active'");
				$_fet3=mysql_fetch_object($_sel3);
				$_production_store=$_fet3->Store_Id;
			//get latest QC number
				$yr=date("y");
				$nm='/';
				$month=date("m");
				$prefix='IMQ'.$yr.$month;
				$len=strlen($prefix);

				$sql1="SELECT CONCAT('$prefix',LPAD(max_qc_number+1,GREATEST(3,LENGTH(max_qc_number+1)),'0')) qc_number FROM
				(SELECT IFNULL( MAX(CAST( SUBSTRING(`qc_number`,$len+1) AS SIGNED)),'0') max_qc_number FROM  assembly_productn_qc WHERE qc_number LIKE '$prefix%') p2";
				$res1=mysql_query($sql1);
				$data1=mysql_fetch_object($res1);

				if(mysql_num_rows($res1))     
				{  
				$somax.=$data1->qc_number;   
				} 
			
				$ins_qc= mysql_query("INSERT INTO `assembly_productn_qc`(`qc_date`, `qc_number`, `qc_fgitem`, `qc_fgitem_serial`, `qc_remark`, `qc_done_at`, `qc_done_by`, `qc_status`,`qc_production_id`,`qc_started_at`) VALUES ('{$qcDt}','{$somax}','{$fg_item}','{$fg_item_serial}','{$remarksall}','{$entry_DaTe}','{$entryBy}','0','{$qc_production_id}','{$qc_started_at}')");
				$qc_insert = mysql_insert_id();
				$passcount=0;
				if($qcstatus_array_size>0 && $qc_para_count==$qcstatus_array_size)
				{
					while($fe12=mysql_fetch_object($check))
					{
						$Qc_Para_sub_Id 		=	$fe12->Qc_Para_sub_Id;
						if($qc_status[$Qc_Para_sub_Id]=='1')
						{
							$ststu='1';
							$passcount++;
						}
						else if($qc_status[$Qc_Para_sub_Id]=='0')
						{
							$ststu='0';
						
						}
						
						if($qc_insert)
						{
						
							$ins_qc_sub = mysql_query("INSERT INTO `assembly_productn_qcparameter`(`prdctnQc_id`, `prdctn_paramsubID`, `prdctnQc_status`) VALUES ('{$qc_insert}','{$Qc_Para_sub_Id}','{$ststu}')");
						}
						else
						{
							$error_msg="QC parameter details not inserted properly..";
							goto _REDIRECT;
						}
						
					}
				}
				else
				{	
					$error_msg="Please check QC parameter details";//"Count of QC parameters and approved parameters are mismatchings..";
					goto _REDIRECT;
				
				}
			
			
				if($passcount==$qc_para_count){
					$qc_approval_status='1';
					//st_item movement table insertion
					$_sel31=mysql_query("select assembly_production_serial.cItem,assembly_production_serial.qty,`assembly_production_serial`.`serial_no` from assembly_production 
					inner join assembly_production_serial on assembly_production_serial.production_id=assembly_production.id
					where assembly_production.fg_serial_no='$fg_item_serial' and assembly_production.production_status='Active'");
					while($_fet31=mysql_fetch_object($_sel31)){
						$_ins2=mysql_query("INSERT INTO `st_item_movement`(`No`, `Item_Id`, `Store_ID`, `Serial_Num`, `Item_QTY`, `Mov_Party`, `Mov_Date`, `Doc_No`, `Inv_No`, `Item_Move`) VALUES ('{$qc_insert}','{$_fet31->cItem}','{$_production_store}','{$_fet31->serial_no}','{$_fet31->qty}','0','{$entry_DaTe}','{$somax}','0','PRODUCTION OUT')");
						if($_ins2){
							$_sel4="SELECT * FROM `st_stock` where Item_id ='{$_fet31->cItem}' and Store_id='{$_production_store}'";
							$_ret4=mysql_query($_sel4);
							if(mysql_num_rows($_ret4)>0){
								$_upd3="UPDATE `st_stock` SET `Stock_Qty`=`Stock_Qty`-$_fet31->qty WHERE Item_id ='{$_fet31->cItem}' and Store_id='{$_production_store}'";
								$_ret41=mysql_query($_upd3);
							}
						}
					}
					//fg item production in 
					$_ins3=mysql_query("INSERT INTO `st_item_movement`(`No`, `Item_Id`, `Store_ID`, `Serial_Num`, `Item_QTY`, `Mov_Party`, `Mov_Date`, `Doc_No`, `Inv_No`, `Item_Move`) VALUES ('{$qc_insert}','{$fg_item}','{$_production_store}','{$fg_item_serial}','1','0','{$entry_DaTe}','{$somax}','0','PRODUCTION IN')");
					
				}
				else
				{
					$qc_approval_status='0';
				}
			
				if($ins_qc_sub){

					$update = mysql_query("update assembly_productn_qc set qc_approval_status='{$qc_approval_status}' where id='{$qc_insert}' and qc_status='0'");
				
					$update1 = mysql_query("update assembly_production set prdctn_qc_status='{$qc_approval_status}' where fg_serial_no='{$fg_item_serial}' and production_status='Active'");
				
					

					$success_msg="QC Completed with  QC Number $somax";
					goto _REDIRECT;
				}
				else{
					$error_msg="Approval Status not updated properly.Please check the details..";
					goto _REDIRECT;
				}
		}
	}
	else{
		$error_msg="QC Parameter is not existing for this item or Invalid FG item.Please check the details..";
		goto _REDIRECT;
	}
}


	_REDIRECT:
	if ($error_msg) {
        mysql_query("ROLLBACK;");
		header("location:index.php?m=$m&sm=$sm&act=assemby_prductn_qc&error_msg=$error_msg");
    }
    else {
    //	$success_msg=" $somax production QC is completed successfully ";
    	mysql_query("COMMIT;");
    	header("location:index.php?m=$m&sm=$sm&act=assemby_prductn_qc&success_msg=$success_msg");
    }
	exit;



?>