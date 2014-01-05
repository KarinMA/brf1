<?php $bIsIE = (bool) strpos($_SERVER['HTTP_USER_AGENT'], "IE"); ?>
<script>document.domain = '<?php $sDomain = str_replace(array("https://","http://"),array('',''),BASE_DIR); $sDomain = substr($sDomain, 0, strlen($sDomain) - 1); echo $sDomain; ?>';</script>
<?php
$oPictures = NULL;
if (@$_POST['save_x'] && $_POST['save_y']) {
    switch ($sAction) {
        case 'saveGalleryAndStreetView':
            if (array_key_exists('Gatuvy', $_POST)) {
                $oBrf->setShowStreetView((bool)@$_POST['Gatuvy']);
            }
            if (@$_FILES['newpicture']) {
                for ($iPictureCounter = 0; $iPictureCounter < count($_FILES['newpicture']['error']); $iPictureCounter++) {
                    if (!$oBrf->savePictureArray(array(
                                'name' => $_FILES['newpicture']['name'][$iPictureCounter],
                                'type' => $_FILES['newpicture']['type'][$iPictureCounter],
                                'tmp_name' => $_FILES['newpicture']['tmp_name'][$iPictureCounter],
                                'error' => $_FILES['newpicture']['error'][$iPictureCounter],
                                'size' => $_FILES['newpicture']['size'][$iPictureCounter]
                    ), $_POST['title'], $_POST['description'], FALSE)) {
                        // ...
                    }
                }
            }
            break;
        case 'saveFrontPictures':
            
            $oPictureCollection = $oBrf->getPictures();
            $aPictures = array();
            // some pictures will be saved, others removed, others added
            foreach ($_POST['pictureId'] as $iPictureIndex => $sPictureId) {
                if (is_numeric($sPictureId)) {
                    // existing picture
                    foreach ($oPictureCollection as $oPictureObject) {
                        if ($oPictureObject->getId() == $sPictureId) {
                            $aPictures[$sPictureId] = $oPictureObject;
                            break;
                        }
                    }
                } else if (!@$_FILES['frontPicture']['error'][$iPictureIndex]) {
                    // new picture
                    $oNewBrfPicture = $oBrf->savePictureArray(array(
                        'name' => $_FILES['frontPicture']['name'][$iPictureIndex],
                        'type' => $_FILES['frontPicture']['type'][$iPictureIndex],
                        'tmp_name' => $_FILES['frontPicture']['tmp_name'][$iPictureIndex],
                        'error' => $_FILES['frontPicture']['error'][$iPictureIndex],
                        'size' => $_FILES['frontPicture']['size'][$iPictureIndex]
                    ), '', '', TRUE);
                    if ($oNewBrfPicture) {
                        $aPictures[$oNewBrfPicture->getId()] = $oNewBrfPicture;
                    }
                } else {
                    // delete picture...
                }
            }
            
            // delete
            foreach ($oPictureCollection as $oPictureObject) {
                if (!array_key_exists($oPictureObject->getId(), $aPictures) && $oPictureObject->getFront()) {
                    $oPictureObject->delete();
                } else if (!$oPictureObject->getFront()) {
                    $aPictures[$oPictureObject->getId()] = $oPictureObject;
                }
            }
            $oPictures = $aPictures;
            break;
    }
}
$oPictureCollection = $oPictures;
if (!isset($oPictureCollection)) {
    $oPictureCollection = $oBrf->getPictures();
}

$bStreetView = FALSE;
if (($aStreetData = getStreetData($oBrf)) && count($aStreetData) && array_key_exists('image_url', $aStreetData)) {
    $bStreetView = TRUE;
}
$iSmallImageHeight = 90;
$iSmallImageWidth = 110;
?>
<img id="bla_skylt" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/styrelseadmin.png" width="210" height="36" alt="styrelseadmin"/>
<p>Här lägger du in föreningens bilder. Välj vilka bilder som ska visas på den publika sidan som alla kan se samt de bilder som endast medlemmarna kan ta del av.</p>

