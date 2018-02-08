<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MoonTalk</title>
    <link rel="stylesheet" type="text/css" href="../../css/login.css">
</head>
<body onload="document.getElementById('user').focus();">

    <div id="body">
        <div class="loginlogo">
            <img src="../../img_source/login/moonTalkLogo.png" alt="LCS_Logo">
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
    
    <div style="margin-left:auto;margin-right:auto;width:425px;height:240px;">
            <div style="float: left;">
                <div id="1" class="picture" style="display: block">
                    <img src="../../img_source/login/img_1_wide.jpg">
                </div>
                <div id="2" class="picture" style="display: none">
                    <img src="../../img_source/login/img_2_wide.jpg">
                </div>
                <div id="3" class="picture" style="display: none">
                    <img src="../../img_source/login/img_3_wide.jpg">
                </div>          
            </div>

            <table style="float: right;">
                <tr>
                    <th>
                        <a href="javascript:void(0)" onclick="openImg('1');">
                        <img src="../../img_source/login/img_1.jpg"></a>
                    </th>
                    <th>
                        <a href="javascript:void(0)" onclick="openImg('2');">
                        <img src="../../img_source/login/img_2.jpg"></a>
                    </th>
                    <th>
                        <a href="javascript:void(0)" onclick="openImg('3');">
                        <img src="../../img_source/login/img_3.jpg"></a>
                    </th>
                </tr>
            </table>
        </div>
<script>
function openImg(imgName) {
  var i, x;
  x = document.getElementsByClassName("picture");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  document.getElementById(imgName).style.display = "block";
}
</script>

</body>
</html>
