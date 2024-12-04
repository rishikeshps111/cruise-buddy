// DataTable
var table = $('#CommonTable').DataTable({
    paging: true,
    scrollCollapse: true,
    serverSide: true,
    ajax: {
        url: '/admin/cruise-type/list', // Replace with the correct route if necessary
        type: 'GET',
        data: function (d) {
            // Add filter values to the AJAX request
            d.model_name = $('#CommonTable .filter-row select[name="model_name"]').val();
            d.type = $('#CommonTable .filter-row select[name="type"]').val();
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
        { orderable: false, targets: [0, 1, 3] } // Replace with actual indexes of columns to disable sorting
    ],
    columns: [
        {
            data: null, // No data source, we will use render
            render: function (data, type, row, meta) {
                return `<span>${meta.row + meta.settings._iDisplayStart + 1}</span>`; // Row number
            },
        },
        {
            data: 'image',               // Assuming 'id' is used for actions
            render: function (data) {
                const imageUrl = data ? data : '/2_AdminPanel/assets/images/dummy-avatar.jpg';
                return `
                    <img class="rounded-circle" width="35"
                         src="${imageUrl}" 
                         alt="">
                    `;
            }
        },
        { data: 'model_name',
            render: function (data) {
                return `
                    ${data}
                `;
            }
         },
        {
            data: 'type',
            render: function (data) {
                return `
                    ${data}
                `;
            }
        },
        {
            data: 'id',               // Assuming 'id' is used for actions
            render: function (data) {
                return `
                    <div class="d-flex">
                        <a class="btn btn-primary shadow btn-xs sharp me-1 EditCruiseType" data-id="${data}"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger shadow btn-xs sharp DeleteCruiseType" data-id="${data}"><i class="fa fa-trash"></i></a>
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
$('#CommonTable .filter-row select').on('select change', function () {
    table.ajax.reload();
});

// Reset filters and reload table
$('#resetButton').on('click', function () {
    $('#CommonTable .filter-row select').val('').selectpicker('refresh'); 
    table.order([[0, 'asc']]).draw();
    table.ajax.reload(); // Reload table data
});

//show the image preview
function ImagePreview() {
    document.getElementById('image').addEventListener('change', function (event) {
        previewImage(event, 'imagePreview');
    });
}

function openFormModal(action, itemId = null, size = 'modal-md') {
    $.ajax({
        url: '/admin/cruise-type/create', // Change this to the route for `renderForm`
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

    document.getElementById('addCruiseTypeButton').addEventListener('click', function () {
        openFormModal('store', null, 'modal-md');
    });

    document.querySelectorAll('.EditCruiseType').forEach(button => {
        button.addEventListener('click', function () {
            const cruiseType_id = this.getAttribute('data-id');
            openFormModal('edit', cruiseType_id, 'modal-md');
        });
    });

    document.querySelectorAll('.DeleteCruiseType').forEach(button => {
        button.addEventListener('click', function () {
            const cruiseType_id = this.getAttribute('data-id');
            const deleteUrl = `/admin/cruise-type/${cruiseType_id}`;
            confirmDelete(deleteUrl, table);

        });
    });

}

const LocationForm = {
    '#model_name': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Model name is required',
            },
        ],
        options: {
            errorsContainer: '.validate-model-name',    
        }

    },
    '#type': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Type is required',
            },
        ],
        options: {
            errorsContainer: '.validate-type',  
        }

    },
    '#image': {
        rules: [
            {
                validator: () => {
                    const preview = document.querySelector('#imagePreview');
                    const imageInput = document.querySelector('#image_image');
                    return (
                        (preview && preview.style.display === 'block' && preview.src) ||
                        (imageInput && imageInput.files.length > 0)
                    );
                },
                errorMessage: 'Please upload a image.',
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
