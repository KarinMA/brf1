<?php 

$oBrfRealtor = NULL;
if ($sSubView) {
    $oBrfRealtor = SvenskBRF_Brf::loadByUrl($sSubView);
    
    if (@$_POST['submit']) {
        getUser()->saveRealtorMessage($oBrfRealtor, $_POST['realtorLog']['header'], $_POST['realtorLog']['message'], (bool) @$_POST['sendToMembers']);
    }

    $iThisBrfIndex = NULL;
    foreach ($aBrfs as $iBrfIndex => $oRealtorBrf) {
        if ($oBrfRealtor->getId() == $oRealtorBrf->getId()) {
            $iThisBrfIndex = $iBrfIndex;
        }
    }
    if ($iThisBrfIndex !== NULL) {
        unset($aBrfs[$iThisBrfIndex]);
    }
    
    $bAdRemoved = FALSE;
    $bInternalMail = FALSE;
    switch ($sAction) {
        case 'savead':
            $oAd = $oBrfRealtor->createAd(
                getUser(),
                $_POST['adForm'],
                $_FILES['file']
            );
            if ($bInternalMail) {
                $oRealtorUser = getUser();
                $sLink = BASE_DIR . $oBrfRealtor->getUrl();
                $oSendMailCommand = Command::createCommand('sendmail', array(
                    'receivers' => array(-1),
                    'message' => trim("
Hej!

Nu finns en lägenhet till salu i din förening. Logga in på föreningens hemsida för att läsa mer!  

$sLink
    
OBS! Hjälp gärna din granne genom att tipsa vänner och bekanta om lägenheten och om fördelarna med att bo i just din förening!

Med vänliga hälsningar 

{$oRealtorUser->getName()}
    
{$oRealtorUser->getExternalPartner()->getPartnerName()}
{$oRealtorUser->getEmail()}
{$oRealtorUser->getCellphone()}
    
Om du i framtiden inte vill ta del av när en lägenhet i din förening är till salu så kan du gå in på din profil och klicka ur markeringen i rutan \"Visa meddelanden från föreningens mäklare\".
                    "),
                    'subject' => 'Nu är en lägenhet till salu i din förening',
                    '_brfId' => $oBrfRealtor->getId()
                ));
                $oSendMailCommand->execute($aResultData);
            } else {
                SvenskBRF_Notice::sendRealtorAdMail($oBrfRealtor, $oAd);
            }
            $sJsAction = 'showMessage("Annonsen är publicerad. Ett meddelande skickas nu ut till samtliga medlemmar. <a href=\"' .  BASE_DIR . $oBrfRealtor->getUrl() . '\" target=\"_blank\">Visa annons.</a>.", "OK");';
            break;
        case 'removead':
            $bAdRemoved = TRUE;
            $oAdsToRemove = getUser()->getAdvertisements($oBrfRealtor);
            $oAdsToRemove->current()->delete();
            break;
        case 'soldad':
            $bAdRemoved = TRUE;
            $oRealtorUser = getUser();
            $oAdSold = $oRealtorUser->getAdvertisements($oBrfRealtor)->current();
            $oAdSold->setSold(TRUE);
            if ($bInternalMail) {
                $sLink = BASE_DIR . $oBrfRealtor->getUrl();
                $oSendMailCommand = Command::createCommand('sendmail', array(
                    'receivers' => array(-1),
                    'message' => trim("
Hej!

Nu har en lägenhet i din förening sålts och du kommer inom kort att få en ny granne!

Logga in på föreningens hemsida för att läsa mer!

$sLink
    
Om du själv går i säljtankar eller undrar vad just din lägenhet är värd är du varmt välkommen att höra av dig. 

Med vänliga hälningar

{$oRealtorUser->getName()}
    
{$oRealtorUser->getExternalPartner()->getPartnerName()}
{$oRealtorUser->getEmail()}
{$oRealtorUser->getCellphone()}
    
Om du i framtiden inte vill ta del av när en lägenhet i din förening är till salu så kan du gå in på din profil och klicka ur markeringen i rutan \"Visa meddelanden från föreningens mäklare\".
                    "),
                    'subject' => 'Nu har en lägenhet sålts i din förening!',
                    '_brfId' => $oBrfRealtor->getId()
                ));
                $oSendMailCommand->execute($aResultData);
            } else {
                SvenskBRF_Notice::sendRealtorAdSoldMail($oBrfRealtor, $oAdSold);
            }
            break;
    } 
}

?>
<?php if ($oBrfRealtor): ?>
<?php echo getHeaderPicture("Mäklare", $oBrfRealtor->getName(), 'bla_skylt', 0, 200); ?>
<?php else: ?>
<img width="210" height="36" alt="dokument" src="<?php echo BASE_DIR; ?>media/inloggad/img/maklare.png" id="bla_skylt">
<?php endif; ?>
<img width="150" height="43" src="<?php echo getUser()->getExternalPartner()->getImageData(); ?>" class="maklar_logga" style="border: none; float: right;     margin-right: 20px;     margin-top: 20px;"/>
<div id="content_maklare">
    <div id="kol1_maklare">
        <!--src11="<?php echo BASE_DIR; ?>media/inloggad/img/stor_bild.jpg"-->
        <img width="157" height="236" id="portratt" src="<?php echo getUser()->getImageData(); ?>"/>
        <p class="maklar_sidan">
            <strong><?php echo getUser()->getName(); ?></strong>
            <br />
            Tel: <?php echo getUser()->getCellphone(); ?><br />
            Mail: <?php echo getUser()->getEmail(); ?>
        </p> 
        
    </div>

    <div id="kol2_maklare" style="margin-top: -30px;">
        <p>&nbsp;</p>
        <?php if (($oBrfRealtor && ($oRealtorLog = $oBrfRealtor->getLatestRealtorMessage())) && @$_REQUEST['parameter'] != 'redigera'): ?>
        <h3><?php echo $oRealtorLog->getHeader(); ?></h3>
        <?php echo nl2br($oRealtorLog->getRealtorMessage()); ?>
        <br />
        <br />
        <a href="<?php echo BASE_DIR . 'maklare/profil/' . $oBrfRealtor->getUrl() . '/redigera'; ?>"><?php echo 'Ändra'; ?> meddelande till föreningen</a>
        <br />
        <br />
        <a href="<?php echo BASE_DIR . $oBrfRealtor->getUrl(); ?>" target="_blank">Gå till föreningens hemsida</a>
        <?php if (TRUE): ?>
        <br />
        <br />
        <?php if (!getUser()->getAdvertisements($oBrfRealtor)->size() || $bAdRemoved): ?>
        <a href="<?php echo BASE_DIR . $oBrf->getUrl() . '/annons/' . $oBrfRealtor->getUrl(); ?>">Lägg upp objekt till salu</a>
        <?php else: ?>
        <a href="<?php echo BASE_DIR . $oBrf->getUrl() . '/annons/' . $oBrfRealtor->getUrl(); ?>">Ändra annons</a>
        <?php endif; ?>
        <?php endif; ?>
        <p>&nbsp;</p>
        <?php elseif ($oBrfRealtor && @$_REQUEST['parameter'] == 'redigera'): ?>
        <form method="post" action="<?php echo BASE_DIR . 'maklare/profil/' . $oBrfRealtor->getUrl(); ?>">
            <p class="rubrik_form">Rubrik:</p>
            <input type="text" class="form_bredd" name="realtorLog[header]" value="<?php echo $oRealtorLog ? $oRealtorLog->getHeader() : ''; ?>"/>
            <p class="rubrik_form">Meddelande:</p>
            <textarea rows="6" cols="30" name="realtorLog[message]"><?php echo $oRealtorLog ? $oRealtorLog->getRealtorMessage() : ''; ?></textarea>
            <input type="hidden" name="submit" value="1"/>
            <input type="hidden" value="0" name="sendToMembers"/>
            <br />
            <br />
            <input type="checkbox" name="sendToMembers" id="sendToMembers" value="1" style="float: left;"/>
            <label for="sendToMembers" style="margin-left: 3px;">Klicka i rutan för att även skicka detta meddelande till medlemmarna</label>
            <br />
            <br />
            <input style="border:none;" type="image" src="<?php echo BASE_DIR; ?>media/inloggad/img/spara.png"/>
        </form>
        <br />
        <?php else: ?>
        <?php if ($oBrfRealtor && @$_REQUEST['parameter'] != 'redigera'): ?>
        <a href="<?php echo BASE_DIR . 'maklare/profil/' . $oBrfRealtor->getUrl() . '/redigera'; ?>"><?php echo 'Skriv'; ?> meddelande till föreningen <?php echo $oBrfRealtor->getName(); ?></a>
        <br />
        <br />
        <a href="<?php echo BASE_DIR . $oBrfRealtor->getUrl(); ?>" target="_blank">Gå till föreningens hemsida</a>
        <br />
        <br />
        <?php if (!getUser()->getAdvertisements($oBrfRealtor)->size() || $bAdRemoved): ?>
        <a href="<?php echo BASE_DIR . $oBrf->getUrl() . '/annons/' . $oBrfRealtor->getUrl(); ?>">Lägg upp objekt till salu</a>
        <?php else: ?>
        <a href="<?php echo BASE_DIR . $oBrf->getUrl() . '/annons/' . $oBrfRealtor->getUrl(); ?>">Ändra annons</a>
        <?php endif; ?>
        <?php endif; ?>
        <h3><?php echo getUser()->getName(); ?></h3>
        <?php endif; ?>
        <?php echo nl2br(getUser()->getPresentation()); ?>
        <?php $aRealtorBrfs = array(); ?>
        <?php if (count($aBrfs) && $oBrfRealtor): ?>
        <?php 
            foreach ($aBrfs as $oRealtorBrf) {
                if ($oBrfRealtor->getBrfViewSetting($oRealtorBrf->getId())) {
                    $aRealtorBrfs[] = $oRealtorBrf->getId();
                }
            }
        ?>
        <?php endif; ?>
    </div>
    <?php if (count($aBrfs) || !$oBrfRealtor): ?>
    <div id="kol3" style="width:519px; clear:both; margin-left:20px; margin-right:20px; padding-top:20px;">
        <p style="margin-left: 1px; font-size: 2.0em; padding-bottom: 5px; margin-bottom: 3px; font-weight: 100; border-bottom: 1px solid #000;">Föreningar jag ansvarar för</p>
        <?php if (!$oBrfRealtor): ?>
        <!--<p style="margin-left: 1px;">Klicka på en förening nedan för att skriva ett nytt/ändra meddelande till den specifika föreningen.</p>-->
        <?php else: ?>
        <p style="margin-left: 1px;">Klicka i boxarna för de föreningar du önskar visa för medlemmarna i <?php echo $oBrfRealtor->getName(); ?>.</p>
        <?php endif; ?>
        <div style="width: 220px; float:left; margin-left:0px;">
            <?php foreach (($oBrfRealtor ? $aBrfs : $aBrfs) as $iBrfIndex => $oRealtorBrf): if ($iBrfIndex % 2 == 0): ?>
            <?php if (!$oBrfRealtor): ?>
            
            <!--<a href="<?php echo BASE_DIR . 'maklare/profil/' . $oRealtorBrf->getUrl(); ?>"><?php echo $oRealtorBrf->getName(); ?></a>-->
            <a href="<?php echo BASE_DIR . $oRealtorBrf->getUrl(); ?>" target="_blank"><?php echo $oRealtorBrf->getName(); ?></a>
            <?php else: ?>
            <input type="hidden" name="brfs[<?php echo $oRealtorBrf->getUrl(); ?>]" value="0"/> 
            <input type="checkbox" class="activateDisplay" name="brfs[<?php echo $oRealtorBrf->getUrl(); ?>]" value="<?php echo $oRealtorBrf->getId(); ?>" id="<?php echo $oRealtorBrf->getUrl(); ?>_label"
            <?php if (in_array($oRealtorBrf->getId(), $aRealtorBrfs)): ?>checked="checked"<?php endif; ?>/>
            &nbsp;<label for="<?php echo $oRealtorBrf->getUrl(); ?>_label"><?php echo $oRealtorBrf->getName(); ?></label>
            <?php endif; ?>
            <br />
            <?php endif; endforeach; ?>
        </div>
        <div style="width: 220px; float:right;">
            <?php foreach (($oBrfRealtor ? $aBrfs : $aBrfs) as $iBrfIndex => $oRealtorBrf): if ($iBrfIndex % 2 == 1): ?>
            <?php if (!$oBrfRealtor): ?>
            <!--<a href="<?php echo BASE_DIR . 'maklare/profil/' . $oRealtorBrf->getUrl(); ?>"><?php echo $oRealtorBrf->getName(); ?></a>-->
            <a href="<?php echo BASE_DIR . $oRealtorBrf->getUrl(); ?>" target="_blank"><?php echo $oRealtorBrf->getName(); ?></a>
            <?php else: ?>
            <input type="hidden" name="brfs[<?php echo $oRealtorBrf->getUrl(); ?>]" value="0"/> 
            <input type="checkbox" class="activateDisplay" name="brfs[<?php echo $oRealtorBrf->getUrl(); ?>]" value="<?php echo $oRealtorBrf->getId(); ?>" id="<?php echo $oRealtorBrf->getUrl(); ?>_label"
            <?php if (in_array($oRealtorBrf->getId(), $aRealtorBrfs)): ?>checked="checked"<?php endif; ?>/>
            &nbsp;<label for="<?php echo $oRealtorBrf->getUrl(); ?>_label"><?php echo $oRealtorBrf->getName(); ?></label>
            <?php endif; ?>
            <br />
            <?php endif; endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<script type="text/javascript">
    <?php if ($oBrfRealtor): ?>
    initMenu($("#foreningar_menu"));
    var _foundBrf = false;
    $("#foreningar_menu a.nav").each(function() {
        if (!_foundBrf && $(this).text() == '<?php echo $oBrfRealtor->getName(); ?>') {
            $(this).css('font-style', 'oblique');
            _foundBrf = true;
        }
    });
    <?php endif; ?>
    <?php if ($oBrfRealtor): ?>
    $("input.activateDisplay").click(function() {
        $.post("<?php echo BASE_DIR; ?>ajax.php", {action : 'activaterealtordisplay', brfId : <?php echo $oBrfRealtor->getId(); ?>, url : $(this).prop('id').replace('_label', ''), display : $(this).is(':checked') ? $(this).val() : 0}, function (response) {
            if (response.result) {
                //
            }
        });
    });
    <?php endif; ?>
</script>
<script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/messi.min.js"></script>
<link href="<?php echo BASE_DIR; ;?>media/js/messi.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
/**
 * @param {type} message
 * @param {type} buttonText
 * @returns {undefined}
 */
function showMessage(message, buttonText) {
    new Messi(
        message,
        {   
            title: 'Svensk Brf', 
            buttons: [{id: 0, label: buttonText, val: 'X'}]
            ,center : true
        }
    );
}
</script>