<?php

include 'setup.php';



//SvenskBRF_Brf::readBrfs2("/tmp/brf1.csv", (int) @$_REQUEST['offset'], @$_REQUEST['limit'] ? $_REQUEST['limit'] : FALSE);
//SvenskBRF_Brf::readBrfs2("/tmp/brf1.csv", (int) @$_REQUEST['offset'], @$_REQUEST['limit'] ? $_REQUEST['limit'] : FALSE);
SvenskBRF_Brf::createTestBrfs();

include 'unsetup.php';




