<?php

$sBasePath = './../files/brfs/';
foreach ($aBrfs = scandir($sBasePath) as $sBrfDir) {
    if ($sBrfDir != '.' && $sBrfDir != '..') {
        @mkdir($sBasePath . $sBrfDir . '/documents/arkiv');
    }
}

?>
