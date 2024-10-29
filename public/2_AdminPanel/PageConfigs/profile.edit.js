document.addEventListener('DOMContentLoaded', function () {

    const sessionMessageElement = document.getElementById('session-message');
    if (sessionMessageElement) {
        const message = sessionMessageElement.getAttribute('data-message');
        const type = sessionMessageElement.getAttribute('data-type');
        showToast(message, 3000, type);
    }

    initIntlTelInput('phone','validate-phone','UpdateProfile');
    ActiveTab();
});

document.querySelector('.avatar-upload-button').addEventListener('click', function () {
    document.getElementById('avatar').click();
});

document.getElementById('avatar').addEventListener('change', function (event) {
    const output = document.getElementById('profile-avatar-preview');
    output.src = URL.createObjectURL(event.target.files[0]);
});

function previewAvatar(event) {
    const output = document.getElementById('profile-avatar-preview');
    output.src = URL.createObjectURL(event.target.files[0]);
}


function ActiveTab() {
    // Get the active tab from localStorage, or default to "edit-profile"
    const activeTab = localStorage.getItem("activeTab") || "edit-profile";

    // Set the active tab on page load
    setActiveTab(activeTab);

    // Add click event to each tab to store the active tab in localStorage
    document.querySelectorAll(".profile-nav").forEach((tab) => {
        tab.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent default anchor behavior
            const tabId = this.getAttribute("href").substring(1); // Extract ID
            localStorage.setItem("activeTab", tabId); // Store in localStorage
            setActiveTab(tabId); // Activate the selected tab
        });
    });

    // Function to set the active tab
    function setActiveTab(tabId) {
        // Remove "active" and "show" classes from all tabs and panes
        document.querySelectorAll(".profile-nav").forEach((tab) => tab.classList.remove("active", "show"));
        document.querySelectorAll(".tab-pane").forEach((pane) => pane.classList.remove("active", "show"));

        // Add "active" and "show" classes to the selected tab and pane
        const selectedTab = document.querySelector(`.nav-link[href="#${tabId}"]`);
        const selectedPane = document.getElementById(tabId);
        if (selectedTab && selectedPane) {
            selectedTab.classList.add("active", "show");
            selectedPane.classList.add("active", "show");
        }
    }
}

const updatePasswordConfig = {
    '#update_password_current_password': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Current password is required',
            },
            {
                rule: 'minLength',
                value: 3,
                errorMessage: 'Current password must be at least 3 characters',
            },
            {
                rule: 'maxLength',
                value: 15,
                errorMessage: 'Current password must be less than 15 characters',
            },
        ],
        options: {
            errorsContainer: '.validate-current-password', // Custom container for current password
        }
    },
    '#update_password_password': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'New password is required',
            },
            {
                rule: 'minLength',
                value: 8, 
                errorMessage: 'New password must be at least 8 characters',
            },
            {
                rule: 'maxLength',
                value: 20, 
                errorMessage: 'New password must be less than 20 characters',
            },
        ],
        options: {
            errorsContainer: '.validate-new-password', 
        }
    },
    '#update_password_password_confirmation': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Password confirmation is required',
            },
        ],
        options: {
            errorsContainer: '.validate-confirm-password', 
        }
    },
};

initializeValidator('#UpdatePassword', updatePasswordConfig);

const updateProfileConfig = {
    '#name': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Name is required',
            },
        ],
    },
    '#email': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Email is required',
            },
        ],
    },
    '#phone': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Phone is required',
            },
        ],
        options: {
            errorsContainer: '.validate-phone', // Custom container for current password
        }
    },
};

initializeValidator('#UpdateProfile', updateProfileConfig);


