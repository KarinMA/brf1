<img id="bla_skylt" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/anslagstavla.png" width="210" height="36" alt="anslagstavla" />
<?php
getUser()->readMessage($oMessage);
?>
<?php if ($oMessage->getHasPicture()): ?>
<br />
<br />
<img class="mittenbild" src="<?php echo $oMessage->getImageData(); ?>" alt="bild" style="height: auto; width: auto; max-height: 426px; max-width: 515px;"/>
<?php endif; ?>

<h2><?php echo $oMessage->getHeader() ? $oMessage->getHeader() : 'Meddelande'; ?></h2>
<ul>
    <li class="rubrik_kalender"><?php echo $oMessage->getSender()->getName(); ?> (<?php echo substr($oMessage->getSendTime(), 0, 10); ?>)</li>
    <li class="brodtext">
        <?php echo nl2br($oMessage->getMessage()); ?>
    </li>
</ul>

<br />
<p class="tillbaka"><a href="<?php echo BASE_DIR; ?><?php echo $oBrf->getUrl(); ?>/anslagstavla">&lt; Tillbaka</a></p>

