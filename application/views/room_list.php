<!DOCTYPE html>
<html>
<head>
	<title>MoonTalk</title>
	<link rel="stylesheet" type="text/css" href="./css/room_list.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<!--jQuery link-->     
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        
        <link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">


</head>
<body>
	<div class="bg"><img src="./img_source/roomList/roomListBG.png"></div>
	<div id="showRoomListBlock">
		<div class="roomListBar">
			<div class="item"><h1>會議室編號</h1></div>
			<div class="item"><h1>會議室名稱</h1></div>
			<div class="item"><h1>有無密碼</h1></div>
		</div>
		<div class="showRoomList">
			<div class="roomTable">		
				
				<?php foreach ($data as $value) {
					echo '<div id="list" class="list" room='.$value->{'room_id'}.' value='.$value->{'room_lock'}.'> <div class="item1"><h1>'.$value->{'room_id'}.'</h1></div>';
			  		echo '<div class="item1" value='.$value->{"room_lock"}.'><h1>'.anchor('chat/?id='.$value->{'room_id'},htmlentities($value->{'room_name'})).'</h1></div>';
			  		echo '<div class="item1"><h1>'.$value->{'room_lock'}.'</h1></div></div>';
				}
				?>				
				<!--
				<div class="list">
					<div class="item1"><h1>test</h1></div>
					<div class="item1"><h1>test</h1></div>
					<div class="item1"><h1>test</h1></div>
				</div>
			-->
			</div>			
		</div>
		<div class="addRoomBlock">
			<form class="addRoom" title="建立新會議室" action="<?php echo site_url().'/room/add';?>" method="post">			
				<hc>房間名稱:</hc>
				<input required type="text" name="name" size="8"><br>
				<hc>房間密碼(可選):</hc>
				<input type="password" name="pass" size="8"><br>
				<div class="text-align-center">
					<input id="submitRoom" type="submit" value="add">
				</div>				
            </form>
		</div>
		<div class="addRoomBar">
			<a href="" class="roomAdd">
				<img src="./img_source/roomList/roomAdd.png" alt="roomAdd">
				<h1>新增會議室</h1>
			</a>
		</div>
	</div>
    <div id="userInfoBlock">
        <div class="userInfo">
            <div class="userIcon">
                <img src="./img_source/login/<?php echo $this->session->head;?>">
            </div>
            <div class="username">
                <p>username:</p>
                <p><?php echo htmlentities($this->session->username);?></p>
            </div>
        </div>  
    </div>
	<div id="noticeBlock">
		<div class="notice">
			<p>※本網站僅作為會議平台使用，請勿做出違反法律之行為，若有法律糾紛，我們概不負責</p>
			<p>※在會議室中，請勿做出違反公序良俗之言論，情節嚴重者，我們將會屏蔽違規者。</p>
			<p>※若有任何有關本網站使用上的疑問，歡迎聯繫官網，我們會盡快為您服務。</p>
			<br><br><br><br>
			<a href="https://www.facebook.com/%E5%B7%A6%E5%BC%A6%E6%9C%88%E5%B7%A5%E4%BD%9C%E5%AE%A4-Left-Crescent-Studio-1916628771890776/">左弦月工作室 敬上</a>
		</div>
	</div>
</body>
</html>

<script>
$(function () {
    $(".list").bind("click", function () {
        location.href = "<?php echo site_url().'chat/?id=';?>"+$(this).attr('room');
		if($(this).attr('value')=="1"){
			var pass = prompt('請輸入密碼');
			if(pass!=null){
				$.ajax({
			           type: "POST",
			           url: '<?php echo site_url('room/check'); ?>',
			           data: {
			            'value': pass
			           }
			       })
			}
		}
    });
});
           $(function() { 
                $(".addRoom").dialog({ 
                    autoOpen: false, 
                    show: null, 
                    hide: null,
                    dialogClass: "dlg-no-close",
                    modal: true,
                    resizable: false
                }); 
                $(".roomAdd").click(function() { 
                    $(".addRoom").dialog("open"); 
                    return false; 
                });                 
            });
</script>
