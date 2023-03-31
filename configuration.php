<div id="content_inner">
	<div class="page_header">
		
	<div id="search"></div></div></div>
	<script type="text/javascript">
		
	</script>
	
	<?php 
		error_reporting(0);
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
					<h1>Configuration</h1>
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
			$sql= "Select count(*) from configuration ";
			$ret=mysql_query($sql);
			list($count)=mysql_fetch_row($ret);
			if($start>$count)
			{
				$page=1; 
				$start=0;
			}
			
			$sql= "SELECT * FROM `configuration`";
			
			$ret=mysql_query($sql);
			
		?>			
		
		<div class="col-md-12">
            <div class="card">
				<div class="card-header">
					<h3 class="card-title">Configuration Details</h3>
					
				</div>
				<table class="table-sm table-bordered" border="0">
					<thead>
						<tr>
							<th align="center" style="width:80px" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI.No</th>
                                                        <th>Company Name</th>
							<th>Background Image</th>
							<th>Main Icon</th>
							<th>Login Image</th>
                                                        <th>Fav Icon</th>
                                                        <th></th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$num=$start+1;
							while ($row=mysql_fetch_object($ret))
							{
								$fld_id=$row->id;
                                                                
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
									<?=$row->company_name?>
								</td>
                                                                <td align="left">
                                                                    <img src="dist/img/<?=$row->bg_img?>" alt="Italian Trulli" width="150">
								</td>
								
								<td align="left">
									<img src="dist/img/<?=$row->icon?>" alt="Italian Trulli" width="150">
								</td>
								<td align="left">
									<img src="dist/img/<?=$row->login_image?>" alt="Italian Trulli" width="150">
								</td>
                                                                <td align="left">
                                                                    <img src="dist/img/<?=$row->favicon?>" alt="Italian Trulli" width="50">
                                                                </td>
									<div class="btn-group title-quick-actions">      
									<td width="150px"><a href="index.php?act=config_edit&mod=edit&amp;id=<?=$fld_id?><?=$condition?>" ><button  type="button" title="Edit" class="btn btn-sm btn-default act-edit"><span class="fas fa-edit"></span></button></a>
									</td>
								</div> 
								
								
							</tr>
							<?php
								$num++;
							} 
						?>
					</tbody></table></div>
					
	<!-- /.card-body -->
</div>


</div>

