<?php
        $mod=$_GET['mod']; 
	$page=$_REQUEST['page'];
 global $oracledatabase ;

?>
<script src="iAjax.js"></script>
<script type="text/javascript">

function passwordEntry(){
			changepassword = document.getElementById("check").checked;
			
			if(changepassword==true){
				document.getElementById("password").disabled = false;
				document.getElementById("cpassword").disabled = false ;
				document.getElementById("password").focus();
			}
			else
			{
				document.getElementById("password").value='';
				document.getElementById("cpassword").value==''
				document.getElementById("password").disabled = true;
				document.getElementById("cpassword").disabled = true;
			}
		}
function check1(){
    

    if (checkEmpty('username','pid_username'))
        {
        	document.getElementById('username').focus();
            return false;
        }
        
        else if (checkEmpty('main_username','pid_main_username'))
        {
            document.getElementById('main_username').focus();
            return false;
        }
        // else if (checkEmpty('designation','pid_designation'))
        // {
        // 	document.getElementById('designation').focus();
        //     return false;
        // }
       
        // else if (checkEmpty('permissiontype','pid_permissiontype'))
        // {
        // 	document.getElementById('permissiontype').focus();
        //     return false;
        // }

     else if(!document.getElementById("check") || document.getElementById("check").checked)
      {
  
     if (checkEmpty('password','pid_password'))
        {
        	document.getElementById('password').focus();
            return false;
    }
  
    else if (checkEmpty('cpassword','pid_cpassword'))
        {
        	document.getElementById('cpassword').focus();
            return false;
        }
    else if(password.value!=cpassword.value){

        document.getElementById('pid_password').style.display ="";
            document.getElementById('pid_password').style.color = "red";
            document.getElementById('pid_password').innerHTML = "Password mismatch";
            document.getElementById('password').focus();
            document.getElementById('password').value="";
            document.getElementById('cpassword').value="";
            return false;
    }
    document.getElementById('manual_time_new').submit();
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
					<h1>User Master <?php if($mod=='add'){ echo "Add";}else{ echo "Edit";}?></h1>
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
                <section class="content">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
				<h3 class="card-title">Enter Details</h3>
                            </div>
                            <div class="col-md-7">
                                <form class="form-horizontal" action="user_validate.php" method="post" name="manual_time_new" id="manual_time_new" >
                                    <div class="card-body">
                                        <?php
                                                $userid=$_REQUEST['userid'];
                                                $sql="SELECT * FROM $oracledatabase.".tbl_usermaster." WHERE user_id='{$userid}'";
                                                $res=db_query($sql);
                                                $data=db_fetch_object($res);
                                                $main_username=$data->USER_NAME;
                                                $username=$data->LOGIN_NAME;
                                                // $usertype=$data->user_type;                                               
                                                // $permissiontype=$data->permission_type;
                                               
                                            ?>
                                        <input name="mod" id="mod" value="<?=$mod?>" type="hidden" />	
					<input name="page" value="<?=$page?>" type="hidden" />
                                        <input name="userid" value="<?=$userid?>" type="hidden" />
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-3 control-label">User Name<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="main_username" id="main_username" class="form-control  form-control-sm"  size="32" value="<?php echo $main_username;?>">
                                                <p id='pid_main_username' style="display: none;"></p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-3 control-label">Login User Name<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="username" id="username" class="form-control  form-control-sm"  size="32" value="<?php echo $username;?>">
                                                <p id='pid_username' style="display: none;"></p>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-3 control-label">User Type<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-9">
                                            <select name="designation" id="designation"   class="form-control select2">
						                        <option value="">--select--</option>
						                        <option value="0" <?php if($usertype=='0'){?>selected="selected"<?php }?> >Standard user</option>	
                                                <option value="1" <?php if($usertype=='1'){?>selected="selected"<?php }?>>Administrator</option>							
					                            </select>
                                                <p id='pid_designation' style="display: none;"></p>
                                            </div>
                                        </div> -->
                                       

                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-3 control-label">Password<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password" id="password" class="form-control  form-control-sm"  size="32" value="" autofocus="autofocus" <?php if($mod=="edit") {echo 'disabled="disabled"';} ?>>
                                                <?php if($mod=="edit") {?>
                                               <input name="check" id="check" type="checkbox" onclick="passwordEntry()" tabindex="-1" /> Change password</label>
                                               <?php } ?>
                                               <p id='pid_password' style="display: none;"></p>
                                
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-3 control-label">Confirm Password<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-9">
                                                <input type="password" id="cpassword" name="cpassword" class="form-control  form-control-sm"  size="32" value="" value="" autofocus="autofocus" <?php if($mod=="edit") {echo 'disabled="disabled"';} ?>>
                                              </label>
                                              <p id='pid_cpassword' style="display: none;"></p>
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
