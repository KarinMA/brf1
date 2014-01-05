<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DomainObjectAssembler
 *
 * @author John Jansson
 */
class DomainObjectAssembler 
{
    /**
     *
     * @var resource
     */
    private $_rDatabaseConnection;
    
    /**
     *
     * @var string
     */
    private $_sTableName;
    
    /**
     *
     * @var string
     */
    private $_sTargetClass;
    
    /**
     *
     * @var SelectionFactory
     */
    private $_oSelectionFactory;
    
    /**
     *
     * @var DomainObjectFactory
     */
    private $_oDomainObjectFactory;
    
    /**
     * The update factory for this assembler.
     *
     * @var UpdateFactory
     */
    private $_oUpdateFactory;
    
    /**
     *
     * @var boolean
     */
    private $_bTransactionStarted;
    
    /**
     *
     * @var array
     */
    private $_aDependentTableDefinitions = array();
    
    /**
     *
     * @var array
     */
    private $_aLinkedTableDefinitions = array();
    
    /**
     *
     * @var string
     */
    private $_sJoinFields;
     
    /**
     *
     * @var string
     */
    private $_sJoinTable = '';
    
    /**
     *
     * @var string
     */
    private $_sJoinCondition = '';
    
    /**
     *
     * @var int
     */
    private $_iJoinType = 0;
    
