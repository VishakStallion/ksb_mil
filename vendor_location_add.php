<?php
        $mod=$_GET['mod']; 
	$page=$_REQUEST['page'];
?>
<script type="text/javascript">
	function int(id)
	{
		var field=document.getElementById(id);
		
		if (checkInteger('zip','pid_zip'))
        {
            document.getElementById('zip').focus();
        }
		/*if (isNaN(id.value))
		{
			alert ("Please Enter a Numeric value");
                        id.value='';
			id.focus();
		}*/
	}
	function check()
	{ 
		if (checkEmpty('vencode','pid_vencode'))
        {
            document.getElementById('vencode').focus();
            return false;
        } 
	/*	if(document.manual_time_new.vencode.value=='')
		{
			alert("Please select a vendor");
			document.manual_time_new.vencode.focus();
		}*/
		/*else if(checkEmpty('loc_code','pid_vencode'))
		{
			alert("Enter a Location code");
			document.manual_time_new.loc_code.focus();
		}*/
		else if (checkEmpty('loc_code','pid_loc_code'))
        {
            document.getElementById('loc_code').focus();
            return false;
        } 
        else if (checkEmpty('address1','pid_address1'))
        {
            document.getElementById('address1').focus();
            return false;
        } 
        else if (checkEmpty('city','pid_city'))
        {
            document.getElementById('city').focus();
            return false;
        } 
      
       else if (checkEmpty('state','pid_state'))
        {
            document.getElementById('state').focus();
            return false;
        } 
        else if (checkEmpty('zip','pid_zip'))
        {
            document.getElementById('zip').focus();
            return false;
        } 
         else if (checkInteger('zip','pid_zip'))
        {
            document.getElementById('zip').focus();
        }
      
    
		else
		{
			document.manual_time_new.submit();
		}
	}
</script>
<div id="content_inner">
  	<div class="page_header">
	<div id="search"></div></div></div>
    <div id="quick_access_overview"></div>
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
                                        <h1>Vendor Location Master <?php if($mod=='add'){ echo "Add";}else{ echo "Edit";}?></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item "><a href="#">Master</a></li>
						<li class="breadcrumb-item active">Vendor Master</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
		
		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<!-- SELECT2 EXAMPLE -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Enter Details</h3>
					</div>
					
					
					
					<?php
						
						
						
						if($mod=="edit")
						{
							$venloccode=$_REQUEST['vendorlocid'];
                                                        $sql="SELECT * FROM `vendor_location_master` WHERE `Vendor_Loc_Id`='$venloccode'  AND Vendor_Loc_Del=0";
							$ret=mysql_query($sql);
							$row=mysql_fetch_object($ret);
                                                        
							$Vendor_Id=$row->Vendor_Id;
                                                        $Vendor_Loc_Code=$row->Vendor_Loc_Code;
                                                        $Address_Line1=$row->Address_Line1;
                                                        $Address_Line2=$row->Address_Line2;
                                                        $Address_Line3=$row->Address_Line3;
                                                        $City=$row->City;
                                                        $State=$row->State;
                                                        $Zip=$row->Zip;
                                                       
						}
						if($mod=="add")
						{
							$sql="select max(Vendor_Id) as maxvendor from vendormaster";
							$ret=mysql_query($sql);	
							$row=mysql_fetch_object($ret);	 
							if(mysql_num_rows($ret))
							{
								$vencode.=$row->maxvendor+1;
							}
						}
					?>  
					
					
					<!-- /.card-header -->
					<div class="col-md-12">
                                            <form class="form-horizontal" action="vendor_location_validate.php" method="post" name="manual_time_new" id="manual_time_new" >
							<div class="card-body">
                                                            <input name="mod" value="<?=$mod?>" type="hidden" />	
                                                            <input name="page" value="<?=$page?>" type="hidden" />	
                                                            <input name="loc_id" value="<?=$venloccode?>" type="hidden" />	
								<div class="form-group row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label for="Scrap Value" class="col-sm-3 control-label">Vendor Name<font color="#FF0000" size="">*</font> </label>
                                                                            <div class="col-sm-9">
                                                                                <select class="form-control select2"  name="vencode"  id="vencode" >
                                                                                    <option value="">--Select--</option>
                                                                                    <?php
                                                                                    $sql1="SELECT * FROM vendormaster WHERE Vendor_Del=0 ORDER BY Vendor_Name";
                                                                                    $res1=mysql_query($sql1);
                                                                                    while($data1=mysql_fetch_object($res1)){
                                                                                        ?>
                                                                                    <option value="<?php echo $data1->Vendor_Id; ?>" <?php if($Vendor_Id==$data1->Vendor_Id){ echo "selected='selected'";} ?>><?php echo $data1->Vendor_Name; ?></option>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                    </select>
                                                                                     <p id='pid_vencode' style="display: none;"></p>
                                           
                                                                                    
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="Scrap Value" class="col-sm-3 control-label">Address Line 1<font color="#FF0000" size="">*</font> </label>
                                                                            <div class="col-sm-9">
                                                                                <input name="address1" id="address1" size="32" class="form-control  form-control-sm" value="<?php echo $Address_Line1 ?>">
                                                                             <p id='pid_address1' style="display: none;"></p>
                                           
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="Scrap Value" class="col-sm-3 control-label">Address Line 2<font color="#FF0000" size=""></font> </label>
                                                                            <div class="col-sm-9">
                                                                                <input name="address2" id="address2" size="32" class="form-control  form-control-sm" value="<?php echo $Address_Line2 ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="Scrap Value" class="col-sm-3 control-label">Address Line 3<font color="#FF0000" size=""></font> </label>
                                                                            <div class="col-sm-9">
                                                                                <input name="address3" id="address3" size="32" class="form-control  form-control-sm" value="<?php echo $Address_Line3 ?>">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>	
                                                            
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group row">
                                                                            <label for="Scrap Value" class="col-sm-3 control-label">Location Code<font color="#FF0000" size="">*</font> </label>
                                                                            <div class="col-sm-9">
                                                                                <input name="loc_code" id="loc_code" size="32" class="form-control  form-control-sm" value="<?php echo $Vendor_Loc_Code; ?>">
                                                                            <p id='pid_loc_code' style="display: none;"></p>
                                           
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="Scrap Value" class="col-sm-3 control-label">City<font color="#FF0000" size="">*</font> </label>
                                                                            <div class="col-sm-9">
                                                                                <input name="city" id="city" size="32" class="form-control  form-control-sm" value="<?php echo $City ?>">
                                                                             <p id='pid_city' style="display: none;"></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="Scrap Value" class="col-sm-3 control-label">State<font color="#FF0000" size="">*</font> </label>
                                                                            <div class="col-sm-9">
                                                                                <input name="state" id="state" size="32" class="form-control" value="<?php echo $State ?>">
                                                                             <p id='pid_state' style="display: none;"></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="Scrap Value" class="col-sm-3 control-label">ZIP Code<font color="#FF0000" size="">*</font> </label>
                                                                            <div class="col-sm-9">
                                                                                <input name="zip" id="zip" size="32" class="form-control  form-control-sm" onkeyup="int(zip)" value="<?php echo $Zip ?>">
                                                                             <p id='pid_zip' style="display: none;"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
							</div>
                                                    <div class="card-body">
                                                        <input type="button" name="Submit" class="btn btn-primary" onclick="check();" value="<?php echo ($mod=="add")?"Add":"Update";?>">
                                                        &nbsp;
                                                        <input type="reset" name="Submit2" class="btn btn-default" value="Clear" /> 
                                                    </div>
						</form>
						
						<!-- /.col -->
					</div>
					<!-- /.row -->
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