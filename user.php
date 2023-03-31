<div id="content_inner">
<div class="page_header">
<div id="search">
</div></div></div>
<script type="text/javascript">

		function deleteconfirm(page,name,usercode)

		{

			if(confirm("Are you sure you want to delete this " + name + "?\nIf 'OK' all the information associated with this " + name +        " will be removed from the system."))

			window.location =page+ "?User_Code=" + usercode + "&name=" + name ;

		}

	</script>

	<?php 

		$perpage=10;

		$page=$_REQUEST['page'];

		$page=($page>=1)?$page:1;

		$start=($page-1)*$perpage;

		
		global $oracledatabase ;

		$condition="";

		if($page) $condition.="&page=$page";

		if($status) $condition.="&status=$status";

		$msg=$_GET['msg'];

		$errmsg=$_GET['errmsg'];

		$searchVal=trim($_GET['search']);

		$lictype = $_SESSION['LIC_TYPE'];

	?>

	<!-- Content Header (Page header) -->

    <div class="content-header">

		<div class="container-fluid">

			<div class="row mb-2">

				<div class="col-sm-6">

					<h1>User Master</h1>

				</div>

				<div class="col-sm-6">

					<ol class="breadcrumb float-sm-right">

						<li class="breadcrumb-item"><a href="index.php">Home</a></li>

						<li class="breadcrumb-item "><a href="#">Master</a></li>

						<li class="breadcrumb-item active">User Master</li>

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

			$sql= "SELECT count(*) as count FROM $oracledatabase.".tbl_usermaster." 


			where 1=1";

				if($searchVal!='')

				{

					$sql.=" and LOGIN_NAME like '%$searchVal%'";

				}

			// echo $sql; exit;
				
			$ret=db_query($sql);

			$temp = db_fetch_object($ret);
			$count = $temp->COUNT;

			if($start>$count)

			{

				$page=1; 

				$start=0;

			}

			$sql= "SELECT $oracledatabase.".tbl_usermaster.".* FROM $oracledatabase.".tbl_usermaster."  where 1=1 AND  ROWNUM >= $start AND ROWNUM <= $perpage   ";

				if($searchVal!='')

				{

					$sql.=" and USER_NAME like '%$searchVal%'";

				}
				// ROWNUM=1
				$sql.=" ORDER BY $oracledatabase.".tbl_usermaster.".user_id   ";
			//echo $sql;
			$ret=db_query($sql);

		?>			

		<div class="col-md-12">

            <div class="card">

				<div class="card-header">

					<!-- <h3 class="card-title">User Details</h3> -->

					<div class="card-title col-md-2">

                    <form name="search" action="?user<?php echo $_SERVER['PHP_SELF']?>">

                    <input type="text" name="search" id="search" class="form-control" style="height: 30px;width: 150px;" placeholder="search here" value="<?php echo $search;?>">

                    </form>

                </div>

					<div class="card-tools">

						<?php if($_SESSION['SESS_USER_TYPE']=='A'){?> <a href="adduser?mod=add" class="btn btn-sm" type="button"><i class="fa fa-plus-square"></i><b>    &nbsp; Add New User </b> </a><?php }?>

					</div>
					   
				</div>

				<table class="table-sm table-bordered" style="width: 100%" border="0">

					<thead>

						<tr>

							<th align="center" style="width:80px" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI.No</th>

                             <th>User Name</th>

                              <th>Login User Name</th>

							  <!-- <th>User Type</th> -->


							<?php if($_SESSION['SESS_USER_TYPE']=='A'){?><th>Action</th><?php } ?>

						</tr>

					</thead>

					<tbody>

						<?php 

							$num=$start+1;

							while ($row=db_fetch_object($ret))

							{

								$fld_id=$row->USER_ID;

                                                                

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

									<?=$row->USER_NAME?>
								</td>
								<td align="left">
									<?=$row->LOGIN_NAME?>
								</td>
                                <!-- <td align="left">
                                <?php if($row->STATUS=='A') echo "Administrator";
                       			else 
                       			 echo "Standard user"; ?>
								</td>
								 -->
                                

								

									<?php if($_SESSION['SESS_USER_TYPE']=='A'){?><div class="btn-group title-quick-actions">      

									<td width="150px"><a href="index.php?act=adduser&mod=edit&amp;userid=<?=$fld_id?><?=$condition?>" ><button  type="button" title="Edit" class="btn btn-sm btn-default act-edit"><span class="fas fa-edit"></span></button></a>

									</td>

								</div> <?php } ?>

								

								

							</tr>

							<?php

								$num++;

							} 

						?>

				

					<table class="table" border="0"><tr>

						<?php

							if($count>0) {

								

							?>

							<td align="right" width="200px">

								<?php if($page>1) { ?>

								<a href="user?page=<?=($page-1)?>" class="btn btn-primary" ><i class="fa fa-angle-double-left"></i></a></a><?php }?></td>

								<td align="center"><font color="#006699">Showing 

									<?=($start+1)?> 

									to 

									<?=((($start+$perpage)>$count)?$count:($start+$perpage))?> of <?=($count)?></font></td><td align="left" width="200px"><?php if(($start+$perpage)<$count) {?>

								<a href="user?page=<?=($page+1)?>" class="btn btn-primary"><i class="fa fa-angle-double-right"></i></a></a>           <?php }?> </td>

								

								

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
		</tbody></table></div>
	</table>

	

	<!-- /.card-body -->

</div>





</div>

						

