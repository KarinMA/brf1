<div id="left" style="margin-top:30px;">
    <img class="bla_rubrik" src="<?php echo BASE_DIR; ?>media/registrera/img/29_bild.png" width="328" height="39" />
    <table width="335">
        <tr>
            <td style="background-color:#fff;">
                <br />
                <p>Nästa steg är att ge föreningens medlemmar möjlighet att själva registrera sig.</p>
                <p>Nedan finns en pdf som innehåller inloggningsuppgifter till alla medlemmar i din förening. Den behöver du skriva ut och häfta ihop så att varje medlem får ett häfte om tre sidor – En sida med registreringsuppgifter samt två sidor användarmanual.<br />
                    Tänk på att alla sidor ligger i samma pdf så att du enkelt kan skriva ut dem.
                </p>
                <p>Om du istället vill mejla dina medlemmar så finns en zipfil längre ned med <?php echo $oBrf->getApartments(); ?> separata pdf:er som du kan spara och sedan mejla. </p>
                <p>Det spelar ingen roll vem som får vilket lösenord. Det vill säga att du kan dela ut eller mejla vilket som helst av dokumenten till vilken som helst av medlemmarna. </p>
                <p>Välj ett av lösenorden för dig själv redan nu. Du kommer behöva fylla i det senare i registreringsprocessen.</p>
                <p>&nbsp;</p>
                <p><a id="getPdf" href="javascript:void(0)"><img style="margin-left:120px; border:none;" src="<?php echo BASE_DIR; ?>media/registrera/img/pdf.jpg" width="50" height="50" alt="pdf" /></a></p>
                <p>&nbsp;</p>
                <p>Klicka på pdf-ikonen för att öppna, spara och skriva ut dokumentet.</p> 
                <p>Vill du istället mejla dina medlemmar deras registreringsuppgifter? Klicka och öppna Zip-filen nedan. Därefter kan du spara separata pdf:er som du sedan kan mejla ut.</p>
                <p>&nbsp;</p>
                <p><a href="javascript:void(0)" id="getZip"><img height="50" width="50" alt="zip" src="<?php echo BASE_DIR; ?>media/registrera/img/zip2.png" style="margin-left:125px; border:none;"></a></p>
                <p>&nbsp;</p>
                <p>Vill du ha hjälp med utskrift och häftning av dokumenten bockar du i rutan här under. När du väljer "Gå vidare" skickas då ett meddelande till oss. Vi levererar materialet till dig till en kostnad av 10 kr inkl moms per dokument.</p>
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
                <a href="javascript:void(0)"><input name="vidare" type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_vidare.png" style="border: none; width: 89px; height: 35px;" alt="Gå vidare"/></a>
            </td>
        </tr>
    </table>
</div>