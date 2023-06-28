<?php
 $uid = $_SESSION['uid'];
 $url = $_GET['act'];  
?>
<div class="row">
	<h4>Reserve Parachute</h4>
</div>

<div class="alert alert-warning d-none align-items-center" role="alert" id="containeralert"></div>

<form id="reserve_parachute_form">
    <input type="hidden" name="url" value="<?php echo $url;?>">
    <input type="hidden" class="form-control" id="uid" name="uid" value="<?php echo $uid;?>" placeholder="id"/>
    <input type="hidden" class="form-control" id="existing_container" name="existing_container" value="<?php echo $_SESSION['repack_container_id'];?>" placeholder="id"/>
    <div class="row" id="add_new_harness_form">
    	
    		<div class="col-md-12">	
    			<div class="form-group">
    				<label for="make" class="control-label"><strong>Make:</strong></label>
    				<input type="text" class="form-control" id="rpmake" name="make" placeholder="Manufacturer" />
    			</div>
    			<div class="form-group">
    				<label for="model" class="control-label"><strong>Model:</strong></label>
    				<input type="text" class="form-control" id="rpmodel" name="model" placeholder="Model" />
    			</div>
                <div class="form-group">
                    <label for="size" class="control-label"><strong>Size:</strong></label>
                    <input type="text" class="form-control" id="rpsize" name="size" placeholder="Size" />
                </div>
    			<div class="form-group">
    				<label for="serial" class="control-label"><strong>Serial Number:</strong></label>
    				<input type="text" class="form-control" id="rpserial" name="serial" placeholder="Serial Number (located on info card)" />
    			</div>
    			<div class="form-group">
    				<label for="mfr" class="control-label"><strong>Date of Mfr:</strong></label>
    				<input type="text" class="form-control" id="rpmfr" name="mfr" placeholder="Date of Mfr" />
    			</div>
    			 <div class="form-group">
                    <label for="fabric" class="control-label"><strong>Fabric:</strong></label>
                    <input type="text" class="form-control" id="rpfabric" name="fabric" placeholder="Fabric" />
                </div>
    		
    		<button  class="btn btn-primary" id="prev_step" style="float: left;" onclick="step_harness(<?php echo $_SESSION['repack_container_id'];?>);  return false;">Back to Harness</button>        
            <button  class="btn btn-primary" id="next_step" style="float: right;" onclick="add_reserve_parachute();  return false;">Continue to AAD</button>	   	
            </div>
    </div>
</form>

<script>
function add_reserve_parachute() {

	$.post( "<?php echo root();?>inc/exec.php?act=add_reserve_parachute&ajax=1&schedule=1", $('#reserve_parachute_form').serialize(), '', 'script');
}

function get_data(){
    var id = $('#existing_container').val();
    $.ajax({
        url: "<?php echo root();?>do/get_container_data/?id="+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log(res);
         $('#rpmake').val(res.rpmake);
         $('#rpmodel').val(res.rpmodel);
         $('#rpsize').val(res.rpsize);
         $('#rpserial').val(res.rpserial);
         $('#rpmfr').val(res.rpmfr);
         $('#rpfabric').val(res.rpfabric);
        }
    });
}

function step_harness(container){
    var stepper = new Stepper(document.querySelector('.bs-stepper'))
    stepper.to(2);
    
    $('#harness-part').load('<?php  echo root();?>inc/exec.php?act=container_info&page=harness&container='+container);
}

$( document ).ready(function() {
    var id = $('#existing_container').val();
    if(id>0){
        get_data();
    }
    
    $( "#rpmfr" ).datepicker({ dateFormat: "mm-dd-yy", setDate: '<?php echo date('Y-m-d')?>', altField: "#mfr"});
});
</script>