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
        <h4 style="margin-left: 35px;">Fastigheten</h4>
        <div class="kol4">
            <?php
                foreach (array('byggar', 'ombyggnadsar', 'adress', 'lokaler') as $sInfoTypeKey):
                    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                    $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p>
                <?php if (FALSE && $oInfoType->getRequired()): ?>*<?php endif; ?><label for="<?php echo $sInfoTypeKey; ?>" id="<?php echo $sInfoTypeKey . '_label'; ?>"><?php echo $oInfoType->getTypeName(); ?></label>
                <input type="text" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][value]" class="input_kol" id="<?php echo $sInfoTypeKey; ?>" value="<?php echo $oInfo ? $oInfo->getValue() : ''; ?>"/>
            </p>
            <?php endforeach; ?>
        </div>

        <div class="kol5">
            <?php
                foreach (array('lagenheter', 'hyresgaster', 'inkopsar') as $sInfoTypeKey):
                    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                    $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p>
                <?php if (FALSE && $oInfoType->getRequired()): ?>*<?php endif; ?><label for="<?php echo $sInfoTypeKey; ?>" id="<?php echo $sInfoTypeKey . '_label'; ?>"><?php echo $oInfoType->getTypeName(); ?></label>
                <input type="text" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][value]" class="input_kol" id="<?php echo $sInfoTypeKey; ?>" value="<?php echo $oInfo ? $oInfo->getValue() : ''; ?>"/>
            </p>
            <?php endforeach; ?>
        </div>

        <div><img width="510" height="12" alt="linje" src="<?php echo BASE_DIR; ?>media/brf/linje.png" class="linje"/></div>

        <div class="kol3"><!-- Början på kolumn 3 -->

            <?php 
                foreach (array('privatbrf', 'gemensamtagande', 'andrahandsuthyrning', 'overnattning', 'kapital', 'juridiskperson', 'avloppbad', 'avloppkok') as $sInfoTypeKey): 
                    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                    $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p id="<?php echo $oInfoType->getTypeKey(); ?>">
                <label id="<?php echo $oInfoType->getTypeKey(); ?>_label"><?php echo $oInfoType->getTypeName(); ?></label>
            <p>
            <p>
                <label for="<?php echo $sInfoTypeKey; ?>_yes">Ja</label>
                <input 
                    id="<?php echo $sInfoTypeKey; ?>_yes"
                    <?php if ($oInfo && $oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                    onclick="$('#comment_<?php echo $sInfoTypeKey; ?>_label').text('Kommentar'+<?php echo FALSE && $oInfoType->getCommentRequiredYes() ? "'*'" : "''"; ?>).click(); return true;"
                    type="radio" 
                    value="1" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" 
                    class="checkbox_form"
                />
                <label for="<?php echo $sInfoTypeKey; ?>_no">Nej</label>
                <input 
                    id="<?php echo $sInfoTypeKey; ?>_no" 
                    <?php if ($oInfo && !$oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                    onclick="$('#comment_<?php echo $sInfoTypeKey; ?>_label').text('Kommentar'+<?php echo FALSE && $oInfoType->getCommentRequiredNo() ? "'*'" : "''"; ?>).click(); return true;"                                                      
                    type="radio" 
                    value="0" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" 
                    class="checkbox_form"
                />
                
                <label for="comment_<?php echo $sInfoTypeKey; ?>" id="comment_<?php echo $sInfoTypeKey; ?>_label">
                    Kommentar<?php if (FALSE && (($oInfo && (($oInfo->getValue() && $oInfoType->getCommentRequiredYes()) || (!$oInfo->getValue() && $oInfoType->getCommentRequiredNo()))) || (!$oInfo && ($oInfoType->getCommentRequiredNo() && $oInfoType->getCommentRequiredYes())))): ?>*<?php endif; ?>:
                </label>  
                <input 
                    id="comment_<?php echo $sInfoTypeKey; ?>"
                    type="text" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][comment]" 
                    class="input_3" 
                    value="<?php echo $oInfo ? $oInfo->getComment() : ''; ?>"
                />
            </p>
            <?php endforeach; ?>
        </div><!-- slut på kolumn 3 -->

        <h4 style="margin-left: 35px;">Renoveringar</h4>
        <div class="kol4">

            <?php 
                foreach (array('elstigar', 'trefas', 'tak') as $sInfoTypeKey): 
                    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                    $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p id="<?php echo $oInfoType->getTypeKey(); ?>"><label id="<?php echo $oInfoType->getTypeKey(); ?>_label"><?php echo $oInfoType->getTypeName(); ?></label><p>
            <p>
                <label for="<?php echo $sInfoTypeKey; ?>_yes">Ja</label>
                <input 
                    id="<?php echo $sInfoTypeKey; ?>_yes"
                    <?php if ($oInfo && $oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                    onclick="$('#comment_<?php echo $sInfoTypeKey; ?>').text('Kommentar'+<?php echo FALSE && $oInfoType->getCommentRequiredYes() ? "'*'" : "''"; ?>); $('#comment_<?php echo $sInfoTypeKey; ?>').focus(); return true;"
                    type="radio" 
                    value="1" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" 
                    class="checkbox_form"
                />
                <label for="<?php echo $sInfoTypeKey; ?>_no">Nej</label>
                <input 
                    id="<?php echo $sInfoTypeKey; ?>_no"
                    <?php if ($oInfo && !$oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                    onclick="$('#comment_<?php echo $sInfoTypeKey; ?>').text('Kommentar'+<?php echo FALSE && $oInfoType->getCommentRequiredNo() ? "'*'" : "''"; ?>); $('#comment_<?php echo $sInfoTypeKey; ?>').focus(); return true;"                                                      
                    type="radio" 
                    value="0" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" 
                    class="checkbox_form"
                />
                <label id="comment_<?php echo $sInfoTypeKey; ?>_label" for="comment_<?php echo $sInfoTypeKey; ?>">Kommentar<?php if (FALSE && ($oInfo && (($oInfo->getValue() && $oInfoType->getCommentRequiredYes()) || (!$oInfo->getValue() && $oInfoType->getCommentRequiredNo()))) || (!$oInfo && ($oInfoType->getCommentRequiredNo() && $oInfoType->getCommentRequiredYes()))): ?>*<?php endif; ?>:</label>  
                <input 
                    id="comment_<?php echo $sInfoTypeKey; ?>"
                    type="text" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][comment]" 
                    class="input_kol" 
                    value="<?php echo $oInfo ? $oInfo->getComment() : ''; ?>"
                />
            </p>
            <?php endforeach; ?>
        </div>

        
        <div class="kol5">
            <?php 
                foreach (array('fasad', 'fonster', 'trappor') as $sInfoTypeKey): 
                    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                    $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p id="<?php echo $oInfoType->getTypeKey(); ?>"><label id="<?php echo $oInfoType->getTypeKey(); ?>_label"><?php echo $oInfoType->getTypeName(); ?></label><p>
            <p>
                <label for="<?php echo $sInfoTypeKey; ?>_yes">Ja</label>
                <input 
                    <?php if ($oInfo && $oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                    onclick="$('#comment_<?php echo $sInfoTypeKey; ?>').text('Kommentar'+<?php echo FALSE && $oInfoType->getCommentRequiredYes() ? "'*'" : "''"; ?>); $('#comment_<?php echo $sInfoTypeKey; ?>').focus(); return true;"
                    type="radio" 
                    value="1" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" 
                    class="checkbox_form"
                />
                <label for="<?php echo $sInfoTypeKey; ?>_no">Nej</label>
                <input 
                    <?php if ($oInfo && !$oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                    onclick="$('#comment_<?php echo $sInfoTypeKey; ?>').text('Kommentar'+<?php echo FALSE && $oInfoType->getCommentRequiredNo() ? "'*'" : "''"; ?>); $('#comment_<?php echo $sInfoTypeKey; ?>').focus(); return true;"                                                      
                    type="radio" 
                    value="0" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" class="checkbox_form"
                />
                <label for="comment_<?php echo $sInfoTypeKey; ?>" id="comment_<?php echo $sInfoTypeKey; ?>_label">Kommentar<?php if (($oInfo && (($oInfo->getValue() && $oInfoType->getCommentRequiredYes()) || (!$oInfo->getValue() && $oInfoType->getCommentRequiredNo()))) || (!$oInfo && ($oInfoType->getCommentRequiredNo() && $oInfoType->getCommentRequiredYes()))): ?>*<?php endif; ?>:</label>  
                <input 
                    id="comment_<?php echo $sInfoTypeKey; ?>"
                    type="text" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][comment]" 
                    class="input_kol" 
                    value="<?php echo $oInfo ? $oInfo->getComment() : ''; ?>"
                />
            </p>
            <?php endforeach; ?>
        </div>

        

        <div class="kol3"><!-- Början på kolumn 3 -->

            
            
            <?php 
                foreach (array('balkong', 'eldstad', 'fungerandeeldstad', 'eldningforbjuden', 'vind') as $sInfoTypeKey): 
                    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                    $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p id="<?php echo $oInfoType->getTypeKey(); ?>">
                <label id="<?php echo $oInfoType->getTypeKey(); ?>_label"><?php echo $oInfoType->getTypeName(); ?></label>
            <p>
            <p>
                <label for="<?php echo $sInfoTypeKey; ?>_yes">Ja</label>
                <input 
                    id="<?php echo $sInfoTypeKey; ?>_yes"
                    <?php if ($oInfo && $oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                    onclick="$('#comment_<?php echo $sInfoTypeKey; ?>_label').text('Kommentar'+<?php echo FALSE && $oInfoType->getCommentRequiredYes() ? "'*'" : "''"; ?>).click(); return true;"
                    type="radio" 
                    value="1" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" 
                    class="checkbox_form"
                />
                <label for="<?php echo $sInfoTypeKey; ?>_no">Nej</label>
                <input 
                    id="<?php echo $sInfoTypeKey; ?>_no" 
                    <?php if ($oInfo && !$oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                    onclick="$('#comment_<?php echo $sInfoTypeKey; ?>_label').text('Kommentar'+<?php echo FALSE && $oInfoType->getCommentRequiredNo() ? "'*'" : "''"; ?>).click(); return true;"                                                      
                    type="radio" 
                    value="0" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" 
                    class="checkbox_form"
                />
                
                <label for="comment_<?php echo $sInfoTypeKey; ?>" id="comment_<?php echo $sInfoTypeKey; ?>_label">
                    Kommentar<?php if (FALSE && (($oInfo && (($oInfo->getValue() && $oInfoType->getCommentRequiredYes()) || (!$oInfo->getValue() && $oInfoType->getCommentRequiredNo()))) || (!$oInfo && ($oInfoType->getCommentRequiredNo() && $oInfoType->getCommentRequiredYes())))): ?>*<?php endif; ?>:
                </label>  
                <input 
                    id="comment_<?php echo $sInfoTypeKey; ?>"
                    type="text" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][comment]" 
                    class="input_3" 
                    value="<?php echo $oInfo ? $oInfo->getComment() : ''; ?>"
                />
            </p>
            <?php endforeach; ?>
            <h4 style="margin-left: 15px;">Gemensamma utrymmen</h4>
            <!--<p>Gemensamma utrymmen:</p>-->
            <p>
                <?php foreach (array('tvattstuga', 'torkrum', 'foreningslokal', 'uteplats', 'bastu', 'terrass', 'cykelforrad', 'festlokal', 'barnvagnsrum', 'lokaler_annat') as $sInfoTypeKey): 
                        $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                        $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
                ?>
                <label for="<?php echo $sInfoTypeKey; ?>_yes"><?php echo $oInfoType->getTypeName(); ?></label>
                <input type="hidden" value="0" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][value]"/>
                <input 
                    <?php if ($oInfo && $oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                    id="<?php echo $sInfoTypeKey; ?>_yes" 
                    type="checkbox" 
                    value="1" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][value]" 
                    class="checkbox_form"
                />
                <?php if ($oInfoType->getCommentRequiredYes()): ?>
                <input type="text" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][comment]" id="<?php echo $sInfoTypeKey; ?>" style="width:68px;" class="input_3" value="<?php echo $oInfo && $oInfo->getValue() ? $oInfo->getComment() : ''; ?>"/>
                <script type="text/javascript">
                    $(document).ready(function(){
                       $("#<?php echo $sInfoTypeKey; ?>_yes").click(function(){
                           if ($(this).is(':checked')) {
                               $("#<?php echo $sInfoTypeKey; ?>").focus();
                           } else {
                               $("#<?php echo $sInfoTypeKey; ?>").val('');
                           }
                       }) 
                    });
                </script>
                <?php endif; ?>
                <?php endforeach; ?>
            </p>
            
            <h4 style="margin-left: 15px;">Kabel-TV/Internet</h4>
            <?php $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName('kabeltv'); ?>
            <p id="kabeltv"><?php echo $oInfoType->getTypeName(); ?></p>
            <p>
                <?php $oInfo = array_key_exists('kabeltv', $aRealtorInformation) ? $aRealtorInformation['kabeltv'] : NULL; ?>
                
                <label for="kabeltv_no">Nej</label>
                <input type="hidden" value="-1" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]"/>
                <input type="radio" value="0" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" class="checkbox_form" id="kabeltv_no"
                    onclick="$('#tvgrundutbud,#kabeltv_yes,#kabeltvdebitering_yes').prop('checked', false); $('#kabeltv_no').prop('checked', true);"
                    <?php if ($oInfo && !$oInfo->getValue()): ?>checked="checked"<?php endif; ?>
                />
                
                <label for="kabeltv_yes">Ja det ingår i avgiften</label>
                <input type="radio" value="1" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" class="checkbox_form" id="kabeltv_yes"
                    onclick="$('#tvgrundutbud,#kabeltv_no,#kabeltvdebitering_yes').prop('checked', false); $('#kabeltv_yes').prop('checked', true); $('#kabeltvdebitering').val('');"      
                    <?php if ($oInfo && $oInfo->getValue() == "1"): ?>checked="checked"<?php endif; ?>
                />
                
                <?php $oInfo = array_key_exists('kabeltvdebitering', $aRealtorInformation) ? $aRealtorInformation['kabeltvdebitering'] : NULL; ?>
                <?php $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName('kabeltvdebitering'); ?>
                <label for="kabeltvdebitering" id="kabeltvdebitering_label"><?php echo $oInfoType->getTypeName(); ?>:</label>
                <input onclick="$('#kabeltvdebitering_yes').click();" type="text" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][comment]" id="kabeltvdebitering" style="width:80px;" value="<?php echo $oInfo && $oInfo->getValue() ? $oInfo->getComment() : ''; ?>"/> kr/månad 
                <input type="hidden" value="0" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]"/>
                <input type="radio" value="1" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" class="checkbox_form" id="kabeltvdebitering_yes"
                    onclick="$('#tvgrundutbud,#kabeltv_no,#kabeltv_yes').prop('checked', false); $('#kabeltvdebitering_yes').prop('checked', true); $('#kabeltvdebitering').focus();"   
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
            <p id="bredband"><?php echo $oInfoType->getTypeName(); ?></p>
            <p>
                
                <?php $oInfo = array_key_exists('bredband', $aRealtorInformation) ? $aRealtorInformation['bredband'] : NULL; ?>
                
                <input type="hidden" name="telefontvinternet[bredband][value]" value="-1"/>  
                <label for="bredband_no">Nej</label>
                <input <?php if ($oInfo && $oInfo->getValue() == '0'): ?>checked="checked" <?php endif; ?>type="radio" value="0" name="telefontvinternet[bredband][value]" class="checkbox_form" id="bredband_no" onclick="$('#bredbandsleverantor, #bredbandshastighet, #bredbandskostnad').val(''); $('.broadband').val('0'); return true;"/>
                <label for="bredband_yes">Ja</label>
                <input <?php if ($oInfo && $oInfo->getValue() == '1'): ?>checked="checked" <?php endif; ?>type="radio" value="1" name="telefontvinternet[bredband][value]" class="checkbox_form" id="bredband_yes" onclick="$('#bredbandsleverantor').focus(); $('.broadband').val('1'); return true;"/>
                
                
                <?php $oInfoSupplier = array_key_exists('bredbandsleverantor', $aRealtorInformation) ? $aRealtorInformation['bredbandsleverantor'] : NULL; ?>
                <?php $oInfoTypeSupplier = SvenskBRF_RealtorInformation::getTypeByKeyName('bredbandsleverantor'); ?>
                <label id="bredbandslevarantor_label" for="bredbandsleverantor"><?php echo $oInfoTypeSupplier->getTypeName(); ?>:</label>
                <input type="hidden" class="broadband" name="telefontvinternet[bredbandsleverantor][value]" value="<?php echo $oInfo && $oInfo->getValue() == "1" ? '1' : '0'; ?>"/>  
                <input type="text" name="telefontvinternet[bredbandsleverantor][comment]" style="width:100px;" id="bredbandsleverantor" value="<?php echo $oInfo && $oInfo->getValue() && $oInfoSupplier && $oInfoSupplier->getValue() == "1" ? $oInfoSupplier->getComment() : ''; ?>"/>  
                
                <?php $oInfoSpeed = array_key_exists('bredbandshastighet', $aRealtorInformation) ? $aRealtorInformation['bredbandshastighet'] : NULL; ?>
                <?php $oInfoTypeSpeed = SvenskBRF_RealtorInformation::getTypeByKeyName('bredbandshastighet'); ?>
                <label for="bredbandshastighet" id="bredbandshastighet_label"><?php echo $oInfoTypeSpeed->getTypeName(); ?>:</label>
                <input type="hidden" class="broadband" name="telefontvinternet[bredbandshastighet][value]" value="<?php echo $oInfo && $oInfo->getValue() == "1" ? '1' : '0'; ?>"/>  
                <input type="text" name="telefontvinternet[bredbandshastighet][comment]" style="width:100px;" id="bredbandshastighet" value="<?php echo $oInfo && $oInfo->getValue() && $oInfoSpeed && $oInfoSpeed->getValue() == "1" ? $oInfoSpeed->getComment() : ''; ?>"/>  
                
                <?php $oInfoCost = array_key_exists('bredbandskostnad', $aRealtorInformation) ? $aRealtorInformation['bredbandskostnad'] : NULL; ?>
                <?php $oInfoTypeCost = SvenskBRF_RealtorInformation::getTypeByKeyName('bredbandskostnad'); ?>
                <label for="bredbandskostnad" id="bredbandskostnad_label"><?php echo $oInfoTypeCost->getTypeName(); ?>:</label>
                <input type="hidden" class="broadband" name="telefontvinternet[bredbandskostnad][value]" value="<?php echo $oInfo && $oInfo->getValue() == "1" ? '1' : '0'; ?>"/>  
                <input type="text" name="telefontvinternet[bredbandskostnad][comment]" style="width:100px;" id="bredbandskostnad" value="<?php echo $oInfo && $oInfo->getValue() && $oInfoCost && $oInfoCost->getValue() == "1" ? $oInfoCost->getComment() : ''; ?>"/> 
                kr/månad. 
            </p>
            <!-- -->
            <h4 style="margin-left: 15px;">Ekonomi</h4>
            <?php
                foreach (array('planeradombyggnad' => 'Ja, enligt följande:', 'amortering' => 'Ja, enligt följande:', 'ekonomi' => 'Ja, följande:') as $sInfoTypeKey => $sYesQuestion): 
            ?>       
            <?php
                $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p id="<?php echo $oInfoType->getTypeKey(); ?>">
                <label id="<?php echo $oInfoType->getTypeKey(); ?>_label"><?php echo $oInfoType->getTypeName(); ?></label>
            <p>
            <p>
                <label for="<?php echo $sInfoTypeKey; ?>_yes"><?php echo $sYesQuestion; ?></label>
                <input 
                    id="<?php echo $sInfoTypeKey; ?>_yes"
                    <?php if ($oInfo && $oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                    onclick="$('#comment_<?php echo $sInfoTypeKey; ?>_label').text('Kommentar'+<?php echo FALSE && $oInfoType->getCommentRequiredYes() ? "'*'" : "''"; ?>).click(); return true;"
                    type="radio" 
                    value="1" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" 
                    class="checkbox_form"
                />
                <label for="<?php echo $sInfoTypeKey; ?>_no">Nej</label>
                <input 
                    id="<?php echo $sInfoTypeKey; ?>_no" 
                    <?php if ($oInfo && !$oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                    onclick="$('#comment_<?php echo $sInfoTypeKey; ?>_label').text('Kommentar'+<?php echo FALSE && $oInfoType->getCommentRequiredNo() ? "'*'" : "''"; ?>).click(); return true;"                                                      
                    type="radio" 
                    value="0" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][value]" 
                    class="checkbox_form"
                />
                
                <label for="comment_<?php echo $sInfoTypeKey; ?>" id="comment_<?php echo $sInfoTypeKey; ?>_label">
                    Kommentar<?php if (FALSE && (($oInfo && (($oInfo->getValue() && $oInfoType->getCommentRequiredYes()) || (!$oInfo->getValue() && $oInfoType->getCommentRequiredNo()))) || (!$oInfo && ($oInfoType->getCommentRequiredNo() && $oInfoType->getCommentRequiredYes())))): ?>*<?php endif; ?>:
                </label>  
                <input 
                    id="comment_<?php echo $sInfoTypeKey; ?>"
                    type="text" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $oInfoType->getTypeKey(); ?>][comment]" 
                    class="input_3" 
                    value="<?php echo $oInfo ? $oInfo->getComment() : ''; ?>"
                />
            </p>
            <?php endforeach; ?>
        </div>

        
        <div class="kol4">
            <?php
                $sInfoTypeKey = 'pantoverlatelse';
                $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p id="<?php echo $sInfoTypeKey; ?>">
                <?php echo $oInfoType->getTypeName(); ?>
            </p>
            
            <p>
                <label for="<?php echo $sInfoTypeKey; ?>_buyer">Köpare:</label>
                <input 
                    id="<?php echo $sInfoTypeKey; ?>_buyer" 
                    <?php if ($oInfo && $oInfo->getValue() === 'Köpare'): ?>checked="checked"<?php endif; ?>
                    type="radio" value="Köpare" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][value]" 
                    class="checkbox_form"
                />
                
                <label for="<?php echo $sInfoTypeKey; ?>_seller">Säljare:</label>
                <input 
                    id="<?php echo $sInfoTypeKey; ?>_seller" 
                    <?php if ($oInfo && $oInfo->getValue() === 'Säljare'): ?>checked="checked"<?php endif; ?>
                    type="radio" 
                    value="Säljare" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][value]" 
                    class="checkbox_form"
                />
                <input type="hidden" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][comment]" value=""/>
            </p>
            
            
            <?php
                $sInfoTypeKey = 'pantavgift';
                $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p id="<?php echo $sInfoTypeKey; ?>"><?php echo $oInfoType->getTypeName(); ?></p>
            
            <p>
                <label for="<?php echo $sInfoTypeKey; ?>_no">Nej</label>
                <input 
                    id="<?php echo $sInfoTypeKey; ?>_no"
                    <?php if ($oInfo && !$oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                    onclick="$('#comment_<?php echo $sInfoTypeKey; ?>').text('Kommentar'+<?php echo $oInfoType->getCommentRequiredNo() ? "'*'" : "''"; ?>); return true;"                                                      
                    type="radio" 
                    value="0" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][value]" class="checkbox_form"
                />
                
                <label for="<?php echo $sInfoTypeKey; ?>_yes">Ja</label>
                <input
                    id="<?php echo $sInfoTypeKey; ?>_yes"
                    <?php if ($oInfo && $oInfo->getValue()): ?>checked="checked" <?php endif; ?>
                    onclick="$('#comment_<?php echo $sInfoTypeKey; ?>').text('Kommentar'+<?php echo FALSE && $oInfoType->getCommentRequiredYes() ? "'*'" : "''"; ?>); $('#comment_<?php echo $sInfoTypeKey; ?>').focus(); return true;"
                    type="radio" 
                    value="1" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][value]" 
                    class="checkbox_form"
                />
                 
                <input 
                    id="comment_<?php echo $sInfoTypeKey; ?>"
                    type="text" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][comment]" 
                    value="<?php echo $oInfo ? $oInfo->getComment() : ''; ?>" 
                    style="width:50px;"
                /> kr.
            </p>

        </div>

        <div class="kol5">
            <?php
                $sInfoTypeKey = 'overlatelseavgift';
                $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p id="<?php echo $sInfoTypeKey; ?>"><?php echo $oInfoType->getTypeName(); ?></p>
            <p>
                <label for="<?php echo $sInfoTypeKey; ?>_no">Nej</label>: 
                <input 
                    id="<?php echo $sInfoTypeKey; ?>_no"
                    <?php if ($oInfo && !$oInfo->getValue()): ?>checked="checked"<?php endif; ?>
                    type="checkbox" 
                    onclick="if (!$(this).is(':checked')) $('#<?php echo $sInfoTypeKey; ?>').focus(); else { $('#<?php echo $sInfoTypeKey; ?>_comment').val('').css('background-color', ''); $('#<?php echo $sInfoTypeKey; ?>_yes').prop('checked', false); }"
                    value="0" 
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][value]" 
                    class="checkbox_form"
                />
                <input id="<?php echo $sInfoTypeKey; ?>_yes" type="checkbox" style="display:none;" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][value]" value="1"<?php if ($oInfo && $oInfo->getValue()): ?> checked="checked"<?php endif; ?>/>
                <label for="<?php echo $sInfoTypeKey; ?>_comment">Ja</label>, 
                <input 
                    id="<?php echo $sInfoTypeKey; ?>_comment"
                    type="text" 
                    onfocus="$('#<?php echo $sInfoTypeKey; ?>_no').prop('checked', false);"
                    name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][comment]" 
                    value="<?php echo $oInfo ? $oInfo->getComment() : ''; ?>"
                    onkeyup="var thisValue = $(this).val(); $('#<?php echo $sInfoTypeKey; ?>_yes').prop('checked', thisValue !== ''); $('#<?php echo $sInfoTypeKey; ?>_no').prop('checked', thisValue === '');"
                    style="width:50px;"
                /> kr.
            </p>
        </div>


        <div>
            <img width="510" height="12" alt="linje" src="<?php echo BASE_DIR; ?>media/brf/linje.png" class="linje"/>
        </div>

        <?php
            $sInfoTypeKey = 'ekonomiskforvaltare';
            $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
            $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
        ?>
        <div class="kol4">
            <p>
                <label for="<?php echo $sInfoTypeKey; ?>" id="<?php echo $sInfoTypeKey; ?>"><?php echo $oInfoType->getTypeName(); ?></label>
                <textarea cols="24" rows="7" id="<?php echo $sInfoTypeKey; ?>_value" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][value]"><?php if ($oInfo): ?><?php echo $oInfo->getValue(); ?><?php endif; ?></textarea>
            </p>
        </div>

        
        <div class="kol5">
            <?php
                foreach (array('kontaktperson', 'kontakttelefon', 'kontaktfax') as $sInfoTypeKey):
                    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                    $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p>
                <?php if (FALSE && $oInfoType->getRequired()): ?>*<?php endif; ?><label for="<?php echo $sInfoTypeKey; ?>" id="<?php echo $sInfoTypeKey . '_label'; ?>"><?php echo $oInfoType->getTypeName(); ?></label>
                <input type="text" name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][value]" class="input_kol" id="<?php echo $sInfoTypeKey; ?>" value="<?php echo $oInfo ? $oInfo->getValue() : ''; ?>"/>
            </p>
            <?php endforeach; ?>
        </div>
        
        

        <div>
            <img width="510" height="12" alt="linje" src="http://109.74.7.190/b/media/brf/linje.png" class="linje"/>
        </div>
        
        <h4 style="margin-left: 35px;">Övrigt</h4>
        <div class="kol3">
            <?php
                foreach (array('ovriginformation') as $sInfoTypeKey):
                    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
                    $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInformation) ? $aRealtorInformation[$sInfoTypeKey] : NULL;
            ?>
            <p>
                <?php if (FALSE && $oInfoType->getRequired()): ?>*<?php endif; ?><label for="<?php echo $sInfoTypeKey; ?>" id="<?php echo $sInfoTypeKey . '_label'; ?>"><?php echo $oInfoType->getTypeName(); ?></label>
                <textarea name="<?php echo $oInfoType->getRealtorInformationCategory()->getCategoryKey(); ?>[<?php echo $sInfoTypeKey; ?>][value]" style="width: 440px;" rows="5" id="<?php echo $sInfoTypeKey; ?>"><?php echo $oInfo ? $oInfo->getValue() : ''; ?></textarea>
            </p>
            <?php endforeach; ?>
        </div>
     
        <div class="kol3"><!-- Början på kolumn 3 -->

            <input type="image"  src="<?php echo BASE_DIR; ?>media/inloggad/img/spara.png" id="saveRealtorInfo" style="border:none; margin-left:15px;"/>
            
            
            <p style="margin-left:15px; display: none;">* obligatorisk information</p>

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
                            alert('Uppgifterna har sparats.');
                        }
                        var element = $("#" + response.data.errors[errorCounter]);
                        if ($(element).filter("input[type='text']").size() == 1) {
                            //$(element).css('background-color', 'red');
                        } else {
                            //$(element).css('color', 'red');
                        }
                    }
                }
            }
        }, 'json');
       
       return false;
    });
</script>