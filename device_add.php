<?php
        $mod=$_GET['mod']; 
	$page=$_REQUEST['page'];
 global $oracledatabase ;

?>
<script src="iAjax.js"></script>
<script type="text/javascript">


function check1(){
    

    if (checkEmpty('device','pid_device'))
        {
        	document.getElementById('device').focus();
            return false;
        }

        else if (checkEmpty('permission','pid_permission'))
        {
        	document.getElementById('permission').focus();
            return false;
        }

    else{
        document.getElementById('manual_time_new').submit();
        } 
}
</script>
<div class="content-header">
<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Device Master <?php if($mod=='add'){ echo "Add";}else{ echo "Edit";}?></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item "><a href="#">Master</a></li>
						<li class="breadcrumb-item active">Device Master</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
				<h3 class="card-title">Enter Details</h3>
                            </div>
                            <div class="col-md-7">
                                <form class="form-horizontal" action="device_validate.php" method="post" name="manual_time_new" id="manual_time_new" >
                                    <div class="card-body">
                                        <?php
                                                $device_id=$_REQUEST['device_id'];
                                                $sql="SELECT * FROM device_master WHERE device_id='{$device_id}'";
                                                $res=db_query($sql);
                                                $data=db_fetch_object($res);
                                                $device_name=$data->DEVICE_NAME;
                                                $permission=$data->STATUS;
                                                
                                               
                                            ?>
                                        <input name="mod" id="mod" value="<?=$mod?>" type="hidden" />	
					                    <input name="page" value="<?=$page?>" type="hidden" />
                                        <input name="device_id" value="<?=$device_id?>" type="hidden" />
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-3 control-label">Device Name <font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="device" id="device" class="form-control  form-control-sm"  size="32" value="<?php echo $device_name;?>">
                                                <p id='pid_device' style="display: none;"></p>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-3 control-label">Permission<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-9">
                                            <select name="permission" id="permission"   class="form-control select2">
						                        <option value="">--select--</option>
						                        <option value="1" <?php if($permission=='1'){?>selected="selected"<?php }?> >Active</option>	
                                                <option value="0" <?php if($permission=='0'){?>selected="selected"<?php }?>>Deactive</option>							
					                            </select>
                                                <p id='pid_permission' style="display: none;"></p>
                                            </div>
                                        </div>
                                       

                                        
                                       
                                    </div>
                                    <div class="card-body">
                                         <input type="button" name="Submit" class="btn btn-primary" onclick="check1();" value="<?php echo ($mod=="add")?"Add":"Update";?>">
                                         &nbsp;
                                         <input type="reset" name="Submit2" class="btn btn-default" value="Clear" /> 
                                     </div>
                                </form>
                            </div>
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
