<script type="text/javascript">
    function removeCalendar(calendar) {
        if (confirm('Är du säker på att du vill ta bort kalenderdagen?')) {
            $.post("<?php echo BASE_DIR; ?>ajax.php", {action : 'removecalendar', 'calendar' : calendar}, function (response) {
                if (response.result) {
                    //console.log(calendar);
                    document.location.reload();
                }
            }, 'json');
        }
        return false;
    }
</script>
<?php 
$sSubView = $sAdminParameter;
// get month to display
$iCalendarMonth = date('n');
$sCalendarMonth = getMonth($iCalendarMonth);
$iCalendarYear = date('Y');
$bBackLink = FALSE;
if (preg_match("/([A-Z][a-z]+)-([0-9]+)/", $sSubView, $aMatches)) {
    // can't go backwards
    if ($iCalendarYear <= $aMatches[2] && ($iCalendarYear < $aMatches[2] || $iCalendarMonth <= getMonthReverse($aMatches[1]))) {
        $bBackLink = $iCalendarYear < $aMatches[2] || getMonthReverse($aMatches[1]) > $iCalendarMonth;
        $sCalendarMonth = $aMatches[1];
        $iCalendarYear = $aMatches[2];
        $iCalendarMonth = getMonthReverse($sCalendarMonth);
    }
} 
?>
<img id="bla_skylt" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/styrelseadmin.png" width="210" height="36" alt="administration" />
<p><?php echo $sInstructionText; ?></p>
<link rel="stylesheet" href="<?php echo BASE_DIR; ?>media/css/jquery-ui-1.10.3.custom.min.css" />
<style type="text/css">
    .ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
    .ui-timepicker-div dl { text-align: left; }
    .ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
    .ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
    .ui-timepicker-div td { font-size: 90%; }
    .ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

    .ui-timepicker-rtl{ direction: rtl; }
    .ui-timepicker-rtl dl { text-align: right; }
    .ui-timepicker-rtl dl dd { margin: 0 65px 10px 10px; }
</style>
<style type="text/css">
    .ui-datepicker-current { display: none; }
</style>
<div id="kalender_top">
    <a href="<?php 
        if ($bBackLink) {
            echo BASE_DIR . $oBrf->getUrl() . '/admin/kalender'; ?>/<?php echo ($iCalendarMonth == 1 ? getMonth(12) : getMonth($iCalendarMonth - 1)) . '-' . ($iCalendarMonth > 1 ? $iCalendarYear : ($iCalendarYear - 1)); 
        } else {
            echo "javascript:void(0)";
        }
    ?>">
        <img src="<?php echo BASE_DIR; ?>media/inloggad/img/pil-vanster.png" width="19" height="30" alt="pil" class="pil_vanster" /></a>
    <a href="<?php echo BASE_DIR . $oBrf->getUrl() . '/admin/kalender'; ?>/<?php echo ($iCalendarMonth == 12 ? getMonth(1) : getMonth($iCalendarMonth + 1)) . '-' . ($iCalendarMonth == 12 ? $iCalendarYear + 1 : $iCalendarYear); ?>">
        <img src="<?php echo BASE_DIR; ?>media/inloggad/img/pil-hoger.png" width="18" height="30" alt="pil" class="pil_hoger" /></a>
    <div id="vecka_center">
        <div id="vecka">
            <h4>
                <a href="#" onclick="javascript:void(0)"><?php echo $sCalendarMonth; ?></a>
            </h4>
        </div>
    </div>
</div>
<style type="text/css">
    table#kalender td {
        cursor: pointer;
    }
    li {
        list-style-type: none;
    }
</style>
<table id="kalender">
    <?php $iCalendarCount = 1; ?>
    <?php foreach (array(1, 8, 15, 22) as $iWeekStart): ?>
    <tr>
        <?php for ($iAdd = 0; $iAdd <= 6; $iAdd++): ?>
        <?php 
            if ($oCalendarEvents->valid() && isCalendarDay($oCalendarEvents->current(), $iCalendarYear, $iCalendarMonth, $iAdd + $iWeekStart)): 
                $oCalendarEvents->next();
        ?>
        <td class="color kalender" onclick="gotoCalendar(<?php echo $iCalendarCount++; ?>);" style="cursor:pointer; background-color: #f6aa6a;"><?php echo $iAdd + $iWeekStart; ?></td>
        <?php else: ?>
        <td class="kalender"><?php echo $iAdd + $iWeekStart; ?></td>
        <?php endif; ?>
        <?php endfor; ?>
    </tr>
    <?php endforeach; ?>
   
    <?php if (getMonthLength($iCalendarYear, $iCalendarMonth)): ?>
    <tr>
        <?php for ($iDay = 29; $iDay <= getMonthLength($iCalendarYear, $iCalendarMonth); $iDay++): ?>
        <td class="<?php 
            $bClickable = FALSE;
            if ($oCalendarEvents->valid() && isCalendarDay($oCalendarEvents->current(), $iCalendarYear, $iCalendarMonth, $iDay)) { 
                $oCalendarEvents->next(); 
                echo "color kalender";
                $bClickable = TRUE;
            }  else {
                echo "kalender";
            }
        ?>"<?php if ($bClickable): ?> style="background-color: #f6aa6a; cursor:pointer;" onclick111="gotoCalendar(<?php echo ''; ?>);" style="cursor:pointer;"<?php endif; ?>><?php echo $iDay; ?></td>
        <?php endfor; ?>
    </tr>
    <?php endif ;?>
</table>

