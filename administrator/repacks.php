<?php 
if ($_SESSION['type']!=='admin') {
	header('location: /');
	exit();
}
?>

<style>
    .dataTables_scrollHead{
        width: 100% !important;
    }
    .scheduled-repacks-delivered,
    .dataTables_scrollHeadInner{
        width: 100% !important;
    }
    
    .dataTables_filter { display : none; }
    textarea
    {
      border:1px solid #999999;
      width:100%;
      margin:5px 0;
      padding:3px;
    }
    
    .boxsizingBorder {
        -webkit-box-sizing: border-box;
           -moz-box-sizing: border-box;
                box-sizing: border-box;
    }

    #repack_content { color: #fff}
    
    fieldset {
        display: none;
    }
    
    fieldset.show {
        display: block;
    }
    
    select:focus, input:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #2196F3 !important;
        outline-width: 0 !important;
        font-weight: 400;
    }
    
    button:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        outline-width: 0;
    }
    
    .tabs {
        margin: 2px 5px 0px 5px;
        padding-bottom: 10px;
        cursor: pointer;
    }
    
    .tabs:hover, .tabs.active {
        border-bottom: 1px solid #2196F3;
    }
    
    a:hover {
        text-decoration: none;
        color: #1565C0;
    }
    
    .box {
        margin-bottom: 10px;
        border-radius: 5px;
        padding: 10px;
    }
    
    .modal-backdrop { 
        background-color: #64B5F6;
    }
    
    .line {
        background-color: #CFD8DC;
        height: 1px;
        width: 100%;
    }
    
    @media screen and (max-width: 768px) {
        .tabs h6 {
            font-size: 12px;
        }
    }
    
    .font-weight-bold {
        color: #fff!important;
        font-weight: 700!important;
    }
    
    .text-muted  {
        color: #fff!important;
    }
    .table {
      width: 100%;
      background-color: bebebe;
      /* Add other table styles as needed */
      /* e.g., border-collapse: collapse; */
    }
    
    .hidden {
      display: none;
    }
    
