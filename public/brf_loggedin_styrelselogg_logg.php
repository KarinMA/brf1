<img width="210" height="36" alt="Dokument" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/logg.png" id="bla_skylt"/>
<p>Nedan ser ni de existerande projekt ni lagt upp. Klickar ni på projektnamnet så kommer ni in i projektmappen och kan se vilka dokument/inlägg som är inlagda.</p>
<p>Ni kan även välja att göra ett inlägg alternativt ladda upp ett dokument direkt i ett projekt genom att klicka på länken till höger om projektnamnet. Vill ni skapa ett nytt projekt så klickar ni på länken skapa ett nytt projekt nedan.</p>

<p>
    <a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/styrelselogg/projekt">
        <img src="<?php echo BASE_DIR; ?>media/inloggad/img/nytt_projekt.png"/>
    </a>
</p>

<div id="dokument">
    <div id="vanster_lista">
        <h5>PROJEKT</h5> 
        <div id="left1">
            <ul>
                <?php foreach (SvenskBRF_PresidentLog::getPresidentLogCategories($oBrf, FALSE) as $oCategory): ?>
                <li class="dokument1">
                    <a class="namn_projekt" href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/styrelselogg/projekt/<?php echo SvenskBRF_PresidentLog::getDirectoryNameForLogCategory($oCategory); ?>"><span class="namn_projekt" style="color:#0099FF;"><?php echo $oCategory->getCategoryName(); ?></span></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="mitt1">
            <ul>
                <?php foreach (SvenskBRF_PresidentLog::getPresidentLogCategories($oBrf, FALSE) as $oCategory): ?>
                <li class="dokument1"><a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/styrelselogg/inlagg/<?php echo SvenskBRF_PresidentLog::getDirectoryNameForLogCategory($oCategory); ?>">Gör inlägg</a></li>
                <?php endforeach; ?>
                
            </ul>
        </div>

        <div id="right1">
            <ul>
                <?php foreach (SvenskBRF_PresidentLog::getPresidentLogCategories($oBrf, FALSE) as $oCategory): ?>
                <li class="dokument1"><a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/styrelselogg/dokument/<?php echo SvenskBRF_PresidentLog::getDirectoryNameForLogCategory($oCategory); ?>">Ladda upp dokument</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="right2" style="float: right; margin-right: 15px;">
            <ul>
                <?php foreach (SvenskBRF_PresidentLog::getPresidentLogCategories($oBrf, FALSE) as $oCategory): ?>
                <li class="dokument1"><form method="post" action=""><input type="hidden" name="action" value="archiveproject"/><input type="hidden" name="projectid" value="<?php echo $oCategory->getId(); ?>"/><a href="javascript:void(0)" onclick="return archiveProject(<?php echo $oCategory->getId(); ?>); return false;">Arkivera</a></form></li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div><!-- vanster_lista -->

    <br class="clear">
</div>
<script type="text/javascript">
    $("a.nav:contains('Logg')").css('font-style', 'oblique');
</script>


