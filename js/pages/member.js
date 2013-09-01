var TMStatus = {
TRANSACTION: 0,
DIRECT_DEBIT: 1,
TARGET: 2
}

//Check that the datePicker type can be used with this browser type.
var check = document.createElement("input");
check.setAttribute("type", "date");

var menu_status = TMStatus.TRANSACTION;

//-------------------
// New User dialog setup
//--------------------
$( "#transactionPopup" ).dialog({
autoOpen: false,
height: 300,
width: 350,
modal: true,
show: 
{
    effect: "blind",
    duration: 200,
},
buttons: 
{
	"Cancel": function()
	{
		$( this ).dialog( "close" );
		enable_transaction_buttons();
	},
	"Update Finance": function() 
	{
		update_finance();
		enable_transaction_buttons();
	}
},
open: function() 
{
	$(this).parent().find(".ui-dialog-titlebar-close").hide();
	
	$(this).parent().find('fieldset').remove();
	
	var newTextBoxDiv = load_form_information( menu_status );
	 
	newTextBoxDiv.appendTo(this);
	 
	if( $("#addFunds").is(":disabled") )
	{
		$(this).dialog( 'option', 'title', 'Add Funds' );
	}
	else
	{
		$(this).dialog( 'option', 'title', 'Withdraw Funds' );
	}
	
	//Set up the date field
    $("#time").attr("value",  get_current_date() );
}
	
});

//-------------------
// Enable transaction buttons
//--------------------
function enable_transaction_buttons()
{
	$("#addFunds" ).button("enable");
	$("#withdrawFunds" ).button("enable");
}

//-------------------
// Sets up the member page initially - Gets the current amount of funds for the current user
//--------------------
$('#funds')
.text
(function( n )
	{
		var funds_value;
	
		$.ajax
		({
		type: "GET",
		url: "/php/member.php",
		async: false,
		data: "funds"
		}).success(
			function( result ) 
			{			
				result = jQuery.parseJSON(result);
				
				if( result.full_setup == true )
				{					
					$("#funds-entrance").hide();
					$("#transactionPopup").hide();
					$("#top-buttons").show();
					$("#funds").show();

					funds_value = result.finance_total;
				}
				else
				{
					$("#funds-entrance").show();
					$("#funds").hide();
					$("#top-buttons").hide();
					$("#transactionPopup").hide();
					
					return false;
				}
			});
			
			var total_value = 'Current Budget : £' + funds_value;
			
			return total_value;			
	}   
);

//-------------------
// Logout button call
//--------------------
  $( "#logout" )
      .button()
      .click(function() 
	  {		
		var header 		= "logout";
		
		$.ajax({
		type: "POST",
		url: "/session/session_handler.php",
		data: {head:header}
		}).done(function( result ) 
		{				
			location = "/index.php";
		});	
	  }
	);

//-------------------
// Add finance opening button call.
//--------------------
  $( "#addFunds" )
      .button()
      .click(function() 
	  {	
		$("#addFunds" ).button("disable");
		$( "#transactionPopup" ).dialog( "open" );
	  }
	);
	
//-------------------
// Add finance opening button call.
//--------------------
  $( "#withdrawFunds" )
      .button()
      .click(function() 
	  {		
		$("#withdrawFunds" ).button("disable");
		$( "#transactionPopup" ).dialog( "open" );
	  }
	);
	
//-------------------
// Open Direct Debit Management
//--------------------
  $( "#manageDirectDebit" )
      .button()
      .click(function() 
	  {			  
		update_top_menu_status( TMStatus.DIRECT_DEBIT );
	  }
	);
	
//-------------------
// Manage targets Button
//--------------------
  $( "#manageTargets" )
      .button()
      .click(function() 
	  {		
		update_top_menu_status( TMStatus.TARGET );
	  }
	);
	
//-------------------
// Manage transactions button
//--------------------
  $( "#manageTransactions" )
      .button()
      .click(function() 
	  {		
		update_top_menu_status( TMStatus.TRANSACTION );
	  }
	);
	  


//-------------------
// When the 'set total button is clicked, it will validate and then send through the add call to the php.
//--------------------
 $( "#setTotal" )
      .button()
      .click(function() 
	  {		
		var bValid = true;
		tips = $( ".validateTips" );
	    
		bValid = bValid && checkRegexp( $( "#financeTotal" ), /([0-9]+(\.[0-9][0-9]?)?)/, "Only allow : 0-9 and ." );
	    
		if( bValid )
		{
			var header 		= "setInitialFinance";
			var mytotal 	= $( "#financeTotal" ).val();
			
			$.ajax({
			type: "POST",
			url: "/php/member.php",
			data: {head:header, total:mytotal}
			}).done(function( result ) 
			{				
				if( result == false )
				{
					alert("The transaction could not be undertaken, please contact an administrator.");
				}
				else if( result == true )
				{
					$("#funds-entrance").hide();
					$("#funds").show();
					location.reload();
				}
				else
				{
					alert( "Shouldn't be here" );
				}
			});	
		}
	  });
	  
	  
