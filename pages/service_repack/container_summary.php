<?php
    $admin = isset($_SESSION['adminid']) ? $_SESSION['adminid'] : 0;
    $_SESSION['uid'] = (isset($_SESSION['uid'])) ? $_SESSION['uid'] : $_GET['uid'];
    $uid = $_SESSION['uid'];
    $_SESSION['repack_container_id'] = (isset($_SESSION['repack_container_id'])) ? $_SESSION['repack_container_id'] : $_GET['container'];
    $s = (isset($_GET['s']) && $_GET['s'] > 0) ? $_GET['s'] : $_SESSION['service'];
    $selected='';
?>

    <div class="container-fluid">

    <div class="row">
        <h4>Your container information</h4>
        
    </div>
            <div class="alert alert-warning d-none align-items-center" role="alert" id="containeralert"></div>
    <form id="container_form">
            <div class="col-md-12">
                <div class="row">
                    <div class="form-group">
                        <label for="existing_container" class="control-label"><strong>Pick a previously registered container:</strong></label>
                            <select class="form-control" id="container" name="container">
                                <option value="-">-- Select Container --</option>
                                <option value="0">Register New Container</option>
                            <?php
                                    $cq = mysqli_query($link, 'SELECT * FROM containers WHERE customer=\''.sf($uid).'\' AND service_id=\''.sf($_GET['s']).'\'');
                                 
                                 if(mysqli_num_rows($cq)>0) {
                                    
                                    while($c = mysqli_fetch_assoc($cq)) {
                                        $selected = ($_SESSION['repack_container_id'] == $c['id']) ? 'selected' : '';
                                        $h = unserialize($c['harness']);
                                        echo '
                                        <option value="'.$c['id'].'" '.$selected.'>'.$h['make'].' '.$h['model'].''.($h['serial']!=='' ? ' SN: '.$h['serial'] : '').'</option>';
                                                    
                                        
                                        ;
                                    }
                                 }
                            ?>
                            </select>
                    </div>
                </div>
            </div>
            <hr/>
        <input type="hidden" class="form-control" id="uid" name="uid" value="<?php echo $uid;?>" placeholder="id"/>
        <input type="hidden" class="form-control" id="s" name="s" value="<?php echo $s;?>" placeholder="service option"/>
            
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
                            <input type="text" class="form-control" id="make" name="hmake" placeholder="Manufacturer" />
                        </div>
                        <div class="form-group">
                            <label for="model" class="control-label"><strong>Model:</strong></label>
                            <input type="text" class="form-control" id="model" name="hmodel" placeholder="Model" />
                        </div>
                        <div class="form-group">
                            <label for="size" class="control-label"><strong>Size:</strong></label>
                            <input type="text" class="form-control" id="size" name="hsize" placeholder="Size" />
                        </div>
                        <div class="form-group">
                            <label for="serial" class="control-label"><strong>Serial Number:</strong></label>
                            <input type="text" class="form-control" id="serial" name="hserial" placeholder="Serial Number (located on info card)" />
                        </div>
                        <div class="form-group">
                            <label for="mfr" class="control-label"><strong>Date of Mfr:</strong></label>
                            <input type="text" class="form-control" id="mfr" name="hmfr" placeholder="Date of Mfr" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!-- RESERVE -->
                        
                        <div class="form-group">
                            <label for="make" class="control-label"><strong>Make:</strong></label>
                            <input type="text" class="form-control" id="rpmake" name="rmake" placeholder="Manufacturer" />
                        </div>
                        <div class="form-group">
                            <label for="model" class="control-label"><strong>Model:</strong></label>
                            <input type="text" class="form-control" id="rpmodel" name="rmodel" placeholder="Model" />
                        </div>
                        <div class="form-group">
                            <label for="size" class="control-label"><strong>Size:</strong></label>
                            <input type="text" class="form-control" id="rpsize" name="rsize" placeholder="Size" />
                        </div>
                        <div class="form-group">
                            <label for="serial" class="control-label"><strong>Serial Number:</strong></label>
                            <input type="text" class="form-control" id="rpserial" name="rserial" placeholder="Serial Number (located on info card)" />
                        </div>
                        <div class="form-group">
                            <label for="mfr" class="control-label"><strong>Date of Mfr:</strong></label>
                            <input type="text" class="form-control" id="rpmfr" name="rmfr" placeholder="Date of Mfr" />
                        </div>
                         <div class="form-group">
                            <label for="fabric" class="control-label"><strong>Fabric:</strong></label>
                            <input type="text" class="form-control" id="rpfabric" name="rfabric" placeholder="Fabric" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!-- AAD -->
                        
                        <div class="form-group">
                            <label for="make" class="control-label"><strong>Make:</strong></label>
                            <input type="text" class="form-control" id="amake" name="amake" placeholder="Manufacturer" />
                        </div>
                        <div class="form-group">
                            <label for="model" class="control-label"><strong>Model:</strong></label>
                            <input type="text" class="form-control" id="amodel" name="amodel" placeholder="Model" />
                        </div>
                        <!--
                        <div class="form-group">
                            <label for="size" class="control-label"><strong>Size:</strong></label>
                            <input type="text" class="form-control" id="asize" name="asize" placeholder="Size" />
                        </div>-->
                        <div class="form-group">
                            <label for="serial" class="control-label"><strong>Serial Number:</strong></label>
                            <input type="text" class="form-control" id="aserial" name="aserial" placeholder="Serial Number (located on info card)" />
                        </div>
                        <div class="form-group">
                            <label for="mfr" class="control-label"><strong>Date of Mfr:</strong></label>
                            <input type="text" class="form-control" id="amfr" name="amfr" placeholder="Date of Mfr" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!-- MAIN -->
                        
                        <div class="form-group">
                            <label for="make" class="control-label"><strong>Make:</strong></label>
                            <input type="text" class="form-control" id="mpmake" name="mmake" placeholder="Manufacturer" />
                        </div>
                        <div class="form-group">
                            <label for="model" class="control-label"><strong>Model:</strong></label>
                            <input type="text" class="form-control" id="mpmodel" name="mmodel" placeholder="Model" />
                        </div>
                        <div class="form-group">
                            <label for="size" class="control-label"><strong>Size:</strong></label>
                            <input type="text" class="form-control" id="mpsize" name="msize" placeholder="Size" />
                        </div>
                        <div class="form-group">
                            <label for="serial" class="control-label"><strong>Serial Number:</strong></label>
                            <input type="text" class="form-control" id="mpserial" name="mserial" placeholder="Serial Number (located on info card)" />
                        </div>
                        <div class="form-group">
                            <label for="mfr" class="control-label"><strong>Date of Mfr:</strong></label>
                            <input type="text" class="form-control" id="mpmfr" name="mmfr" placeholder="Date of Mfr" />
                        </div>
                         <div class="form-group">
                            <label for="fabric" class="control-label"><strong>Fabric:</strong></label>
                            <input type="text" class="form-control" id="mpfabric" name="mfabric" placeholder="Fabric Type" />
                        </div>
                        <div class="form-group">
                            <label for="line" class="control-label"><strong>Line:</strong></label>
                            <input type="text" class="form-control" id="mpline" name="mline" placeholder="Line Type" />
                        </div>
                    </div>
                </div>
                <hr/>
                <p>Please confirm the information you have written. It is important that this information is accurate.</p>
            <button  class="btn btn-primary" id="prev_step" style="float: left;display:none">Back to Harness</button>        
            <button  class="btn btn-primary" id="next_step" style="float: right;" onclick="add_container();  return false;">Verify My Rig</button>        
    		</div>
    </div>
    </form>
