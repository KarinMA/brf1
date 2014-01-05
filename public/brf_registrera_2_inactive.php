<div id="left" style="margin-top:30px;">
    <!--<img class="bla_rubrik" src="<?php echo BASE_DIR; ?>media/registrera/img/29_bild.png" width="328" height="39" />-->
    <?php echo getHeaderPicture("<b style=\"font-weight: bold;\">2</b>/3. Användaruppgifter"); ?>
    <table width="335">
        <tr>
            <td style="background-color:#fff;">
                <br />
                <!--<p>Nästa steg är att ge föreningens medlemmar möjlighet att själva registrera sig och skapa en egen profil.</p>-->
                <p>Nästa steg är att ge föreningens medlemmar möjlighet att registrera sig själva.</p>
                
                <!--<p>Nedan finns en pdf som innehåller inloggningsuppgifter för <b>alla</b> hushåll i din förening. Den behöver du skriva ut så att varje medlem får ett häfte om tre sidor – En sida med registreringsuppgifter samt två sidor användarmanual. Det spelar ingen roll vem som får vilket lösenord.<br />
                    Tänk på att alla sidor ligger i samma pdf så att du enkelt kan skriva ut dem.
                </p>-->
                
                <p>
                    <b>Dela ut lösenord</b>
                    <br />
                    Nedan finns en pdf som innehåller inloggningsuppgifter till alla medlemmar i din förening. Den behöver du skriva ut och dela ut till medlemmarna. Tänk på att det inte spelar någon roll vem som får vilket lösenord. Det vill säga att du kan dela ut vilket som helst av dokumenten till vilken som helst av medlemmarna.
                </p>
                
                
                
                <!--<p>Klicka på pdf-länken nedan.</p>-->
                <!--<p>Om du istället vill mejla dina medlemmar så finns en zip-fil längre ned med <?php echo $oBrf->getApartments(); ?> separata pdf:er som du kan spara och sedan mejla. </p>-->
                <!--<p>Det spelar ingen roll vem som får vilket lösenord. Det vill säga att du kan dela ut eller mejla vilket som helst av dokumenten till vilken som helst av medlemmarna.</p>-->

                <p>&nbsp;</p>
                <p><a id="getPdf" href="javascript:void(0)"><img style="margin-left:120px; border:none;" src="<?php echo BASE_DIR; ?>media/registrera/img/pdf.jpg" width="50" height="50" alt="pdf" /></a></p>
                <p>&nbsp;</p>
                
                <!--<p style="color:red;">Öppna PDF-dokumentet nedan och välj ett av lösenorden för dig själv redan nu. Du kommer behöva fylla i det senare i registreringsprocessen.</p>-->
                <!--<p>Klicka på pdf-ikonen ovan och skriv ut dokumentet. <b>Välj sedan ett av lösenorden för dig själv redan nu. Du kommer behöva fylla i det senare i registreringsprocessen.</b></p> 
                <br />
                <p style="font-size:14px;"><i><u>Mejl-utskick?</u></i></p>
                <p>Vill du istället mejla dina medlemmar deras registreringsuppgifter? Klicka och öppna zip-filen nedan. I den finns <?php echo $oBrf->getApartments(); ?> separata pdf:er som du sedan kan mejla ut separat till varje medlem.</p>-->
                
                <p>
                    <b>Mejla ut lösenord</b>
                    <br />
                    Om du istället vill mejla dina medlemmar så finns en zipfil längre ned med <?php echo $oBrf->getApartments(); ?> separata pdf:er som du kan spara och sedan mejla.
                </p>
                
                <p>&nbsp;</p>
                <p><a href="javascript:void(0)" id="getZip"><img height="50" width="50" alt="zip" src="<?php echo BASE_DIR; ?>media/registrera/img/zip2.png" style="margin-left:125px; border:none;"></a></p>
                <p>&nbsp;</p>  
                
                <p>
                    <b>Välj ett lösenord redan nu</b>
                    <br />
                    Välj ett av lösenorden till dig själv redan nu. Du kommer behöva fylla i det i nästa steg i processen när du ska registrera din egen profil.
                </p>
                
                <!--
                    <p style="font-size:14px;"><i><u>Hjälp med utskrift?</u></i></p>
                    <p><i>Vill du ha hjälp med utskrift och häftning av dokumenten bockar du i rutan här under. När du väljer "Gå vidare" skickas då ett meddelande till oss. Vi postar materialet till föreningen till en kostnad av 10 kr exkl. moms per dokument.</i></p>
                -->
                <p>&nbsp;</p>
                <p>
                    <b>Hjälp med utskrift?</b>
                    <br />
                    Vill du ha hjälp med utskrift och häftning av dokumenten bockar du i rutan här under. När du väljer "Gå vidare" skickas då ett meddelande till oss. Vi postar materialet till föreningen till en kostnad av 10 kr exkl. moms per dokument.
                </p>
                
                <p><input type="hidden" name="utskrift" value="0"/><input type="checkbox" name="utskrift" value="1" id="utskrift"/><label for="utskrift">&nbsp;Ja tack, jag vill gärna få hjälp med utskrift</label></p>
                <br />
            </td>
        </tr>
    </table>
    <table width="330">
        <tr>
            <td width="200"><a href="javscript:void(0)" onclick="document.location.href='<?php echo BASE_DIR; ?>registrera/1'; return false;"><input style="border:none;" type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_tillbaka.png" alt="Tillbaka" style="width:89px;height:35px;"/></a>
            </td>
            <td>
                <a href="javascript:void(0)"><input id="gaVidare" name="vidare" type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_vidare.png" style="border: none; width: 89px; height: 35px;" alt="Gå vidare"/></a>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/messi.min.js"></script>
<link href="<?php echo BASE_DIR; ;?>media/js/messi.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .btnbox {
        margin-right: 20px;
        display: inline;
    }
</style>
<script type="text/javascript">
    var _forward = false;
    function showMessage(message, buttonText) {
        new Messi(
            message,
            {   
                title: 'Svensk Brf', 
                buttons: [{id: "passYes", label: buttonText, val: '1'}, {id: "passNo", label: 'Nej', val: '0'}]
                ,center : true,
                callback: function(value) {
                    if (value == 1) {
                        _forward = true;
                        $("#gaVidare").click();
                    } else {
                        $("#getPdf").click();
                    }
                }
            }
        );
    }
</script>        
<script type="text/javascript">
    $("#gaVidare").click(function(){
        if (!_forward) {
            //showMessage("Har du valt ett lösenord till dig själv?", "Ja");
            //return false;
            return true;
        } else {
            return true;
        }
    });
</script>