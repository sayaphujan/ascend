<?php
  
    //options array configuration
    $s = [
                'reserve_repack' => [
                                        '$110',
                                        '$170',
                                        '$210',
                                        '$120'
                                    ],
                'assembly'  => [
                                '$165',
                                '$135',
                                ],
                 'inspect_repack' => [
                                        '$115',
                                        '$185',
                                        ],
                'aad' => [
                                        '$20',
                                        '$35',
                                        ],
                'inspection' => [
                                        '$45',
                                        '$35',
                                        '$75',
                                        ],
                 'wash' => [
                                        '$65',
                                        '$65',
                                        '$85',
                                        ],
                'main' => [
                                        '$30',
                                        '$10',
                                        '$18',
                                        ],
                 'scotchguard' => [
                                        '$55',
                                        '$25',
                                        ],
                 'disassembly' => [
                                        '$20',
                                        '$40',
                                        ],
                'S-TRIMCHECK' => [
                                    'No',
                                    'Yes (+$30)',
                                ],
                'S-CSC25' =>  [
                                    'No',
                                    'Yes (+$16)',
                                ],
                'S-30LBTEST' =>  [
                                    'No',
                                    'Yes (+$15)',
                                ],
                'S-RUSH1' => [
                                    'No',
                                    'Yes (+$60)',
                                ],
                'S-RUSH2' => [
                                    'No',
                                    'Yes (+$100)',
                                ],
                'S-SHOPRATE' => [
                                    'No',
                                    'Yes (+$90)',
                                ],
                'S-STORAGE' => [
                                    'No',
                                    'Yes (+$25)',
                                ],
            ];

    $t = [
                'reserve_repack' => [
                                        '$135',
                                        '$155',
                                    ],
                'assembly'  => [
                                '$185',
                                '$210',
                                ],
            ];
    $p = [
             'emergency_inspect' => [
                                        '$115',
                                        '$185',
                                        ],
            ];
   
 $o = [
                'S-RUSH1' => [
                                    'No',
                                    'Yes (+$60)',
                                ],
                'S-RUSH2' => [
                                    'No',
                                    'Yes (+$100)',
                                ],
                'S-SHOPRATE' => [
                                    'No',
                                    'Yes (+$90)',
                                ],
                'S-STORAGE' => [
                                    'No',
                                    'Yes (+$25)',
                                ],
                'S-IRS1' => [
                                    'No',
                                    'Yes (+$110)',
                                ],
                'S-IRS1RUSH1' => [
                                    'No',
                                    'Yes (+$170)',
                                ],
                'S-IRS1RUSH2' => [
                                    'No',
                                    'Yes (+$210)',
                                ],
                'S-IRS2' => [
                                    'No',
                                    'Yes (+$120)',
                                ],
                'S-IRT1' => [
                                    'No',
                                    'Yes (+$135)',
                                ],
                'S-IRT2' => [
                                    'No',
                                    'Yes (+$155)',
                                ],
                'S-AIPFULLSPORT' => [
                                    'No',
                                    'Yes (+$165)',
                                ],
                'S-AIP ' => [
                                    'No',
                                    'Yes (+$135)',
                                ],
                'S-AIPT' => [
                                    'No',
                                    'Yes (+$185)',
                                ],
                'S-AIPTM' => [
                                    'No',
                                    'Yes (+$210)',
                                ],
                'S-PACK2' => [
                                    'No',
                                    'Yes (+$115)',
                                ],
                'S-PACK2RUSH' => [
                                    'No',
                                    'Yes (+$185)',
                                ],
                'S-IRDROGUE' => [
                                    'No',
                                    'Yes (+$58)',
                                ],
                'S-IRDROGERUSH' => [
                                    'No',
                                    'Yes (+$98)',
                                ],
                'S-AAD1' => [
                                    'No',
                                    'Yes (+$20)',
                                ],
                'S-AAD2' => [
                                    'No',
                                    'Yes (+$35)',
                                ],
                'S-INSPHC' => [
                                    'No',
                                    'Yes (+$45)',
                                ],
                'S-INSPCAN' => [
                                    'No',
                                    'Yes (+$35)',
                                ],
                'S-INSPFULLSYS' => [
                                    'No',
                                    'Yes (+$75)',
                                ],
                'S-TRIMCHECK' => [
                                    'No',
                                    'Yes (+$30)',
                                ],
                'S-CSC25' => [
                                    'No',
                                    'Yes (+$16)',
                                ],
                'S-30LBTEST' => [
                                    'No',
                                    'Yes (+$15)',
                                ],
                'S-MAINASSEMBLY' => [
                                    'No',
                                    'Yes (+$30)',
                                ],
                'S-PACKMAIN' => [
                                    'No',
                                    'Yes (+$10)',
                                ],
                'S-UNTANGLEMAIN' => [
                                    'No',
                                    'Yes (+$18)',
                                ],
                'S-WASHHC' => [
                                    'No',
                                    'Yes (+$65)',
                                ],
                'S-WASHCAN' => [
                                    'No',
                                    'Yes (+$65)',
                                ],
                'S-WASHTANDEM' => [
                                    'No',
                                    'Yes (+$85)',
                                ],
                'S-SCOTCH1' => [
                                    'No',
                                    'Yes (+$55)',
                                ],
                'S-SCOTCH2' => [
                                    'No',
                                    'Yes (+$25)',
                                ],
                'S-DISASS1' => [
                                    'No',
                                    'Yes (+$20)',
                                ],
                'S-DISASS2' => [
                                    'No',
                                    'Yes (+$40)',
                                ],
                'S-REPLBOC' => [
                                    'No',
                                    'Yes (+$40)',
                                ],
                'S-AADMAINT' => [
                                    'No',
                                    'Yes (PER MFR)',
                                ],
                'S-KLREPLACE' => [
                                    'No',
                                    'Yes (+$50)',
                                ],
                'S-TKLREPLACE' => [
                                    'No',
                                    'Yes (+$65)',
                                ],
                'S-WPZIP1' => [
                                    'No',
                                    'Yes (+$50)',
                                ],
                'S-WPZIP2' => [
                                    'No',
                                    'Yes (+$50)',
                                ],
                'S-ZIP1' => [
                                    'No',
                                    'Yes (+$45)',
                                ],
                'S-WSZIP1' => [
                                    'No',
                                    'Yes (+$75)',
                                ],
                'S-ZIPSLIDEFIX' => [
                                    'No',
                                    'Yes (+$16)',
                                ],
                'S-ZIPSLIDEREPL1' => [
                                    'No',
                                    'Yes (+$26)',
                                ],
                'S-ZIPSLIDE2' => [
                                    'No',
                                    'Yes (+$30)',
                                ],
                'S-WSZIPPOC' => [
                                    'No',
                                    'Yes (+$65)',
                                ],
                'S-ZIPPOC' => [
                                    'No',
                                    'Yes (+$40)',
                                ],
                'S-PMPATCH' => [
                                    'No',
                                    'Yes (+$20)',
                                ],
                'S-JSPATCH1' => [
                                    'No',
                                    'Yes (+$35)',
                                ],
                'S-JSPATCH2' => [
                                    'No',
                                    'Yes (+$45)',
                                ],
                'S-RDSPOC' => [
                                    'No',
                                    'Yes (+$55)',
                                ],
                'S-JSSEAMREP' => [
                                    'No',
                                    'Yes (+$18)',
                                ],
                'S-BOOTIEREP' => [
                                    'No',
                                    'Yes (+$55)',
                                ],
                'S-BUTTPATCH' => [
                                    'No',
                                    'Yes (+$80)',
                                ],
                'S-AFFBOCINS' => [
                                    'No',
                                    'Yes (+$175)',
                                ],
                'S-BUNGEEINST' => [
                                    'No',
                                    'Yes (+$35)',
                                ],
                'S-LEGPADINST' => [
                                    'No',
                                    'Yes (+$45)',
                                ],
                'S-BANDSTOW' => [
                                    'No',
                                    'Yes (+$15)',
                                ],
                'S-PCHAND' => [
                                    'No',
                                    'Yes (+$45)',
                                ],
                'S-TOGKEEPFIX' => [
                                    'No',
                                    'Yes (SHOP RATE)',
                                ],
                'S-SLIDERSTOP' => [
                                    'No',
                                    'Yes (+$40)',
                                ],
                'S-VLELASTIC' => [
                                    'No',
                                    'Yes (SHOP RATE)',
                                ],
                'S-VELCRO' => [
                                    'No',
                                    'Yes (SHOP RATE)',
                                ],
                'S-BRIDCOVER' => [
                                    'No',
                                    'Yes (+$50)',
                                ],
                'S-UPTRESFLAP' => [
                                    'No',
                                    'Yes (+$45)',
                                ],
                'S-REPSTIF' => [
                                    'No',
                                    'Yes (SHOP RATE)',
                                ],
                'S-REPSTIFGROM' => [
                                    'No',
                                    'Yes (SHOP RATE)',
                                ],
                'S-CAMWING' => [
                                    'No',
                                    'Yes (+$40)',
                                ],
                'S-FASTEX' => [
                                    'No',
                                    'Yes (+$10)',
                                ],
                'S-SNAP1' => [
                                    'No',
                                    'Yes (+$7,95)',
                                ],
                'S-SNAP2' => [
                                    'No',
                                    'Yes (+$7,95)',
                                ],
                'S-REPLGROM#0' => [
                                    'No',
                                    'Yes (+$15)',
                                ],
                'S-REPLGROM#2' => [
                                    'No',
                                    'Yes (+$20)',
                                ],
                'S-RSLRIS' => [
                                    'No',
                                    'Yes (+$70)',
                                ],
                'S-HEATSHRINK' => [
                                    'No',
                                    'Yes (+$8)',
                                ],
                'S-REPRECOILRC' => [
                                    'No',
                                    'Yes (+$55)',
                                ],
                'S-PATCHDROMESH' => [
                                    'No',
                                    'Yes (+$25)',
                                ],
                'S-PACKT11' => [
                                    'No',
                                    'Yes (+$115)',
                                ],
                'S-TPHI' => [
                                    'No',
                                    'Yes (+$15)',
                                ],
                'S-TAP NM' => [
                                    'No',
                                    'Yes (+$155)',
                                ],
                'S-TCI' => [
                                    'No',
                                    'Yes (+$45)',
                                ],
                'S-TMP' => [
                                    'No',
                                    'Yes (+$12)',
                                ],
                'S-RTB' => [
                                    'No',
                                    'Yes (+$55)',
                                ],
                'S-RPW' => [
                                    'No',
                                    'Yes (SHOP RATE)',
                                ],
                'S-RTY' => [
                                    'No',
                                    'Yes (SHOP RATE)',
                                ],
                'S-ILT' => [
                                    'No',
                                    'Yes (+$65)',
                                ],
                'S-TCN' => [
                                    'No',
                                    'Yes',
                                ],
                'S-DPR' => [
                                    'No',
                                    'Yes (+$25)',
                                ],
                'S-RELINE TANDEM' => [
                                    'No',
                                    'Yes (+$190)',
                                ],
                'S-RELINE SPORT' => [
                                    'No',
                                    'Yes (+$150)',
                                ],
                'S-RELINE RESERVE' => [
                                    'No',
                                    'Yes (+$410)',
                                ],
                'S-REPLLST' => [
                                    'No',
                                    'Yes (+$65)',
                                ],
                'S-SACLINE' => [
                                    'No',
                                    'Yes (+$18)',
                                ],
                'S-ADJSTEER' => [
                                    'No',
                                    'Yes (+$25)',
                                ],
                'S-REPBRKTOG' => [
                                    'No',
                                    'Yes (+$40)',
                                ],
                'S-REPLLSTRES' => [
                                    'No',
                                    'Yes (+$110)',
                                ],
                'S-REPLBRKTOGR' => [
                                    'No',
                                    'Yes (+$65)',
                                ],
                'S-BARTACK' => [
                                    'No',
                                    'Yes (+$4)',
                                ],
                'S-LINEREPL' => [
                                    'No',
                                    'Yes (+$45)',
                                ],
                'S-BPATCH1' => [
                                    'No',
                                    'Yes (+$80)',
                                ],
                'S-BPATCH2' => [
                                    'No',
                                    'Yes (+$90)',
                                ],
                'S-BPATCH3' => [
                                    'No',
                                    'Yes (+$100)',
                                ],
                'S-BPATCH4' => [
                                    'No',
                                    'Yes (+$115)',
                                ],
                'S-BPATCH5' => [
                                    'No',
                                    'Yes (+$125)',
                                ],
                'S-BPATCH6' => [
                                    'No',
                                    'Yes (+$165)',
                                ],
                'S-BPATCH7' => [
                                    'No',
                                    'Yes (+$40)',
                                ],
                'S-SEAMREPAIR' => [
                                    'No',
                                    'Yes (+$25)',
                                ],
                'S-PCA' => [
                                    'No',
                                    'Yes (+$45)',
                                ],
                'S-SLIDERCHAN' => [
                                    'No',
                                    'Yes (+$50)',
                                ],
                'S-PACKTAB' => [
                                    'No',
                                    'Yes (+$10)',
                                ],
                'S-DATAPANEL' => [
                                    'No',
                                    'Yes (+$30)',
                                ],
                'S-REPLTAPE' => [
                                    'No',
                                    'Yes (+$20)',
                                ],
                'S-REPLLATTACH' => [
                                    'No',
                                    'Yes (+$27)',
                                ],
                'S-RIPSTOPSTICK' => [
                                    'No',
                                    'Yes (+$25)',
                                ],
                'S-SLIDERPOCK' => [
                                    'No',
                                    'Yes (+$65)',
                                ],
                'S-SLDRCHAN' => [
                                    'No',
                                    'Yes (+$40)',
                                ],
                'S-HARNLS1' => [
                                    'No',
                                    'Yes (+$45)',
                                ],
                'S-HARNCHEST1' => [
                                    'No',
                                    'Yes (+$30)',
                                ],
                'S-HARNCHEST2' => [
                                    'No',
                                    'Yes (+$85)',
                                ],
                'S-HARNCHEST3' => [
                                    'No',
                                    'Yes (+$100)',
                                ],
                'S-HARNCHEST4' => [
                                    'No',
                                    'Yes (+$55)',
                                ],
                'S-HARNCHEST5' => [
                                    'No',
                                    'Yes (+$90)',
                                ],
                'S-HARNCHEST6' => [
                                    'No',
                                    'Yes (+$55)',
                                ],
                'S-HARNCHEST7' => [
                                    'No',
                                    'Yes (+$90)',
                                ],
                'S-HARNLS2' => [
                                    'No',
                                    'Yes (+$185)',
                                ],
                'S-HARNMLW2' => [
                                    'No',
                                    'Yes (+$245)',
                                ],
                'S-HARNMLW1' => [
                                    'No',
                                    'Yes (+$165)',
                                ],
                'S-HARNMLW3' => [
                                    'No',
                                    'Yes (+$400)',
                                ],
                'S-HARNMLW4' => [
                                    'No',
                                    'Yes (+$650)',
                                ],
                'S-HARNMLW5' => [
                                    'No',
                                    'Yes (+$400)',
                                ],
                'S-HARNMLW6' => [
                                    'No',
                                    'Yes (+$650)',
                                ],
                /*'IA-BOC' => [
                                    'No',
                                    'Yes (+$25)',
                                ],
                'IA-ELLARGE' => [
                                    'No',
                                    'Yes (+$25)',
                                ],
                'IA-ELSMALL' => [
                                    'No',
                                    'Yes (+$25)',
                                ],
                'IA-MAINCL LONG' => [
                                    'No',
                                    'Yes (+$25)',
                                ],
                'IA-RESCL' => [
                                    'No',
                                    'Yes (+$25)',
                                ],*/
                'S-RUSH1' => [
                                    'No',
                                    'Yes (+$60)',
                                ],
                'S-RUSH2' => [
                                    'No',
                                    'Yes (+$100)',
                                ],
                'S-SHOPRATE' => [
                                    'No',
                                    'Yes (+$90)',
                                ],
                'S-STORAGE' => [
                                    'No',
                                    'Yes (+$25)',
                                ],
                ];

