document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const fullname = document.getElementById("fullname");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    const profilePhoto = document.getElementById("profilePhoto");

    const fullnameError = document.getElementById("fullnameError");
    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("passwordError");
    const confirmPasswordError = document.getElementById("confirmPasswordError");
    const profilePhotoError = document.getElementById("profilePhotoError");

    form.addEventListener("submit", function (e) {
        let isValid = true;

        // Full Name
        if (fullname.value.trim() === "") {
            fullnameError.textContent = "Full name is required.";
            fullnameError.style.display = "block";
            isValid = false;
        } else {
            fullnameError.style.display = "none";
        }

        // Email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value.trim())) {
            emailError.textContent = "Enter a valid email address.";
            emailError.style.display = "block";
            isValid = false;
        } else {
            emailError.style.display = "none";
        }

        // Password
        if (password.value.length < 6) {
            passwordError.textContent = "Password must be at least 6 characters.";
            passwordError.style.display = "block";
            isValid = false;
        } else {
            passwordError.style.display = "none";
        }

        // Confirm Password
        if (password.value !== confirmPassword.value) {
            confirmPasswordError.textContent = "Passwords do not match.";
            confirmPasswordError.style.display = "block";
            isValid = false;
        } else {
            confirmPasswordError.style.display = "none";
        }

        // Profile Photo
        if (profilePhoto.files.length > 0) {
            const allowedExtensions = ["jpg", "jpeg", "png", "gif"];
            const fileExtension = profilePhoto.files[0].name.split(".").pop().toLowerCase();

            if (!allowedExtensions.includes(fileExtension)) {
                profilePhotoError.textContent = "Only JPG, JPEG, PNG, or GIF files are allowed.";
                profilePhotoError.style.display = "block";
                isValid = false;
            } else {
                profilePhotoError.style.display = "none";
            }
        } else {
            profilePhotoError.style.display = "none"; // optional image, so no error
        }

        if (!isValid) {
            e.preventDefault(); // Stop form from submitting
        }
    });
});
