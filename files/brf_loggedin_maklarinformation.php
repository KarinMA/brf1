<style type="text/css">
    .checkbox_form {margin-right: 15px; }

    #kolumner {
        margin-top: 50px;
        width: 535px
    }

    .kol4 {
        float: left;
        margin: 20px 0 0 20px;
        width: 235px;}

    .kol5 {
        float: right;
        margin: 20px 40px 0 0;
        width: 235px;
    }

    .kol3{
        float: left;
        margin: 20px 0 0 20px;
        width: 480px;
    }

    .input_kol {width: 200px; }

    .input_3 {
        width: 425px;
        margin-left:10px;
    }

</style>
<img width="210" height="36" alt="medlemsidor" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/info_maklare.png" id="bla_skylt">
<p>När en lägenhet ska säljas brukar en mäklare höra av sig till ordförande i föreningen. Genom att fylla i nedanstående uppgifter har du alltid dokumentet klart och slipper fylla i vid varje försäljning.</p>
<?php
    $aRealtorInformation = SvenskBRF_RealtorInformation::getRealtorInformationWithKeys($oBrf);
?>
<div id="kolumner">
    <form method="post" action="" id="realtorForm">
        <input type="hidden" name="action" id="formAction" value="validaterealtorinfo"/>
        <div class="kol4">
            <?php
                foreach (array('build_year', 'rebuild_year', 'address', 'spaces') as $sInfoTypeKey):
                    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                    $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p>
                <?php if ($oInfoType->getRequired()): ?>*<?php endif; ?><label for="<?php echo $sInfoTypeKey; ?>" id="<?php echo $sInfoTypeKey . '_label'; ?>"><?php echo $oInfoType->getTypeName(); ?></label>:
                <input type="text" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][value]" class="input_kol" id="<?php echo $sInfoTypeKey; ?>" value="<?php echo $oInfo ? $oInfo->getValue() : ''; ?>"/>
            </p>
            <?php endforeach; ?>
        </div>

        <div class="kol5">
            <?php
                foreach (array('apartments', 'tennants', 'purchase_year') as $sInfoTypeKey):
                    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                    $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p>
                <?php if ($oInfoType->getRequired()): ?>*<?php endif; ?><label for="<?php echo $sInfoTypeKey; ?>" id="<?php echo $sInfoTypeKey . '_label'; ?>"><?php echo $oInfoType->getTypeName(); ?></label>:
                <input type="text" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][value]" class="input_kol" id="<?php echo $sInfoTypeKey; ?>" value="<?php echo $oInfo ? $oInfo->getValue() : ''; ?>"/>
            </p>
            <?php endforeach; ?>
        </div>

        <div><img width="510" height="12" alt="linje" src="<?php echo BASE_DIR; ?>media/brf/linje.png" class="linje"/></div>

        <div class="kol3"><!-- Början på kolumn 3 -->

            <?php 
                foreach (array('privatebrf', 'coownership', 'subrental', 'sleepover', 'money', 'judicialperson', 'plumbingbath', 'plumbingkitchen') as $sInfoTypeKey): 
                    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                    $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p id="<?php echo $oInfoType->getTypeKey(); ?>"><label id="<?php echo $oInfoType->getTypeKey(); ?>_label"><?php echo $oInfoType->getTypeName(); ?></label><p>
            <p>Ja<input 
                <?php if ($oInfo && $oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                onclick="$('#comment_<?php echo $sInfoTypeKey; ?>').text('Kommentar'+<?php echo $oInfoType->getCommentRequiredYes() ? "'*'" : "''"; ?>); return true;"
                type="radio" value="1" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" class="checkbox_form"/>
                Nej<input <?php if ($oInfo && !$oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                onclick="$('#comment_<?php echo $sInfoTypeKey; ?>').text('Kommentar'+<?php echo $oInfoType->getCommentRequiredNo() ? "'*'" : "''"; ?>); return true;"                                                      
                type="radio" value="0" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" class="checkbox_form"/><span id="comment_<?php echo $sInfoTypeKey; ?>">Kommentar<?php if (($oInfo && (($oInfo->getValue() && $oInfoType->getCommentRequiredYes()) || (!$oInfo->getValue() && $oInfoType->getCommentRequiredNo()))) || (!$oInfo && ($oInfoType->getCommentRequiredNo() && $oInfoType->getCommentRequiredYes()))): ?>*<?php endif; ?>:</span>  <input type="text" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][comment]" 
                    class="input_3" value="<?php echo $oInfo ? $oInfo->getComment() : ''; ?>"/>
            </p>
            <?php endforeach; ?>
        </div><!-- slut på kolumn 3 -->


        <div class="kol4">

            <?php 
                foreach (array('electricpaths', 'phasethree', 'roof') as $sInfoTypeKey): 
                    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                    $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p id="<?php echo $oInfoType->getTypeKey(); ?>"><label id="<?php echo $oInfoType->getTypeKey(); ?>_label"><?php echo $oInfoType->getTypeName(); ?></label><p>
            <p>Ja<input 
                <?php if ($oInfo && $oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                onclick="$('#comment_<?php echo $sInfoTypeKey; ?>').text('Kommentar'+<?php echo $oInfoType->getCommentRequiredYes() ? "'*'" : "''"; ?>); return true;"
                type="radio" value="1" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" class="checkbox_form"/>
                Nej<input <?php if ($oInfo && !$oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                onclick="$('#comment_<?php echo $sInfoTypeKey; ?>').text('Kommentar'+<?php echo $oInfoType->getCommentRequiredNo() ? "'*'" : "''"; ?>); return true;"                                                      
                type="radio" value="0" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" class="checkbox_form"/><span id="comment_<?php echo $sInfoTypeKey; ?>">Kommentar<?php if (($oInfo && (($oInfo->getValue() && $oInfoType->getCommentRequiredYes()) || (!$oInfo->getValue() && $oInfoType->getCommentRequiredNo()))) || (!$oInfo && ($oInfoType->getCommentRequiredNo() && $oInfoType->getCommentRequiredYes()))): ?>*<?php endif; ?>:</span>  <input type="text" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][comment]" 
                    class="input_kol" value="<?php echo $oInfo ? $oInfo->getComment() : ''; ?>"/>
            </p>
            <?php endforeach; ?>
        </div>

        
        <div class="kol5">

            <?php 
                foreach (array('fasade', 'windows', 'stairs') as $sInfoTypeKey): 
                    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                    $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p id="<?php echo $oInfoType->getTypeKey(); ?>"><label id="<?php echo $oInfoType->getTypeKey(); ?>_label"><?php echo $oInfoType->getTypeName(); ?></label><p>
            <p>Ja<input 
                <?php if ($oInfo && $oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                onclick="$('#comment_<?php echo $sInfoTypeKey; ?>').text('Kommentar'+<?php echo $oInfoType->getCommentRequiredYes() ? "'*'" : "''"; ?>); return true;"
                type="radio" value="1" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" class="checkbox_form"/>
                Nej<input <?php if ($oInfo && !$oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                onclick="$('#comment_<?php echo $sInfoTypeKey; ?>').text('Kommentar'+<?php echo $oInfoType->getCommentRequiredNo() ? "'*'" : "''"; ?>); return true;"                                                      
                type="radio" value="0" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" class="checkbox_form"/><span id="comment_<?php echo $sInfoTypeKey; ?>">Kommentar<?php if (($oInfo && (($oInfo->getValue() && $oInfoType->getCommentRequiredYes()) || (!$oInfo->getValue() && $oInfoType->getCommentRequiredNo()))) || (!$oInfo && ($oInfoType->getCommentRequiredNo() && $oInfoType->getCommentRequiredYes()))): ?>*<?php endif; ?>:</span>  <input type="text" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][comment]" 
                    class="input_kol" value="<?php echo $oInfo ? $oInfo->getComment() : ''; ?>"/>
            </p>
            <?php endforeach; ?>
        </div>

        

        <div class="kol3"><!-- Början på kolumn 3 -->

            
            
            <?php 
                foreach (array('balcony', 'fireplace', 'fireplacenotworking', 'firebanned', 'attic') as $sInfoTypeKey): 
                    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                    $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p id="<?php echo $oInfoType->getTypeKey(); ?>"><label id="<?php echo $oInfoType->getTypeKey(); ?>_label"><?php echo $oInfoType->getTypeName(); ?></label><p>
            <p>Ja<input 
                <?php if ($oInfo && $oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                onclick="$('#comment_<?php echo $sInfoTypeKey; ?>').text('Kommentar'+<?php echo $oInfoType->getCommentRequiredYes() ? "'*'" : "''"; ?>); return true;"
                type="radio" value="1" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" class="checkbox_form"/>
                Nej<input <?php if ($oInfo && !$oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                onclick="$('#comment_<?php echo $sInfoTypeKey; ?>').text('Kommentar'+<?php echo $oInfoType->getCommentRequiredNo() ? "'*'" : "''"; ?>); return true;"                                                      
                type="radio" value="0" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" class="checkbox_form"/><span id="comment_<?php echo $sInfoTypeKey; ?>">Kommentar<?php if (($oInfo && (($oInfo->getValue() && $oInfoType->getCommentRequiredYes()) || (!$oInfo->getValue() && $oInfoType->getCommentRequiredNo()))) || (!$oInfo && ($oInfoType->getCommentRequiredNo() && $oInfoType->getCommentRequiredYes()))): ?>*<?php endif; ?>:</span>  <input type="text" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][comment]" 
                    class="input_3" value="<?php echo $oInfo ? $oInfo->getComment() : ''; ?>"/>
            </p>
            <?php endforeach; ?>
            
            <p>Gemensamma utrymmen:</p>
            <p>
                <?php foreach (array('tvattstuga', 'torkrum', 'foreningslokal', 'uteplats', 'bastu', 'terrass', 'cykelforrad', 'festlokal', 'barnvagnsrum', 'lokaler_annat') as $sInfoTypeKey): 
                        $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                        $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
                ?>
                <label for="<?php echo $sInfoTypeKey; ?>_yes"><?php echo $oInfoType->getTypeName(); ?></label>
                <input type="hidden" value="0" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][value]"/>
                <input <?php if ($oInfo && $oInfo->getValue()): ?>checked="checked" <?php endif; ?>id="<?php echo $sInfoTypeKey; ?>_yes" type="checkbox" value="1" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][value]" class="checkbox_form"
                                                                  
                />
                <?php if ($oInfoType->getCommentRequiredYes()): ?>
                <input type="text" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][comment]" id="<?php echo $sInfoTypeKey; ?>" style="width:68px;" class="input_3" value="<?php echo $oInfo && $oInfo->getValue() ? $oInfo->getComment() : ''; ?>"/>
                <script type="text/javascript">
                    $(document).ready(function(){
                       $("#<?php echo $sInfoTypeKey; ?>_yes").click(function(){
                           if ($(this).is(':checked')) {
                               $("#<?php echo $sInfoTypeKey; ?>").focus();
                           }
                       }) 
                    });
                </script>
                <?php endif; ?>
                <?php endforeach; ?>
            </p>
            
            <?php $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName('kabeltv'); ?>
            <p id="kabeltv"><?php echo $oInfoType->getTypeName(); ?>:</p>
            <p>
                <?php $oInfo = array_key_exists('kabeltv', $aRealtorInformation) ? $aRealtorInformation['kabeltv'] : NULL; ?>
                
                <label for="kabeltv_no">Nej<label>
                <input type="hidden" value="-1" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]"/>
                <input type="radio" value="0" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" class="checkbox_form" id="kabeltv_no"
                    onclick="$('#tvgrundutbud,#kabeltv_yes,#kabeltvdebitering_yes').prop('checked', false); $('#kabeltv_no').prop('checked', true);"
                    <?php if ($oInfo && !$oInfo->getValue()): ?>checked="checked"<?php endif; ?>
                />
                
                <label for="kabeltv_yes">Ja det ingår i avgiften</label>
                <input type="radio" value="1" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" class="checkbox_form" id="kabeltv_yes"
                    onclick="$('#tvgrundutbud,#kabeltv_no,#kabeltvdebitering_yes').prop('checked', false); $('#kabeltv_yes').prop('checked', true);"      
                    <?php if ($oInfo && $oInfo->getValue() == "1"): ?>checked="checked"<?php endif; ?>
                />
                
                <?php $oInfo = array_key_exists('kabeltvdebitering', $aRealtorInformation) ? $aRealtorInformation['kabeltvdebitering'] : NULL; ?>
                <?php $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName('kabeltvdebitering'); ?>
                <label for="kabeltvdebitering" id="kabeltvdebitering_label"><?php echo $oInfoType->getTypeName(); ?>:</label>
                <input onclick="$('#kabeltvdebitering_yes').click();" type="text" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][comment]" id="kabeltvdebitering" style="width:80px;" value="<?php echo $oInfo && $oInfo->getValue() ? $oInfo->getComment() : ''; ?>"/> kr/månad 
                <input type="hidden" value="0" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]"/>
                <input type="radio" value="1" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" class="checkbox_form" id="kabeltvdebitering_yes"
                    onclick="$('#tvgrundutbud,#kabeltv_no,#kabeltv_yes').prop('checked', false); $('#kabeltvdebitering_yes').prop('checked', true);"   
                    <?php if ($oInfo && $oInfo->getValue()): ?>checked="checked"<?php endif; ?>
                />
                
                <?php $oInfo = array_key_exists('tvgrundutbud', $aRealtorInformation) ? $aRealtorInformation['tvgrundutbud'] : NULL; ?>
                <?php $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName('tvgrundutbud'); ?>
                <label for="tvgrundutbud"><?php echo $oInfoType->getTypeName(); ?></label>
                <input type="hidden" value="0" class="broadband" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]"/>
                <input type="radio" value="1" id="tvgrundutbud" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" class="checkbox_form" 
                    onclick="$('#kabeltvdebitering_yes,#kabeltv_no,#kabeltv_yes').prop('checked', false); $('#tvgrundutud').prop('checked', true); $('#kabeltvdebitering').val('');"
                    <?php if ($oInfo && $oInfo->getValue()): ?>checked="checked"<?php endif; ?>
                />
            </p>

         
            <?php $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName('bredband'); ?>
            <p id="bredband"><?php echo $oInfoType->getTypeName(); ?>:</p>
            <p>
                
                <?php $oInfo = array_key_exists('bredband', $aRealtorInformation) ? $aRealtorInformation['bredband'] : NULL; ?>
                
                <input type="hidden" name="phone_tv_internet[bredband][value]" value="-1"/>  
                <label for="bredband_no">Nej</label>
                <input <?php if ($oInfo && $oInfo->getValue() == '0'): ?>checked="checked" <?php endif; ?>type="radio" value="0" name="phone_tv_internet[bredband][value]" class="checkbox_form" id="bredband_no" onclick="$('#bredbandsleverantor, #bredbandshastighet, #bredbandskostnad').val(''); $('.broadband').val('0'); return true;"/>
                <label for="bredband_yes">Ja</label>
                <input <?php if ($oInfo && $oInfo->getValue() == '1'): ?>checked="checked" <?php endif; ?>type="radio" value="1" name="phone_tv_internet[bredband][value]" class="checkbox_form" id="bredband_yes" onclick="$('#bredbandsleverantor').focus(); $('.broadband').val('1'); return true;"/>
                
                
                <?php $oInfoSupplier = array_key_exists('bredbandsleverantor', $aRealtorInformation) ? $aRealtorInformation['bredbandsleverantor'] : NULL; ?>
                <?php $oInfoTypeSupplier = SvenskBRF_RealtorInformation::getTypeByKeyName('bredbandsleverantor'); ?>
                <label id="bredbandslevarantor_label" for="bredbandsleverantor"><?php echo $oInfoTypeSupplier->getTypeName(); ?>:</label>
                <input type="hidden" class="broadband" name="phone_tv_internet[bredbandsleverantor][value]" value="<?php echo $oInfo && $oInfo->getValue() == "1" ? '1' : '0'; ?>"/>  
                <input type="text" name="phone_tv_internet[bredbandsleverantor][comment]" style="width:100px;" id="bredbandsleverantor" value="<?php echo $oInfo && $oInfo->getValue() && $oInfoSupplier && $oInfoSupplier->getValue() == "1" ? $oInfoSupplier->getCommment() : ''; ?>"/>  
                
                <?php $oInfoSpeed = array_key_exists('bredbandshastighet', $aRealtorInformation) ? $aRealtorInformation['bredbandshastighet'] : NULL; ?>
                <?php $oInfoTypeSpeed = SvenskBRF_RealtorInformation::getTypeByKeyName('bredbandshastighet'); ?>
                <label for="bredbandshastighet" id="bredbandshastighet_label"><?php echo $oInfoTypeSpeed->getTypeName(); ?>:</label>
                <input type="hidden" class="broadband" name="phone_tv_internet[bredbandshastighet][value]" value="<?php echo $oInfo && $oInfo->getValue() == "1" ? '1' : '0'; ?>"/>  
                <input type="text" name="phone_tv_internet[bredbandshastighet][comment]" style="width:100px;" id="bredbandshastighet" value="<?php echo $oInfo && $oInfo->getValue() && $oInfoSpeed && $oInfoSpeed->getValue() == "1" ? $oInfoSpeed->getCommment() : ''; ?>"/>  
                
                <?php $oInfoCost = array_key_exists('bredbandskostnad', $aRealtorInformation) ? $aRealtorInformation['bredbandskostnad'] : NULL; ?>
                <?php $oInfoTypeCost = SvenskBRF_RealtorInformation::getTypeByKeyName('bredbandskostnad'); ?>
                <label for="bredbandskostnad" id="bredbandskostnad_label"><?php echo $oInfoTypeCost->getTypeName(); ?>:</label>
                <input type="hidden" class="broadband" name="phone_tv_internet[bredbandskostnad][value]" value="<?php echo $oInfo && $oInfo->getValue() == "1" ? '1' : '0'; ?>"/>  
                <input type="text" name="phone_tv_internet[bredbandskostnad][comment]" style="width:100px;" id="bredbandskostnad" value="<?php echo $oInfo && $oInfo->getValue() && $oInfoCost && $oInfoCost->getValue() == "1" ? $oInfoCost->getCommment() : ''; ?>"/> 
                kr/månad. 
            </p>

            <?php /*
            <p>Har det beslutats eller diskuterats större reparationer eller ombyggnader av fastigheten? Om ja, hur ska detta ﬁnansieras?</p>
            <p>Nej
                <input type="checkbox" value="Nej" name="Nej" class="checkbox_form">
                Ja, enligt följande:<input type="text" name=" Ja, enligt följande:" class="input_3"></p>


            <p>Finns en plan för amortering av föreningens lån?</p>
            <p>Nej
                <input type="checkbox" value="Nej" name="Nej" class="checkbox_form">
                Ja, enligt följande:<input type="text" name=" Ja, enligt följande:" style="width:435px;"></p>


            <p>Kända framtida förändringar av föreningens ekonomi (omläggning lån, avtrappning räntebidrag, full fastighetsskatt etc)</p>
            <p>Nej
                <input type="checkbox" value="Nej" name="Nej" class="checkbox_form">
                Ja, följande:<input type="text" name=" Ja, följande:" style="width:435px;"></p>
             
             */ ?>
            <!-- -->
        </div>

        <?php 
                /*
        <div class="kol4">

            <p>Förningens kostnader i samband med överlåtelsen. Betalas av:</p>
            <p>Köpare:
                <input type="checkbox" value="Ja" name="Betalas av köpare" class="checkbox_form">
                Säljare:<input type="checkbox" value="Nej" name="betalas av säljare" class="checkbox_form"></p>
            <p>Pantsättningsavgift:</p>
            <p>Nej:<input type="checkbox" value="Ja" name="Nej" class="checkbox_form">Ja, <input type="text" name="Pantsättningsavgift:" style="width:50px;"> kr.</p>

        </div>

        <div class="kol5">

            <p>Överlåtesleavgift:</p>
            <p>Nej:<input type="checkbox" value="Ja" name="Nej" class="checkbox_form">Ja, <input type="text" name="Överlåtesleavgift:" style="width:50px;"> kr.</p>

        </div>


        <div><img width="510" height="12" alt="linje" src="http://109.74.7.190/b/media/brf/linje.png" class="linje"></div>

        <div class="kol4">

            <p> *Namn och kontaktuppgifter till er ekonomiska förvaltare:<textarea cols="24" rows="7"></textarea></p>

        </div>



        <div class="kol5">

            <p>*Kontaktperson i föreningen:
                <input type="text" name="kontaktperson i föreningen" class="input_kol"></p>
            <p>*Telefon
                <input type="text" name="telefon" class="input_kol"></p>
            <p>Fax:
                <input type="text" name="fax" class="input_kol"></p>

        </div>

        <div><img width="510" height="12" alt="linje" src="http://109.74.7.190/b/media/brf/linje.png" class="linje"></div>
        <div class="kol3"><!-- Början på kolumn 3 -->
            <p>Övrigt som köparen bör informeras om:
                <input type="text" name="Övrigt som köparen bör informeras om:" style="width:435px;"></p>
        </div>*/?>

        <div class="kol3"><!-- Början på kolumn 3 -->

            <input type="image"  src="<?php echo BASE_DIR; ?>media/inloggad/img/spara.png" id="saveRealtorInfo" style="border:none; margin-left:15px;"/>
            <p style="margin-left:15px;">* obligatorisk information</p>

        </div>

    </form>
</div>
<script type="text/javascript">
    $("#saveRealtorInfo").click(function() {
        $("#kolumner input,p").css('background-color', '');
        $("#kolumner input,p").css('color', '');
        $.post("<?php echo BASE_DIR; ?>ajax.php", $("#realtorForm").serialize(), function (response) {
            if (response.result) {
                if (!response.data.isValid) {
                    for (var errorCounter = 0; errorCounter < response.data.errors.length; errorCounter++) {
                        if (errorCounter == 0 && true) {
                            var goTo = response.data.errors[errorCounter] + '_label';
                            if ($("#" + goTo).size() == 1) {
                                goTo = response.data.errors[errorCounter];
                            }
                            document.location.href = '<?php echo BASE_DIR . $oBrf->getUrl() . '/maklarinformation#'; ?>' + goTo;
                        }
                        var element = $("#" + response.data.errors[errorCounter]);
                        if ($(element).filter("input[type='text']").size() == 1) {
                            $(element).css('background-color', 'red');
                        } else {
                            $(element).css('color', 'red');
                        }
                    }
                }
            }
        }, 'json');
       
       return false;
    });
</script>