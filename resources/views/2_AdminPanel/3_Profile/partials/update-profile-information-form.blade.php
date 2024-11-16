<form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="UpdateProfile">
    @csrf
    @method('patch')
    <div class="card-body">
        <div class="mt-2">
            <div class="row mb-4">
                <div class="col-md-3">
                    <label class="form-label mb-md-0">Avatar</label>
                </div>
                <div class="col-md-9">
                    <div class="d-inline-block position-relative me-4 mb-3 mb-lg-0">
                        <img src="{{ $user->image_path ? asset($user->image_path) : asset('2_AdminPanel/assets/images/dummy-avatar.jpg') }}"
                            alt="" class="rounded-4 profile-avatar fixed-avatar" id="profile-avatar-preview">
                        <button type="button"
                            class="btn btn-primary btn-sharp position-absolute bottom-0 end-0 avatar-upload-button">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <input type="file" name="avatar" id="avatar" style="display: none;">
                        <x-input-error :messages="$errors->get('avatar')" />
                    </div>
                </div>
            </div>


            <div class="row align-items-center mb-4">
                <div class="col-md-3">
                    <label class="form-label mb-md-0" for="name">Name</label>
                </div>
                <div class="col-md-9">
                    <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required
                        autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" />
                </div>
            </div>
            <div class="row align-items-center mb-4">
                <div class="col-md-3">
                    <label class="form-label mb-md-0" for="email">Email</label>
                </div>
                <div class="col-md-9">
                    <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" />

                </div>
            </div>
            <div class="row align-items-center mb-4">
                <div class="col-md-3">
                    <label class="form-label mb-md-0" for="phone">Contact Phone</label>
                </div>
                <div class="col-md-9">
                    <x-text-input id="phone" name="phone" type="tel" :value="old('phone', $user->phone)" required />
                    <div class="validate-phone"></div>
                    <x-input-error :messages="$errors->get('phone')" />
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary ms-2">{{ __('Save') }}</button>
    </div>
    @if (session('status') === 'profile-updated')
        <div id="session-message" data-message="Profile Updated successfully" data-type="success"
            style="display: none;"></div>
    @endif
</form>
