<?php
$msg = $_GET['msg'];
$production_no = $_GET['production_no'];
$emp_id = $_SESSION['SESS_STU_ADMINID'];
$fg_item = $_REQUEST['fg_item'];
$Menu_Id=$_REQUEST['m'];
$msg = ($_REQUEST['error_msg'])? $_REQUEST['error_msg'] : $_REQUEST['success_msg'];
?>
<style>
/*input.loading{
	background-repeat: no-repeat;
	background-image: url("common/images/ajax_clock_small.gif");
	background-position: right center;
}
input.invalid{
	//background-color: #FFEDED;
	//border-color: #F00000;
}
.table.wrapper{
}
.table.wrapper select{
	width: 218px;
}
.table.wrapper select.fullwidth{
	width: 596px;
}
table.table_small tbody tr:hover{
	background: #C8D7A6;
}*/
</style>
<script src="iAjax.js"></script>
<script>
function f_dob(){
	gfPop.fStartPop(document.manual_time_new.date,Date);
}

document.onkeydown = checkKeycode 
var keycode;      
function checkKeycode(e)     
{	
	if (window.event) keycode = window.event.keyCode; 
	else if (e) keycode = e.which; 
} 

function submitForm(){

	var count = document.getElementById('count').value;
	var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
	if(document.forms.manual_time_new.date.value==''){
		document.forms.manual_time_new.date.focus();
		alert("Select QC date");
		return false;
	}
	else if(document.forms.manual_time_new.qc_no.value==''){
		document.forms.manual_time_new.qc_no.focus();
		alert("QC Number is empty,Please check the details ");
		return false;
	}
	else if(document.forms.manual_time_new.fg_item_serial.value==''){
		document.forms.manual_time_new.fg_item_serial.focus();
		alert("Please enter FG item serial number");
		return false;
	} 

	else if(count!=checkboxes.length){
		alert("Some QC parameters are not verified.Please check the details");
		return false;
	}
	else{
		document.forms.manual_time_new.submit();
		document.getElementById('Submit').disabled=true;
	}
	
}

function checkSerialNo()
{
	var serial_no = document.manual_time_new.elements.serial_no.value;
	iAjax("assembly_ajax.php?act=checkSerialNo&serial_no="+serial_no,checkSerialNo_success01);
}
function checkSerialNo_success01(result)
{
	if(result=='1'){
		alert("This serial number is already exists.Please check with another one");
		document.manual_time_new.elements.serial_no.focus();
	}
	
}
function roundNumber(num, dec) {
	var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	return result;
}
function validate_fgitem(){
	if(document.getElementById('timestamp').value==''){
		document.getElementById('timestamp').value='<?=date('Y-m-d H:i:s')?>';
	}
	var fg_item_serial= document.getElementById('fg_item_serial').value;
	iAjax("assembly_ajax.php?act=check_fgitem_QC&fg_item_serial="+fg_item_serial,validate_success01);
}
function validate_success01(result){//alert(result);
	if(result=='0'){
		alert('Invalid barcode or QC already done aganist this serial number');
		document.getElementById('fg_item_serial').value='';
		document.getElementById('fg_item_serial').focus();
	}
	else if(result=='2'){
		alert('QC already done aganist this serial number.Please do rework');
		document.getElementById('fg_item_serial').value='';
		document.getElementById('fg_item_serial').focus();
	}
	else{
		validate_fgitem1();
	}
	
}
function validate_fgitem1(){
	var fg_item_serial= document.getElementById('fg_item_serial').value;
	iAjax("assembly_ajax.php?act=check_fgitem&fg_item_serial="+fg_item_serial,validate_success02);
}
function validate_success02(result){
	if(result==0){
		alert('Invalid serial number or QC parameter not exists for this FG item.Please check the serial number');
		document.getElementById('fg_item_serial').value='';
		document.getElementById('fg_item_serial').focus();
		
	}
	else{
		'$fg_item='+result;
		document.getElementById('fg_item').value=result;
		get_productiondetails();
	}
}
function get_productiondetails(){
	var fg_item_serial= document.getElementById('fg_item_serial').value;
	iAjax("assembly_ajax.php?act=getProduction&fg_item_serial="+fg_item_serial,productn_success01);
}
function productn_success01(result){
	if(result){
		document.getElementById('prdctn_tr').innerHTML=result;
		
		qc_parameter();
	}
}
function qc_parameter(){
	fg_item = document.getElementById('fg_item').value;
	production_id=document.getElementById('production_id').value;
	iAjax("assembly_ajax.php?act=qc_parameter&fg_item="+fg_item+'&production_id='+production_id,qc_parameter_success01);
}
function qc_parameter_success01(result){
	document.getElementById('qc_parameter').style.display='';
	document.getElementById('qc_parameter').innerHTML=result;
}

