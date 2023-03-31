<?php
$msg = $_GET['msg'];
$production_no = $_GET['production_no'];
$emp_id = $_SESSION['SESS_STU_ADMINID'];
$fg_item = $_REQUEST['fg_item'];

//lot number
$yr = 'QC' . date("y");
$len = strlen($yr);
$sql1 = "SELECT CONCAT('$yr',LPAD(max_production_qc_number+1,GREATEST(5,LENGTH(max_production_qc_number+1)),'0')) production_qc_number FROM 
        (SELECT IFNULL( MAX(SUBSTRING(`production_qc_number`, $len+1)),'0') max_production_qc_number FROM assembly_fgpacking WHERE production_qc_number LIKE '$yr%') p2";
$res1 = mysql_query($sql1);
$data1 = mysql_fetch_object($res1);
$rtn_id = $data1->production_qc_number;




?>
<style>
input.loading{
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
}
</style>
<script src="iAjax.js"></script>
<script>
var Rows=1;  
var SlNo=1;
function addRowToTable(itemcode,itemname,bom_qty)
{ 
	//check item already exists or not
/*	var iid1 =document.getElementById('iid1').value;
	var PurSlitem=iid1.split('$');
	for(var i=0; i< PurSlitem.length; i++)
	{
		if(itemcode==PurSlitem[i])
		{
			alert("Item Already Added");
			return false;
		}
	}*/
  var tbl = document.getElementById('tblgrid'); 
  var lastRow = tbl.rows.length; 
  // if there's no header row in the table, then iteration = lastRow + 1   
  var iteration = lastRow;  
  var row = tbl.insertRow(lastRow);  
  row.setAttribute('id','row'+Rows);      
  lastRow++;    
  
  // first cell  
  var cellLeft = row.insertCell(0); 
  var textNode = document.createTextNode('aaa');   
  cellLeft.appendChild(textNode);
  cellLeft.innerHTML=SlNo;  
   
  // second cell 
  var cell1 = row.insertCell(1);       
  var textNode = document.createTextNode('bbb');  
  cell1.appendChild(textNode);  
  cell1.innerHTML=itemname+"/Item Code:"+itemcode; 
  
  // second cell 
  var cell2 = row.insertCell(2);       
  var textNode = document.createTextNode('');  
  cell2.appendChild(textNode);  
  cell2.align="right";
  cell2.innerHTML=bom_qty; 

  var cell3 = row.insertCell(3);         
  var textNode = document.createTextNode('');
  cell3.appendChild(textNode);  
  cell3.style.display='none'
  cell3.innerHTML=itemcode;
  
  /* var cell4 = row.insertCell(4);         
  var textNode = document.createTextNode('');
  cell4.appendChild(textNode);  
  cell4.style.display='none'
  cell4.innerHTML=totqty;
  
 var cell4 = row.insertCell(4);       
  var textNode = document.createTextNode('');  
  cell4.appendChild(textNode);  
  cell4.align="right";
  cell4.innerHTML=Remark;*/ 
  
  // last cell 
  var cellRight = row.insertCell(4);   
  var textNode = document.createTextNode(''); 
  cellRight.appendChild(textNode); 
  cellRight.align="center";
 
  <!-------------------------Assignment of coming values to text area --------------------------->
/*var PurSlno=PurSlBno.split('$');
	for(var i=0; i< PurSlno.length; i++)
	{
		if(PurSlno[i]!='')
		{
			if(document.getElementById('sno1').innerHTML=='')
			{
			document.getElementById('sno1').innerHTML=PurSlno[i];
			}
			else
			{
			//alert(document.getElementById('sno1').innerHTML);
			document.getElementById('sno1').innerHTML=document.getElementById('sno1').innerHTML+"$"+PurSlno[i];
			}
		}
	}
	
var PurSlitem=Iid.split('$');
for(var i=0; i< PurSlitem.length; i++)
	{
		if(PurSlitem[i]!='')
		{
			if(document.getElementById('iid1').innerHTML=='')
			{
			document.getElementById('iid1').innerHTML=PurSlitem[i];
			}
			else
			{
			document.getElementById('iid1').innerHTML=document.getElementById('iid1').value+"$"+PurSlitem[i];
			}
		}
	}
	
var PurSlitemQTY=SidQty.split('$');
for(var i=0; i< PurSlitemQTY.length; i++)
	{
		if(PurSlitemQTY[i]!='')
		{
			if(document.getElementById('SidQty1').innerHTML=='')
			{
			document.getElementById('SidQty1').innerHTML=PurSlitemQTY[i];
			}
			else
			{
			document.getElementById('SidQty1').innerHTML=document.getElementById('SidQty1').value+"$"+PurSlitemQTY[i];
			}
		}
	}
	
	var PurSlitemRem=Remark.split('$');
for(var i=0; i< PurSlitemRem.length; i++)
	{
		if(PurSlitemRem[i]!='')
		{
			if(document.getElementById('remark1').innerHTML=='')
			{
			document.getElementById('remark1').innerHTML=PurSlitemRem[i];
			}
			else
			{
			document.getElementById('remark1').innerHTML=document.getElementById('remark1').value+"$"+PurSlitemRem[i];
			}
		}
	}*/
<!-- ------------------------Assignment of coming values to text area Ends--------------------------- -->
 
  cellRight.innerHTML="<a href='#' onclick='editrow(\"row"+ Rows+"\","+itemcode+","+bom_qty+")'><img src=\"images/edit2.png\" width=\"18\" height=\"18\" title='Edit'   /></a> <input type='hidden' name='itemcode[]' id='itemcode' value='"+itemcode +"'>"; 
 // alert (cellRight.innerHTML);
   
  Rows++;  
  SlNo++;   
  var divGrid=document.getElementById('grid'); 
  divGrid.scrollTop=parseInt(document.getElementById('tblgrid').clientHeight)-parseInt(divGrid.style.height)+2;
} 

