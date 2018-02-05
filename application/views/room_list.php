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
			<h1>人數限制</h1>
		</div>
		<div class="showRoomList">
			<div class="roomTable">						
				<?php foreach ($data as $value) {
					echo "<div class="list"><div class="item1"><h1>".$value->{'room_id'}
			  					."</h1></div><div class="item2"><h1>".anchor('chat/?hash='.$value->{'room_hash'},$value->{'room_name'})
			  					."</h1></div><div class="item3"><h1>2</h1></div></div>";
				}
				?>	
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

