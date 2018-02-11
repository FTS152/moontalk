<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>MoonTalk</title>        
        <link rel="stylesheet" type="text/css" href="./css/login.css">        

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script>
            function openImg(imgName) {
                var i, x;
                x = document.getElementsByClassName("picture");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                document.getElementById(imgName).style.display = "inline";
            }
        </script>
    </head>

    <body onload="document.getElementById('user').focus();">                
        <div class="bg">
            <img src="./img_source/login/loginBG.png" alt="loginBG">
        </div>               
        <div class="loginbox">

            <div id="currentIcons" data-toggle="collapse" data-target="#settingUserIcon">
                <img id="1" class="picture" style="display: inline;" src="./img_source/login/img_1.png">
                <img id="2" class="picture" style="display: none;"   src="./img_source/login/img_2.png">
                <img id="3" class="picture" style="display: none;"    src="./img_source/login/img_3.png">
            </div>
            <div id="settingUserIcon" class="collapse">   
                <img class="selpicture" src="./img_source/login/img_1.png" onclick="openImg('1')";>
                <img class="selpicture" src="./img_source/login/img_2.png" onclick="openImg('2');">
                <img class="selpicture" src="./img_source/login/img_3.png" onclick="openImg('3');">                
            </div>
            <div class="user">
                <form name="user" action="<?php echo site_url().'/login/check';?>" onsubmit="" method="post">
                    <hc>使用者名稱:</hc>
                    <input type="text" name="user" id="user">
                    <input type="hidden" name="head" value="1"> <!-- 頭像先藏起來-->
                    <input type="submit" name="enter" value="加入會議室">
                </form>
            </div>                       
        </div>           
    </body>
</html>
