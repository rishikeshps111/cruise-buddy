// DataTable
var table = $('#CommonTable').DataTable({
    paging: true,
    scrollCollapse: true,
    serverSide: true,
    ajax: {
        url: '/admin/cruises/list', // Replace with the correct route if necessary
        type: 'GET',
        data: function (d) {
            // Add filter values to the AJAX request
            d.name = $('#CommonTable .filter-row input[name="name"]').val();
            d.owner_id = $('#CommonTable .filter-row input[name="owner_id"]').val();
            d.owner_name = $('#CommonTable .filter-row input[name="owner_name"]').val();
            d.type = $('#CommonTable .filter-row select[name="type"]').val();
            d.rooms = $('#CommonTable .filter-row input[name="rooms"]').val();
            d.max_capacity = $('#CommonTable .filter-row input[name="max_capacity"]').val();
            d.is_active = $('#CommonTable .filter-row select[name="is_active"]').val();
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
        { orderable: false, targets: [0, 1, 5, 9] } // Replace with actual indexes of columns to disable sorting
    ],
    columns: [
        {
            data: null, // No data source, we will use render
            render: function (data, type, row, meta) {
                return `<span>${meta.row + meta.settings._iDisplayStart + 1}</span>`; // Row number
            },
        },
        {
            data: 'cruises_images',
            render: function (data) {
                if (Array.isArray(data) && data.length > 0) {
                    // Get the latest 5 images
                    let latestImages = data.slice(-5);

                    // Generate the HTML for stacked avatars
                    let avatars = latestImages.map(image => `
                        <img src="${image.cruise_img}" 
                             class="avatar rounded-circle" 
                             alt="${image.alt || 'Image'}" 
                             width="35">
                    `).join('');

                    return `<div class="avatar-list avatar-list-stacked">${avatars}</div>`;
                } else {
                    // Fallback to a single dummy image if no data is available
                    return `
                        <span class="badge badge-warning light border-0" style="font-size: 8px;">No Imges Available</span>
                    `;
                }
            }
        },
        { data: 'name' },
        { data: 'owner_id' },
        { data: 'owner_name' },
        {
            data: null, // Use `null` when you don't directly map a single property
            render: function (data, type, row) {
                return `
                    <div style="text-align: left; line-height: 1.6;">
                        <span><b>Model:</b></span> 
                        <span>${toCamelCase(row.model_name)}</span><br>
                        <span><b>Type:</b></span> 
                        <span>${capitalizeFirstLetter(row.type)}</span>
                    </div>
                `;
            }
        },
        { data: 'rooms' },
        { data: 'max_capacity' },
        {
            data: 'is_active',
            render: function (data) {
                return data == 1
                    ? '<span class="badge badge-success light border-0">Active</span>'
                    : '<span class="badge badge-danger light border-0">Inactive</span>';
            }
        },
        {
            data: null,
            render: function (data, type, row) {
                return `
                    <div class="d-flex">
                        <a href="/admin/cruises/${row.slug}" class="btn btn-info shadow btn-xs sharp me-1 ViewCruise" data-id="${row.id}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-success shadow btn-xs sharp me-1 ImageCruise" data-id="${row.id}"><i class="fa fa-image"></i></a>
                        <a class="btn btn-primary shadow btn-xs sharp me-1 EditCruise" data-id="${row.id}"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger shadow btn-xs sharp DeleteCruise" data-id="${row.id}"><i class="fa fa-trash"></i></a>
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
$('#CommonTable .filter-row input, select').on('input change', function () {
    table.ajax.reload();
});

// Reset filters and reload table
$('#resetButton').on('click', function () {
    $('#CommonTable .filter-row input').val('');
    $('#CommonTable .filter-row select').val('').selectpicker('refresh');
    table.order([[0, 'asc']]).draw();
    table.ajax.reload(); // Reload table data
});

function openFormModal(action, itemId = null, size = 'modal-md') {
    $.ajax({
        url: '/admin/cruises/create', // Change this to the route for `renderForm`
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
            const validator = initializeValidator('#commonModalForm', CruiseForm);
            EditOrCreate(validator);
            Slug();
        },
        error: function () {
            alert("An error occurred while loading the form.");
        }
    });
}

function openImageModal(itemId = null, size = 'modal-md') {
    $.ajax({
        url: '/admin/cruises-image/create', // Change this to the route for `renderForm`
        method: 'GET',
        data: {
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
            filePond();
            AddImages();
            DeleteImages();
        },
        error: function () {
            alert("An error occurred while loading the form.");
        }
    });
}

function CrudFunctions() {

    document.getElementById('addCruiseButton').addEventListener('click', function () {
        openFormModal('store', null, 'modal-xl');
    });

    document.querySelectorAll('.EditCruise').forEach(button => {
        button.addEventListener('click', function () {
            const cruise_id = this.getAttribute('data-id');
            openFormModal('edit', cruise_id, 'modal-xl');
        });
    });

    document.querySelectorAll('.DeleteCruise').forEach(button => {
        button.addEventListener('click', function () {
            const cruise_id = this.getAttribute('data-id');
            const deleteUrl = `/admin/cruises/${cruise_id}`;
            confirmDelete(deleteUrl, table);

        });
    });

    document.querySelectorAll('.ImageCruise').forEach(button => {
        button.addEventListener('click', function () {
            const cruise_id = this.getAttribute('data-id');
            openImageModal(cruise_id, 'modal-xl');
        });
    });

}

const CruiseForm = {
    '#name': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Cruise name is required',
            },
        ],
    },
    '#owner_id': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'please select a owner',
            },
        ],
        options: {
            errorsContainer: '.validate-owner-id',
        }

    },
    '#cruise_type_id': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'please select a cruise type',
            },
        ],
        options: {
            errorsContainer: '.validate-cruise-type',
        }

    },
    '#location_id': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'please select a location',
            },
        ],
        options: {
            errorsContainer: '.validate-location',
        }

    },
    '#rooms': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Rooms is required',
            },
            {
                rule: 'number',
                errorMessage: 'Rooms must be a number',
            },
            {
                rule: 'minNumber',
                value: 1,
                errorMessage: 'Rooms must be at least 1',
            },
            {
                rule: 'maxNumber',
                value: 8,
                errorMessage: 'Rooms must be no more than 8',
            },
        ],
    },
    '#max_capacity': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Max Capacity is required',
            },
            {
                rule: 'number',
                errorMessage: 'Max Capacity must be a number',
            },
            {
                rule: 'minNumber',
                value: 1,
                errorMessage: 'Max Capacity must be at least 1',
            },
            {
                rule: 'maxNumber',
                value: 50,
                errorMessage: 'Max Capacity must be no more than 50',
            },
        ],
    },
    '#description': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Description is required',
            },
            {
                rule: 'maxLength',
                value: 200,
                errorMessage: 'Description must not exceed 200 characters',
            },
        ],
    },
    '#slug': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Slug is required',
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

function filePond() {
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file"]');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateSize, FilePondPluginFileValidateType);

    // Create a FilePond instance
    const pond = FilePond.create(inputElement, {
        allowMultiple: true,
        maxFiles: 10,
        allowFileSizeValidation: true,
        maxFileSize: '2MB',
        imagePreviewMaxHeight: 60,
        acceptedFileTypes: ['image/png', 'image/jpeg'],
    });

    FilePond.setOptions({
        server: {
            process: '/admin/upload',
            revert: '/admin/delete',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
        }
    });
}

function AddImages() {
    document.getElementById('commonModalImagesForm').addEventListener('submit', (event) => {
        event.preventDefault();
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

function DeleteImages() {
    document.querySelectorAll('.DeleteImage').forEach(button => {
        button.addEventListener('click', function () {

            const imageId = this.getAttribute('data-id');
            const deleteUrl = `/admin/cruises-image/${imageId}`;
            const imageWrapper = this.closest('.col-md-3');

            confirmDelete(deleteUrl, table, imageWrapper, updateImageContainer);
        });
    });
}

function Slug() {
    document.getElementById('name').addEventListener('input', function () {

        const nameValue = this.value;
        const slug = generateSlug(nameValue);
        document.getElementById('slug').value = slug;

    });
}

function updateImageContainer() {
    const imageContainer = document.querySelector('#commonModalImagesForm .image-area');
    console.log(imageContainer)
    if (!imageContainer.querySelector('.image-section')) {
        imageContainer.innerHTML = `
            <div class="col-12">
                <p class="text-center">No Images Available</p>
            </div>`;
    }
}

