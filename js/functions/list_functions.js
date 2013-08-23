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

//-------------------
// Checks the length of an entered value
//--------------------
function checkStringLength( length, valueName, min, max )
{
	if ( length > max || length < min ) 
	{
		return false;
	}
	
	return true;
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