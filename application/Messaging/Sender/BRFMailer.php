<?php

class Messaging_Sender_BRFMailer implements Messaging_SenderInterface {

    /**
     * The mail accounts.
     * 
     * @var array
     */
    private static $_aMailAddresses = array(
        'internt@svenskbrf.se' => 'urby3twx',
        'info@svenskbrf.se' => 'urby3twx',
        'kontakt@svenskbrf.se' => 'urby3twx',
    );

    /**
     * Default sender address if sender address isn't known.
     * 
     * @var string
     */

    const DEFAULT_USERNAME = 'info@svenskbrf.se';

    /**
     *
     * @var string 
     */
    const REPLY_TO_ADDRESS = 'kontakt@svenskbrf.se';

    /**
     *
     * @var Mail 
     */
    private $_oMailFactory;

    /**
     * 
     * var Mail
     */
    private $_oMime;

    /**
     * 
     * @var array
     */
    private $_aHeaders = array();

    /**
     * 
     * @var array
     */
    private $_aMimeParams = array();

  
    
    function _initMailSystem($a_sSender) {
        // PEAR Mail with MIME
        $oMail = new Mail();
        $sSender = array_key_exists($a_sSender, self::$_aMailAddresses) ? $a_sSender : self::DEFAULT_USERNAME;
        $this->_oMailFactory = @$oMail->factory('smtp', array(
                'host' => 'mailcluster.loopia.se',
                'port' => '587',
                'auth' => TRUE,
                'username' => $sSender,
                'password' => self::$_aMailAddresses[$sSender]
            )
        );


        // init header
        $this->_aHeaders['From'] = "Svensk Brf <$a_sSender>";
        $this->_aHeaders['Reply-To'] = $a_sSender == "maklare@svenskbrf.se" ? $a_sSender : self::REPLY_TO_ADDRESS;
        $this->_aHeaders['Date'] = date('r', time());

        // mime params
        $this->_aMimeParams['text_encoding'] = "7bit";
        $this->_aMimeParams['text_charset'] = "UTF-8";
        $this->_aMimeParams['html_charset'] = "UTF-8";
        $this->_oMime = new Mail_mime(array('eol' => "\n"));
    }
    
   
    function send(SvenskBRF_Notice $a_oMessage) {
        $this->_initMailSystem($a_oMessage->getSender());

        // need an error catcher here?
        $sEmail = $a_oMessage->getReceiver();
        $sMailHeader = $a_oMessage->getSubject();
        $sMailBody = $a_oMessage->getBody();
        if (($sHTMLBody = $a_oMessage->getBodyHTML())) {
            @$this->_oMime->setHTMLBody($sHTMLBody);
        }
        @$this->_oMime->setTXTBody(($sMailBody));

        // attachment(s)
        foreach ($a_oMessage->getNoticeAttachmentCollection() as $oAttachment) {
            $sAttachmentFile = $oAttachment->getAttachmentFile();
            $sAttachmentFileName = switchCharacters($oAttachment->getAttachmentFileName());
            if (!is_null($sAttachmentFile) && file_exists(($sAttachmentFile))) {
                @$this->_oMime->addAttachment($sAttachmentFile, "application/" . $oAttachment->getAttachmentFileType(), $sAttachmentFileName);
            }
        }

        $sBody = @$this->_oMime->get($this->_aMimeParams);


        $aHeaders = @$this->_oMime->headers(array_merge($this->_aHeaders, array(
                            'Subject' => utf8_decode($sMailHeader),
                            'To' => $sEmail
        )));

        try {
            $mResult = @$this->_oMailFactory->send($sEmail, $aHeaders, $sBody);
            if (is_bool($mResult) && $mResult === FALSE) {
                throw new Messaging_SendException("PEAR Mail returned FALSE");
            } else if (is_object($mResult) && get_class($mResult) === 'PEAR_Error') {
                throw new Messaging_SendException(@$mResult->getMessage(), @$mResult->getCode());
            } else if (!is_bool($mResult)) {
                throw new Messaging_SendException("Unknown error: " . serialize($mResult));
            }
            return TRUE;
        } catch (Exception $oException) {
            throw new Messaging_SendException("Mail error: " . $oException->getMessage());
        }
    }

}