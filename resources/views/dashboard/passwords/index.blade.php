@extends('dashboard/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h5>Ganti Kata Sandi</h5>
    </div>
    
    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show col-lg-5" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if (session()->has('error'))
      <div class="alert alert-danger alert-dismissible fade show col-lg-5" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="col-lg-5">
        <form method="POST" action="{{ route('change-password') }}" class="mb-5">
            @csrf
            <div class="mb-3">
                <input type="password" class="form-control @error('current_password') is-invalid  @enderror" id="current_password" name="current_password" required autofocus value="{{ old('current_password') }}" placeholder="Kata sandi saat ini">
                @error('current_password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" class="form-control @error('password') is-invalid  @enderror" id="password" name="password" required autofocus value="{{ old('password') }}" placeholder="Kata sandi baru">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" class="form-control @error('password_confirmation') is-invalid  @enderror" id="password_confirmation" name="password_confirmation" required autofocus value="{{ old('password_confirmation') }}" placeholder="Tulis ulang kata sandi baru">
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Ganti Kata Sandi</button>
        </form>
    </div>
@endsection