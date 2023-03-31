<?php

$mod = $_GET['mod'];

$page = $_REQUEST['page'];

$grid = $_POST['asn_grid'];



$branch_id=$_SESSION['SESS_LOGIN_BRANCH'];

?>

<script src="iAjax.js"></script>

<script type="text/javascript">

    // function f_dob1(){

    //     gfPop.fStartPop(document.manual_time_new.rejection_date,Date);

    //     }



$(document).ready(function() {

  $('#mainsubitemdiv').hide();

  $("#divitemgrid").hide();

  $("#addgridbutton").hide();

});





    function changedateformat() {

        datepicker = document.getElementById('rejection_date').value;

        var res = datepicker.split("/");

        date = res[1] + '-' + res[0] + '-' + res[2];

        document.getElementById('rejection_date').value = date;

        document.getElementById('addhgt').style.height = '0px';

    }



    function addhght() {



        document.getElementById('addhgt').style.height = '180px';

    }







</script>

<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1>Production Rejection Entry</h1>

            </div>

            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>

                    <li class="breadcrumb-item "><a href="#">Transaction</a></li>

                    <li class="breadcrumb-item active">Production Rejection Entry</li>

                </ol>

            </div>

        </div>

    </div>

    <!-- Main content -->

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





        <section class="content">

            <div class="container-fluid">

                <div class="card">

                    <div class="card-header">

                        <h3 class="card-title">Entry Details</h3>

                    </div>

                    <div class="col-md-12">

                        <form class="form-horizontal" action="prorej_entry_validate.php" method="post" name="manual_time_new" id="manual_time_new" autocomplete="off">

                            <div class="card-body">

                                <div class="col-md-12">

                                    <div class="form-group row">

                                        <!--first column-->

                                        <div class="col-md-6">

                                            <div class="form-group row">





                                                <label for="Scrap Value" class="col-sm-4 control-label">Route Card Number:<font color="#FF0000" size="">*</font> </label>

                                                <div class="col-sm-7">

                                                    <select name="routeno" id="routeno"  class="form-control select2" onchange="auto_value();">

                                                        <option value="">--select--</option>

                                                        <?php

                         $sql = "SELECT route_card.ROUTE_CARD_NUMBER FROM `route_card` 

                                 INNER JOIN route_card_pick_list ON route_card.ROUTE_CARD_ID=route_card_pick_list.ROUTE_CARD_ID 

                                  WHERE `STATUS`='1' AND route_card.ORGANIZATION_ID='{$branch_id}' GROUP BY route_card.ROUTE_CARD_NUMBER ";

                         $res = mysql_query($sql);

                          while ($data = mysql_fetch_object($res)) 

                          { ?>

                           <option value="<?php echo $data->ROUTE_CARD_NUMBER ?>"><?php echo $data->ROUTE_CARD_NUMBER ?></option>

                             <?php } ?>

                          </select>
                          <p id='pid_routeno' style="display: none;"></p>
                                                </div>

                                            </div>

                                        </div>

                                        <!--second column-->



                                        <div class="col-md-6">

                                            <div class="form-group row">

												<label for="Scrap Value" class="col-sm-4 control-label">Rejection Date:<font color="#FF0000" size="">*</font> </label>

                                                <div class="col-sm-7 input-group">
													<div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                                    <input type="text" name="rejection_date" id="rejection_date" class="form-control form-control-sm has-datepicker pull-right"  size="32" value="<?php ?>" onchange="changedateformat()"  onclick="addhght()"  readonly="readonly">
                                                       
                                                </div>
                                                <p id='pid_rejection_date' style="display: none;padding-left: 250px;"></p>
                                            </div>

                                        </div>

                                    </div>
								<div class="form-group row"  id="addhgt"></div>







                                    <div class="form-group row">

                                        <div class="col-md-6">

                                            <div class="form-group row">





                                                <label for="Scrap Value" class="col-sm-4 control-label">Produced Item:<font color="#FF0000" size="">*</font> </label>

                                                <div class="col-sm-7" id="produceditemdiv">

                                                    <input type="text" name="produceditem" id="produceditem" class="form-control form-control-sm readonly"  size="32" value="<?php ?>" readonly="readonly">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group row">





												<label for="Scrap Value" class="col-sm-4 control-label">Rejection Quantity:<font color="#FF0000" size="">*</font> </label>

                                                <div class="col-sm-7">

                                                    <input type="text" name="rqty" id="rqty" class="form-control form-control-sm"  size="32" value="<?php ?>" >

                                                     <p id='pid_rqty' style="display: none;"></p>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    





                                    <div class="form-group row"  id="addhgt"></div>





                                    <label for="Scrap Value" >Remaining Material Details<font color="#FF0000" size=""></font> </label>



                                    <!--grid-->

                                    <div class="card-body table-responsive p-0" >

                                        <table class="table  table-head-fixed">

                                            <thead>

                                                <tr>

                                                    <th>Sl.no</th>

                                                    <th>Sub Item </th>

                                                    <th>Remaining Sub Item Quantity</th>





                                                </tr>

                                            </thead>

                                            <tbody id="asn_grid">



                                            </tbody>

                                        </table>

                                    </div> 

                                    <div class="card-header"></div>&nbsp;

                                     <div class="form-group row">

                                        <div class="col-md-12">

                                            <div class="form-group row">





                                                <label for="Scrap Value" class="col-sm-4 control-label">Do you want to Re-issue items for pending Production? </label>

                                                <div class="col-sm-3">

                                                    <input type="checkbox" name="checktick" id="checktick"   value="YES" onChange="itemreissue();" >

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-group row" id="mainsubitemdiv">

                                        <div class="col-md-6">

                                            <div class="form-group row">





                                                <label for="Scrap Value" class="col-sm-4 control-label">Sub Item:<font color="#FF0000" size="">*</font> </label>

                                                <div class="col-sm-7" id="subitemdiv" >

                                                   

                                                </div>
                                                   <p id='pid_subitem' style="display: none;"></p>

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group row">





                                                <label for="Scrap Value" class="col-sm-4 control-label">Quantity:<font color="#FF0000" size="">*</font> </label>

                                                <div class="col-sm-7">

                                                    <input type="text" name="sqty" id="sqty" class="form-control form-control-sm"  size="32" value="<?php ?>" >

                                                    <p id='pid_sqty' style="display: none;"></p>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <div class="col-md-6">

                                            <div class="form-group row" id="addgridbutton">



                                                <input type="button" value="ADD TO GRID" class="btn btn-primary"  onclick="additemgrid()"/>

                                                &nbsp;

                                                <input type="button" name="reset"  class="btn btn-default" value="Reset" onclick=""/>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-group row" >

                                    </div>

                                    <div class="form-group row" >

                                    </div>

                            <!--grid-->

                        <div class="card-body table-responsive p-0" id="divitemgrid" >

                        <table class="table  table-head-fixed" id="grnitemgrid">

                                <thead>

                                <tr>

                                <th>Sl.no</th>

                                <th>Item Name</th>

                                <th>Quantity</th>

                                <th>Option</th>

                                </tr>

                                </thead>

                            <tbody id="grngridbody">

                            </tbody>

                        </table>

                        </div> 
                           <div class="card-header"></div>&nbsp;
                                    <div class="form-group row">

                                        <div class="col-md-6">

                                            <div class="form-group row">



                                                <input type="button" value="confirm" class="btn btn-primary"  onclick="check()"/>

                                                &nbsp;

                                                <input type="button" name="reset" class="btn btn-default" value="Reset" onclick="clearall()"/>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>



                        </form>

                        <script>



                            function check()

                            {
                                if ( checkEmpty('routeno','pid_routeno') )
                                {
                                    document.getElementById('routeno').focus();
                                    return false;
                                }
                              else if ( checkEmpty('rejection_date','pid_rejection_date') )
                                {
                                    document.getElementById('rejection_date').focus();
                                    
                                    // document.getElementById('rejection_date').value="";
                                    
                                    
                                }
                             
                                 else if ( checkEmpty('rqty','pid_rqty') )
                                {
                                    document.getElementById('rqty').focus();
                                    
                                }
                                  else if ( checkInteger('rqty','pid_rqty') )
                                {
                                    document.getElementById('rqty').focus();
                                    
                                }
                               else

                                {

                                    document.manual_time_new.submit();

                                }

                            }



                            function itemreissue(){

                                

                                    

                                   

                                        

                                        if(document.getElementById('checktick').checked =true){

                                            if(document.forms.manual_time_new.routeno.value=='')

                                                {
                                                    document.getElementById('pid_routeno').style.display = "";
                                                    document.getElementById('pid_routeno').style.color = "red";
                                                    document.getElementById('pid_routeno').innerHTML = "Please Select Route Card Number";
                                                    document.getElementById('routeno').focus();
                                                   // alert("Please Select Route Card Number");

                                                    document.getElementById("checktick").checked = false;

                                                    return false;



                                                }

                                            $("#mainsubitemdiv").show();

                                            $("#divitemgrid").show();

                                            $("#addgridbutton").show();

                                            

                                            

                                            data = "ask=addsubitem&routeno=" + document.forms.manual_time_new.routeno.value;

                                            iAjax('ajax_production_rejection_entry.php?' + data,reissuegrid);

                                        }

                                        else

                                        {

                                             $("#mainsubitemdiv").hide();

                                             $("#divitemgrid").hide();

                                             $("#addgridbutton").hide();

                                        }

                                        

                                    

                                

                            }

                            function reissuegrid(result)



                            {



                                 document.getElementById('subitemdiv').innerHTML = result;


                            }
                            function classadd(){
                                    $("#subitem").addClass("select2");
                            }

                            function auto_value()

                            {



                                data = "ask=addtogrid&routeno=" + document.forms.manual_time_new.routeno.value;

                                iAjax('ajax_production_entry.php?' + data, routegrid);

                                

                                //get produced item

                                

                                data1 = "ask=produceditem&routeno=" + document.forms.manual_time_new.routeno.value;

                                iAjax('ajax_production_entry.php?' + data1, produceditem);

                                

                            }



                            function routegrid(result)

                            {

                                document.getElementById('asn_grid').innerHTML = result;





                            }



                            function produceditem(result){

                                

                                document.getElementById('produceditemdiv').innerHTML=result;

                            }



                            function clearProductSelectors()

                            {

                                window.location.reload();

                            }



                            function clearall()

                            {

                                clearProductSelectors();

                            }



