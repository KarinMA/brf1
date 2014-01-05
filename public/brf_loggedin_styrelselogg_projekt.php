<?php
$sProjectName = isset($sParameter) ? $sParameter : $_REQUEST['parameter'];
$oProject = NULL;
foreach (SvenskBRF_PresidentLog::getPresidentLogCategories($oBrf) as $oCategory) {
    if ($sProjectName === SvenskBRF_PresidentLog::getDirectoryNameForLogCategory($oCategory)) {
        $oProject = $oCategory;
        break;
    }
}
if ($sProjectName && !$oProject) {
    foreach (SvenskBRF_PresidentLog::getPresidentLogCategories($oBrf, TRUE) as $oCategory) {
        if ($sProjectName === SvenskBRF_PresidentLog::getDirectoryNameForLogCategory($oCategory)) {
            $oProject = $oCategory;
            break;
        }
    }    
}

?>
<?php if ($oProject != NULL): ?>
<script type="text/javascript">
    function removePresidentLog(logId) {
        if (confirm('Är du säker på att du vill ta bort?')) {
            $.post("<?php echo BASE_DIR; ?>ajax.php", {action : 'removepresidentlog', logId : logId}, function (response) {
                if (response.result) {
                    document.location.href = document.location.href;
                }
            }, 'json');
        }
    }
</script>
<script type="text/javascript">
    function gotoPresidentLog(presidentLog) {
        $.post("<?php echo BASE_DIR; ?>ajax.php", { action : 'gotopresidentlog', presidentLog : presidentLog }, function (response) {
            if (response.result) {
                document.location.href = '<?php echo BASE_DIR . $oBrf->getUrl(); ?>/styrelselogg/visa';
            }
        }, 'json');
        return false;
    }
</script>    
<img width="210" height="36" alt="Projekt" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/projekt.png" id="bla_skylt"/>
<?php
if ($oCategory): 
?>
<p>Här nedan ser ni de inlägg och dokument som finns kopplade till projektet. Ni kan även skriva nya inlägg och ladda upp dokument.
    <?php if (TRUE): ?>
    Klicka på den blå länkarna som finns under Inlägg och under Dokument för att läsa inlägget eller öppna dokumentet. 
    <?php endif; ?>
