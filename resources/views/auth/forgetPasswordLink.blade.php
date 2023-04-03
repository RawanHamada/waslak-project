







<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none" data-preloader="disable">

<x-head />

<body>



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
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                         xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                        <path
                            d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z">
                        </path>
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
                                        <img src="{{ asset('adminassets/images/logo-light.png') }}"
                                             alt="" height="20">
                                    </a>
                                </div>
                                <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">{{ __('Reset Password') }}</div>







                                    <div class="card-body">



                                        <form action="{{ route('reset.password.post') }}" method="POST">

                                            @csrf

                                            <input type="hidden" name="token" value="{{ $token }}">



                                            <div class="form-group row">

                                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                                <div class="col-md-6">

                                                    <input type="text" id="email_address" class="form-control" name="email" required autofocus>

                                                    @if ($errors->has('email'))

                                                        <span class="text-danger">{{ $errors->first('email') }}</span>

                                                    @endif

                                                </div>

                                            </div>



                                            <div class="form-group row">

                                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                                <div class="col-md-6">

                                                    <input type="password" id="password" class="form-control" name="password" required autofocus>

                                                    @if ($errors->has('password'))

                                                        <span class="text-danger">{{ $errors->first('password') }}</span>

                                                    @endif

                                                </div>

                                            </div>



                                            <div class="form-group row">

                                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                                <div class="col-md-6">

                                                    <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>

                                                    @if ($errors->has('password_confirmation'))

                                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>

                                                    @endif

                                                </div>

                                            </div>



                                            <div class="col-md-6 offset-md-4">

                                                <button type="submit" class="btn btn-primary">

                                                    Reset Password

                                                </button>

                                            </div>

                                        </form>



                                    </div>










                                </div>
                            </div>
                        </div>
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
                                        </script> Velzon. Crafted with <i
                                            class="mdi mdi-heart text-danger"></i>
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
        </div>
        <x-js />
        </body>

        </html>
