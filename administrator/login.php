<div class="container-fluid">
    <div class="h-100 row align-items-center mt-5">
        <div class="col-sm-6 mx-auto">
            <!--<form action="<?php  echo root('do/admin_login/'); ?>" method="post">-->
            <form id="login_form" onsubmit="login();  return false;">
                <div class="form-group">
                    <label for="email" class="control-label"><strong>Email:</strong></label>
                    <input type="email" class="form-control" id="cemail" name="cemail" placeholder="Please enter your email..."/>
                </div>
                <?php  if (!isset($_SESSION['forgot'])) { ?>
                <div class="form-group">
                    <label for="password" class="control-label"><strong>Password:</strong></label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword" autocomplete="off" placeholder="Please enter your password..."/>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <!--<button class="btn btn-primary">Login</button>-->
                <?php  } ?>
                <!--<button class="btn btn-primary" name="forgot" onclick="forgot()">Forgot My Password</button>-->
            </form>
        </div>
    </div>
</div>
<?php 
unset($_SESSION['forgot']);
?>
<script>
/*function login() {
	$.post( "/inc/exec.php?act=admin_login&ajax=1&schedule=1", $('#login_form').serialize(), '', 'script');
}*/
function login() {
     $.post('<?php  echo root();?>inc/exec.php?act=admin_login', $('#login_form').serialize(), function(result){
                if(result == "error"){
                    $.notify("Sorry this email or password is not valid, please re-check & try again","error")
                }else{
                    document.location = '<?php echo root();?>staff/';
                }
            })
}
</script>