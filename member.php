<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<body>		
		<div id="top-menu">
			<div id="funds" >
			</div>
			
			<div id="funds-entrance">
					<table width="100" border="0" align="left" cellpadding="0" cellspacing="1">
						<tr>
							<form name="financeBox" method="post" action="/php/member.php">
							
							<td width="78">Finance Total :</td>
							<td width="6">:</td>
							<td width="294"><input name="financeTotal" type="text" id="financeTotal"></td>
							<td width "100"><input id="setTotal" name="updateTotal" value="Set"></td>
						</tr>						
						</form>
					</table>
			</div>
		
			<div id="top-buttons">
				<input type="submit" id="logout" name="logout" value="logout">
				
				<div id="funds-buttons">
					<input type="submit" id="addFunds" name="addFunds" value="Add Funds">
					<input type="submit" id="withdrawFunds" name="withdrawFunds" value="Withdraw Funds">
				</div>
				
				<div id="main-buttons">
					<input type="submit" id="manageTransactions" name="manageTransactions" value="Transactions">
					<input type="submit" id="manageDirectDebit" name="manageDirectDebit" value="Direct Debits">
					<input type="submit" id="manageTargets" name="manageTargets" value="Targets">
				</div>
				
			</div>
		</div>	
		
		<div id="transactionsTable">
			<table cellspacing="1" id="transactionsList" class="tablesorter" />
		</div>
	
		<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
		<tr>
		</tr>
		</table>
	
		
		<div id="transactionPopup">
			<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
				<tr>
					<form id="transactionForm" name="newTransactionForm" method="post" action="/php/member.php">
						<td>
							<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
									<p class="validateTips">All form fields are required.</p>
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
									<td><input id="cancelFinance" name="cancelFinance" value="Cancel"></td>
									<td><input id="addFinance" name="addFinance" value="Add"></td>
								</tr>
							</table>
						</td>
					</form>
				</tr>
			</table>
		</div>
		
	</body>
</html>

<?php
include '/php/member.php';
?>

<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.10.3.custom.css">
<link rel="stylesheet" type="text/css" href="css/table/blue/style.css">
<link rel="stylesheet" type="text/css" href="css/member.css">
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/pages/member.js"></script>
<script type="text/javascript" src="js/functions/list_functions.js"></script>
<script type="text/javascript" src="js/functions/table_functions.js"></script>
<script type="text/javascript" src="js/jquery.tools.min.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script> 