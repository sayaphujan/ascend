<?php
date_default_timezone_set( 'America/Chicago' );

error_reporting( E_ALL ^ E_NOTICE );

ini_set( 'display_errors', 1 );

session_start();

$repack_pricing['standard']='110.00';
$repack_pricing['rush1']='170.00';
$repack_pricing['rush2']='210.00';
$repack_pricing['tandem']='135.00';

$repack_label['standard']='Sport Repack - Standard Lead Time';
$repack_label['rush1']='Sport Repack - Rush 1 (Front of line)';
$repack_label['rush2']='Sport Repack - Rush 2 (Immediate)';
$repack_label['tandem']='Tamdem Reserve Repack';

//error_reporting(0);

$link = mysqli_connect('localhost','root','','ascendloft_db');
if ( mysqli_connect_error() ) {
    $emsg = 'MySQL Error: ' . mysqli_connect_error();
    die( $emsg );
}

function mysqli_result( $res, $row, $field = 0 ) {
    $res->data_seek( $row );
    $datarow = $res->fetch_array();
    return $datarow[ $field ];
}

function root( $var = '' ) {
    $pro = 'https';
    $dom = 'loft.ascendrigging.com';
    $fol = '';

    if ( !empty( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] != 'off' ) {
        $pro = 'https';
    }
    //return $pro . '://' . $dom . '/' . $fol . $var;
    return 'http://127.0.0.1/ascend/';

}

function num_only( $var, $ex = ',.' ) {
    return preg_replace( '/[^0-9' . $ex . ']/', '', $var );
}

function word_cleanup( $var ) {
    $pat = "/<(\w+)>(\s|&nbsp;)*<\/\1>/";
    $var = preg_replace( $pat, '', $var );
    return mb_convert_encoding( $var, 'HTML-ENTITIES', 'UTF-8' );
}

function make_safe( $var, $safe = '' ) {
    $var = word_cleanup( $var );
    if ( isset( $safe ) && !empty( $safe ) ) {
        $var = strip_tags( $var, $safe );
    }
    $var = addslashes( trim( $var ) );
    return $var;
}

function sf($var) {
	return make_safe($var);
}
/*
function passwd_hash($input, $default){
    $salt = hash( 'sha256', uniqid( mt_rand(), true ) . time() . strtolower( $input ) );
                        $hash = $salt . $input;
                        for ( $i = 0; $i < 100000; ++$i ) {
                            $hash = hash( 'sha256', $hash );
                        }
                        $hash = $salt . $hash;
    return $hash;
}
*/
function save_posts( $posts ) {
    foreach ( $posts as $post ) {
        if ( isset( $_POST[ $post ] ) ) {
            $_SESSION[ $post ] = $_POST[ $post ];
        }
    }
}

function unset_sess( $sessions ) {
    foreach ( $sessions as $session ) {
        if ( isset( $_SESSION[ $session ] ) ) {
            unset( $_SESSION[ $session ] );
        }
    }
}

function blankCheck( $vars ) {
    $x = 0;
    $c = count( $vars );

    for ( $i = 0; $i < $c; ++$i ) {
        if ( !empty( $_POST[ $vars[ $i ] ] ) ) {
            ++$x;
        }
    }

    if ( $x == $c ) {
        return true;
    } else {
        return false;
    }
}

function blankResp( $var, $blank = '' ) {
    $var = trim( $var );
    if ( !empty( $var ) ) {
        return $var;
    } else {
        return $blank;
    }
}

function month( $num ) {
    $month = array( '', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );
    return $month[ $num ];
}

function sendHTML($email,$subject,$message) {
	$dom = root('dom');
	$headers  = "From: <info@peregrine.ndevix.com>\r\n"; 
	$headers .= "To: <{$email}>\r\n";
	$headers .= "Subject: {$subject}\r\n";
	$headers .= "Date: ".date("r")."\r\n";
	$headers .= "Organization: Organization\r\n";
	$headers .= "User-Agent: NDX Mail/1.0\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Reply-To: info@peregrinemfginc.com\r\n";
	$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
	$headers .= "Content-Transfer-Encoding: 7bit\r\n";
	$headers .= "Content-Disposition: inline\r\n";
	$headers .= "Message-Id: <".date("mdY").time().".email@peregrine.ndevix.com>";
	
	$socket = pfsockopen('mail.ndevix.com', 25, $errno, $errstr);
	if ($socket){
		fputs($socket, "HELO s106.ndevix.com\r\n");
		fgets($socket, 256);
		fputs($socket, "AUTH LOGIN\r\n");
		fgets($socket, 256);
		fputs($socket, base64_encode("peregrinecontainers@ndevix.com")."\r\n");
		fgets($socket, 256);
		fputs($socket, base64_encode("i2pptpxzzi")."\r\n");
		fgets($socket, 256);
		fputs($socket, "MAIL FROM:<info@peregrine.ndevix.com>\r\n");
		fgets($socket, 256);
		fputs($socket, "RCPT TO:<{$email}>\r\n");
		fgets($socket, 256);
		fputs($socket, "DATA\r\n");
		fgets($socket, 256);
		fputs($socket, "{$headers}\n\n{$message}\r\n");
		fputs($socket, ".\r\n");
		fgets($socket, 256);
		fputs($socket, "QUIT\r\n");
		fgets($socket, 256);
		fclose($socket);
	} else {
		echo 'Our servers are temporarily offline. Please try back in a few minutes';
	}
}

