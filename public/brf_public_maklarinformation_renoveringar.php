<?php foreach (array('avloppbad', 'avloppkok', 'elstigar', 'fasad', 'trefas', 'vind', 'tak', 'fonster', 'trappor', 'balkong', 'eldstad', 'fungerandeeldstad', 'eldningforbjuden') as $sInfoTypeKey): ?>
<?php
    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
?>
<p class="content_center_margin"><strong><?php echo $oInfoType->getTypeNamePublic(); if (!$oInfoType->getTypeNamePublic()) echo $oInfoType->getTypeName(); ?></strong> <?php 
    if (!array_key_exists($sInfoTypeKey, $aRealtorInfo)) {
        echo _realtorInfoMissing();
    } else {
        echo $aRealtorInfo[$sInfoTypeKey] ? 'Ja' : 'Nej';
        if (($sComment = $aRealtorInfo[$sInfoTypeKey]->getComment())) {
            echo ", " . lcfirst($sComment);
        }
    }
?></p>
<?php endforeach; ?>
<!--
<p class="content_center_margin"><strong>VA-stammar i badrum är bytta i gathus och gårdshus :</strong> Ja, 2008</p>
<p class="content_center_margin"><strong>VA-stammar i kök är bytta i gathus och gårdshus:</strong> Nej, stammarna spolades 2005. Arbetet är dokumenterat på film</p>
<p class="content_center_margin"><strong>Elstigarna är bytta :</strong> Ja, 2008</p>
<p class="content_center_margin"><strong>Fasaden är renoverad:</strong> Ja, 2010</p>
<p class="content_center_margin"><strong>3-fas el finns indraget:</strong> Nej, det kommer att åtgärdas inom ett år.</p>
<p class="content_center_margin"><strong>Råvinden finns kvar:</strong> Ja. kommer att omvandlas till lägenheter inom 5 år.</p>
<p class="content_center_margin"><strong>Taket är renoverat:</strong> Nej, behövs inte.</p>
<p class="content_center_margin"><strong>Fönstren är renoverade:</strong> Ja 2012.</p>
<p class="content_center_margin"><strong>Trappuset är renoverat:</strong> Nej, ska göras under 2013.</p>
<p class="content_center_margin"><strong>Det finns balkongplaner:</strong> Ja, föreningen har bett om offerter från företag. Föreningen har god ekonomi, vilket betalar tillbyggnaden.</p>
<p class="content_center_margin"><strong>Elstad/ eldstäder har provtryckts: </strong> Nej</p>
<p class="content_center_margin"><strong>Möjlighet att få ej fungerande eldstäder i användning:</strong> Nej</p>
<p class="content_center_margin"><strong>Eldningsförbud:</strong> Nej</p>-->