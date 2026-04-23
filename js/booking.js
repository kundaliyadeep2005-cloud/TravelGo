document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("bookingForm");

    function validateField(fieldId, errorId, errorMessage, pattern = null) {
        const field = document.getElementById(fieldId);
        const errorElement = document.getElementById(errorId);
        const value = field.value.trim();

        if (!value || (pattern && !pattern.test(value))) {
            errorElement.textContent = errorMessage;
            field.classList.add("is-invalid");
        } else {
            errorElement.textContent = "";
            field.classList.remove("is-invalid");
        }
    }

    form.addEventListener("submit", function (event) {
        let valid = true;

        validateField("name", "nameError", "⚠ Full Name is required.");
        validateField("email", "emailError", "⚠ Enter a valid email.", /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/);
        validateField("phone", "phoneError", "⚠ Enter a valid 10-digit phone number.", /^[0-9]{10}$/);
        validateField("packageName", "packageNameError", "⚠ Package Name is required.");
        validateField("packageDuration", "packageDurationError", "⚠ Please select a Package Duration.");

        // Guests validation (1-7 range)
        const guests = document.getElementById("guests");
        const guestsError = document.getElementById("guestsError");
        if (!guests.value || guests.value < 1 || guests.value > 7) {
            guestsError.textContent = "⚠ Guests must be between 1 and 7.";
            guests.classList.add("is-invalid");
            valid = false;
        } else {
            guestsError.textContent = "";
            guests.classList.remove("is-invalid");
        }

        // Date validation
        const startDate = document.getElementById("startDate");
        const endDate = document.getElementById("endDate");
        const startDateError = document.getElementById("startDateError");
        const endDateError = document.getElementById("endDateError");

        if (!startDate.value) {
            startDateError.textContent = "⚠ Start Date is required.";
            startDate.classList.add("is-invalid");
            valid = false;
        } else {
            startDateError.textContent = "";
            startDate.classList.remove("is-invalid");
        }

        if (!endDate.value) {
            endDateError.textContent = "⚠ End Date is required.";
            endDate.classList.add("is-invalid");
            valid = false;
        } else if (new Date(endDate.value) <= new Date(startDate.value)) {
            endDateError.textContent = "⚠ End Date must be after Start Date.";
            endDate.classList.add("is-invalid");
            valid = false;
        } else {
            endDateError.textContent = "";
            endDate.classList.remove("is-invalid");
        }

        if (!valid) {
            event.preventDefault();
        }
    });

    // Show errors only when incorrect data is entered
    document.querySelectorAll("input, select").forEach((element) => {
        element.addEventListener("blur", function () {
            validateField(
                element.id,
                element.nextElementSibling.id,
                element.getAttribute("data-error"),
                element.pattern ? new RegExp(element.pattern) : null
            );
        });
    });
});
