<!DOCTYPE html>
<html>
<head>
	<title>MoonTalk</title>
	<link rel="stylesheet" type="text/css" href="../../css/room_list.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script>
	$('.item1').click(function(){
			if($(this).attr('value')=="1"){
				var pass = prompt('請輸入密碼');
				$.ajax({
		            type: "POST",
		            url: '<?php echo site_url('room/check'); ?>',
		            data: {
		            	'value': pass
		            }
		        })
			}
	    });
	</script>
</head>
<body>
	<div id="showRoomListBlock">
		<div class="roomListBar">
			<div class="item"><h1>會議室編號</h1></div>
			<div class="item"><h1>會議室名稱</h1></div>
			<div class="item"><h1>有無密碼</h1></div>
		</div>
		<div class="showRoomList">
			<div class="roomTable">		
				<!--
				<?php foreach ($data as $value) {
					echo '<div class="list"><div class="item1"><h1>'.$value->{'room_id'}.'</h1></div>';
			  		echo '<div class="item1" value='.$value->{"room_lock"}.'><h1>'.anchor('chat/?id='.$value->{'room_id'},htmlentities($value->{'room_name'})).'</h1></div>';
			  		echo '<div class="item1"><h1>'.$value->{'room_lock'}.'</h1></div></div>';
				}
				?>
			-->				
				<div class="list">
					<div class="item1"><h1>test</h1></div>
					<div class="item1"><h1>test</h1></div>
					<div class="item1"><h1>test</h1></div>
				</div>
			</div>			
		</div>
		<div class="addRoomBar">
			<a href="room/add/" class="roomAdd">
				<img src="../../img_source/roomList/roomAdd.png" alt="roomAdd">
				<h1>新增會議室</h1>
			</a>
		</div>
	</div>
	<div id="userInfoBlock">
		<div class="userInfo">
			<div class="userIcon">
				<img src="../../img_source/login/img_1.png">
			</div>
			<div class="username">
				<p>username:</p>
				<p>iNoyoka</p>
			</div>
		</div>	
	</div>
	<div id="noticeBlock">
		<div class="notice">
			<p>add some animation, notice or link to here</p>
		</div>
	</div>
</body>
</html>


