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
                        $que = 'SELECT * FROM shopping_cart WHERE cart_order_id =\''.sf($_SESSION['order_id']).'\'';
                        //echo $que;
                        $q = mysqli_query($link, $que);
                        $total_price = 0;
                        while($res = mysqli_fetch_assoc($q)) {
                    echo '
                    <tr id="tr_'.$res['cart_service_id'].'">
                        <td class="p-4"><button id="item_'.$res['cart_id'].'" onclick="javascript:remove_cart('.$res['cart_service_id'].','.$res['cart_service_price'].')" type="button" class="btn btn-danger btn-remove" data-id="'.$res['cart_id'].'" data-price="'.$res['cart_service_price'].'" data-service="'.$res['cart_service_name'].'">Remove</button></td>
                        <td class="p-4">'.$res['cart_service_name'].'</td>
                        <td class="p-4">$'.number_format($res['cart_service_price'],2,".",",").'</td>
                    </tr>';
                    $total_price +=$res['cart_service_price'];
                        }
                     echo '
                    <tr>
                        <td colspan=2><h5>Total </h5></td>
                        <td><h5><span id="total_price">$'.number_format($total_price,2,".",",").'</span></h5></td>
                    </tr>';
                    ?>
            	  	
            </tbody>
        </table>
        <br/>
        <button  class="btn btn-primary" id="next_step" style="float: right;" onclick="step_schedule('<?php echo $_SESSION['repack_container_id'];?>');  return false;">Continue Scheduling</button>        

    	</div>
    </div>
</div>

<script>

$( document ).ready(function() 
{
    var total_price_sub = 0;
    var total_price = 0;
    var base_price = 0;
    var price = base_price;
    
    $(document).on('click', '.btn-add', function()
    {
        var price = $(this).data('price');
        console.log("price "+price);
        calculate_total_price(price);
    });
});

function step_schedule(container) {

    $.ajax({
      url: '<?php echo root();?>do/service_checkout/',
      type: 'POST',
      data: { 'cart_order_id' : '<?php echo $_SESSION['order_id'];?>', 'cart_customer_id' : '<?php echo $_SESSION['uid'];?>' ,'existing_container' : '<?php echo $_SESSION['repack_container_id'];?>', 's':'<?php echo $s;?>', 'repack_type' : '<?php echo $r;?>' },
      success: function(response) {
        // Handle the success response here
        console.log(response);
        
      },
      error: function(xhr, status, error) {
        // Handle any errors that occur during the request
      }
    });
    
   /* var stepper = new Stepper(document.querySelector('.bs-stepper'))
    stepper.to(3);
    
    $('#schedule-part').load('<?php  echo root();?>inc/exec.php?act=service_repack&repack_type=sport&page=schedule&container='+container+'&s=<?php echo $s;?>');
    */
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

function calculate_total_price(price){
    var total_price_sub = parseFloat($('#total_price').text().replace('$', ''));
    total_price_sub -= parseFloat(price);
    var total_price = total_price_sub.toFixed(2);
    $('#total_price').html(number_format(total_price, 2, '.', ','));
}

function remove_cart(id, price)
{
    $.ajax({
      url: '<?php echo root();?>do/del_item_cart/',
      type: 'POST',
      data: { 'cart_order_id' : '<?php echo $_SESSION['order_id'];?>', 'cart_service_id' : id, 'cart_customer_id' : '<?php echo $_SESSION['uid'];?>' },
      success: function(response) {
        // Handle the success response here
        console.log(response);
        calculate_total_price(price);
        $("#tr_"+id).hide();
      },
      error: function(xhr, status, error) {
        // Handle any errors that occur during the request
      }
    });
}
</script>