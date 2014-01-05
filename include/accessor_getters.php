<?php

/**
 * Get a brf accessor
 * 
 * @return Accessor_Brf
 */
function getBrfAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('brf')) {
        AccessorRepository::getInstance()->setAccessor('brf', new Accessor_Brf());
    }
    return AccessorRepository::getInstance()->getAccessor('brf');
}

/**
 * Get a brf_address accessor
 * 
 * @return Accessor_BrfAddress
 */
function getBrfAddressAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('brf_address')) {
        AccessorRepository::getInstance()->setAccessor('brf_address', new Accessor_BrfAddress());
    }
    return AccessorRepository::getInstance()->getAccessor('brf_address');
}

/**
 * Get a brf_felanmalan accessor
 * 
 * @return Accessor_BrfFelanmalan
 */
function getBrfFelanmalanAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('brf_felanmalan')) {
        AccessorRepository::getInstance()->setAccessor('brf_felanmalan', new Accessor_BrfFelanmalan());
    }
    return AccessorRepository::getInstance()->getAccessor('brf_felanmalan');
}

/**
 * Get a brf_mail accessor
 * 
 * @return Accessor_BrfMail
 */
function getBrfMailAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('brf_mail')) {
        AccessorRepository::getInstance()->setAccessor('brf_mail', new Accessor_BrfMail());
    }
    return AccessorRepository::getInstance()->getAccessor('brf_mail');
}

/**
 * Get a brf_picture accessor
 * 
 * @return Accessor_BrfPicture
 */
function getBrfPictureAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('brf_picture')) {
        AccessorRepository::getInstance()->setAccessor('brf_picture', new Accessor_BrfPicture());
    }
    return AccessorRepository::getInstance()->getAccessor('brf_picture');
}

/**
 * Get a brf_realtor_ad accessor
 * 
 * @return Accessor_BrfRealtorAd
 */
function getBrfRealtorAdAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('brf_realtor_ad')) {
        AccessorRepository::getInstance()->setAccessor('brf_realtor_ad', new Accessor_BrfRealtorAd());
    }
    return AccessorRepository::getInstance()->getAccessor('brf_realtor_ad');
}

/**
 * Get a brf_realtor_ad_time accessor
 * 
 * @return Accessor_BrfRealtorAdTime
 */
function getBrfRealtorAdTimeAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('brf_realtor_ad_time')) {
        AccessorRepository::getInstance()->setAccessor('brf_realtor_ad_time', new Accessor_BrfRealtorAdTime());
    }
    return AccessorRepository::getInstance()->getAccessor('brf_realtor_ad_time');
}

/**
 * Get a brf_realtor_code accessor
 * 
 * @return Accessor_BrfRealtorCode
 */
function getBrfRealtorCodeAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('brf_realtor_code')) {
        AccessorRepository::getInstance()->setAccessor('brf_realtor_code', new Accessor_BrfRealtorCode());
    }
    return AccessorRepository::getInstance()->getAccessor('brf_realtor_code');
}

/**
 * Get a brf_realtor_log accessor
 * 
 * @return Accessor_BrfRealtorLog
 */
function getBrfRealtorLogAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('brf_realtor_log')) {
        AccessorRepository::getInstance()->setAccessor('brf_realtor_log', new Accessor_BrfRealtorLog());
    }
    return AccessorRepository::getInstance()->getAccessor('brf_realtor_log');
}

/**
 * Get a brf_setting accessor
 * 
 * @return Accessor_BrfSetting
 */
function getBrfSettingAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('brf_setting')) {
        AccessorRepository::getInstance()->setAccessor('brf_setting', new Accessor_BrfSetting());
    }
    return AccessorRepository::getInstance()->getAccessor('brf_setting');
}

/**
 * Get a calendar accessor
 * 
 * @return Accessor_Calendar
 */
function getCalendarAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('calendar')) {
        AccessorRepository::getInstance()->setAccessor('calendar', new Accessor_Calendar());
    }
    return AccessorRepository::getInstance()->getAccessor('calendar');
}

/**
 * Get a document accessor
 * 
 * @return Accessor_Document
 */
function getDocumentAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('document')) {
        AccessorRepository::getInstance()->setAccessor('document', new Accessor_Document());
    }
    return AccessorRepository::getInstance()->getAccessor('document');
}

/**
 * Get a document_type accessor
 * 
 * @return Accessor_DocumentType
 */
function getDocumentTypeAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('document_type')) {
        AccessorRepository::getInstance()->setAccessor('document_type', new Accessor_DocumentType());
    }
    return AccessorRepository::getInstance()->getAccessor('document_type');
}

/**
 * Get a external_partner accessor
 * 
 * @return Accessor_ExternalPartner
 */
function getExternalPartnerAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('external_partner')) {
        AccessorRepository::getInstance()->setAccessor('external_partner', new Accessor_ExternalPartner());
    }
    return AccessorRepository::getInstance()->getAccessor('external_partner');
}

/**
 * Get a external_partner_type accessor
 * 
 * @return Accessor_ExternalPartnerType
 */
function getExternalPartnerTypeAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('external_partner_type')) {
        AccessorRepository::getInstance()->setAccessor('external_partner_type', new Accessor_ExternalPartnerType());
    }
    return AccessorRepository::getInstance()->getAccessor('external_partner_type');
}

/**
 * Get a mail_receiver accessor
 * 
 * @return Accessor_MailReceiver
 */
function getMailReceiverAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('mail_receiver')) {
        AccessorRepository::getInstance()->setAccessor('mail_receiver', new Accessor_MailReceiver());
    }
    return AccessorRepository::getInstance()->getAccessor('mail_receiver');
}

/**
 * Get a message accessor
 * 
 * @return Accessor_Message
 */
function getMessageAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('message')) {
        AccessorRepository::getInstance()->setAccessor('message', new Accessor_Message());
    }
    return AccessorRepository::getInstance()->getAccessor('message');
}

/**
 * Get a message_read accessor
 * 
 * @return Accessor_MessageRead
 */
function getMessageReadAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('message_read')) {
        AccessorRepository::getInstance()->setAccessor('message_read', new Accessor_MessageRead());
    }
    return AccessorRepository::getInstance()->getAccessor('message_read');
}

/**
 * Get a notice accessor
 * 
 * @return Accessor_Notice
 */
function getNoticeAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('notice')) {
        AccessorRepository::getInstance()->setAccessor('notice', new Accessor_Notice());
    }
    return AccessorRepository::getInstance()->getAccessor('notice');
}

/**
 * Get a notice_attachment accessor
 * 
 * @return Accessor_NoticeAttachment
 */
function getNoticeAttachmentAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('notice_attachment')) {
        AccessorRepository::getInstance()->setAccessor('notice_attachment', new Accessor_NoticeAttachment());
    }
    return AccessorRepository::getInstance()->getAccessor('notice_attachment');
}

/**
 * Get a notice_queue accessor
 * 
 * @return Accessor_NoticeQueue
 */
function getNoticeQueueAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('notice_queue')) {
        AccessorRepository::getInstance()->setAccessor('notice_queue', new Accessor_NoticeQueue());
    }
    return AccessorRepository::getInstance()->getAccessor('notice_queue');
}

/**
 * Get a notice_type accessor
 * 
 * @return Accessor_NoticeType
 */
function getNoticeTypeAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('notice_type')) {
        AccessorRepository::getInstance()->setAccessor('notice_type', new Accessor_NoticeType());
    }
    return AccessorRepository::getInstance()->getAccessor('notice_type');
}

/**
 * Get a password_reset accessor
 * 
 * @return Accessor_PasswordReset
 */
function getPasswordResetAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('password_reset')) {
        AccessorRepository::getInstance()->setAccessor('password_reset', new Accessor_PasswordReset());
    }
    return AccessorRepository::getInstance()->getAccessor('password_reset');
}

/**
 * Get a president_log accessor
 * 
 * @return Accessor_PresidentLog
 */
function getPresidentLogAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('president_log')) {
        AccessorRepository::getInstance()->setAccessor('president_log', new Accessor_PresidentLog());
    }
    return AccessorRepository::getInstance()->getAccessor('president_log');
}

/**
 * Get a president_log_category accessor
 * 
 * @return Accessor_PresidentLogCategory
 */
function getPresidentLogCategoryAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('president_log_category')) {
        AccessorRepository::getInstance()->setAccessor('president_log_category', new Accessor_PresidentLogCategory());
    }
    return AccessorRepository::getInstance()->getAccessor('president_log_category');
}

/**
 * Get a president_log_comment accessor
 * 
 * @return Accessor_PresidentLogComment
 */
function getPresidentLogCommentAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('president_log_comment')) {
        AccessorRepository::getInstance()->setAccessor('president_log_comment', new Accessor_PresidentLogComment());
    }
    return AccessorRepository::getInstance()->getAccessor('president_log_comment');
}

/**
 * Get a realtor_information accessor
 * 
 * @return Accessor_RealtorInformation
 */
function getRealtorInformationAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('realtor_information')) {
        AccessorRepository::getInstance()->setAccessor('realtor_information', new Accessor_RealtorInformation());
    }
    return AccessorRepository::getInstance()->getAccessor('realtor_information');
}

