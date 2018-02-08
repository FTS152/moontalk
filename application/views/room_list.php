<!DOCTYPE html>
<html>
<head>
	<title>MoonTalk</title>
	<link rel="stylesheet" type="text/css" href="../../css/room_list.css">
</head>
<body>
	<div class="showRoomListBlock">
		<div class="roomListBar">
			<h1>ID</h1>
			<h1>會議室名稱</h1>
			<h1>密碼</h1>
		</div>
		<div class="showRoomList">
			<div class="roomTable">		
							
				<?php foreach ($data as $value) {
					echo '<div class="list"><div class="item1"><h1>'.$value->{'room_id'}.'</h1></div>';
			  		if($value->{'room_lock'})
			  			echo '<div class="item2"><h1>'.anchor('chat/?id='.$value->{'room_id'},htmlentities($value->{'room_name'})).'</h1></div>';
			  		else
			  			echo '<div class="item2"><h1>'.anchor('chat/?id='.$value->{'room_id'},htmlentities($value->{'room_name'})).'</h1></div>';
			  		echo '<div class="item3"><h1>'.$value->{'room_lock'}.'</h1></div></div>';
				}
				?>
				<div class="list">
					<div class="item1"></div>
					<div class="item2"></div>
					<div class="item3"></div>
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
	<div class="userInfo"></div>
	<div class="notice"></div>
</body>
</html>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
$('.item2').click(function(){
		var pass = prompt('請輸入密碼');
  		location.href="room?value=" pass;
</script>

