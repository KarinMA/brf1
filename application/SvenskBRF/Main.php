<?php

abstract class SvenskBRF_Main
{
    /**
     * The brf accessor
     * 
     * @var Accessor_Brf
     */
    protected static $_oBrfAccessor;

    /**
     * The brf selector
     * 
     * @var Selector_BrfSelector
     */
    protected static $_oBrfSelector;

    /**
     * The brf factory
     * 
     * @var DomainFactory_Brf
     */
    protected static $_oBrfFactory;

    /**
     * The brf_address accessor
     * 
     * @var Accessor_BrfAddress
     */
    protected static $_oBrfAddressAccessor;

    /**
     * The brf_address selector
     * 
     * @var Selector_BrfAddressSelector
     */
    protected static $_oBrfAddressSelector;

    /**
     * The brf_address factory
     * 
     * @var DomainFactory_BrfAddress
     */
    protected static $_oBrfAddressFactory;

    /**
     * The brf_felanmalan accessor
     * 
     * @var Accessor_BrfFelanmalan
     */
    protected static $_oBrfFelanmalanAccessor;

    /**
     * The brf_felanmalan selector
     * 
     * @var Selector_BrfFelanmalanSelector
     */
    protected static $_oBrfFelanmalanSelector;

    /**
     * The brf_felanmalan factory
     * 
     * @var DomainFactory_BrfFelanmalan
     */
    protected static $_oBrfFelanmalanFactory;

    /**
     * The brf_mail accessor
     * 
     * @var Accessor_BrfMail
     */
    protected static $_oBrfMailAccessor;

    /**
     * The brf_mail selector
     * 
     * @var Selector_BrfMailSelector
     */
    protected static $_oBrfMailSelector;

    /**
     * The brf_mail factory
     * 
     * @var DomainFactory_BrfMail
     */
    protected static $_oBrfMailFactory;

    /**
     * The brf_picture accessor
     * 
     * @var Accessor_BrfPicture
     */
    protected static $_oBrfPictureAccessor;

    /**
     * The brf_picture selector
     * 
     * @var Selector_BrfPictureSelector
     */
    protected static $_oBrfPictureSelector;

    /**
     * The brf_picture factory
     * 
     * @var DomainFactory_BrfPicture
     */
    protected static $_oBrfPictureFactory;

    /**
     * The brf_realtor_ad accessor
     * 
     * @var Accessor_BrfRealtorAd
     */
    protected static $_oBrfRealtorAdAccessor;

    /**
     * The brf_realtor_ad selector
     * 
     * @var Selector_BrfRealtorAdSelector
     */
    protected static $_oBrfRealtorAdSelector;

    /**
     * The brf_realtor_ad factory
     * 
     * @var DomainFactory_BrfRealtorAd
     */
    protected static $_oBrfRealtorAdFactory;

    /**
     * The brf_realtor_ad_time accessor
     * 
     * @var Accessor_BrfRealtorAdTime
     */
    protected static $_oBrfRealtorAdTimeAccessor;

    /**
     * The brf_realtor_ad_time selector
     * 
     * @var Selector_BrfRealtorAdTimeSelector
     */
    protected static $_oBrfRealtorAdTimeSelector;

    /**
     * The brf_realtor_ad_time factory
     * 
     * @var DomainFactory_BrfRealtorAdTime
     */
    protected static $_oBrfRealtorAdTimeFactory;

    /**
     * The brf_realtor_code accessor
     * 
     * @var Accessor_BrfRealtorCode
     */
    protected static $_oBrfRealtorCodeAccessor;

    /**
     * The brf_realtor_code selector
     * 
     * @var Selector_BrfRealtorCodeSelector
     */
    protected static $_oBrfRealtorCodeSelector;

    /**
     * The brf_realtor_code factory
     * 
     * @var DomainFactory_BrfRealtorCode
     */
    protected static $_oBrfRealtorCodeFactory;

    /**
     * The brf_realtor_log accessor
     * 
     * @var Accessor_BrfRealtorLog
     */
    protected static $_oBrfRealtorLogAccessor;

    /**
     * The brf_realtor_log selector
     * 
     * @var Selector_BrfRealtorLogSelector
     */
    protected static $_oBrfRealtorLogSelector;

    /**
     * The brf_realtor_log factory
     * 
     * @var DomainFactory_BrfRealtorLog
     */
    protected static $_oBrfRealtorLogFactory;

    /**
     * The brf_setting accessor
     * 
     * @var Accessor_BrfSetting
     */
    protected static $_oBrfSettingAccessor;

    /**
     * The brf_setting selector
     * 
     * @var Selector_BrfSettingSelector
     */
    protected static $_oBrfSettingSelector;

    /**
     * The brf_setting factory
     * 
     * @var DomainFactory_BrfSetting
     */
    protected static $_oBrfSettingFactory;

    /**
     * The calendar accessor
     * 
     * @var Accessor_Calendar
     */
    protected static $_oCalendarAccessor;

    /**
     * The calendar selector
     * 
     * @var Selector_CalendarSelector
     */
    protected static $_oCalendarSelector;

    /**
     * The calendar factory
     * 
     * @var DomainFactory_Calendar
     */
    protected static $_oCalendarFactory;

    /**
     * The document accessor
     * 
     * @var Accessor_Document
     */
    protected static $_oDocumentAccessor;

    /**
     * The document selector
     * 
     * @var Selector_DocumentSelector
     */
    protected static $_oDocumentSelector;

    /**
     * The document factory
     * 
     * @var DomainFactory_Document
     */
    protected static $_oDocumentFactory;