<h2 style="margin-left:15px;">Bilder - publikt bildspel</h2>

<p>Klicka på Ladda upp bild och välj en bild du vill ladda upp. Bilden visas i den ruta du klickat i. Vill du ladda upp en bild till klickar du på nästa ruta. Bilderna visas i den ordning du valt att ladda upp de enligt rutornas ordning nedan. Man kan maximalt ladda upp fyra bilder för det offentliga bildspelet. Tryck därefter på Spara.</p>

<p><i>Obs! Tänk på att bilden du laddar upp bör vara en liggande bild eftersom den visas i det formatet på er förenings offentliga sida.</i></p>

<div id="galleri">
    <form method="post" action="" id="form" enctype="multipart/form-data">
    <div id="imageList">
    <!-- flera, max 4 -->
    <?php $iFrontPictureFileFieldCounter = 0; ?>
    <?php $iFrontPictureCounter = 0;
    foreach ($oPictureCollection as $oPicture): ?>
    
    <?php if ($oPicture->getFront()): ?>
            <div class="img exists occupied">
                <input type="file" class="upfile" id="upfile<?php echo $iFrontPictureCounter; ?>" name="frontPicture[]" style="display:none;"/>
                <input type="hidden" name="pictureId[]" class="pictureId" value="<?php echo $oPicture->getId(); ?>"/>
                <label for="upfile<?php echo $iFrontPictureCounter; ?>">
                    <a href="javascript:void(0)" onclick="<?php if (!$bIsIE): ?>$('#upfile<?php echo $iFrontPictureCounter; ?>').click();<?php endif; ?>  return true;">
                        <img width="<?php echo $iSmallImageWidth; ?>" id="picture_<?php echo $oPicture->getId(); ?>" height="<?php echo $iSmallImageHeight; ?>" alt="Ladda upp bild" src="<?php //echo $oPicture->getImageData(); ?>" class="img_text postload"/>
                    </a>
                </label>
                <div class="desc ta_bort"><a href="javascript:void(0)">Ta bort bild</a></div>
            </div>
            <?php $iFrontPictureCounter++; $iFrontPictureFileFieldCounter++;
        endif;
    endforeach; ?>
<?php for ($iFronPictureIndex = 4; $iFronPictureIndex > $iFrontPictureCounter; $iFronPictureIndex--): ?>
        <div class="img">
            <input type="file" class="upfile" id="upfile<?php echo $iFronPictureIndex; ?>" name="frontPicture[]" style="display:none;"/>
            <input type="hidden" name="pictureId[]" class="pictureId" value=""/>
            <label for="upfile<?php echo $iFronPictureIndex; ?>">
            <!-- $('.upfile:eq(<?php echo $iFrontPictureFileFieldCounter; ?>)').click(); -->
            <a href="javascript:void(0)" onclick="<?php if (!$bIsIE): ?>$('#upfile<?php echo $iFronPictureIndex; ?>').click();<?php endif; ?> return true;">
                Ladda upp bild
            </a>
            </label>
            <div class="desc">...</div>
        </div>
<?php $iFrontPictureFileFieldCounter++; endfor; ?>
    </div>
    
        <input type="image" align="left" alt="spara" style="position:relative;top:-10px; width:78px; height:28px; border:0;" src="<?php echo BASE_DIR; ?>media/inloggad/img/spara.png" name="save" id="saveFrontPictures"/>
        <input type="hidden" name="action" id="formAction" value="saveFrontPictures"/>
        <input type="hidden" name="pictureIndex" id="pictureIndex" value=""/>
        <input type="hidden" name="brf11" id="brf11" value="<?php echo rand(1000,9999); ?>"/>
    </form>

    <br />
    <br />
    <form method="post" action="" enctype="multipart/form-data">
