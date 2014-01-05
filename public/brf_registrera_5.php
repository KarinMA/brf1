<?php
$sDomain = str_replace(array("https://", "http://"), array('', ''), BASE_DIR);
$sDomain = substr($sDomain, 0, strlen($sDomain) - 1);
switch ($sAction) {
    case 'temploadbrffp':
        $sDestination = TMP_DIR . $_REQUEST['brf'] . '_' . $_REQUEST['brf'] . '_' . $_REQUEST['pictureIndex'];
        if (@move_uploaded_file($_FILES['file']['tmp_name'], $sDestination)) {
            SvenskBRF_Session::getInstance()->savePicture(array($sDestination, $_FILES['file']));
            echo "<script>document.domain='$sDomain';</script>" . $_FILES['file']['type'];
        }
        break;
    case 'removepicture':
        $iPictureId = (int) @$_POST['pictureId'];
        if ($iPictureId) {
            SvenskBRF_Session::getInstance()->addRemovedFrontPictureId($iPictureId);
            echo json_encode(array('result' => TRUE));
        } else {
            SvenskBRF_Session::getInstance()->removePictureData();
        }
        break;
    case 'saveaddress':
        // addresses
        $aResponse['result'] = TRUE;
        if ($_REQUEST['session']) {
            $aResponse['address'] = SvenskBRF_Session::getInstance()->saveAddress($_POST['address'], $_REQUEST['index']);
        } else {
            if ($_REQUEST['firstAddress']) {
                $oBrf->setAddress($_POST['address']['Adress']);
                $oBrf->setZip($_POST['address']['Postnummer']);
                $oBrf->setPostalAddress($_POST['address']['Postort']);
                $oBrf->setStreetNumber($_POST['address']['Nummer1'] ? $_POST['address']['Nummer1'] : NULL);
                $oBrf->setStreetNumber2($_POST['address']['Nummer2'] ? $_POST['address']['Nummer2'] : NULL);
                $oBrf->setCoAddress($_POST['address']['CoAdress'] ? $_POST['address']['CoAdress'] : NULL);
                $aResponse = $aResponse + array('address' => $oBrf->formatBrfAddress());
            } else {
                $oBrfAddresses = $oBrf->getBrfAddresses();
                for ($iBrfAddressIndex = 0; $iBrfAddressIndex < $_REQUEST['index']; $iBrfAddressIndex++) {
                    $oBrfAddresses->next();
                }
                $oBrfAddresses->current()->setAddress($_POST['address']['Adress']);
                $oBrfAddresses->current()->setZip($_POST['address']['Postnummer']);
                $oBrfAddresses->current()->setPostalAddress($_POST['address']['Postort']);
                $oBrfAddresses->current()->setStreetNumber($_POST['address']['Nummer1'] ? $_POST['address']['Nummer1'] : NULL);
                $oBrfAddresses->current()->setStreetNumber2($_POST['address']['Nummer2'] ? $_POST['address']['Nummer2'] : NULL);
                $oBrfAddresses->current()->setEvenNumbers(@$_POST['address']['Jamna'] ? TRUE : FALSE);
                $oBrfAddresses->current()->setOddNumbers(@$_POST['address']['Udda'] ? TRUE : FALSE);
                $aResponse = $aResponse + array('address' => $oBrf->formatBrfAddress($oBrfAddresses->current()));
            }
        }
        echo json_encode($aResponse);
        break;
    case 'loadfirstaddress':
        // addresses
        $aResponse['result'] = TRUE;
        if (FALSE && count(($aSessionAddresses = SvenskBRF_Session::getInstance()->getSavedAddresses()))) {
            $aResponse = $aResponse + $aSessionAddresses[0];
        } else {
            $aResponse = $aResponse + array(
                'Adress' => $oBrf->getAddress(),
                'Nummer1' => $oBrf->getStreetNumber() ? $oBrf->getStreetNumber() : '',
                'Nummer2' => $oBrf->getStreetNumber2() ? $oBrf->getStreetNumber2() : '',
                'Postnummer' => $oBrf->getZip(),
                'Postort' => $oBrf->getPostalAddress(),
                'CoAdress' => (string) $oBrf->getCoAddress(),
            );
        }

        echo json_encode($aResponse);
        break;
    case 'loadotheraddress':
        // addresses
        $aResponse['result'] = TRUE;
        if ($_REQUEST['session']) {
            $aSessionAddresses = SvenskBRF_Session::getInstance()->getSavedAddresses();
            $aResponse = $aResponse + $aSessionAddresses[$_REQUEST['index']];
        } else {
            $oBrfAddresses = $oBrf->getBrfAddresses();
            for ($iBrfAddressIndex = 0; $iBrfAddressIndex < $_REQUEST['index']; $iBrfAddressIndex++) {
                $oBrfAddresses->next();
            }
            $aResponse = $aResponse + array(
                'Adress' => $oBrfAddresses->current()->getAddress(),
                'Nummer1' => $oBrfAddresses->current()->getStreetNumber() ? $oBrfAddresses->current()->getStreetNumber() : '',
                'Nummer2' => $oBrfAddresses->current()->getStreetNumber2() ? $oBrfAddresses->current()->getStreetNumber2() : '',
                'Postnummer' => $oBrfAddresses->current()->getZip(),
                'Postort' => $oBrfAddresses->current()->getPostalAddress(),
                'Jamna' => (int) $oBrfAddresses->current()->getEvenNumbers(),
                'Udda' => (int) $oBrfAddresses->current()->getOddNumbers(),
            );
        }

        echo json_encode($aResponse);
        break;
    case 'removeaddress':
        // addresses
        $aResponse['result'] = TRUE;
        if ($_REQUEST['session']) {
            SvenskBRF_Session::getInstance()->removeSavedAddress($_REQUEST['index']);
        } else {
            $oBrfAddresses = $oBrf->getBrfAddresses();
            for ($iBrfAddressIndex = 0; $iBrfAddressIndex < $_REQUEST['index']; $iBrfAddressIndex++) {
                $oBrfAddresses->next();
            }
            $oBrfAddresses->current()->delete();
        }

        echo json_encode($aResponse);
        break;
}

