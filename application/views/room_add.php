<p class="title">新增房間</p>
 <?php
 $attributes = array(
 	'id' => 'add',
 	'name' => 'add',
 	'method' => 'get'
 );
 echo form_open('room/add/',$attributes);
 ?>
 房間名稱:<input type="text" name="name" size="8"><br>
 隱藏房間:
<input type="radio" name="hide" value="1">是
<input type="radio" name="hide" value="0">否<br>
<input type="submit" value="add">
 
</form> 