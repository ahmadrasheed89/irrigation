<x-guest-layout>



				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">

					<!-- Login form -->
					<form method="POST" action="{{ route('login') }}">
                        @csrf
						<div class="card mb-0">
							<div class="card-body">
								<div class="text-center mb-3">
									<div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
										<img src="https://themes.kopyov.com/limitless/demo/template/assets/images/logo_icon.svg" class="h-48px" alt="">
									</div>
									<h5 class="mb-0">Login to your account</h5>
									<span class="d-block text-muted">Enter your credentials below</span>
								</div>
                                <!-- Email Address -->
								<div class="mb-3">
                                    <x-input-label class="form-label" for="email" :value="__('Email')" />
									<div class="form-control-feedback form-control-feedback-start">
                                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus class="form-control" placeholder="john@doe.com" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
										<div class="form-control-feedback-icon">
											<i class="ph-user-circle text-muted"></i>
										</div>
									</div>
								</div>

                                <!-- Password -->
								<div class="mb-3">
									<x-input-label class="form-label" for="password" :value="__('Password')" />
									<div class="form-control-feedback form-control-feedback-start">
										<x-text-input id="password" type="password" name="password" autofocus required class="form-control" placeholder="•••••••••••" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
										<div class="form-control-feedback-icon">
											<i class="ph-lock text-muted"></i>
										</div>
									</div>
								</div>
                                <!-- Remember Me -->
								<div class="d-flex align-items-center mb-3">
									<label class="form-check">
										<input id="remember_me" type="checkbox" name="remember" class="form-check-input" checked>
										<span class="form-check-label">{{ __('Remember') }}</span>
									</label>
                                    @if (Route::has('password.request'))
									    <a href="{{ route('password.request') }}" class="ms-auto">{{ __('Forgot password?') }}</a>
                                    @endif
								</div>

								<div class="mb-3">
                                    <x-primary-button class="btn btn-primary w-100">
                                        {{ __('Login in') }}
                                    </x-primary-button>
								</div>

								<div class="text-center text-muted content-divider mb-3">
									<span class="px-2">or sign in with</span>
								</div>

								<div class="text-center mb-3">
									<button type="button" class="btn btn-outline-primary btn-icon rounded-pill border-width-2"><i class="ph-facebook-logo"></i></button>
									<button type="button" class="btn btn-outline-pink btn-icon rounded-pill border-width-2 ms-2"><i class="ph-dribbble-logo"></i></button>
									<button type="button" class="btn btn-outline-secondary btn-icon rounded-pill border-width-2 ms-2"><i class="ph-github-logo"></i></button>
									<button type="button" class="btn btn-outline-info btn-icon rounded-pill border-width-2 ms-2"><i class="ph-twitter-logo"></i></button>
								</div>

								<div class="text-center text-muted content-divider mb-3">
									<span class="px-2">Don't have an account?</span>
								</div>

								<div class="mb-3">
									<a href="{{ route('register') }}" class="btn btn-light w-100">Create Account</a>
								</div>

								<span class="form-text text-center text-muted">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span>
							</div>
						</div>
					</form>
					<!-- /login form -->

				</div>
				<!-- /content area -->

</x-guest-layout>
