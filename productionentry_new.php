<?php

$mod = $_GET['mod'];
$page = $_REQUEST['page'];
$currentdate = date("d-m-Y");
  $yr=date("y");
      $nm='/';
      $m=date("m");
      $prefix='PE'.$yr.$m;
      $len=strlen($prefix);

 $sql1="SELECT CONCAT('$prefix',LPAD(max_Production_No+1,GREATEST(5,LENGTH(max_Production_No+1)),'0')) Production_No FROM
(SELECT IFNULL( MAX(SUBSTRING(`Production_No`,$len+1)),'0') max_Production_No FROM  production_entry WHERE Production_No LIKE '$prefix%') p2";
$res1=mysql_query($sql1);
$data1=mysql_fetch_object($res1);
 $Production_No=$data1->Production_No;



?>
<script src="iAjax.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script type="text/javascript">
    function check()
    { 
        if(checkEmpty('prod_no','pid_prod_no'))
            {
                 document.getElementById('prod_no').focus();
                return false;
            }
        else if ( checkEmpty('date','pid_date') )
            {
                document.getElementById('date').focus();
                return false;
            }
            else if(checkEmpty('plan_order','pid_plan_order'))
            {
                 document.getElementById('plan_order').focus();
                return false;
            }
              
               else if(checkEmpty('shift','pid_shift'))
            {
                 document.getElementById('shift').focus();
                return false;
            }


                 else if(checkEmpty('itemname','pid_itemname'))
            {
                 document.getElementById('itemname').focus();
                return false;
            }
                 else if(checkEmpty('pqty','pid_pqty'))
            {
                 document.getElementById('pqty').focus();
                return false;
            }
                 else if(checkEmpty('spq','pid_spq'))
            {
                 document.getElementById('spq').focus();
                return false;
            }
            else if(checkFloat('pqty','pid_pqty'))
            {
                 document.getElementById('pqty').focus();
                return false;
            }
             else if(checkFloat('spq','pid_spq'))
            {
                 document.getElementById('spq').focus();
                return false;
            }


             else if(checkEmpty('activity','pid_activity'))
            {
                 document.getElementById('activity').focus();
                return false;
            }
               else if(checkEmpty('batch','pid_batch'))
            {
                 document.getElementById('batch').focus();
                return false;
            }



                else if(checkEmpty('dom','pid_dom'))
            {
                 document.getElementById('dom').focus();
                return false;
            }
            
                else if(checkEmpty('expiry_date','pid_expiry_date'))
            {
                 document.getElementById('expiry_date').focus();
                return false;
            }
            
                else if(checkEmpty('netweight','pid_netweight'))
            {
                 document.getElementById('netweight').focus();
                return false;
            }
            
                else if(checkEmpty('grossweight','pid_grossweight'))
            {
                 document.getElementById('grossweight').focus();
                return false;
            }
            
                else if(checkEmpty('bcount','pid_bcount'))
            {
                 document.getElementById('bcount').focus();
                return false;
            }
            

              else if(checkFloat('grossweight','pid_grossweight'))
            {
                 document.getElementById('grossweight').focus();
                return false;
            }
             else if(checkFloat('netweight','pid_netweight'))
            {
                 document.getElementById('netweight').focus();
                return false;
            }
             else if(checkFloat('bcount','pid_bcount'))
            {
                 document.getElementById('bcount').focus();
                return false;
            }
             else if(checkEmpty('prodqty','pid_prodqty'))
            {
                 document.getElementById('prodqty').focus();
                return false;
            }
               else if(checkFloat('prodqty','pid_prodqty'))
            {
                 document.getElementById('prodqty').focus();
                return false;
            }
            
            
            else
            {

                document.manual_time_new.submit();

            }


    }





    function check_code()
    {
        var plan_order = document.getElementById('plan_order').value;
        if(plan_order)
        {
            data = "ask=get_item_order&plan_order=" + document.getElementById('plan_order').value;
            iAjax('ajax_production_entry_new.php?'+ data, item);
            document.getElementById('plan_order').focus();

        }else
        {
           document.getElementById('pid_plan_order').style.display = "";
            document.getElementById('pid_plan_order').style.color = "red";
            document.getElementById('pid_plan_order').innerHTML = "Please Pick A Plan Order";
            document.getElementById('plan_order').focus();
        }
    }



    function item(result)
    {
        
          if (result.trim() == "1")
        {  
            document.getElementById('pid_plan_order').style.display = "";
            document.getElementById('pid_plan_order').style.color = "red";
            document.getElementById('pid_plan_order').innerHTML = "Enter A Valid Production Order Number";
            
            //alert("Enter A Valid Job Card Number");
            document.getElementById('plan_order').value = "";
            document.getElementById('itemname').value = "";
            document.getElementById('routecardgridbody').innerHTML = "";
            document.getElementById('plan_order').focus();
        } else
        {
           
            document.getElementById('itemname').innerHTML = result;
            data = "ask=planned_qty&plan_order=" + document.getElementById('plan_order').value;
            iAjax('ajax_production_entry_new.php?' + data, qty);
        }
       
    }

    function qty(result)
    {
        var x = JSON.parse(result);
        
        document.getElementById('pqty').value=x.Order_Qty;

        data = "ask=get_item_details&itemname=" + document.getElementById('itemname').value;
        iAjax('ajax_production_entry_new.php?' + data, item_details);
       
    }
    function item_details(result)
    {
        var x = JSON.parse(result);
        document.getElementById('topacking').value=x.Pack_Typ;
        document.getElementById('uom').value=x.Uom;
        document.getElementById('spq').value=x.Spq_Quantity;
    }

     function check_order_qty(result)
    {
   
        var pending_qty=   document.getElementById('pending_qty').value;
        var order_qty=document.getElementById('order_qty').value;

        if(Number(order_qty) > Number(pending_qty))
        {
            alert('Order Quantity Cannot be Greater than Pending Quantity');
              document.getElementById('order_qty').value='';
            document.getElementById('order_qty').focus()
            return false;

        }
 
        
        
       
    }

    
 function calc_prodqty() {
        
        netweight = document.getElementById('netweight').value;
        bcount = document.getElementById('bcount').value;
        
       if(netweight != '')
        {  if(checkFloat('netweight','pid_netweight'))
            {
                alert('Enter Valid Number');
                 document.getElementById('netweight').focus();
                return false;
            }
        }
       if(bcount != '')
        {  if(checkFloat('bcount','pid_bcount'))
            {
                alert('Enter Valid Number');
                 document.getElementById('bcount').focus();
                return false;
            }
        }

         pqty=bcount*netweight;
        
        document.getElementById('prodqty').value=pqty.toFixed(2);
   
        
    }

    function clearProductSelectors()
    {

        window.location.reload();
    }
    function clearall() {
        clearProductSelectors();

    }


      function barcodeprint(production_id,size,barcodestart_id){
                                    
                                    production_id = production_id || false;
                                    
                                    if(!production_id) return;
                                    
                                    
                                    
                                    printpage = 'barcodeprint_validation2.php'; 
                                    
                                    
                                    
                                    var printWindow = window.open(printpage+"?src=production&production_id="+production_id+"&size="+size+"&barcodestart_id="+barcodestart_id, "", "width=300,height=200");
                                    
                                    
                                    
                                }
                                
                                
                                
                                <?php if($_GET['production_id']){ echo "barcodeprint('".$_GET['production_id']."','".$_GET['size']."','".$_GET['barcodestart_id']."')"; } ?>
  
