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
<?php if ($sAction === 'felanmalan'): ?>
    showMessage('Felanmälan har skickats.', 'OK');
    <?php
        $oFelanmalan = BrfFelanmalan::create($oBrf->getId(), getUser()->getId(), $_POST['header'], $_POST['meddelande'], date('Y-m-d H:i:s'));
        foreach ($oBrf->getBoardMembers() as $oBoardMember) {
            SvenskBRF_Notice::sendFelanmalan($oFelanmalan, $oBoardMember, $oBrf);
        }
    ?>
<?php endif; ?>
</script>
<div class="knapp bla_knapp2">Felanmälan:</div>
<p>Vänligen beskriv vad felet gäller i rutorna nedan. När du fyllt i formuläret så sänds ett meddelande medlemmarna i styrelsen via mail<?php if ($oBrf->getSetting(SvenskBRF_Brf::BRF_SETTING_ID_SMS_FELANMALAN)): ?> och SMS<?php endif; ?>.</p>
<div class="marginal_bottom"></div>
<form action="" method="post" id="kontaktform" name="kontaktform">
    <!--<p>
        <label for="tags">Till:</label> 
        <br />
        <input type="text" id="tags"/>
    </p>-->
    <p>
    </p>
    <p>
        <label for="subject">Rubrik:</label> 
        <input type="text" value="" name="header" id="subject" size="30" style="width: 490px;">
        <br />
        <br />
        <label for="meddelande">Felanmälan:</label> 
        <textarea name="meddelande" id="meddelande" cols="54" rows="5" style="width: 490px; height: 100px; margin-top:1px; resize: none;"></textarea>
        <br />
        <input type="image" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/skicka.png" id="submit" name="submit">
        <input type="hidden" name="action" value="felanmalan"/>
    </p>
</form>
<script type="text/javascript">
    $("a.nav:contains('Felanmälan'):eq(0)").css('font-style', 'oblique');
</script>