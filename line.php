<div id="content_inner">
	<div class="page_header">
		
	<div id="search"></div></div></div>
	<script type="text/javascript">
		function deleteconfirm(page,name,lineid)
		{
			if(confirm("Are you sure you want to delete this " + name + "?\nIf 'OK' all the information associated with this " + name +" will be removed from the system."))
			{
				window.location =page+ "?line_id=" + lineid + "&name=" + name ;		}		
		}
	</script>
	
	<?php 
		
		$perpage=10
		;
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
					<h1>Line Master</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item "><a href="#">Master</a></li>
						<li class="breadcrumb-item active">Line Master</li>
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
			$sql= "Select count(line_id),line_no from line_master where 1=1 and line_Del=0 ";
			if($searchVal!='')
			{
				$sql.=" and line_no like '%$searchVal%'";
			}
			$ret=mysql_query($sql);
			list($count)=mysql_fetch_row($ret);
			if($start>$count)
			{
				$page=1; 
				$start=0;
			}
			
			$sql= "SELECT line_master.line_no,line_master.line_id,branch_master.Branch_Name,line_master.description,locationmaster.Loc_Name
			     from line_master INNER JOIN locationmaster on locationmaster.Loc_Id=line_master.loc_id and Loc_Del='0'
				 INNER JOIN branch_master on branch_master.Branch_Id=line_master.branch_id	
				 		where 1=1  and line_Del=0 ";
			if($searchVal!='')
			{
				$sql.=" and line_no like '%$searchVal%'";
			}
			$sql.=" order by `line_id` LIMIT $start,$perpage ";
			
			$ret=mysql_query($sql);
			
		?>			
				<div class="col-md-12">
            <div class="card">
				<div class="card-header">
					<!-- <h3 class="card-title">Line Details</h3> -->
					
					<div class="card-title col-md-2">
                    <form name="search" action="?line<?php echo $_SERVER['PHP_SELF']?>">
                    <input type="text" name="search" id="search" class="form-control" style="height: 30px;width: 150px;" placeholder="search here" value="<?php echo $search;?>">
                    </form>
                </div>
					<div class="card-tools">
						<?php if($lictype==3){?> <a href="addline?mod=add" class="btn btn-sm" type="button"><i class="fa fa-plus-square"></i><b>  &nbsp; Add New Line </b> </a><?php }?>
					</div>
				</div>
				<table class="table-sm table-bordered" style="width: 100%" border="0">
					<thead>
						<tr>
							<th align="center" style="width:80px" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI.No</th>
                                                        <th>Line No</th>
							<th>Description</th>
                            <th>Branch</th>
                            <th>Location</th>

                            <th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$num=$start+1;
							while ($row=mysql_fetch_object($ret))
							{
                                $fld_id=$row->line_id;
                                
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

								<?=$row->line_no?>

								</td>
								<td align="left">
									<?=$row->description?>
								</td>
                                <td align="left">
									<?=$row->Branch_Name?>
								</td>
                                <td align="left">
									<?=$row->Loc_Name?>
								</td>
                                
									<div class="btn-group title-quick-actions">      
									<td width="150px">
									<?php if($lictype==3){?><div class='btn-group'><button data-toggle='tooltip' title='Delete' onClick="javascript:deleteconfirm('line_delete.php','line','<?=$fld_id.$condition?>')" type='button' class='btn btn-sm btn-default act-view'><span class='fa fa-trash'></span></button></div> <?php }?></td>
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
								<a href="line?page=<?=($page-1)?>" class="btn btn-primary" ><i class="fa fa-angle-double-left"></i></a></a><?php }?></td>
								<td align="center"><font color="#006699">Showing 
									<?=($start+1)?> 
									to 
									<?=((($start+$perpage)>$count)?$count:($start+$perpage))?> of <?=($count)?></font></td><td align="left" width="200px"><?php if(($start+$perpage)<$count) {?>
								<a href="line?page=<?=($page+1)?>" class="btn btn-primary"><i class="fa fa-angle-double-right"></i></a></a>           <?php }?> </td>
								
								
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

