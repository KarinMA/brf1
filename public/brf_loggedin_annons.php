<script>document.domain = '<?php $sDomain = str_replace(array("https://","http://"),array('',''),BASE_DIR); $sDomain = substr($sDomain, 0, strlen($sDomain) - 1); echo $sDomain; ?>';</script>
<?php
    $iSmallImageHeight = 173;
    $iSmallImageWidth = 250;
?>
<?php

$oRealtorBrf = SvenskBRF_Brf::loadByUrl($sSubView);
$oAd = NULL;
if (($oAds = getUser()->getAdvertisements($oRealtorBrf)) && $oAds->size()) {
    $oAd = $oAds->current();
}

if ($sAction === 'editad') {
    $oAd = $oRealtorBrf->createAd(getUser(), $_POST['adForm'], $_FILES['file']);
    $sJsAction = "showMessage('Dina ändringar är sparade. Klicka <a target=\'_blank\' href=\'".BASE_DIR . $oRealtorBrf->getUrl() . "\'>här</a> för att se annonsen.', 'OK');";
}

?>
<script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_DIR; ?>media/css/jquery-ui-1.10.3.custom.min.css" />
<script type="text/javascript" src="<?php echo BASE_DIR; ?>media/inloggad/js/lib/jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_DIR; ?>media/inloggad/js/lib/jquery.timepicker.css" />
<style type="text/css">

    .checkbox_form {
        margin-right: 15px; 
    }

    #kolumner {
        margin-top: 50px;
        width: 535px
    }

    .kol4 {
        float: left;
        margin: 20px 0 0 20px;
        width: 235px;
    }

    .kol5 {
        float: right;
        margin: 20px 40px 0 0;
        width: 235px;
    }

    .kol3{
        float: left;
        margin: 20px 0 0 20px;
        width: 480px;
    }

    .input_kol {
        width: 200px; 
    }

    .input_3 {
        width: 425px;
        margin-left:10px;
    }

    .time start { 
        width: 20px;
    }

    .time end { 
        width: 20px;
    }

</style>
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
<img alt="medlemsidor" src="<?php echo BASE_DIR; ?>media/inloggad/img/till_salu.png" id="bla_skylt" height="36" width="210">
<p>
    Nedan lägger du in informationen för att lägga upp en annons på föreningens hemsida. När du lägger upp annonsen så skickas ett mejl till samtliga medlemmar i föreningen som informerar om att du har lagt ett objekt till salu. När du sedan klickar i att lägenheten är såld så går ett nytt mejl ut med att lägenheten är såld. På så sätt fungerar detta som en unik före- och efterlappning.
</p>
<p>&nbsp;</p>

