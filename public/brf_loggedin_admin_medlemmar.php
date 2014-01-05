<script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/messi.min.js"></script>
<link href="<?php echo BASE_DIR; ;?>media/js/messi.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
/**
 * @param {type} message
 * @param {type} buttonText
 * @returns {undefined}
 */
function showMessage(message, buttonText) {
    new Messi(
        message,
        {   
            title: 'Svensk Brf', 
            buttons: [{id: 0, label: buttonText, val: 'X'}]
            ,center : true
        }
    );
}
</script>
<?php
    $sMemberJsAction = "";
    $iNewMemberId = NULL;
    $iRemovedMemberId = NULL;
    $oRemovedBoardMember = NULL;
    switch ($sAction) {
        case 'numberofapartments':
            if (is_numeric($_POST['apartments']) && $_POST['apartments'] > 0) {
                $sJsAction = "showMessage('Antal lägenheter ändrades från " . $oBrf->getApartments() . " till " . $_POST['apartments'] . ".', 'OK');";
                $oBrf->setApartments($_POST['apartments']);
            }
            break;
        case 'removemember': 
            getUserAccessor()->getById($_POST['remove'])->delete();
            $iRemovedMemberId = $_POST['remove'];
            break;
        case 'addmember':
            $sPassword = SvenskBRF_User::generatePassword();
            $oNewMember = SvenskBRF_User::saveUser(array(
                'BrfId' => $oBrf->getId(),
                'Presentation' => '',
                'Age' => NULL,
                'LivesWith' => NULL,
                'Username' => array($oBrf->getUrl(), $oBrf->getUrl()),
                'Password' => array($sPassword, $sPassword),
                'Email' => array('',''),
                'Firstname' => '',
                'Surname' => '',
                'ApartmentNumber' => '',
                'ApartmentNumber2' => '',
                'Phone' => '',
                'HidePhone' => 0,
                'TitleId' => NULL,
                'OwnTitle' => NULL,
                'AddressId' => NULL,
                'Floor' => NULL,
            ), array());
            // generate new pdf with $oNewMember
            $iNewMemberId = $oNewMember->getId();
            $sMemberJsAction = "$('#totalMembers').text(parseInt($('#totalMembers').text())+1); document.forms['getmemberpdf'].submit();";
            break;
        case 'removeboardmember':
            $oEditBoardMember = SvenskBRF_User::loadById($_POST['userId']);
            $oEditBoardMember->setUserTitleId(5); // medlem
            $oRemovedBoardMember = $oEditBoardMember;
            break;
        case 'addboardmember':
            $oAddedBoardMember = NULL;
            if ($_POST['userId'] && $_POST['userTitleId']) {
                $oEditBoardMember = SvenskBRF_User::loadById($_POST['userId']);
                $oEditBoardMember->setUserTitleId($_POST['userTitleId']);
                $oEditBoardMember->setUserTitle(getUserTitleAccessor()->getById($_POST['userTitleId'])); // medlem
                $oAddedBoardMember = $oEditBoardMember;
            }
            break;
    }
?>
<img id="bla_skylt" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/styrelseadmin.png" width="210" height="36" alt="styrelseadmin"/>
<p>Här hanterar ni antal lägenheter och medlemsadministrationen.</p>
<style type="text/css">
    li {list-style-type: none; }
