<?php include 'setup.php'; ?>
<?php
    $bError = FALSE;
    $sMessage = "";

    // form sent
    if (array_key_exists('skicka_x', $_POST) && array_key_exists('skicka_y', $_POST) && trim($_POST['email'])) {
        $sEmail = trim($_POST['email']);
        $oUsers = getUserAccessor()->getUsersByEmail($sEmail);
        if ($oUsers->size()) {
            SvenskBRF_Notice::sendPasswordLink(SvenskBRF_User::load($oUsers->current()));
            $sMessage = "Ett mail har skickats till " . $oUsers->current()->getEmail() . ".";
        } else {
            $bError = TRUE;
        }
    }
    

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>SvenskBrf.se - Glömt lösenord</title>
        <style type="text/css">
            #login_maklare { width: 500px;
                             max-height:400px;
                             margin:auto;
                             margin-top:100px;

                             background-color:#FFF;
                             border-top: 2px solid #d0cfcb;
                             border-left:1px solid #d0cfcb;
                             border-right:1px solid #d0cfcb;
                             border-bottom:1px solid #d0cfcb;
                             border-radius: 10px;
                             -moz-border-radius:10px;  /* Firefox 3.6 and earlier */ }

            body { background-color:#f3f2ec;
                   font-family:'Open Sans', sans-serif;
                   font-size: 62.5%;}

            a {color:#09F;}
            a img { border: none; }
            
             #wrapper {
                margin:auto;
                  width:300px;
                  padding-top: 100px;
            }

        </style>
    </head>

    <body>
        <div id="wrapper">
            <a href="<?php echo BASE_DIR; ?>"><img src="<?php echo BASE_DIR; ?>media/img/SvenskaBrf_logga_1.png" width="150" height="60" alt="logga" /></a>
            <div id="login_maklare">
                <h1 style="text-align:center;">Fyll i din e-postadress</h1>
                <p style="margin:0 15px 0 15px;">Fyll i den e-postadress du använde när du registrerade dig. Vi skickar genast en länk till dig så att du kan välja ett nytt lösenord.</p>
                <form style="margin-top:30px;" action="" method="post">
                    <label style="margin:45px; font-size:1.1em; line-height:1.3;" for="subject">Din epost-adress:</label> 
                    <br />
                    <input type="text" name="email" id="email" size="60" value="<?php if ($bError) echo $_POST['email']; ?>" style="padding-left:20px; font-size:18px; font-weight:bold; width: 400px; margin-left:40px; height:40px; border:1px solid #d0cfcb;  border-radius: 10px; -moz-border-radius:10px;  /* Firefox 3.6 and earlier */"/> 

                    <br />

                    <br />

                    <input style="margin:10px 0 20px 40px; width:78px;height: 28px;" type="image" name="skicka" src="<?php echo BASE_DIR; ?>media/img/skicka.png" alt="Skicka"/>
                </form>
                <?php if ($bError): ?>
                <p style="margin:0 15px 20px; 15px; color:red;">E-postadressen hittades inte. Kontakta oss på <a href="mailto:kontakt@svenskbrf.se">kontakt@svenskbrf.se</a></p>
                <?php endif; ?>
                <?php if ($sMessage): ?>
                <p style="margin:0 15px 20px; 15px;"><?php echo $sMessage; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </body>
</html>
<?php include 'unsetup.php'; ?>