function smtpemail($email,$subject,$message) {

$headers = 'From: Peregrine Manufacturing Inc <info@peregrine.ndevix.com>
To: <'.$email.'>
Subject: '.$subject.'
Date: '.date('r').'
User-Agent: nDX Mail/1.0
MIME-Version: 1.0
Content-Type: text/plain;
 charset="us-ascii"
Content-Transfer-Encoding: 7bit
Content-Disposition: inline
Message-Id: <'.date('mdY').time().'.email@s106.ndevix.com>';

$socket = pfsockopen('s105.ndevix.com', 25, $timeout);
	if(!$socket){
	echo("Our email services are temporarily offline. Please try back in a few minutes.");
	} else {
	fputs($socket, "HELO s106.ndevix.com\r\n");
	fgets($socket, 256);
	fputs($socket, "MAIL FROM:<".$from.">\r\n");
	fgets($socket, 256);
	fputs($socket, "RCPT TO:<".$email.">\r\n");
	fgets($socket, 256);
	fputs($socket, "DATA\r\n");
	fgets($socket, 256);
	fputs($socket, "".$headers."\n\n".stripslashes($message)."\r\n");
	fputs($socket, ".\r\n");
	fgets($socket, 256);
	fputs($socket, "QUIT\r\n");
	fgets($socket, 256);
	fclose($socket);
	}
}


function random_alphanum_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

function dbdate($date){
        $day  = substr($date,3,2);
        $month  = substr($date,0,2);
        $year  = substr($date,-4);
        /*
        if (($pos = strpos($date, "-")) !== FALSE) { 
            $check = substr($date, $pos+3); 
            if(strlen($check) == '4'){
                $year  = substr($date,-4);
            }
            if(strlen($check) == '2'){
                $year  = substr($date,-2);
            }
        }
        */
        
        
        
        return $year.'-'.$month.'-'.$day;
}

function get_next_pickup_date($speed = 'standard', $dropoff = null) {
	global $link;
	
	$current_hour = date('G');
	//Rush repacks - allow 2 per day. If more than 2 or after 3pm, show tomorrows date. Don't go beyond 30 days when calculating this till the math is reworked
	if($speed=='rush1' || $speed=='rush2') {
		
		$cq = mysqli_query($link, 'SELECT * FROM repacks WHERE (`speed`=\'rush1\' OR `speed`=\'rush2\') AND (`status`!=\'complete\') '.($dropoff!==null ? 'AND estimated_pickup > \''.date('Y-m-d 23:59:59', strtotime($dropoff)).'\'' : '').' ORDER BY estimated_pickup,id ASC');
		
		$repack_counts = array();
		
		while($rp = mysqli_fetch_assoc($cq)) {
			//count the number of rush repacks today if before 1pm
			$date = date('Ymd', strtotime($rp['estimated_pickup']));
			if(!$repack_counts[$date]) {
				$repack_counts[$date] = 1;
			} else {
				$repack_counts[$date]++;
			}
			
			
			
		
		}
		
		
		
		//there's nothing in the system, return it now. 
		if(count($repack_counts)==0) {
			if($current_hour<15) {
				return date('Y-m-d');
			} else {
				return date('Y-m-d', strtotime('+1 day'));
			}
		}
		
		foreach($repack_counts as $date=>$count) {
			//match todays date
			if($date == date('Ymd')) {
				if($current_hour>13) {
					$limit = 1;
				} else {
					$limit = 2;
				}
			} else {
				$limit = 2;
			}
			
			//echo '<br>'.$date.' x '.$limit.' y '.$count.' <br>';
			
			if($count < $limit) {
				$return = substr($date, 0, 4).'-'.substr($date, 4, 2).'-'.substr($date, 6, 2);
				//make sure we're not telling someone same day pickup if it's after 3pm today
				if($return == date('Y-m-d') && $current_hour > 15) return date('Y-m-d', strtotime('+1 day'));
				return $return;
			}
		}
		
		//check if we ended the last loop with a limit of 2. If so, return the next day
		
		if($limit==2) {
			$return = substr($date, 0, 4).'-'.substr($date, 4, 2).'-'.substr($date, 6, 2);
			$return = date('Y-m-d', strtotime('+1 day', strtotime($return)));
			return $return;
		}
		
		
		//something somewhere failed
		return date('Y-m-d',strtotime('+7 days'));
		
		
		
	}
	
	if($speed=='standard') {
		if($dropoff) {
			return date('Y-m-d',strtotime('+9 days', strtotime($dropoff)));
		} else {
			return date('Y-m-d',strtotime('+9 days'));
		}
		
	}
	
	//normal repacks 7 per day max, unless 63 are in queue 9 days out, 
	
	
}

