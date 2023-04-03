<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<x-head />

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="{{ asset('adminassets/images/logo-light.png') }}" alt=""
                                        height="20">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to Waslak.</p>
                                </div>
                                <div class="p-2 mt-4">

                                    <form method="POST" action="{{ route('admin.login') }}">
                                        @csrf


                                        {{--                                        <label class="form-label" for="password-input">Email</label> --}}

                                        {{--                                        <div class="mb-3"> --}}
                                        {{--                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus> --}}

                                        {{--                                @error('email') --}}
                                        {{--                                    <span class="invalid-feedback" role="alert"> --}}
                                        {{--                                        <strong>{{ $message }}</strong> --}}
                                        {{--                                    </span> --}}
                                        {{--                                @enderror --}}
                                        {{--                                        </div> --}}



                                        @if ($errors->any())
                                            <div class="">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li style="color: red">{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif


                                        <div >
                                            <label for="email">Email</label>
                                            <input style="border : 1px solid #ddd" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                id="email" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            {{-- <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}"> --}}
{{--                                            @error('email')--}}
{{--                                            <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                                            @enderror--}}
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input style="border : 1px solid #ddd" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" id="password" autofocus>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            {{-- <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password"> --}}
{{--                                            @error('password')--}}
{{--                                            <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                                            @enderror--}}
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">
                                                @if (Route::has('forget.password.get'))
                                                    <a href="{{ route('forget.password.get') }}"
                                                        class="text-muted">Forgot password?</a>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember
                                                me</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">
                                                {{ __('Login') }}</button>
                                        </div>


                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Don't have an account ? <a href="{{ route('admin.register') }}"
                                    class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Velzon. Crafted with <i class="mdi mdi-heart text-danger"></i>
                                by Themesbrand
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <x-js />
</body>

</html>