</div>
<script>
function add_container() {
    $.post( "<?php echo root();?>inc/exec.php?act=add_container_summary&repack_type=sport&ajax=1&schedule=1&s=<?php echo $s;?>", $('#container_form').serialize(), '', 'script');
}

function get_data(id){
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
         //$('#asize').val(res.asize);
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
    document.location='<?php echo root();?>container_information/?id='+container+'&container='+container+'&s=<?php echo $s;?>&uid=<?php echo $uid;?>';
}

$('#container').change(function () {
    var id = $('#container').val();
    $("#prev_step").hide();
    
    if(id == 0){
        if(admin > 0){
            document.location='<?php echo root();?>customers/?s=<?php echo $s;?>';          
        }else{
            document.location='<?php echo root();?>container_information/?id='+id+'&s=<?php echo $s;?>';       
        }
    }else{
      get_data(id);
      $("#prev_step").removeAttr('onclick');
      $("#prev_step").attr('onclick','step_harness('+id+');  return false;'); 
      $("#prev_step").show();
      container_id = id;
    }
    
});

var container_id = '<?php echo $_SESSION['repack_container_id'];?>';
var admin = '<?php echo $admin;?>';
$( document ).ready(function() {
    $('#container_form input').attr('readonly', 'readonly');
    
    var id = $('#container').val();
    
    if(id > 0) { $("#container").trigger('change'); }
});
</script>