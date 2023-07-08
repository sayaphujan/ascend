<?php
$url = $_GET['repack_type'];  
?>
<div class="row">
	<h4>Finalize Service & Scheduling</h4>
</div>

<div class="alert alert-warning d-none align-items-center" role="alert" id="finalalert"></div>

<form id="schedule_form" action="" method="post" onsubmit="finalize_repack();  return false;">
<div class="row">
	
		<div class="col-md-6">	
		<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<div ><h3><u><strong>Container</strong></u></h3></div>
						
						<?php

						$aq = mysqli_query($link, 'SELECT * FROM containers WHERE id=\''.sf($_SESSION['repack_container_id']).'\'');
						if(mysqli_num_rows($aq)>0) {
							
							//$c = mysqli_fetch_assoc($cq);
						
							//echo ''.$c['manufacturer'].' '.$c['model'].''.($c['serial']!=='' ? ' SN: '.$c['serial'] : '').' &nbsp;&nbsp; <button type="button" class="btn-sm btn-warning" onclick="step_containerinfo()">Change</button>';
							$cq   = mysqli_fetch_assoc($aq);
							$h   = unserialize($cq['harness']);
							$rp  = unserialize($cq['reserve_parachute']);
							$a   = unserialize($cq['aad_info']);
							$mp  = unserialize($cq['main_parachute']);

                            $_SESSION['repack_container_id'] = $c['id'];
                            $s = $c['service_id'];
                            
                            //    echo ''.$h['make'].' '.$h['model'].''.($h['serial']!=='' ? ' SN: '.$h['serial'] : '').' &nbsp;&nbsp; <button type="button" class="btn-sm btn-warning" onclick="step_containerinfo(\''.$c['id'].'\')">Change</button>';
                                
                            
	                        echo'<h5>Harness</h5>';
	                        echo '<table>
	                        		<tr>
	                        			<td>Make</td>
	                        			<td>:</td>
	                        			<td>'.$h['make'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>Model</td>
	                        			<td>:</td>
	                        			<td>'.$h['model'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>size</td>
	                        			<td>:</td>
	                        			<td>'.$h['size'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>Serial Number</td>
	                        			<td>:</td>
	                        			<td>'.$h['serial'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>Date of Mfr</td>
	                        			<td>:</td>
	                        			<td>'.$h['mfr'].'</td>
	                        		</tr>
	                        </table>';
							echo'<hr/>';

							echo'<h5>Reserve / Parachute</h5>';
							echo '<table>
	                        		<tr>
	                        			<td>Make</td>
	                        			<td>:</td>
	                        			<td>'.$r['make'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>Model</td>
	                        			<td>:</td>
	                        			<td>'.$r['model'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>size</td>
	                        			<td>:</td>
	                        			<td>'.$r['size'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>Serial Number</td>
	                        			<td>:</td>
	                        			<td>'.$r['serial'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>Date of Mfr</td>
	                        			<td>:</td>
	                        			<td>'.$r['mfr'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>Fabric</td>
	                        			<td>:</td>
	                        			<td>'.$r['fabric'].'</td>
	                        		</tr>
	                        </table>';
							echo'<hr/>';
							
							echo'<h5>AAD</h5>';
							echo '<table>
	                        		<tr>
	                        			<td>Make</td>
	                        			<td>:</td>
	                        			<td>'.$a['make'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>Model</td>
	                        			<td>:</td>
	                        			<td>'.$a['model'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>size</td>
	                        			<td>:</td>
	                        			<td>'.$a['size'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>Serial Number</td>
	                        			<td>:</td>
	                        			<td>'.$a['serial'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>Date of Mfr</td>
	                        			<td>:</td>
	                        			<td>'.$a['mfr'].'</td>
	                        		</tr>
	                        </table>';
							echo'<hr/>';

							echo'<h5>Main Parachute</h5>';
							echo '<table>
	                        		<tr>
	                        			<td>Make</td>
	                        			<td>:</td>
	                        			<td>'.$m['make'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>Model</td>
	                        			<td>:</td>
	                        			<td>'.$m['model'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>size</td>
	                        			<td>:</td>
	                        			<td>'.$m['size'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>Serial Number</td>
	                        			<td>:</td>
	                        			<td>'.$m['serial'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>Date of Mfr</td>
	                        			<td>:</td>
	                        			<td>'.$m['mfr'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td>Fabric</td>
	                        			<td>:</td>
	                        			<td>'.$m['fabric'].'</td>
	                        		</tr>
	                        </table>';
							echo'<hr/>';

						}
						
						?>
						
					<!--</div>
				</div>
				
				
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">-->
						<div ><h3><u><strong>Service </strong></u></h3></div>
							<h5>Service Item :</h5>
						 <?php 
                            $que = 'SELECT * FROM shopping_cart WHERE cart_order_id =\''.sf($_SESSION['order_id']).'\' AND cart_status=\'1\'';
                            //echo $que;
                            $q = mysqli_query($link, $que);
                            $total_price = 0;
                            echo '<table>';
                            while($res = mysqli_fetch_assoc($q)) {
                                $total_price +=$res['cart_service_price'];

								echo'                                
	                        		<tr>
	                        			<td>'.$res['cart_service_name'].'</td>
	                        			<td>:</td>
	                        			<td>$'.number_format($res['cart_service_price'],2,".",",").'</td>
	                        		</tr>';
	                        
                            }
                            
                            echo '<tr><td>Total Service </td><td>:</td><td>$'.number_format($total_price,2,".",",").'</td>';
                            echo'</table>';
                            echo '<hr/>';
                        ?>
					<!--</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">-->
						<div ><h3><u><strong>Repack Speed</strong></u></h3></div>
						<table>
							<tr><td colspan="3">
						<?php
                        if($url == 'tandem'){
                            echo $repack_label[$_GET['speed']].' - $'.($repack_pricing[$_GET['speed']]+100.00).'.00 &nbsp;&nbsp; <button type="button" class="btn-sm btn-warning" onclick="goto_step_schedule()">Change</button>';
                        }else if($url == 'sport'){
						    echo $repack_label[$_GET['speed']].' - $'.$repack_pricing[$_GET['speed']].' &nbsp;&nbsp; <button type="button" class="btn-sm btn-warning" onclick="goto_step_schedule()">Change</button>';
                        }
                        echo '</td>';
                         $quem = 'SELECT * FROM service_cart WHERE sc_cart_order_id =\''.sf($_SESSION['order_id']).'\'';
                            $qm = mysqli_query($link, $quem);
                            $resm = mysqli_fetch_assoc($qm);
                            $mainchute = (float)$resm['sc_cart_mainchute'];
                            $total = (float)$total_price+$mainchute+(float)$repack_pricing[$_GET['speed']];

                            $resm['sc_cart_mainchute'] = ($resm['sc_cart_mainchute'] > 0 ) ? 'Yes ($'.$resm['sc_cart_mainchute'].')' : 'No';

                            echo '<tr><td>Mainchute</td><td>:</td><td>'.$resm['sc_cart_mainchute'].'</td></tr>';

                            echo '<tr><td>Total </td><td>:</td><td>$'.number_format($total,2,".",",").'</td></tr>';
						?>
					</table>
				<hr/>
						
					<!--</div>
				</div>
			</div>
		
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">-->
						<div ><h3><u><strong>Dropoff Date</strong></u></h3></div>
						<?php
						//&container='.$_SESSION['repack_container_id'].'&speed='.$speed.'&dropoff_date='.$dropoff_date.'&estimated_pickup='.$pickup.'\'
                    
						echo '<table><tr><td><h4>'.date('m-d-Y', strtotime($_GET['dropoff_date'])).'</h4> </td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn-sm btn-warning" onclick="goto_step_schedule()">Change</button></td></tr></table>';
						echo '<hr/>';
						?>
						
					<!--</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">-->
						<div ><h3><u><strong>Estimated Pickup</strong></u></h3></div>
						<?php
						//&container='.$_SESSION['repack_container_id'].'&speed='.$speed.'&dropoff_date='.$dropoff_date.'&estimated_pickup='.$pickup.'\'
						echo '<table><tr><td><h4>'.date('m-d-Y', strtotime($_GET['estimated_pickup'])).'</h4> </td></tr></table>';
						echo '<hr/>';
						
						?>
						
					</div>
				</div>
				<button  class="btn btn-primary" id="place_order_button">Finalize & Submit Work Order</button>
			</div>
			
			
		</div>
			<!--
		<div class="col-md-2"></div>
	
		<div class="col-md-4">
			<div ><u><strong>Payment Type</strong></u></div>
			
			<div class="form-check">
			  <input class="form-check-input" type="radio" name="payment_type" id="flexRadioDefault1"  checked/>
			  <label class="form-check-label" for="flexRadioDefault1"> Pay at dropoff </label>
			</div>

			<div class="form-check">
			  <input class="form-check-input" type="radio" name="payment_type" id="flexRadioDefault2" disabled />
			  <label class="form-check-label" for="flexRadioDefault2"> Pay now via Credit Card </label>
			</div>
			<br />
			<br />
			
			
		
		</div>
		</div>
	-->
	

