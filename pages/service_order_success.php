<?php 


if ( empty( $_SESSION[ 'uid' ] ) )header( 'location: /' );

?>
<div class="container">
    <div class="pt-4">
        <p class="display-4">Order Scheduled! </p>
        <p class="lead">Thank you for scheduling your rigging appointment.<br />
            Below is a summary of your order. </p>
        <?php 
        if ( $_GET[ 'page' ] == 'service_order_success' ) {

            $rq = mysqli_query( $link, 'SELECT * FROM repacks WHERE id=\'' . sf( $_GET[ 'id' ] ) . '\'' );

            $r = mysqli_fetch_assoc( $rq );

            ?>
        <div class="infobox p-3 my-3">
            <div class="row">
                <div class="col-md-6">
                    <div><u><strong>Container</strong></u></div>
                    <?php 

                    $aq = mysqli_query( $link, 'SELECT * FROM containers WHERE id=\'' . sf( $r[ 'container' ] ) . '\'' );
                    if(mysqli_num_rows($aq)>0) {
                            $cq   = mysqli_fetch_assoc($aq);
                            $h   = unserialize($cq['harness']);
                            $r  = unserialize($cq['reserve_parachute']);
                            $a   = unserialize($cq['aad_info']);
                            $m  = unserialize($cq['main_parachute']);

                            $_SESSION['repack_container_id'] = $cq['id'];
                            $s = $cq['service_id'];
                            
	                        echo'<h5>Harness</h5>';
	                        echo '<table>
	                        		<tr>
	                        			<td  align="right">Make</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$h['make'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">Model</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$h['model'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">size</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$h['size'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">Serial Number</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$h['serial'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">Date of Mfr</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$h['mfr'].'</td>
	                        		</tr>
	                        </table>';
							echo'<hr/>';

							echo'<h5>Reserve / Parachute</h5>';
							echo '<table>
	                        		<tr>
	                        			<td  align="right">Make</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$r['make'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">Model</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$r['model'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">size</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$r['size'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">Serial Number</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$r['serial'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">Date of Mfr</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$r['mfr'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">Fabric</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$r['fabric'].'</td>
	                        		</tr>
	                        </table>';
							echo'<hr/>';
							
							echo'<h5>AAD</h5>';
							echo '<table>
	                        		<tr>
	                        			<td  align="right">Make</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$a['make'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">Model</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$a['model'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">Size</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$a['size'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">Serial Number</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$a['serial'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">Date of Mfr</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$a['mfr'].'</td>
	                        		</tr>
	                        </table>';
							echo'<hr/>';

							echo'<h5>Main Parachute</h5>';
							echo '<table>
	                        		<tr>
	                        			<td  align="right">Make</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$m['make'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">Model</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$m['model'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">Size</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$m['size'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">Serial Number</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$m['serial'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">Date of Mfr</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$m['mfr'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">Fabric</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$m['fabric'].'</td>
	                        		</tr>
	                        		<tr>
	                        			<td  align="right">Line</td>
	                        			<td  align="right">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
	                        			<td  align="right">'.$m['line'].'</td>
	                        		</tr>
	                        </table>';
                            //echo'<hr/>';

                        }
                    //$c = mysqli_fetch_assoc( $cq );

                    //echo '' . $c[ 'manufacturer' ] . ' ' . $c[ 'model' ] . '' . ( $c[ 'serial' ] !== '' ? ' SN: ' . $c[ 'serial' ] : '' ) . '';
                    /*while($c = mysqli_fetch_assoc($cq)) {
                                $_SESSION['repack_container_id'] = $c['id'];
                                $s = $c['service_id'];
                                $h = unserialize($c['harness']);
                                echo ''.$h['make'].' '.$h['model'].''.($h['serial']!=='' ? ' SN: '.$h['serial'] : '').' &nbsp;&nbsp; <button type="button" class="btn-sm btn-warning" onclick="step_containerinfo(\''.$c['id'].'\')">Change</button>';
                                
                            }*/
                    ?>
                </div>
                <div class="col-md-6">
                    <div><u><strong>Service</strong></u></div>
                    <h5>Service Item :</h5>
                         <?php 
                            $que = 'SELECT * FROM shopping_cart WHERE cart_order_id =\''.sf($_GET['order']).'\'';
                            //echo $que;
                            $q = mysqli_query($link, $que);
                            $total_price = 0;
                            echo '<table>';
                            while($res = mysqli_fetch_assoc($q)) {
                                $res['cart_service_price'] = ($res['cart_shoprate_mfg'] > 0) ? ($res['cart_shoprate_mfg_price']*$res['cart_shoprate_mfg']) : $res['cart_service_price'];
                                $total_price +=$res['cart_service_price'];

                                echo'                                
                                    <tr>
                                        <td>'.$res['cart_service_name'].'</td>
                                        <td>:</td>
                                        <td>$'.number_format($res['cart_service_price'],2,".",",").'</td>
                                    </tr>';
                            
                            }
                            
                            echo '<tr><td><h4><strong>Total Service </h4></strong></td><td>:</td><td><h4><strong>$'.number_format($total_price,2,".",",").'</h4></strong></td>';
                            echo'</table>';
                            echo '<hr/>';
                        ?>
                    
                
                    <div><u><strong>Repack Speed</strong></u></div>
                    <?php 
                    $rq = mysqli_query( $link, 'SELECT * FROM repacks WHERE id=\'' . sf( $_GET[ 'id' ] ) . '\'' );

            $r = mysqli_fetch_assoc( $rq );
                    if($r['type'] == 'tandem'){
                        $data =  $repack_label[ $r[ 'speed' ] ];
                        $rs_price = '$' . ($repack_pricing[$r[ 'speed' ]]+100) . '.00';
                    
                    }else if($r['type'] == 'sport'){
                    
                    $data = $repack_label[ $r[ 'speed' ] ];
                    $rs_price = '$' . $repack_pricing[$r[ 'speed' ]] . '';
                    }
                    echo'
                    <table>
                            <tr><td>'.$data.'</td><td>:</td><td>'.$rs_price.'</td></tr>';
                         $quem = 'SELECT * FROM service_cart WHERE sc_cart_order_id =\''.sf($_GET['order']).'\'';
                         //echo $quem;
                            $qm = mysqli_query($link, $quem);
                            $resm = mysqli_fetch_assoc($qm);
                            $mainchute = (float)$resm['sc_cart_mainchute'];
                            $total = (float)$total_price+$mainchute+(float)$repack_pricing[$r[ 'speed' ]];

                            $resm['sc_cart_mainchute'] = ($resm['sc_cart_mainchute'] > 0 ) ? 'Yes ($'.$resm['sc_cart_mainchute'].')' : 'No';

                            echo '<tr><td>Mainchute</td><td>:</td><td>'.$resm['sc_cart_mainchute'].'</td></tr>';

                            echo '<tr><td><h4><strong>Total </h4></strong></td><td>:</td><td><h4><strong>$'.number_format($total,2,".",",").'</strong></h4></td></tr>';
                        ?>
                    </table>
                </div>
            </div>
            <hr/>
            <div class="row pt-3">
                <div class="col-md-6">
                    <div><u><strong>Dropoff Date</strong></u></div>
                    <?php 
                    //&container='.$_SESSION['repack_container_id'].'&speed='.$speed.'&dropoff_date='.$dropoff_date.'&estimated_pickup='.$pickup.'\'
                    echo '<table><tr><td><h4>'.date('m-d-Y', strtotime($r['dropoff_date'])).'</h4> </td></tr></table>';

                    ?>
                </div>
                <hr/>
                <div class="col-md-6">
                    <div><u><strong>Estimated Pickup</strong></u></div>
                    <?php 
                    //&container='.$_SESSION['repack_container_id'].'&speed='.$speed.'&dropoff_date='.$dropoff_date.'&estimated_pickup='.$pickup.'\'

                    echo '<table><tr><td><h4>'.date('m-d-Y', strtotime($r['estimated_pickup'])).'</h4> </td></tr></table>';

                    ?>
                </div>
            </div>
        </div>
        <?php  } ?>
        <p class="lead">Please bring your equipment to our loft during regular business hours. Our loft is located at:</p>
        <div class="p-3 my-3"><strong>Chicagoland Skydiving Center</strong><br />
            1207 E Gurler Rd, Rochelle, IL 61068</div>
        <p class="lead">If you have scheduled a rush repack, you must bring in your equipment as soon as possible to avoid missing your space in line. Same day repacks are not guaranteed if brought in at the end of the day!</p>
    </div>
</div>
