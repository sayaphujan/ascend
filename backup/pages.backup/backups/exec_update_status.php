<?
case 'update_status_repack':
		
		if($_POST['status'] =='pending'){
		    $status = 'In-Progress';
		}
		
		if($_POST['status'] =='In-Progress'){
		    $status = 'Completed';
		}
		
		if($_POST['status'] =='Completed'){
		    $status = 'Delivered';
		}
    		 $upd = 'UPDATE `repacks` SET `status`=\''.sf($status).'\' WHERE `id`=\''.sf($_POST['repack_id']).'\'';
    		 $query = mysqli_query($link,$upd);
    		 
    		    $select = 'SELECT * FROM repacks LEFT JOIN customers ON customers.user_id=repacks.customer LEFT JOIN containers ON containers.id=repacks.container WHERE repacks.id=\''.sf($_POST['repack_id']).'\'';
    		    
    		    $rq = mysqli_query($link,$select);
    		    $r = mysqli_fetch_assoc($rq);
    		    
    		    $updt = 'UPDATE `work_orders` SET `status`=\''.sf($status).'\' WHERE `id`=\''.sf($r['work_order']).'\'';
    		    $query = mysqli_query($link,$updt);
    		    
    		        if($status == 'Completed')
    		        {
        		        $today = date('Y-m-d');
        		        $next_repack = date('Y-m-d', strtotime($today. ' + 180 days'));
        		        $updt = 'UPDATE `containers` SET `next_repack`=\''.sf($next_repack).'\' WHERE `id`=\''.sf($r['container']).'\'';
    		        }
    		    
    		    if(sf($status) == 'In-Progress'){
    		                $to = $r[ 'email' ];
                            $subject = "Peregrine Manufacturing, Inc.";
                            $message = "
                            <html>
                            <head>
                            <title>Work Order in Progress | Peregrine Manufacturing, Inc.</title>
                            </head>
                            <body>
                            <p>Hello " . make_safe( $r[ 'first_name' ] ) . ",</p>
                            <p>Your Order status is In-Progress</p>
                            
                            <hr/>
                            <h3>Account Details:</h3>
                            <hr/>
                            <p>Name: " . make_safe( $r[ 'first_name' ] ) . " " . make_safe( $r[ 'last_name' ] ) . "</p>
                            <p>Address: " . make_safe( $r[ 'address' ] ) . "<br/>" . make_safe( $r[ 'address2' ] ) . "</p>
                            <p>" . make_safe( $r[ 'city' ] ) . "," . make_safe( $r[ 'state' ] ) . "," . make_safe( $r[ 'zip' ] ) . "</p>
                            <p>Phone: " . make_safe( $r[ 'phone' ] ) . "</p>
                            <p>Email: " . make_safe( $r[ 'email' ] ) . "</p>
                            <br/><br/>
                            
                            <hr/>
                            <h3>Order Details:</h3>
                            <hr/>
                            <p>Type: " . make_safe( $r[ 'type' ] ) . "</p>
                            <p>Speed: " . make_safe( $r[ 'speed' ] ) . "</p>
                            <p>Schedule Date: " . make_safe(date('m-d-y', strtotime($r['schedule_date']))) . "</p>
                            <p>Dropoff Date: " . make_safe(date('m-d-y', strtotime($r['dropoff_date']))) . "</p>
                            <p>Estimated Pickup Date: " . make_safe( date('m-d-y', strtotime($r['estimated_pickup']))) . "</p>
                            <br/>
                            <br/>
                            
                            <hr/>
                            <h3>Container Details:</h3>
                            <hr/>
                            <p>Name: " . make_safe( $r[ 'manufacturer' ] ) . " ".make_safe('model')."</p>
                            <p>Thank You!</p>
                            <p>--</p>
                            <p>Peregrine Manufacturing, Inc.</p>
                            </body>
                            </html>
                            ";
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $headers .= 'From: <admin@peregrinemfginc.com>' . "\r\n";
                            //mail( $to, $subject, $message, $headers );
                            
                            /*$data = array(
                                'repack_id'=> sf($_POST['repack_id']),
                		        'status' => sf($_POST['status']),
                		        'message' => $message,
                		        'query'=> $select
            		        );*/
    		    }
    		    
    		    echo json_encode(sf($_POST['status']));

		break;
		
?>