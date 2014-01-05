<?php
if (@$_POST['save_x'] && $_POST['save_y']) {
    foreach ($_POST['smsSetting'] as $iSettingTypeId => $sSettingValue) {
        $oBrf->saveSetting($iSettingTypeId, $sSettingValue);
    }
    $sJsAction = "showMessage('SMS-inställningarna har sparats.', 'OK');";
}
?>
<img id="bla_skylt" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/administration.png" width="210" height="36" alt="administration"/>
<script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/messi.min.js"></script>
<link href="<?php echo BASE_DIR; ;?>media/js/messi.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
/**
 * @param {type} message
 * @param {type} buttonText
 * @returns {undefined}
 */
function showMessage(message, buttonText) {
    new Messi(
        message,
        {   
            title: 'Svensk Brf', 
            buttons: [{id: 0, label: buttonText, val: 'X'}]
            ,center : true
        }
    );
}
</script>
<p>Här ändrar du SMS-inställningar för er förening. Att skicka SMS kostar 99 öre ink. moms per SMS.</p>

<div id="styrelseadmin">
    <form method="post" action="">
        <table style="width:500px;">
            <tr>
                <td style="background-color:#fff;" colspan="3">
                    <h2 align="left">Kalender-SMS</h2>
                </td>
            </tr>
            <tr>
                <td style="background-color:#fff;" colspan="3">
                    <p align="left">
                        <input type="hidden" name="smsSetting[<?php echo SvenskBRF_Brf::BRF_SETTING_ID_SMS_CALENDAR; ?>]" value="0"/>
                        <input type="checkbox" name="smsSetting[<?php echo SvenskBRF_Brf::BRF_SETTING_ID_SMS_CALENDAR; ?>]" value="1"<?php if ($oBrf->getSetting(SvenskBRF_Brf::BRF_SETTING_ID_SMS_CALENDAR)): ?> checked="checked"<?php endif; ?>/>&nbsp;Aktiverad</p>
                </td>
            </tr>
            <tr>
                <td style="background-color:#fff;" colspan="3">
                    <h2 align="left">Påminnelse-SMS vid bokning</h2>
                </td>
            </tr>
            <tr>
                <td style="background-color:#fff;" colspan="3">
                    <p align="left">
                        <input type="hidden" name="smsSetting[<?php echo SvenskBRF_Brf::BRF_SETTING_ID_SMS_BOOKING; ?>]" value="0"/>
                        <input type="checkbox" name="smsSetting[<?php echo SvenskBRF_Brf::BRF_SETTING_ID_SMS_BOOKING; ?>]" value="1"<?php if ($oBrf->getSetting(SvenskBRF_Brf::BRF_SETTING_ID_SMS_BOOKING)): ?> checked="checked"<?php endif; ?>/>&nbsp;Aktiverad</p>
                </td>
            </tr>
            <tr>
                <td style="background-color:#fff;" colspan="3">
                    <h2 align="left">SMS-notifiering till styrelsen vid felanmälan</h2>
                </td>
            </tr>
            <tr>
                <td style="background-color:#fff;" colspan="3">
                    <p align="left">
                        <input type="hidden" name="smsSetting[<?php echo SvenskBRF_Brf::BRF_SETTING_ID_SMS_FELANMALAN; ?>]" value="0"/>
                        <input type="checkbox" name="smsSetting[<?php echo SvenskBRF_Brf::BRF_SETTING_ID_SMS_FELANMALAN; ?>]" value="1"<?php if ($oBrf->getSetting(SvenskBRF_Brf::BRF_SETTING_ID_SMS_FELANMALAN)): ?> checked="checked"<?php endif; ?>/>&nbsp;Aktiverad</p>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="background-color:#fff;">
                    <p align="left">
                        <input type="image" name="save" align="left" src="<?php echo BASE_DIR; ?>media/inloggad/img/spara.png" style="width:78px;height:28px;border:0;" alt="spara" />
                    </p>
                </td>
            </tr>
        </table>
    </form>
</div>
<script type="text/javascript">
    $("a.nav:contains('SMS-inställningar')").css('font-style', 'oblique');
</script>