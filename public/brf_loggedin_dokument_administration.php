<?php echo getHeaderPicture("Svensk Brf-", 'dokument', 'bla_skylt', 0, 200); ?>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<p>Här hittar du viktiga dokument och mallar från Svensk Brf. Klicka på en kategori och välj sedan öppna eller spara för att få tillgång till det dokument du är intresserad av.</p>
<div id="dokument">
    <div id="vanster_lista">
        <h5>Dokument</h5>
        <div id="left1" style="width: 250px;">
            <ul>
                <li class="dokument1">Användaruppgifter för<br />oregistrerade medlemmar</li>
            </ul>
        </div>
        <div id="mitt1">
            <ul>
                <li class="oppna"><a href="javascript:void(0)" onclick="$('#getUserPdfsAction').val('getuserpdfsopen'); document.forms['getuserpdfs'].submit(); return false;">Öppna</a></li>
            </ul>
        </div>
        <div id="right1">
            <ul>
                <li class="spara"><a href="javascript:void(0)" onclick="$('#getUserPdfsAction').val('getuserpdfs'); document.forms['getuserpdfs'].submit(); return false;">Spara</a></li>
            </ul>
        </div>
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php" name="getuserpdfs">
            <input type="hidden" name="action" value="getuserpdfs" id="getUserPdfsAction"/>
            <input type="hidden" name="brfId" value="<?php echo $oBrf->getId(); ?>"/>
        </form>
        
        <!-- --->
        <br />
        <!-- -->
        
        <?php $oResources = $oBrf->getResources(); ?>
        <?php if ($oResources->size()): ?>
        <h5>Lokaler</h5>
        <div id="left1" style="width: 250px;">
            <ul>
                <?php foreach ($oResources as $oResource): ?>
                <li class="dokument1"><?php echo $oResource->getName(); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="mitt1">
            <ul>
                <?php foreach ($oResources as $oResource): ?>
                <li class="oppna"><a href="javascript:void(0)" onclick="return getResourceFile('<?php echo $oResource->getName(); ?>', 'openresourcedocument')">Öppna</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="right1">
            <ul>
                <?php foreach ($oResources as $oResource): ?>
                <li class="spara"><a href="javascript:void(0)" onclick="return getResourceFile('<?php echo $oResource->getName(); ?>', 'downloadresourcedocument')">Spara</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php" id="dlform1"><input type="hidden" name="documentName" value=""/><input type="hidden" name="brfId" value="<?php echo $oBrf->getId(); ?>"/><input type="hidden" name="action" value="downloadresourcedocument"/></form>
        <?php endif; ?>
    </div>
</div>
<script type="text/javascript">
    function getResourceFile(file, command)
    {
        var docName = $("#dlform1").find("input").eq(0);
        $("#dlform1").find("input").eq(2).val(command);
        $(docName).val(file);
        $("#dlform1").submit();
        $(docName).val('');
        return false;
    }
</script>
<script type="text/javascript">
    initMenu($("#dokumenthantering_menu"));
    $("a.nav:contains('Svensk Brf-dokument')").css('font-style', 'oblique');    
</script>
