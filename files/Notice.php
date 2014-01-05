<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notice
 *
 * @author John Jansson
 */
class SvenskBRF_Notice extends SvenskBRF_Main
{
    /**
     *
     * @var int 
     */
    const TYPE_EMAIL = 1;
    
    /**
     *
     * @var int 
     */
    const TYPE_SMS = 2;
    
    /**
     *
     * @var string 
     */
    const QUEUE_PENDING = 'pending_send';
    
    /**
     *
     * @var string 
     */
    const QUEUE_SENT = 'message_processed';
    
    /**
     *
     * @var string 
     */
    const QUEUE_FAILED = 'failed_to_send';
    
    /**
     *
     * @var string 
     */
    const SMS_SENDER_NAME = 'Svensk Brf';
    
    /**
     * @var string
     */
    const MAIL_TYPE_FROM_SVBRF = 'from_us';
    
    /**
     * @var string
     */
    const MAIL_TYPE_FROM_REALTOR = 'from_realtor';
    
    /**
     *
     * @var Notice
     */
    private $_oNotice;
    
    /**
     *
     * @return SvenskBRF_Notice 
     */
    private static function _queueSms(
            $a_sText,
            $a_sReceiver,
            $a_sSender = NULL,
            $a_sSendOn = NULL,
            $a_iBrfId = NULL,
            $a_iResourceBookingId = NULL,
            $a_iCalendarId = NULL,
            $a_iUserId = NULL,
            $a_iFromUserId = NULL
    )
    {
        $sReceiver = preg_replace("/[^0-9]/", "", $a_sReceiver);
        if (strlen($sReceiver) >= 10) {
            if (strlen($sReceiver) == 10) {
                $sReceiver = "46" . substr($sReceiver, 1);
            } else if (strlen($sReceiver) == 12) {
                $sReceiver = "46" . substr($sReceiver, 3);
            }
            $oNotice = Notice::create(self::TYPE_SMS, $a_iBrfId, $a_iUserId, $a_iResourceBookingId, $a_iCalendarId, $a_iFromUserId, substr($a_sText, 0, 160), NULL, NULL, $a_sSender ? $a_sSender : self::SMS_SENDER_NAME, $sReceiver, FALSE, NULL, NULL, TRUE);
            $oNoticeObject = self::load($oNotice);
            self::_putInQueue($oNoticeObject, $a_sSendOn);
            return $oNoticeObject;
        }
        return NULL;
    }
    
    public static function sendRealtorActivationMail(SvenskBRF_Brf $a_oBrf)
    {
        $oRealtorUser = $a_oBrf->getRealtorUser();
        if (!$oRealtorUser) {
            $oRealtorUser = SvenskBRF_User::loadById($a_oBrf->getRealtorUserId());
        }
        $sBrfLink = BASE_DIR . $a_oBrf->getUrl();
        $sBodyHTML = <<<REALTOR_ACTIVATED
<p>Förening {$a_oBrf->getName()} ($sBrfLink) har aktiverats med mäklarkod från {$oRealtorUser->getName()} ({$oRealtorUser->getEmail()}).</p>
REALTOR_ACTIVATED;

        self::_queueMail($sBodyHTML, "Förening aktiverad med mäklarkod", "internt@svenskbrf.se", "maklare@svenskbrf.se", FALSE, NULL, $a_oBrf->getId());
        
        $sBodyHTML = <<<REALTOR_ACTIVATED2
<p>Bostadsrättsförening {$a_oBrf->getName()} ($sBrfLink) har aktiverats med din mäklarkod. Du är nu föreningens mäklare hos Svensk Brf.</p>
REALTOR_ACTIVATED2;
        
        self::_queueMail($sBodyHTML, $a_oBrf->getName() . ' aktiverades med din aktiveringskod!', "maklare@svenskbrf.se",$oRealtorUser->getEmail(), TRUE, NULL, $a_oBrf->getId(), NULL, NULL, $oRealtorUser->getId());
    }
    