</form>

<script>
function update_pickup(date) {
	$.post( "<?php echo root();?>inc/exec.php?act=get_estimated_pickup&repack_type=<?php echo $url;?>&ajax=1&schedule=1", $('#schedule_form').serialize(), '', 'script');
}

function finalize_repack() {

	$('#place_order_button').prop('disabled', true);


    //$.post( "<?php echo root();?>inc/exec.php?act=service_checkout&ajax=1&schedule=1&s=<?php echo $_GET['s'];?>", { 'cart_order_id' : '<?php echo $_SESSION['order_id'];?>', 'cart_customer_id' : '<?php echo $_SESSION['uid'];?>' ,'existing_container' : container, 'repack_type' : '<?php echo $_GET['repack_type'];?>' }, '', 'script');

	$.post( "<?php echo root();?>inc/exec.php?act=submit_service_order&ajax=1&schedule=1&repack_type=<?php echo $url;?>", 'container=<?php echo $_SESSION['repack_container_id']?>&speed=<?php echo $_GET['speed']?>&dropoff_date=<?php echo $_GET['dropoff_date']?>&estimated_pickup=<?php echo $_GET['estimated_pickup']?>&cart_order_id=<?php echo $_SESSION['order_id'];?>', '', 'script');
	
}

$('#dropoff_date').on('input',function(e){
 update_pickup();
});

$('#speed').on('change',function(e){
 update_pickup();
});

</script>