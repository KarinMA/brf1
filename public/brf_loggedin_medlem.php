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
            $bSendRegMail = FALSE;
            if (!getUser()->isRegistered()) {
                $bSendRegMail = TRUE;
            }
            if (@$_POST['addMember']) {
                $oNewBrfUser = SvenskBRF_User::saveUser($aRequest, $_FILES['Picture'], NULL, getUser());
                $sJsAction = "alert('{$aRequest['Firstname']} {$aRequest['Surname']} har lagts till som medlem.')";
            } else {
                SvenskBRF_User::saveUser($aRequest, $_FILES['Picture'], getUser());
                $sJsAction = "alert('Dina uppgifter har sparats.')";
                if ($bSendRegMail) {
                    SvenskBRF_Notice::sendMemberRegistrationMail(getUser());
                }
            }
            break;
    }
    $bAddMember = @$_REQUEST['subview'] === 'laggtill';
    $bIsIE = (bool) strpos($_SERVER['HTTP_USER_AGENT'], "IE");
?>
<img id="bla_skylt" class="medlem" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/medlem.png" width="210" height="36" alt="medlemsidor" /> 
<?php
    $iMedlemWidth = 123;
    $iMedlemHeight = 170;
?>
<?php if (!$bAddMember): ?>
<p>Här kan du enkelt lägga upp uppgifter om dig själv som kommer att visas på din medlemsprofil. Fyll i uppgifterna nedan och tryck på spara. För att lägga till eller byta bild klickar du på den grå bildrutan.</p>
<p><i>Vi kommer inte att lämna ut dina eller föreningens uppgifter till tredje part. Vi tillämpar strikt personuppgiftslagen (PUL).</i></p>
<form method="post" action="" id="memberForm" name="memberForm" enctype="multipart/form-data">
    <div id="kol1">
        <?php $oUser = getUser(); ?>
        <?php if (!$oUser->hasPicture()): ?>
        <label for="upfile">
        <div id="bild_medlem" style="height: <?php echo $iMedlemHeight; ?>px; width: <?php echo $iMedlemWidth; ?>px; border:1px dashed #BBB; cursor:pointer; text-align:center;">Klicka här för att ladda upp din bild!</div>
        </label>
        <div style='height: 0px; width: 0px; overflow:hidden;'><input id="upfile" type="file" name="Picture" value="upload"/></div>
        <?php else: ?>
        <label for="upfile">
        <div id="bild_medlem">
            <img src="<?php echo $oUser->getImageData(); ?> " width="<?php echo $iMedlemWidth; ?>" height="<?php echo $iMedlemHeight; ?>"
                 style="height: auto; width: auto; max-width: <?php echo $iMedlemWidth; ?>px; max-height: <?php echo $iMedlemHeight; ?>px;"
            />
        </div>
        </label>
        <div style='height: 0px; width: 0px; overflow:hidden;'><input id="upfile" type="file" name="Picture" value="upload"/></div>
        <?php endif; ?>    
        <br />
        <br />
        <p class="rubrik_form">*Förnamn:</p>
        <input type="text" class="form_bredd" name="member[Firstname]" value="<?php echo current(explode(" ", $oUser->getName())); ?>"/>
        
        <p class="rubrik_form">*Efternamn:</p>
        <input type="text" class="form_bredd" name="member[Surname]" value="<?php echo current(array_reverse(explode(" ", $oUser->getName(), 2))); ?>"/>
        
        <p style="margin-bottom:10px;" class="rubrik_form">Din e-post och ditt telefonnummer kommer inte att visas för övriga medlemmar. Kryssa i rutan nedan om du vill visa ditt telefonnummer.</p>
        
        <?php if (!$oUser->isRegistered() && !$oUser->getPrimaryMemberId()): ?>
        <p class="rubrik_form">*E-post:</p>
        <input type="text" class="form_bredd" name="member[Email][0]" value=""/>
        <p class="rubrik_form errorEmail error" style="margin-top:-15px; margin-bottom: 10px; display:none;">Ange en giltig e-postadress.</p>
        <p class="rubrik_form">*Bekräfta E-post:</p>
        <input type="text" value="" name="member[Email][1]" class="form_bredd">
        <?php else: ?>
        <p class="rubrik_form">*E-post:</p>
        <input type="text" class="form_bredd" name="member[Email]" value="<?php echo $oUser->getEmail(); ?>"/>
        <p class="rubrik_form errorEmail error" style="margin-top:-15px; margin-bottom: 10px; display:none;">Ange en giltig e-postadress.</p>
        <?php endif; ?>
        
        <?php if (!$oUser->isRegistered() && !$oUser->getPrimaryMemberId()): ?>
        <p class="rubrik_form">*Mobiltelefonnummer:</p>
        <input type="text" class="form_bredd" name="member[Phone][0]" value=""/>
        <p class="rubrik_form errorPhone error" style="margin-top:-15px; margin-bottom: 10px; display:none;">Ange ett giltigt mobiltelefonnummer.</p>
        <p class="rubrik_form">*Bekräfta mobiltelefonnummer:</p>
        <input type="text" class="form_bredd" name="member[Phone][1]" value=""/>
        <?php else: ?>
        <p class="rubrik_form">*Mobiltelefonnummer:</p>
        <input type="text" class="form_bredd" name="member[Phone]" value="<?php echo $oUser->getCellphone(); ?>"/>
        <p class="rubrik_form errorPhone error" style="margin-top:-15px; margin-bottom: 10px; display:none;">Ange ett giltigt mobiltelefonnummer.</p>
        <?php endif; ?>
        
        <input type="hidden" name="member[HidePhone]" value="1"/>
        <input type="checkbox" name="member[HidePhone]" id="showPhone" value="0"<?php if ($oUser->isRegistered() && !$oUser->getHidePhone()): ?> checked="checked"<?php endif; ?>/>
        <label for="showPhone">Visa ditt telefonnummer</label>
        
        <?php if ($oUser->isRegistered() || $oUser->getPrimaryMemberId()): ?>
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
        
        <?php if ($oUser->isRegistered() || $oUser->getPrimaryMemberId()): ?>
        <p class="rubrik_form">Nytt lösenord</p>
        <input type="password" name="member[Password][0]" class="form_bredd"/>
        <p class="rubrik_form errorPassword error" style="margin-top:-15px; margin-bottom: 10px; display:none;">Lösenordet måste ha minst fyra tecken.</p>
        
        <p class="rubrik_form">Bekräfta lösenord</p>
        <input type="password" name="member[Password][1]" class="form_bredd"/>
        <?php else: ?>
        <p class="rubrik_form">*Lösenord</p>
        <input type="password" name="member[Password][0]" class="form_bredd"/>
        <p class="rubrik_form errorPassword error" style="margin-top:-15px; margin-bottom: 10px; display:none;">Lösenordet måste ha minst fyra tecken.</p>
        <p class="rubrik_form">*Bekräfta lösenord</p>
        <input type="password" name="member[Password][1]" class="form_bredd"/>
        <?php endif; ?>
    </div>

    <div id="kol2">
        
        <!--<p class="rubrik_form">*Titel:</p>
        <select name="member[TitleId]">
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
        </select>
        
        <p class="rubrik_form ownTitle">Namn på titel som inte finns i listan:</p>
        <input type="text" name="member[OwnTitle]" id="ownTitleField" disabled="disabled" value="" class="form_bredd ownTitle"/>
        
        <br />-->
        
        <?php if ($oUser->getPrimaryMember()): ?>
        <p style="margin-bottom:10px;" class="rubrik_form">Alla bostadsrätter har ett lägenhetsnummer som delas ut av lantmäteriet. Är du osäker på vilket nummer din lägenhet har kan du kontakta kommunen där du bor.</p>
        
        <p class="rubrik_form">Lägenhetsnummer:</p>
        <input type="text" class="form_bredd" value="<?php echo $oUser->getApartmentNumber(); ?>" name="member[ApartmentNumber]"/>
       
        <p class="rubrik_form">Föreningens eget lägenhetsnummer:</p>
        <input type="text" class="form_bredd" value="<?php echo $oUser->getApartmentNumber2(); ?>" name="member[ApartmentNumber2]"/>
       
        <p class="rubrik_form">Våningsplan:</p>
        <input type="text" class="form_bredd" value="<?php echo $oUser->getFloor(); ?>" name="member[Floor]"/>
        
        <?php if (($oBrfAddresses = $oBrf->getBrfAddresses()) && $oBrfAddresses->size()): ?>
        <p class="rubrik_form">*Adress:</p>
        <input type="hidden" name="member[AddressId]" value="" id="addressId"/>
        <select name="member[AddressNumber]">
            <option value="" onclick="$('#addressId').val(''); return true;"><?php echo $oBrf->getAddress(); if ($oBrf->getStreetNumber()) echo ' ' . $oBrf->getStreetNumber(); ?></option>
            <?php foreach ($oBrfAddresses as $oBrfAddress): ?>
            <optgroup label="<?php echo $oBrfAddress->getAddress(); ?>" onclick="$('#addressId').val(<?php echo $oBrfAddress->getId(); ?>);">
                <?php for ($iAddressIndex = $oBrfAddress->getStreetNumber(); $iAddressIndex <= ($oBrfAddress->getStreetNumber2() ? $oBrfAddress->getStreetNumber2() : $oBrfAddress->getStreetNumber()); 
                    $iAddressIndex += (
                            ($oBrfAddress->getEvenNumbers() && !$oBrfAddress->getOddNumbers())
                            || 
                            (!$oBrfAddress->getEvenNumbers() && $oBrfAddress->getOddNumbers())
                    ) ? 2 : 1        
                    ): 
                ?>
                <option value="<?php echo $iAddressIndex; ?>"<?php if ($oUser && $oBrfAddress->getId() == $oUser->getAddressId() && $iAddressIndex == $oUser->getAddressNumber()): ?> selected="selected"<?php endif; ?>>
                    <?php //echo $oBrfAddress->getAddress(); ?>
                    <?php if ($oBrfAddress->getStreetNumber()); //echo ' ' . $oBrfAddress->getStreetNumber(); ?>
                    <?php if ($oBrfAddress->getStreetNumber2()); //echo '-' . $oBrfAddress->getStreetNumber2(); ?>
                    <?php echo $iAddressIndex; ?>
                </option>
                <?php endfor; ?>
            </optgroup>
            <?php endforeach; ?>
        </select>
        
        <?php endif; ?>
        <?php endif; ?>
        <p class="rubrik_form">Ålder:</p>
        <input class="form_bredd" type="text" name="member[Age]" value="<?php echo ((int) $oUser->getAge()) ? $oUser->getAge() : ''; ?>"/>
        
        <?php if ($oUser->getPrimaryMember()): ?>
        <p style="margin-bottom:10px;" class="rubrik_form">Är ni flera ägare till bostadsrätten så kan ni lägga till ytterligare personer här. Notera att en person kommer att stå som huvudkontakt. Det är huvudkontakten som kommer att synas när man exempelvis gör bokningar</p>
        <p style="margin-bottom:10px;" class="rubrik_form"><a href="<?php echo BASE_DIR . $oBrf->getUrl() . '/medlem/laggtill'; ?>">Lägg till medlem i hushållet</a></p>
        <?php endif; ?>
        
        <?php if (!$oUser->getPrimaryMemberId()): ?>
        <p class="rubrik_form">Bor med:</p>
        <input type="text" class="form_bredd" name="member[LivesWith]" value="<?php echo $oUser->getLivesWith(); ?>"/>
        <?php endif; ?>
        <p class="rubrik_form">Intressen/presentation:</p>
        <textarea rows="4" cols="24" name="member[Presentation]"><?php echo trim($oUser->getPresentation()); ?></textarea>
        
        <?php if (!$oUser->isRegistered()): ?>
        <p>
            Nu är du nästan klar med registreringen!
            <a href="<?php echo BASE_DIR; ?>/villkor" target="_blank">Läs igenom</a> 
            de villkor som gäller för sidan och bocka sedan i rutan nedan.
        </p>
        
        <p>
            <input type="hidden" value="0" name="member[Villkor]"/>
            <input type="checkbox" value="1" name="member[Villkor]" id="villkor"/>
            <label for="villkor" id="villkorLabel">Jag godkänner villkoren</label>
        </p>
        <?php elseif ($oUser->getPrimaryMember() && $oBrf->getRealtorUser()): ?>
        <p class="rubrik_form"></p>
        <input type="hidden" name="member[setting][<?php echo SvenskBRF_User::BLOCK_REALTOR_MESSAGE_SETTING_ID; ?>]" value="1"/>
        <input type="checkbox" name="member[setting][<?php echo SvenskBRF_User::BLOCK_REALTOR_MESSAGE_SETTING_ID; ?>]" value="0" id="blockRealtorMessage" <?php if (!$oUser->getSetting(SvenskBRF_User::BLOCK_REALTOR_MESSAGE_SETTING_ID)): ?>checked="checked"<?php endif; ?>/>
        <label for="blockRealtorMessage" style="font-size: 8.2px;">Visa meddelanden från föreningens mäklare</label>
        <br />
        <br />
        <?php endif; ?>
        <input style="border:none;" type="image" src="<?php echo BASE_DIR; ?>media/inloggad/img/spara.png" id="gaVidare"/>
        
        <br />
        
        <p style="margin-left:15px;">* obligatorisk information</p>
    </div>
    <input type="hidden" name="action" id="formAction" value="save" />
    <input type="hidden" name="number" value="<?php echo rand(10000, 99999); ?>" id="picNumber"/>
    <input type="hidden" name="userid" value="<?php echo $oUser->getId(); ?>"/>
    <?php if (!$bRegistered): ?>
    <input type="hidden" name="member[IsRegistered]" value="1"/>
    <?php endif; ?>
