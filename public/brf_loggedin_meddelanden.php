<?php if (@$_REQUEST['subview'] && file_exists("brf_loggedin_meddelanden_" . $_REQUEST['subview'] . '.php')): ?>
<?php include 'brf_loggedin_meddelanden_' . $_REQUEST['subview'] . '.php'; ?>
<script type="text/javascript">
    initMenu($("#meddelanden_menu"));
</script>
<?php else: ?>
<script type="text/javascript">
    $(document).ready(function(){
        document.location.href='<?php echo BASE_DIR . $oBrf->getUrl(); ?>';
    });
</script>
<?php endif; ?>
