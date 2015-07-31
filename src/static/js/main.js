$(document).ready(function(){

  // Initialize tooltips.
  $('[data-toggle="tooltip"]').tooltip();


  // Initialize Bars table.
  $('#bars-listing-table').dataTable({
    columnDefs: [
      { orderable: false, targets: [0, 6] },
      { searchable: false, targets: [0, 6] }
    ],
    order: [[ 1, 'asc' ]]
  });


  // Add handler for Bars table master checkbox toggle.
  $('.table-toggle', '#bars-listing-table').on('change', function() {
    var isChecked = $(this).prop('checked');
    $('.checkbox-delete').prop('checked', isChecked);
  });


  // Sends a delete request with a passed ID. Returns a Promise.
  function deleteBar(id) {
    return $.ajax({
      type: 'GET',
      url: '/deletebar',
      data: {
        id: id
      }
    });
  }


  // Add handler for deletion button.
  $('#delete-selected-bars').on('click', function(e) {
    e.preventDefault();
    var $checkedBoxes = $('.checkbox-delete:checked');
    var conf;

    if ($checkedBoxes.length <= 0) {
      alert('You haven\'t selected any bars.')
    } else if($checkedBoxes.length === 1) {
      conf = confirm('Are you sure want to delete this bars?');
    } else {
      conf = confirm('Are you sure want to delete these bars?');
    }

    if (conf) {
      $checkedBoxes.each(function() {
        var $this = $(this);
        var id = $this.data('barid');
        deleteBar(id).done(function() {
          $this.closest('tr').remove();
        });
      })
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