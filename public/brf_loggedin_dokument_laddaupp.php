<?php
    $sDocumentType = @$_REQUEST['parameter'];
?>
<?php if ($sDocumentType === 'styrelse'): ?>
<?php echo getHeaderPicture('Styrelse-', 'dokument', 'bla_skylt', 0, 200); ?>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<?php elseif ($sDocumentType === 'arkiv'): ?>
<?php echo getHeaderPicture('Dokumentarkiv', '', 'bla_skylt', 0, 200); ?>
<br />
<br />
<br />
<br />
<br />
<?php else: ?>
<?php echo getHeaderPicture('Ladda upp', 'dokument', 'bla_skylt', 0, 200); ?>
<br />
<br />
<br />
<br />
<br />
<br />
<?php endif; ?>
<br />

<p>Här kan ni ladda upp dokument till medlemmar, styrelse eller till dokumentarkivet. Börja med att välja vem dokumentet ska visas för.</p>
<p class="toggle medlem" style="display: none;">Här kan du ladda upp dokument som ska visas för medlemmarna. Välj även om det är ett offentligt dokument eller inte. Ett offentligt dokument visas även för besökare till föreningens offentliga sida.</p>
<p class="toggle medlem" style="display: none;">När du trycker spara så finns dokumentet tillgängligt för medlemmarna under dokument i den övre vänstra menyn.</p>
<p class="toggle styrelse" style="display: none;">Här kan du ladda upp dokument som ska synas för styrelsen.</p>
<p class="toggle styrelse" style="display: none;">När du trycker spara så finns dokumentet tillgängligt för styrelsen.</p>
<p class="toggle arkiv" style="display: none;">Här kan du ladda upp dokument till föreningens dokumentarkiv. Du kan även välja att skapa en ny kategori genom att välja "Ny kategori..." i rullgardinslistan nedan. Skriv sedan namnet på den nya kategorin.</p>
<p class="toggle arkiv" style="display: none;">När du trycker spara så finns dokumentet sparat i arkivet. Arkivet är endast tillgängligt för styrelsemedlemmar.</p>

<div style="margin-left: 15px;"> 
    <form method="post" action="" id="documentForm" enctype="multipart/form-data">
    <input type="hidden" name="isBoard" value="1" class="arkiv styrelse toggle"/>
    <input type="hidden" name="dType" value="<?php echo $sDocumentType; ?>"/>
    <table>
        <?php if (!$sDocumentType): ?>
        <tr>
            <td>Dokumenttyp</td>
            <td>
                <input type="radio" name="dType" class="documentType" value="medlem" id="docMedlem"/>
                &nbsp;<label for="docMedlem">Medlemsdokument</label>
                <input type="radio" name="dType" class="documentType" value="styrelse" id="docStyrelse"/>
                &nbsp;<label for="docStyrelse">Styrelsedokument</label>
                <input type="radio" name="dType" class="documentType" value="arkiv" id="docArkiv"/>
                &nbsp;<label for="docArkiv">Dokumentarkiv</label>
            </td>
        </tr>
        <?php endif; ?>
        
        <?php if (!$sDocumentType || $sDocumentType == 'medlem'): ?>
        <tr<?php if ($sDocumentType != 'medlem'): ?> style="display: none;"<?php endif; ?> class="medlem toggle">
            <td>Offentligt<br />dokument?</td>
            <td><input type="checkbox" name="public" value="1"/></td>
        </tr>
        <?php endif; ?>
        <tr>
            <td>Välj dokument</td>
            <td><input type="file" name="file1"/></td>
        </tr>
        
        <?php if (!$sDocumentType || $sDocumentType != 'arkiv'): ?>
        <tr<?php if (FALSE): ?> style="display: none;"<?php endif; ?> class="medlem styrelse toggle">
            <td>Välj kategori</td>
            <td>
                <select name="documentType" id="dt1" onchange="return setAction();">
                    <option value="">Välj...</option>
                    <?php foreach (getDocumentTypeAccessor()->getAll() as $oDocumentType): ?>
                    <?php if ($oDocumentType->getId() != 9): ?>
                    <option value="<?php echo $oDocumentType->getDirectoryName(); ?>"><?php echo $oDocumentType->getDocumentTypeName(); ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                </select>
            </td>
        </tr>
        
        <tr<?php if (TRUE): ?> style="display: none;"<?php endif; ?> id="yearChooser" class="toggle styrelse medlem">
            <td>Välj år</td>
            <td>
                <select name="year">
                    <option value="">Välj...</option>
                    <option value="2009">2009</option>
                    <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                </select>
            </td>
        </tr>
        
        <?php endif; ?>
        
        <?php if (!$sDocumentType || $sDocumentType == 'arkiv'): ?>
        <tr<?php if ($sDocumentType != 'arkiv'): ?> style="display: none;"<?php endif; ?> class="arkiv toggle">
            <td>Välj kategori</td>
            <td>
                <select name="documentType_prepend" id="documentType" class="toggle arkiv">
                    <?php
                        $aDocumentArchiveTypes = array(
                            'Protokoll', 
                            'Årsredovisningar', 
                            'Stadgar',
                            'Offerter', 
                            'Renoveringar',
                            'Besiktningar',
                            'Avtal',
                            'Ekonomi',
                            'Ritningar',
                            'Historia'
                        );
                        $aDocumentArchiveTypes = array_merge($aDocumentArchiveTypes, SvenskBRF_Document::getDocumentArchiveTypes($oBrf));
                        $aDocumentArchiveTypes = array_merge($aDocumentArchiveTypes, array('Ny kategori...'));
                        $aDocumentArchiveTypes = array_unique($aDocumentArchiveTypes);
                    ?>
                    <option value="">Välj kategori...</option>
                    <?php foreach ($aDocumentArchiveTypes as $sDocType): ?>
                    <option value="<?php echo $sDocType ?>"><?php echo $sDocType; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="documentType" value="arkiv" class="toggle arkiv"/>
                
            </td>
        </tr>
        <?php endif; ?>
        
        
        <?php if (!$sDocumentType || $sDocumentType == 'arkiv'): ?>
        <tr style="display: none;" id="otherRow">
            <td>Kategorinamn</td>
            <td><input type="text" name="documentType_prepend" id="docTypePrepend" class="toggle arkiv"/></td>
        </tr>
        <?php endif; ?>
        
        <tr>
            <td>Ange namn</td>
            <td><input type="text" name="name" placeholder="Dokumentnamn"/></td>
        </tr>
        
        <tr>
            <td>&nbsp;</td>
            <td><input type="image" src="<?php echo BASE_DIR; ?>media/inloggad/img/spara.png" style="border: none;" id="uploadButton"/></td>
        </tr>
    </table>
    <input type="hidden" name="action" value="savedocument"/>
    </form>
