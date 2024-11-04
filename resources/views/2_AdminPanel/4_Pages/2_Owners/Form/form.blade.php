<form id="commonModalForm" action="{{ $data ? route('owners.update', $data->id) : route('owners.store') }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @if ($data)
        <input name="_method" type="hidden" value="PUT">
        <input type="hidden" name="id" value="{{ $data->id }}">
        <input type="hidden" name="user_id" value="{{ $data->user_id }}">
    @endif
    <div class="row">
        <div class="mb-3 col-md-6">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" placeholder="Enter Your Name"
                value="{{ $data->user->name ?? '' }}" />
            <x-input-error :messages="$errors->get('name')" />
        </div>
        <div class="mb-3 col-md-6">
            <x-input-label for="email" :value="__('Email')" /><small class="form-text text-muted">*Password will be your email ID.</small>
            <x-text-input id="email" type="email" name="email" :value="old('email')" placeholder="Enter Your Email"
                value="{{ $data->user->email ?? '' }}" />
            <x-input-error :messages="$errors->get('email')" />
        </div>
        <div class="mb-3 col-md-6">
            <x-input-label for="phone" :value="__('Primary Phone')" />
            <x-text-input id="phone" type="tel" name="phone" :value="old('phone')" placeholder="Enter Your Phone"
                value="{{ $data->user->phone ?? '' }}" />
            <div class="validate-phone"></div>
            <x-input-error :messages="$errors->get('phone')" />
        </div>
        <div class="mb-3 col-md-6">
            <x-input-label for="phone_2" :value="__('Secondary Phone')" />
            <x-text-input id="phone_2" type="tel" name="phone_2" :value="old('phone_2')" placeholder="Enter Your Phone"
                value="{{ $data->additional_phone ?? '' }}" />
            <div class="validate-phone-2"></div>
            <x-input-error :messages="$errors->get('phone_2')" />
        </div>
        <div class="mb-3 col-md-6">
            <x-input-label for="proof_type" :value="__('Proof Type')" />
            <select class="default-select style-1 form-control" id="proof_type" name="proof_type">
                <option value="" data-display="Select">Please select</option>
                <option value="aadhaar" {{ old('proof_type', $data->proof_type ?? '') == 'aadhaar' ? 'selected' : '' }}>
                    Aadhaar</option>
                <option value="passport"
                    {{ old('proof_type', $data->proof_type ?? '') == 'passport' ? 'selected' : '' }}>Passport</option>
                <option value="driving_license"
                    {{ old('proof_type', $data->proof_type ?? '') == 'driving_license' ? 'selected' : '' }}>Driving
                    License</option>
                <option value="voter_id"
                    {{ old('proof_type', $data->proof_type ?? '') == 'voter_id' ? 'selected' : '' }}>Voter ID</option>
            </select>
            <div class="validate-proof-type"></div>
            <x-input-error :messages="$errors->get('proof_type')" />
        </div>
        <div class="mb-3 col-md-6">
            <x-input-label for="proof_id" :value="__('Proof ID')" />
            <x-text-input id="proof_id" type="text" name="proof_id" :value="old('proof_id')"
                placeholder="Enter Your Proof ID" value="{{ $data->proof_id ?? '' }}" />
            <x-input-error :messages="$errors->get('proof_id')" />
        </div>
        <div class="mb-3 col-md-6">
            <x-input-label for="proof_image" :value="__('Proof')" />
            <div class="d-flex justify-content-center">
                <img id="proofPreview" class="form-img-preview mb-2" alt="Proof Preview"
                    src="{{ isset($data->proof_image) ? asset('storage/' . $data->proof_image) : '' }}"
                    style="{{ isset($data->proof_image) ? 'display: block;' : 'display: none;' }}">
            </div>
            <x-text-input id="proof_image" type="file" name="proof_image" accept="image/*" />
            <x-input-error :messages="$errors->get('proof_image')" />
        </div>
        <div class="mb-3 col-md-6">
            <x-input-label for="avatar" :value="__('Avatar')" />
            <div class="d-flex justify-content-center">
                <img id="avatarPreview" class="form-img-preview mb-2" alt="Avatar Preview"
                    src="{{ isset($data->user->image_path) ? asset('storage/' . $data->user->image_path) : '' }}"
                    style="{{ isset($data->user->image_path) ? 'display: block;' : 'display: none;' }}">
            </div>
            <x-text-input id="avatar" type="file" name="avatar" accept="image/*" value="" />
            <x-input-error :messages="$errors->get('avatar')" />
        </div>
        <div class="mb-3 col-md-6">
            <x-input-label :value="__('Status')" />
            <div class="mt-1">
                <div class="form-check custom-checkbox form-check-inline">
                    <input type="radio" class="form-check-input" name="status" value="1"
                        {{ old('status', $data->user->is_active ?? 1) == 1 ? 'checked' : '' }}>
                    <x-input-label :value="__('Active')" />
                </div>
                <div class="form-check custom-checkbox form-check-inline">
                    <input type="radio" class="form-check-input" name="status" value="0"
                        {{ old('status', $data->user->is_active ?? '') == 0 ? 'checked' : '' }}>
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
