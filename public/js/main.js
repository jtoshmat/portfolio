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

	$('.approve_bar').click(function(){
		var id = $(this).attr('id');
		id = id.substr(3);
		var val = 0;

		var cls = $(this).hasClass('approved');
	    val = (cls)?0:1;
		var msg = (cls)?'disapprove':'approve';
		var conf = confirm("Are you sure you want to do it?");
		var imgsrc = (cls)?"/img/approved.png":"/img/notapproved.png";

		if (conf){
			$.ajax({
				url: '/admin/bars/appprove/'+id,
				type: "post",
				data: {'val':val},
				success: function(data, textStatus, jqXHR) {
					if ($("#ad_"+id).attr('src')=='/img/notapproved.png'){
						$("#ad_"+id).attr('src', '/img/approved.png');
					}else{
						$("#ad_"+id).attr('src', '/img/notapproved.png');
					}
					//window.location = "/bars?action=approved";
				}
			});
		}



	});

	$('.delete_game').click(function(){
		var id = $(this).attr('id');
		id = id.substr(3);
		var conf = confirm("Are you sure you want to do it?");
		if (conf){
			$.ajax({
				url: '/deletegame/'+id,
				type: "post",
				data: {},
				success: function(data, textStatus, jqXHR) {
					$('#id_'+id).closest('tr').remove();
					alert('The game '+id+" has been deleted");
				}
			});
		}



	});

});