var Rows1=1;  

var SlNo1=1; 



    function additemgrid()

    {



             var itemid = document.getElementById('subitem').value;

            var qty=document.getElementById('sqty').value;

            if (checkEmpty('subitem','pid_subitem'))
        {
            document.manual_time_new.subitem.focus();
        } 
        else if (checkEmpty('sqty','pid_sqty'))
        {
            document.getElementById('sqty').focus();
        } 
        else if (checkInteger('sqty','pid_sqty'))
        {
            document.getElementById('sqty').focus();
        } 
          
            else{

            var e = document.getElementById('subitem');

            var item = e.options[e.selectedIndex];

            var partno = item.getAttribute("data-itemid");

            var itemname = item.getAttribute("data-itemname");

         

            var allpartids = document.getElementsByName('partid[]');

            

            for(i=0;i<allpartids.length;i++){

                if(itemid == allpartids[i].value){
                    document.getElementById('pid_subitem').style.display = "";
                    document.getElementById('pid_subitem').style.color = "red";
                    document.getElementById('pid_subitem').innerHTML = "Item already added";
                    //alert("Item already added.");
                    document.getElementById('subitem').focus();
                    return false;

                }

            }

            

            

            var grid = document.getElementById('grnitemgrid');

            var lastRow = grid.rows.length;

            // if there's no header row in the table, then iteration = lastRow + 1   

            var iteration = lastRow;

            var row = grid.insertRow(lastRow);

            row.setAttribute('id', 'row' + Rows1);

            lastRow++;



            // first cell  

            var cellLeft = row.insertCell(0);

            var textNode = document.createTextNode('');

            cellLeft.appendChild(textNode);

            cellLeft.innerHTML = SlNo1;



            // second cell 

            var cell1 = row.insertCell(1);

            var textNode = document.createTextNode('');

            cell1.appendChild(textNode);

            cell1.align = "left";

            cell1.innerHTML = itemname;

      

            // second cell 

            var cell2 = row.insertCell(2);

            var textNode = document.createTextNode('');

            cell2.appendChild(textNode);

            cell2.align = "left";

            cell2.style.display='none';

            cell2.innerHTML = partno;



            var cell3 = row.insertCell(3);

            var textNode = document.createTextNode('');

            cell3.appendChild(textNode);

            cell3.align = "center";

            cell3.innerHTML = qty;





            var cellRight = row.insertCell(4);

            var textNode = document.createTextNode('');

            cellRight.appendChild(textNode);

            cellRight.align = "center";

            cellRight.innerHTML = "<a href='#' onclick='deleterow(\"row" + Rows1 + "\"," + SlNo1 + ")'><img src=\"images/delete.png\" width=\"18\" height=\"18\" title='Delete'/></a><input type='hidden' name='partid[]' id='partid' value='" + itemid + "'><input type='hidden' name='sqty1[]' id='sqty1' value='" + qty + "'>";





            rowreset();

            Rows1++;

            SlNo1++;

           

        }



    }

    function rowreset()

    {

    document.getElementById('subitem').value="";

    document.getElementById('sqty').value="";

    document.getElementById('itemname').focus();

    }

    function deleterow(id,slno)

{   

    

if(confirm("Are you sure you want to delete this Item?"))

{



var r = document.getElementById(id);



r.parentNode.removeChild( r );  

var tbl = document.getElementById('grnitemgrid');

var lastRow = tbl.rows.length;  

for(i=1;i<lastRow;i++) 

{ 

r=document.getElementById('grnitemgrid').rows[i]; 

r.cells[0].innerHTML=i;

}      

SlNo1--;    

Rows1--;  

}





}











                            $(function () {

                                $("#rejection_date").datepicker();

                            });



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


                    </div>

                </div>

            </div>

        </section>

</div>