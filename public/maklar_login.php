<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Svensk Brf - Logga in</title>
        <style type="text/css">
            #login_maklare { 
                width: 300px;
                max-height:400px;
                margin:auto;
                margin-top:100px;

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

            a {
                color:#09F;
            }
            
            a img { border: none; }

            #wrapper {margin:auto;
                      width:300px;
                      padding-top: 100px;}
            </style>
        </head>
        <body>
            <div id="wrapper">
            <a href="<?php echo BASE_DIR; ?>"><img src="<?php echo BASE_DIR; ?>media/img/SvenskaBrf_logga_1.png" width="150" height="60" alt="logga" /></a>
            <div id="login_maklare">
                <h1 style="text-align:center;">Inloggning</h1>
                <form style="margin-top:30px;" method="post">
                    <label style="margin:45px; font-size:1.1em; line-height:1.3;" for="username">Användarnamn:</label> 
                    <br />
                    <input type="text" name="u" id="username" size="30" value="<?php echo @$_REQUEST['u']; ?>" style="padding-left:20px; font-size:18px; font-weight:bold; width: 200px; margin-left:40px; height:40px; border:1px solid #d0cfcb;  border-radius: 10px; -moz-border-radius:10px;  /* Firefox 3.6 and earlier */"/>
                    <br />
                    <br />
                    <br />
                    <label style="margin:45px; font-size:1.1em; line-height:1.3;" for="password">Lösenord:</label> 
                    <br />
                    <input type="password" name="p" id="password" size="30" value="<?php echo @$_REQUEST['p']; ?>" style=" padding-left:20px; font-size:18px; font-weight:bold; width: 200px; margin-left:40px; height:40px; border:1px solid #d0cfcb;  border-radius: 10px;-moz-border-radius:10px;  /* Firefox 3.6 and earlier */"/> 
                    <br />
                    <p style="margin:0 45px;">
                        <?php if (isset($sLoginMessage)): ?>
                            <span style="color:#F00;">Antingen är lösenord eller användarnamnet fel. Vänligen prova igen.</span>
                            <br />
                        <?php endif; ?>
                        <br />
                        <a href="<?php echo BASE_DIR; ?>glomtlosenord">Har du glömt ditt användarnamn eller lösenord?</a>
                        <br />
                        <br />
                        <label for="komihag">Kom ihåg mig</label>
                        <input type="hidden" name="komihag" value="0"/><input type="checkbox" name="komihag" value="1" id="komihag"/>
                    </p>
                    <input style="margin:10px 0 20px 40px;width: 43px; height: 27px;" type="image" src="<?php echo BASE_DIR; ?>media/img/ok.png" alt="OK"/>
                    <input type="hidden" name="action" value="login"/>
                </form>
            </div>
        </div>
    </body>
</html>
