<style>
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
    $_SESSION['order_id'] = (isset($_SESSION['order_id'])) ? $_SESSION['order_id'] : '';
    $uid = $_SESSION['uid'];

    $cq = mysqli_query($link, 'SELECT * FROM containers WHERE customer=\''.sf($uid).'\' AND service_id=\''.sf($_GET['s']).'\'');
    $res = mysqli_fetch_assoc($cq);

    $_SESSION['repack_container_id'] = $res['id'];
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

    $cq = mysqli_query($link, 'SELECT * FROM shopping_cart WHERE cart_container_id=\''.sf($_SESSION['repack_container_id']).'\' AND cart_status=\'1\' AND cart_customer_id=\''.sf($uid).'\' ORDER BY cart_id DESC LIMIT 1');
    $d = mysqli_fetch_assoc($cq);
    $r = $d['cart_repack_type'];
    $_SESSION['order_id'] = $d['cart_order_id'];

if(isset($_GET['cart']) && $_GET['cart'] == 'true' ){ 
    $r = $_GET['repack_type'];
}

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
                            $que = "SELECT * FROM service_list WHERE group_qb_code =".$serv;
                        }else{
                            $que = "SELECT * FROM service_list WHERE group_qb_code = 8";
                        }

                        $q = mysqli_query($link, $que);
                        while($res = mysqli_fetch_assoc($q)) {
                    echo '
                    <tr id="tr_'.$res['id'].'">
                        <td class="p-4"><button id="item_'.$res['id'].'" onclick="javascript:add_cart('.$res['id'].')" type="button" class="btn btn-success btn-add" data-id="'.$res['id'].'" data-price="'.$res['sales_price'].'" data-service="'.$res['service_item'].'">Add</button></td>
                        <td class="p-4">'.$res['service_item'].'</td>
                        <td class="p-4">$'.number_format($res['sales_price'],2,".",",").'</td>
                    </tr>';
                        }
                    ?>
            	  	
            </tbody>
        </table>
        <?php } ?>
        <br/>
        <button  class="btn btn-primary" id="next_step" style="float: right;" onclick="checkout('<?php echo $_GET['repack_type'];?>');  return false;">Checkout</button>        
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
                <td align="right">$<span id="total_price">0</span></td>
            </tr>
        </tfoot>
    </table>
</div>

<script>
//default variable definition
//default variable definition
//default variable definition
var shopping_cart = [];
var item = [];
var list_item = '';
var total_price = 0;
var detail_id = 0;

$( document ).ready(function() 
{
    
    var order = $("#order_id").val();

    if(order == ''){
        generate_order_id(10);
    }else{
        show_cart();
    }

    $(document).on('change', '#repack_type', function(){
        var r_type = $(this).val();
        step_service(r_type);
    });
});