<?php $iCalendarCount = 1; $oCalendarEvents->rewind(); foreach ($oCalendarEvents as $oCalendarEvent): ?>
<h2 id="<?php echo $iCalendarCount++; ?>"><?php echo getMonth(date('n', strtotime($oCalendarEvent->getWhen()))); ?></h2>
<ul>
    <li class="rubrik_kalender"><?php echo $oCalendarEvent->getHeader(); ?> <span class="datum"><?php echo substr($oCalendarEvent->getWhen(), 0, 16); if ($oCalendarEvent->getEnds()) echo " - ".substr($oCalendarEvent->getEnds(), 10,6); ?></span><span style="float: right; margin-right: 15px;"><a href="javascript:void(0)" onclick="return removeCalendar(<?php echo $oCalendarEvent->getId(); ?>);" style="font-size: 0.8em;">Ta bort</a></span></li>
    <li style="text-align: left; list-style-type: none;"><?php echo nl2br($oCalendarEvent->getText()); ?></li>
</ul>
<?php endforeach; ?>

<br />
<h2>Ny kalendardag</h2>
<form method="post" action="" id="calendarForm">
    <ul>
        <li class="rubrik_kalender">
            Rubrik<br />
            <input name="header" id="calendarHeader" type="text"/>
        </li>
        <li style="text-align: left;">
            Datum (välj ovan)<br />
            <input type="text" name="date" id="date1" disabled="disabled"/>
        </li>
        <li style="text-align: left;">
            Börjar<br />
            <input type="text" name="time" id="time"/>
        </li>
        <li style="text-align: left;">
            Slutar<br />
            <input type="text" name="endtime" id="time2"/>
        </li>
        <?php if ($oBrf->getSetting(SvenskBRF_Brf::BRF_SETTING_ID_SMS_CALENDAR)): ?>
        <li style="text-align:left;">
            <input type="hidden" name="smsReminder" value="0"/><input type="checkbox" name="smsReminder" id="smsReminder" value="1"/>&nbsp;<label for="smsReminder">SMS-påminnelse?</label>
        </li>
        <?php endif; ?>
        <li style="text-align: left;">
            <label for="text">Om kalendardagen</label><br/>
            <textarea id="text" name="text" rows="6" cols="35"></textarea>
        </li>
        <?php if ($oBrf->getSetting(SvenskBRF_Brf::BRF_SETTING_ID_SMS_CALENDAR)): ?>
        <li style="text-align: left; display:none;" class="smsText">
            <label for="text">Text för SMS-påminnelse (Skickas till samtliga medlemmar)<br />
                <i style="font-size: 10px;">Påminnelse-SMS skickas en timma innan.</i>
            </label>
            <br/>
            <textarea id="sms" name="sms" rows="6" cols="35"></textarea>
        </li>
        <?php endif; ?>
        
        <li style="text-align: left;">
            <input id="submitButton" type="image" name="submit" src="<?php echo BASE_DIR; ?>media/inloggad/img/spara.png" style="width:78px;height:28px;border:0;"/>
        </li>
    </ul>
    <input type="hidden" name="isBoard" value="<?php echo $iIsBoard; ?>"/>
</form>

<script type="text/javascript">
    function gotoCalendar(day)
    {
        var loc = new String(document.location.href);
        if (loc.indexOf("#") > -1)
        {
            loc = loc.substring(0, loc.indexOf("#"));
        }
        loc +="#" + day;
        document.location.href = loc;
    }
    
    $("#kalender td").click(function(){
        $("#date1").val('<?php echo $iCalendarYear . '-' . getFormatedMonth($iCalendarMonth) . '-'; ?>' + ($(this).text().length == 2 ? $(this).text() : "0" + $(this).text())); 
        $(".chosenDate").removeClass('color').removeAttr('style');
        $(this).addClass('color').addClass('chosenDate').prop('style', 'background-color: #f6aa6a;');
        <?php
            $sLinkAdd = $sSubView;
            
            if ($sLinkAdd) {
                $sLinkAdd = '/' . $sLinkAdd;
            }
        ?>
        
        document.location.href = '<?php echo BASE_DIR . $oBrf->getUrl(); ?>/admin/<?php echo $sCalendarView . $sLinkAdd; ?>#calendarForm';
    });
    
    $(document).ready(function(){
        
        $("#submitButton").click(function(){
            $("#calendarForm > input").css('background-color', '');
            // validate
            var valid = true;
            if ($("#date1").val().length == 0) {
                $("#date1").css('background-color', 'red');
                valid = false;
            }
            if ($("#time").val().length == 0) {
                $("#time").css('background-color', 'red');
                valid = false;
            }
            if ($("#time2").val().length == 0) {
                $("#time2").css('background-color', 'red');
                valid = false;
            } else if ($("#time").val().length >0 && parseInt($("#time2").val().replace(/\D/g,'')) <= parseInt($("#time").val().replace(/\D/g,''))) {
                $("#time2").css('background-color', 'red');
                valid = false;
            }
            if ($("#calendarHeader").val().length == 0) {
                $("#calendarHeader").css('background-color', 'red');
                valid = false;
            }
            
            if (valid) {
                $("#date1").prop('disabled', false);
            }
            return valid;
        });
        
        $("#smsReminder").click(function(){
           $(".smsText").toggle(); 
        });
    });
    
</script>

<script src="<?php echo BASE_DIR; ?>media/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
    jQuery(function($){
            $.timepicker.regional['sv'] = {
            timeOnlyTitle : 'Dra markören till önskat klockslag',
            hourText: 'Tid',
            minuteText: 'Minut',
            timeText : '',
            closeText: 'Spara',
            currentText: ''
        }
        $.timepicker.setDefaults($.timepicker.regional['sv']);
    });


    $(document).ready(function() {
        $('#time').timepicker({dateFormat : 'HH:mm', hour: '18', minute : '00'});
        
        
        $('#time2').timepicker({dateFormat : 'HH:mm', hour: '19', minute : '00'});
    });
</script>
