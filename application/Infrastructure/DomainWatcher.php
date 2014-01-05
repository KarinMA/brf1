<?php

class DomainWatcher 
{
    private $_aAllObjects = array();
    
    private $_aNewObjects = array();
    
    private $_aModifiedObjects = array();
    
    private $_aDeletedObjects = array();
    
    private $_aAccessors = array();
    
    const IDENTITY_SEPARATOR = "_";
    
    private static $_oInstance;
    
    private function __construct() 
    {
        // private constructor, singleton access
    }
    
    static function addDeletedObject(DomainObject $a_oDomainObject)
    {
        $oInstance = self::getInstance();
        if ($a_oDomainObject->getId()) {
            $oInstance->_aDeletedObjects[] = $oInstance->getGlobalKeyForDomainObject($a_oDomainObject);
        }
    }
    
    static function addNewObject(DomainObject $a_oDomainObject) 
    {
        $oInstance = self::getInstance();
        $oInstance->_aNewObjects[] = $a_oDomainObject;
    }
    
    static function addModifiedObject(DomainObject $a_oDomainObject) 
    {
        $oInstance = self::getInstance();
        if (!in_array($oInstance->getGlobalKeyForDomainObject($a_oDomainObject), $oInstance->_aModifiedObjects)) {
            $oInstance->_aModifiedObjects[] = $oInstance->getGlobalKeyForDomainObject($a_oDomainObject);
        }
    }
    
    /**
     *
     * @return DomainWatcher 
     */
    static function getInstance()
    {
        if (self::$_oInstance == null) {
            self::$_oInstance = new DomainWatcher();
        }
        return self::$_oInstance;
    }
    
    function getGlobalKeyForDomainObject(DomainObject $a_oDomainObject)
    {
        return $this->_getGlobalKeyForClassAndObject(get_class($a_oDomainObject), $a_oDomainObject->getId());
    }
    
    private function _getGlobalKeyForClassAndObject($a_sDomainObjectClass, $a_iDomainObjectId)
    {
        return $a_sDomainObjectClass . self::IDENTITY_SEPARATOR . $a_iDomainObjectId;
    }
    
    static function getDomainObject($a_sDomainObjectClass, $a_iDomainObjectId)
    {
        $oInstance = self::getInstance();
        return $oInstance->_aAllObjects[$oInstance->_getGlobalKeyForClassAndObject($a_sDomainObjectClass, $a_iDomainObjectId)];
    }
    
    static function add(DomainObject $a_oDomainObject, Accessor $a_oAccessor)
    {
        $oInstance = self::getInstance();
        $sGlobalKey = $oInstance->getGlobalKeyForDomainObject($a_oDomainObject);
        $oInstance->_aAllObjects[$sGlobalKey] = $a_oDomainObject;
        $oInstance->_aAccessors[$sGlobalKey] =& $a_oAccessor;
    }
    
    static function addCollection(Collection $a_oCollection, Accessor $a_oAccessor)
    {
        while ($a_oCollection->valid()) {
            self::add($a_oCollection->current(), $a_oAccessor);
            $a_oCollection->next();
        }
        $a_oCollection->rewind();
    }
    
    /**
     *
     * @param DomainObject $a_oDomainObject
     * @return DomainObject
     */
    static function domainObjectExists(DomainObject $a_oDomainObject) 
    {
        $oInstance = self::getInstance();
        $sGlobalKey = $oInstance->getGlobalKey($a_oDomainObject);
        if (isset($oInstance->_aAllObjects[$sGlobalKey])) {
            return $oInstance->_aAllObjects[$sGlobalKey];
        } else {
            return null;
        }
    }
    
    /**
     *
     * @param Selector $a_oSelector 
     * @return Collection
     */
    static function getWithIdSelector(Selector $a_oSelector) {
        // check that it's id selector only
        $oCollection = new Collection();
        $oInstance = self::getInstance();
        foreach ($a_oSelector->fetchSearchParameters() as $oSearchParameter) {
            $sParamName = $oSearchParameter->getParameterName();
            $sCompareValue = "id";
            if ($sParamName != $sCompareValue) {
                return NULL;
            } else if ($oSearchParameter->getCondition() == Selector::CONDITION_IN || $oSearchParameter->getCondition() == Selector::CONDITION_EQUALS) {
                $mSearchParameterValue = $oSearchParameter->getParameterValue();
                $aParameters = is_array($mSearchParameterValue) ? $mSearchParameterValue : array($mSearchParameterValue);
                $sClassName = str_replace(array('Selector', '_'), array('',''), get_class($a_oSelector));
                foreach ($aParameters as $iIdParameter) {
                    if (array_key_exists($sClassName . '_' . $iIdParameter, $oInstance->_aAllObjects)) {
                        $oCollection->addObject($oInstance->_aAllObjects[$sClassName . '_' . $iIdParameter]);
                    }
                }
            }
        }
        return $oCollection->size() ? $oCollection : NULL;
    }
    
