<?php
    $sAdminView = @$_REQUEST['view'] ? $_REQUEST['view'] : 'startpage';
    if (@$_REQUEST['view']!=='svenskbrflosenord' && !@$_REQUEST['svenskbrflosenord'] && !@$_SESSION[ADMIN]) {
        exitForLocation();
    } else if ($_REQUEST['view'] == 'svenskbrflosenord') {
        $sAdminView = 'startpage';
    }
    $_SESSION[ADMIN] = 1;
    switch ($sAction) {
        case 'create':
            getStartpageAccessor()->createNew($_REQUEST['name'], $_REQUEST['description'], trim($_REQUEST['content']), $_REQUEST['type'], $_REQUEST['category'], getUser()->getId(), date('Y-m-d H:i:s'));
            break;
        case 'edit':
            foreach ($_POST['content'] as $sContentPieceName => $sContent) {
                $oContentPiece = getStartpageAccessor()->getStartPageByName($sContentPieceName);
                $oContentPiece->setContent(trim($sContent));
            }
            break;
        default:
            break;
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="<?php echo BASE_DIR; ?>media/stil3.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <style type="text/css">
            .active_category {text-decoration: underline;}
        </style>
        <title>SvenskBrf.se - admin</title>
    </head>
    <body>
        
        <?php 
            $aViews = array(
                'startpage' => 'Texter startsida',
            );
        ?>
        <?php foreach ($aViews as $sView => $sViewDescription): ?>
        <a href="<?php echo BASE_DIR; ?>admin/<?php echo $sView; ?>" style="<?php if ($sAdminView === $sView) echo 'color:red;' ?>"><?php echo $sViewDescription; ?></a>&nbsp;
        <?php endforeach; ?>
        <br />
        <br />
        <?php 
            $sCategoryToShow = @$_REQUEST['category'] ? $_REQUEST['category'] : 'all';
        ?>
        Visa: <a href="#" class="category active_category" onclick="$('.content').show(); $('#edit_categories').val('all'); $('.category').removeClass('active_category'); $(this).addClass('active_category');" style="color:blue;">Alla</a>
        <?php 
            include 'admin_' . $sAdminView . '_categories.php';
        ?>
        <?php foreach ($aCategories as $sCategory => $sCategoryDescription): ?>
        , <a href="#" class="category" id="view_category_<?php echo $sCategory; ?>" onclick="$('.<?php echo $sCategory; ?>').show();$('.content').not('.<?php echo $sCategory; ?>').hide(); $('#edit_categories').val('<?php echo $sCategory; ?>'); $('.category').removeClass('active_category'); $(this).addClass('active_category');" style="color:blue;"><?php echo $sCategoryDescription; ?></a>
        <?php if ($sCategoryToShow === $sCategory): ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#view_category_<?php echo $sCategory; ?>').click();
            });
        </script>
        <?php endif; ?>
        <?php endforeach; ?>
        <br />
        <form action="index.php?admin=1&view=<?php echo $sAdminView; ?>" method="post" name="content_form">
            <input type="hidden" name="action" value="edit" />
            <input type="hidden" name="category" value="<?php echo $sCategoryToShow; ?>" id="edit_categories"/>
            <?php
                $oStartPageSelector = getStartpageSelector();
                $oStartPageSelector->setSearchParameter('category', array_keys($aCategories), Selector::CONDITION_IN);
                $oContentCollection = getStartpageAccessor()->read($oStartPageSelector);
                foreach ($oContentCollection as $oContentPiece):
            ?>

            <?php if ('text' === $oContentPiece->getContentType()): ?>
            <?php if (FALSE && $oContentPiece->getCategory() === 'services' && !preg_match("/intro/", $oContentPiece->getName())): ?>
            
            <div class="content <?php echo $oContentPiece->getCategory(); ?>">
                <br />
                <input type="text" name="content[<?php echo $oContentPiece->getName().'_header'; ?>]" value="<?php echo getStartpageAccessor()->getStartpageByName($oContentPiece->getName().'_header')->getContent(); ?>" size="140"/>
                <span><?php echo getStartpageAccessor()->getStartpageByName($oContentPiece->getName().'_header')->getDescription(); ?></span>
            </div>
            <?php else: ?>
            <br />
            <?php endif; ?>
            
            <div class="content <?php echo $oContentPiece->getCategory(); ?>">
                
                <span><?php echo $oContentPiece->getDescription(); ?></span>
                <br />
                <textarea rows="<?php echo ceil(strlen($oContentPiece->getContent())/100) * 2; ?>" cols="60" name="content[<?php echo $oContentPiece->getName(); ?>]"><?php echo $oContentPiece->getContent(); ?></textarea>
                <br />
            </div>
            
            <?php else: ?>
            
            <div class="content <?php echo $oContentPiece->getCategory(); ?>">
                <br />
                <input type="text" name="content[<?php echo $oContentPiece->getName(); ?>]" value="<?php echo $oContentPiece->getContent(); ?>" size="140"/>
                <span><?php echo $oContentPiece->getDescription(); ?></span>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
            <input type="hidden" name="svenskbrflosenord" value="1"/>
            <button type="submit" name="action" value="edit" onclick="if (confirm('Är du säker på att du vill spara ändringar?')) {document.forms.content_form.setAttribute('target','_self');return true; } else { return false; }">Spara</button>&nbsp;
            <button type="submit" name="action" value="test_<?php echo $sAdminView; ?>" onclick="document.forms.content_form.setAttribute('target','_blank');return true;">Testa</button>
            <input type="hidden"  name="<?php echo $sAdminView;?>" value="1" />
        </form>
        
        <?php if (0): ?>
        <hr />
        <form action="index.php?admin=1&view=startpage" method="post">
            <input type="hidden" name="action" value="create" />
            name<input type="text" name="name"/>
            <br />
            desc<input type="text" name="description"/>
            <br />
            type<input type="text" name="type"/>
            <br />
            cate<input type="text" name="category"/>
            <br />
            cont<textarea name="content"></textarea>
            
            <input type="submit" value="Skapa" />
        </form>
        <?php endif; ?>
    </body>
</html>