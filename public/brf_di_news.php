<?php
    if (!isset($bAd)) {
        $bAd = (bool) SHOW_AD;
    }
?>
<a href="http://www.di.se/amnen/sa-dyr-ar-borantan/" target="_blank"><img src="<?php echo BASE_DIR; ?>media/<?php if ($bAd): ?>brf/ny_DI<?php else: ?>img/di<?php endif; ?>.png" 
        <?php if (!$bAd): ?>
        width="239" 
        <?php else: ?>
        <?php if (($oUser = getUser()) && $oUser->getBrfId() == $oBrf->getId()): ?>
        width="505" 
        <?php else: ?>
        width="495" 
        <?php endif; ?>
        <?php endif; ?>
height="40" alt=""/></a>
<?php 
    // RSS
    $oDIXml = simplexml_load_string(file_get_contents("http://www.di.se/rss"));
?>
<ul id="nyhetsflode" class="horizontalScroller">
    <?php for ($iRepeat = 1; $iRepeat <= 10; $iRepeat++): ?>
    <?php foreach ($oDIXml->channel->item as $oNewsItem): ?>
    <li class="nyhetsflode">
        <a href="<?php echo $oNewsItem->link; ?>" target="_blank">
            <?php
                $sTitle = $oNewsItem->title;
            ?>
            <?php echo $sTitle; ?>
        </a>
    </li>
    <?php endforeach; ?>
    <?php endfor; ?>
</ul>