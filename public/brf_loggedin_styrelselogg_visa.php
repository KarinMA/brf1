<?php
    if (!@$_SESSION[CURRENT_PRESIDENT_LOG]) {
        include './brf_loggedin_styrelselogg_logg.php';
    } else {
?>
<script type="text/javascript">
    function removeComment(commentId) {
        if (confirm('Är du säker på att kommentaren ska tas bort?')) {
            $.post("<?php echo BASE_DIR; ?>ajax.php", { commentId : commentId, action : 'removecomment' }, function (response) {
                if (response.result) {
                    //
                }
            }, 'json');
            return true;
        } else {
            return false;
        }
    }
</script>
<style type="text/css" >
    #right2 { 
        width: 130px;
        float: left;
        margin: 0px; 
        padding: 0px;
        margin-left: -20px;
    }

    h5 {
        font-size: 15px;
        margin: 40px 0 0 15px;
    }

    #mitt1 {
        width: 150px;
    }
</style>
<?php
$oLog = SvenskBRF_PresidentLog::loadById(@$_SESSION[CURRENT_PRESIDENT_LOG]);
$oProject = getPresidentLogCategoryAccessor()->getById($oLog->getPresidentLogCategoryId());
if ($oLog):
    $sHeaderImage = $oLog->isDocument() ? 'dokument' : 'Kommentarinlagg';
?>
    <img width="210" height="36" alt="Dokument" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/<?php echo $sHeaderImage; ?>.png" id="bla_skylt"/>
    <p>
        <?php if ($oLog->isDocument()): ?>
        Nedan kan ni öppna dokumentet och även lägga till kommentarer på dokumentet. Tryck på länken öppna alternativt spara om ni vill spara ner dokumentet på er dator.
        <?php else: ?>
        Nedan ser ni ett inlägg på ett projekt. Ni kan kommentera inlägget nedan.
        <?php endif; ?>
    </p>


    <div id="dokument">
        <div id="vanster_lista">
            <h5>
                <?php if ($oLog->isDocument()): ?>
                <?php echo $oProject->getCategoryName(); ?><br /><br />
                <a href="javascript:void(0)" onclick="document.forms['document_form_open'].submit(); return false;">
                    <img width="14" height="14" style="margin-top: 5px; margin-right: 10px;" src="<?php echo BASE_DIR; ?>media/img/<?php echo $oLog->getDocument()->getFileType() . '.' . $oLog->getDocument()->getIconImageType(); ?>" target="_blank"/>
                </a>
                &nbsp;
                <?php echo $oLog->getLogName(); ?>
                &nbsp;
                <a style="font-size:11px; font-weight:100; margin-left:20px;" href="javascript:void(0)" onclick="document.forms['document_form_save'].submit();">Spara</a>
                &nbsp;
                <a style="font-size:11px; font-weight:100; margin-left:20px;" href="javascript:void(0)" onclick="document.forms['document_form_open'].submit();" target="_blank">Öppna</a>
              
                <br />
                <span style="font-style: oblique; font-size: xx-small; position: relative; top: 2px;">
                    <?php
                        $oFromUser = SvenskBRF_User::loadById($oLog->getCreatedByUserId());
                        echo "Skapades av " . $oFromUser->getName() . ' ' . substr($oLog->getDate(), 0, 10);
                    ?>
                </span>
                <form name="document_form_save" method="post" action="<?php echo BASE_DIR; ?>/ajax.php">
                    <input type="hidden" name="id" value="<?php echo $oLog->getDocument()->getId(); ?>"/>
                    <input type="hidden" name="action" value="downloaddocument"/>
                </form>
                <form name="document_form_open" method="post" action="<?php echo BASE_DIR; ?>/ajax.php">
                    <input type="hidden" name="id" value="<?php echo $oLog->getDocument()->getId(); ?>"/>
                    <input type="hidden" name="action" value="opendocument"/>
                </form>
                <?php else: ?>
                <?php echo $oProject->getCategoryName(); ?> - <?php echo $oLog->getHeader(); ?>
                <br />
                <span style="font-style: oblique; font-size: xx-small; position: relative; top: 2px;">
                    <?php
                        $oFromUser = SvenskBRF_User::loadById($oLog->getCreatedByUserId());
                        echo "Skapades av " . $oFromUser->getName() . ' ' . substr($oLog->getDate(), 0, 10);
                    ?>
                </span>
                <?php endif; ?>
            </h5>
            
            
            <h5>Beskrivning</h5>
            <p><?php echo nl2br($oLog->getComment()); ?></p>
            
            <h4 style="margin-left: 15px; font-size: 14px; margin-bottom: 15px; margin-top:20px;">KOMMENTARER</h4>
            <?php
                $oComments = $oLog->getPresidentLogCommentCollection();
            ?>
            <?php foreach ($oComments as $iCommentIndex => $oComment): ?>
            <div id="spalt_block">
                <div id="left1">
                    <p class="dokument1"><?php echo getDaySlashMonth($oComment->getTimestamp()) . '-' . substr($oComment->getTimestamp(), 0, 4); ?></p>
                </div>
                <div id="mitt1">
                    <p class="dokument1" style="margin-left: -50px; margin-right: 0px;"><i><?php
                        $oUserCommenter = $oComment->getByUser();
                        if (!$oUserCommenter) {
                            $oUserCommenter = SvenskBRF_User::loadById($oComment->getByUserId());
                        }
                        echo $oUserCommenter->getName();
                    ?></i></p>
                </div>
                <div id="right1">
                    <p class="dokument1" style="margin-left: -70px; margin-right: -40px;"><?php echo nl2br($oComment->getComment()); ?></p>
                </div>
                <div class="right2" style="float:right; margin-right: 15px; margin-top: 15px;">
                    <form method="post" action="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/styrelselogg/visa" name="comment_<?php echo $iCommentIndex; ?>">
                        <input name="logId" type="hidden" value="<?php echo $oComment->getPresidentLogId(); ?>"/>
                        <a 
                            href="javascript:void(0)" 
                            onclick="if (removeComment(<?php echo $oComment->getId(); ?>)) { window.setTimeout('document.forms[\'comment_<?php echo $iCommentIndex; ?>\'].submit();', 750); } return false;">

                            Ta bort
                        </a>
                    </form>
                </div>
            </div>
            
            <?php endforeach; ?>
            <br />
            <br />
            <form style="margin-left:15px;" method="post" action="">
                <textarea cols="55" rows="4" name="comment" style="padding: 10px;"></textarea>
                <label>
                    <input type="image" alt="Lägg till kommentar" src="<?php echo BASE_DIR; ?>media/inloggad/img/lagg_till_kommentar.png" style="margin-top: -5px; width: 150px; height: 29px; border: none;"/>
                    <br />
                    <br />
                    <br />
                    <br />
                </label>
                <input type="hidden" name="action" value="savecomment"/>
                <input type="hidden" name="logId" value="<?php echo $oLog->getId(); ?>"/>
            </form>


            <p><a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/styrelselogg/projekt/<?php echo SvenskBRF_PresidentLog::getDirectoryNameForLogCategory($oProject); ?>">&lt; Tillbaka </a></p>
        </div><!-- vanster_lista -->

        <br class="clear">
    </div>

<?php else: ?>
    <p><a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/styrelselogg/logg">&lt; Tillbaka </a></p>
<?php endif; ?>
<?php } ?>