<?php
include 'setup.php';

$sError = "";
if (@$_POST['submit']) {
   if (!mysql_query("UPDATE {$_POST['tabell']} SET {$_POST['kolumn']} = '{$_POST['varde']}' WHERE id = {$_POST['id']} LIMIT 1")) {
       $sError = mysql_error();
   }
}

include 'unsetup.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
        <form method="post" action="">
            id: <input type="text" name="id" value="<?php echo @$_REQUEST['id']; ?>"/>
            <br />
            tabell: <input type="text" name="tabell" value="<?php echo @$_REQUEST['tabell']; ?>"/>
            <br />
            kolumn: <input type="text" name="kolumn" value=""/>
            <br />
            värde: <textarea name="varde" cols="60" rows="10"></textarea>
            <br />
            <input type="submit" name="submit" value="spara"/>
            <br />
            <?php echo $sError; ?>
        </form>
    </body>
</html>