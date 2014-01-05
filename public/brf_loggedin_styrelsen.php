<?php echo getHeaderPicture('Styrelsen', '', 'bla_skylt', 0, 200); ?>
<br />
<br />
<br />
<br />
<br />
<p>Här hittar du medlemmar i din styrelse.</p>
<?php $oBoardMembers = $oBrf->getBoardMembers(); ?>
<?php if ($oBoardMembers->size()): ?>
<?php foreach ($oBoardMembers as $oBoardMember): ?>
<div style="float:left; margin-left:60px; margin-right:55px;  font-size:100%; text-align:left; width:150px; padding-bottom:1.0em;">
    <?php 
        $aUserLinkNames = array();
        $iCounter = 1;
        $sUserLinkName = switchCharacters($oBoardMember->getName(), FALSE, TRUE);
        while (in_array($sUserLinkName, $aUserLinkNames)) {
            $sUserLinkName = preg_replace("/[0-9]/", "", $sUserLinkName) . $iCounter;
            $iCounter++;
        }
        $aUserLinkNames[] = $sUserLinkName;
        $iCounter = 1;
    ?>
    <a href="<?php echo BASE_DIR . $oBrf->getUrl() . '/medleminfo/' . $sUserLinkName; ?>">
        <?php if ($oBoardMember->hasPicture()): ?>
        <img style="padding-bottom: 1.0em; padding-top: 0.5em; height: auto; width: auto; max-width: 150px; max-height: 190px;" src="<?php echo $oBoardMember->getImageData(); ?>"/>
        <?php else: ?>
        <img style="padding-bottom: 1.0em; padding-top: 0.5em; height: auto; width: auto; max-width: 150px; max-height: 190px;" src="<?php echo BASE_DIR; ?>media/inloggad/img/fantombild.png"/>
        <?php endif; ?>
    </a>
    <?php echo '<br />' . $oBoardMember->getName(); ?>
    <br /> 
    Titel: <?php echo $oBoardMember->getUserTitle()->getTitleName(); ?>
    <br /> 
    <?php if ($oBoardMember->getHidePhone() || !$oBoardMember->getCellphone()): ?>
    <span style="color: white;">
    <?php endif; ?>
    Telefon: <?php if (!$oBoardMember->getHidePhone() && $oBoardMember->getCellphone()): ?><?php echo $oBoardMember->getCellphone(); ?><?php endif; ?>
    <br /> 
    <?php if ($oBoardMember->getHidePhone() || !$oBoardMember->getCellphone()): ?>
    </span>
    <?php endif; ?>
    <form method="post" action="<?php echo BASE_DIR . $oBrf->getUrl() . '/meddelanden/skicka'; ?>">
        <input type="hidden" name="_uid" value="<?php echo $oBoardMember->getId(); ?>"/>    
        <a href="javascript:void(0)" onclick="$(this).parent().submit(); return false;">Skicka meddelande</a>
    </form>
    <br /> 
</div>
<?php endforeach; ?>
<?php else: ?>
<p style="font-size: 11px; font-style: italic; color: #999999">
    Än har inga styrelsemedlemmar registrerats.
</p>
<?php endif; ?>
