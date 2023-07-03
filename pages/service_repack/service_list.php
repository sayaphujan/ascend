<?php

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
include("service_dropdown.php");

?>
<div class="container-fluid">

    <div class="row">
    	<h4><?php echo strtoupper($_GET['repack_type'].' Repack - '.$title);?></h4>
    </div>

    <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3" style="float:right;pa">
            <h5>Total <span id="total_price">$0,00</span></h5>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-12">
            <!--<div class="alert alert-warning d-none align-items-center" role="alert" id="containeralert"></div>-->
    	  <form id="service_form">
                         
            <input type="hidden" class="form-control" id="uid" name="uid" value="<?php echo $_SESSION['uid'];?>" placeholder="id"/>
            <input type="hidden" class="form-control" id="existing_container" name="existing_container" value="<?php echo $_SESSION['repack_container_id'];?>"/>
            <input type="hidden" class="form-control" id="s" name="s" value="<?php echo $serv;?>" placeholder="id"/>
    	  	<?php if($serv == 1){ ?>
                <?php if($_GET['repack_type'] == 'sport') { ?>
                    <div class="form-group">
                        <label for="make" class="control-label"><strong>Reserve Repack</strong></label>
                        <select class="form-control dd" id="reserve_repack" name="reserve_repack" >
                            <?php sport('reserve_repack'); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="make" class="control-label"><strong>Assembly</strong></label>
                        <select class="form-control dd"  id="assembly" name="assembly" >
                            <?php sport('assembly'); ?>
                        </select>
                    </div>
                     <div class="form-group">
                        <label for="make" class="control-label"><strong>Inspect and Repack</strong></label>
                        <select class="form-control dd"  id="inspect_repack" name="inspect_repack" >
                            <?php sport('inspect_repack'); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="make" class="control-label"><strong>AAD</strong></label>
                        <select class="form-control dd"  id="aad" name="aad" >
                            <?php sport('aad'); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="make" class="control-label"><strong>Inspection</strong></label>
                        <select class="form-control dd"  id="inspection" name="inspection" >
                            <?php sport('inspection'); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="make" class="control-label"><strong>Trim chk only- not a full inspect</strong></label>
                        <select class="form-control dd"  id="S-TRIMCHECK" name="S-TRIMCHECK" >
                            
                        <?php options('S-TRIMCHECK'); ?></select>
                    </div>
                    <div class="form-group">
                        <label for="make" class="control-label"><strong>CSC 25 jump check</strong></label>
                        <select class="form-control dd"  id="S-CSC25" name="S-CSC25" >
                            
                        <?php options('S-CSC25'); ?></select>
                    </div>
                    <div class="form-group">
                        <label for="make" class="control-label"><strong>30 lb strength test only</strong></label>
                        <select class="form-control dd"  id="S-30LBTEST" name="S-30LBTEST" >
                            
                        <?php options('S-30LBTEST'); ?></select>
                    </div>
                    <div class="form-group">
                        <label for="make" class="control-label"><strong>Wash</strong></label>
                        <select class="form-control dd"  id="wash" name="wash" >
                            <?php sport('wash'); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="make" class="control-label"><strong>Main</strong></label>
                        <select class="form-control dd"  id="main" name="main" >
                            <?php sport('main'); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="make" class="control-label"><strong>Scotchguard</strong></label>
                        <select class="form-control dd"  id="scotchguard" name="scotchguard" >
                            <?php sport('scotchguard'); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="make" class="control-label"><strong>Disassembly</strong></label>
                        <select class="form-control dd"  id="disassembly" name="disassembly" >
                            <?php sport('disassembly'); ?>
                        </select>
                    </div>
                <?php } else if($_GET['repack_type'] == 'tandem') { ?>
                    <div class="form-group">
                        <label for="make" class="control-label"><strong>Reserve Repack</strong></label>
                        <select class="form-control dd" id="reserve_repack" name="reserve_repack" >
                            <?php tandem('reserve_repack'); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="make" class="control-label"><strong>Assembly</strong></label>
                        <select class="form-control dd"  id="assembly" name="assembly" >
                            <?php tandem('assembly'); ?>
                        </select>
                    </div>
                <?php } else if($_GET['repack_type'] == 'pilot') { ?>
                     <div class="form-group">
                        <label for="make" class="control-label"><strong>Emergency Inspect</strong></label>
                        <select class="form-control dd"  id="emergency_inspect" name="emergency_inspect" >
                            <?php pilot('emergency_inspect'); ?>
                        </select>
                    </div>
                <?php } ?>
            <!--
    	  	<div class="form-group">
                <label for="make" class="control-label"><strong>Reserve Repack (SPORT) STANDARD LEAD TIME</strong></label>
                <select class="form-control dd"  id="S-IRS1" name="S-IRS1" >
                	<?php options('S-IRS1'); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Reserve Repack (SPORT) FRONT OF LINE</strong></label>
                <select class="form-control dd"  id="S-IRS1RUSH1" name="S-IRS1RUSH1" >
                    <?php options('S-IRS1RUSH1'); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Reserve Repack (SPORT) (RIGHT NOW)</strong></label>
                <select class="form-control dd"  id="S-IRS1RUSH2" name="S-IRS1RUSH2" >
                    <?php options('S-IRS1RUSH2'); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Reserve Repack with Main (SPORT) STANDARD LEAD TIME</strong></label>
                <select class="form-control dd"  id="S-IRS2" name="S-IRS2" >
                    
                <?php options('S-IRS2'); ?>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Reserve Repack (Tandem)</strong></label>
                <select class="form-control dd"  id="S-IRT1" name="S-IRT1" >
                    
                <?php options('S-IRT1'); ?>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Reserve Repack including Main (Tandem)</strong></label>
                <select class="form-control dd"  id="S-IRT2" name="S-IRT2" >
                    
                <?php options('S-IRT2'); ?>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Assembly and Pack Reserve and Main</strong></label>
                <select class="form-control dd"  id="S-AIPFULLSPORT" name="S-AIPFULLSPORT" >
                    
                <?php options('S-AIPFULLSPORT'); ?>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Assembly and Pack Reserve No Main</strong></label>
                <select class="form-control dd"  id="S-AIP" name="S-AIP" >
                    
                <?php options('S-AIP'); ?>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>ASSEMBLY AND PACK TANDEM SYSTEM NO MAIN</strong></label>
                <select class="form-control dd"  id="S-AIPT" name="S-AIPT" >
                    
                <?php options('S-AIPT'); ?>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>ASSEMBLY AND PACK TANDEM SYSTEM WITH MAIN</strong></label>
                <select class="form-control dd"  id="S-AIPTM" name="S-AIPTM" >
                    
                <?php options('S-AIPTM'); ?>
                    
                </select>
            </div>
            <?php if($_GET['repack_type'] == 'pilot') { ?>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Pilot Emergency Inspect and Repack</strong></label>
                <select class="form-control dd"  id="S-PACK2" name="S-PACK2" >
                    
                <?php options('S-PACK2'); ?>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Pilot Emergency Inspect and Repack (RUSH)</strong></label>
                <select class="form-control dd"  id="S-PACK2RUSH" name="S-PACK2RUSH" >
                    
                <?php options('S-PACK2RUSH'); ?>
                    
                </select>
            </div>
        <?php } ?>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Inspect and Repack L39 DROGUE</strong></label>
                <select class="form-control dd"  id="S-IRDROGUE" name="S-IRDROGUE" >
                    
                <?php options('S-IRDROGUE'); ?>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Inspect and Repack L39 DROGUE (RUSH)</strong></label>
                <select class="form-control dd"  id="S-IRDROGERUSH" name="S-IRDROGERUSH" >
                    
                <?php options('S-IRDROGERUSH'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>AAD install/remove ONLY</strong></label>
                <select class="form-control dd"  id="S-AAD1" name="S-AAD1" >
                    
                <?php options('S-AAD1'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Open/Close for  AAD</strong></label>
                <select class="form-control dd"  id="S-AAD2" name="S-AAD2" >
                    
                <?php options('S-AAD2'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Harness/Container Ispection only</strong></label>
                <select class="form-control dd"  id="S-INSPHC" name="S-INSPHC" >
                    
                <?php options('S-INSPHC'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Canopy inspection only (visuial)</strong></label>
                <select class="form-control dd"  id="S-INSPCAN" name="S-INSPCAN" >
                    
                <?php options('S-INSPCAN'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Full System Inspection only</strong></label>
                <select class="form-control dd"  id="S-INSPFULLSYS" name="S-INSPFULLSYS" >
                    
                <?php options('S-INSPFULLSYS'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Trim chk only- not a full inspect</strong></label>
                <select class="form-control dd"  id="S-TRIMCHECK" name="S-TRIMCHECK" >
                    
                <?php options('S-TRIMCHECK'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>CSC 25 jump check</strong></label>
                <select class="form-control dd"  id="S-CSC25" name="S-CSC25" >
                    
                <?php options('S-CSC25'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>30 lb strength test only</strong></label>
                <select class="form-control dd"  id="S-30LBTEST" name="S-30LBTEST" >
                    
                <?php options('S-30LBTEST'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Main Assembly</strong></label>
                <select class="form-control dd"  id="S-MAINASSEMBLY" name="S-MAINASSEMBLY" >
                    
                <?php options('S-MAINASSEMBLY'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Main Pack</strong></label>
                <select class="form-control dd"  id="S-PACKMAIN" name="S-PACKMAIN" >
                    
                <?php options('S-PACKMAIN'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Main Untangle</strong></label>
                <select class="form-control dd"  id="S-UNTANGLEMAIN" name="S-UNTANGLEMAIN" >
                    
                <?php options('S-UNTANGLEMAIN'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>WASH H/C</strong></label>
                <select class="form-control dd"  id="S-WASHHC" name="S-WASHHC" >
                    
                <?php options('S-WASHHC'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Wash Canopy</strong></label>
                <select class="form-control dd"  id="S-WASHCAN" name="S-WASHCAN" >
                    
                <?php options('S-WASHCAN'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Wash TM Rig</strong></label>
                <select class="form-control dd"  id="S-WASHTANDEM" name="S-WASHTANDEM" >
                    
                <?php options('S-WASHTANDEM'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Scotchguard full rig</strong></label>
                <select class="form-control dd"  id="S-SCOTCH1" name="S-SCOTCH1" >
                    
                <?php options('S-SCOTCH1'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Scothgard Legpads only</strong></label>
                <select class="form-control dd"  id="S-SCOTCH2" name="S-SCOTCH2" >
                    
                <?php options('S-SCOTCH2'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Disassemble Canopy</strong></label>
                <select class="form-control dd"  id="S-DISASS1" name="S-DISASS1" >
                    
                <?php options('S-DISASS1'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Complete Disassembly</strong></label>
                <select class="form-control dd"  id="S-DISASS2" name="S-DISASS2" >
                    
                <?php options('S-DISASS2'); ?></select>
            </div>-->
    	  	<?php }
    	  		if($serv == 2){ 
    	  	 ?>
			            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace BOC pocket</strong></label>
                <select class="form-control dd"  id="S-REPLBOC" name="S-REPLBOC" >
                    
                <?php options('S-REPLBOC'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Cypres 4/8yr check</strong></label>
                <select class="form-control dd"  id="S-AADMAINT" name="S-AADMAINT" >
                    
                <?php options('S-AADMAINT'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Sport kill line replace</strong></label>
                <select class="form-control dd"  id="S-KLREPLACE" name="S-KLREPLACE" >
                    
                <?php options('S-KLREPLACE'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>TM kill line replace</strong></label>
                <select class="form-control dd"  id="S-TKLREPLACE" name="S-TKLREPLACE" >
                    
                <?php options('S-TKLREPLACE'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Waterproof Zipper rep</strong></label>
                <select class="form-control dd"  id="S-WPZIP1" name="S-WPZIP1" >
                    
                <?php options('S-WPZIP1'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Waterproof Sep. Jacket rep</strong></label>
                <select class="form-control dd"  id="S-WPZIP2" name="S-WPZIP2" >
                    
                <?php options('S-WPZIP2'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Regular #5 zipper rep</strong></label>
                <select class="form-control dd"  id="S-ZIP1" name="S-ZIP1" >
                    
                <?php options('S-ZIP1'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Wingsuit Zipper replace</strong></label>
                <select class="form-control dd"  id="S-WSZIP1" name="S-WSZIP1" >
                    
                <?php options('S-WSZIP1'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Reattach or flix exist slide</strong></label>
                <select class="form-control dd"  id="S-ZIPSLIDEFIX" name="S-ZIPSLIDEFIX" >
                    
                <?php options('S-ZIPSLIDEFIX'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Zipper Slide Replace</strong></label>
                <select class="form-control dd"  id="S-ZIPSLIDEREPL1" name="S-ZIPSLIDEREPL1" >
                    
                <?php options('S-ZIPSLIDEREPL1'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Expensive Zip Slide Rep</strong></label>
                <select class="form-control dd"  id="S-ZIPSLIDE2" name="S-ZIPSLIDE2" >
                    
                <?php options('S-ZIPSLIDE2'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add zip pocket-wingsuit</strong></label>
                <select class="form-control dd"  id="S-WSZIPPOC" name="S-WSZIPPOC" >
                    
                <?php options('S-WSZIPPOC'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add zip pocket</strong></label>
                <select class="form-control dd"  id="S-ZIPPOC" name="S-ZIPPOC" >
                    
                <?php options('S-ZIPPOC'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Pre-made patch sew-on</strong></label>
                <select class="form-control dd"  id="S-PMPATCH" name="S-PMPATCH" >
                    
                <?php options('S-PMPATCH'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Small Jumpsuit Patch</strong></label>
                <select class="form-control dd"  id="S-JSPATCH1" name="S-JSPATCH1" >
                    
                <?php options('S-JSPATCH1'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Large Jumpsuit Patch</strong></label>
                <select class="form-control dd"  id="S-JSPATCH2" name="S-JSPATCH2" >
                    
                <?php options('S-JSPATCH2'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add RDS pocket</strong></label>
                <select class="form-control dd"  id="S-RDSPOC" name="S-RDSPOC" >
                    
                <?php options('S-RDSPOC'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Jumpsuit Seam</strong></label>
                <select class="form-control dd"  id="S-JSSEAMREP" name="S-JSSEAMREP" >
                    
                <?php options('S-JSSEAMREP'); ?></select>
            </div>            
            <div class="form-group">
                <label for="make" class="control-label"><strong>Bootie repair</strong></label>
                <select class="form-control dd"  id="S-BOOTIEREP" name="S-BOOTIEREP" >
                    
                <?php options('S-BOOTIEREP'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Whole Butt Patch</strong></label>
                <select class="form-control dd"  id="S-BUTTPATCH" name="S-BUTTPATCH" >
                    
                <?php options('S-BUTTPATCH'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Install AFF BOC</strong></label>
                <select class="form-control dd"  id="S-AFFBOCINS" name="S-AFFBOCINS" >
                    
                <?php options('S-AFFBOCINS'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Install butt bungee (12")</strong></label>
                <select class="form-control dd"  id="S-BUNGEEINST" name="S-BUNGEEINST" >
                    
                <?php options('S-BUNGEEINST'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Install legpads- sport</strong></label>
                <select class="form-control dd"  id="S-LEGPADINST" name="S-LEGPADINST" >
                    
                <?php options('S-LEGPADINST'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>D-bag band stow</strong></label>
                <select class="form-control dd"  id="S-BANDSTOW" name="S-BANDSTOW" >
                    
                <?php options('S-BANDSTOW'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Install new PC handle</strong></label>
                <select class="form-control dd"  id="S-PCHAND" name="S-PCHAND" >
                    
                <?php options('S-PCHAND'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Rep riser toggle keepers</strong></label>
                <select class="form-control dd"  id="S-TOGKEEPFIX" name="S-TOGKEEPFIX" >
                    
                <?php options('S-TOGKEEPFIX'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Slider stop riser mod</strong></label>
                <select class="form-control dd"  id="S-SLIDERSTOP" name="S-SLIDERSTOP" >
                    
                <?php options('S-SLIDERSTOP'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace velcro/elastic</strong></label>
                <select class="form-control dd"  id="S-VLELASTIC" name="S-VLELASTIC" >
                    
                <?php options('S-VLELASTIC'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace MLW velcro</strong></label>
                <select class="form-control dd"  id="S-VELCRO" name="S-VELCRO" >
                    
                <?php options('S-VELCRO'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add Bridle protection</strong></label>
                <select class="form-control dd"  id="S-BRIDCOVER" name="S-BRIDCOVER" >
                    
                <?php options('S-BRIDCOVER'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace UPT res flap</strong></label>
                <select class="form-control dd"  id="S-UPTRESFLAP" name="S-UPTRESFLAP" >
                    
                <?php options('S-UPTRESFLAP'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace stiffener/ no grommet</strong></label>
                <select class="form-control dd"  id="S-REPSTIF" name="S-REPSTIF" >
                    
                <?php options('S-REPSTIF'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace stiffener/grommet</strong></label>
                <select class="form-control dd"  id="S-REPSTIFGROM" name="S-REPSTIFGROM" >
                    
                <?php options('S-REPSTIFGROM'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Rings for  wing attachment</strong></label>
                <select class="form-control dd"  id="S-CAMWING" name="S-CAMWING" >
                    
                <?php options('S-CAMWING'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add Fastex clip</strong></label>
                <select class="form-control dd"  id="S-FASTEX" name="S-FASTEX" >
                    
                <?php options('S-FASTEX'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add snap</strong></label>
                <select class="form-control dd"  id="S-SNAP1" name="S-SNAP1" >
                    
                <?php options('S-SNAP1'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add plastic snap w/bartack</strong></label>
                <select class="form-control dd"  id="S-SNAP2" name="S-SNAP2" >
                    
                <?php options('S-SNAP2'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Rep Grommet</strong></label>
                <select class="form-control dd"  id="S-REPLGROM#0" name="S-REPLGROM#0" >
                    
                <?php options('S-REPLGROM#0'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Rep #8 SS grommet</strong></label>
                <select class="form-control dd"  id="S-REPLGROM#2" name="S-REPLGROM#2" >
                    
                <?php options('S-REPLGROM#2'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add RSL to  risers</strong></label>
                <select class="form-control dd"  id="S-RSLRIS" name="S-RSLRIS" >
                    
                <?php options('S-RSLRIS'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace heat shrink (EA)</strong></label>
                <select class="form-control dd"  id="S-HEATSHRINK" name="S-HEATSHRINK" >
                    
                <?php options('S-HEATSHRINK'); ?></select>
            </div>
            <?php }
    	  		if($serv == 3){ 
    	  	 ?>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Recoil Ripcord System</strong></label>
                <select class="form-control dd"  id="S-REPRECOILRC" name="S-REPRECOILRC" >
                <?php options('S-REPRECOILRC'); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Patch Drogue Mesh</strong></label>
                <select class="form-control dd"  id="S-PATCHDROMESH" name="S-PATCHDROMESH" >
                    
                <?php options('S-PATCHDROMESH'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>T11 Reserve Repack</strong></label>
                <select class="form-control dd"  id="S-PACKT11" name="S-PACKT11" >
                    
                <?php options('S-PACKT11'); ?></select>
            </div>
            <!-- END -->

            <div class="form-group">
                <label for="make" class="control-label"><strong>Tandem Passenger Harness Inspect</strong></label>
                <select class="form-control dd"  id="" name="" >
                    
                <?php options(''); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>TANDEM ASSEMBLY AND PACK, No Main</strong></label>
                <select class="form-control dd"  id="" name="" >
                    
                <?php options(''); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>TANDEM canopy inspect</strong></label>
                                <select class="form-control dd"  id="" name="" >
                    
                <?php options(''); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>TANDEM main pack</strong></label>
                <select class="form-control dd"  id="" name="" >
                    
                <?php options(''); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>REPLACE Tandem BOC                
                <select class="form-control dd"  id="" name="" >
                    
                <?php options(''); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Rep plastic on tm  warn label</strong></label>
                                <select class="form-control dd"  id="" name="" >
                    
                <?php options(''); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Rebuild TANDEM Y Mod</strong></label>
                                <select class="form-control dd"  id="" name="" >
                    
                <?php options(''); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Install legpads- TANDEM</strong></label>
                                <select class="form-control dd"  id="" name="" >
                    
                <?php options(''); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>TM Cypres window</strong></label>
                                <select class="form-control dd"  id="" name="" >
                    
                <?php options(''); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Drogue Poly replacement</strong></label>
                <select class="form-control dd"  id="" name="" >
                    
                <?php options(''); ?></select>
            </div>
            <?php }
    	  		if($serv == 4){ 
    	  	 ?>
                        <div class="form-group">
                <label for="make" class="control-label"><strong>Tandem/Military Re-line</strong></label>
                <select class="form-control dd"  id="S-RELINE TANDEM" name="S-RELINE TANDEM" >
                    
                <?php options('S-RELINE TANDEM'); ?></select>
            </div>

                  <div class="form-group">
                <label for="make" class="control-label"><strong>Sport Re-line, labor only</strong></label>
                <select class="form-control dd"  id="S-RELINE SPORT" name="S-RELINE SPORT" >
                    
                <?php options('S-RELINE SPORT'); ?></select>
            </div>
            
            <div class="form-group">
                <label for="make" class="control-label"><strong>Reserve re-line</strong></label>
                <select class="form-control dd"  id="S-RELINE RESERVE" name="S-RELINE RESERVE" >
                    
                <?php options('S-RELINE RESERVE'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Steering Lines (pair)</strong></label>
                <select class="form-control dd"  id="S-REPLLST" name="S-REPLLST" >
                    
                <?php options('S-REPLLST'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Sacraficial line</strong></label>
                <select class="form-control dd"  id="S-SACLINE" name="S-SACLINE" >
                    
                <?php options('S-SACLINE'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>lengthen/shorten brakes</strong></label>
                <select class="form-control dd"  id="S-ADJSTEER" name="S-ADJSTEER" >
                    
                <?php options('S-ADJSTEER'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace both bk-tog</strong></label>
                <select class="form-control dd"  id="S-REPBRKTOG" name="S-REPBRKTOG" >
                    
                <?php options('S-REPBRKTOG'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Reserve line (pair)</strong></label>
                <select class="form-control dd"  id="S-REPLLSTRES" name="S-REPLLSTRES" >
                    
                <?php options('S-REPLLSTRES'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Reserve bk-tog</strong></label>
                <select class="form-control dd"  id="S-REPLBRKTOGR" name="S-REPLBRKTOGR" >
                    
                <?php options('S-REPLBRKTOGR'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Bartack</strong></label>
                <select class="form-control dd"  id="S-BARTACK" name="S-BARTACK" >
                    
                <?php options('S-BARTACK'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace 1 line</strong></label>
                <select class="form-control dd"  id="S-LINEREPL" name="S-LINEREPL" >
                    
                <?php options('S-LINEREPL'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>6-12" patch</strong></label>
                <select class="form-control dd"  id="S-BPATCH1" name="S-BPATCH1" >
                    
                <?php options('S-BPATCH1'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>12-30" patch</strong></label>
                <select class="form-control dd"  id="S-BPATCH2" name="S-BPATCH2" >
                    
                <?php options('S-BPATCH2'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>31-48" patch</strong></label>
                <select class="form-control dd"  id="S-BPATCH3" name="S-BPATCH3" >
                    
                <?php options('S-BPATCH3'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>49-66" patch</strong></label>
                <select class="form-control dd"  id="S-BPATCH4" name="S-BPATCH4" >
                    
                <?php options('S-BPATCH4'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>67-84" patch</strong></label>
                <select class="form-control dd"  id="S-BPATCH5" name="S-BPATCH5" >
                    
                <?php options('S-BPATCH5'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>85"-101" patch</strong></label>
                <select class="form-control dd"  id="S-BPATCH6" name="S-BPATCH6" >
                    
                <?php options('S-BPATCH6'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>cut crossport</strong></label>
                <select class="form-control dd"  id="S-BPATCH7" name="S-BPATCH7" >
                    
                <?php options('S-BPATCH7'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>seam</strong></label>
                <select class="form-control dd"  id="S-SEAMREPAIR" name="S-SEAMREPAIR" >
                    
                <?php options('S-SEAMREPAIR'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Remove/replc PCA</strong></label>
                <select class="form-control dd"  id="S-PCA" name="S-PCA" >
                    
                <?php options('S-PCA'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Slider channel patch</strong></label>
                <select class="form-control dd"  id="S-SLIDERCHAN" name="S-SLIDERCHAN" >
                    
                <?php options('S-SLIDERCHAN'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Remove/replc packing tab</strong></label>
                <select class="form-control dd"  id="S-PACKTAB" name="S-PACKTAB" >
                    
                <?php options('S-PACKTAB'); ?></select>
            </div>
                        <div class="form-group">
                <label for="make" class="control-label"><strong>Remove/replc data panel</strong></label>
                <select class="form-control dd"  id="S-DATAPANEL" name="S-DATAPANEL" >
                    
                <?php options('S-DATAPANEL'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Remove/replc tape</strong></label>
                <select class="form-control dd"  id="S-REPLTAPE" name="S-REPLTAPE" >
                    
                <?php options('S-REPLTAPE'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Remove/replc line atch</strong></label>
                <select class="form-control dd"  id="S-REPLLATTACH" name="S-REPLLATTACH" >
                    
                <?php options('S-REPLLATTACH'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Ripstop Patch (2 pieces)</strong></label>
                <select class="form-control dd"  id="S-RIPSTOPSTICK" name="S-RIPSTOPSTICK" >
                    
                <?php options('S-RIPSTOPSTICK'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add slider pocket</strong></label>
                <select class="form-control dd"  id="S-SLIDERPOCK" name="S-SLIDERPOCK" >
                    
                <?php options('S-SLIDERPOCK'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace 1 Slider Channel</strong></label>
                <select class="form-control dd"  id="S-SLDRCHAN" name="S-SLDRCHAN" >
                    
                <?php options('S-SLDRCHAN'); ?></select>
            </div>
    	  	<?php } 
            if($serv == 5){ 
                ?>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Shorten Leg Staps (Webbing Only)</strong></label>
                <select class="form-control dd"  id="S-HARNLS1" name="S-HARNLS1" >
                    
                <?php options('S-HARNLS1'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Shorten Chest strap</strong></label>
                <select class="form-control dd"  id="S-HARNCHEST1" name="S-HARNCHEST1" >
                    
                <?php options('S-HARNCHEST1'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Long Side  Chest Strap (RING HARNESS)</strong></label>
                <select class="form-control dd"  id="S-HARNCHEST2" name="S-HARNCHEST2" >
                    
                <?php options('S-HARNCHEST2'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Long Side  Chest Strap (STD HARNESS)</strong></label>
                <select class="form-control dd"  id="S-HARNCHEST3" name="S-HARNCHEST3" >
                    
                <?php options('S-HARNCHEST3'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Short Side Chest Strap (RING HARNESS) (Use Existing HW)</strong></label>
                <select class="form-control dd"  id="S-HARNCHEST4" name="S-HARNCHEST4" >
                    
                <?php options('S-HARNCHEST4'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Short Side Chest Strap (RING HARNESS)(USE HW)</strong></label>
                <select class="form-control dd"  id="S-HARNCHEST5" name="S-HARNCHEST5" >
                    
                <?php options('S-HARNCHEST5'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Short Side Chest Strap (STD HARNESS)  (USE EXISTING HW) </strong></label>
                <select class="form-control dd"  id="S-HARNCHEST6" name="S-HARNCHEST6" >
                    
                <?php options('S-HARNCHEST6'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Short Side Chest Strap (STD HARNESS)  (NEW HW)</strong></label>
                <select class="form-control dd"  id="S-HARNCHEST7" name="S-HARNCHEST7" >
                    
                <?php options('S-HARNCHEST7'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace  Leg Straps (PAIR)</strong></label>
                <select class="form-control dd"  id="S-HARNLS2" name="S-HARNLS2" >
                    
                <?php options('S-HARNLS2'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace from hip rings down</strong></label>
                <select class="form-control dd"  id="S-HARNMLW2" name="S-HARNMLW2" >
                    
                <?php options('S-HARNMLW2'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace MLW between rings (Ring Harness)</strong></label>
                <select class="form-control dd"  id="S-HARNMLW1" name="S-HARNMLW1" >
                    
                <?php options('S-HARNMLW1'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace MLW (FULL) 4 RING HARNESS (REUSE EXISTING HW)</strong></label>
                <select class="form-control dd"  id="S-HARNMLW3" name="S-HARNMLW3" >
                    
                <?php options('S-HARNMLW3'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace MLW (FULL) 4 RING HARNESS NEW HW</strong></label>
                <select class="form-control dd"  id="S-HARNMLW4" name="S-HARNMLW4" >
                    
                <?php options('S-HARNMLW4'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace MLW (FULL) 2 RING HARNESS (REUSE EXISTING HW HIP RING ONLY</strong></label>
                <select class="form-control dd"  id="S-HARNMLW5" name="S-HARNMLW5" >
                    
                <?php options('S-HARNMLW5'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace MLW (FULL)2  RING HARNESS NEW HW HIP RING ONLY</strong></label>
                <select class="form-control dd"  id="S-HARNMLW6" name="S-HARNMLW6" >
                    
                <?php options('S-HARNMLW6'); ?></select>
            </div>
        <?php } ?>          
    	  	<!-- SEPARATE NOTATION AT THE BOTTOM OF SERVICE  -->
    		<hr/>
    		<div class="form-group">
                <label for="make" class="control-label"><strong>Rush Fee(front of line)</strong></label>
                <select class="form-control dd"  id="S-RUSH1" name="S-RUSH1" >
                    
                <?php sport('S-RUSH1'); ?></select>

            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Rush Fee(right now)</strong></label>
                <select class="form-control dd"  id="S-RUSH2" name="S-RUSH2" >
                    
                <?php sport('S-RUSH2'); ?></select>

            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Hourly shop rate</strong></label>
                <select class="form-control dd"  id="S-SHOPRATE" name="S-SHOPRATE" >
                	<?php sport('S-SHOPRATE'); ?></select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Monthly storage fee</strong></label>
                <select class="form-control dd"  id="S-STORAGE" name="S-STORAGE" >
                    <?php sport('S-STORAGE'); ?></select>
            </div>
            <button  class="btn btn-primary" id="next_step" style="float: right;" onclick="add_service_option();  return false;">Continue Scheduling</button>        
          </form>
    	</div>
    </div>

</div>
<script>
$( document ).ready(function() {
    //$('#service_form select').attr('readonly', 'readonly');
    var total_price_sub = 0;
    var total_price = 0;
    var base_price = 0;
    var price = base_price;
    //calculate_total_price(price);
    $('.dd').trigger('change');
    $('.dd').change(function()
    {
        var opt = $(this).val();
        console.log("opt "+opt);
        if (~opt.indexOf("$")){
            var price = opt.split("$").pop();
            if (~price.indexOf(")")){
            price.slice(0,-1);
            }
            console.log("price "+price);
            calculate_total_price(price);
        }
    });
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

function add_service_option() {
    $.post( "<?php echo root();?>inc/exec.php?act=add_service_option&repack_type=<?php echo $_GET['repack_type'];?>&ajax=1&schedule=1&container=<?php echo $_GET['container'];?>&s=<?php echo $s;?>", $('#service_form').serialize(), '', 'script');
}

function calculate_total_price(price){
    var total_price_sub = parseFloat($('#total_price').text().replace('$', ''));
    total_price_sub += parseFloat(price);
    var total_price = total_price_sub.toFixed(2);
    $('#total_price').html('$'+number_format(total_price, 2, '.', ','));
}
</script>