$options = array();
$sport = array();
$tandem = array();
$pilot = array();

foreach($o as $key => $values){
    $options[$key]  = $values; 
}


foreach($s as $key => $values){
    //print_r($sport);
    $sport[$key]  = $values; 
}

foreach($t as $key => $values){
    //print_r($tandem);
    $tandem[$key]  = $values; 
}

foreach($p as $key => $values){
    
    $pilot[$key]  = $values; 
}

    function options($variable)
    {
        global $values;
        global $options;


        foreach($options[$variable] as $key => $val)
        { 
            $selected = '';
            
            if($key == $values[$variable])
                $selected = 'selected';
                
            echo '<option value="'.$val.'" '.$selected.'>'.$val.'</option>';     
        } 

    }

    function sport($variable)
    {
        global $values;
        global $sport;


        foreach($sport[$variable] as $key => $val)
        { 
            $selected = '';
            
            if($sport[$key] == $values[$variable])
                $selected = 'selected';
                
            echo '<option value="'.$val.'" '.$selected.'>'.$val.'</option>';     
        } 

    }

    function tandem($variable)
    {
        global $values;
        global $tandem;


        foreach($tandem[$variable] as $key => $val)
        { 
            $selected = '';
            
            if($tandem[$key] == $values[$variable])
                $selected = 'selected';
                
            echo '<option value="'.$val.'" '.$selected.'>'.$val.'</option>';     
        } 

    }

    function pilot($variable)
    {
        global $values;
        global $pilot;


        foreach($pilot[$variable] as $key => $val)
        { 

            $selected = '';
            
            if($pilot[$key] == $values[$variable])
                $selected = 'selected';
                
            echo '<option value="'.$val.'" '.$selected.'>'.$val.'</option>';     
        } 

    }
        
?>