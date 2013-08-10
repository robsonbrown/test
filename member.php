<!DOCTYPE html>
<html>
	<body>
		<form name="logout" method="post" >
			<input type="submit" name="logout" value="logout">
		</form>
	
		
		<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
		<tr>
			<form name="newTransactionForm" method="post" action="/php/member.php">
				<td>
				<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
				<tr>
				<td colspan="3"><strong>New Transaction </strong></td>
				</tr>
				<tr>
				<td width="78">Amount</td>
				<td width="6">:</td>
				<td width="294"><input name="amount" type="text" id="amount"></td>
				</tr>
				<tr>
				<td>Time</td>
				<td>:</td>
				<td><input name="time" type="date" required="required" id="time"></td>
				</tr>
				<tr>
				<td>Category</td>
				<td>:</td>
				<td><input name="category" type="password" required="required" id="category"></td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td><input id="add" name="addFinance" value="Add"></td>
				</tr>
				</table>
				</td>
			</form>
		</tr>
	</table>
	</body>
</html>

<?php
include '/php/member.php';
?>

<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.10.3.custom.css">
<link rel="stylesheet" type="text/css" href="css/member.css">
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/member.js"></script>
<script type="text/javascript" src="js/jquery.tools.min.js"></script>