function updateRowToTable(PurSlBno,Iid,SidQty,rowid,itemcode)
{
	//check item already exists or not
	var sno1 =document.getElementById('sno1').value;
	var PurSl=sno1.split('$');

	for(var i=0; i< PurSl.length; i++)
	{
		if(PurSlBno==PurSl[i])
		{
			alert("Serial number already added for this item");
			return false;
		}
	}

	
	fg_qty = document.getElementById(rowid).cells[2].innerHTML;
	
<!-------------------Code to update serial no and item textarea ---------------------------->
var serials=document.getElementById('sno1').innerHTML;
var serials_array=serials.split('$'); //splitting wrto $ and changing to array 
var serialQTY=document.getElementById('SidQty1').innerHTML;
var serialQTY_array=serialQTY.split('$');
var serialitm=document.getElementById('iid1').innerHTML;
var serialitm_array=serialitm.split('$'); //splitting wrto $ and changing to array
var serialitmindex=serialitm_array.indexOf(itemcode); //finding first occurence of itemid in array
var serialitmlindex=serialitm_array.lastIndexOf(itemcode); //finding Last occurence of itemid in array
	if(serialitmindex!=-1)
	{
	var splicecount=(serialitmlindex-serialitmindex)+1; //setting the count for splicing
	serialitm_array.splice(serialitmindex,splicecount); // removing itemid's from array(splicing)
	var serialitm_array1=serialitm_array.toString();
	var serialitm_array2=serialitm_array1.replace(/,/g,"$");
	document.getElementById('iid1').innerHTML=serialitm_array2; //asssigning new value to textarea
	serials_array.splice(serialitmindex,splicecount); // removing serial nos from array(splicing)
	var serials_array1=serials_array.toString();
	var serials_array2=serials_array1.replace(/,/g,"$");
	document.getElementById('sno1').innerHTML=serials_array2; //asssigning new value to textarea
	serialQTY_array.splice(serialitmindex,splicecount);
	var serialQTY_array1=serialQTY_array.toString();
	var serialQTY_array2=serialQTY_array1.replace(/,/g,"$");
	document.getElementById('SidQty1').innerHTML=serialQTY_array2;
	}
<!--------------------- Code to update serial no and item textarea Ends --------------------------->
	var r = document.getElementById(rowid);
<!-- ---------------------Assignment of coming values to text area --------------------------- -->
var PurSlno=PurSlBno.split('$');
	for(var i=0; i< PurSlno.length; i++)
	{
		if(PurSlno[i]!='')
		{
			if(document.getElementById('sno1').innerHTML=='')
			{
			document.getElementById('sno1').innerHTML=PurSlno[i];
			}
			else
			{
			//alert(document.getElementById('sno1').innerHTML);
			document.getElementById('sno1').innerHTML=document.getElementById('sno1').innerHTML+"$"+PurSlno[i];
			}
		}
	}
	
var PurSlitem=Iid.split('$');
for(var i=0; i< PurSlitem.length; i++)
	{
		if(PurSlitem[i]!='')
		{
			if(document.getElementById('iid1').innerHTML=='')
			{
			document.getElementById('iid1').innerHTML=PurSlitem[i];
			}
			else
			{
			document.getElementById('iid1').innerHTML=document.getElementById('iid1').value+"$"+PurSlitem[i];
			}
		}
	}
	
var PurSlitemQTY=SidQty.split('$');
for(var i=0; i< PurSlitemQTY.length; i++)
	{
		if(PurSlitemQTY[i]!='')
		{
			if(document.getElementById('SidQty1').innerHTML=='')
			{
			document.getElementById('SidQty1').innerHTML=PurSlitemQTY[i];
			}
			else
			{
			document.getElementById('SidQty1').innerHTML=document.getElementById('SidQty1').value+"$"+PurSlitemQTY[i];
			}
		}
	}
	
/*	var PurSlitemRem=remark.split('$');
for(var i=0; i< PurSlitemRem.length; i++)
	{
		if(PurSlitemRem[i]!='')
		{
			if(document.getElementById('remark1').innerHTML=='')
			{
			document.getElementById('remark1').innerHTML=PurSlitemRem[i];
			}
			else
			{
			document.getElementById('remark1').innerHTML=document.getElementById('remark1').value+"$"+PurSlitemRem[i];
			}
		}
	}*/
<!-- ------------------------Assignment of coming values to text area Ends--------------------------- -->
	
	//update row
	/*r.cells[1].innerHTML=itemname;
	r.cells[2].innerHTML=totqty;
	r.cells[3].innerHTML=itemcode;
	//r.cells[4].innerHTML=StQty;
	r.cells[4].innerHTML=remark;
	r.cells[5].innerHTML="<a href='#' onclick='editrow(\"row"+ rowid+"\","+itemcode+")'><img src=\"images/edit2.png\" width=\"18\" height=\"18\" title='Edit'/></a> <a href='#' onclick='deleterow(\"row"+ Rows+"\")'><img src=\"images/delete.png\" width=\"18\" height=\"18\" title='Delete'   /></a><input type='hidden' name='itemcode[]' id='itemcode' value='"+itemcode +"'><input type='hidden' name='qty[]' id='qty' value='"+totqty +"'><input type='hidden' name='remark[]' id='remark' value='"+remark +"'>";*/
}