</style>

        <!-- ################# MODAL ##################################### -->
        <div id="repack_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color:#1d1e22">
                    <div class="modal-header row d-flex justify-content-between mx-1 mx-sm-3 mb-0 pb-0 border-0">
                        <div class="tabs active" id="work_order">
                            <h6 class="font-weight-bold wo-id">Work Order</h6>
                        </div>
                        <div class="tabs active" id="repack" style="display:none">
                            <h6 class="font-weight-bold rp-id">Repack Info</h6>
                        </div>
                        <div class="tabs" id="additional">
                            <h6 class="text-muted">Additional Work</h6>
                        </div>
                        <div class="tabs" id="customer">
                            <h6 class="text-muted">Customer</h6>
                        </div>
                        <div class="tabs" id="container">
                            <h6 class="text-muted">Container</h6>
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="modal-body p-0">
                        
                        <fieldset  id="tab_work_order">
                            <form class="form-horizontal" id="step_parts_form" action="" method="post">
                        		  <div class="modal-body" id="work_order_content">
                        		    
                        		    <input type="hidden" class="form-control" id="work_order_id" name="work_order_id" placeholder="Work Order ID"/>
                        		    <input type="hidden" class="form-control" id="repack_id" name="repack_id" placeholder="Repack ID"/>
                        		    <input type="hidden" class="form-control" id="wo_type" name="wo_type"/>
                        		    <input type="hidden" class="form-control" id="wo_customer" name="wo_customer"/>
                        		    <input type="hidden" class="form-control" id="wo_schedule_date" name="wo_schedule_date"/>
                        		    
                        			<div class="form-group">
                        				<label for="dropoff_date" class="control-label"><strong>Dropoff  Date:</strong></label>
                        				<input type="text" class="form-control" id="wo_dropoff_date" name="wo_dropoff_date" placeholder="Dropoff Date"/>
                        			</div>
                        			<div class="form-group">
                        				<label for="estimated_pickup" class="control-label"><strong>Estimated Pickup:</strong></label>
                        				<input type="text" class="form-control" id="wo_estimated_pickup" name="wo_estimated_pickup" placeholder="Estimated Pickup"/>
                        			</div>
                        			<div class="form-group">
                        				<label for="initial_price" class="control-label"><strong>Initial Price:</strong></label>
                        				<input type="text" class="form-control" id="wo_initial_price" name="wo_initial_price" placeholder="Initial Price" readonly="readonly"/>
                        			</div>
                        			
                        			<div class="form-group">
                        				<label for="paid" class="control-label"><strong>Paid Amount:</strong></label>
                        				<input type="text" class="form-control" id="wo_paid" name="wo_paid" placeholder="Paid Amount" readonly="readonly"/>
                        			</div>
                        			
                        			<div class="form-group">
                        				<label for="additional_cost" class="control-label"><strong>Additional Cost:</strong></label>
                        				<input type="text" class="form-control" id="wo_additional_cost" name="wo_additional_cost" placeholder="Additional Cost"/>
                        			</div>
                        			
                        			<div class="form-group">
                        				<label for="total_cost" class="control-label"><strong>Total Cost:</strong></label>
                        				<input type="text" class="form-control" id="wo_total_cost" name="wo_total_cost" placeholder="Total Cost"/>
                        			</div>
                        			
                        			<div class="form-group">
                        				<label for="notes" class="control-label"><strong>Notes:</strong></label>
                        				<textarea class="form-control" id="wo_notes" name="wo_notes" placeholder="Notes"/></textarea>
                        			</div>
                        		  </div>
                        	  </form>
                        
                        </fieldset>
                        <fieldset id="tab_repack" style="display:none">
                            
                            <form class="form-horizontal" id="step_parts_form" action="" method="post">
                        		  <div class="modal-body" id="repack_content">
                        		    
                        		    <input type="hidden" class="form-control" id="rp_work_order_id" name="rp_work_order_id" placeholder="Work Order ID"/>
                        		    <input type="hidden" class="form-control" id="rp_repack_id" name="repack_id" placeholder="Repack ID"/>
                        		    <input type="hidden" class="form-control" id="rp_customer" name="rp_customer" placeholder="Repack Customer"/>
                        		    
                        		    <div class="form-group">
                        				<label for="type" class="control-label"><strong>Type:</strong></label>
                        				<input type="text" class="form-control" id="rp_type" name="rp_type" placeholder="Repack Type"/>
                        			</div>
                        		    <div class="form-group">
                        				<label for="schedule_date" class="control-label"><strong>Schedule Date:</strong></label>
                        				<input type="text" class="form-control" id="rp_schedule_date" name="rp_schedule_date" placeholder="Schedule Date"/>
                        			</div>
                        			<div class="form-group">
                        				<label for="dropoff_date" class="control-label"><strong>Dropoff  Date:</strong></label>
                        				<input type="text" class="form-control" id="rp_dropoff_date" name="rp_dropoff_date" placeholder="Dropoff Date"/>
                        			</div>
                        			<div class="form-group">
                        				<label for="speed" class="control-label"><strong>Speed:</strong></label>
                        				<input type="text" class="form-control" id="rp_speed" name="rp_speed" placeholder="Speed"/>
                        			</div>
                        			<div class="form-group">
                        				<label for="initial_price" class="control-label"><strong>Initial Price:</strong></label>
                        				<input type="text" class="form-control" id="rp_initial_price" name="rp_initial_price" placeholder="Initial Price" readonly="readonly"/>
                        			</div>
                        			<div class="form-group">
                        				<label for="paid" class="control-label"><strong>Paid Amount:</strong></label>
                        				<input type="text" class="form-control" id="rp_paid" name="rp_paid" placeholder="Paid Amount" readonly="readonly"/>
                        			</div>
                        			<div class="form-group">
                        				<label for="estimated_pickup" class="control-label"><strong>Estimated Pickup:</strong></label>
                        				<input type="text" class="form-control" id="rp_estimated_pickup" name="rp_estimated_pickup" placeholder="Estimated Pickup"/>
                        			</div>
                        			<div class="form-group">
                        				<label for="notes" class="control-label"><strong>Notes:</strong></label>
                        				<textarea class="form-control" id="rp_notes" name="rp_notes" placeholder="Notes"/></textarea>
                        			</div>
                        		  </div>
                        	  </form>
                        </fieldset>
                        <fieldset id="tab_additional" style="padding:10px">
                            <br/>
                            <div class="row" style="margin-left:10px">
                            	<h4>Additional Work Required</h4>
                            </div>
                            <button type="button" class="btn btn-primary btn-xs" id="addFields">Add Fields</button><br><br>
                                <form class="form-horizontal" id="form_additional_work" action="" method="post">
                                    <input type="hidden" class="form-control" id="aw_repack_id" name="aw_repack_id">
                                    <input type="hidden" class="form-control" id="aw_wo_id" name="aw_wo_id">
                                        <div id="additional_work_content"></div>
                                    <div id="fields">
                                        
                                        <div class="row first_aw" id="input-group_x">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control qbcode" placeholder="QB Code" id="qbcode_x">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <textarea class="form-control desc" placeholder="Description" id="description_x"></textarea>
                                                </div>
                                            </div>
                                            <input type="hidden" class="record_id" name="record_id_1">
                                            <div class="form-group-append">
                                                <button class="btn btn-danger remove_aw" type="button" id="remove_1">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                </form>
                        </fieldset>
                        <fieldset id="tab_customer">
                           <br/>
                           <div class="row" style="margin-left:10px">
                                <h4>Customer Information</h4>
                           </div>
                            <form id="customer_form" action="" method="post">
                                <input type="hidden" class="form-control" id="acid" name="cid"/>
                                <input type="hidden" class="form-control" id="auid" name="uid"/>
                                <div class="row"  style="padding:10px">
                            	<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name" class="control-label"><strong>First Name:</strong></label>
                                        <input type="text" class="form-control" id="afirst_name" name="first_name" autocomplete="off" placeholder="Please enter your first name..." readonly="readonly"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="first_name" class="control-label"><strong>Last Name:</strong></label>
                                        <input type="text" class="form-control" id="alast_name" name="last_name" autocomplete="off" placeholder="Please enter your last_name..." readonly="readonly"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="control-label"><strong>Email:</strong></label>
                                        <input type="text" class="form-control" id="aemail" name="email" placeholder="Please enter your email..." readonly="readonly"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="control-label"><strong>Phone:</strong></label>
                                        <input type="text" class="form-control" id="aphone" name="phone" placeholder="Please enter your phone number..."/>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="control-label"><strong>Company:</strong></label>
                                        <input type="text" class="form-control" id="acompany" name="company" autocomplete="off" placeholder="Please enter your company name..."/>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="control-label"><strong>Address:</strong></label>
                                        <input type="text" class="form-control" id="aaddress" name="address" autocomplete="off" placeholder="Please enter your Address..."/><br/>
                                        <input type="text" class="form-control" id="aaddress2" name="address2" autocomplete="off" placeholder="Please enter your Address..."/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name" class="control-label"><strong>City:</strong></label>
                                        <input type="text" class="form-control" id="acity" name="city" autocomplete="off" placeholder="Please enter your City..."/>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="control-label"><strong>State:</strong></label>
                                        <input type="text" class="form-control" id="astate" name="state" autocomplete="off" placeholder="Please enter your State..."/>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="control-label"><strong>Zip:</strong></label>
                                        <input type="text" class="form-control" id="azip" name="zip" autocomplete="off" placeholder="Please enter your Zip Code..."/>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="control-label"><strong>Country:</strong></label>
                                        <input type="text" class="form-control" id="acountry" name="country" autocomplete="off" placeholder="Please enter your Country..."/>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="control-label"><strong>Sponsor:</strong></label>
                                        <input type="text" class="form-control" id="asponsor" name="sponsor" autocomplete="off" placeholder="Please enter your Sponsor..."/>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="control-label"><strong>Notes:</strong></label>
                                        <textarea class="form-control" id="notes" name="anotes" autocomplete="off" placeholder="Please enter your notes..."/></textarea>
                                    </div>
                                </div>
                              </div>
                            </form>
                        </fieldset>
                        <fieldset id="tab_container" style="padding:10px">
                            
                            <br/>
                            <div class="row" style="margin-left:10px">
                            	<h4>Container Information</h4>
                            </div>
                            <form id="container_form" action="" method="post">
                                 <input type="hidden" class="form-control" id="uid" name="uid" placeholder="customer id"/>
                                 <input type="hidden" class="form-control" id="existing_container" name="existing_container" placeholder="customer id"/>
                                <div class="row" id="add_new_container_form">
                            		<div class="col-md-6">	
                            			<div class="form-group">
                            				<label for="manufacturer" class="control-label"><strong>Manufacturer:</strong></label>
                            				<input type="text" class="form-control" id="manufacturer" name="manufacturer" placeholder="Manufacturer"/>
                            			</div>
                            			<div class="form-group">
                            				<label for="model" class="control-label"><strong>Model:</strong></label>
                            				<input type="text" class="form-control" id="model" name="model" placeholder="Model"/>
                            			</div>
                            			<div class="form-group">
                            				<label for="serial" class="control-label"><strong>Serial Number:</strong></label>
                            				<input type="text" class="form-control" id="serial" name="serial" placeholder="Serial Number (located on info card)"/>
                            			</div>
                            			<div class="form-group">
                            				<label for="aad" class="control-label"><strong>AAD:</strong></label>
                            				<select class="form-control" id="aad" name="aad" >
                            					
                            					<option value="Cypress">Cypress2</option>
                            					
                            					<option value="Vigil">Vigil</option>
                            					
                            					<option value="MARS">MarS m2</option>
                            					
                            					<option value="Argus">Argus</option>
                            					
                            					<option value="None">None</option>
                            				</select>
                            			</div>
                            			<div class="form-group">
                            				<label for="serial" class="control-label"><strong>AAD Serial # :</strong></label>
                            				<input type="text" class="form-control" id="aad_serial" name="aad_serial" placeholder="AAD Serial #"/>
                            			</div>
                            			<div class="form-group">
                            				<label for="serial" class="control-label"><strong>AAD Install Date :</strong></label>
                            				<input type="text" class="form-control" id="aad_install" name="aad_install" placeholder="yyyy-mm-dd"/>
                            			</div>
                            			<div class="form-group">
                            				<label for="serial" class="control-label"><strong>AAD Next Maintenance :</strong></label>
                            				<input type="text" class="form-control" id="aad_next_maintenance" name="aad_next_maintenance" placeholder="yyyy-mm-dd"/>
                            			</div>
                            			<div class="form-group">
                            				<label for="serial" class="control-label"><strong>AAD End of Service :</strong></label>
                            				<input type="text" class="form-control" id="aad_eol" name="aad_eol" placeholder="yyyy-mm-dd"/>
                            			</div>
                            		</div>
                            		<div class="col-md-6">
                            			<div class="form-group">
                            				<label for="reserve" class="control-label"><strong>Reserve Canopy:</strong></label>
                            				<input type="text" class="form-control" id="reserve" name="reserve" placeholder="Reserve Canopy (PDR, SMART, etc)"/>
                            			</div>
                            			<div class="form-group">
                            					<label for="reserve_size" class="control-label"><strong>Reserve Size:</strong></label>
                            					<input type="text" class="form-control" id="reserve_size" name="reserve_size" placeholder="Reserve Size (sq ft)" style="width:200px"/>
                            			</div>
                            			<div class="form-group">
                            				<label for="main" class="control-label"><strong>Main Canopy:</strong></label>
                            				<input type="text" class="form-control" id="main" name="main" placeholder="Main Canopy"/>
                            			</div>
                            			<div class="form-group">
                            					<label for="main_size" class="control-label"><strong>Reserve Size:</strong></label>
                            					<input type="text" class="form-control" id="main_size" name="main_size" placeholder="Main Size (sq ft)" style="width:200px"/>
                            			</div>
                            			<div class="form-group">
                            					<label for="main_size" class="control-label"><strong>Reserve Serial:</strong></label>
                            					<input type="text" class="form-control" id="reserve_serial" name="reserve_serial" placeholder="Reserve Serial" style="width:200px"/>
                            			</div>
                            		</div>
                            	</div>
                            </form>
                        </fieldset>
                    </div>
                    <div class="line"></div>
                    <div class="modal-footer">
                		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> 
                		<button type="button" class="btn btn-success" id="modal-save">Save</button>
                		<button type="button" class="btn btn-check"></button>
                	</div>
                </div>
            </div>
        </div>

