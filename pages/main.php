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
                echo '<a href="'.$menu.'?s=1" class="btn btn-large btn-standard d-block text-center mb-2">Assemblies, Repacks, Inspections</a>';
                echo '<a href="'.$menu.'?s=2" class="btn btn-large btn-standard d-block text-center mb-2">Common Maintenance Items</a>';
                echo '<a href="'.$menu.'?s=3" class="btn btn-large btn-standard d-block text-center mb-2">Tandem Maintenance</a>';
                echo '<a href="'.$menu.'?s=4" class="btn btn-large btn-standard d-block text-center mb-2">Canopy Sewing</a>';
                echo '<a href="'.$menu.'?s=5" class="btn btn-large btn-standard d-block text-center mb-2">Harness Work</a>';
            
            ?>
		</div>
	<?php 
	if (!isset($_SESSION['uid'])) {
	?>
        <div class="col-sm-7">
            <h4>Login</h4>
            <form id="login_form" onsubmit="login(); return false;">
                <div class="form-group">
                    <label for="email" class="control-label"><strong>Email:</strong></label>
                    <input type="email" class="form-control" id="cemail" name="cemail" placeholder="Please enter your email..."/>
                </div>
                <?php  if (!isset($_SESSION['forgot'])) { ?>
                    <div class="form-group">
                        <label for="password" class="control-label"><strong>Password:</strong></label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword" autocomplete="off" placeholder="Please enter your password..."/>
                    </div>
                    <button type="submit" class="btn btn-standard" name="submit">Submit</button>
                    <?php  } ?>
                <button type="button" class="btn btn-standard" name="forgot">Forgot My Password</button>
            </form>
        </div>
    <?php  } ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"></script>
<script>
function login() {
     $.post('<?php  echo root();?>inc/exec.php?act=login', $('#login_form').serialize(), function(result){
                if(result == "error"){
                    $.notify("Sorry this email or password is not valid, please re-check & try again","error")
                }else{
                    document.location = result;
                }
            })
}
</script>