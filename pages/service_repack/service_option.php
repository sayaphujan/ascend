<div class="container">
    <div class="row">
        <h4>Choose Schedule Service Type :</h4>
    </div>
    <div class="row pt-4">
        <div class="col-md-5">
            <button onclick="sport();" class="btn btn-standard">Schedule Sport Repack</button>
            <button onclick="tandem();" class="btn btn-standard">Schedule Tandem Repack</button>
            <button onclick="pilot();" class="btn btn-standard">Schedule Pilot Repack</button>
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