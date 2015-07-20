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
             window.location = "/profile?action=deleted";
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
             window.location = "/profile?action=deleted";
        }
    });
        }


    });


});