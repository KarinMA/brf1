<style type="text/css">
    #right2 { 
        width: 130px;
        float: left;
        margin:0px; 
        padding:0px;
        margin-left:-20px;
    }

    h5 {
        font-size: 15px;
        margin: 40px 0 0 15px;
    }
</style>
<?php
    $sCategoryDir = @$_REQUEST['parameter'];
?>
<img width="210" height="36" alt="Gör inlägg" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/ladda_upp_dokument.png" class="medlem" id="bla_skylt"/>
<p>Här kan ni ladda upp dokument till specifika projekt. Välj projekt i listan nedan. Därefter trycker ni på knappen Välj fil och väljer det dokument ni vill ladda upp. Vill ni skapa ett nytt projekt så väljer ni Nytt projekt. </p>
<form enctype="multipart/form-data" method="post" action="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/styrelselogg/projekt">
    <div id="dokument">
        <div id="vanster_lista">
            <?php if (($oCategories = SvenskBRF_PresidentLog::getPresidentLogCategories($oBrf)) && $oCategories->size()): ?>
            <h5><label for="categorySelect">VÄLJ PROJEKT</label></h5>
            <br />
            <select style="margin-left: 15px;" id="categorySelect" name="category">
                <option value="">Välj...</option>
                <?php foreach ($oCategories as $oCategory): ?>
                <option value="<?php echo $oCategory->getId(); ?>"<?php if ($sCategoryDir && $sCategoryDir === SvenskBRF_PresidentLog::getDirectoryNameForLogCategory($oCategory)): ?> selected="selected"<?php endif; ?>><?php echo $oCategory->getCategoryName(); ?></option>
                <?php endforeach; ?>
                <option value="0">Nytt projekt</option>
            </select>
            <?php endif; ?>


            <div id="newCategory">
                <h5>NYTT PROJEKT</h5>
                <p>Skriv ett namn på det nya projektet nedan samt en beskrivning för vad projektet handlar om. </p>
                <label for="categoryText" style="margin-left:15px;">
                    Namn på projekt:<br /><input type="text" name="category" style="width:430px; margin-left: 15px;" id="categoryText"/> 
                </label>
                
                <input name="newcategory" id="newCategoryIndicator" type="hidden" value="1"/>
                <br />
                <label for="categoryDescription" style="margin-left:15px;">
                    Beskrivning:<br /><textarea cols="60" rows="6" name="categoryDescription" id="categoryDescription" style="margin-left: 15px;"></textarea>
                </label>
                <!--
                <label for="saveButton0">
                    <input id="saveButton0" type="image" align="left"  alt="spara" style="position:relative;top:20px; width:78px; height:28px; border:0; margin-bottom:50px; margin-left:15px;" src="<?php echo BASE_DIR; ?>media/inloggad/img/spara.png" name="save"
                        onclick=" if ($.trim($('#categoryText').val()).length > 0) { $('#saveAction').val('savepresidentlogcategory'); return true; } else { $('#categoryText').css('background-color','red'); return false; }"
                    />
                </label>
                -->
            </div>
            
            <!--<h5>RUBRIK</h5>
            <p>Här kommer lite text.</p>
            <label for="logHeader" style="margin-left:15px;">
                Namn: <input type="text" name="header" style="width:430px;" id="logHeader"/>
            </label>-->

            <h5>BIFOGA DOKUMENT</h5>
            <br />
            <input type="file" style="width: 200px; margin-left:15px;" name="document" id="document">
            

            <h5>NAMNGE FIL</h5>
            <p>Skriv in ett namn på filen som ni laddar upp. Detta namn visas för andra användare.</p>
            <label for="logName" style="margin-left:15px;">
                Namn:<br /><input type="text" name="logName" id="logName" style="width:430px; margin-left: 15px;">
            </label>

            <h5>BESKRIVNING DOKUMENT</h5>
            <p>Här kan ni beskriva dokumentet ni laddar upp.</p>
            <label for="comment" style="">
                <textarea cols="60" rows="4" name="comment" id="comment" style="margin-left: 15px;"></textarea>
            </label>

            
            <label for="saveButton1">
                <input id="saveButton1" type="image" class="saveLog" align="left" alt="spara" style="position:relative;top:20px; width:78px; height:28px; border:0; margin-bottom:50px; margin-left:15px;" src="<?php echo BASE_DIR; ?>media/inloggad/img/spara.png" name="save"/>
            </label>



            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <?php if ($sCategoryDir): ?>
            <p><a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/styrelselogg/projekt/<?php echo $sCategoryDir; ?>">&lt; Tillbaka </a></p>
            <?php else: ?>
            <p><a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/styrelselogg/logg">&lt; Tillbaka </a></p>
            <?php endif; ?>
            
        </div><!-- vanster_lista -->

        <br class="clear"/>
    </div>
    <input type="hidden" name="action" value="savepresidentlog" id="saveAction"/>
    <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>" id="date"/>
