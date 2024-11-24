<form id="commonModalForm" action="{{ $data ? route('cruise-type.update', $data->id) : route('cruise-type.store') }}"
    method="POST" enctype="multipart/form-data">
    @csrf
    @if ($data)
        <input name="_method" type="hidden" value="PUT">
        <input type="hidden" name="id" value="{{ $data->id }}">
    @endif
    <div class="row">
        <div class="mb-3 col-md-6">
            <x-input-label for="model_name" :value="__('Model Name')" />
            <select class="default-select style-1 form-control" id="model_name" name="model_name">
                <option value="" data-display="Select">Select Model Name</option>
                <option value="normal" {{ $data && $data->model_name == 'normal' ? 'selected' : '' }}>Normal</option>
                <option value="full_upper_deck" {{ $data && $data->model_name == 'full_upper_deck' ? 'selected' : '' }}>
                    FullUpperDeck</option>
                <option value="semi_upper_deck" {{ $data && $data->model_name == 'semi_upper_deck' ? 'selected' : '' }}>
                    SemiUpperDeck</option>
            </select>
            <div class="validate-model-name"></div>
            <x-input-error :messages="$errors->get('model_name')" />
        </div>
        <div class="mb-3 col-md-6">
            <x-input-label for="type" :value="__('Type')" />
            <select class="default-select style-1 form-control" id="type" name="type">
                <option value="" data-display="Select">Select Type</option>
                <option value="open" {{ $data && $data->type == 'open' ? 'selected' : '' }}>Open</option>
                <option value="closed" {{ $data && $data->type == 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
            <div class="validate-type"></div>
            <x-input-error :messages="$errors->get('type')" />
        </div>

        <div class="mb-3 col-md-12 d-flex justify-content-end mt-2">
            <button type="button" class="btn btn-danger light me-2" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"
                id="commonModalSubmitButton">{{ isset($data) ? 'Update' : 'Save' }}</button>
        </div>
    </div>
</form>
