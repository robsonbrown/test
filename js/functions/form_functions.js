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
