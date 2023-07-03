<?php
  
    //options array configuration
    $o = [
                'S-RUSH1' => ['$'],
                'S-RUSH2' => ['$'],
                'S-SHOPRATE' => ['$'],
                'S-STORAGE' => ['$'],
                'S-IRS1' => ['$'],
                'S-IRS1RUSH1' => ['$'],
                'S-IRS1RUSH2' => ['$'],
                'S-IRS2' => ['$'],
                'S-IRT1' => ['$'],
                'S-IRT2' => ['$'],
                'S-AIPFULLSPORT' => ['$'],
                'S-AIP ' => ['$'],
                'S-AIPT' => ['$'],
                'S-AIPTM' => ['$'],
                'S-PACK2' => ['$'],
                'S-PACK2RUSH' => ['$'],
                'S-IRDROGUE' => ['$'],
                'S-IRDROGERUSH' => ['$'],
                'S-AAD1' => ['$'],
                'S-AAD2' => ['$'],
                'S-INSPHC' => ['$'],
                'S-INSPCAN' => ['$'],
                'S-INSPFULLSYS' => ['$'],
                'S-TRIMCHECK' => ['$'],
                'S-CSC25' => ['$'],
                'S-30LBTEST' => ['$'],
                'S-MAINASSEMBLY' => ['$'],
                'S-PACKMAIN' => ['$'],
                'S-UNTANGLEMAIN' => ['$'],
                'S-WASHHC' => ['$'],
                'S-WASHCAN' => ['$'],
                'S-WASHTANDEM' => ['$'],
                'S-SCOTCH1' => ['$'],
                'S-SCOTCH2' => ['$'],
                'S-DISASS1' => ['$'],
                'S-DISASS2' => ['$'],
                'S-REPLBOC' => ['$'],
                'S-AADMAINT' => ['$'],
                'S-KLREPLACE' => ['$'],
                'S-TKLREPLACE' => ['$'],
                'S-WPZIP1' => ['$'],
                'S-WPZIP2' => ['$'],
                'S-ZIP1' => ['$'],
                'S-WSZIP1' => ['$'],
                'S-ZIPSLIDEFIX' => ['$'],
                'S-ZIPSLIDEREPL1' => ['$'],
                'S-ZIPSLIDE2' => ['$'],
                'S-WSZIPPOC' => ['$'],
                'S-ZIPPOC' => ['$'],
                'S-PMPATCH' => ['$'],
                'S-JSPATCH1' => ['$'],
                'S-JSPATCH2' => ['$'],
                'S-RDSPOC' => ['$'],
                'S-JSSEAMREP' => ['$'],
                'S-BOOTIEREP' => ['$'],
                'S-BUTTPATCH' => ['$'],
                'S-AFFBOCINS' => ['$'],
                'S-BUNGEEINST' => ['$'],
                'S-LEGPADINST' => ['$'],
                'S-BANDSTOW' => ['$'],
                'S-PCHAND' => ['$'],
                'S-TOGKEEPFIX' => ['$'],
                'S-SLIDERSTOP' => ['$'],
                'S-VLELASTIC' => ['$'],
                'S-VELCRO' => ['$'],
                'S-BRIDCOVER' => ['$'],
                'S-UPTRESFLAP' => ['$'],
                'S-REPSTIF' => ['$'],
                'S-REPSTIFGROM' => ['$'],
                'S-CAMWING' => ['$'],
                'S-FASTEX' => ['$'],
                'S-SNAP1' => ['$'],
                'S-SNAP2' => ['$'],
                'S-REPLGROM#0' => ['$'],
                'S-REPLGROM#2' => ['$'],
                'S-RSLRIS' => ['$'],
                'S-HEATSHRINK' => ['$'],
                'S-REPRECOILRC' => ['$'],
                'S-PATCHDROMESH' => ['$'],
                'S-PACKT11' => ['$'],
                'S-RELINE TANDEM' => ['$'],
                'S-RELINE SPORT' => ['$'],
                'S-RELINE RESERVE' => ['$'],
                'S-REPLLST' => ['$'],
                'S-SACLINE' => ['$'],
                'S-ADJSTEER' => ['$'],
                'S-REPBRKTOG' => ['$'],
                'S-REPLLSTRES' => ['$'],
                'S-REPLBRKTOGR' => ['$'],
                'S-BARTACK' => ['$'],
                'S-LINEREPL' => ['$'],
                'S-BPATCH1' => ['$'],
                'S-BPATCH2' => ['$'],
                'S-BPATCH3' => ['$'],
                'S-BPATCH4' => ['$'],
                'S-BPATCH5' => ['$'],
                'S-BPATCH6' => ['$'],
                'S-BPATCH7' => ['$'],
                'S-SEAMREPAIR' => ['$'],
                'S-PCA' => ['$'],
                'S-SLIDERCHAN' => ['$'],
                'S-PACKTAB' => ['$'],
                'S-DATAPANEL' => ['$'],
                'S-REPLTAPE' => ['$'],
                'S-REPLLATTACH' => ['$'],
                'S-RIPSTOPSTICK' => ['$'],
                'S-SLIDERPOCK' => ['$'],
                'S-SLDRCHAN' => ['$'],
                'S-HARNLS1' => ['$'],
                'S-HARNCHEST1' => ['$'],
                'S-HARNCHEST2' => ['$'],
                'S-HARNCHEST3' => ['$'],
                'S-HARNCHEST4' => ['$'],
                'S-HARNCHEST5' => ['$'],
                'S-HARNCHEST6' => ['$'],
                'S-HARNCHEST7' => ['$'],
                'S-HARNLS2' => ['$'],
                'S-HARNMLW2' => ['$'],
                'S-HARNMLW1' => ['$'],
                'S-HARNMLW3' => ['$'],
                'S-HARNMLW4' => ['$'],
                'S-HARNMLW5' => ['$'],
                'S-HARNMLW6' => ['$'],
                'IA-BOC' => ['$'],
                'IA-ELLARGE' => ['$'],
                'IA-ELSMALL' => ['$'],
                'IA-MAINCL LONG' => ['$'],
                'IA-RESCL' => ['$'],
                'S-RUSH1' => ['$'],
                'S-RUSH2' => ['$'],
                'S-SHOPRATE' => ['$'],
                'S-STORAGE' => ['$'],
                ];


$options = array();
foreach($o as $key => $values){
    $options[$key]  = $values[0]; 
}

//print_r($options);
    function options($variable)
    {
        global $values;
        global $options;

        //print_r($options);

        foreach($options as $key => $val)
        { 
            //print_r($key);
            $selected = '';
            
            if($key == $values[$variable])
                $selected = 'selected';
                
            echo '<option value="'.$val.'" '.$selected.'>'.$val.'</option>';     
        } 

    }
        
?>