    /**
     * The document_type accessor
     * 
     * @var Accessor_DocumentType
     */
    protected static $_oDocumentTypeAccessor;

    /**
     * The document_type selector
     * 
     * @var Selector_DocumentTypeSelector
     */
    protected static $_oDocumentTypeSelector;

    /**
     * The document_type factory
     * 
     * @var DomainFactory_DocumentType
     */
    protected static $_oDocumentTypeFactory;

    /**
     * The external_partner accessor
     * 
     * @var Accessor_ExternalPartner
     */
    protected static $_oExternalPartnerAccessor;

    /**
     * The external_partner selector
     * 
     * @var Selector_ExternalPartnerSelector
     */
    protected static $_oExternalPartnerSelector;

    /**
     * The external_partner factory
     * 
     * @var DomainFactory_ExternalPartner
     */
    protected static $_oExternalPartnerFactory;

    /**
     * The external_partner_type accessor
     * 
     * @var Accessor_ExternalPartnerType
     */
    protected static $_oExternalPartnerTypeAccessor;

    /**
     * The external_partner_type selector
     * 
     * @var Selector_ExternalPartnerTypeSelector
     */
    protected static $_oExternalPartnerTypeSelector;

    /**
     * The external_partner_type factory
     * 
     * @var DomainFactory_ExternalPartnerType
     */
    protected static $_oExternalPartnerTypeFactory;

    /**
     * The mail_receiver accessor
     * 
     * @var Accessor_MailReceiver
     */
    protected static $_oMailReceiverAccessor;

    /**
     * The mail_receiver selector
     * 
     * @var Selector_MailReceiverSelector
     */
    protected static $_oMailReceiverSelector;

    /**
     * The mail_receiver factory
     * 
     * @var DomainFactory_MailReceiver
     */
    protected static $_oMailReceiverFactory;

    /**
     * The message accessor
     * 
     * @var Accessor_Message
     */
    protected static $_oMessageAccessor;

    /**
     * The message selector
     * 
     * @var Selector_MessageSelector
     */
    protected static $_oMessageSelector;

    /**
     * The message factory
     * 
     * @var DomainFactory_Message
     */
    protected static $_oMessageFactory;

    /**
     * The message_read accessor
     * 
     * @var Accessor_MessageRead
     */
    protected static $_oMessageReadAccessor;

    /**
     * The message_read selector
     * 
     * @var Selector_MessageReadSelector
     */
    protected static $_oMessageReadSelector;

    /**
     * The message_read factory
     * 
     * @var DomainFactory_MessageRead
     */
    protected static $_oMessageReadFactory;

    /**
     * The notice accessor
     * 
     * @var Accessor_Notice
     */
    protected static $_oNoticeAccessor;

    /**
     * The notice selector
     * 
     * @var Selector_NoticeSelector
     */
    protected static $_oNoticeSelector;

    /**
     * The notice factory
     * 
     * @var DomainFactory_Notice
     */
    protected static $_oNoticeFactory;

    /**
     * The notice_attachment accessor
     * 
     * @var Accessor_NoticeAttachment
     */
    protected static $_oNoticeAttachmentAccessor;

    /**
     * The notice_attachment selector
     * 
     * @var Selector_NoticeAttachmentSelector
     */
    protected static $_oNoticeAttachmentSelector;

    /**
     * The notice_attachment factory
     * 
     * @var DomainFactory_NoticeAttachment
     */
    protected static $_oNoticeAttachmentFactory;

    /**
     * The notice_queue accessor
     * 
     * @var Accessor_NoticeQueue
     */
    protected static $_oNoticeQueueAccessor;

    /**
     * The notice_queue selector
     * 
     * @var Selector_NoticeQueueSelector
     */
    protected static $_oNoticeQueueSelector;

    /**
     * The notice_queue factory
     * 
     * @var DomainFactory_NoticeQueue
     */
    protected static $_oNoticeQueueFactory;

    /**
     * The notice_type accessor
     * 
     * @var Accessor_NoticeType
     */
    protected static $_oNoticeTypeAccessor;

    /**
     * The notice_type selector
     * 
     * @var Selector_NoticeTypeSelector
     */
    protected static $_oNoticeTypeSelector;

    /**
     * The notice_type factory
     * 
     * @var DomainFactory_NoticeType
     */
    protected static $_oNoticeTypeFactory;

    /**
     * The password_reset accessor
     * 
     * @var Accessor_PasswordReset
     */
    protected static $_oPasswordResetAccessor;

    /**
     * The password_reset selector
     * 
     * @var Selector_PasswordResetSelector
     */
    protected static $_oPasswordResetSelector;

    /**
     * The password_reset factory
     * 
     * @var DomainFactory_PasswordReset
     */
    protected static $_oPasswordResetFactory;

    /**
     * The president_log accessor
     * 
     * @var Accessor_PresidentLog
     */
    protected static $_oPresidentLogAccessor;

    /**
     * The president_log selector
     * 
     * @var Selector_PresidentLogSelector
     */
    protected static $_oPresidentLogSelector;

    /**
     * The president_log factory
     * 
     * @var DomainFactory_PresidentLog
     */
    protected static $_oPresidentLogFactory;

    /**
     * The president_log_category accessor
     * 
     * @var Accessor_PresidentLogCategory
     */
    protected static $_oPresidentLogCategoryAccessor;

    /**
     * The president_log_category selector
     * 
     * @var Selector_PresidentLogCategorySelector
     */
    protected static $_oPresidentLogCategorySelector;

