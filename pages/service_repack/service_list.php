<style>
    .disabled {
        opacity: 0.6;
        pointer-events: none;
    }

    #shopping-cart{
        position: fixed;
        top: 11px;
        left: 100px;
        background-color: #492d30;
        padding: 5px 10px;
        border-radius: 5px;
        z-index: 9999;
    }
    #shopping-cart-detail{
        position: fixed;
        top: 55px;
        z-index: 99999;
        left: 99px;
        background-color: #007bff;
        padding: 5px;
        border-radius: 3px;   
    }
    #shopping-cart-detail table{
        font-size: 11px;
        width: 230px;   
    }
    #shopping-cart-detail table td{
        border-bottom: 1px dashed #ccc
}
</style>
<?php
    $r = '';
    $_SESSION['order_id'] = '';
    $uid = $_SESSION['uid'];
    $_SESSION['repack_container_id'] = (isset($_SESSION['repack_container_id'])) ? $_SESSION['repack_container_id'] : $_GET['container'];
    
    $cq = mysqli_query($link, 'SELECT * FROM containers WHERE customer=\''.sf($uid).'\' AND id=\''.$_SESSION['repack_container_id'].'\' AND service_id=\''.sf($_GET['s']).'\'');
    $res = mysqli_fetch_assoc($cq);
    
    //$_SESSION['repack_container_id'] = $res['id'];
    $serv = $res['service_id'];
    
switch ($serv) {
	case '1':
		$title = 'Assemblies, Repacks, Inspections';
		break;
	case '2':
		$title = 'Common Maintenance Items';
		break;
	case '3':
		$title = 'Tandem Maintenance';
		break;
	case '4':
		$title = 'Canopy Sewing';
		break;
	case '5':
		$title = 'Harness Work';
		break;
	
	default:
		$title = 'Assemblies, Repacks, Inspections';
		break;
}

    $q = 'SELECT * FROM shopping_cart WHERE cart_container_id=\''.sf($_SESSION['repack_container_id']).'\' AND cart_status=\'1\' AND cart_customer_id=\''.sf($uid).'\' ORDER BY cart_id DESC LIMIT 1';
    //echo $q;
    $cq = mysqli_query($link, $q);
    if(mysqli_num_rows($cq) > 0){
        $d = mysqli_fetch_assoc($cq);
        
        $r = $d['cart_repack_type'];
        $_SESSION['order_id'] = $d['cart_order_id'];
    }

if(isset($_GET['cart']) && $_GET['cart'] == 'true' ){ 
    $r = $_GET['repack_type'];
}
$_SESSION['repack_type'] = $r;
?>
<div class="container-fluid">

    <div class="row">
    	<div class="col-md-12">
            <!--<div class="alert alert-warning d-none align-items-center" role="alert" id="containeralert"></div>-->
        <label for="make" class="control-label"><strong>Please select Repack Type :</strong></label>
        <select class="form-control dd" id="repack_type" name="repack_type">
            <option value=""> -- Select Repack Type  -- </option>
            <option value="sport" <?php if($r=='sport'){echo 'selected'; }?>>Schedule Sport/Tandem Repack</option>
            <option value="pilot" <?php if($r=='pilot'){echo 'selected'; }?>>Schedule Pilot Repack</option>
        </select>
        <br/>
        <br/>
        <input type="hidden" id="order_id" name="order_id" value="<?php echo $_SESSION['order_id'];?>">
        <?php if($r != ''){ ?>
        <div class="row">
        	<h4><?php echo strtoupper($_GET['repack_type'].' Repack - '.$title);?></h4>
        </div>
        
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

                        if($r != 'pilot'){
                            $que = "SELECT * FROM service_list WHERE group_qb_code =".$serv." AND status='1'";
                        }else{
                            $que = "SELECT * FROM service_list WHERE group_qb_code = 8 AND status='1'";
                        }

                        /*if($_SESSION['order_id'] != ''){
                            $que = $que.' AND id NOT IN (SELECT cart_service_id FROM shopping_cart WHERE cart_customer_id=\''.sf($_SESSION['uid']).'\' AND cart_status=\'1\')';
                        }*/

                        $q = mysqli_query($link, $que);
                        while($res = mysqli_fetch_assoc($q)) {
                            /*if($res['shoprate_mfg'] == '1'){
                                $res['sales_price'] = '0';
                                $text = "$0";
                            }else{
                                $res['sales_price'] = '$'.number_format($res['sales_price'],2,".",",");
                                $text = $res['sales_price'];
                            }*/
                    echo '
                    <tr id="tr_'.$res['id'].'">
                        <td><button id="item_'.$res['id'].'" type="button" class="btn btn-success btn-add" data-id="'.$res['id'].'" data-price="'.$res['sales_price'].'" data-service="'.$res['service_item'].'">Add</button></td>
                        <td>'.$res['service_item'].'</td>
                        <td>$'.number_format($res['sales_price'],2,".",",").'</td>
                    </tr>';
                        }
                    ?>
            	  	
            </tbody>
        </table>
        <?php } ?>
        <br/>
        <button  class="btn btn-primary" style="float: left;" onclick="back_to_container('<?php echo $_GET['repack_type'];?>');  return false;">Back to Container Information</button>        
        <button  class="btn btn-primary" style="float: right;" onclick="checkout('<?php echo $_GET['repack_type'];?>');  return false;">Confirm Services</button>        
    	</div>
    </div>
