<div class="box4">
    <div id="wrap">
        <ul class="navbar">
            <li>
                <a class="nav" href="<?php echo BASE_DIR; ?><?php echo $oBrf->getUrl(); ?>">Hem</a>
            </li>

            <?php if ($oBrf->getResourceCollection()->size()): ?>
                <li>
                    <a class="nav" href="javascript:void(0)" onclick="return toggleMenu(this);" style="cursor:pointer;">Boka &gt;</a>
                    <ul id="boka_menu" class="menulink">
                        <?php foreach ($oBrf->getResourceCollection() as $oResource): ?>
                            <li class="lista5"><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/boka/' . getResourceLink($oResource); ?>"><?php echo $oResource->getName(); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/bokningar'; ?>">Dina bokningar</a></li>
            <?php endif; ?>
            <?php $oDocumentTypes = $oBrf->getDocumentTypes(FALSE); ?>
            <?php if ($oDocumentTypes->size()): ?>
                <li>
                    <a class="nav" href="javascript:void(0)" onclick="return toggleMenu(this);" style="cursor:pointer;">Dokument &gt;</a>
                    <ul id="dokument_menu"  class="menulink">
                        <?php foreach ($oDocumentTypes as $oDocumentType): ?>
                            <li class="lista5"><a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/dokument/<?php echo $oDocumentType->getDirectoryName(); ?>" class="nav"><?php echo $oDocumentType->getDocumentTypeName(); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <li><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/bilder'; ?>">Bilder</a></li>
            <li><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/kalender'; ?>">Kalender</a></li>
            <li><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/anslagstavla'; ?>">Anslagstavla</a></li>
            <li><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/styrelsen'; ?>">Styrelsen</a></li>

            <li>
                <?php if ($iNumberOfUnreadEmails > 0 || FALSE): ?>
                    <ul class="dropdown_left_siffra">
                        <li class="siffra1" style="height: 18px; margin-left: -25px; margin-top: 2px; text-align: center; width: 22px;">
                            <?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') || strpos($_SERVER['HTTP_USER_AGENT'], 'Safari')): ?>
                            <span style="position: relative; top: 2px;">
                            <?php endif; ?>
                            <?php echo $iNumberOfUnreadEmails; ?>
                            <?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') || strpos($_SERVER['HTTP_USER_AGENT'], 'Safari')): ?>
                            </span>
                            <?php endif; ?>
                        </li>
                    </ul>
                <?php endif; ?>
                <a class="nav" href="javascript:void(0)" onclick="$('ul.dropdown_left_siffra').eq(1).hide(); window.setTimeout(showNumber, 750); return toggleMenu(this);" style="cursor:pointer;">Meddelanden &gt;</a>
                <ul id="meddelanden_menu" class="menulink">
                    <?php $aClasses = array('inkorg' => 'inkorg', 'skicka' => 'nytt_meddelande', 'skickat' => 'skickat'); ?>
                    <?php $aMessageViews = array('skicka' => 'Skicka', 'inkorg' => 'Inkorg', 'skickat' => 'Skickat',); ?>
                    <li class="lista5">
                        <a href="<?php echo BASE_DIR . $oBrf->getUrl() . '/meddelanden/skicka'; ?>" class="nav <?php echo $aClasses['skicka']; ?>"><?php echo $aMessageViews['skicka']; ?></a>
                    </li>
                    <li class="lista5">
                        <?php if (FALSE || $iNumberOfUnreadEmails > 0): ?>
                            <ul class="dropdown_left_siffra">
                                <li class="siffra1" style="height: 18px; margin-left: -25px; margin-top: 2px; text-align: center; width: 22px;">
                                    <?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') || strpos($_SERVER['HTTP_USER_AGENT'], 'Safari')): ?>
                                    <span style="position: relative; top: 2px;">
                                    <?php endif; ?>
                                    <?php echo $iNumberOfUnreadEmails; ?>
                                    <?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') || strpos($_SERVER['HTTP_USER_AGENT'], 'Safari')): ?>
                                    </span>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        <?php endif; ?>
                        <a href="<?php echo BASE_DIR . $oBrf->getUrl() . '/meddelanden/inkorg'; ?>" class="nav <?php echo $aClasses['inkorg']; ?>"><?php echo $aMessageViews['inkorg']; ?></a>
                    </li>
                    <li class="lista5">
                        <a href="<?php echo BASE_DIR . $oBrf->getUrl() . '/meddelanden/skickat'; ?>" class="nav <?php echo $aClasses['skickat']; ?>"><?php echo $aMessageViews['skickat']; ?></a>
                    </li>
                </ul>

            </li>
            <li><a class="nav dina_bokningar" href="<?php echo BASE_DIR; ?><?php echo $oBrf->getUrl(); ?>/medlemmar" onclick="$('#member_menu').toggle();return true;" style="cursor:pointer;">Medlemmar</a></li>
            <?php if (getUser()->isRegistered()): ?>
            <li id="dittKontoMenu"><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/medleminfo/' . getUserLinkName(getUser(), $aUserLinkNames, $iCounter, SvenskBRF_User::getUsersByBrfId($oBrf->getId())); ?>">Ditt konto</a></li>
            <?php else: ?>
            <li id="dittKontoMenu"><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/medlem'; ?>">Ditt konto</a></li>
            <?php endif; ?>
            <li><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/faq'; ?>">Hjälp/FAQ</a></li>
            <li style="background:#F48136; border:#ddd 1px solid;"><a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/felanmalan" class="nav">Felanmälan</a></li>
            <?php if (getUser()->isBoardMember()): ?>
            <li style="margin-left:40px; background-color:transparent; border:none;">
                <ul>
                    <li style="font-size:16px; color:#000; width:140px; border-bottom:1px solid #000; margin-bottom:20px;" class="rubrik_styrelse">För styrelsen</li>
                </ul>
                <ul class="navbar">
                   <li class="nav2">
                        <a class="nav" href="javascript:void(0)" onclick="return toggleMenu(this);" style="cursor:pointer;">Styrelselogg &gt;</a>
                        <ul id="styrelselogg_menu" class="menulink">
                            <li class="nav3 lista5"><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/styrelselogg/logg'; ?>">Logg</a></li>
                            <li class="nav3 lista5"><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/styrelselogg/inlagg'; ?>">Gör inlägg</a></li>
                            <li class="nav3 lista5"><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/styrelselogg/dokument'; ?>">Ladda upp dokument</a></li>
                            <li class="nav3 lista5"><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/styrelselogg/arkiv'; ?>">Arkiverade projekt</a></li>
                        </ul>
                    </li> 
                    <li class="nav2">
                        <a class="nav" href="javascript:void(0)" onclick="return toggleMenu(this);" style="cusror: pointer;">Dokumenthantering &gt;</a>
                        <ul id="dokumenthantering_menu" class="menulink">
                            <?php if (FALSE && !$oDocumentTypes->size()): ?>
                            <li class="nav3 lista5"><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/dokument/laddaupp/medlem'; ?>">Ladda upp medlemsdokument</a></li>
                            <?php endif; ?>
                            <li class="nav3 lista5"><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/dokument/styrelse'; ?>">Styrelsedokument</a></li>
                            <li class="nav3 lista5"><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/dokument/laddaupp'; ?>">Ladda upp dokument</a></li>
                            <li class="nav3 lista5"><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/dokument/administration'; ?>">Svensk Brf-dokument</a></li>
                            <li class="nav3 lista5"><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/dokument/arkiv'; ?>">Dokumentarkiv</a></li>
                            
                        </ul>
                    </li>
                    <li class="nav2">
                        <a class="nav" href="javascript:void(0)" onclick="return toggleMenu(this);" style="cursor:pointer;">Styrelseadmin &gt;</a>
                        <ul id="admin_menu" class="menulink">
                            <li class="nav3 lista5"><a class="nav"  href="<?php echo BASE_DIR . $oBrf->getUrl() . '/admin/kalender'; ?>">Kalender / Medlemmar</a></li>
                            <li class="nav3 lista5"><a class="nav"  href="<?php echo BASE_DIR . $oBrf->getUrl() . '/admin/styrelsekalender'; ?>">Kalender / Styrelsen</a></li>
                            <li class="nav3 lista5"><a class="nav"  href="<?php echo BASE_DIR . $oBrf->getUrl() . '/admin/skickasms'; ?>">Skicka SMS</a></li>
                            <li class="nav3 lista5"><a class="nav"  href="<?php echo BASE_DIR . $oBrf->getUrl() . '/admin/medlemmar'; ?>">Medlemsadministration</a></li>
                            <li class="nav3 lista5"><a class="nav"  href="<?php echo BASE_DIR . $oBrf->getUrl() . '/admin/bilder'; ?>">Bilder</a></li>
                            <li class="nav3 lista5"><a class="nav"  href="<?php echo BASE_DIR . $oBrf->getUrl() . '/admin/presentation'; ?>">Presentationstext</a></li>
                            <li class="nav3 lista5"><a class="nav"  href="<?php echo BASE_DIR . 'registrera/1'; ?>">Adress(er)</a></li>
                            <li class="nav3 lista5"><a class="nav"  href="<?php echo BASE_DIR . 'registrera/4'; ?>">Bokningsbara utrymmen</a></li>
                            <li class="nav3 lista5"><a class="nav"  href="<?php echo BASE_DIR . $oBrf->getUrl() . '/admin/sms'; ?>">SMS-inställningar</a></li>
                        </ul>
                    </li>
                    <li class="nav2"><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/maklarinformation'; ?>">Mäklarinformation</a></li>
                    <li class="nav2"><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/styrelsefaq'; ?>">FAQ / Styrelsen</a></li>
                    <?php if (($aMessages = $oBrf->getInactivatedFunctions())): ?>
                    <script type="text/javascript">
                        function hideMessage(settingType, element) {
                            $.post("<?php echo BASE_DIR; ?>ajax.php", {settingType : settingType, value : 1, action : 'setusersetting' }, function (response) {
                                if (response.result) {
                                    if ($(element).parent().find("div").size() > 1) {
                                        var _height = $(element).parent().height();
                                        $(element).parent().height(parseInt(_height - 40));
                                        var _hr = $(element).next().find("hr");
                                        $(element).remove();
                                        $(_hr).remove();
                                    } else {
                                        $(element).parent().remove();
                                    }
                                }     
                            }, 'json');
                            return false;
                        }
                    </script>
                    <?php $iMsgHeight = 30 + count($aMessages) * 45; ?>
                    <li class="bokningsbara_lokaler" style="border: 3px solid #DDDDDD; height: <?php echo $iMsgHeight; ?>px; margin-left: -30px; margin-top: 30px; padding: 8px; width: 132px; background: #D8EAEE; 2.	border-radius: 10px 10px 10px 10px;">
                        <b>Ni har ännu inte aktiverat följande funktioner</b>
                        <hr />
                        <?php $iMsgCount = 0; ?>
                        <?php foreach ($aMessages as $iSettingTypeId => $aMessages): ?>
                        <div>
                            <?php if ($iMsgCount && $iMsgCount < count($aMessages) + 1): ?>
                            <hr style="height:1px;border:none;color:#bbb;background-color:#bbb;"/>
                            <?php endif; ?>
                            <a href="<?php echo $aMessages[1]; ?>" style="display:inline; padding:0; color: #0099FF;"><?php echo $aMessages[0]; ?></a>
                            <br />
                            <a href="javascript:void(0)" style="display: inline; padding: 0; color: #0099FF;" onclick="return hideMessage(<?php echo $iSettingTypeId; ?>, $(this).parent());"><u>Dölj</u></a>
                        </div>
                        <?php $iMsgCount++; endforeach; ?>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            
            <?php endif; ?>
        </ul>
    </div>
    <br class="clear"/>
    <div id="bottenmarginal"></div>
</div>
