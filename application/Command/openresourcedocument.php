<?php

/**
 * Description of openresourcedocument
 *
 * @author John Jansson
 */
class Command_openresourcedocument extends Command_downloadresourcedocument 
{
    /**
     * Try to open the document right away.
     * 
     * @return boolean
     */
    public function isView()
    {
        return TRUE;
    }
}

?>
