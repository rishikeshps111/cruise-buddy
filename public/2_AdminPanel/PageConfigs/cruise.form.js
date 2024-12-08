const PackageForm = {
    '#category': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'please select a category',
            },
        ],
        options: {
            errorsContainer: '.validate-category',
        }
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
    '#multi-value-select': {
        rules: [
            {
                rule: 'required',
                errorMessage: 'Please select at least one amenity',
            },
        ],
        options: {
            errorsContainer: '.validate-amenity',
        }
    },
};

function EditOrCreate(validator) {

    document.getElementById('PackageForm').addEventListener('submit', (event) => {
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
                swalToast(response.data.message, 'success');
                swalToast.callback = () => {
                    if (response.data.redirect_url) {
                        window.location.href = response.data.redirect_url;
                    }
                };
                clearErrorMessages();

                if (response.data.action == 'store') {
                    FormReset(Form);
                }

                // if (response.data.redirect_url) {
                //     window.location.href = response.data.redirect_url;
                // }
            })
            .catch(error => {
                if (error.response && error.response.status === 422) {
                    customShowErrorMessages(error.response.data.errors);
                } else {
                    console.error(error.response.data);
                }
            });

    });
}


document.addEventListener('DOMContentLoaded', function () {
    const validator = initializeValidator('#PackageForm', PackageForm);
    filePond();
    document.getElementById("category").addEventListener("change", updateSlug);
    EditOrCreate(validator);
});

let pond;

function filePond() {
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file"]');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateSize, FilePondPluginFileValidateType);

    // Create a FilePond instance
    pond = FilePond.create(inputElement, {
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

function updateSlug() {
    const cruiseSlug = document.getElementById("cruise_slug").value.trim();
    const category = document.getElementById("category").value.trim();
    const slugInput = document.getElementById("slug");

    if (cruiseSlug && category) {
        slugInput.value = `${cruiseSlug}-${category}-package`;
    } else {
        slugInput.value = "";
    }
}

function FormReset(form) {

    form.reset();

    if (pond) {
        pond.removeFiles();
    }

    $('#PackageForm select').val('').selectpicker('refresh');
    $('#multi-value-select').val(null).trigger('change');

}


document.querySelectorAll('.DeleteImage').forEach(button => {
    button.addEventListener('click', function () {

        const imageId = this.getAttribute('data-id');
        const deleteUrl = `/admin/packages/image/${imageId}`;
        const imageWrapper = this.closest('.col-3');

        confirmDelete(deleteUrl, null, imageWrapper, updateImageContainer);
    });
});

function updateImageContainer() {
    const imageContainer = document.querySelector('#PackageForm .image-area');
    console.log(imageContainer)
    if (!imageContainer.querySelector('.image-section')) {
        imageContainer.innerHTML = `
            <div class="col-12">
                <p class="text-center">No Images Available</p>
            </div>`;
    }
}