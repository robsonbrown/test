//-------------------
// loads form information for the info supplied
//--------------------
function load_form_information( id_in ) 
{
	var newTextBoxDiv = $(document.createElement('div'))
      .attr("id", 'TextBoxDiv');
	
	var html_text = '<fieldset>';
	
	html_text += get_form_for_data( id_in );
	
	html_text += '</fieldset>';

	newTextBoxDiv.html( html_text );
	
	return newTextBoxDiv;
}


//-------------------
// Creates a label + textbox for the form
//--------------------
function create_fieldset_row( type, name, user_friendly_label, id, required, class_name )
{
	var label = '<label for ="' + name + '">' + user_friendly_label + '</label>';
	var textbox = '<input type="' + type + '" name="' + name + '" id="' + id + '" required="' + required + '" class="' + class_name + '" />';
	
	return label + textbox;
}

//-------------------
// returns the html data compressed into a div to display
//--------------------
function get_form_for_data( id_in )
{
	var html_text = "";
	
	switch( id_in )
	{
		case TMStatus.TRANSACTION:
		{
			html_text += create_fieldset_row( 'text', 'amount', 'Amount', 'amount', 'required', 'text ui-widget-content ui-corner-all' );
			html_text += '</br>';
			html_text += create_fieldset_row( 'date', 'time', 'Time', 'time', 'required', 'text ui-widget-content ui-corner-all' );
			html_text += '</br>';
			html_text += create_fieldset_row( 'text', 'category', 'Category', 'category', 'required', 'text ui-widget-content ui-corner-all' );
		}
		break;
		case TMStatus.DIRECT_DEBIT:
		{
			html_text += create_fieldset_row( 'text', 'amount', 'Amount', 'amount', 'required', 'text ui-widget-content ui-corner-all' );
			html_text += '</br>';
			html_text += create_fieldset_row( 'date', 'start_date', 'Start Date', 'start_date', 'required', 'text ui-widget-content ui-corner-all' );
			html_text += '</br>';
			html_text += create_fieldset_row( 'date', 'end_date', 'End Date', 'end_date', 'required', 'text ui-widget-content ui-corner-all' );
			html_text += '</br>';
			html_text += create_fieldset_row( 'text', 'recourrance', 'Recourrance', 'recourrance', 'required', 'text ui-widget-content ui-corner-all' );
			html_text += '</br>';
			html_text += create_fieldset_row( 'text', 'category', 'Category', 'category', 'required', 'text ui-widget-content ui-corner-all' );
		}
		break;
		case TMStatus.TARGET:
		{
			html_text += create_fieldset_row( 'text', 'amount', 'Amount', 'amount', 'required', 'text ui-widget-content ui-corner-all' );
			html_text += '</br>';
			html_text += create_fieldset_row( 'date', 'target_date', 'Target Date', 'target_date', 'required', 'text ui-widget-content ui-corner-all' );
			html_text += '</br>';
			html_text += create_fieldset_row( 'text', 'category', 'Category', 'category', 'required', 'text ui-widget-content ui-corner-all' );
			html_text += '</br>';
			html_text += create_fieldset_row( 'text', 'name', 'Name', 'name', 'required', 'text ui-widget-content ui-corner-all' );
		}
		break;
		default:
		break;
	}
	
	return html_text;
}

//-------------------
// returns the html data compressed into a div to display
//--------------------
function get_button_name()
{
	return 'test';
}

//-------------------
// Creates and sends a post function using ajax
//--------------------
function post_form_data( header, value_array )
{
	$.ajax({
		type: "POST",
		url: "/php/member.php",
		data: 
		{
			head:header, 			
			array:value_array
		}
		}).done(function( result ) 
		{						
			if( result == false )
			{
				alert("The transaction could not be undertaken, please contact an administrator.");
			}
			else if( result == true )
			{
				location.reload();
			}
			else
			{
				alert( "Shouldn't be here" );
			}
		});
}

//-------------------
// Validate posts
//--------------------
function validate_form_data( id_in )
{
	tips = $( ".validateTips" );
	
	var bValid = true;
	
	switch( id_in )
	{
		case TMStatus.TRANSACTION:
		{	
			//Check that the values 
			bValid = bValid && checkLength( $( "#amount" ), "amount", 1, 16 );
			bValid = bValid && checkRegexp( $( "#amount" ), /([0-9]+(\.[0-9][0-9]?)?)/, "Only allow : 0-9 and ." );
			
			bValid = bValid && checkLength( $( "#time" ), "time", 1, 10 );
			bValid = bValid && checkLength( $( "#category" ), "category", 1, 10 );
		}
		break;
		case TMStatus.DIRECT_DEBIT:
		{
			bValid = bValid && checkLength( $( "#amount" ), "amount", 1, 16 );
			bValid = bValid && checkRegexp( $( "#amount" ), /([0-9]+(\.[0-9][0-9]?)?)/, "Only allow : 0-9 and ." );
			
			bValid = bValid && checkLength( $( "#start_date" ), "start_date", 1, 10 );
			bValid = bValid && checkLength( $( "#end_date" ), "end_date", 1, 10 );
			
			bValid = bValid && checkLength( $( "#category" ), "category", 1, 10 );
		}
		break;
		case TMStatus.TARGET:
		{
			bValid = bValid && checkLength( $( "#amount" ), "amount", 1, 16 );
			bValid = bValid && checkRegexp( $( "#amount" ), /([0-9]+(\.[0-9][0-9]?)?)/, "Only allow : 0-9 and ." );
			
			bValid = bValid && checkLength( $( "#target_date" ), "target_date", 1, 10 );
			
			bValid = bValid && checkLength( $( "#category" ), "category", 1, 10 );
		}
		break;
		default:
		break;
	}
	
	return bValid;
}

//-------------------
// Form Header name
//--------------------
function get_form_header_name( id_in, add_button_status )
{
	switch( id_in )
	{
		case TMStatus.TRANSACTION:
		{	
			if( add_button_status )
			{
				return "addFinance";
			}
			else
			{
				return "removeFinance";
			}
		}
		break;
		case TMStatus.DIRECT_DEBIT:
		{	
			return "addDirectDebit";
		}
		break;
		case TMStatus.TARGET:
		{
			return 'addTarget';
		}
		break;
		default:
		break;
	}
}

//-------------------
// Post array
//--------------------
function get_form_post_array( id_in )
{
	switch( id_in )
	{
		case TMStatus.TRANSACTION:
		{	
			return [ $( "#amount" ).val(), $( "#time" ).val(), $( "#category" ).val() ];
		}
		break;
		case TMStatus.DIRECT_DEBIT:
		{	
			return [ $( "#amount" ).val(), $( "#start_date" ).val(), $( "#end_date" ).val(), $( "#recourrance" ).val(), $( "#category" ).val() ];
		}
		break;
		case TMStatus.TARGET:
		{
			return [ $( "#amount" ).val(), $( "#target_date" ).val(), $( "#category" ).val(), $( "#name" ).val() ];
		}
		break;
		default:
		break;
	}
}

