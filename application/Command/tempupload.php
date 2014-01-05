<?php

class Command_tempupload extends Command 
{
    protected function _executeCommand() {
        $sFilePath = $this->_aRequest['number'];
        $sDestination = TMP_DIR . getUser()->getId() . '_' . $sFilePath;
        $iCounter = 0;
        do {
           sleep(1);
           $iCounter++;
           if ($iCounter > 5) {
               throw new CommandException("file not loaded!");
           }
        } while (!file_exists($sDestination));
        $sBase64 = base64_encode(file_get_contents($sDestination)); 
        $sImageData = 'data:' . $this->_aRequest['imageType'] . ';base64,' . $sBase64;
        return array('image' => $sImageData);
    }
}