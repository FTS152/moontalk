<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MoonTalk</title>
    <link rel="stylesheet" type="text/css" href="../css/chat.css">
    <!-- 最新編譯和最佳化的 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url().'css/style.default.css';?>" type="text/css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src=" http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>

    <script language="javascript" type="text/javascript">
    $(document).ready(function(){ 
        //create a new WebSocket object.(建立socket物件)
        var wsUri = "<?php echo $socket_url;?>";
        websocket = new WebSocket(wsUri);
        websocket.onopen = function(ev) { // connection is open (socket連接時觸發的事件)
            if(ev.isTrusted && ev.type=='open'){
                //確認socket連結是 open 狀態
                //取得名稱
                var name = '<?php echo $username;?>';
                if(name.trim()=='' || name.trim()==null || name.trim()==[] || typeof(name) =='undefined'){
                    alert('尚未登入');
                    window.location = "<?php echo site_url().'login'?>";
                    return false;
                }else{
                    //prepare json data
                    var msg = {
                        type : 'join_name',
                        room: <?php echo $this->session->room;?> ,
                        join_name: name,
                        color : '<?php echo $user_colour; ?>',
                        head : '<?php echo $head;?>',
                    };
                    //convert and send data to server (連接傳送數據)
                    websocket.send(JSON.stringify(msg));
                    $.ajax({
                        type: "GET",
                        url: "history?id="+<?php echo $_GET['id']?>,
                        dataType: "json",
                        success: function(data) {
                            var num = data.length;
                            for(var i = 0; i < num; i++){
                                $("#chatmessage").append(
                                    "<div><span class=\"user_name\" style='color:#"+data[i]['chat_color']+"'>"+data[i]['chat_user']+"</span> : <span class=\"user_message\">"+htmlentities(data[i]['chat_msg'])+"</span></div>"
                                );
                            }
                        },
                        error: function(jqXHR) {
                            alert('Error!'); 
                            location.href = '../room';
                        }
                    })                    
                }
            }
        }

        $('#send-btn').click(function(){ //use clicks message send button
            $.ajax({
                type: "GET",
                url: "save?msg=" + $('#msgbox').val(),
            })
            message_send();
            $('#msgbox').val('');            
        });

        $('#msgbox').keypress(function(event){ //按下Enter 自動送出訊息
            if(event.keyCode==13){
                 $.ajax({
                    type: "GET",
                    url: "save?msg=" + $('#msgbox').val(),
                })
                message_send();
                $('#msgbox').val(''); //reset text
            }
        });


        function message_send(){
            var mymessage = $('#msgbox').val(); //get message text
            var myname = '<?php echo $username;?>'; //get user name

            if(myname == ""){ //empty name?
                alert('尚未登入');
                window.location = "<?php echo site_url().'login'?>";
                return false;
            }
            if(mymessage == ""){ //emtpy message?
                alert("未輸入留言");
                return false;
            }

            //prepare json data
            var msg = {
                type : 'usermsg',
                message: mymessage,
                room: <?php echo $this->session->room;?>,
                name: myname,
                color : '<?php echo $user_colour; ?>'
            };
            //convert and send data to server (連接傳送數據)
            websocket.send(JSON.stringify(msg));
        }

        $('#leave-btn').click(function(){
            X = document.getElementsByClassName("online new");
            if(X.length==1&&<?php echo $_GET['id'];?>!=10){
                if(confirm("你是此房間的最後一人。若你離開，此房間將會被刪除。")){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url().'room/delete'?>",
                        data:{
                            'room': <?php echo $_GET['id'];?>
                        }
                    })
                    leave();
                }
            }
            else{
                leave();
            }
        });

        $(window).unload(function(){
                X = document.getElementsByClassName("online new");
                if(X.length==1&&<?php echo $_GET['id'];?>!=10){
                    if(confirm("你是此房間的最後一人。若你離開，此房間將會被刪除。")){
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url().'room/delete'?>",
                            data:{
                                'room': <?php echo $_GET['id'];?>
                            }
                        })
                        leave();
                    }
                }
                else{
                    leave();
                }
        });

        function leave(){
            var myname = '<?php echo $username;?>'; //get user name
            var msg = {
                type : 'join_name',
                room: <?php echo $this->session->room;?>,
                name: myname,
                color : '<?php echo $user_colour; ?>'
            };
            //convert and send data to server (連接傳送數據)
            websocket.send(JSON.stringify(msg));
            websocket.close();
            $('#chatmessage').append("<div class=\"system_msg\">您已離線...</div>");
            window.location = "<?php echo site_url().'login/logout'?>";
        }

        //#### Message received from server? (view端接收server數據時觸發事件)
        websocket.onmessage = function(ev) {
            var msg = JSON.parse(ev.data); //PHP sends Json data
            var type = msg.type; //message type
            var ucolor = msg.color; //color
            var uroom = msg.room;
            if(uroom==<?php echo $this->session->room;?>){ //only show messages in the same room
                if(type == 'usermsg')
                {
                    
                    var uname = msg.name; //user name
                    var umsg = msg.message; //message text
                    if(uname && umsg){
                        $('#chatmessage').append("<div><span class=\"user_name\" style='color:#"+ucolor+"'>"+uname+"</span> : <span class=\"user_message\">"+htmlentities(umsg)+"</span></div>");
                    }
                }
                if(type == 'join_name')
                {
                    var join_name = msg.join_name; //join name
                    var join_list = msg.join_list; //join list
                    if(join_name)
                    $('#chatmessage').append("<div class=\"system_msg\">"+join_name+"連線成功</div>");

                    //更新名單
                    $('.contactlist').empty();
                    for(var index in join_list) {
                        if(join_list[index].join_name&&join_list[index].room==<?php echo $this->session->room;?>){
                            var add_html = "<li class='online new'><span style='color:#"+join_list[index].color+"'>"+join_list[index].join_name+"</span></li>";
                            $('.contactlist').append(add_html);
                        }
                    }
                }
            } 
        };

        websocket.onerror   = function(ev){$('#chatmessage').append("<div class=\"system_error\">Error Occurred - "+ev.data+"</div>");}; //與server連接發生錯誤時
        websocket.onclose   = function(ev){$('#chatmessage').append("<div class=\"system_msg\">Server Closed</div>");};  //server被關閉時

    });
    function htmlentities(str) {
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }
    </script>
</head>
<body>
    <div class="bg">
        <img src="../img_source/roomList/roomListBG.png" alt="bg">
    </div>
    <div id="chatBlock">
        <div id="chatmessage"></div>
        <div class="inputbox">
            <input type="text" id="msgbox" name="msgbox">
            <button id="send-btn" class="btn_">送出</button>
            <button id="leave-btn" class="btn_">登出</button>
            <button id="export" class="btn_" > <a href="<?php echo site_url().'/chat/export';?>">匯出會議記錄</a> </button>
        </div>
    </div>
    <div id="userInfoBlock">
        <div class="userInfo">
            <div class="userIcon">
                <img src="../img_source/login/<?php echo $this->session->head;?>">
            </div>
            <div class="username">
                <p>username:</p>
                <p><?php echo htmlentities($this->session->username);?></p>
            </div>
        </div>  
    </div>
    <div id="onlineBlock">
        <hc>線上成員</hc>
        <hr>
        <div>
            <ul class="contactlist"></ul>
        </div>
    </div>
</body>
</html>