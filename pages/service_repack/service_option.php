<div class="container">
    <div class="row">
        <h4>Choose Schedule Service Type :</h4>
    </div>
    <div class="row pt-4">
        <div class="col-md-5">
            <a href="javascript:void(0)" onclick="sport();" class="btn btn-large btn-standard d-block text-center mb-2">Schedule Sport Repack</a>
            <a href="javascript:void(0)" onclick="tandem();" class="btn btn-large btn-standard d-block text-center mb-2">Schedule Tandem Repack</a>
            <a href="javascript:void(0)" onclick="pilot();" class="btn btn-large btn-standard d-block text-center mb-2">Schedule Pilot Repack</a>
		</div>
    </div>
</div>
<script>
function sport() {
    var stepper = new Stepper(document.querySelector('.bs-stepper'))
    stepper.to(2);
    
    $('#service-part').load('<?php  echo root();?>inc/exec.php?act=service_repack&repack_type=sport&page=service_list&container=<?php echo $_GET['container'];?>&s=<?php echo $s;?>');
}

function tandem() {
    var stepper = new Stepper(document.querySelector('.bs-stepper'))
    stepper.to(2);
    
    $('#service-part').load('<?php  echo root();?>inc/exec.php?act=service_repack&repack_type=tandem&page=service_list&container=<?php echo $_GET['container'];?>&s=<?php echo $s;?>');
}

function pilot() {
    var stepper = new Stepper(document.querySelector('.bs-stepper'))
    stepper.to(2);
    
    $('#service-part').load('<?php  echo root();?>inc/exec.php?act=service_repack&repack_type=pilot&page=service_list&container=<?php echo $_GET['container'];?>&s=<?php echo $s;?>');
}
</script>