function api_pull_order($id){
    global $link;
    
    $query = 'SELECT work_orders.*
                            , ANY_VALUE(CONCAT(containers.manufacturer,\' \',containers.model)) as container_name
                            , containers.*
                            , customers.*
                            , users.*
                            , repacks.*
                            , additional_work.*
                            , containers.id as container_id
                            , customers.id as customer_id
                            , users.id as login_id
                            , additional_work.id as aw_id
                            , containers.serial
                            , containers.next_repack
                            , ANY_VALUE(CONCAT(users.first_name,\' \',users.last_name)) as name
                            , repacks.id as repack_id
                            , repacks.type as repack_type
                            , repacks.status as status
                            , repacks.schedule_date as schedule_date
                            , repacks.dropoff_date as dropoff_date
                            , repacks.speed as speed
                            , repacks.estimated_pickup as estimated_pickup
                            , repacks.completed as completed
                            , repacks.notes as notes
                            , work_orders.id as wo_id
                            , work_orders.type as wo_type
                            , work_orders.schedule_date as wo_schedule_date 
                            , work_orders.dropoff_date as wo_dropoff_date
                            , work_orders.estimated_pickup as wo_estimated_pickup 
                            , work_orders.completion_date as wo_completion_date 
                            , work_orders.notes as wo_notes
                            , work_orders.status as wo_status
                            , work_orders.date as wo_date
                            , additional_work.date as aw_date
                            FROM `work_orders` 
                            LEFT JOIN containers ON work_orders.container = containers.id 
                            LEFT JOIN users ON work_orders.customer = users.id 
                            LEFT JOIN repacks ON repacks.work_order = work_orders.id 
                            LEFT JOIN additional_work ON additional_work.work_order = work_orders.id 
                            LEFT JOIN customers ON customers.id = work_orders.customer 
                            WHERE repacks.id='.$id;
    $r = mysqli_fetch_assoc(mysqli_query($link,$query));
    //echo $query;
    $data = array(
                //customer
                'Customer_ID'   => $r['customer_id'],
                'First_Name'    => $r['first_name'],
                'Last_Name'     => $r['last_name'],
                'Company'       => $r['company'],
                'Address'       => $r['address'],
                'Address_2'     => $r['address_2'],
                'City'          => $r['city'],
                'State'         => $r['state'],
                'Zip'           => $r['zip'],
                'Country'       => $r['country'],
                'Email'         => $r['email'],
                'Phone'         => $r['phone'],
                'Sponsor'       => $r['sponsor'],
                'Notes'         => $r['notes'],
                'Login_ID'      => $r['user_id'],
                
                //container
                'Container_ID'          => $r['container_id'],
                'Manufacturer'          => $r['manufacturer'],
                'Model'                 => $r['model'],
                'Serial'                => $r['serial'],
                'Dom'                   => $r['dom'],
                'AAD'                   => $r['aad'],
                'AAD_Serial'            => $r['aad_serial'],
                'AAD_Install'           => $r['aad_install'],
                'AAD_Next_Maintenance'  => $r['aad_next_maintenance'],
                'AAD_Eol'               => $r['aad_eol'],
                'Reserve'               => $r['reserve'],
                'Reserve_Size'          => $r['reserve_size'],
                'Reserve_Serial'        => $r['reserve_serial'],
                'Main'                  => $r['main'],
                'Main_Size'             => $r['main_size'],
                'Main_Serial'           => $r['main_serial'],
                'Container_Notes'       => $r['notes'],
                'Next_Repack'           => $r['next_repack'],
                'Enter_Date'            => $r['enter_date'],
                
                //repacks
                'Repack_ID'                    => $r['repack_id'],
                'Repack_Type'                  => $r['repack_type'],
                'Repack_Status'                => $r['repack_status'],
                'Repack_Schedule_Date'         => $r['repack_schedule_date'],
                'Repack_Dropoff_Date'          => $r['repack_dropoff_date'],
                'Repack_Speed'                 => $r['repack_speed'],
                'Repack_Estimated_Pickup'      => $r['repack_estimated_pickup'],
                'Repack_Completed'             => $r['repack_completed'],
                'Repack_Notes'                 => $r['repack_notes'],
                
                 //work_orders
                'WO_ID'                    => $r['wo_id'],
                'WO_Type'                  => $r['wo_type'],
                'WO_Date'                  => $r['wo_date'],
                'WO_Schedule_Date'         => $r['wo_schedule_date'],
                'WO_Dropoff_Date'          => $r['wo_dropoff_date'],
                'WO_Estimated_Pickup'      => $r['wo_estimated_pickup'],
                'WO_Completion_Date'       => $r['wo_completion_date'],
                'WO_Notes'                 => $r['wo_notes'],
                'WO_Status'                => $r['wo_status'],
                'Initial_Price'         => $r['initial_price'],
                'Paid'                  => $r['paid'],
                'Additional_Cost'       => $r['additional_cost'],
                'Total_Cost'            => $r['total_cost'],

                //additional_work
                'QB_Code'            => $r['qbcode'],
                'Description'        => $r['description'],
                'AW_Date'            => $r['aw_date'],
                );
    return $data;
}
?>