    /**
     * Construct the domain object assembler.
     *
     * @param resource $a_r_rDatabaseConnection
     * @param string $a_sTableName
     * @param SelectionFactory $a_oSelectionFactory
     * @param DomainFactory $a_oDomainObjectFactory 
     */
    public function __construct(&$a_r_rDatabaseConnection, $a_sTableName, $a_sTargetClass, SelectionFactory $a_oSelectionFactory, DomainFactory $a_oDomainObjectFactory, UpdateFactory $a_oUpdateFactory, array $a_aLinkedDefinitions = array(), $a_aJoin = array())
    {
        $this->_rDatabaseConnection = $a_r_rDatabaseConnection;
        $this->_sTableName = $a_sTableName;
        $this->_sTargetClass = $a_sTargetClass;
        $this->_oSelectionFactory = $a_oSelectionFactory;
        $this->_oDomainObjectFactory = $a_oDomainObjectFactory;
        $this->_oUpdateFactory = $a_oUpdateFactory;
        foreach ($a_aLinkedDefinitions as $aLinkedTableDefinition) {
            if ($aLinkedTableDefinition[1][0] === 'dependent_objects') {
                $this->_aDependentTableDefinitions[] = $aLinkedTableDefinition;
            } else if ($aLinkedTableDefinition[1][0] === 'linked_object') {
                $this->_aLinkedTableDefinitions[] = $aLinkedTableDefinition;
            }
        }
        
        if (count($a_aJoin) && count($a_aJoin) == 4) {
            $this->_iJoinType = $a_aJoin[0];
            $this->_sJoinTable = $a_aJoin[1];
            $this->_sJoinCondition = $a_aJoin[2];
            $this->_sJoinFields = $a_aJoin[3];
        }
    }
    
    
    /**
     *
     * @param Selector $a_oSelector 
     * @return Collection
     * @throws DomainObjectException
     */
    public function read(Selector $a_oSelector)
    {
        try {
            // make it a transaction
            // ---
                  
                        
                
            $rQueryResult = $this->_issueQuery($a_oSelector);
            
            $aRows = array();
            
            $aLinkings = array('id' => array());
            
            $oCollection = new Collection();
            
            
            $aDoMappings = array();
            
            // collect data here
            while (($aResultRow = mysql_fetch_assoc($rQueryResult))) {
                $aRows[] = $aResultRow;
                
                if (DomainWatcher::exists($this->_sTargetClass, $aResultRow['id'])) {
                    $oCollection->addObject(DomainWatcher::getDomainObject($this->_sTargetClass, $aResultRow['id']));
                    $aDoMappings[$aResultRow['id']] = FALSE;
                } else {
                    $oDomainObject = $this->_oDomainObjectFactory->createDomainObject($aResultRow);
                    $oCollection->addObject($oDomainObject);
                    $aDoMappings[$aResultRow['id']] = TRUE;
                    DomainWatcher::add($oDomainObject, AccessorRepository::getInstance()->getAccessor($this->_sTableName));
                }   
                
                if (count($this->_aDependentTableDefinitions)) {
                    $aLinkings['id'][] = $aResultRow['id'];
                }
                
                if (count($this->_aLinkedTableDefinitions)) {

                    foreach ($this->_aLinkedTableDefinitions as $aLinkedTableDefinition) {

                        if (!array_key_exists($aLinkedTableDefinition[1][1], $aLinkings)) {
                            $aLinkings[$aLinkedTableDefinition[1][1]] = array();
                        }

                        if (!array_key_exists($aResultRow[$aLinkedTableDefinition[1][1]], $aLinkings[$aLinkedTableDefinition[1][1]])) {
                            $aLinkings[$aLinkedTableDefinition[1][1]][$aResultRow[$aLinkedTableDefinition[1][1]]] = array();
                        }

                        $aLinkings[$aLinkedTableDefinition[1][1]][$aResultRow[$aLinkedTableDefinition[1][1]]][] = $aResultRow['id'];
                    }
                }

                
            }
            
            
            
            // set the other tables too, i.e. the order row(s)
            if ($oCollection->size() > 0) {
                foreach ($this->_aDependentTableDefinitions as $aLinkDefinition) {
                    $oLinkedTableAccessor = AccessorRepository::getInstance()->getAccessor($aLinkDefinition[0]);
                    $sClassName = str_replace('Accessor_', '', get_class($oLinkedTableAccessor));
                    $sSelectorClass = "Selector_{$sClassName}Selector";
                    $oSelector = new $sSelectorClass();
                    //$oSelector->setSearchParameter($this->_sTableName . '_id', $aLinkings['id'], Selector::CONDITION_IN);
                    $oSelector->setSearchParameter($aLinkDefinition[1][1], $aLinkings['id'], Selector::CONDITION_IN);
                    if (array_key_exists(4, $aLinkDefinition[1])) {
                        $oSelector->setOrderBy($aLinkDefinition[1][4]);
                    }
                    //$oSelector->set*
                    /*$oDependentObjectsCollection = DomainWatcher::getWithIdSelector($oSelector);
                    if (!isset($oDependentObjectsCollection)) {
                        $oDependentObjectsCollection = $oLinkedTableAccessor->read($oSelector);
                    }*/
                    $oDependentObjectsCollection = $oLinkedTableAccessor->read($oSelector);
                    while ($oDependentObjectsCollection->valid()) {
                        $oDependentObject = $oDependentObjectsCollection->current();

                        $oCollection->rewind(); // ugly fix
                        while ($oCollection->valid() && $oCollection->current()->getId() != call_user_func_array(array($oDependentObject, $aLinkDefinition[1][2]), array())) {
                            $oCollection->next();
                        }
                        
                        if ($oCollection->valid() && $aDoMappings[$oCollection->current()->getId()]) {
                            $oDependentObjectCollection = $oCollection->current()->{"get{$sClassName}Collection"}();
                            $oDependentObjectCollection->addObject($oDependentObject);
                        }

                        $oDependentObjectsCollection->next();
                    }
                    $oCollection->rewind();
                }
                
                 
                
                foreach ($this->_aLinkedTableDefinitions as $aLinkDefinition) {
                    // länka ihop t.ex. orderrader med en artikel. gemensam artikel för många orderrader
                    $oLinkedTableAccessor = AccessorRepository::getInstance()->getAccessor($aLinkDefinition[0]);
                    if ($aLinkDefinition[0]=='brf_mail') {
                        echo "";
                    }
                    $sClassName = str_replace('Accessor_', '', get_class($oLinkedTableAccessor));
                    $sSelectorClass = "Selector_{$sClassName}Selector";
                    $oSelector = new $sSelectorClass();
                    $oSelector->setSearchParameter('id', array_keys($aLinkings[$aLinkDefinition[1][1]]), Selector::CONDITION_IN);
                    $oLinkedObjectsCollection = DomainWatcher::getWithIdSelector($oSelector);
                    
                    if (!isset($oLinkedObjectsCollection)) {
                        $oLinkedObjectsCollection = $oLinkedTableAccessor->read($oSelector);
                    } elseif ($oLinkedObjectsCollection->size() < $oCollection->size()) {
                    }
                    while ($oLinkedObjectsCollection->valid()) {
                        $oLinkedObject = $oLinkedObjectsCollection->current();
                            
                        foreach ($aLinkings[$aLinkDefinition[1][1]][$oLinkedObject->getId()] as $iObjectId) {
                            if ($aDoMappings[$iObjectId]) {
                                $oObject = $oCollection->getById($iObjectId);
                                if ($oObject) {
                                    $oObject->{$aLinkDefinition[1][2]}($oLinkedObject);
                                } else {
                                    throw new DomainObjectException("Couldn't map linked object.");
                                }
                            }
                        }
                        

                        $oLinkedObjectsCollection->next();
                    }
                   
                }
                
            }
            
            $oCollection->rewind();
            return $oCollection;
            
            // commit transaction
            // ---
            
            
        } catch (SQLException $oSqlException) {
            // roll back transaction
            if ($this->_bTransactionStarted) {
                
            }
            
            throw new DomainObjectException("Read operation failed", -1, $oSqlException);
        } 
    }
    
