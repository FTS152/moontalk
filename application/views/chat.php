<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OOXX.Talk</title>
    <!-- 最新編譯和最佳化的 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url().'css/style.default.css';?>" type="text/css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src=" http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>
</head>
<body>
<div class="bodywrapper">
    <div class="centercontent">
        <div class="pageheader notab">
                <h1 class="pagetitle">OOXX.Talk</h1>
                <span class="pagedesc">這是一個簡單的聊天室</span>
        </div><!--pageheader-->

        <div id="contentwrapper" class="contentwrapper withrightpanel">

            <div class="subcontent chatcontent">

                <div id="chatmessage" class="chatmessage radius2">
                    <div id="chatmessageinner"></div><!--chatmessageinner-->
                </div><!--chatmessage-->
                <br>
                <span id="welcome_str"></span>
                <div class="messagebox radius2">
                    <span class="inputbox" style="width:70%;float: left;">
                        <input type="text" id="msgbox" name="msgbox"  />
                    </span>
                    <button id="send-btn" class="btn btn-warning" style="float: left;margin-left: 20px;">送出</button>
                    <button class="btn btn-danger" id="leave-btn" style="float: left;margin-left: 20px;">登出/離開</button>
                    <?php echo anchor('chat/export?id='.$_GET['id'],'匯出'); ?>
                </div>

            </div><!--subcontent-->

        </div><!--contentwrapper-->

        <div class="rightpanel">
            <div class="rightpanelinner">
                <div class="widgetbox uncollapsible">
                    <div class="title"><h4>線上使用者</h4></div>
                    <div class="widgetcontent nopadding">
                        <ul class="contactlist">
                        </ul>
                    </div><!--widgetcontent-->
                </div><!--widgetbox-->
            </div><!--rightpanelinner-->
        </div><!--rightpanel-->

    </div><!-- centercontent -->
</div>

<script type="text/javascript"></script>
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
                var url = new URL(location.href);
                var room = url.searchParams.get('id'); //get id

                if(name.trim()=='' || name.trim()==null || name.trim()==[] || typeof(name) =='undefined'){
                    alert('尚未登入');
                    window.location = "<?php echo site_url().'login'?>";
                    return false;
                }else{
                    //prepare json data
                    var msg = {
                        type : 'join_name',
                        room: room ,
                        join_name: name,
                        color : '<?php echo $user_colour; ?>',
                        head : '<?php echo $head;?>',
                    };
                    //convert and send data to server (連接傳送數據)
                    websocket.send(JSON.stringify(msg));
                    $.ajax({
                        type: "GET",
                        url: "history?id=" + room,
                        dataType: "json",
                        success: function(data) {
                            var num = data.length;
                            for(var i = 0; i < num; i++){
                                $("#chatmessage").append(
                                    "<div><span class=\"user_name\" style='color:#"+data[i]['chat_color']+"'>"+data[i]['chat_user']+"</span> : <span class=\"user_message\">"+data[i]['chat_msg']+"</span></div>"
                                );
                            }
                        },
                        error: function(jqXHR) {
                            alert('不存在此房間！'); 
                            location.href = '../room';
                        }
                    })
                    $("#welcome_str").html('歡迎 <b>'+name+' </b>, 請於下方輸入留言:');
                }
            }
        }

        $('#send-btn').click(function(){ //use clicks message send button
            var url = new URL(location.href);
            var room = url.searchParams.get('id'); //get id
            $.ajax({
                type: "GET",
                url: "save?msg=" + $('#msgbox').val() + "&room=" + room,
                dataType: "json",
            })
            message_send();
            $('#msgbox').val('');            
        });

        $('#msgbox').keypress(function(event){ //按下Enter 自動送出訊息
            if(event.keyCode==13){
                var url = new URL(location.href);
                var room = url.searchParams.get('id'); //get id
                 $.ajax({
                    type: "GET",
                    url: "save?msg=" + $('#msgbox').val() + "&room=" + room,
                })
                message_send();
                $('#msgbox').val(''); //reset text
            }
        });


        function message_send(){
            var mymessage = $('#msgbox').val(); //get message text
            var myname = '<?php echo $username;?>'; //get user name

            var url = new URL(location.href);
            var myroom = url.searchParams.get('id'); //get id

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
                room: myroom,
                name: myname,
                color : '<?php echo $user_colour; ?>'
            };
            //convert and send data to server (連接傳送數據)
            websocket.send(JSON.stringify(msg));
        }

        $('#leave-btn').click(function(){
            var myname = '<?php echo $username;?>'; //get user name
            var url = new URL(location.href);
            var myroom = url.searchParams.get('id'); //get id
            var msg = {
                type : 'join_name',
                room: myroom,
                name: myname,
                color : '<?php echo $user_colour; ?>'
            };
            //convert and send data to server (連接傳送數據)
            websocket.send(JSON.stringify(msg));
            websocket.close();
            $('#chatmessage').append("<div class=\"system_msg\">您已離線...</div>");
            window.location = "<?php echo site_url().'login/logout'?>";
        });

        //#### Message received from server? (view端接收server數據時觸發事件)
        websocket.onmessage = function(ev) {
            var current_room_url = new URL(location.href);
            var current_room = current_room_url.searchParams.get('id'); //get id

            var msg = JSON.parse(ev.data); //PHP sends Json data
            var type = msg.type; //message type
            var ucolor = msg.color; //color
            var uroom = msg.room;
            if(uroom==current_room){ //only show messages in the same room
                if(type == 'usermsg')
                {
                    
                    var uname = msg.name; //user name
                    var umsg = msg.message; //message text
                    if(uname && umsg){
                        $('#chatmessage').append("<div><span class=\"user_name\" style='color:#"+ucolor+"'>"+uname+"</span> : <span class=\"user_message\">"+umsg+"</span></div>");
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
                        if(join_list[index].join_name&&join_list[index].room==current_room){
                            var add_html = "<li class='online new'><span style='color:#"+join_list[index].color+"'>"+join_list[index].join_name+"</span></li>";
                            $('.contactlist').append(add_html);
                        }
                    }
                }
            } 
        };

        websocket.onerror	= function(ev){$('#chatmessage').append("<div class=\"system_error\">Error Occurred - "+ev.data+"</div>");}; //與server連接發生錯誤時
        websocket.onclose 	= function(ev){$('#chatmessage').append("<div class=\"system_msg\">Server Closed</div>");};  //server被關閉時

    });
</script>
</body>
</html>