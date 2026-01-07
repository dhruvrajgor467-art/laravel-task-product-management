@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Register</div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}" >
                    @csrf

                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" >
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" >
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" >
                        @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="mb-3">
                        <label>Password Confirm</label>
                        <input type="password" name="password_confirmation" class="form-control">
                        @error('password_confirmation')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    

                    <button class="btn btn-primary w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
