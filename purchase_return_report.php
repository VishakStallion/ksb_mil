<?php

        $mod=$_GET['mod']; 

    $page=$_REQUEST['page'];

    $grid=$_POST['asn_grid'];

          

// print_r($_SESSION);



       

?>

<script src="../iAjax.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="/resources/demos/style.css">

                <script type="text/javascript">

        

        function changedateformat()

         {

        datepicker=document.getElementById('fromdate').value;

        var res = datepicker.split("/");

        date=res[1]+'-'+res[0]+'-'+res[2];

        document.getElementById('fromdate').value=date;

        // document.getElementById('addhgt').style.height='0px';

        }

        function changetodateformat()

         {

        datepicker=document.getElementById('todate').value;

        var res = datepicker.split("/");

        date=res[1]+'-'+res[0]+'-'+res[2];

        document.getElementById('todate').value=date;

        // document.getElementById('addhgt').style.height='0px';

        }





        function check_summary()

        {



        document.manual_time_new.action="purchase_return_report_summary";

        document.manual_time_new.submit();

        }

        

        function check_detail()

        {

            document.manual_time_new.action="purchase_return_report_detailed";

        document.manual_time_new.submit();

        }

   



                </script>

                <div class="content-header">

<div class="container-fluid">

    <div class="row mb-2">

        <div class="col-sm-6">

            <h1>Purchase Return Scan Report</h1>

        </div>

        <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

                <li class="breadcrumb-item"><a href="index.php">Home</a></li>

                <li class="breadcrumb-item "><a href="#">Report</a></li>

                <li class="breadcrumb-item active">Purchase Return Scan Report</li>

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

                <h3 class="card-title">Entry Details</h3>

                </div>

                <div class="col-md-12">

                <form class="form-horizontal" action="#" method="post" name="manual_time_new" id="manual_time_new" >

                <div class="card-body">

                <div class="col-md-12">

                        <div class="form-group row">

                                        <!--first column-->

                                        <div class="col-md-6">

                                <div class="form-group row">  

                                <label for="Scrap Value" class="col-sm-4 control-label">From Date:<font color="#FF0000" size=""></font> </label>

                                <div class="col-sm-7 input-group">

                               <div class="input-group-prepend"><span class="input-group-text">

                                                        <i class="far fa-calendar-alt"></i>

                                                    </span></div>

                                <input type="text" name="fromdate" id="fromdate" autocomplete='off' class="form-control form-control-sm has-datepicker pull-right" onchange="changedateformat()" readonly="readonly">      

                                </div>

                                </div>

                                </div>



                                <!--second column-->



                                <div class="col-md-6">

                                <div class="form-group row">  

                                <label for="Scrap Value" class="col-sm-4 control-label">To Date:<font color="#FF0000" size=""></font> </label>

                                <div class="col-sm-7 input-group">                                                                           

                               <div class="input-group-prepend"><span class="input-group-text">

                                                        <i class="far fa-calendar-alt"></i>

                                                    </span></div>

                                <input type="text" name="todate" id="todate" autocomplete='off' class="form-control form-control-sm has-datepicker pull-right" onchange="changetodateformat()" readonly="readonly">      

                                </div>

                                </div>

                                </div>

                        </div>

              

             

                <div class="form-group row">

                      
                        <div class="col-md-6">

                        <div class="form-group row"> 

                        <label for="Scrap Value" class="col-sm-4 control-label">Purchase Return Number:<font color="#FF0000" size=""></font> </label>

                        <div class="col-sm-7">   

                        <input type="text" name="purchase_no" id="purchase_no" class="form-control form-control-sm" autocomplete="off"  size="32" value="">

        

                        </div>

                        </div>

                        </div>


                        <div class="col-md-6">

											<div class="form-group row">

												<label for="Scrap Value" class="col-sm-4 control-label">MRR No:<font color="#FF0000" size=""></font> </label>

												<div class="col-sm-7">

													 <input type="text" name="mrrno" id="mrrno" class="form-control form-control-sm" autocomplete="off"  size="32" value="">
                                  
												</div>

											</div>

										</div>

                </div> 

                 

                    <div class="card-header"></div>&nbsp;

                    <div class="form-group row">

                    <div class="col-md-12">

                    <div class="form-group row">

                                <input type="button"  value="Summary"  onclick="check_summary()"  class="btn btn-primary"/>

                                 &nbsp;&nbsp;   

                                <input type="submit" name="summaryexcel" value="Summary Excel" class="btn btn-primary" onclick="this.form.action='purchase_return_summary_excel.php?act=<?php echo $_GET['act']?>'" /> &nbsp;&nbsp;

                                <input type="button"  value="Detailed"  onclick="check_detail()"  class="btn btn-primary"/>

                                 &nbsp;&nbsp;   

                                <input type="submit" name="summaryexcel" value="Detailed Excel" class="btn btn-primary" onclick="this.form.action='purchase_return_detailed_excel.php?act=<?php echo $_GET['act']?>'" /> &nbsp;&nbsp;

                                <input type="button" name="reset" value="RESET" onclick="clearall()" class="btn btn-default"/>

                        </div>

                        </div>

                        </div>

                         </div>

                    </div>





                </form>

                <script>



    $( function()

     {

    $( "#fromdate" ).datepicker();

  } );

  $( function()

     {

    $( "#todate" ).datepicker();

  } );



   function clearProductSelectors(){ 

                        //document.getElementById('gatenumber').value = '';

                        window.location.reload();

                            }

                            function clearall(){ 

                                clearProductSelectors();

                    //Remove Grid

                            }



</script>

                </div>

                </div>

                </div>

                </section>

                </div>