<?php



$mod = $_GET['mod'];



$page = $_REQUEST['page'];



$grid = $_POST['despatch_grid'];











// $yr=date("y");



// $sql1="SELECT CONCAT('$yr',LPAD(max_gate_no+1,GREATEST(5,LENGTH(max_gate_no+1)),'0')) gateno FROM 



// (SELECT IFNULL( MAX(SUBSTRING(`gate_no`, 3)),'0') max_gate_no FROM gate_entry WHERE gate_no LIKE '$yr%') p2";



// $res1=mysql_query($sql1);



// $data1=mysql_fetch_object($res1);



// $gate_id=$data1->gateno;







$yr = 'OSPO' . date('y');



$len = strlen($yr);



$sqlserialno = "SELECT CONCAT('$yr',LPAD(max_OSP_OUTWARD_NUMBER+1,GREATEST(5,LENGTH(max_OSP_OUTWARD_NUMBER+1)),'0')) `OSP_OUTWARD_NUMBER` FROM (SELECT IFNULL( MAX(SUBSTRING(`OSP_OUTWARD_NUMBER`,$len+1)),'0') max_OSP_OUTWARD_NUMBER FROM osp_outward WHERE OSP_OUTWARD_NUMBER LIKE '$yr%') P2";



$resserialno = mysql_query($sqlserialno);



$data1 = mysql_fetch_object($resserialno);



$OSP_OUTWARD_NUMBER = $data1->OSP_OUTWARD_NUMBER;



?>



<script src="iAjax.js"></script>



<script type="text/javascript">



    // function f_dob1(){



    //     gfPop.fStartPop(document.manual_time_new.date,Date);



    //     }











    function changedateformat() {



        datepicker = document.getElementById('datepicker').value;



        var res = datepicker.split("/");



        date = res[1] + '-' + res[0] + '-' + res[2];



        document.getElementById('datepicker').value = date;



        document.getElementById('addhgt').style.height = '0px';



    }







    function addhght() {







        document.getElementById('addhgt').style.height = '180px';



    }





function GetDetails()

{

	var types =document.getElementById("types").value;

	if(types){

		var data="ask=getDetails&types="+types;

		iAjax('ajax_dispacthsearch.php?' + data, sucessDe);

	}

}

function sucessDe(result)

{

	document.getElementById("delvto").innerHTML=result;

}





	function getpicklist(outward_id)

    {

        // alert(route_picklist_id);

        outward_id = outward_id || false;

        if (!outward_id)

		return;

		

        /*	confirmed = confirm("Do you want to print barcodes now?");

		if(!confirmed) return;*/

		

        var printWindow = window.open("outward_picklist.php?srcoutwardplan&outward_id=" + outward_id, "", "width=300,height=200,resizable=yes,scrollbars=yes");

		

	}

	<?php

		if ($_GET['outward_id']) {

			// echo "getaswin()";

			echo "getpicklist('" . $_GET['outward_id'] . "')";

		}

	?>



</script>



