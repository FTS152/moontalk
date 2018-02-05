<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OOXX.Talk登入</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url().'css/style.default.css';?>" type="text/css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src=" http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script></head>

<body class="loginpage">
<div class="loginbox">
    <div class="loginboxinner">

        <div class="logo">
            <h1 class="logo">OOXX.<span>Talk</span></h1>
        </div><!--logo-->
        <br clear="all" /><br />

        <form id="login" action="<?php echo site_url().'login/check';?>" method="post">

            <div class="username">
                <div class="usernameinner">
                    <input type="text" name="user" id="user" placeholder="名稱"/>
                </div>
            </div>

            <input type="hidden" name="head" value="1"> <!-- 頭像先藏起來-->

            <button id="login_btn">登入</button>
        </form>

    </div><!--loginboxinner-->
</div><!--loginbox-->

</body>
</html>