</div>
<script src="<?php echo BASE_DIR; ?>media/js/jquery.placeholder.js" type="text/javascript"></script>
<script type="text/javascript">
    function setAction()
    {
       var _value = $("input.documentType").filter(':checked').val();  
       var action = _value === 'medlem' ? ('/' + $("#dt1").val()) : ('/' + _value);
       $("#documentForm").prop('action', '<?php echo BASE_DIR . $oBrf->getUrl(); ?>/dokument' + action);
    }
    
    $("a.nav:contains('Ladda upp dokument')").filter(':eq(1)').css('font-style', 'oblique');
    
    
    $("input.documentType[type='radio']").change(function(){
       $("tr." + $(this).val()).show();
       $("tr.toggle").not("." + $(this).val()).hide();
       setAction();
    });
    
    $("#dt1").change(function(){
        if ($(this).val() === 'arsredovisning') {
            $("#yearChooser").show();
        } else {
            $("#yearChooser").hide();
        }
    });

</script>
<script type="text/javascript">
    $('#documentType').change(function() {
        if ($(this).val() === 'Ny kategori...' && $(".documentType").filter(':checked').val() === 'arkiv')  {
            $("#otherRow").show();
            $("#docTypePrepend").prop('disabled', false).show().focus();
        } else {
            $("#otherRow").hide();
            $("#docTypePrepend").prop('disabled', true).hide();
        }
    });
</script>
<script type="text/javascript">
    function update(documentType) {
        $("input,select").filter(".toggle").not("."+documentType).prop('disabled', true);
        $(".toggle").not("."+documentType).hide();
        $("input,select").filter(".toggle").filter("."+documentType).prop('disabled', false);
        $(".toggle").filter(".toggle").filter("."+documentType).show();
        $("#documentType").trigger('change');
        $("#dt1").trigger('change');
    }
    
    <?php if ($sDocumentType): ?>
    update('<?php echo $sDocumentType; ?>');
    <?php endif; ?>

    $(".documentType").click(function(){
        update($(this).val());
    });
    
    $("#uploadButton").click(function() {
        <?php if (!$sDocumentType): ?>
        if ($(".documentType").filter(':checked').size() === 0) {
            return false;
        } else 
        <?php endif; ?>

        if ($(".documentType").filter(':checked').val() === 'arkiv' && $("#documentType").val() === '') {
            return false;
        } else if ($("#dt1").val() === '') {
            return false;
        }
        
        return true;
    });
    
    $("input[name='name']").placeholder();
    initMenu($("#dokumenthantering_menu"));
    
</script>
