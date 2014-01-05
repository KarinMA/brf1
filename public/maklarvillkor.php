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
        <title>Svensk Brf - Villkor</title>
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
                        <h1>Villkor</h1>
                        <h6>Användarvillkor för Svenskbrf.se - Fastighetsmäklare</h6>
                        <p>Dessa villkor reglerar användandet av de tjänster som Nordisk Brf och Fastighetsservice AB med organisationsnummer 556901-3260 tillhandahåller genom Svenskbrf.se, nedan kallad Företaget, och den part som använder tjänsten, nedan kallad Användaren.</p>
                        <p>Villkoren gäller från och med 2013-10-01 och tills vidare.</p>
                        <h6>1 Tjänsten</h6>
                        <p>Vi vill skapa en trevlig grannsämja och spara tid åt styrelsen i bostadsrättsföreningar. På föreningens sida kommer det finnas flertalet funktioner som gör det enklare för en styrelse att sköta många av de uppgifter som en styrelsemedlem och medlem behöver göra som boende i en bostadsrättsförening. </p>
                        <p>Som Fastighetsmäklare så har man möjlighet att profilera sig i en annons på de föreningars hemsidor som är aktiverade. </p>
                        <h6>2 Användarkonto</h6>
                        <p>Ett användarkonto krävs för att du som Fastighetsmäklare ska kunna lägga upp dina uppgifter på Svenskbrf.se och med detta kunna skapa annonser i de föreningar du väljer att synas i. För att kunna skapa ett användarkonto krävs ett lösenord vilket du får från Företaget. </p>
                        <h6>3 Under utveckling</h6>
                        <p>Företaget är ständigt under utveckling vilket medför att nya funktioner sätts i drift successivt. Du får gärna komma med tips på hur vi kan förbättra tjänsten, vi värdesätter dina synpunkter! Maila oss gärna dina tips och förslag på <a href="mailto:kontakt@svenskbrf.se">kontakt@svenskbrf.se</a> </p>
                        <h6>4 Ordningsregler</h6>
                        <p>Vi på Företaget erbjuder en dynamisk och interaktiv samlingsplats för boende i bostadsrättsföreningar, det är ett öppet forum för bostadsrättsföreningars medlemmar i samverkan med fastighetsmäklare. Detta kräver dock att alla följer vissa enkla förhållningsregler. Om vi finner överträdelser mot företagets allmänna villkor kan vi varna användaren eller ta bort användaridentiteten utan förvarning. Det innebär att allt användaren har gjort försvinner. I allvarliga fall kan t.o.m. polisanmälan göras. Om det är gränsfall kan vi skicka ut varningar. Om man vill göra en anmälan av någon användare som man tycker bryter mot reglerna och t.o.m. lagen ska anmälan göras till Företaget.</p>
                        <h6>5 Allmänna regler</h6>
                        <p>För att tjänsten ska fungera på bästa sätt för alla inblandade parter så följer här allmänna regler för tjänsten. Följer du inte reglerna kan ditt användarkonto raderas.</p>
                        <p>Följande allmänna regler gäller när man är inloggad:</p>
                        <p class="list">
                            <span>&bull;&nbsp;Du måste givetvis följa Svensk lag när du använder tjänsten. Pornografi, främjande av droger och publicering av copyrightskyddat material är förbjudet på hela sajten. Du får inte använda tjänsten för olagliga aktiviteter eller för distribution av material som är olagligt eller som kan upplevas som stötande, t.ex. hets mot folkgrupp, trakasserier, mobbning, kedjebrev eller intrång på copyrightskyddat material. Då kan ditt användarkonto raderas, och om det är illa nog kan du t.o.m. bli polisanmäld. Länkningar till sajter som innehåller olagligt innehåll är att betrakta som olagligt. Användare som gör sådan länkning är direkt ansvarig för denna förseelse.<br /></span>
                            <span>&bull;&nbsp;Som föreningens mäklare uppmanas du att endast skicka relevanta meddelanden till medlemmarna kopplat med den tjänst ni tillhandahåller.<br /></span>
                            <span>&bull;&nbsp;Du får inte använda, kopiera eller skicka vidare användarinformation.<br /></span>
                            <span>&bull;&nbsp;Du får inte ladda upp virussmittade, pornografiska eller copyrightskyddade filer (t.ex. mp3-filer med kända artister), eller länka till pornografiska, rasistiska eller andra uppenbart olämpliga sajter.<br /></span>
                            <span>&bull;&nbsp;Alla försök till datorintrång i Företagets system polisanmäls.<br /></span>
                            <span>&bull;&nbsp;Missbruk av Företagets tjänster/funktioner är absolut förbjudet, t.ex. spam eller massmejl.<br /></span>
                            <span>&bull;&nbsp;Du får inte systematiskt sprida politisk eller religiös propaganda.<br /></span>
                            <span>&bull;&nbsp;Ditt lösenord är din nyckel till din förenings hemsida och du ansvarar för att ditt lösenord förblir din privata hemlighet.<br /></span>
                            <span>&bull;&nbsp;Om vi misstänker att du angett felaktiga uppgifter vid registreringen eller i inställningar kan ditt konto bli raderat.<br /></span>
                        </p>

                        <h6>6 Lagar</h6>
                        <p>Självklart gäller alla lagar även när man använder Företagets tjänster. Följande lagar kan betraktas som mer aktuella för internet:</p>
                        <p class="list">
                            <span>&bull;&nbsp;Lagen (1960:729) om upphovsrätt<br /></span>
                            <span>&bull;&nbsp;Brottsbalken 1962:700 uppvigling<br /></span>
                            <span>&bull;&nbsp;Brottsbalken 1962:700 barnpornografibrott<br /></span>
                            <span>&bull;&nbsp;Brottsbalken 1962:700 hets mot folkgrupp<br /></span>
                            <span>&bull;&nbsp;Brottsbalken 1962:700 olaga våldsskildring<br /></span>
                            <span>&bull;&nbsp;Brottsbalken 1962:700 ofredande<br /></span>
                            <span>&bull;&nbsp;Brottsbalken 1962:700 olaga hot<br /></span>
                            <span>&bull;&nbsp;Brottsbalken 1962:700 pornografisk bild<br /></span>
                            <span>&bull;&nbsp;Narkotikastrafflagen 1968:64 narkotikabrott<br /></span>
                        </p>
                        <p>Om Företaget får kännedom om grova otillåtna inlägg kan anmälan göras till operatör (t.ex. Telia) som då kan varna och även stänga ner internetabonnemanget.</p>
                        <p>Om Företaget eller någon användare gör polisanmälan kan åtal väckas. Brott mot någon av dessa lagar kan leda till olika typer av straff. Böter eller fängelse är de normala bestraffningarna beroende på brottets art.</p>
                        
                        <h6>7 Rättigheter du ger oss</h6>
                        <p>Som ägare av sajten www.svenskbrf.se har Företaget vissa rättigheter av funktionella, säkerhetsmässiga och även kommersiella skäl. Företaget har alltid för avsikt att använda dessa rättigheter på ett sätt som inte strider mot god sed.</p>
                        <p>Rättigheter som Företaget innehar:</p>
                        <p>Företaget har rättighet att kopiera, ändra, visa upp och distribuera material du publicerar "offentligt" (inte privata meddelanden) på Företagets hemsida eller på de aktiverade hemsidor tillhörande de bostadsrättsföreningar/bostadsföreningar där du har en aktiv annons. Detta kan ske i samband med marknadsföring av Företagets tjänster utan skyldighet att betala ersättning till Användaren.</p>
                        <p>För att se till att det inte förekommer trakasserier, pornografi, mobbing och andra olagliga eller ej önskvärda aktiviteter kommer våra anställda att ha full tillgång till ditt användarkonto för att undersöka eventuella klagomål och anmälningar.</p>
                        <p>Företaget har rätt att skicka information samt kommersiella budskap till användarna via föreningarnas respektive hemsidor och funktioner. Dessa kan vara anpassade efter din ålder eller hur du svarar på frågor. Användaren har rätt att tacka nej till nyhetsbrev. Vid marknadsundersökningar av tredje part kommer förfrågan alltid att ske via Företaget. Det statistiska materialet är inte knutet till enskilda personer och det leder inte till lägenhetsnummer, e-mailadresser, adresser eller annat som kan utnyttjas för spamming eller liknande.</p>
                        <p>Företaget har för avsikt att följa god sed vad det gäller marknadsföring och marknadsundersökningar.</p>
                        <p>Företaget har rätt att ha en fastighetsmäklarannons på hemsidan. I det fall fastighetsmäklaren på något sätt missbrukat föreningens förtroende så kan föreningen påkalla detta för Företaget. Företaget kan då besluta att ta bort denna annons för aktuell mäklare och sälja annonsplatsen till annan fastighetsmäklare.</p>
                        <p>Företaget har rätt att skicka information om företaget och från företagets samarbetspartners samt kommersiella budskap till användarna via e-post, SMS, MMS och andra elektroniska kommunikationssätt i samband med påminnelser och nyhetsbrev etc.</p>
                    </div>
                    <div class="hoger">
                        
                        <h6>8 Användaruppgifter</h6>
                        <p>Nordisk Brf och Fastighetsservice AB, organisationsnummer 556901-3260 , är personuppgiftsbiträde.</p>
                        <p>Företaget värnar om din personliga integritet. Vi prioriterar alltid skyddet av all information du anförtror oss och följer naturligtvis de lagar och regler som finns - t.ex. personuppgiftslagen - för att skydda din integritet.</p>
                        <p>Fakta om hur Företaget hanterar användaruppgifter:</p>
                        <p>Uppgifterna är nödvändiga för att användaren ska kunna använda sin förenings respektive hemsida och dess funktioner på återkommande basis.</p>
                        <p>Det kan bli aktuellt att Företaget överlåter statistiska uppgifter från tredje man inom och utanför EU/EES för marknadsförings- och marknadsundersökningsändamål. Dessa uppgifter kan inte härledas till den enskilde användaren.</p>
                        
                        <h6>9 Cookies - vad är det och vad används de till?</h6>
                        <p>Företaget använder cookies när du besöker denna webbsida. En cookie är en kort informationsfil som placeras i användarens dator. Företaget använder i första hand cookies för att du ska kunna skall kunna använda Företagets tjänster på bästa sätt.</p>
                        <p>Cookien kan inte identifiera dig personligen, endast den webbläsare som finns installerad på din dator och som du använder vid besöket.</p>
                        <p>Cookien innehåller inte virus och den kan inte heller förstöra annan information på din dator.</p>
                        <p>Företaget använder olika sorters cookies för olika ändamål:</p>
                        <p class="list">
                            <span>&bull;&nbsp;
                                <strong>Påloggnings-cookies</strong>
                                <br />
                                Påloggnings-cookies används för att kunna hantera användaren med så liten belastning som möjligt, vilket bl.a. görs genom att användaren kommer till samma server som tidigare.
                            <br /></span>
                            <span>&bull;&nbsp;
                                <strong>Naviverings-cookies</strong>
                                <br />
                                Navigerings-cookies används för att du enkelt ska kunna navigera på din förenings hemsida. Den registrerar vilken funktion användaren senast använde och vilken sida i denna användare senast befann sig på.
                            <br /></span>
                            <span>&bull;&nbsp;
                                <b>Annons-cookies</b>
                                <br />
                                Annons-cookies används för att kunna peka på kluster av ålder, postort och kön. Detta underlättar annonsering på internet och därmed finansiering av tjänster. Den innebär inte att den identifierar användaren personligen och har inget att göra med registrerade uppgifter i övrigt.
                            <br /></span>
                            <span>&bull;&nbsp;
                                <strong>Statistik-cookies</strong>
                            <br /></span>
                        </p>
                        
                        <p>Cookies lagras på din dator endast under så lång tid som anses nödvändigt för ändamålet.</p>
                        <p>Du har rätt att förhindra Företaget att lagra cookies på din dator, men du kan då inte, av funktionella skäl, använda företagets tjänster längre. Du kan också själv välja på vilken nivå du vill acceptera cookies för din webbläsare.</p>
                        <p>Medlemskap hos Svenskbrf.se kräver att Företaget registrerar ditt namn, adress och lägenhetsnummer. Syftet med denna registrering är att underlätta styrelsens administrativa arbete.</p>
                        <p>Företaget kommer inte att sälja dina användaruppgifter, som adress, telefon eller t.ex. e-mailadresser vidare till tredje part. Däremot så kan dessa komma att användas i kommersiellt syfte då alltid med dig som användares godkännande. </p>
                        <p>Användaren har rätt att en gång per år begära kostnadsfri information om kunduppgifterna, och kan när som helst återkalla lämnat samtycke. Du kan även begära att uppgifter tas bort eller ändras om de visar sig vara felaktiga eller ofullständiga.</p>
                        <p>Genom att acceptera reglerna samtycker användaren till den behandling av personuppgifter som beskrivits under punkt 8: Användaruppgifter.</p>
                        
                        <h6>10 Ändrade villkor</h6>
                        <p>Företaget har alltid rätt att ändra de allmänna villkoren om detta behövs för att följa lag och myndighetsbeslut. Vi uppmanar användarna att gå in på allmänna villkor för att se om eventuella ändringar gjorts. Om ändringar är av sådan karaktär att användandet av företagets tjänster förändras på ett betydande sätt kommer detta att meddelas till användarna. Företaget kommer aldrig att sälja personuppgifter, som t.ex. e-mailadresser. Genom att fortsätta använda företagets tjänster anses användaren ha godkänt förändrade regler och villkor. Om användare vill avsluta medlemskapet har användaren möjlighet att avregistrera sig.</p>
                        <p>Företaget kan vid var tid ändra prislistan för mäklarannonsen. Användaren kommer att bli informerad om detta med minimum 2 månaders varsel. Användaren kan då säga upp annonsplatsen innan prisändringen verkställts.</p>
                        <h6>11 Betalningsvillkor</h6>
                        <p>Kostnaden för mäklarannonser betalas kvartalsvis i förskott enligt gällande prislista. Betalningsvillkor 10 dagar. Förseningsränta diskonto +8% per år.</p>
                        <h6>12 Uppsägnin av annons</h6>
                        <p>Önskar Användaren avsluta en annons i en förening är uppsägningstiden 30 dagar. </p>
                        <h6>13 Föreningars möjlighet att avsluta en mäklarannons</h6>
                        <p>Föreningen har möjlighet att rapportera en fastighetsmäklare som de anser betett sig opassande eller i strid med användarvillkoren. Föreningen måste motivera för Företaget varför de vill stänga av en mäklarannons. I de fall Företaget anser att föreningens skäl är motiverade kan mäklarannonsen sägas upp med omedelbar verkan. Användaren måste betala för annonsen innevarande månad.</p>
                        <h6>14 Konkurrens</h6>
                        <p>Vid godkännandet av dessa villkor godkänner även Användaren att inte annonsera på andra hemsidor hos föreningar skapade av konkurrerande företag.</p>
                        <h6>15 Övrigt</h6>
                        <p>Användaren ansvarar för att informationen som läggs upp i profilen eller skickas till medlemmar är korrekt och uppdaterad. Företaget tar inget ansvar för den information Användaren själv lägger upp.</p>
                        <p>Som du säkert redan förstått blir meddelanden och text som du lägger in i din profil offentligt för alla inloggade besökare på de sidor där din annons som fastighetsmäklare syns.</
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