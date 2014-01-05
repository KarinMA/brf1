<?php echo getHeaderPicture("Styrelse-", 'dokument', 'bla_skylt', 0, 200); ?>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<p>Här finns dokument för styrelsen.</p>
<!--<p><a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/dokument/laddaupp/styrelse">Ladda upp dokument</a></p>-->
<?php
    if (($oDocuments = $oBrf->getDocuments(FALSE, TRUE, FALSE)) && $oDocuments->size()) {
?>
<div id="dokument">
    <div id="vanster_lista">
        <?php $iFormCounter = 0; ?>
        <?php
            // sort the types
            $aSortedDocuments = array();
            foreach ($oDocuments as $oDocument) {
                if (!$oDocument->getDocumentType()) {
                    $oDocument->setDocumentType(getDocumentTypeAccessor()->getById($oDocument->getDocumentTypeId()));
                }
                $sDocumentType = $oDocument->getDocumentType()->getDocumentTypeName();
                if ($sDocumentType != 'Dokumentarkiv') {
                    @$aSortedDocuments[$sDocumentType][] = $oDocument;
                }
            }
            
            foreach ($aSortedDocuments as $sDocumentType => $aDocuments):
                //$aDocuments = array_reverse($aDocuments);
        ?>
        <h5><?php echo ucfirst($sDocumentType); ?></h5>
        <div id="left1" style="width: 235px;">
            <ul>
                <?php foreach ($aDocuments as $oDocument): ?>
                <li class="dokument1"><?php echo $oDocument->getFilename(); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="mitt1" style="width: 100px;">
            <ul>
                <?php foreach ($aDocuments as $oDocument): ?>
                <li class="oppna"><a href="javascript:void(0)" onclick="document.forms['open_<?php echo $iFormCounter; ?>'].submit(); return false;">Öppna</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="right1">
            <ul>
                <?php foreach ($aDocuments as $oDocument): ?>
                <li class="spara"><a class="spara" href="javascript:void(0)" onclick="document.forms['save_<?php echo $iFormCounter; ?>'].submit(); return false;">Spara</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="right1">
            <ul>
                <?php foreach ($aDocuments as $oDocument): ?>
                <li class="spara"><a class="" href="javascript:void(0)" onclick="return archiveDocument('<?php echo $oDocument->getFilename(); ?>', <?php echo $oDocument->getId(); ?>);">Arkivera</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="right1">
            <ul>
                <?php foreach ($aDocuments as $oDocument): ?>
                <li class="spara"><a class="spara" href="javascript:void(0)" onclick="return removeDocument('<?php echo $oDocument->getFilename(); ?>');">Ta bort</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php" name="open_<?php echo $iFormCounter; ?>">
            <input type="hidden" name="action" value="opendocument"/>
            <input type="hidden" name="brfId" value="<?php echo $oBrf->getId(); ?>"/>
            <input type="hidden" name="documentName" value="<?php echo $oDocument->getFilename(); ?>"/>
        </form>
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php" name="save_<?php echo $iFormCounter++; ?>">
            <input type="hidden" name="action" value="downloaddocument"/>
            <input type="hidden" name="brfId" value="<?php echo $oBrf->getId(); ?>"/>
            <input type="hidden" name="documentName" value="<?php echo $oDocument->getFilename(); ?>"/>
        </form>
        <?php endforeach; ?>
    </div>
</div>
<?php } else { ?>
<p>
    <br />
    <br />
    Det finns inga uppladdade dokument.
</p>
<?php } ?>
<script type="text/javascript">
    initMenu($("#dokumenthantering_menu"));
    $("a.nav:contains('Styrelsedokument')").css('font-style', 'oblique');
</script>
