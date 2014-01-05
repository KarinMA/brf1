<?php

function showDay($a_iTime)
{
    return getShortDay(date('w', $a_iTime)) . ' ' . date('j', $a_iTime) . '/' . date('n', $a_iTime);
}


$iFirstDay = $_REQUEST['time'];
$oResource = getResourceAccessor()->getById($_REQUEST['resource']);
$aIntervals = array();
for ($iOpenHour = $oResource->getOpenHour(); $iOpenHour < $oResource->getCloseHour(); $iOpenHour += $oResource->getInterval()) {
    $aIntervals[$iFirstDay + $iOpenHour * 3600] = getHour($iOpenHour).':00-'.getHour($iOpenHour+$oResource->getInterval()).':00'; 
}

$iAvailableSlots = 0;        

?>
<tr>
    <th class="datum"></th>
    <?php for ($iAddDays = 0; $iAddDays < 7; $iAddDays++): ?>
    <th class="datum"<?php /*if (date('Y-m-d', $iFirstDay + $iAddDays * 24 * 3600) === date('Y-m-d')): ?> style="border-style:solid;"<?php endif; */?>> 
        <?php if (date('Y-m-d', $iFirstDay + $iAddDays * 24 * 3600) === date('Y-m-d')): ?>
        <span style="color: #0099FF;">I dag</span><br />
        <?php endif; ?>
        <?php echo showDay($iFirstDay + $iAddDays * 24 * 3600); ?>
    </th>
    <?php endfor; ?>
</tr>
<?php foreach ($aIntervals as $iTime => $sInterval): ?>
<tr>
    <td class="tid"><?php echo $sInterval; ?></td>
    <?php for ($iAddDays = 0; $iAddDays < 7; $iAddDays++): ?>
    <?php $iBookTime = $iTime + $iAddDays * 24 * 3600; ?>
    <?php $iAvailabilityResult = getUser()->checkResourceAvailability($oResource, $iBookTime); ?>
    <?php 
        $sBookingClass = "";
        switch ($iAvailabilityResult) {
            case SvenskBRF_User::RESOURSE_AVAILABILITY_AVAILABLE:
                $sBookingClass = "bokning_kalender";
                $iAvailableSlots++;
                $oBookedUser = NULL;
                break;
            case SvenskBRF_User::RESOURSE_AVAILABILITY_BOOKED:
                $sBookingClass = "bokning_kalender_bokat";
                $oBookedUser = SvenskBRF_User::getBookedUser($oResource, $iBookTime);
                $sBookedName = $oBookedUser ? $oBookedUser->getName() : getUser()->getName();
                break;
            default:
                $oBookedUser = NULL;
                break;
        }
    ?>
    <td class="<?php echo $sBookingClass ? $sBookingClass : 'tid'; ?>">
        <form method="post" action="">
            <input type="hidden" name="bookingTime" value="<?php echo $iBookTime; ?>" />
            <input type="hidden" name="action" value="book_resource" />
            <input type="hidden" name="firstDay" value="<?php echo @$_REQUEST['time']; ?>"/>
        </form>
        <?php if (isset($sBookedName) && $sBookedName): ?>
        <span style="display: none;">Bokat av <?php echo $sBookedName; ?></span>
        <?php endif; ?>
    </td>
    <?php endfor; ?>
</tr>
<?php endforeach; ?>
<?php $GLOBALS['iAvailableSlots'] = $iAvailableSlots; ?>
<script type="text/javascript">
    _loaded = true;
    $(".bokning_kalender_bokat").qtip({
        content: function (event, api) {
            return api.target.find("span").text()
        }
    });
</script>