<div class="content-header">



    <div class="container-fluid">



        <div class="row mb-2">



            <div class="col-sm-6">



                <h1>OSP Outward Entry</h1>



            </div>



            <div class="col-sm-6">



                <ol class="breadcrumb float-sm-right">



                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>



                    <li class="breadcrumb-item "><a href="#">Transaction</a></li>



                    <li class="breadcrumb-item active">OSP Outward Entry</li>



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



                        <form class="form-horizontal" action="OSP_outward_entry_validate.php" method="post" name="manual_time_new" id="manual_time_new" autocomplete="off">



                            <div class="card-body">



                                <div class="col-md-12">



                                    <div class="form-group row">



                                        <!--first column-->







                                        <div class="col-md-6">



                                            <div class="form-group row">



                                                <label for="Scrap Value" class="col-sm-4 control-label">OSP Outward Number:<font color="#FF0000" size=""></font> </label>



                                                <div class="col-sm-7">



                                                    <input type="text" name="disno" id="disno" class="form-control form-control-sm"  size="32" value="<?php echo $OSP_OUTWARD_NUMBER ?>"  >



                                                </div>



                                            </div>



                                        </div>







                         



                                        <div class="col-md-6">



                                            <div class="form-group row">



                                                <label for="Scrap Value" class="col-sm-4 control-label"> OSP Outward  Date:<font color="#FF0000" size="">*</font> </label>



                                                <div class="col-sm-7 input-group">

                                                <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>





                                                    <input type="text" name="datepicker" id="datepicker" class="form-control form-control-sm has-datepicker pull-right" readonly="readonly"  onchange="changedateformat()" onclick="addhght()"> 



                                                </div>

                                                <p id='pid_datepicker' style="display: none;padding-left: 250px;"></p>

                                            </div>



                                        </div>



                                    </div>

                                    <div class="form-group row"  id="addhgt"></div>



                                    <!--second column-->







                                    <div class="form-group row">	  



                                        



                                        <div class="col-md-6">



                                            <div class="form-group row">



                                                <label for="Scrap Value" class="col-sm-4 control-label">OSP Outward Type:<font color="#FF0000" size="">*</font> </label>



                                                <div class="col-sm-7">







                                                    <select name="types" id="types"  class="form-control select2" onChange="GetDetails();">



                                                        <option value="">--select--</option>



                                                        <option value="1">Branch Transfer</option>



                                                        <option value="2">Party Transfer</option>



                                                    </select> 

													<p id='pid_types' style="display: none;"></p>

                                                </div>



                                            </div>



                                        </div>



                                        <div class="col-md-6">



                                            <div class="form-group row">



                                                <label for="Scrap Value" class="col-sm-4 control-label">Delivary To:<font color="#FF0000" size=""></font> </label>



                                                <div class="col-sm-7">



                                                   <select name="delvto" id="delvto"  class="form-control select2" >



                                                        <option value="">--select--</option>



                                                        <?php 



                                                        $sql="SELECT Vendor_Name,Vendor_Id FROM vendormaster WHERE Vendor_Del=0";



                                                        $query=mysql_query($sql);



                                                        while($data=mysql_fetch_object($query))



                                                        { ?>



                                                        <option value="<?php echo $data->Vendor_Id ;?>"><?php echo $data->Vendor_Name ;?></option>



                                                         <?php }







                                                         ?>



                                                    </select> 

													<p id="pid_delvto" style="display:none;">

                                                </div>



                                            </div>



                                        </div>



                                       



                                    </div>   







                                    <div class="form-group row">



                                        



                                         <div class="col-md-6">



                                            <div class="form-group row">



                                                <label for="Scrap Value" class="col-sm-4 control-label">Driver Name:<font color="#FF0000" size=""></font> </label>



                                                <div class="col-sm-7">



                                                    <input type="text" name="dname" id="dname" class="form-control form-control-sm has-datepicker pull-right"  > 



                                                </div>



                                            </div>



                                        </div>







                                        <div class="col-md-6">



                                            <div class="form-group row">



                                                <label for="Scrap Value" class="col-sm-4 control-label">Vehicle Number:<font color="#FF0000" size=""></font> </label>



                                                <div class="col-sm-7">



                                                    <input type="text" name="dvecno" id="dvecno" class="form-control form-control-sm has-datepicker pull-right"  > 







                                                </div>



                                            </div>



                                        </div>



                                        



                                    </div>    







                                    <div class="form-group row">



                                       



                                         <div class="col-md-6">



                                            <div class="form-group row">



                                                <label for="Scrap Value" class="col-sm-4 control-label">Phone Number:<font color="#FF0000" size=""></font> </label>



                                                <div class="col-sm-7">



                                                    <input type="text" name="dphno" id="dphno" class="form-control form-control-sm has-datepicker pull-right" > 

                                                     <p id='pid_dphno' style="display: none;"></p>

                                                </div>



                                            </div>



                                        </div>



                                        <div class="col-md-6">



                                            <div class="form-group row">



                                                <label for="Scrap Value" class="col-sm-4 control-label">Description:<font color="#FF0000" size=""></font> </label>



                                                <div class="col-sm-7">



                                                    <textarea name="desc" id="desc" class="form-control form-control-sm has-datepicker pull-right"></textarea> 



                                                </div>



                                            </div>



                                        </div>







                                    </div> 



                                    <div class="card-header  mb-5">



                                    <h3 class="card-title">Part  Details</h3>



                                        </div>



                                    <div class="form-group row">



                                            <div class="col-md-6">



                                            <div class="form-group row">



                                                <label for="Scrap Value" class="col-sm-4 control-label">Item Name:<font color="#FF0000" size=""></font> </label>



                                                <div class="col-sm-7">



                                                    <select name="itemname" id="itemname"  class="form-control select2" >



                                                        <option value="">--select--</option>



                                                        <?php 



                                                           $sql="SELECT Item_Name,Part_No,Item_Id from item_master where Item_Del=0 AND ((Type = 'SFG') ||( Type = 'FG')) ";



                                                           $query=mysql_query($sql);



                                                            while($data=mysql_fetch_object($query))



                                                            {?>



                                                        <option value="<?php echo $data->Item_Id?>" data-partno="<?php echo $data->Part_No ?>" data-itemname="<?php echo $data->Item_Name ?>"><?php echo $data->Item_Name; ?></option>







                                                            <?php }







                                                        ?>



                                                    </select>



														<p id="pid_itemname" style="display:none;">



                                                </div>



                                            </div>



                                        </div>







                                        <div class="col-md-6">



                                            <div class="form-group row">



                                                <label for="Scrap Value" class="col-sm-4 control-label">Planned Quantity:<font color="#FF0000" size=""></font> </label>



                                                <div class="col-sm-7">



                                                    <input type="number" min="0" name="pqty" id="pqty" class="form-control form-control-sm  has-datepicker pull-right"> 

													<p id="pid_pqty" style="display:none;">

                                                </div>



                                            </div>



                                        </div>



                                       



                                    </div> 











                                    <div class="form-group row"  id="addhgt"></div>



                                    <div class="card-header  mb-5"></div>



                                      <div class="form-group row">



                                        <div class="col-md-6">



                                            <div class="form-group row">







                                                <input type="button" value="Add To Grid" class="btn btn-primary" onclick="additemgrid()"/>



                                                &nbsp;



                                                <input type="button" name="reset" class="btn btn-default" value="Reset" onclick="clearall();"/>



                                            </div>



                                        </div>



                                    </div>







                                    <label for="Scrap Value" class="col-sm-2 control-label"> Material Details<font color="#FF0000" size=""></font> </label>







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

										<p id='pid_itemarray' style="display: none;"></p>



                                    </table>



                                    </div> 



                                    <div class="card-header"></div>&nbsp;



                                    <div class="form-group row">



                                        <div class="col-md-6">



                                            <div class="form-group row">







                                                <input type="button" value="confirm" class="btn btn-primary" onclick="check()"/>



                                                &nbsp;



                                                <input type="button" name="reset" class="btn btn-default" value="Reset" onclick="clearall();"/>



                                            </div>



                                        </div>



                                    </div>



                                </div>



                            </div>







                        </form>



                        <script>







                            



                            function check()



                            {



                              

								var allpartids = document.getElementsByName('partid[]');

                                if(checkEmpty('datepicker','pid_datepicker'))



                                {



                                  document.manual_time_new.datepicker.focus();



                                } 

								else if(checkEmpty('types','pid_types'))



                                {



                                    document.manual_time_new.types.focus();



                                }
                                else if (document.getElementById('dphno').value!='')
                                {

                                 checkInteger('dphno','pid_dphno')
                                    {
                                        document.getElementById('dphno').focus();
                                    }
                                }
								else if(allpartids.length<1)

								{



									document.getElementById('pid_itemarray').style.display = "";

									document.getElementById('pid_itemarray').style.color = "red";

									document.getElementById('pid_itemarray').innerHTML = "Add some data to grid";

									document.getElementById('itemname').focus();

									return false;

								

								}



                               /* else if (document.forms.manual_time_new.dphno.value != '')



                                {



                                    var phone = document.forms["manual_time_new"]["dphno"].value;



                                    var phoneNum = phone.replace(/[^\d]/g, '');



                                        if(phoneNum.length < 6 && phoneNum.length > 11) 



                                        {



                                            alert("Please Enter a valid phone number");



                                            return false;



                                        }



                                    if (Phonevalidate(phone)) {err=true; alert("Please Enter Valid Phone Number");}



                                        



                                }*/



                                else



                                {



                                    document.manual_time_new.submit();



                                }



                            }



        



