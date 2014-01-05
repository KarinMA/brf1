<?php 
    if (@$_POST['submit_x'] && $_POST['submit_y']) {
        // save calendar day
        $oBrf->createCalendarDay($_REQUEST['date'], $_REQUEST['time'], $_REQUEST['endtime'], $_REQUEST['header'], $_REQUEST['text'], $_POST['isBoard'], (bool) @$_POST['smsReminder'], @$_POST['sms']);
    }
    $iIsBoard = 1;
    $sInstructionText = "Här skapar du kalenderdagar för styrelsens arbete. Välj vilken dag och månad det gäller genom att klicka på ett datum i kalendern. Skriv in rubrik, välj tiden på dagen och gör en kort beskrivning om vad som kommer att hända i fältet &quot;Om kalendardagen&quot;";
    $oCalendarEvents = $oBrf->getCalendarEvents(FALSE, (bool) $iIsBoard, FALSE);
    $sCalendarView = 'styrelsekalender';
    include './brf_loggedin_admin_kalender_include.php'; 
    $sContains = 'Kalendar / Styrelse';
    
?>
<script type="text/javascript">
    $("a.nav:contains('<?php echo $sContains; ?>'):eq(0)").css('font-style', 'oblique');
</script>