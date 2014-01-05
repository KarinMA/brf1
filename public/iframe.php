<?php include 'setup.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                document.domain = '<?php $sDomain = str_replace(array("https://","http://"),array('',''),BASE_DIR); $sDomain = substr($sDomain, 0, strlen($sDomain) - 1); echo $sDomain; ?>';
                //return true;
            });
        </script>
    </head>
    <body><?php echo @$_SESSION['imgType']; ?></body>
</html>
<?php include 'unsetup.php'; ?>
