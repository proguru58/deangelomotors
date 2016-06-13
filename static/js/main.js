function initializeUserRegistrationForm($base_path) {
    $("#new_user").validate({
        rules: {
            "email": {required: true, email: true},
            "credit_card[cardholder_name]": {required: true},
            "credit_card[credit_card_number]": {required: true, number: true},
            "credit_card[credit_card_expiration_month]": {required: true, number: true, min: 1, max: 12},
            "credit_card[credit_card_expiration_year]": {required: true, number: true},
            "credit_card[cvv]": {required: true, minlength: 3, number: true}
        },
        messages: {
            "email": {
                remote: $.validator.format("{0} is already in use.")
            }
        }
    });
    $("#amount_photos_count").change(function() {
        var totalIndicator = '$' + parseInt($(this).val()) * 2;
        $('#amount_total_value').text(totalIndicator);
    });
}

function initializeUserEmailVerifyForm() {
    $("#email_verify").validate({
        rules: {
            "email": {required: true, email: true}
        }
    });
}
function initializeUserLoginForm() {
    $("#users_login_form").validate({
        rules: {
            "email": {required: true, email: true},
            "code": {required: true}
        }
    });
}
