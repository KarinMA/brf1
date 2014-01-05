<div class="box4">
    <div id="wrap">
        <ul class="navbar">
            <li><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/profil'; ?>">Hem</a></li>
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
                <a class="nav" href="javascript:void(0)" onclick="$('ul.dropdown_left_siffra').eq(1).hide(); window.setTimeout(showNumber, 750); return toggleMenu(this);" style="cursor:pointer;">In/utkorg &gt;</a>
                <ul id="meddelanden_menu" class="menulink">
                    <?php $aClasses = array('inkorg' => 'inkorg', 'skicka' => 'nytt_meddelande', 'skickat' => 'skickat'); ?>
                    <?php $aMessageViews = array('skicka' => 'Skicka', 'inkorg' => 'Inkorg', 'skickat' => 'Besvarade',); ?>
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
            
            
            <li><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/registreringskod'; ?>">Skapa aktiveringslänk</a></li>
            
            <li>
                <a class="nav" href="javascript:void(0)" onclick="return toggleMenu(this);" style="cursor:pointer;">Dina föreningar - admin &gt;</a>
                <ul id="foreningar_menu" class="menulink">
                    <?php foreach (($aBrfs = getUser()->getRealtorBrfs($oBrf)) as $oRealtorBrf): ?>
                    <li class="lista5">
                        <a href="<?php echo BASE_DIR . 'maklare/profil/' . $oRealtorBrf->getUrl(); ?>" class="nav"><?php echo $oRealtorBrf->getName(); ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li id="dittKontoMenu"><a  class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/installningar'; ?>">Inställningar</a></li>
            <?php if (TRUE): ?><li><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/dokumentochinformation'; ?>">Dokument, information och mallar</a></li><?php endif ;?>
            <li><a class="nav" href="<?php echo BASE_DIR . $oBrf->getUrl() . '/maklarfaq'; ?>">Hjälp/FAQ</a></li>
        </ul>
    </div>
</div>
