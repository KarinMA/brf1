<?php
$aBranches = array(
            268 => array('name' => 'Livsmedel', 'exclude' => array()), // livsmdel
            104 => array('name' => 'Träning', 'exclude' => array()), // livsmdel
            137 => array('name' => 'Tåg/T-bana', 'exclude' => array()),
            81 => array('name' => 'Varuhus', 'exclude' => array(83, 60, 71, 481)), // varuhus 
            175 => array('name' => 'FÖRSKOLOR &amp; FRITIDS', 'exclude' => array()), // dagis
            192 => array('name' => 'SKOLOR', 'exclude' => array()), // varuhus
            374 => array('name' => 'Gymnasium', 'exclude' => array()),
            115 => array('name' => 'Vårdcentral', 'exclude' => array())
        );
        extract($_POST);
        $oAreaResult = @json_decode(file_get_contents($sAreaUrl));
        $aResults = getBranchData($oAreaResult, $aBranches, $iNorthCoordinate, $iEastCoordinate);
        
        foreach ($aResults as $iBranchId => $aBranch):
        if (count($aResults[$iBranchId])):
            ?>
        <ul class="plats">
            <li><strong><?php echo $aBranches[$iBranchId]['name']; ?></strong></li>
            <?php foreach ($aBranch as $aBranchCompany): ?>
            <li>
                <?php if (array_key_exists('link', $aBranchCompany)): ?>
                <a href="<?php echo $aBranchCompany['link'] ;?>"  target="_blank">
                <?php endif; ?>
                    <?php $iLength = 21; ?>
                    <?php if (strlen($aBranchCompany['name']) > 22 && in_array(substr($aBranchCompany['name'], 20, 2), array_keys(getSwitchCharacters()))): ?>
                    <?php $iLength = 20; ?>
                    <?php endif; ?>
                    <?php echo substr($aBranchCompany['name'], 0, $iLength); if (strlen($aBranchCompany['name']) > $iLength) echo '...'; ?>
                <?php if (array_key_exists('link', $aBranchCompany)): ?>    
                </a>
                <?php endif; ?>
                <span class="siffror"><?php echo $aBranchCompany['distance']; ?>m</span></li>
            <?php endforeach; ?>
        </ul>
        <?php 
                endif;
            endforeach; 
        ?>