var Rows1=1;  



var SlNo1=1; 



function additemgrid()



    {



            var itemid = document.getElementById('itemname').value;



            var qty=document.getElementById('pqty').value;



           if (checkEmpty('itemname','pid_itemname')){



                document.manual_time_new.itemname.focus();



            }



           else if (checkEmpty('pqty','pid_pqty')){



                 document.manual_time_new.pqty.focus();



            }



            else{



            var e = document.getElementById('itemname');



            var item = e.options[e.selectedIndex];



            var partno = item.getAttribute("data-partno");



            var itemname = item.getAttribute("data-itemname");



            var allpartids = document.getElementsByName('partid[]');



          for(i=0;i<allpartids.length;i++){



                if(itemid == allpartids[i].value){



                  //  alert("Item already added.");



                    //return false;

					document.getElementById('pid_itemarray').style.display = "";

				document.getElementById('pid_itemarray').style.color = "red";

				document.getElementById('pid_itemarray').innerHTML = "Item already added";

				document.getElementById('itemname').focus();

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



            // third cell 



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



            document.getElementById('itemname').value="";



            document.getElementById('pqty').value="";



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



        function clearProductSelectors()



            {



                window.location.reload();



            }



        function clearall()



            {



                 clearProductSelectors();



            }







        $(function () {



            $("#datepicker").datepicker();



        });



        function picklistprint(dispatchid) {



            dispatchid = dispatchid || false;



                if (!dispatchid)



                   return;



         printpage = 'dispatch_picklist_view.php';



        var printWindow = window.open(printpage + "?src=repack&dispatch_id=" + dispatchid, "", "width=300,height=200");



         }



        <?php if ($_GET['dispatch_id']) {



             echo "picklistprint('" . $_GET['dispatch_id'] . "')";



        } ?>



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