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

  // Sends a delete request with a passed ID. Returns a Promise.
  function deleteEvent(id) {
    return $.ajax({
      type: 'GET',
      url: '/deletebevent',
      data: {
        id: id
      }
    });
  }

  // Sends a delete request with a passed ID. Returns a Promise.
  function deleteGame(id) {
    return $.ajax({
      type: 'POST',
      url: '/deletegame/' + id
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


  var stateSelect = {
    us: '<select name="state" class="form-control">' +
      '<option value=""></option><option value="AK">AK</option>' +
      '<option value="AL">AL</option><option value="AR">AR</option>' +
      '<option value="AZ">AZ</option><option value="CA">CA</option>' +
      '<option value="CO">CO</option><option value="CT">CT</option>' +
      '<option value="DC">DC</option><option value="DE">DE</option>' +
      '<option value="FL">FL</option><option value="GA">GA</option>' +
      '<option value="HI">HI</option><option value="IA">IA</option>' +
      '<option value="ID">ID</option><option value="IL">IL</option>' +
      '<option value="IN">IN</option><option value="KS">KS</option>' +
      '<option value="KY">KY</option><option value="LA">LA</option>' +
      '<option value="MA">MA</option><option value="MD">MD</option>' +
      '<option value="ME">ME</option><option value="MI">MI</option>' +
      '<option value="MN">MN</option><option value="MO">MO</option>' +
      '<option value="MS">MS</option><option value="MT">MT</option>' +
      '<option value="NC">NC</option><option value="ND">ND</option>' +
      '<option value="NE">NE</option><option value="NH">NH</option>' +
      '<option value="NJ">NJ</option><option value="NM">NM</option>' +
      '<option value="NV">NV</option><option value="NY">NY</option>' +
      '<option value="OH">OH</option><option value="OK">OK</option>' +
      '<option value="OR">OR</option><option value="PA">PA</option>' +
      '<option value="RI">RI</option><option value="SC">SC</option>' +
      '<option value="SD">SD</option><option value="TN">TN</option>' +
      '<option value="TX">TX</option><option value="UT">UT</option>' +
      '<option value="VA">VA</option><option value="VT">VT</option>' +
      '<option value="WA">WA</option><option value="WI">WI</option>' +
      '<option value="WV">WV</option><option value="WY">WY</option>' +
      '<option value="--" disabled="disabled">---</option>' +
      '<option value="AA">AA</option><option value="AE">AE</option>' +
      '<option value="AP">AP</option><option value="AS">AS</option>' +
      '<option value="FM">FM</option><option value="GU">GU</option>' +
      '<option value="MH">MH</option><option value="MP">MP</option>' +
      '<option value="PR">PR</option><option value="PW">PW</option>' +
      '<option value="VI">VI</option></select>',
    ca: '<select name="state" class="form-control">' +
      '<option value=""></option>' +
      '<option value="Alberta">Alberta</option>' +
      '<option value="British Columbia">British Columbia</option>' +
      '<option value="Manitoba">Manitoba</option>' +
      '<option value="New Brunswick">New Brunswick</option>' +
      '<option value="Newfoundland and Labrador">Newfoundland and ' +
      'Labrador</option><option value="Northwest Territories">' +
      'Northwest Territories</option><option value="Nova Scotia">' +
      'Nova Scotia</option><option value="Nunavut">Nunavut</option>' +
      '<option value="Ontario">Ontario</option>' +
      '<option value="Prince Edward Island">Prince Edward Island</option>' +
      '<option value="Quebec">Quebec</option>' +
      '<option value="Saskatchewan">Saskatchewan</option>' +
      '<option value="Yukon">Yukon</option></select>',
    generic: '<input type="text" class="form-control" name="state">'
  };


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


  // Add handler for Bars table master checkbox toggle.
  $('.table-toggle').on('change', function(e) {
    var isChecked = $(this).prop('checked');
    $(e.currentTarget).closest('table').find('.checkbox-delete')
      .prop('checked', isChecked);
  });


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
          barsTable.row($this.closest('tr')).remove().draw();
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

  $('.bar-logo-upload').on('change', function() {
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

  // Swaps the state input for a select depending on the country chosen.
  $('select[name="country"]').on('change', function(e) {
    var $target = $(e.target);
    var $stateInputs = $('select[name="state"], input[name="state"]');
    $stateInputs.each(function() {
      var originalValue = $(this).val();
      var $newInput;
      switch ($target.val()) {
        case 'US' :
          $newInput = $(stateSelect.us);
          break;
        case 'CA' :
          $newInput = $(stateSelect.ca);
          break;
        default :
          $newInput = $(stateSelect.generic);
      }
      $(this).replaceWith($newInput);
      $newInput.val(originalValue);
    });
  }).trigger('change');

  var $tzselect = $('select[name="timezone"]');
  if ($tzselect.length > 0 && !$tzselect.val()) {
    var tz = jstz.determine();
    var timezone = tz.name();
    $tzselect.val(timezone);
  }


  /**
   * Games list view handlers.
   */
  if ($('#games-listing-table').length > 0) {
    var gamesTable = $('#games-listing-table').DataTable({
      columnDefs: [
        {
          orderable: false,
          targets: [0, 6, 7]
        },
        {
          searchable: false,
          targets: [0, 7]
        }
      ],
      order: [[ 1, 'asc' ]]
    });
    $.fn.dataTable.ext.search.push(
      function( settings, data, dataIndex ) {
        var now = new Date().getTime() / 1000;
        var filter = $('#game-filter').val();
        var timestamp = parseInt( data[1] );
        if (filter === 'upcoming') {
          return timestamp >= now ? true : false;
        } else if (filter === 'past') {
          return now >= timestamp ? true : false;
        } else {
          return true;
        }
      }
    );
    $('#game-filter').on('change', function(e) {
      gamesTable.draw();
    }).trigger('change');

    // Add handler for games deletion button.
    $('#delete-selected-games').on('click', function(e) {
      e.preventDefault();
      var $checkedBoxes = $('.checkbox-delete:checked');
      var conf;

      if ($checkedBoxes.length <= 0) {
        alert('You haven\'t selected any games.')
      } else if($checkedBoxes.length === 1) {
        conf = confirm('Are you sure want to delete this games?');
      } else {
        conf = confirm('Are you sure want to delete these games?');
      }

      if (conf) {
        $checkedBoxes.each(function() {
          var $this = $(this);
          var id = $this.data('gid');
          deleteGame(id).done(function() {
            gamesTable.row($this.closest('tr')).remove().draw();
          });
        });
      }
    });
  }

  /**
   * Events list view handlers.
   */
  if ($('#bevents-listing-table').length > 0) {
    var eventsTable = $('#bevents-listing-table').DataTable({
      columnDefs: [
        {
          orderable: false,
          targets: [0, 6]
        },
        {
          searchable: false,
          targets: [0, 6]
        }
      ],
      order: [[ 1, 'asc' ]]
    });
    $.fn.dataTable.ext.search.push(
      function( settings, data, dataIndex ) {
        var now = new Date().getTime() / 1000;
        var filter = $('#event-filter').val();
        var timestamp = parseInt( data[1] );
        if (filter === 'upcoming') {
          return timestamp >= now ? true : false;
        } else if (filter === 'past') {
          return now >= timestamp ? true : false;
        } else {
          return true;
        }
      }
    );
    $('#event-filter').on('change', function(e) {
      eventsTable.draw();
    }).trigger('change');

    // Add handler for event deletion button.
    $('#delete-selected-events').on('click', function(e) {
      e.preventDefault();
      var $checkedBoxes = $('.checkbox-delete:checked');
      var conf;

      if ($checkedBoxes.length <= 0) {
        alert('You haven\'t selected any events.')
      } else if($checkedBoxes.length === 1) {
        conf = confirm('Are you sure want to delete this event?');
      } else {
        conf = confirm('Are you sure want to delete these events?');
      }

      if (conf) {
        $checkedBoxes.each(function() {
          var $this = $(this);
          var id = $this.data('eventid');
          deleteEvent(id).done(function() {
            // TODO: is this the best way to remove tables? Maybe there's a Data
            // Tables method that we should be using? Also, for this we need
            // to revert the table row back to the game info.
            var $row =  $this.closest('tr');
            var gamedate = $this.data('gamedate');
            var gametime = $this.data('gametime');
            var gameunix = $this.data('gameunix');
            var gametimestring = $this.data('timestring');
            if (gamedate) {
              // We're deleting an event attached to a game, so we need to
              // redraw the table with the original game time.

              // Remove the checkbox.
              $this.remove();

              // Update the date column.
              $row.find('td').eq(1).data('order', gameunix)
                .data('filter', gameunix).text(gamedate).end()
              // Update the time column.
                .eq(2).data('order', gametimestring).text(gametime).end()
              // Update the event title column
                .eq(3).addClass('text-muted').text('No Event Planned').end()
              // Update the action column
                .eq(6).html(function() {
                  var url = '/addbevent/' + $row.data('barid') + '?gid=' +
                      $row.data('gameid');
                  var html = '<a href="' + url + '">' +
                    '<span class="glyphicon glyphicon-plus" ' +
                    'data-toggle="tooltip" data-placement="bottom" ' +
                    'title="Create an event for this game"' +
                    'aria-hidden="true"></span><span class="sr-only">' +
                    '<span class="sr-only">Create an event for this game' +
                    '</span></a>';
                  return html;
                });

              // Redraw the table.
              eventsTable.row($row).draw();

            } else {
              // This deleted event is not attached to a game. We can just
              // remove it as normal.
              eventsTable.row($row).remove().draw();
            }
          });
        });
      }
    });
  }


  /**
   * Edit event view handlers.
   */
  $('#delete-event').on('click', function(e) {
    e.preventDefault();
    var id = $(e.currentTarget).data('eventid');
    var barid = $(e.currentTarget).data('barid');
    var conf = confirm('Are you sure you want to delete this event?');
    if (conf) {
      deleteEvent(id).done(function() {
        window.location.pathname = '/bevents/' + barid;
      });
    }
  });


  /**
   * Edit game view handlers.
   */
  $('#delete-game').on('click', function(e) {
    e.preventDefault();
    var id = $(e.currentTarget).data('gid');
    var conf = confirm('Are you sure you want to delete this event?');
    if (conf) {
      deleteGame(id).done(function() {
        window.location.pathname = '/allgames';
      });
    }
  });


  /**
   * User list view handlers.
   */
  if ($('#user-listing-table').length > 0) {
    var userTable = $('#user-listing-table').DataTable({
      columnDefs: [
        {
          orderable: false,
          targets: [0, 4]
        },
        {
          searchable: false,
          targets: [0, 4]
        }
      ],
      order: [[ 0, 'asc' ]]
    });

    $('.delete-user').on('click', function(e) {
      e.preventDefault();
      var conf = confirm('Are you sure you want to delete this user?');

      if (conf) {
        $(e.currentTarget).closest('form.delete-user-form').submit();
      }
    });
  }


  /**
   * Initialize datetime pickers.
   */
  $('.datetime-picker').each(function() {
    var options = {
      sideBySide: true
    };
    if ($(this).hasClass('limit-date')) {
      options.enabledDates = [$(this).data('date')];
    }
    $(this).datetimepicker(options);
  });

  /**
   * Initialize chara ter counters.
   */
  $('.character-limit').on('keyup', function(e) {
    var $this = $(this);
    var limit = parseInt($this.attr('maxlength'), 10);
    var current = $this.val().length;
    if (current > limit) {
      e.preventDefault();
    } else {
      var $count = $this.siblings('.character-count');
      var message = '';
      message += limit - current;
      message += limit === 1 ? ' character' : ' characters';
      message += ' remaining';
      $count.text(message);
      if (limit - current <= 10) {
        $count.addClass('text-danger');
      } else {
        $count.removeClass('text-danger');
      }
    }
  }).trigger('keyup');
});