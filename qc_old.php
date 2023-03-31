<?php

	$mod=$_GET['mod']; 

	$page=$_REQUEST['page'];

	

	$yr=date("y");

	$sql1="SELECT MAX(grn_id)+1 as grn_number from grn";

	$res1=mysql_query($sql1);

	

	//$data1=mysql_fetch_object($res1);

	$rtn_id=$data1->grn_number; 

	if($rtn_id=='')

	{

		$rtn_id=1;

	}

	

?>

<script src="iAjax.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="/resources/demos/style.css">

<script type="text/javascript">

	

	function check()

    {

	document.manual_time_new.submit();

	}



	

	

    function get_barcode()

    {

        

		var datefrom = document.getElementById("fromdate").value;

		var dateto = document.getElementById("todate").value;

		var grnno = document.getElementById("grnno").value;

		var barcode = document.getElementById("barcode").value;

		var status = document.getElementById("qcstatus").value;

		data = "ask=addtogridbarcode&datefrom=" + datefrom + "&dateto=" + dateto + "&grnno="+ grnno + "&barcode="+ barcode+"&status="+status;

		// alert(data);

		iAjax('ajax_getsearch_qc.php?' + data, barcodeview);

        

	}

	

    

    function barcodeview(result)

    {

		// alert(result);

        document.getElementById('qcbarcodebody').innerHTML = result;

		document.getElementById('barcode').value="";

		

		

		

	}

	  

  

/*edited by anju on 25-090-2020*/

$(document).ready(function(){

var status = document.getElementById("qcstatus").value;

var data="ask=addtogridbarcode&status="+status;
// alert(data);

iAjax('ajax_getsearch_qc.php?' + data, barcodeview);

});



    function clearProductSelectors()

    {

		

        window.location.reload();

	}

    function clearall() {

        clearProductSelectors();

		

	}

	
//for date picker

	 function changedateformat(datefield) {

        datepicker = datefield.value;
        var res = datepicker.split("/");
        date = res[1] + '-' + res[0] + '-' + res[2];
        datefield.value = date;
		document.getElementById('addhgt').style.height = '0px';
    }
    

 /*   function changedateformat1() {



    datepicker=document.getElementById('todate').value;

        var res = datepicker.split("/");

        date=res[1]+'-'+res[0]+'-'+res[2];

        document.getElementById('todate').value=date;
		document.getElementById('addhgt1').style.height = '0px';



    }*/


 function addhght() {

        document.getElementById('addhgt').style.height = '180px';
    }

	
//end here

	

</script>

<?php

	$msg=$_GET['msg'];

	$errmsg=$_GET['errmsg'];

?>

