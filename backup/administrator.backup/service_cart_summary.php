<style>
        .disabled {
        opacity: 0.6;
        pointer-events: none;
    }
</style>
<div class="container">
    <h3 style="margin-top:20px;margin-bottom:20px">Service Cart ID #<?php echo $_GET['id'];?></h3>
    <div class="row" style="margin-top:60px">
        <div class="service_list w-100 mt-3">

            <table class="table table-bordered m-0">
                <thead>
                      <tr>
                        <!-- Set columns width -->
                        <th class="text-center py-3 px-4" style="min-width: 50%;">Service Item</th>
                        <th colspan="2" class="text-center py-3 px-4" style="width: 35%;">Shoprate / MFG</th>
                        <th class="text-center py-3 px-4" style="width: 10%;">Price</th>
                      </tr>
                </thead>
                <tbody>         
                        <?php 
                            $que = 'SELECT * FROM shopping_cart WHERE cart_order_id =\''.sf($_GET['id']).'\' AND cart_status=\'1\'';
                            //echo $que;
                            $q = mysqli_query($link, $que);
                            $total_price = 0;
                            while($res = mysqli_fetch_assoc($q)) {
                                $shoprate = ($res['cart_shoprate_mfg'] > 0 ) ? $res['cart_shoprate_mfg'] : 1;
                        echo '
                        <tr id="tr_'.$res['cart_service_id'].'">
                            <td>'.$res['cart_service_name'].'</td>
                            <td style="border-right:hidden;width:260px;">
                                <input type="text" class="shoprate_mfg" id="shoprate_mfg_'.$res['cart_service_id'].'" name="shoprate_mfg_'.$res['cart_service_id'].'" data-id="'.$res['cart_service_id'].'" onkeyup="calculate(shoprate_mfg_'.$res['cart_service_id'].','.$res['cart_service_id'].')" placeholder="insert hour(s)" value="'.$shoprate.'">&nbsp;/hr
                            </td>
                            <td  style="width: 100px;">
                                X $'.number_format($res['cart_service_price'],2,".",",").'
                                <input type="hidden" id="price_'.$res['cart_service_id'].'" name="price_'.$res['cart_service_id'].'" value="'.$res['cart_service_price'].'">
                            </td>
                            <td><span id="cart_service_price" style="float:right">$'.number_format($res['cart_service_price'],2,".",",").'</span></td>
                        </tr>';
                        $total_price +=$res['cart_service_price'];
                            }

                            $total_service = $total_price;
                            $check = mysqli_query($link,'SELECT * FROM service_cart WHERE sc_cart_order_id=\''.sf($_GET['id']).'\'');

                            $mainchute = mysqli_fetch_assoc($check);
                            $total_service +=$mainchute['sc_cart_mainchute'];
                        ?>
                        <tr>
                            <td>
                                Will you be dropping off your rig with main chute attached? 
                               <br/>
                                <span style="font-size:13px">*There will be a $12 re-pack fee automatically added as we will need to un-pack & re-pack your main chute.</span>
                            </td>
                            <td colspan="3">
                                <select class="form-control disabled" id="cart_mainchute" name="cart_mainchute" style="float:right;">
                                    <option value="0" <?php if($mainchute['sc_cart_mainchute'] == 0){ echo 'selected'; }?>>No</option>
                                    <option value="12" <?php if($mainchute['sc_cart_mainchute'] == 12){ echo 'selected'; }?>>Yes (+$12)</option>
                                </select>
                            </td>
                        </tr>
                        <?php
                         echo '
                        <tr>
                            <td><h5>Total </h5></td>
                            <td colspan="3"><h5><span id="total_price" style="float:right">$'.number_format($total_service,2,".",",").'</span></h5></td>
                        </tr>';
                        ?>
                	  	
                </tbody>
            </table>
            <br/>
            <a href="<?php echo root();?>service-order"><button  class="btn btn-primary" style="float: left;">Back to Service Order List</button> </a>
    	</div>
    </div>
</div>

<script>

$(document).ready(function() {
  // Find the input element with the class "shoprate_mfg" and trigger keyup event
  $('.shoprate_mfg').trigger('keyup');
});


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

function calculate (el, id){
    var total = 0;
    var price_hr = parseFloat($('#shoprate_mfg_'+id).val());
    var service_price = parseFloat($('#price_'+id).val());
    var total_price = parseFloat($('#total_price').text().replace('$', ''));
    var mainchute = parseFloat($('#cart_mainchute').val());

    if(price_hr < 1){
        $('#shoprate_mfg_'+id).val(1);
    }

    if(price_hr > 0){
        total = price_hr * service_price;
    }
    total_price = mainchute + total;

    $.post( "<?php echo root();?>inc/exec.php?act=shoprate_mfg", { 'cart_order_id' : '<?php echo $_GET['id'];?>', 'cart_service_id' : id ,'cart_shoprate_mfg' : price_hr}, '', 'script');

    $('#cart_service_price').html('$'+number_format(total, 2, '.', ','));
    $('#total_price').html('$'+number_format(total_price, 2, '.', ','));
}
</script>