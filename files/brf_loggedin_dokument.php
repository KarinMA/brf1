<img id="bla_skylt" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/dokument.png" width="210" height="36" alt="Dokument"/>
<p>Här hittar du viktiga dokument och mallar från din bostadsrättsförening. Klicka på en kategori och välj sedan öppna eller spara för att få tillgång till det dokument du är intresserad av.</p>
<?php
    $iIsBoard = 0;
    $oDocumentType = SvenskBRF_Document::getDocumentTypeByDirectoryName($sSubView);
    if ($oDocumentType && ($oDocuments = $oBrf->getDocuments($oDocumentType->getId(), $iIsBoard)) && $oDocuments->size()): 
?>
<div id="dokument">
    <div id="vanster_lista">
        <h5><?php echo strtoupper($oDocumentType->getDocumentTypeName()); ?></h5>
        <div id="left1" style="width: 250px;">
            <ul>
                <?php foreach ($oDocuments as $oDocument): ?>
                <li class="dokument1"><?php echo $oDocument->getFilename(); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="mitt1">
            <ul>
                <?php $iFormCounter = 0; ?>
                <?php foreach ($oDocuments as $oDocument): ?>
                <li class="oppna"><a href="javascript:void(0)" onclick="document.forms['open_<?php echo $iFormCounter; ?>'].submit(); return false;">&Ouml;ppna</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="right1">
            <ul>
                <?php $iFormCounter = 0; ?>
                <?php foreach ($oDocuments as $oDocument): ?>
                <li class="spara"><a class="spara" href="javascript:void(0)" onclick="document.forms['save_<?php echo $iFormCounter; ?>'].submit(); return false;">Spara</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php foreach ($oDocuments as $iFormCounter => $oDocument): ?>
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php" name="open_<?php echo $iFormCounter; ?>">
            <input type="hidden" name="action" value="opendocument"/>
            <input type="hidden" name="brfId" value="<?php echo $oBrf->getId(); ?>"/>
            <input type="hidden" name="documentName" value="<?php echo $oDocument->getFilename(); ?>"/>
        </form>
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php" name="save_<?php echo $iFormCounter; ?>">
            <input type="hidden" name="action" value="downloaddocument"/>
            <input type="hidden" name="brfId" value="<?php echo $oBrf->getId(); ?>"/>
            <input type="hidden" name="documentName" value="<?php echo $oDocument->getFilename(); ?>"/>
        </form>
        <?php endforeach; ?>
    </div>
</div>
<?php else: ?>
<p style="margin-left: 30px;">Det finns inga uppladdade dokument.</p>
<?php endif; ?>
<script type="text/javascript">
    initMenu($("#dokument_menu"));
</script>
<?php if ($oDocumentType): ?>
<script type="text/javascript">
    $("a.nav:contains('<?php echo $oDocumentType->getDocumentTypeName(); ?>')").css('font-style', 'oblique');
</script>
<?php endif; ?>