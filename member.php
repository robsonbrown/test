<!DOCTYPE html>
<html>
	<body>
		<form name="logout" method="post" >
			<input type="submit" name="logout" value="logout">
		</form>
		
		</br>
		</br>
		<form name="newTransactionForm" method="post" >
			<fieldset>
				Amount <input name="amount" type="text" required="required" id="amount">
				</br>
				Time <input name="time" type="date" required="required" id="time">
				</br>
				Category <input name="category" type="password" required="required" id="category">
				</br>
				<input type="submit" name="addFinance" value="Add">
			</fieldset>
		</form>
	</body>
</html>

<?php
include '/php/member.php';
?>