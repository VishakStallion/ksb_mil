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
$menuid				=	$_REQUEST['m'];
$sm					=	$_REQUEST['sm'];
$entryBy			=	$_SESSION['SESS_STU_ADMINID'];

$pkDt				=	date("Y-m-d",strtotime($_POST['date']));

$fg_packg_no1		=	$_REQUEST['fg_packg_no'];
$fg_item_serial		=	trim($_REQUEST['fg_serial_no']);
$qc_status			=	$_REQUEST['qc_status'];
$remarksall			=	$_REQUEST['remarksall'];
$entry_DaTe			=	date("Y-m-d H:i:s");
$store_id           =   $_REQUEST['store_id'];
$ItemSubCat_Id      =   $_REQUEST['ItemSubCat_Id'];
$picklist           =   $_REQUEST['checkbox'];
$picklist_size      =  sizeof($_REQUEST['checkbox']);
$count              =   $_REQUEST['count'];
$qcstatus_array_size 	=	sizeof($qc_status);
$picklist_subid     =   $_REQUEST['picklist_subid'];
$picklist_id        =   $_REQUEST['picklist_id'];
$start_at          =   $_REQUEST['timestamp'];
$lot_no          =   $_REQUEST['lot_no'];

if(!$fg_packg_no1 || !$pkDt || !$fg_item_serial || !$lot_no)
{
	header("location:index.php?m=$m&sm=$sm&act=assembly_fgpacking&msg=Please fill all mandatory fields&page=$page");
    exit();
}

$sno1               =   $_REQUEST['sno1'];
$iid1               =   $_REQUEST['iid1'];
$SidQty1            =   $_REQUEST['SidQty1'];
//echo "<pre>";print_r($_POST);exit;

$exp_serial = explode('$',$sno1); // array
$sSize=sizeof($exp_serial);
$exp_serialqty = explode('$',$SidQty1); // array
$exp_item=explode('$',$iid1);
$iSize=sizeof($iid1);
 
if($mod=="edt")
{
}
else
{
    $_sel=mysql_query("select * from assembly_production where fg_serial_no='{$fg_item_serial}' and prdctn_qc_status='1' and production_status='Active' and fg_packng_status='1'");
    if(mysql_num_rows($_sel)>0){
        header("location:index.php?m=$m&sm=$sm&act=assembly_fgpacking&msg=Please check fg item serial number&page=$page");
        exit();
    }
    else
    {

        $yr=date("y");
        $nm='/';
        $m=date("m");
        $prefix='IMFP'.$yr.$m;
        $len=strlen($prefix);
        
        $sql1="SELECT CONCAT('$prefix',LPAD(max_fg_packg_no+1,GREATEST(3,LENGTH(max_fg_packg_no+1)),'0')) fg_packg_no FROM
            (SELECT IFNULL( MAX(CAST( SUBSTRING(`fg_packg_no`,$len+1) AS SIGNED)),'0') max_fg_packg_no FROM  assembly_fgpacking WHERE fg_packg_no LIKE '$prefix%') p2";
        $res1=mysql_query($sql1);

        $_sel=mysql_query("select * from assembly_production where fg_serial_no='{$fg_item_serial}' and prdctn_qc_status='1' and production_status='Active' and fg_packng_status!='1'");
        $data1=mysql_fetch_object($res1);
        $somax=$data1->fg_packg_no;	
        if(mysql_num_rows($res1))     
        {  
            $fg_packg_no.=$somax;    
        }
        $_fet=mysql_fetch_object($_sel);
        $fg_itemid=$_fet->FG_item;
            //insert
        if(!empty($fg_packg_no))
        {
            $sel4="select * from assembly_fgpacking where fg_serial_no='{$fg_item_serial}' and fg_status='Active'";
            $_ret4=mysql_query($sel4);
            if(mysql_num_rows($_ret4)>0){
                $fet4=mysql_fetch_object($_ret4);
                   
                $sel41="select * from assembly_fgpacking_picklst where fg_packg_id='$fet4->id'";
                $_ret41=mysql_query($sel41);
                if(mysql_num_rows($_ret41)>0){
                    $del41="delete from assembly_fgpacking_picklst where fg_packg_id='$fet4->id'";
                    $_del41=mysql_query($del41);
                }

                $del="delete from assembly_fgpacking where fg_serial_no='{$fg_item_serial}' and fg_status='Active'";
                $_del4=mysql_query($del);
            }
          //insert new one
                $_ins="INSERT INTO `assembly_fgpacking`(`fg_packg_no`, `fg_itemid`, `fg_serial_no`, `fg_date`, `fg_remark`, `fg_packg_by`, `fg_packg_at`, `fg_status`,`fg_packg_start_at`,`fg_lot_number`)
                VALUES ('{$somax}','{$fg_itemid}','{$fg_item_serial}','{$pkDt}','{$remarksall}','{$entryBy}','{$entry_DaTe}','Active','{$start_at}','{$lot_no}')";
                $_ret=mysql_query($_ins) or die($_ins."Error in Query ".mysql_error()); 
                $insert_id = mysql_insert_id();
                $qty_sum=0;
    
                for($i=0;$i<$picklist_size;$i++){
                    $_ins2="INSERT INTO `assembly_fgpacking_picklst`(`fg_packg_id`,`picklist_id`, `picklist_subid`, `fg_ItemSubCat_Id`, `status`) VALUES ('$insert_id','$picklist_id','$picklist_subid[$i]','$ItemSubCat_Id','$picklist[$i]')";
                    $_ret2=mysql_query($_ins2) or die($_ins2."Error in Query ".mysql_error()); 
                }
                $sql_updt3=mysql_query("update assembly_production set fg_packng_status='1' where FG_item='{$fg_itemid}' and fg_serial_no='{$fg_item_serial}'");
            

         
           
		        /*$sel5=mysql_query("select sum(assembly_bom_sub.qty) bom_qty from assembly_bom inner join assembly_bom_sub on assembly_bom_sub.bom_id =assembly_bom.Bom_Id
                        where FG_Item_Id='{$fg_itemid}' and Bom_Status='0' and assembly_bom_sub.comp_type='PC'");
                $fet1=mysql_fetch_object($sel5);
               
                if(round($fet1->bom_qty,1)==$qty_sum)
                { 
                    $sql_updt3=mysql_query("update assembly_production set fg_packng_status='1' where FG_item='{$fg_itemid}'");
                    if(!$sql_updt3){
                         header("location:index.php?m=$menuid&sm=$sm&act=assembly_fgpacking&msg=Error in production status updation query");		
                        
                    }
                }*/
                header("location:index.php?m=$menuid&sm=$sm&act=assembly_fgpacking&msg=FG item is packed with packing number is $fg_packg_no");		
        }
                    
            
           	
    }
}
?>