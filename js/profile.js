document.addEventListener("DOMContentLoaded", function () {
    console.log("JavaScript Loaded");

    let profileForm = document.getElementById("profileForm");

    if (!profileForm) {
        console.error("profileForm not found!");
        return;
    }

    profileForm.addEventListener("submit", function (e) {
        console.log("Form Submitted");
        let isValid = true;

        // Full Name Validation
        let fullname = document.getElementById("fullname");
        let fullnameError = document.getElementById("fullnameError");
        if (fullname && fullnameError) {
            let trimmedFullname = fullname.value.trim();
            if (trimmedFullname === "") {
                console.log("Fullname is empty");
                fullnameError.textContent = "Full Name is required!";
                fullnameError.style.display = "block";
                isValid = false;
            } else if (trimmedFullname.length < 3) {
                console.log("Fullname too short");
                fullnameError.textContent = "Full Name must be at least 3 characters!";
                fullnameError.style.display = "block";
                isValid = false;
            } else {
                fullnameError.style.display = "none";
            }
        }

        // Email Validation
        let email = document.getElementById("email");
        let emailError = document.getElementById("emailError");
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email && emailError) {
            let trimmedEmail = email.value.trim();
            if (!emailPattern.test(trimmedEmail)) {
                console.log("Invalid email");
                emailError.textContent = "Enter a valid email!";
                emailError.style.display = "block";
                isValid = false;
            } else {
                emailError.style.display = "none";
            }
        }

        // Password Validation (Optional)
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("profileForm").addEventListener("submit", function (event) {
                let password = document.getElementById("password").value.trim();
                let passwordError = document.getElementById("passwordError");
        
                if (password === "") {
                    passwordError.textContent = "Password is required to update your profile.";
                    passwordError.style.display = "block";
                    event.preventDefault(); // Prevent form submission
                } else {
                    passwordError.style.display = "none";
                }
            });
        });
        
        // Prevent form submission if validation fails
        if (!isValid) {
            console.log("Form validation failed, preventing submission");
            e.preventDefault();
        } else {
            console.log("Form is valid, proceeding with submission.");
        }
    });
});
