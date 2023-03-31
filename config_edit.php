<?php
        $mod=$_GET['mod']; 
	$page=$_REQUEST['page'];
?>
<script src="iAjax.js"></script>
<script type="text/javascript">
 function check1(){
     if(document.getElementById('companyname').value==''){
         alert('Please enter company name');
         return false;
     }
     else if(document.getElementById('bgimg').value==''){
         alert("must select a back ground image");
         return false;
     }
     else if(document.getElementById('icon').value==''){
         alert('must select a icon image');
         return false;
     }
     else if(document.getElementById('logimg').value==''){
         alert('must select a login image');
         return false;
     }
     else if(document.getElementById('favicon').value==''){
         alert('must select a fav icon');
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
					<h1>Configuration Master <?php if($mod=='add'){ echo "Add";}else{ echo "Edit";}?></h1>
				</div>
				
			</div>
		</div><!-- /.container-fluid -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
				<h3 class="card-title">Enter Details</h3>
                            </div>
                            <div class="col-md-6">
                                <form class="form-horizontal" action="configuration_validate.php" method="post" name="manual_time_new" id="manual_time_new" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <?php
                                                
                                        ?>
                                        <input name="mod" id="mod" value="<?=$mod?>" type="hidden" />	
					<input name="page" value="<?=$page?>" type="hidden" />
                                        <!--<input name="branchid" value="<?=$branchid?>" type="hidden" />-->
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-3 control-label">Company Name <font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="companyname" id="companyname" class="form-control"  size="32" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-3 control-label">Background Image<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-9">
                                                <input type="file" name="bgimg" id="bgimg" class="form-control"  size="32" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-3 control-label">Main Icon<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-9">
                                                 <input type="file" name="icon" id="icon" class="form-control"  size="32" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-3 control-label">Login Image<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-9">
                                                 <input type="file" name="logimg" id="logimg" class="form-control"  size="32" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-3 control-label">Fav Icon<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-9">
                                                 <input type="file" name="favicon" id="favicon" class="form-control"  size="32" value="">
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
