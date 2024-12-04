// DataTable
var table = $('#CommonTable').DataTable({
    paging: true,
    scrollCollapse: true,
    serverSide: true,
    searching: false,
    pageLength: 5,
    lengthChange: false,
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
        { orderable: false, targets: [0, 1, 4] } // Replace with actual indexes of columns to disable sorting
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
                        <a class="btn btn-primary shadow btn-xs sharp me-1 EditCruise" data-id="${row.id}"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger shadow btn-xs sharp DeleteCruise" data-id="${row.id}"><i class="fa fa-trash"></i></a>
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