<div id="kolumner">

    <div class="example">
        
        <?php if ($oAd): ?>
        
        
        <div style="margin-left: 20px; margin-top: -30px;">
            <form method="post" action="<?php echo BASE_DIR . $oBrf->getUrl() . '/profil/' . $oRealtorBrf->getUrl(); ?>">
            <a href="javascript:void(0)" onclick="if (confirm('Bekräfta att lägenheten är såld.')) { $(this).parent().submit(); } return false;" style="font-size: 13px;">Klicka här om lägenheten är såld.</a>
            <input type="hidden" name="action" value="soldad"/>
            </form>
            <br />
            <br />
            <br />
            <br />
        </div>
        
        <?php endif; ?>
        
        
        <form style="margin-left:20px;" 
              <?php if (!$oAd): ?>
              action="<?php echo BASE_DIR; ?>maklare/profil/<?php echo $oRealtorBrf->getUrl(); ?>" 
              <?php else: ?>
              action="<?php echo BASE_DIR; ?>maklare/annons/<?php echo $oRealtorBrf->getUrl(); ?>" 
              <?php endif; ?>
                method="post" id="adForm" enctype="multipart/form-data">
            <script src="<?php echo BASE_DIR; ?>media/inloggad/js/lib/datepair.js"></script>
            <label for="upfile">
                <div style="height: 153px; width: 250px; border:1px dashed #BBB; cursor:pointer; text-align:center;" id="bild_medlem">
                    <?php if ($oAd && $oAd->hasPicture()): ?>
                    <img 
                        src="<?php echo $oAd->getImageData(); ?>" 
                        height="<?php echo $iSmallImageHeight-20; ?>" 
                        width="<?php echo $iSmallImageWidth-20; ?>" 
                        style="max-height:<?php echo ($iSmallImageHeight-20).'px; max-width:'.($iSmallImageWidth-20).'px; height: auto; width: auto;'; ?>"
                    />
                    <?php else: ?>
                    Klicka här för att ladda upp din bild!
                    <?php endif; ?>
                </div>
            </label>
            <a href="javascript:void(0)" onclick="$('#bild_medlem').html('Klicka här för att ladda upp din bild!'); $('#attachPicture').val(0); $(this).hide(); return false;" style="display:none;" id="removePictureLink">Ta bort bild</a>
            <br />
            <input type="file" name="file" id="upfile" style="display:none;"/>
            Adress (t.ex. Kungsgatan 1)* 
            <br />
            <input name="adForm[address]" type="text" class="required" value="<?php echo $oAd ? $oAd->getAddress() : ''; ?>"/>
            <br />
            Våning*: 
            <br />
            <select name="adForm[stairs]" class="required">
                <option value="">Välj...</option>
                <?php foreach (range(-3, 0) as $iFloor): ?>
                    <option class="stairs" value="<?php echo $iFloor; ?>"<?php if ($oAd && $oAd->getStairs() == $iFloor): ?> selected="selected"<?php endif; ?>><?php echo $iFloor; ?> tr</option>
                <?php endforeach; ?>
                <?php foreach (array('KV', 'BV', 'NB') as $sFloor): ?>
                    <option value="<?php echo $sFloor; ?>"<?php if ($oAd && $oAd->getStairs() == $sFloor): ?> selected="selected"<?php endif; ?>><?php echo $sFloor; ?></option>
                <?php endforeach; ?>
                <?php for ($fFloor = 0.5; $fFloor <= 20; $fFloor+= 0.5): ?>
                    <option class="stairs" value="<?php echo $fFloor; ?>"<?php if ($oAd && $oAd->getStairs() == $fFloor): ?> selected="selected"<?php endif; ?>><?php echo str_replace(".", ",", $fFloor) . ' tr'; ?></option>
                <?php endfor; ?>
            </select>
            <br />
            Avgift*: 
            <br />
            <input name="adForm[fee]" type="text" class="required" value="<?php echo $oAd ? $oAd->getFee() : ''; ?>"/>
            <br />
            Pris*: 
            <br />
            <input name="adForm[price]" type="text" class="required" value="<?php echo $oAd ? $oAd->getPrice() : ''; ?>"/>
            <br />
            Kommentar till pris (t.ex. Accepterat pris, Högstbjudande etc.):
            <br />
            <input name="adForm[pricetype]" type="text" value="<?php echo $oAd ? $oAd->getPriceType() : ''; ?>"/>
            <br />
            Antal rum*: 
            <br />
            <select name="adForm[rooms]" class="required">
                <option value="">Välj...</option>
                <?php for ($fRooms = 1; $fRooms <= 10; $fRooms+= 0.5): ?>
                <option value="<?php echo $fRooms; ?>"<?php if ($oAd && $oAd->getRooms() == $fRooms): ?> selected="selected"<?php endif; ?>><?php echo str_replace(".", ",", $fRooms); ?></option>
                <?php endfor; ?>
            </select>
            <br />
            Antal kvm*: 
            <br />
            <input name="adForm[sqm]" type="text" class="required" value="<?php echo $oAd ? $oAd->getSquareMeters() : ''; ?>"/>
            <br />
            Länk till objektet (kopiera in länken från annonsen på din hemsida här)*
            <br />
            <input name="adForm[link]" type="text" style="width: 450px;" class="required" value="<?php echo $oAd ? $oAd->getRealtorAdLink() : ''; ?>"/>
            <br />
            <br />
            <?php if (!$oAd): ?>
            <input type="hidden" name="action" value="savead"/>
            <?php else: ?>
            <input type="hidden" name="action" value="editad"/>
            <?php endif; ?>
            * = Obligatoriskt fält
            <br />
            <br />
            <div style="border-bottom: 1px solid #ddd; width: 450px; margin-left:20px; margin-bottom:40px;"></div>

            <p style="font-size: 20px;"><b>Visningstider</b></p>
            <p class="datepair" data-language="javascript">

                <?php
                    $oTimes = $oAd ? $oAd->getBrfRealtorAdTimeCollection() : NULL;
                ?>
                
                Datum 1:
                <input class="datepicker" style="width:80px;" name="adForm[date][0]" type="text" value="<?php if ($oTimes && $oTimes->valid()): ?><?php echo substr($oTimes->current()->getStartTime(), 0, 10); ?><?php endif; ?>"/>
                &nbsp;
                <!--<br />-->
                <!--<br />-->
                Tid 1:&nbsp;
                <!--<br />-->
                <!--<br />-->

                Från: <input style="width:80px;" class="time" name="adForm[time][0][0]" type="text" value="<?php if ($oTimes && $oTimes->valid()): ?><?php echo substr($oTimes->current()->getStartTime(), 11,5); ?><?php endif; ?>"/>
                Till: <input style="width:80px;" class="time" type="text" name="adForm[time][0][1]" value="<?php if ($oTimes && $oTimes->valid()): ?><?php echo date('H:i', strtotime('+'.$oTimes->current()->getDurationMinutes().' minute', strtotime($oTimes->current()->getStartTime()))); ?><?php endif; ?>"/>
                <br />
                <br />
                <?php if ($oTimes) $oTimes->next(); ?>

                Datum 2:
                <input class="datepicker" style="width:80px;" name="adForm[date][1]" type="text" value="<?php if ($oTimes && $oTimes->valid()): ?><?php echo substr($oTimes->current()->getStartTime(), 0, 10); ?><?php endif; ?>"/>
                &nbsp;
                
                <!--<br />
                <br />-->
                Tid 2:&nbsp;
                <!--<br />
                <br />-->

                Från: <input style="width:80px;" class="time" type="text" name="adForm[time][1][0]" value="<?php if ($oTimes && $oTimes->valid()): ?><?php echo substr($oTimes->current()->getStartTime(), 11,5); ?><?php endif; ?>"/>
                Till: <input style="width:80px;" class="time" type="text" name="adForm[time][1][1]" value="<?php if ($oTimes && $oTimes->valid()): ?><?php echo date('H:i', strtotime('+'.$oTimes->current()->getDurationMinutes().' minute', strtotime($oTimes->current()->getStartTime()))); ?><?php endif; ?>"/>
                <br />
                <br />
                <?php if ($oTimes) $oTimes->next(); ?>
                
                Datum 3:
                <input class="datepicker" style="width:80px;" name="adForm[date][2]" type="text"  value="<?php if ($oTimes && $oTimes->valid()): ?><?php echo substr($oTimes->current()->getStartTime(), 0, 10); ?><?php endif; ?>"/>
                &nbsp;
                <!--<br />
                <br />-->
                Tid 3:&nbsp;
                <!--<br />
                <br />-->
                Från: <input style="width:80px;" class="time" type="text" name="adForm[time][2][0]" value="<?php if ($oTimes && $oTimes->valid()): ?><?php echo substr($oTimes->current()->getStartTime(), 11,5); ?><?php endif; ?>"/>
                Till: <input style="width:80px;" class="time " type="text" name="adForm[time][2][1]" value="<?php if ($oTimes && $oTimes->valid()): ?><?php echo date('H:i', strtotime('+'.$oTimes->current()->getDurationMinutes().' minute', strtotime($oTimes->current()->getStartTime()))); ?><?php endif; ?>"/>
                <br />
                Alternativ viningstext (visas endast om inga visningstider har valts)<br />
                <textarea name="adForm[alternatetime]" placeholder="<?php echo !$oAd || !$oAd->getAlternateTime() ? 'T.ex. Ring för visning!' : ''; ?>"><?php echo $oAd ? $oAd->getAlternateTime() : ''; ?></textarea>
            </p>
            <input type="hidden" name="action" id="formAction" value="save"/>
            <input type="hidden" id="picturenumber" name="brf1" value="<?php echo rand(1,10000); ?>"/>
            <input type="hidden" name="attachPicture" value="1" id="attachPicture"/>
            <?php if ($oAd): ?><input type="hidden" name="adForm[id]" value="<?php echo $oAd->getId(); ?>"/><?php endif; ?>
            <input style="border: none; float: left;" src="<?php echo BASE_DIR; ?>media/inloggad/img/spara.png" type="image" id="saveAdButton"/>
            </form>
            
        
            <form method="post" action="<?php echo BASE_DIR . $oBrf->getUrl() . '/profil/' . $oRealtorBrf->getUrl(); ?>">
                <input type="image" alt="Ta bort annons" src="<?php echo BASE_DIR; ?>media/inloggad/img/ta_bort2.png" id="removeAd" onclick="return confirm('Är du säker på att du vill ta bort annonsen?'); " style="border: none; float: right; margin-right: 15px;"/>
                <input type="hidden" name="action" value="removead"/>
            </form>
    </div>
