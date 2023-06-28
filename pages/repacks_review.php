<?php 
$url_id = (isset($_GET['id'])) ? sf($_GET['id']) : '';

if($_SESSION['type'] == 'customer'){
    $que ='SELECT * FROM containers LEFT JOIN repacks ON repacks.container = containers.id WHERE containers.customer=\''.sf($_SESSION['uid']).'\' AND  containers.next_repack IS NOT NULL AND repacks.status!=\'pending\' AND repacks.status!=\'In-Progress\' ORDER BY containers.next_repack DESC LIMIT 1';
   //echo $que.'<br/>';
    $slct = mysqli_query($link, $que);
    $res = mysqli_fetch_assoc($slct);
    if($res['next_repack'] != null || $res['next_repack'] != '' || !empty($res['next_repack'])){
        $next_repack = new DateTime($res['next_repack']);
        $today = new DateTime();
        $today->setTime(0, 0, 0, 0);
        $days_until_repack = $today->diff($next_repack)->format('%a');
        
        // Cap the value of $days_until_repack at 5 days or 0 days if it's negative
        if ($next_repack < $today) {
            $days_until_repack = -$days_until_repack;
        }else{ 
            if ($days_until_repack <= 5) {
                $days_until_repack = $days_until_repack;
            }
        }

        if($days_until_repack > 0 && $days_until_repack <= 5){
             $msg = '<br/><div class="alert alert-warning align-items-center next_repack_alert" role="alert">' . $days_until_repack . ' days to go before next repack</div><br/>';
        }else if($days_until_repack == 0){
            $msg = '<br/><div class="alert alert-danger align-items-center next_repack_alert" role="alert">Next repack is due today</div><br/>';
        }else{
            $msg = '';
        }

    //echo 'DB next_repack '.$res['next_repack'];
    //echo '<br/>today '.$today->format('Y-m-d H:i:s');
    //echo '<br/>next repack '.$next_repack->format('Y-m-d H:i:s');
    //echo '<br/>'.$days_until_repack;
    }

}
?>
<style>
    .dataTables_filter { display : none; }
    .form-control:disabled, .form-control[readonly]{
        background-color: #adb2b7;
        opacity: 1;
    }
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
    
    .table {
    	background-color: bebebe;
    }
    
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
                                <form class="form-horizontal" id="form_additional_work" action="" method="post">
                                    <input type="hidden" class="form-control" id="aw_repack_id" name="aw_repack_id">
                                    <input type="hidden" class="form-control" id="aw_wo_id" name="aw_wo_id">
                                    <br><br>
                                        <div id="additional_work_content"></div>
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
                    	</div>
                </div>
            </div>
        </div>

<!-- ################# SCHEDULED AND DELIVERED TABLE ####################### -->
<div class="container">
	<h3 style="margin-top:20px;margin-bottom:20px">Scheduled Repacks</h3>

    <?php 
    if($_SESSION['type'] == 'customer'){
         echo $msg;
    }
    ?>

<!--	<button id="show_delivered" type="button" class="btn btn-primary" style="float:right;margin-bottom:25px">Show Delivered Repacks</button>-->
<div class="row">
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
    </div>
        <!--
        <div class="delivered_list" style="max-width: 100vw;margin-left:-15px;margin-right:-15px;">
            <table id="delivered_list" class="table table-striped scheduled-repacks-delivered" cellspacing="0" style="width:100%">
              <thead>
                <tr>
                  <th class="th-sm" scope="col">WO#</th>  
                  <th class="th-sm" scope="col">Customer</th>
                  <th class="th-sm" scope="col">Type</th>
                  <th class="th-sm" scope="col">Speed</th>
                  <th class="th-sm" scope="col">Container</th>
                  <th class="th-sm" scope="col">Dropoff</th>
                  <th class="th-sm" scope="col">Pickup</th>
                  <th class="th-sm" scope="col">Next Repack</th>
                  <th class="th-sm" scope="col">Status</th>
                  <th class="th-sm" scope="col"></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>-->
