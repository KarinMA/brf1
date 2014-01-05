<?php

    $aReceivers = array();
    $aReceiverNames = array();
    $sSubject = "";
    $sMessage = "";
    $sSubjectStart = "";
    if ($sAction) {
        $aResultData = array();
        // see if command has some execution point
        // result data can be used in the switch below too
        Command::createCommand($sAction)->execute($aResultData);
        switch ($sAction) {
            case 'mailreplyall':
                $oMailRead = getMailReceiverAccessor()->getById($_POST['readid']);
                if (!$oMailRead->getMail()) {
                    $oMailRead->setMail(getBrfMailAccessor()->getById($oMailRead->getMailId()));
                }
                $oMailReceivers = getMailReceiverAccessor()->getMailReceiversByMailId($oMailRead->getMail()->getId());
                foreach ($oMailReceivers as $oMailReceiver) {
                    if ($oMailReceiver->getToUserId() != getUser()->getId()) {
                        $aReceivers[] = $oMailReceiver->getToUserId();
                        $aReceiverNames[] = SvenskBRF_User::loadById($oMailReceiver->getToUserId())->getName();
                    }
                }
            case 'mailreply':
                // fill receivers
                $oSenderUser = SvenskBRF_User::loadById($_POST['sender']);
                $aReceiverNames[] = $oSenderUser->getName();
                $aReceivers[] = $oSenderUser->getId();
                $oMailRead = getMailReceiverAccessor()->getById($_POST['readid']);
                $aReceiverNames = array_reverse($aReceiverNames);
                $sSubjectStart = "SV: ";
            case 'mailforward':
                $oMailRead = getMailReceiverAccessor()->getById($_POST['readid']);
                if (!$oMailRead->getMail()) {
                    $oMailRead->setMail(getBrfMailAccessor()->getById($oMailRead->getMailId()));
                }
                $sSubject = ($sSubjectStart ? $sSubjectStart : "FWD: ") . $oMailRead->getMail()->getHeader();
                $sMessage = "\n\n\n" . $oMailRead->getMail()->getFromUser()->getName() . " skrev:\n" . $oMailRead->getMail()->getMessage();
                break;
            case 'mailreplysent':
                $oMail = getBrfMailAccessor()->getById($_POST['readid']);
                $sSubject = "SV: " . $oMail->getHeader();
                $sMessage = "\n\n\n" . getUser()->getName() . " skrev:\n" . $oMail->getMessage();
                // receivers, receiver names
                foreach ($oMail->getMailReceiverCollection() as $oMailReceiver) {
                    $aReceiverNames[] = SvenskBRF_User::loadById($oMailReceiver->getToUserId())->getName();
                    $aReceivers[] = SvenskBRF_User::loadById($oMailReceiver->getToUserId())->getId();
                }
                break;
                
        }
    } else if (@$_POST['_uid']) {
        $oReceiver = SvenskBRF_User::loadById($_POST['_uid']);
        $aReceivers[] = $oReceiver->getId();
        $aReceiverNames[] = $oReceiver->getName();
    }

