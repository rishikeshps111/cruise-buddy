var table = $('#CommonTable').DataTable({
    paging: true,
    scrollCollapse: true,
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
        { orderable: false, targets: [1, 5, 8] } // Replace with the actual indexes of columns to disable sorting
    ],
    drawCallback: function (settings) {
        // This function will be called every time the table is redrawn
        CrudFunctions();
    },
});

// Custom filter function for Status
$.fn.dataTable.ext.search.push(function (settings, data) {
    const filter = $('#statusFilter').val();  // Get filter value
    const statusText = data[7];  // Get status text in the 8th column

    // Include all rows if 'All' is selected, or only those matching "Active" or "Inactive"
    return filter === "" || (filter === "1" && statusText.includes("Active")) ||
        (filter === "0" && statusText.includes("Inactive"));
});


$('#CommonTable thead tr:eq(1) th').each(function (i) {
    // Attach event to filter inputs and select
    $('input', this).on('keyup change', function () {
        if (table.column(i).search() !== this.value) {
            table
                .column(i)
                .search(this.value)
                .draw();
        }
    });
});

// Trigger filter on dropdown change
$('#statusFilter').on('change', function () {
    table.draw();
});

$('#resetButton').on('click', function () {
    // Reset each input and dropdown in the filter row
    $('#CommonTable thead tr:eq(1) th').each(function () {
        $('input, select', this).val('');
    });

    // Reset each column's search and redraw the table
    const table = $('#CommonTable').DataTable();
    table.columns().search('').draw();
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

}
