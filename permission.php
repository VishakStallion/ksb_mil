
<?php
 global $oracledatabase ;

        $mod=$_GET['mod']; 
	$page=$_REQUEST['page'];
        $msg=$_GET['msg'];
	$errmsg=$_GET['errmsg'];
                
        $ucode=$_REQUEST['ucode'];
        $sql="select * from $oracledatabase.".tbl_permission." where user_id='$ucode'";
	$ret=db_query($sql);
	$row=db_fetch_object($ret);
?>
<script src="iAjax.js"></script>

<script type="text/javascript">
    function resetform(){
        window.location.href='permission';
    }
    
    function saveform(){

        
        if (checkEmpty('userid','pid_userid'))
        {
        	document.getElementById('userid').focus();
            return false;
        }
        else{
            document.getElementById('manual_time_new').submit();
        }
    }
    
    function goglecheck(that){
        var chk=document.getElementsByClassName(that.id);
        if(that.checked==true){
            for (x in chk) {
                if(chk[x].id==undefined){
                   
                    continue;
                }
                document.getElementById(chk[x].id).checked=true;
            }
        }
        if(that.checked==false){
            for (x in chk) {
                if(chk[x].id==undefined){
                    continue;
                }
                document.getElementById(chk[x].id).checked=false;
            }
        }
        
    }
    
    function goglecheckload(that){
        var chk=document.getElementsByClassName(that);
       var flag=1;
            for (x in chk) {
                if(chk[x].id==undefined){
                   
                    continue;
                }
                if(document.getElementById(chk[x].id).checked==false){
                    flag=0;
                }
            }
  
     if(flag==1){
         document.getElementById(that).checked=true;
     }
        
    }
         function loaddata(){
             goglecheckload('master');
            //  goglecheckload('transcation');
            //  goglecheckload('report');
             goglecheckload('utility');
            //  goglecheckload('scanner');
         }
         
         $(document).ready(function() {
             loaddata();
         });
</script>
<style>
    .checkboxstyle{
        width: 15px;
        height: 15px;
    }
</style>
<div class="content-header">
     <div class="container-fluid">
	<div class="row mb-2">
            <div class="col-sm-6">
                <h1>User Permission </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item "><a href="#">Utility</a></li>
                    <li class="breadcrumb-item active">User Permission</li>
                </ol>
            </div>
        </div>
     </div><!-- /.container-fluid -->		
    <section class="content">
        
        <?php if($msg!='' or $errmsg!=''){?>
			<div class="alert alert-<?php if($_GET['msg']) echo 'success'; if($_GET['errmsg']) echo 'danger'; ?>  alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="fa  fa-info" style="margin-right:0.5em;"></i>
				<?php if($_GET['msg']) echo $msg; else echo $errmsg;?>
			</div>
		<?php } ?>
        
                    <div class="container-fluid">
                        <div class="col-sm-12">
                                <form class="form-horizontal" action="permission_validate.php" method="post" name="manual_time_new" id="manual_time_new" >
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="col-sm-6">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <label for="Scrap Value" class="col-sm-3 control-label">User Name<font color="#FF0000" size="">*</font> </label>
                                                        <div class="col-sm-9">
                                                            <select  class="form-control select2" name="userid" id="userid" onchange="window.location.href='permission&ucode='+(this.value) ">
                                                                <option value="">--select--</option>
                                                                <?php
                                                                    $usertype=0;
                                                                    $sql="SELECT DISTINCT $oracledatabase.".tbl_permission.".*,$oracledatabase.".tbl_usermaster.".USER_NAME,$oracledatabase.".tbl_usermaster.".STATUS FROM $oracledatabase.".tbl_permission." 
                                                                            INNER JOIN $oracledatabase.".tbl_usermaster." ON $oracledatabase.".tbl_usermaster.".USER_ID=$oracledatabase.".tbl_permission.".USER_ID
                                                                            WHERE 1=1 ";

                                                                    $res=db_query($sql);
                                                                    while ($data=db_fetch_object($res)){
                                                                        $usertype=$data->STATUS;
                                                                        ?>
                                                                 <option value="<?php echo $data->USER_ID?>" <?php if($row->USER_ID==$data->USER_ID){echo "selected='selected'";} ?>><?php echo $data->USER_NAME?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </select>

                                                            <p id='pid_userid' style="display: none;"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                         </div>
<!--                                    </div>
                                    <div class="card">-->
									
                                    <div class="row d-flex justify-content-around mt-3"><!-- first row-MASTER-->
                                        <!--first div-->
                                         <div class="col-sm-4">
                                             <div class="card">
                                                 <div class="card-header" style="background-color: #6D8AB0; color: white;">
                                                     <h3 class="card-title">MASTER/TRANSCTION</h3>
                                                     <div align="right" >Select All&nbsp;&nbsp;<input type="checkbox" id="master" onclick="goglecheck(this)"></div>
                                                 </div>
                                                 <div class="card-body">
                                                     <table class="table table-striped">
                                                         <tbody>
                                                             <tr>
                                                                 <td style="width: 90%">Device Master</td>
                                                                 <td>
                                                                     <input class="checkboxstyle master" type="checkbox" name="M1" id="m1" value="1" <?php if($row->M1==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>

                                                             <tr>
                                                                  <td style="width: 90%">User Master</td>
                                                                 <td><input class="checkboxstyle master" type="checkbox" name="M2" id="m2" value="1" <?php if($row->M2==1){ echo "checked";} ?>></td>
                                                             </tr>
                                                          
                                                             <tr>
                                                                  <td style="width: 90%">Stamping</td>
                                                                 <td><input class="checkboxstyle master" type="checkbox" name="M3" id="M3" value="1" <?php if($row->M3==1){ echo "checked";} ?>></td>
                                                             </tr>
                                                            
                                                         </tbody>
                                                     </table>
                                                 </div>
                                             </div>
                                             </div>
											 
											 
											 
											 
											 <div class="col-sm-4">
											  <div class="card">
                                                 <div class="card-header" style="background-color: #6D8AB0; color: white;">
                                                     <h3 class="card-title">UTILITY</h3>
                                                     <div align="right" >Select All&nbsp;&nbsp;<input type="checkbox" id="utility" onclick="goglecheck(this)"></div>
                                                 </div>
                                                 <div class="card-body">
                                                     <table class="table table-striped">
                                                         <tbody>
                                                             <tr style="<?php if( $ucode==1){ ?> display: none;<?php } ?>">
                                                                 <td style="width: 90%;">User Permission</td>
                                                                 <td>
                                                                     <input class="checkboxstyle utility" type="checkbox" name="P1" id="p1" value="1" <?php if($row->P1==1){ echo "checked";} ?> >
                                                                 </td>
                                                             </tr>
                                                             
                                                           
                                                         </tbody>
                                                     </table>
                                                 </div>
                                             </div>
											 
											 
											 
											 
                                         </div>
                                        
                                    </div><!-- first row-->
                                   
                                        <div class="row">
                                        <div class="col-sm-4">
                                            <!--<div class="card">-->
                                                <div class="card-body">
                                                    <input type="button" value="Save" class="btn btn-primary" onclick="saveform();">
                                                    <input type="reset" value="Cancel" class="btn btn-default" onclick="resetform();">
                                                </div>
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    </div>
                                </form>
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
