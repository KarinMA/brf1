<?php
include 'setup.php';

// kopiera anna
$annaid = 803;
//$brfs = range(138085,138094);
$brfs = array(138096);

$brfs = array_combine(array(
    /*4,
    10,
    11,
    12,
    //13,
    14,
    15,
    16,
    17,
    18,
    19,*/
    21
), $brfs);

// hej anna
$oAnna = SvenskBRF_User::loadById($annaid);

// get user column array
$useridq = "SELECT * from user where id = $annaid";
$ur = mysql_query($useridq, $rDatabaseConnection);
$aCalendar = mysql_fetch_assoc($ur);
unset($aCalendar['id']);



foreach ($brfs as $expid => $bid) {
    $aValues = array();
    foreach ($aCalendar as  $sKey => $val) {
        if (!is_null($val)) {
            $aValues[$sKey] = "'$val'";
        } else {
            $aValues[$sKey] = 'NULL';
        }
    }
    $aValues['login_cookie'] = "'".SvenskBRF_User::generatePassword(32)."'";
    $aValues['external_partner_id'] = "'$expid'";
    $oExt = SvenskBRF_ExternalPartner::load(getExternalPartnerAccessor()->getById($expid));
    $aValues['username'] = "'" . $oExt->getPartnerName() . "'";
    $aValues['password'] = "'" . $oExt->getPartnerName() . "'";
    
    
    
    
    if (mysql_query("INSERT INTO `user` (`" . implode("`,`", array_keys($aCalendar)) . "`) VALUES ("  . implode(",", $aValues) . ")", $rDatabaseConnection)) {
    $newid = mysql_insert_id($rDatabaseConnection);
    if (!copy("./../files/userpictures/" . $annaid . "." . $oAnna->getImageType(), "./../files/userpictures/" . $newid . "." . $oAnna->getImageType())) {
        echo "misslyckad kopiering";
    }
    
    $oBrf = SvenskBRF_Brf::loadById($bid);
    $oBrf->setRealtorUserId($newid);
    } else {
        echo "KUNDE INTE SKAPA: " . mysql_error($rDatabaseConnection);
    }
    
}











/*$brfId = 96113;
$brfId = 138086;
$brf2 = array(138104,  // 20
);
//s$brf2 = array_merge(array(138085), array()); //range(138088, 138103));
*/

/* MEDLEMMAR
$r = mysql_query("SELECT * FROM `user` WHERE brf_id = $brfId and admin = 0 and is_registered = 1 and username not like 'sv%' LIMIT 3", $rDatabaseConnection);
$oOldBrf = SvenskBRF_Brf::loadById($brfId);
while (($aCalendar = mysql_fetch_assoc($r))) {

    $oldId = $aCalendar['id'];
    unset($aCalendar['id']);
    
    
    foreach ($brf2 as $bid) {
        $aCalendar['brf_id'] = $bid;
        
        
        $aValues = array();
        foreach (($aCalendar)as  $sKey => $val) {
            if (!is_null($val)) {
                $aValues[$sKey] = "'$val'";
            } else {
                $aValues[$sKey] = 'NULL';
            }
        }
        $aValues['has_picture'] = file_exists("./../files/userpictures/".$oldId.".". $aCalendar['image_type']) ? "'1'" : "'0'";
        $aValues['image_type'] = $aValues['has_picture'] ? ("'" . $aCalendar['image_type'] . "'") : 'NULL';
        $aValues['login_cookie'] = "'".SvenskBRF_User::generatePassword(32)."'";
        var_dump($aValues);
        //continue;
        if (!mysql_query(($sQuery = "INSERT INTO user (`" . implode("`,`", array_keys($aValues)) . "`) VALUES (" . implode(",", array_values($aValues)) . ")"), $rDatabaseConnection)) {
            echo $sQuery . mysql_error($rDatabaseConnection);
        } else {
            
            if ($aCalendar['has_picture'] && file_exists("./../files/userpictures/".$oldId.".". $aCalendar['image_type'])) {
                copy("./../files/userpictures/".$oldId.".". $aCalendar['image_type'],
                        "./../files/userpictures/".mysql_insert_id($rDatabaseConnection).".". $aCalendar['image_type']);
                        
            }
        }
        
          
    }
}

*/


