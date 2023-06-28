<?
    $uid = $_SESSION['adminid'];
?>
<div class="container">
<div class="row">
    <div class="col-md-12">
      <div class="container-fluid">
        <div class="row mt-5">
            <h4>Account Information</h4>
        </div>
        <form id="user_form" onsubmit="user(); return false;">
            <input type="hidden" class="form-control" id="auid" name="cid"/>
              <div class="row">
            	<div class="col-md-12">
                    <div class="form-group">
                        <label for="first_name" class="control-label"><strong>First Name:</strong></label>
                        <input type="text" class="form-control" id="afirst_name" name="rfname" autocomplete="off" placeholder="Please enter your first name..."/>
                    </div>
                    <div class="form-group">
                        <label for="first_name" class="control-label"><strong>Last Name:</strong></label>
                        <input type="text" class="form-control" id="alast_name" name="rlname" autocomplete="off" placeholder="Please enter your last_name..."/>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label"><strong>Email:</strong></label>
                        <input type="text" class="form-control" id="aemail" name="remail" placeholder="Please enter your email..." readonly="readonly"/>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label"><strong>Password:</strong></label>
                        <input type="password" class="form-control" id="apassword" name="rpassword" placeholder="Please enter your password..."/>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label"><strong>Phone:</strong></label>
                        <input type="text" class="form-control" id="aphone" name="rphone" placeholder="Please enter your phone number..."/>
                    </div>
                    <!--
                    <div class="form-group">
                        <label for="last_name" class="control-label"><strong>Company:</strong></label>
                        <input type="text" class="form-control" id="acompany" name="company" autocomplete="off" placeholder="Please enter your company name..."/>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="control-label"><strong>Address:</strong></label>
                        <input type="text" class="form-control" id="aaddress" name="address" autocomplete="off" placeholder="Please enter your Address..."/><br/>
                        <input type="text" class="form-control" id="aaddress2" name="address2" autocomplete="off" placeholder="Please enter your Address..."/>
                    </div>-->
                </div><!--
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <label for="last_name" class="control-label"><strong>City:</strong></label>
                        <input type="text" class="form-control" id="acity" name="city" autocomplete="off" placeholder="Please enter your City..."/>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="control-label"><strong>State:</strong></label>
                        <input type="text" class="form-control" id="astate" name="state" autocomplete="off" placeholder="Please enter your State..."/>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="control-label"><strong>Zip:</strong></label>
                        <input type="text" class="form-control" id="azip" name="zip" autocomplete="off" placeholder="Please enter your Zip Code..."/>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="control-label"><strong>Country:</strong></label>
                        <input type="text" class="form-control" id="acountry" name="country" autocomplete="off" placeholder="Please enter your Country..."/>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="control-label"><strong>Sponsor:</strong></label>
                        <input type="text" class="form-control" id="asponsor" name="sponsor" autocomplete="off" placeholder="Please enter your Sponsor..."/>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="control-label"><strong>Notes:</strong></label>
                        <textarea class="form-control" id="notes" name="anotes" autocomplete="off" placeholder="Please enter your notes..."/></textarea>
                    </div>
                   
                </div> -->
              </div>
                <div class="row">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary center" name="submit" style="float:right">Save</button>
                  </div>
                </div>
        </form>
      </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"></script>
<script>
function user() {
	//$.post( "/inc/exec.php?act=update_customer&ajax=1&schedule=1", $('#customer_form').serialize(), '', 'script');
	$.post('<?=root();?>inc/exec.php?act=update_staff', $('#user_form').serialize(), function(result){
                if(result){
                    $.notify('Success', 'success')
                }else{
                    $.notify('Error', 'error')
                }
            })
}

$("#uid").val("<?=$uid;?>");

function get_user_data(){
    
    var id = "<?=$uid;?>";
    
    $.ajax({
        url: "<?=root();?>do/get_user_data/?id="+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log(res);
         $('#auid').val(res.id);
         $('#afirst_name').val(res.first_name);
         $('#alast_name').val(res.last_name);
         $('#aemail').val(res.email);
         $('#aphone').val(res.phone);
         /*
         $('#acompany').val(res.company);
         $('#aaddress').val(res.address);
         $('#aaddress2').val(res.address_2);
         $('#acity').val(res.city);
         $('#astate').val(res.state);
         $('#azip').val(res.zip);
         $('#acountry').val(res.country);
         $('#asponsor').val(res.sponsor);
         $('#anotes').val(res.notes);
         */
        }
    });
}
/*var timer;
$("#auid, #afirst_name, #alast_name, #aemail, #aphone").keyup(function() {
    clearTimeout(timer);
    timer = setTimeout(function() {
      user();
    }, 300);
});*/

$('#auid').change(function () {
    get_user_data();
});

$( document ).ready(function() {
    get_user_data();
});
</script>