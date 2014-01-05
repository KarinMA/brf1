<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BRFSmser
 *
 * @author John Jansson
 */
class Messaging_Sender_BRFSmser implements Messaging_SenderInterface
{
    const USERNAME = 'Ovansjo';
    const PASSWORD = 'abcdef123';
    
    /**
     *
     * @param SvenskBRF_Notice $a_oNotice
     */
    function send(SvenskBRF_Notice $a_oNotice)
    {
        $sServiceUrl = "http://api.infobip.com/api/v3/sendsms/plain?";
        $aParameters = array(
            'username'  => self::USERNAME,
            'password'  => urlencode(self::PASSWORD),
            'sender'    => urlencode($a_oNotice->getSender()),
            'GSM'       => $a_oNotice->getReceiver(),
            'SMSText'   => urlencode(utf8_decode($a_oNotice->getBody()))
        );
        $sRequestURL = $sServiceUrl;
        $aRequestFields = array();
        foreach ($aParameters as $sKey => $sValue) {
            $aRequestFields[] = "$sKey=$sValue";
        }
        $sResult = file_get_contents($sRequestURL . implode("&", $aRequestFields));
        var_dump($sResult);
    }
}

?>
