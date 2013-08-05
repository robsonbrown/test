	  
	  $( "#login" )
      .button()
      .click(function() {
		var header = "login";
		var myusername = $( "#myusername" ).val();
		var	mypassword = $( "#mypassword" ).val();
		
		$.ajax({
		type: "POST",
		url: "session/session_handler.php",
		data: {head:header, username:myusername, password:mypassword}
		}).done(function( result ) 
		{		
			if( result == 'false' )
			{
				alert("You have entered an incorrect user name or password.");
				alert(result);
			}
			else if( result == 'passed' )
			{
				alert( result );
			}
			else
			{
				alert( result );
				//location.reload();
			}
		
		
			//alert("hello");
			//$("#msg").html( " Address of Roll no " +myusername +" is "+mypassword );
		});
	   });
	  
	  
	    $( "#create-user" )
      .button()
      .click(function() {
        $( "#dialog-form" ).dialog( "open" );
      });
	  
	  
	  
	  $(function() 
	  {
		var nameBox 	= $( "#name" ),
		usernameBox 	= $( "#username" ),
		emailBox 		= $( "#email" ),
		passwordBox 	= $( "#password" ),
		allFields 		= $( [] ).add( nameBox ).add( usernameBox ).add( emailBox ).add( passwordBox ),
		tips = $( ".validateTips" );
	  
		//-------------------
		// New User dialog setup
		//--------------------
		$( "#dialog-form" ).dialog({
		autoOpen: false,
		height: 300,
		width: 350,
		modal: true,
		buttons: 
		{
			"Create an account": function() 
			{
			var bValid = true;
			
			alert("Create account called");
			
			var 	header = "signUp";
			var 	myusername = $( "#username" ).val();
			var 	name = $( "#name" ).val();
			var		password = $( "#password" ).val();
			var 	finance = 0;
			var		email = $( "#email" ).val();
			
			//allFields.removeClass( "ui-state-error" );
	
			bValid = bValid && checkLength( nameBox, "name", 3, 16 );
			 bValid = bValid && checkLength( username, "username", 3, 16 );
			 bValid = bValid && checkLength( email, "email", 6, 80 );
			 bValid = bValid && checkLength( password, "password", 5, 16 );
			
			 bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Name may consist of a-z, 0-9, underscores, begin with a letter." );
			 bValid = bValid && checkRegexp( username, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
			 bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
			 bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
	
			if ( bValid ) 
			{		  
				$.ajax({
				type: "POST",
				url: "session/session_handler.php",
				data: {head:header, username:myusername, name:name, password:password, finance:finance, email:email}}
				).done
				(
					function( result ) 
					{
						alert("hello");
						alert(result);
					}
				);
				
				alert( bValid );
				$( this ).dialog( "close" );
				}
				},
				Cancel: function() 
				{
				$( this ).dialog( "close" );
				alert("cancelled");
				}
		},
		close: function() 
		{
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
		});
	
	
		//-------------------
		// Checks the length of an entered value
		//--------------------
		function checkLength( o, n, min, max ) 
		{
			if ( o.val().length > max || o.val().length < min ) 
			{
				o.addClass( "ui-state-error" );
				updateTips( "Length of " + n + " must be between " +
				min + " and " + max + "." );
				return false;
			} 
			else 
			{
				return true;
			}
		}
		
	    function checkRegexp( o, regexp, n ) 
		{
			if ( !( regexp.test( o.val() ) ) ) 
			{
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} 
			else 
			{
				return true;
			}
		}
		
		function updateTips( t ) 
		{
		 tips
        .text( t )
        .addClass( "ui-state-highlight" );
		 setTimeout(function() 
		 {
			tips.removeClass( "ui-state-highlight", 1500 );
		 }, 500 );
		}
	
	    
  });
	
	
	
	
	
	
	
	