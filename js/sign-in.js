document.getElementById("signInForm").addEventListener("submit", function (e) {
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    let emailError = document.getElementById("emailError");
    let passwordError = document.getElementById("passwordError");

    let isValid = true; // Assume form is valid

    // Reset previous error messages
    emailError.style.display = "none";
    passwordError.style.display = "none";

    if (email === "") {
        emailError.innerText = "Email is required!";
        emailError.style.display = "block";
        isValid = false;
    }

    if (password === "") {
        passwordError.innerText = "Password is required!";
        passwordError.style.display = "block";
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault(); // Stop form submission
    }
});
