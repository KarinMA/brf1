
<?php

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
<p><?php echo $sCalendarText; ?></p>
<?php ?>
<div id="kalender_top">
    <a href="<?php 
        if ($bBackLink) {
            echo BASE_DIR . $oBrf->getUrl() . '/'.$sLinkPrepend.'kalender'; ?>/<?php echo ($iCalendarMonth == 1 ? getMonth(12) : getMonth($iCalendarMonth - 1)) . '-' . ($iCalendarMonth > 1 ? $iCalendarYear : ($iCalendarYear - 1)); 
        } else {
            echo "javascript:void(0)";
        }
    ?>">
        <img src="<?php echo BASE_DIR; ?>media/inloggad/img/pil-vanster.png" width="19" height="30" alt="pil" class="pil_vanster" /></a>
    <a href="<?php echo BASE_DIR . $oBrf->getUrl() . '/'.$sLinkPrepend.'kalender'; ?>/<?php echo ($iCalendarMonth == 12 ? getMonth(1) : getMonth($iCalendarMonth + 1)) . '-' . ($iCalendarMonth == 12 ? $iCalendarYear + 1 : $iCalendarYear); ?>">
        <img src="<?php echo BASE_DIR; ?>media/inloggad/img/pil-hoger.png" width="18" height="30" alt="pil" class="pil_hoger" /></a>
    <div id="vecka_center">
        <div id="vecka">
            <h4>
                <a href="#" onclick="javascript:void(0)"><?php echo $sCalendarMonth; ?></a>
            </h4>
        </div>
    </div>
</div>
<?php
    $iCalendarCount = 1;
?>
<table id="kalender">
    <?php foreach (array(1, 8, 15, 22) as $iWeekStart): ?>
    <tr>
        <?php for ($iAdd = 0; $iAdd <= 6; $iAdd++): ?>
        <?php 
            if ($oCalendarEvents->valid() && isCalendarDay($oCalendarEvents->current(), $iCalendarYear, $iCalendarMonth, $iAdd + $iWeekStart)): 
                $oCalendarEvents->next();
        ?>
        <td class="color kalender" style="background-color: #f6aa6a; cursor:pointer;" onclick="gotoCalendar(<?php echo $iCalendarCount++; ?>);" style="cursor:pointer;"><?php echo $iAdd + $iWeekStart; ?></td>
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
        ?>"<?php if ($bClickable): ?> style="background-color: #f6aa6a; cursor:pointer;" onclick="gotoCalendar(<?php echo $iCalendarCount++; ?>);" style="cursor:pointer;"<?php endif; ?>><?php echo $iDay; ?></td>
        <?php endfor; ?>
    </tr>
    <?php endif ;?>
</table>

<?php $iCalendarCount = 1; $oCalendarEvents->rewind(); foreach ($oCalendarEvents as $oCalendarEvent): ?>
<h2 id="<?php echo $iCalendarCount++; ?>"><?php echo getMonth(date('n', strtotime($oCalendarEvent->getWhen()))); ?></h2>
<ul>
    <li class="rubrik_kalender"><?php echo $oCalendarEvent->getHeader(); ?> <span class="datum"><?php echo substr($oCalendarEvent->getWhen(), 0, 16); if ($oCalendarEvent->getEnds()) echo " - ".substr($oCalendarEvent->getEnds(), 10,6); ?></span></li>
    <li style="text-align: left; list-style-type: none;"><?php echo nl2br($oCalendarEvent->getText()); ?></li>
</ul>
<?php endforeach; ?>
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
</script>