<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="bs-stepper">
                <div class="bs-stepper-header" role="tablist">
                    <div class="step" data-target="#logins-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger"> <span class="bs-stepper-circle">1</span> <span class="bs-stepper-label">Login / Register</span> </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#information-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger"> <span class="bs-stepper-circle">2</span> <span class="bs-stepper-label">Container Information</span> </button>
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
                    <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                        <? include 'schedule_repack/register.php'; ?>
                    </div>
                    <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">2</div>
                    <div id="schedule-part" class="content" role="tabpanel" aria-labelledby="schedule-part-trigger">3</div>
					<div id="finalize-part" class="content" role="tabpanel" aria-labelledby="schedule-part-trigger">3</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

function step_containerinfo() {
	 
	var stepper = new Stepper(document.querySelector('.bs-stepper'))
	stepper.to(2);
	
	$('#information-part').load('/inc/exec.php?act=schedule_repack&repack_type=tandem&page=container_info');
}

function step_schedule(container) {
	
	var stepper = new Stepper(document.querySelector('.bs-stepper'))
	stepper.to(3);
	
	$('#schedule-part').load('/inc/exec.php?act=schedule_repack&repack_type=tandem&page=schedule&container='+container);
	
}

function goto_step_schedule() {
	
	var stepper = new Stepper(document.querySelector('.bs-stepper'))
	stepper.to(3);
	
	//$('#schedule-part').load('/inc/exec.php?act=schedule_repack&repack_type=tandem&page=schedule&container='+container);
	
}

$(document).ready(function () {
  var stepper = new Stepper($('.bs-stepper')[0]);
  <? 
  if($_SESSION['uid']>0) {
	if($_SESSION['repack_container_id']) {
		echo 'step_schedule('.$_SESSION['repack_container_id'].');';
	} else {
		echo 'step_containerinfo();';
	}
  ?>
	
<? } ?>
})



</script>