    /**
     *
     * @return SvenskBRF_Notice 
     */
    private static function _queueMail(
            $a_sMailType,
            $a_sBody,
            $a_sSubject,
            $a_sSender,
            $a_sReceiver,
            $a_bPhoneInEmail = FALSE,
            $a_sSendOn = NULL,
            $a_iBrfId = NULL,
            $a_iResourceBookingId = NULL,
            $a_iCalendarId = NULL,
            $a_iUserId = NULL,
            $a_iFromUserId = NULL,
            array $a_aAttachments = array()
    )
    {
        $sTagHTML = "<br/><p>Med vänliga hälsningar,</p><p>Teamet på Svensk Brf<br/><a href=\"mailto:kontakt@svenskbrf.se\">kontakt@svenskbrf.se</a><br/><img src=\"" . BASE_DIR . "media/start/img/logga.png\" width=\"248\" height=\"85\" alt=\"Svensk Brf\"/></p>";
        $sTag = "\n\n\nMed vänliga hälsningar,\n\nTeamet på Svensk Brf\nkontakt@svenskbrf.se";
        $sTagHTMLPhone = "<br/><p>Med vänliga hälsningar,</p><p>Teamet på Svensk Brf<br/>Tel: 08-636 56 00<br /><a href=\"mailto:kontakt@svenskbrf.se\">kontakt@svenskbrf.se</a><br/><img src=\"" . BASE_DIR . "media/start/img/logga.png\" width=\"248\" height=\"85\" alt=\"Svensk Brf\"/></p>";
        $sTagPhone = "\n\n\nMed vänliga hälsningar,\n\nTeamet på Svensk Brf\nTel: 08-636 56 00\nkontakt@svenskbrf.se";
        
        $sMailTag = '';
        $sMailTagHTML = '';
        switch ($a_sMailType) {
            case self::MAIL_TYPE_FROM_SVBRF:
                $sMailTag = $a_bPhoneInEmail ? $sTagPhone : $sTag;
                $sMailTagHTML = $a_bPhoneInEmail ? $sTagHTMLPhone : $sTagHTML;
                break;
            case self::MAIL_TYPE_FROM_REALTOR:
                break;
        }
        
        $oNotice = Notice::create(
            self::TYPE_EMAIL, 
            $a_iBrfId, 
            $a_iUserId, 
            $a_iResourceBookingId, 
            $a_iCalendarId, 
            $a_iFromUserId, 
            
            // clear text
            strip_tags($a_sBody) . $sMailTag,
                
            // html mail
            "<html><body>" . $a_sBody . $sMailTagHTML. '</body></html>', 
                
            $a_sSubject, 
            $a_sSender, 
            $a_sReceiver, 
            FALSE, 
            NULL, 
            NULL, 
            TRUE
        );
        
        foreach ($a_aAttachments as $aAttachmentData) {
            $oAttachment = NoticeAttachment::create($oNotice->getId(), $aAttachmentData[0], $aAttachmentData[1], $aAttachmentData[2], TRUE);
            $oNotice->getNoticeAttachmentCollection()->addObject($oAttachment);
        }
        $oNoticeObject = self::load($oNotice);
        self::_putInQueue($oNoticeObject, $a_sSendOn);
        return $oNoticeObject;
    }

    
    public static function sendTipMail($a_sFromName, $a_sToEmail, $a_sMessage = '')
    {
        $sActivateLink = BASE_DIR . 'tjanster';
        $sSubject = "$a_sFromName vill tipsa dig om fördelarna med att aktivera er förenings hemsida hos Svensk Brf!";
        $sTipMailBody = <<<TIPMAIL
<p>Hej,<br /> 
<br />        
Meddelande från $a_sFromName:</p>
        
<p>$a_sMessage</p>
        
<p>Du har fått detta mail då $a_sFromName tipsat oss om att du sitter i styrelsen för en bostadsrättsförening och kan vara intresserad av att aktivera en gratis hemsida..</p>

<p>Vi på Svensk Brf har skapat hemsidor för samtliga bostadsrätts- och bostadsföreningar i Sverige. Vi erbjuder nu styrelsemedlemmar möjligheten att aktivera sin förenings hemsida. Ni får då tillgång till ett stort antal funktioner som underlättar styrelsearbetet och ökar trivseln för medlemmarna i föreningen.</p>

<table><tr><td width="15"></td><td>- Dokument: Styrelsen kan på ett enkelt sätt ladda upp protokoll, årsredovisningar och den information som du som mäklare behöver vid förmedlingsarbetet.</td></tr>
<tr><td width="15"></td><td>- Bokningar: Styrelsen och medlemmarna kommer även att kunna sköta bokningar av föreningens gemensamma ytor som t.ex. tvättstuga eller gård. Man kommer även kunna lägga till påminnelser via sms för sina bokningar.</td></tr>
<tr><td width="15"></td><td>- Kalender: Styrelsen kan lägga upp viktiga datum för föreningens medlemmar t.ex. årsmöten och städdagar. Det går även att lägga in automatiska påminnelser via mail och sms. - Anslagstavla: På anslagstavlan kan  medlemmarna skriva meddelanden och lägga upp bilder som t.ex. på lördag har jag fest eller köp min soffa!</td></tr>
<tr><td width="15"></td><td>- Meddelanden: Denna funktion gör att  alla medlemmar kan skicka meddelande  till varandra.</td></tr> 
<tr><td width="15"></td><td>- Profil: Naturligtvis så kommer medlemmarna kunna skapa en egen medlemsprofil där medlemmen kan välja att ladda upp en bild och skriva lite om sig själv.</td></tr>
<tr><td width="15"></td><td>- Styrelselogg: Med styrelseloggen så kan styrelsen ladda upp dokument som endast ska vara tillgänglig för styrelsen samt göra noteringar i en logg för att underlätta för en styrelse att kunna följa vad som hänt i en förening. Även när styrelsen bytts ut.</td></tr>
<tr><td width="15"></td><td>- Upphandlingar: Detta är en tjänst som vi kommer vidareutveckla där vi kommer att hjälpa föreningar att sänka kostnaden för olika tjänster som t.ex. renoveringsarbeten eller abonnemang.</td></tr></table>
        
<p>Läs gärna mer om oss och våra tjänster här:
        
<p><a href="$sActivateLink">$sActivateLink</a></p>
    
<p style="font-size: small">Svensk Brf är finansierade av annonsörer och sponsorer och kan således erbjuda detta utan kostnad för er som förening. Är ni inte nöjda med vår tjänst när ni väl provat den så kan vi avaktivera omgående. Hemsidan innebär ingen bindningstid eller övriga förpliktelser för er som förening.</p>
TIPMAIL;

        self::_queueMail(self::MAIL_TYPE_FROM_SVBRF, $sTipMailBody, $sSubject, "info@svenskbrf.se", $a_sToEmail, TRUE);
        self::_queueMail(self::MAIL_TYPE_FROM_SVBRF, "$a_sFromName har tipsat $a_sToEmail om SvenskBrf med meddelande: $a_sMessage", "Någon tipsade om SvenskBrf.se via siten", "info@svenskbrf.se", "andreas.karrfelt@svenskbrf.se");
    }
    
    
    private static function _putInQueue(SvenskBRF_Notice $a_oNotice, $a_sSendOn) 
    {
        $oNoticeQueue = NoticeQueue::create($a_oNotice->getId(), self::QUEUE_PENDING, NULL, NULL, date('Y-m-d H:i:s'), $a_sSendOn ? $a_sSendOn : date('Y-m-d H:i:s'), TRUE);
        $a_oNotice->getNoticeQueueCollection()->addObject($oNoticeQueue);
        $oNoticeQueue->setNotice($a_oNotice->getDomainObject());
    }
    
    
        
    function getQueueData()
    {
        $bAdded = FALSE;
        if (!$this->_oNotice->getNoticeQueueCollection()->size()) {
            foreach (self::$_oNoticeQueueAccessor->getNoticeQueuesByNoticeId($this->_oNotice->getId()) as $oNoticeQueue) {
                $this->_oNotice->getNoticeQueueCollection()->addObject($oNoticeQueue);
                $bAdded = TRUE;
            }
        }
        return $bAdded ? $this->_oNotice->getNoticeQueueCollection()->current() : NULL;
    }
    
    /**
     *
     * @return Notice 
     */
    function getDomainObject()
    {
        return $this->_oNotice;
    }
    
    /**
     *
     * @param Notice $a_oNotice
     * @return SvenskBRF_Notice
     */
    public static function load(Notice $a_oNotice)
    {
        return new self($a_oNotice);
    }
    