</div>

<script src="https://kit.fontawesome.com/0094d052f5.js" crossorigin="anonymous"></script>
<div id="shopping-cart"><i class="fa-solid fa-cart-shopping"></i> <span id="shopping-cart-value"></span></div>
<div id="shopping-cart-detail" style=>
    <table>
        <tbody>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td>Total Price</td>
                <td align="right">$<span id="total_price">0.00</span></td>
            </tr>
        </tfoot>
    </table>
</div>

<script>
//default variable definition
//default variable definition
//default variable definition
var shopping_cart = [];
var total_price = 0;
var detail_id = 0;

$( document ).ready(function() 
{    
    if($("#order_id").val() != ''){
        show_cart();
    }

     $(".btn-add").unbind().click(function() {
        var id = $(this).data('id');
            add_cart(id);
    });
});


    $(document).on('change', '#repack_type', function(){
        var r_type = $(this).val();
        step_service(r_type);
    });

function step_service(r_type) {
	
	var stepper = new Stepper(document.querySelector('.bs-stepper'))
	stepper.to(2);
	
	$('#service-part').load('<?php  echo root();?>inc/exec.php?act=service_repack&repack_type='+r_type+'&page=service_list&container=<?php echo $_GET['container'];?>&s=<?php echo $s;?>&cart=true');
	
}