?>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
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
<script type="text/javascript">7
    var names = [];
    var ids = [];
    $(document).ready(function() {
        
        <?php foreach (SvenskBRF_User::getUsersByBrfId($oBrf->getId(), getUser()) as $oOtherUser): ?>
        <?php if (!$oOtherUser->isMember() || !$oOtherUser->isRegistered()): ?><?php continue; ?><?php endif; ?>
        <?php $aNameParts = explode(' ', $oOtherUser->getName()); ?>
        names.push("<?php echo $aNameParts[1] . ' ' . $aNameParts[0]; ?>");<?php echo "\n"; ?>
        ids.push(<?php echo $oOtherUser->getId(); ?>);<?php echo "\n"; ?>
        <?php endforeach; ?>
        <?php if (getUser()->getUserType() == SvenskBRF_User::USER_TYPE_MEMBER): ?>
        names.push("Alla");
        ids.push(-1);
        <?php endif; ?>
        $("#tags").autocomplete({
            source : names,
            select : function(event, ui) {
                if (addedUsers.indexOf(ids[names.indexOf(ui.item.value)]) == -1) {
                    var addUser = true;
                    if (ids[names.indexOf(ui.item.value)] == -1) {
                       $(".removeLink").click(); 
                    } else if (addedUsers.indexOf(-1) != -1) {
                        addUser = false;
                    }
                    if (addUser) {
                        $('#receivers').append('<span><span>' + ui.item.value + '&nbsp;</span><a rel="'+ids[names.indexOf(ui.item.value)]+'" href="javascript:void(0)" class="removeLink" onclick="removeUser(this); return false;"><img src="<?php echo BASE_DIR; ?>media/inloggad/img/delete_button.gif" height="7" width="7"/></a>&nbsp;</span>'); 
                        addedUsers.push(ids[names.indexOf(ui.item.value)]); 
                    }
                }
                $("#tags").val('');
            },
            close : function(event, ui) {
                $("#tags").val('');
            }
        });
        $("#submit").click(function(){
            // make an ajax request
            if (addedUsers.length > 0 && $("#meddelande").val().length > 0 && $("#subject").val().length > 0) {
                $.post("<?php echo BASE_DIR; ?>ajax.php", {
                    action : 'sendmail',
                    receivers : addedUsers,
                    message : $("#meddelande").val(),
                    subject : $("#subject").val()
                }, function (response) {
                   if (response.result) {
                       // go somewhere else
                       //document.location.href = '<?php echo BASE_DIR . $oBrf->getUrl() . '/meddelanden/skickat'; ?>';
                       $(".removeLink").click(); 
                       $("#meddelande,#subject").val('');
                       <?php if (getUser()->getUserType() == SvenskBRF_User::USER_TYPE_MEMBER): ?>
                       showMessage('Meddelandet har skickats.', 'OK');
                       document.location.href = '<?php echo BASE_DIR . $oBrf->getUrl() . '/meddelanden/inkorg'; ?>';
                       <?php else: ?>
                       showMessage('Meddelandet har skickats.', 'OK');
                       document.location.href = '<?php echo BASE_DIR . $oBrf->getUrl() . '/meddelanden/skickat'; ?>';
                       <?php endif; ?>
                   } else {
                       alert(response.data);
                   }
                }, 'json');
            } else {
            }
            return false;
        });
    });
    var addedUsers = [];
    <?php foreach ($aReceivers as $iReceiverId): ?>
    addedUsers.push(<?php echo $iReceiverId . ")\n"; ?>
    <?php endforeach; ?>
    
</script>    
<img id="bla_skylt" src="<?php echo BASE_DIR; ?>media/inloggad/img/nytt_meddelande.png" width="210" height="36" alt="Nytt meddelande" />
<p>Skriv för- eller efternamn till den eller de personer du vill skicka meddelandet till. Vill du skicka till alla medlemmar, skriv alla.</p>
<div class="marginal_bottom"></div>

<form name="kontaktform" id="kontaktform" method="post" action="">
    <p>
        <label for="tags">Till:</label> 
        <br />
        <input id="tags" type="text" onblur="if (this.value != '' && addedUsers.indexOf(ids[names.indexOf(this.value)]) == -1 && names.indexOf(this.value) != -1) { $('#receivers').append(' ' + this.value + ';'); addedUsers.push(ids[names.indexOf(this.value)]); this.value=''; } else { this.value=''; } "/>
    </p>
    <p>
        <div id="mottagare" style="margin-left: 20px; font-size: 12px;">
            <span id="receivers">
                <?php if (count($aReceiverNames)): ?>
                    <?php foreach ($aReceiverNames as $iReceiverNameIndex => $sReiverName): ?>
                        <span>
                            <span>
                                <?php echo $sReiverName.';'; ?>
                                &nbsp;
                            </span>
                            <a href="javascript:void(0)" class="removeLink" rel="<?php echo $aReceivers[$iReceiverNameIndex]; ?>" onclick="removeUser(this); return false;">
                                <img src="<?php echo BASE_DIR; ?>media/inloggad/img/delete_button.gif" width="7" height="7"/>
                            </a>
                        </span>
                    <?php endforeach; ?>
                <?php endif; ?>
            </span>
        </div>
    </p>
    <p>
        <label for="subject">Rubrik:</label> 
        <input type="text" style="width: 490px;" size="30" id="subject" name="header" value="<?php echo $sSubject; ?>"/>
        <br />
        <br />
        <textarea style="width: 490px; height: 100px; margin-top:1px; resize: none;" rows="5" cols="54" id="meddelande" name="meddelande"><?php echo $sMessage; ?></textarea>
        <br />
        <input type="image" name="submit" id="submit" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/skicka.png" />
    </p>
</form>

<script type="text/javascript">
    $(document).ready(function(){
        $("#Till").dblclick(function(){ 
            if (addedUsers.indexOf(parseInt($(this).val())) == -1) {
                addedUsers.push(parseInt($(this).val()));
                $('#receivers').append('<span><span>'  + $(this).find('option:selected').text() + '&nbsp;</span><a rel="'+$(this).val()+'" href="#" onclick="removeUser(this); return false;"><img src="<?php echo BASE_DIR; ?>media/inloggad/img/delete_button.gif" height="7" width="7"/></a>&nbsp;</span>'); 
            }
        });
        
    }); 
    function removeUser(removeLink) {
        // remove from added users
        var index = addedUsers.indexOf(parseInt($(removeLink).prop('rel')));
        addedUsers.splice(index, 1);
        $(removeLink).parent().remove();
        
    }
</script>
<script type="text/javascript">
    <?php if (getUser()->getUserType() == SvenskBRF_User::USER_TYPE_MEMBER): ?>
    $("a.nav:contains('Skicka'):eq(0)").css('font-style', 'oblique');
    <?php endif; ?>
</script>