    /**
     *
     * @param int $a_iId
     * @return SvenskBRF_Notice
     */
    public static function loadbyId($a_iId)
    {
        return self::load(self::$_oNoticeAccessor->getById($a_iId));
    }
    
    /**
     *
     * @param Notice $a_oNotice 
     * @return SvenskBRF_Notice
     */
    private function __construct(Notice $a_oNotice)
    {
        $this->_oNotice = $a_oNotice;
    }
    
    
   
    
    /**
     *
     * @param string $a_sMethod
     * @param array $a_aArguments 
     * @return mixed
     */
    function __call($a_sMethod, array $a_aArguments = array()) 
    {
        if (method_exists($this->_oNotice, $a_sMethod)) {
            return call_user_func_array(array($this->_oNotice, $a_sMethod), $a_aArguments);
        }
    }
    
    public static function queueCalendarSms(Calendar $a_oCalendar, $a_sSmsText, array $a_aUsers, $a_bIsBoard)
    {
        foreach ($a_aUsers as $oUser) {
            
            $sSendOn = date('Y-m-d H:i:s', strtotime('-1 hour', strtotime($a_oCalendar->getWhen())));
            if (TEST) {
                $sSendOn = NULL;
            }
            
            if ($oUser->getCellPhone()) {
                if ((!$a_bIsBoard || $oUser->isBoardMember()) && $oUser->isRegistered()) {
                    $sSMSText = $a_sSmsText;
                    self::_queueSms($sSMSText, $oUser->getCellPhone(), NULL, $sSendOn  /* SEND ON! */, NULL, NULL, $a_oCalendar->getId(), $oUser->getId());
                }
            }
        }
    }
    
    public static function sendSMSToMembers($a_sSmsText, SvenskBRF_Brf $a_oBrf, $a_aReceiverIds, $a_iSenderUserId = NULL)
    {
        foreach (SvenskBRF_User::getUsersByBrfId($a_oBrf->getId()) as $oUser) {
            if (in_array($oUser->getId(), $a_aReceiverIds) && (!$a_iSenderUserId || $oUser->getId() != $a_iSenderUserId)) {
                self::_queueSms($a_sSmsText, $oUser->getCellphone(), NULL, NULL, $a_oBrf->getId(), NULL, NULL, $oUser->getId(), $a_iSenderUserId);
            }
        }
    }
    
    public static function queueBookingReminderSms(ResourceBooking $a_oResourceBooking)
    {
        $sSendOn = date('Y-m-d H:i:s', strtotime('-1 hour', strtotime($a_oResourceBooking->getStart())));
        if (TEST) {
            $sSendOn = NULL;
        }
        $sBookingText = "Hej! Detta är en påminnelse om att du har bokat ";
        $sBookingText .= $a_oResourceBooking->getResource()->getName() . " idag kl ";
        $sBookingText .= getResourceBookingTimeFormatMainViewSecondPartNoZeros($a_oResourceBooking) . ". ";
        $sBookingText .= "Om du vill avboka denna tid gå in på " . BASE_DIR . 'avboka/' . $a_oResourceBooking->getUnbookCode();
        self::_queueSms($sBookingText, $a_oResourceBooking->getUser()->getCellphone(), NULL, 
                $sSendOn, 
        NULL, $a_oResourceBooking->getId(), NULL, $a_oResourceBooking->getUser()->getId());
    }
    
    public static function sendMailNotification(MailReceiver $a_oReceiver)
    {
        $oBrf = ($oToUser = $a_oReceiver->getToUser()) && $oToUser->getBrf();
        if ($oBrf) {
            $oBrf = SvenskBRF_Brf::load($oBrf);
        }
        if (!$oToUser) {
            $oToUser = SvenskBRF_User::loadById($a_oReceiver->getToUserId());
            $a_oReceiver->setToUser($oToUser);
        }
        $oFromUser = NULL;
        if (!$oBrf) {
            $oFromUser = $a_oReceiver->getMail()->getFromUser();
            if ($oFromUser) {
                $oBrf = $oFromUser->getBrf();
                if ($oBrf) {
                    $oBrf = SvenskBRF_Brf::load($oBrf);
                }
            }
            if (!$oFromUser) {
                $oFromUser = SvenskBRF_User::loadById($a_oReceiver->getMail()->getFromUserId());
                $a_oReceiver->getMail()->setFromUser($oFromUser);
            }
            if (!$oBrf) {
                $oBrf = SvenskBRF_Brf::loadById($oFromUser->getBrfId());
            }
        }
        if (!$oFromUser) {
            $oFromUser = SvenskBRF_User::loadById($a_oReceiver->getMail()->getFromUserId());
            $a_oReceiver->getMail()->setFromUser($oFromUser);
        }
        $sFirstLine = "{$oFromUser->getName()} i din bostadsrättsförening har skickat ett meddelande till dig. på föreningens sajt.";
        if ($oFromUser->getUserType() == SvenskBRF_User::USER_TYPE_REALTOR) {
            $sFirstLine = "Din bostadsrättsförenings mäklare, {$oFromUser->getName()}, har skickat ett meddelande till dig.";
        }
        $sUrl = BASE_DIR . $oBrf->getUrl() . '/meddelanden/inkorgen';
        $sBodyText = <<<MAILNOTIFICATION
<p>Hej,</p>
    
<p>$sFirstLine<br />
Klicka på länken nedan för att kunna läsa meddelandet.

<a href="$sUrl">$sUrl</a>
    
<p>Vi rekommenderar att ni loggar regelbundet på föreningens hemsida och håller er uppdaterade om väsentliga händelser i föreningen.</p>
                
<p style="font-size: 10px;">Om du inte har klickat i Kom ihåg mig vid inloggning så behöver du logga in för att se meddelandet.</p>
MAILNOTIFICATION;
        $oNotice = self::_queueMail(self::MAIL_TYPE_FROM_SVBRF, $sBodyText, "Du har fått ett meddelande från {$oFromUser->getName()}", "info@svenskbrf.se", $a_oReceiver->getToUser()->getEmail(), FALSE, NULL, NULL, NULL, NULL, $a_oReceiver->getToUserId(), $oFromUser->getId());
    }
    
