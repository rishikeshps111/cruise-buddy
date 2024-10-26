<x-guest-layout>
    <div class="col-lg-6 col-md-12 col-sm-12 mx-auto align-self-center">
        <div class="login-form">
            <div class="text-center">
                <h3 class="title">Sign In</h3>
                <p>Sign in to your account to start using W3CRM</p>
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                        autocomplete="username" placeholder="Enter Your Email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <!-- Password -->
                <div class="mb-4 position-relative">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="dz-password" type="password" name="password" required
                        placeholder="Enter Your Password" autocomplete="current-password" />

                    <span class="show-pass eye">
                        <i class="fa fa-eye-slash"></i>
                        <i class="fa fa-eye"></i>
                    </span>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <!-- Remember Me -->
                <div class="form-row d-flex justify-content-between mt-4 mb-2">
                    <div class="mb-4">
                        <div class="form-check custom-checkbox mb-3">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                            <label class="form-check-label" for="remember_me">Remember me</label>
                        </div>
                    </div>
                    @if (Route::has('password.request'))
                        <div class="mb-4">
                            <a href="{{ route('password.request') }}" class="btn-link text-primary">Forgot Password?</a>
                        </div>
                    @endif
                </div>
                <div class="text-center mb-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