<?php if ($bStreetView): ?>
        <br />
        <br />
        <br />
        <h2 style="margin-top:150px; margin-left:0px;">Gatuvy</h2>
        <p style="margin-left:1px;">Om du inte vill visa den tillgängliga gatuvyn från Hitta.se på er offentliga sida så klicka ur rutan &quot;Visa gatuvy&quot;. </p>
        <div id="Gatuvy">
            <img src="<?php echo $aStreetData['image_url']; ?>" height="200" width="498"/>
        </div>

        <input type="hidden" name="Gatuvy" value="0"/>
        <input type="checkbox" value="1" name="Gatuvy" id="Gatuvy1"<?php if ($oBrf->getShowStreetView()): ?> checked="checked"<?php endif; ?>/><label for="Gatuvy1">Visa gatuvy från hitta.se</label>

<?php else: ?>
        <h2 style="margin-top: 150px;"></h2>        
<?php endif; ?>

    <?php if (!$bStreetView): ?>
    <br />
    <br />
    <?php endif; ?>
    <h2 style=" margin-left:0px;">Bilder - galleri för medlemmar</h2>
    <p style="margin-left:1px;">Här laddar ni upp de bilder som endast visas för medlemmarna. Klicka på knappen välj fil och välj sedan den bild ni vill ladda upp. Därefter kan ni ge bilden en titel och en kortfattad beskrivning som visas under bilden. Bilderna visas som tumnaglar nedan. Klicka på Spara när du laddat upp de bilder du valt. Ni kan ladda upp obegränsat med bilder.</p>
    <p style="margin-left:1px;">Klicka på Ta bort under bilden om ni vill ta bort någon bild ni laddat upp.</p>
    <p style="margin-left:1px;">Svensk Brf kommer att lägga till möjligheten att lägga bilder i olika mappar. Vi återkommer snart med denna funktion och tackar för ert tålamod!</p>

    <label for="document">Välj en bild:</label>
    <input type="file" style="width: 200px;" name="newpicture[]" id="document"/>
        <br />
        Titel: 
        <input type="text" name="title" style="margin-left:33px;">
        <br />
        Beskrivning: 
        <input type="text" name="description" style="margin-left:3px;">
        <br />
        <input type="image" align="left" alt="spara" style="position:relative;top:20px; width:78px; height:28px; border:0; margin-bottom:30px;" src="<?php echo BASE_DIR; ?>media/inloggad/img/spara.png" name="save"/>
        <input type="hidden" name="action" value="saveGalleryAndStreetView"/>
    </form>

    <br />
    <br />
    <br />
    <br />
    <br />
    <br />

    <!-- Flera -->
<?php foreach ($oPictureCollection as $oPicture): ?>
    <?php if (!$oPicture->getFront()): ?>
            <div class="img">
                <a href="javascript:void(0)" target="_blank">
                    <img width="<?php echo $iSmallImageWidth; ?>" id="picture_<?php echo $oPicture->getId(); ?>" height="<?php echo $iSmallImageHeight; ?>" alt="Bild" src="<?php echo $oPicture->getImageData(); ?>" class="img_text postload"/>
                </a>
                <div class="desc"><!--<?php echo $oPicture->getTitle(); ?><br/><br/>--><a href="javscript:void(0)" onclick="return removePicture(this, <?php echo $oPicture->getId(); ?>)">Ta bort bild</a></div>
             </div>
    <?php endif;
endforeach; ?>

    
</div>
<iframe id="upload_target" name="upload_target" style="width:0;height:0;border:0px solid #fff;"></iframe> 
<script type="text/javascript">
    $("a.nav:contains('Bilder'):eq(1)").css('font-style', 'oblique');