    public static function queueToMembersNotification(SvenskBRF_Brf $a_oBrf)
    {
        $oNotice = self::_queueMail(self::MAIL_TYPE_FROM_SVBRF,
                "<p>Förening " . $a_oBrf->getName() ." vill ha hjälp med utskrift anv/lösen till medlemmar.</p>\n\n<p>Se bifogad fil!</p>", 
                "För utskrift",
                "internt@svenskbrf.se", 
                "utskrift@svenskbrf.se", 
                FALSE,
                NULL, // send_on
                $a_oBrf->getId(), 
                NULL, 
                NULL,
                NULL,
                NULL,
                array(
                    array(
                        SvenskBRF_Document::FILE_BASE_PATH . $a_oBrf->getUrl() . '/documents/administration/' . (SvenskBRF_Document::getToMembersStartDocumentName($a_oBrf)),
                        'pdf', 
                        (SvenskBRF_Document::getToMembersStartDocumentName($a_oBrf)
                    )
                ),
        ));
    }
    
    /**
     *
     * @param WebformActivation $a_oBrf 
     */
    public static function sendRegisterInstructions(SvenskBRF_Brf $a_oBrf, $a_sEmail) 
    {
        $sRegisterLink = BASE_DIR ."registrera/".$a_oBrf->getSetting(SvenskBRF_Brf::BRF_SETTING_ID_REGISTER_BRFCODE);
        $sRegInstMail = <<<REGINSTMAIL
<p>Välkommen till Svensk Brf!</p>
    
<p>Snart har du aktiverat din förenings nya hemsida.</p>
                
<p>Du har fått detta mail då du har påbörjat registreringen av din förenings hemsida! Om du avslutar registreringsprocessen kan du återgå till denna genom att klicka på länken nedan.</p>

<p><a href="$sRegisterLink">$sRegisterLink</a></p>
                
<p>Du, och medlemmarna i din förening, kommer snart att få tillgång till en stor mängd funktioner som underlättar arbetet för dig som sitter föreningens styrelse. Vi på Svensk Brf arbetar kontinuerligt för att lägga till nya och förbättrade tjänster med fler funktioner, allt för att göra livet som styrelsemedlem enklare samt för att höja trivseln för de boende samt att spara tid och pengar åt boende i Sveriges samtliga bostadsrättsföreningar!</p>

<p>Tveka inte att höra av dig till oss på info@svenskbrf.se om du har några frågor eller om du fastnar någonstans. Din synpunkt är viktig!</p>

<p>Varmt välkommen!</p>
REGINSTMAIL;
        $oNotice = self::_queueMail(
                $sRegInstMail,
                "Påbörjad registrering av din förenings nya hemsida!", 
                "info@svenskbrf.se", 
                $a_sEmail,
                TRUE,
                $a_oBrf->getId()
        );
    }
    
