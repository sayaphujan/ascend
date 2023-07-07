<?php 
$id = (isset($_GET['id'])) ? $_GET['id'] : '';
$title = (isset($_GET['id'])) ? "Edit Data" : 'Add Data';
$readonly = (isset($_GET['id'])) ? "readonly='readonly'" : '';
?>
<div class="container">
<div class="row">
    <div class="col-md-12">
      <div class="container-fluid">
        <div class="row mt-5">
            <h4><?php  echo $title;?> Staff</h4>
        </div>
        <form id="register_form" onsubmit="register(); return false;">
		    <input type="hidden" class="form-control" id="acid" name="cid" value="<?php  echo $id;?>"/>
		        <div class="form-group">
                    <label for="first_name" class="control-label"><strong>First Name:</strong></label>
                    <input type="text" class="form-control" id="rfname" name="rfname" autocomplete="off" placeholder="Please enter your first name..." required="required"/>
                </div>
                <div class="form-group">
                    <label for="last_name" class="control-label"><strong>Last Name:</strong></label>
                    <input type="text" class="form-control" id="rlname" name="rlname" autocomplete="off" placeholder="Please enter your last name..." required="required"/>
                </div>
                <div class="form-group">
    				<label for="rphone" class="control-label"><strong>Phone Number:</strong></label>
    				<input type="number" class="form-control" id="rphone" name="rphone" placeholder="Your mobile phone number"/>
    			</div>
                <div class="form-group">
                    <label for="email" class="control-label"><strong>Email:</strong></label>
                    <input type="email" class="form-control" id="remail" name="remail" placeholder="Please enter your email..." required="required" <?php  echo $readonly;?>/>
                </div>
                <div class="form-group password">
                    <label for="password" class="control-label"><strong>Password:</strong></label>
                    <input type="password" class="form-control" id="rpassword" name="rpassword" autocomplete="off" placeholder="Please enter your password..."/>
                </div>
			    <button class="btn btn-primary" type="submit">Save</button>
		</form>
      </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"></script>
<script>
function register() {
     $.post('<?php  echo root();?>inc/exec.php?act=update_staff', $('#register_form').serialize(), function(result){
                if(result == "success"){
                    $.notify('Admin succesfully added!', 'success')
                    setTimeout(function () {
                        document.location = '<?php echo root();?>staff/';
                    }, 3000);
                }else if(result == "update"){
                    $.notify('Data succesfully updated!', 'success')
                    setTimeout(function () {
                        document.location = '<?php echo root();?>staff/';
                    }, 3000);
                }else if(result == "exist"){
                    $.notify('Email already Exist!', 'error')
                }else if(result == "inactive"){
                    $.notify('Account Inactive!', 'error')
                }
            })
}

function get_user_data(){
    
    var id = "<?php  echo $_GET['id'];?>";
    
    $.ajax({
        url: "<?php  echo root();?>do/get_user_data/?id="+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log(res);
         $('#rfname').val(res.first_name);
         $('#rlname').val(res.last_name);
         $('#remail').val(res.email);
         $('#rphone').val(res.phone);
        }
    });
}
var timer;
/*$("#acid, #rfname, #rlname, #remail, #rphone, #rpassword").keyup(function() {
    clearTimeout(timer);
    timer = setTimeout(function() {
      register();
    }, 300);
});
*/

$( document ).ready(function() {
    var id = "<?php  echo $_GET['id'];?>";
    if(id > 0){
        get_user_data();
    }
});
</script>