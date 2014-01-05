<script>document.domain = '<?php $sDomain = str_replace(array("https://","http://"),array('',''),BASE_DIR); $sDomain = substr($sDomain, 0, strlen($sDomain) - 1); echo $sDomain; ?>';</script>
<?php
    if (!isset($sJsAction)) {
        $sJsAction = "";
    }
    switch ($sAction) {
        case 'tempupload':
            $sDestination = TMP_DIR . getUser()->getId() . '_' .  basename( $_FILES['Picture']['name']);
            @move_uploaded_file($_FILES['Picture']['tmp_name'], $sDestination);
            break;
        case 'save':
           
            
            
            $aRequest = $_POST['member'];
            if (!getUser()->isRegistered() && getUser()->isMember()) {
                SvenskBRF_Notice::sendMemberRegistrationMail(getUser());
            }
            SvenskBRF_User::saveUser($aRequest, $_FILES['Picture'], getUser());
            
            if (array_key_exists('realtor', $_POST) && !$_POST['member']['ExternalPartnerId']) {
                
                $oPartnerCollection = getExternalPartnerAccessor()->getExternalPartnersByPartnerName($_POST['realtor']['PartnerName']);
                if ($oPartnerCollection->size()) {
                    // check name
                    $sJsAction = "$('#addRealtorLink').click(); $('#extPartnerName').css('background-color','red'); alert('Mäklarfirma " . $_POST['realtor']['PartnerName'] . " finns redan')"; 
                } else if (!$_POST['realtor']['PartnerName']) {
                    // check logo
                    $sJsAction = "$('#addRealtorLink').click(); $('#extPartnerName').css('background-color','red'); alert('Ange namn på mäklarfirma'); "; 
                } else {
                    $oExternalPartner = SvenskBRF_ExternalPartner::load(ExternalPartner::create(SvenskBRF_ExternalPartner::PARTNER_TYPE_REALTOR, $_POST['realtor']['PartnerName'], FALSE, NULL, NULL, NULL, NULL, NULL, TRUE));
                    if (!$oExternalPartner->savePicture(@$_FILES['realtorLogo'])) {
                        $iExcludePartner = $oExternalPartner->getId();
                        $oExternalPartner->delete();
                        $sJsAction = "$('#addRealtorLink').click();  alert('Ladda upp en logga till mäklarfirman.')";
                    } else {
                        getUser()->setExternalPartnerId($oExternalPartner->getId());
                    }
                }
            }
            
            if (!$sJsAction) {
                $sJsAction = "alert('Dina uppgifter har sparats.')";
            }
                
            break;
    }
    $bIsIE = (bool) strpos($_SERVER['HTTP_USER_AGENT'], "IE");
?>
<style type="text/css">.hidden {display:none;}</style>
<img id="bla_skylt" class="medlem" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/maklare.png" width="210" height="36" alt="medlemsidor" /> 
<?php
    $iMedlemWidth = 123;
    $iMedlemHeight = 170;
