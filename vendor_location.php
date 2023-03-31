<div id="content_inner">
	<div class="page_header">
		
	<div id="search"></div></div></div>
	<script type="text/javascript">
		function deleteconfirm(page,name,vendorloccode)
		{
			if(confirm("Are you sure you want to delete this " + name + "?\nIf 'OK' all the information associated with this " + name +        " will be removed from the system."))
			window.location =page+ "?Vendor_Loc_Code=" + vendorloccode + "&name=" + name ;
		}
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
		$searchVal=trim($_GET['search']);
	?>
	<!-- Content Header (Page header) -->
    <div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Vendor Location Master</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item "><a href="#">Master</a></li>
						<li class="breadcrumb-item active">Vendor Location Master</li>
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
			$sql= "SELECT count(vendor_location_master.Vendor_Loc_Code),vendormaster.Vendor_Name FROM vendor_location_master
			INNER JOIN vendormaster ON vendormaster.Vendor_Id=vendor_location_master.Vendor_Id
			 where 1=1 AND vendor_location_master.Vendor_Loc_Del=0  AND  vendormaster.Vendor_Del=0 ";
			if($searchVal!='')
			{
				$sql.=" AND  Vendor_Name like '%$searchVal%'";
			}
			$ret=mysql_query($sql);
			list($count)=mysql_fetch_row($ret);
			if($start>$count)
			{
				$page=1; 
				$start=0;
			}
			
			$sql= "SELECT vendor_location_master.*,vendormaster.`Vendor_Name` FROM vendor_location_master
                                INNER JOIN vendormaster ON vendormaster.Vendor_Id=vendor_location_master.Vendor_Id
                                 where 1=1 AND vendor_location_master.Vendor_Loc_Del=0 AND  vendormaster.Vendor_Del=0 ";
			if($searchVal!='')
			{
				$sql.=" AND vendormaster.Vendor_Name like '%$searchVal%'";
			}
			$sql.=" order by vendormaster.`Vendor_Name` LIMIT $start,$perpage ";
			
			$ret=mysql_query($sql);
			
		?>			
		
		<div class="col-md-12">
            <div class="card">
				<div class="card-header">
				<div class="card-title col-md-2">
                    <form name="search" action="?vendorloc<?php echo $_SERVER['PHP_SELF']?>">
                    <input type="text" name="search" id="search" class="form-control" style="height: 30px;width: 150px;" placeholder="search here" value="<?php echo $search;?>">
                    </form>
                </div>
					<!-- <h3 class="card-title">Vendor Location Details</h3> -->
					<div class="card-tools">
						<?php if($lictype==3){?> <a href="addvendorloc?mod=add" class="btn btn-sm" type="button"><i class="fa fa-plus-square"></i><b>    &nbsp; Add New Vendor Location </b> </a><?php }?>
					</div>
				</div>
				<table class="table-sm table-bordered"  style="width: 100%" border="0">
					<thead>
						<tr>
							<th align="center" style="width:80px" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI.No</th>
							<th>Vendor Name</th>
							<th>Location Code</th>
                            <th>Address</th>

							<th>City</th>
							<th>State</th>
							<th>Zip</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$num=$start+1;
							while ($row=mysql_fetch_object($ret))
							{
								$fld_id=$row->Vendor_Loc_Id;
								$address=$row->Address_Line1;

								if($row->Address_Line2){
                                   $address.=",<br>".$row->Address_Line2;
                                    }
                                if($row->Address_Line3){
                                    $address.=",<br>".$row->Address_Line3;
                                    }

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
							<tr >
								<td align="center" style="width: 20px">
									<?=$num?>
								</td>
								
								<td align="left">
									<?=$row->Vendor_Name?>
								</td>
								
                                                                <td align="left">
									<?=$row->Vendor_Loc_Code?>
								</td>
                                                                
								<td align="left">
									<?=$address?>
								</td>

								<td align="left">
									<?=$row->City?>
								</td>
								<td align="left">
									<?=$row->State?>
								</td>
								<td align="left">
									<?=$row->Zip?>
								</td>
								<!--<td></td>-->
									<div class="btn-group title-quick-actions">      
									<td width="150px"><a href="index.php?act=addvendorloc&mod=edit&amp;vendorlocid=<?=$fld_id?><?=$condition?>" ><button  type="button" title="Edit" class="btn btn-sm btn-default act-edit"><span class="fas fa-edit"></span></button></a>
									<?php if($lictype==3){?><div class='btn-group'><button data-toggle='tooltip' title='Delete' onClick="javascript:deleteconfirm('ven_loc_delete.php','Vendor Location','<?=$fld_id.$condition?>')" type='button' class='btn btn-sm btn-default act-view'><span class='fa fa-trash'></span></button></div> <?php }?></td>
								</div> 
								
								
							</tr>
							<?php
								$num++;
							} 
						?>
					</tbody></table></div>
					<table class="table" border="0"><tr>
						<?php
							if($count>0) {
								
							?>
							<td align="right" width="200px">
								<?php if($page>1) { ?>
								<a href="vendorloc?page=<?=($page-1)?>" class="btn btn-primary" ><i class="fa fa-angle-double-left"></i></a></a><?php }?></td>
								<td align="center"><font color="#006699">Showing 
									<?=($start+1)?> 
									to 
									<?=((($start+$perpage)>$count)?$count:($start+$perpage))?> of <?=($count)?></font></td><td align="left" width="200px"><?php if(($start+$perpage)<$count) {?>
								<a href="vendorloc?page=<?=($page+1)?>" class="btn btn-primary"><i class="fa fa-angle-double-right"></i></a></a>           <?php }?> </td>
								
								
								<?php
								}
								else
								{
								?>
				            	<tr><td colspan='9' align='Left'><font color='red'><b>No Records found!</b></font></td></tr>
								<?php
								}
					?>
		</tr>
	</table>
	
	<!-- /.card-body -->
</div>
</div>


