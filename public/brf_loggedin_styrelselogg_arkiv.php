<?php echo getHeaderPicture("Arkiverade", 'projekt', 'bla_skylt', 0, 200); ?>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<p>Nedan ser ni de projekt ni arkiverat. Klicka på projektnamnet för att öppna projektmappen. Då kan ni se samtliga dokument och inlägg.</p>

<!--<p>
    <a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/styrelselogg/projekt">
        <img src="<?php echo BASE_DIR; ?>media/inloggad/img/nytt_projekt.png"/>
    </a>
</p>-->

<div id="dokument">
    <div id="vanster_lista">
        <h5>PROJEKT</h5> 
        <div id="left1">
            <ul>
                <?php foreach (SvenskBRF_PresidentLog::getPresidentLogCategories($oBrf, TRUE) as $oCategory): ?>
                <li class="dokument1">
                    <a class="namn_projekt" href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/styrelselogg/projekt/<?php echo SvenskBRF_PresidentLog::getDirectoryNameForLogCategory($oCategory); ?>"><span class="namn_projekt" style="color:#0099FF;"><?php echo $oCategory->getCategoryName(); ?></span></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="mitt1">
            <ul>
                <?php foreach (SvenskBRF_PresidentLog::getPresidentLogCategories($oBrf, TRUE) as $oCategory): ?>
                <li class="dokument1"><a onclick="return moveToLog(<?php echo $oCategory->getId(); ?>);" href="javascript:void(0)">Flytta till logg</a></li>
                <?php endforeach; ?>
                
            </ul>
        </div>

        <div id="right1" style="float:right;">
            <ul>
                <?php foreach (SvenskBRF_PresidentLog::getPresidentLogCategories($oBrf, TRUE) as $oCategory): ?>
                <li class="dokument1"><a href="javascript:void(0)" onclick="return removeProject(<?php echo $oCategory->getId(); ?>); return false;">Ta bort</a></form></li>
                <?php endforeach; ?>
            </ul>
        </div>
        
    </div><!-- vanster_lista -->

    <br class="clear">
</div>
<script type="text/javascript">
    $("a.nav:contains('Arkiverade projekt')").css('font-style', 'oblique');
</script>