</div>

<script>
    jQuery(function($) {
        $.datepicker.setDefaults({timeFormat: 'HH:mm'});
        $.datepicker.regional['sv'] = {
            closeText: 'Stäng',
            prevText: '&laquo;Förra',
            nextText: 'Nästa&raquo;',
            currentText: 'Idag',
            monthNames: ['Januari', 'Februari', 'Mars', 'April', 'Maj', 'Juni',
                'Juli', 'Augusti', 'September', 'Oktober', 'November', 'December'],
            monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun',
                'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
            dayNamesShort: ['Sön', 'Mån', 'Tis', 'Ons', 'Tor', 'Fre', 'Lör'],
            dayNames: ['Söndag', 'Måndag', 'Tisdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lördag'],
            dayNamesMin: ['Sö', 'Må', 'Ti', 'On', 'To', 'Fr', 'Lö'],
            weekHeader: 'Ve',
            dateFormat: 'yy-mm-dd',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: '',
            timeFormat: "HH:mm",
        };
        $.datepicker.setDefaults($.datepicker.regional['sv']);
    });

    $(function() {
        $(".datepicker").datepicker();
    });

    $('.time').timepicker({'timeFormat': 'H:i:s'});
    var isValid = false;
    $("#saveAdButton").click(function(){
        if (!isValid) {
            $("#formAction").val('validaterealtorad');
            var adForm = $("#adForm").serialize();
            adForm += "&required=";
            var requiredFields = [];
            $(".required").each(function(){
                requiredFields.push($(this).prop('name'));
            });
            adForm+=requiredFields.join(",");
            $("#adForm input,select").css('background-color', '');
            $.post("<?php echo BASE_DIR; ?>ajax.php", adForm, function (response) { 
                if (response.result) {
                    if (response.data.valid) {
                        isValid = true;
                        $('#formAction').val('<?php echo $oAd ? 'editad' : 'savead'; ?>');
                        $("#saveAdButton").click();
                    } else {
                        for (var field in response.data.errors) {
                            $("*[name='"+response.data.errors[field]+"']").css('background-color', 'red');
                        }
                        isValid = false;
                    }
                }
            }, 'json');
            return false;
        } else {
            return true;
        }
    });
