<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MoonTalk</title>

    <link rel="stylesheet" type="text/css" href="./css/login/login.css">
</head>
<body onload="document.getElementById('user').focus();">
    <div id="body">
        <div class="loginlogo">
            <img src="./img_source/login/moonTalkLogo.png" alt="LCS_Logo">
        </div>
        <div class="loginbox">
            <div class="user">
                <form name="user" action="<?php echo site_url().'/login/check';?>" onsubmit="" method="post">
                    <hc>USERNAME:</hc>
                    <input type="text" name="user" id="user">
                    <input type="hidden" name="head" value="1"> <!-- 頭像先藏起來-->
                    <input type="submit" name="enter" value="加入會議室">
                </form>
            </div>                       
        </div>       
    </div>
    
</body>
</html>
