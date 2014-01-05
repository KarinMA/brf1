<?php

/**
 * Use this class instead of the functions I've used.
 * 
 */

/**
 * Description of Message
 *
 * @author John Jansson
 */
class SvenskBRF_Message extends SvenskBRF_HasPicture
{
    public static function getMessagePicturePath(SvenskBRF_Brf $a_oBrf)
    {
        return "./../files/brfs/" . $a_oBrf->getUrl() . '/pictures/message/';
    }
    
    /**
     *
     * @var Message
     */
    private $_oMessage;
    
    /**
     * Callback to the domain object.
     *
     * @param type $a_sMethod
     * @param type $a_aArguments
     * @return type 
     */
    public function __call($a_sMethod, $a_aArguments = array()) 
    {
        return call_user_func_array(array($this->_oMessage, $a_sMethod), $a_aArguments);
    }
    
    /**
     *
     * @return string 
     */
    public function getHeader()
    {
        $sHeader = $this->_oMessage->getHeader();
        if (!$sHeader) {
            $sHeader = "Meddelande";
        }
        return $sHeader;
    }
    
    function getSender()
    {
        $oSender = $this->_oMessage->getSender();
        if (!$oSender) {
            $oSender = self::$_oUserAccessor->getById($this->_oMessage->getSenderId());
        }
        return $oSender;
    }
    
    /**
     *
     *
     * @param Message $a_oMessage
     * @return SvenskBRF_Message
     */
    public static function load(Message $a_oMessage)
    {
        return new self($a_oMessage);
    }
    
    private function __construct(Message $a_oMessage)
    {
        $this->_oMessage = $a_oMessage;
    }
    
    /**
     *
     * @return bool
     */
    public function hasPicture()
    {
        return $this->_oMessage->getHasPicture();
    }
    
    /**
     *
     * @return string 
     */
    public function getMessageLink()
    {
        //$sLink = str_replace(array('å', 'ä', 'ö', 'é', 'è', 'ü', ' '), array('a', 'a', 'o', 'e', 'e', 'u', '-'), strtolower($this->getSender()->getName()));
        $sLink = switchCharacters($this->getSender()->getName(), FALSE, TRUE);
        $sLink .= "-" . str_replace(array(' ', ':'), array('-', '-'), $this->_oMessage->getSendTime());
        return $sLink;
    }
    
    
    
    /**
     * Find a message for the message view.
     *
     * @param string  $a_sLink
     * @return Message
     */
    public static function getMessageByLink($a_sLink) {
        if (preg_match("/([0-9]{4}-[0-9]{2}-[0-9]{2})-([0-9]{2}-[0-9]{2}-[0-9]{2})/", $a_sLink, $aMatches) && count($aMatches) == 3) {
            $sSender = str_replace("-", ' ', str_replace($aMatches[0], '', $a_sLink));
            $sSendTime = $aMatches[1] . ' ' . str_replace('-', ':', $aMatches[2]);
            
            $aNeighbors = getUser()->findNeighborByName($sSender, TRUE);
            
            
            if (count($aNeighbors)) {
                
                self::$_oMessageSelector->setBrfId(getUser()->getBrfId());
                self::$_oMessageSelector->setSendTime($sSendTime);
                $aNeighborIds = array();
                foreach ($aNeighbors as $oNeighbor) {
                    $aNeighborIds[] = $oNeighbor->getId();
                }
                self::$_oMessageSelector->setSearchParameter('sender_id', $aNeighborIds, Selector::CONDITION_IN);
                $oMessageCollection = new SvenskBRF_Message_Collection(self::$_oMessageAccessor->read(self::$_oMessageSelector));
                if ($oMessageCollection->size() >= 1) {
                    return $oMessageCollection->current();
                }
            }
        }

        return NULL;
    }
    
  
    
    protected function _getPictureName()
    {
        return $this->getMessageLink();
    }
    
    protected function _getImagePath()
    {
        return '../files/brfs/' . getBrf()->getUrl() . '/pictures/message' . '/' . $this->getMessageLink();
    }
}

?>
