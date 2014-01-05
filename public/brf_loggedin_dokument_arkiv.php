<?php echo getHeaderPicture("Dokumentarkiv", '', 'bla_skylt', 0, 200); ?>
<br />
<br />
<br />
<br />
<br />
<p>I dokumentarkivet kan du arkivera dokument för framtida bruk. Klicka på ladda upp dokument om du vill spara ett dokument i arkivet. Du kan då välja eller skapa en kategori som passar för dokumentet.</p>
<!--<p><a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/dokument/laddaupp/arkiv">Ladda upp dokument</a></p>-->
<?php
    $oDocumentType = SvenskBRF_Document::getDocumentTypeByDirectoryName($sSubView, TRUE);
    if ($oDocumentType && ($oDocuments = $oBrf->getDocuments($oDocumentType->getId(), TRUE)) && $oDocuments->size()) {
?>
<div id="dokument">
    <div id="vanster_lista">
        <?php $iFormCounter = 0; ?>
        <?php
            // sort the types
            $aSortedDocuments = array();
            foreach ($oDocuments as $oDocument) {
                $sDocumentType = substr($oDocuments->current()->getFilename(), 0, ($iNamePosition = strpos($oDocuments->current()->getFilename(), "_") - 1));
                @$aSortedDocuments[$sDocumentType][] = $oDocument;
            }
            
            foreach ($aSortedDocuments as $sDocumentType => $aDocuments):
        ?>
        <h5><?php echo ucfirst($sDocumentType); ?></h5>
        <div id="left1" style="width: 350px;">
            <ul>
                <?php foreach ($aDocuments as $oDocument): ?>
                <li class="dokument1"><?php echo substr($oDocument->getFilename(), strlen($sDocumentType) + 2); ?></li>
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
        <div id="right2">
            <ul>
                <?php foreach ($aDocuments as $oDocument): ?>
                <li class="spara"><a class="spara" href="javascript:void(0)" onclick="return removeDocument('<?php echo $oDocument->getFilename(TRUE); ?>', '<?php echo $oDocument->getFilename(); ?>');">Ta bort</a></li>
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
    Det finns inga uppladdade dokument.
</p>
<?php } ?>
<script type="text/javascript">
    initMenu($("#dokumenthantering_menu"));
    $("a.nav:contains('<?php echo $oDocumentType->getDocumentTypeName(); ?>')").css('font-style', 'oblique');
</script>