function deleterow(id)
{
   
	if(confirm("Are you sure you want to delete this product?"))
	var r = document.getElementById(id);
	var itemcode=r.cells[3].innerHTML;
	
	<!-----------------Code to update serial no and item textarea -------------------------->
var serials=document.getElementById('sno1').innerHTML;
var serials_array=serials.split('$'); //splitting wrto $ and changing to array
var serialitm=document.getElementById('iid1').innerHTML;
var serialitm_array=serialitm.split('$'); //splitting wrto $ and changing to array
var serialQty=document.getElementById('SidQty1').innerHTML;
var serialQty_array=serialQty.split('$'); //splitting wrto $ and changing to array

var serialitmindex=serialitm_array.indexOf(itemcode); //finding first occurence of itemid in array
var serialitmlindex=serialitm_array.lastIndexOf(itemcode); //finding Last occurence of itemid in array
	if(serialitmindex!=-1)
	{
	var splicecount=(serialitmlindex-serialitmindex)+1; //setting the count for splicing
	serialitm_array.splice(serialitmindex,splicecount); // removing itemid's from array(splicing)
	var serialitm_array1=serialitm_array.toString();
	var serialitm_array2=serialitm_array1.replace(/,/g,"$");
	document.getElementById('iid1').innerHTML=serialitm_array2; //asssigning new value to textarea
	
	serials_array.splice(serialitmindex,splicecount); // removing serial nos from array(splicing)
	var serials_array1=serials_array.toString();
	var serials_array2=serials_array1.replace(/,/g,"$");
	document.getElementById('sno1').innerHTML=serials_array2; //asssigning new value to textarea
	
	serialQty_array.splice(serialitmindex,splicecount); // removing serial nos from array(splicing)
	var serialQty_array1=serialQty_array.toString();
	var serialQty_array2=serialQty_array1.replace(/,/g,"$");
	document.getElementById('SidQty1').innerHTML=serialQty_array2; //asssigning new value to textarea
	}
<!------------------- Code to update serial no and item textarea Ends ------------------------->

	//deduct the existing row values from the total

	
	r.parentNode.removeChild( r );  
	
	var tbl = document.getElementById('tblgrid');  
	var lastRow = tbl.rows.length;  
	
	//update the serial number in the first column 
	for(i=1;i<lastRow;i++) 
	{ 
		r=document.getElementById('tblgrid').rows[i];    
		r.cells[0].innerHTML=i;
	}      
	SlNo=i;	 
}   