    /**
     * The president_log_category factory
     * 
     * @var DomainFactory_PresidentLogCategory
     */
    protected static $_oPresidentLogCategoryFactory;

    /**
     * The president_log_comment accessor
     * 
     * @var Accessor_PresidentLogComment
     */
    protected static $_oPresidentLogCommentAccessor;

    /**
     * The president_log_comment selector
     * 
     * @var Selector_PresidentLogCommentSelector
     */
    protected static $_oPresidentLogCommentSelector;

    /**
     * The president_log_comment factory
     * 
     * @var DomainFactory_PresidentLogComment
     */
    protected static $_oPresidentLogCommentFactory;

    /**
     * The realtor_information accessor
     * 
     * @var Accessor_RealtorInformation
     */
    protected static $_oRealtorInformationAccessor;

    /**
     * The realtor_information selector
     * 
     * @var Selector_RealtorInformationSelector
     */
    protected static $_oRealtorInformationSelector;

    /**
     * The realtor_information factory
     * 
     * @var DomainFactory_RealtorInformation
     */
    protected static $_oRealtorInformationFactory;

    /**
     * The realtor_information_category accessor
     * 
     * @var Accessor_RealtorInformationCategory
     */
    protected static $_oRealtorInformationCategoryAccessor;

    /**
     * The realtor_information_category selector
     * 
     * @var Selector_RealtorInformationCategorySelector
     */
    protected static $_oRealtorInformationCategorySelector;

    /**
     * The realtor_information_category factory
     * 
     * @var DomainFactory_RealtorInformationCategory
     */
    protected static $_oRealtorInformationCategoryFactory;

    /**
     * The realtor_information_history accessor
     * 
     * @var Accessor_RealtorInformationHistory
     */
    protected static $_oRealtorInformationHistoryAccessor;

    /**
     * The realtor_information_history selector
     * 
     * @var Selector_RealtorInformationHistorySelector
     */
    protected static $_oRealtorInformationHistorySelector;

    /**
     * The realtor_information_history factory
     * 
     * @var DomainFactory_RealtorInformationHistory
     */
    protected static $_oRealtorInformationHistoryFactory;

    /**
     * The realtor_information_type accessor
     * 
     * @var Accessor_RealtorInformationType
     */
    protected static $_oRealtorInformationTypeAccessor;

    /**
     * The realtor_information_type selector
     * 
     * @var Selector_RealtorInformationTypeSelector
     */
    protected static $_oRealtorInformationTypeSelector;

    /**
     * The realtor_information_type factory
     * 
     * @var DomainFactory_RealtorInformationType
     */
    protected static $_oRealtorInformationTypeFactory;

    /**
     * The resource accessor
     * 
     * @var Accessor_Resource
     */
    protected static $_oResourceAccessor;

    /**
     * The resource selector
     * 
     * @var Selector_ResourceSelector
     */
    protected static $_oResourceSelector;

    /**
     * The resource factory
     * 
     * @var DomainFactory_Resource
     */
    protected static $_oResourceFactory;

    /**
     * The resource_booking accessor
     * 
     * @var Accessor_ResourceBooking
     */
    protected static $_oResourceBookingAccessor;

    /**
     * The resource_booking selector
     * 
     * @var Selector_ResourceBookingSelector
     */
    protected static $_oResourceBookingSelector;

    /**
     * The resource_booking factory
     * 
     * @var DomainFactory_ResourceBooking
     */
    protected static $_oResourceBookingFactory;

    /**
     * The resource_day accessor
     * 
     * @var Accessor_ResourceDay
     */
    protected static $_oResourceDayAccessor;

    /**
     * The resource_day selector
     * 
     * @var Selector_ResourceDaySelector
     */
    protected static $_oResourceDaySelector;

    /**
     * The resource_day factory
     * 
     * @var DomainFactory_ResourceDay
     */
    protected static $_oResourceDayFactory;

    /**
     * The resource_type accessor
     * 
     * @var Accessor_ResourceType
     */
    protected static $_oResourceTypeAccessor;

    /**
     * The resource_type selector
     * 
     * @var Selector_ResourceTypeSelector
     */
    protected static $_oResourceTypeSelector;

    /**
     * The resource_type factory
     * 
     * @var DomainFactory_ResourceType
     */
    protected static $_oResourceTypeFactory;

    /**
     * The setting_type accessor
     * 
     * @var Accessor_SettingType
     */
    protected static $_oSettingTypeAccessor;

    /**
     * The setting_type selector
     * 
     * @var Selector_SettingTypeSelector
     */
    protected static $_oSettingTypeSelector;

    /**
     * The setting_type factory
     * 
     * @var DomainFactory_SettingType
     */
    protected static $_oSettingTypeFactory;

    /**
     * The site_setting accessor
     * 
     * @var Accessor_SiteSetting
     */
    protected static $_oSiteSettingAccessor;

    /**
     * The site_setting selector
     * 
     * @var Selector_SiteSettingSelector
     */
    protected static $_oSiteSettingSelector;

    /**
     * The site_setting factory
     * 
     * @var DomainFactory_SiteSetting
     */
    protected static $_oSiteSettingFactory;

    /**
     * The startpage accessor
     * 
     * @var Accessor_Startpage
     */
    protected static $_oStartpageAccessor;

    /**
     * The startpage selector
     * 
     * @var Selector_StartpageSelector
     */
    protected static $_oStartpageSelector;

    /**
     * The startpage factory
     * 
     * @var DomainFactory_Startpage
     */
    protected static $_oStartpageFactory;

