<?php
	
	$mod = $_GET['mod'];
	
	$page = $_REQUEST['page'];
	
	$grid = $_POST['asn_grid'];
	
	
	
	$branch_id=$_SESSION['SESS_LOGIN_BRANCH'];
	
?>

<script src="iAjax.js"></script>

<script type="text/javascript">
	
    function changedateformat() {
		
        datepicker = document.getElementById('production_date').value;
		
        var res = datepicker.split("/");
		
        date = res[1] + '-' + res[0] + '-' + res[2];
		
        document.getElementById('production_date').value = date;
		
        document.getElementById('addhgt').style.height = '0px';
		
	}
	function changedateformat1() {
		
        datepicker = document.getElementById('bestbefore').value;
		
        var res = datepicker.split("/");
		
        date = res[1] + '-' + res[0] + '-' + res[2];
		
        document.getElementById('bestbefore').value = date;
		
        document.getElementById('addhgt').style.height = '0px';
		
	}
    function addhght() {
		
		
		
        document.getElementById('addhgt').style.height = '180px';
		
	}
    function calc_prodqty() {
		
		netweight = document.getElementById('netweight').value;
		bcount = document.getElementById('bcount').value;
		
		
		pqty=bcount*netweight;
		
		document.getElementById('pqty').value=pqty.toFixed(2);
		
	}
	
    function setworkmode() {
		
		var online = document.getElementById("online");
		if ( online.checked == true )
		{
						
			document.getElementById("viewrefrpo").disabled = false;
			
			document.getElementById("refrouteno" ).disabled=false;
			document.getElementById('online_status').value=1;
			
			
		}
		else{
			document.getElementById("viewrefrpo").disabled = true;
			document.getElementById("refrouteno" ).disabled=true;
			document.getElementById('online_status').value=0;
			
		}
		
		
		
	}
	
	
	
	
	
	
	function checkbatchlen() {
		
		
		batchno = document.getElementById('batchno').value;
		var batch_len = batchno.length;
		
		if(batch_len>11){
			alert('Invalid Batch');
			str = batchno.substr(0, 11);
			document.getElementById('batchno').value=str;
			return false;
		}
	}
	
	
	
	function calcnetweight(spqqty) {
		
	
		if(document.getElementById("spq").readOnly == false){
			
		singlepackqty = document.getElementById('singlepackqty1').value;
		
		
		netqty=(Number(spqqty)*Number(singlepackqty))/1000;     
		
		document.getElementById('netweight').value=netqty.toFixed(2);
		
		//document.getElementById('netweight').value=(Number(spqqty)*Number(singlepackqty))/1000;
		}
	}
	
	function checkproduction_type(ptype) {
		
	document.getElementById('details').innerHTML='';
	
	document.getElementById("grngrid").style.display = "none";
	
	
		if(ptype=='FG'){
			
			/* document.getElementById("wiplabel").disabled = true;
			document.getElementById("wiplabel").checked = false;
			document.getElementById("productionlabel").checked = true;
				document.getElementById("productionlabel").disabled = false;
			document.getElementById("institutelabel").disabled = false;
			
			 */
			
				
		if(document.getElementById("online").checked == true){
										
			document.getElementById("viewrefrpo").disabled = false;
		}
		else{
			document.getElementById("viewrefrpo").disabled = true;
		}
		
			
			// clear fields 
			selecElement=document.getElementById("refrouteno");
			selecElement.selectedIndex = 0; 
			
				document.getElementById("produceditem").value = '';
				document.getElementById("packtype").value = '';
				document.getElementById("planqty").value = '';
				document.getElementById("singlepackqty").value = '';
				document.getElementById("uom").value = '';
				document.getElementById("spq").value = '';
				document.getElementById("batchno").value = '';
				document.getElementById("production_date").value = '';
				document.getElementById("bestbefore").value = '';
				document.getElementById("netweight").value = '';
				document.getElementById("grossweight").value = '';
				document.getElementById("bcount").value = '';
				document.getElementById("pqty").value = '';
				/* document.getElementById("fromlocationname").value = '';
				document.getElementById("location").value = ''; */
				
			selecElement1=document.getElementById("location");
			selecElement1.selectedIndex = 0; 
			
			selecElement2=document.getElementById("shift");
			selecElement2.selectedIndex = 0; 
			
			selecElement3=document.getElementById("activity");
			selecElement3.selectedIndex = 0; 
			
			
			
			
			
			
			
		 	document.getElementById('online').disabled=false;
			document.getElementById("online").checked = false;
			
			
		 	document.getElementById('refrouteno').disabled=true;
			
			
			document.getElementById("spq").readOnly = false;
			document.getElementById("netweight").readOnly = true;
			
			
			document.getElementById("online_block").style.display = "";
			$('.select2').select2();
		}
		else{
			
		/* 	document.getElementById("wiplabel").checked = true;
			document.getElementById("productionlabel").checked = false;
			document.getElementById("institutelabel").checked = false;
			document.getElementById("productionlabel").disabled = true;
			document.getElementById("institutelabel").disabled = true;
			document.getElementById("wiplabel").disabled = false; */
			document.getElementById("spq").readOnly = true;
			document.getElementById('online').disabled=false;
			document.getElementById("online").checked = false;
			document.getElementById('refrouteno').disabled=true;
			
			
			//clear fields
			
					
			selecElement1=document.getElementById("location");
			selecElement1.selectedIndex = 0; 
			
			
			selecElement=document.getElementById("refrouteno");
			selecElement.selectedIndex = 0; 
			
			
				document.getElementById("produceditem").value = '';
				document.getElementById("packtype").value = '';
				document.getElementById("planqty").value = '';
				document.getElementById("singlepackqty").value = '';
				document.getElementById("uom").value = '';
				document.getElementById("spq").value = '';
				document.getElementById("batchno").value = '';
				document.getElementById("production_date").value = '';
				document.getElementById("bestbefore").value = '';
				document.getElementById("netweight").value = '';
				document.getElementById("grossweight").value = '';
				document.getElementById("bcount").value = '';
				document.getElementById("pqty").value = '';
				/* document.getElementById("fromlocationname").value = '';
				document.getElementById("location").value = ''; */
				
		
			
			selecElement2=document.getElementById("shift");
			selecElement2.selectedIndex = 0; 
			
			selecElement3=document.getElementById("activity");
			selecElement3.selectedIndex = 0; 
			
			
			
			
			
			
			document.getElementById("online").checked = false;
			document.getElementById("online_block").style.display = "none";
			document.getElementById("netweight").readOnly = false;
		}
		
		
		
		data1 = "ask=checkprntype&type=" + ptype;
		
		iAjax('ajax_production_entry.php?' + data1, loadrpos);
		
		
		
		
		function loadrpos(result){
			
			
			document.getElementById('routeno').innerHTML=result;
			
			
			
		}
		
		
		
		
	}
	
	
	function openmodel() {
		
		
		
		data1 = "ask=produceditem1&rpo_id=" + document.forms.manual_time_new.refrouteno.value;
		
		iAjax('ajax_production_entry.php?' + data1, produceditem1);
		
		
		
		
		function produceditem1(result){
			
			//alert(result);
			var dt= JSON.parse(result);
			var shelf_life='<option value="'+dt['primary_shelf_life']+'">Primary Shelf Life : '+dt['primary_shelf_life']+' days</option>';
			shelf_life+='<option value="'+dt['secondary_shelf_life']+'">Secondary Shelf Life : '+dt['secondary_shelf_life']+' days</option>';
			
			
			
			if(dt['Itemname']){
				document.getElementById("somthing").style.display = "";
				document.getElementById("nothing").style.display = "none";
				
				document.getElementById('produceditem1').innerHTML=dt['Itemname'];
				document.getElementById('rpo_no1').innerHTML=dt['RPO_No'];
				document.getElementById('uom1').innerHTML=dt['uom'];
				document.getElementById('spq1').innerHTML=Math.round(dt['spq']);
				document.getElementById('packtype1').innerHTML=dt['pack_type'];    
				document.getElementById('batchno1').innerHTML=dt['batchno'];    
				document.getElementById('planqty1').innerHTML=dt['FG_Qty'];    
				document.getElementById('remainqty1').innerHTML=dt['Remaining_Qty']; 
				
			}
			else{
				document.getElementById("somthing").style.display = "none";
				document.getElementById("nothing").style.display = "";
				document.getElementById('rpo_no1').innerHTML="";
				
				
			}
			
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
	
	function appendbatch() {
		
		batch_exist = document.getElementById('batch_exist').value;
		production_date = document.getElementById('production_date').value;
		
		if(batch_exist==0){
			
			batchno = document.getElementById('batchno').value;
			Item_Lot_Code = document.getElementById('Item_Lot_Code').value;
			
			shift = document.getElementById('shift').value;
			activity = document.getElementById('activity').value;
			
			
			
			
			batchno =  batchno.substring(0, 6);
			batchno=batchno+''+shift+''+activity+''+Item_Lot_Code;
			
			if(production_date!=''){
				
				production_date =  production_date.substring(0, 2);
				
				
				let arr = batchno.split("");
				arr.splice(1,2,production_date);
				batchno = arr.join("");
				
				
			}
			
			
			
			
			document.getElementById('batchno').value=batchno;
			
		}
		
		
	}
	
	
	
	
	
</script>

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
						
						<h3 class="card-title"> Entry Details</h3>
						
					</div>
					
					<div class="col-md-12">
						
						<form class="form-horizontal" action="productionentry_validate.php" method="post" name="manual_time_new" id="manual_time_new" autocomplete="off">
							
							<div class="card-body">
								
								<div class="col-md-12">
									
									
									<div class="form-group row">
										
										<div class="col-md-3">
											<div class="form-group row">
												<label for="wip" class="col-sm-5 control-label">WIP</label>
												<div class="col-sm-7">
													<input type="radio" id="wip" name="ptype" value="WIP" checked="checked" onclick="checkproduction_type(this.value);">
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group row">
												<label for="fg" class="col-sm-5 control-label">FG</label>
												<div class="col-sm-7">
													<input type="radio" id="fg" name="ptype" value="FG" onclick="checkproduction_type(this.value);">
												</div>
											</div>
										</div>
									</div>
									<p id='pid_label_size' style="display: none;"></p>
									
									
									
									<div class="form-group row">
										
										<!--first column-->
										
										<div class="col-md-6">
											
											<div class="form-group row">
												
												<label for="Scrap Value" class="col-sm-4 control-label">RPO Number:<font color="#FF0000" size="">*</font> </label>
												
												<div class="col-sm-7">
													
													<select name="routeno" id="routeno"  class="form-control select2" onchange="auto_value();">
														
														<option value="">--select--</option>
														
														<?php
															
															
															$sql = "SELECT rpo_master.RPO_Id,rpo_master.RPO_No FROM `rpo_master` 
															
															inner join route_card on route_card.RPO_ID=rpo_master.RPO_Id
															inner join item_master on item_master.Item_Id=rpo_master.FG_ItemId
															where rpo_master.Status=0 and item_master.Type='WIP' ";
															
															$res = mysql_query($sql);
															
															while ($data = mysql_fetch_object($res)) {
																
															?>
															
															<option value="<?php echo $data->RPO_Id ?>"><?php echo $data->RPO_No ; ?></option>
															
															<?php
																
															}
															
														?>
														
													</select>
													<p id='pid_routeno' style="display: none;"></p>
													
												</div>
												
											</div>
											
										</div>
										
										<!--second column-->
										
										
										
										
										
										
									</div>
									
									<div class="card-body table-responsive p-0" id="divgrid" >

										<table class="table  table-head-fixed" id="grngrid" style="display: none;">
											<tr><td style="background-color:#e9ecef"><table id="details"></table></td></tr>
											
										<tr><td><table class="table  table-head-fixed" id="hidetable"  >
											
										</table></td></tr>
										</table>

										
										
									</div> 
									
									
									
									
									
									
									
									
									
									
									<div class="form-group row" id="online_block" style="display: none;">
										
										<div class="col-md-6">
											
											<div class="form-group row">
												
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="col-sm-4 control-label">
												</label>
												<div class="col-sm-7">
													<input name="online" id="online" type="checkbox" class="form-check-input" value="" onclick="setworkmode();">Online Production
													<input type="hidden" name="online_status" id="online_status" >
													<input type="hidden" name="Item_Lot_Code" id="Item_Lot_Code" >
													
													
												</div>
											</div>
										</div>
										
										
										
										<div class="col-md-6">
											
											<div class="form-group row">
												
												<label for="Scrap Value" class="col-sm-4 control-label">WIP RPO Number:<font color="#FF0000" size=""></font> </label>
												
												
												<div class="col-sm-6">
													<div class="input-group mb-12">
														
														<select name="refrouteno" id="refrouteno"  class="form-control select2" onchange="openmodel();"; disabled >
															
															<option value="">--select--</option>
															
															<?php
																
																
																
																
																$sql = "SELECT rpo_master.RPO_Id,rpo_master.RPO_No
																FROM `rpo_master` 
																inner join route_card on route_card.RPO_ID=rpo_master.RPO_Id 
																INNER JOIN item_master ON item_master.Item_Id=rpo_master.FG_ItemId
																where rpo_master.Status=0 and route_card.STATUS!=0 and item_master.Type='WIP' ";
																
																
																//		$sql = "SELECT route_card.ROUTE_CARD_NUMBER,rpo_master.RPO_No 
																//	FROM `route_card` 
																//INNER JOIN rpo_master ON rpo_master.RPO_No = route_card.RPO_NO AND rpo_master.Status = '0'
																/*INNER JOIN route_card_pick_list ON route_card.ROUTE_CARD_ID=route_card_pick_list.ROUTE_CARD_ID */ //WHERE /*route_card.`STATUS`='1'*/ //1=1 //AND route_card.ORGANIZATION_ID='{$branch_id}' 
																//GROUP BY route_card.ROUTE_CARD_NUMBER ";
																
																$res = mysql_query($sql);
																
																while ($data = mysql_fetch_object($res)) {
																	
																?>
																
																<option value="<?php echo $data->RPO_Id ?>"><?php echo $data->RPO_No ; ?></option>
																
																<?php
																	
																}
																
															?>
															
														</select>
														
														
														<div class="input-group-append">
															<button id="viewrefrpo" name="viewrefrpo" class="btn btn-secondary btn-sm " data-toggle="modal" data-target="#exampleModalLong" type="button">VIEW</button>
														</div>
														
														
														<!-- Modal -->
														<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
															<div class="modal-dialog" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title" id="exampleModalLongTitle"><b id="rpo_no1"></b></h5>
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																			<span aria-hidden="true">&times;</span>
																		</button>
																	</div>
																	<div class="modal-body">
																		
																		
																		<div class="container" id="nothing" style="display: none;">
																			<div class="col">
																				Please select a WIP RPO Number
																			</div>
																		</div>
																		
																		<div class="container" id="somthing" style="display: none;">
																			<div class="row">
																				<div class="col">
																					Produced Item:
																				</div>
																				<div class="col">
																					<b id="produceditem1"></b>
																				</div>
																			</div>
																			
																			<div class="row">
																				<div class="col">
																					Batch:
																				</div>
																				<div class="col">
																					<b id="batchno1"></b>
																				</div>
																			</div>
																			
																			<div class="row">
																				<div class="col">
																					Type Of Packing:
																				</div>
																				<div class="col">
																					<b id="packtype1"></b>
																				</div>
																			</div>
																			
																			<div class="row">
																				<div class="col">
																					Planned Quantity:
																				</div>
																				<div class="col">
																					<b id="planqty1"></b>
																				</div>
																			</div>
																			
																			<div class="row">
																				<div class="col">
																					Remaining Quantity:
																				</div>
																				<div class="col">
																					<b id="remainqty1"></b>
																				</div>
																			</div>
																			
																			<div class="row">
																				<div class="col">
																					UOM:
																				</div>
																				<div class="col">
																					<b id="uom1"></b>
																				</div>
																			</div>
																			
																			
																			<div class="row">
																				<div class="col">
																					SPQ Quantity:
																				</div>
																				<div class="col">
																					<b id="spq1"></b>
																				</div>
																			</div>
																			
																			
																			
																		</div>
																		
																		
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																	</div>
																</div>
															</div>
														</div>
														
														
														<p id='pid_refrouteno' style="color:red"></p>
														
														
													</div>
												</div>
												
												
											</div>
											
											
											
											
											
										</div>
										
										
										
										
										
										
										
										
										
										
									</div>
									
									
									
									
									
									<div class="form-group row">
										
										
										<div class="col-md-6">
											
											<div class="form-group row">
												
												
												
												<label for="Scrap Value" class="col-sm-4 control-label">Location:<font color="#FF0000" size="">*</font>  </label>
											
												
												<div class="col-sm-7" >
												
												
												
												<select name="location" id="location" class="form-control select2"  > 
														
														<option value="">--select--</option>
														
														<?php
															$sql1 = "SELECT `NAV_loc_code`,`Loc_Id`,`Loc_Name` FROM `locationmaster` WHERE `Loc_Del`=0  ORDER BY Loc_Name";
															
															$res1 = mysql_query($sql1);
															
															while ($data1 = mysql_fetch_object($res1)) {
															?>
															
															<option value="<?php echo $data1->Loc_Id; ?>"><?php echo  $data1->NAV_loc_code.'/'.$data1->Loc_Name ;?></option>
															
															<?php
															}
														?>
														
													</select>
													<p id='pid_location' style="display: none;"></p>
												
												
												
												
												
												
											<!--		<input type="text" name="fromlocationname" id="fromlocationname" class="form-control form-control-sm  readonly"  size="32" value="<?php ?>" readonly="readonly">
													<input type="hidden" name="location" id="location" > -->
												
												
											</div>
												<p id='pid_location' style="display: none;"></p>
											</div>
											
										</div>
										
										
										
										
										
										
										
										<div class="col-md-6">
											
											<div class="form-group row">
												
												<label for="Scrap Value" class="col-sm-4 control-label">Shift:<font color="#FF0000" size="">*</font> </label>
												
												<div class="col-sm-7">
													
													<select name="shift" id="shift"  class="form-control select2" onchange="appendbatch();" >
														
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
												
												<label for="Scrap Value" class="col-sm-4 control-label">Produced Item:<font color="#FF0000" size="">*</font> </label>
												
												<div class="col-sm-7" >
													
													<input type="text" name="produceditem" id="produceditem" class="form-control form-control-sm  readonly"  size="32" value="<?php ?>" readonly="readonly">
													<input type="hidden" name="Item_Id" id="Item_Id" >
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group row">
												<label for="Scrap Value" class="col-sm-4 control-label">Type Of Packing:<font color="#FF0000" size="">*</font> </label>
												
												<div class="col-sm-7">
													
													<input type="text" name="packtype" id="packtype" class="form-control form-control-sm"   value="<?php ?>" readonly="readonly">
													
													
													
												</div>
												
											</div>
											
										</div>
										
									</div>
									
									<div class="form-group row">
										
										<div class="col-md-6">
											<div class="form-group row">
												
												<label for="Scrap Value" class="col-sm-4 control-label">Planned Quantity:<font color="#FF0000" size="">*</font> </label>
												
												<div class="col-sm-7">
													
													<input type="text" name="planqty" id="planqty" class="form-control form-control-sm  readonly"  size="32" value="<?php ?>" readonly="readonly">
													<p id='pid_planqty' style="display: none;"></p>
												</div>
											</div>
										</div>
										
										
										
									<div class="col-md-6">
											<div class="form-group row">
												
												<label for="Scrap Value" class="col-sm-4 control-label">Single Packet Weight:<font color="#FF0000" size="">*</font> </label>
												
												<div class="col-sm-7">
													
													<input type="text" name="singlepackqty" id="singlepackqty" class="form-control form-control-sm  readonly"  size="32" value="<?php ?>" readonly="readonly">
													<input type="hidden" name="singlepackqty1" id="singlepackqty1" >
													<p id='pid_singlepackqty' style="display: none;"></p>
												</div>
											</div>
										</div>
										
										
									</div>
									
									
									
									
									
									
									
									
									
									
									
									<div class="form-group row">
										
										<div class="col-md-6">
											<div class="form-group row">
												
												<label for="Scrap Value" class="col-sm-4 control-label">UOM:<font color="#FF0000" size="">*</font> </label>
												
												<div class="col-sm-7">
													
													<input type="text" name="uom" id="uom" class="form-control form-control-sm  readonly"  size="32" value="<?php ?>" readonly="readonly">
													<p id='pid_uom' style="display: none;"></p>
												</div>
											</div>
										</div>
										
										
										
										<div class="col-md-6">
											
											<div class="form-group row">
												
												<label for="Scrap Value" class="col-sm-4 control-label">SPQ Quantity<font color="#FF0000" size="">*</font> </label>
												
												<div class="col-sm-7">
													
													<input type="number" name="spq" id="spq" class="form-control form-control-sm  readonly"  size="32" value="<?php ?>" readonly="readonly" onkeyup="calcnetweight(this.value);">
													<p id='pid_spq' style="display: none;"></p>
												</div>
											</div>
										</div>
										
										
									</div>
									<div class="form-group row">
										
										<div class="col-md-6">
											
											<div class="form-group row">
												
												<label for="Scrap Value" class="col-sm-4 control-label">Activity:<font color="#FF0000" size="">*</font> </label>
												
												<div class="col-sm-7">
													
													<select name="activity" id="activity"  class="form-control select2" onchange="appendbatch();" >
														
														<option value="">--select--</option>
														<option value="M">Manufactured</option>
														<option value="R">Re-packed</option>
														<option value="S">Re-processed</option>
														<option value="W">Re-worked</option>
														
														
														
													</select>
													<p id='pid_activity' style="display: none;"></p>
													
												</div>
												
											</div>
											
										</div>
										
										
										
										
										
										
										
										
										
										
										
										<div class="col-md-6">
											
											
											<div class="form-group row">
												
												<label for="Scrap Value" class="col-sm-4 control-label">Batch No:<font color="#FF0000" size="">*</font> </label>
												
												<div class="col-sm-7">
													
													<input type="text" name="batchno" id="batchno" class="form-control form-control-sm readonly "  size="32" value="<?php ?>" onkeyup="checkbatchlen();">
													<input type="hidden" name="batch_exist" id="batch_exist" >
													<p id='pid_batchno' style="display: none;"></p>
												</div>
											</div>
										</div>
										
										
										<!--	<div class="col-md-6">
											
											<div class="form-group row">
											
											<label for="Scrap Value" class="col-sm-4 control-label">Lot No:<font color="#FF0000" size="">*</font> </label>
											
											<div class="col-sm-7">
											
											<input type="text" name="lotno" id="lotno" class="form-control form-control-sm  readonly"  size="32" value="<?php ?>" >
											<p id='pid_lotno' style="display: none;"></p>
											</div>
											</div>
											
											
											
											
											
										</div> -->
									</div>
									
									<div class="form-group row">
										
										<div class="col-md-6">
											
											
											
											
									

											
											
											
											
											
											
											
											
											
											
											
											
											<div class="form-group row">
												<label for="Scrap Value" class="col-sm-4 control-label"> DOM:<font color="#FF0000" size="">*</font> </label>
												
												<div class="col-sm-7 input-group">
													<div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
													
													
															<input type="text" class="datepicker form-control form-control-sm" name="production_date" id="production_date" value="" onchange="appendbatch();">
													
												<!--	<input type="text" name="production_date" id="production_date" class="form-control form-control-sm has-datepicker pull-right"  size="32" value="<?php ?>" onchange="changedateformat();/*loadbbf();*/"  onclick="addhght()"  > -->
													
												</div>
												<p id='pid_production_date'style="display: none;padding-left: 250px;"></p>
											</div>
											
										</div> 
										<div class="col-md-6">
											
											<div class="form-group row">
												
												<label for="Scrap Value" class="col-sm-4 control-label">Expiry Date:<font color="#FF0000" size="">*</font> </label>
												
												
												<div class="col-sm-7 input-group">
													
													<div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
													
													
													<input type="text" class="datepicker form-control form-control-sm" name="bestbefore" id="bestbefore" value="">
													
													<!--<input type="text" name="bestbefore" id="bestbefore" class="form-control form-control-sm has-datepicker pull-right"  size="32" onchange="changedateformat1();" 
													onclick="addhght()"   > -->
													
												</div>
												<p id='pid_bestbefore'style="display: none;padding-left: 250px;"></p>
											</div>
										</div>
										
									</div>
									<div class="form-group row"  id="addhgt"></div>
									<div class="form-group row">
										
										
										<div class="col-md-6">
											
											<div class="form-group row">
												
												<label for="Scrap Value" class="col-sm-4 control-label">Net Weight:<font color="#FF0000" size="">*</font> </label>
												
												<div class="col-sm-7">
													
													<input type="text" name="netweight" id="netweight" class="form-control form-control-sm  readonly"  size="32" value="<?php ?>" onkeyup="calc_prodqty()"; >
													<p id='pid_netweight' style="display: none;"></p>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											
											<div class="form-group row">
												
												<label for="Scrap Value" class="col-sm-4 control-label">Gross Weight:<font color="#FF0000" size="">*</font> </label>
												
												<div class="col-sm-7">
													
													<input type="text" name="grossweight" id="grossweight" class="form-control form-control-sm  readonly"  size="32" value="<?php ?>" >
													<p id='pid_grossweight' style="display: none;"></p>
												</div>
											</div>
										</div>
										
										
									</div>
									<div class="form-group row"  id="addhgt"></div>
									<div class="form-group row">
										
										
										
										
										<div class="col-md-6">
											<div class="form-group row">
												<label for="Scrap Value" class="col-sm-4 control-label">No. of Barcodes:<font color="#FF0000" size="">*</font> </label>
												
												<div class="col-sm-7">
													
													<input type="text" name="bcount" id="bcount" class="form-control form-control-sm"  size="32" value="<?php ?>" onkeyup="calc_prodqty()";>
													<p id='pid_pqty' style="display: none;"></p>
													
													
												</div>
												
											</div>
											
										</div>
										
										<div class="col-md-6">
											
											<div class="form-group row">
												
												<label for="Scrap Value" class="col-sm-4 control-label">Production Quantity:<font color="#FF0000" size="">*</font> </label>
												
												<div class="col-sm-7">
													
													<input type="text" name="pqty" id="pqty" class="form-control form-control-sm  readonly"  size="32" value="<?php ?>" readonly="readonly">
												</div>
											</div>
										</div> 
										
										
										
										
										
									</div>
									
									<div class="form-group row"  id="addhgt"></div>
									
									<div class="card-header"></div>&nbsp;
									
									
									<!--
									
									<div class="card-body">
										<div class="form-group row">
											<div class="col-md-3">
												<label for="labelsize29x19" class="col-sm-5 control-label"><b>Label Size: <font color="#FF0000" size="">*</font></b></label>
											</div>
											
											<div class="col-md-3">
												<div class="form-group row">
													<label for="productionlabel" class="col-sm-5 control-label">WIP</label>
													<div class="col-sm-7">
														<input type="radio" id="wiplabel" name="labelsize" value="wip" checked="checked">
													</div>
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="form-group row">
													<label for="productionlabel" class="col-sm-5 control-label">Production</label>
													<div class="col-sm-7">
														<input type="radio" id="productionlabel" name="labelsize" value="productionlabel" disabled >
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group row">
													<label for="institutelabel" class="col-sm-5 control-label">Institutional</label>
													<div class="col-sm-7">
														<input type="radio" id="institutelabel" name="labelsize" value="institutelabel" disabled>
													</div>
												</div>
											</div>
										</div>
										<p id='pid_label_size' style="display: none;"></p>
									</div>
									
									-->
									
									
									
									<div class="form-group row">
										
										<div class="col-md-6">
											
											<div class="form-group row">
												
												<input type="button" value="Confirm" class="btn btn-primary"  onclick="check()"/>
												
												&nbsp;
												
												<input type="button" name="reset"  class="btn btn-default" value="Reset" onclick="clearall()"/>
												
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
									
									
									var online = document.getElementById("online");
									
									
									if ( online.checked == true )
									{
										
										if ( checkEmpty('refrouteno','pid_refrouteno') )
										{
											document.getElementById('refrouteno').focus();
											return false;
											
										}
										
										
									}
									
									
									routeno = document.getElementById('routeno').value;	
									refrouteno = document.getElementById('refrouteno').value;	
									
									
									if(routeno==refrouteno){
										alert('Select different RPO Reference Number');
										document.getElementById('refrouteno').focus();
										return false;
										
									}
									
									
									
									
									
									
									
									
									
									
									
									if ( checkEmpty('location','pid_location') )
									{
										document.getElementById('location').focus();
										return false;
									} 
									
									if ( checkEmpty('shift','pid_shift') )
									{
										document.getElementById('shift').focus();
										return false;
										
									}
									
									if ( checkEmpty('spq','pid_spq') )
									{
										document.getElementById('spq').focus();
										return false;
										
									}
									
									if ( checkInteger('spq','pid_spq') )
									{
										document.getElementById('spq').focus();
										return false;
										
									}
									
									
									
									if ( checkEmpty('activity','pid_activity') )
									{
										document.getElementById('activity').focus();
										return false;
										
									}
									if ( checkEmpty('batchno','pid_batchno') )
									{
										document.getElementById('batchno').focus();
										return false;
										
									}
									
									
									
									batchno = document.getElementById('batchno').value;
									var batch_len = batchno.length;
									
									if(batch_len>11){
										alert('Invalid Batch');
										str = batchno.substr(0, 11);
										document.getElementById('batchno').value=str;
										return false;
									}
									
									
									
									
									
									
									
									if ( checkEmpty('production_date','pid_production_date') )
									{
										document.getElementById('production_date').focus();
										return false;
										
									}
									
									
									
									if ( checkEmpty('bestbefore','pid_bestbefore') )
									{
										document.getElementById('bestbefore').focus();
										return false;
										
									}
									/* else if ( checkEmpty('production_date','pid_production_date') )
										{
										document.getElementById('production_date').focus();
										return false;
										
										}
									*/
									
									
									if ( checkEmpty('netweight','pid_netweight') )
									{
										document.getElementById('netweight').focus();
										return false;
										
									}
									
									
									
									
									if ( checkEmpty('grossweight','pid_grossweight') )
									{
										document.getElementById('grossweight').focus();
										return false;
										
									}
									
									
									if ( checkEmpty('bcount','pid_pqty') )
									{
										document.getElementById('bcount').focus();
										return false;
										
									}
									
									if ( checkInteger('bcount','pid_pqty') )
									{
										document.getElementById('bcount').focus();
										return false;
										
									}
									
									
									
									
									
									
									document.manual_time_new.submit();
									
									
								}
								
								function auto_value()
								
								{
									
									/* data = "ask=addtogrid&routeno=" + document.forms.manual_time_new.routeno.value;
										
									iAjax('ajax_production_entry.php?' + data, routegrid); */
									
									//get produced item
									
									data1 = "ask=produceditem&rpo_id=" + document.forms.manual_time_new.routeno.value+"&ptype=" + document.forms.manual_time_new.ptype.value;
									
									iAjax('ajax_production_entry.php?' + data1, produceditem);
									
								}
								
								function routegrid(result)
								
								{
									
									
									
									document.getElementById('asn_grid').innerHTML = result;
									
									
								}
								
								function produceditem(result){
									
											//alert(result);
									if(document.getElementById("fg").checked == true){	
									if(result=='NOPRN'){
									
										alert('PRN file not found for this RPO Item');
										return false;
										
									}
									if(result=='NOMRP'){
									
										alert('MRP not defined for this RPO Item');
										return false;
										
									}
									}
									
									
									
									
									
									//alert(result);
									var dt= JSON.parse(result);
									
									
									
									
									
									
									var shelf_life='<option value="'+dt['primary_shelf_life']+'">Primary Shelf Life : '+dt['primary_shelf_life']+' days</option>';
									shelf_life+='<option value="'+dt['secondary_shelf_life']+'">Secondary Shelf Life : '+dt['secondary_shelf_life']+' days</option>';
									
									document.getElementById('produceditem').value=dt['Itemname'];
									/*    document.getElementById('category').value=dt['category'];
									document.getElementById('subcategory').value=dt['Subcategory']; */      
									//	document.getElementById('shelflife').innerHTML=shelf_life;
									document.getElementById('uom').value=dt['uom'];
									document.getElementById('spq').value=Math.round(dt['spq']);
									
										if(document.getElementById("fg").checked == true){
										
										document.getElementById('netweight').value=dt['net_weight'];
										}
										else{
											
											document.getElementById('netweight').value='';
										}
									//document.getElementById('grossweight').value=dt['gross_weight'];
									document.getElementById('packtype').value=dt['pack_type'];    
									document.getElementById('singlepackqty').value=dt['singlepackqty'];    
									document.getElementById('singlepackqty1').value=dt['singlepackqty1'];    
									document.getElementById('batchno').value=dt['batchno'];    
									document.getElementById('Item_Id').value=dt['Item_Id'];    
									document.getElementById('planqty').value=dt['FG_Qty'];    
									//document.getElementById('remainqty').value=dt['Remaining_Qty'];    
									document.getElementById('batch_exist').value=dt['batch_exist'];
									document.getElementById('Item_Lot_Code').value=dt['Item_Lot_Code'];
									/* document.getElementById('fromlocationname').value=dt['fromlocationname'];
									document.getElementById('location').value=dt['fromlocationid']; */
									
									
									
									
									shift=document.getElementById("shift");
									shift.selectedIndex = 0;
									
									activity=document.getElementById("activity");
									activity.selectedIndex = 0;
									
									
									
									if(dt['batch_exist']==1){
										
										//document.getElementById("batchno").readOnly = true;
										
									}
									else{
										//document.getElementById("batchno").readOnly = false;
									}
									
									
									
									if(document.getElementById("fg").checked == true){
										
										
										
										document.getElementById("online_block").style.display = "";
										
										$('.select2').select2();
										
										if(dt['online']==1){
											alert('Please Select a reference RPO Number!');
											document.getElementById('refrouteno').disabled=false;
											document.getElementById('refrouteno').focus();
											
											document.getElementById("online").checked = true;
											document.getElementById("online").disabled = true;
											
											document.getElementById('online_status').value=1;
											
											
										}
										else{
											document.getElementById('online').disabled=false;
											document.getElementById("online").checked = false;
											document.getElementById('refrouteno').disabled=true;
										}
										
									}
									else{
										document.getElementById("online_block").style.display = "none";
										$('.select2').select2();
										document.getElementById("online").checked = false;
										document.getElementById("online").disabled = false;
										document.getElementById('online_status').value=0;
									}
									
									
									
									
									var routeno = document.getElementById("routeno").value;
									var ptype =  document.forms.manual_time_new.ptype.value;
									
									data = "ask=getproduced_details&routeno="+ routeno+"&ptype="+ptype;
									iAjax('ajax_production_entry.php?' + data, itemlistview);
									
										
									
								}
								
								
								
								
								function itemlistview(result){
								
								//alert(result);
								if(result){
									
									document.getElementById('details').innerHTML=result;
										document.getElementById("grngrid").style.display = "";
								}
								else{
									
									document.getElementById('details').innerHTML='';
										document.getElementById("grngrid").style.display = "none";
								}
								
								}
								
								
								
								
								function loadbbf(){
									document.getElementById('bestbefore').value='';
									if(document.getElementById('shelflife').value!='' && document.getElementById('production_date').value!=''){       
										data="ask=loadbbf&shelflife="+document.getElementById('shelflife').value+"&dom="+document.getElementById('production_date').value;
										iAjax("ajax_production_entry.php?" + data, loadbbfsuccess);
									}      
								}
								
								function loadbbfsuccess(result){
									document.getElementById('bestbefore').value=result;       
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
									
									$("#production_date").datepicker();
									
								});
								$(function () {
									
									$("#bestbefore").datepicker();
									
								});
								
								
								
								function barcodeprint(production_id,size,barcodestart_id){
									
									production_id = production_id || false;
									
									if(!production_id) return;
									
									
									
									printpage = 'barcodeprint_validation2.php'; 
									
									
									
									var printWindow = window.open(printpage+"?src=production&production_id="+production_id+"&size="+size+"&barcodestart_id="+barcodestart_id, "", "width=300,height=200");
									
									
									
								}
								
								
								
								<?php if($_GET['production_id']){ echo "barcodeprint('".$_GET['production_id']."','".$_GET['size']."','".$_GET['barcodestart_id']."')"; } ?>
								
							</script>
							<script>
								$(function () {
									openmodel();
									
									//Initialize Select2 Elements
									$('.select2').select2()
									
									//Initialize Select2 Elements
									$('.select2bs4').select2({
										theme: 'bootstrap4'
									})
								});
								
								 $('.datepicker').datepicker({
									dateFormat: 'dd-mm-yy'
								 });
								
								
								
								
							</script>
							
							
							
							
							
						</div>
						
					</div>
					
				</div>
				
			</section>
			
		</div>																																																																							