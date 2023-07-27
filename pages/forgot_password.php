<div class="container-fluid">
    <div class="h-100 row align-items-center mt-5">
        <div class="col-sm-6 mx-auto">
            <h1>Forgot Password</h1>
            <br/>
            <p>To reset your password, please enter your email address.
               We will send the password reset instructions to the email address for this account.
               If you don't know the username or your email address is no longer valid, please Contact Us for further assistance.</p>
            <br/>
            <form action="<?php echo root();?>do/forgot_password/" method="post">
                <div class="form-group">
                    <label for="email" class="control-label"><strong>Email:</strong></label>
                    <input type="email" class="form-control" id="cemail" name="cemail" placeholder="Please enter your email...">
                </div>
                <button type="submit" class="btn btn-primary mr-3" name="submit">Submit</button>
            </form>
        </div>
    </div>
</div>