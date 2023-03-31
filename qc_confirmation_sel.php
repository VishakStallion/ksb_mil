<?php
        $mod=$_GET['mod']; 
	$page=$_REQUEST['page'];
	$grid=$_POST['asn_grid'];
          

       
?>

<script src="iAjax.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
        <script type="text/javascript">

         function changedateformat() {
        datepicker=document.getElementById('datepicker').value;
        var res = datepicker.split("/");
        date=res[1]+'-'+res[0]+'-'+res[2];
        document.getElementById('datepicker').value=date;

	}
    
    function changedateformat1() {

    datepicker=document.getElementById('datepicker1').value;
        var res = datepicker.split("/");
        date=res[1]+'-'+res[0]+'-'+res[2];
        document.getElementById('datepicker1').value=date;

    }





// function f_dob1() 
// 	{
// 	    gfPop.fStartPop(document.manual_time_new.from_date,Date);
// 	}
// function f_dob2()
// 	{
// 	    gfPop.fStartPop(document.manual_time_new.to_date,Date);
// 	}





           function check1(){
                            
    
                               document.manual_time_new.action="qc_confirmation_summary";
                               document.manual_time_new.submit();                        
                      
                       }
                       
                       
            function  check2(){
                document.manual_time_new.action="qc_confirmation_detailed";
                               document.manual_time_new.submit();   

            }                             
                       

    
</script>
<div class="content-header">
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>QC Confirmation Report</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item "><a href="#">Report</a></li>
                <li class="breadcrumb-item active">QC Confirmation Report</li>
            </ol>
        </div>
    </div>
</div>
        <!-- Main content -->
		<section class="content">
		
		<?php if($msg!='' or $errmsg!=''){?>
			<div class="alert alert-<?php if($_GET['msg']) echo 'success'; if($_GET['errmsg']) echo 'danger'; ?>  alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="fa  fa-info" style="margin-right:0.5em;"></i>
				<?php if($_GET['msg']) echo $msg; else echo $errmsg;?>
			</div>
		<?php } ?>
 

    <section class="content">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
								<h3 class="card-title">Enter Details</h3> 
                            </div>
                            <div class="col-md-12">
                                <form class="form-horizontal" action="#" method="post" name="manual_time_new" id="manual_time_new" autocomplete="off">
                                    <div class="card-body">
									<div class="col-md-12">
                                        <div class="form-group row">
                                          <!--first column-->
                                      <div class="col-md-6">
                                    <div class="form-group row">
                        
											<label for="Scrap Value" class="col-sm-3 control-label">From Date:<font color="#FF0000" size=""></font> </label>
                                            <div class="col-sm-7 input-group">
												<div class="input-group-prepend"><span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                        </span></div>
                                                <input type="text" name="datepicker" id="datepicker" class="form-control form-control-sm has-datepicker pull-right" readonly="readonly"  onchange="changedateformat()">
                                            </div>
											</div>
                                            </div>												
                                        <!--second column-->
                                       <div class="col-md-6">
                                    <div class="form-group row">
                        
											<label for="Scrap Value" class="col-sm-2 control-label">To Date:<font color="#FF0000" size=""></font> </label>
                                            <div class="col-sm-7 input-group">
												<div class="input-group-prepend"><span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                        </span></div>
                                                <input type="text" name="datepicker1" id="datepicker1" class="form-control form-control-sm has-datepicker pull-right" readonly="readonly"  onchange="changedateformat1()">
                                            											
                                         </div>
	                                      </div>
                                           </div>
	                                     </div>												

											
											 <div class="form-group row">		
                                            <!--  <div class="col-md-6">
                                             <div class="form-group row">		
                                            <label for="Scrap Value" class="col-sm-3 control-label">Barcode:<font color="#FF0000" size=""></font> </label>
                                            <div class="col-sm-7">
                                            <input type="text" name="barcode" id="barcode" class="form-control form-control-sm"  size="32" value="<?php ?>">
                                            </div>
                                            </div>
                                            </div> -->
                                            <div class="col-md-6">
                                             <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-3 control-label">GRN/Production No:<font color="#FF0000" size=""></font> </label>
                                            <div class="col-sm-7"  >
                                            <input type="text" name="grnno" id="grnno" class="form-control form-control-sm"  size="32" value="<?php ?>">
                                            </div>
											</div>
                                            </div>
											</div>
                                <div class="card-header"></div>&nbsp;
                                <div class="form-group row">
                                <div class="col-md-6">
                                <div class="form-group row">
								<input type="button" name="summary" value="Summary" class="btn btn-primary" onclick="check1()" />
                                &nbsp;&nbsp;
                                 <input type="submit" name="excel" value="Summary-Excel" class="btn btn-primary" onclick="this.form.action='qcconfirmationreport_excel.php?act=<?php echo $_GET['act']?>'" />
                                 &nbsp;&nbsp;
								<input type="button" name="detailed" value="Detailed" class="btn btn-primary" onclick="check2()"/>
								 &nbsp;&nbsp;
                                <input type="submit" name="excel" value="Detailed-Excel" class="btn btn-primary" onclick="this.form.action='qcconfirmation_detail_excel.php?act=<?php echo $_GET['act']?>'" />
								 &nbsp;&nbsp;
                                <input type="button" name="reset" value="RESET" class="btn btn-default" onclick="clearall()"/>
						</div>
						</div> 
                        </div>
                        </div>



                </form>
                <script>
         
$( function() {
    $( "#datepicker" ).datepicker();
  } );
    
$( function() {
    $( "#datepicker1" ).datepicker();
  } );


                function clearProductSelectors(){ 
						//document.getElementById('gatenumber').value = '';
						window.location.reload();
							}
							function clearall(){ 
								clearProductSelectors();
					//Remove Grid
							}

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
                        </div>
                        </div>
        </section>
</div>











