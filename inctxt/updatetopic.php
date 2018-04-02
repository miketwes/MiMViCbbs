<h2 class="hk">Update topic</h2>
<div align="center">
<form id="simple-form" style="width: 420px;" method="post" action="/<?=I_N?>u/<?php echo $rows['id']; ?>" >

<div><label for="password1">view:</label>
<input type="text" name="view" id="password1" value="<?php echo $rows['view']; ?>"/></div>
			
<div><label for="password2">reply:</label>
<input type="text" name="reply" id="password2" value="<?php echo $rows['reply']; ?>" /></div>

<div><label for="password2">topic:</label>
<input type="text" name="topic" id="password2" value="<?php echo $rows['topic']; ?>" /></div>

<div><label for="password2">name:</label>
<input type="text" name="name" id="password2" value="<?php echo $rows['name']; ?>" /></div>

<div><label for="password2">time:</label>
<input type="text" name="time" id="password2" value="<?php echo $t1; ?>" /></div>

<div><label for="password2">last reply:</label>
<input type="text" name="lastname" id="password2" value="<?php echo $rows['lastname']; ?>" /></div>

<div><label for="password2">updated:</label>
<input type="text" name="lasttime" id="password2" value="<?php echo $v; ?>" /></div>

<input type="submit" name="Submit" id="Submit" value="Updatetopic"></form></div>