if ($sAction) {
    include 'unsetup.php';
    exit;
}

$iSmallImageWidth = $iSmallImageHeight = 53;
$iNumberOfPictures = 4;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Registrering, SvenskBrf.se</title>
        <link href="<?php echo BASE_DIR; ?>media/registrering.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            .ta_bort {
                margin-bottom: 10px;
            }
            #wrapper {
                height: 950px;
            }

            #bild_medlem {
                background-color: #DDDDDD;
                border: 1px dashed #BBBBBB;
                cursor: pointer;
                height: 40px;
                padding: 10px;
                text-align: center;
                width: 250px;
            }

            .bild1 {
                max-height: <?php echo $iSmallImageHeight; ?>px;
                max-width: <?php echo $iSmallImageWidth; ?>px;
                min-width: <?php echo $iSmallImageWidth; ?>px;
                height: auto;
                width: auto;
            }

        </style>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript">
            function setHeight(addHeight) {
                var leftHeight = $("#left").height();
                var wrapperHeight = $("#wrapper").height();
                if (addHeight) {
                    leftHeight += addHeight;
                }
                if (leftHeight + 15 > wrapperHeight) {
                    $("#wrapper").height(leftHeight + 15);
                } else {
                }
            }
            var firstAddress = 0;
            var saveAddressIndex = -1;
            var isSessionAddress = 1;
            function editAddress(first, sessionAddress, index) {
                if (first == 1) {
                    $(".evenNumbers,.oddNumbers").hide();
                    $("input[name='Nummer2']").hide();
                    $("#numbersDash").hide();
                } else {
                    $(".evenNumbers,.oddNumbers").show();
                    $("input[name='Nummer2']").show();
                    $("#numbersDash").show();
                    $("input[name='CoAdress']").parent().hide();
                }
                $.post("<?php echo BASE_DIR; ?>registrera", {step: 1, action: first == 1 ? 'loadfirstaddress' : 'loadotheraddress', session: sessionAddress, index: index}, function(response) {

                    if (response.result) {
                        $("input[name='Adress']").focus().val(response.Adress);
                        $("input[name='Postnummer']").val(response.Postnummer);
                        $("input[name='Postort']").val(response.Postort);
                        $("input[name='Nummer1']").val(response.Nummer1);
                        $("input[name='Nummer2']").val(response.Nummer2);
                        if (first == 1) {
                            $("input[name='CoAdress']").val(response.CoAdress).parent().show();
                        }
                        firstAddress = first;
                        saveAddressIndex = index;
                        isSessionAddress = sessionAddress;
                        if (firstAddress == 1) {
                            $("#editFirstAddress").fadeOut();
                            $(".otherAddressEdit").show();
                        } else {
                            if (sessionAddress == 1) {
                                index += $(".brfAddress").size();
                            }
                            $(".otherAddressEdit").eq(index).fadeOut();
                            $("#editFirstAddress").show();
                            $(".otherAddressEdit").not(":eq(" + index + ")").show();
                        }
                        if (response.Jamna && response.Jamna == 1) {
                            $("#evenNumbers").prop('checked', true);
                        } else {
                            $("#evenNumbers").prop('checked', false);
                        }
                        if (response.Udda && response.Udda == 1) {
                            $("#oddNumbers").prop('checked', true);
                        } else {
                            $("#oddNumbers").prop('checked', false);
                        }
                    }
                    return false;
                }, 'json');
            }

            function removeOtherAddress(index, session) {
                $.post("<?php echo BASE_DIR; ?>registrera", {step: 1, action: 'removeaddress', session: session, index: index}, function(response) {

                    if (response.result) {
                        var identifier = session == 1 ? '.sessionAddress' : '.brfAddress';
                        $(identifier).eq(index).remove();
                    }
                    $("#addressAdd").trigger('click');
                    return false;
                }, 'json');
            }

            function clearFields()
            {
                $("#input.addressData[type='text']").val('');
                $("#evenNumbers").prop('checked', false);
                $("#oddNumbers").prop('checked', false);
                $(".evenNumbers").show();
                $(".oddNumbers").show();
            }


        </script>   
    </head>

    <body>
        <script>document.domain = '<?php echo $sDomain; ?>';</script>
        <div id="header">
            <img id="logga" src="<?php echo BASE_DIR; ?>media/registrera/img/logga.png" width="166" height="92" alt="logga" />
            <div id="rubrik">
                <h1><span class="h1_bold">Registrering:</span> För dig i styrelsen</h1>
            </div>
        </div>

        <div id="wrapper" style="min-height: <?php if (!$bIsFromAdmin): ?>950<?php else: ?>950<?php endif; ?>px;">
            <form action="<?php echo BASE_DIR; ?>registrera/6" method="post" enctype="multipart/form-data" id="form">
                <div id="left">

                    <?php if (!$bIsFromAdmin): ?>   
                        <?php echo getHeaderPicture("<b style=\"font-weight: bold;\">5</b>/10. Ladda upp bilder och ", "skriv presentationstext"); ?>
                        <!--<img class="bla_rubrik" src="<?php echo BASE_DIR; ?>media/registrera/img/19_bild.png" width="328" height="65" />-->
                    <?php else: ?>
                        <img class="bla_rubrik" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/styrelseadmin.png" width="210" height="36" alt="styrelseadmin"/>
                    <?php endif; ?>


                    <input type="hidden" name="showStreetView" value="0"/>
                    <?php if (($aStreetData = getStreetData($oBrf)) && count($aStreetData) && array_key_exists('image_url', $aStreetData)): ?>
                        <input type="hidden" name="showStreetView" value="1"/>
                        <?php endif; ?>
                    <table width="330">
