
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
            if(isset($_SESSION['uid']) && $_SESSION['uid'] > 0) { 
                $menu = root().'service/';  
            }else{
                $menu = root().'container_information/';
            }
                echo '<a href="'.$menu.'" class="btn btn-large btn-standard d-block text-center mb-2">Assemblies, Repacks, Inspections</a>';
                echo '<a href="'.$menu.'" class="btn btn-large btn-standard d-block text-center mb-2">Common Maintenance Items</a>';
                echo '<a href="'.$menu.'" class="btn btn-large btn-standard d-block text-center mb-2">Tandem Maintenance</a>';
                echo '<a href="'.$menu.'" class="btn btn-large btn-standard d-block text-center mb-2">Canopy Sewing</a>';
                echo '<a href="'.$menu.'" class="btn btn-large btn-standard d-block text-center mb-2">Harness Work</a>';
            
            ?>
		</div>
    </div>
</div>
