<style type="text/css">.hidden {display:none;}</style>
<img id="bla_skylt" class="medlem" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/aktiveringskod.png" width="210" height="36" alt="medlemsidor" /> 
<p>Här skapar du en aktiveringslänk som du sedan kan kopiera och maila till en styrelsemedlem. Om de aktiverar sin förenings hemsida genom att klicka på länken du skickat kommer du att som mäklare automatiskt att bli kopplad till denna förening.

</p>
<form method="post" action="<?php echo BASE_DIR; ?>maklare/registreringskod" id="regForm" name="regForm">
    <div id="kol1" style="margin-top: 10px;">
        <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
        <p class="rubrik_form"><label for="tags">Skriv in namnet på föreningen du vill skicka en aktiveringslänk till. Välj förening i listan som visas.</label></p>
        <input id="tags" class="form_bredd" type="text" onblur="" style="width: 204px;"/>
        <p class="rubrik_form linkField"><label for="tags">Här skapas en länk som du kopierar och lägger in i det mail du skickar till den styrelsemedlem du har kontakt med.</label></p>
        <p></p>
        <p class="rubrik_form">Aktiveringslänk:</p>
        
        <textarea rows="2" cols="23" id="linkField" class="linkField" style=""></textarea>
        
        <script type="text/javascript">
            function autoComplete(request, response, url) {
                $.ajax({
                    url: '<?php echo BASE_DIR; ?>searchbrf.php',
                    data : {term : request.term, param : 'realtor'},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response($.map(data, function(item) {
                            return { 
                                label: item.name,
                                value: item.name
                            };
                        }));
                    }
                });
            }
            <?php $oUser = getUser(); ?>
            $(document).ready(function(){
                $("#tags").keyup(function(){
                    //$(".linkField").hide(); 
                });
                $("#tags").autocomplete({
                    source : autoComplete,
                    select : function(event, ui) {
                        $.post('<?php echo BASE_DIR; ?>ajax.php', { action : 'generaterealtorlink', 'brf' : /*$("#tags").val()*/ ui.item.label, userId : <?php echo $oUser->getId(); ?>}, function(response) {
                            if (response.result) {
                                $("#linkField").val(response.data.link);
                            }
                        }, 'json');
                        //$(".linkField").fadeIn();
                    },
                    close : function(event, ui) {

                    }
                });
            });
        </script>
    </div>

    <div id="kol2">
        <p></p>
        
    </div>
    
</form>
<script type="text/javascript" src="<?php echo BASE_DIR; ?>media/js/messi.min.js"></script>
<script type="text/javascript">
function showMessage(message, buttonText) {
        new Messi(
            message,
            {   
                title: 'Svensk Brf', 
                buttons: [{id: 0, label: buttonText, val: 'X'}]
                ,center : true
                //,modalOpacity : 2
            }
        );
    }
</script>
<link href="<?php echo BASE_DIR; ;?>media/js/messi.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    $("a.nav:contains('Skapa aktiveringslänk')").css('font-style', 'oblique');
</script>