/* BILDER
$r = mysql_query("SELECT * FROM `brf_picture` WHERE brf_id = $brfId and front = 0", $rDatabaseConnection);
$oOldBrf = SvenskBRF_Brf::loadById($brfId);

while (($aCalendar = mysql_fetch_assoc($r))) {

    $oldId = $aCalendar['id'];
    unset($aCalendar['id']);
    
    
    foreach ($brf2 as $bid) {
        $aCalendar['brf_id'] = $bid;
        $oNewBrf = SvenskBRF_Brf::loadById($bid);
        if (file_exists("./../files/brfs/" . $oOldBrf->getUrl() . "/pictures/brf/$oldId.".$aCalendar['image_type'])) {
            
            
            if (!mysql_query("INSERT INTO brf_picture (`".implode("`,`", array_keys($aCalendar)) . "`) VALUES ('" . implode("','", array_values($aCalendar)) . "')", $rDatabaseConnection)) {
                echo mysql_error($rDatabaseConnection);
            } else {
            
            copy(
                    "./../files/brfs/" . $oOldBrf->getUrl() . "/pictures/brf/$oldId.".$aCalendar['image_type'],
                    "./../files/brfs/" . $oNewBrf->getUrl() . "/pictures/brf/" .  mysql_insert_id($rDatabaseConnection).".".$aCalendar['image_type']
            );
            
            }
        }
        
    }

}*/



/* RESURSER
$r = mysql_query("SELECT * FROM `resource` WHERE brf_id = $brfId", $rDatabaseConnection);
$oOldBrf = SvenskBRF_Brf::loadById($brfId);


$useridq = "SELECT id from user where brf_id = $brfId and admin = 1";
$ur = mysql_query($useridq, $rDatabaseConnection);
$userdata = mysql_fetch_assoc($ur);
$oldUserId = $userdata['id'];


while (($aCalendar = mysql_fetch_assoc($r))) {

    $oldId = $aCalendar['id'];
    unset($aCalendar['id']);
    

    
    foreach ($brf2 as $bid) {
        
            
        $rdresult = mysql_query("SELECT * from resource_day WHERE resource_id = $oldId", $rDatabaseConnection);

        $rbresult = mysql_query("SELECT * from resource_booking where resource_id = $oldId and user_id = $oldUserId");


        
        $useridq = "SELECT id from user where brf_id = $bid and admin = 1";
        $ur = mysql_query($useridq, $rDatabaseConnection);
        $userdata = mysql_fetch_assoc($ur);
        $newUserId = $userdata['id'];

        var_dump("newuserid", $newUserId);
        
        $aCalendar['brf_id'] = $bid;
        $aValues = array();
        foreach (array_values($aCalendar) as $val) {
            if (!is_null($val)) {
                $aValues[] = "'$val'";
            } else {
                $aValues[] = 'NULL';
            }
        }
        $query = "INSERT INTO resource (`" .implode("`,`",array_keys($aCalendar)) . "`) VALUES (" . implode(",", array_values($aValues)).")";
        //echo "$query<br/>";
        
        if (true || mysql_query($query, $rDatabaseConnection)) {
            //$newid = mysql_insert_id($rDatabaseConnection);
            
            $oNBrf = SvenskBRF_Brf::loadById($bid);
            if (file_exists("./../files/brfs/".$oOldBrf->getUrl() . "/documents/lokaler/" . $aCalendar['name'] . '.pdf')) {
                 copy("./../files/brfs/".$oOldBrf->getUrl() . "/documents/lokaler/" . $aCalendar['name'] . '.pdf', "./../files/brfs/".$oNBrf->getUrl() . "/documents/lokaler/" . $aCalendar['name'] . '.pdf');
            }
            $useridq1 = "SELECT id from resource where brf_id = $bid and name = '" . $aCalendar['name']."'";
            $ur1 = mysql_query($useridq1, $rDatabaseConnection);
            $userdata1 = mysql_fetch_assoc($ur1);
            $newid = $userdata1['id'];
            
            
            var_dump("newid",$newid);
            while (($day = mysql_fetch_assoc($rdresult))) {
                unset($day['id']);
                $day['resource_id'] = $newid;
                $queryd = "INSERT INTO resource_day (`" .implode("`,`",array_keys($day)) . "`) VALUES (" . implode(",", array_values($day)).")";
                
                if (!mysql_query($queryd, $rDatabaseConnection)) {
                    echo "error2 ". mysql_error($rDatabaseConnection);
                    die;
                }
            }
            
            // the bookings..

             while (($booking = mysql_fetch_assoc($rbresult))) {
                 unset($booking['id']);
                 $booking['user_id'] = $newUserId;
                 $booking['mail_reminder'] = 0;
                 $booking['sms_reminder'] = 0;
                 $booking['unbook_code'] = SvenskBRF_User::generatePassword(7);
                 $booking['resource_id'] = $newid;
                 $queryb = "INSERT INTO resource_booking (`" . implode("`,`", array_keys($booking)) . "`) VALUES ('" .implode("','", array_values($booking)) . "')";
                 
                 if (mysql_query($queryb, $rDatabaseConnection)) {

                 } else {
                     echo "ERROR3: " . mysql_error($rDatabaseConnection);
                 }
             }
             
             
             
        } else {
            echo "error: " . mysql_error($rDatabaseConnection);
        }
        
    }
}*/



