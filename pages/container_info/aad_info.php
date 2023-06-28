<?php
    $uid = $_SESSION['uid'];
    $url = $_SERVER['REQUEST_URI'];  
?>
<div class="container-fluid">

    <div class="row">
    	<h4>AAD</h4>
    </div>
    		<div class="alert alert-warning d-none align-items-center" role="alert" id="containeralert"></div>
    <form id="aad_info_form" action="" method="post" onsubmit="add_aad();  return false;">
    <input type="hidden" name="url" value="<?php echo $url;?>">
    <input type="hidden" class="form-control" id="uid" name="uid" value="<?php echo $uid;?>" placeholder="id"/>
    <input type="hidden" class="form-control" id="existing_container" name="existing_container" value="<?php echo $_SESSION['repack_container_id'];?>" placeholder="id"/>
    <div class="row" id="add_new_aad_info_form">
    	
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
    		</div>   
            <button  class="btn btn-primary" id="next_step">Continue to Main Parachute</button>	
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
         $('#make').val(res.amake);
         $('#model').val(res.amodel);
         $('#size').val(res.asize);
         $('#serial').val(res.aserial);
         $('#mfr').val(res.amfr);
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