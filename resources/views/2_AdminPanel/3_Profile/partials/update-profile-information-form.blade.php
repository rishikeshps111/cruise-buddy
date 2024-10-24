<section>

    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Basic Info</h6>
            </div>
            <div class="card-body">
                <form action="#" class="mt-2">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label class="form-label mb-md-0">Avatar</label>
                        </div>
                        <div class="col-md-9">
                            <div class="d-inline-block position-relative me-4 mb-3 mb-lg-0">
                                <img src="../../..//images/avatar/pic7.jpg" alt=""
                                    class="rounded-4 profile-avatar">
                                <button type="button"
                                    class="btn btn-primary btn-sharp position-absolute bottom-0 end-0">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-4">
                        <div class="col-md-3">
                            <label class="form-label mb-md-0">Full Name</label>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="First Name">
                                </div>
                                <div class="col-sm-6 mt-2 mt-sm-0">
                                    <input type="text" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-4">
                        <div class="col-md-3">
                            <label class="form-label mb-md-0">Company</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="DexignZone">
                        </div>
                    </div>
                    <div class="row align-items-center mb-4">
                        <div class="col-md-3">
                            <label class="form-label mb-md-0">Contact Phone</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control" placeholder="044 3276 454 935">
                        </div>
                    </div>
                    <div class="row align-items-center mb-4">
                        <div class="col-md-3">
                            <label class="form-label mb-md-0">Company Site</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="https://dexignzone.com/">
                        </div>
                    </div>
                    <div class="row align-items-center mb-4">
                        <div class="col-md-3">
                            <label class="form-label mb-md-0">Country</label>
                        </div>
                        <div class="col-md-9">
                            <select class="default-select form-control">
                                <option>Please select</option>
                                <option>India</option>
                                <option>China</option>
                                <option>USA</option>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center mb-4">
                        <div class="col-md-3">
                            <label class="form-label mb-md-0">Notifications</label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-check custom-checkbox me-4 mb-0 d-inline-block">
                                <input type="checkbox" class="form-check-input mb-0" id="checkboxEmail" required>
                                <label class="form-check-label" for="checkboxEmail">Email</label>
                            </div>
                            <div class="form-check custom-checkbox me-4 mb-0 d-inline-block">
                                <input type="checkbox" class="form-check-input mb-0" id="checkboxPhone" required>
                                <label class="form-check-label" for="checkboxPhone">Phone</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-md-3">
                            <label class="form-label mb-md-0">Allow Changes</label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="flexSwitchCheckChecked" checked>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-end">
                <a href="javascript:void(0);" class="btn btn-white">Discard</a>
                <a href="javascript:void(0);" class="btn btn-primary ms-2">Save Changes</a>
            </div>
        </div>
    </div>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
