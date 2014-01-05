<?php

    $oEmails = getUser()->getSentEmails();
    $iNumberOfEmails = $oEmails->size(); 
    $iMessageLength = 10; // display this much
    
?>
<img id="bla_skylt" src="<?php echo BASE_DIR; ?>media/inloggad/img/skickat.png" width="210" height="36" alt="dokument" />
<?php if (getUser()->getUserType() == SvenskBRF_User::USER_TYPE_REALTOR): ?>
<p>Här finns de meddelanden som du skickat till medlemmar i de föreningar du har hos Svensk Brf.</p>
<?php else: ?>
<p>Här finns de meddelanden som du skickat till styrelsen eller andra föreningsmedlemmar.</p>
<?php endif; ?>

<?php foreach ($oEmails as $iEmailIndex => $oEmail): ?>
<?php
    $bShowWholeMessage = strlen($oEmail->getMessage()) < $iMessageLength - 3;
    $sReceiverBrf = "";
    $aReceiverNames = array();
    foreach ($oEmail->getMailReceiverCollection() as $oMailReceiver) {
        $oReceiverUser = SvenskBRF_User::loadById($oMailReceiver->getToUserId());
        $aReceiverNames[] = $oReceiverUser->getName();
        if (!$sReceiverBrf) {
            $sReceiverBrf = " <a href=\"".BASE_DIR . $oReceiverUser->getBrf()->getUrl() . "\">". $oReceiverUser->getBrf()->getName() . "</a><br /><span class=\"datum\" style=\"margin-left:0px;\">";
        }
    }
    if (!$sReceiverBrf) {
        $sReceiverBrf = "<span class=\"datum\">";
    }
?>
<div class="meddelande">
    <h2><?php echo implode(', ', $aReceiverNames); ?><?php echo $sReceiverBrf; ?><?php echo $oEmail->getSentOn(); ?></span></h2>
    <ul>
        <li class="rubrik_kalender"><?php echo $oEmail->getHeader(); ?></li>
        <li class="brodtext"><span class="messageContent"><?php echo nl2br(!$bShowWholeMessage ? (substr($oEmail->getMessage(), 0, $iMessageLength - 3) . '...') : $oEmail->getMessage()); ?></span>
            <?php if (!$bShowWholeMessage): ?>
            <br />
            <br />
            <a class="anslagstavla_las readMail" href="javascript:void(0)" onclick="$(this).parent().find('.messageContent').html('<?php echo str_replace("\n", "", nl2br($oEmail->getMessage())); ?>'); $(this).remove(); return false;">Läs<?php if (!$bShowWholeMessage): ?> mer<?php endif; ?>...</a>    
            
            
            <?php endif; ?>
            <ul class="utkorg3">
                <li class="utkorg">
                    <form action="<?php echo BASE_DIR; ?><?php echo $oBrf->getUrl(); ?>/meddelanden/skicka" method="post" class="utkorg1"/>
                        <input type="hidden" name="readid" value="<?php echo $oEmail->getId(); ?>"/>
                        <input type="hidden" name="action" value="mailreplysent"/>
                        <input type="image" name="mailreplyall" src="<?php echo BASE_DIR; ?>media/inloggad/img/svara.png" style="width:60px; height:15px;" alt="Svara" />
                    </form>
                </li>
            </ul>
        </li>
    </ul>
    <?php if ($iEmailIndex < $iNumberOfEmails - 1): ?>
    <ul class="mellanrum3">
        <li></li>
    </ul>
<?php endif; ?>
</div>

<?php endforeach; ?>
<script type="text/javascript">
    <?php if (getUser()->getUserType() == SvenskBRF_User::USER_TYPE_REALTOR): ?>
    $("a.nav:contains('Besvarade')").css('font-style', 'oblique');
    <?php else: ?>
    $("a.nav:contains('Skickat')").css('font-style', 'oblique');    
    <?php endif; ?>
</script>
