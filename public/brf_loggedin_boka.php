<script type="text/javascript">
var _loaded = false;
var _interval = null;
</script>
<style type="text/css">
    .bokning_kalender_bokat {
        height: 30px;
        padding: 20px 10px 15px;
        width: 65px;
    }
</style>
<?php if (@$_REQUEST['subview'] && ($oResource = $oBrf->getResourceByName($_REQUEST['subview']))): ?>
<?php
    // where are we?
    $iFirstDay = @$_REQUEST['firstDay'] ? $_REQUEST['firstDay'] : (strtotime((!date('w') ? 'previous' : 'this') . ' week') - date('G') * 3600 - ((int)date('i'))*60 - (int) date('s'));
    $iCurrentWeek = (int) date('W', $iFirstDay);
    $iCurrentYear = date('Y', $iFirstDay);
    if ($iCurrentWeek == 1 && date('n') == 12) {
        $iCurrentYear += 1;
    }
?>
<?php

switch ($sAction) {
    case 'book_resource':
        SvenskBRF_Session::getInstance()->saveBooking(getBookingString($oResource, $_POST['bookingTime']), $oResource->getId(), $_POST['bookingTime'], FALSE, FALSE);
        $sJsAction = "_interval = window.setInterval(\"if(_loaded) { window.scrollTo(0, $('#paminnelse').position().top - 150); window.clearInterval(_interval); } else {  }\", 300);";
        break;
    case 'remove_booking':
        SvenskBRF_Session::getInstance()->removeBooking($_POST['bookingIndex']);
        if (count(SvenskBRF_Session::getInstance()->getBookings()) > 0) {
            $sJsAction = "_interval = window.setInterval(\"if(_loaded) { window.scrollTo(0, $('#paminnelse').position().top - 150); window.clearInterval(_interval); } else {  }\", 300);";
        }
        break;
}


?>
<script type="text/javascript">
    $("#contents").find(".height").hide();
</script>
<?php 
    if (file_exists("media/inloggad/img/" . str_replace("/", "", switchCharacters($oResource->getResourceType()->getTypeName())).".png")) $sHeaderImg = BASE_DIR . "media/inloggad/img/".str_replace("/", "", switchCharacters($oResource->getResourceType()->getTypeName())).".png";
    else $sHeaderImg =  BASE_DIR . "media/img/lokal.png";
?>
<!--<img id="bla_skylt" rel="<?php echo str_replace("/", "", switchCharacters($oResource->getResourceType()->getTypeName())); ?>" src="<?php echo $sHeaderImg; ?>" width="210" height="36" alt="tvattstuga" />-->
<?php echo getHeaderPicture($oResource->getName(), '', 'bla_skylt', 0, 200); ?>
<br />
<br />
<br />
<br />
<br />

<?php if ($oResource->getResourceType()->getInstructionText()): ?><p><?php echo nl2br($oResource->getResourceType()->getInstructionText()); ?>
För muspekaren över en bokad tid för att se vem som gjort bokningen.
</p><?php endif; ?>

<?php if ($oResource->getAdvanceBookings() > 0): ?>
<p><b>Du kan högst ha <?php echo $oResource->getAdvanceBookings(); ?> pågående bokningar för detta utrymme.</b></p>
<?php endif; ?>

<?php if ($oResource->getResourceDayCollection()->size() > 0): ?>
<?php 
    $aResourceDays = array();
    foreach ($oResource->getResourceDayCollection() as $oResourceDay) {
        $aResourceDays[$oResourceDay->getDay()] = getDay($oResourceDay->getDay());
    }
    //asort($aResourceDays);
?>
<p><b><?php echo $oResource->getName(); ?> kan bokas följande dagar: <?php echo implode(", ", $aResourceDays); ?>.</b></p>
<?php endif; ?>
<p><i>Styrelsen väljer hur många pågående bokningar varje hushåll kan ha samtidigt och vilka dagar utrymmet kan bokas.</i></p>
<br />
<p>
    <span style="color:grey;background-color:#F3F2EC;">&nbsp;&nbsp;&nbsp;</span><span>&nbsp&nbsp;Ej bokningsbar&nbsp;</span>
    <span style="color:grey;background-color:#DBEBF2;">&nbsp;&nbsp;&nbsp;</span><span>&nbsp&nbsp;Tillgänglig för bokning&nbsp;</span>
    <span style="color:grey;background-color:#F6AA6A;">&nbsp;&nbsp;&nbsp;</span><span>&nbsp&nbsp;Bokad av dig eller någon annan i föreningen</span>
</p>
<p style="color:red; display:none;" id="noDays">
    OBS! OM BOKNINGSBARA DAG/DAGAR PASSERATS FÖR INNEVARANDE VECKA SÅ VISAS DE SOM EJ BOKNINGSBARA. GÅ TILL NÄSTA VECKA FÖR NÄSTA BOKNINGSBARA DAG.
