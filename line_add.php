<?php
        $mod=$_GET['mod']; 
	$page=$_REQUEST['page'];
?>
<script src="iAjax.js"></script>
<script type="text/javascript">
function linenocheck()
{
   var a= document.getElementById('lineno').value;
      if(!(a.match(/[a-zA-Z0-9]/)))
   {
       alert("Use Alphanumeric Value For Line Number");
       document.getElementById('lineno').value=''; 
       document.getElementById('lineno').focus(); 
   }
   document.getElementById('branchid').focus(); 
 
}

function locationlist()
{
    
    data="ask=getloc&branch_no="+document.forms.manual_time_new.branchid.value;
    
    iAjax('ajax_getsearch.php?'+data,loc);

}
function loc(result)
{


    document.getElementById('locid').innerHTML=result;

}

function check1(){
    

    if (checkEmpty('lineno','pid_lineno'))
        {
        	document.getElementById('lineno').focus();
            return false;
        }
        else if (checkEmpty('branchid','pid_branchid'))
        {
        	document.getElementById('branchid').focus();
            return false;
        }
        else if (checkEmpty('locid','pid_locid'))
        {
        	document.getElementById('locid').focus();
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
					<h1>Line Master <?php if($mod=='add'){ echo "Add";}else{ echo "Edit";}?></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item "><a href="#">Master</a></li>
						<li class="breadcrumb-item active">Line Master</li>
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
                                <form class="form-horizontal" action="line_validate.php" method="post" name="manual_time_new" id="manual_time_new" >
                                    <div class="card-body">
                                     
                                        	
					<input name="page" value="<?=$page?>" type="hidden" />
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-3 control-label">Line No<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="lineno" id="lineno" class="form-control  form-control-sm" onchange="linenocheck()" size="32" value="">
                                                <p id='pid_lineno' style="display: none;"></p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-3 control-label">Branch<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2" name="branchid" id="branchid" onchange="locationlist()">
                                                    <option value="">--select--</option>
                                                    <?php
                                                        $sql1="SELECT * FROM `branch_master` WHERE `Branch_Del`=0";
                                                        $res1=mysql_query($sql1);
                                                        while ($data1=mysql_fetch_object($res1))
                                                        {
                                                    ?>
                                                    <option value="<?php echo $data1->Branch_Id; ?>"><?php echo $data1->Branch_Name; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                                <p id='pid_branchid' style="display: none;"></p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-3 control-label">Location <font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-9">
                                            <select class="form-control  form-control-sm" name="locid" id="locid">
                                            <option value="">--select--</option>  
                                                </select> 
                                                <p id='pid_locid' style="display: none;"></p>                            
                                               </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-3 control-label">Description<font color="#FF0000" size=""></font> </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="description" id="description" class="form-control  form-control-sm"  size="32" value="<?php echo $Loc_Desc;?>">    
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