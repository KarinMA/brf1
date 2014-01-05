<?php foreach ($oEmails as $iEmailIndex => $oEmail): ?>
<?php if (!$oEmail->getMail()) $oEmail->setMail(getBrfMailAccessor()->getById($oEmail->getMailId())); ?>
<?php
    $bShowWholeMessage = strlen($oEmail->getMail()->getMessage()) < $iMessageLength - 3;
?>
<div class="meddelande">
    <h2><?php echo $oEmail->getMail()->getFromUser()->getName(); ?>
    <?php if (getUser()->getUserType() == SvenskBRF_User::USER_TYPE_REALTOR): ?>
    <a target="_blank" href="<?php echo BASE_DIR . $oEmail->getMail()->getFromUser()->getBrf()->getUrl(); ?>"><?php echo $oEmail->getMail()->getFromUser()->getBrf()->getName(); ?></a>
    <br />
    <span class="datum" style="margin-left: 0px;">
    <?php else: ?>
    <span class="datum">
    <?php endif; ?>
    <?php echo $oEmail->getMail()->getSentOn(); ?></span><?php if (!$oEmail->getIsRead()): ?> <span class="olast" id="olast_<?php echo $oEmail->getId(); ?>">(oläst)</span><?php endif; ?></h2>
    <ul>
        <li class="rubrik_kalender">
            <?php echo $oEmail->getMail()->getHeader(); ?></span>
        </li>
        <li class="brodtext">
            <span><?php echo nl2br(!$bShowWholeMessage ? (substr($oEmail->getMail()->getMessage(), 0, $iMessageLength - 3) . '...') : $oEmail->getMail()->getMessage()); ?> 
            <?php if (!$oEmail->getIsRead() || !$bShowWholeMessage): ?>
            <br /><br /><a class="anslagstavla_las readMail" href="javascript:void(0)" onclick="loadMail(this, <?php echo $oEmail->getMailId(); ?>); readMail(<?php echo $oEmail->getId(); ?>); return false;">Läs<?php if (!$bShowWholeMessage): ?> mer<?php endif; ?>...</a>
            </span>
            <?php endif; ?>
        </li>
        <ul class="utkorg3">
            <li class="utkorg">
                <form action="<?php echo BASE_DIR; ?><?php echo $oBrf->getUrl(); ?>/meddelanden/skicka" method="post" class="utkorg1"/>
                    <input type="hidden" name="readid" value="<?php echo $oEmail->getId(); ?>"/>
                    <input type="hidden" name="sender" value="<?php echo $oEmail->getMail()->getFromUser()->getId(); ?>"/>
                    <input type="hidden" name="action" value="mailreply"/>
                    <input type="image" name="mailreply" src="<?php echo BASE_DIR; ?>media/inloggad/img/svara.png" width="60" height="15" alt="Svara" />
                </form>
            </li>
            <li class="utkorg">
                <form action="<?php echo BASE_DIR; ?><?php echo $oBrf->getUrl(); ?>/meddelanden/skicka" method="post" class="utkorg1"/>
                    <input type="hidden" name="readid" value="<?php echo $oEmail->getId(); ?>"/>
                    <input type="hidden" name="sender" value="<?php echo $oEmail->getMail()->getFromUser()->getId(); ?>"/>
                    <input type="hidden" name="action" value="mailreplyall"/>
                    <input type="image" name="mailreplyall" src="<?php echo BASE_DIR; ?>media/inloggad/img/svara_alla.png" width="89" height="15" alt="Svara alla" />
                </form>
            </li>
            <li class="utkorg">
                <form action="<?php echo BASE_DIR; ?><?php echo $oBrf->getUrl(); ?>/meddelanden/skicka" method="post" class="utkorg1"/>
                    <input type="hidden" name="readid" value="<?php echo $oEmail->getId(); ?>"/>
                    <input type="hidden" name="sender" value="<?php echo $oEmail->getMail()->getFromUser()->getId(); ?>"/>
                    <input type="hidden" name="action" value="mailforward"/>
                    <input type="image" name="mailreplyall" src="<?php echo BASE_DIR; ?>media/inloggad/img/vidarebefordra.png" width="112" height="15" alt="Vidarebefordra" />
                </form>
            </li>
            <li class="utkorg">
                <form action="" method="post" class="utkorg2 utkorg1"/>
                    <input type="hidden" name="readid" value="<?php echo $oEmail->getId(); ?>"/>
                    <input type="hidden" name="action" value="mailremove"/>
                    <input class="utkorg2" type="image" name="mailremove" src="<?php echo BASE_DIR; ?>media/inloggad/img/ta_bort.png" width="61" height="15" alt="Ta bort" />
                </form>
            </li>
        </ul>
    </ul>
    <?php if ($iEmailIndex < $oEmails->size() - 1): ?>
    <br />
    <div class="mellanrum3"></div>
<?php endif; ?>
</div>
<?php endforeach; ?>

<?php if (FALSE && $iNumberOfEmails > $iOffset): ?>

<div id="Foregaende_nasta">
   <p>
       <span class="foregaende">
           <a href="javscript:void(0);" class="internalNavigation">
               <?php if ($iOffset > 0): ?>
               <img width="100" height="17" alt="Föregående" src="<?php echo BASE_DIR; ?>media/inloggad/img/foregaende.png"/>
               <?php else: ?>
               <span style="width:100px;">&nbsp;</span>
               <?php endif; ?>
           </a>
       </span>
       Sida <?php echo $iPage; ?>/<?php echo ((int) ($iNumberOfEmails/$iLimit)) + 1; ?>
       <?php if ($iNumberOfEmails > $iOffset + 10): ?>
       <span class="nasta">
           <a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/meddelanden/inkorg/<?php echo $iPage+1; ?>" class="internalNavigation">
               <img width="100" height="17" alt="Nästa" src="<?php echo BASE_DIR; ?>media/inloggad/img/nasta.png"/>
           </a>
       </span>
       <?php endif; ?>
   </p>
</div>

<?php endif; ?>
