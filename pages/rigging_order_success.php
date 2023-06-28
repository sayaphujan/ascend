<?


if ( empty( $_SESSION[ 'uid' ] ) )header( 'location: /' );

?>
<div class="container">
    <div class="pt-4">
        <p class="display-4">Order Scheduled! </p>
        <p class="lead">Thank you for scheduling your rigging appointment.<br />
            Below is a summary of your order. </p>
        <?
        if ( $_GET[ 'page' ] == 'repack_order_success' ) {

            $rq = mysqli_query( $link, 'SELECT * FROM repacks WHERE id=\'' . sf( $_GET[ 'id' ] ) . '\'' );

            $r = mysqli_fetch_assoc( $rq );

            ?>
        <div class="infobox p-3 my-3">
            <div class="row">
                <div class="col-md-6">
                    <div><u><strong>Container</strong></u></div>
                    <?

                    $cq = mysqli_query( $link, 'SELECT * FROM containers WHERE customer=\'' . sf( $_SESSION[ 'uid' ] ) . '\' AND id=\'' . sf( $r[ 'container' ] ) . '\'' );

                    $c = mysqli_fetch_assoc( $cq );

                    echo '' . $c[ 'manufacturer' ] . ' ' . $c[ 'model' ] . '' . ( $c[ 'serial' ] !== '' ? ' SN: ' . $c[ 'serial' ] : '' ) . '';
                    ?>
                </div>
                <div class="col-md-6">
                    <div><u><strong>Repack Speed</strong></u></div>
                    <?
                    if($r['type'] == 'tandem'){
                        echo $repack_label[ $r[ 'speed' ] ] . ' - $' . ($repack_pricing[$r[ 'speed' ]]+100) . '.00';
                    
                    }else if($r['type'] == 'sport'){
                    
                    echo $repack_label[ $r[ 'speed' ] ] . ' - $' . $repack_pricing[$r[ 'speed' ]] . '';
                    }
                    ?>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-md-6">
                    <div><u><strong>Dropoff Date</strong></u></div>
                    <?
                    //&container='.$_SESSION['repack_container_id'].'&speed='.$speed.'&dropoff_date='.$dropoff_date.'&estimated_pickup='.$pickup.'\'

                    echo '<span class="lead"><strong>' . date( 'm/d/Y', strtotime( $r[ 'dropoff_date' ] ) ) . '</strong></span>';

                    ?>
                </div>
                <div class="col-md-6">
                    <div><u><strong>Estimated Pickup</strong></u></div>
                    <?
                    //&container='.$_SESSION['repack_container_id'].'&speed='.$speed.'&dropoff_date='.$dropoff_date.'&estimated_pickup='.$pickup.'\'

                    echo '<span class="lead"><strong>' . date( 'm/d/Y', strtotime( $r[ 'estimated_pickup' ] ) ) . '</strong></span>';

                    ?>
                </div>
            </div>
        </div>
        <? } ?>
        <p class="lead">Please bring your equipment to our loft during regular business hours. Our loft is located at:</p>
        <div class="p-3 my-3"><strong>Chicagoland Skydiving Center</strong><br />
            1207 E Gurler Rd, Rochelle, IL 61068</div>
        <p class="lead">If you have scheduled a rush repack, you must bring in your equipment as soon as possible to avoid missing your space in line. Same day repacks are not guaranteed if brought in at the end of the day!</p>
    </div>
</div>
