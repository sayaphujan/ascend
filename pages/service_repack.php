<?php 
$s = (isset($_GET['s']) && $_GET['s'] > 0) ? $_GET['s'] : $_SESSION['service'];
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="bs-stepper">
                <div class="bs-stepper-header" role="tablist">
                    <div class="step" data-target="#information-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger"> <span class="bs-stepper-circle">1</span> <span class="bs-stepper-label">Container Information</span> </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#service-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="service-part" id="service-part-trigger"> <span class="bs-stepper-circle">2</span> <span class="bs-stepper-label">Service Options</span> </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#schedule-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="schedule-part" id="schedule-part-trigger"> <span class="bs-stepper-circle">3</span> <span class="bs-stepper-label">Schedule</span> </button>
                    </div>
					<div class="line"></div>
                    <div class="step" data-target="#finalize-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="finalize-part" id="finalize-part-trigger"> <span class="bs-stepper-circle">4</span> <span class="bs-stepper-label">Finalize</span> </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                        <?php  include 'service_repack/container_summary.php'; ?>
                    </div>
                    <div id="service-part" class="content" role="tabpanel" aria-labelledby="service-part-trigger">2</div>
                    <div id="schedule-part" class="content" role="tabpanel" aria-labelledby="schedule-part-trigger">3</div>
					<div id="finalize-part" class="content" role="tabpanel" aria-labelledby="finalize-part-trigger">4</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

function step_containerinfo(container) {
	 
	var stepper = new Stepper(document.querySelector('.bs-stepper'))
	stepper.to(1);
	
	$('#information-part').load('<?php  echo root();?>inc/exec.php?act=service_repack&repack_type=sport&page=container_info&container='+container+'&s=<?php echo $s;?>');
}

function step_service(container) {
	
	var stepper = new Stepper(document.querySelector('.bs-stepper'))
	stepper.to(2);
	
	$('#service-part').load('<?php  echo root();?>inc/exec.php?act=service_repack&repack_type=sport&page=service&container='+container+'&s=<?php echo $s;?>');
	
}

function step_schedule(container) {
    
    var stepper = new Stepper(document.querySelector('.bs-stepper'))
    stepper.to(3);
    
    $('#schedule-part').load('<?php  echo root();?>inc/exec.php?act=service_repack&repack_type=sport&page=schedule&container='+container+'&s=<?php echo $s;?>');
    
}

function goto_step_schedule() {
    
    var stepper = new Stepper(document.querySelector('.bs-stepper'))
    stepper.to(3);
    
    //$('#schedule-part').load('/inc/exec.php?act=schedule_repack&repack_type=sport&page=schedule&container='+container);
    
}

function step_payment(container) {
    
    var stepper = new Stepper(document.querySelector('.bs-stepper'))
    stepper.to(4);
    
    $('#finalize-part').load('<?php  echo root();?>inc/exec.php?act=service_repack&repack_type=sport&page=payment&container='+container+'&s=<?php echo $s;?>');
    
}

$(document).ready(function () {
  var stepper = new Stepper($('.bs-stepper')[0]);
  <?php  
  if($_SESSION['uid']>0) {
	//if($_SESSION['repack_container_id']) {
    if($_GET['page'] == 'service_list'){
        echo 'step_service('.$_SESSION['repack_container_id'].');';   
    }
	//}
  } ?>
})



</script>