// DataTable
var table = $('#CommonTable').DataTable({
    paging: true,
    scrollCollapse: true,
    serverSide: true, // Enables server-side processing
    ajax: {
        url: '/admin/owners/list',
        type: 'GET',
        data: function(d) {
            // Add filter values to the AJAX request
            d.name = $('#CommonTable .filter-row input[name="name"]').val();
            d.email = $('#CommonTable .filter-row input[name="email"]').val();
            d.phone = $('#CommonTable .filter-row input[name="phone"]').val();
            d.proof_id = $('#CommonTable .filter-row input[name="proof_id"]').val();
            d.status = $('#statusFilter').val(); // Gets the selected status filter value
        }
    },
    layout: {
        bottomEnd: {
            paging: {
                firstLast: false
            }
        }
    },
    language: {
        paginate: {
            next: '<i class="fa-solid fa-angle-right"></i>',
            previous: '<i class="fa-solid fa-angle-left"></i>'
        }
    },
    columnDefs: [
        { orderable: false, targets: [0, 1, 5, 8] } // Replace with actual indexes of columns to disable sorting
    ],
    columns: [
        {
            data: null, // No data source, we will use render
            render: function (data, type, row, meta) {
                return `<span>${meta.row + meta.settings._iDisplayStart + 1}</span>`; // Row number
            },
        },
        {
            data: 'user.image_path',               // Assuming 'id' is used for actions
            render: function (data) {
                const imageUrl = data ? data : '/2_AdminPanel/assets/images/dummy-avatar.jpg';
                return `
                    <img class="rounded-circle" width="35"
                         src="${imageUrl}" 
                         alt="">
                    `;
            }
        },
        { data: 'user.name' },
        { data: 'user.email' },
        {
            data: 'user.phone', // We will render country code and phone here
            render: function (data, type, row) {
                return `${formatPhone(data)}`; // Concatenating country code and phone
            }
        },
        {
            data: 'proof_image',               // Assuming 'id' is used for actions
            render: function (data) {
                const imageUrl = data ? data : '/2_AdminPanel/assets/images/dummy-avatar.jpg';
                return `
                    <img class="rounded-circle" width="35"
                         src="${imageUrl}" 
                         alt="">
                    `;
            }
        },
        { data: 'proof_id' },
        {
            data: 'user.is_active',
            render: function (data) {
                return data == 1
                    ? '<span class="badge badge-success light border-0">Active</span>'
                    : '<span class="badge badge-danger light border-0">Inactive</span>';
            }
        },
        {
            data: 'id',               // Assuming 'id' is used for actions
            render: function (data) {
                return `
                    <div class="d-flex">
                        <a class="btn btn-info shadow btn-xs sharp me-1 ViewOwner" data-id="${data}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-primary shadow btn-xs sharp me-1 EditOwner" data-id="${data}"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger shadow btn-xs sharp DeleteOwner" data-id="${data}"><i class="fa fa-trash"></i></a>
                    </div>
                `;
            }
        }
    ],
    drawCallback: function (settings) {
        // Called every time the table is redrawn
        CrudFunctions();
    }
});

// Trigger table refresh on filter change
$('#CommonTable .filter-row input, #statusFilter').on('input change', function() {
    table.ajax.reload();
});

// Reset filters and reload table
$('#resetButton').on('click', function() {
    $('#CommonTable .filter-row input').val(''); // Clear text inputs
    $('#statusFilter').val('').selectpicker('refresh');  // Reset the select box
    table.order([[0, 'asc']]).draw(); // Reset sorting to the initial state
    table.ajax.reload(); // Reload table data
});

function openFormModal(action, itemId = null, size = 'modal-md') {
    $.ajax({
        url: '/admin/owners/create', // Change this to the route for `renderForm`
        method: 'GET',
        data: {
            action: action,
            id: itemId,
            size: size
        },
        success: function (response) {
            // Set modal title
            $('#commonModalLabel').text(response.title);
            // Set modal size
            $('#commonModal .modal-dialog')
                .removeClass('modal-sm modal-md modal-lg')
                .addClass(response.size);
            // Inject form content
            $('#commonModalBody').html(response.content);
            // Show the modal
            $('#commonModal').modal('show');
            // reloading the input components
            W3Crm.init();
            ImagePreview();
            initIntlTelInput('phone', 'validate-phone', 'commonModalForm');
            initIntlTelInput('phone_2', 'validate-phone-2', 'commonModalForm', 'phone_2_full_phone', 'phone_2_country_code');
            const validator = initializeValidator('#commonModalForm', OwnersForm);
            EditOrCreate(validator);

        },
        error: function () {
            alert("An error occurred while loading the form.");
        }
    });
}

//show the image preview
function ImagePreview() {
    document.getElementById('proof_image').addEventListener('change', function (event) {
        previewImage(event, 'proofPreview');
    });
    document.getElementById('avatar').addEventListener('change', function (event) {
        previewImage(event, 'avatarPreview');
    })
}