    /**
     *
     * @param string $a_sDomainObjectClass
     * @param int $a_iDomainObjectId
     * @return DomainObject 
     */
    static function exists($a_sDomainObjectClass, $a_iDomainObjectId)
    {
        $oInstance = self::getInstance();
        return isset($oInstance->_aAllObjects[$oInstance->_getGlobalKeyForClassAndObject($a_sDomainObjectClass, $a_iDomainObjectId)]) ? 
                $oInstance->_aAllObjects[$oInstance->_getGlobalKeyForClassAndObject($a_sDomainObjectClass, $a_iDomainObjectId)] :
                NULL;
    }
    
    static function performOperations()
    {
        $oInstance = self::getInstance();
        
        // updates
        foreach ($oInstance->_aModifiedObjects as $sModifiedObjectIdentifier) {
            if (!array_key_exists($sModifiedObjectIdentifier, $oInstance->_aAllObjects)) {
                echo "";
            }
            
            $oInstance->_aAccessors[$sModifiedObjectIdentifier]->write($oInstance->_aAllObjects[$sModifiedObjectIdentifier]);
        }

        // inserts - but i need the accessor
        foreach ($oInstance->_aNewObjects as $oNewObject) {
            $oAccessor = call_user_func_array("get".get_class($oNewObject).'Accessor', array());
            $oAccessor->write($oNewObject);
        }
        
        // deletes
        foreach ($oInstance->_aDeletedObjects as $sDeletedObjectIdentifier) {
            $oInstance->_aAccessors[$sDeletedObjectIdentifier]->delete($oInstance->_aAllObjects[$sDeletedObjectIdentifier]);
        }
    }

}

/*
 * Alla objekt skapas,
 * om vi då sparar dem i en lista i accessorn
 * så vet vi precis vilka det rör sig om, vi vet även om de är uppdaterade? i och med domain watchern
 * 
 * så varje accessor vet om att den skall spara objekt.
 * Det kan man då göra i descruct-metoden för den.
 * 
 * vi har en domain map, där objekten ligger sparade, för hämtning
 * detta oavsett de tidigare hämtats. Alla använda objekt ligger där.
 * 
 * Om vi då går igenom detta dessa objekt,
 * kan vi då veta om de är modifierade,
 * vi vet vilka de modifierade är genom att ta fram deras unika identifierare.
 * 
 * Så, om man kallar på DomainWatcher::performOperations,
 * så kan den ta tag i dessa från repo't och sen uppdatera dem.
 * 
 * detta påkallas från destruktorn. så hur vet destruktorn vad den ska göra.
 * Jo, den bör ha en lista på objekt hos sig, t.ex.
 * 
 * 
 * DomainWatcher->performOperations->
 * 
 * 
 * När ett objekt skapas:
 * lägg till det i domain watcher med __class__id__ (allobjects(
 * 
 * när det modifieras, lägg det i modifiedobjects,där behövs bara nyckeln
 * 
 * DomainFactory-objektet lägger till det hela i DW.
 * Lägger till accessorn också så fort ett objekt akapas.
 * 
 * 
 * **************
 * eller snarare så att i och med att accessorn är sättet man får ut objekten på,
 * så kan man i read-funktionen lägga till att där så läggs det hela till till DW'n, tillsammans med accessorn i sig.
 * 
 * Sen så uppdaterar man ett objekt,
 * därefter så kör man performOperations,
 * då har DW'n objekten och man kan se till att den sparar bara de uppdaterade.
 * 
 * Men måste se till att mna inte skapar ett objekt i onödan, om det redan finns
 * det är en del av poängen också. detta gör man då i assemblern?
 * 
 * 
 * 
 * 
 */