    /**
     *
     * @param DomainObject $a_oDomainObject 
     */
    public function delete(DomainObject $a_oDomainObject)
    {
        $sDeleteQuery = "DELETE FROM `$this->_sTableName` WHERE `$this->_sTableName`.`id` = {$a_oDomainObject->getId()} LIMIT 1";
        if (!mysql_query($sDeleteQuery, $this->_rDatabaseConnection)) {
            throw new SQLException("Failed to delete domain object: " . mysql_error($this->_rDatabaseConnection), mysql_errno($this->_rDatabaseConnection));
        } else {
            if (1 != ($iObjectsDeleted = mysql_affected_rows($this->_rDatabaseConnection))) {
                throw new SQLException("Deleted more or less than one object?, object id was {$a_oDomainObject->getId()}. Deleted objects: $iObjectsDeleted", -10);
            }
        }
    }
    
    
    public function write(DomainObject $a_oDomainObject, Selector $a_oSelector = NULL)
    {
        return $a_oDomainObject->getId() ? $this->_issueUpdate($a_oDomainObject, $a_oSelector) : $this->_issueInsert($a_oDomainObject);
    }
    
    protected function _issueInsert(DomainObject $a_oDomainObject)
    {
        // generate the SQL for it.
        $sInsertSql = "INSERT INTO `$this->_sTableName` (`";
        
        
        $aUpdate = $this->_oUpdateFactory->newUpdate($a_oDomainObject);
        $sInsertSql .= implode("`,`", array_keys($aUpdate)) . "`) VALUES (";
        $aValues = array();
        foreach (array_values($aUpdate) as $mValue) {
            if (is_numeric($mValue)) {
                $aValues[] = $mValue;
            } else if (is_null($mValue)) {
                $aValues[] = "NULL";
            } else {
                $aValues[] = "'" . mysql_real_escape_string($mValue, $this->_rDatabaseConnection) . "'";
            }
        }
        $sInsertSql .= implode(",", $aValues) . ")";
        
        
        // set the id of the object
        
        // set the link definitions' id, we have those stored.
        
        
        // hur gör man då man lägger till en order-rad till en existerane order.
        // denna order rad måste sparas med rätt order id
        
        if ($this->_sTableName === 'tag' && $a_oDomainObject->getTag() == 'Kök') {
            echo "";
        }
        // that means that the whole thing should be set for insert by the DomainWatcher
        if (!mysql_query($sInsertSql, $this->_rDatabaseConnection)) {
            throw new SQLException("Insert failed for " . get_class($a_oDomainObject) . " object. " . mysql_error($this->_rDatabaseConnection), mysql_errno($this->_rDatabaseConnection));
        } else {
            $a_oDomainObject->setId(mysql_insert_id($this->_rDatabaseConnection));
            foreach ($this->_aDependentTableDefinitions as $aDependentTableDefinition) {
                $sCollectionMethod = "get" . str_replace("Accessor_", "", get_class(is_object($aDependentTableDefinition[0]) ? $aDependentTableDefinition[0] : AccessorRepository::getInstance()->getAccessor($aDependentTableDefinition[0]))) . "Collection";
                $oDependentCollection = $a_oDomainObject->{$sCollectionMethod}();
                $oDependentCollection->rewind();
                while ($oDependentCollection->valid()) {
                    $oDependentCollection->current()->{$aDependentTableDefinition[1][3]}($a_oDomainObject->getId());
                    $oDependentCollection->next();
                }
            }    
        }
        
        if (!DomainWatcher::getInstance()->exists(get_class($a_oDomainObject), $a_oDomainObject->getId())) {
            DomainWatcher::add($a_oDomainObject, AccessorRepository::getInstance()->getAccessor($this->_sTableName));
        }
    }
    
    
    
