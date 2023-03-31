<?php

$barcode  = $_GET['barcode'];

?>



<script src="iAjax.js"></script>
<script type="text/javascript">


function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                   
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(400)
                        .height(400);
                        $('#image-preview').show(); // show the div containing the image
                        $('#photo_btn').hide();
                };

                reader.readAsDataURL(input.files[0]);
                
            }

            var myButton1 = document.getElementById("save");
            myButton1.disabled = false;
            var myButton2 = document.getElementById("addnew");
            myButton2.disabled = false;
        }

function check1()
{
    document.getElementById('manual_time_new').submit();
}


function check2()
{
    // alert("hdc");
    // return false;

    const form = document.getElementById('manual_time_new');

        // Change the action attribute
        form.action = 'calibration_validate2.php';
        document.getElementById('manual_time_new').submit();
}


function check_recalibrate() {

// if (checkEmpty('barcode', 'pid_barcode')) {
//     alert("valve serial number missing go back and try again")
//     return false;
// }


var barcode = document.getElementById('barcode').value;
window.location.href = 'recalibrate_validate.php?barcode=' + barcode;
}


</script>
<div class="content-header">




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

                

                <form class="form-horizontal" action="calibration_validate.php" method="post" name="manual_time_new" id="manual_time_new" enctype="multipart/form-data"  autocomplete='off'>

                    <div class="card-body">

                        <div class="col-md-12">


                            <input type="hidden" name="barcode" id="barcode" value="<?php echo $barcode?>">
                            <!--first column-->
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-group row d-flex justify-content-center">
                                       
                                        <div class="col-sm-7" id="photo_btn">
                                        <div class="custom-file">
                                        <label for="img" class="btn btn-primary">
                                        Take Photo
                                        </label>
                                        <input type="file" class="custom-file-input" id="img" name="img" capture="camera" onchange="readURL(this);">
                                    
                                    </div>
                                      
                                    </div>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group row" id="image-preview" style="display:none;">   
                                <img id="blah" src="#" alt="image file"  class="form-control  img-thumbnail" />
                                    </div></div>
                               
                            </div>

                        </div>

                    <div class="card-header"></div>&nbsp;

                        <div class="form-group row">

                            <div class="col-md-6">

                                <div class="form-group row">
 
                                    <a href="calibration" id="return"  class="btn btn-danger" >Back</a>
                              
                                    &nbsp;&nbsp;    
                                    <input type="button" value="Save" disabled="true" id="save"   class="btn btn-primary" onclick="check1()"/>

                                    &nbsp;&nbsp;
                                    <input type="button" value="Save & Add New" disabled="true" id="addnew"   class="btn btn-success" onclick="check2()"/>
                                    

                                    &nbsp;

                                    <a href="#" class="btn btn-danger" disabled="true" name='itemclear' id="itemclear" onclick="check_recalibrate()"> Loose Item Stamp</a>


                                </div>



                            </div>

                        </div>

                    </div>


                </form>
            </div>

        </div>

    </section>

</div>


