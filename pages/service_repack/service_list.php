<?php
$s = $_GET['s'];

switch ($s) {
	case '1':
		$o = 'Assemblies, Repacks, Inspections';
		break;
	case '2':
		$o = 'Common Maintenance Items';
		break;
	case '3':
		$o = 'Tandem Maintenance';
		break;
	case '4':
		$o = 'Canopy Sewing';
		break;
	case '5':
		$o = 'Harness Work';
		break;
	
	default:
		$o = 'Assemblies, Repacks, Inspections';
		break;
}

?>
<div class="container-fluid">

    <div class="row">
    	<h4><?php echo $o;?></h4>
    </div>

    <div class="row">
    	<div class="col-md-12">
            <div class="alert alert-warning d-none align-items-center" role="alert" id="containeralert"></div>
    	  <form id="service_form">
            <input type="hidden" class="form-control" id="existing_container" name="existing_container" value="<?php echo $_SESSION['repack_container_id'];?>"/>
    	  	<?php if($s == 1){ ?>
    	  	            <div class="form-group">
                <label for="make" class="control-label"><strong>Reserve Repack (SPORT) STANDARD LEAD TIME</strong></label>
                <select class="form-control"  id="S-IRS1" name="S-IRS1" >
                	
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Reserve Repack (SPORT) FRONT OF LINE</strong></label>
                <select class="form-control"  id="S-IRS1RUSH1" name="S-IRS1RUSH1" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Reserve Repack (SPORT) (RIGHT NOW)</strong></label>
                <select class="form-control"  id="S-IRS1RUSH2" name="S-IRS1RUSH2" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Reserve Repack with Main (SPORT) STANDARD LEAD TIME</strong></label>
                <select class="form-control"  id="S-IRS2" name="S-IRS2" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Reserve Repack (Tandem)</strong></label>
                <select class="form-control"  id="S-IRT1" name="S-IRT1" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Reserve Repack including Main (Tandem)</strong></label>
                <select class="form-control"  id="S-IRT2" name="S-IRT2" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Assembly and Pack Reserve and Main</strong></label>
                <select class="form-control"  id="S-AIPFULLSPORT" name="S-AIPFULLSPORT" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Assembly and Pack Reserve No Main</strong></label>
                <select class="form-control"  id="S-AIP " name="S-AIP " >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>ASSEMBLY AND PACK TANDEM SYSTEM NO MAIN</strong></label>
                <select class="form-control"  id="S-AIPT" name="S-AIPT" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>ASSEMBLY AND PACK TANDEM SYSTEM WITH MAIN</strong></label>
                <select class="form-control"  id="S-AIPTM" name="S-AIPTM" >
                    
                </select>
            </div>
            <?php if($_GET['repack_type'] == 'pilot') { ?>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Pilot Emergency Inspect and Repack</strong></label>
                <select class="form-control"  id="S-PACK2" name="S-PACK2" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Pilot Emergency Inspect and Repack (RUSH)</strong></label>
                <select class="form-control"  id="S-PACK2RUSH" name="S-PACK2RUSH" >
                    
                </select>
            </div>
        <?php } ?>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Inspect and Repack L39 DROGUE</strong></label>
                <select class="form-control"  id="S-IRDROGUE" name="S-IRDROGUE" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Inspect and Repack L39 DROGUE (RUSH)</strong></label>
                <select class="form-control"  id="S-IRDROGERUSH" name="S-IRDROGERUSH" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>AAD install/remove ONLY</strong></label>
                <select class="form-control"  id="S-AAD1" name="S-AAD1" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Open/Close for  AAD</strong></label>
                <select class="form-control"  id="S-AAD2" name="S-AAD2" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Harness/Container Ispection only</strong></label>
                <select class="form-control"  id="S-INSPHC" name="S-INSPHC" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Canopy inspection only (visuial)</strong></label>
                <select class="form-control"  id="S-INSPCAN" name="S-INSPCAN" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Full System Inspection only</strong></label>
                <select class="form-control"  id="S-INSPFULLSYS" name="S-INSPFULLSYS" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Trim chk only- not a full inspect</strong></label>
                <select class="form-control"  id="S-TRIMCHECK" name="S-TRIMCHECK" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>CSC 25 jump check</strong></label>
                <select class="form-control"  id="S-CSC25" name="S-CSC25" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>30 lb strength test only</strong></label>
                <select class="form-control"  id="S-30LBTEST" name="S-30LBTEST" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Main Assembly</strong></label>
                <select class="form-control"  id="S-MAINASSEMBLY" name="S-MAINASSEMBLY" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Main Pack</strong></label>
                <select class="form-control"  id="S-PACKMAIN" name="S-PACKMAIN" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Main Untangle</strong></label>
                <select class="form-control"  id="S-UNTANGLEMAIN" name="S-UNTANGLEMAIN" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>WASH H/C</strong></label>
                <select class="form-control"  id="S-WASHHC" name="S-WASHHC" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Wash Canopy</strong></label>
                <select class="form-control"  id="S-WASHCAN" name="S-WASHCAN" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Wash TM Rig</strong></label>
                <select class="form-control"  id="S-WASHTANDEM" name="S-WASHTANDEM" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Scotchguard full rig</strong></label>
                <select class="form-control"  id="S-SCOTCH1" name="S-SCOTCH1" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Scothgard Legpads only</strong></label>
                <select class="form-control"  id="S-SCOTCH2" name="S-SCOTCH2" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Disassemble Canopy</strong></label>
                <select class="form-control"  id="S-DISASS1" name="S-DISASS1" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Complete Disassembly</strong></label>
                <select class="form-control"  id="S-DISASS2" name="S-DISASS2" >
                    
                </select>
            </div>
    	  	<?php }
    	  		if($s == 2){ 
    	  	 ?>
			            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace BOC pocket</strong></label>
                <select class="form-control"  id="S-REPLBOC" name="S-REPLBOC" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Cypres 4/8yr check</strong></label>
                <select class="form-control"  id="S-AADMAINT" name="S-AADMAINT" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Sport kill line replace</strong></label>
                <select class="form-control"  id="S-KLREPLACE" name="S-KLREPLACE" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>TM kill line replace</strong></label>
                <select class="form-control"  id="S-TKLREPLACE" name="S-TKLREPLACE" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Waterproof Zipper rep</strong></label>
                <select class="form-control"  id="S-WPZIP1" name="S-WPZIP1" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Waterproof Sep. Jacket rep</strong></label>
                <select class="form-control"  id="S-WPZIP2" name="S-WPZIP2" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Regular #5 zipper rep</strong></label>
                <select class="form-control"  id="S-ZIP1" name="S-ZIP1" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Wingsuit Zipper replace</strong></label>
                <select class="form-control"  id="S-WSZIP1" name="S-WSZIP1" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Reattach or flix exist slide</strong></label>
                <select class="form-control"  id="S-ZIPSLIDEFIX" name="S-ZIPSLIDEFIX" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Zipper Slide Replace</strong></label>
                <select class="form-control"  id="S-ZIPSLIDEREPL1" name="S-ZIPSLIDEREPL1" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Expensive Zip Slide Rep</strong></label>
                <select class="form-control"  id="S-ZIPSLIDE2" name="S-ZIPSLIDE2" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add zip pocket-wingsuit</strong></label>
                <select class="form-control"  id="S-WSZIPPOC" name="S-WSZIPPOC" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add zip pocket</strong></label>
                <select class="form-control"  id="S-ZIPPOC" name="S-ZIPPOC" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Pre-made patch sew-on</strong></label>
                <select class="form-control"  id="S-PMPATCH" name="S-PMPATCH" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Small Jumpsuit Patch</strong></label>
                <select class="form-control"  id="S-JSPATCH1" name="S-JSPATCH1" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Large Jumpsuit Patch</strong></label>
                <select class="form-control"  id="S-JSPATCH2" name="S-JSPATCH2" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add RDS pocket</strong></label>
                <select class="form-control"  id="S-RDSPOC" name="S-RDSPOC" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Jumpsuit Seam</strong></label>
                <select class="form-control"  id="S-JSSEAMREP" name="S-JSSEAMREP" >
                    
                </select>
            </div>            
            <div class="form-group">
                <label for="make" class="control-label"><strong>Bootie repair</strong></label>
                <select class="form-control"  id="S-BOOTIEREP" name="S-BOOTIEREP" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Whole Butt Patch</strong></label>
                <select class="form-control"  id="S-BUTTPATCH" name="S-BUTTPATCH" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Install AFF BOC</strong></label>
                <select class="form-control"  id="S-AFFBOCINS" name="S-AFFBOCINS" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Install butt bungee (12")</strong></label>
                <select class="form-control"  id="S-BUNGEEINST" name="S-BUNGEEINST" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Install legpads- sport</strong></label>
                <select class="form-control"  id="S-LEGPADINST" name="S-LEGPADINST" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>D-bag band stow</strong></label>
                <select class="form-control"  id="S-BANDSTOW" name="S-BANDSTOW" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Install new PC handle</strong></label>
                <select class="form-control"  id="S-PCHAND" name="S-PCHAND" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Rep riser toggle keepers</strong></label>
                <select class="form-control"  id="S-TOGKEEPFIX" name="S-TOGKEEPFIX" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Slider stop riser mod</strong></label>
                <select class="form-control"  id="S-SLIDERSTOP" name="S-SLIDERSTOP" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace velcro/elastic</strong></label>
                <select class="form-control"  id="S-VLELASTIC" name="S-VLELASTIC" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace MLW velcro</strong></label>
                <select class="form-control"  id="S-VELCRO" name="S-VELCRO" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add Bridle protection</strong></label>
                <select class="form-control"  id="S-BRIDCOVER" name="S-BRIDCOVER" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace UPT res flap</strong></label>
                <select class="form-control"  id="S-UPTRESFLAP" name="S-UPTRESFLAP" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace stiffener/ no grommet</strong></label>
                <select class="form-control"  id="S-REPSTIF" name="S-REPSTIF" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace stiffener/grommet</strong></label>
                <select class="form-control"  id="S-REPSTIFGROM" name="S-REPSTIFGROM" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Rings for  wing attachment</strong></label>
                <select class="form-control"  id="S-CAMWING" name="S-CAMWING" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add Fastex clip</strong></label>
                <select class="form-control"  id="S-FASTEX" name="S-FASTEX" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add snap</strong></label>
                <select class="form-control"  id="S-SNAP1" name="S-SNAP1" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add plastic snap w/bartack</strong></label>
                <select class="form-control"  id="S-SNAP2" name="S-SNAP2" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Rep Grommet</strong></label>
                <select class="form-control"  id="S-REPLGROM#0" name="S-REPLGROM#0" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Rep #8 SS grommet</strong></label>
                <select class="form-control"  id="S-REPLGROM#2" name="S-REPLGROM#2" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add RSL to  risers</strong></label>
                <select class="form-control"  id="S-RSLRIS" name="S-RSLRIS" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace heat shrink (EA)</strong></label>
                <select class="form-control"  id="S-HEATSHRINK" name="S-HEATSHRINK" >
                    
                </select>
            </div>
            <?php }
    	  		if($s == 3){ 
    	  	 ?>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Recoil Ripcord System</strong></label>
                <select class="form-control"  id="S-REPRECOILRC" name="S-REPRECOILRC" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Patch Drogue Mesh</strong></label>
                <select class="form-control"  id="S-REPLBOC" name="S-PATCHDROMESH" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>T11 Reserve Repack</strong></label>
                <select class="form-control"  id="S-PACKT11" name="S-PACKT11" >
                    
                </select>
            </div>
            <!-- END -->

            <div class="form-group">
                <label for="make" class="control-label"><strong>Tandem Passenger Harness Inspect</strong></label>
                <select class="form-control"  id="" name="" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>TANDEM ASSEMBLY AND PACK, No Main</strong></label>
                <select class="form-control"  id="" name="" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>TANDEM canopy inspect</strong></label>
                                <select class="form-control"  id="" name="" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>TANDEM main pack</strong></label>
                <select class="form-control"  id="" name="" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>REPLACE Tandem BOC                <select class="form-control"  id="" name="" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Rep plastic on tm  warn label</strong></label>
                                <select class="form-control"  id="" name="" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Rebuild TANDEM Y Mod</strong></label>
                                <select class="form-control"  id="" name="" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Install legpads- TANDEM</strong></label>
                                <select class="form-control"  id="" name="" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>TM Cypres window</strong></label>
                                <select class="form-control"  id="" name="" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Drogue Poly replacement</strong></label>
                <select class="form-control"  id="" name="" >
                    
                </select>
            </div>
            <?php }
    	  		if($s == 4){ 
    	  	 ?>
                        <div class="form-group">
                <label for="make" class="control-label"><strong>Tandem/Military Re-line</strong></label>
                <select class="form-control"  id="S-RELINE TANDEM" name="S-RELINE TANDEM" >
                    
                </select>
            </div>

                  <div class="form-group">
                <label for="make" class="control-label"><strong>Sport Re-line, labor only</strong></label>
                <select class="form-control"  id="S-RELINE SPORT" name="S-RELINE SPORT" >
                    
                </select>
            </div>
            
            <div class="form-group">
                <label for="make" class="control-label"><strong>Reserve re-line</strong></label>
                <select class="form-control"  id="S-RELINE RESERVE" name="S-RELINE RESERVE" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Steering Lines (pair)</strong></label>
                <select class="form-control"  id="S-REPLLST" name="S-REPLLST" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Sacraficial line</strong></label>
                <select class="form-control"  id="S-SACLINE" name="S-SACLINE" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>lengthen/shorten brakes</strong></label>
                <select class="form-control"  id="S-ADJSTEER" name="S-ADJSTEER" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace both bk-tog</strong></label>
                <select class="form-control"  id="S-REPBRKTOG" name="S-REPBRKTOG" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Reserve line (pair)</strong></label>
                <select class="form-control"  id="S-REPLLSTRES" name="S-REPLLSTRES" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Reserve bk-tog</strong></label>
                <select class="form-control"  id="S-REPLBRKTOGR" name="S-REPLBRKTOGR" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Bartack</strong></label>
                <select class="form-control"  id="S-BARTACK" name="S-BARTACK" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace 1 line</strong></label>
                <select class="form-control"  id="S-LINEREPL" name="S-LINEREPL" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>6-12" patch</strong></label>
                <select class="form-control"  id="S-BPATCH1" name="S-BPATCH1" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>12-30" patch</strong></label>
                <select class="form-control"  id="S-BPATCH2" name="S-BPATCH2" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>31-48" patch</strong></label>
                <select class="form-control"  id="S-BPATCH3" name="S-BPATCH3" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>49-66" patch</strong></label>
                <select class="form-control"  id="S-BPATCH4" name="S-BPATCH4" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>67-84" patch</strong></label>
                <select class="form-control"  id="S-BPATCH5" name="S-BPATCH5" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>85"-101" patch</strong></label>
                <select class="form-control"  id="S-BPATCH6" name="S-BPATCH6" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>cut crossport</strong></label>
                <select class="form-control"  id="S-BPATCH7" name="S-BPATCH7" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>seam</strong></label>
                <select class="form-control"  id="S-SEAMREPAIR" name="S-SEAMREPAIR" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Remove/replc PCA</strong></label>
                <select class="form-control"  id="S-PCA" name="S-PCA" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Slider channel patch</strong></label>
                <select class="form-control"  id="S-SLIDERCHAN" name="S-SLIDERCHAN" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Remove/replc packing tab</strong></label>
                <select class="form-control"  id="S-PACKTAB" name="S-PACKTAB" >
                    
                </select>
            </div>
                        <div class="form-group">
                <label for="make" class="control-label"><strong>Remove/replc data panel</strong></label>
                <select class="form-control"  id="S-DATAPANEL" name="S-DATAPANEL" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Remove/replc tape</strong></label>
                <select class="form-control"  id="S-REPLTAPE" name="S-REPLTAPE" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Remove/replc line atch</strong></label>
                <select class="form-control"  id="S-REPLLATTACH" name="S-REPLLATTACH" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Ripstop Patch (2 pieces)</strong></label>
                <select class="form-control"  id="S-RIPSTOPSTICK" name="S-RIPSTOPSTICK" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Add slider pocket</strong></label>
                <select class="form-control"  id="S-SLIDERPOCK" name="S-SLIDERPOCK" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace 1 Slider Channel</strong></label>
                <select class="form-control"  id="S-SLDRCHAN" name="S-SLDRCHAN" >
                    
                </select>
            </div>
    	  	<?php } 
            if($s == 5){ 
                ?>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Shorten Leg Staps (Webbing Only)</strong></label>
                <select class="form-control"  id="S-HARNLS1" name="S-HARNLS1" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Shorten Chest strap</strong></label>
                <select class="form-control"  id="S-HARNCHEST1" name="S-HARNCHEST1" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Long Side  Chest Strap (RING HARNESS)</strong></label>
                <select class="form-control"  id="S-HARNCHEST2" name="S-HARNCHEST2" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Long Side  Chest Strap (STD HARNESS)</strong></label>
                <select class="form-control"  id="S-HARNCHEST3" name="S-HARNCHEST3" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Short Side Chest Strap (RING HARNESS) (Use Existing HW)</strong></label>
                <select class="form-control"  id="S-HARNCHEST4" name="S-HARNCHEST4" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Short Side Chest Strap (RING HARNESS)(USE HW)</strong></label>
                <select class="form-control"  id="S-HARNCHEST5" name="S-HARNCHEST5" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Short Side Chest Strap (STD HARNESS)  (USE EXISTING HW) </strong></label>
                <select class="form-control"  id="S-HARNCHEST6" name="S-HARNCHEST6" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace Short Side Chest Strap (STD HARNESS)  (NEW HW)</strong></label>
                <select class="form-control"  id="S-HARNCHEST7" name="S-HARNCHEST7" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace  Leg Straps (PAIR)</strong></label>
                <select class="form-control"  id="S-HARNLS2" name="S-HARNLS2" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace from hip rings down</strong></label>
                <select class="form-control"  id="S-HARNMLW2" name="S-HARNMLW2" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace MLW between rings (Ring Harness)</strong></label>
                <select class="form-control"  id="S-HARNMLW1" name="S-HARNMLW1" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace MLW (FULL) 4 RING HARNESS (REUSE EXISTING HW)</strong></label>
                <select class="form-control"  id="S-HARNMLW3" name="S-HARNMLW3" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace MLW (FULL) 4 RING HARNESS NEW HW</strong></label>
                <select class="form-control"  id="S-HARNMLW4" name="S-HARNMLW4" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace MLW (FULL) 2 RING HARNESS (REUSE EXISTING HW HIP RING ONLY</strong></label>
                <select class="form-control"  id="S-HARNMLW5" name="S-HARNMLW5" >
                    
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Replace MLW (FULL)2  RING HARNESS NEW HW HIP RING ONLY</strong></label>
                <select class="form-control"  id="S-HARNMLW6" name="S-HARNMLW6" >
                    
                </select>
            </div>
        <?php } ?>          
    	  	<!-- SEPARATE NOTATION AT THE BOTTOM OF SERVICE  -->
    		<hr/>
    		<div class="form-group">
                <label for="make" class="control-label"><strong>Rush Fee(front of line)</strong></label>
                <input type="text" class="form-control" id="S-RUSH1" name="S-RUSH1" placeholder="Rush Fee(front of line)" value="Sales Price $60,00" />
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Rush Fee(right now)</strong></label>
                <input type="text" class="form-control" id="S-RUSH2" name="S-RUSH2" placeholder="Rush Fee(right now)" value="Sales Price $100,00" />
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Hourly shop rate</strong></label>
                <select class="form-control"  id="S-SHOPRATE" name="S-SHOPRATE" >
                	<option value="Sales Price $90,00">Sales Price $90,00</option>
                	<option value="Master Rigger $49,50">Master Rigger $49,50</option>
                	<option value="Senior Rigger $44,00">Master Rigger $44,00</option>
                </select>
            </div>
            <div class="form-group">
                <label for="make" class="control-label"><strong>Monthly storage fee</strong></label>
                <input type="text" class="form-control" id="S-STORAGE" name="S-STORAGE" placeholder="Monthly storage fee" value="Sales Price $25,00" />
            </div>
            <button  class="btn btn-primary" id="next_step" style="float: right;" onclick="add_service_option();  return false;">Continue Scheduling</button>        
          </form>
    	</div>
    </div>

</div>
<script>
function add_service_option() {
    $.post( "<?php echo root();?>inc/exec.php?act=add_service_option&repack_type=<?php echo $_GET['repack_type'];?>&ajax=1&schedule=1&container=<?php echo $_GET['container'];?>&s=<?php echo $s;?>", $('#service_form').serialize(), '', 'script');
}
</script>