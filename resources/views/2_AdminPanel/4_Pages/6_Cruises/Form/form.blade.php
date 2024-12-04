<form id="commonModalForm" action="{{ $data ? route('cruises.update', $data->id) : route('cruises.store') }}"
    method="POST" enctype="multipart/form-data">
    @csrf
    @if ($data)
        <input name="_method" type="hidden" value="PUT">
        <input type="hidden" name="id" value="{{ $data->id }}">
    @endif
    <div class="row">
        <div class="mb-3 col-md-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" placeholder="Enter Cruise Name"
                value="{{ $data->name ?? '' }}" />
            <x-input-error :messages="$errors->get('name')" />
        </div>
        <div class="mb-3 col-md-4">
            <x-input-label for="owner_id" :value="__('Owner')" />
            <select class="default-select style-1 form-control" id="owner_id" name="owner_id">
                <option value="" data-display="Select">Please select owner</option>
                @foreach ($owners as $owner)
                    <option value="{{ $owner->id }}" data-display="Select"
                        {{ old('owner_id', $data->owner_id ?? '') == $owner->id ? 'selected' : '' }}>
                        {{ $owner->id }} -
                        {{ $owner->user->name }}</option>
                @endforeach
            </select>
            <div class="validate-owner-id"></div>
            <x-input-error :messages="$errors->get('owner_id')" />
        </div>
        <div class="mb-3 col-md-4">
            <x-input-label for="cruise_type_id" :value="__('Cruise Type')" />
            <select class="default-select style-1 form-control" id="cruise_type_id" name="cruise_type_id">
                <option value="" data-display="Select">Please select owner</option>
                @foreach ($cruise_types as $cruise_type)
                    <option value="{{ $cruise_type->id }}" data-display="Select"
                        {{ old('cruise_type_id', $data->cruise_type_id ?? '') == $cruise_type->id ? 'selected' : '' }}>
                        {{ $cruise_type->model_name }} -
                        {{ $cruise_type->type }} </option>
                @endforeach
            </select>
            <div class="validate-cruise-type"></div>
            <x-input-error :messages="$errors->get('cruise_type_id')" />
        </div>
        <div class="mb-3 col-md-4">
            <x-input-label for="location_id" :value="__('Location')" />
            <select class="default-select style-1 form-control" id="location_id" name="location_id">
                <option value="" data-display="Select">Please select owner</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}" data-display="Select"
                        {{ old('location_id', $data->location_id ?? '') == $location->id ? 'selected' : '' }}>
                        {{ $location->name }},
                        {{ $location->district }}, {{ $location->state }}, {{ $location->country }}</option>
                @endforeach
            </select>
            <div class="validate-location"></div>
            <x-input-error :messages="$errors->get('location_id')" />
        </div>
        <div class="mb-3 col-md-4">
            <x-input-label for="rooms" :value="__('Rooms')" />
            <x-text-input id="rooms" type="number" name="rooms" min="1" :value="old('rooms')"
                placeholder="Number of Rooms" value="{{ $data->rooms ?? '' }}" />
            <x-input-error :messages="$errors->get('rooms')" />
        </div>
        <div class="mb-3 col-md-4">
            <x-input-label for="max_capacity" :value="__('Max Capacity')" />
            <x-text-input id="max_capacity" type="number" name="max_capacity" min="1" :value="old('max_capacity')"
                placeholder="Number of Maximum Capacity" value="{{ $data->max_capacity ?? '' }}" />
            <x-input-error :messages="$errors->get('max_capacity')" />
        </div>
        <div class="mb-3 col-md-12">
            <x-input-label for="description" :value="__('Description')" />
            <textarea class="form-control" id="description" type="number" name="description" rows="5"
                placeholder="Enter Description">{{ $data->description ?? '' }}</textarea>
            <x-input-error :messages="$errors->get('description')" />
        </div>
        <div class="mb-3 col-md-4">
            <x-input-label for="slug" :value="__('Slug')" />
            <x-text-input id="slug" type="text" name="slug" :value="old('slug')" placeholder="Enter Cruise Slug"
                value="{{ $data->slug ?? '' }}" />
            <x-input-error :messages="$errors->get('slug')" />
        </div>
        <div class="mb-3 col-md-6">
            <x-input-label :value="__('Status')" />
            <div class="mt-1">
                <div class="form-check custom-checkbox form-check-inline">
                    <input type="radio" class="form-check-input" name="is_active" value="1"
                        {{ old('is_active', $data->is_active ?? 1) == 1 ? 'checked' : '' }}>
                    <x-input-label :value="__('Active')" />
                </div>
                <div class="form-check custom-checkbox form-check-inline">
                    <input type="radio" class="form-check-input" name="is_active" value="0"
                        {{ old('is_active', $data->is_active ?? '') == 0 ? 'checked' : '' }}>
                    <x-input-label :value="__('Inactive')" />
                </div>
            </div>
        </div>
        <div class="mb-3 col-md-12 d-flex justify-content-end mt-2">
            <button type="button" class="btn btn-danger light me-2" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"
                id="commonModalSubmitButton">{{ isset($data) ? 'Update' : 'Save' }}</button>
        </div>
    </div>
</form>
