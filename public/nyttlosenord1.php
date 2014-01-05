<?php include 'setup.php'; ?>
<?php
$bError = FALSE;
$sErrorMessage = "";
$sMessage = "";

if (array_key_exists('skicka_x', $_POST) && array_key_exists('skicka_y', $_POST)) {
    // form posted
    if (strlen($_POST['password']) < 6) {
        $sErrorMessage = "Välj ett lösenord med minst 6 tecken.";
    } elseif ($_POST['password'] !== $_POST['confirmpassword']) {
        $sErrorMessage = "Lösenorden överensstämmer inte.";
    }
    if ($sErrorMessage) {
        $bError = TRUE;
    } else {
        // set the new password
        $oUser = SvenskBRF_User::getUserByPasswordKey($_REQUEST['key']);
        $oUser->setPassword($_POST['password']);
        $sMessage = 'Lösenordet har ändrats. Klicka <a href="' . BASE_DIR . $oUser->getBrf()->getUrl() . '">här</a> för att logga in. Ditt anvämndarnamn är ' . $oUser->getUsername();
    }
} else if (!@$_REQUEST['key']) {
    header('Location: ' . BASE_DIR);
    include 'unsetup.php';
    exit;
} else {
    if (!SvenskBRF_User::isValidPasswordKey($_REQUEST['key'])) {
        $sMessage = "Länken är ogiltig eller har gått ut. Återställ lösenordet <a href=\"" . BASE_DIR . 'glomtlosenord' . "\">här</a>.";
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>SvenskBrf.se - Byt lösenord</title>
        <style>
            #login_maklare { width: 300px;
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
                <h1 style="text-align:center;">Välj ditt nya lösenord</h1>
                <form style="margin-top:30px;" action="" method="post">
                    <label style="margin:45px; font-size:1.1em; line-height:1.3;" for="password">Nytt lösenord:</label> 
                    <br />
                    <input type="password" name="password" id="password" size="30" value="<?php if ($bError) echo @$_POST['password']; ?>" style="padding-left:20px; font-size:18px; font-weight:bold; width: 200px; margin-left:40px; height:40px; border:1px solid #d0cfcb;  border-radius: 10px;-moz-border-radius:10px;  /* Firefox 3.6 and earlier */"/> 
                    <br />
                    <br />
                    <br />
                    <label style="margin:45px; font-size:1.1em; line-height:1.3;" for="confirmpassword">Bekräfta lösenord:</label> 
                    <br />
                    <input type="password" name="confirmpassword" id="confirmpassword" size="30" value="<?php if ($bError) echo @$_POST['confirmpassword']; ?>" style="padding-left:20px; font-size:18px; font-weight:bold; width: 200px; margin-left:40px; height:40px; border:1px solid #d0cfcb;  border-radius: 10px;-moz-border-radius:10px;  /* Firefox 3.6 and earlier */"/> 
                    <br />
                    <br />
                    <input style="margin:10px 0 20px 40px;width:78px;height:28px;" name="skicka" type="image" src="<?php echo BASE_DIR; ?>media/img/skicka.png" alt="Skicka"/>
    <?php if ($bError): ?>
                        <p style="margin:0 15px 20px; 15px; color:red;"><?php echo $sErrorMessage; ?></p>
                    <?php endif; ?>
                    <?php if ($sMessage): ?>
                        <p style="margin:0 15px 20px; 15px;"><?php echo $sMessage; ?></p>
                    <?php endif; ?>
                    <input type="hidden" name="key" value="<?php echo @$_REQUEST['key']; ?>"/>
                </form>
            </div>
        </div>
    </body>
</html>
<?php include 'unsetup.php'; ?>
