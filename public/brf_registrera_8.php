<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Registrering, SvenskBrf.se</title>
        <link href="<?php echo BASE_DIR; ;?>media/registrering.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <form method="post" action="<?php echo BASE_DIR; ?>/registrera/9">
            <div id="wrapper" style="min-height:630px;">
                <div id="left" style="margin-top:30px;">
                    <table width="">
                        <tr>
                            <td style="background-color:#fff;">
                               <!--<img class="bla_rubrik" src="<?php echo BASE_DIR; ?>media/registrera/img/79_bild.png" width="345" height="38" />-->
                                <?php if (!$bIsFromAdmin): ?>
                                <?php echo getHeaderPicture("<b style=\"font-weight: bold;\">8</b>/10. Skicka SMS"); ?>
                                <?php else: ?>
                                <?php echo getHeaderPicture("SMS-tjänsten"); ?>
                                <?php endif; ?>
                                <p>Genom hemsidans admin-sida kan man som styrelsemedlem skicka sms till medlemmarna. Medlemmarna kan även beställa påminnelser via sms när man bokat någon av föreningens lokaler. Likaså kan styrelsen lägga in sms påminnelser för medlemmarna om man t.ex. har ett årsmöte eller en hantverkare som behöver tillgång till medlemmarnas lägenheter.</p>
                                <p>Det finns möjlighet att stänga av möjligheten för SMS tjänsten. Detta kan ni göra på admin-sidan.*</p>
                            </td>
                        </tr>

                    </table>
                    <table width="330" style="background-color:#fff; padding-top:20px;">
                        <tr>
                            <?php if (!$bIsFromAdmin): ?>
                            <td width="200"><a href="javscript:void(0)" onclick="document.location.href='<?php echo BASE_DIR; ?>registrera/7'; return false;"><input type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_tillbaka.png" alt="Tillbaka" style="border:none;width:89px;height:35px;"/></a>
                            </td>
                            <td>
                                <a href="javascript:void(0)"><input name="vidare" type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_vidare.png" style="border: none; width: 89px; height: 35px;" alt="Gå vidare" id="gaVidare"/></a>
                            </td>
                            <?php else: ?>
                            <td width="200"><a href="javscript:void(0)" onclick="document.location.href='<?php echo BASE_DIR; ?>registrera/grattis'; return false;"><input type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_tillbaka.png" alt="Tillbaka" style="border:none;width:89px;height:35px;"/></a>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td colspan="2" width="330"><p style="font-size:11px; font-style:italic;">*SMS tjänsten kostar 99 öre exkl. moms per sms och debiteras föreningen kvartalsvis.</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div id="right">
                    <img class="hoger_bild" src="<?php echo BASE_DIR; ?>media/registrera/img/hoger_bild7.png" width="451" height="564" />
                </div>
            </div>
            <input type="hidden" name="step" value="<?php echo $iStep; ?>"/>
        </form>
    </body>
</html>