/* ANSLAGSTAVLA
$r = mysql_query("SELECT * FROM `message` WHERE brf_id = $brfId", $rDatabaseConnection);
$oOldBrf = SvenskBRF_Brf::loadById($brfId);
while (($aCalendar = mysql_fetch_assoc($r))) {
    $oOldSender = SvenskBRF_User::loadById($aCalendar['sender_id']);
    foreach ($brf2 as $bid) {
        $useridq = "SELECT id from user where brf_id = $bid and admin = 1";
        $ur = mysql_query($useridq, $rDatabaseConnection);
        unset($aCalendar['id']);
        $userdata = mysql_fetch_assoc($ur);
        $aCalendar['sender_id'] = $userdata['id'];
        $oBrf = SvenskBRF_Brf::loadById($bid);
        $oSender = SvenskBRF_User::loadById($aCalendar['sender_id']);
        $sLink = switchCharacters($oOldSender->getName(), FALSE, TRUE);
        $sLink .= "-" . str_replace(array(' ', ':'), array('-', '-'), $aCalendar['send_time']);
        
        $sLink2 = switchCharacters($oSender->getName(), FALSE, TRUE);
        $sLink2 .= "-" . str_replace(array(' ', ':'), array('-', '-'), $aCalendar['send_time']);
        $insert = true;
        if ($aCalendar['has_picture']) {
            $sOldPath = "./../files/brfs/".$oOldBrf->getUrl()."/pictures/message/" .$sLink . "." . $aCalendar['image_type'];
            var_dump($sOldPath);
            if (file_exists($sOldPath)) {
                $sNewPath = "./../files/brfs/".$oBrf->getUrl()."/pictures/message/" .$sLink2 . "." . $aCalendar['image_type'];
                copy($sOldPath, $sNewPath);
            } else{
                $insert = false;
            }
        }
        if ($insert) {
            $aCalendar['brf_id'] = $bid;
            $aValues = array();
            foreach (array_values($aCalendar) as $val) {
                if (!is_null($val)) {
                    $aValues[] = "'$val'";
                } else {
                    $aValues[] = 'NULL';
                }
            }
            $query = "INSERT INTO message (`" .implode("`,`",array_keys($aCalendar)) . "`) VALUES (" . implode(",", array_values($aValues)).")";
            //echo "$query<br/>";
            mysql_query($query, $rDatabaseConnection);
            echo mysql_error();
        }
    }
}*/



/*
$r = mysql_query("SELECT * FROM `calendar` WHERE brf_id = $brfId", $rDatabaseConnection);
while (($aCalendar = mysql_fetch_assoc($r))) {
    unset($aCalendar['id']);
    
    foreach ($brf2 as $bid) {
        $aCalendar['brf_id'] = $bid;
        var_dump(array_keys($aCalendar), array_values($aCalendar));
        $aValues = array();
        foreach (array_values($aCalendar) as $val) {
            if (!is_null($val)) {
                $aValues[] = "'$val'";
            } else {
                $aValues[] = 'NULL';
            }
        }
        $query = "INSERT INTO calendar (`" .implode("`,`",array_keys($aCalendar)) . "`) VALUES (" . implode(",", array_values($aValues)).")";
        //echo "$query<br/>";
        mysql_query($query, $rDatabaseConnection);
        //echo mysql_error();
    }
    
}
*/




include 'unsetup.php';