    /**
     * The user accessor
     * 
     * @var Accessor_User
     */
    protected static $_oUserAccessor;

    /**
     * The user selector
     * 
     * @var Selector_UserSelector
     */
    protected static $_oUserSelector;

    /**
     * The user factory
     * 
     * @var DomainFactory_User
     */
    protected static $_oUserFactory;

    /**
     * The user_setting accessor
     * 
     * @var Accessor_UserSetting
     */
    protected static $_oUserSettingAccessor;

    /**
     * The user_setting selector
     * 
     * @var Selector_UserSettingSelector
     */
    protected static $_oUserSettingSelector;

    /**
     * The user_setting factory
     * 
     * @var DomainFactory_UserSetting
     */
    protected static $_oUserSettingFactory;

    /**
     * The user_title accessor
     * 
     * @var Accessor_UserTitle
     */
    protected static $_oUserTitleAccessor;

    /**
     * The user_title selector
     * 
     * @var Selector_UserTitleSelector
     */
    protected static $_oUserTitleSelector;

    /**
     * The user_title factory
     * 
     * @var DomainFactory_UserTitle
     */
    protected static $_oUserTitleFactory;

    /**
     * The webform_activation accessor
     * 
     * @var Accessor_WebformActivation
     */
    protected static $_oWebformActivationAccessor;

    /**
     * The webform_activation selector
     * 
     * @var Selector_WebformActivationSelector
     */
    protected static $_oWebformActivationSelector;

    /**
     * The webform_activation factory
     * 
     * @var DomainFactory_WebformActivation
     */
    protected static $_oWebformActivationFactory;

