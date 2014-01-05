<?php
$sDomain = str_replace(array("https://","http://"),array('',''),BASE_DIR); $sDomain = substr($sDomain, 0, strlen($sDomain) - 1);
$iSmallImageWidth = 143;
$iSmallImageHeight = 190;
switch ($sAction) {
    case 'temploadbrf':
        $sDestination = TMP_DIR . $_REQUEST['brf'] . '_' .  $_REQUEST['brf']; 
        if (move_uploaded_file($_FILES['file']['tmp_name'], $sDestination)) {
            echo "<script>document.domain = '$sDomain';</script>".$_FILES['file']['type'];
        }
        break;
}

// logged in?
$oUser = getUser();

if ($sAction) {
    include 'unsetup.php';
    exit;
}
$bIsIE = (bool) strpos($_SERVER['HTTP_USER_AGENT'], "IE");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Registrering, SvenskBrf.se</title>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/json2.js"></script>
        <link href="<?php echo BASE_DIR; ;?>media/registrering.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
            function checkTitle(element) {
                if ($(element).val()=='other') {
                    $("#titleWrap").show();
                    $("#ownTitle").removeAttr('disabled').fadeIn();
                } else {
                    $("#titleWrap").hide();
                    $("#ownTitle").attr('disabled','disabled').fadeOut();
                }
            }
        </script>
    </head>

    <body>
        <script>document.domain = '<?php echo $sDomain; ?>';</script>
        <form method="post" action="<?php echo BASE_DIR; ?>registrera/grattis" enctype="multipart/form-data" id="form">
            <div id="wrapper" style="min-height:2100px;">
                <div id="left" style="margin-top:30px;">
                    <table width="300">
                        <tr>
                            <td>
                                <!--<img class="bla_rubrik" src="<?php echo BASE_DIR; ?>media/registrera/img/reg_din_sida99.png" width="345" height="63" />-->
                                <?php echo getHeaderPicture("<b style=\"font-weight: bold;\">3</b>/3. Registrera din", 'medlemsprofil'); ?>
                                <p>Nu har du kommit fram till delen där du registrerar din egen profil. Samma steg kommer alla medlemmar i föreningen gå igenom. </p>
                                
                                <?php if (!$oUser): ?>
                                <p>Nedan är dokumentet med alla användaruppgifter som du skapade i steg två. Välj ett av lösenorden till lösenordesfältet nedtill.</p>
                                <p><a class="getPdf" href="javascript:void(0);"><img height="50" width="50" alt="pdf" src="<?php echo BASE_DIR; ?>media/registrera/img/pdf.jpg" style="margin-left:120px; border:none;"/></a></p>
                                <br />
                                <?php endif; ?>
                                <p style="font-size: 14px; font-weight: bold;">DIN PROFIL</p>
                                <label for="upfile"><div id="bild_medlem" onclick="return true;" style="height: 250px; width: 200px; border:1px dashed #BBB; cursor:pointer; text-align:center; margin-left: 40px;"><p style="font-size: 12px;">*Klicka här för att ladda upp din bild!</p>
                                    <?php if ($oUser && $oUser->getHasPicture()): ?>
                                    <img height="<?php echo $iSmallImageHeight - 20; ?>" width="<?php echo $iSmallImageWidth - 20; ?>" style="max-width:<?php echo $iSmallImageWidth - 20; ?>px; max-height:<?php echo $iSmallImageHeight - 20; ?>px; height: auto; width: auto;"
                                         src="<?php echo $oUser->getImageData(); ?>"/>
                                    <?php endif; ?>
                                </div>
                                </label>
                                <br/>
                                <!-- this is your file input tag, so i hide it!-->
                                <div style="height: 0px;width:0px; overflow:hidden;">
                                    <input id="upfile" type="file" name="file"/>
                                </div>
                                <!-- here you can have file submit button or you can write a simple script to upload the file automatically-->
                            </td>
                        </tr>
                    </table>
                    <table width="330">
                        <tr>
                            <td width="150"><p>Lägenhetsnummer från <a target="_blank" href="http://www.lantmateriet.se/Fastigheter/Fastighetsinformation/Lagenhetsregistret/Innehall/Lagenhetsnummer/">lantmäteriet</a>:<br/><input style="width:150px" type="text" name="member[ApartmentNumber]" value="<?php if ($oUser) echo $oUser->getApartmentNumber(); ?>"/></p></td>
                            <td><p>Föreningens lägenhetsnummer:<br/><input type="text" name="member[ApartmentNumber2]" value="<?php if ($oUser) echo $oUser->getApartmentNumber2(); ?>"/></p></td>
                        </tr>
                        <tr>
                            <td width="250" colspan="2"><p>Ditt våningsplan:<br/><input type="text" style="width:150px;" name="member[Floor]" value="<?php if ($oUser) echo $oUser->getFloor(); ?>"/></p></td>
                        </tr>
                        <?php if (($oBrfAddresses = $oBrf->getBrfAddresses()) && $oBrfAddresses->size()): ?>
                        <tr>
                            <td colspan="2"><p>Din adress:<br />
                                <input type='hidden' id='addressId' name="member[AddressId]" value=''/>
                                <select name="member[AddressNumber]">
                                    <option value=""><?php echo $oBrf->getAddress(); if ($oBrf->getStreetNumber()) echo ' ' . $oBrf->getStreetNumber(); ?></option>
                                    <?php foreach ($oBrfAddresses as $oBrfAddress): ?>
                                    <optgroup label="<?php echo $oBrfAddress->getAddress(); ?>" onclick="$('#addressId').val(<?php echo $oBrfAddress->getId(); ?>);">
                                        <?php for ($iAddressIndex = $oBrfAddress->getStreetNumber(); $iAddressIndex <= ($oBrfAddress->getStreetNumber2() ? $oBrfAddress->getStreetNumber2() : $oBrfAddress->getStreetNumber()); 
                                            $iAddressIndex += (
                                                    ($oBrfAddress->getEvenNumbers() && !$oBrfAddress->getOddNumbers())
                                                    || 
                                                    (!$oBrfAddress->getEvenNumbers() && $oBrfAddress->getOddNumbers())
                                            ) ? 2 : 1        
                                            ): 
                                        ?>
                                        <option value="<?php echo $iAddressIndex; ?>"<?php if ($oUser && $oBrfAddress->getId() == $oUser->getAddressId() && $iAddressIndex == $oUser->getAddressNumber()): ?> selected="selected"<?php endif; ?>>
                                            <?php //echo $oBrfAddress->getAddress(); ?>
                                            <?php if ($oBrfAddress->getStreetNumber()); //echo ' ' . $oBrfAddress->getStreetNumber(); ?>
                                            <?php if ($oBrfAddress->getStreetNumber2()); //echo '-' . $oBrfAddress->getStreetNumber2(); ?>
                                            <?php echo $iAddressIndex; ?>
                                        </option>
                                        <?php endfor; ?>
                                    </optgroup>
                                    <?php endforeach; ?>
                                </select></p>
                            </td>
                            <?php else: ?>
                            <td style="display:none;">
                                <input type="hidden" name="member[AddressId]" value=""/>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php
                            $aNames = array('','');
                            if ($oUser) {
                                $aNames = explode(" ", $oUser->getName(), 2);
                            }
                        ?>
                        <tr>
                            <td width="150"><p>*Förnamn:<br/><input style="width:150px" type="text" name="member[Firstname]" value="<?php echo $aNames[0]; ?>"/></p></td>
                            <td><p>*Efternamn:<br/><input type="text" name="member[Surname]" value="<?php echo $aNames[1]; ?>"/></p></td>
                        </tr>
                        <tr>
                            <td width="150">
                                <p>*E-post:<br/><input style="width:150px" type="text" name="member[Email][0]" value="<?php if ($oUser) echo $oUser->getEmail(); else echo @$_SESSION['activateEmail']; ?>"/></p>
                            </td>
                            <td><p>*Bekräfta E-post:<br/><input type="text" name="member[Email][1]" value="<?php if ($oUser) echo $oUser->getEmail(); ?>"/></p></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="rubrik_form errorEmail error" style="margin-top:-15px; margin-bottom: 10px; display: none;">Ange en giltig e-postadress.</p>
                            </td>
                        </tr>
                        <tr>
                            <td width="150">
                                <p>*Mobiltelefon:<br /><input type="text" name="member[Phone]" value="<?php if ($oUser) echo $oUser->getCellphone(); else echo @$_SESSION['activatePhone']; ?>"/></p>
                                <p class="rubrik_form errorPhone error" style="margin-top:-15px; margin-bottom: 10px; display: none;">Ange ett giltigt mobiltelefonnummer.</p>
                            </td>
                            <td><p>Visa ditt telefonnummer:<br /><input type="hidden" name="member[HidePhone]" value="1"/><input type="checkbox" name="member[HidePhone]" value="1" <?php if ($oUser && !$oUser->getHidePhone()): ?> checked="checked"<?php endif; ?>/></p></td>
                        </tr>
                        <?php if (!$oUser): ?>
                        <tr>
                            <td width="150" colspan="1"><p>*Ditt valda lösenord från pdf-fil:<br /><input type="text" name="member[PrePass]"/></p></td>
                            <td><a class="getPdf" href="javascript:void(0);"><img height="30" width="30" alt="pdf" src="<?php echo BASE_DIR; ?>media/registrera/img/pdf.jpg" style="margin-left:30px; border:none;"/></a><br />
                            <span style="font-family: 'Open Sans',sans-serif; font-size: 11px; text-align: left;">PDF med lösenord</span></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td width="150"><p>*Nytt användarnamn:<br /><input type="text" name="member[Username][0]" value="<?php if ($oUser) echo $oUser->getUsername(); ?>"/></p></td>
                            <td><p>*Bekräfta användarnamn:<br /><input type="text" name="member[Username][1]" value="<?php if ($oUser) echo $oUser->getUsername(); ?>"/></p></td>
                        </tr>
                        <tr>
                            <td width="150">
                                <p>*Nytt lösenord (minst 4 tecken):<br /><input type="password" name="member[Password][0]"  value="<?php if ($oUser) echo $oUser->getPassword(); ?>"/></p>
                            </td>
                            <td><p>*Bekräfta lösenord:<br /><br /><input type="password" name="member[Password][1]" value="<?php if ($oUser) echo $oUser->getPassword(); ?>"/></p></td>
                        </tr>
                    </table>
                    <table width="300">
                        <tr>
                            <td>
                                <p>*Titel:
                                    <select name="member[TitleId]" id="title">
                                        <option value="">Välj...</option>
                                        <?php foreach (getUserTitleAccessor()->getAll() as $oUserTitle): ?>
                                        <option value="<?php echo $oUserTitle->getId(); ?>"<?php if ($oUser && $oUserTitle->getId()==$oUser->getUserTitleId()): ?> selected="selected"<?php endif; ?>><?php echo $oUserTitle->getTitleName(); ?></option>
                                        <?php endforeach; ?>
                                        <option value="other">Övrigt</option>
                                    </select>
                                </p>
                                <p id="titleWrap" style="display:none;">Egen titel:<br/><input type="text" name="member[OwnTitle]" disabled="disabled" id="ownTitle"/></p>
                                <br />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>Ålder:<br /><input type="text" name="member[Age]" value="<?php if ($oUser) echo $oUser->getAge(); ?>"/></p>
                                <p>I din medlemsprofil kommer du att kunna lägga till ytterligare användare.<!-- i ditt hushåll.-->&nbsp;<a href="javascript:void(0)" onclick="$(this).next().fadeIn(); $(this).remove(); return false;">Läs mer</a><span style="display:none;">D.v.s att skapa en egen inloggning för andra boende i hushållet. De blir kopplade till dig som huvudkontakt men kommer kunna lägga in en egen profil etc. Begränsningar av antal bokningstillfällen av lokaler kommer bli kopplade till huvudkontakten. För att skapa ytterligare användare går du till Ditt Konto när du är inloggad.</span></p>
                                <p>Bor med:<br /><input type="text" name="member[LivesWith]"  value="<?php if ($oUser) echo $oUser->getLivesWith(); ?>"/></p>
                                <p>Övrig information/Intressen:<br /><textarea rows="10" cols="24" name="member[Presentation]"><?php if ($oUser) echo $oUser->getPresentation(); ?></textarea></p>
                                <p>&nbsp;</p>
                                <p style="margin-left:15px;">* obligatorisk information</p>
                                <p>&nbsp;</p>
                                <p><a href="<?php echo BASE_DIR; ?>villkor" target="_blank">Användarvillkor</a></p>
                                <p>
                                    <input type="checkbox" value="villkor" name="villkor" id="villkor"/>
                                    <label for="villkor">Jag godkänner <a href="<?php echo BASE_DIR; ?>villkor" target="_blank">villkoren</a></label>
                                </p>
                            </td>
                        </tr>
                    </table>
                    <table width="330" style="background-color:#fff; padding-top:20px;">
                        <tr>
                            <td width="200"><a href="javscript:void(0)" onclick="document.location.href='<?php echo BASE_DIR; ?>registrera/2'; return false;"><input type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_tillbaka.png" alt="Tillbaka" style="border:none;width:89px;height:35px;"/></a>
                            </td>
                            <td>
                                <a href="javascript:void(0)"><input name="vidare" type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_vidare.png" style="border: none; width: 89px; height: 35px;" alt="Gå vidare" id="gaVidare"/></a>
                            </td>
                        </tr>
                    </table>
                </div>

                <div id="right">
                    <img class="hoger_bild" src="<?php echo BASE_DIR; ?>media/registrera/img/hoger_bild9.png" width="451" height="564" />
                </div>
            </div>
            <input type="hidden" name="step" value="<?php echo $iStep; ?>"/>
            <input type="hidden" id="formAction" name="action" value=""/>
            <input type="hidden" id="picturenumber" name="brf" value="<?php echo rand(1000,10000); ?>"/>
            <input type="hidden" name="member[BrfId]" value="<?php echo $oBrf->getId(); ?>"/>
        </form>
        <iframe id="upload_target" name="upload_target" src="<?php echo BASE_DIR; ?>iframe.php" style="width:0;height:0;border:0px solid #fff;"></iframe> 
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php">
            <input type="hidden" name="action" value="getuserpdfs"/>
            <input type="hidden" name="brfId" value="<?php echo $oBrf->getId(); ?>"/>
        </form>
        <script type="text/javascript">
            var imageType = '';
            function getImageType() {
                imageType = $("#upload_target").contents().find("body").html();
                $.post("<?php echo BASE_DIR; ?>ajax.php", { action : $("#formAction").val(), 'brf' : $("#picturenumber").val(), imageType : imageType }, function (response) { 
                    if (response.result) {
                        var listItem = $("#bild_medlem");
                        var imgTag = "<img src=\"" + response.data.image + 
                            "\" height=\"<?php echo $iSmallImageHeight-20; ?>\"" +
                            " width=\"<?php echo $iSmallImageWidth-20; ?>\" " + 
                            "style=\"height: auto; width: auto; max-height:<?php echo ($iSmallImageHeight-20).'px; max-width:'.($iSmallImageWidth-20).'px;'; ?>\"/>";

                        $(listItem).html(
                          '<p style="font-size:12px;">*Klicka här för att ladda upp din bild!</p>\n'+  
                          imgTag  
                        );
                        ifrm = document.getElementById('upload_target');
                        ifrm = (ifrm.contentWindow) ? (ifrm.contentWindow) : (ifrm.contentDocument.document)
                        ifrm.domain = '<?php echo $sDomain; ?>';
                    }
                },'json');
                $("#formAction").val('');
            }
            
            function submitPicture() {
                $("#form").prop("target", 'upload_target');
                $("#formAction").val('temploadbrf');
                $("#form").submit();
                $("#form").removeAttr("target");
                window.setTimeout(getImageType, 800);
            }
            
            $(document).ready(function(){
                
                $(".getPdf").click(function(){
                   //return false;
                   document.forms[1].submit();
                   return false;
                });
                
                
                
               $("#upfile").change(function(){
                    submitPicture();
                });
                var validated = false;
                $("#gaVidare").click(function(){
                    $("p.error").hide();
                    if (!$('#villkor').is(':checked')) { alert('Du måste godkänna villkoren'); return false; } 
                    
                    if (!validated) {
                        $("#formAction").val('validatememberform');
                        $("#form input,select").css('background-color', '');
                        $.post("<?php echo BASE_DIR; ?>ajax.php", $("#form").serialize(), function (response) { 
                            if (response.result) {
                                if (!response.data.error) {
                                    for (var i = 0; i < response.data.errors.length; i++) {
                                        if (typeof response.data.errors[i] === 'object') {
                                            $("input[name='member["+response.data.errors[i][0]+"]["+response.data.errors[i][1]+"]"+"']").css('background-color', 'red');
                                            $("select[name='member["+response.data.errors[i][0]+"]["+response.data.errors[i][1]+"]"+"']").css('background-color', 'red');
                                            $("p.error").filter(".error"+response.data.errors[i][0]).show().css('color', 'red');
                                        } else {
                                            $("input[name='member["+response.data.errors[i]+"]']").css('background-color', 'red');
                                            $("select[name='member["+response.data.errors[i]+"]']").css('background-color', 'red');
                                            $("p.error").filter(".error"+response.data.errors[i]).show().css('color', 'red');
                                        }
                                    }
                                    window.scrollTo(0, 600);
                                } else {
                                    validated = true;
                                    $("#gaVidare").click();
                                }
                            }
                        },'json');
                        $("#formAction").val('');
                        return false;
                    } else {
                        return true;
                    }
                });
                
                $("#title").change(function(){
                    checkTitle($(this));
                });
                checkTitle($("#title"));
            });
        </script>
        
    </body>
</html>
