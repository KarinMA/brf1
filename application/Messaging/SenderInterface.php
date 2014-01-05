<?php

/**
 * An interface for senders.
 * 
 * @author John
 *
 */
interface Messaging_SenderInterface
{
    function send(SvenskBRF_Notice $a_oNotice);
}