</script>
<?php
$msg = $_GET['msg'];
$errmsg = $_GET['errmsg'];
// print_r($_SESSION);
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Production Entry</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item "><a href="#">Transaction</a></li>
                    <li class="breadcrumb-item active">Production Entry</li>
                </ol>
            </div>
        </div>
    </div>

    <section class="content">
        <?php if ($msg != '' or $errmsg != '') { ?>
            <div class="alert alert-<?php if ($_GET['msg']) echo 'success';
            if ($_GET['errmsg']) echo 'danger'; ?>  alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa  fa-info" style="margin-right:0.5em;"></i>
                <?php if ($_GET['msg']) echo $msg;
                else echo $errmsg; ?>
            </div>
<?php } ?>

        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Enter Details</h3>
                </div>
                <div class="col-md-12">

                    <form class="form-horizontal" action="production_entry_new_validate.php" method="post" name="manual_time_new" id="manual_time_new" autocomplete="off" >
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <input type="hidden"  name="stock" id="stock">
                                     <input type="hidden"  name="status" id="status">
                                    
                                    <!--first column-->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-4 control-label"> Production Number:<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-7">
                                                <input type="text"  name="prod_no" readonly="readonly" class="form-control form-control-sm" id="prod_no" class="" value="<?=$Production_No?>" readonly="readonly" size="10" >

                                            </div>
                                            <p id='pid_prod_no' style="display: none;"></p>
                                        </div>
                                    </div>
									
									
                              <div class="col-md-6">
                                        
                                            <div class="form-group row">
                                                <label for="Scrap Value" class="col-sm-4 control-label">Date:<font color="#FF0000" size="">*</font> </label>
                                                <div class="col-sm-7 input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                                    <input type="text" name="date" id="date" class="form-control form-control-sm has-datepicker pull-right" readonly="readonly" value="<?php echo $currentdate; ?>" autocomplete="off" >
                                                </div>
                                                 <p id='pid_date' style="display: none;"></p>
                                            </div>
                                        
                                    </div>
                                   
									<!--second column-->

                               
                                   
                                    
                                </div>
                            <div class="form-group row"  id="addhgt"></div>
                              

                                <div class="form-group row">
                                        <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-4 control-label"> Production Order:<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-7" >
                                                <select name="plan_order" id="plan_order"  class="form-control select2" onchange="check_code()"> 

                                                    <option value="">---Select---</option>
                                                    <?php

                                                          $sql1 = "SELECT `Production_Order_Id`,`Prod_Order` FROM `production_order` WHERE `Del_Status`=0 AND status=0 ORDER BY Prod_Order" ;
                                                     $res1 = mysql_query($sql1);

                                                    while ($data1 = mysql_fetch_object($res1)) {
                                                        ?>

                                                    <option value="<?php echo $data1->Production_Order_Id; ?>"><?php echo $data1->Prod_Order; ?></option>

                                                    <?php
                                                    }
                                                    ?>


                                                 </select>
                                                 <p id='pid_plan_order' style="display: none;"></p>
                                            </div>

                                        </div>
                                    </div>
                                   
                                        <div class="col-md-6">
                                            
                                            <div class="form-group row">
                                                
                                                <label for="Scrap Value" class="col-sm-4 control-label">Shift:<font color="#FF0000" size="">*</font> </label>
                                                
                                                <div class="col-sm-7">
                                                    
                                                    <select name="shift" id="shift"  class="form-control select2" >
                                                        
                                                        <option value="">--select--</option>
                                                        <option value="D">Day</option>
                                                        <option value="F">First</option>
                                                        <option value="N">Night</option>
                                                        
                                                        
                                                        
                                                    </select>
                                                    <p id='pid_shift' style="display: none;"></p>
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                             
                                     
                                    

                                   
                                    
                                </div>
                                  <div class="form-group row">

                                            <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-4 control-label"> Production Item:<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-7" >
                                                <select name="itemname" id="itemname"  class="form-control select2" > 

                                                    <option value="">---Select---</option>
                                                    <?php

                                                          $sql1 = "SELECT `Item_Id`,`Item_Name` FROM `item_master` WHERE `Item_Del`=0 AND `Type`='FG' AND BarcodeEnabled='1' ORDER BY Item_Name" ;
                                                     $res1 = mysql_query($sql1);

                                                    while ($data1 = mysql_fetch_object($res1)) {
                                                        ?>

                                                    <option value="<?php echo $data1->Item_Id; ?>"><?php echo $data1->Item_Name; ?></option>

                                                    <?php
                                                    }
                                                    ?>


                                                 </select>
                                                 <p id='pid_itemname' style="display: none;"></p>
                                            </div>

                                        </div>
                                    </div>
                                      <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-4 control-label"> Type Of Packing:<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-7">
                                                <input type="text"  name="topacking" class="form-control form-control-sm" id="topacking" readonly="readonly"  value=""  >
                                                 <p id='pid_topacking'  style="display: none;"></p>
                                            </div>

                                        </div>


                                    </div>
                                  </div>

                                <div class="form-group row">
                                      <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-4 control-label"> Planned Quantity:<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-7">
                                                <input type="text"  name="pqty" class="form-control form-control-sm" id="pqty" readonly="readonly"  value=""  >
                                                 <p id='pid_pqty'  style="display: none;"></p>
                                            </div>

                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-4 control-label"> Uom:<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-7">
                                                <input type="text"  name="uom" class="form-control form-control-sm" id="uom" readonly="readonly"  value=""  >
                                                 <p id='pid_uom'  style="display: none;"></p>
                                            </div>

                                        </div>


                                    </div>
                                    
                                    
                                </div>
                                         <div class="form-group row">
                                      <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-4 control-label"> SPQ:<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-7">
                                                <input type="text"  name="spq" class="form-control form-control-sm" id="spq"   value=""  >
                                                 <p id='pid_spq'  style="display: none;"></p>
                                            </div>

                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-4 control-label"> Activity:<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-7">
                                                <select id="activity" name="activity" class="form-control select2" >

                                                    <option value="">---Select---</option>
                                                    <option value="1">Manufactured</option>
                                                    <option value="2">Re-Packed</option>
                                                    <option value="3">Re-Processed</option>
                                                    <option value="4">Re-Worked</option>
                                                </select>
                                                 <p id='pid_activity'  style="display: none;"></p>
                                            </div>

                                        </div>


                                    </div>
                                    
                                    
                                </div>
                                     <div class="form-group row">
                                      <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="Scrap Value" class="col-sm-4 control-label"> Batch No:<font color="#FF0000" size="">*</font> </label>
                                            <div class="col-sm-7">
                                                <input type="text"  name="batch" class="form-control form-control-sm" id="batch"   value=""  >
                                                 <p id='pid_batch'  style="display: none;"></p>
                                            </div>

                                        </div>


                                    </div>
                                     <div class="col-md-6">
                                        
                                            <div class="form-group row">
                                                <label for="Scrap Value" class="col-sm-4 control-label">Date Of Manufacture:<font color="#FF0000" size="">*</font> </label>
                                                <div class="col-sm-7 input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                                    <input type="text" name="dom" id="dom" class="form-control form-control-sm has-datepicker pull-right" readonly="readonly" autocomplete="off" >
                                                </div>
                                                 <p id='pid_dom'  style="display: none;"></p>
                                            </div>
                                        
                                    </div>
                                    
                                    
                                </div>
                             
                                <div class="form-group row"  id="addhgt"></div>
                              
                              <div class="form-group row">
                                    
                                     <div class="col-md-6">
                                        
                                            <div class="form-group row">
                                                <label for="Scrap Value" class="col-sm-4 control-label">Expiry Date:<font color="#FF0000" size="">*</font> </label>
                                                <div class="col-sm-7 input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                                    <input type="text" name="expiry_date" id="expiry_date" class="form-control form-control-sm has-datepicker pull-right" readonly="readonly" autocomplete="off" >
                                                </div>
                                                 <p id='pid_expiry_date'  style="display: none;"></p>
                                            </div>
                                        
                                    </div>
                                    
                                        <div class="col-md-6">
                                            
                                            <div class="form-group row">
                                                
                                                <label for="Scrap Value" class="col-sm-4 control-label">Net Weight:<font color="#FF0000" size="">*</font> </label>
                                                
                                                <div class="col-sm-7">
                                                    
                                                    <input type="text" name="netweight" id="netweight" class="form-control form-control-sm  readonly"  size="32" value="<?php ?>" onkeyup="calc_prodqty()"; >
                                                    <p id='pid_netweight' style="display: none;"></p>
                                                </div>
                                            </div>
                                        </div>
                                    
                                </div>

                             <div class="form-group row"  id="addhgt"></div>
                              <div class="form-group row">
                                    
                                   <div class="col-md-6">
                                            
                                            <div class="form-group row">
                                                
                                                <label for="Scrap Value" class="col-sm-4 control-label">Gross Weight:<font color="#FF0000" size="">*</font> </label>
                                                
                                                <div class="col-sm-7">
                                                    
                                                    <input type="text" name="grossweight" id="grossweight" class="form-control form-control-sm  readonly"  size="32" value="<?php ?>" >
                                                    <p id='pid_grossweight' style="display: none;"></p>
                                                </div>
                                            </div>
                                        </div>
                                    
                                       
                                        
                                        
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="Scrap Value" class="col-sm-4 control-label">No. of Barcodes:<font color="#FF0000" size="">*</font> </label>
                                                
                                                <div class="col-sm-7">
                                                    
                                                    <input type="text" name="bcount" id="bcount" class="form-control form-control-sm"  size="32" value="<?php ?>" onkeyup="calc_prodqty()";>
                                                    <p id='pid_bcount' style="display: none;"></p>
                                                    
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    
                                </div>
                                <div class="form-group row">
                                        <div class="col-md-6">
                                            
                                            <div class="form-group row">
                                                
                                                <label for="Scrap Value" class="col-sm-4 control-label">Production Quantity:<font color="#FF0000" size="">*</font> </label>
                                                
                                                <div class="col-sm-7">
                                                    
                                                    <input type="text" name="prodqty" id="prodqty" class="form-control form-control-sm  readonly"  size="32" value="<?php ?>" readonly="readonly">
                                                </div>
                                                 <p id='pid_prodqty' style="display: none;"></p>
                                            </div>
                                        </div> 
                                  <div class="col-md-6">

                                    <div class="form-group row">

                                        <label for="Scrap Value" class="col-sm-4 control-label">Remark:<font color="#FF0000" size=""></font> </label>

                                        <div class="col-sm-7" >

                                            <textarea name="remark" id="remark" class="form-control form-control-sm" value=""  size="32" ></textarea>

                                        </div>

                                    </div>

                                </div>
                                    
                                    
                                </div>
                                        <div class="card-header"></div>&nbsp;
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-group row">

                                            <input type="button" class="btn btn-primary" value="Save"  onclick="check()"/>
                                            &nbsp;

                                            <input type="button" class="btn btn-default" name="reset" value="Reset" onclick="clearall()"/>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                </form>

            </div>
    </section>
</div>
<script>
  
$( function() {

$( "#dom" ).datepicker();
$( "#expiry_date" ).datepicker();

} );

</script>
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