function CrudFunctions() {

    document.getElementById('addOwnerButton').addEventListener('click', function () {
        openFormModal('store', null, 'modal-lg');
    });

    document.querySelectorAll('.EditOwner').forEach(button => {
        button.addEventListener('click', function () {
            const ownerId = this.getAttribute('data-id');
            openFormModal('edit', ownerId, 'modal-lg');
        });
    });

    document.querySelectorAll('.DeleteOwner').forEach(button => {
        button.addEventListener('click', function () {
            const ownerId = this.getAttribute('data-id');
            const deleteUrl = `/admin/owners/${ownerId}`;
            confirmDelete(deleteUrl, table);

        });
    });

    document.querySelectorAll('.ViewOwner').forEach(button => {
        button.addEventListener('click', function () {
            const ownerId = this.getAttribute('data-id');
            const viewUrl = `/admin/owners/${ownerId}`;
            openViewModal(viewUrl);

        });
    });

}

const OwnersForm = {
    '#name': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Name is required',
            },
            {
                rule: 'customRegexp',
                value: /^[a-zA-Z\s]+$/,
                errorMessage: 'Name should contain only letters and spaces',
            },
        ],
    },
    '#email': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Email is required',
            },
            {
                rule: 'email',
                errorMessage: 'Please enter a valid email address',
            },
        ],
    },
    '#phone': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Phone is required',
            },
            {
                rule: 'custom',
                validator: (value) => {
                    try {

                        let countryCode = document.querySelector('input[name="country_code"]').value;
                        let numberObj = libphonenumber.parsePhoneNumber(value.replace(/\s+/g, ''), countryCode.toUpperCase());
                        return numberObj.isValid();

                    } catch (error) {

                        return false;
                    }

                },
                errorMessage: 'Please enter a valid phone number.',
            },
        ],
        options: {
            errorsContainer: '.validate-phone', // Custom container for current password
        }
    },
    '#phone_2': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Phone is required',
            },
            {
                rule: 'custom',
                validator: (value) => {
                    try {

                        let countryCode = document.querySelector('input[name="phone_2_country_code"]').value;
                        let numberObj = libphonenumber.parsePhoneNumber(value.replace(/\s+/g, ''), countryCode.toUpperCase());
                        return numberObj.isValid();

                    } catch (error) {

                        return false;
                    }

                },
                errorMessage: 'Please enter a valid phone number.',
            },
        ],
        options: {
            errorsContainer: '.validate-phone-2', // Custom container for current password
        }
    },
    '#proof_type': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Proof Type is required',
            },
        ],
        options: {
            errorsContainer: '.validate-proof-type', // Custom container for current password
        }

    },
    '#proof_id': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Proof ID is required',
            },
        ],
    },
    '#proof_image': {
        rules: [
            {
                validator: () => {
                    const proofPreview = document.querySelector('#proofPreview');
                    const proofImageInput = document.querySelector('#proof_image');
                    // Ensure proofPreview.src is checked properly and proof_image file selection
                    return (
                        (proofPreview && proofPreview.style.display === 'block' && proofPreview.src) ||
                        (proofImageInput && proofImageInput.files.length > 0)
                    );
                },
                errorMessage: 'Please upload a proof image.',
            },
        ],
    },
    '#avatar': {
        rules: [
            {
                rule: 'custom',
                validator: () => {
                    const proofPreview = document.querySelector('#avatarPreview');
                    const proofImageInput = document.querySelector('#avatar');
                    return (
                        (proofPreview && proofPreview.style.display === 'block' && proofPreview.src) ||
                        (proofImageInput && proofImageInput.files.length > 0)
                    );
                },
                errorMessage: 'Please upload a Avatar image.',
            },
        ],
    },
};

function EditOrCreate(validator) {

    document.getElementById('commonModalForm').addEventListener('submit', (event) => {
        event.preventDefault();
        if (!validator.isValid)
            return false;
        const Form = event.target;
        const Data = new FormData(Form);
        const FormAction = Form.getAttribute("action");
        const Method = Form.getAttribute("method") ?? "GET";

        axios({
            method: Method,
            url: FormAction,
            data: Data,
        })
            .then(response => {
                console.log(response);
                $("#commonModal").modal("hide");
                table.ajax.reload(null, false);
                showToast(response.data.message, 3000, 'success')
                clearErrorMessages();
            })
            .catch(error => {
                if (error.response && error.response.status === 422) {
                    showErrorMessages(error.response.data.errors);
                } else {
                    console.error(error.response.data);
                }
            });

    });
}

function openViewModal(url) {
    $.ajax({
        url: url, // Change this to the route for `renderForm`
        method: 'GET',
        success: function (response) {
            // Set modal title
            $('#commonModalLabel').text(response.title);
            // Set modal size
            $('#commonModal .modal-dialog')
                .removeClass('modal-sm modal-md modal-lg')
                .addClass(response.size);
            // Inject form content
            $('#commonModalBody').html(response.content);
            // Show the modal
            $('#commonModal').modal('show');
            // reloading the input components
        },
        error: function () {
            alert("An error occurred while loading the form.");
        }
    });
}

