<div class="container-fluid">
    <div class="h-100 row align-items-center mt-5">
        <div class="col-sm-6 mx-auto">
            <form action="<?=root('do/register/'); ?>" method="post">
                <div class="form-group">
                    <label for="first_name" class="control-label"><strong>First Name:</strong></label>
                    <input type="text" class="form-control" id="rfname" name="rfname" autocomplete="off" placeholder="Please enter your first name..."/>
                </div>
                <div class="form-group">
                    <label for="last_name" class="control-label"><strong>Last Name:</strong></label>
                    <input type="text" class="form-control" id="rlname" name="rlname" autocomplete="off" placeholder="Please enter your last name..."/>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label"><strong>Email:</strong></label>
                    <input type="email" class="form-control" id="remail" name="remail" placeholder="Please enter your email..."/>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label"><strong>Password:</strong></label>
                    <input type="password" class="form-control" id="rpassword" name="rpassword" autocomplete="off" placeholder="Please enter your password..."/>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Register</button>
            </form>
        </div>
    </div>
</div>
<?
unset($_SESSION['forgot']);
?>