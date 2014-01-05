<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Registrering, SvenskBrf.se</title>
        <link href="<?php echo BASE_DIR; ;?>media/registrering.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <form method="post" action="<?php echo BASE_DIR; ?>/registrera/8">
            <div id="wrapper" style="min-height:630px;">
                <div id="left" style="margin-top:30px;">
                    <!--<img class="bla_rubrik" src="<?php echo BASE_DIR; ?>media/registrera/img/69_bild.png" width="345" height="38" />-->
                    <?php if (!$bIsFromAdmin): ?>
                    <?php echo getHeaderPicture("<b style=\"font-weight: bold;\">7</b>/10. Kalendern"); ?>
                    <?php else: ?>
                    <?php echo getHeaderPicture("Kalender"); ?>
                    <?php endif; ?>
                    <table width="335">
                        <tr>
                            <td style="background-color:#fff;">
                                <p>&nbsp;</p>
                                <p>Kalendern är ytterligare ett sätt för styrelsen att kommunicera med föreningens medlemmar. Här bokar man in föreningens gemensamma aktiviteter och åtaganden.</p>
                                <p>Det finns även en kalender som endast visas för föreningens styrelsemedlemmar där tex styrelsemöten kan bokas in.</p>
                                <p>När medlemmarna loggar in på föreningens sida ser de vad som är på gång.</p>
                                <!--<p>Kalendern styrs via adminsidan. Denna sida har enbart styrelsen tillgång till.</p>-->
                                <p>&nbsp;</p>
                            </td>
                        </tr>
                    </table>
                    <table width="330" style="background-color:#fff; padding-top:20px;">
                        <tr>
                            <?php if (!$bIsFromAdmin): ?>
                            <td width="200"><a href="javscript:void(0)" onclick="document.location.href='<?php echo BASE_DIR; ?>registrera/6'; return false;"><input type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_tillbaka.png" alt="Tillbaka" style="border:none;width:89px;height:35px;"/></a>
                            </td>
                            <td>
                                <a href="javascript:void(0)"><input name="vidare" type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_vidare.png" style="border: none; width: 89px; height: 35px;" alt="Gå vidare" id="gaVidare"/></a>
                            </td>
                            <?php else: ?>
                            <td width="200"><a href="javscript:void(0)" onclick="document.location.href='<?php echo BASE_DIR; ?>registrera/grattis'; return false;"><input type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_tillbaka.png" alt="Tillbaka" style="border:none;width:89px;height:35px;"/></a>
                            </td>
                            <?php endif; ?>
                        </tr>
                    </table>
                </div>

                <div id="right">
                    <img class="hoger_bild" src="<?php echo BASE_DIR; ?>media/registrera/img/hoger_bild6.png" width="451" height="564" />
                </div>
            </div>
            <input type="hidden" name="step" value="<?php echo $iStep; ?>"/>
        </form>
    </body>
</html>
