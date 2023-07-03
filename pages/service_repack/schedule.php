<?php
$url = $_GET['repack_type'];  
?>
<div class="row">
	<h4>Schedule your reserve repack</h4>
</div>

<div class="alert alert-warning d-none align-items-center" role="alert" id="schedulealert"></div>

<form id="schedule_form" action="" method="post" onsubmit="schedule_dropoff();  return false;">
    <input type="hidden" name="url" value="<?php echo $url;?>">
<div class="row">
	
		<div class="col-md-6">	
		<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<div ><u><strong>Container</strong></u></div>
						<br />
						<?php

						$cq = mysqli_query($link, 'SELECT * FROM containers WHERE customer=\''.sf($_SESSION['uid']).'\' AND id=\''.sf($_SESSION['repack_container_id']).'\'');

						if(mysqli_num_rows($cq)>0) {
							
							$c = mysqli_fetch_assoc($cq);
						
							echo ''.$c['manufacturer'].' '.$c['model'].''.($c['serial']!=='' ? ' SN: '.$c['serial'] : '').' &nbsp;&nbsp; <button type="button" class="btn-sm btn-warning" onclick="step_containerinfo(\''.$c['id'].'\')">Change</button>';
						}
						
						?>
						
						
					</div>
				</div>
				
				<br />
			</div>
		
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<div ><u><strong>Speeds</strong></u></div>
						<br />
						
						<div><strong>Standard</strong> - Typical turn around is 9 days from the date of drop off.</div>
						<div><strong>Rush 1</strong> - Front of the line, typically same day depending on dropoff time and rigger availability.</div>
						<div><strong>Rush 2</strong> - Immediate repack</div>
						
					</div>
				</div>
				<br />
				<?php
    				$cq = mysqli_query($link, 'SELECT * FROM repacks WHERE customer=\''.sf($_SESSION['uid']).'\' AND container=\''.sf($_SESSION['repack_container_id']).'\'');
    
    						if(mysqli_num_rows($cq)>0) {
    							
    							$r = mysqli_fetch_assoc($cq);
    						}
				?>
				<?php echo $url;?>
				<label for="priority" class="control-label"><strong>Select your Repack Speed:</strong></label>
				<select class="form-control" id="speed" name="speed">
				    <?php if($url == 'tandem'){ ?>
				        <option value="standard" <?php if($r['speed'] == 'standard' ) { echo 'selected'; } ?>>Standard Lead Time - $<?php echo $repack_pricing['standard']+100;?>.00</option>
					    <option value="rush1" <?php if($r['speed'] == 'rush1' ) { echo 'selected'; } ?>>Rush 1 (Front of line) - $<?php echo $repack_pricing['rush1']+100;?>.00</option>
					    <option value="rush2" <?php if($r['speed'] == 'rush2' ) { echo 'selected'; } ?>>Rush 2 (Immediate) - $<?php echo $repack_pricing['rush2']+100;?>.00</option>    
				    <?php }else if($url == 'sport'){ ?>
    					<option value="standard" <?php if($r['speed'] == 'standard' ) { echo 'selected'; } ?>>Standard Lead Time - $<?php echo $repack_pricing['standard']?></option>
    					<option value="rush1" <?php if($r['speed'] == 'rush1' ) { echo 'selected'; } ?>>Rush 1 (Front of line) - $<?php echo $repack_pricing['rush1']?></option>
    					<option value="rush2" <?php if($r['speed'] == 'rush2' ) { echo 'selected'; } ?>>Rush 2 (Immediate) - $<?php echo $repack_pricing['rush2']?></option>
					<?php } ?>
				</select>
				
				<br />
				
				<div class="row">
					<div class="col-md-12">
						<div ><u><strong>Current Turn Around Times</strong></u></div>
						<div><strong>Standard</strong>: <?php echo date('m-d-Y', strtotime(get_next_pickup_date('standard')));?></div>
						<div><strong>Rush 1 (Front of line)</strong>: <?php echo date('m-d-Y', strtotime(get_next_pickup_date('rush1')));?></div>
						<div><strong>Rush 2 (Immediate)</strong>: <?php echo date('m-d-Y', strtotime(get_next_pickup_date('rush2')));?></div>
						
					</div>
				</div>
				
				
			</div>
			
			
		</div>
		<div class="col-md-2"></div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="dropoff" class="control-label"><strong>Pick your drop Off Date:</strong></label>
				<script>
				$( function() {
					$( "#datepicker" ).datepicker({ minDate: 0, maxDate: "+12M", dateFormat: "yy-mm-dd", setDate: '<?php echo date('Y-m-d')?>', altField: "#dropoff_date",
						onSelect: function(dateText) {
								update_pickup(this.value);
						}				
					});
				} );
				</script>
				<div id="datepicker"></div>
				<input type="hidden" id="dropoff_date" name="dropoff_date">
				
			</div>
			
			<div class="form-group">
				<label for="pickup_date" class="control-label"><strong>Estimated Pickup Date:</strong></label>
				
				<input type="text" class="form-control" id="pickup_date" name="pickup_date" value="<?php echo date('m-d-Y', strtotime(get_next_pickup_date('standard')));?>"/>
				<input type="hidden" id="container_id" name="container_id" value="<?php echo $c['id'];?>">
			</div>
			
			<button  class="btn btn-primary" >Continue to Payment</button>
		
		</div>
	
</div>
</form>

<script>
function update_pickup(date) {
	$.post( "<?php  echo root();?>inc/exec.php?act=get_estimated_pickup&repack_type=<?php echo $url;?>&ajax=1&schedule=1", $('#schedule_form').serialize(), '', 'script');
}

function schedule_dropoff() {

	$.post( "<?php  echo root();?>inc/exec.php?act=schedule_dropoff&repack_type=<?php echo $url;?>&ajax=1&schedule=1", $('#schedule_form').serialize(), '', 'script');
}

$('#dropoff_date').on('input',function(e){
 update_pickup();
});

$('#speed').on('change',function(e){
 update_pickup();
});

$( "#pickup_date" ).datepicker({ minDate: 0, maxDate: "+12M", dateFormat: "mm-dd-yy", setDate: '<?php echo date('Y-m-d')?>', altField: "#pickup_date"});

</script>