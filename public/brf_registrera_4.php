<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Registrering, Svensk Brf</title>
        <link href="<?php echo BASE_DIR; ?>media/registrering.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo BASE_DIR; ?>media/css/jquery-ui-1.10.3.custom.min.css" />
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-1.9.1.min.js"></script>
        <script src="<?php echo BASE_DIR; ?>media/js/jquery.placeholder.js" type="text/javascript"></script>
        <script type="text/javascript">
            function setHeight(addHeight) {
                var leftHeight = $("#left").height();
                var bokningHeight = $("#tabell_bokningar").height();
                var h = leftHeight + bokningHeight;
                var wrapperHeight = $("#wrapper").height();
                if (addHeight) {
                    h += addHeight;
                }
                if (h + 10 > wrapperHeight) {
                    $("#wrapper").height(h + 10);
                } else {
                }
            }
        </script>
        <style type="text/css">
            .ui-datepicker-current { display: none; }
        </style>
        <style type="text/css">
            .bokning {width:270px; font-family: 'Open Sans',sans-serif; font-size: 13px; text-align: center;}

            .bokning1 {text-align:left; width:160px; font-family: 'Open Sans',sans-serif; font-size: 13px;}

            #tabell_bokningar { clear:both; 
            width:700px; 
            margin-left:15px;}
        </style>
        <script src="<?php echo BASE_DIR; ?>media/js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-ui-timepicker-addon.js"></script>
        <script type="text/javascript">
            jQuery(function($){
                $.timepicker.regional['sv'] = {
                    timeOnlyTitle : 'Dra markören till önskat klockslag',
                    hourText: 'Tid',
                    minuteText: 'Minut',
                    timeText : '',
                    closeText: 'Spara',
                    currentText: ''
                    //deselectButtonText: 'Rensa'
                }
                $.timepicker.setDefaults($.timepicker.regional['sv']);
            });

            var rt = false;
            function timePickerChange() {
                var intervalField = $("select[name='tidsintervall']");
                if ($("#slutTid").val().length > 0 && $("#startTid").val().length > 0) {
                    
                    
                    var start = parseInt($("#startTid").val());
                    var slut = parseInt($("#slutTid").val());
                    var hours = slut - start;
                    $(intervalField).find("option").filter(':gt(0)').remove();
                    if (hours >= 1) {
                        var intervals = [];
                        for (var hour = 1; hour <= hours; hour++) {
                            if (hours % hour == 0) {
                                intervals.push(hour);
                            }
                        }
                        for (var index = 0; index < intervals.length; index++) {
                            $(intervalField).append('<option value="'+intervals[index]+'">'+intervals[index]+ " timmar</option>");
                        }
                        if (rt) {
                            $(intervalField).val(intervals[intervals.length - 1]);
                        }
                    } else {
                        $(intervalField).val('');
                    }
                }
            }

            $(document).ready(function() {
                $('#startTid,#slutTid').timepicker({dateFormat : 'HH', showMinute : false, onSelect : timePickerChange});
                
            });
        </script>
        <style type="text/css">
            .ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
            .ui-timepicker-div dl { text-align: left; }
            .ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
            .ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
            .ui-timepicker-div td { font-size: 90%; }
            .ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

            .ui-timepicker-rtl{ direction: rtl; }
            .ui-timepicker-rtl dl { text-align: right; }
            .ui-timepicker-rtl dl dd { margin: 0 65px 10px 10px; }
        </style>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/messi.min.js"></script>
        <link href="<?php echo BASE_DIR; ;?>media/js/messi.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <form method="post" action="<?php echo BASE_DIR; ?>registrera/5">

            <div id="wrapper" style="min-height:2200px;">

                <div id="left" style="margin-top:30px;">
                    <?php if (!$bIsFromAdmin): ?>
                        <!--<img class="bla_rubrik" src="<?php echo BASE_DIR; ?>media/registrera/img/49_bild.png" width="326" height="66" />-->
                    <?php echo getHeaderPicture("<b style=\"font-weight: bold;\">4</b>/10. Aktivera boknings-", "systemet"); ?>
                    <?php else: ?>
                    <?php if ($sStepParameter != 'r') : ?>
                        <img class="bla_rubrik" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/styrelseadmin.png" width="210" height="36" alt="styrelseadmin"/>
                    <?php else: ?>
                    <?php echo getHeaderPicture("Bokningsbara", "utrymmen"); ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <table width="335">
                        <tr>
                            <td style="background-color:#fff;">
                                <?php if (!$bIsFromAdmin): ?>
                                <p>
                                    Via hemsidan kan ni boka föreningens gemensamma utrustning och lokaler. *<!-- Nedan fyller du i vilka bokningsmöjligheter ni vill utnyttja och vilka regler som gäller vid bokning.<b>Om föreningen inte vill aktivera bokningssystemet nu trycker du bara på fortsätt för att komma till nästa steg. Med andra ord så kan registreringen av bokningsbara lokaler även göras vid ett senare tillfälle.</b>-->
                                </p>
                                <?php else: ?>
                                <p>Nedan fyller du i vilka bokningsmöjligheter ni vill utnyttja och vilka regler som gäller vid bokning. Längst ner finns de lokaler som är registrerade idag. Klicka på ändra eller ta bort om ni vill göra ändringar i hur de bokas eller om ni vill ta bort lokalen ifråga. </p>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="background-color:#fff; margin-bottom:20px;">
                                <ul>
                                    <li class="dokument" ><p style="font-size:14px;">VÄLJ LOKAL</p></li>
                                </ul>

                                <select name="Lokal" id="lokalval">
                                    <option value="">Välj...</option>
                                    <?php foreach (SvenskBRF_Brf::getResourceTypes() as $oResourceType): ?>
                                        <option value="<?php echo $oResourceType->getTypeName(); ?>"><?php echo $oResourceType->getTypeName(); ?></option>
                            <?php endforeach; ?>
                                </select>
                                
                                <p>Har ni fler lokaler av samma kategori så lägger ni till en ytterligare lokal av samma typ som tidigare och skriver namnet i textrutan nedan (tex om ni har fler tvättstugor lägger ni till en ytterligare tvättstuga och kallar den tvättstuga 2 eller det namn ni önskar).</p>
                                
                                
                                
                                <p style="margin-top:20px;"><!--Om du vill ändra lokalnamn fyll i nytt namn nedan.-->Om du vill skapa en ny lokal som inte stämmer överens med någon av kategorierna ovan så väljer du <b>Övrigt</b> och fyller i namnet nedan.<br/>
                                    <br />
                                    <input type="text" name="name" placeholder="Lokalnamn/typ"/>
                                </p>

                            </td>
                        </tr>
                    </table>

                    <table width="330">
                        <tr>
                            <td colspan="2" width="300">
                                <p class="notWholeDay" style="font-size: 14px;">START/SLUT-TID</p>
                                <p class="notWholeDay">Välj en starttid och sluttid (endast hela timmar), det vill säga en tid på dagen när lokalen tidigast kan bokas samt när lokalen &quot;stänger&quot; för dagen.</p>
                                <p class="wholeDay" style="display:none;">För gästrum/lägenhet så kan ni inte välja tidsintervall utan ni väljer vilken starttid som gäller för lokalen. Intervallet är automatiskt satt till 24 timmar. Dvs så kan ni välja att lokalen bokas från t.ex. 12.00 på dagen. Bokningen gäller då till 12.00 nästföljande dag.</p>
                            </td>
                        </tr>
                        <tr>
                            <td width="150">
                                <p >STARTTID: 
                                    <input type="text" name="starttid" id="startTid" style="width:140px;" value=""/></p>
                            </td>
                            <td  class="notWholeDay">

                                <p>SLUTTID:
                                    <input type="text" name="sluttid" id="slutTid" style="width:140px;" value=""/></p>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p style="font-size: 14px;"><span class="notWholeDay">TIDSINTERVALL/</span>BOKNINGAR</p>
                                <p class="notWholeDay">Ange hur många timmar man får lov att boka åt gången.</p>
                                <p>Välj även hur många bokningar en medlem får göra åt gången per lokal.<!-- Det vill säga om en medlem tex bokar tvättstugan och ni valt att man endast kan göra en bokning åt gången för denna lokal, så kan medlemmen inte göra en ny bokning av tvättstugan förrän den första bokningstiden passerat.--></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="notWholeDay">
                                <p>TIDSINTERVALL:
                                    <select name="tidsintervall" style="width:140px;">
                                        <option value="">Välj</option>
                                        
                                    </select>
                                    </p>
                            </td>
                            <td>
                                <p>BOKNINGAR PER GÅNG: 
                                    <select name="antalBokningar">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="-1" selected="selected">Obegränsat</option>
                                    </select>
                                </p>

                            </td>
                        </tr>
                        <tr class="notWholeDay">
                            <td><p style="margin-top: -10px;"><i>Observera att tidsintervallet anpassas efter den start- och sluttid du valt.<!-- Ändra start eller sluttid för att få flera möjliga tidsintervall.--></i></p></td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <td style="background-color:#fff; padding-top:20px;">
                                <p>BOKNINGSBARA DAGAR</p>
                                <p>Här kan ni välja vilka dagar som ska vara bokningsbara för lokalen via hemsidan.<!-- Ni kan tex välja att en lokal bara ska vara bokningsbar via hemsidan ett visst antal dagar i veckan och--> Resterande dagar hanteras fortsatt med ert tidigare bokningssystem.</p>
                                <p><input type="checkbox" value="Alla dagar" id="allDays"/>Alla dagar<br/><br/>
                                    <input type="checkbox" class="day" name="days[1]" value="Måndag"/>Måndag<br/>
                                    <input type="checkbox" class="day" name="days[2]" value="Tisdag"/>Tisdag<br/>
                                    <input type="checkbox" class="day" name="days[3]" value="Onsdag"/>Onsdag<br/>
                                    <input type="checkbox" class="day" name="days[4]" value="Torsdag"/>Torsdag<br/>
                                    <input type="checkbox" class="day" name="days[5]" value="Fredag"/>Fredag<br/>
                                    <input type="checkbox" class="day" name="days[6]" value="Lördag"/>Lördag<br/>
                                    <input type="checkbox" class="day" name="days[0]" value="Söndag"/>Söndag</p>
                            </td>
                        </tr>


                        <tr>
                            <td style="background-color:#fff; padding-top:20px;">
                                <p style="font-size: 14px;">FÖRHÅLLNINGSREGLER: </p>
                                <p>Här kan ni fylla i de regler som gäller för den bokningsbara lokalen.<!-- Dessa regler kommer att visas i samband med att medlemmen bokar lokalen ifråga.--></p>
                                <textarea rows="10" cols="30" name="description"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="background-color:#fff;">
                                <input style="border:none;width:78px;height:28px;" type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/spara.png" onclick="_forward = true; $('#actionType').val('save'); $('#gaVidare').click(); return false;"/>
                                <br />
                            </td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <td style="background-color:#fff; padding-top:20px;">
                                <ul>
                                    <li class="dokument">
                                        <p>SKAPADE LOKALER:</p>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    
                </div>

                <div id="right">
                    <img class="hoger_bild" src="<?php echo BASE_DIR; ?>media/registrera/img/hoger_bild4.png" width="451" height="564" />
                </div>
                
                <?php $iAddHeight = 0; ?>
                <div id="tabell_bokningar"> 
                    <table>
                        <?php foreach ($oBrf->getResources() as $oResource): ?>
                        <tr>
                            <td class="bokning1"><b><?php echo $oResource->getName(); ?></b></td>
                            <td class="bokning"><b>Startid:</b> <?php echo getFormattedHour($oResource->getOpenHour()); ?></td>
                            <?php if (!$oResource->getResourceType()->getWholeDay()): ?><td class="bokning"><b>Sluttid:</b> <?php echo getFormattedHour($oResource->getCloseHour()); ?></td>
                            <td class="bokning"><b>Intervall:</b> <?php echo $oResource->getInterval() . ' timmar'; ?></td>
                            <?php else: ?>
                            <td class="bokning"><b>Heldag</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td class="bokning"></td>
                            <?php endif; ?>
                            <td class="bokning"><a href="javscript:void(0)" onclick="return loadResource(<?php echo $oResource->getId(); ?>);">Ändra</a></td>
                            <td class="bokning"><a href="javscript:void(0)" onclick="return removeResource($(this).parent().parent(), <?php echo $oResource->getId(); ?>)">Ta bort</a></td>
                        </tr>
                        <?php $iAddHeight += 30; ?>
                        <?php endforeach; ?>
                    </table>
                    <table width="330" style="background-color:#fff; padding-top:20px;">
                        <tr>
                            <td width="200">
                                <?php if (!$bIsFromAdmin): ?>
                                <a href="javscript:void(0)" onclick="document.location.href='<?php echo BASE_DIR; ?>registrera/3'; return false;"><input type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_tillbaka.png" alt="Tillbaka" style="border:none;width:89px;height:35px;"/></a>
                                <?php else: ?>
                                <?php if ($sStepParameter != 'r'): ?>
                                <a href="javascript:void(0)"><input name="vidare" type="image" src="<?php echo BASE_DIR; ?>media/img/till_styrelseadmin.png" style="border: none; width: 168px; height: 35px;" alt="Gå vidare" id="gaVidare"/></a>
                                <?php else: ?>
                                <a href="javascript:void(0)"><input name="vidare" type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_tillbaka.png" style="border: none;"  alt="Gå vidare" id="gaVidare" onclick="document.location.href='<?php echo BASE_DIR; ?>registrera/grattis'; return false;"/></a>
                                <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!$bIsFromAdmin): ?>
                                <a href="javascript:void(0)"><input name="vidare" type="image" src="<?php echo BASE_DIR; ?>media/registrera/img/ga_vidare.png" style="border: none; width: 89px; height: 35px;" alt="Gå vidare" id="gaVidare"/></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <!--<tr>
                            <td colspan="2">
                                <p style="font-size: 11px;">* 
                                    <i>
                                        Om föreningen inte vill aktivera bokningssystemet nu trycker du bara på fortsätt för att komma till nästa steg. Med andra ord så kan registreringen av bokningsbara lokaler även göras vid ett senare tillfälle.
                                    </i>
                                </p>
                            </td>
                        </tr>-->
                    </table>
                </div>
            </div>
            <input type="hidden" name="step" value="<?php echo $iStep; ?>"/>
            <input type="hidden" name="actionType" id="actionType" value=""/>
            <input type="hidden" name="resource" id="resource" value=""/>
        </form>
        

        <script type="text/javascript"> 
            function loadResource(resourceId) {
                $.post("<?php echo BASE_DIR; ?>ajax.php", {action : 'loadresource', resourceId : resourceId}, function (response) {
                    if (response.result) {
                        $("#startTid").val(response.data.startTime + ":00");
                        $("#slutTid").val(response.data.endTime + ":00");
                        $("select[name='Lokal']").val(response.data.resourceType);
                        timePickerChange();
                        $("select[name='tidsintervall']").val(response.data.interval);
                        $("select[name='antalBokningar']").val(response.data.numberOfBookings);
                        $("input[name='name']").val(response.data.resourceName);
                        $("#allDays").prop('checked', false);
                        $("input.day").prop('checked', false);
                        for (var i = 0; i < response.data.availableDays.length; i++) {
                            $("input[name='days["+response.data.availableDays[i]+"]']").prop('checked', true);
                        }
                        if ($("input.day").filter(':checked').size() == $("input.day").size()) {
                            $("#allDays").prop('checked', true);
                        }
                        $("textarea[name='description']").val(response.data.rules);
                        $("#resource").val(resourceId);
                        hideFields(response.data.wholeDay, true);
                        window.scrollTo(0, 140);
                        
                        rt = response.data.wholeDay;
                    }
                }, 'json');
                
                return false;
            }
            
            function removeResource(elementToRemove,resourceId) {
                if (confirm('Är du säker på att du vill ta bort?')) {
                    $.post("<?php echo BASE_DIR; ?>ajax.php", {action : 'removeregisteresource', resourceId : resourceId}, function (response) {
                        if (response.result) {
                            $(elementToRemove).remove();
                            setHeight(-10);
                        }
                    }, 'json');
                }
                return false;
            }
            
            function hideFields(hide, keep) {
                if (hide) {
                    $(".notWholeDay").hide();
                    $(".wholeDay").show();
                    $("#slutTid").val('24:00');
                    if (!keep) {
                        $("#startTid").val('');
                        $("select[name='tidsintervall']").find("option").filter(":gt(0)").remove().end().end().append('<option value="24">24 timmar</option>').val(24);
                    }
                    
               } else {
                    $(".notWholeDay").show();
                    $(".wholeDay").hide();
                    if (!keep) {
                        $(".notWholeDay").find("input,select").val('');
                        $("select[name='tidsintervall']").find("option").filter(":gt(0)").remove();
                    }
                }
            }
            
            $(document).ready(function() {
                setHeight(50 + <?php echo $iAddHeight; ?>); 
                $("#allDays").click(function(){
                    $("input.day").prop('checked', $(this).is(':checked'));
                    return true;
                })
                $("#allDays").click();
                
                $("input.day").click(function() {
                    if (!$(this).is(':checked')) {
                        $("#allDays").prop('checked', false);
                    } else if ($("input.day").filter(':checked').size() == 7) {
                        $("#allDays").prop('checked', true);
                    }
                    return true;
                });
               
                $("#resourceAdd").click(function(){
                    $("input[name='resource'],input[name='starttid'],input[name='sluttid'],select[name='tidsintervall'],input[name='name'],select[name='Lokal'],textarea[name='description']").val('');
                    $("input.day,#allDays").prop('checked', true);
                    $("select[name='antalBokningar']").val('-1');
                    window.scroll(0,100);
                });
                
                $("select[name='Lokal']").change(function(){
                    $.post("<?php echo BASE_DIR; ?>ajax.php", {action : 'checkresourcetype', resourceType : $(this).val()}, function (response) {
                        if (response.result) {
                            hideFields(response.data.wholeDay);
                            rt = response.data.wholeDay;
                        }
                    }, 'json');
                    return false;
                });
                <?php if ($sStepParameter != 'r' && $bIsFromAdmin && preg_match("/\/".$oBrf->getUrl()."/", @$_SERVER['HTTP_REFERER'])): ?>
                window.setTimeout('showMessage("Du kommer från styrelseadmin. Klicka på &quot;Till styrelseadmin&quot; längst ner när du är klar för att komma tillbaka till styrelseadmin.", "OK")', 1000);
                <?php endif; ?>
            });
        </script>
        <style type="text/css">
            .btnbox {
                margin-right: 20px;
                display: inline;
            }
        </style>
        <script type="text/javascript">
            var _forward = false;
            function showMessage(message, buttonText, question) {
                var _buttons = [{id: "resourceYes", label: buttonText, val: '1'}];
                if (question) {
                    _buttons.push({id: "resourceNo", label: 'Nej', val: '0'});
                }
                new Messi(
                    message,
                    {   
                        title: 'Svensk Brf', 
                        buttons: _buttons
                        ,center : true,
                        callback: function(value) {
                            if (question) {
                                if (value == 0) {
                                    window.scroll(0, 200);
                                } else {
                                    _forward = true;
                                    $("#gaVidare").click();
                                }
                            } else {
                                
                            }
                        }
                    }
                );
            }
            $("input[name='namn']").placeholder();
            
        </script>        
        <script type="text/javascript">
            $("#gaVidare").click(function(){
                if (!_forward && $("select[name='Lokal']").val() !== '') {
                    showMessage("Du har börjat fylla uppgifter för en lokal men inte sparat. Vill du fortsätta ändå?", "Ja", true);
                    return false;
                } else {
                    return true;
                }
            });
        </script>
    </body>
</html>
