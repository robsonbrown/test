
//-------------------
// Table functions
//--------------------
function load_list_information()
{
	var rows;
		
	var header = "";
		
	if( $("#manageDirectDebit").is(":disabled") )
	{
		header	= "manageDirectDebit";
		alert('hello');
	}
	else
	{
		header	= "listPanel";
	}
		
	$.ajax
		({
		type: "GET",
		url: "/php/member.php",
		async: false,
		data: header
		}).success(
			function( tableResult ) 
			{			
				tableResult = jQuery.parseJSON(tableResult);
				rows = tableResult;
			});
	$i=0; 
	
	while( $i < rows.length )
	{	
		var html = "<tr><td>" + rows[$i].time + "</td>" + "<td>" + rows[$i].category + "</td>" + "<td>" + rows[$i].amount + "</td> </tr>"; 

		$("#transactionsList tbody").append(html);
	
		$i++;
	}	
	
	$("#transactionsList").trigger("update");

}