</style>
<div id="styrelseadmin">
    <table style="width:400px;" cellspacing="0">
        <tr>
            <td style="background-color:#fff;" align="left">
                <h2 align="left">Antal lägenheter inklusive hyreslägenheter</h2>
            </td>
        </tr>
        <tr>
            <td style="background-color:#fff;" align="left">
                <p align="left">Här kan ni ändra antalet lägenheter. T.ex. om föreningen bygger till lägenheter på vinden eller liknande.</p>
            </td>
        </tr>
        
        <tr>
            <td style="background-color:#fff;">
                <form method="post" action="">
                    <input type="text" size="2" name="apartments" value="<?php echo $oBrf->getApartments(); ?>"/>
                    <input type="hidden" name="action" value="numberofapartments"/>
                    <br />
                    <input name="save" type="image" align="left" src="<?php echo BASE_DIR; ?>media/inloggad/img/spara.png" style="width:78px;height:28px;border:0;"/>
                </form>
            </td>
        </tr>
        <?php if ($oBrf->hasUnregisteredMembers()): ?>
        <?php
            $iRegisteredMembers = 0;;
            $iTotalMembers = 0;
        ?>
        <tr>
            <td style="background-color:#fff;" align="left">
                <h2 align="left">Dessa medlemmar är registrerade&nbsp;<span id="membersRegisterered"></span></h2>
            </td>
        </tr>
        <tr>
            <td style="background-color:#fff;">
                <ul>
                    <?php foreach (SvenskBRF_User::getAllUsersByBrfId($oBrf->getId()) as $oMember): ?>
                    <?php
                        if ($oMember->isMember() && $oMember->getId() != $iRemovedMemberId) {
                            $iTotalMembers++;
                            if ($oMember->isRegistered()) {
                                $iRegisteredMembers++;
                            }
                        }
                    ?>
                    <?php if ($oMember->isMember() && $oMember->isRegistered()): ?>
                    <li><?php echo $oMember->getName(); ?><?php if ($oMember->getApartmentNumber()): ?> (<?php echo $oMember->getApartmentNumber(); ?>)<?php endif; ?></li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </td>
        </tr>
        <?php endif; ?>
        <tr>
            <td style="background-color:#fff;" align="left">
                <h2 align="left">Ta bort medlem</h2>
            </td>
        </tr>
        <tr>
            <td style="background-color:#fff;" align="left">
                <p align="left">Här kan ni radera en medlem. Tex när någon flyttar från föreningen.</p>
            </td>
        </tr>
        <tr>
            <td style="background-color:#fff;">
                <form method="post" action="">
                    <select name="remove">
                        <option value="">Välj...</option>
                        <?php $oMembers = SvenskBRF_User::getUsersByBrfId($oBrf->getId()); ?>
                        <?php foreach ($oMembers as $oMember): ?>
                        <?php if ($oMember->isMember() && $oMember->isRegistered() && $iRemovedMemberId != $oMember->getId()): ?>
                        <option value="<?php echo $oMember->getId(); ?>"><?php echo $oMember->getName(); ?><?php if ($oMember->getApartmentNumber()): ?> (<?php echo $oMember->getApartmentNumber(); ?>)<?php endif; ?></option>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="action" value="removemember"/>
                    <br />
                    <input name="save" type="image" align="left" src="<?php echo BASE_DIR; ?>media/inloggad/img/ta_bort2.png" style="border:0;" onclick="return confirm('Är du säker på att medlemmen ska tas bort?');"/>
                </form>
            </td>
        </tr>
        <tr>
            <td style="background-color:#fff;" align="left">
                <h2 align="left">Lägg till medlem</h2>
            </td>
        </tr>
        <tr>
            <td style="background-color:#fff;" align="left">
                <p align="left">Här hämtar ni ett pdf dokument med ett nytt lösenord för nya medlemmar.</p>
            </td>
        </tr>
        <tr>
            <td style="background-color:#fff;">
                <form method="post" action="">
                    <input type="hidden" name="action" value="addmember"/>
                    <br />
                    <input name="save" type="image" align="left" src="<?php echo BASE_DIR; ?>media/inloggad/img/Lagg_till.png" style="border:0;"/>
                </form>
            </td>
        </tr>
        
        <?php $oBoardMembers = $oBrf->getBoardMembers(); ?>
        <?php if ($oBoardMembers->size() || isset($oAddedBoardMember)): ?>
        <tr>
            <td style="background-color:#fff;" align="left">
                <h2 align="left">Styrelsemedlemmar</h2>
            </td>
        </tr>
        
        <?php foreach ($oBoardMembers as $oBoardMember): ?>
        <?php if (!isset($oRemovedBoardMember) || ($oBoardMember->getId() != $oRemovedBoardMember->getId())): ?>
        <?php if($oBoardMember->getId() != $iRemovedMemberId): ?>
        <tr>
            <td style="background-color:#fff;">
                <form method="post" action="">
                    <?php echo $oBoardMember->getName(); ?><?php if ($oBoardMember->getFloor()): ?>, våning <?php echo $oBoardMember->getFloor(); ?><?php endif; ?><?php echo ", " . $oBoardMember->getUserTitle()->getTitleName(); ?>                    
                    <input type="hidden" name="action" value="removeboardmember"/>
                    <input type="hidden" name="userId" value="<?php echo $oBoardMember->getId(); ?>"/>
                    &nbsp; 
                    <input name="save" type="image" align="right" src="<?php echo BASE_DIR; ?>media/inloggad/img/ta_bort2.png" style="border:0;  margin-top: -5px;" onclick="return confirm('Är du säker på att du vill ta bort denna medlem ur styrelsen?');"/>
                </form>
            </td>
        </tr>
        <?php endif; ?>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php if (isset($oAddedBoardMember)): ?>
        <tr>
            <td style="background-color:#fff;">
                <form method="post" action="">
                    <?php echo $oAddedBoardMember->getName(); ?><?php if ($oAddedBoardMember->getFloor()): ?>, våning <?php echo $oAddedBoardMember->getFloor(); ?><?php endif; ?><?php echo ", " . $oAddedBoardMember->getUserTitle()->getTitleName(); ?>                    
                    <input type="hidden" name="action" value="removeboardmember"/>
                    <input type="hidden" name="userId" value="<?php echo $oAddedBoardMember->getId(); ?>"/>
                    &nbsp; 
                    <input name="save" type="image" align="right" src="<?php echo BASE_DIR; ?>media/inloggad/img/ta_bort2.png" style="border:0;  margin-top: -5px;" onclick="return confirm('Är du säker på att du vill ta bort denna medlem ur styrelsen?');"/>
                </form>
            </td>
        </tr>
        <?php endif; ?>
        <?php endif; ?>
        
        <tr>
            <td style="background-color:#fff;" align="left">
                <h2 align="left">Lägg till styrelsemedlem</h2>
            </td>
        </tr>
        
        <tr>
            <td style="background-color:#fff;">
                <form method="post" action="">
                    Medlem
                    <select name="userId" style="margin-left: 20px;">
                        <option value="">Välj...</option>
                        <?php foreach ($oMembers as $oMember): ?>
                        <?php if ($iRemovedMemberId != $oMember->getId() && !$oMember->isBoardMember() || (isset($oRemovedBoardMember) && $oRemovedBoardMember->getId() == $oMember->getId())): ?>
                        <option value="<?php echo $oMember->getId(); ?>"><?php echo $oMember->getName(); if ($oMember->getFloor()) echo ', våning ' . $oMember->getFloor(); ?></option>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <br/>
                    Roll
                    
                    <select name="userTitleId" style="margin-left: 40px;">
                        <option value="">Välj...</option>
                        <option value="1">Ordförande</option>
                        <option value="2">Styrelseledamot</option>
                        <option value="3">Suppleant</option>
                        <option value="4">Sekreterare</option>
                    </select>
                    <br />
                    <br />
                    <input name="save" type="image" align="left" src="<?php echo BASE_DIR; ?>media/inloggad/img/Lagg_till.png" style="border:0;"/>
                    <input type="hidden" name="action" value="addboardmember"/>
        
                </form>    
            </td>
        </tr>
        
        
    </table>
</div>
<form action="<?php echo BASE_DIR; ?>ajax.php" method="post" name="getmemberpdf">
    <input type="hidden" name="action" value="newmemberpdf"/>
    <input type="hidden" name="userId" value="<?php echo $iNewMemberId; ?>"/>
    <input type="hidden" name="brfId" value="<?php echo $oBrf->getId(); ?>"/>
</form>
<script type="text/javascript">
<?php if ($oBrf->hasUnregisteredMembers()): ?>
$(document).ready(function(){
   $("#membersRegisterered").html("(<?php echo $iRegisteredMembers; ?>/<span id=\"totalMembers\"><?php echo $iTotalMembers; ?></span>)"); 
   
   <?php echo $sMemberJsAction; ?>
});  
<?php endif; ?>
</script>
<script type="text/javascript">
    $("a.nav:contains('Medlemsadministration')").css('font-style', 'oblique');
</script>