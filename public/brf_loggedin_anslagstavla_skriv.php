<script>document.domain = '<?php $sDomain = str_replace(array("https://","http://"),array('',''),BASE_DIR); $sDomain = substr($sDomain, 0, strlen($sDomain) - 1); echo $sDomain; ?>';</script>
<img id="bla_skylt" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/gor_ett_inlagg.png" width="210" height="36" alt="Skriv meddelande" />
<form name="kontaktform" id="kontaktform1" method="post" action="<?php echo BASE_DIR; ?><?php echo $oBrf->getUrl(); ?>/anslagstavla" enctype="multipart/form-data">
    <label for="namn">Rubrik</label>
    <br />
    <input type="text" name="namn" id="namn"/>
    <br />
    <label for="upfile">
    <div style="height: 170px; width: 123px; border:1px dashed #BBB; cursor:pointer; text-align:center;" id="bild_medlem">Klicka här för att ladda upp din bild!</div>
    </label>
    <a href="javascript:void(0)" onclick="$('#bild_medlem').html('Klicka här för att ladda upp din bild!'); $('#attachPicture').val(0); $(this).hide(); return false;" style="display:none;" id="removePictureLink">Ta bort bild</a>
    <br />
    <input type="file" name="file" id="upfile" style="display:none;"/>
    <textarea name="message" id="meddelande" cols="60" rows="14" style="resize: none;"></textarea> 
    <br />
    <input type="hidden" name="action" id="formAction" value="write_msg"/>
    <input type="hidden" name="attachPicture" value="1" id="attachPicture"/>
    <input type="hidden" id="picturenumber" name="brf1" value="<?php echo rand(1,10000); ?>"/>
    <input type="hidden" name="view" value="anslagstavla"/>
    <input type="image" name="submit" id="submit" src="<?php echo BASE_DIR; ?>media/inloggad/img/spara.png" />
</form>
<iframe id="upload_target" name="upload_target" style="width:0;height:0;border:0px solid #fff;" src="<?php echo BASE_DIR; ?>iframe.php"></iframe> 
<?php
    $iSmallImageHeight = 170+20;
    $iSmallImageWidth = 123+20;
?>
<script type="text/javascript">
    var formAction = $("#kontaktform1").attr('action');
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
                $("#removePictureLink").show();
                ifrm = document.getElementById('upload_target');
                ifrm = (ifrm.contentWindow) ? (ifrm.contentWindow) : (ifrm.contentDocument.document)
                ifrm.domain = '<?php echo $sDomain; ?>';
            }
        },'json');
        $("#formAction").val('write_msg');
    }
    function submitPicture() {
        $("#kontaktform1").prop("target", 'upload_target');
        $("#formAction").val('temploadbrf');
        $("#kontaktform1").prop('action', '<?php echo BASE_DIR; ?>temppicture.php');
        $("#kontaktform1").submit();
        $("#kontaktform1").attr('action', formAction);
        $("#kontaktform1").removeAttr("target");
        window.setTimeout(getImageType, 800);
    }
    
    
    function validateForm() {
        return $("#meddelande").val().trim().length > 0;
    }
    $(document).ready(function(){
        $("#upfile").change(function(){
            submitPicture();
        });
        
    });
</script>