</p>
<div id="kalender_top">
    <a href="javascript:void(0)" id="left-arrow">
        <img src="<?php echo BASE_DIR; ?>media/inloggad/img/pil-vanster.png" width="19" height="30" alt="pil" class="pil_vanster" />
    </a>
    <a href="javascript:void(0)" id="right-arrow">
        <img src="<?php echo BASE_DIR; ?>media/inloggad/img/pil-hoger.png" width="18" height="30" alt="pil" class="pil_hoger" />
    </a>
    <div id="vecka_center"> 
        <div id="vecka">
            <h4>
                <a href="#">Vecka <span id="week"><?php echo $iCurrentWeek; ?></span><span id="year" style="display:none;"><?php echo $iCurrentYear; ?></span></a>
            </h4>
            <!--<li><a href="#">Vecka <span id="week"><?php echo $iCurrentWeek; ?></span>&nbsp;<span id="year"><?php echo $iCurrentYear; ?></span></a>
                <ul>
                    <li><a href="javascript:void(0)" class="nextWeek">Vecka <span class="week"><?php echo ($iCurrentWeek + 1) % 52; ?></span><span style="display:none;">1</span></a></li>
                    <li><a href="javascript:void(0)" class="nextWeek">Vecka <span class="week"><?php echo ($iCurrentWeek + 2) % 52; ?></span><span style="display:none;">2</span></a></li>
                    <li><a href="javascript:void(0)" class="nextWeek">Vecka <span class="week"><?php echo ($iCurrentWeek + 3) % 52; ?></span><span style="display:none;">3</span></a></li>
                </ul>
            </li>-->
        </div>
    </div>
</div>

<script src="<?php echo BASE_DIR; ?>media/js/jquery.qtip.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_DIR; ?>media/css/jquery.qtip.min.css"/>

<table class="boka_tid">
    
</table>
<?php
    $aBookings = SvenskBRF_Session::getInstance()->getBookings();
    if (count($aBookings)):
?>
<table class="tabell_bokning">
    <tr>
        <th class="paminnelse" id="paminnelse" name="paminnelse">Påminnelse</th>
    </tr>
    <?php $bSMSBookings = (bool) $oBrf->getSetting(SvenskBRF_Brf::BRF_SETTING_ID_SMS_BOOKING); ?>
    <tr>
        <td colspan="5" style="text-align:left; margin-top: -10px;"><p><i>
                <?php if ($bSMSBookings): ?>Om du väljer SMS-påminnelse kommer du att få ett SMS en timma innan din bokade tid.<?php endif; ?>
                Om du väljer mail-påminnelse kommer du att få ett mail 24 timmar innan din bokade tid.
        </i></p></td>
    </tr>
    
    <?php foreach ($aBookings as $iBookingIndex => $aBookingData): ?>
    <tr>
        <td class="plats">
            <span class="bold">
                <?php echo $oBrf->getResourceById($aBookingData['resource'])->getName(); ?>
            </span>
        </td>
        <td>
            <?php $aTextData = explode(' ', $aBookingData['text']); echo '<span class="bold">'.$aTextData[0].' '.$aTextData[1] .'</span>&nbsp;'; echo $aTextData[2]; ?>
        </td>
        <td class="form_cell">
            <form>
                <label for="mail_<?php echo $iBookingIndex; ?>">
                    <input id="mail_<?php echo $iBookingIndex; ?>" type="checkbox" value="<?php echo $iBookingIndex; ?>"<?php if ($aBookingData['mail']) echo ' checked="checked"';?> class="edit_booking mail checkbox"/>
                    Mail
                </label>
            </form>
        </td>
        <?php if ($bSMSBookings): ?>
        <td class="form_cell">
            <form>
                <label for="sms_<?php echo $iBookingIndex; ?>">
                    <input id="sms_<?php echo $iBookingIndex; ?>" type="checkbox" value="<?php echo $iBookingIndex; ?>"<?php if ($aBookingData['sms']) echo ' checked="checked"';?> class="edit_booking sms checkbox"/>
                    SMS
                </label>
            </form>
        </td>
        <?php endif; ?>
        <td>
            <a href="javascript:void(0)" onclick="$(this).next().submit();">Ta bort</a>
            <form method="post" action="" style="height:0px;width:0px;">
                <input type="hidden" name="action" value="remove_booking"/>
                <textarea name="week" class="week" style="display:none;"><?php echo $iCurrentWeek; ?></textarea>
                <input type="hidden" name="bookingIndex" value="<?php echo $iBookingIndex; ?>"/>
                <input hidden="firstDay" name="firstDay" class="firstDayLoad" value="<?php echo $iFirstDay; ?>"/>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<form action="<?php echo BASE_DIR; ?><?php echo $oBrf->getUrl(); ?>/bokningar" method="post">
   <label>
       <input type="hidden" name="action" value="save_bookings"/>
       <input type="image" class="boka_knapp" src="<?php echo BASE_DIR; ?>media/inloggad/img/boka_ruta.png" alt="boka" style="width:79px; height:39px;"/> 
   </label>
</form>

<br />
<br />

<?php endif; ?>

