<?
    $_SESSION['repack_container_id'] = (isset($_SESSION['repack_container_id'])) ? $_SESSION['repack_container_id'] : 0;
    
    $uid = $_SESSION['uid'];
    $url = $_GET['repack_type'];  
?>
<div class="container-fluid">

    <div class="row">
    	<h4>Your container information</h4>
    </div>
    		<div class="alert alert-warning d-none align-items-center" role="alert" id="containeralert"></div>
    <form id="harness_form" action="" method="post" onsubmit="add_container();  return false;">
    <input type="hidden" name="url" value="<?php echo $url;?>">
    <input type="hidden" class="form-control" id="uid" name="uid" value="<?php echo $uid;?>" placeholder="id"/>
    <input type="hidden" class="form-control" id="existing_container" name="existing_container" value="<?php echo $_SESSION['repack_container_id'];?>" placeholder="id"/>
    <div class="row" id="add_new_harness_form">
    	
    		<div class="col-md-6">	
    			<div class="form-group">
    				<label for="manufacturer" class="control-label"><strong>Manufacturer:</strong></label>
    				<input type="text" class="form-control" id="manufacturer" name="manufacturer" placeholder="Manufacturer" />
    			</div>
    			<div class="form-group">
    				<label for="model" class="control-label"><strong>Model:</strong></label>
    				<input type="text" class="form-control" id="model" name="model" placeholder="Model" />
    			</div>
    			<div class="form-group">
    				<label for="serial" class="control-label"><strong>Serial Number:</strong></label>
    				<input type="text" class="form-control" id="serial" name="serial" placeholder="Serial Number (located on info card)" />
    			</div>
    			<div class="form-group">
    				<label for="aad" class="control-label"><strong>AAD:</strong></label>
    				<select class="form-control" id="aad" name="aad"  >
    					
    					<option value="Cypress">Cypress2</option>
    					
    					<option value="Vigil">Vigil</option>
    					
    					<option value="MARS">MarS m2</option>
    					
    					<option value="Argus">Argus</option>
    					
    					<option value="None">None</option>
    				</select>
    			</div>
    			<div class="form-group">
    				<label for="serial" class="control-label"><strong>AAD Serial # :</strong></label>
    				<input type="text" class="form-control" id="aad_serial" name="aad_serial" placeholder="AAD Serial #" />
    			</div>
    			<div class="form-group">
    				<label for="serial" class="control-label"><strong>AAD Install Date :</strong></label>
    				<input type="text" class="form-control" id="aad_install" name="aad_install" placeholder="AAD Install Date" />
    			</div>
    			<div class="form-group">
    				<label for="serial" class="control-label"><strong>AAD Next Maintenance :</strong></label>
    				<input type="text" class="form-control" id="aad_next_maintenance" name="aad_next_maintenance" placeholder="AAD Next Maintenance Date" />
    			</div>
    			<div class="form-group">
    				<label for="serial" class="control-label"><strong>AAD End of Service :</strong></label>
    				<input type="text" class="form-control" id="aad_eol" name="aad_eol" placeholder="AAD End of Service Date" />
    			</div>
    		</div>
    		<div class="col-md-6">
    			<div class="form-group">
    				<label for="reserve" class="control-label"><strong>Reserve Canopy:</strong></label>
    				<input type="text" class="form-control" id="reserve" name="reserve" placeholder="Reserve Canopy (PDR, SMART, etc)" />
    			</div>
    			
    			<div class="form-group">
    					<label for="reserve_size" class="control-label"><strong>Reserve Size:</strong></label>
    					<input type="text" class="form-control" id="reserve_size" name="reserve_size" placeholder="Reserve Size (sq ft)" style="width:200px" />
    			</div>
    			
    			<div class="form-group">
    				<label for="main" class="control-label"><strong>Main Canopy:</strong></label>
    				<input type="text" class="form-control" id="main" name="main" placeholder="Main Canopy" />
    			</div>
    			
    			<div class="form-group">
    					<label for="main_size" class="control-label"><strong>Reserve Size:</strong></label>
    					<input type="text" class="form-control" id="main_size" name="main_size" placeholder="Main Size (sq ft)" style="width:200px" />
    			</div>
    			<div class="form-group">
    					<label for="main_size" class="control-label"><strong>Reserve Serial:</strong></label>
    					<input type="text" class="form-control" id="reserve_serial" name="reserve_serial" placeholder="Reserve Serial" style="width:200px" />
    			</div>
    			<button  class="btn btn-primary" >Continue to Scheduling</button>
    		</div>
    	
    </div>
    </form>
</div>
<script>
function add_container() {
	$.post( "/inc/exec.php?act=add_container&repack_type=<?php echo $url;?>&ajax=1&schedule=1", $('#harness_form').serialize(), '', 'script');
}

function get_data(){
    $('#add_new_harness_form').show();
    var id = $('#existing_container').val();
    $.ajax({
        url: "<?php echo root();?>do/get_container_data/?id="+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log(res);
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
}

$('#existing_container').change(function () {
    var id = $('#existing_container').val();
    if(id>0){
        get_data();
    }
});

$( document ).ready(function() {
    var id = $('#existing_container').val();
    if(id>0){
        get_data();
    }
    
    $( "#aad_install" ).datepicker({ dateFormat: "mm-dd-yy", setDate: '<?php echo date('Y-m-d')?>', altField: "#aad_install"});
    
    $( "#aad_eol" ).datepicker({ dateFormat: "mm-dd-yy", setDate: '<?php echo date('Y-m-d')?>', altField: "#aad_eol"});
    
    $( "#aad_next_maintenance" ).datepicker({ dateFormat: "mm-dd-yy", setDate: '<?php echo date('Y-m-d')?>', altField: "#aad_next_maintenance"});
});
</script>