</form>
<?php else: ?>
<p>Här lägger du till en medlem i ditt hushåll.</p>
<form method="post" action="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/medlem" id="memberForm" name="memberForm" enctype="multipart/form-data">
    <div id="kol1">
        <?php $oUser = getUser(); ?>
        <div id="bild_medlem" style="height: <?php echo $iMedlemHeight; ?>px; width: <?php echo $iMedlemWidth; ?>px; border:1px dashed #BBB; cursor:pointer; text-align:center;" onclick="$('#upfile').click();">Klicka här för att ladda upp bild!</div>
        <div style='height: 0px;width:0px; overflow:hidden;'><input id="upfile" type="file" name="Picture" value=""/></div>
        <br />
        <br />
        <p class="rubrik_form">*Förnamn:</p>
        <input type="text" class="form_bredd" name="member[Firstname]" value=""/>
        
        <p class="rubrik_form">*Efternamn:</p>
        <input type="text" class="form_bredd" name="member[Surname]" value=""/>
        
        <p style="margin-bottom:10px;" class="rubrik_form">Din e-post och ditt telefonnummer kommer inte att visas för övriga medlemmar. Kryssa i rutan nedan om du vill visa ditt telefonnummer.</p>
        
        <p class="rubrik_form">*E-post:</p>
        <input type="text" class="form_bredd" name="member[Email][0]" value=""/>
        <p class="rubrik_form errorEmail error" style="margin-top:-15px; margin-bottom: 10px; display:none;">Ange en giltig e-postadress.</p>
        
        <p class="rubrik_form">*Bekräfta E-post:</p>
        <input type="text" value="" name="member[Email][1]" class="form_bredd">
        
        <p class="rubrik_form">*Mobiltelefonnummer:</p>
        <input type="text" class="form_bredd" name="member[Phone][0]" value=""/>
        <p class="rubrik_form errorPhone error" style="margin-top:-15px; margin-bottom: 10px; display:none;">Ange ett giltigt mobiltelefonnummer.</p>
        
        <p class="rubrik_form">*Bekräfta mobiltelefonnummer:</p>
        <input type="text" class="form_bredd" name="member[Phone][1]" value=""/>
        
        <input type="hidden" name="member[HidePhone]" value="1"/>
        <input type="checkbox" name="member[HidePhone]" id="showPhone" value="0"/>
        <label for="showPhone">Visa telefonnummer</label>
        
        <p class="rubrik_form">*Användarnamn</p>
        <input type="text" name="member[Username][0]" value="" class="form_bredd"/>
        
        <p class="rubrik_form">*Bekräfta användarnamn</p>
        <input type="text" class="form_bredd" name="member[Username][1]" value=""/>
        
        
        <p class="rubrik_form">*Lösenord</p>
        <input type="password" name="member[Password][0]" class="form_bredd"/>
        <p class="rubrik_form errorPassword error" style="margin-top:-15px; margin-bottom: 10px; display:none;">Lösenordet måste ha minst fem tecken.</p>
        
        <p class="rubrik_form">*Bekräfta lösenord</p>
        <input type="password" name="member[Password][1]" class="form_bredd"/>
        
    </div>

    <div id="kol2">
        
        <!--<p class="rubrik_form">*Titel:</p>
        <select name="member[TitleId]">
            <?php if (FALSE && !$oUser->getUserTitleId()): ?>
            <option value="">Välj...</option>
            <?php endif; ?>
            <?php
                $oTitles = getUserTitleAccessor()->getAll();
            ?>
            <?php foreach ($oTitles as $oTitle): ?>
            <option value="<?php echo $oTitle->getId(); ?>"<?php if ($oUser->getUserTitleId() == $oTitle->getId()): ?> selected="selected"<?php endif; ?>><?php echo $oTitle->getTitleName(); ?></option>
            <?php endforeach; ?>
            <option value="">Övrigt</option>
        </select>
        
        <p class="rubrik_form ownTitle">Namn på titel som inte finns i listan:</p>
        <input type="text" name="member[OwnTitle]" id="ownTitleField" disabled="disabled" value="" class="form_bredd ownTitle"/>
        
        <br />-->
        
        <?php if (FALSE && $oUser->getPrimaryMember()): ?>
        <p style="margin-bottom:10px;" class="rubrik_form">Alla bostadsrätter har ett lägenhetsnummer som delas ut av lantmäteriet. Är du osäker på vilket nummer din lägenhet har kan du kontakta kommunen där du bor.</p>
        
        <p class="rubrik_form">Lägenhetsnummer:</p>
        <input type="text" class="form_bredd" value="<?php echo $oUser->getApartmentNumber(); ?>" name="member[ApartmentNumber]"/>
       
        <p class="rubrik_form">Föreningens eget lägenhetsnummer:</p>
        <input type="text" class="form_bredd" value="<?php echo $oUser->getApartmentNumber2(); ?>" name="member[ApartmentNumber2]"/>
       
        <p class="rubrik_form">Våningsplan:</p>
        <input type="text" class="form_bredd" value="<?php echo $oUser->getFloor(); ?>" name="member[Floor]"/>
        
        <?php if (($oBrfAddresses = $oBrf->getBrfAddresses()) && $oBrfAddresses->size()): ?>
        <p class="rubrik_form">*Adress:</p>
        <select name="member[AddressId]">
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
        <?php endif; ?>
        <p class="rubrik_form">Ålder:</p>
        <input class="form_bredd" type="text" name="member[Age]" value=""/>
        
        <?php if (FALSE && $oUser->getPrimaryMember()): ?>
        <p style="margin-bottom:10px;" class="rubrik_form">Är ni flera ägare till bostadsrätten så kan ni lägga till ytterligare personer här. Notera att en person kommer att stå som huvudkontakt. Det är huvudkontakten som kommer att synas när man exempelvis gör bokningar</p>
        <p style="margin-bottom:10px;" class="rubrik_form"><a href="<?php echo BASE_DIR . $oBrf->getUrl() . '/medlem/laggtill'; ?>">Lägg till medlem i hushållet</a></p>
        <?php endif; ?>
        
        <p class="rubrik_form">Bor med:</p>
        <input type="text" disabled="disabled" class="form_bredd" name="member[LivesWith]" value="<?php echo $oUser->getName(); ?>"/>
        <input type="hidden" class="form_bredd" name="member[LivesWith]" value="<?php echo $oUser->getName(); ?>"/>
        <p class="rubrik_form">Intressen/presentation:</p>
        <textarea rows="4" cols="24" name="member[Presentation]"></textarea>
        
        <?php if (FALSE && !$oUser->isRegistered()): ?>
        <p>
            Nu är du nästan klar med registreringen!
            <a href="<?php echo BASE_DIR; ?>/villkor" target="_blank">Läs igenom</a> 
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
    </div>
    <input type="hidden" name="action" id="formAction" value="save" />
    <input type="hidden" name="number" value="<?php echo rand(10000, 99999); ?>" id="picNumber"/>
    <input type="hidden" name="userid" value="<?php echo $oUser->getId(); ?>"/>
    <input type="hidden" name="addMember" value="1"/>
    <input type="hidden" name="member[BrfId]" value="<?php echo $oBrf->getId(); ?>"/>
    <input type="hidden" name="member[IsRegistered]" value="0"/>
