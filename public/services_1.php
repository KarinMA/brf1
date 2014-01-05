<?php
    
    // any action?
    switch ($sAction) {
        case 'test_services':
            $bEditView = TRUE;
            break;
        default:
            break;
    }



    $aServicesIntroContentPieces = array(
        'services_intro1_full', 
        'services_intro2_full', 
    );
    $aServicesContentPieces = array(
        // piecce
        'services_homepage_full',
        'services_booking_full',
        'services_pictures_full', 
        'services_document_full', 
        'services_contract_full', 
        'services_calendar_full', 
        'services_smsmail_full', 
        'services_msgboard_full', 
    );
    $aStartPageContentPieces = array_merge(array(
        'logo_tagline', 
    ), $aServicesContentPieces, $aServicesIntroContentPieces, $aServicesContentPieces);
    
    $aStartPageContent = array();
    foreach ($aStartPageContentPieces as $sContentPiece) {
        $aStartPageContent[$sContentPiece] = isset($bEditView) ? trim($_POST['content'][$sContentPiece]) : getStartpageAccessor()->getStartpageByName($sContentPiece)->getContent();
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Tjänster | SvenskBrf.se</title>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_DIR; ?>media/stil.css">
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <style type="text/css">
            #sidebar { 
              width: 190px; 
              position: fixed; 
              //height:100px;
              margin-left: 1000px; 
            }
        </style>
    </head>
    <body>
         <div id="content">
              <div id="sidebar">
                  <ol>
                      <?php foreach ($aServicesContentPieces as $sServiceContentPiece): ?>
                      <?php $sContentHeaderName = str_replace('_full', '', $sServiceContentPiece); ?>
                      <li><a href="#<?php echo $sContentHeaderName ?>"><?php echo getStartpageAccessor()->getStartpageByName($sContentHeaderName . '_header')->getContent(); ?></a></li>
                      <?php endforeach; ?>
                  </ol>
              </div>
            
            <div id="header">

                <!--<div>
                    <p class="sok"><?php echo $aStartPageContent['search_header']; ?></p>
                    <form>
                        <label> 
                            <input type="text" id="sok" name="search_brf"/>
                        </label>
                    </form>
                </div>-->

                <img src="<?php echo BASE_DIR; ?>media/start/img/logga.png" width="248" height="85" alt="logga" />
                <p><?php echo $aStartPageContent['logo_tagline']; ?></p>

                <!--<ul>
                    <li><a href="#content">Hem</a></li>
                    <li><a href="#om_oss">Om oss</a></li>
                    <li><a href="#aktivera">Aktivera</a></li>
                    <li><a href="#kontakt">Kontakt</a></li>
                </ul>-->
            </div>
            <div class="box">
                <div class="height">
                    <h1>Tjänster</h1>
                    <?php foreach (array_combine(array('vanster', 'hoger'), $aServicesIntroContentPieces) as $sClass => $sContentPiece): ?>
                    <div class="<?php echo $sClass; ?>">
                        <p><?php echo nl2br($aStartPageContent[$sContentPiece]); ?></p>
                    </div>
                    <?php endforeach; ?>
                    <br class="clear"/>
                    <?php foreach ($aServicesContentPieces as $sServiceContent): ?>
                    <?php $sHeaderName = preg_replace("/(services_[a-z]+_)full/", "\\1header", $sServiceContent);  ?>
                    <?php $sPictureName = preg_replace("/(services_[a-z]+)_full/", "\\1", $sServiceContent);  ?>
                    <div id="<?php echo $sPictureName; ?>">
                        <h4>
                            
                            <img width="35" height="35" alt="<?php echo getStartpageAccessor()->getStartpageByName($sHeaderName)->getContent(); ?>" src="<?php echo BASE_DIR; ?>media/start/img/ikoner/<?php echo $sPictureName; ?>.png" class="ikon"><?php echo getStartpageAccessor()->getStartpageByName($sHeaderName)->getContent(); ?>
                        </h4>
                    <p class="margin"><?php echo nl2br($aStartPageContent[$sServiceContent]); ?></p>
                    </div>
                    <br class="clear"/>
                    <?php endforeach; ?>
                </div>
            </div>
             
            
         </div>
        <script type="text/javascript">
            $(document).ready(function() {

                var $sidebar   = $("#sidebar"), 
                    $window    = $(window),
                    offset     = $sidebar.offset(),
                    topPadding = 5;

                $window.scroll(function() {
                    if ($window.scrollTop() > offset.top) {
                        $sidebar.stop().animate({
                            marginTop: $window.scrollTop() - offset.top + topPadding
                        });
                    } else {
                        $sidebar.stop().animate({
                            marginTop: 0
                        });
                    }
                });

            });
        </script>
    </body>
</html>