document.getElementById("resetPasswordForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let token = document.getElementById("token").value;
    let password = document.getElementById("password").value;
    let message = document.getElementById("message");

    fetch("reset-password.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "token=" + encodeURIComponent(token) + "&password=" + encodeURIComponent(password)
    })
    .then(response => response.text())
    .then(data => {
        if (data === "success") {
            message.innerHTML = "<span class='text-success'>Password updated successfully! You can now <a href='sign-in.php'>sign in</a>.</span>";
        } else if (data === "invalid_token") {
            message.innerHTML = "<span class='text-danger'>Invalid or expired token.</span>";
        } else {
            message.innerHTML = "<span class='text-danger'>Error updating password. Please try again.</span>";
        }
    })
    .catch(error => console.error("Error:", error));
});
