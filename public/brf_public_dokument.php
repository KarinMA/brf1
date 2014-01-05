<script type="text/javascript">
    function downloadFile(id) {
        $("#downloadform_"+id).submit();
        return false;
    }
</script>
<?php
$oDocumentType = SvenskBRF_Document::getDocumentTypeByDirectoryName(@$_REQUEST['subview']);
if (!$oDocumentType):
?>
<h4>Dokument</h4>
<p class="centertext">
    Inga dokument är uppladdade.
</p>
<?php else: ?>
<h4><?php echo $oDocumentType->getDocumentTypeName(); ?></h4>
<?php foreach ($oBrf->getPublicDocuments($oDocumentType->getId()) as $oDocument): ?>
<p class="centertext">
    <a href="javascript:void(0)" onclick="downloadFile(<?php echo $oDocument->getId(); ?>)"><?php echo $oDocument->getFilename(); ?></a>
    <form id="downloadform_<?php echo $oDocument->getId(); ?>" method="post" action="<?php echo BASE_DIR; ?>ajax.php">
        <input type="hidden" name="id" value="<?php echo $oDocument->getId(); ?>"/>
        <input type="hidden" value="downloaddocument" name="action"/>
    </form>
    <br />
</p>
<?php endforeach; ?>
<?php endif; ?>
<?php //include './brf_public_icons.php'; ?>

                    