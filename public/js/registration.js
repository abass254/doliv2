jQuery(document).ready(function(){
    

    $('.btn-register').on('click', function(){
        
    })
});


function registerUser() {
    // Gather form data
    const userData = {
        name: $('#name').val(),
        email: $('#email').val(),
        password: $('#password').val(),
        confirmPassword: $('#confirmPassword').val() // If needed
    };

    $.ajax({
        url: '/api/register',  // Replace with your registration endpoint
        type: 'POST',
        data: JSON.stringify(userData),
        contentType: 'application/json',
        success: function(response) {
            alert("Registration successful!");
            window.location.href = "/login"; // Redirect to login page
        },
        error: function(xhr, status, error) {
            console.error("Registration failed:", xhr.responseText);
            alert("Error during registration. Please try again.");
        }
    });
}