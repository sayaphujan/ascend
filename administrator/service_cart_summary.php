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
                        <th class="text-center py-3 px-4">Service Item</th>
                        <th colspan="2" class="text-center py-3 px-4">Price</th>
                      </tr>
                </thead>
                <tbody>         
                        <?php 
                            $que = 'SELECT * FROM `shopping_cart` WHERE `shopping_cart`.`cart_order_id` =\''.sf($_GET['id']).'\' ';
                            //echo $que;
                            $q = mysqli_query($link, $que);
                            $total_price = 0;
                            $flag_shoprate = 0;
                            $flag_mfr = 0;

                            while($res = mysqli_fetch_assoc($q)) {
                                $price = ($res['cart_shoprate_mfg'] > 0) ? $res['cart_shoprate_mfg_price'] : $res['cart_service_price'];
                                $res['cart_service_price'] = ($res['cart_shoprate_mfg'] > 0) ? ($res['cart_shoprate_mfg_price']*$res['cart_shoprate_mfg']) : $res['cart_service_price'];
                        echo '
                        <tr id="tr_'.$res['cart_service_id'].'">
                            <td>'.$res['cart_service_name'].'</td>
                            <td style="border-right:hidden;width:25%">
                                <div id="div_'.$res['cart_service_id'].'" style="display:none">
                                    <input type="text" id="shoprate_mfg_'.$res['cart_service_id'].'" name="shoprate_mfg_'.$res['cart_service_id'].'" data-id="'.$res['cart_service_id'].'" value="'.$res['cart_shoprate_mfg'].'" placeholder="hour(s)" style="width:20%">&nbsp;/hr
                                

                                    X $ <input type="text" id="price_'.$res['cart_service_id'].'" name="price_'.$res['cart_service_id'].'" value="'.$price.'" placeholder="price"  style="width:25%" data-id="'.$res['cart_service_id'].'"> = 

                                    <input type="hidden" id="val_service_price_'.$res['cart_service_id'].'" name="val_service_price_'.$res['cart_service_id'].'" value="'.$price.'">
                                </div>
                            </td>
                            <td>
                                <span id="cart_service_price_'.$res['cart_service_id'].'" style="float:right;font-size:20px">$'.number_format($res['cart_service_price'],2,".",",").'</span>
                            </td>
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
                            <td colspan="2">
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
                            <td colspan="2">
                                <h4><strong><span id="total_price" style="float:right">$'.number_format($total_service,2,".",",").'</span></strong></h4>
                                <input type="hidden" id="val_total_price" name="val_total_price" value="'.$total_service.'">
                            </td>
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
var total = 0;
var price_hr = 0;
var service_price = 0;
    
$(document).ready(function() {

  check_shop_mfr();
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

var delayTimer;
$(document).on('keyup', '.shoprate_mfr', function(){
var lengthkeyup = this.value.length;
var id = $(this).data('id'); // Retrieve the ID value
  clearTimeout(delayTimer);

  // Set a new delay timer to execute calculate function after 500 milliseconds (0.5 seconds)
  delayTimer = setTimeout(function() {
    if(lengthkeyup >0){
        console.log('keyup '+id);
        calculate(id); // Call the calculate function
    }
  }, 300);
});

function calculate (id){
    var val_total_service = parseFloat($('#val_total_price').val());
    var shoprate_price    = parseFloat($('#cart_service_price_'+id).text().replace('$', ''));
    var val_service_price = parseFloat($('#val_service_price_'+id).val());
    
    var price_hr = parseFloat($('#shoprate_mfg_'+id).val());
    var service_price = parseFloat($('#price_'+id).val());
    
    
          // Check if price_hr is less than 1 or empty
          if (price_hr < 1 || isNaN(price_hr)) {
            price_hr = 0;
          }
        
          // Check if service_price is less than 1 or empty
          if (service_price < 1 || isNaN(service_price)) {
            service_price = 0;
          }
          
    if (price_hr > 0 || service_price > 0) {
            total = price_hr * service_price;
    console.log('total_price 1st '+val_total_service);
    console.log('shoprate price '+shoprate_price);
    console.log('set price '+total);
        
    total_price = (val_total_service - shoprate_price) + total;
    console.log(total_price);
    
        $.post( "<?php echo root();?>inc/exec.php?act=shoprate_mfr", { 'cart_order_id' : '<?php echo $_GET['id'];?>', 'cart_service_id' : id ,'cart_shoprate_mfg' : price_hr, 'cart_service_price' : service_price}, '', 'script');
    
        $('#cart_service_price_'+id).html('$'+number_format(total, 2, '.', ','));
        $('#total_price').html('$'+number_format(total_price, 2, '.', ','));
        $('#val_total_price').val(total_price);
    }
}

function check_shop_mfr(){
    $.ajax({
        url: "<?php  echo root();?>do/check_flag_shop_mfr/",
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log(res);
            $.each(res, function (i, val) {
                $('#shoprate_mfg_'+val.id).addClass('shoprate_mfr');
                //$('#shoprate_mfg_'+val.id).attr('onkeyup','calculate('+val.id+')');

                $('#price_'+val.id).addClass('shoprate_mfr');       
                //$('#price_'+val.id).attr('onkeyup','calculate('+val.id+')');

                $('#div_'+val.id).show();   
            })
        }
    });
}
</script>