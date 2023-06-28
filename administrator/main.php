
<div class="container">
    <div class="row pt-4">
        <div class="col-md-5">
            <p class="display-4">Schedule a Repack </p>
			<p class="lead">Need a repack? Use our scheduler to make the process simple, fast &amp; easy!</p>
			<p>Select an Option:</p>
            <!--<a href="/schedule_sport_repack/" class="btn btn-large btn-standard d-block text-center mb-2">Schedule Sport Repack</a>
            
			<a href="/schedule_tandem_repack/" class="btn btn-large btn-standard d-block text-center mb-2">Schedule Tandem Repack</a>
			<a href="" class="btn btn-large btn-standard d-block text-center">Other Maintenance</a>-->
            <?php 
            if(isset($_SESSION['adminid']) && $_SESSION['adminid'] > 0) { 
                echo '<a href="'.root().'Schedule_sport_repack/" class="btn btn-large btn-standard d-block text-center mb-2">Schedule Sport Repack</a>';
            }else{
                echo '<a href="'.root().'container_information/" class="btn btn-large btn-standard d-block text-center mb-2">Schedule Sport Repack</a>';
            } 
            ?>
            
			<a href="<?php echo root();?>/container_information/" class="btn btn-large btn-standard d-block text-center mb-2">Assemblies, Repacks, Inspections</a>
			<a href="<?php echo root();?>/container_information/" class="btn btn-large btn-standard d-block text-center mb-2">Canopy Sewing</a>
			<a href="<?php echo root();?>/container_information/" class="btn btn-large btn-standard d-block text-center mb-2">Harness Work</a>
			<a href="<?php echo root();?>/container_information/" class="btn btn-large btn-standard d-block text-center mb-2">Tandem Maintenance</a>
			<a href="<?php echo root();?>/container_information/" class="btn btn-large btn-standard d-block text-center mb-2">Common Maintenance Items</a>
		</div>
    </div>
</div>
