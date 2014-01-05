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
<img width="210" height="36" alt="Gör inlägg" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/inlagg.png" class="medlem" id="bla_skylt"/>
<p>Här kan ni göra ett inlägg på ett projekt. Välj projekt i listan nedan. Vill ni skapa ett nytt projekt så väljer ni Nytt projekt i listan nedan. </p>
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
            <h5>INLÄGG</h5>
            <p>Skriv in en rubrik för inlägget och sedan själva inlägget. Tryck därefter på Spara. </p>
            <label for="logHeader" style="margin-left:15px;">
                Rubrik:<br /> <input type="text" name="header" style="width:430px; margin-left:15px;" id="logHeader"/>
            </label>
            <br />
            <label for="comment" style="margin-left:15px;">
                Inlägg: <br /><textarea cols="60" rows="4" name="comment" id="comment" style="margin-left:15px;"></textarea>
            </label>

            <!--
            <h5>BIFOGA DOKUMENT</h5>
            <br />
            <input type="file" style="width: 200px; margin-left:15px;" name="document" id="document">
            -->

            <!--<h5>NAMNGE FIL</h5>
            <p>Här kommer lite förklarande text.</p>
            <label for="logName" style="margin-left:15px;">
                Namn: <input type="text" name="logName" id="logName" style="width:430px;">
            </label>-->

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
    <input type="hidden" name="action" value="savepresidentlog"/>
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
            } else {
                $("#newCategory input").val('').prop('disabled', true);
                $("#newCategory").hide();
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
            var loc = '<?php echo BASE_DIR . $oBrf->getUrl() . '/styrelselogg/inlagg'; ?>';
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
    $("a.nav:contains('Gör inlägg')").css('font-style', 'oblique');
</script>