    public static function sendRealtorInterestMail($a_sText, array $a_aFormData)
    {
        // to us...
        self::_queueMail("<p>$a_sText</p>", "Intresseanmälan från mäklare", "internt@svenskbrf.se", "maklare@svenskbrf.se");
        // from
        // message
        // email
        // phone
        $sReceiverName = $a_aFormData['from'];
        $sServicesLink = BASE_DIR . 'tjanster';
        $sRealtorMail = <<<REALTORMAIL
<p>Hej $sReceiverName,<br />
<br />    
Tack för att du anmält intresse för att bli en föreningsmäklare hos Svensk Brf!</p>
        
<h3>Fördelar med att vara föreningsmäklare hos Svensk Brf</h3>
<p>Med Svensk Brf så får du möjlighet att få direktkontakt med medlemmar i bostadsrätts/bostadsföreningar. Fördelen med Svensk Brfs modell äratt du som föreningsmäklare i en förening blir ett naturligt val då man vill värdera eller sälja sin lägenhet. Varje gång en medlem går in för att läsa ett meddelande eller boka tvättstugan så syns du på förstasidan.</p>
        
<table><tr><td width="15"></td><td>-Som föreningensmäklare visas endast din profil på föreningens hemsida.</td></tr>
<tr><td width="15"></td><td>-Direktkontakt med medlemmarna via din profil, text och meddelanden.</td></tr>
<tr><td width="15"></td><td>-Direktkontakt med styrelsen.</td></tr>
<tr><td width="15"></td><td>-Större trovärdighet än lappar i brevlådan bland alla andra mäklare.</td></tr>
<tr><td width="15"></td><td>-Du blir en naturlig kontakt när någon i föreningen ska ta in mäklare vid en försäljning.</td></tr>
<tr><td width="15"></td><td>-Som föreningsmäklare syns du även för de spekulanter som söker på en förening. Din profil visas även på den offentliga sidan.</td></tr>
<tr><td width="15"></td><td>-Möjlighet att visa samtliga sina föreningar via en länk i din profil. På så sätt så kan en potentiell kund se hur många föreningar du är föreningsmäklare åt. Naturligtvis så väljer du själv om länken ska visas eller inte i din profil.</td></tr></table>
        
<h3>Mäklarprofil</h3>
        
<p>Med Svensk Brf får du möjlighet att skapa en mäklarprofil med bild och presentationstext. Du kan skapa unika presentationstexter för olika föreningar och exempelvis berätta om din senaste försäljning i föreningen. Du är den enda mäklaren som kan kommunicera med styrelse och medlemmar via detta forum, så länge som du prenumererar på platsen som föreningsmäklare. Du gör det enkelt på din inloggade sida hos Svensk Brf!</p>
        
<h3>Hur du knyter en förening till dig</h3>
        
<p>För att bli föreningsmäklare måste du tipsa en styrelsemedlem i en förening om att de har en gratis hemsida och intranät som bara väntar på att aktiveras – och få dem att aktivera sidan. Kom ihåg att tjänsten är helt gratis för föreningarna. Om en förening redan är aktiverad men inte har en föreningsmäklare så mejlar du oss på <a href="mailto:maklare@svenskbrf.se">maklare@svenskbrf.se</a> och meddelar föreningens namn. Om du vill kan du läsa mer om företaget och alla de tjänster vi har att erbjuda Sveriges samtliga föreningar här: <a href="$sServicesLink">$sServicesLink</a>.</p>
    
<h3>TRE MÅNADER GRATIS</h3>

<p>Du kan vara föreningsmäklare för en förening i tre månader helt kostnadsfritt. Därefter betalar du en månadskostnad enligt prislistan som finns upplagd på din inloggade sida eller under menyn För mäklare på <a href="http://www.svenskbrf.se">http://www.svenskbrf.se</a>. Det blir betydligt mer effektivt än att lappa en förening löpande där du alltid riskerar att ligga bland andra mäklarlappar eller försvinna bland reklamen. </p>

<p>Inloggningsuppgifter:</p>
                
<p>Användarnamn: {$a_aFormData['username']}</p>
<p>Lösenord: {$a_aFormData['password']}</p>
                
<p>Du loggar in på <a href="http://www.svenskbrf.se">http://www.svenskbrf.se</a> genom att klicka på Logga in i menyn</p>
                
<p>Kontakta oss gärna om du har frågor eller förslag. Vi kommer gärna på ett möte om ni önskar en personlig presentation av vår tjänst!</p>

<p>Varmt välkommen!</p>
REALTORMAIL;
        self::_queueMail(self::MAIL_TYPE_FROM_SVBRF, $sRealtorMail, "Tack för din intresseanmälan för ett samarbete med Svensk Brf!", "maklare@svenskbrf.se", $a_aFormData['email'], TRUE,
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                NULL,
                array(
                    array(
                        './../files/templates/Komma_igang_guide.pdf',
                        'pdf', 
                        'Kom igång.pdf'
                    )
                )
        );
        
    }
    
    
    public static function sendMemberRegistrationMail(SvenskBRF_User $a_oUser)
    {
        $sBodyText = <<<REG_MAIL
<p>Hej {$a_oUser->getName()}!</p>

<p>Nu har du registrerat dig som medlem på Svensk Brf och har därmed tillgång till en massa smarta funktioner som gör din vardag enklare.</p>

<p>Ett tips om du vill lära känna dina grannar bättre är att registrera din medlemsprofil. Då kan du och dina grannar enkelt komma i kontakt med varandra och bland annat skicka privata meddelanden.</p>

<p>Tack vare hemsidan har du tillgång till följande funktioner:</p>

<table><tr><td width="15"></td><td>-Med hjälp av vårt bokningssystem kan du som boende boka tvättstugan och övriga gemensamma utrymmen via din mobil, I-Pad eller dator. Bokningarna avbokas lätt vid förhinder och vill man få en påminnelse via sms är det bara att bocka i en ruta i samband med bokningen.</td></tr>
<tr><td width="15"></td><td>-För att medlemmarna ska lära känna varandra lite bättre så finns det möjlighet att beskriva sig själv, lägga upp en bild och information om vem man bor med. Dessutom så kan man lägga till kontaktuppgifter här så att man kan nås om det behövs.</td></tr>
<tr><td width="15"></td><td>-Genom intranätet kan du få automatiska påminnelser när du bokat tvättstugan eller andra lokaler. Styrelsen har också möjlighet att skicka ut påminnelser via mejl eller sms till samtliga medlemmar vid viktiga händelser som till exempel när en hantverkare ska komma eller till en stämma.</td></tr>
<tr><td width="15"></td><td>-Kalendern använder styrelsen för att lägga upp tider för årsstämman, för städdagar eller för när sotaren kommer förbi. Som medlem får du snabbt all viktig information samlad på ett ställe. Styrelsen kan via hemsidan skicka ute en påminnelse via mejl eller sms till medlemmarna.</td></tr>
<tr><td width="15"></td><td>-Hemsidan innehåller ett system för att hantera dokument på ett enkelt sätt. Styrelsen kan lätt lägga upp viktiga dokument som till exempel ordningsregler, stadgar och årsredovisning som ska vara tillgängligt för medlemmarna. På så sätt slipper styrelsen springa runt och dela ut papper i brevlådor.</td></tr>
<tr><td width="15"></td><td>-På anslagstavlan kan medlemmar och styrelse lägga upp meddelanden eller händelser som blir synliga för alla inloggade. Det kan handla om att någon ska ha födelsedagsfest eller att du vill sälja din soffa.</td></tr>
<tr><td width="15"></td><td>-När hemsidan är aktiverad finns möjlighet att ladda upp bilder som är av intresse för de boende eller för andra i presentationen av föreningen. Man kan lägga upp bilder som visas offentligt eller privat, det vill säga enbart för föreningens medlemmar.</td></tr></table>

<p>Vi hoppas du kommer få mycket nytta av er nya hemsida. Tveka inte att göra av dig till oss med eventuella frågor.</p>
REG_MAIL;
                
        $sSubject = "Välkommen till din förenings nya hemsida!";
        self::_queueMail(self::MAIL_TYPE_FROM_SVBRF, $sBodyText, $sSubject, "info@svenskbrf.se", $a_oUser->getEmail(), FALSE, NULL, $a_oUser->getBrfId(), NULL, NULL, $a_oUser->getId(), NULL, array(
            array(
                './../files/templates/Guide.pdf',
                'pdf', 
                'Guide'
            )
        ));
        
        if (TRUE) {
            $sMessage = <<<INTRO_MESSAGE
Hej {$a_oUser->getName()}!

Välkommen till din förenings nya hemsida! Du har nu tillgång till en rad användbara funktioner utformade för att göra livet enklare för föreningens medlemmar och styrelsen.  

Ta gärna några minuter och bekanta dig med alla de funktioner som nu finns tillgängliga som möjligheten att boka gemensamhetsutrymmen, tex tvättstuga, och att man kan lägga upp notiser på föreningens digitala anslagstavla och skicka meddelanden mellan medlemmarna. 

Du har fått en enkel användarguide, som PDF, skickad till din registrerade e-postadress.


Din medlemsprofil

Du har även möjligheten att skriva lite information om dig själv under din medlemsprofil. Det är naturligtvis valfritt hur mycket eller lite information du väljer att lägga in.  

Om du får problem med någon av våra funktioner/tjänster hittar du svaren på de flesta frågor under FAQ (vanliga frågor) i vänstermenyn.

Du är självklart även välkommen att kontakta oss på kontakt@svenskbrf.se.

Varmt välkommen önskar 

Teamet på Svensk Brf
INTRO_MESSAGE;
        
            $oSendMailCommand = Command::createCommand('sendmail', array(
                'userId'    => SvenskBRF_User::SYSTEM_USER_ID,
                'message'   => $sMessage,
                'receivers' => array($a_oUser->getId()),
                'subject'   => 'Välkommen till Svensk Brf',
                'skipNotification' => TRUE,
            ));
            $oSendMailCommand->execute($aResultData);
            // result data...
        }
    }
    
