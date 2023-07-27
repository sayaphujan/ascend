<?php
 $uid = (isset($_SESSION['uid']) && $_SESSION['uid'] > 0) ? $_SESSION['uid'] : $_GET['uid'];
 $url = $_GET['act'];  
 $s = (isset($_GET['s']) && $_GET['s'] > 0) ? $_GET['s'] : $_SESSION['service'];
 
    /*if(isset($_SESSION['repack_container_id']) && $_SESSION['repack_container_id'] > 0) {
        $_SESSION['repack_container_id'] = $_SESSION['repack_container_id'];   
    }else if(isset($_GET['id']) && $_GET['id'] > 0) {
        $_SESSION['repack_container_id'] = $_GET['id'];
    }else{
        $_SESSION['repack_container_id'] = 0;
    }*/
  
$_SESSION['repack_container_id'] = $_GET['container'];
  

?>
<div class="row">
	<h4>Main Parachute</h4>
</div>

<div class="alert alert-warning d-none align-items-center" role="alert" id="schedulealert"></div>

<form id="main_parachute_form" >
    <input type="hidden" name="url" value="<?php  echo $url;?>">
    <input type="hidden" class="form-control" id="uid" name="uid" value="<?php  echo $uid;?>" placeholder="id"/>
    <input type="hidden" class="form-control" id="existing_container" name="existing_container" value="<?php  echo $_SESSION['repack_container_id'];?>" placeholder="id"/>
    <input type="hidden" class="form-control" id="s" name="s" value="<?php echo $s;?>" placeholder="service option"/>
    <div class="row" id="add_new_harness_form">
    	
    		<div class="col-md-12">	
    			<div class="form-group">
    				<label for="make" class="control-label"><strong>Make:</strong></label>
    				<input type="text" class="form-control" id="mpmake" name="make" placeholder="Manufacturer" />
    			</div>
    			<div class="form-group">
    				<label for="model" class="control-label"><strong>Model:</strong></label>
    				<input type="text" class="form-control" id="mpmodel" name="model" placeholder="Model" />
    			</div>
                <div class="form-group">
                    <label for="size" class="control-label"><strong>Size:</strong></label>
                    <input type="text" class="form-control" id="mpsize" name="size" placeholder="Size" />
                </div>
    			<div class="form-group">
    				<label for="serial" class="control-label"><strong>Serial Number:</strong></label>
    				<input type="text" class="form-control" id="mpserial" name="serial" placeholder="Serial Number (located on info card)" />
    			</div>
    			<div class="form-group">
    				<label for="mfr" class="control-label"><strong>Date of Mfr:</strong></label>
    				<input type="text" class="form-control" id="mpmfr" name="mfr" placeholder="Date of Mfr" />
    			</div>
    			 <div class="form-group">
                    <label for="fabric" class="control-label"><strong>Fabric:</strong></label>
                    <input type="text" class="form-control" id="mpfabric" name="fabric" placeholder="Fabric Type" />
                </div>
                <div class="form-group">
                    <label for="line" class="control-label"><strong>Line:</strong></label>
                    <input type="text" class="form-control" id="mpline" name="line" placeholder="Line Type" />
                </div>
    		<button  class="btn btn-primary" id="prev_step" style="float: left;" onclick="step_aad(<?php echo $_SESSION['repack_container_id'];?>);  return false;">Back to AAD</button>  
    		<button  class="btn btn-primary" id="next_step" style="float: right;" onclick="add_main_parachute();  return false;">Confirmation</button>	   	
            </div>
    </div>
</form>

<script>
function add_main_parachute() {

	$.post( "<?php  echo root();?>inc/exec.php?act=add_main_parachute&ajax=1&schedule=1&s=<?php echo $_GET['s'];?>&uid=<?php echo $uid;?>", $('#main_parachute_form').serialize(), '', 'script');
}

function get_data(){
    var id = $('#existing_container').val();
    $.ajax({
        url: "<?php  echo root();?>do/get_container_data/?id="+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log(res);
         $('#mpmake').val(res.mpmake);
         $('#mpmodel').val(res.mpmodel);
         $('#mpsize').val(res.mpsize);
         $('#mpserial').val(res.mpserial);
         $('#mpmfr').val(res.mpmfr);
         $('#mpfabric').val(res.mpfabric);
         $('#mpline').val(res.mpline);
        }
    });
}

function step_aad(container){
    var stepper = new Stepper(document.querySelector('.bs-stepper'))
    stepper.to(4);
    
    $('#aad-info-part').load('<?php  echo root();?>inc/exec.php?act=container_info&page=aad_info&container='+container+'&s=<?php echo $_GET['s'];?>&uid=<?php echo $uid;?>');
}

$( document ).ready(function() {
    var id = $('#existing_container').val();
    if(id>0){
        get_data();
    }
    
    $( "#mpmfr" ).datepicker({ dateFormat: "mm-dd-yy", setDate: '<?php  echo date('Y-m-d')?>', altField: "#mfr"});
});
</script>