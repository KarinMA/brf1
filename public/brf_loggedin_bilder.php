<img id="bla_skylt" src="<?php echo BASE_DIR; ?>/media/inloggad/img/bla-skyltar_brf/bilder.png" width="210" height="36" alt="Bilder" />
<p>
    Här ligger bilder som styrelsen valt att ladda upp. Styrelsen kan lägga in ett obegränsat antal bilder för att dokumentera gårdsfester, renoveringar och annat som kan vara roligt att titta på.
</p>
<div class="entry-content" style="">
    <div id="fancygallery-2" class="fg-panel">
    <?php $aTexts = array(); ?>
    <?php foreach ($oBrf->getPictures() as $oPicture): ?>
    <?php if (!$oPicture->getFront()): ?>
    
        
    <div title="<?php echo $oPicture->getDescription(); ?>">
        <a href="<?php echo BASE_DIR; ?>getpicture.php?id=<?php echo $oPicture->getId(); ?>">
            <img title="<?php echo $oPicture->getDescription(); ?>" class="image2 image_<?php echo $oPicture->getId(); ?>" id="image_<?php echo $oPicture->getId(); ?>"/>
            <span><?php echo $oPicture->getTitle(); ?></span>
        </a>
        <?php foreach ($oBrf->getPictures() as $oPicture2): ?>
        <?php if ($oPicture2->getId() != $oPicture->getId() && !$oPicture2->getFront()): ?>
        <a href="<?php echo BASE_DIR; ?>getpicture.php?id=<?php echo $oPicture2->getId(); ?>">
            <img title="<?php echo $oPicture2->getDescription(); ?>" class="image_<?php echo $oPicture2->getId(); ?>"/>
            <span><?php echo $oPicture2->getTitle(); ?></span>
        </a>
        <?php endif; ?>
        
        <?php endforeach; ?>
        <?php $aTexts[] = $oPicture->getTitle(); ?>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    <script type="text/javascript">
        jQuery(document).ready(function(){
          jQuery('#fancygallery-2').fancygallery({
                  backgroundColor: '#F5F5F5', 
                  titleColor: '#383634', 
                  thumbWidth: 240, 
                  thumbHeight: 140,
                  thumbOpacity: 0.6, 
                  imagesPerPage: 100, 
                  titleHeight: 40, 
                  borderThickness: 3,
                  rowOffset: 15, 
                  columnOffset: 20, 
                  shadowOffset: 0, 
                  textFadeDirection: 'normal', 
                  shadowImage: '<?php echo BASE_DIR; ?>media/inloggad/bilder/shadow1.png',
                  hoverImage: '',
                  hoverImageEffect: 'fade',
                  navPosition: 'bottom', 
                  selectAlbum: '', 
                  dropdown: 1, 
                  divider: 1, 
                  showTitle: 1, 
                  slideTitle: 1,
                  inverseHoverEffect: 1,
                  secondThumbnail: 0,
                  /*timthumbUrl: '<?php echo BASE_DIR; ?>media/inloggad/bilder/css/radykal-fancy-gallery/admin/timthumb.php',  
                  timthumbParameters: '&zc=1&f=2', */
                  allMediasSelector: '', 
                  albumSelection: 'thumbnails',
                  navigation: false, //'arrows', 
                  navStyle: 'white', 
                  navAlignment: 'left', 
                  navPreviousText: '<',
                  navNextText: '>', 
                  navBackText: '<', 
                  thumbnailTransition: 'fade', 
                  lightbox: 'prettyphoto', 
                  boxOptions: { theme: 'pp_default', allow_resize: 1 , overlay_gallery: 1, autoplay_slideshow: 0, deeplinking: 0 , social_tools: '' },
                  columns: 3,
                  dropdownTheme: 'white',
                  showOnlyFirstThumbnail: 0,
                  mediaText: ''
          });
          
          $(".fg-back-to-albums").removeClass('fg-back-to-albums').removeClass('fg-pagination').removeClass('fg-nav-white').html('&lt;&lt;&nbsp;Tillbaka');
          
          $(".image2").one('load', function() {
            // do stuff
            var _id = $(this).prop('id');
            $.post("<?php echo BASE_DIR; ?>ajax.php", { action : 'loadimage', imageId : _id }, function (response) {
                    if (response.result) {
                        console.log("image"  + _id);
                        $("." + _id).prop("src", response.data.imageData);
                        setHeight();
                    } else {
                        console.log("no result");
                    }
                },'json');
            }).each(function() {
                if(this.complete) $(this).load();
            })<?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')): ?>.load()<?php endif; ?>;
            
            $("li.fg-album-thumbnail > a").click(function(){
                window.setTimeout(setHeight, 100);
            });
        });
        
        

        function showTitle(eq, text) {
            $("div.fg-album-thumbnail-length").eq(eq).text(text).show();
        }
        <?php foreach ($aTexts as $iTextIndex => $sText): ?>
            window.setTimeout('showTitle(<?php echo $iTextIndex; ?>, "<?php echo $sText; ?>")', 500);
        <?php endforeach; ?>
        </script>
    </div>
