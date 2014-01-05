<?php
    $sInfoTypeKey = 'ovriginformation';
    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
?>
<p class="content_center_margin"><strong><?php echo $oInfoType->getTypeNamePublic(); ?></strong> <?php echo array_key_exists($sInfoTypeKey, $aRealtorInfo) ? $aRealtorInfo[$sInfoTypeKey]->getValue() : _realtorInfoMissing(); ?></p>
                    