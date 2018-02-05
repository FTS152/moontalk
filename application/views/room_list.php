<table class="table table-striped result">
	<thead>
		<tr>
		    <th>ID</th>
		    <th>房間名稱</th>
		    <th>在線人數</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $value){
  				echo "<tr><td>".$value->{'room_id'}
  					."</td><td>".anchor('chat/?hash='.$value->{'room_hash'},$value->{'room_name'})
  					."</td><td>2</td></tr>";
		}
		?>
	</tbody>
</table>
<a href="room/add/">新增房間</a>
