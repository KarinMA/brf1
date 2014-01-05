<?php
// see if we're logged in
$oBrf = NULL;
if (isLoggedIn() && getBrf()->getUrl() === $sBrf) {
    // own BRF
    $oBrf = getBrf();
    if (@$_SESSION[SAVED_LOGIN_URL] && strpos($_SESSION[SAVED_LOGIN_URL], "/".$sBrf)) {
        $sRedirect = $_SESSION[SAVED_LOGIN_URL];
        $_SESSION[SAVED_LOGIN_URL] = NIL;
        unset($_SESSION[SAVED_LOGIN_URL]);
        exitForLocation('', $sRedirect);
    } else if (@$_SESSION[SAVED_LOGIN_URL]) {
        unset($_SESSION[SAVED_LOGIN_URL]);
    }
    include_once 'brf_loggedin.php';
    
} else if ($sBrf == 'maklare' && !isLoggedIn()) {
    include_once './maklar_login.php';
} else if ($sBrf == 'maklare' && isLoggedIn()) {
    exitForLocation(getUser()->getBrf()->getUrl());
} else {
    $bPublicBrfPage = TRUE;
    if (($oBrf = SvenskBRF_Brf::loadByUrl($sBrf))) {
        $sUrl = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], $oBrf->getUrl()) + strlen($oBrf->getUrl()) + 1);
        $aUrlParts = explode("/", $sUrl);
        if ($sUrl && $sAction != 'logout' && !in_array($aUrlParts[0], array(
            'dokument',
            'welcome',
            'maklarinformation',
            'kontakt'
        )) && !strpos($aUrlParts[0], 'pjax')) {
            $_SESSION[SAVED_LOGIN_URL] = BASE_DIR . $oBrf->getUrl() . '/' . $sUrl;
            exitForLocation($oBrf->getUrl());
        }
    } else {
        exitForLocation();
    }
    
    if ($sAction === 'realtor_interest') {
        SvenskBRF_Notice::sendApartmentInterestMail($oBrf, $_POST['interest']);
        $sJsAction = "showMessage('Intresseanmälan har skickats.', 'OK');";
    }
    
    // get subview
    $sView = @$_REQUEST['view'] && file_exists('./brf_public_' . $_REQUEST['view'] . '.php') ? $_REQUEST['view'] : 'welcome';

    // pjax load of subpages?
    if (@$_SERVER['HTTP_X_PJAX'] && isset($sView)) {
        include_once "brf_public_$sView.php";
        include_once 'unsetup.php';
        exit;
    }

    // get data from hitta.se
    $sStreetImageUrl = BASE_DIR . 'media/img/forening_bild.png';
    $iNorthCoordinate = 0;
    $iEastCoordinate = 0;
    $sHittaSeLink = "";
    $bGetMapUrl = TRUE;
    if (($aStreetData = getStreetData($oBrf)) && count($aStreetData)) { 
        if ($oBrf->getShowStreetView()) {
            $sStreetImageUrl = $aStreetData['image_url'];
        }
        $iNorthCoordinate = $aStreetData['north'];
        $iEastCoordinate = $aStreetData['east'];
        $sHittaSeLink = $aStreetData['link'] . '&nostat=true';
    } else {
        $oResult = @json_decode(file_get_contents("http://public.api.hitta.se/search/v5/address/" . getNormalizedAddress($oBrf)));
        if (!is_null($oResult)) {
            $iNorthCoordinate = $oResult->result->location->address->coordinate->north;
            $iEastCoordinate = $oResult->result->location->address->coordinate->east;
            if (!$sHittaSeLink) {
                $sHittaSeLink = $oResult->result->link[3]->uri;
            }
        }
    }
    $iMapImageWidth = 213;
    $iSlideImageHeight = $iMapImageHeight = 187;
    $iSlideImageWidth = 517;
    $sMapUrl = "";
    
    if ($iNorthCoordinate && $iEastCoordinate) {
        $sMapUrl = "http://public.api.hitta.se/image/0/2/$iNorthCoordinate/$iEastCoordinate/$iMapImageWidth/$iMapImageHeight?&filter={\"name\":\"markers\",\"props\":{\"pe\":[$iEastCoordinate],\"pn\":[$iNorthCoordinate]}}";
    } else {
        $sMainMapUrl = "http://public.api.hitta.se/search/v5/location/".switchCharacters(strtolower($oBrf->getPostalAddress()));
        $oMainMapObject = @json_decode(file_get_contents($sMainMapUrl.".json"));
        if (is_object($oMainMapObject) && $oMainMapObject->result->locations->total) {
            @$sMapUrl = "http://public.api.hitta.se/image/0/2/{$oMainMapObject->result->locations->location[0]->coordinate->north}/{$oMainMapObject->result->locations->location[0]->coordinate->east}/$iMapImageWidth/$iMapImageHeight/4";
        } else {
            $sMapUrl = BASE_DIR . 'media/brf/karta.png';
            $bGetMapUrl = FALSE;
        }
    }
    $sMapImageSource = $bGetMapUrl ? getDataUri(file_get_contents($sMapUrl), 'image/gif') : $sMapUrl;

    $aBranches = array(
        268 => array('name' => 'Livsmedel', 'exclude' => array()), // livsmdel
        104 => array('name' => 'Träning', 'exclude' => array()), // livsmdel
        137 => array('name' => 'Tåg/T-bana', 'exclude' => array()),
        81 => array('name' => 'Varuhus', 'exclude' => array(83, 60, 71, 481)), // varuhus 
        175 => array('name' => 'FÖRSKOLOR &amp; FRITIDS', 'exclude' => array()), // dagis
        192 => array('name' => 'SKOLOR', 'exclude' => array()), // varuhus
        374 => array('name' => 'Gymnasium', 'exclude' => array()),
        115 => array('name' => 'Vårdcentral', 'exclude' => array())
    );
    
    $sAreaUrl = "http://public.api.hitta.se/search/v5/companies/trade/" . implode(",", array_keys($aBranches)) . "/nearby/{$iNorthCoordinate}:{$iEastCoordinate}.json?geo.distance=15000&trade.maxc.count=3";
    
    function getAdjustedAddress(SvenskBRF_Brf $a_oBrf)
    {
        
        $sAddress = "";
        
        // split?
        if (($iStrPos = strpos($a_oBrf->getAddress(), "gatan")) || ($iStrPos = strpos($a_oBrf->getAddress(), "vägen"))) {
            if ($iStrPos >= 14) {
                $sAddress = substr($a_oBrf->getAddress(), 0, $iStrPos) . '-<br />' . substr($a_oBrf->getAddress(), $iStrPos);
                $sAddress .= ($a_oBrf->getStreetNumber() ? (' ' . $a_oBrf->getStreetNumber()) : ''); 
            } else {
                $sAddress = $a_oBrf->getAddress();
                if (strlen($sAddress) >= 17) {
                    $sAddress .= '<br />'; 
                }
                $sAddress .= ($a_oBrf->getStreetNumber() ? (' ' . $a_oBrf->getStreetNumber()) : ''); 
            }
            
        } else {
            
            $iStopCharacters = 16;
            $iCharacterCounter = 0;
            for ($iAddressIndex = 0; $iAddressIndex < strlen(($a_oBrf->getAddress())); $iAddressIndex++) { 
                $sAddress .= substr($a_oBrf->getAddress(), $iAddressIndex, 1); 
                if ($iCharacterCounter >= $iStopCharacters && preg_match("/^[A-Öa-öéüÜÉ]$/", substr($sAddress, $iAddressIndex, 1))) {
                    $iCharacterCounter = 0;
                    $sAddress .= "-<br />";
                } else {
                    $iCharacterCounter++; 
                }
            }
            
            if ($iCharacterCounter > 16) {
                $sAddress .= '<br />'; 
            }
            $sAddress .= ($a_oBrf->getStreetNumber() ? (' ' . $a_oBrf->getStreetNumber()) : ''); 
        }
                
        
        return $sAddress;
    }
    
    
    $bAktiveraLink = !$oBrf->getActivated();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $oBrf->getName(); ?> | SvenskBrf.se</title>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery.pjax.js"></script>
        <link href="<?php echo BASE_DIR; ?>media/css/test.css" rel="stylesheet" type="text/css" />
        <!--<link href="<?php echo BASE_DIR; ?>media/li-scroller.css" rel="stylesheet" type="text/css" />-->
        <script src="<?php echo BASE_DIR; ?>media/jquery.slides.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery.li-scroller.1.0.1.js"></script>
        <link href="<?php echo BASE_DIR; ?>media/css/jquery-ui-1.10.3.custom.min.css" type="text/css" rel="stylesheet"/>
        <!--<link href="<?php echo BASE_DIR; ?>media/inloggad/css/nyheter_inloggad.css" rel="stylesheet" type="text/css" />-->
        <style type="text/css">
            
            .lista3 {
                margin-bottom: 2px;
            }
            
            #sliderFrame {
                background-color: #FFFFFF;
                margin-left: 166px;
                position: relative;
                <?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')): ?>
                top: 1px;
                margin-top: 8px;
                <?php else: ?>
                top: 9px;
                <?php endif; ?>
                width: <?php echo $iSlideImageWidth; ?>px;
            }
            #slider {
                width:<?php echo $iSlideImageWidth; ?>px;
                height:<?php echo $iSlideImageHeight; ?>px;/* Make it the same size as your images */
                background-color:#FFF;
                position:relative;
                margin:0 auto;/*make the image slider center-aligned */
                <?php if ($oBrf->getFrontPictures()->size() > 0): ?>
                display:none;
                <?php endif; ?>
            }
            <?php if (FALSE && strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')): ?>
            #slider img {
                position: relative;
                top: -15px;
            }
            <?php endif; ?>
        </style>
        <style type="text/css">
            .uppgift_saknas {
                color:#999;
                font-style:italic; 
            }
            
             
            .tickercontainer {
                background: none repeat scroll 0 0 #FFFFFF;
                border: 1px solid #FFFFFF;
                height: 20px;
                overflow: hidden;
                padding: 0;
                    margin-top:-5px;
            }

            .tickercontainer .mask {
                height: 19px;
                left: -250px;
                overflow: hidden;
                position: relative;
                top: -2px;
                width: 2018px;
            }

            ul.newsticker a {
                color:black;
                margin-right: 15px;
            }
            
            #nyhetsflode  {
                display: none;
            }
            
            #nyhetsflode li.nyhetsflode a {
                color: #fff;
            }
        </style>
        <script src="<?php echo BASE_DIR; ?>media/js/jquery.placeholder.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/messi.min.js"></script>
        <link href="<?php echo BASE_DIR; ;?>media/js/messi.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
            function showMessage(message, buttonText) {
                new Messi(
                    message,
                    {   
                        title: 'Svensk Brf', 
                        buttons: [{id: 0, label: buttonText, val: 'X'}]
                        ,center : true
                        //,modalOpacity : 2
                    }
                );
            }
            
            function setBrfNameStyle() {
                var activateLink = <?php echo $bAktiveraLink ? 'true' : 'false'; ?>;
                multipleLines = $("#brf_namn").height() > 65;
                if (!multipleLines && !activateLink) {
                    $("ul.formular").css('margin', '-111px -15px 0 0');
                } else if (multipleLines) {
                    
                    $(".brf_namn").css('top', '-55px');        
                    $("#aktivera").css('top', '-150px');
                    if (activateLink) {
                        $("ul.formular").css('margin', '-145px 25px 0 0');
                    } else {
                        $("ul.formular").css('margin', '-145px -15px 0 0');
                    }
                }
            }
        </script>
    </head>
    <body>
        <div id="wrapper">
            <div id="top">
                <a href="<?php echo BASE_DIR; ?>">
                    <img id="logga" src="<?php echo BASE_DIR; ?>media/brf/SvenskaBrf_logga.png" width="150" height="60" alt="Logga" />
                </a>

                <ul class="brf_namn">
                    <li id="brf">Brf</li>
                    <li id="brf_namn"><?php echo $oBrf->getName(); ?></li>
                </ul>

                                    
                <?php if (isLoggedIn() && getUser()->getUrl() == $sBrf): ?>
                <ul class="formular2">
                    <li class="namn" id="logga_ut"><a href="javascript:void(0)" onclick="document.forms['loginForm'].submit(); return false;">Logga ut</a></li>
                </ul>
                <?php endif; ?>
                <?php if (!isLoggedIn() || getUser()->getBrf()->getUrl() !== $sBrf): ?>
                <form name="loginForm" method="post">
                    <ul class="formular">
                        <li>Användarnamn:<input class="logga_in" id="namn" name="u" type="text" style="<?php if(isset($sLoginMessage)): ?>color:red;<?php endif; ?>" value="<?php echo isset($sLoginMessage) ? $_REQUEST['u'] : ''; ?>"/></li>
                        <li>Lösenord:<input class="logga_in" id="losen" name="p" type="password" value="<?php echo isset($sLoginMessage) ? $_REQUEST['p'] : ''; ?>" style="<?php if(isset($sLoginMessage)): ?>color:red;<?php endif; ?>"/></li>
                        <li style="margin-top: -10px;"><label for="komihag" class="komihag">Kom ihåg mig</label>:<input type="hidden" name="komihag" value="0"/><input type="checkbox" name="komihag" value="1" id="komihag"<?php if (@$_POST['komihag']): ?> checked="checked"<?php endif; ?>/></li>
                        <li id="glomt" style="font-size:9px; font-style:italic; margin-top: 6px; width: 170px;"><a href="<?php echo BASE_DIR; ?>glomtlosenord">Har du glömt inloggningsuppgifterna?</a></li>
                        <li><input type="image" id="ok" src="<?php echo BASE_DIR; ?>media/brf/ok.png" width="40" height="20" alt="ok"/></li>
                    </ul>
                    <input type="hidden" name="action" id="action" value="login"/>
                </form>
                <?php else: ?>
                <form name="loginForm" method="post">
                    <input type="hidden" name="action" value="logout" />
                </form>
                <?php endif; ?>
                <?php if ($bAktiveraLink): ?>
                <a href="javascript:void(0)" id="aktiveraLink">
                    <img id="aktivera" clasS="aktiveraLink" src="<?php echo BASE_DIR; ?>media/brf/AKTIVERA.png" width="138" height="135"  alt="aktivera"/>
                </a>  
                <?php endif; ?>
            </div> 


            <div id="header">
                <div id="fakta">
                    <img src="<?php echo BASE_DIR; ?>media/brf/fakta.png" width="63" height="31" alt="fakta" class="fakta"/>
                    <ul class="lista_top">
                        <li><strong>
                            <?php echo getAdjustedAddress($oBrf); ?>
                            <?php if ($oBrf->getCoAddress()): ?><br /><?php echo "C/o " . $oBrf->getCoAddress(); ?><?php endif; ?>
                        </strong></li>
                        <li><?php echo substr($oBrf->getZip(), 0, 3) . ' ' . substr($oBrf->getZip(), 3) . ' '; ?><?php if (strlen($oBrf->getPostalAddress()) >= 14) echo '<br />'; echo $oBrf->getPostalAddress(); ?></li>
                        <?php if (($oBrfAddresses = $oBrf->getBrfAddresses()) && $oBrfAddresses->size()): ?>
                        <?php
                            $sAddressesMessage = "";
                            foreach ($oBrfAddresses as $oBrfAddress) {
                                $sAddressesMessage .= $oBrf->formatBrfAddress($oBrfAddress) . "<br />";
                            }
                        ?>
                        <li><a href="javascript:void(0)" onclick="showMessage('<?php echo $sAddressesMessage; ?>', 'OK');">Fler adresser</a></li>
                        <?php endif; ?>
                        <li>&nbsp;</li>
                        <?php if ($oBrf->getApartments()): ?>
                        <li>Lägenheter: <?php echo $oBrf->getApartments(); ?></li>
                        <?php endif; ?>
                        <li>Förening bildad: <?php echo $oBrf->getRegisterYear(); ?></li>
                        <li>Org-nr. <?php echo $oBrf->getGovernmentNumber(); ?></li>
                        <?php if ($oBrf->getBuildYear()): ?>
                        <li>Byggnadsår: <?php echo $oBrf->getBuildYear(); ?></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div id="sliderFrame">
                    <div id="slider" style="width:<?php echo $iSlideImageWidth; ?>;height:<?php echo $iSlideImageHeight; ?>px;">
                        <?php $oPictures = $oBrf->getFrontPictures(); ?>
                        <?php if ($oPictures->size() == 0 || $oBrf->getShowStreetView()): ?>
                        <img src="<?php echo $sStreetImageUrl; ?>" width="<?php echo $iSlideImageWidth; ?>" height="<?php echo $iSlideImageHeight; ?>"/>
                        <?php endif; ?>
                        <?php foreach ($oPictures as $oPicture): ?>
                        <img src="<?php echo $oPicture->getImageData(); ?>" width="<?php echo $iSlideImageWidth; ?>" height="<?php echo $iSlideImageHeight; ?>"/>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div id="karta" style="margin: <?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')): ?>-186<?php else: ?>-178<?php endif; ?>px 8px 0 0">
                    <?php if ($sHittaSeLink): ?><a target="_new" href="<?php echo $sHittaSeLink; ?>"><?php endif; ?><img src="<?php echo $sMapImageSource; ?>" width="<?php echo $iMapImageWidth; ?>" height="<?php echo $iMapImageHeight; ?>" alt="karta" /><?php if ($sHittaSeLink): ?></a><?php endif; ?>
                </div>
            </div>
            <?php
                $oDocumentTypes = $oBrf->getPublicDocumentTypes();
            ?>
            <div id="content">
                <div id="left">
                    <div class="list-topp">
                        <!--<ul class="lista">
                            <li><a class="hoger_lank internalNavigation" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/'; ?>" onclick="return false;">Presentation</a></li>
                        </ul>-->
                        <ul class="lista">
                            <li class="lista3"><strong>FÖRENINGSINFO</strong></li>
                            <li class="lista3"><a class="hoger_lank internalNavigation" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/'; ?>" onclick="return false;">Hem</a></li>
                            <li class="lista3"><a class="hoger_lank internalNavigation" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/kontakt'; ?>" onclick="return false;">Kontakt</a></li>
                            <li class="lista3">
                                <?php if (!$oDocumentTypes->size()): ?>
                                <a class="hoger_lank internalNavigation" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/dokument'; ?>">
                                <?php endif; ?>
                                Dokument
                                <?php if (!$oDocumentTypes->size()): ?>
                                </a>
                                <?php else: ?>
                                <?php foreach ($oDocumentTypes as $oDocumentType): ?>
                                <br />
                                <a class="hoger_lank internalNavigation" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/dokument/'. $oDocumentType->getDirectoryName(); ?>" style="margin-left:10px;">-<?php echo $oDocumentType->getDocumentTypeName(); ?></a>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </li>
                            <?php foreach (SvenskBRF_RealtorInformation::getCategories() as $oRealtorInformationCategory): ?>
                            <li class="lista3">
                                <a class="hoger_lank internalNavigation" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/maklarinformation/'. $oRealtorInformationCategory->getCategoryKey(); ?>" style="/*margin-left:10px;*/"><?php echo SvenskBRF_RealtorInformation::hasAnyCategoryData($oBrf,$oRealtorInformationCategory)  ? $oRealtorInformationCategory->getCategoryName() : _realtorInfoMissing($oRealtorInformationCategory->getCategoryName()); ?></a>
                            </li>
                            <?php endforeach; ?>
                            <li class="lista3">
                                <a class="hoger_lank internalNavigation" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/maklarinformation/'; ?>" style="/*margin-left:10px;*/">Mäklarinformation</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="centerblock">
                    <div id="centerblock_text">
                        <?php include_once "./brf_public_$sView.php"; ?>
                    </div>
                    <div id="maklarinfo">
                        <img class="linje" src="<?php echo BASE_DIR; ?>media/brf/linje.png" width="510" height="12" alt="linje" />
                    </div>
                </div>
                <div id="right">
                    <div class="list-topp" id="narheten">
                        <ul class="lista">
                            <li style="font-weight:100; font-size:16px; width: 175px; border-bottom: 1px solid #000;">I NÄRHETEN</li>
                        </ul>
                        <?php
                            /*foreach ($aResults as $iBranchId => $aBranch):
                                if (count($aResults[$iBranchId])):
                        ?>
                        <ul class="plats">
                            <li><strong><?php echo $aBranches[$iBranchId]['name']; ?></strong></li>
                            <?php foreach ($aBranch as $aBranchCompany): ?>
                            <li>
                                <?php if (array_key_exists('link', $aBranchCompany)): ?>
                                <a href="<?php echo $aBranchCompany['link'] ;?>"  target="_blank">
                                <?php endif; ?>
                                    <?php $iLength = 21; ?>
                                    <?php if (strlen($aBranchCompany['name']) > 22 && in_array(substr($aBranchCompany['name'], 20, 2), array_keys(getSwitchCharacters()))): ?>
                                    <?php $iLength = 20; ?>
                                    <?php endif; ?>
                                    <?php echo substr($aBranchCompany['name'], 0, $iLength); if (strlen($aBranchCompany['name']) > $iLength) echo '...'; ?>
                                <?php if (array_key_exists('link', $aBranchCompany)): ?>    
                                </a>
                                <?php endif; ?>
                                <span class="siffror"><?php echo $aBranchCompany['distance']; ?>m</span></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php 
                                endif;
                            endforeach; */
                        ?>
                    </div>
                    <p class="align-bottom" style="margin-bottom: 10px;">Hämtat från <a class="hitta" href="http://www.hitta.se">Hitta.se</a></p>
                </div>
            </div>
            <div>
                <a href="http://www.hemnet.se" target="_blank">
                    <img src="<?php echo BASE_DIR; ?>media/brf/Hemnet_915x430.gif" width="915" height="430" alt="reklam" />
                </a>
                <div id="fot">
                    <p style="background: none repeat scroll 0 0 #FFFFFF; height: 130px; margin-bottom: 7px; margin-left: 1px; margin-top: -45px; padding: 20px; width: 94.5%; border: 1px solid #D0CFCB; border-radius: 10px; font-size:10px;">
                        <span style="color:#F48136; font-size:20px; font-weight:100;">Denna tjänst tillhandahålls av</span>
                        <br />
                        <br />
                        <b>Svensk Brf</b>
                        <br />
                        Östermalmstorg 2<br />
                        114 42 Stockholm<br />
                        Box 5273<br />
                        <b>E-post:</b> 
                        kontakt@svenskbrf.se
                    </p>
                </div>
            </div>
            <div id="dialog-form" title="<?php echo $oBrf->getName(); ?> - intresseanmälan" style="display:none;">
                <form id="aktiveraForm" method="post">
                    <fieldset>
                        <input type="hidden" name="action" value="realtor_interest"/>
                        <label for="interest_rooms">Önskat antal rum</label>
                        <br />
                        <select name="interest[rooms]" id="interest_rooms">
                            <option value="">Välj...</option>
                            <?php for ($fRooms = 1; $fRooms <= 10; $fRooms += 0.5): ?>
                            <option value="<?php echo $fRooms; ?>"><?php echo str_replace(".", ",", $fRooms); ?></option>
                            <?php endfor; ?>
                        </select>
                        <br />
                        <br />
                        
                        <label for="interest_name">Namn</label>
                        <br />
                        <input type="text" name="interest[name]" value="" id="interest_name" size="42"/>
                        <br />
                        <br />
                        
                        <label for="interest_mail">E-postadress</label>
                        <br />
                        <input type="text" name="interest[mail]" value="" size="42" id="interest_mail"/>
                        <br />
                        <br />
                        
                        <label for="interest_phone">Telefonnummer</label>
                        <br />
                        <input type="text" name="interest[phone]" value="" id="interest_phone" size="42"/>
                        <br />
                        <br />
                        
                        <label for="interest_text">Övrigt information</label>
                        <br />
                        <textarea id="interest_text" name="interest[text]" rows="10" cols="40" placeholder="Meddelande till mäklaren"></textarea>
                        
                    </fieldset>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            $(window).load(function() {
                setBrfNameStyle();
                
                $.pjax.defaults.timeout = 7500;
                $.pjax.defaults.scrollTo = false;
                $(document).pjax(".internalNavigation", "#centerblock_text");
                $(document).on('pjax:complete', function() {
                    setHeight();
                })
                if ($("#slider > img").size() > 1) {
                    $("#slider").slidesjs({
                        width: <?php echo $iSlideImageWidth; ?>,
                        height: <?php echo $iSlideImageHeight; ?>,
                        play: {
                          active: true,
                          auto: true,
                          interval: 4000,
                          swap: false,
                          buttons: false
                        }, navigation: {
                            active: false
                        }, pagination: {
                            active: false
                        }
                    });
                }
                
                //$(".horizontalScroller").liScroll();
                
                $(".aktiveraLink").click(function(){
                    document.location.href = '<?php echo BASE_DIR; ?>aktivera/<?php echo $oBrf->getUrl(); ?>';
                    return false;
                });
                
                
                $("#dialog-form" ).dialog({
                    autoOpen: false,
                    //height: 500,
                    //width: 750,
                    modal: true,
                    buttons: {
                        "Spara": function() {
                            $("#aktiveraForm").submit();
                    },
                    Avbryt: function() {
                        $( this ).dialog( "close" );
                    }
                    },
                    close: function() {
                    }
                });
                
                $("#interest_text").placeholder();
                
            });
        </script>
        <script type="text/javascript">
            function setHeight(addHeight) {
                var minHeight = $("#right").removeAttr('style').height();
                minHeight += 75;
                $("#centerblock, #left").each(function() {
                    if ($(this).removeAttr('style').height() > minHeight) {
                        minHeight = $(this).height();
                    }
                });
                
                if (addHeight) {
                    minHeight += addHeight;
                }
                
                if (parseInt(minHeight) < 800) {
                    //minHeight = 800;
                }
                $("#left, #centerblock, #right").height(minHeight);
            }
            setHeight();
            <?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')): ?>
            $("#komihag").css('margin-left', '11px');
            $("#glomt").css('margin-top', '8px');
            $("#ok").css('top', '37px');
            <?php elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')): ?>
            $("#ok").css('top', '35px');    
            $("#glomt").css('margin-top', '7px');
            <?php elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari')): ?>
            $("#ok").css('top', '35px');        
            <?php endif; ?>
