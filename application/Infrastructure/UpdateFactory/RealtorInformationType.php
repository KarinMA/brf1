<?php

/**
 * Update factory class for RealtorInformationType. 
 *
 * @see RealtorInformationType
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_RealtorInformationType extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['realtor_information_category_id'] = $a_oDomainObject->getRealtorInformationCategoryId();
        $aUpdate['type_key'] = $a_oDomainObject->getTypeKey();
        $aUpdate['type_name'] = $a_oDomainObject->getTypeName();
        $aUpdate['type_name_public'] = $a_oDomainObject->getTypeNamePublic();
        $aUpdate['comment_public'] = $a_oDomainObject->getCommentPublic();
        $aUpdate['required'] = $a_oDomainObject->getRequired();
        $aUpdate['comment_required_yes'] = $a_oDomainObject->getCommentRequiredYes();
        $aUpdate['comment_required_no'] = $a_oDomainObject->getCommentRequiredNo();
        return $aUpdate;
    }
}
