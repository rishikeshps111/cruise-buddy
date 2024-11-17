function showToast(message, duration, type = 'success') {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: duration,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: type,
        title: message
    });
}

function initIntlTelInput(id, message_id, form_id, full_phone = "full_phone", country_code = "country_code") {

    const input = document.querySelector(`#${id}`);
    const message = document.querySelector(`.${message_id}`);
    const form = document.querySelector(`#${form_id}`);

    const iti = window.intlTelInput(input, {
        initialCountry: "in",
        allowMobileNumbersOnly: true,
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/js/utils.js",
        hiddenInput: () => ({ phone: full_phone, country: country_code }),
        strictMode: true,
        separateDialCode: true,
    });

    // const errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

    // form.onsubmit = (event) => {
    //     message.innerHTML = "";
    //     if (!iti.isValidNumber()) {
    //         event.preventDefault();
    //         const errorCode = iti.getValidationError(); 
    //         const msg = errorMap[errorCode] || "Invalid number"; 

    //         const messageDiv = document.createElement('div');
    //         messageDiv.className = 'invalid-feedback'; 
    //         messageDiv.innerText = msg; 

    //         message.innerHTML = ""; 
    //         message.appendChild(messageDiv); 

    //         return false; 
    //     } else {
    //         message.innerHTML = "";
    //     }
    // };
}

function initializeValidator(formId, fieldsConfig, submitForm = false) {
    const validator = new JustValidate(formId, {
        // errorFieldCssClass: 'is-invalid',
        errorLabelCssClass: 'invalid-feedback',
        submitFormAutomatically: submitForm,
        validateBeforeSubmitting: true,
        errorLabelStyle: {
            color: "#FF5E5E"
        }
    });

    Object.keys(fieldsConfig).forEach(field => {
        const rules = fieldsConfig[field].rules; // Get the rules for the field
        const options = fieldsConfig[field].options; // Get any additional options

        // Add the field with rules and options
        validator.addField(field, rules, options);
    });

    return validator;
}

function previewImage(event, previewId) {
    const preview = document.getElementById(previewId);
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.style.display = 'block';
    preview.onload = () => URL.revokeObjectURL(preview.src);  // Release memory when loaded
}

// Function to clear all error messages
function clearErrorMessages() {
    document.querySelectorAll('.invalid-feedback').forEach(el => {
        el.innerHTML = ''; // Clear messages
        el.classList.add('d-none'); // Hide
    });
}

// Function to show error messages
function showErrorMessages(errors) {
    clearErrorMessages(); // Clear existing errors

    Object.keys(errors).forEach(field => {
        const errorContainer = document.querySelector(`[name="${field}"]`).closest('.mb-3').querySelector('.invalid-feedback');
        if (errorContainer) {
            errorContainer.innerHTML = errors[field].map(message => `<p>${message}</p>`).join(''); // Populate messages
            errorContainer.classList.remove('d-none'); // Show error container
        }
    });
}

function confirmDelete(url, table) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Axios DELETE request
            axios.delete(url)
                .then(response => {
                    // Handle success
                    Swal.fire(
                        'Deleted!',
                        response.data.message, // Use custom message or API response message
                        'success'
                    ).then(() => {
                        table.ajax.reload(null, false);
                    });
                })
                .catch(error => {
                    // Handle error
                    Swal.fire(
                        'Error!',
                        'There was a problem deleting the owner. Please try again.',
                        'error'
                    );
                });
        }
    });
}

function formatPhone(phone) {
    try {
        const phoneNumber = libphonenumber.parsePhoneNumber(phone);
        return phoneNumber.formatInternational();
    } catch (error) {
        console.error("Invalid phone number:", error);
        return phone;
    }
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

