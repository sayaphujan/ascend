<?php
    $uid = $_SESSION['uid'];
    $url = $_GET['act'];  
?>
<div class="container-fluid">

    <div class="row">
    	<h4>AAD</h4>
    </div>
    		<div class="alert alert-warning d-none align-items-center" role="alert" id="containeralert"></div>
    <form id="aad_info_form">
    <input type="hidden" name="url" value="<?php echo $url;?>">
    <input type="hidden" class="form-control" id="uid" name="uid" value="<?php echo $uid;?>" placeholder="id"/>
    <input type="hidden" class="form-control" id="existing_container" name="existing_container" value="<?php echo $_SESSION['repack_container_id'];?>" placeholder="id"/>
    <div class="row" id="add_new_aad_info_form">
    	
    		<div class="col-md-12">	
    			<div class="form-group">
    				<label for="make" class="control-label"><strong>Make:</strong></label>
    				<input type="text" class="form-control" id="amake" name="make" placeholder="Manufacturer" />
    			</div>
    			<div class="form-group">
    				<label for="model" class="control-label"><strong>Model:</strong></label>
    				<input type="text" class="form-control" id="amodel" name="model" placeholder="Model" />
    			</div>
                <div class="form-group">
                    <label for="size" class="control-label"><strong>Size:</strong></label>
                    <input type="text" class="form-control" id="asize" name="size" placeholder="Size" />
                </div>
    			<div class="form-group">
    				<label for="serial" class="control-label"><strong>Serial Number:</strong></label>
    				<input type="text" class="form-control" id="aserial" name="serial" placeholder="Serial Number (located on info card)" />
    			</div>
    			<div class="form-group">
    				<label for="mfr" class="control-label"><strong>Date of Mfr:</strong></label>
    				<input type="text" class="form-control" id="amfr" name="mfr" placeholder="Date of Mfr" />
    			</div>
    		<button  class="btn btn-primary" id="prev_step" style="float: left;" onclick="step_reserve_parachute(<?php echo $_SESSION['repack_container_id'];?>);  return false;">Back to Reserve Parachute</button>        
            <button  class="btn btn-primary" id="next_step" style="float: right;" onclick="add_aad();  return false;">Continue to Main Parachute</button>	
            </div>   
    </div>
    </form>
</div>
<script>
function add_aad() {
	$.post( "<?php echo root();?>inc/exec.php?act=add_aad&ajax=1&schedule=1", $('#aad_info_form').serialize(), '', 'script');
}

function get_data(){
    var id = $('#existing_container').val();
    $.ajax({
        url: "<?php echo root();?>do/get_container_data/?id="+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log(res);
         $('#amake').val(res.amake);
         $('#amodel').val(res.amodel);
         $('#asize').val(res.asize);
         $('#aserial').val(res.aserial);
         $('#amfr').val(res.amfr);
        }
    });
}

function step_reserve_parachute(container){
    var stepper = new Stepper(document.querySelector('.bs-stepper'))
    stepper.to(3);
    
    $('#reserve-parachute-part').load('<?php  echo root();?>inc/exec.php?act=container_info&page=reserve_parachute&container='+container);
}

$( document ).ready(function() {
    var id = $('#existing_container').val();
    if(id>0){
        get_data();
    }
    
    $( "#amfr" ).datepicker({ dateFormat: "mm-dd-yy", setDate: '<?php echo date('Y-m-d')?>', altField: "#mfr"});
});
</script>