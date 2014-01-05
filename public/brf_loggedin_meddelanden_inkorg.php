<?php


    $iLimit = 10;
    $iOffset = 0;
    $iPage = ($iOffset / $iLimit) + 1;

    $iNumberOfEmails = 0;
    $oEmails = getUser()->getEmails($iLimit, $iOffset, $iNumberOfEmails);
    $iMessageLength = 100; // display this much

    
?>
<img id="bla_skylt" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/inkorgen.png" width="210" height="36" alt="dokument" />
<p>I inkorgen hittar du alla dina meddelanden som skickats från styrelsen eller andra föreningsmedlemmar.</p>
<?php
    if ($sAction) {
        $aResultData = array();
        // see if command has some execution point
        // result data can be used in the switch below too
        Command::createCommand($sAction)->execute($aResultData);
    }
?>

<div id="msgInclude">
<?php include './brf_loggedin_meddelanden_inkorgen_meddelanden.php'; ?>
</div>
<script type="text/javascript">
    function readMail(id) {
        $.post("<?php echo BASE_DIR; ?>ajax.php", {
            action : 'readmail',
            readid : id
        }, function (response) {
            if (response.result) {
                $("#olast_"+id).remove();
            }
        }, 'json');
    }
    function loadMail(element, id) {
        var parentRef = $(element).parent();
        $.post("<?php echo BASE_DIR; ?>ajax.php", {
            action : 'loadmail',
            id : id
        }, function (response) {
            if (response.result) {
                $(element).parent().html(response.data.mailcontent);
                setHeight($(parentRef).height());
                
                if ($("ul.dropdown_left_siffra").size() === 2) {
                    var _unreadMessageCount = parseInt($("ul.dropdown_left_siffra").filter(':eq(0)').find("li").text()) - 1;
                    if (_unreadMessageCount === 0) {
                        $("ul.dropdown_left_siffra").remove();
                    } else {
                        $("ul.dropdown_left_siffra li").text(_unreadMessageCount);
                    }
                }
                
            }
        }, 'json');
    }
    
</script>
<script type="text/javascript">
    $("a.nav:contains('Inkorg')").css('font-style', 'oblique');
</script>