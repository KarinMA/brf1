<?php 
    include_once './setup.php';
    $sAction = @$_REQUEST['action'];
    $bAdmin = @$_REQUEST['admin'];
    $sBrf = @$_REQUEST['brf'];
    $bServices = (bool) @$_REQUEST['services'];
    $bLogin = (bool) @$_REQUEST['login'];
    
    if (!isLoggedIn() && $sAction != 'logout') {
        if (@$_COOKIE[LOGINCOOKIE]) {
            $oUser = SvenskBRF_User::getByLoginCookie($_COOKIE[LOGINCOOKIE]);
            login($oUser, TRUE);
        }
    }

    
    switch ($sAction) {
        case 'login':
            $sUsername = $_REQUEST['u'];
            $sPassword = $_REQUEST['p'];
            try {
                $oUser = SvenskBRF_User::login($sUsername, $sPassword);
                if ($oUser && (!$sBrf || $oUser->getBrf()->getUrl() == $sBrf)) {
                    login($oUser, (bool) @$_POST['komihag']);
                    exitForLocation($oUser->getBrf()->getUrl());
                } else {
                    $sLoginMessage = "Error";
                }
            } catch (SvenskBRFException $a_oException) {
                // display this?
                $sLoginMessage = $a_oException->getMessage();
            }
            break;
        case 'logout':
            $oLogoutBrf = NULL;
            $bRealtorUser = ($oUser = getUser()) && $oUser->getUserType() == SvenskBRF_User::USER_TYPE_REALTOR;
            if (isLoggedIn()) {
                $oLogoutBrf = getBrf();
                logout();
            }
            if (!$oLogoutBrf || $bRealtorUser) {
                $sBrf = '';
            } else {
                $sBrf = $oLogoutBrf->getUrl();
            }
            exitForLocation($sBrf);
            break;
        case 'test_startpage':
            // show how page looks
            $bEditView = TRUE;
            $bAdmin = FALSE;
            break;
        case 'test_services':
            $bAdmin = FALSE;
        default:
            // pass on the action to sub scripts...
            break;
    }
    
    $bShowStart = TRUE;
    
    if ($sBrf) {
        $bShowStart = FALSE;
        $sIncludeFile = "brf_public.php";
    } else if ($bAdmin) {
        // admin interface
        $bShowStart = FALSE;
        $sIncludeFile = 'admin11111.php';
    } else if ($bServices) {
        $bShowStart = FALSE;
        $sIncludeFile = 'services.php';
    } else if ($bLogin) {
        $bShowStart = FALSE;
        $sIncludeFile = 'maklar_login.php';
    }
    
    
    
    if ($bShowStart || !isset($sIncludeFile)):
        $aStartPageContentPieces = array(
            'logo_tagline', 
            'search_header', 
            'services_intro1', 
            'services_intro2', 
            'free_plus', 
            'about_us', 
            'activate',
            'contact_info',
            'header',
            
            // services texts
            'services_homepage',
            'services_booking',
            'services_pictures', 
            'services_document', 
            'services_contract', 
            'services_calendar', 
            'services_smsmail', 
            'services_msgboard', 
            
            // and their headers
            //'services_homepage_header',
            //'services_booking_header',
            //'services_pictures_header', 
            //'services_document_header', 
            //'services_contract_header', 
            //'services_calendar_header', 
            //'services_smsmail_header', 
            //'services_msgboard_header',
        );
        $aStartPageContent = array();
        foreach ($aStartPageContentPieces as $sContentPiece) {
            $aStartPageContent[$sContentPiece] = isset($bEditView) ? trim($_POST['content'][$sContentPiece]) : getStartpageAccessor()->getStartpageByName($sContentPiece)->getContent();
        }
        
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Svensk Brf - Din bostadsrättsförening på nätet!</title>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_DIR; ?>media/css/stil.css" />
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-1.9.1.min.js"></script>
        <link href="<?php echo BASE_DIR; ?>media/bildspel/js-image-slider.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo BASE_DIR; ?>media/bildspel/js-image-slider.js" type="text/javascript"></script>
        <link href="<?php echo BASE_DIR; ?>media/bildspel/generic.css" type="text/css" rel="stylesheet"/>
        <script src="<?php echo BASE_DIR; ?>media/js/jquery.placeholder.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-ui.js"></script>
        <link href="<?php echo BASE_DIR; ?>media/css/jquery-ui-1.10.3.custom.min.css" type="text/css" rel="stylesheet"/>
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
    </head>
    <body>
        <div id="content">

            <?php include './startpage_header.php'; ?>



            <div id="sliderFrame">
                <div id="slider">
                    <img src="<?php echo BASE_DIR; ?>media/bildspel/en_gratis_tjanst.png" width="955" alt="" />
                    
                    <img src="<?php echo BASE_DIR; ?>media/bildspel/allt_som_behovs.png" width="955" alt="" />

                    <img src="<?php echo BASE_DIR; ?>media/bildspel/styrelsen.png" width="955" alt="" />
                    
                    <a href="<?php echo BASE_DIR; ?>#aktivera"><img src="<?php echo BASE_DIR; ?>media/bildspel/hur_kommer_vi_igang.png" width="955" alt=""/></a>
                </div>
            </div>

            <!--<div id="valkommen">
                <img src="<?php echo BASE_DIR; ?>media/start/img/vi_valkomnar.png" width="138" height="26" alt="vi_valkommnar" />
            </div>

            <div id="gra_ruta" class="">
                <ul class="gra_text horizontal_scroller no_mouse_events">-->
                <!-- The latest -->
                <!-- QQQ: run query -->
                <!--<li class="scrollingtext" style="margin-left:50px;">Bostadsrättsföreningen A&nbsp;&nbsp;&nbsp;&nbsp;Bostadsrättsföreningen Baa&nbsp;&nbsp;&nbsp;&nbsp;Bostadsrättsföreningen C5435435455</li>-->
                <!--<li class="scrollingtext">Bostadsrättsföreningen</li>
                <li class="scrollingtext">Bostadsrättsföreningen</li>
                <li class="scrollingtext">Bostadsrättsföreningen</li>
                <li class="scrollingtext">Bostadsrättsföreningen</li>-->
                <!--</ul>
            </div>-->   


            <div class="box">
                <div class="height">
                    <div class="vanster">
                        <h1>Så funkar det</h1>
                        <p><?php echo nl2br($aStartPageContent['services_intro1']); ?></p>
                    </div>
                    <div class="hoger">
                        <h1>&nbsp;</h1>
                        <p><?php echo $aStartPageContent['services_intro2']; ?></p>
                    </div>
                </div>
                <br class="clear"/>

                <div class="height">
                    <div class="vanster">
                        <h4>
                            <a href="<?php echo BASE_DIR; ?>tjanster#hemsida" target="_blank">
                                <img class="ikon" src="<?php echo BASE_DIR; ?>media/start/img/ikoner/gratis_hemsida.png" width="35" height="35" alt="bildbank" /><?php echo "Hemsida"; //$aStartPageContent['services_pictures_header']; ?>
                            </a>
                        </h4>
                        <p class="margin">
                            <?php echo $aStartPageContent['services_homepage']; ?>
                            <a href="<?php echo BASE_DIR; ?>tjanster#hemsida">Läs mer</a>
                        </p>

                    </div>

                    
                    <div class="hoger">
                        <h4>
                            <a href="<?php echo BASE_DIR; ?>tjanster#bokningar" target="_blank">
                                <img class="ikon" src="<?php echo BASE_DIR; ?>media/start/img/ikoner/bokning.png" width="35" height="35" alt="Bokning" /> <?php echo "Bokningar"; //$aStartPageContent['services_booking_header']; ?>
                            </a>
                        </h4>
                        <p class="margin">
                            <?php echo $aStartPageContent['services_booking'] ;?>
                            <a href="<?php echo BASE_DIR; ?>tjanster#bokningar">Läs mer</a>
                        </p>
                    </div>
                    
                </div>
                <br class="clear" />


                <div class="height">
                    
                    <div class="vanster">
                        <h4>
                            <a href="<?php echo BASE_DIR; ?>tjanster#styrelsen" target="_blank">
                                <img class="ikon" src="<?php echo BASE_DIR; ?>media/start/img/ikoner/styrelselogg.png" width="35" height="35" alt="Styrelsen" /><?php echo "Styrelselogg"; //$aStartPageContent['services_contract_header']; ?>
                            </a>
                        </h4>
                        <p class="margin">
                            Det finns även en funktion där styrelsen smidigt kan föra en logg på händelser eller möten i föreningen som kanske inte protokollförts. Här kan även styrelsen lägga upp dokument som bara ska vara tillgängliga för styrelsen. 
                            <a href="<?php echo BASE_DIR; ?>tjanster#styrelsen">Läs mer</a>
                        </p>
                    </div>
                    
                    <div class="hoger">
                        <h4>
                            <a href="<?php echo BASE_DIR; ?>tjanster#medlemsprofil" target="_blank">
                                <img class="ikon" src="<?php echo BASE_DIR; ?>media/start/img/ikoner/medlemsprofil.png" width="35" height="35" alt="Medlemsprofil" /><?php echo "Medlemsprofil"; //$aStartPageContent['services_document_header']; ?>
                            </a>
                        </h4>
                        <p class="margin">
                            För att medlemmarna ska lära känna varandra lite bättre så finns det möjlighet att beskriva sig själv, lägga upp en bild och information om vem man bor med. Dessutom så kan man lägga till kontaktuppgifter här så att man kan nås om det behövs.
                            <a href="<?php echo BASE_DIR; ?>tjanster#medlemsprofil">Läs mer</a>
                        </p>                            
                        
                    </div>
                    
             
                    
                    
                </div>
                <br class="clear" />

                <div class="height">
                    
                    <div class="vanster">
                        <h4>
                            <a href="<?php echo BASE_DIR; ?>tjanster#smsmail" target="_blank">
                                <img class="ikon" src="<?php echo BASE_DIR; ?>media/start/img/ikoner/sms-mail.png" width="35" height="35" alt="SMS/Mail" /><?php echo "SMS/Mail"; // echo $aStartPageContent['services_smsmail_header']; ?>
                            </a>
                        </h4>
                        <p class="margin">
                            <?php echo $aStartPageContent['services_smsmail'] ;?>
                            <a href="<?php echo BASE_DIR; ?>tjanster#smsmail">Läs mer</a>
                        </p>    
                    </div>
                    
                    <div class="hoger">
                        <h4>
                            <a href="<?php echo BASE_DIR; ?>tjanster#kalender" target="_blank">
                                <img class="ikon" src="<?php echo BASE_DIR; ?>media/start/img/ikoner/kalender.png" width="35" height="35" alt="Kalender" /> <?php echo "Kalender"; //$aStartPageContent['services_calendar_header']; ?>
                            </a>
                        </h4>
                        <p class="margin">
                            <?php echo $aStartPageContent['services_calendar']; ?>
                            <a href="<?php echo BASE_DIR; ?>tjanster#kalender">Läs mer</a>
                        </p>
                    </div>
                    
                    
                </div>
                <br class="clear" />
                
                <div class="height">
                   <div class="vanster">
                        <h4>
                            <a href="<?php echo BASE_DIR; ?>tjanster#dokument" target="_blank">
                                <img class="ikon" src="<?php echo BASE_DIR; ?>media/start/img/ikoner/dokument.png" width="35" height="35" alt="Dokument" /><?php echo "Dokument"; //$aStartPageContent['services_document_header']; ?>
                            </a>
                        </h4>
                        <p class="margin">
                            <?php echo $aStartPageContent['services_document']; ?>
                            <a href="<?php echo BASE_DIR; ?>tjanster#dokument">Läs mer</a>
                        </p>                            
                        
                    </div>
                    
                   <div class="hoger">
                        <h4>
                            <a href="<?php echo BASE_DIR; ?>tjanster#anslagstavla" target="_blank">
                                <img class="ikon" src="<?php echo BASE_DIR; ?>media/start/img/ikoner/anslagstavla.png" width="35" height="35" alt="anslagstavla" /> <?php echo "Anslagstavla"; //$aStartPageContent['services_msgboard_header']; ?>
                            </a>
                        </h4>
                        <p class="margin">
                            <?php echo $aStartPageContent['services_msgboard']; ?>
                            <a href="<?php echo BASE_DIR; ?>tjanster#anslagstavla">Läs mer</a>
                        </p>    
                    </div>
                    
                </div>
                <br class="clear" />
                

                <div class="height">
                    
                    
                 
                    <!--<div class="vanster">
                        
                        <h4>
                            <a href="<?php echo BASE_DIR; ?>tjanster#upphandling" target="_blank">
                                <img class="ikon" src="<?php echo BASE_DIR; ?>media/start/img/ikoner/gemensam_upphandling.png" width="35" height="35" alt="Bokningssystem" /><?php echo "Upphandling"; //$aStartPageContent['services_contract_header']; ?>
                            </a>
                        </h4>
                        <p class="margin">
                            <?php echo $aStartPageContent['services_contract']; ?>
                            <a href="<?php echo BASE_DIR; ?>tjanster#upphandling">Läs mer</a>
                        </p>
                    </div>-->
                    
                    <div class="vanster">
                        <h4>
                            <a href="<?php echo BASE_DIR; ?>tjanster#bildbank" target="_blank">
                                <img class="ikon" src="<?php echo BASE_DIR; ?>media/start/img/ikoner/bildbank.png" width="35" height="35" alt="Bildbank" /><?php echo "Bildbank"; //$aStartPageContent['services_homepage_header']; ?>
                            </a>
                        </h4>
                        <p class="margin">
                            <?php echo $aStartPageContent['services_pictures'] ;?>
                            <a href="<?php echo BASE_DIR; ?>tjanster#bildbank">Läs mer</a>
                        </p>    
                    </div>
                </div>
                <br class="clear"/>
                <div class="bottenmarginal"></div>
            </div>

            <!-- början aktivera -->
            <div class="box" id="aktivera">

                <div class="height">
                    <div class="vanster" style="height: 450px;">
                        <h1>Kom igång!</h1>
                        <?php echo nl2br($aStartPageContent['activate']); ?>       
                        <!--<p>
                            <img src="<?php echo BASE_DIR; ?>media/start/img/aktivering_formular_minskad_hojd2.png" width="376" height="270" />
                        </p>-->
                        
                    </div>
                    <div class="hoger" style="height: 450px;">
                        <h1>&nbsp;</h1>
                        <!--
                        <p>
                            Länken leder till din förenings nya hemsida som ser ut som bilden visar:
                            <br />
                            <br />
                            <img width="250" height="233" alt="hemsida" src="<?php echo BASE_DIR; ?>media/start/img/hemsida.png" style="margin-left: 50px;"/> 
                        </p>
                        <p>Klicka på den blå cirkeln uppe till höger, &quot;Aktivera din förening&quot;. Nu börjar aktiveringsprocessen i några enkla steg!</p>
                        <p>Det är kostnadsfritt att ha en hemsida hos Svensk Brf.</p>-->
                        <p>
                            <img src="<?php echo BASE_DIR; ?>media/start/img/aktivering_formular_minskad_hojd2.png" width="376" height="270" />
                        </p>
                        <table width="192" border="0" style="margin-top:65px; position:relative; right:20px;">
                            <tbody>
                                <tr>
                                    <td valign="top" align="left"> 
                                        <form onsubmit="if (responseBrf1 != null) document.location.href = responseBrf1; return false;"> 
                                            <p>
                                                <label for="brf">Sök efter din bostadsrättsförening här:</label>
                                                <br />
                                                <input type="text" id="brf" class="sok2" value="" placeholder="Föreningsnamn"/>
                                            </p>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <input type="image" class="" width="78" height="27" src="<?php echo BASE_DIR; ?>media/start/img/aktivera.png" alt="Skicka" id="activateButton"/>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- slut på hoger -->
                </div><!-- slut på height -->
                <br class="clear"/>

            </div><!-- aktivera -->

            <div class="box" id="tipsa"> 
                <div class="height">
                    <div id="inline">
                        <div id="left" style="padding-top: 30px;">
                            <h2>Tipsa!</h2>
                            <p>Här kan du tipsa en vän eller någon i styrelsen i den förening du bor i om fördelarna med att aktivera föreningens hemsida. Du kan även skriva ett personligt meddelande till mottagaren.</p>
                        </div>
                        <div id="mitt">
                            <p class="text">
                                <label for="tipsaMeddelande">Meddelande:</label>
                                <textarea placeholder="Ditt meddelande" id="tipsaMeddelande" name="tip[message]" style="width: 254px; height: 155px; padding:10px; font-family: 'Open Sans',sans-serif;  resize: none;" class="text_ram" rows="10" cols="30"></textarea>
                            </p>
                        </div>
                        <div id="right">
                            <form class="tipsa_form" action="<?php echo BASE_DIR; ?>#tipsa" method="post">
                                <p class="text">
                                    <label for="tipFrom">Från:</label> 
                                    <input class="form" type="text" name="tip[from]" id="tipFrom" placeholder="Ditt namn" style="font-family: 'Open Sans',sans-serif;"/>
                                </p>
                                <br />
                                <p class="text2">
                                    <label for="tipTo">Till:</label> 
                                    <input class="form" type="text" name="tip[to]" id="tipTo" placeHolder="Mottagarens e-postadress" style="font-family: 'Open Sans',sans-serif;"/>
                                </p>
                                <input type="image" class="skicka" src="<?php echo BASE_DIR; ?>media/start/img/skicka.png" id="sendTip" width="78" height="27" />
                            </form>
                        </div>
                    </div>
                </div>
                <br class="clear"/>
            </div>



            <!-- om oss -->
            <div class="box" id="om_oss">
                <div class="height">
                    <div class="vanster">
                        <h1>Om oss</h1>
                        <?php echo nl2br($aStartPageContent['about_us']); ?>
                    </div>
                    <div class="hoger">
                        <h1>&nbsp;</h1>
                        <p>
                            <img width="385" height="257" alt="Om oss" src="<?php echo BASE_DIR; ?>media/start/img/bild_oss.jpg"/>
                            Från vänster: Andreas Kärrfelt, Rolf Alexander, Karin Andersen, John Jansson
                        </p>
                    </div>
                </div> 
                <br class="clear"/>
                <div class="bottenmarginal"></div>
            </div><!-- slut på om oss -->


            <?php include './startpage_footer.php'; ?>

        </div>
        <script type="text/javascript">
            
            <?php include './startpage_autocomplete.php'; ?>
            var responseBrf1 = null;
            function autoComplete2(request, response, url) {
                $.ajax({
                    url: '<?php echo BASE_DIR; ?>searchbrf.php',
                    data : {term : request.term},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                
                
                
                        if (data.length == 1) {
                            responseBrf1 = '<?php echo BASE_DIR; ?>' + 'aktivera/' + data[0].url;
                        } else {
                            responseBrf1 = null;
                        }
                        if (data.length > 0) {
                        response($.map(data, function(item) {
                            return { 
                                label: item.name,
                                value: item.url
                            };
                        }));
                        }
                        $("ul#ui-id-2").
                            prop('style', 'display: block; /*left: 443px;*/<?php if (FALSE && strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')): ?> top: 2504px;<?php endif; ?>').
                            css('top', (parseFloat($("#brf").offset().top) + parseFloat($("#brf").position().top) + 10) + 'px').
                            css('left', (parseFloat($("#brf").offset().left) + parseFloat($("#brf").position().left) - 3) + 'px').
                            <?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')): ?>
                            //css('top', (parseFloat($("#brf").offset().top) + parseFloat($("#brf").position().top) + 10) + 'px').
                            //css('left', (parseFloat($("#brf").offset().left) + parseFloat($("#brf").position().left)) + 'px').
                            <?php elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')): ?>
                            <?php elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari')): ?>
                            <?php endif; ?>
                            css('font-family', "'Open sans', sans serif").css('font-size', '0.6em').width(257);
                            //console.log(($("#brf").offset().top));
                    }
                });
            }
     
            
            
            $("#brf").autocomplete({
                source : autoComplete2,
                select : function(event, ui) {
                    if (false && window.confirm('Gå till: ' + ui.item.label + "?")) {
                        document.location.href = '<?php echo BASE_DIR; ?>' + ui.item.value;
                    }
                },
                close : function(event, ui) {
                    //
                }
            });
            
            $("#sendTip").click(function(){
                if ($.trim($("#tipFrom").val()).length == 0) {
                    alert('Fyll i namn');
                    $("#tipFrom").focus();
                    return false;
                }
                
                if ($.trim($("#tipTo").val()).length == 0) {
                    alert('Fyll i mottagare');
                    $("#tipTo").focus();
                    return false;
                }
                
                if ($.trim($("#tipsaMeddelande").val()).length == 0) {
                    alert('Skriv ditt meddelande');
                    $("#tipsaMeddelande").focus();
                    return false;
                }
                
                $.post("<?php echo BASE_DIR; ?>ajax.php",  { action : 'sendtip', to : $("#tipTo").val(), from : $("#tipFrom").val(), message : $("#tipsaMeddelande").val() }, function (response) {
                    if (response.result) {
                        <?php if (!TEST): ?>
                        $("#tipTo, #tipFrom, #tipsaMeddelande").val('');
                        <?php endif; ?>
                        showMessage('Meddelandet skickades!', 'OK');
                    } else {
                        showMessage('Meddelande kunde inte skickas!', 'OK');
                    }
                }, 'json');
                
                return false;
            })
            
            $("#activateButton").click(function() {
                if ($("#brf").val().length > 0) {
                    document.location.href = '<?php echo BASE_DIR; ?>aktivera/' + $("#brf").val();
                }
                return false;
            });
        
            $(document).ready(function(){
                $("#tipTo, #tipFrom, #tipsaMeddelande").placeholder();
            });
        </script>
    </body>
</html>
<?php else: ?>
<?php include_once $sIncludeFile; ?>
<?php endif; ?>
<?php include_once 'unsetup.php'; ?>