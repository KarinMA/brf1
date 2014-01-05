<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Registrering, SvenskBrf.se</title>
        <link href="<?php echo BASE_DIR; ;?>media/registrering.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript">
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
                $(downloadName).val('downloadresourcedocument');
                return false;
            }
            function setHeight(addHeight) {
                var leftHeight = $("#left").height();
                var wrapperHeight = $("#wrapper").height();
                if (addHeight) {
                    leftHeight += addHeight;
                }
                if (leftHeight + 15 > wrapperHeight) {
                    $("#wrapper").height(leftHeight + 51);
                } else {
                }
            }
            
        </script>
        <style type="text/css">
            a img {border : none;}
        </style>
    </head>

    <body>
        <form method="post" action="<?php echo BASE_DIR; ?>/registrera/10">
            <div id="wrapper" style="min-height:700px;">
                <div id="left" style="margin-top:30px;">
                    <table width="335">
                        <tr>
                            <td style="background-color:#fff;">
                                <!--<img class="bla_rubrik" src="<?php echo BASE_DIR; ?>media/registrera/img/89_bild.png" width="345" height="63" />-->
                                <?php echo getHeaderPicture("<b style=\"font-weight: bold;\">9</b>/10. Informera", 'medlemmarna'); ?>
                                <p>Du har tidigare i den här registreringen skrivit ut eller sparat en pdf som ger medlemmarna i föreningen inloggnings-uppgifter och information om hur hemsidan kan användas.</p>

                                <!--<p>För att vara extra tydlig till era medlemmar så har vi skapat pdf:er nedan som beskriver hemsidans funktioner. Det är pdf:en vi kallat Anslagstavla och den kan med fördel sättas upp på er förenings anslagstavla.</p>-->

                                <p>Det har även skapats en pdf för varje lokal ni lagt till som bokningsbar. Dessa pdf:er kan skrivas ut och sättas upp som information till medlemmarna vid varje lokal.</p>
                                <br />
                                <br />
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <ul>
                                    <?php foreach ($oBrf->getResources() as $oResource): ?>
                                    <li><p><a style="float:left;" href="javascript:void(0)" onclick="getFile('<?php echo $oResource->getName(); ?>');"><img src="<?php echo BASE_DIR; ?>media/registrera/img/pdf.jpg" width="20" height="20" alt="pdf"/></a><span style="margin-left:40px;margin-bottom:10px;"><?php echo $oResource->getName(); ?></span></p></li>
                                    <?php endforeach; ?>
                                    <li><p><a style="float: left;" href="javascript:void(0)"  id="getPdf">Inloggningsuppgifterna</a></p></li>
                                </ul>
                            </td>
                        </tr>
                    </table>

                    <table width="330">
                        <tr>
                            <td>
                                <p>Klicka på länkarna för att öppna, spara och skriva ut dokumenten</p>
                             </td>  
                        </tr>
                    </table>
                    
                    <table width="330" style="background-color:#fff; padding-top:20px;">
                        <tr>
                            <td width="200"><a href="javscript:void(0)" onclick="document.location.href='<?php echo BASE_DIR; ?>registrera/8'; return false;"><input type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_tillbaka.png" alt="Tillbaka" style="border:none;width:89px;height:35px;"/></a>
                            </td>
                            <td>
                                <a href="javascript:void(0)"><input name="vidare" type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_vidare.png" style="border: none; width: 89px; height: 35px;" alt="Gå vidare" id="gaVidare"/></a>
                            </td>
                        </tr>
                    </table>
                </div>

                <div id="right">
                    <img class="hoger_bild" src="<?php echo BASE_DIR; ?>media/registrera/img/hoger_bild8.png" width="451" height="564" />
                </div>
            </div>
            <input type="hidden" name="step" value="<?php echo $iStep; ?>"/>
        </form>
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php" id="dlform"><input type="hidden" name="documentName" value=""/><input type="hidden" name="brfId" value="<?php echo $oBrf->getId(); ?>"/><input type="hidden" name="action" value="downloadresourcedocument"/></form>
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php" name="getpdfsform">
            <input type="hidden" name="action" value="getuserpdfs"/>
            <input type="hidden" name="brfId" value="<?php echo $oBrf->getId(); ?>"/>
        </form>
        <script type="text/javascript">
            $(document).ready(function(){
                setHeight((1+<?php echo $oBrf->getResources()->size(); ?>) * 10);
            });
        </script>
        <script type="text/javascript">
            $("#getPdf").click(function(){
               document.forms['getpdfsform'].submit();
               return false;
            });
        </script>
    </body>
    
</html>
