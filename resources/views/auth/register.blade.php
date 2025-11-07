<x-guest-layout>
   <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">

            <!-- Registration form -->
            <form  method="POST" action="{{ route('register') }}" class="flex-fill">
                 @csrf
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                                        <img src="https://themes.kopyov.com/limitless/demo/template/assets/images/logo_icon.svg" class="h-48px" alt="">
                                    </div>
                                    <h5 class="mb-0">Create account</h5>
                                    <span class="d-block text-muted">All fields are required</span>
                                </div>

                                <div class="mb-3">
                                    <x-input-label for="username" class="form-label" :value="__('Username')" />
                                    <div class="form-control-feedback form-control-feedback-start">
                                        <x-text-input id="username" type="text" name="username" :value="old('username')" required autofocus class="form-control" placeholder="KhanAli" />
                                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                        <div class="form-control-feedback-icon">
                                            <i class="ph-user-circle text-muted"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <x-input-label for="first_name" class="form-label" :value="__('First name')" />
                                            <div class="form-control-feedback form-control-feedback-start">
                                                <x-text-input id="first_name" type="text" name="first_name" :value="old('first_name')" required autofocus class="form-control" placeholder="Khan" />
                                                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                                <div class="form-control-feedback-icon">
                                                    <i class="ph-user-circle-plus text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <x-input-label for="last_name" class="form-label" :value="__('Last name')" />
                                            <div class="form-control-feedback form-control-feedback-start">
                                                <x-text-input id="last_name" type="text" name="last_name" :value="old('last_name')" required autofocus class="form-control" placeholder="Ali" />
                                                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                                <div class="form-control-feedback-icon">
                                                    <i class="ph-user-circle-plus text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <x-input-label for="password" class="form-label" :value="__('Create password')" />
                                            <div class="form-control-feedback form-control-feedback-start">
                                                <x-text-input id="password" type="password" name="password" required class="form-control" placeholder="•••••••••••" />
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                <div class="form-control-feedback-icon">
                                                    <i class="ph-lock text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <x-input-label for="password_confirmation" class="form-label" :value="__('Repeat password')" />
                                            <div class="form-control-feedback form-control-feedback-start">
                                                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required class="form-control" placeholder="•••••••••••" />
                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                                <div class="form-control-feedback-icon">
                                                    <i class="ph-lock text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <x-input-label for="email" class="form-label" :value="__('Your email')" />
                                            <div class="form-control-feedback form-control-feedback-start">
                                                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus class="form-control" placeholder="john@doe.com" />
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                <div class="form-control-feedback-icon">
                                                    <i class="ph-at text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <x-input-label for="email_confirmation" class="form-label" :value="__('Repeat email')" />
                                            <div class="form-control-feedback form-control-feedback-start">
                                                <x-text-input id="email_confirmation" type="email" name="email_confirmation" :value="old('email_confirmation')" required autofocus class="form-control" placeholder="john@doe.com" />
                                                <x-input-error :messages="$errors->get('email_confirmation')" class="mt-2" />
                                                <div class="form-control-feedback-icon">
                                                    <i class="ph-at text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="form-check mb-2">
                                        <input type="checkbox" name="remember" class="form-check-input" checked>
                                        <span class="form-check-label">Send me <a href="#">&nbsp;test account settings</a></span>
                                    </label>

                                    <label class="form-check mb-2">
                                        <input type="checkbox" name="remember" class="form-check-input" checked>
                                        <span class="form-check-label">Subscribe to monthly newsletter</span>
                                    </label>

                                    <label class="form-check">
                                        <input type="checkbox" name="remember" class="form-check-input">
                                        <span class="form-check-label">Accept <a href="#">&nbsp;terms of service</a></span>
                                    </label>
                                </div>
                            </div>

                            <div class="card-body text-end border-top">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ph-plus me-2"></i>
                                    Create account
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /registration form -->

        </div>
    <!-- /content area -->
</x-guest-layout>
