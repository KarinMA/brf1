<?php include 'setup.php'; ?>
<?php
    if (isLoggedIn()) {
        logout(TRUE);
    }

    $oBrf = SvenskBRF_Brf::loadByUrl(@$_REQUEST['brf']);
    if (!$oBrf || $oBrf->getActivated() || isLoggedIn()) {
        exitForLocation("#aktivera");
    } 
    
    
    $aFields = array('email', 'cellphone', 'styrelse');
    
    $aFieldErrors = array();
    if (@$_POST['submit']) {
        $bValid = TRUE;
        // check fields
        foreach ($aFields as $sField) {
            if (!$_POST[$sField]) {
                $aFieldErrors[] = $sField;
                $bValid = FALSE;
            }
        }
        if ($bValid) {
            SvenskBRF_Notice::sendRegisterStartNotification($oBrf, $_POST['email'], $_POST['cellphone']);
            $_SESSION['activateEmail'] = $_POST['email'];
            $_SESSION['activatePhone'] = $_POST['cellphone'];
            exitForLocation('registrera/' . $oBrf->getSetting(SvenskBRF_Brf::BRF_SETTING_ID_REGISTER_BRFCODE));
        }
        
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Registrering, SvenskBrf.se</title>
        <link href="<?php echo BASE_DIR; ?>media/registrering.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            #wrapper {
                height: 700px;
            }
            a img { border: none }
        </style>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-1.9.1.min.js"></script>
    </head>

    <body>
        <div id="header">
            <a href="<?php echo BASE_DIR; ?>"><img id="logga" src="<?php echo BASE_DIR; ?>media/registrera/img/logga.png" width="166" height="92" alt="logga" /></a>
            <div id="rubrik">

            </div>
        </div>

        <div id="wrapper" style="min-height:0px;">
            <form action="" method="post" id="form">
                <div id="left">
                    <table width="330">
                        <tr>
                            <td width="320">
                                <h3>Välkommen till registreringen av<br /><?php echo $oBrf->getName(); ?>:s hemsida</h3>
                                <p>Hej och välkommen till din bostadsrättsförenings nya hemsida. För att registrera föreningen behöver du vara medlem i föreningens styrelse. Är du inte medlem i styrelsen kan du <a href="<?php echo BASE_DIR; ?>tipsa/<?php echo $oBrf->getUrl(); ?>">klicka här</a> för att tipsa din förening.</p>
                                <!--<p>Svensk Brf erbjuder din förening ett komplett intranät där ni via nätet kan kommuncera med varandra, boka lokaler inom föreningen och få tips om rabatter i närliggande butiker.</p>-->
                                
                                
                                <p>För att komma igång klickar du på knappen som heter &quot;Gå vidare&quot; och påbörjar registreringen. *</p>
                                
                                
                                
                                <p>Fyll i </p>

                                <div style="margin-top:15px;">
                                    <p><label style="margin:5px;" for="email">E-post:</label></p>
                                    <?php
                                        $sEmail = array_key_exists('email', $_POST) ? $_POST['email'] : @$_SESSION['activateEmail'];
                                    ?>
                                    <input type="text" name="email" id="email" size="30" value="<?php echo $sEmail; ?>" style="width: 200px; height:20px; border:1px solid #d0cfcb;<?php if (in_array('email', $aFieldErrors)): ?>background-color:red;<?php endif; ?>"/> 

                                    <p><label style="margin:5px;" for="cellphone">Telefon:</label></p>

                                    <?php
                                        $sPhone = array_key_exists('cellphone', $_POST) ? $_POST['cellphone'] : @$_SESSION['activatePhone'];
                                    ?>
                                    <input type="text" name="cellphone" id="cellphone" size="30" value="<?php echo $sPhone; ?>" style="width: 200px; height:20px; border:1px solid #d0cfcb;<?php if (in_array('cellphone', $aFieldErrors)): ?>background-color:red;<?php endif; ?>"/> 
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td height="15"><p>
                                    <input type="hidden" name="styrelse" value="0"/>
                                    <input style="margin-left:0px;" type="checkbox" name="styrelse" value="1"<?php if (@$_POST['styrelse']): ?> checked="checked"<?php endif; ?>/>
                                    Jag är medlem i styrelsen i bostadsrättsföreningen<br /><?php echo $oBrf->getName(); ?>.
                                </p></td>
                        </tr>
                        <?php if (in_array('styrelse', $aFieldErrors)): ?>
                        <tr>
                            <td height="15"><p style="color:red;">
                                    Du måste vara medlem i styrelsen för att gå vidare.
                            </p></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                    <table width="330">
                        <tr>

                            <td width="200">
                                &nbsp;
                            </td>

                            <td>
                                <a href="javascript:void(0)"><input id="gaVidare" name="vidare" type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_vidare.png" style="border: none; width: 89px; height: 35px;" alt="Gå vidare"/></a>
                            </td>
                        </tr>
                        <!--<tr>
                            <td colspan="2">
                                <p style="font-size:11px;">* <i>Denna registreringsguide består av några enkla steg. Du behöver inte fylla i all information nu - det kan göras vid ett senare tillfälle.</i></p>
                            </td>
                        </tr>-->
                    </table>
                    <input type="hidden" name="step" value="0"/>
                </div>

                <div id="right" style="margin-top: 75px;">
                    <img class="hoger_bild" src="<?php echo BASE_DIR; ?>media/registrera/img/3_steg.png" width="425" height="229" alt="bild" />

                </div>
                <input type="hidden" name="submit" value="1"/>
                <input type="hidden" name="brf" value="<?php echo $oBrf->getUrl(); ?>"/>
            </form>
        </div>

    </body>
</html>
<?php include 'unsetup.php'; ?>