function editrow(id,itemcode,bom_qty)
{
	var serial_no = document.getElementById('fg_serial_no').value;
	var store_id = document.getElementById('store_id').value;
	var ser = window.open('assembly_fgpacking_item_add.php?act=edit&row='+id+'&itemcode='+itemcode+'&fg_serialno='+serial_no+'&bom_qty='+bom_qty+'&store_id='+store_id, '','toolbar=0,scrollbars=0,location=1,statusbar=1,menubar=0,resizable=1,titlebar=1,width=850,height=500'); 

}
 
 
 
 
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
		alert("Select date");
		return false;
	}
	else if(document.getElementById('fg_serial_no').value==''){
		document.getElementById('fg_serial_no').focus();
		alert("Please enter serial no");
		return false;
	}
	else if(count!=checkboxes.length){
		alert("Some picklist are not verified.Please check the details");
		return false;
	}
	else{
		document.forms.manual_time_new.submit();
		document.getElementById('Submit').disabled=true;
		
	}
	
}
function popup_additem() 
{ 
	var stor=document.getElementById("sstore").value ; 
	if(stor=='')
	{
		alert("Please select the store");
		document.getElementById("sstore").focus();
		return
	}
	else
	{
		var ser = window.open('assembly_sdk_unit_trans_item_add.php?st='+stor, '','toolbar=0,scrollbars=0,location=1,statusbar=1,menubar=0,resizable=1,titlebar=1,width=1000,height=390'); 
	}
} 
function addvalues(totgtotal,roundoff,totsubtotal,totvat,totcst,totdis)
{//alert("Hai");
if(keycode!=8 || keycode!=9)
{
       var val1=document.getElementById(totgtotal);
	   var val3=document.getElementById(roundoff);
	   var val4=document.getElementById(totsubtotal);
	   var val5=document.getElementById(totvat);
	   var val6=document.getElementById(totcst);
	   var val8=document.getElementById(totdis);
       n=Number(Number(val4.value)+Number(val5.value)+Number(val6.value)+Number(val3.value)+Number(val8.value));
	  // n1=n-Number(val8.value);
	   document.manual_time_new.elements.totgtotal.value=n.toFixed(2);
		   
}	   
}
function checkBOM(){
	var fg_item = document.manual_time_new.elements.fg_item.value;
	iAjax("assembly_ajax.php?act=checkBOM&itm="+fg_item,BOMchk_success01);
				
}
function BOMchk_success01(result){
	
	if(result=='1'){
		var fg_item = document.manual_time_new.elements.fg_item.value;
		location.href="index.php?m=<?=$Menu_Id?>&sm=<?=$sm?>&act=assembly_productn&mod=add&fg_item=" +fg_item;
		//iAjax("assembly_ajax.php?act=getBOM&itm="+fg_item,BOMchk_success02);
	}
	else{
		alert("There is no BOM for this FG Item.Please check the item");
		document.manual_time_new.elements.fg_item.focus();
	}
}
function BOMchk_success02(result){
	
	document.getElementById("grid").innerHTML=result;
	
}
// listen the keyboard
function keypadAction(event){
	//if (window.event) event = window.event;
	event = event || window.event;
	return event.which || event.keyCode;	
}
function checkSerialNo()
{
	pressedKey = keypadAction(event);
	if(pressedKey!=13){ // enter key
		return;
	}
	else{
		if(document.manual_time_new.elements.fg_serial_no.value!=''){
		var serial_no = document.manual_time_new.elements.fg_serial_no.value;
		if(document.manual_time_new.elements.timestamp.value==''){
			document.manual_time_new.elements.timestamp.value='<?=date('Y-m-d H:i:s')?>';
		}
		iAjax("assembly_ajax.php?act=fgpackg_checkSerialNo&fg_serial_no="+serial_no,_success01);
		}
		else{
			alert("Please enter the FG serial number");
			document.manual_time_new.elements.fg_serial_no.focus();
		}
	}
	
	
}
function _success01(result)
{
	if(result=='0'){
		alert("Invalid serial number or FG item already packed or QC is not done for this serial number");
		location.reload();  
		document.manual_time_new.elements.serial_no.focus();
		
	}
	else{
		getlot_no();
	}
}
function getlot_no(){
	var serial_no = document.manual_time_new.elements.fg_serial_no.value;
	iAjax("assembly_ajax.php?act=getlot_no&fg_serial_no="+serial_no,_success02d);
}
function _success02d(result){
	document.getElementById('lot_no').value=result;
	fgpackg_checkQc();
}

