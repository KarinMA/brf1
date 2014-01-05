<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Collection
 *
 * @author John Jansson
 */
class SvenskBRF_Document_Collection extends SvenskBRF_Collection {
    /**
     *
     * @return SvenskBRF_Document
     */
    public function current() {
        return SvenskBRF_Document::load($this->_oObjects->current());
    }
    
     /**
     *
     * @param Collection $a_oObjects 
     * @return SvenskBRF_Collection
     */
    public function __construct(Collection $a_oObjects = NULL) 
    {
        // sort
        if ($a_oObjects !== NULL) {
            $aDocuments = array();
            foreach ($a_oObjects as $oObject) {
                $aDocuments[$oObject->getFilename()] = $oObject;
            }
            ksort($aDocuments);
            $oSortedCollection = new Collection();
            foreach ($aDocuments as $oObject) {
                $oSortedCollection->addObject($oObject);
            }
            $a_oObjects = $oSortedCollection;
        }
        parent::__construct($a_oObjects);
    }
}

?>
