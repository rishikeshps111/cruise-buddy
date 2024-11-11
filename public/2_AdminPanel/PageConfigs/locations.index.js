// DataTable
var table = $('#CommonTable').DataTable({
    paging: true,
    scrollCollapse: true,
    serverSide: true,
    ajax: {
        url: '/admin/locations/list', // Replace with the correct route if necessary
        type: 'GET',
        data: function(d) {
            // Add filter values to the AJAX request
            d.name = $('#CommonTable .filter-row input[name="name"]').val();
            d.email = $('#CommonTable .filter-row input[name="district"]').val();
            d.phone = $('#CommonTable .filter-row input[name="state"]').val();
            d.proof_id = $('#CommonTable .filter-row input[name="country"]').val();
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
        { orderable: false, targets: [1, 6, 7] } // Replace with actual indexes of columns to disable sorting
    ],
    columns: [
        {
            data: null, // No data source, we will use render
            render: function (data, type, row, meta) {
                return `<span>${meta.row + meta.settings._iDisplayStart + 1}</span>`; // Row number
            },
        },
        {
            data: 'thumbnail',               // Assuming 'id' is used for actions
            render: function (data) {
                const imageUrl = data ? data : '/2_AdminPanel/assets/images/dummy-avatar.jpg';
                return `
                    <img class="rounded-circle" width="35"
                         src="${imageUrl}" 
                         alt="">
                    `;
            }
        },
        { data: 'name' },
        { data: 'district' },
        { data: 'state' },
        { data: 'country' },
        {
            data: 'map_url',
            render: function (data) {
                return `
                    <a href="${data}" class="text-primary">URL</a>
                `;
            }
        },
        {
            data: 'id',               // Assuming 'id' is used for actions
            render: function (data) {
                return `
                    <div class="d-flex">
                        <a class="btn btn-info shadow btn-xs sharp me-1 ViewLocation" data-id="${data}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-primary shadow btn-xs sharp me-1 EditLocation" data-id="${data}"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger shadow btn-xs sharp DeleteLocation" data-id="${data}"><i class="fa fa-trash"></i></a>
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
$('#CommonTable .filter-row input').on('input change', function() {
    table.ajax.reload();
});

// Reset filters and reload table
$('#resetButton').on('click', function() {
    $('#CommonTable .filter-row input').val(''); // Clear text inputs
    table.ajax.reload(); // Reload table data
});

function openFormModal(action, itemId = null, size = 'modal-md') {
    $.ajax({
        url: '/admin/locations/create', // Change this to the route for `renderForm`
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
            const validator = initializeValidator('#commonModalForm', LocationForm);
            EditOrCreate(validator);

        },
        error: function () {
            alert("An error occurred while loading the form.");
        }
    });
}


function CrudFunctions() {

    document.getElementById('addLocationButton').addEventListener('click', function () {
        openFormModal('store', null, 'modal-lg');
    });

    document.querySelectorAll('.EditLocation').forEach(button => {
        button.addEventListener('click', function () {
            const locationId = this.getAttribute('data-id');
            openFormModal('edit', locationId, 'modal-lg');
        });
    });

    document.querySelectorAll('.DeleteLocation').forEach(button => {
        button.addEventListener('click', function () {
            const locationId = this.getAttribute('data-id');
            const deleteUrl = `/admin/locations/${locationId}`;
            confirmDelete(deleteUrl, table);

        });
    });

    document.querySelectorAll('.ViewLocation').forEach(button => {
        button.addEventListener('click', function () {
            const locationId = this.getAttribute('data-id');
            const viewUrl = `/admin/locations/${locationId}`;
            openViewModal(viewUrl);

        });
    });

}

//show the image preview
function ImagePreview() {
    document.getElementById('thumbnail').addEventListener('change', function (event) {
        previewImage(event, 'thumbnailPreview');
    });
}

const LocationForm = {
    '#name': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Name is required',
            },
        ],
    },
    '#district': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'District is required',
            },
        ],
        options: {
            errorsContainer: '.validate-district', // Custom container for current password
        }
    },
    '#state': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'State is required',
            },
        ],
        options: {
            errorsContainer: '.validate-state', // Custom container for current password
        }
    },
    '#country': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Country is required',
            },
        ],
        options: {
            errorsContainer: '.validate-country', // Custom container for current password
        }
    },
    '#thumbnail': {
        rules: [
            {
                validator: () => {
                    const proofPreview = document.querySelector('#thumbnailPreview');
                    const proofImageInput = document.querySelector('#thumbnail');
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
    '#map_url': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Map URL is required',
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