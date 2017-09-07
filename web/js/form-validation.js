$(function() {
    $("form[name='registration']").validate({
        rules: {
            username: "required",
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            username: "Please enter your username.",
            email: "Please enter a valid email address",
            password: "Please provide a password",
            repassword: "Please provide a password"
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});