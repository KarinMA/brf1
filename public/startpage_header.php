<div id="header">
                <div>
                    <p class="sok"><?php echo $aStartPageContent['search_header']; ?></p>
                    <form onsubmit="if (responseBrf != null) document.location.href = responseBrf; return false;">
                        <label> 
                            <!--placeholder="Föreningsnamn"-->
                            <input type="text" id="sok" name="search_brf" class="sok_margin" placeholder="Föreningsnamn" value=""/>
                        </label>
                    </form>
                </div>

                <a href="<?php echo BASE_DIR; ?>"><img id="logga" src="<?php echo BASE_DIR; ?>media/start/img/logga.png" width="248" height="85" alt="logga" /></a>
                <p><?php echo $aStartPageContent['logo_tagline']; ?></p>

                <ul class="huvudmeny">
                    <li class="meny"><a href="<?php echo BASE_DIR; ?>#content">Hem</a></li>
                    <li class="meny"><a href="<?php echo BASE_DIR; ?>#om_oss">Om oss</a></li>
                    <li class="meny"><a href="<?php echo BASE_DIR; ?>#aktivera">Kom igång</a></li>
                    <li class="meny"><a href="<?php echo BASE_DIR; ?>#kontakt">Kontakt</a></li>
                    <li class="meny"><a href="<?php echo BASE_DIR; ?>lar_dig_mer">Lär dig mer</a></li>
                    <li class="meny"><a href="<?php echo BASE_DIR; ?>for_maklare">För mäklare</a></li>
                    <?php if (!isLoggedIn()): ?>
                    <li class="meny"><a href="<?php echo BASE_DIR; ?>login">Logga in</a></li>
                    <?php else: ?>
                    <li class="meny"><a href="<?php echo BASE_DIR; ?><?php echo getBrf()->getUrl(); ?>"><?php echo getUser()->getUserType() == SvenskBRF_User::USER_TYPE_MEMBER ? 'Din förening' : 'Ditt konto'; ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <script type="text/javascript">
                $("#sok").placeholder();
            </script>