    public static function sendRegisterStartNotification(SvenskBRF_Brf $a_oBrf, $a_sEmail, $a_sCellphone)
    {
        $sBodyText = "<p>Registreringsprocess har påbörjats för {$a_oBrf->getName()} ({$a_oBrf->getUrl()}). E-post: $a_sEmail Telefon: $a_sCellphone</p>";
        self::_queueMail($sBodyText, "Registrering påbörjad", "internt@svenskbrf.se", "andreas.karrfelt@svenskbrf.se", FALSE, NULL, $a_oBrf->getId());
        self::sendRegisterInstructions($a_oBrf, $a_sEmail);
    }
    
    
    public static function sendRegisterCompleteNotification(SvenskBRF_Brf $a_oBrf, $a_sEmail, $a_sCellphone, $a_iUserId = NULL)
    {
        $sBodyText = "<p>Registreringsprocess har SLUTFÖRTS {$a_oBrf->getName()} ({$a_oBrf->getUrl()}). E-post: $a_sEmail Telefon: $a_sCellphone</p>";
        self::_queueMail($sBodyText, "Registrering slutförd", "internt@svenskbrf.se", "andreas.karrfelt@svenskbrf.se", FALSE, NULL, $a_oBrf->getId());
        $sServicesLink = BASE_DIR . 'tjanster';
        $sName = "!";
        if ($a_iUserId) {
            $sName = " " . SvenskBRF_User::loadById($a_iUserId)->getName() . $sName;
        }
        $sBodyText = <<<REGCOMPLETEMAIL
<p>Hej$sName</p>
                
<p>Er förenings webbsida är nu aktiverad. Vi hoppas att du, styrelsen och medlemmarna i föreningen kommer att få mycket nytta av sidan.</p>
                
<p>Vill du läsa mer om vilka tjänster som finns tillgängliga på hemsidan så kan du klicka på länken nedan:</p>

<a href="$sServicesLink">$sServicesLink</a>
                
<p>Har du några frågor om hur våra tjänster fungerar hittar du en FAQ i menyn till vänster i inloggat läge - under "För styrelsen". Har du övriga frågor det självklart bra att maila oss på info@svenskbrf.se eller ringa på 08-636 56 00.</p>

<p>Varmt välkommen!</p>
REGCOMPLETEMAIL;
        
        $sSubject = "Slutförd aktivering av {$a_oBrf->getName()} hos Svensk Brf!";
        self::_queueMail(self::MAIL_TYPE_FROM_SVBRF, $sBodyText, $sSubject, "info@svenskbrf.se", $a_sEmail, TRUE, NULL, $a_oBrf->getId(), NULL, NULL, $a_iUserId);
        
        
        if (TEST) {
            $sMessage = <<<INTRO_MESSAGE
Hej$sName!
                    
Välkommen till din förenings nya hemsida! Du har nu tillgång till en rad användbara funktioner utformade för att göra livet enklare för föreningens medlemmar och styrelsen.  
                    
För styrelsen
Du som styrelsemedlem har tillgång till en extra meny som heter ”För styrelsen” och som du hittar i den vänstra menyn. Här sköter du och övriga styrelsemedlemmar alla funktioner som finns på sidan. Funktioner som bildhantering, ladda upp dokument, lägga in händelser som tex stämmor i medlemskalendern etc. 
En värdefull funktion är styrelseloggen. Här kan styrelsemedlemmarna hantera projekt såsom tex en renovering i föreningen genom att ladda upp dokument och kommentarer för just det projektet. 
För att lära dig mer om hur du använder alla funktionerna ska du läsa PDFen som ligger under menyn Dokumenthantering/Svensk Brf PDF:er – Användarguide för dig som Styrelsemedlem.

Aktivera övriga styrelsemedlemmar

Just nu är det endast du som har aktiverat sidan som har möjlighet att administrera sidan. Men du kan ge samtliga styrelsemedlemmar samma möjlighet:
1. Klicka på Styrelseadmin och klicka sedan medlemsadmin.
2. Längst ner på denna sida finns en rullgardinsmeny där du ser vilka medlemmar som registrerat sig. När en styrelsemedlem registrerat sig så kan du välja väljer du här vilken roll han eller hon har i styrelsen. 
3. Ovanför detta ser du vilka medlemmar som är registrerade som styrelsemedlemmar och därmed har behörighet till samtliga adminfunktioner.

Om du får problem med, eller har frågor om, någon av våra funktioner/tjänster hittar du svaren på de flesta frågor under vår FAQ (vanliga frågor) som ligger längst ner i vänstermenyn. 
Du är självklart välkommen att kontakta oss på kontakt@svenskbrf.se

Varmt välkommen önskar 
Teamet på Svensk Brf
INTRO_MESSAGE;
        
            $oSendMailCommand = Command::createCommand('sendmail', array(
                'userId'    => SvenskBRF_User::SYSTEM_USER_ID,
                'message'   => $sMessage,
                'receivers' => array($a_iUserId),
                'subject'   => 'Välkommen till din förenings nya hemsida!',
                'skipNotification' => TRUE,
            ));
            $oSendMailCommand->execute($aResultData);
            // result data...
        }
    }
    
    
    public static function tip(SvenskBRF_Brf $a_oBrf, $a_sSenderName, $a_sReceiverName, $a_sEmail, $a_sSenderEmail)
    {
        $sBrfUrl = BASE_DIR . $a_oBrf->getUrl();
        $sBodyText = <<<TIP1
<p>Hej!</p>
    
<p>$a_sSenderName vill tipsa dig om att er förening nu har en egen hemsida hos Svensk Brf. Detta är helt kostnadsfritt och sidan innehåller funktioner som underlättar arbetet för dig som styrelsemedlem, men framför allt har den många funktioner som underlättar medlemmarnas vardag.</p>
    
<table><tr><td width="15"></td><td>-Med hjälp av vårt bokningssystem kan du som boende boka tvättstugan och övriga gemensamma utrymmen via din mobil, I-Pad eller dator. Bokningarna avbokas lätt vid förhinder och vill man få en påminnelse via sms är det bara att bocka i en ruta i samband med bokningen.</td></tr>
<tr><td width="15"></td><td>-För att medlemmarna ska lära känna varandra lite bättre så finns det möjlighet att beskriva sig själv, lägga upp en bild och information om vem man bor med. Dessutom så kan man lägga till kontaktuppgifter här så att man kan nås om det behövs.</td></tr>
<tr><td width="15"></td><td>-Genom intranätet kan du få automatiska påminnelser när du bokat tvättstugan eller andra lokaler. Styrelsen har också möjlighet att skicka ut påminnelser via mejl eller sms till samtliga medlemmar vid viktiga händelser som till exempel när en hantverkare ska komma eller till en stämma.</td></tr>
<tr><td width="15"></td><td>-Kalendern använder styrelsen för att lägga upp tider för årsstämman, för städdagar eller för när sotaren kommer förbi. Som medlem får du snabbt all viktig information samlad på ett ställe. Styrelsen kan via hemsidan skicka ute en påminnelse via mejl eller sms till medlemmarna.</td></tr>
<tr><td width="15"></td><td>-Hemsidan innehåller ett system för att hantera dokument på ett enkelt sätt. Styrelsen kan lätt lägga upp viktiga dokument som till exempel ordningsregler, stadgar och årsredovisning som ska vara tillgängligt för medlemmarna. På så sätt slipper styrelsen springa runt och dela ut papper i brevlådor.</td></tr>
<tr><td width="15"></td><td>-På anslagstavlan kan medlemmar och styrelse lägga upp meddelanden eller händelser som blir synliga för alla inloggade. Det kan handla om att någon ska ha födelsedagsfest eller att du vill sälja din soffa.</td></tr>
<tr><td width="15"></td><td>-När hemsidan är aktiverad finns möjlighet att ladda upp bilder som är av intresse för de boende eller för andra i presentationen av föreningen. Man kan lägga upp bilder som visas offentligt eller privat, det vill säga enbart för föreningens medlemmar.</td></tr></table>

<p>Klicka på länken nedan för att se er hemsida. För att aktivera sidan och lägga in mer information så klickar ni på den blå cirkeln uppe till höger. Därefter följer en enkel guide som hjälper dig genom aktiveringsprocessen.</p>

<a href="$sBrfUrl">$sBrfUrl</a>
    
<p>Har ni några frågor så är ni självklart välkomna att kontakta oss på 08-636 56 00 eller via mejl på <a href="mailto:kontakt@svenskbrf.se">kontakt@svenskbrf.se</a>.</p>
    
<p style="font-size: small">Svensk Brf är finansierade av annonsörer och sponsorer och kan således erbjuda detta utan kostnad för er som förening! Är ni inte nöjda med vår tjänst när ni väl provat den så kan vi avaktivera omgående. Hemsidan innebär ingen bindningstid eller övriga förpliktelser för er som förening.</p>
TIP1;
        self::_queueMail($sBodyText, "$a_sSenderName vill tipsa dig om att ni ska aktivera er förenings hemsida!", "info@svenskbrf.se", $a_sEmail, TRUE, NULL, $a_oBrf->getId());
        
        $sBodyText = "<p>$a_sSenderName har tipsat $a_sReceiverName om {$a_oBrf->getName()} ({$a_oBrf->getUrl()}). Tipsare; E-post: $a_sSenderEmail Namn: $a_sSenderName. Mottagare; E-post: $a_sEmail Namn: $a_sReceiverName.</p>";
        self::_queueMail($sBodyText, "BRF-tips", "info@svenskbrf.se", "andreas.karrfelt@svenskbrf.se", FALSE, NULL, $a_oBrf->getId(), NULL, NULL, NULL);
    }
    
    
    public static function processQueue($a_iCount = 5)
    {
        $aSenders = array(
            self::TYPE_EMAIL    => new Messaging_Sender_BRFMailer(),
            self::TYPE_SMS      => new Messaging_Sender_BRFSmser(),
        );
        $sTimestamp = date('Y-m-d H:i:s');
        self::$_oNoticeQueueSelector->setStatus(SvenskBRF_Notice::QUEUE_PENDING);
        self::$_oNoticeQueueSelector->setSearchParameter("send_on", $sTimestamp, Selector::CONDITION_LTE);
        self::$_oNoticeQueueSelector->limit($a_iCount);
        self::$_oNoticeQueueSelector->setOrderBy('queued_on ASC');
        $oNoticeQueue = self::$_oNoticeQueueAccessor->read(self::$_oNoticeQueueSelector);
        $iProcesssed = 0;
        foreach ($oNoticeQueue as $oQueue) {
            $oMsg = self::load($oQueue->getNotice());
            try {
                $aSenders[$oMsg->getNoticeTypeId()]->send($oMsg);
                $oMsg->setSent(TRUE);
                $oMsg->setSentOn($sTimestamp);
                $oQueue->setStatus(SvenskBRF_Notice::QUEUE_SENT);
            } catch (Messaging_SendException $oSendException) {
                $oMsg->setFailedOn($sTimestamp);
                $oQueue->setStatus(SvenskBRF_Notice::QUEUE_FAILED);
                $oQueue->setErrorMessage($oSendException->getErrorMessage());
                $oQueue->setErrorCode($oSendException->getErrorCode());
            }
            $iProcesssed++;
        }
        return $iProcesssed;
    }
 