</form>

<?php endif; ?>
<iframe id="upload_target" name="upload_target" style="width:0;height:0;border:0px solid #fff;" src="<?php echo BASE_DIR; ?>iframe.php"></iframe> 
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
                ifrm = document.getElementById('upload_target');
                ifrm = (ifrm.contentWindow) ? (ifrm.contentWindow) : (ifrm.contentDocument.document)
                ifrm.domain = '<?php echo $sDomain; ?>';
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
            $("p.error").hide();
            if (!validated) {
                $("#villkorLabel").removeClass('color-red');
                $("#formAction").val('validatememberform');
                $("#memberForm input,select").css('background-color', '');
                var memberForm = $("#memberForm").serialize();
                memberForm+="&doubleOptional=<?php echo ((!$bAddMember && $oUser->isRegistered()) || (!$oUser->isRegistered() && $oUser->getPrimaryMemberId()) ) ? 1 : 0; ?>";
                $.post("<?php echo BASE_DIR; ?>ajax.php", memberForm, function (response) { 
                    if (response.result) {
                        if (!response.data.error) {
                            for (var i = 0; i < response.data.errors.length; i++) {
                                if (typeof response.data.errors[i] === 'object') {
                                    $("input[name='member["+response.data.errors[i][0]+"]["+response.data.errors[i][1]+"]"+"']").css('background-color', 'red');
                                    $("select[name='member["+response.data.errors[i][0]+"]["+response.data.errors[i][1]+"]"+"']").css('background-color', 'red');
                                    $("p.error").filter(".error"+response.data.errors[i][0]).show().css('color', 'red');
                                } else {
                                    if (response.data.errors[i] == 'Villkor') {
                                        $("#villkorLabel").addClass('color-red');
                                    } else {
                                        $("input[name='member["+response.data.errors[i]+"]']").css('background-color', 'red');
                                        $("select[name='member["+response.data.errors[i]+"]']").css('background-color', 'red');
                                        $("p.error").filter(".error"+response.data.errors[i]).show().css('color', 'red');
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

        $("a.showPicture").click(function() {
            submitPicture(); return false;
        });

        <?php if (!$oUser->getIsRegistered()): ?>
        window.setTimeout("showMessage('Välkommen!<br /><br />Du kommer snart få tillgång till flera användbara funktioner för dig som boende!<br /><br />Detta är första gången du loggar in.<br /><br />Har du några frågor så är du välkommen att kontakta oss på Svensk Brf!<br /><br />kontakt@svenskbrf.se', 'OK')", 1000);
        <?php endif; ?>
    });
</script>
