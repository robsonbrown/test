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
	
		
		<div id="transactionPopup" >
			<p class="validateTips">All form fields are required.</p>
			<form>
				<fieldset>
					<label for="Amount">Amount</label>
					<input type="text" name="amount" id="amount" required="required" class="text ui-widget-content ui-corner-all" />
					</br>
					<label for="Time">Date</label>
					<input type="date" name="time" id="time" required="required" class="text ui-widget-content ui-corner-all" />
					</br>
					<label for="category">Category</label>
					<input type="text" name="category" id="category" required="required" value="" class="text ui-widget-content ui-corner-all" />
				</fieldset>
			</form>
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
<script type="text/javascript" src="js/functions/date_functions.js"></script>
<script type="text/javascript" src="js/jquery.tools.min.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script> 