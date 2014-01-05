<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Registrering, SvenskBrf.se</title>
        <link href="<?php echo BASE_DIR; ;?>media/registrering.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-1.9.1.min.js"></script>
    </head>

    <body>
        <form method="post" action="<?php echo BASE_DIR; ?>registrera/3">
            <div id="wrapper" style="min-height:1250px;">
                <?php
                    if ($oBrf->getActivated()): 
                        include './brf_registrera_2_activated.php';
                    else:
                        include './brf_registrera_2_inactive.php';
                    endif;
                ?>
                <div id="right">
                    <img class="hoger_bild" src="<?php echo BASE_DIR; ?>media/registrera/img/hoger_bild8.png" width="451" height="564" />
                </div>
            </div>
            <input type="hidden" name="step" value="<?php echo $iStep; ?>"/>
        </form>
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php">
            <input type="hidden" name="action" value="getuserpdfs"/>
            <input type="hidden" name="brfId" value="<?php echo $oBrf->getId(); ?>"/>
        </form>
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php">
            <input type="hidden" name="action" value="getuserpdfsmultiple"/>
            <input type="hidden" name="brfId" value="<?php echo $oBrf->getId(); ?>"/>
        </form>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#getPdf").click(function(){
                   //alert('Kommer snart...');
                   //return false;
                   document.forms[1].submit();
                   return false;
                });
                $("#getZip").click(function(){
                   //alert('Kommer snart...');
                   //return false;
                   document.forms[2].submit();
                   return false;
                });
            });
        </script>
    </body>
</html>
