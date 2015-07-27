$(document).ready(function(){
	 

    $('#example').DataTable();


    $('.delete_bar').click(function(){
    	var id = $(this).attr('id');
    	id = id.substr(3);
    	id = parseInt(id);
    	

    	var conf = confirm("Are you sure you want to delete it?");

    	if (conf){
    		deleteBar(id);
    	}

    	function deleteBar(id){
     $.ajax({
        url: '/deletebar?id='+id,
        type: "get",
        data: {/* the id goes here */},
        success: function(data, textStatus, jqXHR) {
             window.location = "/bars?action=deleted";
        }
    });
    	}


    });

//Delete Bar events

    $('.delete_bevent').click(function(){
        var id = $(this).attr('id');
        id = id.substr(3);
        id = parseInt(id);
        

        var conf = confirm("Are you sure you want to delete it?");

        if (conf){
            deleteBevent(id);
        }

    function deleteBevent(id){
     $.ajax({
        url: '/deletebevent?id='+id,
        type: "get",
        data: {/* the id goes here */},
        success: function(data, textStatus, jqXHR) {
             window.location = "/bars?action=deleted";
        }
    });
        }


    });

    //Delete a user

    $('.delete_user').click(function(){
        var id = $(this).attr('id');
        id = id.substr(3);
        id = parseInt(id);


        var conf = confirm("Are you sure you want to delete the user?");

        if (conf){
            deleteUser(id);
        }

        function deleteUser(id){
            $.ajax({
                url: '/user/delete/'+id,
                type: "get",
                data: {/* the id goes here */},
                success: function(data, textStatus, jqXHR) {
                    window.location = "/users?action="+data;
                }
            });
        }
    });


	$('.upload_user_image').click(function(){
		var bid = $(this).attr('id');
		bid = bid.substr(3);
		bid = parseInt(bid);

		var wnd = window.open("/upload?bid="+bid, "_blank", "toolbar=no, status=no, scrollbars=yes, resizable=no," +
			" top=200," +
			" left=400," +
			" width=400," +
			" height=450");




		setTimeout(function() {
			wnd.close();
		}, 50000);
		return false;

	});




});