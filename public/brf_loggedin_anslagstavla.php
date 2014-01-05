<?php
echo "";
// message posted
switch ($sAction) {
    case 'write_msg':
        $sMessage = $_REQUEST['message'];
        if (trim($sMessage)) {

            $oMessage = getUser()->sendMessage($_REQUEST['message'], $_REQUEST['namn']);
            if (@$_REQUEST['attachPicture'] && @$_FILES['file'] && $_FILES['file']['error'] == UPLOAD_ERR_OK &&
                    in_array($_FILES['file']['type'], array('image/jpg', 'image/jpeg', 'image/gif', 'image/png'))
            ) {
                if (preg_match("/image\/([a-z]{3})/", str_replace("image/jpeg", "image/jpg", $_FILES['file']['type']), $aMatches) && count($aMatches) == 2) {
                    $oMessage->savePicture($_FILES['file']);
                }
            }
        }
        break;
}

if (@$_REQUEST['subview'] && ($_REQUEST['subview'] == 'skriv' || ($oMessage = SvenskBRF_Message::getMessageByLink($_REQUEST['subview'])))) {
    if ($_REQUEST['subview'] == 'skriv') {
        include 'brf_loggedin_anslagstavla_skriv.php';
    } else {
        include 'brf_loggedin_anslagstavla_las.php';
    }
} else {
$iMessageLength = 75;
?>
<img id="bla_skylt" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/anslagstavla.png" width="210" height="36" alt="anslagstavla" />
<p>Här kan du som medlem lägga upp meddelanden till alla medlemmar i din förening. Du kanske vill kommentera en händelse eller informera om något som kan vara av värde för dina grannar. Klicka på &quot;gör ett inlägg&quot; för att komma till en sida där du kan skriva och skicka ditt inlägg.</p>
<form style="margin-left: 20px;">
   <label>
       <a href="<?php echo BASE_DIR; ?><?php echo $oBrf->getUrl(); ?>/anslagstavla/skriv">
           <image width="100" height="29" alt="Gör ett inlägg" src="<?php echo BASE_DIR; ?>media/inloggad/img/gor_ett_inlagg.png" class="inlagg"/>
       </a>
    </label>
</form>
<div class="marginal_bottom"></div>
<?php $oMessages = getUser()->getMessages(FALSE); ?>
<?php foreach ($oMessages as $iMessageIndex => $oMessage): ?>
<h2><?php echo $oMessage->getSender()->getName(); ?><span class="datum"><?php echo substr($oMessage->getSendTime(), 0, 10); ?></span><?php if (!getUser()->isRead($oMessage)): ?> <span class="olast">(oläst)</span><?php endif; ?>
<?php if (getUser()->isBoardMember()): ?>
<span class="ta_bort_anslagstavla"><a href="javascript:void(0)" onclick="return removeMsg(this, <?php echo $oMessage->getId(); ?>);" style="font-size: 0.6em;">&nbsp;Ta bort inlägg</a></span>
<?php endif; ?>
</h2>
<ul>
    <li class="rubrik_kalender"><?php echo $oMessage->getHeader() ? $oMessage->getHeader() : 'Meddelande'; ?> <?php if ($oMessage->hasPicture() /* IMAGE */): ?>
        <a class="anslagstavla_läs" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/anslagstavla/' . $oMessage->getMessageLink(); ?>">
            <img src="<?php echo $oMessage->getImageData(); ?>" width="70" height="63" alt="thumb" class="thumb" style="height: auto; width: auto; max-height: 63px; max-width: 70px;" />
        </a>
        <?php endif; ?>
    </li>
    <li class="brodtext">
        <?php echo nl2br(substr($oMessage->getMessage(), 0, $iMessageLength)).'...'; ?>
        <a class="anslagstavla_las_mer" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/anslagstavla/' . $oMessage->getMessageLink(); ?>">Läs mer...</a>
    </li>
    <br />
    <?php if ($iMessageIndex + 1 < $oMessages->size()): ?>
    <ul class="mellanrum" style="margin-top: 30px;">
        <li></li>
    </ul>
    <?php endif; ?>
</ul>
<?php endforeach; ?>
<?php } ?>
<script type="text/javascript">
    function removeMsg(element, msg)
    {
        if (confirm('Är du säker på att meddelandet ska tas bort?')) {
            $.post("<?php echo BASE_DIR; ?>ajax.php", {action : 'removemsg', id : msg}, function (response) {
                if (response.result) {
                    // sidvisning sen? gå till rätt sida man var inne på
                    $(element).parent().parent().next().remove();
                    $(element).parent().parent().remove();
                }
            }, 'json');
        }
        return false;
    }
</script>
