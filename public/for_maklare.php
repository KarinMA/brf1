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
        <title>Svensk Brf - För mäklare</title>
        <link href="<?php echo BASE_DIR; ?>media/css/stil.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-ui.js"></script>
        <link href="<?php echo BASE_DIR; ?>media/css/jquery-ui-1.10.3.custom.min.css" type="text/css" rel="stylesheet"/>
        <script src="<?php echo BASE_DIR; ?>media/js/jquery.placeholder.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/messi.min.js"></script>
        <link href="<?php echo BASE_DIR; ;?>media/js/messi.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
        /**
         * @param {type} message
         * @param {type} buttonText
         * @returns {undefined}
         */
        function showMessage(message, buttonText) {
            new Messi(
                message,
                {   
                    title: 'Svensk Brf', 
                    buttons: [{id: 0, label: buttonText, val: 'X'}]
                    ,center : true
                }
            );
        }
        </script>
    </head>

    <body>
        <div id="content">
            <?php include './startpage_header.php'; ?>
            <!-- Slut på Header --> 


            <div class="box"><!-- Det här är boxen för tjänster -->
                <div class="height">
                    <div class="vanster">
                        <h1>Till dig som är mäklare</h1>
                        <p><b>Arbetar du som fastighetsmäklare och strävar efter att lättare få kontakt med fler potentiella säljare? Vill du vara ett givet val när en lägenhet i en förening ska säljas? Det kan vi hjälpa dig med.</b></p>
                        <p>Vi har skapat hemsidor för Sveriges alla bostadsrätts- och bostadsföreningar. På föreningarnas hemsidor hittar du information om föreningen samt karta och gatubild. På varje sida finns också plats att presentera en mäklare med bild och text – vi kallar detta Mäklarboxen.</p>
                        
                        <p>Det är enkelt att bli en förenings exklusiva mäklare. Det enda du behöver göra är att presentera vår tjänst för en förening och få dem att komma igång med sin sida. Du får då möjlighet att synas på föreningens hemsida*. Vi kallar det att du är Föreningsmäklare.</p>
                        <h6 style="margin-bottom: 16px;">Fördelar med att vara Föreningsmäklare</h6>
                        <p class="list">
                            <!--
                            <li>&bull;&nbsp;Varje gång en medlem i föreningen går in på sin förenings hemsida syns du som Föreningsmäklare. Du blir Top of Mind för medlemmarna!<br /></li>
                            <li>&bull;&nbsp;Som Föreningsmäklare så vet medlemmarna att du kan föreningen (du kan endast vara föreningsmäklare om du eller företaget du jobbar på har sålt eller ska sälja i föreningen – något som många tycker är viktigt vid val av mäklare!<br /></li>
                            <li>&bull;&nbsp;Endast en mäklare kan synas på varje förenings hemsida<br /></li>
                            <li>&bull;&nbsp;När du har något till salu i föreningen så kan du lägga upp en objektsannons direkt på föreningens hemsida<br /></li>
                            <li>&bull;&nbsp;Du har direktkontakt med medlemmarna. Du kan lägga upp nya meddelanden på hemsidan när du t.ex. haft en lyckad försäljning i föreningen.<br /></li>
                            <li>&bull;&nbsp;Till skillnad från lappning så når du ALLA föreningens registrerade medlemmar.<br /></li>
                            -->
                            <ul class="lista">
                                <li class="lista">Varje gång en medlem i föreningen går in på sin förenings hemsida syns du som Föreningsmäklare. Du blir Top of Mind för medlemmarna!<br /></li>
                                <li class="lista">Som Föreningsmäklare så vet medlemmarna att du kan föreningen (du kan endast vara föreningsmäklare om du eller företaget du jobbar på har sålt eller ska sälja i föreningen – något som många tycker är viktigt vid val av mäklare!<br /></li>
                                <li class="lista">Endast en mäklare kan synas på varje förenings hemsida<br /></li>
                                <li class="lista">När du har något till salu i föreningen så kan du lägga upp en objektsannons direkt på föreningens hemsida<br /></li>
                                <li class="lista">Du har direktkontakt med medlemmarna. Du kan lägga upp nya meddelanden på hemsidan när du t.ex. haft en lyckad försäljning i föreningen.<br /></li>
                                <li class="lista">Till skillnad från lappning så når du ALLA föreningens registrerade medlemmar.<br /></li>
                            </ul>
                        </p>

                        
                        <!--<p>När du får en styrelse att aktivera sin hemsida så får du bli Föreningsmäklare i tre månader utan kostnad.</p>-->
                        <p style="margin-bottom: -5px;"><br />För att komma igång så fyll i dina kontaktuppgifter nedan. Vi återkommer då med mer information samt inloggningsuppgifter. Detta är helt kostnadsfritt.</p>
                        


                        <form class="tipsa_form" action="" method="post">
                            <p class="text">
                                <label for="realtorFrom">Ditt namn:</label>
                                <br />
                                <input type="text" name="realtorform[from]" class="form" id="realtorFrom" placeholder="Ditt namn"/>
                            </p>
                            
                            <p class="text">
                                <label for="realtorEmail">Din e-postadress:</label>
                                <br />
                                <input type="text" name="realtorform[email]" class="form" id="realtorEmail" placeholder="Din e-postadress"/>
                            </p>
  
                            <p class="text">
                                <label for="realtorPhone">Ditt telefonnummer (företag):</label>
                                <br />
                                <input type="text" name="realtorform[phone]" class="form" id="realtorPhone" placeholder="Ditt telefonnummer"/>
                            </p>
  
                            <br />
                            <br />

                            <p class="text2">
                                <label for="realtorMessage">Meddelande:</label>
                                <br />
                                <textarea cols="30" rows="10" class="text_ram" id="realtorMessage" style="resize: none; padding: 15px;" name="realtorform[message]" placeholder="Meddelande"></textarea>
                            </p>
                            <input type="image" class="skicka" src="<?php echo BASE_DIR; ?>media/start/img/skicka.png"/>
                            <input type="hidden" name="action" value="realtorform"/>
                        </form> 
                        <p>&nbsp;</p>
                        <p><a href="javascript:void(0)" onclick="history.back(); return false;">&lt;&lt; Tillbaka</a></p>
                    </div>
                    <div class="hoger">
                        <h1>&nbsp;</h1>
                        <!--<p>Du kan endast bli föreningens exklusiva mäklare i de föreningar där det mäklarföretag du arbetar för har sålt eller snart kommer att sälja ett objekt. Detta för att säkerställa att du är inläst och kunnig om föreningen i fråga.</p>-->
                        <p><img width="371" height="421" alt="hemsida" src="media/start/img/for_maklare3.png"/><i>Så här ser den nya hemsidan ut!</i></p>

                        <h6 style="margin-bottom: 16px;">Nå fler säljare på ett unikt sätt!</h6>
                        <p>Som föreningens mäklare når du, på ett kostnadseffektivt sätt, ut till föreningars medlemmar och styrelse. Du kommer även att synas på föreningens hemsida.</p>
                        <p>På så sätt så får du som mäklare en unik möjlighet till direktkommunikation med föreningens medlemmar. Det blir således mycket mer effektivt än vanlig lappning (du når samtliga registrerade medlemmar via mejl) och även de som har Ej reklam på dörren (ca 30% av alla brevlådor). Detta till en lägre kostnad än vad det skulle kosta att få samma exponering genom lappning. Se aktuell prislista nedan i PDF-format.</p>
                        <h6 style="margin-bottom: 16px;">3 månader gratis!</h6>
                        <p>När du hjälpt oss att aktivera en förening så får du de första 3 månaderna gratis för att sedan få möjlighet att förlänga din profil. Vi ser fram emot att ha dig som en av våra anslutna mäklare!</p>
                        <p>&nbsp;</p>
                        <p>Om du hittar en förening som redan aktiverat sin hemsida hos oss men inte har en mäklare ansluten så kontaktar du oss på <a href="maklare@svenskbrf.se">maklare@svenskbrf.se</a> om ditt önskemål att bli Föreningsmäklare.</p>
                        <p><i>*Observera att du endast kan bli föreningsmäklare i de föreningar där du eller det mäklarföretag du arbetar för har sålt eller snart kommer att sälja ett objekt.</i></p>
                        <p>&nbsp;</p>
                        
                        
                        
                        
                        <h6 style="margin-bottom: 16px;">Klicka på länkarna nedan för mer information</h6>
                        <p><a href="javascript:void(0)" onclick="$('#dlform').submit(); return false;">Information för mäklare (PDF)</a></p>
                        <p><a href="javascript:void(0)" onclick="$('#dlform1').submit(); return false;">Prislista (PDF)</a></p>
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
            var formFields = {
                'realtorFrom' : 'Fyll i Från-fältet',
                'realtorMessage' : 'Fyll i meddelande-fältet'
            };
            $("input.skicka").click(function() {
                var formFields = {
                    'realtorFrom' : 'Fyll i ditt namn',
                    'realtorEmail' : 'Fyll i din e-postadress',
                    'realtorPhone' : 'Fyll i ditt telefonnummer',
                    'realtorMessage' : 'Fyll i meddelande-fältet'
                };
                
                for (var field in formFields) {
                    if ($.trim($("#" + field).val()).length === 0) {
                        alert(formFields[field]);
                        $("#"+field).focus();
                        return false;
                    } 
                }
                
                $.post("<?php echo BASE_DIR; ?>ajax.php", $("form.tipsa_form").serialize(), function (response) {
                    if (response.result) {
                        for (var field in formFields) {
                            <?php if (!TEST): ?>
                            $("#" + field).val('');
                            <?php endif; ?>
                        }
                        showMessage('Meddelandet skickades. Vi kommer snart att kontaka dig. Mvh Svensk Brf', 'OK');
                    } else {
                        showMessage('Meddelandet kunde inte skickas. Maila oss på maklare@svenskbrf.se', 'OK');
                    }
                }, 'json');
                return false;
            });
            
            var placeHolderSelector = "";
            for (var field in formFields) {
                placeHolderSelector += "#" + field + ",";
            }
            if (placeHolderSelector.length > 0) {
                placeHolderSelector = placeHolderSelector.substring(0, placeHolderSelector. length - 1);
            }
            $(placeHolderSelector).placeholder();
            
        </script>
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php" id="dlform"><input type="hidden" name="documentName" value="for_maklare.pdf"/><input type="hidden" name="action" value="downloadtemplate"/></form>
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php" id="dlform1"><input type="hidden" name="documentName" value="prislista.pdf"/><input type="hidden" name="action" value="downloadtemplate"/></form>
    </body>
</html>
<?php include 'unsetup.php'; ?>