//            window.setTimeout("$('#nyhetsflode').find('a').css('color', '#000;'); $('#nyhetsflode').show();", 750);
            <?php if (isLoggedIn()): ?>
            $("#losen, #namn").val('');    
            <?php endif; ?>
                
            $( "#dialog-form" ).dialog({
                autoOpen: false,
                height: 550,
                width: 370,
                modal: true,
                buttons: {
                    "Create an account": function() {
                        var bValid = true;
                        allFields.removeClass( "ui-state-error" );
                        /*bValid = bValid && checkLength( name, "username", 3, 16 );
                        bValid = bValid && checkLength( email, "email", 6, 80 );
                        bValid = bValid && checkLength( password, "password", 5, 16 );
                        bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
                        // From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
                        bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
                        bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );*/
                        if (true || bValid) {
                            $( this ).dialog( "close" );
                        }
                    },
                    Cancel: function() {
                        $( this ).dialog( "close" );
                    }
                },
                close: function() {
                    allFields.val( "" ).removeClass( "ui-state-error" );
                }
            });
            /*
            $( "#interested" ).
                click(function() {
                $( "#dialog-form" ).dialog( "open" );
                return false;
            });
            */
            $.post("<?php echo BASE_DIR; ?>ajax.php", { action : 'getcloseby', sAreaUrl : '<?php echo $sAreaUrl; ?>', iNorthCoordinate : <?php echo $iNorthCoordinate; ?>, iEastCoordinate : <?php echo $iEastCoordinate; ?> }, function (response) {
                if (response.result) {
                    $("#narheten").append(response.data.html);
                    setHeight();
                }
            }, 'json');
            
            $.post("<?php echo BASE_DIR; ?>ajax.php", { action : 'loadpublicmiddlesection', url : '<?php echo $oBrf->getUrl(); ?>' }, function (response) {
                if (response.result) {
                    $("#maklarinfo").append(response.data.html);
                    $(".horizontalScroller").liScroll();
                    $('#nyhetsflode').find('a').css('color', '#000;'); $('#nyhetsflode').show();
                    setHeight();
                    $( "#interested" ).
                        click(function() {
                        $( "#dialog-form" ).dialog( "open" );
                        return false;
                    });
                }
            }, 'json');
            
            
            
            <?php if (isset($sJsAction) && $sJsAction): ?>
                <?php echo $sJsAction; ?>
            <?php endif; ?>
                
            
        </script>
    </body>
</html>
<?php } ?>