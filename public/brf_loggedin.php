<?php
    if (@$_SESSION['sendRegisterMail']) {
        SvenskBRF_Notice::sendRegisterCompleteNotification($oBrf, getUser()->getEmail(), getUser()->getCellphone(), getUser()->getId());
        $_SESSION['sendRegisterMail'] = NULL;
        unset($_SESSION['sendRegisterMail']);
    }

    $sView = @$_REQUEST['view'] && file_exists("./brf_loggedin_".$_REQUEST['view'] . ".php") ? $_REQUEST['view']:  'senastenytt';
    if ($sView == "senastenytt" && getUser()->getUserType() != SvenskBRF_User::USER_TYPE_MEMBER) {
        $sView = "profil";
    }
    $sSubView = @$_REQUEST['subview'] ? $_REQUEST['subview'] : '';
    $sJsAction = "";
    $bRegistered = TRUE;
    if (!getUser()->getIsRegistered()) {
        // show register page only
        $bRegistered = FALSE;
        if ($sView != 'medlem') {
            $sView = 'medlem';
        }
        if (getUser()->getUserType() == SvenskBRF_User::USER_TYPE_REALTOR) {
            $sView = 'installningar';
        }
        $sJsAction = '$("ul.navbar > li").not("#dittKontoMenu").remove(); $("a.userLink,a.hoger_lankar").remove();';
    }
    
    switch ($sAction) {
        case 'send_message':
            $aReceivers = @$_REQUEST['receiver'];
            if (is_array($aReceivers) && count($aReceivers)) {
                $oMessage = getMessageAccessor()->createNew($_REQUEST['meddelande'], "Meddelande från " . getUser()->getName(), getUser()->getId(), $oBrf->getId());
                $oBrf->getMessageCollection()->addObject($oMessage);
            }
            $sView = 'senastenytt';
            break;
        case 'savedocument':
            if (@$_FILES['file1'] && $_POST['documentType'] && @$_POST['dType'])
            {
                SvenskBRF_Document::saveDocument(
                    $oBrf, 
                    @$_FILES['file1'], 
                    @$_POST['documentType'], 
                    @$_POST['public'], 
                    !@array_key_exists('documentType_prepend', $_POST) ?    
                    (@$_POST['name']) : 
                    (
                        ($_POST['documentType_prepend'] ? 
                        $_POST['documentType_prepend'] : 'Dokumentarkiv')
                        .
                            " _ "
                        .
                        ($_POST['name'] ? $_POST['name'] : $_FILES['file1']['name'])
                    )
                    , 
                    (int) @$_POST['year'],
                    (bool) @$_POST['isBoard']
                );
            }
            break;
        case 'savepresentation':
            $oBrf->setPresentation($_POST['presentation']);
            $sJsAction = "showMessage('Presentationstexten ändrades', 'OK');";
            break;
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Svensk Brf | <?php echo $oBrf->getName(); ?></title>
        <link href="<?php echo BASE_DIR; ?>/media/inloggad/css/test_inloggad.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-1.9.1.min.js"></script>
        <link href="<?php echo BASE_DIR; ?>media/inloggad/css/nyheter_inloggad.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery.li-scroller.1.0.1.js"></script>
        <script type="text/javascript">
            function toggleMenu(headItem, arrow) {
                if (!arrow) {
                    $(headItem).next().toggle('slow');
                }
                
                if ($(headItem).text().indexOf('<') != -1) {
                    $(headItem).text($(headItem).text().replace('<', '>'));
                } else {
                    $(headItem).text($(headItem).text().replace('>', '<'));
                }
                return false;
            }
            
            function initMenu(menu, board) {
                if (!board) {
                    $(".menulink").not(menu).parent().prop('style', '');
                    $(menu).show().parent().prop('style', 'border: 1px solid #98daff; background-color: #e7e7e7;');
                } else {
                    
                }
                toggleMenu($(menu).prev(), true);
            }
        </script>
        <style type="text/css">
            
            .menulink {
                margin-left: 10px;
            }
            .lista5 {
                width: 120px !important;
            }
            
            .siffra1 {
                background-image: url('<?php echo BASE_DIR; ?>media/inloggad/img/rod_markering2.png'); 
                color: #FFFFFF;
                left: 155px;
                position: absolute;
                background-repeat:no-repeat;
                z-index: 1000;
            }

            .siffra { 
                background-image: url("<?php echo BASE_DIR; ?>media/inloggad/img/rod_markering.png"); 
                width: 32px; 
                height: 28px; 
                text-align: center; 
                background-position: 0px -2px;
                color: #fff;
                left: 126px; 
                position: absolute; 
                text-align:center;
                background-repeat:no-repeat;
            }	
            
            #nyhetsflode li.nyhetsflode {
                display: none;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">

            <div id="header"><!-- Start på Header --> 

                <a href="<?php echo BASE_DIR; ?>"><img id="logga" src="<?php echo BASE_DIR; ?>media/inloggad/img/SvenskaBrf_logga_1.png" width="147" height="54" alt="logotyp"<?php if (isBrfNameMultipleLine($oBrf, 23)): ?> style="top: 50px;"<?php endif; ?>/></a>

                <div id="center_rubrik">
                    <ul class="brf_namn">
                        <li id="brf"><?php if (SvenskBRF_User::USER_TYPE_MEMBER == getUser()->getUserType()): ?>Brf<?php else: ?>Svensk<?php endif; ?></li>
                        <li id="brf_namn"><?php if (SvenskBRF_User::USER_TYPE_MEMBER == getUser()->getUserType()): ?><?php echo $oBrf->getName(); ?><?php else: ?>Brf<?php endif; ?></li>
                    </ul>
                </div>

                <form id="logga2" action="" method="post">
                    <input type="hidden" name="action" value="logout"/>
                    <input type="image" class="logga_ut" src="<?php echo BASE_DIR; ?>media/inloggad/img/logga_ut.png" alt="logga ut" name="user" style="width:56px;height:22px;"/>
                </form>
            </div>
            <!-- Slut på Header -->  

            <div id="left">
                <?php $iNumberOfUnreadEmails = getUser()->getNumberOfUnreadMails(); ?>
                <?php include './brf_loggedin_menu_' . getUser()->getUserType() . '.php'; ?>
                <div class="marginal_bottom"></div> 
            </div>
            <div id="contents">
                <div class="height">
                        <?php include 'brf_loggedin_' . $sView . '.php'; ?>
                    <div id="maklarinfo">
                        <img class="linje" src="<?php echo BASE_DIR; ?>media/inloggad/img/linje.png" width="524" height="12" alt="linje" />
                        <?php
                            //$oBrf = SvenskBRF_Brf::loadByUrl(LOAD_URL);
                            /*$oLoggedInUser = getUser();
                            ?>
                            <?php if ($oLoggedInUser->getUserType() == SvenskBRF_User::USER_TYPE_MEMBER): ?>
                            <?php $bAd = FALSE; ?>
                            <?php if (FALSE || ($oRealtorUser = $oBrf->getRealtorUser()) && ($oAdCollection = $oRealtorUser->getAdvertisements($oBrf)) && $oAdCollection->size()): ?>
                                    <?php $bAd = TRUE; $oAd = $oAdCollection->current(); ?>
                                    <?php include './brf_realtor_ad.php'; ?>
                                <?php else: ?>
                            <div class="marknadskollen">
                                <?php //include './brf_di_news.php'; ?>
                                <h6><a href="http://www.di.se/compricersidor/bolan/" target="_blank" style="color:#000;">LÄGSTA BOLÅNERÄNTAN &gt;</a></h6>
                                <?php include './brf_mortgage_rate_table.php'; ?>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php if ($oLoggedInUser->getUserType() == SvenskBRF_User::USER_TYPE_MEMBER): ?>
                            <div id="maklarinfo_vanster">
                                    <?php if ($oRealtorUser): ?>
                                <h4 style="font-size: 2.4em; margin-left: 25px; padding-bottom: 30px; margin-bottom: 3px; font-weight: 100;">Föreningens Mäklare</h4>
                                <img class="foto" src="<?php echo $oRealtorUser->getImageData(); ?>" width="70" height="105" />
                                <img id="logga_maklare" src="<?php echo $oRealtorUser->getExternalPartner()->getImageData(); ?>" style="height: auto; width: 100%; max-width: 140px; max-height: 37px;"/> 
                                <p class="maklare_uppgifter">
                                    <strong><?php echo $oRealtorUser->getName(); ?></strong>
                                    <br />
                                    Kontakta mig om du har frågor om bostadsmarknaden eller vill ha en kostnadsfri värdering. <br/><br/>
                                    <a href="<?php echo BASE_DIR; ?><?php echo $oBrf->getUrl(); ?>/maklare" class="userLink">Läs mer &gt;</a>
                                </p>

                                <p class="maklare_uppgifter">
                                    Tel: <?php echo $oRealtorUser->getCellphone(); ?>
                                    <br />
                                    Mail: <a href="mailto:<?php echo $oRealtorUser->getEmail(); ?>"><?php echo $oRealtorUser->getEmail(); ?></a>
                                </p>
                                    <?php else: ?>
                                <img class="foto" src="<?php echo BASE_DIR; ?>media/brf/fantombild.png" width="70" height="105" />
                                <img id="logga_maklare" src="<?php echo BASE_DIR; ?>media/brf/plats_for_logga.png" width="130" height="37" /> 
                                <p class="maklare_uppgifter">
                                    <strong>Er förening har ännu ingen mäklare ansluten till er via Svensk Brf</strong>
                                    <br />
                                    <br />

                                </p>

                                <p class="maklare_uppgifter">
                                </p>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            <?php if (isset($bAd) && $bAd): ?>
                            <style type="text/css">
                                .marknadskollen {
                                    background: none repeat scroll 0 0 #E1BBB6;
                                    float: right;
                                    height: 280px;
                                    margin: 0 10px 10px 0;
                                    width: 505px;
                                }

                                #di_tabell {
                                    background: none repeat scroll 0 0 #F7EAE4;
                                    height: 150px;
                                    margin-left: 7px;
                                    margin-top: -10px;
                                   width: 480px;
                                }
                                .tickercontainer .mask {
                                    left: -230px;
                                }
                            </style>
                            <img class="linje" width="510" height="12" alt="Linje" src="<?php echo BASE_DIR; ?>media/brf/linje.png"/>
                            <div class="marknadskollen">
                                <h6 style="margin-top:0px;"><a href="http://www.di.se/compricersidor/bolan/" target="_blank">LÄGSTA BOLÅNERÄNTAN &gt;></a></h6>
                                <?php include './brf_mortgage_rate_table_big.php'; ?>
                            </div>
                            <?php endif; */?>
                    </div>
                    <a href="http://www.hemnet.se" target="_blank">
                        <img class="banner" src="<?php echo BASE_DIR; ?>media/inloggad/img/Hemnet_514x330_animerad.gif" width="514" height="330" alt="banner" style="margin-left: 10px; margin-right: 10px;" />
                    </a>
                    <div class="marginal_bottom"></div>
                </div><!-- Slut på height --> 
            </div> 

                
            <div id="right">
                <?php if (getUser()->getUserType() == SvenskBRF_User::USER_TYPE_MEMBER): ?>
                <div class="height">
                    <div class="box box1">
                        <!--<img class="knapp" src="<?php echo BASE_DIR; ?>media/inloggad/img/bokningar.png" />-->
                        <div class="knapp bla_knapp1">Bokningar</div>
                            <?php 
                                foreach (getUser()->getBookings(3 /* Limit */) as $iBookingIndex => $oResourceBooking):
                            ?>
                        <p class="overskrift"><?php echo $oResourceBooking->getResource()->getName(); ?></p>
                        <p class="datum"><?php echo getResourceBookingTimeFormatMainViewFirstPart($oResourceBooking); ?><span class="tid" style="background-color:#D8EAEE; padding-top: 10px;"><?php echo getResourceBookingTimeFormatMainViewSecondPart($oResourceBooking); ?></span></p>
                            <?php if ($iBookingIndex < 2 && $iBookingIndex+1 < getUser()->getBookings(3)->size()): ?>
                        <div class="mellanrum2"></div>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        <p class="se_alla"><a href="<?php echo BASE_DIR; ?><?php echo $oBrf->getUrl(); ?>/bokningar" class="align-bottom userLink" style="margin-left: 10px;">Se alla bokningar</a></p>
                    </div><!-- Slut på box --> 
                </div><!-- Slut på height -->


                <div class="height margin_top">
                    <!-- Start på anslagstavla --> 
                    <div class="box" id="box2"> 
                        <!--<img class="knapp" src="<?php echo BASE_DIR; ?>media/inloggad/img/anslagstavla.png" />-->
                        <div class="knapp bla_knapp1">Anslagstavla</div>
                            <?php $iNumberOfUnreadMessages = getUser()->getNumberOfUnreadMessages(); ?>
                            <?php if ($iNumberOfUnreadMessages > 0): ?>
                        <ul id="dropdown2">
                            <!--[if IE]>
                            <li class="siffra" style="background-image: url('<?php echo BASE_DIR; ?>media/inloggad/img/rod_markering.png'); width: 32px; height: 28px; background-position: 0px -1px; background-repeat: no-repeat;"><a href="<?php echo BASE_DIR . $oBrf->getUrl(). '/anslagstavla'; ?>"><?php echo getUser()->getNumberOfUnreadMessages(); ?></a></li>
                            <![endif]-->
                            <!--[if !IE]> -->
                            <li class="siffra" style="background-image: url('<?php echo BASE_DIR; ?>media/inloggad/img/rod_markering.png'); width: 32px; height: 28px; background-position: 0px 0px; background-repeat: no-repeat;"><a href="<?php echo BASE_DIR . $oBrf->getUrl(). '/anslagstavla'; ?>"><?php echo getUser()->getNumberOfUnreadMessages(); ?></a></li>
                            <!-- <![endif]-->
                        </ul>
                            <?php endif; ?>
                            <?php $oUserMessages = getUser()->getMessages(3); ?>
                            <?php //print_r($oUserMessages); ?>
                            <?php foreach ($oUserMessages as $iMessageIndex => $oMessage): ?>
                        <p class="overskrift"><?php echo strtoupper($oMessage->getHeader()); ?></p>
                        <p class="namn"><?php echo $oMessage->getSender()->getName(); ?><?php if (strlen(@$oMessage->getSender()->getApartmentNumber()) == 4): ?>, <?php echo substr($oMessage->getSender()->getApartmentNumber(), 0, 1); ?>tr<?php endif; ?></p>
                            <?php if ($oMessage->getHasPicture()): ?>
                        <img width="31" height="22" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla_markering.png" class="kamera"/>
                            <?php endif; ?>
                        <p class="datum2"><?php echo getReadableDateAndTime($oMessage->getSendTime()); ?></p>
                            <?php 
                                $iMessageLength = 90;
                                $bShowReadLink = strlen($oMessage->getMessage()) > $iMessageLength;
                            ?>
                        <p class="text" id="message_<?php echo $oMessage->getId(); ?>"><?php echo $bShowReadLink ? substr($oMessage->getMessage(), 0, $iMessageLength) : $oMessage->getMessage(); ?><?php if ($bShowReadLink): ?>...<?php endif; ?><br/> 
                            <a href="<?php echo BASE_DIR; ?><?php echo $oBrf->getUrl();?>/anslagstavla/<?php echo $oMessage->getMessageLink(); ?>" class="hoger_lankar">Läs ></a></p>
                            <?php if ($iMessageIndex < 2 && $iMessageIndex+1 < $oUserMessages->size()): ?>
                        <div class="mellanrum2"></div>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        <a href="<?php echo BASE_DIR; ?><?php echo $oBrf->getUrl(); ?>/anslagstavla/skriv" class="userLink">
                            <label>
                                <img src="<?php echo BASE_DIR; ?>media/inloggad/img/gor_ett_inlagg.png" class="meddelande" style="width: 100px; height: 29px;" width="100"  height="29"/>
                            </label>
                        </a>
                        <p class="se_alla"><a href="<?php echo BASE_DIR; ?><?php echo $oBrf->getUrl(); ?>/anslagstavla" class="align-bottom userLink" style="margin-left:-11px;">Se hela anslagstavlan</a></p>
                    </div><!-- Slut på box --> 
                </div><!-- Slut på height --> 
                <div class="height margin_top">
                    <!-- Start på kalender --> 
                    <div class="box box1"> 
                        <!--<img class="knapp" src="<?php echo BASE_DIR; ?>media/inloggad/img/kalender.png" width="132" height="34" />-->
                        <div class="knapp bla_knapp1">Kalender</div>
                            <?php foreach ($oBrf->getCalendarEvents(3, getUser()->isBoardMember(), TRUE) as $iCalendarIndex => $oCalendar): ?>
                        <p class="overskrift"><?php echo ($oCalendar->getHeader()); ?></p>
                        <p class="datum"><?php echo getReadableDateAndTime($oCalendar->getWhen()); ?></p>
                        <p class="text"><?php echo nl2br($oCalendar->getText()); ?></p>
                            <?php if ($iCalendarIndex < 2 && $iCalendarIndex+1 < $oBrf->getCalendarEvents(3, getUser()->isBoardMember(), TRUE)->size()): ?>
                        <div class="mellanrum2"></div>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        <p class="se_alla"><a href="<?php echo BASE_DIR; ?><?php echo $oBrf->getUrl(); ?>/kalender" class="align-bottom userLink" style="margin-left: 5px;">Se hela kalendern</a></p>
                    </div><!-- Slut på box --> 
                </div><!-- Slut på height --> 
                <?php endif; ?>
            </div> 
                
            <div id="footer">
                <p style="background: none repeat scroll 0 0 #FFFFFF; margin-bottom: 7px; margin-left: 1px; margin-top: 10px; padding: 20px; width: 94.5%; font-size:10px;">
                    <span style="color:#F48136; font-size:20px; font-weight:100;">Denna tjänst tillhandahålls av</span>
                    <br />
                    <br />
                    <b>Svensk Brf</b><br>
                    Östermalmstorg 2<br />
                    114 42 Stockholm<br />
                    Box 5273<br />
                    <b>Telefon:</b> 
                    08-636 56 00<br />
                    <b>E-post:</b>
                    kontakt@svenskbrf.se
                </p>
                <img src="<?php echo BASE_DIR; ?>media/inloggad/img/fot.png" width="920" height="94" alt="fot" />
            </div>
        </div><!-- Slut på wrapper --> 
        <script type="text/javascript">
            
            function showNumber()
            {
                $('ul.dropdown_left_siffra').eq(1).show();
            }
            
            
            function setHeight(addHeight) {
                
                var minHeight = $("#left").removeAttr('style').height();
                $("#contents, #right").each(function() {
                    if ($(this).removeAttr('style').height() > minHeight) {
                        minHeight = $(this).height();
                    }
                });
                
                if (addHeight) {
                    minHeight += addHeight;
                }
                
                if (parseInt(minHeight) < 882) {
                    minHeight = 882;
                }
                $("#left, #contents, #right").height(minHeight);
            }
            setHeight();
            
            var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
            if (is_chrome) {
                $("li.siffra1").css("background-position", "0px -1px");
            }
            
            $(document).ready(function(){
                $('.horizontalScroller').liScroll();
            
                
               $.post("<?php echo BASE_DIR; ?>ajax.php", { action : 'loadloggedinmiddlesection', 
                   <?php if (isset($bAd)): ?>ad : '<?php echo $bAd ? 1 : 0; ?>',<?php endif; ?>
                   url : '<?php echo $oBrf->getUrl(); ?>'}, function (response) {
                    if (response.result) {
                        <?php if (isset($bAd)): ?>
                        $("div.marknadskollen").prepend(response.data.html);
                        <?php else: ?>
                        $("#maklarinfo").append(response.data.html);    
                        <?php endif; ?>
                        $(".horizontalScroller").liScroll();
                        $('#nyhetsflode li.nyhetsflode').show();
                        setHeight();
                    }
                }, 'json');
                 
               
               
               <?php if ($sJsAction): ?>
               <?php echo $sJsAction; ?>
               <?php endif; ?>
            });
            
        </script>
    </body>
</html>