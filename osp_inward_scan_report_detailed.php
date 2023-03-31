<div id="content_inner">
	<div class="page_header">
		
	<div id="search"></div></div></div>
	<script type="text/javascript">
	
	</script>
	
	<?php 
		
		$perpage=10;
		$page=$_REQUEST['page'];
		
		$page=($page>=1)?$page:1;
		$start=($page-1)*$perpage;
		
		$condition="";
		if($page) $condition.="&page=$page";
		if($status) $condition.="&status=$status";
		$msg=$_GET['msg'];
		$errmsg=$_GET['errmsg'];
	?>
	<!-- Content Header (Page header) -->
    <div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>OSP Inward Scan Detailed </h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item "><a href="#">Report</a></li>
						<li class="breadcrumb-item active">OSP Inward Scan Report Detailed</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	
		
    <!-- Main content -->
    <section class="content">
		
		<?php if($msg!='' or $errmsg!=''){?>
			<div class="alert alert-<?php if($_GET['msg']) echo 'success'; if($_GET['errmsg']) echo 'danger'; ?>  alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="fa  fa-info" style="margin-right:0.5em;"></i>
				<?php if($_GET['msg']) echo $msg; else echo $errmsg;?>
			</div>
		<?php } ?>
		
		<?php

	$perpage=10;
	$page=$_GET['page'];
	
	$page=($page>=1)?$page:1;
	$start=($page-1)*$perpage;
	
	$condition="";
	
	$msg=$_GET['msg'];
    ?>	
	
		
	<?php
		
			

        $date1=$_REQUEST['from_date'];
        $newdate1=date("Y-m-d",strtotime($date1));
        if($date1!="") $condition.="&date1=$date1";
        $date2=$_REQUEST['to_date']; 
        $newdate2=date("Y-m-d",strtotime($date2)); 
        if($date2!="") $condition.="&date2=$date2";
        $InwardNo=$_REQUEST['InwardNo'];
        if($InwardNo!="") $condition.="&InwardNo=$InwardNo";
    
        $p_id=addslashes($_REQUEST['pid']);

			
      

			
         $sql= "SELECT
					osp_inward_storage_scan.*, osp_inward.Osp_Inward_Date,
					osp_inward.Osp_Inward_No,
					bin_master.Bin_Name,
					osp_barcode.Lot_Number,
					osp_barcode.Net_Weight,
					osp_barcode.Inward_Net_Wieght,
					osp_barcode.Gross_Weight,
					osp_barcode.Inward_Gross_Weight,
					osp_barcode.Barcode_Time,
					locationmaster.Loc_Name,
					branch_master.Branch_Name,
					osp_barcode.Manf_Date,
					item_master.Item_Name
				FROM
					osp_inward_storage_scan
				INNER JOIN osp_barcode ON osp_barcode.Serial_No = osp_inward_storage_scan.barcode
				INNER JOIN osp_inward ON osp_inward.Osp_Inward_Id = osp_barcode.Osp_Inward_Id AND osp_inward.Osp_Inward_Del = '0'
				INNER JOIN bin_master ON bin_master.Bin_Id = osp_inward_storage_scan.bin_code AND bin_master.Bin_Del = '0'
				INNER JOIN locationmaster ON locationmaster.Loc_Id = osp_barcode.Location_Id AND locationmaster.Loc_Del = '0'
				INNER JOIN branch_master ON branch_master.Branch_Id = osp_barcode.Branch_Id AND branch_master.Branch_Del = '0'
				INNER JOIN item_master ON item_master.Item_Id = osp_barcode.Item_Id AND item_master.Item_Del = '0'
				WHERE
					osp_barcode.`Status` = '1'
				AND osp_inward_storage_scan.storage_del = '0'";
        
        if($date1!='')
		{
		$sql.=" AND DATE(osp_inward_storage_scan.`scan_time`)>= '$newdate1'";
        }
        
		if($date2!='')
		{
		$sql.="  AND DATE(osp_inward_storage_scan.`scan_time`)<= '$newdate2'";
        }
        
        if($InwardNo!='')
         {     
          $sql.=" AND osp_inward.Osp_Inward_No='$InwardNo'";
         }
		 
		  if($p_id!='')
         {     
          $sql.=" AND osp_inward_storage_scan.scan_id='$p_id'";
         }
        $ret1=mysql_query($sql);
		$count=mysql_num_rows($ret1); 
		if($start>$count) { 
			$page=1;
			$start=0;
        }
        // echo $sql;
			
			$sql.=" ORDER BY  osp_inward.Osp_Inward_No LIMIT $start,$perpage ";
			//echo $sql; exit;
			$ret=mysql_query($sql);
			
			?>			
			<div class="col-md-12">
            <div class="card">
			<div class="card-header">
			<h3 class="card-title">Report Details</h3>	
			<h6 align='right'><a href="osp_inward_scan_report"><img src="images/back.png" width="20px;"></a></h6>
			</div>
			<table class="table-sm table-bordered" border="0" width="100%">
			<thead>
			<tr>
			<th align="center" style="width:30px" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI.No</th>
                                                        <th>Inward Number</th>
                                                        <th>Inward Entry Date</th>
                                                        <th>Item Name</th>
                                                        <th>Barcode</th>
														 <th>Manf.Date</th>
                                                       <!-- <th>Branch</th>
														<th>Location</th>
														<th>Bin</th>-->
                                                        <th>Net Weight</th>
														 <th>Inward Net Weight</th>
														 <th>Gross Weight</th>
														 <th>Inward Gross Weight</th>
														 <th>Scanned Time</th>
                            
							
			</tr>
			</thead>
			<tbody>
			<?php 
							   $num=$start+1;
							   while ($row=mysql_fetch_object($ret))
							   {
                                $fld_id=$row->Gate_Entry_Id;
                                
								if ($num%2==0)
								{
								?>
								<?php 
								}
								else
								{
								?>
								
								<?php
								}
						    	?>
							   <tr>
                               <td align="center" style="width: 20px"><?=$num?></td>
								<td align="left"><?=$row->Osp_Inward_No?></td>
                                <td align="left"><?=date("d-m-Y ",strtotime($row->Osp_Inward_Date))?></td> 
								<td align="left"><?=$row->Item_Name?></td>
                                <td align="left"><?=$row->barcode?></td>
								 <td align="left"><?=date("d-m-Y ",strtotime($row->Manf_Date))?></td> 
                                <!--<td align="left"><?=$row->Branch_Name?></td>
								<td align="left"><?=$row->Loc_Name?></td>
								<td align="left"><?=$row->Bin_Name?></td>-->
								<td align="left"><?=$row->Net_Weight?></td>
								<td align="left"><?=$row->Inward_Net_Wieght?></td>
								<td align="left"><?=$row->Gross_Weight?></td>
								<td align="left"><?=$row->Inward_Gross_Weight?></td>
								 <td align="left"><?=date("d-m-Y:H:i:s",strtotime($row->scan_time))?></td> 
                                


								
                              
								
                              						
								
 	<?php 
	 $num++;
	 }
	 if($num<=1) 
	 { 
	echo "<tr><td  colspan='12' align='center'><b><font color='red'>no records to display</font></b></td></tr>";
	 }
	 ?>
    </table>




	<table width="100%"  border="0">

<tr class="table_row_odd">

<td width="16%" height="24" align="center"><?php if($page>1) { ?>

<a href="osp_inward_scan_report_detailed?page=<?=($page-1)?><?=$condition?>"><img src="images/back.png" alt="Back" title="Back" height="25" width="40" /></a><?php }?></td>

<td width="69%" align="center" ><font color="#006699">Showing <?php if($count==0){?> <?=($start)?> <?php } else {?>



<?=($start+1)?> <?php } ?>

to 

<?=((($start+$perpage)>$count)?$count:($start+$perpage))?> of <?=($count)?></td>

<td width="15%" align="center"><?php if(($start+$perpage)<$count) {?>

<a href="osp_inward_scan_report_detailed?page=<?=($page+1)?><?=$condition?>"><img src="images/next.png" alt="Next" title="Next" height="25" width="40" /></a><?php }?> </td>  

</tr></table>








	</div>
	</div> 	
	<!-- /.card-body -->
</div>


</div>

