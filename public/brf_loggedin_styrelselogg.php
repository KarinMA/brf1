<?php
    switch ($sAction) {
        case 'movetolog':
            getPresidentLogCategoryAccessor()->getById($_POST['projectid'])->setArchive(FALSE);
            $sJsAction = 'window.location.reload()';
    }
?>
<script type="text/javascript">
    function removeProject(projectid) {
        if (confirm('Är du säker på att du vill ta bort projektet?')) {
            $.post("<?php echo BASE_DIR; ?>ajax.php", {action : 'removeproject', projectid : projectid}, function (response) {
               if (response.result) {
                   document.location.reload();
               } 
            }, 'json');
        }
        return false;
    }
    
    function archiveProject(projectid) {
        if (confirm('Är du säker på att du vill arkivera projektet?')) {
            $.post("<?php echo BASE_DIR; ?>ajax.php", {action : 'archiveproject', projectid : projectid}, function (response) {
               if (response.result) {
                   document.location.reload();
               } 
            }, 'json');
        }
        return false;
    }
    function moveToLog(projectid) {
        $.post("<?php echo BASE_DIR; ?>ajax.php", {action : 'movetolog', projectid : projectid}, function (response) {
           if (response.result) {
               document.location.href = '<?php echo BASE_DIR . $oBrf->getUrl() . '/styrelselogg/logg'; ?>';
           } 
        }, 'json');

        return false;
    }
</script>
<?php
    echo "";
    switch ($sAction) {
        case 'savepresidentlogcategory':
            $oLogCategory = SvenskBRF_PresidentLog::getLogCategory($oBrf, $_POST['category'], @$_POST['newcategory'], @$_POST['categoryDescription']);
            $sParameter = SvenskBRF_PresidentLog::getDirectoryNameForLogCategory($oLogCategory);
            break;
        case 'savepresidentlog':
            $oLogCategory = SvenskBRF_PresidentLog::getLogCategory($oBrf, $_POST['category'], @$_POST['newcategory'], @$_POST['categoryDescription']);
            $oPresidentLog = SvenskBRF_PresidentLog::save(getBrf(), $oLogCategory, $_POST['date'], @$_POST['logName'], @$_POST['header'], $_POST['comment']);
            if (isset($_FILES['document'])) {
                $oPresidentLog->attachDocument($_FILES['document']);
            }
            $sParameter = SvenskBRF_PresidentLog::getDirectoryNameForLogCategory($oLogCategory);
            break;
        case 'removeproject':
            SvenskBRF_PresidentLog::removeProject($oBrf, $_POST['projectid']);
            break;
        case 'savecomment':
            $oPLog = SvenskBRF_PresidentLog::loadById($_POST['logId']);
            if ($oPLog->getBrfId() == $oBrf->getId()) {
                $oPLog->saveComment(trim($_POST['comment']));
            }
            break;
        case 'removecomment':
            $oComment = getPresidentLogCommentAccessor()->getById($_POST['commentId']);
            if ($oComment && $oComment->getPresidentLogId() == $_POST['logId']) {
                $oComment->delete();
            }
            break;
    }

?>
<?php if ($sSubView && file_exists("brf_loggedin_styrelselogg_" . $sSubView . '.php')): ?>
<?php include 'brf_loggedin_styrelselogg_' . $_REQUEST['subview'] . '.php'; ?>
<script type="text/javascript">
    initMenu($("#styrelselogg_menu"));
</script>
<?php else: ?>
<script type="text/javascript">
    $(document).ready(function(){
        document.location.href='<?php echo BASE_DIR . $oBrf->getUrl(); ?>';
    });
</script>
<?php endif; ?>
