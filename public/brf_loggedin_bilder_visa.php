<?php
    //$aPictureIds = range(1,5);
    $aPictureIds = array();
    $oPictures = getBrf()->getPictures();
    $aPictures = array();
    foreach ($oPictures as $oPicture) {
        $aPictureIds[] = $oPicture->getId();
        $aPictures[$oPicture->getId()] = $oPicture;
    }
?>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_DIR; ?>media/inloggad/css/jquery.ad-gallery.css" />
<script type="text/javascript" src="<?php echo BASE_DIR; ?>media/inloggad/js/jquery.ad-gallery.min.js"></script>
<script type="text/javascript">
   $(function() {
     <?php foreach ($aPictureIds as $iIndex => $iPictureId): ?>
     $('img.imagegallery<?php echo $iIndex; ?>').data('ad-desc', '<?php echo $aPictures[$iPictureId]->getDescription(); ?>');
     $('img.imagegallery<?php echo $iIndex; ?>').data('ad-title', '<?php echo $aPictures[$iPictureId]->getTitle(); ?>');
     <?php endforeach; ?>
     var galleries = $('.ad-gallery').adGallery({
        slideshow: {
            enable: true,
            autostart: false,
            speed: 5000,
            start_label: '<span style="cursor: default;">Bildspel: </span>Starta',
            stop_label: 'Stoppa'
            // Should the slideshow stop if the user scrolls the thumb list?
            //stop_on_scroll: true, 
            // Wrap around the countdown
            //countdown_prefix: '(', 
            //countdown_sufix: ')',
            //onStart: function() {
              // Do something wild when the slideshow starts
            //},
            //onStop: function() {
              // Do something wild when the slideshow stops
            //}
        }
     });
     $('#switch-effect').change(
       function() {
         galleries[0].settings.effect = $(this).val();
         return false;
       }
     );
     //$('#toggle-slideshow').click(
       //function() {
         //galleries[0].slideshow.toggle();
         //return false;
       //}
     //);
     $('#toggle-description').click(
       function() {
         if(!galleries[0].settings.description_wrapper) {
           galleries[0].settings.description_wrapper = $('#descriptions');
         } else {
           galleries[0].settings.description_wrapper = false;
         }
         return false;
       }
     );
   });
</script>

<style type="text/css">
    * {
        font-family: 'Open Sans', sans-serif;
        color: #000;
        line-height: 140%;
    }
    select, input, textarea {
        font-size: 1em;
    }
    body {
        padding: 30px;
        font-size: 70%;
        //width: 800px;
    }
    h2 {
        margin-top: 1.2em;
        margin-bottom: 0;
        padding: 0;
        border-bottom: 1px dotted #dedede;
    }
    h3 {
        margin-top: 1.2em;
        margin-bottom: 0;
        padding: 0;
    }
    .example {
        border: 1px solid #CCC;
        background: #f2f2f2;
        padding: 10px;
    }
    ul {
        list-style-image:url(list-style.gif);
    }
    pre {
        font-family: 'Open Sans', sans-serif;
        border: 1px solid #CCC;
        background: #f2f2f2;
        padding: 10px;
    }
    code {
        font-family: 'Open Sans', sans-serif;
        margin: 0;
        padding: 0;
    }

    #gallery {
        padding: 30px;
        background: #FFF;
    }
    #descriptions {
        position: relative;
        height: 50px;
        background: #FFF;
        margin-top: 10px;
        width: 640px;
        padding: 10px;
        overflow: hidden;
    }
    #descriptions .ad-image-description {
        position: absolute;
    }
    #descriptions .ad-image-description .ad-description-title {
        display: block;
    }
</style>
<div id="container">
    <div id="gallery" class="ad-gallery">
        <div class="ad-image-wrapper">
        </div>
        <div class="ad-controls">
        </div>
        <div class="ad-nav">
            <div class="ad-thumbs">
                <ul class="ad-thumb-list">
                    <?php foreach ($aPictureIds as $iIndex => $iPictureId): ?>
                    <?php $oPicture = $aPictures[$iPictureId]; ?>
                    <li>
                        <a href="<?php echo BASE_DIR; ?>getpicture.php?id=<?php echo $iPictureId; ?>">
                            <img src="<?php echo $oPicture->getImageData(); ?>" class="imagegallery<?php echo $iIndex; ?>" style=width:90px; height: 60px;"/>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>