?>
<form method="post" action="<?php echo BASE_DIR; ?>maklare/installningar" id="memberForm" name="memberForm" enctype="multipart/form-data">
    <div id="kol1">
        <?php $oUser = getUser(); ?>
        <?php if (!$oUser->hasPicture()): ?>
        <label for="upfile">
        <div id="bild_medlem" style="height: <?php echo $iMedlemHeight; ?>px; width: <?php echo $iMedlemWidth; ?>px; border:1px dashed #BBB; cursor:pointer; text-align:center;">Klicka här för att ladda upp din bild!</div>
        </label>
        <div style='height: 0px;width:0px; overflow:hidden;'><input id="upfile" type="file" name="Picture" value="upload"/></div>
        <?php else: ?>
        <label for="upfile">
        <div id="bild_medlem">
            <img src="<?php echo getUser()->getImageData(); ?> " width="<?php echo $iMedlemWidth; ?>" height="<?php echo $iMedlemHeight; ?>"
                 style="height: auto; width: auto; max-width: <?php echo $iMedlemWidth; ?>px; max-height: <?php echo $iMedlemHeight; ?>px;"
            />
        </div>
        </label>
        <div style='height: 0px;width:0px; overflow:hidden;'><input id="upfile" type="file" name="Picture" value="upload"/></div>
        <?php endif; ?>    
        <br />
        <br />
        <p class="rubrik_form">*Förnamn:</p>
        <input type="text" class="form_bredd" name="member[Firstname]" value="<?php echo current(explode(" ", getUser()->getName())); ?>"/>
        
        <p class="rubrik_form">*Efternamn:</p>
        <input type="text" class="form_bredd" name="member[Surname]" value="<?php echo current(array_reverse(explode(" ", getUser()->getName(), 2))); ?>"/>
        
        <p style="margin-bottom:10px;" class="rubrik_form">Din e-post och ditt telefonnummer kommer inte att visas för övriga medlemmar. Kryssa i rutan nedan om du vill visa ditt telefonnummer.</p>
        
        <?php if (FALSE && !$oUser->isRegistered()): ?>
        <p class="rubrik_form">*E-post:</p>
        <input type="text" class="form_bredd" name="member[Email][0]" value=""/>
        
        <p class="rubrik_form">*Bekräfta E-post:</p>
        <input type="text" value="" name="member[Email][1]" class="form_bredd">
        <?php else: ?>
        <p class="rubrik_form">*E-post:</p>
        <input type="text" class="form_bredd" name="member[Email]" value="<?php echo getUser()->getEmail(); ?>"/>
        <?php endif; ?>
        
        <?php if (FALSE && !$oUser->isRegistered()): ?>
        <p class="rubrik_form">*Mobiltelefonnummer:</p>
        <input type="text" class="form_bredd" name="member[Phone][0]" value=""/>
        
        <p class="rubrik_form">*Bekräfta mobiltelefonnummer:</p>
        <input type="text" class="form_bredd" name="member[Phone][1]" value=""/>
        <?php else: ?>
        <p class="rubrik_form">*Mobiltelefonnummer:</p>
        <input type="text" class="form_bredd" name="member[Phone]" value="<?php echo $oUser->getCellphone(); ?>"/>
        <?php endif; ?>
        
        <input type="hidden" name="member[HidePhone]" value="1"/>
        <input type="checkbox" name="member[HidePhone]" id="showPhone" value="0"<?php if (!getUser()->getHidePhone()): ?> checked="checked"<?php endif; ?>/>
        <label for="showPhone">Visa ditt telefonnummer</label>
        
        <?php if (TRUE || $oUser->isRegistered()): ?>
        <p class="rubrik_form">Nytt användarnamn</p>
        <input type="text" name="member[Username][0]" value="" class="form_bredd"/>
        
        <p class="rubrik_form">Bekräfta användarnamn</p>
        <input type="text" class="form_bredd" name="member[Username][1]" value=""/>
        <?php else: ?>
        <p class="rubrik_form">*Användarnamn</p>
        <input type="text" name="member[Username][0]" value="" class="form_bredd"/>
        
        <p class="rubrik_form">*Bekräfta användarnamn</p>
        <input type="text" class="form_bredd" name="member[Username][1]" value=""/>
        <?php endif; ?>
        
        <?php if (TRUE || $oUser->isRegistered()): ?>
        <p class="rubrik_form">Nytt lösenord</p>
        <input type="password" name="member[Password][0]" class="form_bredd"/>
        <p class="rubrik_form errorPassword error" style="margin-top:-15px; margin-bottom: 10px; display:none;">Lösenordet måste ha minst fem tecken.</p>
        
        <p class="rubrik_form">Bekräfta lösenord</p>
        <input type="password" name="member[Password][1]" class="form_bredd"/>
        <?php else: ?>
        <p class="rubrik_form">*Lösenord</p>
        <input type="password" name="member[Password][0]" class="form_bredd"/>
        <p class="rubrik_form errorPassword error" style="margin-top:-15px; margin-bottom: 10px; display:none;">Lösenordet måste ha minst fem tecken.</p>
        
        <p class="rubrik_form">*Bekräfta ösenord</p>
        <input type="password" name="member[Password][1]" class="form_bredd"/>
        <?php endif; ?>
    </div>

    <div id="kol2" style="padding-top: 203px;">
        <?php /*
        <p class="rubrik_form hidden">*Titel:</p>
        <select name="member[TitleId]" class="hidden">
            <?php if (!$oUser->getUserTitleId()): ?>
            <option value="">Välj...</option>
            <?php endif; ?>
            <?php
                $oTitles = getUserTitleAccessor()->getAll();
            ?>
            <?php foreach ($oTitles as $oTitle): ?>
            <option value="<?php echo $oTitle->getId(); ?>"<?php if ($oUser->getUserTitleId() == $oTitle->getId()): ?> selected="selected"<?php endif; ?>><?php echo $oTitle->getTitleName(); ?></option>
            <?php endforeach; ?>
            <option value="">Övrigt</option>
        </select> */ ?>
        
        <p class="rubrik_form ownTitle hidden">Namn på titel som inte finns i listan:</p>
        <input type="text" name="member[OwnTitle]" id="ownTitleField" disabled="disabled" value="" class="form_bredd ownTitle hidden"/>
        
        <br />
        
        
        <p style="margin-bottom:10px;" class="rubrik_form hidden">Alla bostadsrätter har ett lägenhetsnummer som delas ut av lantmäteriet. Är du osäker på vilket nummer din lägenhet har kan du kontakta kommunen där du bor.</p>
        
        <p class="rubrik_form hidden">Lägenhetsnummer:</p>
        <input type="text" class="form_bredd hidden" value="<?php echo $oUser->getApartmentNumber(); ?>" name="member[ApartmentNumber]"/>
       
        <p class="rubrik_form hidden">Föreningens eget lägenhetsnummer:</p>
        <input type="text" class="form_bredd hidden" value="<?php echo $oUser->getApartmentNumber2(); ?>" name="member[ApartmentNumber2]"/>
       
        <p class="rubrik_form hidden">Våningsplan:</p>
        <input type="text" class="form_bredd hidden" value="<?php echo $oUser->getFloor(); ?>" name="member[Floor]"/>
        
        <?php if (($oBrfAddresses = $oBrf->getBrfAddresses()) && $oBrfAddresses->size()): ?>
        <p class="rubrik_form hidden">*Adress:</p>
        <select name="member[AddressId]" class="hidden">
            <option value=""><?php echo $oBrf->getAddress(); if ($oBrf->getStreetNumber()) echo ' ' . $oBrf->getStreetNumber(); ?></option>
            <?php foreach ($oBrfAddresses as $oBrfAddress): ?>
            <option value="<?php echo $oBrfAddress->getId(); ?>"<?php if ($oUser && $oBrfAddress->getId() == $oUser->getAddressId()): ?> selected="selected"<?php endif; ?>>
                <?php echo $oBrfAddress->getAddress(); ?>
                <?php if ($oBrfAddress->getStreetNumber()) echo ' ' . $oBrfAddress->getStreetNumber(); ?>
                <?php if ($oBrfAddress->getStreetNumber2()) echo '-' . $oBrfAddress->getStreetNumber2(); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php endif; ?>
        <p class="rubrik_form hidden">Ålder:</p>
        <input class="form_bredd hidden" type="text" name="member[Age]" value="<?php echo ((int) getUser()->getAge()) ? $oUser->getAge() : ''; ?>"/>
        
        <p style="margin-bottom:10px;" class="rubrik_form hidden">Är ni flera ägare till bostadsrätten så kan ni lägga till ytterligare personer här. Notera att en person kommer att stå som huvudkontakt. Det är huvudkontakten som kommer att synas när man exempelvis gör bokningar</p>
        
        <p class="rubrik_form hidden">Bor med:</p>
        <input type="text" class="form_bredd hidden" name="member[LivesWith]" value="<?php echo $oUser->getLivesWith(); ?>"/>
        
        <p class="rubrik_form">*Mäklarfirma</p>
        <select name="member[ExternalPartnerId]">
            <option value="">Välj...</option>
            <?php foreach (SvenskBRF_ExternalPartner::getRealtors() as $oRealtor): ?>
            <?php if (!isset($iExcludePartner) || $iExcludePartner != $oRealtor->getId()): ?>
            <option value="<?php echo $oRealtor->getId(); ?>"<?php if ($oUser && $oUser->getExternalPartnerId() == $oRealtor->getId()): ?> selected="selected"<?php endif; ?>>
                <?php echo $oRealtor->getPartnerName(); ?>
            </option>
            <?php endif; ?>
            <?php endforeach; ?>
        </select>
        
        <p class="rubrik_form"><a id="addRealtorLink" href="javascript:void(0)" onclick="$('#newRealtor').find('p,input').toggleClass('hidden').prop('disabled', function() { return !$(this).prop('disabled') ? 'disabled' : ''}); setHeight(); return false;">Saknas ditt mäklarföretag i listan?</a></p>
        <br />
        <div id="newRealtor">
            <p class="rubrik_form hidden">Mäklarfirmans namn:</p>
            <input type="text" class="form_bredd hidden" name="realtor[PartnerName]" id="extPartnerName" disabled="disabled" value="<?php echo @$_POST['realtor']['PartnerName']; ?>"/>
            <p class="rubrik_form hidden">Logga (png/jpg/gif-bild):</p>
            <input type="file" class="form_bredd hidden" name="realtorLogo" disabled="disabled"/>
        </div>
        
        
        <p class="rubrik_form">Presentation</p>
        <textarea rows="20" cols="24" name="member[Presentation]"><?php echo trim(getUser()->getPresentation()); ?></textarea>
        
        <?php if (!$oUser->isRegistered()): ?>
        <p>
            Nu är du nästan klar med registreringen!
            <a href="<?php echo BASE_DIR; ?>/maklarvillkor" target="_blank">Läs igenom</a> 
            de villkor som gäller för sidan och bocka sedan i rutan nedan.
        </p>
        
        <p>
            <input type="hidden" value="0" name="member[Villkor]"/>
            <input type="checkbox" value="1" name="member[Villkor]" id="villkor"/>
            <label for="villkor" id="villkorLabel">Jag godkänner villkoren</label>
        </p>
        <?php endif; ?>
        <input style="border:none;" type="image" src="<?php echo BASE_DIR; ?>media/inloggad/img/spara.png" id="gaVidare"/>
        <br />
        <p style="margin-left:15px;">* obligatorisk information</p>
        <?php if (FALSE && $oUser->isRegistered()): ?>
        <p></p>
        <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
        <p class="rubrik_form"><label for="tags">Kontaka förening om Svensk Brf (registreringslänk):</label></p>
        <input id="tags" class="form_bredd" type="text" onblur="" style="width: 200px;"/>
        <p class="rubrik_form linkField" style="display:none;"><label for="tags">Registreringslänk:</label></p>
        <textarea rows="2" cols="24" id="linkField" class="linkField" style="display:none;"></textarea>
        
        <script type="text/javascript">
            function autoComplete(request, response, url) {
                $.ajax({
                    url: '<?php echo BASE_DIR; ?>searchbrf.php',
                    data : {term : request.term, param : 'realtor'},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response($.map(data, function(item) {
                            return { 
                                label: item.name,
                                value: item.name
                            };
                        }));
                    }
                });
            }
            
            $("#tags").keyup(function(){
               $(".linkField").hide(); 
            });
            
            $("#tags").autocomplete({
                source : autoComplete,
                select : function(event, ui) {
                    $.post('<?php echo BASE_DIR; ?>ajax.php', { action : 'generaterealtorlink', 'brf' : $("#tags").val(), userId : <?php echo $oUser->getId(); ?>}, function(response) {
                        if (response.result) {
                            $("#linkField").val(response.data.link);
                        }
                    }, 'json');
                    $(".linkField").fadeIn();
                },
                close : function(event, ui) {
                    
                }
            });
        </script>
        <?php endif; ?>
    </div>
    <input type="hidden" name="action" id="formAction" value="save" />
    <input type="hidden" name="number" value="<?php echo rand(10000, 99999); ?>" id="picNumber"/>
    <input type="hidden" name="userid" value="<?php echo $oUser->getId(); ?>"/>
    <?php if (!$bRegistered): ?>
    <input type="hidden" name="member[IsRegistered]" value="1"/>
    <?php endif; ?>