</script>     
<style type="text/css">
    #Gatuvy {
        border: 1px solid #DDDDDD;
        height: 200px;
        margin-left: 2px;
        width: 498px;
    }

    #bild_medlem {width: 100px;
    height:100px; }


    #galleri {
        margin-left: 15px;
       }

    div.img {
        border: 1px solid #DDDDDD;
        float: left;
        height: 96px;
        margin: 2px;
        margin-bottom: 50px;
        padding-bottom: 3px;
        text-align: center;
        width: 120px;
    }

    div.img img
      {
      display:inline;
      margin:3px;
      border:1px solid #ffffff;
      }
      
    div.img a:hover img
      {
      border:1px solid #fff;
      }

      
    div.desc
      {
      text-align:center;
      font-weight:normal;
      width:100px;
      /*margin:4px;*/
      position: relative;
      top: 5px;
      background-color:transparent;
      }

    .img_text { height: auto; width: auto; max-height: <?php echo $iSmallImageHeight; ?>px; max-width: <?php echo $iSmallImageWidth; ?>px; min-height: 90px; }
</style>
<script type="text/javascript">
    
    function removePicture(link, gallery) {
        if (!gallery) {
            var listItem = $(link).parent();
            var index = $("#imageList div.ta_bort").index(listItem);
            var imageList = $("#imageList > div.img").filter(".occupied").eq(index);
            $(imageList).find("a").find("img").remove().end().html("Ladda upp bild");
            $(imageList).find("input.pictureId").val("");
            $(imageList).removeClass('occupied').removeClass('exists');
            $(listItem).removeClass("ta_bort").html("...");
        } else {
            if (confirm('Är du säker på att du vill ta bort bilden?')) {
                $.post("<?php echo BASE_DIR; ?>ajax.php", { action : 'removepicture', id : gallery }, function (response) {
                    if (response.result) {
                        $(link).parent().parent().remove();
                    }
                }, 'json');    
            }
        }
        return false;
    }
    var imageType = '';
    function getImageType(_upFile, pictureIndex)
    {
        imageType = $("#upload_target").contents().find("body").html();
        $.post("<?php echo BASE_DIR; ?>ajax.php", { action : $("#formAction").val() , 'brf'  : $("#brf11").val(), imageType : imageType }, function (response) { 
            var listItem = $("#imageList").find("div.img").eq(pictureIndex);
            listItem.removeClass('exists').addClass('occupied');
            $(listItem).find("a").html('<img src="' + response.data.image +'" height="<?php echo $iSmallImageHeight; ?>" width="<?php echo $iSmallImageWidth; ?>" class="img_text" alt="Ladda upp bild"/>');
            // set the remove link
            $(listItem).find("div.desc").addClass('ta_bort').html('<a href="javascript:void(0)" onclick="removePicture(this);">Ta bort bild</a>');
            $("#formAction").val('saveFrontPictures');
            $("#upload_target").document.domain = '<?php echo $sDomain; ?>';
        },'json');
    }
    var _upFile = null;
    
    function submitPicture(_upFile, index) {
        $("#form").prop("target", 'upload_target');
        $("#formAction").val('temploadbrf');
        $("#form").attr('action', '<?php echo BASE_DIR; ?>temppictureadm.php');
        $("#form").submit();
        $("#form").attr('action', '');
        $("#form").removeAttr("target");
        
        window.setTimeout('getImageType(_upFile, '+index+')', 800);        
    }
    
    $(document).ready(function() {
        
        $(".upfile").change(function(){
            var index = $("input.upfile").index($(this));
            $("#pictureIndex").val(index);
            $("input.pictureId").eq(index).val("");
            _upFile = $(this);
            submitPicture(_upFile, index);
        });
        $("img.postload").each(function(){
            var _img = $(this);
            $.post("<?php echo BASE_DIR; ?>ajax.php", { action : 'loadimage', imageId : $(_img).prop("id").replace(/\D/g,'') }, function (response) {
                if (response.result) {
                    $(_img).prop("src", response.data.imageData);
                    $(_img).parent().next().find("a").show();
                }
            },'json');
        });


        $(".ta_bort > a").click(function() {
            removePicture(this);
        });
        
        $("#saveFrontPictures").click(function(){
           return true;
        });
    });
    
    $("a.nav:contains('SMS-inställningar')").css('font-style', 'oblique');$("a.nav:contains('Bilder'):eq(1)").css('font-style', 'oblique');
</script>
