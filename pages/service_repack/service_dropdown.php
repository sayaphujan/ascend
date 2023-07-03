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
                'S-RUSH1' => ['$60'],
                'S-RUSH2' => ['$100'],
                'S-SHOPRATE' => ['$90'],
                'S-STORAGE' => ['$25'],
                ];


$options = array();
$sport = array();
$tandem = array();
$pilot = array();

foreach($o as $key => $values){
    $options[$key]  = $values[0]; 
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


        foreach($options as $key => $val)
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