/**
 * Get a realtor_information_category accessor
 * 
 * @return Accessor_RealtorInformationCategory
 */
function getRealtorInformationCategoryAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('realtor_information_category')) {
        AccessorRepository::getInstance()->setAccessor('realtor_information_category', new Accessor_RealtorInformationCategory());
    }
    return AccessorRepository::getInstance()->getAccessor('realtor_information_category');
}

/**
 * Get a realtor_information_history accessor
 * 
 * @return Accessor_RealtorInformationHistory
 */
function getRealtorInformationHistoryAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('realtor_information_history')) {
        AccessorRepository::getInstance()->setAccessor('realtor_information_history', new Accessor_RealtorInformationHistory());
    }
    return AccessorRepository::getInstance()->getAccessor('realtor_information_history');
}

/**
 * Get a realtor_information_type accessor
 * 
 * @return Accessor_RealtorInformationType
 */
function getRealtorInformationTypeAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('realtor_information_type')) {
        AccessorRepository::getInstance()->setAccessor('realtor_information_type', new Accessor_RealtorInformationType());
    }
    return AccessorRepository::getInstance()->getAccessor('realtor_information_type');
}

/**
 * Get a resource accessor
 * 
 * @return Accessor_Resource
 */
function getResourceAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('resource')) {
        AccessorRepository::getInstance()->setAccessor('resource', new Accessor_Resource());
    }
    return AccessorRepository::getInstance()->getAccessor('resource');
}

/**
 * Get a resource_booking accessor
 * 
 * @return Accessor_ResourceBooking
 */
function getResourceBookingAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('resource_booking')) {
        AccessorRepository::getInstance()->setAccessor('resource_booking', new Accessor_ResourceBooking());
    }
    return AccessorRepository::getInstance()->getAccessor('resource_booking');
}

/**
 * Get a resource_day accessor
 * 
 * @return Accessor_ResourceDay
 */
function getResourceDayAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('resource_day')) {
        AccessorRepository::getInstance()->setAccessor('resource_day', new Accessor_ResourceDay());
    }
    return AccessorRepository::getInstance()->getAccessor('resource_day');
}

/**
 * Get a resource_type accessor
 * 
 * @return Accessor_ResourceType
 */
function getResourceTypeAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('resource_type')) {
        AccessorRepository::getInstance()->setAccessor('resource_type', new Accessor_ResourceType());
    }
    return AccessorRepository::getInstance()->getAccessor('resource_type');
}

/**
 * Get a setting_type accessor
 * 
 * @return Accessor_SettingType
 */
function getSettingTypeAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('setting_type')) {
        AccessorRepository::getInstance()->setAccessor('setting_type', new Accessor_SettingType());
    }
    return AccessorRepository::getInstance()->getAccessor('setting_type');
}

/**
 * Get a site_setting accessor
 * 
 * @return Accessor_SiteSetting
 */
function getSiteSettingAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('site_setting')) {
        AccessorRepository::getInstance()->setAccessor('site_setting', new Accessor_SiteSetting());
    }
    return AccessorRepository::getInstance()->getAccessor('site_setting');
}

/**
 * Get a startpage accessor
 * 
 * @return Accessor_Startpage
 */
function getStartpageAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('startpage')) {
        AccessorRepository::getInstance()->setAccessor('startpage', new Accessor_Startpage());
    }
    return AccessorRepository::getInstance()->getAccessor('startpage');
}

/**
 * Get a user accessor
 * 
 * @return Accessor_User
 */
function getUserAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('user')) {
        AccessorRepository::getInstance()->setAccessor('user', new Accessor_User());
    }
    return AccessorRepository::getInstance()->getAccessor('user');
}

/**
 * Get a user_setting accessor
 * 
 * @return Accessor_UserSetting
 */
function getUserSettingAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('user_setting')) {
        AccessorRepository::getInstance()->setAccessor('user_setting', new Accessor_UserSetting());
    }
    return AccessorRepository::getInstance()->getAccessor('user_setting');
}

/**
 * Get a user_title accessor
 * 
 * @return Accessor_UserTitle
 */
function getUserTitleAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('user_title')) {
        AccessorRepository::getInstance()->setAccessor('user_title', new Accessor_UserTitle());
    }
    return AccessorRepository::getInstance()->getAccessor('user_title');
}

/**
 * Get a webform_activation accessor
 * 
 * @return Accessor_WebformActivation
 */
function getWebformActivationAccessor()
{
    if (!AccessorRepository::getInstance()->hasAccessor('webform_activation')) {
        AccessorRepository::getInstance()->setAccessor('webform_activation', new Accessor_WebformActivation());
    }
    return AccessorRepository::getInstance()->getAccessor('webform_activation');
}

