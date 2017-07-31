$(document).ready(function(){

	//Taking the data of the current user
	$.ajax({
    	type: 'post',
    	dataType : 'json',
    	url: "/program/sessionUser.php" ,success: function(result){
    	var login = result.login;
        var role = result.role;
        var department = result.department;

		//CKEditor instance
		if($("#editor").length > 0){
			CKEDITOR.replace('editor');
		}

		//Send button
		$("#send-button").on("click", function(){
			var text = CKEDITOR.instances['editor'].getData();
			//console.log(text);
			if(text != ""){
			    $.ajax({
			    	type: 'post',
			    	data: {"text": text},
			    	url: "/program/insertDayplan.php" ,success: function(result){
			    		console.log(result);
			    	if(result == "update"){
			    		swal(
						  'WELL DONE!',
						  'Your dayplan has been updated',
						  'info'
						);
			    	} else {
				    	swal(
						  'CONGRATULATIONS!',
						  'Your dayplan has been sent',
						  'success'
						);
			    	}

					CKEDITOR.instances['editor'].setData("");
			    }});
			} else {
				swal(
				  'ERROR WHAT A HORROR!',
				  'You need to fill the dayplan!',
				  'error'
				);
			}
		});

		//Erase button
		$("#erase-button").on("click", function(){
			CKEDITOR.instances['editor'].setData("");
		});

		//List users
		$("#listUsers").on("click", function(){
		    $.ajax({
		    	type: 'post',
		    	data: {"department": department, "role": role},
		    	url: "/view/listUser.php",success: function(result){
		        $("#main").html(result);
		    }});
		});

		//Create users
		$("#createUsers").on("click", function(){
		    $.ajax({
		    	type: 'post',
		    	data: {"department": department, "role": role},
		    	url: "/view/createUser.php",success: function(result){
		        $("#main").html(result);
		    }});
		});

		//Erase users
		$("#eraseUsers").on("click", function(){
		    $.ajax({
		    	type: 'post',
		    	data: {"department": department, "role": role},
		    	url: "/view/deleteUser.php",success: function(result){
		        $("#main").html(result);
		    }});
		});

		//Update users
		$("#updateUsers").on("click", function(){
			chooseUser("updateUser");
		});

		//Alert non implemented buttons
		$("#reminder").on("click", function(){

		    /*$.ajax({
		    	type: 'post',
		    	data: {"department": department, "role": role},
		    	url: "/program/mailDelayed.php",success: function(result){
		        swal(
				  'REMINDER SENT!',
				  'All the users have a reminder',
				  'success'
				);
		    }});*/
		    swal(
			  'REMINDER DEACTIVATED!',
			  'We are working on it :)',
			  'error'
			);
		});

		//Free option
		$("#option2").on("click", function(){
	    	swal(
			  'NOT IMPLEMENTED YET!',
			  'This is a future feature',
			  'info'
			);
		});

		//Free option
		$("#option3").on("click", function(){
	    	swal(
			  'NOT IMPLEMENTED YET!',
			  'This is a future feature',
			  'info'
			);
		});

		//Pagination
		var page = 1;

		var rows = parseInt($("#num_rows").text());
    	var total = parseInt($("#num_pages").text());

		$("#next-button").on("click", function(){
			page += 1;
			$("#pagination").html("page " + page + " of " + total);
			if(page >= total){
				$("#next-button").attr("hidden", "true");
			}else if(page > 1){
				$("#back-button").removeAttr("hidden");
			}
		});

		$("#back-button").on("click", function(){
			page -= 1;
			$("#pagination").html("page " + page + " of " + total);
			if(page <= 1){
				$("#back-button").attr("hidden", "true");
			}else if(page < total){
				$("#next-button").removeAttr("hidden");
			}
		});

		$("#back-button").attr("hidden", "true");
		$("#pagination").html("page " + page + " of " + total);


		//Show menu to pick option
		function showMenu(url, option){
			if(role == "admin"){
				swal({
				  	title: 'Select department',
				  	type: 'question',
				  	input: 'select',
				  	inputOptions: {
				    	'it': 'IT',
				    	'hr': 'HR',
				    	'sales': 'Sales',
				    	'accounting': 'Accounting',
				    	'marketing': 'Marketing',
				    	'ceo': 'CEO'
			  },
			  	inputPlaceholder: 'List of departments',
			  	showCancelButton: true,

				}).then(function (results) {
					console.log(results);
					$.ajax({
				    	type: 'post',
				    	data: {"department": results, "option": option},
				    	url: "/view/listDayplan.php" ,success: function(result){
				        $("#main").html(result);
				    }});
				})
			} else {

				$.ajax({
			    	type: 'post',
			    	data: {"text": department, "option": option},
			    	url: "/view/" + url ,success: function(result){
			        $("#main").html(result);
			    }});
			}
		}

		//List dayplans
		$("#listDayplans").on("click", function(){
			var url = "listDayplan.php";
			var option = "all";
			showMenu(url, option);
		});

		//List today dayplans
		$("#listTodayDay").on("click", function(){
			var url = "listDayplan.php";
			var option = "today";
			showMenu(url, option);
		});

		//Show list of users
		function chooseUser(option){
			$.ajax({
		    	type: 'post',
		    	data: {"department": department, "role": role},
		    	dataType : 'json',
		    	url: "/view/listUsers.php", success: function(result){
		        var users = "<select class='form-control' id='select-user'>";

		        for(var i = 0; i < result.length; i++){
		        	users += "<option>" + result[i] + "</option>";
		        }

		        users += "</select>";

				swal({
				  title: 'SELECT EMPLOYEE',
				  type: 'question',
				  html:
				    users,
				  showCloseButton: true,
				  showCancelButton: true,
				  confirmButtonText:
	    		'<i id="sended"></i> SEND'
				})

				$("button.swal2-confirm.swal2-styled").on("click", function(){
					var user = $("#select-user").val();

					switch(option){
						case "listUserDay":
						$.ajax({
					    	type: 'post',
					    	data: {"text": user, "option": "user"},
					    	url: "/view/listDayplan.php" ,success: function(result){
					        $("#main").html(result);
					    }});
					    break;
					    case "updateUser":
					    $.ajax({
					    	type: 'post',
					    	data: {"department": department, "role": role, "login": user},
					    	url: "/view/updateUser.php",success: function(result){
					        $("#main").html(result);
					    }});
					    break;
					}
				});
		    }});
		}

		//List user dayplans
		$("#listUserDay").on("click", function(){
			chooseUser("listUserDay");
		});

		//List not sent dayplans
		$("#listNotSentDayplan").on("click", function(){
			console.log("clicked");
			$.ajax({
		    	type: 'post',
		    	data: {"department": department, "role": role},
		    	dataType : 'html',
		    	url: "/view/listNotSentDayplan.php" ,success: function(result){
		        $("#main").html(result);
		    }});
		});

		// Progress bar for dayplans
		var data = {};
		var completed = 0;
		var nonCompleted = 0;

		$.ajax({
	    	type: 'post',
		   	data: {"department": department, "role": role},
	    	url: "/view/dayplanComplete.php" ,success: function(result){
	    	data = JSON.parse(result);

	    	completed = parseInt((data[1].dayplans * 100) / data[0].users);
	    	nonCompleted = 100 - completed;

			$("#complete").css("width", completed + "%");
			$("#notComplete").css("width", nonCompleted + "%");
	    }});

		//Highlight left bar menus
		$("#panel-menus li").click(function () {
		    $("li").removeClass("active");
		    $(this).addClass("active");   
		});

		//Home button
		$("#home").on("click",function(){
			$(".profile-content").html("");
			$(".profile-content").append("<textarea>");
			$(".profile-content textarea").attr("id", "editor");
			CKEDITOR.replace('editor');
		});

		//Profile button
		$("#profile").on("click",function(){
			$.ajax({
		    	dataType : 'html',
		    	url: "/view/userProfile.php" ,success: function(result){
		        $(".profile-content").html(result);
		    }});
		});

		//Last dayplan button
		$("#lastDayplan").on("click",function(){
			$.ajax({
		    	type: 'post',
				data: {"text": login, "option": "recover"},
		    	dataType : 'html',
		    	url: "/view/listDayplan.php" ,success: function(result){
		    	$(".profile-content").html("");
				$(".profile-content").append("<textarea>");
				$(".profile-content textarea").attr("id", "editor");

				CKEDITOR.replace('editor');
				var editorElement = CKEDITOR.document.getById('editor');
				editorElement.setHtml(result);
		    }});
		});

		//Time to send the dayplan
		var deadline = new Date();
		var now = new Date();
		var sended = $("#sended-dayplan").text();
		console.log(sended);
		deadline.setHours("11");
		var result = (deadline.getHours() - now.getHours());
		if(sended === ""){

			if(now.getHours() > 7 && now.getHours() < 12){
				$("#time").html(" TIME: " + result + " HOURS TO SEND").css("color", "#5CB85C");
			}else {
				$("#time").html(" TIME: " + result + " HOURS DELAY").css("color", "red");
			}
		} else {
			$("#time").html(" SENT " + sended).css("color", "#98BFE0");
		}
	}});

	//Export table to word document
	$("#export").on("click", function() {
	 
	   if (!window.Blob) {
	      alert('Your legacy browser does not support this action.');
	      return;
	   }

	   var html, link, blob, url, css;
	   
	   // EU A4 use: size: 841.95pt 595.35pt;
	   // US Letter use: size:11.0in 8.5in;
	   
	   css = (
		    '<style>' +
		    '@page WordSection1{size: 900.95pt 700.35pt;mso-page-orientation: landscape;}' +
		    'div.WordSection1 {page: WordSection1;}' +
		    'table{border-collapse:collapse;text-align:center;}td{border:1px gray solid;width:15em;padding:8px;text-align:center;}'+
		    '</style>'
	   );

	    html = window.docx.innerHTML;
	   	blob = new Blob(['\ufeff', css + html], {
	    	type: 'application/msword'
	   	});
	   	url = URL.createObjectURL(blob);
	   	link = document.createElement('A');
	   	link.href = url;
	   	// Set default file name. 
	   	// Word will append file extension - do not add an extension here.
	   	link.download = 'Document';   
	   	document.body.appendChild(link);
	   	if (navigator.msSaveOrOpenBlob ) navigator.msSaveOrOpenBlob( blob, 'Document.doc'); // IE10-11
	   		else link.click();  // other browsers
	   	document.body.removeChild(link);
	});

	//Same height sidebar than editor
    var sidebar = $('#sidebar').height();
    var editor = $("#editor-container").height();
     
    // Set the height of all those children to whichever was highest 
    $('#sidebar').height(editor - 22);
});