<h2 style="margin-left: 30px;">Ordningsregler</h2>
<p style="margin-left:40px; margin-right:40px;"><?php echo $oResource->getDescription(); ?></p>
<?php if (FALSE && count($aBookings)): ?><p style="margin-left:20px; margin-right:20px; font-style:italic; font-size:11px;">*Sms-kostnad är 1 krona per sms. Glöm inte att trycka på Boka för att bekräfta din bokning!</p><?php endif; ?>
<script type="text/javascript">
    
    function scrollToLoaded()
    {
        if (document.location.href.indexOf("#") > 0) {
            document.location.href = document.location.href;
        }
    }
    
    function loadWeek(element, otherElement, currentTime, timeAdjustment, weekAdjustment, scroll) {
        var _time = currentTime + timeAdjustment;
        $.post('<?php echo BASE_DIR; ?>ajax.php', {
           action : 'loadbookingcalendar',
           resource : <?php echo $oResource->getId(); ?>,
           time : _time
        }, function (response) {
            if (response.result) {
                if (response.data.available > 0) {
                    $("#noDays").hide();
                } else {
                    $("#noDays").show();
                }
                $(".boka_tid").html(response.data.html);
                $("td.bokning_kalender").click(function(){
                    $(this).find("form").submit();
                });
                $("#contents").find(".height").show();
                //setHeight(parseInt($(".boka_tid").height())+150+$("table.tabell_bokning").height()+$("table.tabell_bokning").next().height());
                setHeight();
                //console.log($(".boka_tid").height());
                if (scroll) {
                    scrollToLoaded();
                }
                $(".firstDayLoad").val(_time);
            } 
        }, 'json');
        
        var yearAdd = 0;
        var newWeekMain = parseInt($("#week").html()) +weekAdjustment;
        if (newWeekMain > 52) {
            newWeekMain = newWeekMain - 52;
            yearAdd = 1;
        } else if (newWeekMain <= 0) {
            newWeekMain = 52 - newWeekMain;
            yearAdd = -1;
        }
        $("#week").html(newWeekMain);
        // update year
        $("#year").html(parseInt($("#year").html())+yearAdd);
        
        $('.week').each(function() {
            var newWeek = parseInt($(this).html()) + weekAdjustment;
            if (newWeek > 52) {
                newWeek = newWeek - 52;
                yearAdd = 1;
            } else if (newWeek <= 0) {
                newWeek = 52 - newWeek;
                yearAdd = -1;
            }
            $(this).html(parseInt(newWeek));
        });
        
        if (element != null && otherElement != null) {
            $(element).off('click').on('click', function(){
                loadWeek(element, otherElement, (parseInt(currentTime) + parseInt(timeAdjustment)), (parseInt(timeAdjustment)), weekAdjustment);
            });
            $(otherElement).off('click').on('click', function(){
                loadWeek(otherElement, element, (parseInt(currentTime) + parseInt(timeAdjustment)), (-1) * (parseInt(timeAdjustment)), -1 * weekAdjustment);
            });
        }
        
        // next week handlers
        $(".nextWeek").off('click').on('click',function(){
           var adjustment = parseInt(($(this).find("span:eq(1)").html()));
           var currentTimeNext = currentTime + timeAdjustment;
           loadWeek(null, null, currentTimeNext, 7 * 24 * 3600 * adjustment, adjustment);

           $("#right-arrow").off('click').on('click', function(){
               loadWeek(this, $("#left-arrow"), currentTimeNext + adjustment * 1 * 7 * 24 * 3600, 1 * 7 * 24 * 3600, 1);
           });
           $("#left-arrow").off('click').on('click', function(){
               loadWeek(this, $("#right-arrow"), currentTimeNext + adjustment * 1 * 7 * 24 * 3600, -1 * 7 * 24 * 3600, -1);
           });

           return false;
       });

        
        return false; 
    }

    $(document).ready(function(){
       
        loadWeek(null, null, <?php echo $iFirstDay; ?>, 0, 0, true);
       
       
       $("#left-arrow").click(function(){
           loadWeek(this, $("#right-arrow"), <?php echo $iFirstDay; ?>, -1 * 7 * 24 * 3600, -1);
       });
       
       $("#right-arrow").click(function(){
           loadWeek(this, $("#left-arrow"), <?php echo $iFirstDay; ?>, 1 * 7 * 24 * 3600, 1);
       });
       
       $(".edit_booking").click(function(){
           $.post('<?php echo BASE_DIR; ?>ajax.php', { 
               action : 'editbooking', 
               type : $(this).hasClass('sms') ? 'sms' : 'mail',
               bookingIndex : $(this).val(),
               checked : $(this).is(':checked') ? 1 : 0
            }, function(response) {
               if (response.result) {
                   //
               }
           }, 'json');
           return true;
       });
       
    });  
</script>
<script type="text/javascript">
    initMenu($("#boka_menu"));
</script>
<script type="text/javascript">
    $("a.nav:contains('<?php echo $oResource->getName(); ?>')").css('font-style', 'oblique');
</script>    
<?php else: ?>
<script type="text/javascript">
    $(document).ready(function(){
        document.location.href='<?php echo BASE_DIR . $oBrf->getUrl(); ?>';
    });
</script>
<?php endif; ?>