<!-- ################# SCHEDULED AND DELIVERED TABLE ####################### -->
<div class="container">
	<h3 style="margin-top:20px;margin-bottom:20px">Scheduled Repacks</h3>
  
	<button id="show_delivered" type="button" class="btn btn-primary" style="float:right;">Show Delivered Repacks</button>

    <div class="row" style="margin-top:60px">
        <div class="scheduled_list w-100 mt-3">
            <table id="scheduled_list" class="table table-striped scheduled-repacks" cellspacing="0">
              <thead>
                <tr>
                  <th class="th-sm" scope="col">WO#</th>  
                  <th class="th-sm" scope="col">Type/Speed</th>
                  <th class="th-sm" scope="col">Customer</th>
                  <th class="th-sm" scope="col">Container</th>
                  <th class="th-sm" scope="col">Dropoff/Pickup</th>
                  <th class="th-sm" scope="col">Next Repack</th>
                  <th class="th-sm" scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
        <div class="delivered_list w-100 mt-3 hidden">
            <table id="delivered_list" class="table table-striped scheduled-repacks-delivered" cellspacing="0">
              <thead>
                <tr>
                  <th class="th-sm" scope="col">WO#</th>  
                  <th class="th-sm" scope="col">Type/Speed</th>
                  <th class="th-sm" scope="col">Customer</th>
                  <th class="th-sm" scope="col">Container</th>
                  <th class="th-sm" scope="col">Dropoff/Pickup</th>
                  <th class="th-sm" scope="col">Next Repack</th>
                  <th class="th-sm" scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
    </div>    
</div>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
var table1, table2;

