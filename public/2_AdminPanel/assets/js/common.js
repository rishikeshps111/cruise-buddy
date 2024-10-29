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

function initIntlTelInput(id, message_id, form_id) {

    const input = document.querySelector(`#${id}`);
    const message = document.querySelector(`#${message_id}`);
    const form = document.querySelector(`#${form_id}`);

    const iti = window.intlTelInput(input, {
        initialCountry: "in",
        allowMobileNumbersOnly: true,
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/js/utils.js",
        hiddenInput: () => ({ phone: "full_phone", country: "country_code" }),
        strictMode: true,
        separateDialCode: true,
    });

    form.onsubmit = (event) => {
        if (!iti.isValidNumber()) {
            event.preventDefault();
            message.innerHTML = "Invalid number. Please try again.";
            return false;
        }
    };
}

function initializeValidator(formId, fieldsConfig) {
    const validator = new JustValidate(formId, {
        // errorFieldCssClass: 'is-invalid',
        errorLabelCssClass: 'invalid-feedback',
        submitFormAutomatically: true,
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


