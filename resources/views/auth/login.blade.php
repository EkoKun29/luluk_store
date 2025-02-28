<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <title>LULUK STORE | LOGIN</title>
</head>

<body>
    <section class="signin-section">
        <div class="container-fluid">
            <div class="row g-0 auth-row">
                <div class="col-lg-6">
                    <div class="auth-cover-wrapper bg-primary-100">
                        <div class="auth-cover">
                            <div class="title text-center">
                                <h1 class="text-primary mb-10">SELAMAT DATANG</h1>
                                <p class="text-medium">
                                    Silahkan Login Untuk Melanjutkan.
                                </p>
                            </div>
                            <div class="cover-image">
                                <img src="assets/images/auth/signin-image.svg" alt="">
                            </div>
                            <div class="shape-image">
                                <img src="assets/images/auth/shape.svg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-6">
                    <div class="signin-wrapper">
                        <div class="form-wrapper">
                            <h6 class="mb-15">Sign In</h6>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Email</label>
                                            <input class="@error('email') is-invalid @enderror" type="email" placeholder="Email" name="email"
                                                required>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Password</label>
                                            <input type="password" placeholder="Password" name="password"
                                                required>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-12">
                                        <div
                                            class="button-group d-flex justify-content-center flex-wrap ">
                                            <button class=" main-btn primary-btn btn-hover w-100 text-center ">
                                                Sign In
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </form>
                            <div class="text-center">
                                <div class="p-6 px-1 pt-0 text-center bg-transparent border-t-0 border-t-solid rounded-b-2xl lg:px-2">
                                  <p class="mx-auto mb-6 leading-normal text-sm">
                                    Belum memiliki akun?
                                    <a href="{{ route('_register') }}" class="relative z-10 font-semibold text-transparent bg-gradient-to-tl from-blue-600 to-cyan-400 bg-clip-text">Daftar Sekarang</a>
                                  </p>
                                </div>
                              </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
    </section>
</body>

</html>
