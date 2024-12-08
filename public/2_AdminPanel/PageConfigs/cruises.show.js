// DataTable
var cruiseId = document.getElementById('CommonTable').dataset.cruiseId;
var table = $('#CommonTable').DataTable({
    paging: true,
    scrollCollapse: true,
    serverSide: true,
    searching: false,
    pageLength: 5,
    lengthChange: false,
    ajax: {
        url: `/admin/packages/list/${cruiseId}`, // Replace with the correct route if necessary
        type: 'GET',
        data: function (d) {
            // Add filter values to the AJAX request
            d.name = $('#CommonTable .filter-row input[name="name"]').val();
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
        { orderable: false, targets: [0, 1, 3, 5] } // Replace with actual indexes of columns to disable sorting
    ],
    columns: [
        {
            data: null, // No data source, we will use render
            render: function (data, type, row, meta) {
                return `<span>${meta.row + meta.settings._iDisplayStart + 1}</span>`; // Row number
            },
        },
        {
            data: 'package_images',
            render: function (data) {
                if (Array.isArray(data) && data.length > 0) {
                    // Get the latest 5 images
                    let latestImages = data.slice(-5);

                    // Generate the HTML for stacked avatars
                    let avatars = latestImages.map(image => `
                        <img src="${image.package_img}" 
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
        {
            data: 'name',
            render: function (data) {
                return `${capitalizeFirstLetter(data)}`
            }
        },
        {
            data: 'amenities',
            render: function (data) {
                return data.map((amenity, index) => {
                    // Check if it's every 3rd item
                    const brTag = (index + 1) % 4 === 0 ? '<br>' : '';
                    return `
                        <span class="badge badge-sm light badge-primary">
                            ${amenity.name}
                        </span>
                        ${brTag}
                    `;
                }).join('');
            }
        },
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
                        <a class="btn btn-info shadow btn-xs sharp me-1 ViewPackage" data-id="${row.id}"><i class="fa fa-eye"></i></a>
                        <a href="/admin/packages/edit/${row.slug}" class="btn btn-primary shadow btn-xs sharp me-1 EditPackage"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger shadow btn-xs sharp DeletePackage" data-id="${row.id}"><i class="fa fa-trash"></i></a>
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

function CrudFunctions() {

    document.querySelectorAll('.DeletePackage').forEach(button => {
        button.addEventListener('click', function () {
            const package_id = this.getAttribute('data-id');
            const deleteUrl = `/admin/packages/${package_id}`;
            confirmDelete(deleteUrl, table);
        });
    });

}
