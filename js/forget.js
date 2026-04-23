document.getElementById("forgotPasswordForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    let email = document.getElementById("email").value;
    let message = document.getElementById("message");

    fetch("forgot-password.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "email=" + encodeURIComponent(email)
    })
    .then(response => response.text())
    .then(data => {
        if (data === "success") {
            message.innerHTML = "<span class='text-success'>A reset link has been sent to your email.</span>";
        } else if (data === "email_not_found") {
            message.innerHTML = "<span class='text-danger'>Email not found!</span>";
        } else {
            message.innerHTML = "<span class='text-danger'>Error sending email!</span>";
        }
    })
    .catch(error => console.error("Error:", error));
});
