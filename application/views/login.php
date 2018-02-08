<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>MoonTalk</title>        
        <link rel="stylesheet" type="text/css" href="./css/login.css">        

        <!--jQuery link-->     
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        
        <link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

        <script>
           $(function() { 
                $("#setIcon").dialog({ 
                    autoOpen: false, 
                    show: null, 
                    hide: null,
                    dialogClass: "dlg-no-close",
                    modal: true,
                    resizable: false
                }); 
                $(".picture").click(function() { 
                    $("#setIcon").dialog("open"); 
                    return false; 
                }); 
                $(".selpicture").click(function(){
                    $("#setIcon").dialog("close");
                    return false;
                });
            });   
        </script>
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
        <div class="loginlogo">
            <img src="./img_source/login/moonTalkLogo.png" alt="LCS_Logo">
        </div>               
        <div class="loginbox">
            <div id="settingUserIcon">   
                <div id="setIcon" title="請選擇你想要的頭像">
                    <img class="selpicture" src="./img_source/login/img_1.jpg" onclick="openImg('1')";>
                    <img class="selpicture" src="./img_source/login/img_2.jpg" onclick="openImg('2');">
                    <img class="selpicture" src="./img_source/login/img_3.jpg" onclick="openImg('3');">
                </div>
                <div id="currentIcons">
                    <img id="1" class="picture" style="display: inline;" src="./img_source/login/img_1.jpg">
                    <img id="2" class="picture" style="display: none;"   src="./img_source/login/img_2.jpg">
                    <img id="3" class="picture" style="display: none;"    src="./img_source/login/img_3.jpg">
                </div>                                 
            </div>

            <div class="user">
                <form name="user" action="<?php echo site_url().'/login/check';?>" onsubmit="" method="post">
                    <hc>USERNAME:</hc>
                    <input type="text" name="user" id="user">
                    <input type="hidden" name="head" value="1"> <!-- 頭像先藏起來-->
                    <input type="submit" name="enter" value="加入會議室">
                </form>
            </div>                       
        </div>           
    </body>
</html>
