<?php 
$id = (isset($_GET['id'])) ? $_GET['id'] : '';
$title = (isset($_GET['id'])) ? "Edit Data" : 'Add Data';
$readonly = (isset($_GET['id'])) ? "readonly='readonly'" : '';
?>
<div class="container">
<div class="row">
    <div class="col-md-12">
      <div class="container-fluid">
        <div class="row mt-5">
            <h4><?php  echo $title;?> service options</h4>
        </div>
        <form id="service_option_form" onsubmit="register(); return false;">
		    <input type="hidden" class="form-control" id="id" name="id" value="<?php  echo $id;?>"/>
		        <div class="form-group">
                    <label for="first_name" class="control-label"><strong>APS QB-CODE:</strong></label>
                    <input type="text" class="form-control" id="qb_code" name="qb_code" autocomplete="off" placeholder="Please enter your APS QB-CODE..." required="required"/>
                </div>
                <div class="form-group">
                    <label for="last_name" class="control-label"><strong>GROUP QB-CODE:</strong></label>
                    <select class="form-control dd" id="group_qb_code" name="group_qb_code">
                        <option value="1">ASSEMBLIES, REPACKS, INSPECTIONS</option>
                        <option value="2">COMMON MAINTENANCE ITEMS</option>
                        <option value="3">TANDEM MAINTENANCE</option>
                        <option value="4">CANOPY SEWING WORK</option>
                        <option value="5">HARNESS WORK (MASTER RIGGER ONLY)</option>
                        <option value="6">COMMON REPLACEMENT PARTS (DO NOT POST PUBLIC)</option>
                        <option value="7">SEPARATE NOTATION</option>
                        <option value="8">(PILOT) ASSEMBLIES, REPACKS, INSPECTIONS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="last_name" class="control-label"><strong>Service Item:</strong></label>
                    <input type="text" class="form-control" id="service_item" name="service_item" autocomplete="off" placeholder="Please enter your service item..." required="required"/>
                </div>
                <div class="form-group">
                    <label for="last_name" class="control-label"><strong>Shoprate / MFG:</strong></label>
                    <select class="form-control dd" id="shoprate_mfg" name="shoprate_mfg">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                <div class="form-group">
    				<label for="rphone" class="control-label"><strong>Sales Price:</strong></label>
    				<input type="text" class="form-control" id="sales_price" name="sales_price" placeholder="Sales Price"/>
    			</div>
                <div class="form-group">
                    <label for="rphone" class="control-label"><strong>Master Rigger:</strong></label>
                    <input type="text" class="form-control" id="master_rigger" name="master_rigger" placeholder="Master Rigger"/>
                </div>
                <div class="form-group">
                    <label for="rphone" class="control-label"><strong>Senior Rigger:</strong></label>
                    <input type="text" class="form-control" id="senior_rigger" name="senior_rigger" placeholder="Senior Rigger"/>
                </div>
                <div class="form-group">
                    <label for="rphone" class="control-label"><strong>Trainee:</strong></label>
                    <input type="text" class="form-control" id="trainee" name="trainee" placeholder="Trainee"/>
                </div>
			    <button class="btn btn-primary" type="submit">Save</button>
		</form>
      </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"></script>
<script>
function register() {
     $.post('<?php  echo root();?>inc/exec.php?act=update_service_option', $('#service_option_form').serialize(), function(result){
                if(result == "success"){
                    $.notify('Service Option succesfully added!', 'success')
                    setTimeout(function () {
                        document.location = '<?php echo root();?>service-options/';
                    }, 3000);
                }else if(result == "update"){
                    $.notify('Data succesfully updated!', 'success')
                    setTimeout(function () {
                        document.location = '<?php echo root();?>service-options/';
                    }, 3000);
                }else if(result == "inactive"){
                    $.notify('Data Exist Inactive!', 'error')
                }
            })
}

function get_data(){
    
    var id = "<?php  echo $id;?>";
    
    $.ajax({
        url: "<?php  echo root();?>do/get_service_option/?id="+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log(res);
         $('#qb_code').val(res.qb_code);
         $('#group_qb_code').val(res.group_qb_code);
         $('#shoprate_mfg').val(res.shoprate_mfg);
         $('#service_item').val(res.service_item);
         $('#sales_price').val(res.sales_pricec);
         $('#master_rigger').val(res.master_rigger);
         $('#senior_rigger').val(res.senior_rigger);
         $('#trainee').val(res.trainee);
        }
    });
}

$( document ).ready(function() {
    var id = "<?php  echo $id;?>";
    if(id > 0){
        get_data();
    }
});
</script>