    public static function queueBookingReminderMail(ResourceBooking $a_oResourceBooking)
    {
        $sTime = getResourceBookingTimeFormatMainViewSecondPartNoZeros($a_oResourceBooking);
        $sLink = BASE_DIR . 'avboka/' . $a_oResourceBooking->getUnbookCode();
        $sBookingText = <<<BOOKINGMAIL
<p>Hej!</p>
    
<p>Detta är en påminnelse om att du har bokat {$a_oResourceBooking->getResource()->getName()} i morgon kl $sTime!</p>
    
<p>Om du önskar avboka denna tid vänligen klicka på länken nedan. Klicka sedan på Avboka så kommer din tid avbokas och göras tillgänglig för en annan medlem i din förening!<p>

<a href=\"$sLink\">$sLink</a>
BOOKINGMAIL;
        
        // the night before
        $sSendOn = $a_oResourceBooking->getStart();
        $sSendOn = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($sSendOn)));
        if (TEST) {
            $sSendOn = NULL;
        }
        
        self::_queueMail(self::MAIL_TYPE_FROM_SVBRF, $sBookingText, "Påminnelse om din bokning av {$a_oResourceBooking->getResource()->getName()} i din förening", "info@svenskbrf.se", $a_oResourceBooking->getUser()->getEmail(), 
                FALSE, $sSendOn, 
                NULL, $a_oResourceBooking->getId(), 
                NULL, $a_oResourceBooking->getUser()->getId()
        );
    }
    
    public static function sendPasswordLink(SvenskBRF_User $a_oUser)
    {
        $sKey = $a_oUser->getPasswordLinkKey();
        $sPwdLink = BASE_DIR . 'nyttlosenord/' . $sKey;
        $sPasswordMail = <<<PWDMAIL
<p>Hej!</p>
    
<p>Klicka på länken nedan för att återställa ditt lösenord.</p>
    
<p><a href="$sPwdLink">$sPwdLink</a></p>
PWDMAIL;
        self::_queueMail(
                $sPasswordMail,
                "Byte av lösenord hos Svensk Brf",
                "info@svenskbrf.se", 
                $a_oUser->getEmail(), FALSE, NULL, NULL, NULL, NULL, $a_oUser->getId());
    }
    
    /**
     *
     * @param SvenskBRF_User $a_oNewUser
     * @param SvenskBRF_User $a_oParentUser
     * @param SvenskBRF_Brf $a_oBrf 
     */
    public static function sendOtherHouseholdMemberMail(SvenskBRF_User $a_oNewUser, SvenskBRF_User $a_oParentUser, SvenskBRF_Brf $a_oBrf)
    {
        self::sendMemberRegistrationMail($a_oNewUser);
    }
    
    /**
     * @param SvenskBRF_Brf $a_oBrf
     * @param SvenskBRF_BrfRealtorAd $a_oBrfRealtorAd
     */
    public static function sendRealtorAdMail(SvenskBRF_Brf $a_oBrf, SvenskBRF_BrfRealtorAd $a_oBrfRealtorAd)
    {
        foreach (SvenskBRF_User::getAllUsersByBrfId($a_oBrf->getId()) as $oMember) {
            if (!$oMember->getSetting(SvenskBRF_User::BLOCK_REALTOR_MESSAGE_SETTING_ID)) {
                $sLink = BASE_DIR . $a_oBrf->getUrl();
                $sRealtorAdMail = <<<REALTOR_AD_MAIL
<p>Hej {$oMember->getName()}!</p>

Nu finns en lägenhet till salu i din förening. Logga in på föreningens hemsida för att läsa mer!  

<p><a href="$sLink">$sLink</a></p>
    
<p>OBS! Hjälp gärna din granne genom att tipsa vänner och bekanta om lägenheten och om fördelarna med att bo i just din förening!</p>

<p>Med vänliga hälsningar, önskar</p>

<p>{$a_oBrf->getRealtorUser()->getName()}</p>
    
<p>{$a_oBrf->getRealtorUser()->getExternalPartner()->getPartnerName()}<br />
{$a_oBrf->getRealtorUser()->getEmail()}<br />
{$a_oBrf->getRealtorUser()->getCellphone()}<br />
</p>
<p style="font-size: small;">Om du i framtiden inte vill ta del av när en lägenhet i din förening är till salu så kan du gå in på din profil och klicka ur markeringen i rutan "Visa meddelanden från föreningens mäklare".</p>

REALTOR_AD_MAIL;

                self::_queueMail(self::MAIL_TYPE_FROM_REALTOR, $sRealtorAdMail, 'Nu är en lägenhet till salu i din förening', "info@svenskbrf.se", $oMember->getEmail(), FALSE, date('Y-m-d H:i:s'), $a_oBrf->getId(), NULL, NULL, $oMember->getId(), $a_oBrf->getRealtorUser()->getId());
            }
        }
    }

    /**
     * @param SvenskBRF_Brf $a_oBrf
     * @param SvenskBRF_BrfRealtorAd $a_oBrfRealtorAd
     */
    public static function sendRealtorAdSoldMail(SvenskBRF_Brf $a_oBrf, SvenskBRF_BrfRealtorAd $a_oBrfRealtorAd)
    {
        $sLink = BASE_DIR . $a_oBrf->getUrl() . '/maklare';

        // add if we have info?
        $sInfoText = "<p>Logga in på föreningens hemsida för att läsa mer!</p>\n\n<p><a href=\"$sLink\">$sLink</a></p>";
        
        foreach (SvenskBRF_User::getAllUsersByBrfId($a_oBrf->getId()) as $oMember) {
            if (!$oMember->getSetting(SvenskBRF_User::BLOCK_REALTOR_MESSAGE_SETTING_ID)) {
                $sRealtorAdMail = <<<REALTOR_SOLD_MAIL
<p>Hej {$oMember->getName()}!</p>

<p>Nu har en lägenhet i din förening sålts och du kommer inom kort att få en ny granne!</p>

<p>Om du är intresserad av att höra vad lägenheten såldes för eller undrar vad just din lägenhet är värd är du välkommen att höra av dig. Klicka på länken nedan för mer information eller för att skicka ett meddelande till mig.</p>

<p><a href="$sLink">$sLink</a></p>

<p>Med vänliga hälsningar</p>

<p>{$a_oBrf->getRealtorUser()->getName()}</p>
    
<p>{$a_oBrf->getRealtorUser()->getExternalPartner()->getPartnerName()}<br />
{$a_oBrf->getRealtorUser()->getEmail()}<br />
{$a_oBrf->getRealtorUser()->getCellphone()}<br />
</p>
<p style="font-size: small;">Om du i framtiden inte vill ta del av när en lägenhet i din förening är till salu så kan du gå in på din profil och klicka ur markeringen i rutan "Visa meddelanden från föreningens mäklare".</p>

REALTOR_SOLD_MAIL;

                self::_queueMail(self::MAIL_TYPE_FROM_REALTOR, $sRealtorAdMail, 'Nu har en lägenhet sålts i din förening!', "info@svenskbrf.se", $oMember->getEmail(), FALSE, date('Y-m-d H:i:s'), $a_oBrf->getId(), NULL, NULL, $oMember->getId(), $a_oBrf->getRealtorUser()->getId());
            }
        }
        
    }
}

?>