</p>
<div id="dokument">
    <div id="vanster_lista">
        <h5><?php echo $oProject->getCategoryName(); ?></h5> 
        <p style="margin-left: 20px;"><?php echo nl2br($oProject->getCategoryDescription()); ?></p>
        <h5>INLÄGG</h5> 
        <?php
            $oPresidentLogs = SvenskBRF_PresidentLog::getPresidentLogs($oBrf, $oCategory);
        ?>
        <div id="left1">
            <ul>
                <?php foreach ($oPresidentLogs as $oPLog): if (!$oPLog->isDocument()): ?>
                <li class="dokument1"><?php echo getDaySlashMonth($oPLog->getDate()) . ' - ' . substr($oPLog->getDate(), 0, 4); ?></li>
                <?php endif; endforeach; ?>
            </ul>
        </div>
        <div id="mitt1">
            <ul>
                <?php foreach ($oPresidentLogs as $oPLog): if (!$oPLog->isDocument()): ?>
                <li class="dokument1">
                    <!--<?php echo $oPLog->getHeader(); ?>-->
                    <a href="javascript:void(0)" onclick="return gotoPresidentLog(<?php echo $oPLog->getId(); ?>);"><?php echo $oPLog->getHeader(); ?></a>
                </li>
                <?php endif; endforeach; ?>
            </ul>

        </div>

        <div id="right1">
            <ul>
                <?php foreach ($oPresidentLogs as $oPLog): if (!$oPLog->isDocument()): ?>
                <li class="dokument1"><?php echo $oPLog->getPresidentLogCommentCollection()->size(); ?> kommentarer</li>
                <?php endif; endforeach; ?>
            </ul>
        </div>
        <div id="right2">
            <ul>
                <?php foreach ($oPresidentLogs as $oPLog): if (!$oPLog->isDocument()): ?>
                <li class="dokument1"><a href="javascript:void(0)" onclick="removePresidentLog(<?php echo $oPLog->getId(); ?>); return false;">Ta bort</a></li>
                <?php endif; endforeach; ?>
            </ul>
        </div>
        <label>
            <a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/styrelselogg/inlagg/<?php echo SvenskBRF_PresidentLog::getDirectoryNameForLogCategory($oProject); ?>"><img width="100" height="29" alt="Nytt inlägg" src="<?php echo BASE_DIR; ?>media/inloggad/img/nytt_inlagg.png" style="margin-left:15px; margin-top:10px;"/></a>
        </label>

        <h5>DOKUMENT</h5> 
        <div id="left1">
            <ul>
                <?php foreach ($oPresidentLogs as $oPLog): if ($oPLog->isDocument()): ?>
                <li class="dokument1"><?php echo getDaySlashMonth($oPLog->getDate()) . ' - ' . substr($oPLog->getDate(), 0, 4); ?></li>
                <?php endif; endforeach; ?>
            </ul>
        </div>
        <div id="mitt1">
            <ul>
                <?php foreach ($oPresidentLogs as $oPLog): if ($oPLog->isDocument()): ?>
                <li class="dokument1"><a href="javascript:void(0)" onclick="return gotoPresidentLog(<?php echo $oPLog->getId(); ?>);"><?php echo $oPLog->getLogName(); ?></a></li>
                <?php endif; endforeach; ?>
            </ul>

        </div>

        <div id="right1">
            <ul>
                <?php foreach ($oPresidentLogs as $oPLog): if ($oPLog->isDocument()): ?>
                <li class="dokument1"><?php echo $oPLog->getPresidentLogCommentCollection()->size(); ?> kommentarer</li>
                <?php endif; endforeach; ?>
            </ul>
        </div>
        <div id="right2">
            <ul>
                <?php foreach ($oPresidentLogs as $oPLog): if ($oPLog->isDocument()): ?>
                <li class="dokument1"><a href="javascript:void(0)" onclick="removePresidentLog(<?php echo $oPLog->getId(); ?>); return false;">Ta bort</a></li>
                <?php endif; endforeach; ?>
            </ul>
        </div>
        <label>
            <a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/styrelselogg/dokument/<?php echo SvenskBRF_PresidentLog::getDirectoryNameForLogCategory($oProject); ?>"><img width="150" height="29" alt="ladda upp dokument" src="<?php echo BASE_DIR; ?>media/inloggad/img/ladda_upp_dokument_knapp.png" style="margin-left:15px; margin-top:10px;"/></a>
        </label>
        <p><a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/styrelselogg/logg">&lt; Tillbaka </a></p>
    </div><!-- vanster_lista -->

    <br class="clear">
</div>
<?php endif; ?>
<?php else: ?>
<img width="210" height="36" alt="Projekt" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/projekt.png" id="bla_skylt"/>
<p>Här skapar du ett nytt projekt</p>
<form method="post" action="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/styrelselogg/logg">
    <h5>NYTT PROJEKT</h5>
    <p>Skriv ett namn på det nya projektet nedan samt en beskrivning för vad projektet handlar om. </p>
    <label for="categoryText" style="margin-left:15px;">
        Namn på projekt:<br /><input type="text" name="category" style="width:430px; margin-left: 15px;" id="categoryText"/> 
    </label>

    <input name="newcategory" id="newCategoryIndicator" type="hidden" value="1"/>
    <br />
    <label for="categoryDescription" style="margin-left:15px;">
        Beskrivning:<br /><textarea cols="60" rows="6" name="categoryDescription" id="categoryDescription" style="margin-left: 15px;"></textarea>
    </label>

    <label>
        <input type="image" align="left" alt="spara" style="position:relative;top:20px; width:78px; height:28px; border:0; margin-bottom:50px; margin-left:15px;" src="<?php echo BASE_DIR; ?>media/inloggad/img/spara.png" name="save"/>
    </label>
    <input type="hidden" name="action" value="savepresidentlogcategory"/>
</form>           
<?php endif; ?>