    static function init()
    {
        //AccessorRepository::getInstance()->setAccessor('brf', new Accessor_Brf());
        self::$_oBrfAccessor = AccessorRepository::getInstance()->getAccessor('brf');
        SelectorRepository::getInstance()->setSelector('brf', new Selector_BrfSelector('brf'));
        self::$_oBrfSelector = SelectorRepository::getInstance()->getSelector('brf');
        ObjectFactoryRepository::getInstance()->setObjectFactory('brf', new DomainFactory_BrfFactory());
        self::$_oBrfFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('brf');
        //AccessorRepository::getInstance()->setAccessor('brf_address', new Accessor_BrfAddress());
        self::$_oBrfAddressAccessor = AccessorRepository::getInstance()->getAccessor('brf_address');
        SelectorRepository::getInstance()->setSelector('brf_address', new Selector_BrfAddressSelector('brf_address'));
        self::$_oBrfAddressSelector = SelectorRepository::getInstance()->getSelector('brf_address');
        ObjectFactoryRepository::getInstance()->setObjectFactory('brf_address', new DomainFactory_BrfAddressFactory());
        self::$_oBrfAddressFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_address');
        //AccessorRepository::getInstance()->setAccessor('brf_felanmalan', new Accessor_BrfFelanmalan());
        self::$_oBrfFelanmalanAccessor = AccessorRepository::getInstance()->getAccessor('brf_felanmalan');
        SelectorRepository::getInstance()->setSelector('brf_felanmalan', new Selector_BrfFelanmalanSelector('brf_felanmalan'));
        self::$_oBrfFelanmalanSelector = SelectorRepository::getInstance()->getSelector('brf_felanmalan');
        ObjectFactoryRepository::getInstance()->setObjectFactory('brf_felanmalan', new DomainFactory_BrfFelanmalanFactory());
        self::$_oBrfFelanmalanFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_felanmalan');
        //AccessorRepository::getInstance()->setAccessor('brf_mail', new Accessor_BrfMail());
        self::$_oBrfMailAccessor = AccessorRepository::getInstance()->getAccessor('brf_mail');
        SelectorRepository::getInstance()->setSelector('brf_mail', new Selector_BrfMailSelector('brf_mail'));
        self::$_oBrfMailSelector = SelectorRepository::getInstance()->getSelector('brf_mail');
        ObjectFactoryRepository::getInstance()->setObjectFactory('brf_mail', new DomainFactory_BrfMailFactory());
        self::$_oBrfMailFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_mail');
        //AccessorRepository::getInstance()->setAccessor('brf_picture', new Accessor_BrfPicture());
        self::$_oBrfPictureAccessor = AccessorRepository::getInstance()->getAccessor('brf_picture');
        SelectorRepository::getInstance()->setSelector('brf_picture', new Selector_BrfPictureSelector('brf_picture'));
        self::$_oBrfPictureSelector = SelectorRepository::getInstance()->getSelector('brf_picture');
        ObjectFactoryRepository::getInstance()->setObjectFactory('brf_picture', new DomainFactory_BrfPictureFactory());
        self::$_oBrfPictureFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_picture');
        //AccessorRepository::getInstance()->setAccessor('brf_realtor_ad', new Accessor_BrfRealtorAd());
        self::$_oBrfRealtorAdAccessor = AccessorRepository::getInstance()->getAccessor('brf_realtor_ad');
        SelectorRepository::getInstance()->setSelector('brf_realtor_ad', new Selector_BrfRealtorAdSelector('brf_realtor_ad'));
        self::$_oBrfRealtorAdSelector = SelectorRepository::getInstance()->getSelector('brf_realtor_ad');
        ObjectFactoryRepository::getInstance()->setObjectFactory('brf_realtor_ad', new DomainFactory_BrfRealtorAdFactory());
        self::$_oBrfRealtorAdFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_realtor_ad');
        //AccessorRepository::getInstance()->setAccessor('brf_realtor_ad_time', new Accessor_BrfRealtorAdTime());
        self::$_oBrfRealtorAdTimeAccessor = AccessorRepository::getInstance()->getAccessor('brf_realtor_ad_time');
        SelectorRepository::getInstance()->setSelector('brf_realtor_ad_time', new Selector_BrfRealtorAdTimeSelector('brf_realtor_ad_time'));
        self::$_oBrfRealtorAdTimeSelector = SelectorRepository::getInstance()->getSelector('brf_realtor_ad_time');
        ObjectFactoryRepository::getInstance()->setObjectFactory('brf_realtor_ad_time', new DomainFactory_BrfRealtorAdTimeFactory());
        self::$_oBrfRealtorAdTimeFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_realtor_ad_time');
        //AccessorRepository::getInstance()->setAccessor('brf_realtor_code', new Accessor_BrfRealtorCode());
        self::$_oBrfRealtorCodeAccessor = AccessorRepository::getInstance()->getAccessor('brf_realtor_code');
        SelectorRepository::getInstance()->setSelector('brf_realtor_code', new Selector_BrfRealtorCodeSelector('brf_realtor_code'));
        self::$_oBrfRealtorCodeSelector = SelectorRepository::getInstance()->getSelector('brf_realtor_code');
        ObjectFactoryRepository::getInstance()->setObjectFactory('brf_realtor_code', new DomainFactory_BrfRealtorCodeFactory());
        self::$_oBrfRealtorCodeFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_realtor_code');
        //AccessorRepository::getInstance()->setAccessor('brf_realtor_log', new Accessor_BrfRealtorLog());
        self::$_oBrfRealtorLogAccessor = AccessorRepository::getInstance()->getAccessor('brf_realtor_log');
        SelectorRepository::getInstance()->setSelector('brf_realtor_log', new Selector_BrfRealtorLogSelector('brf_realtor_log'));
        self::$_oBrfRealtorLogSelector = SelectorRepository::getInstance()->getSelector('brf_realtor_log');
        ObjectFactoryRepository::getInstance()->setObjectFactory('brf_realtor_log', new DomainFactory_BrfRealtorLogFactory());
        self::$_oBrfRealtorLogFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_realtor_log');
        //AccessorRepository::getInstance()->setAccessor('brf_setting', new Accessor_BrfSetting());
        self::$_oBrfSettingAccessor = AccessorRepository::getInstance()->getAccessor('brf_setting');
        SelectorRepository::getInstance()->setSelector('brf_setting', new Selector_BrfSettingSelector('brf_setting'));
        self::$_oBrfSettingSelector = SelectorRepository::getInstance()->getSelector('brf_setting');
        ObjectFactoryRepository::getInstance()->setObjectFactory('brf_setting', new DomainFactory_BrfSettingFactory());
        self::$_oBrfSettingFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_setting');
        //AccessorRepository::getInstance()->setAccessor('calendar', new Accessor_Calendar());
        self::$_oCalendarAccessor = AccessorRepository::getInstance()->getAccessor('calendar');
        SelectorRepository::getInstance()->setSelector('calendar', new Selector_CalendarSelector('calendar'));
        self::$_oCalendarSelector = SelectorRepository::getInstance()->getSelector('calendar');
        ObjectFactoryRepository::getInstance()->setObjectFactory('calendar', new DomainFactory_CalendarFactory());
        self::$_oCalendarFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('calendar');
        //AccessorRepository::getInstance()->setAccessor('document', new Accessor_Document());
        self::$_oDocumentAccessor = AccessorRepository::getInstance()->getAccessor('document');
        SelectorRepository::getInstance()->setSelector('document', new Selector_DocumentSelector('document'));
        self::$_oDocumentSelector = SelectorRepository::getInstance()->getSelector('document');
        ObjectFactoryRepository::getInstance()->setObjectFactory('document', new DomainFactory_DocumentFactory());
        self::$_oDocumentFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('document');
        //AccessorRepository::getInstance()->setAccessor('document_type', new Accessor_DocumentType());
        self::$_oDocumentTypeAccessor = AccessorRepository::getInstance()->getAccessor('document_type');
        SelectorRepository::getInstance()->setSelector('document_type', new Selector_DocumentTypeSelector('document_type'));
        self::$_oDocumentTypeSelector = SelectorRepository::getInstance()->getSelector('document_type');
        ObjectFactoryRepository::getInstance()->setObjectFactory('document_type', new DomainFactory_DocumentTypeFactory());
        self::$_oDocumentTypeFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('document_type');
        //AccessorRepository::getInstance()->setAccessor('external_partner', new Accessor_ExternalPartner());
        self::$_oExternalPartnerAccessor = AccessorRepository::getInstance()->getAccessor('external_partner');
        SelectorRepository::getInstance()->setSelector('external_partner', new Selector_ExternalPartnerSelector('external_partner'));
        self::$_oExternalPartnerSelector = SelectorRepository::getInstance()->getSelector('external_partner');
        ObjectFactoryRepository::getInstance()->setObjectFactory('external_partner', new DomainFactory_ExternalPartnerFactory());
        self::$_oExternalPartnerFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('external_partner');
        //AccessorRepository::getInstance()->setAccessor('external_partner_type', new Accessor_ExternalPartnerType());
        self::$_oExternalPartnerTypeAccessor = AccessorRepository::getInstance()->getAccessor('external_partner_type');
        SelectorRepository::getInstance()->setSelector('external_partner_type', new Selector_ExternalPartnerTypeSelector('external_partner_type'));
        self::$_oExternalPartnerTypeSelector = SelectorRepository::getInstance()->getSelector('external_partner_type');
        ObjectFactoryRepository::getInstance()->setObjectFactory('external_partner_type', new DomainFactory_ExternalPartnerTypeFactory());
        self::$_oExternalPartnerTypeFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('external_partner_type');
        //AccessorRepository::getInstance()->setAccessor('mail_receiver', new Accessor_MailReceiver());
        self::$_oMailReceiverAccessor = AccessorRepository::getInstance()->getAccessor('mail_receiver');
        SelectorRepository::getInstance()->setSelector('mail_receiver', new Selector_MailReceiverSelector('mail_receiver'));
        self::$_oMailReceiverSelector = SelectorRepository::getInstance()->getSelector('mail_receiver');
        ObjectFactoryRepository::getInstance()->setObjectFactory('mail_receiver', new DomainFactory_MailReceiverFactory());
        self::$_oMailReceiverFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('mail_receiver');
        //AccessorRepository::getInstance()->setAccessor('message', new Accessor_Message());
        self::$_oMessageAccessor = AccessorRepository::getInstance()->getAccessor('message');
        SelectorRepository::getInstance()->setSelector('message', new Selector_MessageSelector('message'));
        self::$_oMessageSelector = SelectorRepository::getInstance()->getSelector('message');
        ObjectFactoryRepository::getInstance()->setObjectFactory('message', new DomainFactory_MessageFactory());
        self::$_oMessageFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('message');
        //AccessorRepository::getInstance()->setAccessor('message_read', new Accessor_MessageRead());
        self::$_oMessageReadAccessor = AccessorRepository::getInstance()->getAccessor('message_read');
        SelectorRepository::getInstance()->setSelector('message_read', new Selector_MessageReadSelector('message_read'));
        self::$_oMessageReadSelector = SelectorRepository::getInstance()->getSelector('message_read');
        ObjectFactoryRepository::getInstance()->setObjectFactory('message_read', new DomainFactory_MessageReadFactory());
        self::$_oMessageReadFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('message_read');
        //AccessorRepository::getInstance()->setAccessor('notice', new Accessor_Notice());
        self::$_oNoticeAccessor = AccessorRepository::getInstance()->getAccessor('notice');
        SelectorRepository::getInstance()->setSelector('notice', new Selector_NoticeSelector('notice'));
        self::$_oNoticeSelector = SelectorRepository::getInstance()->getSelector('notice');
        ObjectFactoryRepository::getInstance()->setObjectFactory('notice', new DomainFactory_NoticeFactory());
        self::$_oNoticeFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('notice');
        //AccessorRepository::getInstance()->setAccessor('notice_attachment', new Accessor_NoticeAttachment());
        self::$_oNoticeAttachmentAccessor = AccessorRepository::getInstance()->getAccessor('notice_attachment');
        SelectorRepository::getInstance()->setSelector('notice_attachment', new Selector_NoticeAttachmentSelector('notice_attachment'));
        self::$_oNoticeAttachmentSelector = SelectorRepository::getInstance()->getSelector('notice_attachment');
        ObjectFactoryRepository::getInstance()->setObjectFactory('notice_attachment', new DomainFactory_NoticeAttachmentFactory());
        self::$_oNoticeAttachmentFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('notice_attachment');
        //AccessorRepository::getInstance()->setAccessor('notice_queue', new Accessor_NoticeQueue());
        self::$_oNoticeQueueAccessor = AccessorRepository::getInstance()->getAccessor('notice_queue');
        SelectorRepository::getInstance()->setSelector('notice_queue', new Selector_NoticeQueueSelector('notice_queue'));
        self::$_oNoticeQueueSelector = SelectorRepository::getInstance()->getSelector('notice_queue');
        ObjectFactoryRepository::getInstance()->setObjectFactory('notice_queue', new DomainFactory_NoticeQueueFactory());
        self::$_oNoticeQueueFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('notice_queue');
        //AccessorRepository::getInstance()->setAccessor('notice_type', new Accessor_NoticeType());
        self::$_oNoticeTypeAccessor = AccessorRepository::getInstance()->getAccessor('notice_type');
        SelectorRepository::getInstance()->setSelector('notice_type', new Selector_NoticeTypeSelector('notice_type'));
        self::$_oNoticeTypeSelector = SelectorRepository::getInstance()->getSelector('notice_type');
        ObjectFactoryRepository::getInstance()->setObjectFactory('notice_type', new DomainFactory_NoticeTypeFactory());
        self::$_oNoticeTypeFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('notice_type');
        //AccessorRepository::getInstance()->setAccessor('password_reset', new Accessor_PasswordReset());
        self::$_oPasswordResetAccessor = AccessorRepository::getInstance()->getAccessor('password_reset');
        SelectorRepository::getInstance()->setSelector('password_reset', new Selector_PasswordResetSelector('password_reset'));
        self::$_oPasswordResetSelector = SelectorRepository::getInstance()->getSelector('password_reset');
        ObjectFactoryRepository::getInstance()->setObjectFactory('password_reset', new DomainFactory_PasswordResetFactory());
        self::$_oPasswordResetFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('password_reset');
        //AccessorRepository::getInstance()->setAccessor('president_log', new Accessor_PresidentLog());
        self::$_oPresidentLogAccessor = AccessorRepository::getInstance()->getAccessor('president_log');
        SelectorRepository::getInstance()->setSelector('president_log', new Selector_PresidentLogSelector('president_log'));
        self::$_oPresidentLogSelector = SelectorRepository::getInstance()->getSelector('president_log');
        ObjectFactoryRepository::getInstance()->setObjectFactory('president_log', new DomainFactory_PresidentLogFactory());
        self::$_oPresidentLogFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('president_log');
        //AccessorRepository::getInstance()->setAccessor('president_log_category', new Accessor_PresidentLogCategory());
        self::$_oPresidentLogCategoryAccessor = AccessorRepository::getInstance()->getAccessor('president_log_category');
        SelectorRepository::getInstance()->setSelector('president_log_category', new Selector_PresidentLogCategorySelector('president_log_category'));
        self::$_oPresidentLogCategorySelector = SelectorRepository::getInstance()->getSelector('president_log_category');
        ObjectFactoryRepository::getInstance()->setObjectFactory('president_log_category', new DomainFactory_PresidentLogCategoryFactory());
        self::$_oPresidentLogCategoryFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('president_log_category');
        //AccessorRepository::getInstance()->setAccessor('president_log_comment', new Accessor_PresidentLogComment());
        self::$_oPresidentLogCommentAccessor = AccessorRepository::getInstance()->getAccessor('president_log_comment');
        SelectorRepository::getInstance()->setSelector('president_log_comment', new Selector_PresidentLogCommentSelector('president_log_comment'));
        self::$_oPresidentLogCommentSelector = SelectorRepository::getInstance()->getSelector('president_log_comment');
        ObjectFactoryRepository::getInstance()->setObjectFactory('president_log_comment', new DomainFactory_PresidentLogCommentFactory());
        self::$_oPresidentLogCommentFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('president_log_comment');
        //AccessorRepository::getInstance()->setAccessor('realtor_information', new Accessor_RealtorInformation());
        self::$_oRealtorInformationAccessor = AccessorRepository::getInstance()->getAccessor('realtor_information');
        SelectorRepository::getInstance()->setSelector('realtor_information', new Selector_RealtorInformationSelector('realtor_information'));
        self::$_oRealtorInformationSelector = SelectorRepository::getInstance()->getSelector('realtor_information');
        ObjectFactoryRepository::getInstance()->setObjectFactory('realtor_information', new DomainFactory_RealtorInformationFactory());
        self::$_oRealtorInformationFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('realtor_information');
        //AccessorRepository::getInstance()->setAccessor('realtor_information_category', new Accessor_RealtorInformationCategory());
        self::$_oRealtorInformationCategoryAccessor = AccessorRepository::getInstance()->getAccessor('realtor_information_category');
        SelectorRepository::getInstance()->setSelector('realtor_information_category', new Selector_RealtorInformationCategorySelector('realtor_information_category'));
        self::$_oRealtorInformationCategorySelector = SelectorRepository::getInstance()->getSelector('realtor_information_category');
        ObjectFactoryRepository::getInstance()->setObjectFactory('realtor_information_category', new DomainFactory_RealtorInformationCategoryFactory());
        self::$_oRealtorInformationCategoryFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('realtor_information_category');
        //AccessorRepository::getInstance()->setAccessor('realtor_information_history', new Accessor_RealtorInformationHistory());
        self::$_oRealtorInformationHistoryAccessor = AccessorRepository::getInstance()->getAccessor('realtor_information_history');
        SelectorRepository::getInstance()->setSelector('realtor_information_history', new Selector_RealtorInformationHistorySelector('realtor_information_history'));
        self::$_oRealtorInformationHistorySelector = SelectorRepository::getInstance()->getSelector('realtor_information_history');
        ObjectFactoryRepository::getInstance()->setObjectFactory('realtor_information_history', new DomainFactory_RealtorInformationHistoryFactory());
        self::$_oRealtorInformationHistoryFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('realtor_information_history');
        //AccessorRepository::getInstance()->setAccessor('realtor_information_type', new Accessor_RealtorInformationType());
        self::$_oRealtorInformationTypeAccessor = AccessorRepository::getInstance()->getAccessor('realtor_information_type');
        SelectorRepository::getInstance()->setSelector('realtor_information_type', new Selector_RealtorInformationTypeSelector('realtor_information_type'));
        self::$_oRealtorInformationTypeSelector = SelectorRepository::getInstance()->getSelector('realtor_information_type');
        ObjectFactoryRepository::getInstance()->setObjectFactory('realtor_information_type', new DomainFactory_RealtorInformationTypeFactory());
        self::$_oRealtorInformationTypeFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('realtor_information_type');
        //AccessorRepository::getInstance()->setAccessor('resource', new Accessor_Resource());
        self::$_oResourceAccessor = AccessorRepository::getInstance()->getAccessor('resource');
        SelectorRepository::getInstance()->setSelector('resource', new Selector_ResourceSelector('resource'));
        self::$_oResourceSelector = SelectorRepository::getInstance()->getSelector('resource');
        ObjectFactoryRepository::getInstance()->setObjectFactory('resource', new DomainFactory_ResourceFactory());
        self::$_oResourceFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('resource');
        //AccessorRepository::getInstance()->setAccessor('resource_booking', new Accessor_ResourceBooking());
        self::$_oResourceBookingAccessor = AccessorRepository::getInstance()->getAccessor('resource_booking');
        SelectorRepository::getInstance()->setSelector('resource_booking', new Selector_ResourceBookingSelector('resource_booking'));
        self::$_oResourceBookingSelector = SelectorRepository::getInstance()->getSelector('resource_booking');
        ObjectFactoryRepository::getInstance()->setObjectFactory('resource_booking', new DomainFactory_ResourceBookingFactory());
        self::$_oResourceBookingFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('resource_booking');
        //AccessorRepository::getInstance()->setAccessor('resource_day', new Accessor_ResourceDay());
        self::$_oResourceDayAccessor = AccessorRepository::getInstance()->getAccessor('resource_day');
        SelectorRepository::getInstance()->setSelector('resource_day', new Selector_ResourceDaySelector('resource_day'));
        self::$_oResourceDaySelector = SelectorRepository::getInstance()->getSelector('resource_day');
        ObjectFactoryRepository::getInstance()->setObjectFactory('resource_day', new DomainFactory_ResourceDayFactory());
        self::$_oResourceDayFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('resource_day');
        //AccessorRepository::getInstance()->setAccessor('resource_type', new Accessor_ResourceType());
        self::$_oResourceTypeAccessor = AccessorRepository::getInstance()->getAccessor('resource_type');
        SelectorRepository::getInstance()->setSelector('resource_type', new Selector_ResourceTypeSelector('resource_type'));
        self::$_oResourceTypeSelector = SelectorRepository::getInstance()->getSelector('resource_type');
        ObjectFactoryRepository::getInstance()->setObjectFactory('resource_type', new DomainFactory_ResourceTypeFactory());
        self::$_oResourceTypeFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('resource_type');
        //AccessorRepository::getInstance()->setAccessor('setting_type', new Accessor_SettingType());
        self::$_oSettingTypeAccessor = AccessorRepository::getInstance()->getAccessor('setting_type');
        SelectorRepository::getInstance()->setSelector('setting_type', new Selector_SettingTypeSelector('setting_type'));
        self::$_oSettingTypeSelector = SelectorRepository::getInstance()->getSelector('setting_type');
        ObjectFactoryRepository::getInstance()->setObjectFactory('setting_type', new DomainFactory_SettingTypeFactory());
        self::$_oSettingTypeFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('setting_type');
        //AccessorRepository::getInstance()->setAccessor('site_setting', new Accessor_SiteSetting());
        self::$_oSiteSettingAccessor = AccessorRepository::getInstance()->getAccessor('site_setting');
        SelectorRepository::getInstance()->setSelector('site_setting', new Selector_SiteSettingSelector('site_setting'));
        self::$_oSiteSettingSelector = SelectorRepository::getInstance()->getSelector('site_setting');
        ObjectFactoryRepository::getInstance()->setObjectFactory('site_setting', new DomainFactory_SiteSettingFactory());
        self::$_oSiteSettingFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('site_setting');
        //AccessorRepository::getInstance()->setAccessor('startpage', new Accessor_Startpage());
        self::$_oStartpageAccessor = AccessorRepository::getInstance()->getAccessor('startpage');
        SelectorRepository::getInstance()->setSelector('startpage', new Selector_StartpageSelector('startpage'));
        self::$_oStartpageSelector = SelectorRepository::getInstance()->getSelector('startpage');
        ObjectFactoryRepository::getInstance()->setObjectFactory('startpage', new DomainFactory_StartpageFactory());
        self::$_oStartpageFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('startpage');
        //AccessorRepository::getInstance()->setAccessor('user', new Accessor_User());
        self::$_oUserAccessor = AccessorRepository::getInstance()->getAccessor('user');
        SelectorRepository::getInstance()->setSelector('user', new Selector_UserSelector('user'));
        self::$_oUserSelector = SelectorRepository::getInstance()->getSelector('user');
        ObjectFactoryRepository::getInstance()->setObjectFactory('user', new DomainFactory_UserFactory());
        self::$_oUserFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('user');
        //AccessorRepository::getInstance()->setAccessor('user_setting', new Accessor_UserSetting());
        self::$_oUserSettingAccessor = AccessorRepository::getInstance()->getAccessor('user_setting');
        SelectorRepository::getInstance()->setSelector('user_setting', new Selector_UserSettingSelector('user_setting'));
        self::$_oUserSettingSelector = SelectorRepository::getInstance()->getSelector('user_setting');
        ObjectFactoryRepository::getInstance()->setObjectFactory('user_setting', new DomainFactory_UserSettingFactory());
        self::$_oUserSettingFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('user_setting');
        //AccessorRepository::getInstance()->setAccessor('user_title', new Accessor_UserTitle());
        self::$_oUserTitleAccessor = AccessorRepository::getInstance()->getAccessor('user_title');
        SelectorRepository::getInstance()->setSelector('user_title', new Selector_UserTitleSelector('user_title'));
        self::$_oUserTitleSelector = SelectorRepository::getInstance()->getSelector('user_title');
        ObjectFactoryRepository::getInstance()->setObjectFactory('user_title', new DomainFactory_UserTitleFactory());
        self::$_oUserTitleFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('user_title');
        //AccessorRepository::getInstance()->setAccessor('webform_activation', new Accessor_WebformActivation());
        self::$_oWebformActivationAccessor = AccessorRepository::getInstance()->getAccessor('webform_activation');
        SelectorRepository::getInstance()->setSelector('webform_activation', new Selector_WebformActivationSelector('webform_activation'));
        self::$_oWebformActivationSelector = SelectorRepository::getInstance()->getSelector('webform_activation');
        ObjectFactoryRepository::getInstance()->setObjectFactory('webform_activation', new DomainFactory_WebformActivationFactory());
        self::$_oWebformActivationFactory = ObjectFactoryRepository::getInstance()->getObjectFactory('webform_activation');

    }
}
