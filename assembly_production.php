<?php
$msg = ($_GET['msg'])?$_GET['msg']:$_REQUEST['error_msg'];
$production_no = $_GET['production_no'];
$emp_id = $_SESSION['SESS_STU_ADMINID'];
$fg_item = $_REQUEST['fg_item'];
$mod = $_REQUEST['mod'];
$Emp_Branch=$_SESSION['Emp_Branch'];
//echo "<pre>";print_r($_SESSION);exit;
						
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
<!------ ------------------------------For chosen--------------------------------- -->
<link rel="stylesheet" href="css/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
  </style>
<script type="text/javascript" src="js/jquery.min.js"></script> 
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery-ui.css" />
<!-- ------------------------------For chosen ENDS----------------------------------- -->
<script>
var Rows=1;  
var SlNo=1;
function addRowToTable(itemcode,itemname,totqty,Stock_Enabled,serial_no)
{
	//check item already exists or not
	var iid1 =document.getElementById('iid1').value;
	var PurSlitem=iid1.split('$');
	for(var i=0; i< PurSlitem.length; i++)
	{
		if(itemcode==PurSlitem[i])
		{
			alert("Item Already Added");
			return false;
		}
	}
  var tbl = document.getElementById('tblgrid'); 
  var lastRow = tbl.rows.length;
  // if there's no header row in the table, then iteration = lastRow + 1   
  var iteration = lastRow;  
  var row = tbl.insertRow(lastRow);  
  row.setAttribute('id','row'+itemcode);      
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
  cell2.innerHTML=totqty; 

  var cell3 = row.insertCell(3);         
  var textNode = document.createTextNode('');
  cell3.appendChild(textNode);  
  cell3.style.display='none'
  cell3.innerHTML=itemcode;
  
 var cell4 = row.insertCell(4);         
  var textNode = document.createTextNode('');
  cell4.appendChild(textNode);  
  cell4.style.display='none'
  cell4.innerHTML=totqty;
  /*
   var cell5 = row.insertCell(5);       
  var textNode = document.createTextNode('');  
  cell5.appendChild(textNode);  
  cell5.align="right";
  cell5.innerHTML=serial_no;*/
  
  // last cell 
  var cellRight = row.insertCell(5);   
  var textNode = document.createTextNode(''); 
  cellRight.appendChild(textNode); 
  cellRight.align="center";
  
   //totqty=totqty+totqty;

  <!-------------------------Assignment of coming values to text area --------------------------->
  var PurSlitem=iid1.split('$');
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
 
  //cellRight.innerHTML="<a href='#' onclick='editrow(\"row"+ Rows+"\","+itemcode+",\""+ totqty+"\",\""+ Stock_Enabled+"\")'><img src=\"images/edit2.png\" width=\"18\" height=\"18\" title='Edit'   /></a> <input type='hidden' name='itemcode[]' id='itemcode' value='"+itemcode +"'><input type='hidden' name='qty[]' id='qty' value='"+totqty +"'>"; 
 // alert (cellRight.innerHTML);
   document.getElementById('tot_bom_qty').value=Number(document.getElementById('tot_bom_qty').value)+Number(totqty);
  Rows++;  
  SlNo++;   
  var divGrid=document.getElementById('grid'); 
  divGrid.scrollTop=parseInt(document.getElementById('tblgrid').clientHeight)-parseInt(divGrid.style.height)+2;
} 

