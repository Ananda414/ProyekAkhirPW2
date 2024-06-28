<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SMK Farmasi Pembina Palembang</title>
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
    <style>
        /* Gambar background untuk seluruh halaman */
        .auth {
            background-image: url('../../assets/images/gambar sekolah.jpg'); /* Ganti dengan path gambar background Anda */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* Gambar background untuk kotak login */
        .auth-form-light {
            background-color: rgba(255, 255, 255, 0.9); /* Warna putih dengan transparansi */
            padding: 20px;
            border-radius: 10px;
        }

        /* Logo di atas form login */
        .auth-logo {
            display: block;
            margin: 0 auto 20px auto;
            width: 100px; /* Ubah ukuran sesuai kebutuhan */
        }
    </style>
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                      <!-- Pesan kesalahan jika ada -->
                      @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                      @endif
                        <!-- Gambar logo di sini -->
                        <img src="../../assets/images/logo sekolah.jpg" alt="Logo" class="auth-logo"> <!-- Ganti dengan path gambar logo Anda -->
                        <h4>Halo! Ayo Login</h4>
                        <h6 class="font-weight-light">Sign in untuk lanjut.</h6>
                        <form class="pt-3" method="POST" action="{{ route('authenticate') }}">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="mt-3">
                                <input type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="Login">
                            </div>
                            {{-- <div class="my-2 d-flex justify-content-between align-items-center">
                            <a href="#" class="auth-link text-black">Forgot password?</a>
                            </div> --}}
                            <div class="text-center mt-4 font-weight-light"> Lupa email atau password? Hubungi No.Telp (WA): +6289681486896 atau Email: wijayaananda28@gmail.com
                                {{-- <a href="register" class="text-primary">Create</a> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
<script src="../../assets/js/off-canvas.js"></script>
<script src="../../assets/js/hoverable-collapse.js"></script>
<script src="../../assets/js/misc.js"></script>
</body>
</html>
