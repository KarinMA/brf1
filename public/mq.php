<?php
include 'setup.php';
$iProcessed = SvenskBRF_Notice::processQueue();
echo "Processed $iProcessed queued messages!";
include 'unsetup.php';
?>
