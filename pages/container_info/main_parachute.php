<?
 $uid = $_SESSION['uid'];
 $url = $_SERVER['REQUEST_URI'];  
?>
<div class="row">
	<h4>Main Parachute</h4>
</div>

<div class="alert alert-warning d-none align-items-center" role="alert" id="schedulealert"></div>

<form id="main_parachute_form	" action="" method="post" onsubmit="add_main_parachute();  return false;">
    <input type="hidden" name="url" value="<?php echo $url;?>">
    <input type="hidden" class="form-control" id="uid" name="uid" value="<?php echo $uid;?>" placeholder="id"/>
    <input type="hidden" class="form-control" id="existing_container" name="existing_container" value="<?php echo $_SESSION['repack_container_id'];?>" placeholder="id"/>
    <div class="row" id="add_new_harness_form">
    	
    		<div class="col-md-6">	
    			<div class="form-group">
    				<label for="make" class="control-label"><strong>Make:</strong></label>
    				<input type="text" class="form-control" id="make" name="make" placeholder="Manufacturer" />
    			</div>
    			<div class="form-group">
    				<label for="model" class="control-label"><strong>Model:</strong></label>
    				<input type="text" class="form-control" id="model" name="model" placeholder="Model" />
    			</div>
                <div class="form-group">
                    <label for="size" class="control-label"><strong>Size:</strong></label>
                    <input type="text" class="form-control" id="size" name="size" placeholder="Size" />
                </div>
    			<div class="form-group">
    				<label for="serial" class="control-label"><strong>Serial Number:</strong></label>
    				<input type="text" class="form-control" id="serial" name="serial" placeholder="Serial Number (located on info card)" />
    			</div>
    			<div class="form-group">
    				<label for="mfr" class="control-label"><strong>Date of Mfr:</strong></label>
    				<input type="text" class="form-control" id="mfr" name="mfr" placeholder="Date of Mfr" />
    			</div>
    			 <div class="form-group">
                    <label for="fabric" class="control-label"><strong>Fabric:</strong></label>
                    <input type="text" class="form-control" id="fabric" name="fabric" placeholder="Fabric Type" />
                </div>
                <div class="form-group">
                    <label for="line" class="control-label"><strong>Line:</strong></label>
                    <input type="text" class="form-control" id="line" name="line" placeholder="Line Type" />
                </div>
    		</div>
    		<button  class="btn btn-primary" id="next_step">Verified</button>	   	
    </div>
</form>

<script>
function add_main_parachute() {

	$.post( "/inc/exec.php?act=add_main_parachute&ajax=1&schedule=1", $('#main_parachute_form').serialize(), '', 'script');
}

function get_data(){
    var id = $('#existing_container').val();
    $.ajax({
        url: "<?php echo root();?>do/get_container_data/?id="+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log(res);
         $('#make').val(res.mpmake);
         $('#model').val(res.mpmodel);
         $('#size').val(res.mpsize);
         $('#serial').val(res.mpserial);
         $('#mfr').val(res.mpmfr);
         $('#fabric').val(res.mpfabric);
         $('#line').val(res.mpline);
        }
    });
}

$( document ).ready(function() {
    var id = $('#existing_container').val();
    if(id>0){
        get_data();
    }
    
    $( "#mfr" ).datepicker({ dateFormat: "mm-dd-yy", setDate: '<?php echo date('Y-m-d')?>', altField: "#mfr"});
});
</script>