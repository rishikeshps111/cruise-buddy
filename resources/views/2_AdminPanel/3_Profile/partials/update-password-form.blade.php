<form method="post" action="{{ route('password.update') }}" id="UpdatePassword">
    @csrf
    @method('put')
    <div class="card-body">
        <div class="mt-2">
            <div class="row align-items-center mb-4">
                <div class="col-md-3">
                    <label class="form-label mb-md-0" for="update_password_current_password">Current Password</label>
                </div>
                <div class="col-md-9">
                    <div class="position-relative">
                        <x-text-input id="update_password_current_password" name="current_password" type="password"
                            autocomplete="current-password" placeholder="Enter Current Password" data-name="password"
                            required minlength="3" maxlength="15" />
                        <span class="show-pass eye">
                            <i class="fa fa-eye-slash"></i>
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                    <div class="validate-current-password"></div>
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" />
                </div>
            </div>
            <div class="row align-items-center mb-4">
                <div class="col-md-3">
                    <label class="form-label mb-md-0" for="update_password_password">New Password</label>
                </div>
                <div class="col-md-9">
                    <div class="position-relative">
                        <x-text-input id="update_password_password" name="password" type="password"
                            autocomplete="new-password" placeholder="Enter New Password" data-name="password" />
                        <span class="show-pass eye">
                            <i class="fa fa-eye-slash"></i>
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                    {{-- custom error section --}}
                    <div class="validate-new-password"></div>
                    <x-input-error :messages="$errors->updatePassword->get('password')" />
                </div>
            </div>
            <div class="row align-items-center mb-4">
                <div class="col-md-3">
                    <label class="form-label mb-md-0" for="update_password_password_confirmation">Confirm
                        Password</label>
                </div>
                <div class="col-md-9">
                    <div class="position-relative">
                        <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                            type="password" autocomplete="new-password" placeholder="Enter Confirm Password"
                            data-name="password" />
                        <span class="show-pass eye">
                            <i class="fa fa-eye-slash"></i>
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                    <div class="validate-confirm-password"></div>
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary ms-2">{{ __('Save') }}</button>
    </div>
    @if (session('status') === 'password-updated')
        <div id="session-message" data-message="Password Changed successfully" data-type="success"
            style="display: none;"></div>
    @endif
</form>
