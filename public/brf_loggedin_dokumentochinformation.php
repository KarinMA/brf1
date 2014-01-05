<script type="text/javascript">
    function getTemplate(file)
    {
        var docName = $("#dlform").find("input").eq(0);
        var downloadName = $("#dlform").find("input").eq(2);
        $(docName).val(file);
        $(downloadName).val('downloadtemplate');
        $("#dlform").submit();
        $(docName).val('');
        $(downloadName).val('downloaddocument');
        return false;
    }
</script>
<?php echo getHeaderPicture("Dokument, information", "och mallar", "bla_skylt", 0, 300); ?>
<br />
<br />
<br />
<br />
<br />
<br />
<p>
Här finner du dokument som är av intresse för dig som mäklare. Bland annat så finns informationsdokumentet om tjänsten som du kan skicka till styrelsen – kallad &quot;Kostnadsfri hemsida för föreningen!&quot;
</p>

<div id="dokument">
    <div id="vanster_lista">
        <h5>Dokument</h5>
        <div id="left1" style="width: 250px;">
            <ul>
                <li class="dokument1">Prislista</li>
                <li class="dokument1">Kom igång-guide</li>
            </ul>
        </div>
        <div id="mitt1">
            <ul>
                <li class="oppna"><a href="javascript:void(0)" onclick="$('#documentName').val('prislista.pdf'); $('#dlform').submit(); return false;">Spara</a></li>
                <li class="oppna"><a href="javascript:void(0)" onclick="$('#documentName').val('Komma_igang_guide.pdf'); $('#dlform').submit(); return false;">Spara</a></li>
            </ul>
        </div>
        <br />
        <h5>Information</h5>
        <div id="left1" style="width: 250px;">
            <ul>
                <li class="dokument1">Prislista</li>
                <li class="dokument1">Kom igång-guide</li>
            </ul>
        </div>
        <div id="mitt1">
            <ul>
                <li class="oppna"><a href="javascript:void(0)" onclick="$('#documentName').val('prislista.pdf'); $('#dlform').submit(); return false;">Spara</a></li>
                <li class="oppna"><a href="javascript:void(0)" onclick="$('#documentName').val('Komma_igang_guide.pdf'); $('#dlform').submit(); return false;">Spara</a></li>
            </ul>
        </div>
        <br />
        <h5>Mallar</h5>
        <div id="left1" style="width: 250px;">
            <ul>
                <li class="dokument1">Prislista</li>
                <li class="dokument1">Kom igång-guide</li>
            </ul>
        </div>
        <div id="mitt1">
            <ul>
                <li class="oppna"><a href="javascript:void(0)" onclick="$('#documentName').val('prislista.pdf'); $('#dlform').submit(); return false;">Spara</a></li>
                <li class="oppna"><a href="javascript:void(0)" onclick="$('#documentName').val('Komma_igang_guide.pdf'); $('#dlform').submit(); return false;">Spara</a></li>
            </ul>
        </div>
        <form method="post" action="<?php echo BASE_DIR; ?>ajax.php" id="dlform">
            <input type="hidden" name="action" value="downloadtemplate"/>
            <input type="hidden" name="documentName" value="" id="documentName"/>
        </form>
    </div>
</div>