</form>
<iframe id="upload_target" name="upload_target" style="width:0;height:0;border:0px solid #fff;" onload="/*alert($(this).contents().find('body').html());*/"></iframe> 
<script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/messi.min.js"></script>
<script type="text/javascript">
function showMessage(message, buttonText) {
        new Messi(
            message,
            {   
                title: 'Svensk Brf', 
                buttons: [{id: 0, label: buttonText, val: 'X'}]
                ,center : true
                //,modalOpacity : 2
            }
        );
    }
</script>
<link href="<?php echo BASE_DIR; ;?>media/js/messi.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var imageType = '';
    function getImageType() {
        imageType = $("#upload_target").contents().find("body").html();
        $.post("<?php echo BASE_DIR; ?>ajax.php", { action : 'tempupload' , 'file' : $("#upfile").val(), number : $("#picNumber").val(), imageType : imageType }, function (response) { 
            if (response.result) {
                $("#bild_medlem").removeAttr("style").html('<img src="' + response.data.image +'" height="<?php echo $iMedlemHeight; ?>" width="<?php echo $iMedlemWidth; ?>" style="height:auto; width:auto; max-width:<?php echo $iMedlemWidth; ?>px; max-height:<?php echo $iMedlemHeight; ?>px;"/>');
            } else {
            }
        },'json');
    }