function back_to_container(r_type) {
	
	var stepper = new Stepper(document.querySelector('.bs-stepper'))
	stepper.to(1);
	
	$('#information-part').load('<?php  echo root();?>inc/exec.php?act=service_repack&repack_type='+r_type+'&page=container_info&container=<?php echo $_GET['container'];?>&s=<?php echo $s;?>');
	
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


function checkout(r_type){
    var stepper = new Stepper(document.querySelector('.bs-stepper'))
    stepper.to(2);
    
    $('#service-part').load('<?php  echo root();?>inc/exec.php?act=service_repack&repack_type='+r_type+'&page=service_summary&container=<?php echo $_SESSION['repack_container_id'];?>&s=<?php echo $s;?>&order_id='+$("#order_id").val());
}

//function calculate_total_price(price){
//    var total_price_sub = parseFloat($('#total_price').text().replace('$', ''));
//    total_price_sub += parseFloat(price);
//    var total_price = total_price_sub.toFixed(2);
//    $('#total_price').html(number_format(total_price, 2, '.', ','));
//}

function show_cart()
{
    var item = [];
    var list_item = '';
    var detail_id = 0;
    
    $("#repack_type").addClass("disabled");
    $.ajax({
      url: '<?php echo root();?>do/show_cart/',
      type: 'POST',
      data: { 'cart_order_id' : $("#order_id").val() },
      success: function(response) {
        var list_item = '';
        var total_price = 0; // Reset total_price before recalculating
    
        $.each(response, function (i, val) {
            $("#tr_"+val.cart_service_id).hide();
            var formattedPrice = parseFloat(val.cart_service_price).toFixed(2); // Format the price to 2 decimal places
             list_item +=  '<tr id="detail_'+detail_id+'" data-id="'+val.cart_service_id+'" data-price="'+formattedPrice+'">'+
                            '<td style="cursor: pointer" onclick="javascript:remove_cart('+detail_id+')" width="10%">x</td>'+
                            '<td width="70%">'+val.cart_service_name+'</td>'+
                            '<td width="20%" align="right">$'+formattedPrice+'</td>'+
                          '</tr>';

            var item = {
                    id: val.cart_service_id,
                    service: val.cart_service_name,
                    price: val.cart_service_price
            };
    
            shopping_cart.push(item);    
            
            total_price += parseFloat(val.cart_service_price);
            //total_price += parseFloat(item.price);
            detail_id++;
        });
        updateCartDetails(list_item, total_price);
      },
      error: function(xhr, status, error) {
        response = 'error';
      }
    });
       
     
}

function add_cart(id)
{
    var item = [];
    var total_price = 0;
    
    if($("#order_id").val() == ''){
        $("#order_id").addClass('disabled');
        generate_order_id(10);
    }

    item.id = $('#item_'+id).data('id');
    item.service = $('#item_'+id).data('service');
    item.price = $('#item_'+id).data('price');
    
    shopping_cart.push(item);
    //total_price += parseFloat(item.price); // Update total_price
    
    var list_item = '';

    shopping_cart.forEach(function(value, index)
    {
        var formattedPrice = parseFloat(value.price).toFixed(2); // Format the price to 2 decimal places
        list_item +=  '<tr id="detail_'+detail_id+'" data-id="'+value.id+'" data-price="'+formattedPrice+'">'+
                        '<td style="cursor: pointer" onclick="javascript:remove_cart('+detail_id+')" width="10%">x</td>'+
                        '<td width="70%">'+value.service+'</td>'+
                        '<td width="20%" align="right">$'+formattedPrice+'</td>'+
                      '</tr>';
        
        total_price += parseFloat(value.price);
        detail_id++;
    })
    
    updateCartDetails(list_item, total_price);
    $("#tr_"+id).hide();
    
    $.ajax({
      url: '<?php echo root();?>do/add_cart/',
      type: 'POST',
      data: { 'cart_order_id' : $("#order_id").val(), 'cart_service_id' : item.id, 'cart_customer_id' : '<?php echo $uid;?>', 'cart_service_name' : item.service, 'cart_service_price' : item.price, 'cart_container_id' : '<?php echo $_SESSION['repack_container_id'];?>', 'repack_type' : '<?php echo $r;?>' },
      success: function(response) {
        // Handle the success response here
        console.log(response);
        $("select:not([class*='disabled'])").addClass("disabled");
      },
      error: function(xhr, status, error) {
        // Handle any errors that occur during the request
      }
    });
}

function updateCartDetails(list_item, total_price){
    console.log(total_price);
    
    var total = parseFloat(total_price).toFixed(2);
    $('#shopping-cart-detail table tbody').html(list_item);
    $('#total_price').html(total);
    $('#shopping-cart-value').fadeOut(500, function() {
        $(this).html(total).fadeIn(500); // Update the shopping cart value with 2 decimal places
    });
}

function remove_cart(id)
{
    item_id = $('#detail_'+id).data('id');
    var total_price = parseFloat($('#total_price').text().replace('$', ''));
    var removedItemPrice = parseFloat($('#detail_' + id).data('price'));
    total_price -= removedItemPrice;


        shopping_cart.forEach(function(value, index)
        {
            if(index == id){
                shopping_cart.splice(index, 1);
            }

        })      

    var total = parseFloat(total_price).toFixed(2);
    $('#total_price').html(total);
    $('#shopping-cart-value').fadeOut(500, function() {
        $(this).html(total).fadeIn(500);
    })
    
    $('#detail_'+id).fadeOut(500, function(){  
        $(this).remove();
        updateDetailIds(); // Update the detail_id values after removing the item 
    })

    //updateListTotalPrice(removedPrice);

    if(shopping_cart.length === 0){
        $("#repack_type").removeClass("disabled");
    }

    $.ajax({
      url: '<?php echo root();?>do/del_item_cart/',
      type: 'POST',
      data: { 'cart_order_id' : $("#order_id").val(), 'cart_service_id' : item_id, 'cart_customer_id' : '<?php echo $uid;?>' },
      success: function(response) {
        // Handle the success response here
        console.log(response);
        $("#tr_"+item_id).show();
      },
      error: function(xhr, status, error) {
        // Handle any errors that occur during the request
      }
    });
}

function updateListTotalPrice(removedPrice) {
    var list_total_price = 0;

    $('#shopping-cart-detail table tbody tr').each(function() {
        var price = parseFloat($(this).data('price'));
        list_total_price += price;
    });

    if (list_total_price === 0) {
        $('#total_price').text(0);
    } else {
        $('#total_price').text(list_total_price.toFixed(2));
    }
}

function updateDetailIds() {
    $('#shopping-cart-detail table tbody tr').each(function(index) {
        $(this).attr('id', 'detail_' + index);
        $(this).find('td[onclick]').attr('onclick', 'remove_cart(' + index + ')');
    });

    detail_id = $('#shopping-cart-detail table tbody tr').length;
}

function generate_order_id(length){
      var result = '';
      var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      var charactersLength = characters.length;

      for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
      }
      console.log(result);
      $("#order_id").val(result);
      $.session.set('order_id', result);
}
</script>