</div>

<link rel='stylesheet' id='prettyphoto-css' href='<?php echo BASE_DIR; ?>media/inloggad/bilder/css/prettyphoto/css/prettyPhoto.css' type='text/css' media='all' />
<link rel='stylesheet' id='fancybox-css'  href='<?php echo BASE_DIR; ?>media/inloggad/bilder/css/fancybox/jquery.fancybox.css' type='text/css' media='all' />
<link rel='stylesheet' id='fancybox-buttons-css'  href='<?php echo BASE_DIR; ?>media/inloggad/bilder/css/fancybox/helpers/jquery.fancybox-buttons.css' type='text/css' media='all' />
<link rel='stylesheet' id='fancybox-thumbs-css'  href='<?php echo BASE_DIR; ?>media/inloggad/bilder/css/fancybox/helpers/jquery.fancybox-thumbs.css' type='text/css' media='all' />
<link rel='stylesheet' id='radykal-fancy-gallery-css'  href='<?php echo BASE_DIR; ?>media/inloggad/bilder/css/css/jquery.fancygallery.css' type='text/css' media='all' />
<script type="text/javascript" src="<?php echo BASE_DIR; ?>media/inloggad/bilder/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?php echo BASE_DIR; ?>media/inloggad/bilder/js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php echo BASE_DIR; ?>media/inloggad/bilder/js/jquery.fancybox-media.js"></script>
<script type="text/javascript" src="<?php echo BASE_DIR; ?>media/inloggad/bilder/js/jquery.fancybox-buttons.js"></script>
<script type="text/javascript" src="<?php echo BASE_DIR; ?>media/inloggad/bilder/js/jquery.fancybox-thumbs.js"></script>
<script type="text/javascript" src="<?php echo BASE_DIR; ?>media/inloggad/bilder/js/jquery.fancygallery.min.js"></script>
<style type="text/css">
.entry-content, .entry-summary {
    margin-left: 15px;
    margin-right: 15px;
    padding: 1.625em 0 0;
    width: 600px;
}

li.fg-album-thumbnail {
    border: 1px solid #E9E9E9;
    box-shadow: none;
    float: left;
    line-height: 0 !important;
    margin-bottom: 40px;
    margin-right: 40px !important;
    width: 140px;
}

.fg-thumbHolder {
    width: 500px;
}

.fg-pagination {
    display: none;
}

li.fg-album-thumbnail a {
    display: block;
    height: 90px;
    overflow: hidden;
    width: 200px;
}

.fg-listItem { 
    width: 200px !important; 
    /*height: 186px; 
    margin: 0px 15px 95px 0px; */

    margin-right: 40px !important;
    /* display: list-item; */
    clear: none !important;
}

.fg-thumb {width:200px !important; }

.fg-image { width: 200px !important;}

.fg-title { width:200px; }

div.fg-album-thumbnail-length {
    display: none;
}



</style>

        