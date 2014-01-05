<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Command_togglereminder
 *
 * @author John Jansson
 */
class Command_togglereminder extends Command {
    protected function _executeCommand() {
        $oBooking = getResourceBookingAccessor()->getById($this->_aRequest['id']);
        if (!$oBooking) {
            throw new CommandException("Booking not found!");
        }
        $sMethodName = 'set' . $this->_aRequest['remindertype'].'Reminder';
        if (method_exists($oBooking, $sMethodName)) {
            $bRemind = (bool) $this->_aRequest['remind'];
            // set property in resource booking
            call_user_func_array(array($oBooking, $sMethodName), array($bRemind));
            
            if (!$bRemind) {
                $iNoticeType = $this->_getQueueType($this->_aRequest['remindertype']);
                $oNoticeSelector = getNoticeSelector();
                $oNoticeSelector->setResourceBookingId($oBooking->getId());
                $oNoticeSelector->setNoticeTypeId($iNoticeType);
                foreach (getNoticeAccessor()->read($oNoticeSelector) as $oNotice) {
                    $oNotice->delete();
                }
            } else {
                // add
                call_user_func_array(array('SvenskBRF_Notice', 'queueBookingReminder'.$this->_aRequest['remindertype']), array($oBooking));
            }
        } else {
            throw new CommandException("Couldnt set reminder!");
        }
        return 1;
    }
    
    private function _getQueueType($a_sReminderType) {
        return ($a_sReminderType == 'Sms') ? SvenskBRF_Notice::TYPE_SMS : SvenskBRF_Notice::TYPE_EMAIL;
    }
}

?>
