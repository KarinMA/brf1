<?php
    $aStreetData = getStreetData($oBrf);
    $sImage = BASE_DIR . 'media/inloggad/img/forening_bild.png';
    if (array_key_exists("image_url", $aStreetData)) {
        $sImage = $aStreetData['image_url'];
    }
?>
<img class="forening_bild" src="<?php echo $sImage; ?>" width="515" height="240"/>
<img id="bla_skylt" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/senaste_nytt.png" width="210" height="36" alt="senaste nytt" style="margin-top: 10px;"/>
<p>Här får du en översikt över din förening och din egen sida hos Svensk Brf. De senaste nyheterna visas i mittenfältet. I högerkolumnen syns dina bokningar, kalendern och föreningens anslagstavla. Marknadskollen, som finns med på alla sidor, ger dig aktuell information från Dagens Industri.</p>
<?php 
    $oLatestCalendarEvent = $oBrf->getNewestCalendarEvent(getUser()->isBoardMember()); 
?>
<?php if ($oLatestCalendarEvent): ?>
<h2 style="margin-left:15px;">Kalender<span style="margin-left:10px;"><?php echo getDaySlashMonth($oLatestCalendarEvent->getWhen()); ?></span></h2>
<p><a href="<?php echo BASE_DIR . $oBrf->getUrl() . '/'; ?><?php if ($oLatestCalendarEvent->getIsBoard()): ?>styrelse<?php endif; ?>kalender/#<?php echo $oLatestCalendarEvent->getId(); ?>"><?php echo $oLatestCalendarEvent->getText() ? nl2br($oLatestCalendarEvent->getText()) : $oLatestCalendarEvent->getHeader(); ?></a></p>
<?php endif; ?>
<?php
    $oLatestMessageBoardEntry = $oBrf->getLatestMessageBoardEntry(); 
?>
<?php if ($oLatestMessageBoardEntry): ?>
<h2 style="margin-left:15px;">Anslagstavla<span style="margin-left:10px;"><?php echo getDaySlashMonth($oLatestMessageBoardEntry->getSendTime()); ?></span></h2>
<p><a href="<?php echo BASE_DIR . $oBrf->getUrl() . '/anslagstavla/' . $oLatestMessageBoardEntry->getMessageLink(); ?>"><?php echo $oLatestMessageBoardEntry->getHeader(); ?></a></p>
<?php endif; ?>
<script type="text/javascript">
    $("a.nav:contains('Hem'):eq(0)").css('font-style', 'oblique');
</script>