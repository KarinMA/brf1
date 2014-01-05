<?php
$aResources = getResourceTypeAccessor()->getAll();
if (@$_POST['save']) {

    foreach ($aResources as $oResource) {
        if ($oResource->getId() == $_POST['id']) {
            foreach ($_POST['resource'] as $sProperty => $sValue) {
                if (method_exists($oResource, "set" . $sProperty)) {
                    call_user_func_array(array($oResource, "set$sProperty"), array($sValue));
                }
            }
        }
    }
}
?>
<?php
foreach ($aResources as $oResource):
?>
<form action="" method="post">
    <input type="text" name="resource[TypeName]" value="<?php echo $oResource->getTypeName(); ?>" />
    <textarea name="resource[InstructionText]"><?php echo $oResource->getInstructionText(); ?></textarea>
    <input type="hidden" name="id" value="<?php echo $oResource->getId(); ?>" />
    <input type="submit" name="save" value="Spara" />
</form>
<?php endforeach; ?>
