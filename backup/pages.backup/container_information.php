<?php
    if(isset($_SESSION['repack_container_id']) && $_SESSION['repack_container_id'] > 0) {
        $_SESSION['repack_container_id'] = $_SESSION['repack_container_id'];   
    }else if(isset($_GET['id']) && $_GET['id'] > 0) {
        $_SESSION['repack_container_id'] = $_GET['id'];
    }else{
        $_SESSION['repack_container_id'] = 0;
    }
  
  $s = (isset($_GET['s']) && $_GET['s'] > 0) ? $_GET['s'] : $_SESSION['service'];
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="bs-stepper">
                <div class="bs-stepper-header" role="tablist">
                    <div class="step" data-target="#logins-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger"> <span class="bs-stepper-circle">1</span> <span class="bs-stepper-label">Login / Register</span> </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#harness-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="harness-part" id="harness-part-trigger"> <span class="bs-stepper-circle">2</span> <span class="bs-stepper-label">Harness / Container</span> </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#reserve-parachute-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="reserve-parachute-part" id="reserve-parachute-part-trigger"> <span class="bs-stepper-circle">3</span> <span class="bs-stepper-label">Reserve Parachute</span> </button>
                    </div>
					<div class="line"></div>
                    <div class="step" data-target="#aad-info-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="aad-info-part" id="aad-info-part-trigger"> <span class="bs-stepper-circle">4</span> <span class="bs-stepper-label">AAD</span> </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#main-parachute-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="main-parachute-part" id="main-parachute-part-trigger"> <span class="bs-stepper-circle">5</span> <span class="bs-stepper-label">Main Parachute</span> </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                        <?php  include 'container_info/register.php'; ?>
                    </div>
                    <div id="harness-part" class="content" role="tabpanel" aria-labelledby="harness-part-trigger">2</div>
                    <div id="reserve-parachute-part" class="content" role="tabpanel" aria-labelledby="reserve-parachute-part-trigger">3</div>
					<div id="aad-info-part" class="content" role="tabpanel" aria-labelledby="reserve-parachute-part-trigger">4</div>
                    <div id="main-parachute-part" class="content" role="tabpanel" aria-labelledby="main-parachute-part-trigger">5</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

function step_harness(container) {
	 
	var stepper = new Stepper(document.querySelector('.bs-stepper'))
	stepper.to(2);
	
	$('#harness-part').load('<?php  echo root();?>inc/exec.php?act=container_info&page=harness&container='+container+'&s=<?php echo $s;?>');
}

function step_reserve_parachute(container) {
	
	var stepper = new Stepper(document.querySelector('.bs-stepper'))
	stepper.to(3);
	
	$('#reserve-parachute-part').load('<?php  echo root();?>inc/exec.php?act=container_info&page=reserve_parachute&container='+container+'&s=<?php echo $s;?>');
	
}

function step_aad_info(container) {
	
	var stepper = new Stepper(document.querySelector('.bs-stepper'))
	stepper.to(4);
	
	$('#aad-info-part').load('<?php  echo root();?>inc/exec.php?act=container_info&page=aad_info&container='+container+'&s=<?php echo $s;?>');
	
}


$(document).ready(function () {
  var stepper = new Stepper($('.bs-stepper')[0]);
  <?php  
  if(isset($_GET['id']) || $_SESSION['uid']>0) {
	//if($_SESSION['repack_container_id']) {
		echo 'step_harness('.$_SESSION['repack_container_id'].');';
	//}
  }
  ?>
})



</script>