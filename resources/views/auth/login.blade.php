@extends('layouts.auth')

@section('container')
  <!-- /.login-logo -->
  <div class="card bg-dark">
    <div class="card-body bg-dark login-card-body">

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group mb-3">
                <input type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            </div>
            <div class="input-group mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
            </div>
            <div class="row">
            <!-- /.col -->
            <div class="col">
                <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
            </div>
            <!-- /.col -->
            </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>

@endsection
