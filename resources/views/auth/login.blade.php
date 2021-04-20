@extends('layouts.login')

@section('title', 'Beranda')

@section('content')
<section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" tabindex="1" required autofocus>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" tabindex="2" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="role" class="col-form-label">{{ __('Login Sebagai') }}</label>
                    <select name="role" id="role" class="custom-select" required tabindex="3">
                        <option value="user" selected></option>
                        <option value="student">Siswa</option>
                        <option value="question_writer">Penulis Soal</option>
                        <option value="school_admin">Admin Sekolah</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
                <div class="row sm-gutters">
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection