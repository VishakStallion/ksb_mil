<?php

        $mod=$_GET['mod']; 

	$page=$_REQUEST['page'];

?>

<script type="text/javascript">

	function int(id)

	{

		var field=document.getElementById(id);

		if (isNaN(field.value))

		{

			alert ("Please Enter a Numeric value");

			field.focus();

		}

	}

	function check()

	{ 
		if (checkEmpty('uomname','pid_uomname'))
        {
        	document.getElementById('uomname').focus();
            return false;
        }
		else if (checkEmpty('NAV_uom_code','pid_NAV_uom_code'))
        {
        	document.getElementById('NAV_uom_code').focus();
            return false;
        }
		
		/*if(document.manual_time_new.venname.value=='')

		{

			alert("Please enter a vendor name");

			document.manual_time_new.venname.focus();

		}*/

		/*else if(document.manual_time_new.qc_rq.value=='')

		{

			alert("Select QC Require");

			document.manual_time_new.qc_rq.focus();

		}	*/
		/*else if (checkEmpty('qc_rq','pid_qc_rq'))
        {
            document.manual_time_new.qc_rq.focus();
        } */

		else

		{

			document.manual_time_new.submit();

		}

	}

</script>

<div id="content_inner">

  	<div class="page_header">

	<div id="search"></div></div></div>

    <div id="quick_access_overview"></div>

	<div class="content-header">

		<div class="container-fluid">

			<div class="row mb-2">

				<div class="col-sm-6">

					<h1>UOM Master <?php if($mod=='add'){ echo "Add";}else{ echo "Edit";}?></h1>

				</div>

				<div class="col-sm-6">

					<ol class="breadcrumb float-sm-right">

						<li class="breadcrumb-item"><a href="index.php">Home</a></li>

						<li class="breadcrumb-item "><a href="#">Master</a></li>

						<li class="breadcrumb-item active">UOM Master</li>

					</ol>

				</div>

			</div>

		</div><!-- /.container-fluid -->

		

		<!-- Main content -->

		<section class="content">

			<div class="container-fluid">

				<!-- SELECT2 EXAMPLE -->

				<div class="card">

					<div class="card-header">

						<h3 class="card-title">Enter Details</h3>

					</div>

					<?php
						if($mod=="edt")

						{

							$uomcode=$_REQUEST['uomcode'];

                           $sql="select * from uom where `Uom_Id`='$uomcode'  AND Uom_Del=0";

							$ret=mysql_query($sql);

							$row=mysql_fetch_object($ret);

							$uomname.=$row->Uom;     
							$uomdesc=  $row->Uom_Description; 
							$NAV_uom_code = $row->NAV_uom_code;
							                  

						}

						if($mod=="add")

						{

							$sql="select max(Uom_Id) as maxuomt from uom";

							$ret=mysql_query($sql);	

							$row=mysql_fetch_object($ret);	 

							if(mysql_num_rows($ret))

							{

								$catcode.=$row->maxuomt+1;

							}

						}

					?>  

					

					

					<!-- /.card-header -->

					<div class="col-md-6">

						<form class="form-horizontal" action="uom_validate.php" method="post" name="manual_time_new" id="manual_time_new" >

							<div class="card-body">

                                                                                <input name="mod" value="<?=$mod?>" type="hidden" />	

										<input name="page" value="<?=$page?>" type="hidden" />	

										<input name="uomcode" type="hidden" value="<?=$uomcode?>" />

									

                                                                    <div class="form-group row">

                                                                        <label for="Scrap Value" class="col-sm-3 control-label">UOM Name <font color="#FF0000" size="">*</font> </label>

                                                                        <div class="col-sm-9">

                                                                            <input name="uomname" id="uomname" value="<?php echo htmlspecialchars($uomname)?>" type="text" class="form-control form-control-sm" size="32" />
                                                                             <p id='pid_uomname' style="display:none;"></p>
                                                                        </div>

                                                                    </div>
                                                                    
                                                                     <div class="form-group row">

                                                                        <label for="Scrap Value" class="col-sm-3 control-label">UOM Code <font color="#FF0000" size="">*</font></br><font color="#FF0000" size="">ERP Code</font> </label>

                                                                        <div class="col-sm-9">

                                                                            <input name="NAV_uom_code" id="NAV_uom_code" value="<?php echo htmlspecialchars($NAV_uom_code)?>" type="text" class="form-control form-control-sm" size="32" />
                                                                             <p id='pid_NAV_uom_code' style="display:none;"></p>
                                                                        </div>

                                                                    </div>

                                                           <!-- <div class="form-group row">

                                               <label for="Scrap Value" class="col-sm-3 control-label">Description </label>

                                                                        <div class="col-sm-9">

                                    <textarea name="uomDesc" id="uomDesc" class="form-control form-control-sm" size="32"><?=$uomdesc?></textarea>
                                                                              

                                                                        </div>

                                                                    </div>

							</div>-->

                                                    <div class="card-body">

                                                        <input type="button" name="Submit" class="btn btn-primary" value="<?php echo ($mod=="add")?"Add":"Update";?>" onClick="check();">

                                                        &nbsp;

                                                        <input type="reset" name="Submit2" class="btn btn-default" value="Clear" />

                                                    </div>

						</form>

						

						<!-- /.col -->

					</div>

					<!-- /.row -->

				</div>

			</div>

		</section>	

	</div>			

	<script>

   

    

   $(function () {

   //Initialize Select2 Elements

   $('.select2').select2()

   

   //Initialize Select2 Elements

   $('.select2bs4').select2({

   theme: 'bootstrap4'

   })

   });

   

</script>