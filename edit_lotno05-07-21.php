
<?php 
include_once("common/includes/constants.php");
      include_once("common/includes/constants.php"); 
      include_once("common/includes/functions.php");
      include_once("common/includes/common.php"); 
      include_once("common/includes/admin_session.php");
      include_once("common/includes/english_admin.php");
      date_default_timezone_set("Asia/Kolkata");

$rowid=$_GET['rowid'];
$act=$_GET['act']; 
$itemid=$_GET['itemid'];
 $mainqty=$_GET['mainqty'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>



      <!-- Auto Complete Starts here-->
  <style>
  .ui-autocomplete-loading {
  background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;
  }
  </style>

<style>
div.scroll{
    width:400px;
    height: 50px;
    overflow: scroll;
  }
#empid { display:none; }

.ui-accordion-content{

height: 200px;

} 
.add{
  cursor: pointer;
  }

</style>
<script src="iAjax.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<script type="text/javascript">



    function updateparent()
  {
    
        if(document.manual_time_new.lotnonew0.value=='')
            {   
              alert("Please Enter Lot Number");
                document.manual_time_new.lotnonew0.focus();
            }
          
          else {
           
           var arraylotnumber=[];
           $( ".lotclass" ).each(function() {
           
            arraylotnumber.push($( this ).val());
              
                  
                });

           var lotnum = arraylotnumber.toString();



             var arrayexpiry=[];
           $( ".expiryclass" ).each(function() {

            if ($( this ).val().length > 0){
           
            arrayexpiry.push($( this ).val());
              
                  }
                });

           var expiry = arrayexpiry.toString();



            var arraymanf=[];
           $( ".manfclass" ).each(function() {

            if ($( this ).val().length > 0){
           
            arraymanf.push($( this ).val());
              
               }   
                });

           var manf = arraymanf.toString();

           


          // console.log(arraylotnumber);
           

           var arrayqty=[];
           
           $( ".qtyclass" ).each(function() {

            if ($( this ).val().length > 0){
           
            arrayqty.push(parseFloat($( this ).val()));
          }
         
                });

           
          var total=0;

        for (var i = 0; i < arrayqty.length; i++) {

              total += parseFloat(arrayqty[i]) ;
               
            }
           
            var mainqty=document.getElementById('mainqty').value;
            var array_qty = arrayqty.toString();

     
            if(Number(mainqty)==Number(total))
            {
               window.opener.updateRowToTable(lotnum,'<?php echo $itemid;?>','<?php echo $rowid;?>',array_qty,expiry,manf);
            self.close();
            }
            else
            {
              alert('Need to meet Issued Quantity');
              return false;
            }
            

            
            

           
          }
  }

  

  function checkqty(i=0)
{
  
  var Quantity=document.getElementById('Quantity'+i).value;
    var net_weight=document.getElementById('net_weight1').value;
    
  if(Number(Quantity) > Number(net_weight))
  {
    alert('Please enter valid Quantity');
    document.getElementById('Quantity'+i).value='';
    return false;
  }
}

function checklotno(i=0)
{

  //var lotno=document.getElementById('lotnonew'+i).value;
var lotno =$( "#lotnonew"+i ).val();
  //var lotno = $('#lotnonew'+i).find(":selected").text();
//alert(lotno);
  

  data = "ask=checklotnoedit&lotno=" + lotno+"&itemid="+'<?php echo $itemid;?>'+"&ivalue="+i;
  iAjax('ajax_materialissue.php?'+ data, item);
}

function item(result)
    {

        var x = JSON.parse(result);
        var invalid='Invalid';
       
        if(x.net_weight)
        {
          document.getElementById('net_weight').innerHTML = '';
          document.getElementById('net_weight').style.color = '';
          document.getElementById('net_weight').innerHTML = x.net_weight;
          document.getElementById('manf_date').innerHTML = x.manf_date;
          document.getElementById('expiry_date').innerHTML = x.expiry_date;
          document.getElementById('net_weight1').value = x.net_weight;

           document.getElementById('manf_date'+x.ivalue).value = x.manf_date;
          document.getElementById('expiry_date'+x.ivalue).value = x.expiry_date;
          
         
        }
        else{
          document.getElementById('net_weight').innerHTML = '';
           document.getElementById('manf_date').innerHTML = '';
          document.getElementById('expiry_date').innerHTML ='';
        document.getElementById('net_weight').style.color = 'red';
           document.getElementById('net_weight').innerHTML = invalid;
            document.getElementById('net_weight1').value = 0;
           return false;
      }
        }

$(document).ready(function() {


var itemid=document.getElementById('itemid').value;
//var ival=document.getElementById('ival').value;
//alert(ival);

  $('.add').on('click', function() {

    var ival=document.getElementById('ival').value;

    if(ival==''){ document.getElementById('ival').value=ival+1; ival=1;}

    data = "ask=appendfield&i=" + ival+"&itemid="+'<?php echo $itemid;?>';
  iAjax('ajax_materialissue.php?'+ data, appendfield);

    
  })
});

function appendfield(result)
{
//console.log(result);
  var field = result;
  var ival=document.getElementById('ival').value;
  
  var update=Number(ival)+Number(1);
  document.getElementById('ival').value=update;
  

    $('.appending_div').append(field);
 
    
    
}


/*$(document).ready(function() {
var i = 1;
  $('.add').on('click', function() {
    var field = '<br><div>Lot Number '+i+': <input type="text" class="lotclass" id="lotnonew'+i+'" name="lotnonew[]" onchange="checklotno('+i+');"> &nbsp; Quantity '+i+':  <input type="text" class="qtyclass" id="Quantity'+i+'" name="Quantity[]" onchange="checkqty('+i+');" ><input type="hidden" class="expiryclass" id="expiry_date'+i+'" name="expiry_date[]"  ><input type="hidden" class="manfclass" id="manf_date'+i+'" name="manf_date[]"  ></div>';
    $('.appending_div').append(field);
    i = i+1;
  })
})
*/
</script>

    <div id="content_inner">
    <div class="form_container" style="width:900px">
<form method="post" action="" name="manual_time_new" id="manual_time_new">
  <input type="hidden" name="mainqty" id="mainqty" value="<?php echo $mainqty;?>">
    <input type="hidden" name="itemid" id="itemid" value="<?php echo $itemid;?>">

  
    <table width="794" height="205" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px">  
     <tr>
     <td height="199">
    
     <table width="785" style="border:thin solid #6985CD;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px" >
        <tr width="106" height="25"> 
          <td>
            <div>
        <span style=" font-size: initial;"> Add New Lot Number: <span class="fa fa-plus add"></span></span>
      </div>

    <div class="appending_div" style=" font-size: initial;">
      <div>
      <table>
        <tr>
          <td>Lot Number:
          </td>
          <td>
            <?php $sql="SELECT barcode_id,lot_number,manf_date,expiry_date FROM `barcode` 
            WHERE item_id='{$itemid}' and status='1' ORDER BY `expiry_date` ASC  ";
            $mysql_query=mysql_query($sql);
         

            ?>
            <select name="lotnonew[]" id="lotnonew0" class="lotclass" onchange="checklotno();">
              <option>--Select--</option>

              <?php
              while($data=mysql_fetch_object($mysql_query))
              { ?>

            <option value="<?php echo $data->lot_number; ?>">Lot No-<?php echo $data->lot_number.'/ MANF - '.$data->manf_date .'/ EXP -'.$data->expiry_date; ?></option>

              <?php }


               ?>

            </select>
          </td>
          <td>Quantity</td>
          <td><input type="text" onchange="checkqty();" name="Quantity[]" class="qtyclass" id="Quantity0"></td>
        </tr>

      </table>
      <input type="hidden"  name="expiry_date[]" class="expiryclass" id="expiry_date0">
      <input type="hidden"  name="manf_date[]" class="manfclass" id="manf_date0">
       <input type='hidden'  name='ival' id='ival' >
    </div>
     <!--  <div>
         
      Lot Number: <input type="text" name="lotnonew[]" id="lotnonew0" class="lotclass" onchange="checklotno();" > &nbsp; Quantity:  <input type="text" onchange="checkqty();" name="Quantity[]" class="qtyclass" id="Quantity0">
      <input type="hidden"  name="expiry_date[]" class="expiryclass" id="expiry_date0">
      <input type="hidden"  name="manf_date[]" class="manfclass" id="manf_date0">
      </div> -->
    </div>
    <div>
    <div  style=" font-size: initial;">Available Quantity:<span id="net_weight" ></span> <input type="hidden" name="net_weight1" id="net_weight1" value=""> </div>
    <div  style=" font-size: initial;">Expiry Date:<span id="expiry_date" ></span>  </div>
     <div  style=" font-size: initial;">Manuf. Date:<span id="manf_date" ></span>  </div>
   </div>
  </td>
        
      </td>
     </tr>
  </table> 
<table width="785"> 
     <tr align="center">
         <td>
          
     <input name="button" type="button" onclick="updateparent()" value="Update"style="font-size: medium;" /> 

         </td>
     </tr>
  </table>
  </form> 
   <?php
    if($act=='edit') {
  ?>
  <script type="text/javascript">
 /* document.getElementById('lotnonew').value=window.opener.document.getElementById('<?php echo $itemid;?>').cells[1].innerHTML;*/
  
  </script>
  <?php } ?>