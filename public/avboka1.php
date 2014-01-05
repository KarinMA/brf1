<?php
include 'setup.php';
if (!$_REQUEST['code']) {
    exitForLocation();
}

$oRBS = getResourceBookingSelector();
$oRBS->setUnbookCode($_REQUEST['code']);
$oRBS->setSearchParameter('end', date('Y-m-d H:i:s'), Selector::CONDITION_GT);
$oResourceBooking = getResourceBookingAccessor()->readOne($oRBS);
$sMessage = "";
if (($oResourceBooking) && @$_POST['unbook']) {
    $oResourceBooking->delete();
    $sMessage = "Din tid är avbokad.";
} else if (!$oResourceBooking) {
    exitForLocation();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Svensk Brf - Avboka</title>
        <style>
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
                 border-radius: 10px;
                 -moz-border-radius:10px;  /* Firefox 3.6 and earlier */ 
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
            
            a img { border: none; }
            
        </style>
    </head>
    <body>
        <div id="wrapper">
            <a href="<?php echo BASE_DIR; ?>"><img src="<?php echo BASE_DIR; ?>media/img/logga_avboka.png" width="152" height="94" alt="logga" /></a>
            <div id="login_maklare">

                <h1 style="text-align:center;">Ta bort din bokning</h1>
                <?php if (!$sMessage): ?>
                <p style="margin:15px;">Är du säker på att du vill ta bort din bokning? Så fort du klickar på knappen försvinner din bokning ur systemet.</p>
                <form method="post">
                    <input style="margin:10px 0 20px 100px; width: 100px; height: 29px;" type="image" src="<?php echo BASE_DIR; ?>media/img/ta_bort.png" alt="Ta bort"/>
                    <input type="hidden" name="code" value="<?php echo @$_REQUEST['code']; ?>"/>
                    <input type="hidden" name="unbook" value="1"/>
                </form>
                <?php else: ?>
                <p style="margin:15px;"><?php echo $sMessage; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </body>
</html>
<?php include 'unsetup.php'; ?>
