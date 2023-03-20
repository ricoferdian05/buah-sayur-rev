@extends('home/layouts/main')

@section('container')
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <main class="form-signin mb-5">
                <h1 class="h5 mb-3 fw-normal text-center">Registrasi Sebagai Pedagang</h1>
                <form action="/home/signup" method="POST">
                    @csrf
                    <div class="form-floating">
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama toko" autofocus required value="{{ old('nama') }}">
                        <label for="nama">Nama Toko</label>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email@gmail.com" required value="{{ old('email') }}">
                        <label for="email">Alamat Email</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="number" name="telp" class="form-control @error('telp') is-invalid @enderror" id="telp" placeholder="Nomor telp" required>
                        <label for="telp">Nomor Telepon</label>
                        @error('telp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-floating">
                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat lengkap" required value="{{ old('alamat') }}">
                        <label for="alamat">Alamat Lengkap</label>
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="username" required value="{{ old('username') }}">
                        <label for="username">Username</label>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                        <label for="password">Kata Sandi</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="password_confirmation" required>
                        <label for="password_confirmation">Ulangi Kata Sandi</label>
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <input type="hidden" name="is_active" value="1">
                    <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Registrasi</button>
                </form>
                <hr>
                <a class="small" style="text-decoration: none;" href="/home/login">Sudah mempunyai akun? Silakan Login.</a>
            </main>
        </div>
    </div>
@endsection