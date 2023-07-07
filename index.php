<?php
/*if($_SERVER['REMOTE_ADDR']!=='114.10.16.126' && $_SERVER['REMOTE_ADDR']!=='103.97.101.1'){
    echo 'Updates in progress.';
    exit();
    header('Location: https://peregrinemfginc.com/', true, 301);
    die();  
}*/
//if($_SERVER['REMOTE_ADDR']!=='10.0.0.50' && $_SERVER['REMOTE_ADDR']!=='103.97.101.1' && $_SERVER['REMOTE_ADDR'] !== '119.2.52.102' && $_SERVER['REMOTE_ADDR'] !== '103.105.28.149') {
//echo 'Updates in progress.';
//exit();
//header('Location: https://peregrinemfginc.com/', true, 301);
//die();
//}

$title = 'Ascend Rigging';
require_once 'inc/functions.php'; 

if ( $_SERVER[ 'SERVER_PORT' ] !== '443' && $_SERVER[ 'SERVER_PORT' ] !== '80' ) {
    header( 'location: ' . root() );
    exit();
}

if (isset($_SESSION['adminid'])) {

    switch ( $_GET[ 'page' ] ) {
    
    	case 'checkout':
    		$page = 'pages/checkout.php';
    		$title .= '';
    		break;
    		
    	case 'confirmation':
    		$page = 'pages/confirmation.php';
    		$title .= '';
    		break;
    	
    	case 'container_information':
            $page = 'pages/container_information.php';
            $title .= '';
            break;

        case 'service_repack':
            $page = 'pages/service_repack.php';
            $title .= '';
            break;

        case 'service':
            $page = 'pages/service.php';
            $title .= '';
            break;

        case 'schedule_sport_repack':
    		$page = 'pages/schedule_sport_repack.php';
    		$title .= '';
    		break;
    		
    	case 'schedule_tandem_repack':
    		$page = 'pages/schedule_tandem_repack.php';
    		$title .= '';
    		break;
    	
    	case 'rigging_order_success':
    		$page = 'pages/rigging_order_success.php';
    		$title .= '';
    	
    	break;
    	
    	case 'repack_order_success':
    		$page = 'pages/rigging_order_success.php';
    		$title .= '';
    	break;
    	
    	case 'service_order_success':
    		$page = 'pages/service_order_success.php';
    		$title .= '';
    	break;
    	
    	case 'settings':
    		$page = 'pages/settings.php';
    		$title .= '';
    	break;
    	
    	case 'account':
    		$page = 'administrator/account.php';
    		$title .= '';
    	break;
    	
    	case 'staff':
    		$page = 'administrator/staff.php';
    		$title .= '';
    	break;
    	
    	case 'add-staff':
    		$page = 'administrator/add_staff.php';
    		$title .= '';
    	break;

        case 'service-options':
            $page = 'administrator/service_options.php';
            $title .= '';
        break;

        case 'service-order':
            $page = 'administrator/service_order.php';
            $title .= '';
        break;

        case 'service-cart-summary':
            $page = 'administrator/service_cart_summary.php';
            $title .= '';
        break;

        case 'add-service-option':
            $page = 'administrator/add_service_option.php';
            $title .= '';
        break;
    	
    	case 'repacks':
    		$page = 'administrator/repacks.php';
    		$title .= '';
    	break;
    	
    	case 'repacks-review':
    		$page = 'pages/repacks_review.php';
    		$title .= '';
    	break;
    	
    	case 'container-review':
    		$page = 'pages/container_review.php';
    		$title .= '';
    	break;
    	
    	case 'view_repack':
    		$page = 'pages/view_repack.php';
    		$title .= '';
    	break;
    	
    	case 'maintenance':
    		$page = 'pages/maintenance.php';
    		$title .= '';
    	break;
    	
    	case 'customers':
    		$page = 'administrator/customers.php';
    		$title .= '';
    	break;
    	
    	case 'customer':
    		$page = 'pages/customer.php';
    		$title .= '';
    	break;
    	
    	case 'containers':
    		$page = 'pages/containers.php';
    		$title .= '';
    	break;
    	
    	case 'container':
    		$page = 'pages/container.php';
    		$title .= '';
    	break;
    
    	default:
    		$page = 'administrator/main.php';
    		$title .= '';
    		break;
    }		
}else if (isset($_SESSION['uid'])) {

    switch ( $_GET[ 'page' ] ) {
    
    	case 'checkout':
    		$page = 'pages/checkout.php';
    		$title .= '';
    		break;
    		
    	case 'confirmation':
    		$page = 'pages/confirmation.php';
    		$title .= '';
    		break;

        case 'container_information':
            $page = 'pages/container_information.php';
            $title .= '';
            break;

        case 'service_repack':
            $page = 'pages/service_repack.php';
            $title .= '';
            break;

        case 'service':
            $page = 'pages/service.php';
            $title .= '';
            break;
    	
    	case 'schedule_sport_repack':
    		$page = 'pages/schedule_sport_repack.php';
    		$title .= '';
    		break;
    		
    	case 'schedule_tandem_repack':
    		$page = 'pages/schedule_tandem_repack.php';
    		$title .= '';
    		break;
    	
    	case 'rigging_order_success':
    		$page = 'pages/rigging_order_success.php';
    		$title .= '';
    	
    	break;
    	
    	case 'repack_order_success':
    		$page = 'pages/rigging_order_success.php';
    		$title .= '';
    	break;
    	
    	case 'service_order_success':
    		$page = 'pages/service_order_success.php';
    		$title .= '';
    	break;
    	
    	case 'settings':
    		$page = 'pages/settings.php';
    		$title .= '';
    	break;
    	
    	case 'account':
    		$page = 'pages/account.php';
    		$title .= '';
    	break;
    	
    	case 'staff':
    		$page = 'pages/staff.php';
    		$title .= '';
    	break;
    	
    	case 'add-staff':
    		$page = 'pages/add_staff.php';
    		$title .= '';
    	break;
    	
    	case 'repacks':
    		$page = 'pages/repacks.php';
    		$title .= '';
    	break;
    	
    	case 'repacks-review':
    		$page = 'pages/repacks_review.php';
    		$title .= '';
    	break;
    	
    	case 'container-review':
    		$page = 'pages/container_review.php';
    		$title .= '';
    	break;
    	
    	case 'view_repack':
    		$page = 'pages/view_repack.php';
    		$title .= '';
    	break;
    	
    	case 'maintenance':
    		$page = 'pages/maintenance.php';
    		$title .= '';
    	break;
    	
    	case 'customers':
    		$page = 'pages/customers.php';
    		$title .= '';
    	break;
    	
    	case 'customer':
    		$page = 'pages/customer.php';
    		$title .= '';
    	break;
    	
    	case 'containers':
    		$page = 'pages/containers.php';
    		$title .= '';
    	break;
    	
    	case 'container':
    		$page = 'pages/container.php';
    		$title .= '';
    	break;
    
    	default:
    		$page = 'pages/main.php';
    		$title .= '';
    		break;
    }		
}else{
    switch ( $_GET[ 'page' ] ) {

        
        case 'container_information':
            $page = 'pages/container_information.php';
            $title .= '';
            break;

        case 'service_repack':
            $page = 'pages/service_repack.php';
            $title .= '';
            break;

        case 'service':
            $page = 'pages/service.php';
            $title .= '';
            break;
        
        case 'schedule_sport_repack':
    		$page = 'pages/schedule_sport_repack.php';
    		$title .= '';
    	break;
    	
    	case 'schedule_tandem_repack':
    		$page = 'pages/schedule_tandem_repack.php';
    		$title .= '';
    	break;
    
        case 'admin':
    		$page = 'administrator/login.php';
    		$title .= '';
    	break;
    
    	default:
    		$page = 'pages/main.php';
    		$title .= '';
    		break;
    }

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.structure.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.theme.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" />
	 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="<?php echo root();?>master.css"/>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://www.jqueryscript.net/demo/handle-window-session-storage/jquery.session.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.0/moment-with-locales.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"></script>
    <title>
        <?php echo $title; ?>
    </title>
    <style>
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #f4f8fb;
        }
        .table .even {
            background-color:transparent;
        }
        
        .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
            color: #f7f7f7;
        }
    </style>
    
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo root(); ?>">
                <!--<img src="<?php echo root('images/logo.png'); ?>" height="30" alt="">--> Ascend Rigging - Services
            </a>
             
            <?php
            
            if (isset($_SESSION['uid']) || isset($_SESSION['adminid'])) { ?>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
						<?php
						    if ($_SESSION['type']=='admin' || $_SESSION['type']=='staff' || $_SESSION['type']=='customer') { 
						?>
					
                                <div class="dropdown">
                                  <li class="dropdown-toggle" type="button" data-toggle="dropdown" style="margin-top:10px;margin-right:10px;">Schedule a Service
                                  <span class="caret"></span></li>
                                  <ul class="dropdown-menu" style="background-color:#a51522;border:transparent;">
                                    <li><a class="nav-link" href="<?php echo root()?>service_repack/?s=1">Assemblies, Repacks, Inspections</a></li>
                                    <li><a class="nav-link" href="<?php echo root()?>service_repack/?s=2">Common Maintenance Items</a></li>
                                    <li><a class="nav-link" href="<?php echo root()?>service_repack/?s=3">Tandem Maintenance</a></li>
                                    <li><a class="nav-link" href="<?php echo root()?>service_repack/?s=4">Canopy Sewing</a></li>
                                    <li><a class="nav-link" href="<?php echo root()?>service_repack/?s=5">Harness Work</a></li>
                                  </ul>
                                </div>
						
						<?php
						    }
						    if ($_SESSION['type']=='customer') 
						    {
						?>
						    <li class="nav-item">
                                <a class="nav-link" href="<?php echo root()?>container-review/">My Containers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo root()?>repacks-review/">My Repacks</a>
                            </li>
						<?php
						    }
						    if ($_SESSION['type']=='admin') 
						    { 
						?>
						        <div class="dropdown">
                                  <li class="dropdown-toggle" type="button" data-toggle="dropdown" style="margin-top:10px;margin-right:10px;">Admin
                                  <span class="caret"></span></li>
                                  <ul class="dropdown-menu" style="background-color:#a51522;border:transparent;">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo root()?>repacks/">Repacks</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo root()?>service-options/">Service Options</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo root()?>service-order/">Service Order</a>
                                    </li>
            						<li class="nav-item">
                                        <a class="nav-link" href="<?php echo root()?>customers/">Customers</a>
                                    </li>
            					
                                    
            						<li class="nav-item">
                                        <a class="nav-link" href="<?php echo root()?>staff/">Staff</a>
                                    </li>
                                    <!--
            						<li class="nav-item">
                                        <a class="nav-link" href="<?php echo root()?>settings/">Settings</a>
                                    </li>-->
                                  </ul>
                                </div>
						<?php } ?>
					    
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo root()?>account/">Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo root()?>do/logout/">Logout</a>
                        </li>
                    </ul>
                </div>
            <?php } else { ?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        
                    </li>
                </ul>
            <?php } ?>
        </div>
    </nav>
    <header class="py-5">
   		<img src="<?php echo root('images/ar-logo.png'); ?>" alt="" class="img-fluid d-block mx-auto" />
    </header>
	


    <?php 
    if ($_SESSION['error']) {
        echo '<div class="container">'.$_SESSION['error'].'</div>';
        unset($_SESSION['error']);
    }
    include $page;
    ?>

    <br/>
</body>
</html>