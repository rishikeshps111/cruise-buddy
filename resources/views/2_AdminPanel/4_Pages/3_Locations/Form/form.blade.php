<form id="commonModalForm" action="{{ $data ? route('locations.update', $data->id) : route('locations.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($data)
        <input name="_method" type="hidden" value="PUT">
        <input type="hidden" name="id" value="{{ $data->id }}">
    @endif
    <div class="row">
        <div class="mb-3 col-md-6">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" placeholder="Enter Name"
                value="{{ $data->name ?? '' }}" />
            <x-input-error :messages="$errors->get('name')" />
        </div>
        <div class="mb-3 col-md-6">
            <x-input-label for="district" :value="__('District')" />
            <select class="default-select style-1 form-control" id="district" name="district" data-live-search="true">
                <option value="" data-display="Select">Please select</option>
                <option value="thiruvananthapuram"
                    {{ old('district', $data->district ?? '') == 'thiruvananthapuram' ? 'selected' : '' }}>
                    Thiruvananthapuram</option>
                <option value="kollam" {{ old('district', $data->district ?? '') == 'kollam' ? 'selected' : '' }}>Kollam
                </option>
                <option value="pathanamthitta"
                    {{ old('district', $data->district ?? '') == 'pathanamthitta' ? 'selected' : '' }}>Pathanamthitta
                </option>
                <option value="alappuzha" {{ old('district', $data->district ?? '') == 'alappuzha' ? 'selected' : '' }}>
                    Alappuzha</option>
                <option value="kottayam" {{ old('district', $data->district ?? '') == 'kottayam' ? 'selected' : '' }}>
                    Kottayam</option>
                <option value="idukki" {{ old('district', $data->district ?? '') == 'idukki' ? 'selected' : '' }}>Idukki
                </option>
                <option value="ernakulam" {{ old('district', $data->district ?? '') == 'ernakulam' ? 'selected' : '' }}>
                    Ernakulam</option>
                <option value="kottayam" {{ old('district', $data->district ?? '') == 'kottayam' ? 'selected' : '' }}>
                    Kottayam</option>
                <option value="thrissur" {{ old('district', $data->district ?? '') == 'thrissur' ? 'selected' : '' }}>
                    Thrissur</option>
                <option value="palakkad" {{ old('district', $data->district ?? '') == 'palakkad' ? 'selected' : '' }}>
                    Palakkad</option>
                <option value="malappuram"
                    {{ old('district', $data->district ?? '') == 'malappuram' ? 'selected' : '' }}>Malappuram</option>
                <option value="kozhikode"
                    {{ old('district', $data->district ?? '') == 'kozhikode' ? 'selected' : '' }}>Kozhikode</option>
                <option value="wayanad" {{ old('district', $data->district ?? '') == 'wayanad' ? 'selected' : '' }}>
                    Wayanad</option>
                <option value="kannur" {{ old('district', $data->district ?? '') == 'kannur' ? 'selected' : '' }}>
                    Kannur</option>
                <option value="kasaragod"
                    {{ old('district', $data->district ?? '') == 'kasaragod' ? 'selected' : '' }}>Kasaragod</option>
            </select>
            <div class="validate-district"></div>
            <x-input-error :messages="$errors->get('district')" />
        </div>
        <div class="mb-3 col-md-6">
            <x-input-label for="state" :value="__('State')" />
            <select class="default-select style-1 form-control" id="state" name="state" data-live-search="true">
                <option value="" data-display="Select">Please select</option>
                <option value="kerala" {{ old('state', $data->state ?? '') == 'kerala' ? 'selected' : '' }}>
                    Kerala</option>
            </select>
            <div class="validate-state"></div>
            <x-input-error :messages="$errors->get('state')" />
        </div>
        <div class="mb-3 col-md-6">
            <x-input-label for="country" :value="__('Country')" />
            <select class="default-select style-1 form-control" id="country" name="country" data-live-search="true">
                <option value="" data-display="Select">Please select</option>
                <option value="india" {{ old('country', $data->country ?? '') == 'india' ? 'selected' : '' }}>
                    India</option>
            </select>
            <div class="validate-country"></div>
            <x-input-error :messages="$errors->get('country')" />
        </div>
        <div class="mb-3 col-md-12">
            <x-input-label for="map_url" :value="__('Map URL')" />
            <x-text-input id="map_url" type="text" name="map_url" :value="old('map_url')" placeholder="Enter Map URL"
                value="{{ $data->map_url ?? '' }}" />
            <x-input-error :messages="$errors->get('map_url')" />
        </div>
        <div class="mb-3 col-md-6">
            <x-input-label for="thumbnail" :value="__('Thumbnail')" />
            <div class="d-flex justify-content-center">
                <img id="thumbnailPreview" class="form-img-preview mb-2" alt="Thumbnail Preview"
                    src="{{ isset($data->thumbnail) ? asset('storage/' . $data->thumbnail) : '' }}"
                    style="{{ isset($data->thumbnail) ? 'display: block;' : 'display: none;' }}">
            </div>
            <x-text-input id="thumbnail" type="file" name="thumbnail" accept="image/*" />
            <x-input-error :messages="$errors->get('thumbnail')" />
        </div>
        <div class="mb-3 col-md-12 d-flex justify-content-end mt-2">
            <button type="button" class="btn btn-danger light me-2" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"
                id="commonModalSubmitButton">{{ isset($data) ? 'Update' : 'Save' }}</button>
        </div>
    </div>
</form>
