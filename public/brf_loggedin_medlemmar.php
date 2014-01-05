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
    $iCounter = 1;
?>
<img id="bla_skylt" class="medlem3" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/medlem.png" width="210" height="36" alt="medlemsidor" /> 
<br />
<div id="kol1">

    <?php foreach ($aColumn1 as $sCharacter => $aUsers): ?>
    <h2><?php echo $sCharacter; ?></h2>
    
    <ul class="medlemslogin_dokument">
        <?php foreach ($aUsers as $oUser): ?>
        <li class="dokument1">
            <?php 
                /*$iCounter = 1;
                $sUserLinkName = switchCharacters($oUser->getName(), FALSE, TRUE);
                while (in_array($sUserLinkName, $aUserLinkNames)) {
                    $sUserLinkName = preg_replace("/[0-9]/", "", $sUserLinkName) . $iCounter;
                    $iCounter++;
                }
                $aUserLinkNames[] = $sUserLinkName;
                $iCounter = 1;*/
                $sUserLinkName = getUserLinkName($oUser, $aUserLinkNames, $iCounter);
            ?>
            <a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/medleminfo/<?php echo $sUserLinkName; ?>"><?php echo $oUser->getName(); ?></a>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endforeach; ?>
</div>

<div id="kol2">

    <?php foreach ($aColumn2 as $sCharacter => $aUsers): ?>
    <h2><?php echo $sCharacter; ?></h2>
    
    <ul class="medlemslogin_dokument">
        <?php foreach ($aUsers as $oUser): ?>
        <li class="dokument1">
            <?php 
                /*$iCounter = 1;
                $sUserLinkName = switchCharacters($oUser->getName(), FALSE, TRUE);
                while (in_array($sUserLinkName, $aUserLinkNames)) {
                    $sUserLinkName = preg_replace("/[0-9]/", "", $sUserLinkName) . $iCounter;
                    $iCounter++;
                }
                $aUserLinkNames[] = $sUserLinkName;
                $iCounter = 1;*/
                $sUserLinkName = getUserLinkName($oUser, $aUserLinkNames, $iCounter);
            ?>
            <a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/medleminfo/<?php echo $sUserLinkName; ?>"><?php echo $oUser->getName(); ?></a>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endforeach; ?>
</div>
<script type="text/javascript">
    $("a.nav:contains('Medlemmar')").css('font-style', 'oblique');
</script>