function step_service(r_type) {
	
	var stepper = new Stepper(document.querySelector('.bs-stepper'))
	stepper.to(2);
	
	$('#service-part').load('<?php  echo root();?>inc/exec.php?act=service_repack&repack_type='+r_type+'&page=service_list&container=<?php echo $_GET['container'];?>&s=<?php echo $s;?>&cart=true');
	
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

function calculate_total_price(price){
    var total_price_sub = parseFloat($('#total_price').text().replace('$', ''));
    total_price_sub += parseFloat(price);
    var total_price = total_price_sub.toFixed(2);
    $('#total_price').html(number_format(total_price, 2, '.', ','));
}

function show_cart()
{
    var order = $("#order_id").val();
    $.ajax({
      url: '<?php echo root();?>do/show_cart/',
      type: 'POST',
      data: { 'cart_order_id' : order },
      success: function(response) {
        //console.log(response);      
        shopping_cart.push(response);
        
        $.each(shopping_cart[0], function (i, item) {
            console.log(shopping_cart[0]);
            console.log("order_id: " + item.cart_order_id);
             list_item +=  '<tr id="detail_'+detail_id+'" data-id="'+item.cart_service_id+'" data-price="'+item.cart_service_price+'">'+
                            '<td style="cursor: pointer" onclick="javascript:remove_cart('+detail_id+')" width="10%">x</td>'+
                            '<td width="70%">'+item.cart_service_name+'</td>'+
                            '<td width="20%" align="right">$'+item.cart_service_price+'</td>'+
                          '</tr>';
            
            total_price += parseFloat(item.cart_service_price);
            detail_id++;

            item.id = item.cart_service_id;
            item.service = item.cart_service_name;
            item.price = item.cart_service_price;
            
        });
        
        $('#shopping-cart-detail table tbody').html(list_item);
        $('#total_price').html(total_price);
        $('#shopping-cart-value').fadeOut(500, function() {
            $(this).text(total_price).fadeIn(500);
        })
        
      },
      error: function(xhr, status, error) {
        // Handle any errors that occur during the request
      }
    });
}

function add_cart(id)
{
    //item = [];
    //total_price = 0;
    //list_item = '';
    //detail_id = 0;
console.log('item'+item);
console.log('cart'+shopping_cart);

    var order = $("#order_id").val();

    item.id = $('#item_'+id).data('id');
    item.service = $('#item_'+id).data('service');
    item.price = $('#item_'+id).data('price');
    
    shopping_cart.push(item)
    
    shopping_cart.forEach(function(value, index)
    {
        list_item +=  '<tr id="detail_'+detail_id+'" data-id="'+value.id+'" data-price="'+value.price+'">'+
                        '<td style="cursor: pointer" onclick="javascript:remove_cart('+detail_id+')" width="10%">x</td>'+
                        '<td width="70%">'+value.service+'</td>'+
                        '<td width="20%" align="right">$'+value.price+'</td>'+
                      '</tr>';
        
        total_price += parseFloat(value.price);
        detail_id++;
    })
    
    $('#shopping-cart-detail table tbody').html(list_item);
    $('#total_price').html(total_price);
    $('#shopping-cart-value').fadeOut(500, function() {
        $(this).text(total_price).fadeIn(500);
    })
    $("#tr_"+id).hide();
    

    $.ajax({
      url: '<?php echo root();?>do/add_cart/',
      type: 'POST',
      data: { 'cart_order_id' : order, 'cart_service_id' : item.id, 'cart_customer_id' : '<?php echo $_SESSION['uid'];?>', 'cart_service_name' : item.service, 'cart_service_price' : item.price, 'cart_container_id' : '<?php echo $_SESSION['repack_container_id'];?>', 'repack_type' : '<?php echo $r;?>' },
      success: function(response) {
        // Handle the success response here
        console.log(response);
      },
      error: function(xhr, status, error) {
        // Handle any errors that occur during the request
      }
    });
}

function remove_cart(id)
{
    item_id = $('#detail_'+id).data('id');
    total_price -= parseFloat($('#detail_'+id).data('price'));
    
    var order = $("#order_id").val();

    shopping_cart.forEach(function(value, index)
    {
        if(index == id)
            shopping_cart.splice(index, 1)
    })
    
    $('#total_price').html(total_price);
    $('#shopping-cart-value').fadeOut(500, function() {
        $(this).text(total_price).fadeIn(500);
    })
    
    $('#detail_'+id).fadeOut(500, function(){  
        $(this).remove(); 
    })

    $.ajax({
      url: '<?php echo root();?>do/del_item_cart/',
      type: 'POST',
      data: { 'cart_order_id' : order, 'cart_service_id' : item.id, 'cart_customer_id' : '<?php echo $_SESSION['uid'];?>' },
      success: function(response) {
        // Handle the success response here
        console.log(response);
      },
      error: function(xhr, status, error) {
        // Handle any errors that occur during the request
      }
    });
}

function generate_order_id(length){
      var result = '';
      var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      var charactersLength = characters.length;

      for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
      }

      $("#order_id").val(result);
      console.log(result);
}
</script>