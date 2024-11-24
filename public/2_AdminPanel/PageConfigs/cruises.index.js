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
                        <img src="/2_AdminPanel/assets/images/dummy-avatar.jpg" 
                             class="rounded-circle" 
                             alt="No Image" 
                             width="35">
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
            data: 'id',               
            render: function (data) {
                return `
                    <div class="d-flex">
                        <a class="btn btn-info shadow btn-xs sharp me-1 ViewOwner" data-id="${data}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-primary shadow btn-xs sharp me-1 EditCruiseType" data-id="${data}"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger shadow btn-xs sharp DeleteCruiseType" data-id="${data}"><i class="fa fa-trash"></i></a>
                    </div>
                `;
            }
        }
    ],
    drawCallback: function (settings) {
        // Called every time the table is redrawn
        // CrudFunctions();
    }
});

// Trigger table refresh on filter change
$('#CommonTable .filter-row input, select').on('input change', function() {
    table.ajax.reload();
});

// Reset filters and reload table
$('#resetButton').on('click', function () {
    $('#CommonTable .filter-row input').val('');
    $('#CommonTable .filter-row select').val('').selectpicker('refresh');
    table.order([[0, 'asc']]).draw();
    table.ajax.reload(); // Reload table data
});

// function openFormModal(action, itemId = null, size = 'modal-md') {
//     $.ajax({
//         url: '/admin/cruise-type/create', // Change this to the route for `renderForm`
//         method: 'GET',
//         data: {
//             action: action,
//             id: itemId,
//             size: size
//         },
//         success: function (response) {
//             // Set modal title
//             $('#commonModalLabel').text(response.title);
//             // Set modal size
//             $('#commonModal .modal-dialog')
//                 .removeClass('modal-sm modal-md modal-lg')
//                 .addClass(response.size);
//             // Inject form content
//             $('#commonModalBody').html(response.content);
//             // Show the modal
//             $('#commonModal').modal('show');
//             // reloading the input components
//             W3Crm.init();
//             const validator = initializeValidator('#commonModalForm', LocationForm);
//             EditOrCreate(validator);

//         },
//         error: function () {
//             alert("An error occurred while loading the form.");
//         }
//     });
// }

// function CrudFunctions() {

//     document.getElementById('addCruiseTypeButton').addEventListener('click', function () {
//         openFormModal('store', null, 'modal-lg');
//     });

//     document.querySelectorAll('.EditCruiseType').forEach(button => {
//         button.addEventListener('click', function () {
//             const locationId = this.getAttribute('data-id');
//             openFormModal('edit', locationId, 'modal-lg');
//         });
//     });

//     document.querySelectorAll('.DeleteCruiseType').forEach(button => {
//         button.addEventListener('click', function () {
//             const locationId = this.getAttribute('data-id');
//             const deleteUrl = `/admin/cruise-type/${locationId}`;
//             confirmDelete(deleteUrl, table);

//         });
//     });

// }

// const LocationForm = {
//     '#model_name': {
//         rules: [
//             {
//                 rule: 'required',
//                 errorMessage: 'Model name is required',
//             },
//         ],
//         options: {
//             errorsContainer: '.validate-model-name',
//         }

//     },
//     '#type': {
//         rules: [
//             {
//                 rule: 'required',
//                 errorMessage: 'Type is required',
//             },
//         ],
//         options: {
//             errorsContainer: '.validate-type',
//         }

//     }
// };

// function EditOrCreate(validator) {

//     document.getElementById('commonModalForm').addEventListener('submit', (event) => {
//         event.preventDefault();
//         if (!validator.isValid)
//             return false;
//         const Form = event.target;
//         const Data = new FormData(Form);
//         const FormAction = Form.getAttribute("action");
//         const Method = Form.getAttribute("method") ?? "GET";

//         axios({
//             method: Method,
//             url: FormAction,
//             data: Data,
//         })
//             .then(response => {
//                 console.log(response);
//                 $("#commonModal").modal("hide");
//                 table.ajax.reload(null, false);
//                 showToast(response.data.message, 3000, 'success')
//                 clearErrorMessages();
//             })
//             .catch(error => {
//                 if (error.response && error.response.status === 422) {
//                     showErrorMessages(error.response.data.errors);
//                 } else {
//                     console.error(error.response.data);
//                 }
//             });

//     });
// }