</form>
<script type="text/javascript">
    var fileChosen = $("#document").size() == 0;
    $(document).ready(function(){
        $("#categorySelect").change(function(){
            if ($(this).val() === "0") {
                $("#newCategory").show();
                $("#newCategory input").removeAttr('disabled');
                $("#newCategoryIndicator").val("1");
                $("#categoryText").focus();
            } else {
                $("#newCategory input").val('').prop('disabled', true);
                $("#newCategory").hide();
                if ($(this).val() !== '') {
                    //$("#comment").focus();
                }
            }
            
        });
        $("#categorySelect").change();
        $("#document").change(function(){
            fileChosen = true;
        });
            
        
        /* Swedish initialisation for the jQuery UI date picker plugin. */
        /* Written by Anders Ekdahl ( anders@nomadiz.se). */
        /*jQuery(function($){
            $.datepicker.regional['sv'] = {
                closeText: 'Stäng',
                prevText: '&laquo;Förra',
                nextText: 'Nästa&raquo;',
                currentText: 'Idag',
                monthNames: ['Januari','Februari','Mars','April','Maj','Juni',
                    'Juli','Augusti','September','Oktober','November','December'],
                monthNamesShort: ['Jan','Feb','Mar','Apr','Maj','Jun',
                    'Jul','Aug','Sep','Okt','Nov','Dec'],
                dayNamesShort: ['Sön','Mån','Tis','Ons','Tor','Fre','Lör'],
                dayNames: ['Söndag','Måndag','Tisdag','Onsdag','Torsdag','Fredag','Lördag'],
                dayNamesMin: ['Sö','Må','Ti','On','To','Fr','Lö'],
                weekHeader: 'Ve',
                dateFormat: 'yy-mm-dd',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''};
            $.datepicker.setDefaults($.datepicker.regional['sv']);
        });

        $.datepicker.setDefaults($.datepicker.regional['sv']);
        $("#date").datepicker();*/

        $(".saveLog").click(function(){
            // validate
            var _focused = false;
            var isValid = true;
            var loc = '<?php echo BASE_DIR . $oBrf->getUrl() . '/styrelselogg/dokument'; ?>';
            $("input,select").css('background-color', '');
            if ($("#categoryText").prop('disabled')) {
                if ($("#categorySelect").val() == 0) {
                    $("#categorySelect").css('background-color', 'red');
                    isValid = false;
                    if (!_focused) {
                        $("#categorySelect").focus();
                        _focused = true;
                        loc += "#categorySelect";
                    }
                }
            } else {
                if ($.trim($("#categoryText").val()) === '') {
                    $("#categoryText").css('background-color', 'red');
                    isValid = false;
                    if (!_focused) {
                        $("#categoryText").focus();
                        _focused = true;
                        loc += "#categoryText";
                    }
                }
            }
            if (!fileChosen) {
                $("#document").css('background-color', 'red');
            }
            
            $("#date,#logName,#logHeader").each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    $(this).css('background-color', 'red');
                    if (!_focused) {
                        $(this).focus();
                        _focused = true;
                        loc += "#" + $(this).prop('id');
                    }
                } 
            });
            
            if (!isValid && _focused) {
                document.location.href = loc;
            }
            return isValid;
        });
    });
</script>
<script type="text/javascript">
    $("a.nav:contains('Ladda upp dokument')").filter(':eq(0)').css('font-style', 'oblique');
</script>