//-------------------
// Cancel finance button called.
//--------------------
$( "#cancelFinance" )
	.button()
	.click(function()
	{
		$("#transactionPopup").hide();
		$("#addFunds" ).button("enable");
		$("#withdrawFunds" ).button("enable");
	});
	  
//-------------------
// When the 'add transaction button is clicked, it will validate and then send through the add call to the php.
//--------------------
function update_finance()
{	
	if ( validate_form_data( menu_status ) ) 
	{	
		var header = get_form_header_name( menu_status, $("#addFunds").is(":disabled") );
	
		var value_array = get_form_post_array( menu_status );
		
		post_form_data( header, value_array );
	}
	else
	{
		alert( "Something has gone wrong when trying to update the finance..");
	}
};
	  
//-------------------
// Checks that HTML5 can be used in the browser for the calendar picker.
//--------------------
if(check.type === "text"){
    $('input[type="date"]').each(function(){
        var input = $(this);

        var newInputId = input.prop('id') + 'Shadow';

        input.before('<input id="' + newInputId + '">');

        var newInput = $('#' + newInputId);

        newInput.datepicker({
            altField:'#'+input.prop('id'),
            altFormat: 'yy-mm-dd'
        });

        var split = input.val().split('-');
        newInput.val(split[1] + '/' + split[2] + '/' + split[0]);

        input.hide();
    });
}

//-------------------
// Works out the current status of the top menu.
//--------------------
function update_top_menu_status( top_menu_item )
{
	switch( top_menu_item )
	{
		case TMStatus.TRANSACTION:
		{
			$("#manageTransactions" ).button("disable");
			$("#manageTargets" ).button("enable");
			$("#manageDirectDebit" ).button("enable");
		}
		break;
		
		case TMStatus.DIRECT_DEBIT:
		{	
			$("#manageTransactions" ).button("enable");
			$("#manageTargets" ).button("enable");
			$("#manageDirectDebit" ).button("disable");
		}
		break;
		
		case TMStatus.TARGET:
		{
			$("#manageTransactions" ).button("enable");
			$("#manageTargets" ).button("disable");
			$("#manageDirectDebit" ).button("enable");
		}
		break;
		
		default:
		break;
	}
	
	menu_status = top_menu_item;
	
	update_page();
}

//-------------------
// 
//--------------------

function update_page()
{
	//Let's decide which table view to use
	var table_name = "";

	switch( menu_status )
	{
		case TMStatus.TRANSACTION:
		{
			table_name = "transactionsListPanel";
			$("#addFunds").attr('value', 'Add Funds');
			$("#withdrawFunds").show();
			$("#withdrawFunds").attr('value', 'Withdraw Funds');
		}
		break;
		case TMStatus.DIRECT_DEBIT:
		{
			table_name = "directDebitListPanel";
			$("#addFunds").attr('value', 'Add Direct Debit');
			$("#withdrawFunds").hide();
		}
		break;
		case TMStatus.TARGET:
		{
			table_name = "targetListPanel";
			$("#addFunds").attr('value', 'Add Target');
			$("#withdrawFunds").hide();
		}
		break;
	}
	
	load_list_information( "/php/member.php", table_name, "transactionsList" );
}

//-------------------
// Loads the table on the screen
//--------------------
$(document).ready(function() 
{ 	
	update_top_menu_status( menu_status );
	
	//directDebitListPanel
    //$("#append").click(function() { 
    //   // add some html 
    //   var html = "<tr><td>Peter</td><td>Parker</td><td>28</td><td>$9.99</td><td>20%</td><td>Jul 6, 2006 8:14 AM</td></tr>"; 
    //   html += "<tr><td>John</td><td>Hood</td><td>33</td><td>$19.99</td><td>25%</td><td>Dec 10, 2002 5:14 AM</td></tr><tr><td>Clark</td><td>Kent</td><td>18</td><td>$15.89</td><td>44%</td><td>Jan 12, 2003 11:14 AM</td></tr>";         
    //   html += "<tr><td>Bruce</td><td>Almighty</td><td>45</td><td>$153.19</td><td>44%</td><td>Jan 18, 2001 9:12 AM</td></tr>"; 
    //   // append new html to table body  
    //    $("table tbody").append(html); 
    //   // let the plugin know that we made a update 
    //   $("table").trigger("update"); 
    //   // set sorting column and direction, this will sort on the first and third column 
    //   var sorting = [[2,1],[0,0]]; 
    //   // sort on the first column 
    //   $("table").trigger("sorton",[sorting]); 	
    //   return false; 
   // }); 
});