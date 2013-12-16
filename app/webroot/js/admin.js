$(document).ready(function(){

	$("#wizard .wizard_label" ).on("click", function() {
	var id = $(this).attr("id");
	if ($("#wizard ."+id).css('display')=='none'){
	 $("#wizard ."+id).fadeIn("fast");
	 $("#wizard ."+id).css('display')=='block';
	}else{
		$("#wizard ."+id).fadeOut("fast");
		$("#wizard ."+id).css('display')=='none';
	}});

	//redirect to add new page when "Create ..." is selected
	$("#customs_index .custom_menu" ).on("change", function() {
		var folder = "cna";
		var selection = $(this).find(':selected').val();
		var id = $(this).attr("title");
			if (selection==0){
				url=location.protocol+"//"+document.domain+"/"+folder+"/"+id+"/add";
				document.location = url;
			}else{
				return false;
			}
	});




	$("#CustomIndexForm tbody .bus_categories").on("click", function() {
		var id = $(this).parent().attr("id");

		if ($("#"+id+" .bus_groups").css("display") == 'table-row'){

			$("#"+id+" .bus_groups").fadeOut("fast");

		}else{
			$("#"+id+" .bus_groups").fadeIn("fast");
		}
	});

	$("#bus_expand_collapse").on("click", function() {
		if ($('#bus_expand_collapse').is(':checked')) {
			$("#CustomIndexForm .bus_groups").fadeIn("fast");
			$("#label_expand_collapse").text("Collapse All");
		} else {
			$("#CustomIndexForm .bus_groups").fadeOut("fast");
			$("#label_expand_collapse").text("Expand All");
		}
	});

	$('#UserLoginForm').submit(function() {
		var flag = false;
		if ( $("#flashMessage").length==0){
			$("#login_message").html("<div class=\"message\" id=\"flashMessage2\"></div>");
		}else{
			$("#login_message").hide();
		}
		var inputs = $('#UserLoginForm .required input');
		 $(inputs).each(function(){
			 $(this).css('border','none');
			 if ($(this).val().length==0){
				 $(this).css('border','1px solid #f00');
				 flag=false;
			 }else{
				 flag=true;
			 }
		 });
		 if ( $("#flashMessage").length>0){
			 if (flag==false){
				 $("#flashMessage").html("Please enter username and password");
			 }

		 }else{
			 $("#flashMessage2").html("Please enter username and password");
		 }
		 if (flag==false){return false;}
		 $("#flashMessage").hide();
		 $("#flashMessage2").hide();
	});


	//CNA-1 jira fix 11/25/2013 3:00 pm
	$('#CustomIndexForm').submit(function() {
		var CustomBusinessId = $("#CustomBusinessId").val() || 0;
		var CustomQuestionId = $("#CustomQuestionId").val() || 0;
		var CustomResponseId = $("#CustomResponseId").val() || 0;

		if (CustomBusinessId==0){
			alert("Please select Business");
			return false;
		}
		if (CustomQuestionId==0){
			alert("Please select Question");
			return false;
		}
		if (CustomResponseId==0){
			alert("Please select Response");
			return false;
		}

		$(":submit").attr('disabled','disabled');
		$(":submit").css("background","#A8A7A7");
		$(":submit").css("color","#000");
	});

	if ( $("#flashMessage").length>0){
		$('html, body').animate({ scrollTop: $('#flashMessage').offset().top }, 'slow');
	}

	//CNA-9 jira fix 11/25/2013 5:25 pm
	var flag = 0;
	$('body form').submit(function(){
		$("form .required").each(function(){
			var inp = $(this).find('input').val() || '';
			if ($(this).find('input').val()==''){
				alert("Required fields must be filled or selected");
				flag=0;
				return false;
			}else{
				flag=1;
			}

		});
		if (flag==0){
			return false;
		}
	});




});