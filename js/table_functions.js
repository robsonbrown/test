
//if( $("#manageDirectDebit").is(":disabled") )
//{
//	header	= "manageDirectDebit";
//	alert('hello');
//}
//else
//{
//	header	= "listPanel";
//}

//-------------------
// Load a tableSorted List panel.
//--------------------
function load_list_information( $urlName, $header, $listPanelName )
{
	var rows;
	
	$.ajax
		({
		type: "GET",
		url: $urlName,
		async: false,
		data: $header
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

		$("#" + $listPanelName + " tbody").append(html);
	
		$i++;
	}	
	
	$("#" + $listPanelName ).trigger("update");

}
