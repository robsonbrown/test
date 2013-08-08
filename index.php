<!DOCTYPE html>
<html>
<body>
	<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
		<tr>
			<form name="form1" method="post" action="session/session_handler.php">
				<td>
				<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
				<tr>
				<td colspan="3"><strong>Member Login </strong></td>
				</tr>
				<tr>
				<td width="78">Username</td>
				<td width="6">:</td>
				<td width="294"><input name="myusername" type="text" id="myusername"></td>
				</tr>
				<tr>
				<td>Password</td>
				<td>:</td>
				<td><input name="mypassword" type="text" id="mypassword"></td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td><input id="login" name="Submit" value="Login"></td>
				<td><input id="create-user" name="new_user" value="New User"></td>
				</tr>
				</table>
				</td>
			</form>
		</tr>
	</table>
	
	<div id="dialog-form" title="Create new user">
		<p class="validateTips">All form fields are required.</p>
			
		<form>
			<fieldset>
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
				</br>
				<label for="username">Username</label>
				<input type="text" name="username" id="username" class="text ui-widget-content ui-corner-all" />
				</br>
				<label for="email">Email</label>
				<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />
				</br>
				<label for="password">Password</label>
				<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
			</fieldset>
		</form>
	</div>
</body>

	<?php
		include '/php/login.php';
		
		//Let us check the database exists.
	?>

</html>