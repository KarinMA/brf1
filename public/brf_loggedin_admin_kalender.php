<?php 
    if (@$_POST['submit_x'] && $_POST['submit_y']) {
        // save calendar day
        $oBrf->createCalendarDay($_REQUEST['date'], $_REQUEST['time'], $_REQUEST['endtime'], $_REQUEST['header'], $_REQUEST['text'], $_POST['isBoard'], (bool) @$_POST['smsReminder'], @$_POST['sms']);
    }
    $iIsBoard = 0;
    $sInstructionText = "Här skapar du nya kalenderdagar. Välj vilken dag och månad det gäller genom att klicka på ett datum i kalendern. Skriv in rubrik, välj tiden på dagen och gör en kort beskrivning om vad som kommer att hända i fältet &quot;Om kalendardagen&quot;";
    $oCalendarEvents = getBrf()->getCalendarEvents(FALSE, (bool) $iIsBoard, FALSE);
    $sCalendarView = 'kalender';
    include './brf_loggedin_admin_kalender_include.php'; 
    $sContains = 'Kalender / Medlemmar';
    
?>
<script type="text/javascript">
    $("a.nav:contains('<?php echo $sContains; ?>'):eq(1)").css('font-style', 'oblique');
</script>