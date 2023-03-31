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
					<h1>Purchase Return Scan Report Detailed</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item "><a href="#">Report</a></li>
						<li class="breadcrumb-item active">Purchase Return Scan Report Detailed</li>
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

            $purchase_no= $_REQUEST['purchase_no'];
            if($purchase_no!="") $condition.="&purchase_no=$purchase_no";
            $mrrno= $_REQUEST['mrrno'];
            if($mrrno!="") $condition.="&mrrno=$mrrno";


			$sql= "SELECT purchase_return_scan.Net_Weight,
			purchase_return_scan.Purchase_Return_No,
			purchase_return_scan.Scan_Time,
			purchase_return_scan.Serial_No,
			usermaster.main_username,
			grn.GrnNo,
			grn.MRR_NO,
			item_master.Item_Name,
			item_master.NAV_code,
			barcode.batch_number,
			barcode.lot_number,
			grn.grn_id


			FROM purchase_return_scan
			INNER JOIN grn ON grn.grn_id=purchase_return_scan.Grn_Id
			INNER JOIN barcode ON barcode.serial_no=purchase_return_scan.Serial_No
			INNER JOIN item_master ON item_master.Item_Id =barcode.item_id

			INNER JOIN usermaster ON usermaster.user_id=purchase_return_scan.User_Id
			
			WHERE 1=1";

				if($date1!='')
				{
				$sql.=" and date(purchase_return_scan.Scan_Time)>= '$newdate1'";
		        }
				if($date2!='')
				{
				$sql.=" and date(purchase_return_scan.Scan_Time)<= '$newdate2'";
		        }


		        if($purchase_no!='')
		         {     
		          $sql.=" and purchase_return_scan.Purchase_Return_No='$purchase_no'";
		         }
		         if($mrrno!='')
		         {     
		          $sql.=" and grn.MRR_NO='$mrrno'";
		         }


        $ret1=mysql_query($sql);
		$count=mysql_num_rows($ret1); 
		if($start>$count) { 
			$page=1;
			$start=0;
		}
		  
         
			$sql.=" order by grn.grn_id LIMIT $start,$perpage ";

			//echo $sql;
			$ret=mysql_query($sql);
		?>			
			<div class="col-md-12">
            <div class="card">
				<div class="card-header">
					<h3 class="card-title">Report Details</h3>
					<h6 align='right'><a href="purchase_return_report"><img src="images/back.png" width="20px;"></a></h6>
				</div>
				<table class="table-sm table-bordered" border="0" width="100%">
					<thead>
						<tr>
							<th align="center" style="width:30px" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI.No</th>
                           
                            <th>Purchase Return Number</th>		
                            <th>MRR No</th>	
                             <th>Item Name</th>	
                                <th>Serial No</th>
                            <th>Batch</th>
                            <th>Lot No</th>

                            <th>Returned Qty</th>
                            <th>Returned By</th>
                            <th>Returned Time</th>
                            <th></th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
							$num=$start+1;
							while ($row=mysql_fetch_object($ret))
							{
                                $fld_id=$row->grn_id;
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
                            <td align="center" style="width: 20px">
									<?=$num?>
								</td>
								<td align="left">
									<?=$row->Purchase_Return_No?>
								</td>
								<td align="left">
									<?=$row->MRR_NO?>
								</td>
								<td align="left">
									<?=$row->NAV_code.'/'.$row->Item_Name?>
								</td>
									<td align="left">
									<?=$row->Serial_No?>
								</td>
									<td align="left">
									<?=$row->batch_number?>
								</td>
									<td align="left">
									<?=$row->lot_number?>
								</td>
								</td>
								

								</td>
									<td align="left">
									<?=$row->Net_Weight?>
								</td>
								<td align="left">
									<?=$row->main_username?>
								</td>
								<td align="left">
                                <?=date("d-m-Y H:i:s",strtotime($row->Scan_Time))?>
								</td>

                                 
								
								</tr> 
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
          <a href="purchase_return_report_detailed?page=<?=($page-1)?><?=$condition ?>"><img src="images/back.png" alt="Back" title="Back" height="25" width="30" /></a><?php }?></td>
         <td width="69%" align="center" ><font color="#006699">Showing <?php if($count == 0){?> <?=($start)?> to 0 of 0 <?php } else {?>
           <?=($start+1)?> <?php  ?>
           to 
           <?=((($start+$perpage)>$count)?$count:($start+$perpage))?> of <?=($count)?><?php } ?></td>
         <td width="15%" align="center"><?php if(($start+$perpage)<$count) {?>
          <a href="purchase_return_report_detailed?page=<?=($page+1)?><?=$condition ?>"><img src="images/next.png" alt="Next" title="Next" height="25" width="30" /></a><?php }?> </td>  
       </tr></table>
	</div>
	</div> 	
</div>

</div>