function fgpackg_checkQc(){
	var serial_no = document.manual_time_new.elements.fg_serial_no.value;
	iAjax("assembly_ajax.php?act=fgpackg_checkQc&fg_serial_no="+serial_no,_success02);
}
function _success02(result){
	document.getElementById('item_details').innerHTML=result;
	//+'<tr><td><label><strong>Accessory Box: </strong></label></td><td><input type="radio" name="checkbox1" value="1">YES <input type="radio" name="checkbox1" value="0">NO</td></tr><tr><td><label><strong>User Manual: </strong></label></td><td><input type="radio" name="checkbox2" value="1">YES <input type="radio" name="checkbox2" value="0">NO</td></tr><tr><td><label><strong>Test: </strong></label></td><td><input type="radio" name="checkbox3" value="1">YES <input type="radio" name="checkbox3" value="0">NO</td></tr><tr><td><label><strong>Test: </strong></label></td><td><input type="radio" name="checkbox4" value="1">YES <input type="radio" name="checkbox4" value="0">NO</td></tr>';
	fgpackg_picklist();
	

}

function roundNumber(num, dec) {
	var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	return result;
}



function fgpackg_picklist(){
	
if(document.manual_time_new.elements.fg_serial_no.value!=''){
	var serial_no = document.manual_time_new.elements.fg_serial_no.value;
	var ItemSubCat_Id = document.manual_time_new.elements.ItemSubCat_Id.value;
	iAjax("assembly_ajax.php?act=fgpackg_packg_picklist&fg_serial_no="+serial_no+"&ItemSubCat_Id="+ItemSubCat_Id,_fgpackg_success01);
}
	
}
function _fgpackg_success01(result){
	document.getElementById('packgpicklst_details').innerHTML=result;
}