</script>
<script type="text/javascript">
    var actionProperty = $("#memberForm").attr('action');
    $("#upfile").change(function() {
        submitPicture();
    });
    
    function submitPicture()
    {
        <?php if (!$bIsIE): ?>
        $("#memberForm").prop("target", 'upload_target');
        $("#formAction").val("tempupload");
        $("#memberForm").attr('action', '<?php echo BASE_DIR; ?>temppictureuser.php');
        $("#memberForm").submit();
        <?php else: ?>
        document.memberForm.setAttribute('target','upload_target');
        $("#formAction").val("tempupload");
        $("#memberForm").attr('action', '<?php echo BASE_DIR; ?>temppictureuser.php');
        document.memberForm.submit();
        <?php endif; ?>

        $("#memberForm").attr("action", actionProperty);
        $("#formAction").val("save");
        $("#memberForm").removeAttr('target');
        window.setTimeout(getImageType, 800);
    }
    
    $(document).ready(function(){
        var validated = false;
        $("#gaVidare").click(function(){
            if (!validated) {
                $("#villkorLabel").removeClass('color-red');
                $("#formAction").val('validatememberform');
                $("#memberForm input,select").css('background-color', '');
                var memberForm = $("#memberForm").serialize();
                memberForm+="&doubleOptional=<?php echo $oUser->isRegistered() ? 1 : 1; ?>";
                $.post("<?php echo BASE_DIR; ?>ajax.php", memberForm, function (response) { 
                    if (response.result) {
                        if (!response.data.error) {
                            for (var i = 0; i < response.data.errors.length; i++) {
                                if (typeof response.data.errors[i] === 'object') {
                                    $("input[name='member["+response.data.errors[i][0]+"]["+response.data.errors[i][1]+"]"+"']").css('background-color', 'red');
                                    $("select[name='member["+response.data.errors[i][0]+"]["+response.data.errors[i][1]+"]"+"']").css('background-color', 'red');
                                } else {
                                    if (response.data.errors[i] == 'Villkor') {
                                        $("#villkorLabel").addClass('color-red');
                                    } else {
                                        $("input[name='member["+response.data.errors[i]+"]']").css('background-color', 'red');
                                        $("select[name='member["+response.data.errors[i]+"]']").css('background-color', 'red');
                                    }
                                }
                            }
                            window.scrollTo(0, 250);
                        } else {
                            validated = true;
                            $("#gaVidare").click();
                        }
                    }
                },'json');
                $("#formAction").val('save');
                return false;
            } else {
                return true;
            }
        });
        
        $(".ownTitle").hide();
        
        $("select[name='member[TitleId]']").change(function(){
            if ($(this).val() === '') {
                $("#ownTitleField").removeAttr('disabled');
                $(".ownTitle").fadeIn();
            } else {
                $(".ownTitle").hide();
                $("#ownTitleField").prop('disabled', true);
            }
        });
        
        <?php if (!$oUser->getIsRegistered()): ?>
        window.setTimeout("showMessage('Välkommen!<br /><br />Du kommer snart få tillgång till flera användbara funktioner för dig som mäklare!<br /><br />Detta är första gången du loggar in.<br /><br />Har du några frågor så är du välkommen att kontakta oss på Svensk Brf!<br /><br />maklare@svenskbrf.se', 'OK')", 1000);
        <?php endif; ?>
    });
</script>
<script type="text/javascript">
    $("a.nav:contains('Inställningar')").css('font-style', 'oblique');
</script>
