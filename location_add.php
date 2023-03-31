<?php

        $mod=$_GET['mod']; 

	$page=$_REQUEST['page'];

?>

<script src="iAjax.js"></script>

<script type="text/javascript">



function check1(){

     if (checkEmpty('locationname','pid_locationname'))
        {
            document.getElementById('locationname').focus();
            return false;
        } 
        else if ( checkEmpty('prefix','pid_prefix') )
        {
            document.getElementById('prefix').focus();
            return false;
        }
		 else if ( checkEmpty('branchid','pid_branchid') )
        {
            document.getElementById('branchid').focus();
            return false;
        }
		  else if ( checkEmpty('NAV_code','pid_NAV_code') )
        {
            document.getElementById('NAV_code').focus();
            return false;
        }
		  else if ( checkEmpty('loc_type','pid_loc_type') )
        {
            document.getElementById('loc_type').focus();
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

					<h1>Location Master <?php if($mod=='add'){ echo "Add";}else{ echo "Edit";}?></h1>

				</div>

				<div class="col-sm-6">

					<ol class="breadcrumb float-sm-right">

						<li class="breadcrumb-item"><a href="index.php">Home</a></li>

						<li class="breadcrumb-item "><a href="#">Master</a></li>

						<li class="breadcrumb-item active">Location Master</li>

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

                            <div class="col-md-6">

                                <form class="form-horizontal" action="location_validate.php" method="post" name="manual_time_new" id="manual_time_new" >

                                    <div class="card-body">

                                        <?php

                                                $locationid=$_REQUEST['locationid'];

                                                $sql="SELECT * FROM locationmaster WHERE Loc_Id='{$locationid}'";

                                                $res=mysql_query($sql);

                                                $data=mysql_fetch_object($res);

                                                $locationname=$data->Loc_Name;

                                                $prefix=$data->Prefix;

                                                $branchid=$data->Branch_Id;

                                                $Loc_Desc=$data->Loc_Desc;
												
												$loc_code=$data->NAV_loc_code;
												
												$loc_type=$data->loc_type;

                                                

                                        ?>

                                        <input name="mod" id="mod" value="<?=$mod?>" type="hidden" />	

					<input name="page" value="<?=$page?>" type="hidden" />

                                        <input name="locationid" value="<?=$locationid?>" type="hidden" />
                                        <div class="form-group row">

                                            <label for="Scrap Value" class="col-sm-3 control-label">Location Name<font color="#FF0000" size="">*</font> </label>

                                            <div class="col-sm-9">

                                                <input type="text" name="locationname" id="locationname" class="form-control form-control-sm"  size="32" value="<?php echo $locationname;?>">
                                                <p id='pid_locationname' style="display: none;"></p>
                                          
                                            </div>

                                        </div>
                                        <div class="form-group row">

                                            <label for="Scrap Value" class="col-sm-3 control-label">Location Prefix<font color="#FF0000" size="">*</font> </label>

                                            <div class="col-sm-9">

                                                <input type="text" name="prefix" id="prefix" class="form-control form-control-sm" onkeyup="this.value=this.value.toUpperCase();"  size="32" value="<?php echo $prefix;?>">
                                                 <p id='pid_prefix' style="display: none;"></p>
                                          
                                            </div>

                                        </div>

                                        
                                        <div class="form-group row">

                                            <label for="Scrap Value" class="col-sm-3 control-label">Branch<font color="#FF0000" size="">*</font> </label>

                                            <div class="col-sm-9">

                                                <select class="form-control select2" name="branchid" id="branchid">

                                                    <option value="">--select--</option>

                                                    <?php

                                                        $sql1="SELECT * FROM `branch_master` WHERE `Branch_Del`=0";

                                                        $res1=mysql_query($sql1);

                                                        while ($data1=mysql_fetch_object($res1)){

                                                        

                                                    ?>

                                                    <option value="<?php echo $data1->Branch_Id; ?>" <?php if($data1->Branch_Id==$branchid){ echo "selected='selected'";}?>><?php echo $data1->Branch_Name; ?></option>

                                                    <?php

                                                        }

                                                    ?>

                                                </select>
                                                  <p id='pid_branchid' style="display: none;"></p>
                                          
                                            </div>

                                        </div>

                                        
                                        <div class="form-group row">

                                            <label for="Scrap Value" class="col-sm-3 control-label">Location Code<font color="#FF0000" size="">*</font></br><font color="#FF0000" size="">(ERP Code)</font></label>

                                            <div class="col-sm-9">

                                                <input type="text" name="NAV_code" id="NAV_code" class="form-control form-control-sm" onkeyup="this.value=this.value.toUpperCase();"  size="32" value="<?php echo $loc_code;?>">
                                                
                                                 <p id='pid_NAV_code' style="display: none;"></p>
                                          
                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label for="Scrap Value" class="col-sm-3 control-label">Location Type<font color="#FF0000" size="">*</font> </label>

                                            <div class="col-sm-9">

                                                <select class="form-control select2" name="loc_type" id="loc_type">

                                                    <option value="">--select--</option>
                                                    <option value="1"<?php if($loc_type=='1'){echo "selected='selected'";}?>>QC Pending</option>
                                                    <option value="2" <?php if($loc_type=='2'){echo "selected='selected'";}?>>Storage</option>
                                                    <option value="3 <?php if($loc_type=='3'){echo "selected='selected'";}?>">Rejection</option>
                                                     <option value="4" <?php if($loc_type=='4'){echo "selected='selected'";}?>>Dispatch</option>
												</select>
                                                  <p id='pid_loc_type' style="display: none;"></p>
                                          
                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label for="Scrap Value" class="col-sm-3 control-label">Description<font color="#FF0000" size=""></font> </label>

                                            <div class="col-sm-9">

                                                <input type="text" name="description" id="description" class="form-control form-control-sm"  size="32" value="<?php echo $Loc_Desc;?>">

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

