<?php
    $uid = $_SESSION['uid'];
?>
<div class="container-fluid">

    <div class="row">
    	<div class="col-md-12">

        <table class="table table-bordered m-0">
            <thead>
                  <tr>
                    <!-- Set columns width -->
                    <th class="text-right py-3 px-4" style="width: 100px;"></th>
                    <th class="text-center py-3 px-4" style="min-width: 400px;">Service Item</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Price</th>
                  </tr>
            </thead>
            <tbody>         
                    <?php 
                        $que = 'SELECT * FROM shopping_cart WHERE cart_order_id =\''.sf($_SESSION['order_id']).'\' AND cart_status=\'1\'';
                        //echo $que;
                        $q = mysqli_query($link, $que);
                        $total_price = 0;
                        while($res = mysqli_fetch_assoc($q)) {
                    echo '
                    <tr id="tr_'.$res['cart_service_id'].'">
                        <td><button id="item_'.$res['cart_id'].'" onclick="javascript:remove_cart('.$res['cart_service_id'].','.$res['cart_service_price'].')" type="button" class="btn btn-danger btn-remove" data-id="'.$res['cart_id'].'" data-price="'.$res['cart_service_price'].'" data-service="'.$res['cart_service_name'].'">Remove</button></td>
                        <td>'.$res['cart_service_name'].'</td>
                        <td>$'.number_format($res['cart_service_price'],2,".",",").'</td>
                    </tr>';
                    $total_price +=$res['cart_service_price'];
                        }

                        $total_service = $total_price;
                        $check = mysqli_query($link,'SELECT * FROM service_cart WHERE sc_cart_order_id=\''.sf($_SESSION['order_id']).'\'');

                        $mainchute = mysqli_fetch_assoc($check);
                        $total_service +=$mainchute['sc_cart_mainchute'];
                    ?>
                    <tr>
                        <td colspan=2>
                            Will you be dropping off your rig with main chute attached? 
                           <br/>
                            <span style="font-size:13px">*There will be a $12 re-pack fee automatically added as we will need to un-pack & re-pack your main chute.</span>
                        </td>
                        <td>
                            <select id="cart_mainchute" name="cart_mainchute">
                                <option value="0" <?php if($mainchute['sc_cart_mainchute'] == 0){ echo 'selected'; }?>>No</option>
                                <option value="12" <?php if($mainchute['sc_cart_mainchute'] == 12){ echo 'selected'; }?>>Yes (+$12)</option>
                            </select>
                        </td>
                    </tr>
                    <?php
                     echo '
                    <tr>
                        <td colspan=2><h5>Total </h5></td>
                        <td><h5><span id="total_price">$'.number_format($total_service,2,".",",").'</span></h5></td>
                    </tr>';

                    echo '<input type="hidden" id="total" name="total" value="'.$total_price.'">';
                    ?>
            	  	
            </tbody>
        </table>
        <br/>
        <button  class="btn btn-primary" id="prev_step" style="float: left;" onclick="step_service_list('<?php echo $_SESSION['repack_container_id'];?>');  return false;">Back to Service Options List</button>        
        <button  class="btn btn-primary" id="next_step" style="float: right;" onclick="schedule('<?php echo $_SESSION['repack_container_id'];?>');  return false;">Continue Scheduling</button>        

    	</div>
    </div>
</div>

<script>
    var total_price_sub = 0;
    var total_price = 0;
    var total = 0;

$( document ).ready(function() 
{
    $(document).on('change', '#cart_mainchute', function(){
        calculate_mainchute();
    });
});



function step_service_list(container){
    var stepper = new Stepper(document.querySelector('.bs-stepper'))
    stepper.to(2);
    
    $('#service-part').load('<?php  echo root();?>inc/exec.php?act=service_repack&repack_type=<?php echo $_SESSION['repack_type'];?>&page=service_list&container=<?php echo $_SESSION['repack_container_id'];?>&s=<?php echo $_GET['s'];?>&order_id=<?php echo $_SESSION['order_id'];?>');

}

function schedule(container) {
    
    $.post( "<?php echo root();?>inc/exec.php?act=service_checkout&ajax=1&schedule=1&s=<?php echo $_GET['s'];?>", { 'cart_order_id' : '<?php echo $_SESSION['order_id'];?>', 'cart_customer_id' : '<?php echo $_SESSION['uid'];?>' ,'existing_container' : container, 'repack_type' : '<?php echo $_GET['repack_type'];?>' }, '', 'script');
}

function number_format (number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}


function calculate_mainchute(){

    $.post( "<?php echo root();?>inc/exec.php?act=cart_mainchute", { 'cart_order_id' : '<?php echo $_SESSION['order_id'];?>', 'cart_customer_id' : '<?php echo $_SESSION['uid'];?>' ,'cart_mainchute' : $("#cart_mainchute").val()}, '', 'script');

    if($("#cart_mainchute").val() == 12){
         var total = parseFloat($("#total").val()) + 12;
    }

    if($("#cart_mainchute").val() == 0){
        var total = (parseFloat($("#total").val()) + 12)-12;
    }

    var total_price = total.toFixed(2);
    $('#total_price').html('$'+number_format(total_price, 2, '.', ','));
}

function remove_cart(id, price)
{
    var total = parseFloat($("#total").val() - price);
    var mainchute = parseFloat($("#cart_mainchute").val());

        $.ajax({
          url: '<?php echo root();?>do/del_item_cart/',
          type: 'POST',
          data: { 'cart_order_id' : '<?php echo $_SESSION['order_id'];?>', 'cart_service_id' : id, 'cart_customer_id' : '<?php echo $_SESSION['uid'];?>' },
          success: function(response) {
            // Handle the success response here
            console.log(response);
            $("#tr_"+id).hide();
            $("#total").val(total);
            var total_price = (total+mainchute).toFixed(2);
            $('#total_price').html('$'+number_format(total_price, 2, '.', ','));
          },
          error: function(xhr, status, error) {
            // Handle any errors that occur during the request
          }
        });
}
</script>