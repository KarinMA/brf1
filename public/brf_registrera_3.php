<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Registrering, SvenskBrf.se</title>
        <link href="<?php echo BASE_DIR; ;?>media/registrering.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript">
            function setHeight(addHeight) {
                var leftHeight = $("#left").height();
                var wrapperHeight = $("#wrapper").height();
                if (addHeight) {
                    leftHeight += addHeight;
                }
                if (leftHeight + 100 > wrapperHeight) {
                    $("#wrapper").height(leftHeight + 100);
                } else {
                }
            }
            
            function getFile(file)
            {
                var docName = $("#dlform").find("input").eq(0);
                $(docName).val(file);
                $("#dlform").submit();
                $(docName).val('');
                return false;
            }
            function getTemplate(file)
            {
                var docName = $("#dlform").find("input").eq(0);
                var downloadName = $("#dlform").find("input").eq(2);
                $(docName).val(file);
                $(downloadName).val('downloadtemplate');
                $("#dlform").submit();
                $(docName).val('');
                $(downloadName).val('downloaddocument');
                return false;
            }
            function removeDocument(elementToRemove, file)
            {
                $.post("<?php echo BASE_DIR; ?>ajax.php", {action : 'removeregisterdocument', documentname : file}, function (response) {
                    if (response.result) {
                        $(elementToRemove).remove();
                        setHeight(-15);
                    }
                }, 'json');
                return false;
            }
            
            function loadDocument(documentId) {
                $.post("<?php echo BASE_DIR; ?>ajax.php", {action : 'loaddocument', documentId : documentId}, function (response) {
                    if (response.result) {
                        if (response.data.documentArchiveType) {
                            $("#documentType").val(response.data.documentArchiveType);
                        } else {
                            $("#documentType").val(response.data.category);
                        }
                        if (response.data.hasYear) {
                            $("#yearChooser").show();
                            $("select[name='year']").val(response.data.year);
                        } else {
                            $("select[name='year']").val('');
                            $("#yearChooser").hide();
                        }
                        $("input[name='name']").val(response.data.name);
                        $("input[name='name']").val(response.data.name);
                        $("#public").prop('checked', response.data.pub);
                        $(".upfile").hide();
                        $("input[name='documentId']").val(documentId);
                        $("#actionType").val('update');
                        
                        window.scrollTo(0, 320);
                    }
                }, 'json');
                return false;
            }
            function showMessage(message, buttonText) {
                new Messi(
                    message,
                    {   
                        title: 'Svensk Brf', 
                        buttons: [{id: 0, label: buttonText, val: 'X'}]
                        ,center : true
                    }
                );
            }
            
        </script>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/messi.min.js"></script>
        <link href="<?php echo BASE_DIR; ;?>media/js/messi.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo BASE_DIR; ?>media/js/jquery.placeholder.js" type="text/javascript"></script>
    </head>

    <body>
        <form method="post" action="<?php echo BASE_DIR; ?>registrera/4" enctype="multipart/form-data">

            <div id="wrapper" style="min-height:<?php if (!$oBrf->hasRealtorMaterial()): ?>1250<?php else: ?>1000<?php endif; ?>px;">

                <div id="left" style="margin-top:30px;">
                    <?php if (!$bIsFromAdmin): ?>
                    <!--<img class="bla_rubrik" src="<?php echo BASE_DIR; ?>media/registrera/img/39_bild.png" width="345" height="39" />-->
                    <?php echo getHeaderPicture("<b style=\"font-weight: bold;\">3</b>/10. Ladda upp dokument"); ?>
                    <?php else: ?>
                    <?php if ($sStepParameter !== 's'): ?>
                    <img class="bla_rubrik" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/dokument.png" width="210" height="36" alt="styrelseadmin"/>
                    <?php else: ?>
                    <?php if ($sStepParameter === 'b'): ?>
                    <img class="bla_rubrik" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/dokumentstyrelse.png" width="210" height="36" alt="styrelseadmin"/>
                    <?php else: ?>
                    <?php echo getHeaderPicture("Dokumentarkiv", ''); ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <table width="325">
                        <tr>
                            <td style="background-color:#fff;">
                                <p>
                                    <?php if ($sStepParameter !== 's'): ?>
                                    <?php if (!$bIsFromAdmin): ?>
                                    Här laddar du upp dokument som kan vara av betydelse för föreningens medlemmar. De dokument du laddar upp kommer att visas på förenings hemsida för medlemmarna.<!--<b>Detta kan även göras vid ett senare tillfälle.</b>-->
                                    <!--När ett dokument laddats upp och sparats läggs det i en lista längst ner på den här sidan. -->Du kan lägga till ett obegränsat antal dokument (Word, Excel eller PDF).<!-- Titta igenom listan så att allt ser rätt ut innan du väljer &quot;<?php if (!$bIsFromAdmin): ?>Gå vidare<?php else: ?>Till styrelseadmin<?php endif; ?>&quot;.-->
                                <b>Detta kan även göras vid ett senare tillfälle.</b>
                                <?php else: ?>
                                    Här kan du ladda upp dokument. 
                                <?php endif; ?>
                                <?php elseif ($sStepParameter === 'b'): ?>
                                    Här laddar du upp styrelsedokument. 
                                    <?php else: ?>
                                    Här laddar du upp dokument till dokumentarkivet. 
                                    Du kan spara dokument under olika kategorier. 
                                    Välj en kategori alternativt skapa en ny genom att välja &quot;Annat...&quot; i rullgardinsmenyn.
                                    <!--Använd sidan för att arkivera allt material som tillhör styrelsen. 
                                    Genom att ha materialet här är det alltid tillgängligt för alla.-->
                                    <?php endif; ?>
                                </p>
                                <?php if (FALSE && ($bIsFromAdmin || !$bIsFromAdmin) && !$oBrf->hasRealtorMaterial()): ?>
                                <p><?php if ($bIsFromAdmin): ?> <b>
                                        Ni har ännu inte laddat upp ett mäklarunderlag. 
                                        <?php endif; ?>Vi förordar att ni laddar upp ett mäklarunderlag, dvs svar på frågor som mäklare ställer vid försäljning av bostadsrätter. Att ha ett sådant dokument på hemsidan sparar mycket tid för föreningens styrelse. Nedan finns en mall för ett mäklarunderlag. Ladda ner och fyll i mallen och spara den sedan här under dokument. Mäklarunderlaget kan ni hänvisa till vid framtida mäklarkontakter. Kom ihåg att uppdatera mallen vid förändringar i föreningen. Observera att den är förinställd som ett offentligt dokument som även visas för de som inte är inloggade. Om ni inte vill ha det som ett offentligt dokument så klicka ur boxen nedan när ni laddar upp underlaget.
                                    <?php if ($bIsFromAdmin): ?></b><?php endif; ?>
                                </p>
                                <ul>
                                    <li class="dokument"><p>MALL FÖR MÄKLARUNDERLAG:</p></li>
                                    <ul class="dokument2">
                                        <li class="dokument1"><p><a onclick="getTemplate('template_maklarunderlag.pdf');" href="javascript:void(0)">Mäklarunderlag &gt;</a></p></li>
                                    </ul>
                                </ul>
                                <?php endif; ?>
                              
                            </td>
                        </tr>
                    </table>
                    <table width="325"> 
                        <tr>
                            <td style="background-color:#fff; padding-top:0px;" width="180">
                                <p class="overskrift">VÄLJ KATEGORI</p>
                                <?php if ($sStepParameter !== 's'): ?>
                                <select name="documentType" id="documentType">
                                    <option value="">Välj...</option>
                                    <?php foreach (getDocumentTypeAccessor()->getAll() as $oDocumentType): ?>
                                    <?php if ($oDocumentType->getId() != 9): ?>
                                    <option value="<?php echo $oDocumentType->getDirectoryName(); ?>"><?php echo $oDocumentType->getDocumentTypeName(); ?></option>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php else: ?>
                                <select name="documentType_prepend" id="documentType">
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
                                        $aDocumentArchiveTypes = array_merge($aDocumentArchiveTypes, array('Annat...'));
                                        $aDocumentArchiveTypes = array_unique($aDocumentArchiveTypes);
                                    ?>
                                    <option value="">Välj kategori...</option>
                                    <?php foreach ($aDocumentArchiveTypes as $sDocumentType): ?>
                                    <option value="<?php echo $sDocumentType ?>"><?php echo $sDocumentType; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br /><br /><input type="text" name="documentType_prepend" disabled="disabled" value="" id="docTypePrepend" style="display:none;"
                                    placeholder="Namnge kategori"/>
                                <script type="text/javascript">
                                    $('#documentType').change(function() {
                                       if ($(this).val() === 'Annat...')  {
                                           $("#docTypePrepend").prop('disabled', false).show().focus();
                                       } else {
                                           $("#docTypePrepend").prop('disabled', true).hide();
                                       }
                                    });
                                </script>
                                <input type="hidden" name="documentType" value="arkiv"/>
                                <?php endif; ?>
                            </td>
                            <td style="background-color:#fff;padding-top:0px;" id="yearChooser" valign="top">
                                <?php if ($sStepParameter !== 's'): ?>
                                <p class="overskrift">VÄLJ ÅR</p>
                                <select name="year">
                                    <option value="">Välj...</option>
                                    <option value="2010">2010</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                </select>
                                <?php else: ?>
                                <input type="hidden" name="documentType" value="9"/>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" width="300">
                                <p style="margin-top:20px;">
                                    <?php if ($sStepParameter !== 's'): ?>
                                    Om du vill ändra namn på ett dokument från listan så kan du göra det nedan. Om du vill ladda upp ett dokument som inte finns i listan välj kategorin Övrigt och skriv in namnet nedan.
                                    <?php else: ?>
                                    Ange namn på dokumentet nedan
                                    <?php endif; ?>
                                </p>
                                <input type="text" name="name"/>
                                
                                
                                <p id="upfileLabel" class="upfile"><label for="file2">Ladda upp dokument från din dator:</label></p>
                                <input style="width:200px;" id="upfile" class="upfile" type="file" name="file1" value="upload"/>

                                <input type="hidden" name="public" value="0"/>
                                <?php if (!strlen($sStepParameter)): ?><p style="font-size: 11px;"><input type="checkbox" id="public" name="public" value="1"/>Bocka i rutan om dokumentet är offentligt. Ett offentligt dokument visas även för dem som inte är inloggade på sidan.</p><?php else: ?><p>&nbsp;</p><?php endif; ?>
                                
                                <input style="border:none;width:78px;height:28px;" type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/spara.png" alt="Spara" onclick="if($('#actionType').val()==='') { $('#actionType').val('save'); } $('#gaVidare').click(); return false;"/>
                                
                            </td>
                        </tr>
                    </table>
                    <table width="325">
                        <tr>
                            <td width="300" style="background-color:#fff; padding-top:20px; padding-bottom:20px;">

                                <p class="overskrift">UPPLADDADE DOKUMENT</p>
                                <ul>
                                    <?php 
                                        $iHeight = 0; 
                                    ?>
                                    <?php
                                        $oDocumentTypes = NULL;
                                        if (!strlen($sStepParameter)) {
                                            $oDocumentTypes = $oBrf->getDocumentTypes(strlen($sStepParameter)); 
                                        } else {
                                            $oDocumentTypes = new Collection();
                                            $oDocumentTypes->addObject(getDocumentTypeAccessor()->getById(9));
                                        }
                                    ?>
                                    <?php foreach ($oDocumentTypes as $oDocumentType): ?>
                                    <?php $iHeight += 15; ?>
                                    <?php $oDocuments = $oBrf->getDocuments($oDocumentType->getId(), strlen($sStepParameter)); ?>
                                    <li class="dokument"><p><?php echo strtoupper($oDocumentType->getDocumentTypeName()); ?></p></li>
                                    <ul class="dokument2">
                                        <?php foreach ($oDocuments as $oDocument): ?>
                                        <?php $iHeight += 15; ?>
                                        <li class="dokument1">
                                            <p>
                                                <img src="<?php echo BASE_DIR; ?>media/img/<?php echo $oDocument->getFileType(); ?>.<?php echo $oDocument->getIconImageType(); ?>" width="20" height="20" alt="<?php echo $oDocument->getFileType(); ?>"/>
                                                &nbsp;
                                                <a href="javascript:void(0)" onclick="return getFile('<?php echo $oDocument->getFilename(); ?>');"><?php echo $oDocument->getFilename($oDocument->getIsBoard()); if ($oDocument->getYear()): echo " (".$oDocument->getYear().")"; endif; ?></a>
                                                <span style="margin-right:0px; margin-left:20px;">
                                                    <a onclick="var nextSpan = $(this).parent().next(); $(nextSpan).hide(); $('.removeSpan').not(nextSpan).show(); return loadDocument(<?php echo $oDocument->getId(); ?>)" href="javascript:void(0)">Ändra</a>
                                                </span>
                                                <span style="margin-right:0px; margin-left:20px;" class="removeSpan">
                                                    <a href="javascript:void(0)" onclick="return removeDocument($(this).parent().parent().parent(),'<?php echo $oDocument->getFilename(); ?>');">Ta bort</a>
                                                </span>
                                            </p>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    <table width="330">
                        <tr>
                            
                            <td width="200">
                                <?php if (!$bIsFromAdmin): ?>
                                <a href="javscript:void(0)" onclick="document.location.href='<?php echo BASE_DIR; ?>registrera/2'; return false;"><input type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_tillbaka.png" alt="Tillbaka" style="border:none;width:89px;height:35px;"/></a>
                                <?php else: ?>
                                <a href="javascript:void(0)"><input name="vidare" type="image" src="<?php echo BASE_DIR; ?>media/img/till_styrelseadmin.png" style="border: none; width: 168px; height: 35px;" alt="Gå vidare" id="gaVidare"/></a>
                                <?php endif; ?>
                            </td>
                            
                            
                            <td>
                                <?php if (!$bIsFromAdmin): ?>
                                <a href="javascript:void(0)"><input name="vidare" type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_vidare.png" style="border: none; width: 89px; height: 35px;" alt="Gå vidare" id="gaVidare"/></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                        </tr>
                    </table>
                </div>

                <div id="right">
                    <img class="hoger_bild" src="<?php echo BASE_DIR; ?>media/registrera/img/hoger_bild3.png" width="451" height="564" />
                </div>

            </div>  
            <input type="hidden" name="step" value="<?php echo $iStep; ?>"/>
            <input type="hidden" name="actionType" id="actionType" value=""/>
            <?php if (!strlen($sStepParameter)): ?>
            <input type="hidden" name="isBoard" value="0"/>
            <?php else: ?>
            <input type="hidden" name="isBoard" value="1"/>
            <?php endif ;?>
            <input type="hidden" name="documentId" value=""/>
        </form>
        <iframe id="dlframe" name="dlframe" style="width:0;height:0;border:0px solid #fff;"></iframe>
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php" target="dlframe" id="dlform"><input type="hidden" name="documentName" value=""/><input type="hidden" name="brfId" value="<?php echo $oBrf->getId(); ?>"/><input type="hidden" name="action" value="downloaddocument"/></form>
        <script type="text/javascript">
            $(document).ready(function(){
               $("#documentType").change(function(){
                    if ($(this).val() == 'arsredovisning') {
                        $("#yearChooser").fadeIn();
                    } else {
                        $("#yearChooser").fadeOut();
                    }
                });
                $("#documentType").trigger('change'); 
                setHeight();
                
                <?php if ($bIsFromAdmin && preg_match("/\/admin/", @$_SERVER['HTTP_REFERER'])): ?>
                window.setTimeout('showMessage("Du kommer från styrelseadmin. Klicka på &quot;Till styrelseadmin&quot; längst ner när du är klar för att komma tillbaka till styrelseadmin.", "OK")', 1000);
                <?php endif; ?>
            });
        </script>
    </body>
</html>