    /**
     *
     * @param Selector $a_oSelector 
     * @return resource
     */
    protected function _issueQuery($a_oSelector)
    {
        /*$aExtraJoins = $a_oSelector->getExtraJoins();
        if (count($aExtraJoins)) {
            $iWherePosition = strpos($this->_sSelectSql, "WHERE");
            $sOriginalSelect = $this->_sSelectSql;
            $this->_sSelectSql = substr($sOriginalSelect, 0, $iWherePosition);
            foreach ($aExtraJoins as $sExtraJoin) {
                $this->_sSelectSql .= " $sExtraJoin ";
            }
            $this->_sSelectSql .= substr($sOriginalSelect, $iWherePosition);
        }*/
        
        /*
        $sSelectSql = "SELECT `$this->_sTableName`.*";
        if ($this->_sJoinFields) {
            $sSelectSql .= ", " . $this->_sJoinFields;
        }
        $sSelectSql .= "FROM `$this->_sTableName`";
        if ($this->_sJoinTable) {
            $sSelectSql .= ", " . $this->_sJoinTable;
        }
        $sSelectSql .= " WHERE TRUE";
        if ($this->_sJoinCondition) {
            $sSelectSql .= " AND " . $this->_sJoinCondition;
        }
        var_dump($sSelectSql);
        */
        $sSelectSql = "SELECT `$this->_sTableName`.* FROM `$this->_sTableName` WHERE TRUE";
         
        // use the custom parameters
        $sSelection = $this->_oSelectionFactory->newSelection($a_oSelector);
        
        $sSelectSql .= $sSelection;
        //var_dump("selectql" , $sSelectSql);
        $rQueryResult = mysql_query($sSelectSql, $this->_rDatabaseConnection);
        if (!is_resource($rQueryResult) && is_bool($rQueryResult) && $rQueryResult === FALSE) {
            throw new SQLException("Query failed with error " . mysql_error($this->_rDatabaseConnection) , mysql_errno($this->_rDatabaseConnection));
        }
        
        return $rQueryResult;
    }
    
    /**
     * 
     *
     * @param DomainObject $a_oDomainObject
     * @param Selector $a_oSelector 
     * 
     */
    private function _issueUpdate(DomainObject $a_oDomainObject, Selector $a_oSelector = NULL)
    {
        $sSelection = "";
        if ($a_oSelector !== NULL) {
            $sSelection = $this->_oSelectionFactory->newSelection($a_oSelector);
        } else {
            $sSelection = "`$this->_sTableName`.`id` = '" . $a_oDomainObject->getId() . "' LIMIT 1";
        }
        $aUpdate = $this->_oUpdateFactory->newUpdate($a_oDomainObject);
        $sUpdateSQL = "UPDATE `$this->_sTableName` SET ";
        if (count($aUpdate)) {
            $aColumnAndValue = each($aUpdate);
            do {
                if (is_null($aColumnAndValue[1])) {
                    $sUpdateSQL .= "`$this->_sTableName`.`{$aColumnAndValue[0]}` = NULL";
                } else {
                    $sUpdateSQL .= "`$this->_sTableName`.`{$aColumnAndValue[0]}` = '".mysql_real_escape_string($aColumnAndValue[1], $this->_rDatabaseConnection)."'";
                }
                $aColumnAndValue = each($aUpdate);
                if ($aColumnAndValue) {
                    $sUpdateSQL .= ", ";
                }
            } while ($aColumnAndValue); 
        }
        
        $sUpdateSQL .= " WHERE $sSelection";
        if (!mysql_query($sUpdateSQL, $this->_rDatabaseConnection)) {
            throw new SQLException("Error on update: " . mysql_error($this->_rDatabaseConnection), mysql_errno($this->_rDatabaseConnection));
        } 
    }
    
    /**
     *
     * @param array $a_aData 
     * @return DomainObject
     */
    function createNew(array $a_aData = array())
    {
        $oDomainObject = $this->_oDomainObjectFactory->createDomainObject($a_aData);
        return $oDomainObject;
    }
}