function ckChange(ckType){
	var ckName = document.getElementsByName(ckType.name);
    var checked = document.getElementById(ckType.id);
	if (checked.checked) {
		 for(var i=0; i < ckName.length; i++){
		 	if(!ckName[i].checked){
              ckName[i].disabled = true;
          }else{
              ckName[i].disabled = false;
		 }
		 
	}
	}
	else {
      for(var i=0; i < ckName.length; i++){
        ckName[i].disabled = false;
      } 
    }   
}
</script>
<div id="content_inner">
<div class="page_header">
<h2>Production QC</h2>
<div id="search"></div></div> 
<div id="quick_access_overview"></div>
<div class="form_container" style="width:800px">
<form action="assembly_productn_qc_validate.php" method="post" name="manual_time_new" id="manual_time_new" class="generic">
    <input name="page" value="<?=$page?>" type="hidden"/>	
    <input name="m" value="<?=$Menu_Id?>" type="hidden" />	
    <input name="sm" value="<?=$sm?>" type="hidden" />
    <textarea  name="sno1" id="sno1"  style="display:none;" ></textarea>
    <textarea  name="iid1" id="iid1"  style="display:none;"></textarea>
    <textarea  name="SidQty1" id="SidQty1" style="display:none;"></textarea>
    <textarea  name="remark1" id="remark1"  style="display:none;"></textarea>
    <input type="hidden" name="totqty" id="totqty">
    <input name="sesver" value="<?=$sesver?>" type="hidden" />
    <input name="fg_item" id="fg_item" type="hidden">
	<input name="timestamp" id="timestamp" type="hidden">
	<table  width="100%" border=0 class="table wrapper">
		<tr>
			<td colspan=4><font color="#FF0000"><b> <?php if($msg){echo $msg/*.' with production number '.$production_no*/;}?></b></font></td>
		</tr>
<?php

	  $yr=date("y");
      $nm='/';
      $m=date("m");
      $prefix='IMQ'.$yr.$m;
      $len=strlen($prefix);

	$sql1="SELECT CONCAT('$prefix',LPAD(max_qc_number+1,GREATEST(3,LENGTH(max_qc_number+1)),'0')) qc_number FROM
	(SELECT IFNULL( MAX(CAST( SUBSTRING(`qc_number`,$len+1) AS SIGNED)),'0') max_qc_number FROM  assembly_productn_qc WHERE qc_number LIKE '$prefix%') p2";
	$res1=mysql_query($sql1);
	$data1=mysql_fetch_object($res1);
	 $somax=$data1->qc_number;	 
	 
	?>
	
	<tr>
			<td><strong>Date:<font color="#FF0000">*</font></strong>
			<td>
				<input type="text"  name="date" class="tb8" id="date" value="<?=date('d-m-Y')?>" readonly/>
				<a href="javascript:void(0)" onclick="javascript:f_dob();return false;" hidefocus="">
				<img name="popcal" align="absmiddle" src="./common/images/calbtn.gif" width="34" height="22" border="0"></a></td>
			
			<td><b>QC Number:<font color="#FF0000">*</font></b></td>
			<td><input type="text" name="qc_no"  value="<?=$somax?>" class="tb8" readonly title="return entry number" id="qc_no"/></td>
			
			
			
		</tr>
        <tr>
        <td><strong>FG Item Serial:<font color="#FF0000">*</font></strong></td>
        <td><input type="text" name="fg_item_serial"  value="<?=$fg_item_serial?>" class="tb8" title="return entry number" id="fg_item_serial" onChange="validate_fgitem()" style="width: 238px;height: 15px;"/></td>
        </tr>
        
        <table id="prdctn_tr" ></table></table><br/>
        <table style="display:none;" id="qc_parameter"><tr></tr></table>
  <br/>  <br/> 
  <table width="98%" height="26" border="0" cellpadding="0" cellspacing="0" class="table" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px">
	 <tr align="left">
       <td height="22" colspan="3" ><b>Remarks:</b>&nbsp; <br />
       <textarea name="remarksall" id="remarksall" align="right" style="    margin: 0px;height: 105px; width: 289px;"></textarea></td><td height="22">&nbsp;</td>
 </tr>
 </table>
<table width="100%" border=0 class="table wrapper">
		<tr>
			<td colspan=4 align="center">
				<input type="button" value="Submit" onclick="submitForm();" id="Submit"/>
				<input type="reset" value="Reset" onclick="window.location.reload(false)"/>
			</td>
		</tr>
	</table>
</form>
</div>

<?php if($fg_item!='')
/*{
	$sel_qry="SELECT * FROM assembly_bom inner join  assembly_bom_sub  on assembly_bom_sub.bom_id=assembly_bom.Bom_Id WHERE assembly_bom.FG_Item_Id='{$fg_item}' and status=0";
	$res_sel_qry=mysql_query($sel_qry);
	while($data_sel_qry=mysql_fetch_object($res_sel_qry))
	{
		if($data_sel_qry->itemstage=='RM')
		{
		  $item_stage='Row Material';
		}
		else if($data_sel_qry->itemstage=='ASSEMBLED')
		{
		  $item_stage='Assembled Good';
		}

		if($data_sel_qry->comp_type=='AC')
		{
		  $comp_type='Assembly Component';
		}
		else if($data_sel_qry->comp_type=='PC')
		{
		  $comp_type='Packing Component';
		}

		  $item_get="SELECT st_item.Item_Name,st_uom.UOM_Name,st_item.Stock_Enabled FROM st_item 
		  INNER JOIN st_uom ON st_uom.UOM_Id=st_item.UOM_Id WHERE Item_Id='{$data_sel_qry->citem_id}'";

		  $item_res=mysql_query($item_get);
		  $item_data=mysql_fetch_object($item_res);
		  $item_data_name=$item_data->Item_Name;
		  $UOM_Name=$item_data->UOM_Name; 
		  $Stock_Enabled = $item_data->Stock_Enabled;
		  
		  ?>
		  <script>addRowToTable(<?=$data_sel_qry->citem_id?>,'<?=$item_data_name?>','<?=$data_sel_qry->qty?>')</script>
		  <?php
	}
}*/

?>

 <iframe width=168 height=175 name="gToday:normal:cal/agenda.js" id="gToday:normal:cal/agenda.js" src="cal/ipopeng.htm" scrolling=  "no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:999; position:absolute; left:-500px; top:0px;">
  </iframe>