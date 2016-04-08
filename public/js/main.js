$(document).ready(function(e){
    $('.patient-register-form').submit(false);
    e.preventDefault;

    $('input[type="submit"]').click(function(){
        $('.alert').html('');
        callAjax();
    });
});

function callAjax() {
    $('#new-patient-error').show();
    $.ajax({
            type: 'POST',
            url: '/patient',
            data: $('.patient-register-form').serialize()
        })
        .success(function (data) {
            if (typeof data.status === 'number'){

                if (data.status==200){
                    $('#new-patient-error').removeClass();
                    $('#new-patient-error').addClass('alert alert-success');
                    $('.alert').html(data.message);
                    return false;
                }

                $('#new-patient-error').removeClass();
                $('#new-patient-error').addClass('alert alert-warning');
                $('.alert').html(data.message);
                return false;
            }
            $('.alert').html(data);
            $('#new-patient-error').removeClass();
            $('#new-patient-error').addClass('alert alert-danger');
            //$('.login-form input[type=email]').val('');
            //$('.login-form input[type=text]').val('');
        })
        .fail(function () {
            $('#new-patient-error').removeClass();
            $('#new-patient-error').addClass('alert alert-danger');
            $('.alert').html('Please try again');
        })

}

