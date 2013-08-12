
//Check that the datePicker type can be used with this browser type.
var check = document.createElement("input");
check.setAttribute("type", "date");


//-------------------
// Gets the current amount of funds for the current user
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
				funds_value = result;
				return result;
			});
			
			return funds_value;
	}   
);

//-------------------
// When the 'add transaction button is clicked, it will validate and then send through the add call to the php.
//--------------------
 $( "#add" )
      .button()
      .click(function() 
	  {
		var bValid = true;
		
		tips = $( ".validateTips" );
	  
		//Check that the values 
		bValid = bValid && checkLength( $( "#amount" ), "amount", 1, 16 );
		bValid = bValid && checkRegexp( $( "#amount" ), /([0-9]+(\.[0-9][0-9]?)?)/, "Password field only allow : 0-9" );
		
		bValid = bValid && checkLength( $( "#time" ), "time", 1, 10 );
		bValid = bValid && checkLength( $( "#category" ), "category", 1, 10 );
	  
		if ( bValid ) 
		{	
			var header 		= "addFinance";
			var myamount 	= $( "#amount" ).val();
			var	mytime 		= $( "#time" ).val();
			var mycategory  = $( "#category" ).val();
		
			$.ajax({
			type: "POST",
			url: "/php/member.php",
			data: {head:header, amount:myamount, time:mytime, category:mycategory}
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
		else
		{
			alert( "Screwed!");
		}
	  });
	  



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