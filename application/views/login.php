<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>MoonTalk</title>        
        <link rel="stylesheet" type="text/css" href="../../css/login.css">        

        <!--jQuery link-->     
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        
        <link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
        
        <script>
           $(function() { 
                $("#setIcon").dialog({ 
                    autoOpen: false, 
                    modal: true,
                    show: null, 
                    hide: null, 
                    buttons: { 
                        "Ok": function() { $(this).dialog("close"); }, 
                        "Cancel": function() { $(this).dialog("close"); }
                    }
                }); 
                $("#showUserIcon").click(function() { 
                    $("#setIcon").dialog("open"); 
                    return false; 
                }); 
            });


        </script>
    </head>

    <body onload="document.getElementById('user').focus();">                
        <div class="loginlogo">
            <img src="../../img_source/login/moonTalkLogo.png" alt="LCS_Logo">
        </div>               
        <div class="loginbox">
            <div id="settingUserIcon">   
                <div id="setIcon" title="請選擇你想要的頭像">
                    <img src="../../img_source/login/img_1.jpg">
                    <img src="../../img_source/login/img_2.jpg">
                    <img src="../../img_source/login/img_3.jpg">
                </div>
                <img id="showUserIcon" src="../../img_source/login/img_1.jpg">                
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
