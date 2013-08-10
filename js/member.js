
//Check that the datePicker type can be used with this browser type.
var check = document.createElement("input");
check.setAttribute("type", "date");


 $( "#add" )
      .button()
      .click(function() 
	  {
		var bValid = true;
		
		tips = $( ".validateTips" );
	  
		//Check that the values 
		bValid = bValid && checkLength( $( "#amount" ), "amount", 3, 16 );
		bValid = bValid && checkRegexp( $( "#amount" ), /^([0-9])+$/, "Password field only allow : a-z 0-9" );
	  
	  
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

$('#submit-button').click(function() {
    var name = $('#username').val();
    $.ajax({
        type: 'POST',
        url: 'php_file_to_execute.php',
        data: {username: name},
        success: function(data) {
            if(data == "1") {
                document.write("Success");   
            } else {
                document.write("Something went wrong");
            }
        }
    });
});