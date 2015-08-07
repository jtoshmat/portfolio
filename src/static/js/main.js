$(document).ready(function(){

  // Initialize tooltips.
  $('[data-toggle="tooltip"]').tooltip();


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


  // Change status of bar with a passed ID and new status value.
  function updateBarStatus(id, status) {
    var url = '/admin/bars/approve/' + id;
    return $.ajax({
      type: 'POST',
      url: url,
      data: {
        val: status
      }
    });
  }


  var barStatuses = {
    APPROVED: 'approved',
    AWAITING_APPROVAL: 'awaiting-approval',
    REJECTED: 'rejected'
  };
  var statusArray = [
    barStatuses.APPROVED,
    barStatuses.AWAITING_APPROVAL,
    barStatuses.REJECTED
  ];


  /**
   * Bars view handlers.
   */
  // Initialize Bars table.
  var barsTable = $('#bars-listing-table').DataTable({
    columnDefs: [
      {
        orderable: false,
        searchable: false,
        targets: [0, 6]
      },
      {
        orderable: false,
        visible: false,
        targets: [7]
      }
    ],
    order: [[ 1, 'asc' ]]
  });
  var statusColumn = barsTable.column(7);

  // Add handler for status dropdown filter.
  $('#bar-status-filter').on('change', function(e) {
    statusColumn.search($(e.currentTarget).val()).draw();
  });


  // Add handler for Bars table master checkbox toggle.
  $('.table-toggle', '#bars-listing-table').on('change', function() {
    var isChecked = $(this).prop('checked');
    $('.checkbox-delete').prop('checked', isChecked);
  });


  // Handlers for approve/reject buttons
  $('.edit-actions').on('click', '.dynamic-action', function(e) {
    e.preventDefault();
    var $this = $(e.currentTarget);
    var $actionContainer = $this.closest('.edit-actions')
    var id = $this.data('barid');
    var newStatus = {
      code: 0,
      cssClass: barStatuses.AWAITING_APPROVAL
    };
    var currentStatus = barStatuses.AWAITING_APPROVAL;

    // Figure out the current status of the bar.
    if ($actionContainer.hasClass(barStatuses.APPROVED)) {
      currentStatus = barStatuses.APPROVED;
    } else if ($actionContainer.hasClass(barStatuses.REJECTED)) {
      currentStatus = barStatuses.REJECTED;
    }

    // Compare this to the action pressed and set the new status.
    if ($this.data('status') === barStatuses.APPROVED &&
        currentStatus !== barStatuses.APPROVED) {
      newStatus.code = 1;
      newStatus.cssClass = barStatuses.APPROVED;
    } else if ($this.data('status') === barStatuses.REJECTED &&
        currentStatus !== barStatuses.REJECTED) {
      newStatus.code = -1;
      newStatus.cssClass = barStatuses.REJECTED;
    }

    // Use the AJAX endpoint to update the bar, then update the table.
    updateBarStatus(id, newStatus.code).done(function() {
      $actionContainer.removeClass(statusArray.join(' '))
        .addClass(newStatus.cssClass);

      // If this was done in the bars listing table, update it.
      if ($this.closest('#bars-listing-table').length > 0) {
        var row = $(e.currentTarget).closest('tr').get(0);
        var rowIndex = barsTable.row(row).index();
        var status = $(e.currentTarget).data('status')
        barsTable.cell(rowIndex, 7).data(status);
        barsTable.draw();
      }

      // If this was done in an edit bar field, update it.
      if ($this.closest('.form-edit-bar').length > 0) {
        $('input[name="status"]').val(newStatus.code);
      }
    });
  });


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
      });
    }
  });


  /**
   * Edit Bar views handler.
   */
  $('#delete-bar').on('click', function(e) {
    e.preventDefault();
    var id = $(e.currentTarget).data('barid');
    var conf = confirm('Are you sure you want to delete this bar?');
    if (conf) {
      deleteBar(id).done(function() {
        window.location.pathname = '/bars';
      });
    }
  });

  $('.bar-logo-upload').change(function(){
    if (window.FileReader && this.files && this.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        var $img = $('<img>')
        $img.attr('src', e.target.result).addClass('bar-logo');
        $('.bar-logo-container').html($img);
      };
      reader.readAsDataURL(this.files[0]);
    }
  });
/*  $('.action-upload-logo').on('click', function(e) {
    e.preventDefault();
    var url = e.currentTarget.href;
    var popup = window.open(url, 'upload', 'toolbar=no, status=no, scrollbars=yes, ' +
        'resizable=no, top=200, left=400, width=400, height=450');
    if (window.localStorage) {
      $(window).one('storage', function() {
        var $img = $('<img>')
        $img.attr('src', window.localStorage.getItem('barFile'))
          .addClass('bar-logo');
        $('.bar-logo-container').html($img);
        window.localStorage.removeItem('barFile');
      });
    } else {
      var timer = setInterval(function() {
        if(popup.closed) {
          clearInterval(timer);
          document.location.reload();
        }
      }, 1000);
    }
  });*/


  /**
   * Initialize datetime pickers.
   */
  $('.datetime-picker').datetimepicker({
    inline: true,
    sideBySide: true
  }).attr('type', 'hidden');

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