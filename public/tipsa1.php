<?php include 'setup.php'; ?>
<?php
    $oBrf = SvenskBRF_Brf::loadByUrl(@$_REQUEST['brf']);
    if (!$oBrf) {
        exitForLocation();
    }
    
    $aFields = array('receiverName', 'senderName', 'senderEmail', 'email');
    
    $aFieldErrors = array();
    if (@$_POST['submit']) {
        $bValid = TRUE;
        // check fields
        foreach ($aFields as $sField) {
            if (!$_POST[$sField]) {
                $aFieldErrors[] = $sField;
                $bValid = FALSE;
            }
        }
        if ($bValid) {
            SvenskBRF_Notice::tip($oBrf, $_REQUEST['senderName'], $_REQUEST['receiverName'], $_REQUEST['email'], $_REQUEST['senderEmail']);
            exitForLocation($oBrf->getUrl());
        }
        
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Svensk Brf | Tipsa din förening!</title>
        <style type="text/Css">
            #login_maklare {
                 width: 300px;
                 max-height:500px;
                 margin:auto;
                 margin-top:0px;
                 background-color:#FFF;
                 border-top: 2px solid #d0cfcb;
                 border-left:1px solid #d0cfcb;
                 border-right:1px solid #d0cfcb;
                 border-bottom:1px solid #d0cfcb;
                 border-radius: 10px; -moz-border-radius:10px;  /* Firefox 3.6 and earlier */ 
            }

            body { 
                background-color:#f3f2ec;
                font-family:'Open Sans', sans-serif;
                font-size: 62.5%;
            }

            #wrapper {
                width: 340px;
                margin:auto;
                margin-top:30px;
            }

            a {
                color:#09F;
            }
            
            a img {
                border: none;
            }

        </style>
    </head>

    <body>
        <div id="wrapper">
            <a href="<?php echo BASE_DIR; ?>"><img src="<?php echo BASE_DIR; ?>media/img/logga.png" width="152" height="94" alt="logga" /></a>
            <div id="login_maklare">

                <h1 style="text-align:center;">Tipsa din förening</h1>
                <form style="margin-top:30px;" method="post" action="">
                    <label style="margin:45px; font-size:1.1em; line-height:1.3;" for="senderName">Ditt namn:</label> 
                    <br />
                    <input type="text" name="senderName" id="senderName" size="30" value="<?php echo @$_POST['senderName']; ?>" style="<?php if (in_array('senderName', $aFieldErrors)): ?>background-color:red;<?php endif; ?>padding-left:20px; font-size:18px; font-weight:bold; width: 200px; margin-left:40px; height:40px; border:1px solid #d0cfcb;  border-radius: 10px; -moz-border-radius:10px;  /* Firefox 3.6 and earlier */"/> 
                    <br />
                    <br />
                    <br />
                    <label style="margin:45px; font-size:1.1em; line-height:1.3;" for="cellphone">Din e-postadress:</label> 
                    <br /> 
                   <input type="text" name="senderEmail" id="cellphone" size="30" value="<?php echo @$_POST['senderEmail']; ?>" style="<?php if (in_array('senderEmail', $aFieldErrors)): ?>background-color:red;<?php endif; ?>padding-left:20px; font-size:18px; font-weight:bold; width: 200px; margin-left:40px; height:40px; border:1px solid #d0cfcb;  border-radius: 10px; -moz-border-radius:10px;  /* Firefox 3.6 and earlier */"/> 
                    <br />
                    <br />
                    <br />
                    <label style="margin:45px; font-size:1.1em; line-height:1.3;" for="receiverName">Mottagarens namn:</label> 
                    <br />
                    <input value="<?php echo @$_POST['receiverName']; ?>" type="text" name="receiverName" id="receiverName" size="30" style="<?php if (in_array('receiverName', $aFieldErrors)): ?>background-color:red;<?php endif; ?>padding-left:20px; font-size:18px; font-weight:bold; width: 200px; margin-left:40px; height:40px; border:1px solid #d0cfcb;  border-radius: 10px; -moz-border-radius:10px;  /* Firefox 3.6 and earlier */"/> 
                    <br />
                    <br />
                    <br />
                    <label style="margin:45px; font-size:1.1em; line-height:1.3;" for="email">Mottagerens e-postadress:</label> 
                    <br />
                    <input type="text" name="email" id="email" size="30" value="<?php echo @$_POST['email']; ?>" style="<?php if (in_array('email', $aFieldErrors)): ?>background-color:red;<?php endif; ?>padding-left:20px; font-size:18px; font-weight:bold; width: 200px; margin-left:40px; height:40px; border:1px solid #d0cfcb;  border-radius: 10px; -moz-border-radius:10px;  /* Firefox 3.6 and earlier */"/> 
                    <br/> 
                    <br/> 
                    <br/>
                    <input style="margin:10px 0 20px 40px;" type="image" src="<?php echo BASE_DIR; ?>media/img/skicka100x29.png" width="100" height="29" alt="skicka"/>
                    <input type="hidden" name="submit" value="1"/>
                    <input type="hidden" name="brf" value="<?php echo $oBrf->getUrl(); ?>"/>
                </form>
            </div>
        </div>
    </body>
</html>
<?php include 'unsetup.php'; ?>