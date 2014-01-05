<?php
    if (@$_POST['save_x'] && $_POST['save_y']) {
        // send to self too
        SvenskBRF_Notice::sendSMSToMembers($_POST['smsMessage'], $oBrf, $_POST['receiver']); //, getUser()->getId());
    }
    $iCharacters = 160;
?>
<img id="bla_skylt" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/styrelseadmin.png" width="210" height="36" alt="styrelseadmin"/>
<p>Här kan du skicka ett SMS till föreningens medlemmar.</p>
<style type="text/css">
    .hidden { display:none; }
</style>
<div id="styrelseadmin">
    <form method="post" action="" onsubmit="if ($('.receiver').filter(':checked').size() == 0) { alert('Inga mottagare är valda!'); return false; } else { return true; }">
        <table style="width:400px;">
            
            <!--border-bottom: 1px solid #666;-->
            <tr>
                <td style="background-color:#fff;" align="left">
                    <h2 align="left">Skicka SMS</h2>
                </td>
            </tr>
            <tr>
                <td style="background-color:#fff;">
                    <textarea rows="3" cols="59" name="smsMessage" id="smsMessage" onkeyup="limitText(this,$('#countdown'), <?php echo $iCharacters; ?>);" onkeydown="limitText(this,$('#countdown'), <?php echo $iCharacters; ?>);"></textarea>
                    <br />
                   <span><span id="countdown"><?php echo "1 SMS per mottagare"; ?></span></span>
                </td>
            </tr>
            <!--<tr>
                <td style="background-color:#fff;">
                    <input name="save" type="image" align="left" src="<?php echo BASE_DIR; ?>media/inloggad/img/skicka.png" style="width:78px;height:28px;border:0;" />
                </td>
            </tr>-->
        </table>
        
        <input type="checkbox" id="sendToAll"/>&nbsp;<label for="sendToAll">Skicka till alla</label>
        <br />
        
        <a href="javascript:void(0)" id="toggleReceivers"><span>Välj mottagare &gt;</span><span style="display: none;">Dölj mottagare &lt;</span></a>
        <br />
        
        
        
        <?php 
        $oUsers = SvenskBRF_User::getUsersByBrfId($oBrf->getId()); //, getUser());
        $aColumn1 = array();
        $aColumn2 = array();

        foreach ($oUsers as $oUser) {
            if (!$oUser->isMember()) {
                continue;
            }
            $sName = strtoupper($oUser->getName());
            $sName = $sName[0];

            $sRef = NULL;
            if (array_key_exists($sName, $aColumn1)) {
                $sRef = 'aColumn1';
            }
            else if (array_key_exists($sName, $aColumn2)) {
                $sRef = 'aColumn2';
            }
            else {
                $sRef = count(array_keys($aColumn1)) == count(array_keys($aColumn2)) ? 'aColumn1' : 'aColumn2';
            }
            if (!array_key_exists($sName, $$sRef)) { 
                ${$sRef}[$sName] = array();
            }
            ${$sRef}[$sName][] = $oUser;
        }
        ksort($aColumn1);
        ksort($aColumn2);
        $aUserLinkNames = array();
    ?>
    
    <div id="kol1" class="receiverList" style="margin-top: 0px; display: none;">

        <?php foreach ($aColumn1 as $sCharacter => $aUsers): ?>
        <h2><?php echo $sCharacter; ?></h2>

        <ul class="medlemslogin_dokument">
            <?php foreach ($aUsers as $oUser): ?>
            <li class="dokument1">
                <?php 
                    $iCounter = 1;
                    $sUserLinkName = switchCharacters($oUser->getName(), FALSE, TRUE);
                    while (in_array($sUserLinkName, $aUserLinkNames)) {
                        $sUserLinkName = preg_replace("/[0-9]/", "", $sUserLinkName) . $iCounter;
                        $iCounter++;
                    }
                    $aUserLinkNames[] = $sUserLinkName;
                    $iCounter = 1;
                ?>
                <input type="checkbox" class="receiver" name="receiver[]" value="<?php echo $oUser->getId(); ?>"/>&nbsp;
                <!--<a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/medleminfo/<?php echo $sUserLinkName; ?>">-->
                    <?php echo $oUser->getName(); ?>
                <!--</a>-->
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endforeach; ?>
    </div>

    <div id="kol2" class="receiverList" style="margin-top: 0px; display: none;">

        <?php foreach ($aColumn2 as $sCharacter => $aUsers): ?>
        <h2><?php echo $sCharacter; ?></h2>

        <ul class="medlemslogin_dokument">
            <?php foreach ($aUsers as $oUser): ?>
            <li class="dokument1">
                <?php 
                    $iCounter = 1;
                    $sUserLinkName = switchCharacters($oUser->getName(), FALSE, TRUE);
                    while (in_array($sUserLinkName, $aUserLinkNames)) {
                        $sUserLinkName = preg_replace("/[0-9]/", "", $sUserLinkName) . $iCounter;
                        $iCounter++;
                    }
                    $aUserLinkNames[] = $sUserLinkName;
                    $iCounter = 1;
                ?>
                <input type="checkbox" class="receiver" name="receiver[]" value="<?php echo $oUser->getId(); ?>"/>&nbsp;
                <!--<a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/medleminfo/<?php echo $sUserLinkName; ?>">-->
                    <?php echo $oUser->getName(); ?>
                <!--</a>-->
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endforeach; ?>
    </div>
        
        
        <table style="width:400px; margin-top: 15px;">
            <tr>
                <td style="background-color:#fff;">
                    <input name="save" type="image" align="left" src="<?php echo BASE_DIR; ?>media/inloggad/img/skicka.png" style="width:78px;height:28px;border:0;" />
                </td>
            </tr>
        </table>
        
        
    </form>
</div>
<script language="javascript" type="text/javascript">
    function limitText(limitField, limitCount, limitNum) {
        $(limitCount).text(Math.ceil(limitField.value.length / limitNum) + ' SMS per mottagare');
    }
    
    $("#toggleReceivers").click(function(){
        $(this).find("span").toggle();
        $(".receiverList").toggle();
    })
    
    $("#sendToAll").click(function(){
        $(".receiver").prop('checked', $(this).is(':checked'));
    });
    
</script>
<script type="text/javascript">
    $("a.nav:contains('Skicka SMS')").css('font-style', 'oblique');
</script>