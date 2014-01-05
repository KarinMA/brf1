<?php

/**
 * Database accessor class for User. 
 *
 * @see Accessor 
 * @see User
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_User extends Accessor
{


    /**
     * Get Users by 'user_type' property. 
     *
     * @param int $a_iUserType
     * @return Collection
     */
    function getUsersByUserType($a_iUserType)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setUserType($a_iUserType);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getUsersByBrfId($a_iBrfId)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setBrfId($a_iBrfId);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'username' property. 
     *
     * @param string $a_sUsername
     * @return Collection
     */
    function getUsersByUsername($a_sUsername)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setUsername($a_sUsername);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'password' property. 
     *
     * @param string $a_sPassword
     * @return Collection
     */
    function getUsersByPassword($a_sPassword)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setPassword($a_sPassword);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'name' property. 
     *
     * @param string $a_sName
     * @return Collection
     */
    function getUsersByName($a_sName)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setName($a_sName);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'apartment_number' property. 
     *
     * @param string $a_sApartmentNumber
     * @return Collection
     */
    function getUsersByApartmentNumber($a_sApartmentNumber)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setApartmentNumber($a_sApartmentNumber);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'apartment_number2' property. 
     *
     * @param string $a_sApartmentNumber2
     * @return Collection
     */
    function getUsersByApartmentNumber2($a_sApartmentNumber2)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setApartmentNumber2($a_sApartmentNumber2);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'email' property. 
     *
     * @param string $a_sEmail
     * @return Collection
     */
    function getUsersByEmail($a_sEmail)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setEmail($a_sEmail);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'cellphone' property. 
     *
     * @param string $a_sCellphone
     * @return Collection
     */
    function getUsersByCellphone($a_sCellphone)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setCellphone($a_sCellphone);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'admin' property. 
     *
     * @param bool $a_bAdmin
     * @return Collection
     */
    function getUsersByAdmin($a_bAdmin)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setAdmin($a_bAdmin);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'external_partner_id' property. 
     *
     * @param int $a_iExternalPartnerId
     * @return Collection
     */
    function getUsersByExternalPartnerId($a_iExternalPartnerId)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setExternalPartnerId($a_iExternalPartnerId);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'has_picture' property. 
     *
     * @param bool $a_bHasPicture
     * @return Collection
     */
    function getUsersByHasPicture($a_bHasPicture)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setHasPicture($a_bHasPicture);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'image_type' property. 
     *
     * @param string $a_sImageType
     * @return Collection
     */
    function getUsersByImageType($a_sImageType)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setImageType($a_sImageType);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'presentation' property. 
     *
     * @param string $a_sPresentation
     * @return Collection
     */
    function getUsersByPresentation($a_sPresentation)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setPresentation($a_sPresentation);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'age' property. 
     *
     * @param int $a_iAge
     * @return Collection
     */
    function getUsersByAge($a_iAge)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setAge($a_iAge);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'lives_with' property. 
     *
     * @param string $a_sLivesWith
     * @return Collection
     */
    function getUsersByLivesWith($a_sLivesWith)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setLivesWith($a_sLivesWith);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'hide_phone' property. 
     *
     * @param bool $a_bHidePhone
     * @return Collection
     */
    function getUsersByHidePhone($a_bHidePhone)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setHidePhone($a_bHidePhone);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'user_title_id' property. 
     *
     * @param int $a_iUserTitleId
     * @return Collection
     */
    function getUsersByUserTitleId($a_iUserTitleId)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setUserTitleId($a_iUserTitleId);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get User by 'login_cookie' property. 
     *
     * @param string $a_sLoginCookie
     * @return Collection
     */
    function getUserByLoginCookie($a_sLoginCookie)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setLoginCookie($a_sLoginCookie);
        return $this->readOne($oUserSelector);

    }

    /**
     * Get Users by 'floor' property. 
     *
     * @param string $a_sFloor
     * @return Collection
     */
    function getUsersByFloor($a_sFloor)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setFloor($a_sFloor);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'address_id' property. 
     *
     * @param int $a_iAddressId
     * @return Collection
     */
    function getUsersByAddressId($a_iAddressId)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setAddressId($a_iAddressId);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'is_registered' property. 
     *
     * @param bool $a_bIsRegistered
     * @return Collection
     */
    function getUsersByIsRegistered($a_bIsRegistered)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setIsRegistered($a_bIsRegistered);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'is_primary_member' property. 
     *
     * @param bool $a_bIsPrimaryMember
     * @return Collection
     */
    function getUsersByIsPrimaryMember($a_bIsPrimaryMember)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setIsPrimaryMember($a_bIsPrimaryMember);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'primary_member_id' property. 
     *
     * @param int $a_iPrimaryMemberId
     * @return Collection
     */
    function getUsersByPrimaryMemberId($a_iPrimaryMemberId)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setPrimaryMemberId($a_iPrimaryMemberId);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Get Users by 'address_number' property. 
     *
     * @param string $a_sAddressNumber
     * @return Collection
     */
    function getUsersByAddressNumber($a_sAddressNumber)
    {
        $oUserSelector = getUserSelector();
        $oUserSelector->setAddressNumber($a_sAddressNumber);
        $oUserCollection = $this->read($oUserSelector);
        return $oUserCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'user', 'User', new SelectionFactory_User(), new DomainFactory_UserFactory(), new UpdateFactory_User(), array(
            array('brf', array('linked_object', 'brf_id', 'setBrf')), // gets product with product id
            array('user_title', array('linked_object', 'user_title_id', 'setUserTitle')), // gets product with product id
            array('external_partner', array('linked_object', 'external_partner_id', 'setExternalPartner')), // gets product with product id
            array('notice', array('dependent_objects', 'from_user_id', 'getFromUserId')), // gets orders customer id
        ));
    }




}
