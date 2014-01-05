<?php
    $oCalendarEvents = getBrf()->getCalendarEvents(FALSE, getUser()->isBoardMember(), TRUE);
    $sLinkPrepend = '';
    $sCalendarText = "I kalendern nedan visas händelser som är inlagda av styrelsen i din förening. Det kan röra sig om städdagar, möten mm.  Under kalendern syns en sammanställning över kommande händelser i föreningen.";
?>
<img id="bla_skylt" src="<?php echo BASE_DIR; ?>media/inloggad/img/kalender2.png" width="210" height="36" alt="kalender" />
<?php include './brf_loggedin_kalender_include.php'; ?>