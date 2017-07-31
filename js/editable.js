//Editable comments in admin panel when listing dayplans
$('.edit').editable();

$(document).on('click','.editable-submit', function(){
	var id = $(this).parents('tr:first').find('td:first').attr("id");
	var text = $(this).parents('tr:first').find('td:eq(3)').text();
	var email = $(this).parents('tr:first').find('td:first').text();
	var comment = $('.input-sm').val();
	//console.log(text);
	$.ajax({
    	type: 'post',
    	data: {"id": id, "text": text, "comment": comment, "email": email},
    	url: "/program/insertComment.php" ,success: function(result){
        console.log(result);
    }});
});