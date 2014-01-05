<?php include 'setup.php'; ?>
<?php
$aStartPageContentPieces = array(
    'search_header',
    'contact_info',
    'header',
    'logo_tagline',
);
$aStartPageContent = array();
foreach ($aStartPageContentPieces as $sContentPiece) {
    $aStartPageContent[$sContentPiece] = isset($bEditView) ? trim($_POST['content'][$sContentPiece]) : getStartpageAccessor()->getStartpageByName($sContentPiece)->getContent();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Svensk Brf - Lär dig mer</title>
        <link href="<?php echo BASE_DIR; ?>media/css/stil.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-ui.js"></script>
        <script src="<?php echo BASE_DIR; ?>media/js/jquery.placeholder.js" type="text/javascript"></script>
        <link href="<?php echo BASE_DIR; ?>media/css/jquery-ui-1.10.3.custom.min.css" type="text/css" rel="stylesheet"/>
    </head>

    <body>
        <div id="content">

            <?php include './startpage_header.php'; ?>
            <!-- Slut på Header --> 


            <div class="box"><!-- Det här är boxen för tjänster -->
                <div class="height">
                    <div class="vanster">
                        <h1>Lär dig mer</h1>
                        <p>Vi på Svensk Brf vill förenkla livet för styrelsemedlemmar och boende i bostadsrätts- och bostadsföreningar. Med en av marknadens bästa plattformar för ändamålet kan vi erbjuda alla sådana föreningar en hemsida och intranät med många användbara funktioner.</p>
                        <h6>För medlemmarna</h6>
                        <p> Som medlem kan du med hjälp av plattformen lätt kommunicera med dina grannar och med din styrelse. Du kan boka  tvättstugan, uteplatsen eller lokaler i mobilen. Du kan om du vill få en sms-påminnelse så att du inte glömmer bort din bokning.</p>
                        <p>Det finns möjlighet att skapa en egen medlemsprofil i intranätet. Vi tror att medlemsprofiler kan vara ett trevligt sätt att lära känna grannar och få en bra stämning i en förening. Att skicka ett meddelande till grannen kan ibland vara närmare till hands än att ringa på dörren.</p>
                        <h6>För styrelsen</h6>
                        <p> Hemsidan underlättar styrelsens kommunikation med medlemmarna genom att erbjuda en tjänst för sms-påminnelser vid viktiga händelser och en kalenderfunktion där styrelsen kan skriva in vad som är på gång i föreningen. </p>
                        <p>Styrelsen har också en loggfunktion som inte är synlig för övriga medlemmar. Här kan styrelsen för anteckningar och spara viktiga dokument. Syftet med detta är att en ny ordförande kan ta över denna logg och därmed snabbt sätta sig in i vad som tidigare skett i föreningen.</p>
                        <h6>En trygg och säker tjänst</h6>
                        <p>Vi värnar självklart om våra medlemmars integritet och kommer inte att sprida eller sälja personlig information om våra medlemmar till tredje part.  Vi kommer inte heller att dela med oss av den information som specifikt rör föreningen och dess fastighet utan att ha föreningens uttryckliga godkännande. Vi tillämpar strikt personuppgiftslagen (PUL).</p>
                        <!--<h6>Gemensamma upphandlingar</h6>
                        <p> Vår ambition är att så många föreningar som möjligt skall se fördelen med att finnas på nätet. I förlängningen  kommer vi erbjuda gemensamma upphandlingar i allt från renoveringar till olika abonnemang &ndash; allt för att spara pengar för föreningen. Man kommer även kunna ta del av erbjudanden från olika lokala näringsidkare.</p>-->
                        <p>&nbsp;</p>
                        <p><a href="javascript:void(0)" onclick="history.back(); return false;">&lt;&lt; Tillbaka</a></p>
                    </div>
                    <div class="hoger">
                        <h1>&nbsp;</h1>

                        <p><img width="380" height="330" alt="bild" src="<?php echo BASE_DIR; ?>media/start/img/ny_hemsida.png"><i>Så här ser den nya hemsidan ut!</i></p>
                        <h6>Föreningsmäklare</h6>
                        <p>Varje förening kommer att få en föreningsmäklare. Tanken med detta är att en fastighetsmäklare som sålt eller säljer i föreningen har en egen informationsruta på hemsidan. Föreningsmäklaren underlättar för medlemmar som vill få bostaden värdering eller få hjälp med försäljning. Föreningsmäklaren finns också till för externa intressenter som fundera på att köpa en bostad i föreningen.</p>
                        <h6>Allt under samma tak</h6>
                        <p>Vår vision är att göra livet enklare för såväl boende i en förening samt de förtroendevalda styrelsemedlemmarna genom att samla en stor mängd viktig information och tjänster under ett och samma tak.</p>
                        <p>Vi kommer löpande bygga på med nya funktioner och tjänster - allt för att tillföra värde för såväl medlemmarna som styrelsen i alla Sveriges bostadsrätts- och bostadsföreningar. Och det bästa av allt är att tjänsten är GRATIS!</p>
                    </div>
                </div>
                <br class="clear"/>
                <div class="bottenmarginal"></div>
            </div>
            <!-- slut på tjanster -->



            <?php include './startpage_footer.php'; ?>


        </div><!-- slut på content -->
        <script type="text/javascript">
<?php include './startpage_autocomplete.php'; ?>
        </script>
    </body>
</html>
<?php include 'unsetup.php'; ?>