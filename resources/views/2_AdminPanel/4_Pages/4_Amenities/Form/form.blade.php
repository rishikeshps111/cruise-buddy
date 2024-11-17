<form id="commonModalForm" action="{{ $data ? route('amenities.update', $data->id) : route('amenities.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($data)
        <input name="_method" type="hidden" value="PUT">
        <input type="hidden" name="id" value="{{ $data->id }}">
    @endif
    <div class="row">
        <div class="mb-3 col-md-12">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" placeholder="Enter Name"
                value="{{ $data->name ?? '' }}" />
            <x-input-error :messages="$errors->get('name')" />
        </div>
        <div class="mb-3 col-md-12">
            <x-input-label for="icon" :value="__('Icon')" />
            <div class="d-flex justify-content-center">
                <img id="iconPreview" class="form-img-preview mb-2" alt="Icon Preview"
                    src="{{ isset($data->icon) ? asset($data->icon) : '' }}"
                    style="{{ isset($data->icon) ? 'display: block;' : 'display: none;' }}">
            </div>
            <x-text-input id="icon" type="file" name="icon" accept="image/*" />
            <x-input-error :messages="$errors->get('icon')" />
        </div>
        <div class="mb-3 col-md-12 d-flex justify-content-end mt-2">
            <button type="button" class="btn btn-danger light me-2" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"
                id="commonModalSubmitButton">{{ isset($data) ? 'Update' : 'Save' }}</button>
        </div>
    </div>
</form>