function updateRowToTable(PurSlBno,Iid,SidQty,itemcode,rowid,totqty,set_fg_slno,emp_id,Stock_Enabled)
{
//	var totSidQty=0;
	//check serial already exists or not
	var sno1 =document.getElementById('sno1').value;
	var PurSl=sno1.split('$');
	var count=1;
	for(var i=0; i< PurSl.length; i++)
	{
		if(Stock_Enabled=='SERIALNO' && PurSlBno==PurSl[i])
		{
			alert("Serial number is already added");
			return false();
		}
		else if(Stock_Enabled=='BATCH' && PurSlBno==PurSl[i] ){
			count++;
		}
		
	}

	//check item already exists or not
	var iid1 =document.getElementById('iid1').value;
	var Puriid1=iid1.split('$');

	for(var i=0; i< Puriid1.length; i++)
	{
		if(Iid==Puriid1[i] && Stock_Enabled=='SERIALNO')
		{
			alert("Serial number is already added for this item");
			return false();
		}
	}
	
	fg_qty = document.getElementById(rowid).cells[4].innerHTML;

	if(Number(roundNumber(count,3))>Number(fg_qty))
	{
		alert("BOM Item Quantity And Total Quantity Against Batch/Serial Numbers Cant be Diffrent");
		return false();
		//count=0;
		
	}

	//check first production scan or not
	if(document.getElementById('timestamp').value==''){
		document.getElementById('timestamp').value='<?=date("Y-m-d H:i:s")?>';
		document.getElementById('emp_id').value=emp_id;
		
	}

	


<!-------------------Code to update serial no and item textarea ---------------------------->
var serials=document.getElementById('sno1').innerHTML;
var serials_array=serials.split('$'); //splitting wrto $ and changing to array 
var serialQTY=document.getElementById('SidQty1').innerHTML;
var serialQTY_array=serialQTY.split('$');
var serialitm=document.getElementById('iid1').innerHTML;
var serialitm_array=serialitm.split('$');//alert(serialitm_array); alert(itemcode); //splitting wrto $ and changing to array
var serialitmindex=serialitm_array.indexOf(itemcode); //finding first occurence of itemid in array
var serialitmlindex=serialitm_array.lastIndexOf(itemcode);//alert(serialitmlindex);//finding Last occurence of itemid in array
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
/*	r.cells[1].innerHTML=itemname;
	r.cells[2].innerHTML=totqty;
	r.cells[3].innerHTML=itemcode;*/
	//r.cells[4].innerHTML=StQty;
	//r.cells[5].innerHTML=PurSlBno;
	if(Stock_Enabled=='BATCH'){
		if(r.cells[5].innerHTML=='')
			{
			r.cells[5].innerHTML=PurSlBno;
			}
			else
			{
			//alert(document.getElementById('sno1').innerHTML);
			r.cells[5].innerHTML=wordWrap(r.cells[5].innerHTML+","+PurSlBno,24);
			}
			
			//r.cells[5].innerHTML=document.getElementById('sno1').innerHTML+","+PurSlBno;
	}
	else{
		r.cells[5].innerHTML=PurSlBno;
	}

	/*r.cells[5].innerHTML="<a href='#' onclick='editrow(\"row"+ rowid+"\","+itemcode+")'><img src=\"images/edit2.png\" width=\"18\" height=\"18\" title='Edit'/></a> <a href='#' onclick='deleterow(\"row"+ Rows+"\")'><img src=\"images/delete.png\" width=\"18\" height=\"18\" title='Delete'   /></a><input type='hidden' name='itemcode[]' id='itemcode' value='"+itemcode +"'><input type='hidden' name='qty[]' id='qty' value='"+totqty +"'><input type='hidden' name='remark[]' id='remark' value='"+remark +"'>";*/
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


function editrow(id,itemcode,qty,Stock_Enabled)
{
	if(document.getElementById("bbranch").value==''){
		alert("Please select the stock branch");
		document.getElementById("bbranch").focus();
		return;
	}
	else{
		var bbranch=document.getElementById("bbranch").value ;
	}

	var ser = window.open('assembly_production_item_add.php?act=edit&row='+id+'&itemcode='+itemcode+'&qty='+qty+'&Stock_Enabled='+Stock_Enabled+'&bbranch='+bbranch, '','toolbar=0,scrollbars=0,location=1,statusbar=1,menubar=0,resizable=1,titlebar=1,width=850,height=500'); 

}
 
 /*
 
 
function f_dob(){
	gfPop.fStartPop(document.manual_time_new.date,Date);
}
function f_dob1(){
	gfPop.fStartPop(document.manual_time_new.invDate,Date);
}
function f_dob2(){
	gfPop.fStartPop(document.manual_time_new.debtdate,Date);
}
function salesmanlist(){
	// loading graphics
	salesmanObj = document.forms.manual_time_new.salesman;
	salesmanObj.options.length=0; // delete all
	var option = document.createElement("option");
	option.text = "--please wait--";
	salesmanObj.add(option, salesmanObj[0]);
	salesmanObj.disabled = true;
	salesmanObj.style.cursor = "wait";
	
	data = "branch="+document.getElementById("branch").value;
	iAjax("ajax_get_salesman.php?"+data,salesmanlist_success); 
}
function salesmanlist_success(respond){
	document.getElementById("wrapper_salesman").innerHTML =respond; 
}

function validSelections(){
	// this function returns true on enough value is there for adding to grid, otherwise false
	if( document.getElementById("item").value == '' ){
		alert("Select item");
		document.getElementById("item").focus();
		return false;
	}
	if( document.getElementById("retqnty").value == '' ){
		alert("Select quantity");
		document.getElementById("retqnty").focus();
		 return false;
	}
	retqnty = document.getElementById("retqnty").value ;
	 if (isNaN(retqnty)){
		 alert("Enter a numeric value");
		 document.getElementById("retqnty").focus();
		 return false;
	 }
		if(document.getElementById("customer").value == '' ){
			alert("Select customer");
			document.getElementById("customer").focus();
			 return false;
		}
		if(document.getElementById("branch").value == '' ){
			alert("Select branch");
			document.getElementById("branch").focus();
			 return false;
		}
		if(document.getElementById("salesman").value == '' ){
			alert("Select salesman");
			document.getElementById("salesman").focus();
			 return false;
		}
		if(document.getElementById("srlno").value == '' ){
			alert("Select serial/batch number");
			document.getElementById("srlno").focus();
			 return false;
		}
		// batch number is optional
		if(document.getElementById("srlnoqty").value == ''|| isNaN(document.getElementById("srlnoqty").value) ){
			alert("Enter a numeric value");
			document.getElementById("srlnoqty").focus();
			 return false;
		}
		return true; // its valid
	
}*/
document.onkeydown = checkKeycode 
var keycode;      
function checkKeycode(e)     
{	
	if (window.event) keycode = window.event.keyCode; 
	else if (e) keycode = e.which; 
} 

function submitForm(){

	if(document.forms.manual_time_new.date.value==''){
		document.forms.manual_time_new.date.focus();
		alert("Select date");
		return false;
	}
	/*else if(document.forms.manual_time_new.serial_no.value==''){
		document.forms.manual_time_new.serial_no.focus();
		alert("Please enter serial no");
		return false;
	}*/
	/*else if(document.forms.manual_time_new.production_line.value==''){
		document.forms.manual_time_new.production_line.focus();
		alert("Please enter production line");
		return false;
	}*/
	else if(document.forms.manual_time_new.prductn_by.value==''){
		document.forms.manual_time_new.prductn_by.focus();
		alert("Select production by");
		return false;
	}
	else if(document.forms.manual_time_new.bbranch.value==''){
		document.forms.manual_time_new.bbranch.focus();
		alert("Please select stock branch");
		return false;
	}
	//var table = document.getElementById("tblgrid");
   // var rows = table.getElementsByTagName("tr");
	//alert(rows.length);
	var sno1 =document.getElementById('sno1').value;
	var PurSl=sno1.split('$');
	var length = PurSl.length;
	var tot_bom_qty = document.getElementById('tot_bom_qty').value;
	if(tot_bom_qty!=length){
		alert("Added serial number count and BOM quantity is mismatching.Please verify the added serial number details");
		return false;
	}
	
	if(document.getElementById('sno1').value==''){
		alert("Add item and serial number details in grid");
		return false;
	}    
	/*if(document.forms.manual_time_new.sstore.value==''){
		document.forms.manual_time_new.sstore.focus();
		alert("Select Store");
		return false;
	}*/
	document.forms.manual_time_new.submit();
	document.getElementById('Submit').disabled=true;
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
function checkSerialNo()
{
	var serial_no = document.manual_time_new.elements.serial_no.value;
	iAjax("assembly_ajax.php?act=checkSerialNo1&serial_no="+serial_no,checkSerialNo_success01);
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
</script>
<div id="content_inner">
  <div class="page_header">
<h2>Production Entry</h2>
<div id="search"></div></div> 
    <div id="quick_access_overview"></div>
    <div class="form_container" style="width:925px">
<form action="assembly_productn_validate.php" method="post" name="manual_time_new" id="manual_time_new" class="generic">
        <input name="page" value="<?=$page?>" type="hidden"/>	
		<input name="m" value="<?=$Menu_Id?>" type="hidden" />	
		<input name="sm" value="<?=$sm?>" type="hidden" />
        <input name="mod" value="<?=$mod?>" type="hidden" />
		
	<textarea  name="sno1" id="sno1"  style="display:none;" ></textarea>
	<textarea  name="iid1" id="iid1"  style="display:none;"></textarea>
	<textarea  name="SidQty1" id="SidQty1"  style="display:none;"></textarea>
    <textarea  name="remark1" id="remark1"  style="display:none;"></textarea>
	
    <input type="hidden" name="totqty" id="totqty">
	<input name="sesver" value="<?=$sesver?>" type="hidden" />
	<input name="timestamp" id="timestamp" type="hidden" />
	<input type="hidden" name="emp_id" id="emp_id" value="" />
	<input type="hidden" name="tot_bom_qty" id="tot_bom_qty" value="" />
	
	<table  width="100%" border=0 class="table wrapper">
	
		<tr>
			<td colspan=4><font color="#FF0000"><b> <?php if($msg){echo $msg;}?></b></font></td>
		</tr>
	<?php
	
	  $yr=date("y");
      $nm='/';
      $m=date("m");
      $prefix='IMP'.$yr.$m;
      $len=strlen($prefix);

	/*$sql1="SELECT CONCAT('$prefix',LPAD(max_production_no+1,GREATEST(3,LENGTH(max_production_no+1)),'0')) production_no FROM
	(SELECT IFNULL( MAX(SUBSTRING(`production_no`,$len+1)),'0') max_production_no FROM  assembly_production WHERE production_no LIKE '$prefix%') p2";*/
	
	$sqlserialno = "SELECT CONCAT('$prefix',LPAD(max_production_no+1,GREATEST(3,LENGTH(max_production_no+1)),'0')) production_no FROM 

    (SELECT IFNULL( MAX(CAST( SUBSTRING(`production_no`,$len+1) AS SIGNED)),'0')  max_production_no FROM assembly_production WHERE production_no LIKE '$prefix%') P2";
	
	
	$res1=mysql_query($sqlserialno);
	$data1=mysql_fetch_object($res1);
	 $somax=$data1->production_no;	 
	
	
	?>
	
		<tr>
			<td><strong>Date:<font color="#FF0000">*</font></strong>
			<td>
				<input type="text"  name="date" class="tb8" value="<?=date('d-m-Y')?>" readonly/>
				<!--<a href="javascript:void(0)" onclick="javascript:f_dob();return false;" hidefocus="" ><img name="popcal" align="absmiddle" src="./common/images/calbtn.gif" width="34" height="22" border="0"></a>
--></td>
			
			<td><b>Production Number:<font color="#FF0000" size="2"> *</font></b></td>
			<td><input type="text" name="prductn_no"  value="<?=$somax?>" class="tb8" readonly title="return entry number" id="prductn_no"/></td>
			
			
			
		</tr>	
		
		 <tr>              
                    <td><strong> FG Item Name: <font color="#FF0000" size="2"> *</font></strong></td>
                    <td>   
					 <select data-placeholder="Select Item" class="chosen-select" style="width:290px;" tabindex="2" name="fg_item" id="fg_item" style="font-size:10px;" onchange="checkBOM()">
                            <option value="">Select  FG Item</option>
                            <?php
                            $sql="select st_item.`Item_Name`,st_item.`Item_Id` from st_item where st_item.ItemCat_Id='23' 
							AND st_item.Item_Stage IN('FG') and st_item.Item_Status='Active' ";
                            if($fg_item){
								$sql.=" and Item_Id='$fg_item'";
							}
							$sql.="order by Item_Name";
                            $ret=mysql_query($sql); 
                            while($row=mysql_fetch_object($ret)) {?>
                            <option value="<?=$row->Item_Id?>" <?php if($row->Item_Id==$fg_item){?> selected="selected"  <?php }?>><?=$row->Item_Name?></option><?php } ?>
                        </select>
                    </td>
					<!--<td><strong>Serial Number:<font color="#FF0000" size="2"> *</font></strong></td>
					<td><input type="text" name="serial_no"  value="" class="tb8" title="serial no" id="serial_no" onkeyup="checkSerialNo()"/></td>-->
					<td><b>Production Line:<font color="#FF0000"></font></b></td>
			<td><input type="text" name="production_line"  value="" class="tb8"  title="production by" id="production_line"/></td>
       </tr>
                
		
		
		
		<tr>
		<td><b>Production By:<font color="#FF0000">*</font></b></td>
			<td> <select name="prductn_by" id="prductn_by">
            <option value="">-- Select Employee --</option>
            <?php 
				$selstr="SELECT Emp_Id,Emp_Name FROM gen_employee where Emp_Status='Active'";
				if($_SESSION['SESS_STU_ADMINID']!='1'){
					$selstr.=" and Emp_Id='$emp_id'";
				}
				$qrystr=mysql_query($selstr);
				while($fetstr=mysql_fetch_object($qrystr)){ ?>
                	  <option value="<?=$fetstr->Emp_Id?>" <?php if($emp_id==$fetstr->Emp_Id){?> selected="selected" <?php } ?> ><?=$fetstr->Emp_Name?></option>
				<?php } ?>
            </td>
			
		
			
			<td><b>Stock Branch   : <font color="#FF0000" > *</font></b></td>
				<td><select name="bbranch" id="bbranch" style="width: 188px;">
					<option value="" selected="selected">--Branch--</option>
					<?php
				
					$sql="select st_branch.* from `st_branch` 
					inner join st_store on st_store.`Branch_id`=st_branch.Branch_Id and st_branch.Branch_Id='621' 
					 where 1=1";
					$sql.=" and Branch_Status!='Deleted'  and BranchActv_Stat='Active' order by Branch_Name";
					$ret=mysql_query($sql); 
					while($row=mysql_fetch_object($ret)) 
					{  
					?>  
					<option value="<?=$row->Branch_Id?>" <?php if($Emp_Branch==$row->Branch_Id){?> selected="selected"<?php }?>><?=$row->Branch_Name?></option>
					<?php  
					}  
					?> 
				</select>
			</td>
		</tr>
		
		<tr>
		<td><b>Production Shift:<font color="#FF0000"></font></b></td>
			<td> <input type="text" name="shift_start" id="shift_start">
            
            </td>
			<!--<td><b>Production Shift End:<font color="#FF0000"></font></b></td>
			<td> <input type="time" name="shift_end" id="shift_end">
            
            </td>-->
			<td><b>Serial Number:<font color="#FF0000"></font></b></td>
			<td> <input type="text" name="serial_no" id="serial_no" onkeypress="checkSerial_no(event);">
            
            </td>
			
		
			
			
		</tr>
		
		</table>
			 <table width="785"> 
	<!-- <tr align="center">
		 <td>
		 <input name="button" type="button" onclick="popup_additem()" value="Add Item" /> 
		 </td>
	 </tr>-->
     
     <tr><td style="padding-top: 35px;">&nbsp;<strong>BOM Details</strong></td></tr>
	 </table>
	 	 <div id="grid" style=" height:100px; width:790px;" align="left" class="scroll">
		  <table width="800" border="1" align="left" cellpadding="0" cellspacing="0" id="tblgrid_table"  bgcolor="#F2F9D9" style="font:Verdana; font-size:10px">
			<thead>
				<tr >  
				  <td width="3%" height="20" align="center" bgcolor="#BADB6F"><b>Slno</b></td>
				 <!-- <td width="25%" align="center" bgcolor="#BADB6F"><b>Stage</b></td>-->
				  <td width="10%" align="right" bgcolor="#BADB6F"><b>Item Name</b></td>
				  <td width="10%" align="right" bgcolor="#BADB6F"><b>Quantity</b></td>
				 <!-- <td width="10%" align="right" bgcolor="#BADB6F"><b>UOM</b></td>
				  <td width="10%" align="right" bgcolor="#BADB6F"><b>Component Type</b></td>-->
				  <td width="9%"  align="center" bgcolor="#BADB6F"><b>Serial Number</b></td>
				</tr> 
			</thead>
			<tbody id="tblgrid"></tbody>
   </table>
 </div>  <br/> 
  <table width="98%" height="26" border="0" cellpadding="0" cellspacing="0" class="table" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px">
	 <tr align="right">
       <td height="22" colspan="3" ><b>Remarks:</b>&nbsp; <br />
       <textarea name="remarksall" id="remarksall" align="right"></textarea></td><td height="22">&nbsp;</td>
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
	$sel_qry="SELECT * FROM assembly_bom inner join  assembly_bom_sub  on assembly_bom_sub.bom_id=assembly_bom.Bom_Id 
	WHERE assembly_bom.FG_Item_Id='{$fg_item}' and status='0' and assembly_bom_sub.comp_type='AC' and assembly_bom.Bom_Status='0'";
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
		  <script>addRowToTable(<?=$data_sel_qry->citem_id?>,'<?=$item_data_name?>','<?=$data_sel_qry->qty?>','<?=$Stock_Enabled?>')</script>
		  <?php
	}
}

?>

<script>
/*****************Barcode scanning code*************************/
function keypadAction(event){
			//if (window.event) event = window.event;
			event = event || window.event;
			return event.which || event.keyCode;
			
		}
		
function checkSerial_no(event)
{
	pressedKey = keypadAction(event);//alert(pressedKey);
		if(pressedKey!=13){ // enter key
			return;
		}
		
		
	var serial_no=document.getElementById('serial_no').value;
	var fg_item = document.getElementById('fg_item').value;
	var bbranch = document.getElementById('bbranch').value;
	var serial_no1=serial_no.split("/");
	
	if(bbranch==''){
		alert("Please select the stock branch");
		document.getElementById('bbranch').focus();
		document.getElementById('serial_no').value='';
	}
	else if(serial_no==''){
		alert("Please serial number");
		document.getElementById('serial_no').focus();
		document.getElementById('serial_no').value='';
	}
	else{
		if(serial_no1.length>1){
			iAjax("assembly_ajax.php?act=scanning_bulk_checkSerialNo&serial_no="+serial_no+"&fg_item="+fg_item+"&bbranch="+bbranch,checkSerialNo_success0101_bulk);
		}
		else{
			iAjax("assembly_ajax.php?act=scanning_checkSerialNo&serial_no="+serial_no+"&fg_item="+fg_item+"&bbranch="+bbranch,checkSerialNo_success0101);
		}
	}
	
}
function checkSerialNo_success0101(result){
	if(result.trim()=='0')
	{
		alert("Serial number is not in assembly stock.Please try again with another one");
		document.getElementById('serial_no').value='';
		document.getElementById('serial_no').focus();
	}
	else{
		var st_Item_id = result.trim();
		var serial_no=document.getElementById('serial_no').value;
		var fg_item = document.getElementById('fg_item').value;
		var bbranch = document.getElementById('bbranch').value;
		iAjax("assembly_ajax.php?act=scanning_checkBOM&serial_no="+serial_no+"&fg_item="+fg_item+"&bbranch="+bbranch+"&st_Item_id="+st_Item_id,checkSerialNo_success0102);
	}
}
function checkSerialNo_success0102(result){
	if(result.trim()=='no' || result.trim()=='0'){
		alert("No bom details is availbale for this FG item OR Some serial number is not belongs to BOM item.Please try again with another one");
		document.getElementById('serial_no').value='';
		document.getElementById('fg_item').focus();
	}
	else{
		obj = JSON.parse(result.trim());
		document.getElementById('serial_no').value='';

		for (let i = 0; i < obj.length; i++) {
			rowid='row'+obj[i].citem_id;
			fg_qty = document.getElementById(rowid).cells[4].innerHTML;
			PurSlBno=obj[i].serial_no;
			Iid = obj[i].citem_id;
			SidQty = obj[i].qty;
			totSidQty=obj[i].totSidQty;
			
			itemcode=obj[i].item_data_name;
			totqty=fg_qty;
			set_fg_slno=obj[i].set_fg_slno;
			emp_id=obj[i].emp_id;
			Stock_Enabled=obj[i].Stock_Enabled;
			updateRowToTable(PurSlBno,Iid,SidQty,itemcode,rowid,totqty,set_fg_slno,emp_id,Stock_Enabled);
		}
		
		/*var citem = result.trim();
		var serial_no=document.getElementById('serial_no').value;
		var fg_item = document.getElementById('fg_item').value;
		var bbranch = document.getElementById('bbranch').value;
		iAjax("assembly_ajax.php?act=scanning_GetBOM&serial_no="+serial_no+"&fg_item="+fg_item+"&bbranch="+bbranch+"&citem="+citem,checkSerialNo_success0103);*/
	}
}/*
function checkSerialNo_success0103(result){
	obj = JSON.parse(result.trim());
	
	/*$("#tblgrid_table > tbody").empty();
	var tbl = document.getElementById('tblgrid');  
	var lastRow = tbl.rows.length;  
	
	//update the serial number in the first column 
	for(i=1;i<lastRow;i++) 
	{ 
		r=document.getElementById('tblgrid').rows[i];    
		r.cells[0].innerHTML=i;
	}      
	SlNo=i;	*/

	/*for (let i = 0; i < obj.length; i++) {
		rowid='row'+obj[i].citem_id;
		fg_qty = document.getElementById(rowid).cells[4].innerHTML;
		PurSlBno=obj[i].serial_no;
		Iid = obj[i].citem_id;
		SidQty = obj[i].qty;
		itemcode=obj[i].item_data_name;
		totqty=fg_qty;
		set_fg_slno='';
		updateRowToTable(PurSlBno,Iid,SidQty,itemcode,rowid,totqty,set_fg_slno);
	}
	
}
*/
function wordWrap(str, maxWidth) {
    var newLineStr = "\n"; done = false; res = '';
    while (str.length > maxWidth) {                 
        found = false;
        // Inserts new line at first whitespace of the line
        for (i = maxWidth - 1; i >= 0; i--) {
            if (testWhite(str.charAt(i))) {
                res = res + [str.slice(0, i), newLineStr].join('');
                str = str.slice(i + 1);
                found = true;
                break;
            }
        }
        // Inserts new line at maxWidth position, the word is too long to wrap
        if (!found) {
            res += [str.slice(0, maxWidth), newLineStr].join('');
            str = str.slice(maxWidth);
        }

    }

    return res + str;
}

function testWhite(x) {
    var white = new RegExp(/^\s$/);
    return white.test(x.charAt(0));
};


function checkSerialNo_success0101_bulk(result)
{
	if(result.trim()=='0')
	{
		alert("Serial number is not in assembly stock.Please try again with another one");
		document.getElementById('serial_no').value='';
		document.getElementById('serial_no').focus();
	}
	else{
		obj = JSON.parse(result.trim());
		var serial_no=document.getElementById('serial_no').value;
		var fg_item = document.getElementById('fg_item').value;
		var bbranch = document.getElementById('bbranch').value;
		
		for (key in obj) 
		{
			var key1 = key.split('$');
		  if (obj.hasOwnProperty(key)) {
			 iAjax("assembly_ajax.php?act=scanning_bulk_checkBOM&serial_no="+obj[key]+"&fg_item="+fg_item+"&bbranch="+bbranch+"&st_Item_id="+key1[0],checkSerialNo_bulk_success0102);
		  }
		}
		
		/*for (let i = 0; i < obj.length; i++) {alert(obj[key]);
			st_Item_id=obj[i];
			iAjax("assembly_ajax.php?act=scanning_bulk_checkBOM&serial_no="+serial_no+"&fg_item="+fg_item+"&bbranch="+bbranch+"&st_Item_id="+st_Item_id,checkSerialNo_bulk_success0102);
		}*/
		
		
		
	}
}
function checkSerialNo_bulk_success0102(result){
	if(result.trim()=='no' || result.trim()=='0'){
		alert("No bom details is availbale for this FG item OR Some serial number is not belong to BOM item.Please try again with another one");
		document.getElementById('serial_no').value='';
		document.getElementById('fg_item').focus();
	}
	else{
		obj = JSON.parse(result.trim());
		document.getElementById('serial_no').value='';

		for (let i = 0; i < obj.length; i++) {
			rowid='row'+obj[i].citem_id;
			fg_qty = document.getElementById(rowid).cells[4].innerHTML;
			PurSlBno=obj[i].serial_no;
			Iid = obj[i].citem_id;
			SidQty = obj[i].qty;
			totSidQty=obj[i].totSidQty;
			
			itemcode=obj[i].item_data_name;
			totqty=fg_qty;
			set_fg_slno=obj[i].set_fg_slno;
			emp_id=obj[i].emp_id;
			Stock_Enabled=obj[i].Stock_Enabled;
			updateRowToTable(PurSlBno,Iid,SidQty,itemcode,rowid,totqty,set_fg_slno,emp_id,Stock_Enabled);
		}
		
		/*var citem = result.trim();
		var serial_no=document.getElementById('serial_no').value;
		var fg_item = document.getElementById('fg_item').value;
		var bbranch = document.getElementById('bbranch').value;
		iAjax("assembly_ajax.php?act=scanning_GetBOM&serial_no="+serial_no+"&fg_item="+fg_item+"&bbranch="+bbranch+"&citem="+citem,checkSerialNo_success0103);*/
	}
}
/*****************Barcode scanning code*************************/
</script>


  <!-- ------------------------------For chosen------------------------------ -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
  <script src="js/chosen.jquery.js" type="text/javascript"></script>
  <script src="js/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
  <!-- ------------------------------For chosen ENDS------------------------------ -->
 <iframe width=168 height=175 name="gToday:normal:cal/agenda.js" id="gToday:normal:cal/agenda.js" src="cal/ipopeng.htm" scrolling=  "no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:999; position:absolute; left:-500px; top:0px;">
  </iframe>