</script>
<iframe id="upload_target" name="upload_target" style="width:0;height:0;border:0px solid #fff;" src="<?php echo BASE_DIR; ?>iframe.php"></iframe> 
<script type="text/javascript">
    
    var formAction = $("#adForm").attr('action');
    var imageType = '';
    
    function getImageType() {
        imageType = $("#upload_target").contents().find("body").html();
        $.post("<?php echo BASE_DIR; ?>ajax.php", { action : $("#formAction").val() , 'brf' : $("#picturenumber").val(), imageType : imageType }, function (response) { 
            if (response.result) {
                var listItem = $("#bild_medlem");
                var imgTag = "<img src=\"" + response.data.image + 
                    "\" height=\"<?php echo $iSmallImageHeight-20; ?>\"" +
                    " width=\"<?php echo $iSmallImageWidth-20; ?>\" " + 
                    "style=\"max-height:<?php echo ($iSmallImageHeight-20).'px; max-width:'.($iSmallImageWidth-20).'px; height: auto; width: auto;'; ?>\"/>";
            
                $(listItem).html(
                    imgTag  
                );
                    
                $("#attachPicture").val(1);
                ifrm = document.getElementById('upload_target');
                ifrm = (ifrm.contentWindow) ? (ifrm.contentWindow) : (ifrm.contentDocument.document)
                ifrm.domain = '<?php echo $sDomain; ?>';
            }
        },'json');
        $("#formAction").val('save');
    }
    
    function submitPicture() {
        $("#adForm").prop("target", 'upload_target');
        $("#formAction").val('temploadbrf');
        $("#adForm").prop('action', '<?php echo BASE_DIR; ?>temppicture.php');
        $("#adForm").submit();
        $("#adForm").attr('action', formAction);
        $("#adForm").removeAttr("target");
        window.setTimeout(getImageType, 1250);
    }
    
    $(document).ready(function(){
        $("#upfile").change(function(){
            submitPicture();
        });
    });
</script>