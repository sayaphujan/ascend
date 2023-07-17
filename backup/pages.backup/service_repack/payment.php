<?php
$url = $_GET['repack_type'];  
?>
<div class="row">
	<h4>Finalize Repack Scheduling</h4>
</div>

<div class="alert alert-warning d-none align-items-center" role="alert" id="finalalert"></div>

<form id="schedule_form" action="" method="post" onsubmit="finalize_repack();  return false;">
<div class="row">
	
		<div class="col-md-6">	
		<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<div ><u><strong>Container</strong></u></div>
						
						<?php

						$cq = mysqli_query($link, 'SELECT * FROM containers WHERE customer=\''.sf($_SESSION['uid']).'\' AND id=\''.sf($_SESSION['repack_container_id']).'\'');

						if(mysqli_num_rows($cq)>0) {
							
							//$c = mysqli_fetch_assoc($cq);
						
							//echo ''.$c['manufacturer'].' '.$c['model'].''.($c['serial']!=='' ? ' SN: '.$c['serial'] : '').' &nbsp;&nbsp; <button type="button" class="btn-sm btn-warning" onclick="step_containerinfo()">Change</button>';
							while($c = mysqli_fetch_assoc($cq)) {
                                $_SESSION['repack_container_id'] = $c['id'];
                                $s = $c['service_id'];
                                $h = unserialize($c['harness']);
                                echo ''.$h['make'].' '.$h['model'].''.($h['serial']!=='' ? ' SN: '.$h['serial'] : '').' &nbsp;&nbsp; <button type="button" class="btn-sm btn-warning" onclick="step_containerinfo(\''.$c['id'].'\')">Change</button>';
                                
                            }
						}
						
						?>
						
						
					</div>
				</div>
				
				
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<div ><u><strong>Service </strong></u></div>
						 <?php 
                            $que = 'SELECT * FROM shopping_cart WHERE cart_order_id =\''.sf($_SESSION['order_id']).'\' AND cart_status=\'0\'';
                            //echo $que;
                            $q = mysqli_query($link, $que);
                            $total_price = 0;
                            while($res = mysqli_fetch_assoc($q)) {
                                $total_price +=$res['cart_service_price'];
                            }

                            $que = 'SELECT * FROM service_cart WHERE sc_cart_order_id =\''.sf($_SESSION['order_id']).'\'';
                            $q = mysqli_query($link, $que);
                            while($res = mysqli_fetch_assoc($q)) {
                                $total_price +=$res['sc_cart_mainchute'];
                            }
                            
                            echo '$'.number_format($total_price,2,".",",");
                        ?>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<div ><u><strong>Repack Speed</strong></u></div>
						<?php
                        if($url == 'tandem'){
                            echo $repack_label[$_GET['speed']].' - $'.($repack_pricing[$_GET['speed']]+100.00).'.00 &nbsp;&nbsp; <button type="button" class="btn-sm btn-warning" onclick="goto_step_schedule()">Change</button>';
                        }else if($url == 'sport'){
						    echo $repack_label[$_GET['speed']].' - $'.$repack_pricing[$_GET['speed']].' &nbsp;&nbsp; <button type="button" class="btn-sm btn-warning" onclick="goto_step_schedule()">Change</button>';
                        }
						?>
						
					</div>
				</div>
			</div>
		
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<div ><u><strong>Dropoff Date</strong></u></div>
						<?php
						//&container='.$_SESSION['repack_container_id'].'&speed='.$speed.'&dropoff_date='.$dropoff_date.'&estimated_pickup='.$pickup.'\'
                    
						echo date('m-d-Y', strtotime($_GET['dropoff_date'])).' &nbsp;&nbsp; <button type="button" class="btn-sm btn-warning" onclick="goto_step_schedule()">Change</button>';
						
						?>
						
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<div ><u><strong>Estimated Pickup</strong></u></div>
						<?php
						//&container='.$_SESSION['repack_container_id'].'&speed='.$speed.'&dropoff_date='.$dropoff_date.'&estimated_pickup='.$pickup.'\'

						echo date('m-d-Y', strtotime($_GET['estimated_pickup'])).' ';
						
						?>
						
					</div>
				</div>
			</div>
			
			
		</div>
		<div class="col-md-2"></div>
		<div class="col-md-4">
			<div ><u><strong>Payment Type</strong></u></div>
			
			<div class="form-check">
			  <input class="form-check-input" type="radio" name="payment_type" id="flexRadioDefault1"  checked/>
			  <label class="form-check-label" for="flexRadioDefault1"> Pay at dropoff </label>
			</div>

			<!-- Default checked radio -->
			<div class="form-check">
			  <input class="form-check-input" type="radio" name="payment_type" id="flexRadioDefault2" disabled />
			  <label class="form-check-label" for="flexRadioDefault2"> Pay now via Credit Card </label>
			</div>
			<br />
			<br />
			
			<button  class="btn btn-primary" id="place_order_button">Place Order</button>
		
		</div>
	
</div>
</form>

<script>
function update_pickup(date) {
	$.post( "<?php echo root();?>inc/exec.php?act=get_estimated_pickup&repack_type=<?php echo $url;?>&ajax=1&schedule=1", $('#schedule_form').serialize(), '', 'script');
}

function finalize_repack() {

	$('#place_order_button').prop('disabled', true);

	$.post( "<?php echo root();?>inc/exec.php?act=submit_service_order&ajax=1&schedule=1&repack_type=<?php echo $url;?>", 'container=<?php echo $_SESSION['repack_container_id']?>&speed=<?php echo $_GET['speed']?>&dropoff_date=<?php echo $_GET['dropoff_date']?>&estimated_pickup=<?php echo $_GET['estimated_pickup']?>', '', 'script');
	
}

$('#dropoff_date').on('input',function(e){
 update_pickup();
});

$('#speed').on('change',function(e){
 update_pickup();
});

</script>