function _bom_success01(result){

	if(result)
	{
		var json_array = JSON.parse(result);
		document.getElementById('grid').style.display='';
		for(i=0;i<json_array.length;i++){
			/*var serial_no = json_array[i].serial_no;
			var slno1='';
			for(j=0;j<serial_no.length;j++){
				var s1 = serial_no[j].fgslno+',';
				var slno1= slno1+s1;
				
			}*/
			//slno1 = slno1.replace(/,\s*$/, "");
			addRowToTable(json_array[i].citem_id,json_array[i].item_name,json_array[i].bom_qty);
		}
	}
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
<h2>FG Packing Entry</h2>
<div id="search"></div></div> 
    <div id="quick_access_overview"></div>
    <div class="form_container" style="width:800px">
<form action="assembly_fgpackg_validate.php" method="post" name="manual_time_new" id="manual_time_new" class="generic">
        <input name="page" value="<?=$page?>" type="hidden"/>	
		<input name="m" value="<?=$Menu_Id?>" type="hidden" />	
		<input name="sm" value="<?=$sm?>" type="hidden" />
	<textarea  name="sno1" id="sno1"  style="display:none;" ></textarea>
	<textarea  name="iid1" id="iid1"  style="display:none;"></textarea>
	<textarea  name="SidQty1" id="SidQty1" style="display:none;"></textarea>
    <textarea  name="remark1" id="remark1"  style="display:none;"></textarea>
    <input type="hidden" name="totqty" id="totqty">
	<input name="sesver" value="<?=$sesver?>" type="hidden" />
	<input name="timestamp"  id="timestamp" type="hidden" />
	<table  width="100%" border=0 class="table wrapper">
		<tr>
			<td colspan=4><font color="#FF0000"><b> <?php if($msg){echo $msg;}?></b></font></td>
		</tr>
	<?php

      $yr=date("y");
      $nm='/';
      $m=date("m");
      $prefix='IMFP'.$yr.$m;
      $len=strlen($prefix);

	$sql1="SELECT CONCAT('$prefix',LPAD(max_fg_packg_no+1,GREATEST(3,LENGTH(max_fg_packg_no+1)),'0')) fg_packg_no FROM
	(SELECT IFNULL( MAX(CAST( SUBSTRING(`fg_packg_no`,$len+1) AS SIGNED)),'0') max_fg_packg_no FROM  assembly_fgpacking WHERE fg_packg_no LIKE '$prefix%') p2";
	$res1=mysql_query($sql1);
	$data1=mysql_fetch_object($res1);

		if(mysql_num_rows($res1))     
		{  
		  $somax.=$data1->fg_packg_no;   
		} 
		
	?>
	
	<tr>
			<td><strong>Date:<font color="#FF0000">*</font></strong>
			<td>
				<input type="text"  name="date" class="tb8" readonly value="<?=date('d-m-Y')?>"/>
				<a href="javascript:void(0)" onclick="javascript:f_dob();return false;" hidefocus=""><img name="popcal" align="absmiddle" src="./common/images/calbtn.gif" width="34" height="22" border="0"></a>
	</td>
			
			<td><b>FG Packing Number:</b></td>
			<td><input type="text" name="fg_packg_no"  value="<?=$somax?>" class="tb8" readonly title="return entry number" id="fg_packg_no"/></td>
			
			
			
		</tr>
		
		 <tr>  
				
           	<td><strong>Serial Number:</strong></td>
			<td><input type="text" name="fg_serial_no"  class="tb8" title="serial no" id="fg_serial_no" onkeypress="checkSerialNo()" style="width: 238px;height: 15px;"/></td>
			
			<td><strong>Lot Number:</strong></td>
			<td><input type="text" name="lot_no"  class="tb8" title="Lot no" id="lot_no" style="    width: 150px;" readonly /></td>
		</tr>			
       
     
	   
		</table>
			 <table width="785" id="item_details" style="margin-top: 10px;"> 

	 </table>
     
	

	 <table width="785" id="packgpicklst_details" style="margin-top: 10px;"></table>
     
     
     
     
     
     
     
	 	 <!--<div id="grid" style=" height:100px; width:790px;display:none;" align="left" class="scroll">
         <div style="margin-top: 37px;"><font><strong>BOM Details</strong></font></div>
		  <table width="800" border="1" align="left" cellpadding="0" cellspacing="0" id="tblgrid" bgcolor="#F2F9D9" style="font:Verdana; font-size:10px">
			
            <tr>   
			  <td width="3%" height="20" align="center" bgcolor="#BADB6F"><b>Slno</b></td>
			
			  <td width="10%" align="right" bgcolor="#BADB6F"><b>Item Name</b></td>
			  <td width="10%" align="right" bgcolor="#BADB6F"><b>Quantity</b></td>
			  <td width="9%"  align="center" bgcolor="#BADB6F"><b>Action</b></td>
			</tr> 
   </table>
 </div> --> <br/> 
  <table width="98%" height="26" border="0" cellpadding="0" cellspacing="0" class="table" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px">
	 <tr align="right">
       <td height="22" colspan="3" ><b>Remarks:</b>&nbsp; <br />
       <textarea name="remarksall" id="remarksall" align="right" style="margin: 0px;width: 426px;height: 80px;"></textarea></td><td height="22">&nbsp;</td>
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
{
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
}

?>

 <iframe width=168 height=175 name="gToday:normal:cal/agenda.js" id="gToday:normal:cal/agenda.js" src="cal/ipopeng.htm" scrolling=  "no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:999; position:absolute; left:-500px; top:0px;">
  </iframe>