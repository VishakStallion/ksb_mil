<?php
date_default_timezone_set("Asia/Kolkata"); 

function differenceInHours($startdate,$enddate){
	$starttimestamp = strtotime($startdate);
	$endtimestamp = strtotime($enddate);
	$difference = abs($endtimestamp - $starttimestamp);
	$hours      = floor($difference / 60 / 60).'Hr ';
	$minutes    = round(($difference - ($hours * 60 * 60)) / 60).'Min';
	$time = $hours.$minutes;
	return $time;
}

include_once("common/includes/constants.php");
include_once("common/includes/functions.php");
include_once("common/includes/common.php"); 
include_once("common/includes/admin_session.php");
include_once("common/includes/english_admin.php");


$emp		=	$_SESSION['SESS_STU_ADMINID'];
$Roll		=	$_SESSION['Emp_Role'];
$Emp_Branch	=	$_SESSION['Emp_Branch'];
$m			=	$_REQUEST['m'];
$sm			=	$_REQUEST['sm'];

$date1		=	$_POST['date']; 
$newdate1	=	date("Y-m-d",strtotime($date1));
$date2		=	$_POST['date1'];  
$newdate2	=	date("Y-m-d",strtotime($date2));  
$fg_item	=	$_POST['fg_item'];
$fg_itemno		=	sizeof($fg_item);
if($fg_itemno>0)
{
	foreach($fg_item as $a => $value)
	{
	  $outfg_item.=$fg_item[$a].',';
	}
	 $resitem=trim($outfg_item,",");
}

$bbranch	=	$_POST['bbranch'];
$bbranch1		=	sizeof($bbranch);
if($bbranch1>0)
{
	foreach($bbranch as $a => $value)
	{
	  $outbbranch.=$bbranch[$a].',';
	}
	 $resbbranch=trim($outbbranch,",");
}


?>
<div id="content_inner">
<div class="page_header">
<h2>Production QC Report</h2> 
<div id="search"></div></div>
<div id="quick_access_overview"></div>
<div class="form_container" style="width:1123px"> 
<table width="100%" height="79"  border="0" align="center" cellpadding="4px" cellspacing="0"  class="w760" style="font:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
    <tr bgcolor="#D8E4EB"> 
    

        <td width="5%" align="left"><b>Sl. no</b></td>
        
        <td width="10%" align="left"><b>QC No.</td>
        <td width="5%"  align="left"><b>Date</b></td>
        <td width="10%"  align="left"><b>Production No.</b></td>
        <td width="10%"  align="left"><b>Production Date</b></td>
		<td width="10%"  align="left"><b>Stock Branch</b></td>
        <td width="5%"  align="left"><b>Serial No.</b></td>
        <td width="15%"  align="left"><b>FG Item Name</b></td>
        <td width="10%"  align="left"><b>Approval Status</b></td>  
		<td width="10%"  align="left"><b>Total Time Taken</b></td>  
        <td width="10%"  align="left"></td>
    </tr> 
        <?php 
		$total=0;
		$sql="SELECT assembly_productn_qc.* ,st_item.Item_Name,assembly_production.*,st_branch.Branch_Name,assembly_productn_qc.id qc_id
		FROM `assembly_productn_qc` 
		inner join st_item on st_item.`Item_Id`=assembly_productn_qc.qc_fgitem and st_item.ItemCat_Id='23' AND st_item.Item_Stage IN('FG','ASSEMBLED')
		inner join assembly_production on assembly_production.id=assembly_productn_qc.qc_production_id
		inner join st_branch on st_branch.Branch_Id=assembly_production.billing_branch
		WHERE 1=1 ";
        if($date1!='' and $date2!='')
		{
			$sql.=" and DATE(assembly_productn_qc.qc_date) between '$newdate1' and '$newdate2'";
		}
		if($bbranch1>0)
		{
			$sql.=" and assembly_production.billing_branch IN ($resbbranch)";
		}
		if($fg_itemno>0)
		{
			$sql.=" and assembly_productn_qc.qc_fgitem IN ($resitem)";
		}
		$sql.=" group by assembly_productn_qc.id ORDER BY qc_done_at";
		$ret=mysql_query($sql); 
		$num=1; 
		while ($row=mysql_fetch_object($ret)) 
		{
			if($row->qc_started_at!='0000-00-00 00:00:00')
			{
				$hours_difference = differenceInHours($row->qc_started_at,$row->qc_done_at);
			}
			else {
				$hours_difference='-NIL-';
			}

			if ($num%2==0)
				$trclass="table_row_odd";
			else
				$trclass="table_row_even"; 
			/*if($row->Cust_Name==''){
				$selcut=mysql_query("select * from sal_customer where Cust_id='$row->debit_customer'");
				$row1=mysql_fetch_object($selcut);
				$Cust_Name = $row1->Cust_Name;
			}
			else{
				$Cust_Name = $row->Cust_Name;
			}*/?>
	    	<tr> 
                <td height="5%" align="left"><?=$num?></td>
                
                <td width="10%"><?=$row->qc_number?></td>
                <td width="8%" ><?=date("d-m-Y",strtotime($row->qc_date))?></td>
                 <td width="10%"><?=$row->production_no?></td>
                <td width="8%" ><?=date("d-m-Y",strtotime($row->Date))?></td>
				<td width="8%" ><?=$row->Branch_Name?></td>
				
                 <td width="10%"  align="left"><?=$row->qc_fgitem_serial?></td>      
                <td width="20%"  align="left"><?php echo $row->Item_Name; ?></td>
                       
                <td width="5%" align="left"><?php if($row->qc_approval_status=='1'){echo "Approved";}else{echo "Rejected";}?></td>
				<td width="20%"  align="left"><?php echo $hours_difference; ?></td>
				<td><a href="index.php?m=<?=$Menu_Id?>&sm=<?=$sm?>&act=assembly_prdctn_qc_report_detailed&id=<?=$row->qc_id?>">More</a></td>   
               
       		</tr>
			<?php  
			$num++;
		}
		
		?> 
    </table>
	</div>  
	</div>
