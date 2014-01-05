<?php
    include './brf_loggedin_kalender.php'; 
    // inactive...
    $oCalendarEvents = getBrf()->getCalendarEvents(FALSE, TRUE);
    $sLinkPrepend = 'styrelse';
    $sCalendarText = "I kalendern nedan visas styrelsens kommande aktiviteter. Under styrelseadmin kan in lägga till en ny aktivitet.";
?>
<img id="bla_skylt" src="<?php echo BASE_DIR; ?>media/inloggad/img/kalender_styrelse.png" width="210" height="36" alt="kalender" />
<?php include './brf_loggedin_kalender_include.php'; ?>