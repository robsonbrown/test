//-------------------
// Load a tableSorted List panel.
//--------------------
function load_list_information( $urlName, $header, $listPanelName )
{	
	var table = $("#" + $listPanelName );
	
	//$.tablesorter.clearTableBody( table );
	
	//$("#" + $listPanelName).tablesorter().remove();
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
	
	table.tablesorter();
		
	//table.append('<th> test </th>');
	table.find('thead').remove();
	table.append('<thead> </thead>');
	
	table.find('tbody').remove();
	table.append('<tbody> </tbody>');
		
	var headerText = create_html_for_header( get_headers_for_table( $header ) );
	table.find('thead').append(headerText);
	table.trigger( "update" );
	table.tablesorter();
	
	$i=0; 
	
	while( $i < rows.length )
	{	
		$columns = get_columns_for_table( $header, rows );
		
		var html = create_html_for_row( $columns );
		
		table.find('tbody').append(html);
	
		$i++;
	}	
	
	table.trigger("update");
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
function create_html_for_header( headers )
{
	var html = "<tr>";
	
	for( k=0; k != headers.length; ++k )
	{
		html += "<th>" + headers[k] + "</th>";
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
		
		case "directDebitListPanel": 
		{
			return [ rows[$i].amount, rows[$i].start_date, rows[$i].end_date, rows[$i].reocurrance_type ];
		}
		break;
		
		case "targetListPanel":
		{
			return [ rows[$i].name, rows[$i].target_date, rows[$i].amount ];
		}
		break;
		
		default:
		return NULL;
		break;
	}
}


//-------------------
// Create a HTML styled table row, with just the column names.
//--------------------
function get_headers_for_table( header )
{
	switch( header ) 
	{
		case "transactionsListPanel":
		{
			return [ "Date", "Category", "Amount" ];
		}
		break;
		
		case "directDebitListPanel": 
		{
			return [ "Amount", "Start Date", "End Date", "Recourrance Type" ];
		}
		break;
		
		case "targetListPanel":
		{
			return [ "Name", "Target Date", "Amount" ];
		}
		break;
		
		default:
		return NULL;
		break;
	}
}




