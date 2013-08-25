//-------------------
// Returns the current date to be used
//--------------------
function get_current_date() 
{
	//Set up the date field
	var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    var today = year + "-" + month + "-" + day;
	
	return today;
}
