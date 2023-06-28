<?php
    $uid = $_SESSION['uid'];
?>
<div class="container-fluid">

    <div class="row">
    	<h4>Your container information</h4>
    </div>
    		<div class="alert alert-warning d-none align-items-center" role="alert" id="containeralert"></div>
    <form id="container_form">
    <input type="hidden" class="form-control" id="uid" name="uid" value="<?php echo $uid;?>" placeholder="id"/>
    <input type="hidden" class="form-control" id="existing_container" name="existing_container" value="<?php echo $_SESSION['repack_container_id'];?>"/>
             
    <?php 
    if($_SESSION['repack_container_id'] == ''){
        $cq = mysqli_query($link, 'SELECT * FROM containers WHERE customer=\''.sf($uid).'\'');
        
        if(mysqli_num_rows($cq)>0) {
        ?>
            <div class="col-md-12">
                <div class="row">
                    <div class="form-group">
                        <label for="existing_container" class="control-label"><strong>Pick a previously registered container:</strong></label>
                        <select class="form-control" id="container" name="container">
                            <?php
                            while($c = mysqli_fetch_assoc($cq)) {
                                $h = unserialize($c['harness']);
                                echo '<option value="'.$c['id'].'">'.$h['make'].' '.$h['model'].''.($h['serial']!=='' ? ' SN: '.$h['serial'] : '').'</option>';
                            }
                            
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <hr/>
    <?php } }?>
            
    		<div class="col-md-12">	
                <div class="row">
                    <div class="col-md-3"><h5>Harness / Container</h5></div>
                    <div class="col-md-3"><h5>Reserve Parachute</h5></div>
                    <div class="col-md-3"><h5>AAD</h5></div>
                    <div class="col-md-3"><h5>Main Parachute</h5></div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-3">
                        <!-- HARNESS -->
                        
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
                    <div class="col-md-3">
                        <!-- RESERVE -->
                        
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
                    </div>
                    <div class="col-md-3">
                        <!-- AAD -->
                        
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
                    </div>
                    <div class="col-md-3">
                        <!-- MAIN -->
                        
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
                    </div>
                </div>
            <button  class="btn btn-primary" id="prev_step" style="float: left;" onclick="step_harness(<?php echo $_SESSION['repack_container_id'];?>);  return false;">Back to Harness</button>        
            <button  class="btn btn-primary" id="next_step" style="float: right;" onclick="add_container();  return false;">Verified</button>        
    		</div>
    </div>
    </form>
</div>
<script>

function get_data(){
    var id = $('#existing_container').val();
    $.ajax({
        url: "<?php echo root();?>do/get_container_data/?id="+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log(res);
         $('#make').val(res.hmake);
         $('#model').val(res.hmodel);
         $('#size').val(res.hsize);
         $('#serial').val(res.hserial);
         $('#mfr').val(res.hmfr);
         $('#rpmake').val(res.rpmake);
         $('#rpmodel').val(res.rpmodel);
         $('#rpsize').val(res.rpsize);
         $('#rpserial').val(res.rpserial);
         $('#rpmfr').val(res.rpmfr);
         $('#rpfabric').val(res.rpfabric);
         $('#amake').val(res.amake);
         $('#amodel').val(res.amodel);
         $('#asize').val(res.asize);
         $('#aserial').val(res.aserial);
         $('#amfr').val(res.amfr);
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

function step_harness(container){
    var id = (container > 0) ? container : $("#existing_container").val();

    document.location='<?php echo root();?>container_information/?id='+id;
}

$('#container').change(function () {
    var id = $('#container').val();
    $("#existing_container").val(id);
    if(id>0){
        get_data();
    }
});

$( document ).ready(function() {
    $('#container').trigger('change');
    $('#container_form input').attr('readonly', 'readonly');
    var id = ($('#existing_container').val() > 0) ? $('#existing_container').val() : $('#container').val();
    $.session.set('repack_container_id',id);
    
    //alert($.session.get('repack_container_id'));
    if(id>0){
        get_data();
    }
});
</script>