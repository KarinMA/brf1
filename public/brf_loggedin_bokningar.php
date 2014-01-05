<?php
    switch ($sAction) {
        case 'remove_booking':
            getUser()->removeBookingByBookingId($_POST['id']);
            break;
        case 'save_bookings':
            // posted here from brf_loggedin_boka.php
            foreach (SvenskBRF_Session::getInstance()->getBookings() as $iBookingIndex => $aBooking) {
                getUser()->bookResource($oBrf->getResourceById($aBooking['resource']), $aBooking['time'], (bool) $aBooking['sms'], (bool) $aBooking['mail']);
                SvenskBRF_Session::getInstance()->removeBooking($iBookingIndex);
            }
            break;
    }

?>
<img id="bla_skylt" src="<?php echo BASE_DIR; ?>/media/inloggad/img/bla-skyltar_brf/dina_bokning.png" width="210" height="36" />
<p>Här ser du dina aktiva bokningar. Här kan du avboka eller välja till påminnelse.</p>
<?php $oBookings = getUser()->getBookings(); ?>
<?php if ($oBookings->size()): ?>
<?php $bSMSBookings = (bool) $oBrf->getSetting(SvenskBRF_Brf::BRF_SETTING_ID_SMS_BOOKING); ?>
<h2>Du har gjort följande bokningar:</h2>
<p style="margin-left: 22px; margin-right: 22px;">
    <i>
    <?php if ($bSMSBookings): ?>Om du väljer SMS-påminnelse kommer du att få ett SMS en timma innan din bokade tid.<?php endif; ?>
    Om du väljer mail-påminnelse kommer du att få ett mail 24 timmar innan din bokade tid.
    </i>
</p>
<?php 

    // sort bookings by resource
    $aResourceBookings = array();
    foreach ($oBookings as $oBooking) {
        if (!array_key_exists($oBooking->getResource()->getName(), $aResourceBookings)) {
            $aResourceBookings[$oBooking->getResource()->getName()] = array();
        }
        $aResourceBookings[$oBooking->getResource()->getName()][] = $oBooking;
    }
    
?>
<!--class="tabell_bokningar"-->
<table width="520px;" cellspacing="5" class="tabell_vanster">
<?php $aForms = array(); ?>

<?php foreach ($aResourceBookings as $sReourceName => $aBooked): ?>
    <tr>
        <th class="plats_bokning" colspan="3"><?php echo $sReourceName; ?></th>
    </tr>
    <?php foreach ($aBooked as $oBooking): ?>
    <?php $aForms[] = $oBooking->getId(); ?>
    <tr>
        <td class="tid_bokning dina_bokningar"><?php echo getResourceBookingTimeFormat($oBooking); ?></td>
        <td class="ta_bort_bokning dina_bokningar"><a href="javscript:void(0)" rel="<?php echo $oBooking->getId(); ?>" class="bookingRemoval tabell_bokningar_td_a">Ta bort bokning</a></td>
        <?php if ($bSMSBookings): ?>
        <td class="ta_bort_sms dina_bokningar"><a href="javscript:void(0)" class="reminder sms tabell_bokningar_td_a" onclick="toggleReminder(this,'SMS-påminnelse', <?php echo (int) !$oBooking->getSmsReminder(); ?>); return false;" rel="<?php echo $oBooking->getId(); ?>" id="sms_<?php echo $oBooking->getId(); ?>"><?php echo ($oBooking->getSmsReminder()) ? 'Ta bort SMS-påminnelse' : 'Lägg till SMS-påminnelse'; ?></a></td>
            <?php endif; ?>
        <td class="ta_bort_mail dina_bokningar"><a href="javascript:void(0)" class="reminder mail tabell_bokningar_td_a" onclick="toggleReminder(this,'mail-påminnelse', <?php echo (int) !$oBooking->getMailReminder(); ?>); return false;" rel="<?php echo $oBooking->getId(); ?>" id="mail_<?php echo $oBooking->getId(); ?>"><?php echo ($oBooking->getMailReminder()) ?  'Ta bort mail-påminnelse' : 'Lägg till mail-påminnelse'; ?></a></td>
    </tr>
    <?php endforeach; ?>
<?php endforeach; ?>
</table>
<?php if (FALSE && $bSMSBookings): ?><p style="margin-left: 20px; margin-right: 20px; font-style: italic; font-size: 11px; display: block;" class="showLater">*Sms-kostnad är 1 krona per sms.</p><?php endif; ?>
<?php foreach ($aForms as $iFormName): ?>
<form method="post" action="" name="booking_removal_form<?php echo $iFormName; ?>">
    <input type="hidden" name="action" value="remove_booking"/>
    <input type="hidden" name="id" value="<?php echo $iFormName; ?>"/>
</form>
<?php endforeach; ?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".bookingRemoval").click(function(){
           if (confirm('Är du säker på att du vill ta bort bokningen?')) {
               var form = 'booking_removal_form' + $(this).attr('rel');
               document.forms[form].submit();
            }
           return false;
        });
    });
    
    function toggleReminder(element, text, remind) {
        var reminderType = $(element).hasClass("mail") ? 'Mail' : 'Sms';
        $.post("<?php echo BASE_DIR; ?>ajax.php", {action : 'togglereminder', id : $(element).attr("rel"), remind : remind, remindertype : reminderType}, function(response) {
            var textValue = "";
            if (remind == 1) {
                textValue = text.replace("*", "");
            } else {
                //textValue = text;
                textValue = text.replace("*", "");
            }
            
            if (response.result) {
                $(element).text(remind == 1 ? ('Ta bort ' + textValue) : ('Lägg till ' + textValue));
            }
            $("#"+$(element).prop('id')).off('click').removeAttr("onclick");
            $(element).on('click', function() {
               toggleReminder(element, remind == 1 ? (text) : (textValue), remind == 1 ? 0 : 1); return false;
            });
            
        }, 'json');
    }
</script>
<?php endif; ?>