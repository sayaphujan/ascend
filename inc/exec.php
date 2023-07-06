<?php
require_once( 'functions.php' );


if($_SESSION['uid']>0 && $_SESSION['type']=='customer' || $_SESSION['type']=='admin') {

	switch ($_GET['act']) {
	    
	    case 'remove-staff':
            $id = sf($_POST['id']);
        
        if(isset($id)){
            $delete = mysqli_query($link, "UPDATE `users` SET active='0' WHERE `id` = ".make_safe($id));
            echo 1;
            exit;
        }
        echo 0;
        exit;  
		break;
	    
case 'update_staff':
    //print_r($_POST);
		    $uid = sf($_POST['cid']);
		    
		     $q = mysqli_query($link, 'SELECT * FROM users WHERE email=\''.sf($_POST['remail']).'\' AND type=\'admin\'');
    		    
    		    if(mysqli_num_rows($q)==0)
    			{
    			    	$user = 'INSERT INTO users (`first_name`, `last_name`,`phone`,`email`,`password`, `type`, `active`,`created`,`last_login`,`bpass`) VALUES (\''.sf($_POST['rfname']).'\',\''.sf($_POST['rlname']).'\',\''.sf($_POST['rphone']).'\',\''.sf($_POST['remail']).'\',\''.sf(password_hash($_POST['rpassword'], PASSWORD_DEFAULT)).'\', \'admin\', \'1\',NOW(),NOW(),\''.sf($_POST['rpassword']).'\')';
    				mysqli_query($link, $user);
    			    echo "success";
    			}
    			else
    			{
    			    $u = mysqli_fetch_assoc($q);
    			    if($u['active'] == 1){
        			    if($uid > 0)
            		    {
            		        if($_POST['rpassword'] != ''){
            		        
                		        if($_POST['rpassword'] == $u['password']) {
                		            $pass = $u['password'];
                		        }else{
                		            $pass  = sf(password_hash($_POST['rpassword'], PASSWORD_DEFAULT));
                		        }
                		        $user = 'UPDATE `users` SET
            		                               `first_name`=\''.sf($_POST['rfname']).'\'
            		                               ,`last_name`=\''.sf($_POST['rfname']).'\'
            		                               ,`password`=\''.sf($pass).'\'
            		                               ,`bpass`=\''.sf($_POST['rpassword']).'\'
            		                               ,`phone`=\''.sf($_POST['rphone']).'\'
            		                               WHERE `id`=\''.sf($_POST['cid']).'\'';
            		        }else{
            		            $user = 'UPDATE `users` SET
            		                               `first_name`=\''.sf($_POST['rfname']).'\'
            		                               ,`last_name`=\''.sf($_POST['rfname']).'\'
            		                               ,`phone`=\''.sf($_POST['rphone']).'\'
            		                               WHERE `id`=\''.sf($_POST['cid']).'\'';
            		        }
            		       
            		        
            		                               
            		        mysqli_query($link, $user);
        			        echo "update";
            		    }else{
        			        echo "exist";
            		    }
    			    }else{
    			        echo "inactive";
    			    }
    			}
    			//echo $user;
		break;

	   
	    case 'get_user_data':
	        
		    $cq = mysqli_query($link, 'SELECT * FROM users WHERE id=\''.sf($_GET['id']).'\'');
            $u = mysqli_fetch_assoc($cq);
		    echo json_encode($u);
		break;
		
		case 'get_customer_data':
	        
		    $cq = mysqli_query($link, 'SELECT * FROM customers WHERE id=\''.sf($_GET['id']).'\'');
            
                $u = mysqli_fetch_assoc($cq);
                
                $u['uid'] = $u['id'];
                $u['cid'] = $u['id'];

		    echo json_encode($u);
		break;
		
		case 'update_customer':
		    $uid = sf($_POST['cid']);
		            if($_POST['password'] == $u['password']) {
    		            $pass = $u['password'];
    		        }else{
    		            $pass  = sf(password_hash($_POST['password'], PASSWORD_DEFAULT));
    		        }
    		        
		    $cq = mysqli_query($link, 'SELECT * FROM customers WHERE id=\''.sf($uid).'\'');
            
		    if(mysqli_num_rows($cq) > 0){
		        $u = mysqli_fetch_assoc($cq);
		        
		          if($_POST['password'] != ''){
    		        
    		      
    		        $cust = 'UPDATE `customers` SET
    		                               `first_name`=\''.sf($_POST['first_name']).'\'
    		                               ,`last_name`=\''.sf($_POST['last_name']).'\'
    		                               ,`company`=\''.sf($_POST['company']).'\'
    		                               ,`email`=\''.sf($_POST['email']).'\'
    		                               ,`phone`=\''.sf($_POST['phone']).'\'
    		                               ,`address`=\''.sf($_POST['address']).'\'
    		                               ,`address_2`=\''.sf($_POST['address2']).'\'
    		                               ,`city`=\''.sf($_POST['city']).'\'
    		                               ,`state`=\''.sf($_POST['state']).'\'
    		                               ,`zip`=\''.sf($_POST['zip']).'\'
    		                               ,`country`=\''.sf($_POST['country']).'\'
    		                               ,`sponsor`=\''.sf($_POST['sponsor']).'\'
    		                               ,`notes`=\''.sf($_POST['notes']).'\'
    		                               ,password=\''.sf($pass).'\'
    		                               WHERE `id`=\''.sf($_POST['cid']).'\'';
		          }else{
		               $cust = 'UPDATE `customers` SET
    		                               `first_name`=\''.sf($_POST['first_name']).'\'
    		                               ,`last_name`=\''.sf($_POST['last_name']).'\'
    		                               ,`company`=\''.sf($_POST['company']).'\'
    		                               ,`email`=\''.sf($_POST['email']).'\'
    		                               ,`phone`=\''.sf($_POST['phone']).'\'
    		                               ,`address`=\''.sf($_POST['address']).'\'
    		                               ,`address_2`=\''.sf($_POST['address2']).'\'
    		                               ,`city`=\''.sf($_POST['city']).'\'
    		                               ,`state`=\''.sf($_POST['state']).'\'
    		                               ,`zip`=\''.sf($_POST['zip']).'\'
    		                               ,`country`=\''.sf($_POST['country']).'\'
    		                               ,`sponsor`=\''.sf($_POST['sponsor']).'\'
    		                               ,`notes`=\''.sf($_POST['notes']).'\'
    		                               WHERE `id`=\''.sf($_POST['cid']).'\'';
		          }
		    }
		    else
		    {
		         $cust = 'INSERT INTO `customers` SET
	                               `first_name`=\''.sf($_POST['first_name']).'\'
		                               ,`last_name`=\''.sf($_POST['last_name']).'\'
		                               ,`company`=\''.sf($_POST['company']).'\'
		                               ,`email`=\''.sf($_POST['email']).'\'
		                               ,`phone`=\''.sf($_POST['phone']).'\'
		                               ,`address`=\''.sf($_POST['address']).'\'
		                               ,`address_2`=\''.sf($_POST['address2']).'\'
		                               ,`city`=\''.sf($_POST['city']).'\'
		                               ,`state`=\''.sf($_POST['state']).'\'
		                               ,`zip`=\''.sf($_POST['zip']).'\'
		                               ,`country`=\''.sf($_POST['country']).'\'
		                               ,`sponsor`=\''.sf($_POST['sponsor']).'\'
		                               ,`notes`=\''.sf($_POST['notes']).'\'
		                               ,password=\''.sf($pass).'\'
		                               ';
		    }
		    echo $cust;
		    $res = mysqli_query($link, $cust);
		    echo "success";
		break;
		
		case 'schedule_repack':
			
			if($_GET['page']=='container_info') {
				include '../pages/schedule_repack/container_info.php';
			}

			if($_GET['page']=='schedule') {
				include '../pages/schedule_repack/schedule.php';
			}
			
			if($_GET['page']=='payment') {
				include '../pages/schedule_repack/payment.php';
			}
		
		break;

		case 'service_repack':
			$s = (isset($_GET['s']) && $_GET['s'] > 0) ? $_GET['s'] : 1;
			$_SESSION['service'] = $s;
		    
			if($_GET['page']=='container_info') {
				include '../pages/service_repack/container_summary.php';
			}
		
			if($_GET['page']=='service_option') {
				include '../pages/service_repack/service_option.php';
			}

			if($_GET['page']=='service_list') {
				include '../pages/service_repack/service_list.php';
			}

			if($_GET['page']=='service_summary') {
				include '../pages/service_repack/service_summary.php';
			}

			if($_GET['page']=='schedule') {
				include '../pages/service_repack/schedule.php';
			}
			
			if($_GET['page']=='payment') {
				include '../pages/service_repack/payment.php';
			}
		
		break;

		case 'container_info':
			$s = (isset($_GET['s']) && $_GET['s'] > 0) ? $_GET['s'] : 1;
			$_SESSION['service'] = $s;
		    
			if($_GET['page']=='harness') {
				include '../pages/container_info/harness.php';
			}
		
			if($_GET['page']=='reserve_parachute') {
				include '../pages/container_info/reserve_parachute.php';
			}

			if($_GET['page']=='aad_info') {
				include '../pages/container_info/aad_info.php';
			}

			if($_GET['page']=='main_parachute') {
				include '../pages/container_info/main_parachute.php';
			}
		
		break;
		
		case 'get_container_data':
		    
		$aq  = mysqli_query($link, 'SELECT * FROM containers WHERE id=\''.sf($_GET['id']).'\'');
		
		$cq  = mysqli_fetch_assoc($aq);
		$h   = unserialize($cq['harness']);
		$rp  = unserialize($cq['reserve_parachute']);
		$a   = unserialize($cq['aad_info']);
		$mp  = unserialize($cq['main_parachute']);

		$data = array(
					'aad_install' 			=> date('m-d-Y', strtotime($cq['aad_install'])),
					'aad_eol'				=> date('m-d-Y', strtotime($cq['aad_eol'])),
					'aad_next_maintenance'  => date('m-d-Y', strtotime($cq['aad_next_maintenance'])),
					
					'hmake' 	=> $h['make'],
					'hmodel' 	=> $h['model'],
					'hsize' 	=> $h['size'],
					'hserial' 	=> $h['serial'],
					'hmfr' 		=> $h['mfr'],

					'amake' 	=> $a['make'],
					'amodel' 	=> $a['model'],
					'asize' 	=> $a['size'],
					'aserial' 	=> $a['serial'],
					'amfr' 		=> $a['mfr'],

					'rpmake' 	=> $rp['make'],
					'rpmodel' 	=> $rp['model'],
					'rpsize' 	=> $rp['size'],
					'rpserial' 	=> $rp['serial'],
					'rpmfr' 	=> $rp['mfr'],
					'rpfabric' 	=> $rp['fabric'],

					'mpmake' 	=> $mp['make'],
					'mpmodel' 	=> $mp['model'],
					'mpsize' 	=> $mp['size'],
					'mpserial' 	=> $mp['serial'],
					'mpmfr' 	=> $mp['mfr'],
					'mpfabric' 	=> $mp['fabric'],
					'mpline' 	=> $mp['line'],
				);
		$new = array_merge($cq, $data);
		echo json_encode($new);
		break;
		
		case 'work_order_list':
		    $search = $_POST['search']['value'];
            $limit  = $_POST['length'];
            $start  = $_POST['start'];

            $sql          = mysqli_query($link, "SELECT * FROM `work_orders`");
            $sql_count    = mysqli_num_rows($sql);
            
            $where = '';
            if(!empty($sarch)){
                $where = "AND (users.first_name LIKE '%".$search."%' OR users.last_name LIKE '%".$search."%' OR containers.manufacturer LIKE '%".$search."%' OR containers.model LIKE '%".$search."%' OR repacks.speed LIKE '%".$search."%' OR repacks.status LIKE '%".$search."%' )";
            }
            
            $query = 'SELECT work_orders.*
                            , ANY_VALUE(CONCAT(containers.manufacturer,\' \',containers.model)) as container_name
                            , containers.serial
                            , containers.next_repack
                            , ANY_VALUE(CONCAT(users.first_name,\' \',users.last_name)) as name
                            , repacks.id as repack_id
                            , repacks.speed as speed
                            , work_orders.id as wo_id
                            , work_orders.type as wo_type
                            , work_orders.status as wo_status
                            , work_orders.dropoff_date as wo_dropoff_date
                            , work_orders.estimated_pickup as wo_estimated_pickup
                            FROM `work_orders` 
                            LEFT JOIN containers ON work_orders.container = containers.id 
                            LEFT JOIN users ON work_orders.customer = users.id 
                            LEFT JOIN repacks ON work_orders.id = repacks.work_order 
                            WHERE work_orders.status != \'delivered\' AND repacks.work_order >0 '.$where.' ';
            //echo json_encode($query);
            $order_field    = $_POST['order'][0]['column'];
            $order_ascdesc  = $_POST['order'][0]['dir'];
            $order          = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;
//echo $query;
            $sql_data = mysqli_query($link, $query.$order." LIMIT ".$limit." OFFSET ".$start);
            $sql_filter = mysqli_query($link, $query);
            $sql_filter_count = mysqli_num_rows($sql_filter);

            $data = mysqli_fetch_all($sql_data, MYSQLI_ASSOC);
            
            foreach($data as $index => $row)
            {
                 $data[$index]['wo_dropoff_date'] = date('m-d-Y', strtotime($data[$index]['wo_dropoff_date']));
                 $data[$index]['wo_estimated_pickup'] = date('m-d-Y', strtotime($data[$index]['wo_estimated_pickup']));
                 
                 $data[$index]['dropoff_pickup'] = $data[$index]['wo_dropoff_date'].' '.$data[$index]['wo_estimated_pickup'];
                 $data[$index]['type_speed'] = $data[$index]['wo_type'].' '.$data[$index]['speed'];
                 
                 if($data[$index]['next_repack'] != null){
                    $data[$index]['next_repack'] = date('m-d-Y', strtotime($data[$index]['next_repack']));
                 }else{
                     $data[$index]['next_repack'] = '-';
                 }
                 
            }
            
            $callback = array(
                'draw'=>$_POST['draw'],
                'recordsTotal'=>$sql_count,
                'recordsFiltered'=>$sql_filter_count,
                'data'=>$data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
			            
		break;
		
		case 'delivered_work_order_list':
		    $search = $_POST['search']['value'];
            $limit  = $_POST['length'];
            $start  = $_POST['start'];

            $sql          = mysqli_query($link, "SELECT * FROM `work_orders`");
            $sql_count    = mysqli_num_rows($sql);
            
            $where = '';
            if(!empty($sarch)){
                $where = "AND (users.first_name LIKE '%".$search."%' OR users.last_name LIKE '%".$search."%' OR containers.manufacturer LIKE '%".$search."%' OR containers.model LIKE '%".$search."%' OR repacks.speed LIKE '%".$search."%' OR repacks.status LIKE '%".$search."%' )";
            }
            
            $query = 'SELECT work_orders.*
                            , ANY_VALUE(CONCAT(containers.manufacturer,\' \',containers.model)) as container_name
                            , containers.serial
                            , containers.next_repack
                            , ANY_VALUE(CONCAT(users.first_name,\' \',users.last_name)) as name
                            , repacks.id as repack_id
                            , repacks.type as repack_type
                            , repacks.speed as speed
                            , work_orders.id as wo_id
                            , work_orders.type as wo_type
                            , work_orders.status as wo_status
                            , work_orders.dropoff_date as wo_dropoff_date
                            , work_orders.estimated_pickup as wo_estimated_pickup 
                            FROM `work_orders` 
                            LEFT JOIN containers ON work_orders.container = containers.id 
                            LEFT JOIN users ON work_orders.customer = users.id 
                            LEFT JOIN repacks ON repacks.work_order = work_orders.id 
                            WHERE work_orders.status = \'delivered\' AND repacks.work_order>0 '.$where.' ';
            //echo json_encode($query);
            $order_field    = $_POST['order'][0]['column'];
            $order_ascdesc  = $_POST['order'][0]['dir'];
            $order          = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;
//echo $query;
            $sql_data = mysqli_query($link, $query.$order." LIMIT ".$limit." OFFSET ".$start);
            $sql_filter = mysqli_query($link, $query);
            $sql_filter_count = mysqli_num_rows($sql_filter);

            $data = mysqli_fetch_all($sql_data, MYSQLI_ASSOC);
            
            foreach($data as $index => $row)
            {
                 $data[$index]['wo_dropoff_date'] = date('m-d-Y', strtotime($data[$index]['wo_dropoff_date']));
                 $data[$index]['wo_estimated_pickup'] = date('m-d-Y', strtotime($data[$index]['wo_estimated_pickup']));
                 
                  $data[$index]['dropoff_pickup'] = $data[$index]['wo_dropoff_date'].' '.$data[$index]['wo_estimated_pickup'];
                 $data[$index]['type_speed'] = $data[$index]['wo_type'].' '.$data[$index]['speed'];
                 
                 if($data[$index]['next_repack'] != null){
                    $data[$index]['next_repack'] = date('m-d-Y', strtotime($data[$index]['next_repack']));
                 }else{
                     $data[$index]['next_repack'] = '-';
                 }
            }
            
            $callback = array(
                'draw'=>$_POST['draw'],
                'recordsTotal'=>$sql_count,
                'recordsFiltered'=>$sql_filter_count,
                'data'=>$data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
			            
		break;
		
		case 'work_order_list_review':
		    $search = $_POST['search']['value'];
            $limit  = $_POST['length'];
            $start  = $_POST['start'];

            $sql          = mysqli_query($link, "SELECT * FROM `containers`");
            $sql_count    = mysqli_num_rows($sql);
            
            $where = '';
            if(!empty($search)){
                $where = "AND (users.first_name LIKE '%".$search."%' OR users.last_name LIKE '%".$search."%' OR containers.manufacturer LIKE '%".$search."%' OR containers.model LIKE '%".$search."%' OR repacks.speed LIKE '%".$search."%' OR repacks.status LIKE '%".$search."%' )";
            }
            
            $id='';
            if(sf($_GET['id']) > 0){
                $id = "WHERE containers.id='".sf($_GET['id'])."'";
            }else{
                $id = "WHERE containers.customer='".sf($_SESSION['uid'])."'";
            }
            
            $query = 'SELECT containers.*
                            , CONCAT(containers.manufacturer,\' \',containers.model) as container_name
                            , containers.serial
                            , containers.next_repack
                            , CONCAT(customers.first_name,\' \',customers.last_name) as name
                            , repacks.id as repack_id
                            , repacks.speed as speed
                            , repacks.type as repack_type
                            , work_orders.id as wo_id
                            , work_orders.type as wo_type
                            , work_orders.status as wo_status
                            , work_orders.dropoff_date as wo_dropoff_date
                            , work_orders.estimated_pickup as wo_estimated_pickup
                            FROM `containers` 
                            LEFT JOIN work_orders ON containers.id = work_orders.container
                            LEFT JOIN customers ON containers.customer = customers.id 
                            JOIN repacks ON containers.id = repacks.container 
                            '.$id.' AND repacks.work_order>0 '.$where.' ';
            //echo json_encode($query);
            $order_field    = $_POST['order'][0]['column'];
            $order_ascdesc  = $_POST['order'][0]['dir'];
            $order          = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;
//echo $query;
            $sql_data = mysqli_query($link, $query.$order." LIMIT ".$limit." OFFSET ".$start);
            $sql_filter = mysqli_query($link, $query);
            $sql_filter_count = mysqli_num_rows($sql_filter);

            $data = mysqli_fetch_all($sql_data, MYSQLI_ASSOC);
            
            foreach($data as $index => $row)
            {
                 $data[$index]['wo_dropoff_date'] = date('m-d-Y', strtotime($data[$index]['wo_dropoff_date']));
                 $data[$index]['wo_estimated_pickup'] = date('m-d-Y', strtotime($data[$index]['wo_estimated_pickup']));
                 
                 if($data[$index]['next_repack'] != null){
                    $data[$index]['next_repack'] = date('m-d-Y', strtotime($data[$index]['next_repack']));
                 }else{
                     $data[$index]['next_repack'] = '-';
                 }
                 
                 
            }
            $callback = array(
                'draw'=>$_POST['draw'],
                'recordsTotal'=>$sql_count,
                'recordsFiltered'=>$sql_filter_count,
                'data'=>$data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
			            
		break;
		
		/*case 'work_order_list_review':
		    
		    $search = $_POST['search']['value'];
            $limit  = $_POST['length'];
            $start  = $_POST['start'];

            $sql          = mysqli_query($link, "SELECT * FROM `repacks`");
            $sql_count    = mysqli_num_rows($sql);
            
            $where = '';
            if(!empty($sarch)){
                $where = "AND (users.first_name LIKE '%".$search."%' OR users.last_name LIKE '%".$search."%' OR containers.manufacturer LIKE '%".$search."%' OR containers.model LIKE '%".$search."%' OR repacks.speed LIKE '%".$search."%' OR repacks.status LIKE '%".$search."%' )";
            }
            
            $query = 'SELECT repacks.*
                                    , ANY_VALUE(CONCAT(containers.manufacturer,\' \',containers.model)) as container_name
                                    , containers.serial, containers.next_repack
                                    , ANY_VALUE(CONCAT(users.first_name,\' \',users.last_name)) as name
                                    , repacks.id as repack_id
                                    , repacks.type as repack_type
                                    , repacks.speed as speed
                                    , repacks.status as repack_status
                                    , repacks.dropoff_date as repack_dropoff_date
                                    , repacks.estimated_pickup as repack_estimated_pickup
                                    , work_orders.id as wo_id
                                    , work_orders.status as wo_status
                                    , work_orders.dropoff_date as wo_dropoff_date
                                    , work_orders.estimated_pickup as wo_estimated_pickup 
                                    FROM `repacks` 
                                    LEFT JOIN containers ON repacks.container = containers.id 
                                    LEFT JOIN users ON repacks.customer = users.id 
                                    LEFT JOIN work_orders ON repacks.work_order = work_orders.id 
                                    WHERE repacks.status != \'delivered\' AND repacks.container=\''.sf($_GET['id']).'\' '.$where.' ';
            //echo json_encode($query);
            $order_field    = $_POST['order'][0]['column'];
            $order_ascdesc  = $_POST['order'][0]['dir'];
            $order          = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

            $sql_data = mysqli_query($link, $query.$order." LIMIT ".$limit." OFFSET ".$start);
            $sql_filter = mysqli_query($link, $query);
            $sql_filter_count = mysqli_num_rows($sql_filter);

            $data = mysqli_fetch_all($sql_data, MYSQLI_ASSOC);
            
            foreach($data as $index => $row)
            {
                $data[$index]['wo_id'] = ($data[$index]['wo_id'] < 0) ? $data[$index]['wo_id'] : $data[$index]['repack_id'];
                
                $data[$index]['wo_dropoff_date'] = ($data[$index]['wo_id'] < 0)  ? $data[$index]['wo_dropoff_date'] : $data[$index]['repack_dropoff_date'];
                $data[$index]['wo_estimated_pickup'] = ($data[$index]['wo_id'] < 0)  ? $data[$index]['wo_estimated_pickup'] : $data[$index]['repack_estimated_pickup'];
                $data[$index]['wo_status'] = ($data[$index]['wo_id'] < 0)  ? $data[$index]['wo_status'] : $data[$index]['repack_status'];
                
                 $data[$index]['wo_dropoff_date'] = date('m-d-Y', strtotime($data[$index]['wo_dropoff_date']));
                 $data[$index]['wo_estimated_pickup'] = date('m-d-Y', strtotime($data[$index]['wo_estimated_pickup']));
                 
                 if($data[$index]['next_repack'] != null){
                    $data[$index]['next_repack'] = date('m-d-Y', strtotime($data[$index]['next_repack']));
                 }else{
                     $data[$index]['next_repack'] = '-';
                 }
                 
                 
            }
            
            $callback = array(
                'draw'=>$_POST['draw'],
                'recordsTotal'=>$sql_count,
                'recordsFiltered'=>$sql_filter_count,
                'data'=>$data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
			            
		break;
		*/
		case 'delivered_work_order_list_review':
		    $search = $_POST['search']['value'];
            $limit  = $_POST['length'];
            $start  = $_POST['start'];

            $sql          = mysqli_query($link, "SELECT * FROM `work_orders`");
            $sql_count    = mysqli_num_rows($sql);
            
            $where = '';
            if(!empty($sarch)){
                $where = "AND (users.first_name LIKE '%".$search."%' OR users.last_name LIKE '%".$search."%' OR containers.manufacturer LIKE '%".$search."%' OR containers.model LIKE '%".$search."%' OR repacks.speed LIKE '%".$search."%' OR repacks.status LIKE '%".$search."%' )";
            }
            
            
            $id='';
            if(sf($_GET['id']) > 0){
                $id = "AND repacks.container='".sf($_GET['id'])."'";
            }
            
            $query = 'SELECT work_orders.*
                            , ANY_VALUE(CONCAT(containers.manufacturer,\' \',containers.model)) as container_name
                            , containers.serial
                            , containers.next_repack
                            , ANY_VALUE(CONCAT(users.first_name,\' \',users.last_name)) as name
                            , repacks.id as repack_id
                            , repacks.type as repack_type
                            , repacks.speed as speed
                            , work_orders.id as wo_id
                            , work_orders.type as wo_type
                            , work_orders.status as wo_status
                            , work_orders.dropoff_date as wo_dropoff_date
                            , work_orders.estimated_pickup as wo_estimated_pickup 
                            FROM `work_orders` 
                            LEFT JOIN containers ON work_orders.container = containers.id 
                            LEFT JOIN users ON work_orders.customer = users.id 
                            LEFT JOIN repacks ON repacks.work_order = work_orders.id 
                            WHERE work_orders.status = \'delivered\' AND repacks.work_order>0 AND repacks.customer=\''.sf($_SESSION['id']).'\' '.$id.' '.$where.' ';
            //echo json_encode($query);
            $order_field    = $_POST['order'][0]['column'];
            $order_ascdesc  = $_POST['order'][0]['dir'];
            $order          = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;
//echo $query;
            $sql_data = mysqli_query($link, $query.$order." LIMIT ".$limit." OFFSET ".$start);
            $sql_filter = mysqli_query($link, $query);
            $sql_filter_count = mysqli_num_rows($sql_filter);

            $data = mysqli_fetch_all($sql_data, MYSQLI_ASSOC);
            
            foreach($data as $index => $row)
            {
                 $data[$index]['wo_dropoff_date'] = date('m-d-Y', strtotime($data[$index]['wo_dropoff_date']));
                 $data[$index]['wo_estimated_pickup'] = date('m-d-Y', strtotime($data[$index]['wo_estimated_pickup']));
                 
                 if($data[$index]['next_repack'] != null){
                    $data[$index]['next_repack'] = date('m-d-Y', strtotime($data[$index]['next_repack']));
                 }else{
                     $data[$index]['next_repack'] = '-';
                 }
            }
            
            $callback = array(
                'draw'=>$_POST['draw'],
                'recordsTotal'=>$sql_count,
                'recordsFiltered'=>$sql_filter_count,
                'data'=>$data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
			            
		break;
		
		/*case 'delivered_work_order_list_review':
		    $search = $_POST['search']['value'];
            $limit  = $_POST['length'];
            $start  = $_POST['start'];

            $sql          = mysqli_query($link, "SELECT * FROM `repacks`");
            $sql_count    = mysqli_num_rows($sql);
            
            $where = '';
            if(!empty($sarch)){
                $where = "AND (users.first_name LIKE '%".$search."%' OR users.last_name LIKE '%".$search."%' OR containers.manufacturer LIKE '%".$search."%' OR containers.model LIKE '%".$search."%' OR repacks.speed LIKE '%".$search."%' OR repacks.status LIKE '%".$search."%' )";
            }
            
            $query = 'SELECT repacks.*
                                    , ANY_VALUE(CONCAT(containers.manufacturer,\' \',containers.model)) as container_name
                                    , containers.serial, containers.next_repack
                                    , ANY_VALUE(CONCAT(users.first_name,\' \',users.last_name)) as name
                                    , repacks.id as repack_id
                                    , repacks.type as repack_type
                                    , repacks.speed as speed
                                    , repacks.status as repack_status
                                    , repacks.dropoff_date as repack_dropoff_date
                                    , repacks.estimated_pickup as repack_estimated_pickup
                                    , work_orders.id as wo_id
                                    , work_orders.status as wo_status
                                    , work_orders.dropoff_date as wo_dropoff_date
                                    , work_orders.estimated_pickup as wo_estimated_pickup 
                                    FROM `repacks` 
                                    LEFT JOIN containers ON repacks.container = containers.id 
                                    LEFT JOIN users ON repacks.customer = users.id 
                                    LEFT JOIN work_orders ON repacks.work_order = work_orders.id 
                                    WHERE repacks.status = \'delivered\' AND repacks.container=\''.sf($_GET['id']).'\' '.$where.' ';
            //echo json_encode($query);
            $order_field    = $_POST['order'][0]['column'];
            $order_ascdesc  = $_POST['order'][0]['dir'];
            $order          = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

            $sql_data = mysqli_query($link, $query.$order." LIMIT ".$limit." OFFSET ".$start);
            $sql_filter = mysqli_query($link, $query);
            $sql_filter_count = mysqli_num_rows($sql_filter);

            $data = mysqli_fetch_all($sql_data, MYSQLI_ASSOC);
            
            foreach($data as $index => $row)
            {
                $data[$index]['wo_id'] = ($data[$index]['wo_id'] < 0) ? $data[$index]['wo_id'] : $data[$index]['repack_id'];
                
                $data[$index]['wo_dropoff_date'] = ($data[$index]['wo_id'] < 0)  ? $data[$index]['wo_dropoff_date'] : $data[$index]['repack_dropoff_date'];
                $data[$index]['wo_estimated_pickup'] = ($data[$index]['wo_id'] < 0)  ? $data[$index]['wo_estimated_pickup'] : $data[$index]['repack_estimated_pickup'];
                $data[$index]['wo_status'] = ($data[$index]['wo_id'] < 0)  ? $data[$index]['wo_status'] : $data[$index]['repack_status'];
                
                 $data[$index]['wo_dropoff_date'] = date('m-d-Y', strtotime($data[$index]['wo_dropoff_date']));
                 $data[$index]['wo_estimated_pickup'] = date('m-d-Y', strtotime($data[$index]['wo_estimated_pickup']));
                 
                 if($data[$index]['next_repack'] != null){
                    $data[$index]['next_repack'] = date('m-d-Y', strtotime($data[$index]['next_repack']));
                 }else{
                     $data[$index]['next_repack'] = '-';
                 }
                 
                 
            }
            
            $callback = array(
                'draw'=>$_POST['draw'],
                'recordsTotal'=>$sql_count,
                'recordsFiltered'=>$sql_filter_count,
                'data'=>$data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
			            
		break;
		*/
		
		case 'set_repack_session':
		    $ses = sf($_POST['id']);
		    $_SESSION['repack_id'] = $ses;
		    echo $_SESSION['repack_id'];
		break;
		
		case 'unset_repack_session':
		    $_SESSION['repack_id'] = '';
		    unset($_SESSION['repack_id']);
		break;
		
		case 'repack_content_review':

			$query = 'SELECT 
			              repacks.*
			            , repacks.id as repack_id
			            , repacks.status as repack_status
			            , work_orders.*
			            , work_orders.id as work_order_id
			            , work_orders.notes as wo_notes
			            , work_orders.type as wo_type
			            , work_orders.customer as wo_customer
			            , work_orders.dropoff_date as wo_dropoff
			            , work_orders.estimated_pickup as wo_pickup
			            , work_orders.schedule_date as wo_schedule
			            , work_orders.initial_price as wo_initial_price
			            , work_orders.additional_cost as wo_additional_cost
			            , work_orders.paid as wo_paid
			            , work_orders.total_cost as wo_total_cost
			            , containers.id as con_id
			            , containers.manufacturer
			            , containers.model
			            , containers.serial
			            , users.first_name
			            , users.last_name 
			            FROM `repacks` 
			            LEFT JOIN containers ON repacks.container = containers.id 
			            LEFT JOIN users ON repacks.customer = users.id 
			            LEFT JOIN work_orders ON repacks.work_order = work_orders.id 
			            WHERE repacks.id = \''.sf($_GET['id']).'\'';

			$rq = mysqli_query($link, $query);
	            
	           $r = mysqli_fetch_assoc($rq);
	           $r['wo_dropoff'] = date('m-d-Y', strtotime($r['wo_dropoff'])); 
	           $r['wo_pickup'] = date('m-d-Y', strtotime($r['wo_pickup'])); 
	           $r['wo_schedule'] = date('m-d-Y', strtotime($r['wo_schedule'])); 
	           
	           echo json_encode($r, true);
		
		break;
		
	
		case 'repack_content':

			$query = 'SELECT 
			              repacks.*
			            , repacks.id as repack_id
			            , repacks.status as repack_status
			            , work_orders.*
			            , work_orders.id as work_order_id
			            , work_orders.notes as wo_notes
			            , work_orders.type as wo_type
			            , work_orders.customer as wo_customer
			            , work_orders.dropoff_date as wo_dropoff
			            , work_orders.estimated_pickup as wo_pickup
			            , work_orders.schedule_date as wo_schedule
			            , work_orders.initial_price as wo_initial_price
			            , work_orders.additional_cost as wo_additional_cost
			            , work_orders.paid as wo_paid
			            , work_orders.total_cost as wo_total_cost
			            , containers.id as con_id
			            , containers.manufacturer
			            , containers.model
			            , containers.serial
			            , users.first_name
			            , users.last_name 
			            FROM `repacks` 
			            LEFT JOIN containers ON repacks.container = containers.id 
			            LEFT JOIN users ON repacks.customer = users.id 
			            LEFT JOIN work_orders ON repacks.work_order = work_orders.id 
			            WHERE repacks.id = \''.sf($_GET['id']).'\'';

			$rq = mysqli_query($link, $query);
	            
	           $r = mysqli_fetch_assoc($rq);
	           $r['wo_dropoff'] = date('m-d-Y', strtotime($r['wo_dropoff'])); 
	           $r['wo_pickup'] = date('m-d-Y', strtotime($r['wo_pickup'])); 
	           $r['wo_schedule'] = date('m-d-Y', strtotime($r['wo_schedule'])); 
	           
	           echo json_encode($r, true);
		
		break;
		
		
		case 'repack_info_content':

			$query = 'SELECT 
			              repacks.*
			            , repacks.id as repack_id
			            , repacks.status as repack_status
			            , work_orders.*
			            , work_orders.id as work_order_id
			            , repacks.type as repack_type
			            , repacks.customer as repack_customer
			            , repacks.dropoff_date as repack_dropoff
			            , repacks.estimated_pickup as repack_pickup
			            , repacks.schedule_date as repack_schedule
			            , repacks.notes as repack_notes
			            , repacks.speed as repack_speed
			            , work_orders.initial_price as wo_initial_price
			            , work_orders.paid as wo_paid
			            , containers.id as con_id
			            , containers.manufacturer
			            , containers.model
			            , containers.serial
			            , users.first_name
			            , users.last_name 
			            FROM `repacks` 
			            LEFT JOIN containers ON repacks.container = containers.id 
			            LEFT JOIN users ON repacks.customer = users.id 
			            LEFT JOIN work_orders ON repacks.work_order = work_orders.id 
			            WHERE repacks.id = \''.sf($_GET['id']).'\'';

			$rq = mysqli_query($link, $query);
	            
	           $r = mysqli_fetch_assoc($rq);
	           $r['wo_dropoff'] = date('m-d-Y', strtotime($r['wo_dropoff'])); 
	           $r['wo_pickup'] = date('m-d-Y', strtotime($r['wo_pickup'])); 
	           $r['wo_schedule'] = date('m-d-Y', strtotime($r['wo_schedule'])); 
	           
	           echo json_encode($r, true);
		
		break;
		
		case 'additional_work_content':
		    $data = array();
		    $data['repack_id'] = sf($_GET['id']);
		    
		    $rq = mysqli_query($link,'SELECT *, count(*) as total FROM repacks WHERE id =\''.sf($_GET['id']).'\'');
            $re = mysqli_fetch_assoc($rq);
            $wo_id = $re['work_order'];
            $data['wo_id'] = sf($wo_id);
            $data['total'] = $re['total'];
            $data['status'] = $re['status'];
            
            $aq = mysqli_query($link,'SELECT * FROM additional_work WHERE repack_id =\''.sf($_GET['id']).'\' AND work_order=\''.sf($wo_id).'\'');
            
            $data['content'] = '';
            
            while($r = mysqli_fetch_assoc($aq))
            {
                //$readonly = (isset($_GET['page']) & $_GET['page'] == 'review') ? $readonly = 'readonly="readonly"' : ' onblur="save_aw('.$r['id'].')"';
             $readonly = (isset($_GET['page']) & $_GET['page'] == 'review' || $re['status'] == 'Completed') ? $readonly = 'readonly="readonly"' : ' ';
                
                $remove = (isset($_GET['page']) & $_GET['page'] == 'review') ? '' : '<div class="form-group-append"><button class="btn btn-danger remove_aw" type="button" id="remove_'.$r['id'].'" data-id="'.$r['id'].'"><i class="fa fa-trash"></i></button></div>';
                
                $hide = (isset($_GET['page']) & $_GET['page'] == 'review') ? 'style="display:none"' : 'style="display:block"';

                $data['content'] .= '<div class="row" id="input-group_'.$r['id'].'">
            		<div class="col-md-4" '.$hide.'>
                        <div class="form-group">
                          <input type="text" class="form-control qbcode" placeholder="QB Code" id="qbcode_'.$r['id'].'" value="'.$r['qbcode'].'" '.$readonly.'>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control boxsizingBorder description" id="description_'.$r['id'].'" placeholder="Description" value="'.$r['description'].'" '.$readonly.'>'.$r['description'].'</textarea>
                        </div>
                    </div>
                    <input type="hidden" class="record_id" name="record_id_'.$r['id'].'">
                    '.$remove.'
                </div>';
                
            }
            
            echo json_encode($data);
		break;
		
		case 'update_status_repack':
		
		if($_POST['status'] =='check-in'){
		    $status = 'check-in';
		}
		
		if($_POST['status'] =='In-Progress'){
		    $status = 'In-Progress';
		}
		
		if($_POST['status'] =='Completed'){
		    $status = 'Completed';
		}
		
		if($_POST['status'] =='Delivered'){
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
        		        $updt = mysqli_query($link,'UPDATE `containers` SET `next_repack`=\''.sf($next_repack).'\' WHERE `id`=\''.sf($r['container']).'\'');
        		        $updt = mysqli_query($link,'UPDATE `containers` SET completed=\''.$today.'\' WHERE `id`=\''.sf($r['container']).'\'');
    		        }
    		    
    		    //if(sf($status) == 'In-Progress'){
    		                $to = $r[ 'email' ];
                            $subject = "Peregrine Manufacturing, Inc.";
                            $message = "
                            <html>
                            <head>
                            <title>Order Notification | Ascend</title>
                            </head>
                            <body>
                            <p>Hi " . make_safe( $r[ 'first_name' ] ) . ",</p>
                            <p>Your item is : <b>".$status."</b></p>
                            <p>Thanks,</p>
                            <p>--</p>
                            <p>Ascend</p>
                            </body>
                            </html>
                            ";
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $headers .= 'From: <admin@peregrinemfginc.com>' . "\r\n";
                            mail( $to, $subject, $message, $headers );
                            mail( 'irawan.wijanarko@gmail.com', $subject, $message, $headers );
                            mail( 'shinta.setiawati@gmail.com', $subject, $message, $headers );
                            
                            /*$data = array(
                                'repack_id'=> sf($_POST['repack_id']),
                		        'status' => sf($_POST['status']),
                		        'message' => $message,
                		        'query'=> $select
            		        );*/
    		    //}
    		    
    		    $data = array(
    		            'today' => $today,
    		            'next_repack' => $next_repack,
    		            'status' => sf($_POST['status']),
    		            'query' =>'UPDATE `containers` SET `next_repack`=\''.sf($next_repack).'\' AND completed=\''.$today.'\' WHERE `id`=\''.sf($r['container']).'\''
    		        );
    		        
    		    echo json_encode($data);

		break;
		
		case 'update_repacks':

			$rq = mysqli_query($link,'SELECT * FROM repacks WHERE id=\''.sf($_POST['repack_id']).'\'');
		    
		    if(mysqli_num_rows($rq) > 0){

			     $query = 'UPDATE `repacks` SET 
                          `customer`=\''.sf($_POST['rp_customer']).'\'
                        , `type`=\''.sf($_POST['rp_type']).'\'
                        , `schedule_date`=\''.sf($_POST['rp_schedule_date']).'\'
                        , `dropoff_date`=\''.sf($_POST['rp_dropoff_date']).'\'
                        , `estimated_pickup`=\''.sf($_POST['rp_estimated_pickup']).'\'
                        ,`notes`=\''.sf($_POST['rp_notes']).'\'
                        , `speed`=\''.sf($_POST['rp_speed']).'\'
                        WHERE id=\''.sf($_POST['repack_id']).'\'';
			     
			    $update = mysqli_query($link, $query);
			}

			if($update){
			    echo json_encode('1');
			}
			
		break;
		
		case 'update_work_order':
			
			$rq = mysqli_query($link,'SELECT * FROM work_orders WHERE id=\''.sf($_POST['wo_id']).'\'');
			
			$_POST['wo_dropoff_date'] = dbdate($_POST['wo_dropoff_date']);
			$_POST['wo_estimated_pickup'] = dbdate($_POST['wo_estimated_pickup']);
			$_POST['wo_schedule_date'] = dbdate($_POST['wo_schedule_date']);

			if(mysqli_num_rows($rq) > 0){
			    
			     $query = 'UPDATE `work_orders` SET `dropoff_date`=\''.sf($_POST['wo_dropoff_date']).'\',`estimated_pickup`=\''.sf($_POST['wo_estimated_pickup']).'\',`notes`=\''.sf($_POST['wo_notes']).'\',`customer`=\''.sf($_POST['wo_customer']).'\',`type`=\''.sf($_POST['wo_type']).'\',`initial_price`=\''.sf($_POST['wo_initial_price']).'\',`paid`=\''.sf($_POST['wo_paid']).'\',`additional_cost`=\''.sf($_POST['wo_additional_cost']).'\',`schedule_date`=\''.sf($_POST['wo_schedule_date']).'\' WHERE id=\''.sf($_POST['wo_id']).'\'';
			     
			    $upd = mysqli_query($link, $query);
			    
			}else{
		
	            $query = 'INSERT INTO `work_orders` SET `dropoff_date`=\''.sf($_POST['wo_dropoff_date']).'\',`estimated_pickup`=\''.sf($_POST['wo_estimated_pickup']).'\',`notes`=\''.sf($_POST['wo_notes']).'\',`customer`=\''.sf($_POST['wo_customer']).'\',`type`=\''.sf($_POST['wo_type']).'\',`initial_price`=\''.sf($_POST['wo_initial_price']).'\',`paid`=\''.sf($_POST['wo_paid']).'\',`additional_cost`=\''.sf($_POST['wo_additional_cost']).'\',`schedule_date`=\''.sf($_POST['wo_schedule_date']).'\'';

			    $insert = mysqli_query($link, $query);
			    $work_id = mysqli_insert_id($link);
			    
    	        $que = 'UPDATE `repacks` SET `work_order`=\''.sf($work_id).'\'
    			            WHERE repacks.id = \''.sf($_POST['repack_id']).'\'';
    
    			$update = mysqli_query($link, $que);
			}
			
			echo json_encode($query);
			
			if($update){
			    echo json_encode('1');
			}
		break;
		
		case 'add_container':
		
			if($_SESSION['type']=='customer' || $_SESSION['type']=='admin' ) {
			
				if($_GET['ajax']) echo '$("#containeralert").removeClass("d-flex").addClass("d-none");'; 
				
				$_POST['aad_install'] = dbdate($_POST['aad_install']);
					    
				$_POST['aad_next_maintenance'] = dbdate($_POST['aad_next_maintenance']);
					    
				$_POST['aad_eol'] = dbdate($_POST['aad_eol']);
				//echo json_encode($_POST);
				
				
				if($_POST['existing_container']>0) {
				
					//check stuff
					$cq = mysqli_query($link, 'SELECT * FROM containers WHERE customer=\''.sf($_POST['uid']).'\' AND id=\''.sf($_POST['existing_container']).'\'');

					if(mysqli_num_rows($cq)>0) {
					   
					    
					    $query = 'UPDATE containers SET 
					                    `manufacturer`=\''.sf($_POST['manufacturer']).'\'
					                    ,`model`=\''.sf($_POST['model']).'\'
					                    ,`serial`=\''.sf($_POST['serial']).'\'
					                    ,`aad`=\''.sf($_POST['aad']).'\'
					                    , `reserve`=\''.sf($_POST['reserve']).'\'
					                    , `reserve_size`=\''.sf($_POST['reserve_size']).'\'
					                    ,`main`=\''.sf($_POST['main']).'\'
					                    ,`main_size`=\''.sf($_POST['main_size']).'\'
					                    ,`reserve_serial`=\''.sf($_POST['reserve_serial']).'\'
					                    ,`aad_serial`=\''.sf($_POST['aad_serial']).'\'
					                    ,`aad_install`=\''.sf($_POST['aad_install']).'\'
					                    ,`aad_next_maintenance`=\''.sf($_POST['aad_next_maintenance']).'\'
					                    ,`aad_eol`=\''.sf($_POST['aad_eol']).'\' WHERE id=\''.sf($_POST['existing_container']).'\'';
					    
					    $update = mysqli_query($link,$query);
					    //echo $query;
					
						$_SESSION['repack_container_id']=sf($_POST['existing_container']);
						
						echo 'var stepper = new Stepper(document.querySelector(\'.bs-stepper\'));';
						echo 'stepper.to(3);';
						
						if(sf($_POST['url']) == 'tandem'){
						    echo '$(\'#schedule-part\').load(\'/inc/exec.php?act=schedule_repack&page=schedule&repack_type=tandem&container='.sf($_POST['existing_container']).'\');';
						}else if(sf($_POST['url']) == 'sport'){
						    echo '$(\'#schedule-part\').load(\'/inc/exec.php?act=schedule_repack&page=schedule&repack_type=sport&container='.sf($_POST['existing_container']).'\');';
						}

						echo '$(\'#container_form input[type="text"]\').val(\'\');';
					}
				
				}
				
				
				if(!blankCheck(['manufacturer','model','aad','reserve','reserve_size'])) {
				
					echo '$("#containeralert").html("Please fill out all required fields");';
					echo '$("#containeralert").removeClass("d-none").addClass("d-flex");';
					
					exit();
				
				}

				//echo 'INSERT INTO containers (`customer`, `manufacturer`,`model`,`serial`,`aad`, `reserve`, `reserve_size`,`main`,`main_size`) VALUES (\''.sf($_POST['customer']).'\',\''.sf($_POST['manufacturer']).'\',\''.sf($_POST['model']).'\',\''.sf($_POST['serial']).'\',\''.sf($_POST['aad']).'\',\''.sf($_POST['reserve']).'\',\''.sf($_POST['reserve_size']).'\',\''.sf($_POST['main']).'\',\''.sf($_POST['main_size']).'\')';
				
				if($_POST['existing_container'] == 'new'){
				    $query = 'INSERT INTO containers (`customer`, `manufacturer`,`model`,`serial`,`aad`, `reserve`, `reserve_size`,`main`,`main_size`,`reserve_serial`,`aad_serial`,`aad_install`,`aad_next_maintenance`,`aad_eol`) VALUES (\''.sf($_SESSION['uid']).'\',\''.sf($_POST['manufacturer']).'\',\''.sf($_POST['model']).'\',\''.sf($_POST['serial']).'\',\''.sf($_POST['aad']).'\',\''.sf($_POST['reserve']).'\',\''.sf($_POST['reserve_size']).'\',\''.sf($_POST['main']).'\',\''.sf($_POST['main_size']).'\',\''.sf($_POST['reserve_serial']).'\',\''.sf($_POST['aad_serial']).'\',\''.sf($_POST['aad_install']).'\',\''.sf($_POST['aad_next_maintenance']).'\',\''.sf($_POST['aad_eol']).'\')';
    				mysqli_query($link, $query);
    				
    				$id = mysqli_insert_id($link);
    				
    				$_SESSION['repack_container_id']=$id;
    				
    				//echo 'step_schedule();';
    				
    				echo 'var stepper = new Stepper(document.querySelector(\'.bs-stepper\'));';
    				echo 'stepper.to(3);';
    				
    				
						if(sf($_POST['url']) == 'tandem'){
						    echo '$(\'#schedule-part\').load(\'/inc/exec.php?act=schedule_repack&page=schedule&repack_type=tandem&container='.$id.'\');';
						}else if(sf($_POST['url']) == 'sport'){
						    echo '$(\'#schedule-part\').load(\'/inc/exec.php?act=schedule_repack&page=schedule&repack_type=sport&container='.$id.'\');';
						}
					
    				echo '$(\'#container_form input[type="text"]\').val(\'\');';
    				
				}
			
			    //echo json_encode($query);
			}
		
		
		
		break;
		
		case 'add_harness':
			$harness = serialize($_POST);
		
			if($_SESSION['type']=='customer' || $_SESSION['type']=='admin' ) {
			
				if($_GET['ajax']) echo '$("#containeralert").removeClass("d-flex").addClass("d-none");'; 
				
				$_POST['mfr'] = dbdate($_POST['mfr']);
					    
				if($_POST['existing_container']>0) {
				
					//check stuff
					$cq = mysqli_query($link, 'SELECT * FROM containers WHERE customer=\''.sf($_POST['uid']).'\' AND id=\''.sf($_POST['existing_container']).'\'');

					if(mysqli_num_rows($cq)>0) {
					   				    
					    $query = 'UPDATE containers SET `harness`=\''.sf($harness).'\' WHERE id=\''.sf($_POST['existing_container']).'\'';
					    
					    $update = mysqli_query($link,$query);
					    //echo $query;
					
						$_SESSION['repack_container_id']=sf($_POST['existing_container']);
						
						echo 'var stepper = new Stepper(document.querySelector(\'.bs-stepper\'));';
						echo 'stepper.to(3);';
						
						if(sf($_POST['url']) == 'tandem'){
						    echo '$(\'#schedule-part\').load(\''.root().'/inc/exec.php?act=service_repack&page=schedule&repack_type=tandem&container='.sf($_POST['existing_container']).'\');';
						}else if(sf($_POST['url']) == 'sport'){
						    echo '$(\'#schedule-part\').load(\''.root().'/inc/exec.php?act=service_repack&page=schedule&repack_type=sport&container='.sf($_POST['existing_container']).'\');';
						}else if(sf($_POST['url']) == 'container_information' || sf($_POST['url']) == 'container_info' ){
						    echo '$(\'#reserve-parachute-part\').load(\''.root().'/inc/exec.php?act=container_info&page=reserve_parachute&container='.sf($_POST['existing_container']).'&s='.sf($_GET['s']).'\');';
						}
						echo '$(\'#harness_form input[type="text"]\').val(\'\');';
					}
				
				}
				
				
				if(!blankCheck(['make','model','size','serial','mfr'])) {
				
					echo '$("#containeralert").html("Please fill out all required fields");';
					echo '$("#containeralert").removeClass("d-none").addClass("d-flex");';
					
					exit();
				
				}

				if($_POST['existing_container'] <1){
				    $query = 'INSERT INTO containers (`customer`, `harness`, `service_id`, `enter_date`) VALUES (\''.sf($_SESSION['uid']).'\',\''.sf($harness).'\', \''.sf($_POST['s']).'\', NOW())';
    				mysqli_query($link, $query);
    				
    				$id = mysqli_insert_id($link);
    				
    				$_SESSION['repack_container_id']=$id;
    				$_SESSION['service']=$_POST['s'];
    				
    				//echo 'step_schedule();';
    				
    				echo 'var stepper = new Stepper(document.querySelector(\'.bs-stepper\'));';
    				echo 'stepper.to(3);';
    				
    				
						if(sf($_POST['url']) == 'tandem'){
						    echo '$(\'#schedule-part\').load(\''.root().'/inc/exec.php?act=service_repack&page=schedule&repack_type=tandem&container='.$id.'\');';
						}else if(sf($_POST['url']) == 'sport'){
						    echo '$(\'#schedule-part\').load(\''.root().'/inc/exec.php?act=service_repack&page=schedule&repack_type=sport&container='.$id.'\');';
						}else if(sf($_POST['url']) == 'container_info' || sf($_POST['url']) == 'container_information' ){
						    echo '$(\'#reserve-parachute-part\').load(\''.root().'/inc/exec.php?act=container_info&page=reserve_parachute&container='.sf($_POST['existing_container']).'&s='.sf($_GET['s']).'\');';
						}
						echo '$(\'#harness_form input[type="text"]\').val(\'\');';
    				
				}
			
			    //echo json_encode($query);
			}
		
		
		
		break;
		
		case 'add_aad':
			$harness = serialize($_POST);
		
			if($_SESSION['type']=='customer' || $_SESSION['type']=='admin' ) {
			
				if($_GET['ajax']) echo '$("#containeralert").removeClass("d-flex").addClass("d-none");'; 
				
				$_POST['mfr'] = dbdate($_POST['mfr']);
					    
				if($_POST['existing_container']>0) {
				
					//check stuff
					$cq = mysqli_query($link, 'SELECT * FROM containers WHERE customer=\''.sf($_POST['uid']).'\' AND id=\''.sf($_POST['existing_container']).'\'');

					if(mysqli_num_rows($cq)>0) {
					   				    
					    $query = 'UPDATE containers SET `aad_info`=\''.sf($harness).'\' WHERE id=\''.sf($_POST['existing_container']).'\'';
					    
					    $update = mysqli_query($link,$query);
					    //echo $query;
					
						$_SESSION['repack_container_id']=sf($_POST['existing_container']);
						
						echo 'var stepper = new Stepper(document.querySelector(\'.bs-stepper\'));';
						echo 'stepper.to(5);';
						
						if(sf($_POST['url']) == 'tandem'){
						    echo '$(\'#schedule-part\').load(\''.root().'/inc/exec.php?act=service_repack&page=schedule&repack_type=tandem&container='.sf($_POST['existing_container']).'\');';
						}else if(sf($_POST['url']) == 'sport'){
						    echo '$(\'#schedule-part\').load(\''.root().'/inc/exec.php?act=service_repack&page=schedule&repack_type=sport&container='.sf($_POST['existing_container']).'\');';
						}else if(sf($_POST['url']) == 'container_information' || sf($_POST['url']) == 'container_info' ){
						    echo '$(\'#main-parachute-part\').load(\''.root().'/inc/exec.php?act=container_info&page=main_parachute&container='.sf($_POST['existing_container']).'&s='.sf($_GET['s']).'\');';
						}
						echo '$(\'#aad_info_form input[type="text"]\').val(\'\');';
					}
				
				}
				
				
				if(!blankCheck(['make','model','size','serial','mfr','fabric'])) {
				
					echo '$("#containeralert").html("Please fill out all required fields");';
					echo '$("#containeralert").removeClass("d-none").addClass("d-flex");';
					
					exit();
				
				}
			
			    //echo json_encode($query);
			}
		
		
		
		break;

		case 'add_reserve_parachute':

			$harness = serialize($_POST);
			//echo json_encode($harness);
		
			if($_SESSION['type']=='customer' || $_SESSION['type']=='admin' ) {
			
				if($_GET['ajax']) echo '$("#containeralert").removeClass("d-flex").addClass("d-none");'; 
				
				$_POST['mfr'] = dbdate($_POST['mfr']);
					    
				if($_POST['existing_container']>0) {
				
					//check stuff
					$cq = mysqli_query($link, 'SELECT * FROM containers WHERE customer=\''.sf($_POST['uid']).'\' AND id=\''.sf($_POST['existing_container']).'\'');

					if(mysqli_num_rows($cq)>0) {
					   				    
					    $query = 'UPDATE containers SET `reserve_parachute`=\''.sf($harness).'\' WHERE id=\''.sf($_POST['existing_container']).'\'';
					    
					    $update = mysqli_query($link,$query);
					    //echo $query;
					
						$_SESSION['repack_container_id']=sf($_POST['existing_container']);
						
						echo 'var stepper = new Stepper(document.querySelector(\'.bs-stepper\'));';
						echo 'stepper.to(4);';
						
						if(sf($_POST['url']) == 'tandem'){
						    echo '$(\'#schedule-part\').load(\''.root().'/inc/exec.php?act=service_repack&page=schedule&repack_type=tandem&container='.sf($_POST['existing_container']).'\');';
						}else if(sf($_POST['url']) == 'sport'){
						    echo '$(\'#schedule-part\').load(\''.root().'/inc/exec.php?act=service_repack&page=schedule&repack_type=sport&container='.sf($_POST['existing_container']).'\');';
						}else if(sf($_POST['url']) == 'container_info' || sf($_POST['url']) == 'container_information' ){
						    echo '$(\'#aad-info-part\').load(\''.root().'/inc/exec.php?act=container_info&page=aad_info&container='.sf($_POST['existing_container']).'&s='.sf($_GET['s']).'\');';
						}
						echo '$(\'#reserve_parachute_form input[type="text"]\').val(\'\');';
					}
				
				}
				
				
				if(!blankCheck(['make','model','size','serial','mfr','fabric'])) {
				
					echo '$("#containeralert").html("Please fill out all required fields");';
					echo '$("#containeralert").removeClass("d-none").addClass("d-flex");';
					
					exit();
				
				}
			
			    echo json_encode($query);
			}
		
		
		
		break;

		case 'add_main_parachute':
			$harness = serialize($_POST);
		
			if($_SESSION['type']=='customer' || $_SESSION['type']=='admin' ) {
			
				if($_GET['ajax']) echo '$("#containeralert").removeClass("d-flex").addClass("d-none");'; 
				
				$_POST['mfr'] = dbdate($_POST['mfr']);
					    
				if($_POST['existing_container']>0) {
				
					//check stuff
					$cq = mysqli_query($link, 'SELECT * FROM containers WHERE customer=\''.sf($_POST['uid']).'\' AND id=\''.sf($_POST['existing_container']).'\'');

					if(mysqli_num_rows($cq)>0) {
					   				    
					    $query = 'UPDATE containers SET `main_parachute`=\''.sf($harness).'\' WHERE id=\''.sf($_POST['existing_container']).'\'';
					    
					    $update = mysqli_query($link,$query);
					    //echo $query;
					
						$_SESSION['repack_container_id']=sf($_POST['existing_container']);
						
						echo 'var stepper = new Stepper(document.querySelector(\'.bs-stepper\'));';
						echo 'stepper.to(6);';
						
						if(sf($_POST['url']) == 'tandem'){
						    echo '$(\'#schedule-part\').load(\''.root().'/inc/exec.php?act=service_repack&page=schedule&repack_type=tandem&container='.sf($_POST['existing_container']).'\');';
						}else if(sf($_POST['url']) == 'sport'){
						    echo '$(\'#schedule-part\').load(\''.root().'/inc/exec.php?act=service_repack&page=schedule&repack_type=sport&container='.sf($_POST['existing_container']).'\');';
						}else if(sf($_POST['url']) == 'container_information' || sf($_POST['url']) == 'container_info' ){
						    //echo '$(\'#schedule-part\').load(\''.root().'/inc/exec.php?act=schedule_repack&page=schedule&repack_type=sport&container='.sf($_POST['existing_container']).'\');';
						    echo 'document.location=\''.root().'service_repack/?s='.sf($_GET['s']).'\';';
						}
						echo '$(\'#main_parachute_form input[type="text"]\').val(\'\');';
					}
				
				}
				
				
				if(!blankCheck(['make','model','size','serial','mfr','fabric','line'])) {
				
					echo '$("#containeralert").html("Please fill out all required fields");';
					echo '$("#containeralert").removeClass("d-none").addClass("d-flex");';
					
					exit();
				
				}
			
			    //echo json_encode($query);
			}
		
		
		
		break;

		case 'add_container_summary':
			$harness = serialize($_POST);
		
			if($_SESSION['type']=='customer' || $_SESSION['type']=='admin' ) {
			
				if($_GET['ajax']) echo '$("#containeralert").removeClass("d-flex").addClass("d-none");'; 
				
				$_POST['aad_install'] 			= date('Y-m-d H:i:s');
					    
				$_POST['aad_next_maintenance'] 	= date('Y-m-d H:i:s');
					    
				$_POST['aad_eol'] 				= date('Y-m-d H:i:s');

				$_POST['amfr'] = dbdate($_POST['amfr']);
				
					    
				if($_POST['existing_container']>0) {
				
					//check stuff
					$cq = mysqli_query($link, 'SELECT * FROM containers WHERE customer=\''.sf($_POST['uid']).'\' AND id=\''.sf($_POST['existing_container']).'\'');

					if(mysqli_num_rows($cq)>0) {
					   				    
					    $query = 'UPDATE containers SET 
					                    `manufacturer`=\''.sf($_POST['hmake']).'\'
					                    ,`model`=\''.sf($_POST['hmodel']).'\'
					                    ,`serial`=\''.sf($_POST['hserial']).'\'
					                    ,`aad`=\''.sf($_POST['amake']).'\'
					                    , `reserve`=\''.sf($_POST['rmake']).'\'
					                    , `reserve_size`=\''.sf($_POST['rsize']).'\'
					                    ,`main`=\''.sf($_POST['mmake']).'\'
					                    ,`main_size`=\''.sf($_POST['msize']).'\'
					                    ,`reserve_serial`=\''.sf($_POST['rserial']).'\'
					                    ,`aad_serial`=\''.sf($_POST['aserial']).'\'
					                    ,`aad_install`=\''.sf($_POST['amfr']).'\'
					                    ,`aad_next_maintenance`=\''.sf($_POST['amfr']).'\'
					                    ,`aad_eol`=\''.sf($_POST['amfr']).'\' WHERE id=\''.sf($_POST['existing_container']).'\'';
					    
					    $update = mysqli_query($link,$query);
					    //echo $query;
					
						$_SESSION['repack_container_id']=sf($_POST['existing_container']);
						
						echo 'var stepper = new Stepper(document.querySelector(\'.bs-stepper\'));';
						echo 'stepper.to(2);';
						
						$_POST['url'] = (isset($_POST['url'])) ? $_POST['url'] : $_GET['repack_type'];

						if(sf($_POST['url']) == 'tandem'){
						    echo '$(\'#service-part\').load(\''.root().'/inc/exec.php?act=service_repack&page=service_list&repack_type=tandem&container='.sf($_POST['existing_container']).'\');';
						}else if(sf($_POST['url']) == 'sport'){
						    echo '$(\'#service-part\').load(\''.root().'/inc/exec.php?act=service_repack&page=service_list&repack_type=sport&container='.sf($_POST['existing_container']).'&s='.sf($_GET['s']).'\');';
						}

						echo '$(\'#container_form input[type="text"]\').val(\'\');';

						//echo 'document.location=\''.root().'service_repack/?page=service_list&container='.sf($_POST['e']).'&s='.sf($_GET['s']).'\';';
					}
				
				}
			}
		
		
		
		break;

		case 'add_cart':
					    $query = 'INSERT INTO `shopping_cart` SET 
					                    `cart_order_id`=\''.sf($_POST['cart_order_id']).'\'
					                    ,`cart_service_id`=\''.sf($_POST['cart_service_id']).'\'
					                    ,`cart_customer_id`=\''.sf($_POST['cart_customer_id']).'\'
					                    ,`cart_service_name`=\''.sf($_POST['cart_service_name']).'\'
					                    , `cart_service_price`=\''.sf($_POST['cart_service_price']).'\'
					                    , `cart_container_id`=\''.sf($_POST['cart_container_id']).'\'
					                    , `cart_repack_type`=\''.sf($_POST['repack_type']).'\'
					                    , `cart_status`=\'1\'
					                    ,`cart_created`=NOW()
					                    ';
					    
					    $insert = mysqli_query($link,$query);
					    //$id = mysqli_insert_id($link);
					    
					    $check = mysqli_query($link,'SELECT * FROM service_cart WHERE `sc_cart_order_id`=\''.sf($_POST['cart_order_id']).'\'');
					    if(mysqli_num_rows($check) == 0){
    					    $sc = 'INSERT INTO `service_cart` SET 
    					                    `sc_cart_order_id`=\''.sf($_POST['cart_order_id']).'\'
    					                    , `sc_cart_mainchute`= 0
    					                    ,`sc_cart_created`=NOW()
    					                    ';
    					    $insert = mysqli_query($link,$sc);
					    }
					    $_SESSION['order_id'] = $_POST['cart_order_id'];
					    if($insert){
					    	echo $_POST['cart_order_id'];
					    }else{
					    	echo 'error';
					    }
			break;


		case 'cart_mainchute':
					    $query = 'UPDATE `service_cart` SET `sc_cart_mainchute`=\''.sf($_POST['cart_mainchute']).'\' WHERE `sc_cart_order_id`=\''.sf($_POST['cart_order_id']).'\'';
					    $set = mysqli_query($link,$query);
			break;

		case 'del_item_cart':
					    $query = 'DELETE FROM `shopping_cart` WHERE `cart_order_id`=\''.sf($_POST['cart_order_id']).'\'
					                    AND `cart_service_id`=\''.sf($_POST['cart_service_id']).'\'';
					    echo $query;
					    $delete = mysqli_query($link,$query);
					    if($delete){
					    	echo 'delete OK';
					    }else{
					    	echo 'error';
					    }
			break;

		case 'service_checkout':
		    if($_POST['cart_order_id'] != ''){
					    $query = 'UPDATE `shopping_cart` SET `cart_status`=\'0\' WHERE `cart_order_id`=\''.sf($_POST['cart_order_id']).'\'
					                    AND `cart_customer_id`=\''.sf($_POST['cart_customer_id']).'\'';
					    
					    $set = mysqli_query($link,$query);
		    }
					    
					        echo 'var stepper = new Stepper(document.querySelector(\'.bs-stepper\'));';
						    echo 'stepper.to(3);';
						
					    	echo '$(\'#schedule-part\').load(\''.root().'inc/exec.php?act=service_repack&page=schedule&repack_type='.sf($_POST['repack_type']).'&container='.sf($_POST['existing_container']).'&s='.sf($_POST['s']).'\');';
					    
			break;

		case 'show_cart':
		$cart = array();
					    $query = 'SELECT * FROM `shopping_cart` WHERE `cart_order_id`=\''.sf($_POST['cart_order_id']).'\' AND cart_status=\'1\'';
					    
					    $res = mysqli_query($link,$query);
					    $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
            
			            $callback = array(
			                'data'=>$data
			            );
			            header('Content-Type: application/json');
			            echo json_encode($callback['data']);
				    	
			break;

		case 'add_service_option':
echo json_encode($_POST);
		
			/*if($_SESSION['type']=='customer' || $_SESSION['type']=='admin' ) {
			
				//if($_GET['ajax']) echo '$("#containeralert").removeClass("d-flex").addClass("d-none");'; 
				
				if($_POST['existing_container']>0) {
				
					//check stuff
					$check = 'SELECT * FROM containers WHERE customer=\''.sf($_POST['uid']).'\' AND id=\''.sf($_POST['existing_container']).'\'';
					//echo $check;
					$cq = mysqli_query($link, $check);

					if(mysqli_num_rows($cq)>0) {
					   				    
					    $query = 'UPDATE containers SET `service_option`=\''.sf($harness).'\' WHERE id=\''.sf($_POST['existing_container']).'\'';
					    //echo json_encode($query);
					    
					    $update = mysqli_query($link,$query);
					    //echo $query;
					
						$_SESSION['repack_container_id']=sf($_POST['existing_container']);
						
						echo 'var stepper = new Stepper(document.querySelector(\'.bs-stepper\'));';
						echo 'stepper.to(3);';
						echo 'step_schedule();';
						
						echo '$(\'#schedule-part\').load(\''.root().'inc/exec.php?act=service_repack&page=schedule&repack_type='.sf($_GET['repack_type']).'&container='.sf($_POST['existing_container']).'\');';

						echo '$(\'#service_form input[type="text"]\').val(\'\');';
					}
				
				}
				
				
				//if(!blankCheck(['make','model','size','serial','mfr','fabric','line'])) {
					//echo '$("#containeralert").html("Please fill out all required fields");';
					//echo '$("#containeralert").removeClass("d-none").addClass("d-flex");';
					//exit();
				//}
			
			    
			}*/
		
		
		
		break;

		
		case 'add_additional_work':
            $repack_id      = sf($_POST['repack_id']);
            $wo_id          = sf($_POST['wo_id']);
            $qbcode        = isset($_POST['qbcode']) ? sf($_POST['qbcode']) : null;
            $desc           = isset($_POST['description']) ? sf($_POST['description']) : null;
            
            if($qbcode != null && $desc != null){
                $query = mysqli_query($link, 'INSERT INTO additional_work (repack_id, work_order,qbcode,description,date) VALUES (\''.$repack_id.'\', \''.$wo_id.'\', \''.$qbcode.'\', \''.$desc.'\', NOW())');
                $aw_id = mysqli_insert_id($link);
                
                echo $aw_id;
            }else{
                echo '';
            }
                //print_r($_POST);
		break;
		
		case 'save_additional_work':
		    $repack_id      = sf($_POST['repack_id']);
            $wo_id          = sf($_POST['wo_id']);
            $qbcode        = isset($_POST['qbcode']) ? sf($_POST['qbcode']) : NULL;
            $desc           = isset($_POST['description']) ? sf($_POST['description']) : NULL;
            $id             = sf($_POST['record_id']);

		    $select = mysqli_query($link, 'SELECT * FROM additional_work WHERE repack_id=\''.sf($repack_id).'\' AND work_order=\''.sf($wo_id).'\' AND qbcode=\''.sf($qbcode).'\' AND description=\''.sf($desc).'\'');

		    if(mysqli_num_rows($select) > 0){
		        $res = mysqli_fetch_assoc($select);
		        $id = $res['id'];
		    }

		        if($id > 0){
                   $query = 'UPDATE additional_work SET qbcode=\''.sf($qbcode).'\', description=\''.sf($desc).'\' WHERE id=\''.sf($id).'\'';
                    mysqli_query($link, $query);
                  
                    $aw_id = $id;
                    
		       }else{
		           if($qbcode != NULL && $desc != NULL){
    		           $query = 'INSERT INTO additional_work (repack_id, work_order,qbcode,description,date) VALUES (\''.$repack_id.'\', \''.$wo_id.'\', \''.$qbcode.'\', \''.$desc.'\', NOW())';
    		           mysqli_query($link, $query);
                        $aw_id = mysqli_insert_id($link);
		            }
		       }
		  
		    echo json_encode($id);
		    echo json_encode($query);
		    echo json_encode($aw_id);
		break;
		
		case 'delete_additional_work':
		    
                $query = 'DELETE FROM additional_work WHERE id=\''.sf($_GET['id']).'\'';
                echo $query;
                mysqli_query($link, $query);
		break;
		
		case 'delete_empty_additional_work':
		    $data = array();
		    $repack_id      = $_GET['repack_id'];
            $wo_id          = $_GET['wo_id'];

            $qs = 'SELECT * FROM additional_work WHERE repack_id=\''.sf($repack_id).'\' AND work_order=\''.sf($wo_id).'\' AND qbcode IS NULL OR qbcode=\'\'';
            $select = mysqli_query($link, $qs);
            
            if(mysqli_num_rows($select)>0){
                while ( $c = mysqli_fetch_assoc($select)){
                       $delete = 'DELETE FROM additional_work WHERE qbcode IS NULL OR qbcode=\'\''; 
                       mysqli_query($link, $delete);
                       
                       $data = array(
                                'query' => $delete,
                                'id'    => $c['id']
                           );
                           
                }
                
            }
            echo json_encode($data);
            
		break;
		
		case 'customer_list':
		    $search = $_POST['search']['value'];
            $limit  = $_POST['length'];
            $start  = $_POST['start'];

            $sql          = mysqli_query($link, "SELECT * FROM `customers`");
            $sql_count    = mysqli_num_rows($sql);
            
            $where = '';
            if(!empty($search)){
                $where = "AND (customers.first_name LIKE '%".$search."%' OR customers.last_name LIKE '%".$search."%' OR customers.email LIKE '%".$search."%')";
            }
            
            $query = 'SELECT customers.*
                            , ANY_VALUE(CONCAT(customers.first_name,\' \',customers.last_name)) as name
                            FROM `customers`
                            WHERE type = \'customer\' AND active=\'1\' '.$where.' ';
            //echo json_encode($query);
            $order_field    = $_POST['order'][0]['column'];
            $order_ascdesc  = $_POST['order'][0]['dir'];
            $order          = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

            $sql_data = mysqli_query($link, $query.$order." LIMIT ".$limit." OFFSET ".$start);
            $sql_filter = mysqli_query($link, $query);
            $sql_filter_count = mysqli_num_rows($sql_filter);

            $data = mysqli_fetch_all($sql_data, MYSQLI_ASSOC);
            
            $callback = array(
                'draw'=>$_POST['draw'],
                'recordsTotal'=>$sql_count,
                'recordsFiltered'=>$sql_filter_count,
                'data'=>$data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
			            
		break;
		
		case 'staff_list':
		    $search = $_POST['search']['value'];
            $limit  = $_POST['length'];
            $start  = $_POST['start'];

            $sql          = mysqli_query($link, "SELECT * FROM `users`");
            $sql_count    = mysqli_num_rows($sql);
            
            $where = '';
            if(!empty($search)){
                $where = "AND (users.first_name LIKE '%".$search."%' OR users.last_name LIKE '%".$search."%' OR users.email LIKE '%".$search."%')";
            }
            
            $query = 'SELECT users.*
                            , ANY_VALUE(CONCAT(users.first_name,\' \',users.last_name)) as name
                            FROM `users`
                            WHERE users.type = \'admin\' AND users.active=\'1\' '.$where.' ';
            //echo json_encode($query);
            $order_field    = $_POST['order'][0]['column'];
            $order_ascdesc  = $_POST['order'][0]['dir'];
            $order          = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

            $sql_data = mysqli_query($link, $query.$order." LIMIT ".$limit." OFFSET ".$start);
            $sql_filter = mysqli_query($link, $query);
            $sql_filter_count = mysqli_num_rows($sql_filter);

            $data = mysqli_fetch_all($sql_data, MYSQLI_ASSOC);
            
            $callback = array(
                'draw'=>$_POST['draw'],
                'recordsTotal'=>$sql_count,
                'recordsFiltered'=>$sql_filter_count,
                'data'=>$data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
			            
		break;
		
		case 'container_list':
		    $search = $_POST['search']['value'];
            $limit  = $_POST['length'];
            $start  = $_POST['start'];

            $sql          = mysqli_query($link, "SELECT * FROM `containers`");
            $sql_count    = mysqli_num_rows($sql);
            
            $where = '';
            if(!empty($search)){
                $where = "AND (containers.manufacturer LIKE '%".$search."%' OR containers.model LIKE '%".$search."%' OR containers.serial LIKE '%".$search."%' OR containers.aad LIKE '%".$search."%')";
            }
            
            $query = 'SELECT * FROM `containers` WHERE customer = \''.sf($_GET['id']).'\' '.$where.' ';
            
            $order_field    = $_POST['order'][0]['column'];
            $order_ascdesc  = $_POST['order'][0]['dir'];
            $order          = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

            if($order == '' && $limit == '' && $start == ''){
                $sql_data = $sql_data = mysqli_query($link, $query);
            }else{
                $sql_data = mysqli_query($link, $query.$order." LIMIT ".$limit." OFFSET ".$start);
            }
            $sql_filter = mysqli_query($link, $query);
            $sql_filter_count = mysqli_num_rows($sql_filter);

            $data = mysqli_fetch_all($sql_data, MYSQLI_ASSOC);
            $callback = array(
                'draw'=>$_POST['draw'],
                'recordsTotal'=>$sql_count,
                'recordsFiltered'=>$sql_filter_count,
                'data'=>$data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
			            
		break;
		
		case 'container_list_review':
		    $search = $_POST['search']['value'];
            $limit  = $_POST['length'];
            $start  = $_POST['start'];

            $sql          = mysqli_query($link, "SELECT * FROM `containers`");
            $sql_count    = mysqli_num_rows($sql);
            
            $where = '';
            if(!empty($search)){
                $where = "AND (containers.manufacturer LIKE '%".$search."%' OR containers.model LIKE '%".$search."%' OR containers.serial LIKE '%".$search."%' OR containers.aad LIKE '%".$search."%')";
            }
            
            $id='';
            if(sf($_GET['id']) > 0){
                $id = sf($_GET['id']);
            }else{
                $id = sf($_SESSION['uid']);
            }
            
            $query = 'SELECT * FROM `containers` WHERE customer = \''.sf($id).'\' '.$where.' ';
            
            $order_field    = $_POST['order'][0]['column'];
            $order_ascdesc  = $_POST['order'][0]['dir'];
            $order          = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

            if($order == '' && $limit == '' && $start == ''){
                $sql_data = $sql_data = mysqli_query($link, $query);
            }else{
                $sql_data = mysqli_query($link, $query.$order." LIMIT ".$limit." OFFSET ".$start);
            }
            $sql_filter = mysqli_query($link, $query);
            $sql_filter_count = mysqli_num_rows($sql_filter);

            $data = mysqli_fetch_all($sql_data, MYSQLI_ASSOC);
            $callback = array(
                'draw'=>$_POST['draw'],
                'recordsTotal'=>$sql_count,
                'recordsFiltered'=>$sql_filter_count,
                'data'=>$data
            );
            header('Content-Type: application/json');
            echo json_encode($callback);
			            
		break;
		
		case 'get_estimated_pickup':
		
			//check if any 
			$type = ($_POST['url'] == 'tandem') ? 'tandem' : 'sport';
			$speed = sf($_POST['speed']);
			
			$pickup = get_next_pickup_date($speed, $_POST['dropoff_date']);
			
			$rq = mysqli_query($link,'SELECT * FROM repacks WHERE `customer`=\''.sf($_SESSION['uid']).'\' AND `container`=\''.sf($_POST['container_id']).'\'');
            $r = mysqli_fetch_assoc($rq);
			if(mysqli_num_rows($rq) == 0)
			{
                /*
    			$wo  = mysqli_query($link, 'INSERT INTO work_orders (`container`,`status`,`date`, `type`, `customer`, `dropoff_date`, `estimated_pickup`, `schedule_date`, `notes`) VALUES (\''.sf($_POST['container_id']).'\',\'pending\',NOW(),\''.sf($type).'\',\''.sf($_SESSION['uid']).'\',\''.sf($_POST['dropoff_date']).'\',\''.$pickup.'\',NOW(),\'\')');
    			
    			$wo_id = mysqli_insert_id($link);
    			*/
    			$query  = mysqli_query($link,'INSERT INTO repacks (`type`, `customer`, `container`,`status`,`speed`,`dropoff_date`, `estimated_pickup`, `schedule_date`) VALUES (\''.sf($type).'\',\''.sf($_SESSION['uid']).'\',\''.sf($_POST['container_id']).'\',\'pending\',\''.$speed.'\',\''.sf($_POST['dropoff_date']).'\',\''.$pickup.'\',NOW())');
			
			}
			else
			{
			    $rp  = mysqli_query($link,'UPDATE repacks SET `speed`=\''.$speed.'\', `estimated_pickup`=\''.$pickup.'\', `dropoff_date`=\''.sf($_POST['dropoff_date']).'\' WHERE `container`=\''.sf($_POST['container_id']).'\'');
			    /*
			    $wo  = mysqli_query($link, 'UPDATE work_orders SET `dropoff_date` = \''.sf($_POST['dropoff_date']).'\', `estimated_pickup`=\''.$pickup.'\' WHERE `id`=\''.sf($r['work_order']).'\'');
*/
			}
			
			$pickup = date('m-d-Y', strtotime($pickup));
		
			echo '$(\'#pickup_date\').val(\''.$pickup.'\');';
		
		break;
		
		case 'schedule_dropoff':
		    
		    $type = ($_POST['url'] == 'tandem') ? 'tandem' : 'sport';
			
			$container_id = $_POST['container_id'];
			
			$dropoff_date = $_POST['dropoff_date'];
			
			$speed = $_POST['speed'];
			
			$pickup = get_next_pickup_date($speed,$_POST['dropoff_date']);
			
			//check if any 
			$speed = $_POST['speed'];
			
			$pickup = get_next_pickup_date($speed, $_POST['dropoff_date']);
			
			$que = 'SELECT * FROM repacks WHERE `customer`=\''.sf($_SESSION['uid']).'\' AND `container`=\''.sf($container_id).'\'';
			$rq = mysqli_query($link,$que);
			//echo $que;
            $r = mysqli_fetch_assoc($rq);
			if(mysqli_num_rows($rq) == 0)
			{
			/*
    			$wo  = mysqli_query($link, 'INSERT INTO work_orders (`container`,`status`,`date`, `type`, `customer`, `dropoff_date`, `estimated_pickup`, `schedule_date`, `notes`) VALUES (\''.sf($container_id).'\',\'pending\',NOW(),\''.sf($type).'\',\''.sf($_SESSION['uid']).'\',\''.sf($dropoff_date).'\',\''.sf($pickup).'\',NOW(),\'\')');
    			
    			$wo_id = mysqli_insert_id($link);
    		*/	
    			$query  = mysqli_query($link,'INSERT INTO repacks (`type`, `customer`, `container`,`status`,`speed`,`dropoff_date`, `estimated_pickup`, `schedule_date`) VALUES (\''.sf($type).'\',\''.sf($_SESSION['uid']).'\',\''.sf($container_id).'\',\'pending\',\''.sf($speed).'\',\''.sf($dropoff_date).'\',\''.sf($pickup).'\',NOW())');
			
			}
			else
			{
			    $rp  = mysqli_query($link,'UPDATE repacks SET `speed`=\''.$speed.'\', `estimated_pickup`=\''.$pickup.'\', `dropoff_date`=\''.sf($dropoff_date).'\' WHERE `container`=\''.sf($container_id).'\'');
			    /*
			    $wo  = mysqli_query($link, 'UPDATE work_orders SET `dropoff_date` = \''.sf($dropoff_date).'\', `estimated_pickup`=\''.$pickup.'\' WHERE `id`=\''.sf($r['work_order']).'\'');
*/
			}

			echo 'var stepper = new Stepper(document.querySelector(\'.bs-stepper\'));';
			echo 'stepper.to(4);';
			echo '$(\'#finalize-part\').load(\''.root().'/inc/exec.php?act=service_repack&page=payment&repack_type='.$type.'&container='.$_SESSION['repack_container_id'].'&speed='.$speed.'&dropoff_date='.$dropoff_date.'&estimated_pickup='.$pickup.'\');';
			
			
			//echo '$(\'#pickup_date\').val(\''.get_next_pickup_date($speed).'\');';
			
		
		break;
		
		case 'submit_service_order':
			
			$repack_type = ($_GET['repack_type'] == 'tandem') ? 'tandem' : 'sport';
			
			
			$dropoff_date = $_POST['dropoff_date'];
			
			$speed = sf($_POST['speed']);
			
			$pickup = get_next_pickup_date($speed,$_POST['dropoff_date']);
			
			$container = $_SESSION['repack_container_id'];
			
			$paid = 0.00;
			
			$price = ($repack_type == 'tandem') ? ($repack_pricing[$speed]+100) : $repack_pricing[$speed];
			
			$total = $price;
			
			$rq = mysqli_query($link,'SELECT * FROM repacks WHERE `customer`=\''.sf($_SESSION['uid']).'\' AND `container`=\''.sf($container).'\'');
            $r = mysqli_fetch_assoc($rq);
            
                /*$wo  = mysqli_query($link, 'UPDATE work_orders SET `dropoff_date` = \''.sf($dropoff_date).'\', `estimated_pickup`=\''.sf($pickup).'\', `initial_price`=\''.$price.'\',`paid`=\''.$paid.'\',`total_cost`= \''.$total.'\' WHERE `id`=\''.sf($r['work_order']).'\'');
		*/
		$que = 'INSERT INTO work_orders (`customer`,`container`,`type`,`date`,`schedule_date`,`dropoff_date`,`estimated_pickup`,`status`,`notes`,`initial_price`,`paid`,`total_cost`) VALUES (\''.sf($_SESSION['uid']).'\',\''.sf($container).'\',\''.sf($repack_type).'\',NOW(),\''.sf($r['schedule_date']).'\',\''.sf($dropoff_date).'\',\''.sf($pickup).'\',\'pending\',\'\',\''.sf($price).'\',\''.sf($paid).'\',\''.sf($total).'\')';
		//echo $que;
			$wo  = mysqli_query($link, $que);
			
			$wo_id = mysqli_insert_id($link);
			
			mysqli_query($link, 'UPDATE repacks SET `work_order` = \''.sf($wo_id).'\' WHERE `id`=\''.sf($r['id']).'\'');
			
			$id = $r['id'];
			
			echo 'document.location=\''.root().'service_order_success/?id='.$id.'&order='.$_SESSION['order_id'].'\';';
			
			
			unset($_SESSION['repack_container_id']);
			unset($_SESSION['order_id']);
			unset($_SESSION['repack_type']);
			
		
		break;
		
		case 'submit_repack_order':
			
			$repack_type = ($_GET['repack_type'] == 'tandem') ? 'tandem' : 'sport';
			
			
			$dropoff_date = $_POST['dropoff_date'];
			
			$speed = sf($_POST['speed']);
			
			$pickup = get_next_pickup_date($speed,$_POST['dropoff_date']);
			
			$container = $_SESSION['repack_container_id'];
			
			$paid = 0.00;
			
			$price = ($repack_type == 'tandem') ? ($repack_pricing[$speed]+100) : $repack_pricing[$speed];
			
			$total = $price;
			
			$rq = mysqli_query($link,'SELECT * FROM repacks WHERE `customer`=\''.sf($_SESSION['uid']).'\' AND `container`=\''.sf($container).'\'');
            $r = mysqli_fetch_assoc($rq);
            
                /*$wo  = mysqli_query($link, 'UPDATE work_orders SET `dropoff_date` = \''.sf($dropoff_date).'\', `estimated_pickup`=\''.sf($pickup).'\', `initial_price`=\''.$price.'\',`paid`=\''.$paid.'\',`total_cost`= \''.$total.'\' WHERE `id`=\''.sf($r['work_order']).'\'');
		*/
		$que = 'INSERT INTO work_orders (`customer`,`container`,`type`,`date`,`schedule_date`,`dropoff_date`,`estimated_pickup`,`status`,`notes`,`initial_price`,`paid`,`total_cost`) VALUES (\''.sf($_SESSION['uid']).'\',\''.sf($container).'\',\''.sf($repack_type).'\',NOW(),\''.sf($r['schedule_date']).'\',\''.sf($dropoff_date).'\',\''.sf($pickup).'\',\'pending\',\'\',\''.sf($price).'\',\''.sf($paid).'\',\''.sf($total).'\')';
		//echo $que;
			$wo  = mysqli_query($link, $que);
			
			$wo_id = mysqli_insert_id($link);
			
			mysqli_query($link, 'UPDATE repacks SET `work_order` = \''.sf($wo_id).'\' WHERE `id`=\''.sf($r['id']).'\'');
			
			unset($_SESSION['repack_container_id']);
			
			$id = $r['id'];
			
			echo 'document.location=\''.root().'repack_order_success/?id='.$id.'\';';
			
			//echo $repack_type.'-'.$price;
		
		break;
		
		
		case 'checkout':
		
			$cart = $_SESSION['cart'];
			
			$order_confirmation_items = '';
			
			foreach ($cart as $item_id=>$item) {
				$total += $item['price']*$item['qty'];
			}
			
			
			if($_POST['payment_type']=='paypal') {
			
				mysqli_query($link, 'INSERT INTO mask_orders (`date`,`email`,`name`,`address_1`,`address_2`,`city`,`state`,`zip`,`phone`,`payment_method`,`transaction_id`,`order_total`, `order_data`, `payment_status`) VALUES (NOW(),\''.sf($_POST['email']).'\',\''.sf($_POST['name']).'\',\''.sf($_POST['address']).'\',\''.sf($_POST['address_2']).'\',\''.sf($_POST['city']).'\',\''.sf($_POST['state']).'\',\''.sf($_POST['zip']).'\',\''.sf($_POST['phone']).'\',\'PayPal\',\''.sf($return['id']).'\',\''.$total.'\', \''.sf(json_encode($_SESSION['cart'])).'\', \'UNPAID\')');
			
				$order_id = mysqli_insert_id($link);
				
				foreach ($cart as $item_id=>$item) {
					$order_confirmation_items .= $item['qty'].' x '.$item['desc'].' - $'.number_format(($item['price']*$item['qty']), 2, '.', '')."\n";
					mysqli_query($link, 'INSERT INTO mask_order_items (`order_id`, `description`, `type`, `color`, `embroidery_color`, `size`, `qty`, `embroidery_type`, `embroidery_file`) VALUES (\''.$order_id.'\', \''.sf($item['desc']).'\', \''.sf($item['selected_mask_type']).'\', \''.sf($item['color']).'\', \''.sf($item['embroidery_color']).'\', \''.sf($item['size']).'\', \''.sf($item['qty']).'\', \''.$item['embroidery_type'].'\', \''.$item['embroidery_file_id'].'\')');
					
				}
				
				$_SESSION['order_id'] = $order_id;
				
				
				
				echo 'document.location="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=admin@peregrinemfginc.com&item_name='.urlencode('Mask Order #'.$order_id).'&item_number=1&amount='.$total.'&no_shipping=1&return='.urlencode(root().'confirmation/?id='.$order_id.'&paypal=1').'&currency_code=USD&notify_url='.urlencode(root().'/paypal/?order='.$order_id).'"';
				
				exit();
			
			}
			
			
			if($_POST['payment_type']=='cc') {
				
				$post = array('amount'=>($total*100), 'currency'=>'usd', 'description'=>$description, 'card[number]'=>$_POST['cc_number'], 'card[exp_month]'=>$_POST['cc_exp_month'], 'card[exp_year]'=>$_POST['cc_exp_year'],'card[cvc]'=>$_POST['cc_cvv']);
	
					$ch = curl_init();
					
					curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/charges');
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
					curl_setopt($ch, CURLOPT_USERPWD, 'sk_live_y8al1OxEfzACqZgWbHYKarWL00WxZRNC0j:');
					//curl_setopt($ch, CURLOPT_USERPWD, 'sk_test_XwwkXsnL5IrBLBkIPcQKbycX00teGXfPQ4:');
					curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
					$output = curl_exec($ch);

					curl_close($ch);
					
					$return = json_decode($output,true);
					
					
										
					if(is_array($return['error'])) {
						echo '$("#card_error").show(); $("#card_error").html("Your card was declined. Please check the information and try again."); $("#complete_order_button").text("Complete Order"); $("#complete_order_button").prop("disabled", true);';
						exit();
					} else {
						//create order
						
						mysqli_query($link, 'INSERT INTO mask_orders (`date`,`email`,`name`,`address_1`,`address_2`,`city`,`state`,`zip`,`phone`,`payment_method`,`transaction_id`,`order_total`, `order_data`, `payment_status`, `order_status`) VALUES (NOW(),\''.sf($_POST['email']).'\',\''.sf($_POST['name']).'\',\''.sf($_POST['address']).'\',\''.sf($_POST['address_2']).'\',\''.sf($_POST['city']).'\',\''.sf($_POST['state']).'\',\''.sf($_POST['zip']).'\',\''.sf($_POST['phone']).'\',\'Stripe\',\''.sf($return['id']).'\',\''.$total.'\', \''.sf(json_encode($_SESSION['cart'])).'\', \'PAID\', \'PAID\')');
			
						$order_id = mysqli_insert_id($link);
						
						foreach ($cart as $item_id=>$item) {
							$order_confirmation_items .= $item['qty'].' x '.$item['desc'].' - $'.number_format(($item['price']*$item['qty']), 2, '.', '')."\n";
							mysqli_query($link, 'INSERT INTO mask_order_items (`order_id`, `description`, `type`, `color`, `embroidery_color`, `size`, `qty`, `embroidery_type`, `embroidery_file`) VALUES (\''.$order_id.'\', \''.sf($item['desc']).'\', \''.sf($item['selected_mask_type']).'\', \''.sf($item['color']).'\', \''.sf($item['embroidery_color']).'\', \''.sf($item['size']).'\', \''.sf($item['qty']).'\', \''.$item['embroidery_type'].'\', \''.$item['embroidery_file_id'].'\')');
							
							
						}
						
						$_SESSION['order_id'] = $order_id;
									
						// email order info
						
						$message = sf($_POST['name'])."\n\n";
						$message .= 'Thank for for placing an order for a Ascend Rigging services. Below is a confirmation of your order.'."\n\n";
						$message .= $order_confirmation_items;
						$message .= "\nTotal: $".number_format($total,2,'.','')."\n\n";
						$message .= "Shipping Address:\n";
						$message .= sf($_POST['name'])."\n";
						$message .= sf($_POST['address'])."\n";
						if($_POST['address_2']) $message .= sf($_POST['address_2'])."\n";
						$message .= sf($_POST['city']).", ".sf($_POST['state'])." ".sf($_POST['zip'])."\n\n";
						$message .= "If you have any questions, please email us at info@ascendrigging.com.\n\n";
						$message .= "Thank You\n\n";
						$message .= "Ascend Rigging";
						
						smtpemail(sf($_POST['email']),'Your Ascend Rigging services order',$message);
						smtpemail('admin@ascendrigging.com','Your Ascend Rigging services order',$message);
						
						echo 'document.location="'.root().'confirmation/?id='.$order_id.'";';
					}
					
					
			}
			//header( 'Location: ' . root() );
	    exit();
		break;
		
		case 'logout':
        session_unset();
        session_destroy();
		header('location: '.root(), true, 301);
		exit();
		break;

        default:
			//echo 'error';
			header( 'Location: ' . root() );
            exit();
            break;
	}

} elseif($_SESSION['type']=='admin' || $_SESSION['type']=='staff') {
	
	switch ($_GET['act']) {
	    
	    case 'ok':
	        echo "ok";
	        break;
		
		case 'manage_container':

			include '../pages/manage_container.php';
		
		break;
		
		case 'logout':
        session_unset();
        session_destroy();
		header('location: '.root(), true, 301);
		exit();
		break;
	
	}

} else {
	
	switch ($_GET['act']) {

        case 'admin_login':
			$q = mysqli_query($link, 'SELECT * FROM users WHERE email=\''.sf($_POST['cemail']).'\' AND active=\'1\'');
			
			if(mysqli_num_rows($q)>0) {
				$u = mysqli_fetch_assoc($q);
				
				if(password_verify($_POST['cpassword'], $u['password'])) {
				    session_start();
					$_SESSION['uname'] = strtoupper($u['first_name'].' '.$u['last_name']);
					//$_SESSION['uid'] = $u['id'];
					$_SESSION['adminid'] = $u['id'];
					$_SESSION['type'] = $u['type'];
					$_SESSION['email'] = sf($_POST['cemail']);
					
					$_SESSION['previous_login'] = $u['last_login'];
					print_r($_SESSION);
					$check_new_projects = mysqli_query($link, 'SELECT id FROM projects WHERE started >= \''.sf($_SESSION['previous_login']).'\'');
					
					
					if($_GET['ajax']) {
						echo 'console.log(\'Login OK\');';
						if($_GET['schedule']) {
							
							if($_SESSION['type'] == 'admin'){
						      echo 'document.location=\'/staff/\';';
							}else{
							    if(sf($_POST['url']) == '/schedule_sport_repack/'){
						        echo 'document.location=\'/schedule_sport_repack/\';';
    							}else if(sf($_POST['url']) == '/schedule_tandem_repack/'){
    						        echo 'document.location=\'/schedule_tandem_repack/\';';
    							}

							}
						} else {
							echo 'document.location=\'/repacks/\';';
						}
					}
					
					mysqli_query($link, 'UPDATE users SET last_login=NOW() WHERE id=\''.sf($u['id']).'\'');
					
					if($_SESSION['type'] == 'admin'){
					    header('location: '.root().'/staff/');
					}else{
					    header('location: '.root().'schedule_sport_repack/');
					}
					
					exit();
				}
			}
			
			if($_GET['ajax']) {
				echo 'console.log(\'Login Failed\');';
				echo '$("#loginalert").html("Username / Password incorrect");';
				echo '$("#loginalert").removeClass("d-none").addClass("d-flex");';
				echo '$("#password").val("");';
				
			} else {
				//header('location: '.root().'admin?error=loginfailed');
				echo "error";
			}
			
		break;
		
		case 'login':
		//$s = (isset($_GET['s'])) ? sf($_GET['s']) : 1;
		$s = sf($_POST['s']);
		$_SESSION['service']=$_POST['s'];
			$q = mysqli_query($link, 'SELECT * FROM customers WHERE email=\''.sf($_POST['cemail']).'\' AND active=\'1\'');
			
			if(mysqli_num_rows($q)>0) {
				$u = mysqli_fetch_assoc($q);
				
				if(password_verify($_POST['cpassword'], $u['password'])) {
				    
				    session_start();
					$_SESSION['uname'] = strtoupper($u['first_name'].' '.$u['last_name']);
					$_SESSION['uid'] = $u['id'];
					$_SESSION['type'] = $u['type'];
					$_SESSION['email'] = sf($_POST['cemail']);
					
					$_SESSION['previous_login'] = $u['last_login'];
					
					$check_new_projects = mysqli_query($link, 'SELECT id FROM projects WHERE started >= \''.sf($_SESSION['previous_login']).'\'');
					
					if($_GET['ajax']) {
						echo 'console.log(\'Login OK\');';
						if($_GET['schedule']) {
							
							if($_SESSION['type'] == 'admin'){
						      echo 'document.location=\'/staff/\';';
							}else{
							    if(sf($_POST['url']) == '/schedule_sport_repack/'){
						        	echo 'document.location=\''.root().'schedule_sport_repack/\';';
    							}else if(sf($_POST['url']) == '/schedule_tandem_repack/'){
    						        echo 'document.location=\''.root().'schedule_tandem_repack/\';';
    							}else if(sf($_POST['url']) == '/container_information/'){
    						        echo 'document.location=\''.root().'container_information/?s='.$s.'\';';
    						        header('location: '.root().'container_information/?s='.$s);
    						        
    							}

							}
						} else {
							echo 'document.location=\'/repacks-review/\';';
						}
						
					}
					
					mysqli_query($link, 'UPDATE customers SET last_login=NOW() WHERE id=\''.sf($u['id']).'\'');
					
					if($_SESSION['type'] == 'admin'){
					    header('location: '.root().'staff/');
					}else{
					    if($_POST['url'] == '/schedule_sport_repack/'){
					        echo "/schedule_sport_repack/";
					    }else if($_POST['url'] == '/schedule_tandem_repack/'){
					        echo "/schedule_tandem_repack/";
					    }else if($_POST['url'] == '/container_information/'){
					        echo "/container_information/";
					    }
					}
					
					exit();
				}
			}
			
			if($_GET['ajax']) {
				echo 'console.log(\'Login Failed\');';
				//echo '$("#loginalert").html("Username / Password incorrect");';
				echo '$("#loginalert").html("Sorry this email or password is not valid, please re-check & try again");';
				echo '$("#loginalert").removeClass("d-none").addClass("d-flex");';
				echo '$("#password").val("");';
				
			} else {
			   echo "error";
				//header('location: '.root().'?error=loginfailed');
			}
			
		break;
		
		
		case 'register':
		//$s = (isset($_GET['s'])) ? sf($_GET['s']) : 1;
		$s = sf($_POST['s']);
		$_SESSION['service']=$_POST['s'];
		
			if($_GET['ajax']) echo '$("#registeralert").removeClass("d-flex").addClass("d-none");';
			
			if(!blankCheck(['remail','rpassword','rfname','rlname'])) {
			
				echo '$("#registeralert").html("Please fill out all required fields");';
				echo '$("#registeralert").removeClass("d-none").addClass("d-flex");';
				
				exit();
			
			}
			
			$q = mysqli_query($link, 'SELECT * FROM customers WHERE email=\''.sf($_POST['remail']).'\' AND active=\'1\'');
			
			if(mysqli_num_rows($q)==0) {
				
				$cust = 'INSERT INTO customers (`first_name`, `last_name`,`phone`,`email`,`password`, `type`, `active`) VALUES (\''.sf($_POST['rfname']).'\',\''.sf($_POST['rlname']).'\',\''.sf($_POST['rphone']).'\',\''.sf($_POST['remail']).'\',\''.sf(password_hash($_POST['rpassword'], PASSWORD_DEFAULT)).'\', \'customer\', \'1\')';
				
				mysqli_query($link, $cust);
				$id = mysqli_insert_id($link);
			
				session_start();
				$_SESSION['uname'] = strtoupper(sf($_POST['rfname']).' '.sf($_POST['rlname']));
				$_SESSION['uid'] = $id;
				$_SESSION['email'] = sf($_POST['remail']);
				$_SESSION['type'] = 'customer';
				$_SESSION['previous_login'] = date('Y-m-d H:i:s');
				
					if($_GET['ajax']) {
						echo 'console.log(\'Register OK\');';
						if($_GET['schedule']) {
						    
						        //echo 'step_containerinfo();';
								echo 'step_harness();';
							
    							echo '$("#register_form").html("");';
    							echo '$("#login_form").html("");';
    							
						
							    if(sf($_POST['url']) == '/schedule_sport_repack/'){
						        echo 'document.location=\'/schedule_sport_repack/\';';
    							}else if(sf($_POST['url']) == '/schedule_tandem_repack/'){
    						        echo 'document.location=\'/schedule_tandem_repack/\';';
    							}else if(sf($_POST['url']) == '/container_information/'){
    						        echo 'document.location=\'/container_information/?s='.$s.'\';';
    							}
						} else {
							echo 'document.location=\'/repacks-review/\';';
						}
						
					}
					    if($_POST['url'] == '/schedule_sport_repack/'){
					        header('location: '.root().'schedule_sport_repack/');
					    }else if($_POST['url'] == '/schedule_tandem_repack/'){
					        header('location: '.root().'schedule_tandem_repack/');
					    }else if($_POST['url'] == '/container_information/'){
					        header('location: '.root().'container_information/');
					    }
					exit();
				
			} else {
				echo '$("#registeralert").html("Your email address is already registered. Please log in.");';
				echo '$("#registeralert").removeClass("d-none").addClass("d-flex");';
			}
			
			
		break;
		
		case 'api_pull_order':
	
	    $id =  intval($_GET['id']);
        
        //echo md5($id.'peregrin3!').'<hr/>';
        
        //if (md5($id.'peregrin3!') == $_GET['s'])
        if (isset($_GET['id']))
        {
                //$query = "SELECT * FROM `repacks` WHERE id='".make_safe($id)."'";
                //$result = mysqli_query($link, $query);
                //$data = mysqli_fetch_assoc($result);

                $result = array(
                        'status' => true,
                        'message' => "Success",
                        'data' => api_pull_order($id)
                    );    
            
            
        }
        else
        {
            $result = array(
                    'status' => false,
                    'message' => "Sorry you're not allowed to access this api",
                        );
        }
        
        echo json_encode($result, JSON_PRETTY_PRINT);
        //echo json_encode($result);
        exit();
    
		    break;

		case 'logout':
        session_unset();
        session_destroy();
		header('location: '.root(), true, 301);
		exit();
		break;
	}

}
?>