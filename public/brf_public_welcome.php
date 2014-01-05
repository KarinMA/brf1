<?php
    $iLimit = 210;
?>
<h4>Välkommen till brf <?php echo $oBrf->getName(); ?></h4>
<p class="centertext">
    <?php if ($oBrf->getActivated() && !$oBrf->getPresentation()): ?>
    Presentationstext kommer inom kort.
    <?php else: ?>
    <?php if ($oBrf->getActivated()): ?>
    <?php if (strlen($oBrf->getPresentation()) <= $iLimit): ?>
    <?php echo nl2br($oBrf->getPresentation()); ?>
    <?php else: ?>
    <?php echo nl2br(substr($oBrf->getPresentation(), 0, $iLimit)); ?><span id="dots">... </span><a href="javascript:void(0)" id="readMore">Läs mer &gt;</a><span style="display:none;" id="moreText"><?php echo nl2br(substr($oBrf->getPresentation(), $iLimit)); ?></span>
    <?php endif; ?>
    <?php else: ?>
    I samband med att er nya hemsida aktiveras får ni möjlighet att på ett trevligt sätt berätta om er förening. Det är den information som blir synlig här på den offentliga delen av hemsidan.
    Om din förening inte blivit aktiverad än kan du klicka <a href="<?php echo BASE_DIR; ?>tipsa/<?php echo $oBrf->getUrl(); ?>">här</a> för att tipsa någon i din styrelse.
    Er nya hemsida hos Svensk Brf ger er  tillgång till ett stort antal funktioner som förenklar vardagen för dig som boende och styrelsemedlem.
    Läs <a href="<?php echo BASE_DIR; ?>tjanster">här</a> om alla fördelar med en egen hemsida. Det är helt gratis att ha en egen hemsida hos Svensk Brf.
    <a href="<?php echo BASE_DIR; ?>aktivera/<?php echo $oBrf->getUrl(); ?>">Aktivera nu!</a>
    <?php endif; ?>
    <?php endif; ?>
</p> 
<script type="text/javascript">
    $("#readMore").click(function(){
        $("#dots,#readMore").fadeOut();
        $("#moreText").fadeIn();
    });
</script>
<?php include './brf_public_icons.php'; ?>
