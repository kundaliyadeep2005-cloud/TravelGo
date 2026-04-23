document.getElementById("forgotPasswordForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    let email = document.getElementById("email").value;
    let message = document.getElementById("message");

    if (email.trim() !== "") {
        message.style.color = "green";
        message.textContent = "A password reset link has been sent to your email.";
    } else {
        message.style.color = "red";
        message.textContent = "Please enter a valid email address.";
    }
});