$( document ).ready(function() {
    $('#show_delivered').on('click', function (e) {
        e.preventDefault();
        var table1 = $('#scheduled_list').DataTable();
        var table2 = $('#delivered_list').DataTable();
    
       // Toggle visibility of tables
      if ($('.scheduled_list').hasClass('hidden')) {
        $('.scheduled_list').removeClass('hidden');
        $('.delivered_list').addClass('hidden');
        table1 = $('#scheduled_list').DataTable(); // Reinitialize the DataTable
        table2.destroy(); // Destroy the DataTable for the hidden table
      } else {
        $('.scheduled_list').addClass('hidden');
        $('.delivered_list').removeClass('hidden');
        table2 = $('#delivered_list').DataTable(); // Reinitialize the DataTable
        table1.destroy(); // Destroy the DataTable for the hidden table
      }
        $(this).text(function(i, text){
          return text === "Show Delivered Repacks" ? "Show Scheduled Repacks" : "Show Delivered Repacks";
        })
    });
    
    var tabel_delivered = null;
    
    tabel_delivered = $('#delivered_list').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "scrollX": true,
        "autoWidth": false,
        "order": [[ 0, 'asc' ]],
        "ajax":
        {
            "url": "<?php  echo root();?>do/delivered_work_order_list/",
            "type": "POST"
        },
        "deferRender": true,
        //columnDefs: [
        //    { "width": "10px", "targets": [0,1] },     
        //],
        "columns": [
            
            { "data": "wo_id" },
            { "data": "repack_type", "render": function ( data, type, row, meta ){
                return '<div style="text-align: center">'+row.repack_type.toUpperCase()+'<br/>'+row.speed.toUpperCase()+'</div>';
              }
            },
            { "data": "name" },
            { "data": "container_name" },
            { "data": "wo_dropoff_date", "render": function ( data, type, row, meta ){
                return '<div style="text-align: center">'+row.wo_dropoff_date+'<br/>'+row.wo_estimated_pickup+'</div>';
              }
            },
           { "data": "next_repack", "render": function ( data, type, row, meta ){
                return '<div style="text-align: center">'+data+'</div>';
              }
            },
            { "data": "wo_status", "render": function ( data, type, row, meta ){
                    var btn_class='btn-primary';
                    var btn_txt = 'view';

                return '<div style="text-align: center"><button type="button" data-toggle="modal" data-target="#repack_modal" data-backdrop="static" data-keyboard="false" class="btn btn-' + row.repack_id +' '+ btn_class +' repack-btn-delivered" data-repack-id="'+row.repack_id+'" data-wo-status="'+row.wo_status+'" >' + btn_txt + '</button><br/>'+row.wo_status.toUpperCase()+'</div>';
              }
            }
        ],
    });
    
    var tabel = null;
    
    tabel = $('#scheduled_list').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "scrollX": true,
        "autoWidth": false,
        "order": [[ 0, 'asc' ]],
        "ajax":
        {
            "url": "<?php  echo root();?>do/work_order_list/",
            "type": "POST"
        },
        "deferRender": true,
        columnDefs: [
            { "width": "30px", "targets": [0,1] },     
        ],
        "columns": [
            
            { "data": "wo_id" },
            { "data": "wo_type", "render": function ( data, type, row, meta ){
                return '<div style="text-align: center">'+row.wo_type.toUpperCase()+'<br/>'+row.speed.toUpperCase()+'</div>';
              }
            },
            { "data": "name" },
            { "data": "container_name" },
            { "data": "wo_dropoff_date", "render": function ( data, type, row, meta ){
                return '<div style="text-align: center">'+row.wo_dropoff_date+'<br/>'+row.wo_estimated_pickup+'</div>';
              }
            },{ "data": "next_repack", "render": function ( data, type, row, meta ){
                return '<div style="text-align: center">'+data+'</div>';
              }
            },
            { "data": "wo_status", "render": function ( data, type, row, meta ){
                if(row.wo_status == 'pending'){
                    var btn_class='btn-primary';
                    var btn_txt = 'Check-In';
                }
                if(row.wo_status == 'check-in'){
                    var btn_class='btn-success';
                    var btn_txt = 'Begin Repack';
                }
                if(row.wo_status == 'In-Progress'){
                    var btn_class='btn-warning';
                    var btn_txt = 'In-Progress';
                }
                if(row.wo_status == 'Completed'){
                    var btn_class='btn-info';
                    var btn_txt = 'Completed';
                }

                
                return '<div style="text-align: center"><button type="button" data-toggle="modal" data-target="#repack_modal" data-backdrop="static" data-keyboard="false" class="btn btn-' + row.repack_id + ' ' + btn_class + ' repack-btn">' + btn_txt + '</button><br/>'+row.wo_status.toUpperCase()+'</div>';
              }
            }
        ],
    });
    
    $(".tabs").click(function(){
        
        toggle_tab($(this).attr('id'));
    
        $(".tabs").removeClass("active");
        $(".tabs h6").removeClass("font-weight-bold");    
        $(".tabs h6").addClass("text-muted");    
        $(this).children("h6").removeClass("text-muted");
        $(this).children("h6").addClass("font-weight-bold");
        $(this).addClass("active");
    
        current_fs = $(".active");
    
        next_fs = $(this).attr('id');
        next_fs = "#tab_" + next_fs;
    
        $("fieldset").removeClass("show");
        $(next_fs).addClass("show");
    
        current_fs.animate({}, {
            step: function() {
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({
                    'display': 'block'
                });
            }
        });
    });
    
    $(document).on('click', '.repack-btn', function() {
        var timer;
        var row = tabel.row($(this).closest('tr')).data();
        
        if(row.wo_status =='pending'){
            $(".btn-check").html("Checked-In");
            $(".btn-check").attr('data-text','check-in');
            $(".btn-check").addClass('btn-warning');   
        }
        
        if(row.wo_status =='check-in'){
            $(".btn-check").html("In-Progress");
            $(".btn-check").attr('data-text','In-Progress');
            $(".btn-check").addClass('btn-warning');   
        }
        
        if(row.wo_status =='In-Progress'){
            $(".btn-check").html("Completed");
            $(".btn-check").attr('data-text','Completed');
            $(".btn-check").removeClass('btn-warning');   
            $(".btn-check").addClass('btn-info');   
        }
        
        if(row.wo_status =='Completed'){
            $(".btn-check").html("Delivered to Customer");
            $(".btn-check").attr('data-text','Delivered');
            $(".btn-check").removeClass('btn-warning');   
            $(".btn-check").addClass('btn-primary');   
        }
        
        if(row.wo_status =='Delivered'){
            $(".btn-check").html("Delivered");
            $(".btn-check").attr('data-text','Delivered');
        }

        if(row.wo_status == "Completed" || row.wo_status == "Delivered" ){
            $("#work_order").hide();
            $("#tab_work_order").hide();
            $("#tab_work_order").removeClass();
            $("#repack").show();
            $("#tab_repack").show();
            $("#tab_repack").addClass('show');
            $("#modal-save").click(save_repack_modal);
            
                clearTimeout(timer);
                timer = setTimeout(function() {
                  repack_info(row.repack_id, row.wo_status); //data from repack
                }, 500);
            
        }else{
            $("#work_order").show();
            $("#tab_work_order").show();
            $("#tab_work_order").addClass('show');
            $("#repack").hide();
            $("#tab_repack").hide();
            $("#tab_repack").removeClass();
            $("#modal-save").click(save_work_order_modal);
            
            clearTimeout(timer);
                timer = setTimeout(function() {
                  repack(row.repack_id, row.wo_status); //data from work_order
                }, 500);
            
            
        }
    });
    
    $(document).on('click', '.repack-btn-delivered', function() {
        var timer;
        var repack_id = $(this).attr('data-repack-id');
        var status = $(this).attr('data-wo-status');
        
        $(".btn-check").html("Delivered");
        $(".btn-check").attr('style','display:none');
        $("#modal-save").attr('style','display:none');
        
            $("#work_order").hide();
            $("#tab_work_order").hide();
            $("#tab_work_order").removeClass();
            $("#repack").show();
            $("#tab_repack").show();
            $("#tab_repack").addClass('show');
            
            
                clearTimeout(timer);
                timer = setTimeout(function() {
                  repack_info(repack_id, status); //data from repack
                }, 500);
    });
    
    $(document).on('click', '.btn-check', function() {
        var id = $(this).attr('data-check');
        var wo_id = $(this).attr('data-wo-id');
        var status = $(this).attr('data-text');
        
        change_status(id,status,wo_id);
    });

}); 
    $(".first_aw").hide();
    var timer;
    
    // Remove the active class from all tabs and panes when the modal is hidden
    $("#repack_modal").on('hidden.bs.modal', function (event) {
      x=1;
      $(".modal-backdrop").attr('style','display:none');
      $("#additional_work_content").empty();
      $("#fields").empty();
      $("#fields").append('<div class="row first_aw" id="input-group_x"><div class="col-md-4"><div class="form-group"><input type="text" class="form-control qbcode" placeholder="QB Code" id="qbcode_x"></div></div><div class="col-md-6"><div class="form-group"><textarea class="form-control desc" placeholder="Description" id="description_x"></textarea></div></div><input type="hidden" class="record_id" name="record_id_1"><div class="form-group-append"><button class="btn btn-danger remove_aw" type="button" id="remove_1"><i class="fa fa-trash"></i></button></div></div></div>');
      $('.first_aw').hide();
      var tabs = $(event.target).find('.tabs');
      var panes = $(event.target).find('.modal-body > fieldset');
      tabs.removeClass('active');
      panes.removeClass('show');
      $('#scheduled_list').DataTable().ajax.reload(function(json){
        if (json.error) {
          console.log(json.error);
        }
     });

    });


    function toggle_tab(id){
        
        if(id != 'work_order'){
            $("#tab_work_order").hide();
        }else{
            $("#tab_work_order").show();
        }
        
        if(id != 'repack'){
            $("#tab_repack").hide();
        }else{
            $("#tab_repack").show();
        }
        
        if(id != 'additional')
        {
            $("#fields").empty();
            $("#fields").append('<div class="row first_aw" id="input-group_x"><div class="col-md-4"><div class="form-group"><input type="text" class="form-control qbcode" placeholder="QB Code" id="qbcode_x"></div></div><div class="col-md-6"><div class="form-group"><textarea class="form-control desc" placeholder="Description" id="description_x"></textarea></div></div><input type="hidden" class="record_id" name="record_id_1"><div class="form-group-append"><button class="btn btn-danger remove_aw" type="button" id="remove_1"><i class="fa fa-trash"></i></button></div></div></div>');
            $('.first_aw').hide();
        }
        
    }
    
    function change_status(id,status,wo_id,el){
         
         $.ajax({
            url: '<?php  echo root();?>do/update_status_repack/',
            type: 'POST',
            dataType: 'json', 
            data: {'status':status, 'repack_id': id},
            encode: true,
            success: function(res){
                if(res != ''){
                    console.log(el+' - '+res.status);
                    $(".btn-"+el).html(res.status);
                    $('#scheduled_list').DataTable().ajax.reload(function(json){
                        if (json.error) {
                            console.log(json.error);
                        }
                    });
                    $('#repack_modal').modal('hide');
                    //delete_empty_aw(id,wo_id);
                }
            }
        });
    }
    
    /* ################# WORK ORDER*/
    
    function repack(id,status) {
        
    	$('#repack_modal').modal({backdrop: 'static', keyboard: false});
    	
    	$.ajax({
            url: '<?php  echo root();?>do/repack_content/?id='+id+'&load=1',
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $('#additional, #customer, #container').attr('data-repack-id',res.repack_id);
                $('#additional, #customer, #container, .btn-check').attr('data-wo-id',res.work_order_id);
                $('#additional, #customer, #container').attr('data-cust-id',res.wo_customer);
                $('#additional, #customer, #container').attr('data-cont-id',res.con_id);
                $('#additional, #customer, #container, #tab_additional').attr('data-status',res.repack_status);
                $('.wo-id').html('Work Order #'+res.work_order_id);
                $('.rp-id').html('Repack Info #'+res.repack_id);
                $('.btn-check').attr('data-check',res.repack_id);
                $('input[name="work_order_id"]').val(res.work_order_id);
                $('input[name="repack_id"]').val(res.repack_id);
                $('input[name="wo_type"]').val(res.wo_type);
                $('input[name="wo_customer"]').val(res.wo_customer);
                $('input[name="wo_dropoff_date"]').val(res.wo_dropoff);
                $('input[name="wo_estimated_pickup"]').val(res.wo_pickup);
                $('input[name="wo_schedule_date"]').val(res.wo_schedule);
                $('input[name="wo_initial_price"]').val(res.wo_initial_price);
                $('input[name="wo_paid"]').val(res.wo_paid);
                $('input[name="wo_total_cost"]').val(res.wo_total_cost);
                $('input[name="wo_additional_cost"]').val(res.wo_additional_cost);
                $('textarea[name="wo_notes"]').val(res.wo_notes);
            },
             error: function(jqXHR, textStatus, errorThrown) {
                setTimeout(function() {$('#repack_modal').modal('hide');}, 200);
                alert("error");
            }
        });
    }
    
    function save_work_order_modal(){
        clearTimeout(timer);
            timer = setTimeout(function() {
              save_work_order();
            }, 500);
        
        $('#repack_modal').modal('hide');
    }
    
    function save_work_order(){
        var formData = {
          repack_id             : $("#repack_id").val(),
          wo_id                 : $("#work_order_id").val(),
          wo_type               : $("#wo_type").val(),
          wo_customer           : $("#wo_customer").val(),
          wo_dropoff_date       : $("#wo_dropoff_date").val(),
          wo_estimated_pickup   : $("#wo_estimated_pickup").val(),
          wo_initial_price      : $("#wo_initial_price").val(),
          wo_paid               : $("#wo_paid").val(),
          wo_total_cost         : $("#wo_total_cost").val(),
          wo_additional_cost    : $("#wo_additional_cost").val(),
          wo_notes              : $("#wo_notes").val(),
          wo_schedule_date      : $("#wo_schedule_date").val(),
          work_order_id         : $("#work_order_id").val(),
        };
        
        $.ajax({
            url: '<?php  echo root();?>do/update_work_order/',
            type: 'POST',
            dataType: 'json', 
            data: formData,
            encode: true,
            success: function(res){
                if(res){
                    $('#scheduled_list').DataTable().ajax.reload(function(json){
                        if (json.error) {
                            console.log(json.error);
                        }
                    });
                }
            }
        });
    }
    
    $("#wo_dropoff_date, #wo_estimated_pickup, #wo_intial_price, #wo_paid, #wo_additional_cost, #wo_notes, #wo_total_cost").keyup(function() {
        clearTimeout(timer);
        timer = setTimeout(function() {
          save_work_order();
        }, 300);
    }); 
    
            
    $( "#wo_dropoff_date" ).datepicker({ 
                                    minDate: 0, 
                                    maxDate: "+12M", 
                                    dateFormat: "mm-dd-yy", 
                                    setDate: '<?php  echo date('Y-m-d')?>', 
                                    altField: "#wo_dropoff_date",
                                    onSelect: function(dateText) {
                                        $(this).val(this.value);
                                        save_work_order();
                                    }
    });
        
    $( "#wo_estimated_pickup" ).datepicker({ 
                                    minDate: 0, 
                                    maxDate: "+12M", 
                                    dateFormat: "mm-dd-yy", 
                                    setDate: '<?php  echo date('Y-m-d')?>', 
                                    altField: "#wo_estimated_pickup",
                                    onSelect: function(dateText) {
                                        $(this).val(this.value);
                                        save_work_order();
                                    }
        
    });

    
    /* ################# REPACK */
    
    function repack_info(id,status) {
        
    	$('#repack_modal').modal({backdrop: 'static', keyboard: false});
    	
    	$.ajax({
            url: '<?php  echo root();?>do/repack_info_content/?id='+id+'&load=1',
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $('#additional, #customer, #container').attr('data-repack-id',res.repack_id);
                $('#additional, #customer, #container, .btn-check').attr('data-wo-id',res.work_order_id);
                $('#additional, #customer, #container').attr('data-cust-id',res.repack_customer);
                $('#additional, #customer, #container').attr('data-cont-id',res.con_id);
                $('#additional, #customer, #container, #tab_additional').attr('data-status',res.repack_status);
                $('.wo-id').html('Work Order #'+res.work_order_id);
                $('.rp-id').html('Repack Info #'+res.repack_id);
                $('.btn-check').attr('data-check',res.repack_id);
                $('input[name="rp_work_order_id"]').val(res.work_order_id);
                $('input[name="repack_id"]').val(res.repack_id);
                $('input[name="rp_type"]').val(res.repack_type);
                $('input[name="rp_customer"]').val(res.repack_customer);
                $('input[name="rp_dropoff_date"]').val(res.repack_dropoff);
                $('input[name="rp_estimated_pickup"]').val(res.repack_pickup);
                $('input[name="rp_schedule_date"]').val(res.repack_schedule);
                $('textarea[name="rp_notes"]').val(res.repack_notes);
                $('input[name="rp_speed"]').val(res.repack_speed);
                $('input[name="rp_initial_price"]').val(res.wo_initial_price);
                $('input[name="rp_paid"]').val(res.wo_paid);
            },
             error: function(jqXHR, textStatus, errorThrown) {
                setTimeout(function() {$('#repack_modal').modal('hide');}, 200);
                alert("error");
            }
        });
    }
    
    
    function save_repack_modal(){
        clearTimeout(timer);
            timer = setTimeout(function() {
              save_repack();
            }, 500);
        
        $('#repack_modal').modal('hide');
    }
    
    function save_repack(){
        var formData = {
          repack_id             : $("#rp_repack_id").val(),
          wo_id                 : $("#rp_work_order_id").val(),
          rp_customer           : $("#rp_customer").val(),
          rp_type               : $("#rp_type").val(),
          rp_schedule_date      : $("#rp_schedule_date").val(),
          rp_dropoff_date       : $("#rp_dropoff_date").val(),
          rp_estimated_pickup   : $("#rp_estimated_pickup").val(),
          rp_notes              : $("#rp_notes").val(),
          rp_speed              : $("#rp_speed").val(),
        };
        
        //$.post( "/inc/exec.php?act=update_repacks&ajax=1&schedule=1", formData, '', 'script');

        $.ajax({
            url: '<?php  echo root();?>do/update_repacks/',
            type: 'POST',
            dataType: 'json', 
            data: formData,
            encode: true,
            success: function(res){
                if(res){
                    $('#scheduled_list').DataTable().ajax.reload(function(json){
                        if (json.error) {
                            console.log(json.error);
                        }
                    });
                }
            }
        });
    }
    
    $("#rp_type, #rp_schedule_date, #rp_dropoff_date, #rp_estimated_pickup, #rp_speed, #rp_notes").keyup(function() {
        clearTimeout(timer);
        timer = setTimeout(function() {
          save_repack();
        }, 300);
    });
    
    $( "#rp_dropoff_date" ).datepicker({ 
                                    minDate: 0, 
                                    maxDate: "+12M", 
                                    dateFormat: "mm-dd-yy", 
                                    setDate: '<?php  echo date('Y-m-d')?>', 
                                    altField: "#rp_dropoff_date",
                                    onSelect: function(dateText) {
                                        $(this).val(this.value);
                                        save_repack();
                                    }
    });
    
    $( "#rp_estimated_pickup" ).datepicker({ 
                                    minDate: 0, 
                                    maxDate: "+12M", 
                                    dateFormat: "mm-dd-yy", 
                                    setDate: '<?php  echo date('Y-m-d')?>', 
                                    altField: "#rp_estimated_pickup",
                                    onSelect: function(dateText) {
                                        $(this).val(this.value);
                                        save_repack();
                                    }
        
    });
    
    $( "#rp_schedule_date" ).datepicker({ 
                                    minDate: 0, 
                                    maxDate: "+12M", 
                                    dateFormat: "mm-dd-yy", 
                                    setDate: '<?php  echo date('Y-m-d')?>', 
                                    altField: "#rp_schedule_date",
                                    onSelect: function(dateText) {
                                        $(this).val(this.value);
                                        save_repack();
                                    }
    });
    
    $(document).on('click', '#additional', function() {
        var repack_id = $(this).attr('data-repack-id');
        var repack_status = $(this).attr('data-status');
        
        if (repack_status == 'Completed') {
          $("#addFields").hide();
        } else {
          $("#addFields").show();
        }
        
        $.ajax({
            url: '<?php  echo root();?>do/additional_work_content/?id='+repack_id+'&load=1',
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                if(res){
                    $('#scheduled_list').DataTable().ajax.reload(function(json){
                        if (json.error) {
                            console.log(json.error);
                        }
                    });
                }
                $('input[name="aw_wo_id"]').val(res.wo_id);
                $('input[name="aw_repack_id"]').val(res.repack_id);
                $("#additional_work_content").html(res.content);
                //$("#fields").append(res.content);
                counter = res.total;
                console.log("counter "+counter);
            },
             error: function(jqXHR, textStatus, errorThrown) {
                setTimeout(function() {$('#repack_modal').modal('hide');}, 200);
                alert("error");
            }
        });
        
        //inisialisasi variabel counter
        var counter = 2;
        var first = true; //variabel penanda bahwa ini adalah tambahan pertama
        
        //menambahkan field ketika tombol "Add Fields" diklik
        $("#addFields").click(function() {
            ind = (counter+1);
            
            if (!$('.first_aw').is(':visible')){
                $(".first_aw").show();
            }
            
            if ($('.first_aw').is(':visible') && $("#qbcode_x").val() !='' && $("#description_x").val() !='')
            {
                if($('#qbcode_'+(ind-1)).val() != '' && $('#description_'+(ind-1)).val() !='')
                {
                    $("#fields").append('<div class="row" id="input-group_' + (ind) + '"><div class="col-md-4"><div class="form-group"><input type="text" class="form-control qbcode" placeholder="QB Code" id="qbcode_' + (ind) + '"></div></div><div class="col-md-6"><div class="form-group"><textarea class="form-control desc" placeholder="Description" id="description_' + (ind) + '"></textarea></div></div><input type="hidden" class="record_id" name="record_id_'+ (ind) +'"><div class="form-group-append"><button class="btn btn-danger remove_aw" type="button" id="remove_' + (ind) + '"><i class="fa fa-trash"></i></button></div></div></div>');
                counter++;
                    console.log("counter "+counter);
                }
            }
            
        });
     
        //menghapus field ketika tombol "Remove" diklik
        $(document).on("click", ".remove_aw", function() {
            //mendapatkan nomor urut dari pasangan field yang akan dihapus
            var id = $(this).attr("id");
            var split_id = id.split("_");
            var deleteindex = split_id[1];
            //alert(deleteindex);
            //menghapus pasangan field yang memiliki nomor urut yang sama
            $("#input-group_" + deleteindex).remove();
           
             if (deleteindex == 'x') {
              $("#fields").append('<div class="row first_aw" id="input-group_' + (counter+1) + '"><div class="col-md-4"><div class="form-group"><input type="text" class="form-control qbcode" placeholder="QB Code" id="qbcode_' + (counter+1) + '"></div></div><div class="col-md-6"><div class="form-group"><textarea class="form-control desc" placeholder="Description" id="description_' + (counter+1) + '"></textarea></div></div><input type="hidden" class="record_id" name="record_id_'+ (counter+1) +'"><div class="form-group-append"><button class="btn btn-danger remove_aw" type="button" id="remove_' + (counter+1) + '"><i class="fa fa-trash"></i></button></div></div></div>');
              $('.first_aw').hide();
            }
            
            if ($(this).attr('data-id') !== undefined ) {
                id = $(this).attr("data-id");
                 $.ajax({
                          type: "GET",
                          url: "<?php  echo root();?>do/delete_additional_work/?id="+id,
                          dataType:'JSON', 
                          success:function(res){
                            if(res){
                                $('#scheduled_list').DataTable().ajax.reload(function(json){
                                    if (json.error) {
                                        console.log(json.error);
                                    }
                                });
                            }
                          }
                  });
            }
            
            counter--;
            console.log("counter "+counter);
        });
        
        var typingTimer;
        var doneTypingInterval = 1000; // 500 milliseconds
        // Add keyup event listener to qbcode and description fields
        $("#fields").on("keyup", ".qbcode, .desc", function() {
            
            if ($(this).attr("class").indexOf("qbcode") !== -1) {
                var qbcode       = $(this).attr("id"); 
                var qb_val        = $(this).val();
            }
            if ($(this).attr("class").indexOf("desc") !== -1) {
                var description   = $(this).attr("id"); 
                var desc_val      = $(this).val();
            }
            
                clearTimeout(typingTimer);
                  typingTimer = setTimeout(function() {
                    save_aw(qb_val,desc_val,qbcode,description)
                  }, doneTypingInterval);
                
            // disable/enable addFields button based on input values
            if(qb_val == '' || desc_val == ''){
              $("#addFields").prop("disabled", true);
            } else {
              $("#addFields").prop("disabled", false);
            }
        });
        
        function save_aw(qb_val,desc_val,qbcode,description){

            if (typeof qbcode === 'undefined') {
                description = description.replace("description", "qbcode");
                qbcode     = $('#' + description);
                qb_val      = qbcode.val();
                var record        =  description.replace("description", "record_id");
                var remove        =  description.replace("qbcode", "remove");
            }

            console.log(qbcode, description);
            console.log(qb_val, desc_val);
            
            
            var repack_id     =  $("#aw_repack_id").val();
            var wo_id         =  $("#aw_wo_id").val();
            var record_id     =  ($('input[name="'+record+'"]').val() > 0 ) ? $('input[name="'+record+'"]').val() : 0;
                
            // Determine if insert or update query should be used
            var url = '<?php  echo root();?>do/save_additional_work/?id='+record_id;
            
            $.ajax({
                      url: url,
                      type: 'POST',
                      dataType: 'json', // added data type
                      data: {'repack_id':repack_id, 'wo_id':wo_id, 'qbcode': qb_val, 'description': desc_val, 'record_id': record_id},
                      success: function(response) {
                            if(response != ''){
                                $('#scheduled_list').DataTable().ajax.reload(function(json){
                                    if (json.error) {
                                        console.log(json.error);
                                    }
                                });
                            }
                        console.log(response);
                        
                        // Update record_id hidden input field if inserting a new record
                        if (!record_id) {
                          var new_record_id = response; // Assuming the server returns the new record ID
                         $('input[name="'+record+'"]').val(new_record_id);
                         $('#'+remove+'').attr('data-id',new_record_id);
                        }
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(textStatus, errorThrown);
                      }
                    });
        }
        
});

    /* ################# ADDITIONAL WORK 
    
    $(document).on('click', '#additional', function() {
        $("#additional_work_content").empty();
        $("#fields").empty();
        var typingTimer;
        var doneTypingInterval = 500; // 500 milliseconds
    
        
        var max_fields = 10;
        var wrapper = $("#fields");
        var add_button = $("#addFields");
        
        var repack_id = $(this).attr('data-repack-id');
        
        $.ajax({
            url: '<?php  echo root();?>do/additional_work_content/?id='+repack_id+'&load=1',
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                if(res){
                    $('#scheduled_list').DataTable().ajax.reload(function(json){
                        if (json.error) {
                            console.log(json.error);
                        }
                    });
                }
                $('input[name="aw_wo_id"]').val(res.wo_id);
                $('input[name="aw_repack_id"]').val(res.repack_id);
                //$("#additional_work_content").html(res.content);
                $(wrapper).append(res.content);
                x = res.total;
            },
             error: function(jqXHR, textStatus, errorThrown) {
                setTimeout(function() {$('#repack_modal').modal('hide');}, 200);
                alert("error");
            }
        });
        
        var isFirstClick = true;
        $(add_button).click(function(e) {
            console.log(isFirstClick);
            e.preventDefault();
        
            if (isFirstClick == true) {
                // If this is the first click, always append the wrapper
                isFirstClick = false;
                if (x < max_fields) {
                    $(wrapper).append('<div class="row"><div class="col-md-4"><div class="form-group"><label for="qbcode" class="control-label">QB Code:</label><input type="text" class="form-control qbcode" name="qbcode_'+x+'"></div></div><div class="col-md-6"><div class="form-group"><label for="description" class="control-label">Description:</label><br/><textarea class="form-control boxsizingBorder description" name="description_'+x+'"></textarea></div></div><input type="hidden" class="record_id" name="record_id_'+x+'"><a href="#" class="remove_field remove_'+x+'">Remove</a></div>');
                    x++;
                }
            }
            
            $(wrapper).on("click", ".remove_field", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();   
                x--;
                isFirstClick = true;
            });
            
          
             // bind keyup event handler to the new fields
            $(wrapper).find(".qbcode, .description").keyup(function() {
                if ($(this).attr("name").indexOf("qbcode") !== -1) {
                    qbcode       = $(this).attr("name"); 
                    qb_val        = $(this).val();
                }
                if ($(this).attr("name").indexOf("description") !== -1) {
                    description   = $(this).attr("name"); 
                    desc_val      = $(this).val();
                }
                
                clearTimeout(typingTimer);
                  typingTimer = setTimeout(function() {
                    console.log(qbcode, description);
                    console.log(qb_val, desc_val);
                    save_aw(qb_val,desc_val,qbcode,description)
                  }, doneTypingInterval);
                
                if (qb_val === "" && desc_val === "") {
                  isFirstClick = false;
                }else{
                    x++;
                    isFirstClick = true;
                }
            
            });
            
            function save_aw(qb_val,desc_val,qbcode,description){
                
                var record        =  qbcode.replace("qbcode", "record_id");
                var remove        =  qbcode.replace("qbcode", "remove");
                
                var repack_id = $("#aw_repack_id").val();
                var wo_id     = $("#aw_wo_id").val();
                var record_id = ($('input[name="'+record+'"]').val() > 0 ) ? $('input[name="'+record+'"]').val() : 0;
                
                // Determine if insert or update query should be used
                var url = '<?php  echo root();?>do/save_additional_work/?id='+record_id;
                
                console.log("record_id "+record_id);
                //console.log("remove "+remove);
                console.log(qb_val+'---'+desc_val);
                 // Make AJAX call to insert/update values in database
                    $.ajax({
                      url: url,
                      type: 'POST',
                      dataType: 'json', // added data type
                      data: {'repack_id':repack_id, 'wo_id':wo_id, 'qbcode': qb_val, 'description': desc_val, 'record_id': record_id},
                      success: function(response) {
                            if(response != ''){
                                $('#scheduled_list').DataTable().ajax.reload(function(json){
                                    if (json.error) {
                                        console.log(json.error);
                                    }
                                });
                            }
                        console.log(response);
                        
                        // Update record_id hidden input field if inserting a new record
                        if (!record_id) {
                          var new_record_id = response; // Assuming the server returns the new record ID
                         $('input[name="'+record+'"]').val(new_record_id);
                         $('.'+remove+'').attr('onclick','remove_aw('+new_record_id+')');
                        }
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                        //console.log(textStatus, errorThrown);
                      }
                    });
                
            }
            
        });
        
    });
    
    function remove_aw(id){
        
        $(".row_"+id).hide();
        $(".row_"+id).remove();
                 $.ajax({
                          type: "GET",
                          url: "<?php  echo root();?>do/delete_additional_work/?id="+id,
                          dataType:'JSON', 
                          success:function(res){
                            if(res){
                                $('#scheduled_list').DataTable().ajax.reload(function(json){
                                    if (json.error) {
                                        console.log(json.error);
                                    }
                                });
                            }
                          }
                  });
                  x--;
    }*/
    // Use find() to get all qbcode elements inside the wrapper
            /*$(wrapper).find(".qbcode").each(function() {
              $(this).keyup(function() {

                      qbcode       =  $(this).attr("name");
                      description   =  qbcode.replace("qbcode", "description");
                      record        =  qbcode.replace("qbcode", "record_id");
                      remove        =  qbcode.replace("qbcode", "remove");
                      
                      qb_val        = $(this).val();
                      desc_val      = $(description).val();
                      $('input[name="'+qbcode+'"]').val(qb_val);
                      
                      clearTimeout(typingTimer);
                      typingTimer = setTimeout(function() {
                        if(record > 0){
                          console.log(qb_val, desc_val);
                        }
                      save_aw(qb_val, desc_val, record, remove);
                      }, doneTypingInterval);
              });
            });
            $(wrapper).find(".description").each(function() {
              $(this).keyup(function() {
                
                  description   = $(this).attr("name");
                  qbcode       = description.replace("description", "qbcode");
                  record        = qbcode.replace("qbcode", "record_id");
                  remove        = qbcode.replace("qbcode", "remove");
                  
                  qb_val        = $(qbcode).val();
                  desc_val      = $(this).val();
                  
                  clearTimeout(typingTimer);
                  typingTimer = setTimeout(function() {
                      console.log(qbcode, description);
                      console.log(qb_val, desc_val);
                  save_aw(qb_val, desc_val, record, remove);
                  }, doneTypingInterval);
              });
            });
            */
    
            
    /* ################# CUSTOMER */
    
    $(document).on('click', '#customer', function() {
        var cust_id = $(this).attr('data-cust-id');
    	$.ajax({
            url: "<?php  echo root();?>do/get_customer_data/?id="+cust_id,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                console.log(res);
                 $('#acid').val(res.cid);
                 $('#auid').val(res.uid);
                 $('#afirst_name').val(res.first_name);
                 $('#alast_name').val(res.last_name);
                 $('#aemail').val(res.email);
                 $('#aphone').val(res.phone);
                 $('#acompany').val(res.company);
                 $('#aaddress').val(res.address);
                 $('#aaddress2').val(res.address_2);
                 $('#acity').val(res.city);
                 $('#astate').val(res.state);
                 $('#azip').val(res.zip);
                 $('#acountry').val(res.country);
                 $('#asponsor').val(res.sponsor);
                 $('#anotes').val(res.notes);
            },
             error: function(jqXHR, textStatus, errorThrown) {
                setTimeout(function() {$('#repack_modal').modal('hide');}, 200);
                alert("error");
            }
        });
    });

    function customer() {
    	$.post( "/inc/exec.php?act=update_customer&ajax=1&schedule=1", $('#customer_form').serialize(), '', 'script');
    }
    
    $("#acid, #auid, #afirst_name, #alast_name, #aemail, #aphone, #acompany, #aaddress, #aaddress2, #acity, #astate, #azip, #acountry, #asponsor, #anotes").keyup(function() {
        clearTimeout(timer);
        timer = setTimeout(function() {
          customer();
        }, 300);
    });
    
    /* ################# CONTAINER */
    
    $(document).on('click', '#container', function() {
        var id = $(this).attr('data-cont-id');
        $.ajax({
            url: "<?php  echo root();?>do/get_container_data/?id="+id,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                console.log(res);
                 $('#uid').val(res.customer);
                 $('#existing_container').val(res.id);
                 $('#manufacturer').val(res.manufacturer);
                 $('#model').val(res.model);
                 $('#serial').val(res.serial);
                 $('#aad').val(res.aad);
                 $('#aad_serial').val(res.aad_serial);
                 $('#aad_install').val(res.aad_install);
                 $('#aad_next_maintenance').val(res.aad_next_maintenance);
                 $('#aad_eol').val(res.aad_eol);
                 $('#reserve').val(res.reserve);
                 $('#reserve_size').val(res.reserve_size);
                 $('#reserve_serial').val(res.reserve_serial);
                 $('#main').val(res.main);
                 $('#main_size').val(res.main_size);
            }
        });
    });
    
    function add_container() {
    	$.post( "/inc/exec.php?act=add_container&ajax=1&schedule=1", $('#container_form').serialize(), '', 'script');
    }
    
    $("#manufacturer, #model, #serial, #aad, #aad_serial, #aad, #aad_install, #aad_next_maintenance, #aad_eol, #reserve, #reserve_size, #reserve_serial, #main, #main_size").keyup(function() {
        clearTimeout(timer);
        timer = setTimeout(function() {
          add_container();
        }, 300);
    });

</script>