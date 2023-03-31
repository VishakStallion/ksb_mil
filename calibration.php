<?php
$mod = $_GET['mod'];
$page = $_REQUEST['page'];
?>
<script src="iAjax.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#calibrate').hide();
        // $('#itemclear').hide();


    });

    function check() {


        if (checkEmpty('barcode', 'pid_barcode')) {
            document.getElementById('barcode').focus();
            return false;
        } else {

            var barcode = document.getElementById('barcode').value;
            data = 'ask=get_deatils&barcode=' + barcode;
            iAjax('ajax_getSearch_AK.php?' + data, get_dtls);

            // document.getElementById('manual_time_new').submit();
        }
    }


    function get_dtls(result) {
        console.log(result);
        if (result != 0) {
            document.getElementById('grngrid').innerHTML = result;
            $('#calibrate').show();
            // $('#itemclear').show();

        } else {
            var data = "<tr><td colspan='9' align='center'><font color='red'><b>No Records found!</b></font></td></tr> ";
            document.getElementById('grngrid').innerHTML = data;
            $('#calibrate').hide();
            // $('#itemclear').hide();
        }
    }

    
    function check_items() {

        if (checkEmpty('barcode', 'pid_barcode')) {
            document.getElementById('barcode').focus();
            return false;
        }

        
    var barcode = document.getElementById('barcode').value;
    window.location.href = 'cam?barcode=' + barcode;
    }

  

    

</script>
<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1>Stamping</h1>

            </div>


        </div>

    </div>


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



        <div class="container-fluid">

            <div class="card">



                <form class="form-horizontal" action="#" method="post" name="manual_time_new" id="manual_time_new" autocomplete='off'>

                    <div class="card-body">

                        <div class="col-md-12">



                            <!--first column-->
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="Scrap Value" class="col-sm-4 control-label">Valve Serial Number:<font color="#FF0000" size="">*</font> </label>
                                        <div class="col-sm-7">
                                            <input type="text" name="barcode" id="barcode" class="form-control  form-control-sm" size="32" value="">
                                            <p id='pid_barcode' style="display: none;"></p>
                                        </div>
                                    </div>
                                </div>

                                <!--second column-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <input type="button" value=" Start " class="btn btn-primary" onclick="check()" />

                                    </div>
                                </div>
                            </div>


                        </div>


                        <!--grid-->

                        <div class="card-body table-responsive p-0" id="divgrid">

                            <table class="table  table-head-fixed" id="grngrid">



                            </table>
                            <p id='pid_itemarray' style="display: none;"></p>
                        </div>


                        <div class="card-header"></div>&nbsp;

                        <div class="form-group row">

                            <div class="col-md-6">

                                <div class="form-group row">


                                    <a href="#" class="btn btn-success" name='calibrate' id="calibrate" onclick="check_items()">Stamp</a>

                                    <!-- <input type="button" value="Save"  class="btn btn-primary" onclick="check()"/> -->


                                </div>



                            </div>

                        </div>

                    </div>


                </form>
            </div>

        </div>

    </section>

</div>