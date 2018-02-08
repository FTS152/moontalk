<p class="title">新增房間</p>
 <?php
 $attributes = array(
 	'id' => 'add',
 	'name' => 'add',
 	'method' => 'post'
 );
 echo form_open('room/add/',$attributes);
 ?>
 房間名稱:<input type="text" name="name" size="8"><br>
 私密房間:
<input type="radio" name="lock" value="1">是
<input type="radio" name="lock" value="0">否<br>
房間密碼:<input type="password" name="pass" size="8"><br>
<input type="submit" value="add">
 
</form> 