</div>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$( document ).ready(function() {
    
    $("input,textarea").attr("readonly","readonly");
    $("select").attr("disabled","disabled");

    $('.delivered_list_wrapper, .delivered_list').hide();
    
    $('#show_delivered').on('click', function (e) {
        e.preventDefault();
        $('.scheduled_list_wrapper, .scheduled_list').toggle();
        $('.delivered_list_wrapper, .delivered_list').toggle();
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
            
            "url": "<?php  echo root();?>do/delivered_work_order_list_review/?id=<?php  echo $url_id;?>",
            "type": "POST"
        },
        "deferRender": true,
        "columns": [
            
            { "data": "wo_id" },
            { "data": "name" },
            { "data": "repack_type" },
            { "data": "speed" },
            { "data": "container_name" },
            { "data": "wo_dropoff_date", "render": function ( data, type, row, meta ){
                return '<div style="text-align: center">'+data+'</div>';
              }
            },
            { "data": "wo_estimated_pickup", "render": function ( data, type, row, meta ){
                return '<div style="text-align: center">'+data+'</div>';
              }
            },
            { "data": "next_repack", "render": function ( data, type, row, meta ){
                return '<div style="text-align: center">' + data + '</div>';
              }
            },
            { "data": "wo_status", "render": function ( data, type, row, meta ){
                return '<div style="text-align: center">'+data+'</div>';
              }
            },
            { "data": "action", "render": function ( data, type, row, meta ){
                    var btn_class='btn-primary';
                    var btn_txt = 'View';
            
                return '<div style="text-align: center"><button type="button" data-toggle="modal" data-target="#repack_modal" data-backdrop="static" data-keyboard="false" class="btn btn-' + row.repack_id + ' ' + btn_class + ' repack-btn">' + btn_txt + '</button></div>';
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
            "url": "<?php  echo root();?>do/work_order_list_review/?id=<?php  echo $url_id;?>",
            "type": "POST"
        },
        "deferRender": true,
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
                  return '<div style="text-align: center">' + data + '</div>';
              }
            },
            { "data": "wo_status", "render": function ( data, type, row, meta ){
                
                    var btn_class='btn-primary';
                    var btn_txt = 'View';
                
                
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

        if(row.wo_status == "Checked-In"){
            $("#work_order").hide();
            $("#tab_work_order").hide();
            $("#tab_work_order").removeClass();
            $("#repack").show();
            $("#tab_repack").show();
            $("#tab_repack").addClass('show');
                clearTimeout(timer);
                timer = setTimeout(function() {
                  repack_info(row.repack_id); //data from repack
                }, 500);
            
        }else{
            $("#work_order").show();
            $("#tab_work_order").show();
            $("#tab_work_order").addClass('show');
            $("#repack").hide();
            $("#tab_repack").hide();
            $("#tab_repack").removeClass();
            
            clearTimeout(timer);
                timer = setTimeout(function() {
                  repack(row.repack_id); //data from work_order
                }, 500);
            
            
        }
    });
    
}); 
    var timer;
    
    // Remove the active class from all tabs and panes when the modal is hidden
    $("#repack_modal").on('hidden.bs.modal', function (event) {
      var tabs = $(event.target).find('.tabs');
      var panes = $(event.target).find('.modal-body > fieldset');
      tabs.removeClass('active');
      panes.removeClass('show');
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
        
    }
    
    /* ################# WORK ORDER */
    
    function repack(id) {
        
    	$('#repack_modal').modal({backdrop: 'static', keyboard: false});
    	
    	$.ajax({
            url: '<?php  echo root();?>do/repack_content/?id='+id+'&load=1',
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $('#additional, #customer, #container').attr('data-repack-id',res.repack_id);
                $('#additional, #customer, #container').attr('data-wo-id',res.work_order_id);
                $('#additional, #customer, #container').attr('data-cust-id',res.wo_customer);
                $('#additional, #customer, #container').attr('data-cont-id',res.con_id);
                $('.wo-id').html('Work Order #'+res.work_order_id);
                $('.rp-id').html('Repack Info #'+res.repack_id);
                $('.btn-check').attr('data-check',res.repack_id);
                $('.btn-check').attr('data-text','Checked-In');
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
    
    
    /* ################# REPACK */
    
    function repack_info(id) {
        
    	$('#repack_modal').modal({backdrop: 'static', keyboard: false});
    	
    	$.ajax({
            url: '<?php  echo root();?>do/repack_info_content/?id='+id+'&load=1',
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $('#additional, #customer, #container').attr('data-repack-id',res.repack_id);
                $('#additional, #customer, #container').attr('data-wo-id',res.work_order_id);
                $('#additional, #customer, #container').attr('data-cust-id',res.repack_customer);
                $('#additional, #customer, #container').attr('data-cont-id',res.con_id);
                $('.wo-id').html('Work Order #'+res.work_order_id);
                $('.rp-id').html('Repack Info #'+res.repack_id);
                $('.btn-check').attr('data-check',res.repack_id);
                $('.btn-check').attr('data-text','Checked-In');
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
    
    /* ################# ADDITIONAL WORK */
    
    $(document).on('click', '#additional', function() {
        var repack_id = $(this).attr('data-repack-id');
    	$.ajax({
            url: '<?php  echo root();?>do/additional_work_content/?id='+repack_id+'&page=review',
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $('input[name="aw_wo_id"]').val(res.wo_id);
                $('input[name="aw_repack_id"]').val(res.repack_id);
                $("#additional_work_content").html(res.content);
            },
             error: function(jqXHR, textStatus, errorThrown) {
                setTimeout(function() {$('#repack_modal').modal('hide');}, 200);
                alert("error");
            }
        });
    });
    
   
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
    
</script>