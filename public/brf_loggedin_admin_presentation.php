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
<img id="bla_skylt" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/styrelseadmin.png" width="210" height="36" alt="styrelseadmin"/>
<p>Här lägger du in föreningens presentationstext.</p>
<div id="styrelseadmin">
    <form method="post" action="">
        <table style="width: 400px;">
            <tr>
                <td style="background-color: #fff;" align="left">
                    <h2 align="left">Presentationstext</h2>
                </td>
            </tr>
            <tr>
                <td style="background-color: #fff;">
                    <textarea rows="7" cols="50" name="presentation"><?php echo $oBrf->getPresentation(); ?></textarea>
                    <input name="save" type="image" align="left" src="<?php echo BASE_DIR; ?>media/inloggad/img/spara.png" style="width:78px;height:28px;border:0;" />
                </td>
            </tr>
        </table>
        <input type="hidden" name="action" value="savepresentation"/>
    </form>
</div>
<script type="text/javascript">
    $("a.nav:contains('Presentation')").css('font-style', 'oblique');
</script>