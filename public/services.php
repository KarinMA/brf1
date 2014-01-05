<?php
// any action?
switch ($sAction) {
    case 'test_services':
        $bEditView = TRUE;
        break;
    default:
        break;
}


$aServicesContentPieces = array(
        // pieces
        'services_homepage',
        'services_booking',
        'services_pictures',
        'services_document',
        'services_contract',
        'services_calendar',
        'services_smsmail',
        'services_msgboard',
);
$aStartPageContentPieces = array_merge(array(
    'logo_tagline',
    'search_header',
    'contact_info'
), $aServicesContentPieces, $aServicesContentPieces);

$aStartPageContent = array();
foreach ($aStartPageContentPieces as $sContentPiece) {
    $aStartPageContent[$sContentPiece] = isset($bEditView) ? trim($_POST['content'][$sContentPiece]) : getStartpageAccessor()->getStartpageByName($sContentPiece)->getContent();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Svensk Brf - Tjänster</title>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_DIR; ?>media/css/stil.css"/>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-ui.js"></script>
        <script src="<?php echo BASE_DIR; ?>media/js/jquery.placeholder.js" type="text/javascript"></script>
        <link href="<?php echo BASE_DIR; ?>media/css/jquery-ui-1.10.3.custom.min.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>
        <div id="content">
            <?php include './startpage_header.php'; ?> 

            <div class="box" id="hemsida"><!-- Det här är boxen för tjänster -->
                <div class="height">
                    <div class="vanster">
                        <h1>GRATIS HEMSIDA</h1>
                        <p><?php echo nl2br($aStartPageContent['services_homepage']); ?></p>
                        <h6>Kostnadsfri hemsida &amp; intra-nät</h6>
                        <p>Med Svensk Brfs internetlösning så kommer föreningen underlätta kommunikationen i föreningen men framförallt förenkla arbetet för styrelsen. Styrelsen slipper springa runt och dela ut lappar, påminna medlemmar om olika datum och jaga de som inte dyker upp. Istället så läggs allt upp på intranätet och påminnelser skickas enkelt ut via mejl eller sms. Svensk Brf kommer kontinuerligt förbättra tjänsterna och utöka nyttan för styrelsen. Allt för att det ska bli enklare, mer effektivt och med kostnadsbesparingar för föreningen.</p>
                        <p>Svensk Brf kan tillhandahålla detta kostnadsfritt eftersom tjänsten sponsras av annonsörer och sponsorer.</p>
                    </div>
                    <div class="hoger">
                        <h1>&nbsp;</h1>
                        <p><img width="250" height="233" alt="hemsida" src="<?php echo BASE_DIR; ?>media/start/img/hemsida.png" style="margin-left: 65px;"></p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                    </div>
                </div>
                <br class="clear"/>
                <div class="bottenmarginal"></div>
            </div>

            
            
            
            <div class="box" id="bokningar"><!-- Det här är boxen för tjänster -->
                <div class="height">
                    <div class="vanster">
                        <h1>BOKNINGAR</h1>
                        <p><?php echo nl2br($aStartPageContent['services_booking']); ?></p>
                        <h6>Missa inte tvättstugan igen</h6>
                        <p>Samtliga medlemmar kan även på ett tydligt sätt se vilka tider som är bokade och vilka regler som gäller. Utöver det så kan styrelsen bestämma vilka dagar som bokas genom nätet. Det vill säga så kan man bestämma om man fortfarande vill att några dagar som bokas på samma sätt man gjort tidigare, tex via en lapp på dörren till tvättstugan. Styrelsen bestämmer även mellan vilka tider utrymmen kan bokas, vilket tidsintervall som gäller och hur många bokningar en medlem kan ha samtidigt.</p>
                    </div>
                    <div class="hoger">
                        <p><img width="380" height="480" alt="bokning" src="<?php echo BASE_DIR; ?>media/start/img/hoger_bild4.png"></p>
                    </div>
                </div>
                <br class="clear"/>

                <div class="bottenmarginal"></div>
            </div>

            
            <div class="box" id="styrelsen"><!-- Det här är boxen för tjänster -->
                <div class="height">
                    <div class="vanster">
                        <h1>STYRELSELOGG</h1>
                        <p>Det finns även en funktion där styrelsen smidigt kan föra en logg på händelser eller möten i föreningen som kanske inte protokollförts. Här kan även styrelsen lägga upp dokument som bara ska vara tillgängliga för styrelsen</p>
                        <h6>Låt inget falla mellan stolarna</h6>
                        <p>På detta sätt så är det enkelt att organisera styrelsearbetet men även enklare för nya styrelsemedlemmar att sätta sig in i vad som hänt innan de kom med i styrelsen. Det hjälper styrelsen att undvika att information missas eller tappas bort. För styrelsen finns även en egen kalender där styrelsen kan lägga in möten som bara berör styrelsemedlemmarna.</p>
                    </div>
                    <div class="hoger">
                        <p><img width="380" height="477" alt="bild_styrelsen" src="<?php echo BASE_DIR; ?>media/start/img/hoger_bild8.png"></p>
                    </div>
                </div>
                <br class="clear"/>


                <div class="bottenmarginal"></div>
            </div>

            <div class="box" id="medlemsprofil"><!-- Det här är boxen för tjänster -->
                <div class="height">
                    <div class="vanster">
                        <h1>MEDLEMSPROFIL</h1>
                        <p>För att medlemmarna ska lära känna varandra lite bättre så finns det möjlighet att beskriva sig själv, lägga upp en bild och information om vem man bor med. Dessutom så kan man lägga till kontaktuppgifter här så att man kan nås om det behövs.</p>
                        <h6>Lär känna din granne</h6>
                        <p>Alla har väl någon gång undrat över vem som bor mittemot och vad hon eller han har för intressen eller jobbar med. Det kan vara trevligt för en ny medlem att få en snabb överblick vilka andra som bor i huset. Dessutom så blir det lätt att skicka ett meddelande eller ett sms om man vill ha kontakt av någon orsak. Vi tror det kommer leda till en trevligare förening och boendemiljö!</p>
                    </div>
                    <div class="hoger">
                        <h1></h1>
                        <p><img width="380" height="477" alt="bild_styrelsen" src="<?php echo BASE_DIR; ?>media/start/img/hoger_bild2.png"/></p>
                    </div>
                </div>
                <br class="clear"/>
                <div class="bottenmarginal"></div>
            </div>

            
            
            <div class="box" id="smsmail"><!-- Det här är boxen för tjänster -->
                <div class="height">
                    <div class="vanster">
                        <h1>SMS/Mail</h1>
                        <p><?php echo nl2br($aStartPageContent['services_smsmail']); ?></p>
                        <h6>Missa inte ett möte igen</h6>
                        <p>Med denna tjänst så slipper föreningen extra kostnader för hantverkare som måste komma ut gång på gång för att medlemmar kanske glömt bort att vara på plats. Medlemmarna kommer även själva ha möjlighet att kommunicera direkt med andra medlemmar via mejl eller sms. Eller skicka ett mejl till alal i föreningen om man tex ska ha en fest som kan bli lite högljudd.</p>
                    </div>
                    <div class="hoger">
                        <h1></h1>
                        <p><img width="380" height="478" alt="bild för sms och mail" src="<?php echo BASE_DIR; ?>media/start/img/hoger_bild7.png"></p>
                    </div>
                </div>
                <br class="clear"/>


                <div class="bottenmarginal"></div>
            </div>
            
            

            <div class="box" id="kalender"><!-- Det här är boxen för tjänster -->
                <div class="height">
                    <div class="vanster">
                        <h1>KALENDER</h1>
                        <p><?php echo nl2br($aStartPageContent['services_calendar']); ?></p>
                        <h6>Snabb överblick</h6>
                        <p>Med kalendern så slipper medlemmarna ringa styrelsen eller fråga grannar. Det är lätt att gå in och titta på vad som händer i föreningen. När en händelse är inlagd så markeras dagen i rött. Endast styrelsen kan lägga in händelser i kalendern.</p>
                    </div>
                    <div class="hoger">
                        <p><img width="380" height="482" alt="bild för kalender" src="<?php echo BASE_DIR; ?>media/start/img/hoger_bild6.png"></p>
                    </div>
                </div>
                <br class="clear"/>


                <div class="bottenmarginal"></div>
            </div>

            


            <div class="box" id="dokument"><!-- Det här är boxen för tjänster -->
                <div class="height">
                    <div class="vanster">
                        <h1>DOKUMENT</h1>
                        <p><?php echo nl2br($aStartPageContent['services_document']); ?></p>
                        <h6>Effektiv dokumenthantering</h6>
                        <p>Styrelsen kan då undvika att en medlem kan påstå att de inte fått information som tex protokoll från en årsstämma eller liknande. Styrelsen kan även enkelt välja om dokumentet de lagt upp ska vara tillgängligt på den offentliga sidan eller bara för föreningens medlemmar. För medlemmarnas del så underlättar det att alltid ha tillgång till dokument som är av vikt för en boende. </p>
                    </div>
                    <div class="hoger">
                        <p><img width="380" height="478" alt="bild" src="<?php echo BASE_DIR; ?>media/start/img/hoger_bild3.png"></p>
                    </div>
                </div>
                <br class="clear"/>


                <div class="bottenmarginal"></div>
            </div>

            

            <div class="box" id="anslagstavla"><!-- Det här är boxen för tjänster -->
                <div class="height">
                    <div class="vanster">
                        <h1>ANSLAGSTAVLA</h1>
                        <p><?php echo nl2br($aStartPageContent['services_msgboard']); ?></p>
                        <h6>Nu börjar renoveringen</h6>
                        <p>Nu slipper medlemmarna sätta upp lappar som rivs ner eller förfular trapphuset. Det är lätt att lägga upp en ny händelse på anslagstavlan och alla nya inlägg rödmarkeras så att det är enkelt för medlemmar att uppmärksamma nya händelser. Man kan även lägga till en bild om man så önskar. Styrelsen kan självklart plocka bort opassande inlägg.</p>
                    </div>
                    <div class="hoger">
                        <p><img width="380" height="476" alt="bild, anslagstavla" src="<?php echo BASE_DIR; ?>media/start/img/hoger_bild5.png"/></p>
                    </div>
                </div>
                <br class="clear"/>


                <div class="bottenmarginal"></div>
            </div>




            <!--
            <div class="box" id="upphandling">
                <div class="height">
                    <div class="vanster">
                        <h1>UPPHANDLING</h1>
                        <p><?php echo nl2br($aStartPageContent['services_contract']); ?></p>
                        <h6>Spara pengar</h6>
                        <p>Med fler aktiverade föreningar så kommer vi på Svensk Brf få möjlighet att erbjuda bättre priser på tex el, försäkringar, teknisk förvaltning, städning etc. Med andra ord så är kan det löna sig för en förening att aktivera sin sida hos oss. Självklart är det helt valfritt om man sen väljer att ta del av erbjudandet eller inte. </p>
                    </div>
                    <div class="hoger">
                        <h1></h1>
                        <p><img width="393" height="316" alt="bild, anslagstavla" src="<?php echo BASE_DIR; ?>media/start/img/upphandling.png"/></p>
                    </div>
                </div>
                <br class="clear"/>


                <div class="bottenmarginal"></div>
            </div>
            -->



            <div class="box" id="bildbank"><!-- Det här är boxen för tjänster -->
                <div class="height">
                    <div class="vanster">
                        <h1>BILDBANK</h1>
                        <p><?php echo nl2br($aStartPageContent['services_pictures']); ?></p>
                        <h6>Visa bilder från gårdsfesten</h6>
                        <p>På den offentliga sidan så finns ett bildspel där man kan lägga upp 4 bilder. På den inloggade sidan så kan man lägga upp ett obegränsat antal bilder från tex gårdsfester eller från vad trädgårdsgruppen åstadkommit. Inom snar framtid så kommer vi lägga till ett mappsystem så att man kan organisera föreningens bilder på ett bra sätt.</p>
                    </div>
                    <div class="hoger">
                        <p><img width="380" height="475" alt="bildbank" src="<?php echo BASE_DIR; ?>media/start/img/hoger_bild1.png"></p>
                    </div>
                </div>
                <br class="clear"/>


                <div class="bottenmarginal"></div>
            </div>





          

                <?php include './startpage_footer.php'; ?> 
        </div>
        <script type="text/javascript">
<?php include './startpage_autocomplete.php'; ?>
        </script>
    </body>
</html>
