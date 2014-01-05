<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author John Jansson
 */
class SvenskBRF_Session 
{
    /**
     *
     * @var array
     */
    private $_aBookings = array();
    
    const SESSION_KEY = 'bookings';
    
    private function __construct() {
        if (array_key_exists(self::SESSION_KEY, $_SESSION)) {
            $this->_aBookings = $_SESSION[self::SESSION_KEY];
        }
        if (!array_key_exists('register', $_SESSION)) {
            $_SESSION['register'] = array();
        }
    }
    
    /**
     *
     * @var SvenskBRF_Session
     */
    private static $_oInstance;
    
    /**
     *
     * @return SvenskBRF_Session
     */
    public static function getInstance()
    {
        if (!self::$_oInstance) {
            self::$_oInstance = new self();
        }
        return self::$_oInstance;
    }
    
    function saveBooking($a_sBookingString, $a_iResourceId, $a_iBookingTime, $a_bSmsReminder, $a_bMailReminder) 
    {
        if (!array_key_exists(self::SESSION_KEY, $_SESSION)) {
            $_SESSION['bookings'] = array();
        }

        $_SESSION[self::SESSION_KEY][] = array(
            'sms' => (int) $a_bSmsReminder,
            'mail' => (int) $a_bMailReminder,
            'text' => $a_sBookingString,
            'time' => $a_iBookingTime,
            'resource' => $a_iResourceId,
        );
        $this->_aBookings = $_SESSION[self::SESSION_KEY];
    }
    
    function editBookingSms($a_iBookingIndex, $a_bSmsReminder)
    {
        $_SESSION[self::SESSION_KEY][$a_iBookingIndex]['sms'] = (int) $a_bSmsReminder;
        $this->_aBookings = $_SESSION[self::SESSION_KEY];
    }
    
    function editBookingMail($a_iBookingIndex, $a_bMailReminder)
    {
        $_SESSION[self::SESSION_KEY][$a_iBookingIndex]['mail'] = (int) $a_bMailReminder;
        $this->_aBookings = $_SESSION[self::SESSION_KEY];
    }
    
    function removeBooking($a_iBookingIndex)
    {
        unset($_SESSION[self::SESSION_KEY][$a_iBookingIndex]);
        $this->_aBookings = $_SESSION[self::SESSION_KEY];
    }
    
    function getBookings()
    {
        return $this->_aBookings;
    }
    
    
    /**
     * 
     * @var string
     */
    const SESSION_KEY_REGISTER = 'register';
    
    function addRemovedFrontPictureId($a_iPictureId)
    {
        @$_SESSION[self::SESSION_KEY_REGISTER]['removedPictureIds'][] = $a_iPictureId;
        $_SESSION[self::SESSION_KEY_REGISTER]['removedPictureIds'] = array_unique(@$_SESSION['register']['removedPictureIds']);
    }
    
    function isRemovedFrontPicture($a_iPictureId) 
    {
        return @in_array($a_iPictureId, $_SESSION[self::SESSION_KEY_REGISTER]['removedPictureIds']);
    }
    
    /**
     *
     * @return array
     */
    function getRemovedFrontPictureIds()
    {
        if (isset($_SESSION[self::SESSION_KEY_REGISTER]['removedPictureIds']) && count($_SESSION[self::SESSION_KEY_REGISTER]['removedPictureIds'])) {
            return $_SESSION[self::SESSION_KEY_REGISTER]['removedPictureIds'];
        } else {
            return array();
        }
    }
    
    function removeSavedAddress($a_iIndex) 
    {
        unset($_SESSION[self::SESSION_KEY_REGISTER]['addresses'][$a_iIndex]);
    }
    
    function sortSavedAddresses()
    {
        $aAddresses = array();
        foreach ($this->getSavedAddresses() as $aAddress) {
            $aAddresses[] = $aAddress;
        }
        $_SESSION[self::SESSION_KEY_REGISTER]['addresses'] = $aAddresses;
    }
    
    /**
     * Format the address
     *
     * @param type $a_aAddressData
     * @return string 
     */
    function saveAddress($a_aAddressData, $a_iIndex = 0)
    {
        // addresses
        if (!@$_SESSION[self::SESSION_KEY_REGISTER]['addresses']) {
            $_SESSION[self::SESSION_KEY_REGISTER]['addresses'] = array();
        } 
        if ($a_iIndex == -1) {
            $_SESSION[self::SESSION_KEY_REGISTER]['addresses'][] = $a_aAddressData;
        } else {
            $_SESSION[self::SESSION_KEY_REGISTER]['addresses'][$a_iIndex] = $a_aAddressData;
        }
        $sReturnAddress = $a_aAddressData['Adress'];
        if ($a_aAddressData['Nummer1']) {
            $sReturnAddress .= ' ' . $a_aAddressData['Nummer1'];
        }
        if ($a_aAddressData['Nummer2']) {
            $sReturnAddress .= '-' . $a_aAddressData['Nummer2'];
        }
        $sReturnAddress .= ' ' . $a_aAddressData['Postnummer'];
        $sReturnAddress .= ' ' . $a_aAddressData['Postort'];
        return $sReturnAddress;
    }
    
    function getSavedAddresses()
    {
        if (isset($_SESSION[self::SESSION_KEY_REGISTER]['addresses']) && count($_SESSION[self::SESSION_KEY_REGISTER]['addresses'])) {
            return $_SESSION[self::SESSION_KEY_REGISTER]['addresses'];
        } else {
            return array();
        }
    }
    
    /**
     * Save the picture
     *
     * @param type $a_aPictureData
     */
    function savePicture($a_aPictureData)
    {
        // addresses
        if (!@$_SESSION[self::SESSION_KEY_REGISTER]['pictures']) {
            $_SESSION[self::SESSION_KEY_REGISTER]['pictures'] = array();
        } 
        $_SESSION[self::SESSION_KEY_REGISTER]['pictures'][] = $a_aPictureData;
    }
    
    /**
     *
     * @return array
     */
    function getSavedPictureData()
    {
        if (isset($_SESSION[self::SESSION_KEY_REGISTER]['pictures']) && count($_SESSION[self::SESSION_KEY_REGISTER]['pictures'])) {
            return $_SESSION[self::SESSION_KEY_REGISTER]['pictures'];
        } else {
            return array();
        }
    }
    
    /**
     *
     * @return void 
     */
    function removePictureData()
    {
        if (count(@$_SESSION[self::SESSION_KEY_REGISTER]['pictures'])) {
            unset($_SESSION[self::SESSION_KEY_REGISTER]['pictures'][count(@$_SESSION[self::SESSION_KEY_REGISTER]['pictures']) - 1]);
        }
    }
    
    function clearRegister($a_iStep) {
        switch ($a_iStep) {
            case 1:
                // addresses
                @$_SESSION[self::SESSION_KEY_REGISTER]['addresses'] = array();
                break;
            case 5:
                // pictures
                $iNumberOfPictures = @count(@$_SESSION[self::SESSION_KEY_REGISTER]['pictures']);
                for ($iIndex = 0; $iIndex < $iNumberOfPictures; $iIndex++) {
                    SvenskBRF_Session::getInstance()->removePictureData();
                }
                
                // front removed
                @$_SESSION[self::SESSION_KEY_REGISTER]['removedPictureIds'] = array();
            default:
                break;
        }
    }
    
    
    /**
     * Clears the register session.
     *
     * @return void 
     */
    function clearRegisterSession()
    {
        $_SESSION[self::SESSION_KEY_REGISTER] = array();
    }
}

?>
