<?php
  // Append the requested resource location to the URL   
    $url = explode('/', $_SERVER['REQUEST_URI']);    
      
    //echo $url[3];  
?>
<div class="row">
	<div class="col-md-5">	
		<h4>Register</h4>
		
		<div class="alert alert-warning d-none align-items-center" role="alert" id="registeralert"></div>
		
		<form id="register_form" onsubmit="register();  return false;">
		    <input type="hidden" name="url" value="<?php echo $url[2];?>">
		    <div class="form-group">
                    <label for="first_name" class="control-label"><strong>First Name:</strong></label>
                    <input type="text" class="form-control" id="rfname" name="rfname" autocomplete="off" placeholder="Please enter your first name..."/>
                </div>
                <div class="form-group">
                    <label for="last_name" class="control-label"><strong>Last Name:</strong></label>
                    <input type="text" class="form-control" id="rlname" name="rlname" autocomplete="off" placeholder="Please enter your last name..."/>
                </div>
                <div class="form-group">
    				<label for="rphone" class="control-label"><strong>Phone Number:</strong></label>
    				<input type="number" class="form-control" id="rphone" name="rphone" placeholder="Your mobile phone number"/>
    			</div>
                <div class="form-group">
                    <label for="email" class="control-label"><strong>Email:</strong></label>
                    <input type="email" class="form-control" id="remail" name="remail" placeholder="Please enter your email..."/>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label"><strong>Password:</strong></label>
                    <input type="password" class="form-control" id="rpassword" name="rpassword" autocomplete="off" placeholder="Please enter your password..."/>
                </div>
			    <button class="btn btn-primary">Register</button>
		</form>
	</div>
	<div class="col-md-2 text-center">Or</div>
	<div class="col-md-5">	
		<h4>Login</h4>
		
		<div class="alert alert-warning d-none align-items-center" role="alert" id="loginalert"></div>
		
		<form id="login_form" action="" method="post"  onsubmit="login();  return false;">
		    <input type="hidden" name="url" value="<?php echo $url[2];?>">
			<div class="form-group">
				<label for="email" class="control-label"><strong>Email:</strong></label>
				<input type="email" class="form-control" id="cemail" name="cemail" placeholder="Please enter your email..."/>
			</div>
			<? if (!isset($_SESSION['forgot'])) { ?>
			<div class="form-group">
				<label for="password" class="control-label"><strong>Password:</strong></label>
				<input type="password" class="form-control" id="cpassword" name="cpassword" autocomplete="off" placeholder="Please enter your password..."/>
			</div>
			<button class="btn btn-primary">Login</button>
			<? } ?>
			<!--<button type="submit" class="btn btn-primary" name="forgot">Forgot My Password</button>-->
		</form>
		
		
		
	</div>
</div>

<script>
function login() {
	$.post( "<?php echo root();?>inc/exec.php?act=login&ajax=1&schedule=1&s=<?php echo $_GET['s'];?>", $('#login_form').serialize(), '', 'script');
}

function register() {
	$.post( "<?php echo root();?>inc/exec.php?act=register&ajax=1&schedule=1&s=<?php echo $_GET['s'];?>", $('#register_form').serialize(), '', 'script');
}
</script>