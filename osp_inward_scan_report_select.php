<?php
$mod = $_GET['mod'];
$page = $_REQUEST['page'];
$grid = $_POST['asn_grid'];
?>
<script src="iAjax.js"></script>
<script type="text/javascript">

    function f_dob1() {
        gfPop.fStartPop(document.manual_time_new.from_date, Date);
    }
    function f_dob2() {
        gfPop.fStartPop(document.manual_time_new.to_date, Date);
    }


    function check1() {
        document.manual_time_new.action = "osp_inward_scan_report_summary";
        document.manual_time_new.submit();
    }


    function check2() {
        document.manual_time_new.action = "osp_inward_scan_report_detailed";
        document.manual_time_new.submit();
    }


</script>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>OSP Inward Scan Report</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item "><a href="#">Report</a></li>
                    <li class="breadcrumb-item active">OSP Inward Scan Report</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <?php if ($msg != '' or $errmsg != '') { ?>
            <div class="alert alert-<?php if ($_GET['msg']) echo 'success';
            if ($_GET['errmsg']) echo 'danger'; ?>  alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa  fa-info" style="margin-right:0.5em;"></i>
                <?php if ($_GET['msg']) echo $msg;
                else echo $errmsg; ?>
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
                                                <label for="Scrap Value" class="col-sm-4 control-label">From Date:<font color="#FF0000" size=""></font> </label>                                 
                                                <div class="col-sm-7 input-group">
													<div class="input-group-prepend"><span class="input-group-text">
														<i class="far fa-calendar-alt"></i>
													</span></div>                                                                          
                                                    <input type="text" name="from_date" id="from_date" class="form-control form-control-sm"  size="32" value="<?php ?>" onchange="changedateformat('from_date')" readonly="readonly">
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
                                                    <input type="text" name="to_date" id="to_date"  class="form-control form-control-sm has-datepicker pull-right" onchange="changedateformat('to_date')" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                    </div>												
                                    <div class="form-group row">		
                                        <div class="col-md-6">
                                            <div class="form-group row">											
                                                <label for="Scrap Value" class="col-sm-4 control-label">OSP Inward Number:<font color="#FF0000" size=""></font> </label>
                                                <div class="col-sm-7">
                                                    <input type="text" name="InwardNo" id="InwardNo" class="form-control form-control-sm" autocomplete="off"  size="32" value="">                                      
                                                </div>
                                            </div>
                                        </div>                                                      
                                    </div>
                                    <div class="card-header"></div>&nbsp;
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <input type="button" name="summary" class="btn btn-primary" value="Summary" onclick="check1()"/>
                                                &nbsp;&nbsp;
                                                <input type="submit" name="summaryexcel" value="Summary-Excel" class="btn btn-primary" onclick="this.form.action='osp_inward_scan_summary_excel.php?act=<?php echo $_GET['act']?>'" />

                                                 &nbsp;&nbsp;   
                                                <input type="button" name="detailed" value="Detailed" class="btn btn-primary" onclick="check2()"/>
                                                &nbsp;&nbsp;
                                                 <input type="submit" name="detailedexcel" value="Detailed-Excel" class="btn btn-primary" onclick="this.form.action='osp_inward_scan_detailed_excel.php?act=<?php echo $_GET['act']?>'" />

                                                 &nbsp;&nbsp;  
                                                <input type="button" name="reset" value="RESET" class="btn btn-default" onclick="clearall()"/>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                        </form>

                        <script>
                            function clearProductSelectors() {
                                //document.getElementById('gatenumber').value = '';
                                window.location.reload();
                            }
                            function clearall() {
                                clearProductSelectors();
                                //Remove Grid
                            }
                            function changedateformat(datevar) {
                                datepicker = document.getElementById(datevar).value;
                                var res = datepicker.split("/");
                                date = res[1] + '-' + res[0] + '-' + res[2];
                                document.getElementById(datevar).value = date;
                            }
                        </script>
                    </div>
                </div>
            </div>
        </section>
</div>
<script>
    $(function () {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });
</script>

















