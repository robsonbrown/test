
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
		//var html = "<tr><td>" + rows[$i].time + "</td>" + "<td>" + rows[$i].category + "</td>" + "<td>" + rows[$i].amount + "</td> </tr>"; 

		$columns = get_columns_for_table( $header, rows );
		
		var html = create_html_for_row( $columns );
		
		$("#" + $listPanelName + " tbody").append(html);
	
		$i++;
	}	
	
	$("#" + $listPanelName ).trigger("update");
}

//-------------------
// Create a HTML styled table row, with just the column names.
//--------------------
function create_html_for_row( $columns_to_add )
{
	var html = "<tr>";
	
	for( $j=0; $j != $columns_to_add.length; ++$j )
	{
		html += "<td>" + $columns_to_add[$j] + "</td>";
	}
	
	html += "</tr>";
	
	return html;
}


//-------------------
// Create a HTML styled table row, with just the column names.
//--------------------
function get_columns_for_table( $header, rows )
{
	switch( $header ) 
	{
		case "transactionsListPanel":
		{
			return [ rows[$i].time, rows[$i].category, rows[$i].amount ];
		}
		break;
		
		default:
		break;
	}
}