<div class="content-header">

	<div class="container-fluid">

		<div class="row mb-2">

			<div class="col-sm-6">

				<h1>QC Checking</h1>

			</div>

			<div class="col-sm-6">

				<ol class="breadcrumb float-sm-right">

					<li class="breadcrumb-item"><a href="index.php">Home</a></li>

					<li class="breadcrumb-item "><a href="#">Transaction</a></li>

					<li class="breadcrumb-item active">QC</li>

				</ol>

			</div>

		</div>

	</div>

	

	<section class="content">

		<?php if($msg!='' or $errmsg!=''){?>

			<div class="alert alert-<?php if($_GET['msg']) echo 'success'; if($_GET['errmsg']) echo 'danger'; ?>  alert-dismissible">

				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

				<i class="fa  fa-info" style="margin-right:0.5em;"></i>

				<?php if($_GET['msg']) echo $msg; else echo $errmsg;?>

			</div>

		<?php } ?>

		

		<div class="container-fluid">

			<div class="card">

				<div class="card-header">

					<h3 class="card-title">Enter Details</h3>

				</div>

				<div class="col-md-12">

					

					<form class="form-horizontal" action="qc_validate.php" method="post" name="manual_time_new" id="manual_time_new" >

						<div class="card-body">

							<div class="col-md-12">

								<div class="form-group row">

		
									<div class="col-md-6">
										<div class="form-group row">
											
											<label for="Scrap Value" class="col-sm-3 control-label">GRN From Date:<font color="#FF0000" size=""></font> </label>
									
												<div class="col-sm-7 input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                                <input type="text" name="fromdate" id="fromdate" class="form-control form-control-sm has-datepicker pull-right"  size="32" onchange="changedateformat(this);" readonly="readonly"   onclick="addhght()">
                                            
											</div>
										</div>
									</div>
                            

                         
                                           	<div class="col-md-6">
										<div class="form-group row">
											
											<label for="Scrap Value" class="col-sm-3 control-label">GRN To Date:<font color="#FF0000" size=""></font> </label>
											
												<div class="col-sm-7 input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                                <input type="text" name="todate" id="todate" class="form-control form-control-sm has-datepicker pull-right"  size="32" onchange="changedateformat(this);" readonly="readonly"   onclick="addhght()">
                                            
											</div>
										</div>
									</div>

                                  </div>	
								  <div class="form-group row"  id="addhgt"></div>

								

								<div class="form-group row">

									<div class="col-md-6">

										<div class="form-group row">

											<label for="Scrap Value" class="col-sm-3 control-label">GRN Number:<font color="#FF0000" size=""></font> </label>

											<div class="col-sm-7">

												<select name="grnno" id="grnno" class="form-control select2" > 

													<option value="">--select--</option>

													<?php

														$sql="SELECT grn_id,PONum,GrnNo FROM `grn` WHERE `grn_del`=0" ;

														$res=mysql_query($sql);

														while($data=mysql_fetch_object($res)){

														?>

														<option value="<?php echo $data->grn_id;?>"><?php echo $data->GrnNo;?></option>

														<?php

														}

													?>

												</select>

											</div>

										</div>

									</div>

									

									<div class="col-md-6">

										<div class="form-group row">

											

											<label for="Scrap Value" class="col-sm-3 control-label">Barcode:<font color="#FF0000" size=""></font> </label>

											<div class="col-sm-7">

												<input type="text" name="barcode" id="barcode" class="form-control form-control-sm" value=""  size="32" >

											</div>

										</div>

									</div>	

								</div>

								

								<div class="form-group row">

									<div class="col-md-6">

										<div class="form-group row">

											<label for="Scrap Value" class="col-sm-3 control-label">QC Status:<font color="#FF0000" size=""></font> </label>

											<div class="col-sm-7">

												<select name="qcstatus" id="qcstatus" class="form-control select2" > 

													<option value="0" selected>QC not done</option>

													<option value="1">Accepted</option>

                                                    <option value="2">Rejected</option>

												</select>

											</div>

										</div>

									</div>

								

								

								

								

							</div>

							<div class="card-body">

								

								<input type="button"  class="btn btn-primary" onclick="get_barcode();" value="View Barcodes">

								&nbsp;

								<input type="reset"  class="btn btn-default" value="Clear" onclick="clearProductSelectors()"/> 

								

								

								

								

							</div>

							

							<div class="form-group row" >

							</div>

							<!--grid-->

							<div class="card-body table-responsive p-0" id="divgrid">

								<table class="table  table-head-fixed" id="grngrid">

									<thead>

										<tr>

											<th>Sl.no</th>

											<th>Part No</th>

											<th>Part Description</th>

											<th>Barcode</th>

											<th>Action</th>

											<th width="50px">Remarks</th>

										</tr>

									</thead>

									<tbody id="qcbarcodebody">

									</tbody>

								</table>

							</div> 

							<div class="card-header"></div>&nbsp;

							<div class="form-group row">

								<div class="col-md-6">

									<div class="form-group row">

										

										

										<input type="button" name="Submit" class="btn btn-primary" onclick="check();" value="Save">

										&nbsp;

										<input type="reset" name="Submit2" class="btn btn-default" value="Clear" onclick="clearall()"/> 

										

										

										

										

									</div>

									

								</div>

							</div>

						</div>

					</div>

					

				</div>

			</form>

	<script>
				$( function() {
					$( "#fromdate" ).datepicker();
					$( "#todate" ).datepicker();
				} );
			</script>
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


		</div>

	</section>

</div>

