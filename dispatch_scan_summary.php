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
		if($status) $condition.="&status=$status";
		$msg=$_GET['msg'];
		$errmsg=$_GET['errmsg'];
	?>
	<!-- Content Header (Page header) -->
    <div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Dispatch Scan Report Summary</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item "><a href="#">Report</a></li>
						<li class="breadcrumb-item active">Dispatch Scan Report Summary</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
    <!-- Main content -->
    <section class="content">
	<?php
	 if($msg!='' or $errmsg!=''){?>
			<div class="alert alert-<?php if($_GET['msg']) echo 'success'; if($_GET['errmsg']) echo 'danger'; ?>  alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="fa  fa-info" style="margin-right:0.5em;"></i>
				<?php if($_GET['msg']) echo $msg; else echo $errmsg;?>
			</div>
		<?php } ?>
			<?php
			$date1=$_REQUEST['fromdate'];
			$newdate1=date("Y-m-d",strtotime($date1));
			if($date1!="") $condition.="&fromdate=$date1";
			$date2=$_REQUEST['todate']; 
			$newdate2=date("Y-m-d",strtotime($date2)); 
			if($date2!="") $condition.="&todate=$date2";
            $dispatch_no= $_REQUEST['dispatch_no'];
            if($dispatch_no!="") $condition.="&dispatch_no=$dispatch_no";
            $customer= $_REQUEST['customer'];
            if($customer!="") $condition.="&customer=$customer";


			$sql= "SELECT dispatch.*,usermaster.main_username,customer.customer_name/*,dispatch_sub.Planned_Qty,dispatch_sub.Scanned_Qty,item_master.Item_Id,item_master.Item_Name,item_master.NAV_code*/
			FROM dispatch_scan
			INNER JOIN dispatch ON dispatch.Dispatch_Id=dispatch_scan.Dispatch_Id
			/*INNER JOIN dispatch_sub ON dispatch_sub.Dispatch_Id=dispatch.Dispatch_Id*/
			
			INNER JOIN usermaster ON usermaster.user_id=dispatch.User_Id
			INNER JOIN customer ON customer.customer_id=dispatch.Dispatch_To
			/*INNER JOIN item_master ON item_master.Item_Id=dispatch_sub.Item_Id*/
			WHERE 1=1";

				if($date1!='')
				{
				$sql.=" and date(dispatch_scan.Scan_Time)>= '$newdate1'";
		        }
				if($date2!='')
				{
				$sql.=" and date(dispatch_scan.Scan_Time)<= '$newdate2'";
		        }
		        if($dispatch_no!='')
		         {     
		          $sql.=" and dispatch.Dispatch_No='$dispatch_no'";
		         }
		         if($customer!='')
		         {     
		          $sql.=" and dispatch.Dispatch_To='$customer'";
		         }

$sql.=" GROUP BY dispatch.Dispatch_No";
        $ret1=mysql_query($sql);
		$count=mysql_num_rows($ret1); 
		if($start>$count) { 
			$page=1;
			$start=0;
		}
		  
         
			$sql.=" order by dispatch.Dispatch_Id LIMIT $start,$perpage ";

		//	echo $sql;
			$ret=mysql_query($sql);
		?>			
			<div class="col-md-12">
            <div class="card">
				<div class="card-header">
					<h3 class="card-title">Report Details</h3>
					<h6 align='right'><a href="dispatch_scan_sel"><img src="images/back.png" width="20px;"></a></h6>
				</div>
				<table class="table-sm table-bordered" border="0" width="100%">
					<thead>
						<tr>
							<th align="center" style="width:30px" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI.No</th>
                           
                            <th>Dispatch Number</th>		
                            <th>Dispatch Date</th>	
                             <th>Invoice No.</th>	
                            <th>Customer Name</th>
                           <!-- <th>Item Name</th>
                            <th>Barcode Scanned</th>-->
                            <th>Dispatch Status</th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
							$num=$start+1;
							while ($row=mysql_fetch_object($ret))
							{
                                $fld_id=$row->Dispatch_Id;
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

								$sql11="SELECT COUNT(dispatch_scan.Serial_No) AS qty FROM dispatch_scan
								INNER JOIN dispatch_sub ON dispatch_scan.Dispatch_Id=dispatch_sub.Dispatch_Id

								 WHERE dispatch_sub.Dispatch_Id='$fld_id' AND dispatch_sub.Item_Id='$row->Item_Id'
								 GROUP BY dispatch_scan.Serial_No,dispatch_scan.Dispatch_Id";
								 $result11=mysql_query($sql11);
								 $data11=mysql_fetch_array($result11);
								 

							?>
							<tr>
                            <td align="center" style="width: 20px">
									<?=$num?>
								</td>
								<td align="left">
									<?=$row->Dispatch_No?>
								</td>
                              
								<?php
								$disdate=date("d-m-Y",strtotime($row->Dispatch_Date));
								if($disdate == "01-01-1970")
								{
									$disdates='--/--/----';
								}
								else
								{
									$disdates=$disdate;
								}

								?>

								<td align="left">
                                <?=$disdates?>
								</td>
                                  <td align="left">
									<?=$row->Invoice_No?>
								</td>
								
								<td align="left">
									<?=$row->customer_name?>
								</td>
								
								<!--<td align="left">
									<?=$row->NAV_code.'/'.$row->Item_Name?>
								</td>
								<td align="left">
									<?=$data11['qty']?>
								</td>-->
								
								<?php if($row->Dispatch_Status == 0)
								{
									$stat='Open';
								} 
								else
								{
									$stat='Close';
								}
									?>
								<td align="left">
									<?=$stat?>
								</td>

								
                                
								
                                
								<td  align="center"><a href="index.php?act=dispatch_scan_detailed&pid=<?=$fld_id?>&date1=<?=$newdate1?>&date2=<?=$newdate2?>&dispatch_no=<?=$row->Dispatch_No?>">more</a></td>
                            </td> 
<?php 
	 $num++;
	 }
	 if($num<=1) 
	 { 
	  echo "<tr><td align='center' colspan='10'><b><font color='red'>no records to display</font></b></td></tr>";
	 }
	 ?>
</table>
<table width="100%"  border="0">
       <tr class="table_row_odd">
         <td width="16%" height="24" align="center"><?php if($page>1) { ?>
          <a href="dispatch_scan_summary?page=<?=($page-1)?><?=$condition ?>"><img src="images/back.png" alt="Back" title="Back" height="25" width="30" /></a><?php }?></td>
         <td width="69%" align="center" ><font color="#006699">Showing <?php if($count == 0){?> <?=($start)?> to 0 of 0 <?php } else {?>
           <?=($start+1)?> <?php  ?>
           to 
           <?=((($start+$perpage)>$count)?$count:($start+$perpage))?> of <?=($count)?><?php } ?></td>
         <td width="15%" align="center"><?php if(($start+$perpage)<$count) {?>
          <a href="dispatch_scan_summary?page=<?=($page+1)?><?=$condition ?>"><img src="images/next.png" alt="Next" title="Next" height="25" width="30" /></a><?php }?> </td>  
       </tr></table>
	</div>
	</div> 	
</div>

</div>



