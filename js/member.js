
//Check that the datePicker type can be used with this browser type.
var check = document.createElement("input");
check.setAttribute("type", "date");

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