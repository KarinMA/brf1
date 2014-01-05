<style type="text/css">
    #right1 {
        width: 100px;
    }
    .dokument1, .oppna, .spara  {
         margin-top: 10px; 
    }

    form#documentForm input,select {
        margin-bottom: 0;
    }
</style>
<script type="text/javascript">
    function removeDocument(file)
    {
        if (window.confirm('Är du säker på att du vill ta bort dokumentet ' + file +'?')) {
            $.post("<?php echo BASE_DIR; ?>ajax.php", {action : 'removeregisterdocument', documentname : file}, function (response) {
                if (response.result) {
                    window.location.reload();
                }
            }, 'json');
        }
        return false;
    }
    
    function archiveDocument(file, docid)
    {
        if (window.confirm('Är du säker på att du vill ta arkivera dokumentet ' + file +'? Det kommer efter arkivering att finnas under Dokumentarkiv.')) {
            $.post("<?php echo BASE_DIR; ?>ajax.php", {action : 'archivedocument', docid : docid }, function (response) {
                if (response.result) {
                    window.location.reload();
                }
            }, 'json');
        }
        return false;
    }
</script>
<?php
    // what document type?
    if ($sSubView == 'arkiv') {
        // dokumentarkiv
        include './brf_loggedin_dokument_arkiv.php';
    } elseif ($sSubView == 'styrelse') {
        // styrelsedokument
        include './brf_loggedin_dokument_styrelse.php';
    } else if ($sSubView == 'administration') {
        // svenskbrf-dokument
        include './brf_loggedin_dokument_administration.php';
    } elseif ($sSubView == 'laddaupp') {
        // ladda upp
        include './brf_loggedin_dokument_laddaupp.php';
    } else {
        // vanliga dokument
?>
<?php
    $oDocumentType = SvenskBRF_Document::getDocumentTypeByDirectoryName($sSubView, FALSE);
    if ($oDocumentType && ($oDocuments = $oBrf->getDocuments($oDocumentType->getId(), FALSE)) && $oDocuments->size()):
?>
<?php echo getHeaderPicture("Dokument /", $oDocumentType->getDocumentTypeName(), 'bla_skylt', 0, 200); ?>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<p>Här hittar du viktiga dokument och mallar från din bostadsrättsförening.</p>
<?php /* if (getUser()->isBoardMember()): ?><p><a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/dokument/laddaupp">Ladda upp dokument</a></p><?php endif; */ ?>
<div id="dokument">
    <div id="vanster_lista">
        <h5><?php echo strtoupper($oDocumentType->getDocumentTypeName()); ?></h5>
        <div id="left1" style="width: 235px;">
            <ul>
                <?php foreach ($oDocuments as $oDocument): ?>
                <li class="dokument1"><?php echo $oDocument->getFilename(); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="mitt1" style="width: 100px;">
            <ul>
                <?php foreach ($oDocuments as $iFormCounter => $oDocument): ?>
                <li class="oppna"><a href="javascript:void(0)" onclick="document.forms['open_<?php echo $iFormCounter; ?>'].submit(); return false;">Öppna</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="right1">
            <ul>
                <?php foreach ($oDocuments as $iFormCounter => $oDocument): ?>
                <li class="spara"><a class="spara" href="javascript:void(0)" onclick="document.forms['save_<?php echo $iFormCounter; ?>'].submit(); return false;">Spara</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="right1">
            <ul>
                <?php foreach ($oDocuments as $iFormCounter => $oDocument): ?>
                <li class="spara"><a class="spara" href="javascript:void(0)" onclick="return archiveDocument('<?php echo $oDocument->getFilename(); ?>', <?php echo $oDocument->getId(); ?>);">Arkivera</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="right1">
            <ul>
                <?php foreach ($oDocuments as $iFormCounter => $oDocument): ?>
                <li class="spara"><a class="spara" href="javascript:void(0)" onclick="return removeDocument('<?php echo $oDocument->getFilename(); ?>');">Ta bort</a></li>
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
<script type="text/javascript">
    initMenu($("#dokument_menu"));
    $("a.nav:contains('<?php echo $oDocumentType->getDocumentTypeName(); ?>'):eq(0)").css('font-style', 'oblique');
</script>
<?php else: ?>
<?php echo getHeaderPicture("Dokument" . ($oDocumentType ? ' /' : ''), $oDocumentType ? $oDocumentType->getDocumentTypeName() : '', 'bla_skylt', 0, 200); ?>
<br />
<br />
<br />
<br />
<br />
<?php if ($oDocumentType): ?>
<br />
<br />
<?php endif; ?>
<p>Här hittar du viktiga dokument och mallar från din bostadsrättsförening.</p>
<!--<p><a href="<?php echo BASE_DIR; ?>registrera/12">Ladda upp dokument</a></p>-->
<br />
<br />
<p>Det finns inga uppladdade dokument.</p>
<?php endif; ?>
<?php } ?>
