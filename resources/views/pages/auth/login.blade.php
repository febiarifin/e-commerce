@extends('layouts.template')

@section('content')
    <div class="page-inner">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title text-center">{{ $title }}</div>
                    </div>
                    <form action="{{ route('login.auth') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" placeholder="Enter Email" required />
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" placeholder="Password" required />
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success" style="submit">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
