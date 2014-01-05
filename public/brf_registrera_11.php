<?php
    // for brf_loggedin.php
    $_SESSION['sendRegisterMail'] = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Guide, svensk brf</title>
        <link href="<?php echo BASE_DIR; ?>media/registrering.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript">
            function getFile(file, resource)
            {
                var docName = $("#dlform").find("input").eq(0);
                $(docName).val(file);
                $("#dlform").submit();
                $(docName).val('');
                return false;
            }
            function getResourceFile(file)
            {
                var docName = $("#dlform1").find("input").eq(0);
                $(docName).val(file);
                $("#dlform1").submit();
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
            ul {
                /*list-style-type: circle;*/
            }
            li {
                font-family: 'Open Sans',sans-serif;
                font-size: 13px;
                margin-bottom: 5px;
            }
        
        </style>
    </head>

    <body>
        <div id="wrapper" style="min-height:800px;">
            <div id="left" style="margin-top:30px;">
                <table width="300">
                    <tr>
                        <td>
                            <img class="bla_rubrik" src="<?php echo BASE_DIR; ?>media/registrera/img/Grattis.png" width="345" height="63" /><br/>
                            <br />
                            <p>
                                <!--Nu är du nästan klar med registreringen!-->
                                Nu är aktiveringsprocessen klar!
                                <!--<br />
                                <a href="<?php echo BASE_DIR; ?>villkor" target="_blank">Läs igenom</a> 
                                de villkor som gäller för sidan och bocka sedan i rutan nedan.-->
                            </p>
                            <p>
                                Ni kan nu börja använda hemsidan. För att nyttja alla funktioner på bästa sätt så bör ni även skriva en presentationstext för föreningen, lägga upp bokningsbara utrymmen och ladda upp de dokument som ni tycker ska vara tillgängliga för medlemmarna. Detta görs under styrelseadmin när ni är inloggad som styrelsemedlem. Om ni önskar göra det nu så kan ni klicka på länkarna nedan. 
                            </p>
                            <p>
                                <ul>
                                    <li><br /><a href="<?php echo BASE_DIR; ?>registrera/4/r">Aktivera föreningens bokningsbara utrymmen</a><br /></li>
                                    <li><a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/dokument/laddaupp">Ladda upp dokument</a><br /></li>
                                    <li><a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/admin/presentation">Skriv en presentationstext</a><br /></li>
                                    <li><a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/admin/bilder">Ladda upp bilder</a><br /></li>
                                </ul>
                            </p>
                            <p>
                                Vill du passa på att läsa lite om de funktioner på hemsidan så kan du klicka på länkarna nedan. 
                            </p>
                            <p>
                                <ul>
                                    <li><br /><a href="<?php echo BASE_DIR; ?>registrera/6">Information om meddelandefunktionen</a><br /></li>
                                    <li><a href="<?php echo BASE_DIR; ?>registrera/7">Information om kalendern</a><br /></li>
                                    <li><a href="<?php echo BASE_DIR; ?>registrera/8">Information om SMS-tjänsten</a><br /></li>
                                </ul>
                            </p>
                            <p>&nbsp;</p>
                            <p>
                                <a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>">Klicka här för att komma till er nya hemsida! &gt;&gt;</a>
                            </p>
                            <!--<p><a href="<?php echo BASE_DIR; ?>villkor" target="_blank">Användarvillkor</a></p>
                            <form>
                                <p>
                                    <input type="checkbox" value="villkor" name="villkor" id="villkor"/>
                                    <label for="villkor">Jag godkänner villkoren</label>
                                </p>
                                <br />
                            </form>
                            <p><a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>" onclick="if ($('#villkor').is(':checked')) { return true; } else { alert('Du måste godkänna Svensk Brfs villkor.'); return false; }">Klicka här för att komma till er nya hemsida! &gt;&gt;</a></p>
                            <p>Du kommer alltid att kunna gå tillbaka till den här registreringen för att uppdatera och ändra när du är inloggad på din sida.<br/><br/>
                                Nedan finns alla pdf:er som skapats för att underlätta för dig som styrelsemedlem. Detta gör du via styrelsens adminsida som du hittar i menyn nere till vänster. Behöver du hjälp så finns svar på de flesta frågor under menyvalen Hjälp / FAQ och Styrelse / FAQ som du också hittar till vänster.</p>
                            -->
                        </td>
                    </tr>
                </table>
                <?php if (FALSE): ?>
                <table>
                    <tr>
                        <td>
                            <ul>
                                <li><p><a href="javascript:void(0)" id="getPdf"><img src="<?php echo BASE_DIR; ?>media/registrera/img/pdf.jpg" width="20" height="20" alt="pdf" /></a><span style="margin-left:20px;">Användaruppgifter</span></p></li>
                                <!--<li><p><a href="javascript:void(0)" onclick="return getTemplate('template_anslagstavla.pdf');"><img src="<?php echo BASE_DIR; ?>media/registrera/img/pdf.jpg" width="20" height="20" alt="pdf" /></a><span style="margin-left:20px;">Anslagstavla</span></p></li>-->
                                <?php foreach ($oBrf->getResources() as $oResource): ?>
                                <li><p><a href="javascript:void(0)" onclick="return getResourceFile('<?php echo $oResource->getName(); ?>')"><img src="<?php echo BASE_DIR; ?>media/registrera/img/pdf.jpg" width="20" height="20" alt="pdf" /></a><span style="margin-left:20px;"><?php echo $oResource->getName(); ?></span></p></li>
                                <?php endforeach; ?>
                            </ul>
                        </td>

                    </tr>
                </table>
                <?php endif; ?>
                <p>Varmt välkommen till Svensk Brf!</p>



            </div>
            <div id="right" style="margin-top: 20px;">
                <img class="hoger_bild" style="margin-top:140px; margin-left:50px;" src="<?php echo BASE_DIR; ?>media/registrera/img/steg10_bild.png" width="350" height="320"/>
            </div>

        </div>
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php"  id="dlform"><input type="hidden" name="documentName" value=""/><input type="hidden" name="brfId" value="<?php echo $oBrf->getId(); ?>"/><input type="hidden" name="action" value="downloadresourcedocument"/></form>
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php">
            <input type="hidden" name="action" value="getuserpdfs"/>
            <input type="hidden" name="brfId" value="<?php echo $oBrf->getId(); ?>"/>
        </form>
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php" id="dlform1"><input type="hidden" name="documentName" value=""/><input type="hidden" name="brfId" value="<?php echo $oBrf->getId(); ?>"/><input type="hidden" name="action" value="downloadresourcedocument"/></form>
        <script type="text/javascript">
            $("#getPdf").click(function(){
               document.forms[2].submit();
               return false;
            });
        </script>
    </body>
</html>