<?php if (!$bIsFromAdmin): ?>
                            <!--<tr>
                                <td width="320"><p>Här registrerar du, i några enkla steg, din förening på Svensk Brf. Du behöver inte göra allt på en gång. Så fort du trycker på <?php if (!$bIsFromAdmin): ?>&quot;Gå vidare&quot;<?php else: ?>&quot;Till styrelseadmin&quot;<?php endif; ?> sparas allt du fyllt i och du kan när som helst gå tillbaka och ändra dina inställningar (om du vill återkomma senare till registreringsprocessen – klicka på länken i mejlet som skickats till din mejladress).</p>
                                </td>
                            </tr>-->
                            <tr>
                                <td width="320">
                                    <!--<p>I detta steg kan du ladda upp bilder och skriva en presentationstext för föreningen. Om du vill göra detta senare, klicka på &quot;Gå vidare&quot;</p>-->
                                    <p style="font-size:14px;"><i><u>Bilder</u></i></p>
                                </td>
                            </tr>

                            <?php  $oPictures = $oBrf->getFrontPictures(); ?>
                              <tr>
                              <td>
                              <!--<h3 style="margin-bottom:-10px;">A</h3>-->
                              <p>Här kan ni ladda upp fyra bilder som sedan visas i bildspelet på föreningens publika sida. *<!-- Ni kommer även kunna ladda upp ett obegränsat antal bilder i föreningens bildarkiv som endast kan nås av medlemmarna. Detta görs på styrelsens adminsida när du är klar med denna registreringsprocess.--><br /><br /></p>
                              <label for="upfile"><div id="bild_medlem"><p>Klicka här för att ladda upp din bild!</p></div></label>
                              <br />
                              <!-- this is your file input tag, so i hide it!-->
                              <div style='height: 0px;width:0px; overflow:hidden;'><input id="upfile" type="file" name="file" value="upload"/></div>
                              <!-- here you can have file submit button or you can write a simple script to upload the file automatically-->

                              </td>
                              </tr>
                              <tr>
                              <td style="background-color:#fff;">
                              <ul id="imageList">

                              <?php foreach ($oPictures as $oPicture): ?>
                              <?php
                              if (SvenskBRF_Session::getInstance()->isRemovedFrontPicture($oPicture->getId())) {
                              continue;
                              } else {
                              if (!isset($iIndex)) {
                              $iIndex = 1;
                              } else {
                              $iIndex++;
                              }
                              }
                              ?>
                              <li class="occupied isSaved"><input type="hidden" name="pictureId[]" value="<?php echo $oPicture->getId(); ?>"/><img class="bild bild1" src="<?php echo $oPicture->getImageData(); ?>" width="<?php echo $iSmallImageWidth; ?>" height="<?php echo $iSmallImageHeight; ?>"/></li>
                              <?php endforeach; ?>
                              <?php foreach (SvenskBRF_Session::getInstance()->getSavedPictureData() as $aPictureData): ?>
                              <?php

                              if (!isset($iIndex)) {
                              $iIndex = 1;
                              } else {
                              $iIndex++;
                              }

                              ?>
                              <li class="occupied"><img class="bild bild1" src="<?php echo SvenskBRF_HasPicture::getImageDataFromFile($aPictureData[0]); ?>" width="<?php echo $iSmallImageWidth; ?>" height="<?php echo $iSmallImageHeight; ?>"/></li>
                              <?php endforeach; ?>
                              <?php if (!isset($iIndex)) $iIndex = 0; ?>
                              <?php for ($iPictureIndex = $iIndex; $iPictureIndex < $iNumberOfPictures; $iPictureIndex++): ?>
                              <li><img class="bild bild1" src="<?php echo BASE_DIR; ?>media/registrera/img/bild.png" width="<?php echo $iSmallImageWidth; ?>" height="<?php echo $iSmallImageHeight; ?>"/></li>
                              <?php endfor; ?>
                              <?php for ($iPictureIndex = 0; $iPictureIndex < $iIndex; $iPictureIndex++): ?>
                              <li class="ta_bort"><p style="font-size:9px;"><a href="javascript:void(0)">Ta bort bild</a></p></li>
                              <?php endfor; ?>
                              <?php for ($iPictureIndex = $iIndex; $iPictureIndex < $iNumberOfPictures; $iPictureIndex++): ?>
                              <li class="ta_bort"><p style="font-size:9px;"><a href="javascript:void(0)" style="color:white;">Ta bort bild</a></p></li>
                              <?php endfor; ?>

                              </ul>
                              </td>
                              </tr>
                                <tr>
                                <td width="320">
                                    <!--<p>I detta steg kan du ladda upp bilder och skriva en presentationstext för föreningen. Om du vill göra detta senare, klicka på &quot;Gå vidare&quot;</p>-->
                                    <p style="font-size:14px;"><i><u>Presentationstext</u></i></p>
                                </td>
                            </tr>
                              <tr>
                              <td style="background-color:#fff;">
                              <!--<h3 style="margin-bottom:-10px;">B</h3>-->
                              <p>Skriv en enkel presentationstext om föreningen som kan läsas av människor som besöker föreningens sida.</p>
                              <textarea rows="10" cols="38" name="presentation"><?php echo $oBrf->getPresentation(); ?></textarea>
                              </td>
                              </tr> 
                                <?php endif; /*?>
                        <tr id="addressRow">
                            <td style="background-color:#fff;">
<?php if (!$bIsFromAdmin): ?>
                                    <!--<h3 style="margin-bottom:-10px;">C</h3>

                                    <p>I nästa steg fyller du i antal lägenheter i föreningen. </p>-->
                                    <p style="margin-top:20px;">
                                        Antal lägenheter (obligatorisk uppgift för att kunna registrera rätt antal användare):
                                        <br />

                                        <input <?php if ($oBrf->getActivated()): ?>disabled="disabled" <?php endif; ?>style="width:25px; margin-top:10px;" type="text" id="apartments" name="lagenheter" value="<?php echo $oBrf->getApartments() ? $oBrf->getApartments() : ''; ?>"/>
                                        <span class="felmeddelande" id="apartmentsError" style="margin-left:20px; font-style:italic; display:none;">Fyll i antal lägenheter</span>
                                    </p>
                                <?php endif; ?>
                                <?php
                                $aSessionAddresses = SvenskBRF_Session::getInstance()->getSavedAddresses();
                                $aFirstAddress = array();
                                if (FALSE && count($aSessionAddresses)) {
                                    $aFirstAddress = $aSessionAddresses[0];
                                } else {
                                    $aFirstAddress = array(
                                        'Adress' => $oBrf->getAddress(),
                                        'Nummer1' => $oBrf->getStreetNumber() ? $oBrf->getStreetNumber() : '',
                                        'Nummer2' => $oBrf->getStreetNumber2() ? $oBrf->getStreetNumber2() : '',
                                        'Postnummer' => $oBrf->getZip(),
                                        'Postort' => $oBrf->getPostalAddress(),
                                        'CoAdress' => $oBrf->getCoAddress(),
                                    );
                                }
                                ?>
                                <p>Nedan ser du den adress som finns registrerad hos Bolagsverket för föreningen. Om denna adress inte stämmer så kan ni ändra den genom att trycka på Ändra knappen till höger om adressen. Det är denna adress som kommer visas som föreningens postadress på den offentliga sidan. Har föreningen ytterligare adresser så ska de läggas till härunder.<!-- Efter varje ny adress trycker du på spara. Nedtill (under Tillagda adresser) ser ni vilka adresser ni lagt till.--></p>
                                <p><b style="font-size: 14px;">BOLAGSVERKETS ADRESS:</b><!--Postadress (Detta är den som bolagsverket har registrerat)--></p>
                                <p id="firstAddress"><i><?php
                                        $sAddress = $aFirstAddress['Adress'] . ' ';
                                        if ($aFirstAddress['Nummer1']) {
                                            $sAddress .= $aFirstAddress['Nummer1'];
                                        }
                                        if ($aFirstAddress['Nummer2']) {
                                            $sAddress .= '-' . $aFirstAddress['Nummer2'];
                                        }
                                        if ($aFirstAddress['CoAdress']) {
                                            $sAddress .= ' C/o ' . $aFirstAddress['CoAdress'];
                                        }
                                        $sAddress .= ' ' . $aFirstAddress['Postnummer'] . ' ' . $aFirstAddress['Postort'];
                                        echo "<u>$sAddress</u>";
                                        ?></i>
                                    <span style="margin-left:20px"><a href="javascript:void(0)" id="editFirstAddress" onclick="return editAddress(1, 0);">Ändra</a></span>
                                </p>
                                <p>Har ni inga ytterligare adresser för föreningen, klicka på <?php if (!$bIsFromAdmin): ?>&quot;Gå vidare&quot;<?php else: ?>&quot;Till styrelseadmin&quot;<?php endif; ?> nedan.</p>
                                <p>Har ni fler adresser till föreningen kan ni fylla i dessa nedan<!-- och trycka spara-->. Efter varje ny adress trycker du på spara. Nedtill (under Tillagda adresser) ser ni vilka adresser ni lagt till.</p>
                                <p>Har ni fler uppgångar på samma gata skriver ni till exempel 1 - 9 i rutorna nedan. Ni kan sedan kryssa i om det endast är ojämna eller jämna nummer på gatan som hör till er förening. Om ni har både jämna och ojämna nummer så kryssar ni i båda rutorna. Har ni bara en uppgång till räcker det med att ni fyller i den första nummerrutan.</p>
                                <p style="margin-top:20px;">
                                    Adress: 
                                    <span style="margin-left:67px;"> Nummer:</span>
                                    <span style="margin-left:30px;" class="evenNumbers"> Jämna:</span>
                                    <span style="margin-left:10px;" class="oddNumbers">Ojämna:</span>
                                    <br />
                                    <input style="width:100px" type="text" name="Adress" class="addressData" value="<?php //echo $aFirstAddress['Adress'];  ?>"/>
                                    <input style="width:25px; margin-left:10px;" type="text" name="Nummer1" class="addressData" value="<?php //echo $aFirstAddress['Nummer1'];  ?>"/>
                                    <span id="numbersDash">-</span>
                                    <input style="width:25px" type="text" name="Nummer2" class="addressData" value="<?php //echo $aFirstAddress['Nummer2'];  ?>"/>
                                    <input type="checkbox" value="1" name="evenNumbers" class="evenNumbers" id="evenNumbers" style="margin-left:10px;"/>
                                    <input type="checkbox" value="1" name="oddNumbers" id="oddNumbers" class="oddNumbers" style="margin-left:30px;"/>
                                </p>

                                <p style="margin-top:20px;">Postnummer:<span style="margin-left:57px;"> Postort:</span><br /><input style="width:100px;" type="text" class="addressData" name="Postnummer" value="<?php //echo $aFirstAddress['Postnummer'];  ?>"/><input style="width:100px; margin-left:40px;" type="text" name="Postort" class="addressData" value="<?php //echo $aFirstAddress['Postort'];  ?>"/></p>
                                <p style="margin-top:20px; display:none;">C/o-adress:<br /><input style="width:100px;" type="text" class="addressData" name="CoAdress" value=""/></p>
                                <input id="saveChangesButton" type="image" alt="Spara" src="<?php echo BASE_DIR; ?>media/registrera/img/spara.png" style="border:none;width:78px;height:28px;display:none;"/>


                                <p><a href="javascript:void(0)" id="addressAdd">Lägg till ytterligare en adress</a></p>
                                <h3>Tillagda adresser</h3>
<?php foreach ($oBrf->getBrfAddresses() as $iBrfAddressIndex => $oBrfAddress): ?>
                                    <p class="brfAddress">
                                        <i><?php echo $oBrf->formatBrfAddress($oBrfAddress); ?></i>
                                        <span style="margin-left:20px"><a href="javascript:void(0)" class="otherAddressEdit" onclick="return editAddress(0, 0,<?php echo $iBrfAddressIndex; ?>)">Ändra</a></span>
                                        <span style="margin-left:20px"><a href="javascript:void(0)" class="otherAddressRemove" onclick="return removeOtherAddress(<?php echo $iBrfAddressIndex; ?>, 0);">Ta bort</a></span>
                                    </p>
                                <?php endforeach; ?>
                                        <?php if (count($aSessionAddresses)): ?>
                                            <?php for ($iIndex = 0; $iIndex < count($aSessionAddresses); $iIndex++): ?>
                                        <p class="sessionAddress"><i>
                                                <?php
                                                $sAddress = $aSessionAddresses[$iIndex]['Adress'] . ' ';
                                                if ($aSessionAddresses[$iIndex]) {
                                                    $sAddress .= $aSessionAddresses[$iIndex]['Nummer1'];
                                                }
                                                if ($aSessionAddresses[$iIndex]['Nummer2']) {
                                                    $sAddress .= '-' . $aSessionAddresses[$iIndex]['Nummer2'];
                                                }
                                                $sAddress .= ' ' . $aSessionAddresses[$iIndex]['Postnummer'] . ' ' . $aSessionAddresses[$iIndex]['Postort'];
                                                echo $sAddress;
                                                ?>
                                            </i>
                                            <span style="margin-left:20px"><a href="javascript:void(0)" class="otherAddressEdit" onclick="return editAddress(0, 1,<?php echo $iIndex; ?>)">Ändra</a></span>
                                            <span style="margin-left:20px"><a href="javascript:void(0)" class="otherAddressRemove" onclick="return removeOtherAddress(<?php echo $iIndex; ?>, 1);">Ta bort</a></span>
                                        </p>
                                    <?php endfor; ?>
                                <?php endif; ?>
                                <p>&nbsp;</p>
                                <?php if (!$bIsFromAdmin): ?>

                                    <p>Klicka på &quot;Gå vidare&quot; för att spara och för att komma vidare till nästa steg.</p>
<?php endif; ?>
                            </td>
                        </tr>
                        */ ?>
                    </table>
                    <table width="330">
                        <tr>
                            <td  width="200">&nbsp;</td>
                            <td></td>
                        </tr>
                        <tr>
                           
                            <td width="200">
                                <?php if (!$bIsFromAdmin): ?>
                                    <a href="javscript:void(0)" onclick="document.location.href='<?php echo BASE_DIR; ?>registrera/4'; return false;"><input type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_tillbaka.png" alt="Tillbaka" style="border:none;width:89px;height:35px;"/></a>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if (!$bIsFromAdmin): ?>
                                    <a href="javascript:void(0)"><input name="vidare" type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_vidare.png" style="border: none; width: 89px; height: 35px;" alt="Gå vidare" id="gaVidare"/></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p style="font-size: 11px;">
                                    <i>
                                        * Ni kommer även kunna ladda upp ett obegränsat antal bilder i föreningens bildarkiv som endast kan nås av medlemmarna. Detta görs på styrelsens adminsida när du är klar med denna registreringsprocess.
                                    </i>
                                </p>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="step" value="<?php echo $iStep; ?>"/>
                </div>

                <div id="right">
                    <img class="hoger_bild" src="<?php echo BASE_DIR; ?>media/registrera/img/hoger_bild1.png" style="width: 451px; height: 564px;"/>
                </div>
                <input type="hidden" id="formAction" name="action" value=""/>
                <input type="hidden" id="brfName" name="brf" value="<?php echo $oBrf->getUrl(); ?>"/>
                <input type="hidden" id="pictureIndex" name="pictureIndex" value=""/>
            </form>
        </div>
        <iframe id="upload_target" src="<?php echo BASE_DIR; ?>iframe.php" name="upload_target" style="width:0;height:0;border:0px solid #fff;"></iframe> 
        <script type="text/javascript">
            var imageType = '';
            function getImageType(index) {
                imageType = $("#upload_target").contents().find("body").html();
                $.post("<?php echo BASE_DIR; ?>ajax.php", {action: $("#formAction").val(), 'brf': '<?php echo $oBrf->getUrl(); ?>', imageType: imageType, pictureIndex: index}, function(response) {
                    var listItem = $("#imageList").find("li").not('.occupied').not(".ta_bort").filter(':first');
                    $(listItem).html('<img src="' + response.data.image + '" height="<?php echo $iSmallImageHeight; ?>" width="<?php echo $iSmallImageWidth; ?>" class="bild bild1"/>').addClass('occupied');
                    // set the remove link
                    $("#imageList > li.ta_bort").eq(index).find("a").removeAttr('style');
                    ifrm = document.getElementById('upload_target');
                    ifrm = (ifrm.contentWindow) ? (ifrm.contentWindow) : (ifrm.contentDocument.document)
                    ifrm.domain = '<?php echo $sDomain; ?>';
                }, 'json');
                $("#formAction").val('');
            }

            function submitPicture(index) {
                $("#form").prop("target", 'upload_target');
                $("#formAction").val('temploadbrffp');
                $("#pictureIndex").val(index);
                $("#form").submit();
                $("#form").removeAttr('target');
                window.setTimeout('getImageType(' + index + ')', 800);
            }

            $(document).ready(function() {
                <?php // setHeight(10 * (<?php echo count(SvenskBRF_Session::getInstance()->getSavedAddresses() + $oBrf->getBrfAddresses()->size());  ?>
                $("#upfile").change(function() {
                    if ($("#imageList").find("li").not('.occupied').not(".ta_bort").size() == 0) {
                        alert('Maximalt ' + $("#imageList").find("li").filter('.occupied').size() + ' bilder kan laddas upp här.');
                        return false;
                    }

                    var listItem = $("#imageList").find("li").not('.occupied').not(".ta_bort").filter(':first');
                    var index = $("#imageList > li").index(listItem);
                    submitPicture(index);
                });

                $(".ta_bort > p > a").click(function() {
                    var listItem = $(this).parent().parent();
                    var index = $("#imageList > li.ta_bort").index(listItem);
                    var imageList = $("#imageList > li").eq(index);
                    var isSaved = $(imageList).hasClass("isSaved");
                    $(imageList).find("img").prop("src", '<?php echo BASE_DIR; ?>media/registrera/img/bild.png').addClass("bild").end().removeClass('occupied').removeClass("isSaved");
                    $(this).css('color', 'white');
                    if (isSaved || true) { // all pictures
                        $.post("<?php echo BASE_DIR; ?>registrera", {action: 'removepicture', 'pictureId': $(imageList).find("input[type='hidden']").val()}, function(response) {
                            if (response.result) {
                                // ...
                                $(imageList).find("input").remove();
                            }
                        }, 'json');
                    }
                    return false;
                });

                $("#addressAdd").click(function() {
                    if (($("input[name='Adress']").val().length > 0)) {
                        var addressFields = $("#addressRow").find("input.addressData")
                        var zipCode = $("input[name='Postnummer']").val();
                        var postalAddress = $("input[name='Postort']").val();
                        $(addressFields).val('');
                        //$("input[name='Postnummer']").val(zipCode);
                        //$("input[name='Postort']").val(postalAddress);
                        $("input[name='Adress']").focus();
                    }
                    $("#editFirstAddress,.otherAddressEdit").show();
                    $(".evenNumbers,.oddNumbers").show();
                    $("#evenNumbers,#oddNumbers").prop('checked', false);
                    $("#numbersDash").show();
                    $("input[name='Nummer2']").show();
                    saveAddressIndex = -1;
                    isSessionAddress = 1;
                    firstAddress = 0;
                    $("input[name='Adress']").focus();
                    return false;
                });

                $("#saveChangesButton").click(function() {
                    if ($("input[name='Adress']").val().length > 0 && $("input[name='Postnummer']").val().length >= 5 && $("input[name='Postort']").val().length > 0) {
                        var address = {};
                        var addressFields = $("#addressRow").find("input.addressData")
                        $(addressFields).each(function() {
                            address[$(this).prop('name')] = $(this).val();
                        });
                        address['Jamna'] = $("#evenNumbers").is(':checked') ? 1 : 0;
                        address['Udda'] = $("#oddNumbers").is(':checked') ? 1 : 0;
                        $.post("<?php echo BASE_DIR; ?>registrera", {step: 1, address: address, action: 'saveaddress', firstAddress: firstAddress, session: isSessionAddress, index: saveAddressIndex}, function(response) {
                            if (response.result) {
                                if (firstAddress == 0) {
                                    if (isSessionAddress == 0) {
                                        $(".brfAddress").eq(saveAddressIndex).find("i").html(response.address);
                                    } else {
                                        if (saveAddressIndex > -1) {
                                            $(".sessionAddress").eq(saveAddressIndex).find("i").html(response.address);
                                        } else {
                                            var p = $("#addressAdd").parent(0).next();
                                            if ($(".sessionAddress").size() > 0) {
                                                p = $(".sessionAddress").filter(":last");
                                            } else if ($(".brfAddress").size() > 0) {
                                                p = $(".brfAddress").filter(":last");
                                            }
                                            $(p).after(
                                                    "<p class=\"sessionAddress\"><i> " + response.address + " </i>" +
                                                    '<span style="margin-left:20px"><a onclick="return editAddress(0,1,' + $(".sessionAddress").size() + ')" class="otherAddressEdit" href="javascript:void(0)">Ändra</a></span>\n' +
                                                    '<span style="margin-left:20px"><a onclick="return removeOtherAddress(' + $(".sessionAddress").size() + ', 1);" class="otherAddressRemove" href="javascript:void(0)">Ta bort</a></span>' +
                                                    "</p>"
                                                    );
                                            setHeight(10);

                                        }
                                    }
                                    $(".otherAddressEdit").fadeIn();
                                } else {
                                    $("#firstAddress > i").html(response.address);
                                    $("#editFirstAddress").fadeIn();
                                }
                                $("input[name='CoAdress']").parent().hide();
                                $("input[name='Adress']").focus();
                                $("#addressAdd").trigger('click');
                            }
                        }, 'json');
                    }
                    return false;
                });

                $("#gaVidare").click(function() {
                    if ($("#apartments").size() > 0) {
                        $("#apartments").css('background-color', '')
                        $("#apartmentsError").hide();
                        if ($("#apartments").val().length == 0 || isNaN($("#apartments").val()) || $("#apartments").val() <= 0) {
                            $("#apartments").css('background-color', 'red').focus();
                            $("#apartmentsError").show();
                            return false;
                        }
                    }

                    return true;
                });

                $("#saveChangesButton").show();


            });
        </script>
    </body>
</html>
