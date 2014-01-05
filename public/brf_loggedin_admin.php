<?php
$sAdminParameter = @$_REQUEST['parameter'];
if (file_exists(($sAdminScript = "brf_loggedin_admin_" . @$_REQUEST['subview'].'.php'))):
include "brf_loggedin_admin_" . $_REQUEST['subview'].'.php';
else:
?>
<img id="bla_skylt" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/styrelseadmin.png" width="210" height="36" alt="styrelseadmin"/>
<p>I menyn till vänster ser du de olika admin-funktionerna.</p>
<?php endif; ?>
<script type="text/javascript">
    initMenu($("#admin_menu"));
</script>