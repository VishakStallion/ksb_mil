<?php
$mod = $_GET['mod'];
$page = $_REQUEST['page'];
?>
<script src="iAjax.js"></script>
<script type="text/javascript">

    function check1() {


            if (checkEmpty('currentpassword','pid_currentpassword'))
        {
        	document.getElementById('currentpassword').focus();
            return false;
        }
        else if (checkEmpty('newpassword','pid_newpassword'))
        {
        	document.getElementById('newpassword').focus();
            return false;
        }
        else if (checkEmpty('confirmpassword','pid_confirmpassword'))
        {
        	document.getElementById('confirmpassword').focus();
            return false;
        }

        else if(document.getElementById('currentpassword').value == document.getElementById('newpassword').value){

    document.getElementById('pid_newpassword').style.display ="";
    document.getElementById('pid_newpassword').style.color = "red";
    document.getElementById('pid_newpassword').innerHTML = "New Password and Current password cannot be same";
    document.getElementById('newpassword').focus();
    document.getElementById('newpassword').value="";
    document.getElementById('confirmpassword').value="";
    return false;
}

else if(document.getElementById('confirmpassword').value != document.getElementById('newpassword').value){

document.getElementById('pid_newpassword').style.display ="";
document.getElementById('pid_newpassword').style.color = "red";
document.getElementById('pid_newpassword').innerHTML = "New Password and Confirm password mismatch";
document.getElementById('newpassword').focus();
document.getElementById('newpassword').value="";
document.getElementById('confirmpassword').value="";
return false;
}


        else {

            document.getElementById('manual_time_new').submit();
        }
    }
</script>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Change Password</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item "><a href="#">Utility</a></li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
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
                <div class="card-header">
                    <h3 class="card-title">Enter Details</h3>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal" action="changepassword_validate.php" method="post" name="manual_time_new" id="manual_time_new" >
                        <div class="card-body">
<?php
?>

                            <input name="mod" id="mod" value="<?= $mod ?>" type="hidden" />   
                            <input name="page" value="<?= $page ?>" type="hidden" />

                            <div class="form-group row">
                                <label for="Scrap Value" class="col-sm-4 control-label">Current Password <font color="#FF0000" size="">*</font> </label>
                                <div class="col-sm-8">
                                    <input type="password" name="currentpassword" id="currentpassword" class="form-control  form-control-sm"  size="32" >
                                    <p id='pid_currentpassword' style="display: none;"></p>
 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Scrap Value" class="col-sm-4 control-label">New Password <font color="#FF0000" size="">*</font> </label>
                                <div class="col-sm-8">
                                    <input type="password" name="newpassword" id="newpassword" class="form-control  form-control-sm"  size="32">
                                    <p id='pid_newpassword' style="display: none;"></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Scrap Value" class="col-sm-4 control-label">Confirm Password <font color="#FF0000" size="">*</font> </label>
                                <div class="col-sm-8">
                                    <input type="password" name="confirmpassword" id="confirmpassword" class="form-control  form-control-sm"  size="32" >
                                    <p id='pid_confirmpassword' style="display: none;"></p>
                                </div>
                            </div>


                        </div>
                        <div class="card-body">
                            <input type="button" name="Submit" class="btn btn-primary" onclick="check1();" value="Change">
                            &nbsp;
                            <input type="reset" name="Submit2" class="btn btn-default" value="Clear" /> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>            
</div>
