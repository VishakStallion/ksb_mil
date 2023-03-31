
<?php
        $mod=$_GET['mod']; 
	$page=$_REQUEST['page'];
        $msg=$_GET['msg'];
	$errmsg=$_GET['errmsg'];
                
        $ucode=$_REQUEST['ucode'];
        $sql="select * from `permission` where `user_id`='$ucode'";
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
                                                                    $sql="SELECT permission.*,usermaster.username,usermaster.user_type FROM `permission` 
                                                                            INNER JOIN usermaster ON usermaster.user_id=permission.user_id
                                                                            WHERE usermaster.User_Del=0 ";
                                                                    $res=mysql_query($sql);
                                                                    while ($data=mysql_fetch_object($res)){
                                                                        $usertype=$data->user_type;
                                                                        ?>
                                                                 <option value="<?php echo $data->user_id?>" <?php if($row->user_id==$data->user_id){echo "selected='selected'";} ?>><?php echo $data->username?></option>
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
									
                                    <div class="row"><!-- first row-MASTER-->
                                        <!--first div-->
                                         <div class="col-sm-4">
                                             <div class="card">
                                                 <div class="card-header" style="background-color: #6D8AB0; color: white;">
                                                     <h3 class="card-title">MASTER</h3>
                                                     <div align="right" >Select All&nbsp;&nbsp;<input type="checkbox" id="master" onclick="goglecheck(this)"></div>
                                                 </div>
                                                 <div class="card-body">
                                                     <table class="table table-striped">
                                                         <tbody>
                                                             <tr>
                                                                 <td style="width: 90%">Vendor Master</td>
                                                                 <td>
                                                                     <input class="checkboxstyle master" type="checkbox" name="m1" id="m1" value="1" <?php if($row->m1==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <!--<tr>
                                                                 <td style="width: 90%">Vendor Location Master</td>
                                                                 <td><input class="checkboxstyle master" type="checkbox" name="m2" id="m2" value="1" <?php if($row->m2==1){ echo "checked";} ?>></td>
                                                             </tr>-->
                                                             
                                                             <tr>
                                                                  <td style="width: 90%">Branch Master</td>
                                                                 <td><input class="checkboxstyle master" type="checkbox" name="m4" id="m4" value="1" <?php if($row->m4==1){ echo "checked";} ?>></td>
                                                             </tr>
                                                             <tr>
                                                                  <td style="width: 90%">Storage Location Master</td>
                                                                 <td><input class="checkboxstyle master" type="checkbox" name="m5" id="m5" value="1" <?php if($row->m5==1){ echo "checked";} ?>></td>
                                                             </tr>
                                                             <tr>
                                                                  <td style="width: 90%">Pallet Master</td>
                                                                 <td><input class="checkboxstyle master" type="checkbox" name="m15" id="m15" value="1" <?php if($row->m15==1){ echo "checked";} ?>></td>
                                                             </tr>
                                                             <tr>
                                                                  <td style="width: 90%">Bin Master</td>
                                                                 <td><input class="checkboxstyle master" type="checkbox" name="m6" id="m6" value="1" <?php if($row->m6==1){ echo "checked";} ?>></td>
                                                             </tr>
                                                             <tr>
                                                                  <td style="width: 90%">Category Master</td>
                                                                 <td><input class="checkboxstyle master" type="checkbox" name="m3" id="m3" value="1" <?php if($row->m3==1){ echo "checked";} ?>></td>
                                                             </tr>
                                                             <tr>
                                                                  <td style="width: 90%">Sub Category Master</td>
                                                                 <td><input class="checkboxstyle master" type="checkbox" name="m12" id="m12" value="1" <?php if($row->m12==1){ echo "checked";} ?>></td>
                                                             </tr>
                                                             <tr>
                                                                  <td style="width: 90%">UOM Master</td>
                                                                 <td><input class="checkboxstyle master" type="checkbox" name="m13" id="m13" value="1" <?php if($row->m13==1){ echo "checked";} ?>></td>
                                                             </tr>
                                                             <tr>
                                                                  <td style="width: 90%">Item Master</td>
                                                                 <td><input class="checkboxstyle master" type="checkbox" name="m7" id="m7" value="1" <?php if($row->m7==1){ echo "checked";} ?>></td>
                                                             </tr>
                                                              <tr>
                                                                  <td style="width: 90%">Customer Master</td>
                                                                 <td><input class="checkboxstyle master" type="checkbox" name="m14" id="m14" value="1" <?php if($row->m14==1){ echo "checked";} ?>></td>
                                                             </tr>
                                                             <tr>
                                                                  <td style="width: 90%">User Master</td>
                                                                 <td><input class="checkboxstyle master" type="checkbox" name="m8" id="m8" value="1" <?php if($row->m8==1){ echo "checked";} ?>></td>
                                                             </tr>
                                                             <tr>
                                                                  <td style="width: 90%">Reason Master</td>
                                                                 <td><input class="checkboxstyle master" type="checkbox" name="m9" id="m9" value="1" <?php if($row->m9==1){ echo "checked";} ?>></td>
                                                             </tr>
                                                            <tr>
                                                                  <td style="width: 90%">Item Receipe Master</td>
                                                                 <td><input class="checkboxstyle master" type="checkbox" name="m10" id="m10" value="1" <?php if($row->m10==1){ echo "checked";} ?>></td>
                                                             </tr>
                                                              <tr>
                                                                  <td style="width: 90%"> FG Label Upload</td>
                                                                 <td><input class="checkboxstyle master" type="checkbox" name="m10" id="m10" value="1" <?php if($row->m10==1){ echo "checked";} ?>></td>
                                                             </tr>
                                                              <tr>
                                                                  <td style="width: 90%">   MRP Master</td>
                                                                 <td><input class="checkboxstyle master" type="checkbox" name="m11" id="m11" value="1" <?php if($row->m11==1){ echo "checked";} ?>></td>
                                                             </tr>
                                                            
                                                         </tbody>
                                                     </table>
                                                 </div>
                                             </div>
											 
											 
											 
											 
											 
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
                                                                     <input class="checkboxstyle utility" type="checkbox" name="p1" id="p1" value="1" <?php if($row->p1==1){ echo "checked";} ?> >
                                                                 </td>
                                                             </tr>
                                                             
                                                             <tr>
                                                                 <td style="width: 90%;">Change Password</td>
                                                                 <td>
                                                                     <input class="checkboxstyle utility" type="checkbox" name="p2" id="p2" value="1" <?php if($row->p2==1){ echo "checked";} ?> >
                                                                 </td>
                                                             </tr>
															   <tr>
                                                                 <td style="width: 90%;">Opening Stock</td>
                                                                 <td>
                                                                     <input class="checkboxstyle utility" type="checkbox" name="p3" id="p3" value="1" <?php if($row->p3==1){ echo "checked";} ?> >
                                                                 </td>
                                                             </tr>
															   <tr>
                                                                 <td style="width: 90%;">Direct Opening Stock</td>
                                                                 <td>
                                                                     <input class="checkboxstyle utility" type="checkbox" name="p5" id="p5" value="1" <?php if($row->p5==1){ echo "checked";} ?> >
                                                                 </td>
                                                             </tr>
															  <tr>
                                                                 <td style="width: 90%;">Barcode Reprint</td>
                                                                 <td>
                                                                     <input class="checkboxstyle utility" type="checkbox" name="p4" id="p4" value="1" <?php if($row->p4==1){ echo "checked";} ?> >
                                                                 </td>
                                                             </tr>
                                                         </tbody>
                                                     </table>
                                                 </div>
                                             </div>
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
                                         </div>


                                        <!--second div-TRANSACTION-->
                                         <div class="col-sm-4">
                                             <div class="card">
                                                 <div class="card-header" style="background-color: #6D8AB0; color: white;">
                                                     <h3 class="card-title">TRANSACTION</h3>
                                                     <div align="right" >Select All&nbsp;&nbsp;<input type="checkbox" id="transcation" onclick="goglecheck(this)"></div>
                                                 </div>
                                                 <div class="card-body">
                                                     <table class="table table-striped">
                                                         <tbody>
                                                             <!--<tr>
                                                                 <td style="width: 90%">Gate Entry With ASN</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i2" id="i2" value="1" <?php if($row->i2==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">Gate Entry Without ASN</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i3" id="i3" value="1" <?php if($row->i3==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>-->
                                                             <tr>
                                                                 <td style="width: 90%">GRN</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i5" id="i5" value="1" <?php if($row->i5==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">QC Confirmation</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i1" id="i1" value="1" <?php if($row->i1==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                            <!-- <tr>
                                                                 <td style="width: 90%">Rejection Entry</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i15" id="i15" value="1" <?php if($row->i15==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">RM Repacking Plan</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i4" id="i4" value="1" <?php if($row->i4==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">Job Order Entry</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i16" id="i16" value="1" <?php if($row->i16==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>-->
                                                             <tr>
                                                                 <td style="width: 90%">Material Issue Entry</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i8" id="i8" value="1" <?php if($row->i8==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">General Material Requisition Entry</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i3" id="i3" value="1" <?php if($row->i3==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">Production Entry</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i6" id="i6" value="1" <?php if($row->i6==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                              <tr>
                                                                 <td style="width: 90%">Inline Rejection Entry</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i17" id="i17" value="1" <?php if($row->i17==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">Production Closing</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i9" id="i9" value="1" <?php if($row->i9==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                              <tr>
                                                                 <td style="width: 90%">Dispatch Entry </td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i12" id="i12" value="1" <?php if($row->i12==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                              <tr>
                                                                 <td style="width: 90%">Transfer Shipment </td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i13" id="i13" value="1" <?php if($row->i13==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                              <tr>
                                                                 <td style="width: 90%">Transfer Receipt </td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i2" id="i2" value="1" <?php if($row->i2==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">Material Issue Cancel</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i10" id="i10" value="1" <?php if($row->i10==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">Dispatch Cancel</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i11" id="i11" value="1" <?php if($row->i11==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                              <tr>
                                                                 <td style="width: 90%">Dispatch Manual Close</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i14" id="i14" value="1" <?php if($row->i14==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>


                                                              <tr>
                                                                 <td style="width: 90%">RPO Item Cancel</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i15" id="i15" value="1" <?php if($row->i15==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                              <tr>
                                                                 <td style="width: 90%">Sale Order Item Cancel</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i16" id="i16" value="1" <?php if($row->i16==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                              <tr>
                                                                 <td style="width: 90%">Transfer Order Item Cancel</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i18" id="i18" value="1" <?php if($row->i18==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                              <tr>
                                                                 <td style="width: 90%">Sales Return Entry</td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i19" id="i19" value="1" <?php if($row->i19==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                           
                                                             <!--
                                                             <tr>
                                                                 <td style="width: 90%">Osp Inward </td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i11" id="i11" value="1" <?php if($row->i11==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>-->
                                                             
                                                            
                                                             
                                                             <!-- <tr>
                                                                 <td style="width: 90%">Dispatch Gate Entry </td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i13" id="i13" value="1" <?php if($row->i13==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
															 
															   <tr>
                                                                 <td style="width: 90%">Dispatch Outward Entry </td>
                                                                 <td>
                                                                     <input class="checkboxstyle transcation" type="checkbox" name="i18" id="i18" value="1" <?php if($row->i18==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>-->
                                                             
                                                         </tbody>
                                                     </table>
                                                 </div>
                                             </div>
											 
											 
											 <div class="card">
                                                 <div class="card-header" style="background-color: #6D8AB0; color: white;">
                                                     <h3 class="card-title">SCANNER</h3>
                                                     <div align="right" >Select All &nbsp;&nbsp;<input type="checkbox" id="scanner" onclick="goglecheck(this)"></div>
                                                 </div>
                                                 <div class="card-body">
                                                     <table class="table table-striped">
                                                         <tbody>
                                                             <tr>
                                                                 <td style="width: 90%">GRN Storage Scan</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s1" id="s1" value="1" <?php if($row->s1==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">Pallet Storage Scan</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s20" id="s20" value="1" <?php if($row->s20==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                                <tr>
                                                                 <td style="width: 90%">Bin To Bin Transfer</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s4" id="s4" value="1" <?php if($row->s4==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">GRN Rejection Scan</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s3" id="s3" value="1" <?php if($row->s3==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">Rejection Removal Scanning</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s11" id="s11" value="1" <?php if($row->s11==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">Purchase Return Scan</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s2" id="s2" value="1" <?php if($row->s2==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                             <tr>
                                                                 <td style="width: 90%">RM Issue Scan</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s5" id="s5" value="1" <?php if($row->s5==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">General Material Issue Scan</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s19" id="s19" value="1" <?php if($row->s19==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">Production Storage Scan</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s6" id="s6" value="1" <?php if($row->s6==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">Production Rejection Scan</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s7" id="s7" value="1" <?php if($row->s7==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">RM Return Scan</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s10" id="s10" value="1" <?php if($row->s10==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                              <tr>
                                                                 <td style="width: 90%">General Item Return Scan</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s18" id="s18" value="1" <?php if($row->s18==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
															 <tr>
                                                                 <td style="width: 90%">Dispatch Picklist Scan</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s9" id="s9" value="1" <?php if($row->s9==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                              <tr>
                                                                 <td style="width: 90%"> Dispatch Confirmation Scan</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s8" id="s8" value="1" <?php if($row->s8==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                            
                                                            <tr>
                                                                 <td style="width: 90%"> Transfer Picklist Scan</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s15" id="s15" value="1" <?php if($row->s15==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                              <tr>
                                                                 <td style="width: 90%"> Transfer Confirmation Scan</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s16" id="s16" value="1" <?php if($row->s16==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                            

                                                             <tr>
                                                                 <td style="width: 90%"> Opening Storage Scan</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s14" id="s14" value="1" <?php if($row->s14==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                            
                                                             <tr>
                                                                 <td style="width: 90%"> Sales Return</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s12" id="s12" value="1" <?php if($row->s12==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                             <tr>
                                                                 <td style="width: 90%"> Stock Out</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s13" id="s13" value="1" <?php if($row->s13==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                               <tr>
                                                                 <td style="width: 90%"> Reprocess Rejection Scan</td>
                                                                 <td>
                                                                     <input class="checkboxstyle scanner" type="checkbox" name="s17" id="s17" value="1" <?php if($row->s17==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                            
                                                         </tbody>
                                                     </table>
                                                 </div>
                                             </div>
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
                                         </div>
                                   
                                        <!--third div-->
                                         <div class="col-sm-4">
                                             <div class="card">
                                                 <div class="card-header" style="background-color: #6D8AB0; color: white;">
                                                     <h3 class="card-title">REPORTS</h3>
                                                     <div align="right" >Select All&nbsp;&nbsp;<input type="checkbox" id="report" onclick="goglecheck(this)"></div>
                                                 </div>
                                                 <div class="card-body">
                                                     <table class="table table-striped">
                                                         <tbody>
                                                        
                                                             <tr>
                                                                 <td style="width: 90%">GRN Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r2" id="r2" value="1" <?php if($row->r2==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                       <!--      <tr>
                                                                 <td style="width: 90%">QC Checking Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r6" id="r6" value="1" <?php if($row->r6==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>-->
                                                             
                                                             <tr>
                                                                 <td style="width: 90%">Stock Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r8" id="r8" value="1" <?php if($row->r8==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>


                                                             <tr>
                                                                 <td style="width: 90%">Purchase Return Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r30" id="r30" value="1" <?php if($row->r30==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             

                                                              <tr>
                                                                 <td style="width: 90%">Barcode History Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r20" id="r20" value="1" <?php if($row->r20==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                          
                                                             <tr>
                                                                 <td style="width: 90%">Storage Scan Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r17" id="r17" value="1" <?php if($row->r17==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                             <!--   <tr>
                                                                 <td style="width: 90%">RTV Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r7" id="r7" value="1" <?php if($row->r7==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>-->
                                                             
                                                             <tr>
                                                                 <td style="width: 90%">Bin To Bin Stock Transfer Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r15" id="r15" value="1" <?php if($row->r15==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                             <tr>
                                                                 <td style="width: 90%">QC Confirmation Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r19" id="r19" value="1" <?php if($row->r19==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                              <tr>
                                                                 <td style="width: 90%">RPO Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r38" id="r38" value="1" <?php if($row->r38==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
															 
															  <tr>
                                                                 <td style="width: 90%">RPO Pending Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r39" id="r39" value="1" <?php if($row->r39==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                               <tr>
                                                                 <td style="width: 90%">Material Issue Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r35" id="r35" value="1" <?php if($row->r35==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
															  <tr>
                                                                 <td style="width: 90%">Material Issue Scan Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r36" id="r36" value="1" <?php if($row->r36==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
															 
															  <tr>
                                                                 <td style="width: 90%">Material Issue Pending Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r37" id="r37" value="1" <?php if($row->r37==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                               <tr>
                                                                 <td style="width: 90%">Material Requisition Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r4" id="r4" value="1" <?php if($row->r4==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>

                                                               <tr>
                                                                 <td style="width: 90%">General Material Issue Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r16" id="r16" value="1" <?php if($row->r16==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                              <tr>
                                                                 <td style="width: 90%">General Material Issue Scan Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r26" id="r26" value="1" <?php if($row->r26==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                            
                                                             
                                                            <!-- <tr>
                                                                 <td style="width: 90%">Job Order Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r9" id="r9" value="1" <?php if($row->r9==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">Job Order Pending Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r10" id="r10" value="1" <?php if($row->r10==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                             <tr>
                                                                 <td style="width: 90%">Route Card Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r11" id="r11" value="1" <?php if($row->r11==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>-->
                                                              
<!--                                                             <tr>
                                                                 <td style="width: 90%">Job Work Plan Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r3" id="r3" value="1" <?php if($row->r3==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">Job Work Receipt Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r4" id="r4" value="1" <?php if($row->r4==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                             <tr>
                                                                 <td style="width: 90%">Route Card Scan Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r27" id="r27" value="1" <?php if($row->r27==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>-->
                                                             
                                                            
                                                             
                                                             <tr>
                                                                 <td style="width: 90%">Production Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r12" id="r12" value="1" <?php if($row->r12==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
															 
															  <tr>
                                                                 <td style="width: 90%">Production Scan Pending Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r22" id="r22" value="1" <?php if($row->r22==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                           <tr>
                                                                 <td style="width: 90%">Production Scan Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r18" id="r18" value="1" <?php if($row->r18==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                              <tr>
                                                                 <td style="width: 90%">RM Return Scan Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r5" id="r5" value="1" <?php if($row->r5==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                              <!-- <tr>
                                                                 <td style="width: 90%">Production Scan Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r31" id="r31" value="1" <?php if($row->r31==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>-->
                                                             
                                                               <tr>
                                                                 <td style="width: 90%">Rejection Scan Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r32" id="r32" value="1" <?php if($row->r32==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="width: 90%">Inline Rejection Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r33" id="r33" value="1" <?php if($row->r33==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                              <tr>
                                                                 <td style="width: 90%">Inline Rejection Scan Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r34" id="r34" value="1" <?php if($row->r34==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                              <!-- <tr>
                                                                 <td style="width: 90%">Rejection Scan Confirmation Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r33" id="r33" value="1" <?php if($row->r33==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
															  <tr>
                                                                 <td style="width: 90%">Rejection Scan Confirmation Pending Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r34" id="r34" value="1" <?php if($row->r34==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>-->
                                                             
                                                             
                                                            <!-- <tr>
                                                                 <td style="width: 90%">Outward Process Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r13" id="r13" value="1" <?php if($row->r13==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                             <tr>
                                                                 <td style="width: 90%">OSP Out Gate Entry Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r14" id="r14" value="1" <?php if($row->r14==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                             <tr>
                                                                 <td style="width: 90%">OSP In Gate Entry Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r20" id="r20" value="1" <?php if($row->r20==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                             
                                                              <tr>
                                                                 <td style="width: 90%">OSP Inward Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r24" id="r24" value="1" <?php if($row->r24==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                             <tr>
                                                                 <td style="width: 90%">OSP Inward Scan Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r25" id="r25" value="1" <?php if($row->r25==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>-->
                                                                   <tr>
                                                                 <td style="width: 90%">Dispatch Order Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r6" id="r6" value="1" <?php if($row->r6==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                             <tr>
                                                                 <td style="width: 90%">Dispatch Pending Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r7" id="r7" value="1" <?php if($row->r7==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                            <tr>
                                                                 <td style="width: 90%">Dispatch Plan Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r9" id="r9" value="1" <?php if($row->r9==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                      
                                                         
                                                             
                                                             <tr>
                                                                 <td style="width: 90%">Dispatch Scan Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r10" id="r10" value="1" <?php if($row->r10==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                               
                                                             <tr>
                                                                 <td style="width: 90%">Dispatch Scan Pending Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r14" id="r14" value="1" <?php if($row->r14==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                               <tr>
                                                                 <td style="width: 90%">Dispatch Confirmation Scan Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r11" id="r11" value="1" <?php if($row->r11==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                               <tr>
                                                                 <td style="width: 90%">Dispatch Confirmation Scan Pending Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r13" id="r13" value="1" <?php if($row->r13==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>

                                                              <tr>
                                                                 <td style="width: 90%">Transfer Entry Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r3" id="r3" value="1" <?php if($row->r3==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                             <tr>
                                                                 <td style="width: 90%">Transfer Order Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r21" id="r21" value="1" <?php if($row->r21==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                             
                                                             <tr>
                                                                 <td style="width: 90%">Opening Stock Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r23" id="r23" value="1" <?php if($row->r23==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                               
                                                             <tr>
                                                                 <td style="width: 90%">Transfer Receipt Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r24" id="r24" value="1" <?php if($row->r24==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                             
                                                                <tr>
                                                                 <td style="width: 90%">Sales Return Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r25" id="r25" value="1" <?php if($row->r25==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
                                                             
                                                               <tr>
                                                                 <td style="width: 90%">Stockout Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r29" id="r29" value="1" <?php if($row->r29==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>

                                                             <tr>
                                                                 <td style="width: 90%">Nav Details Report</td>
                                                                 <td>
                                                                     <input class="checkboxstyle report" type="checkbox" name="r40" id="r40" value="1" <?php if($row->r40==1){ echo "checked";} ?>>
                                                                 </td>
                                                             </tr>
															 
															 
															 
															 
                                                             
                                                             
                                                         </tbody>
                                                     </table>
                                                 </div>
                                             </div>
                                         </div>
                                  
                                    
                                        
                                    </div><!-- first row-->
                                    <div class="col-sm-4">
                                        <div class="row">
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
