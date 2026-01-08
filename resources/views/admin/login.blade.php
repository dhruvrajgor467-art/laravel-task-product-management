@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Admin Login</div>

            <div class="card-body">

                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <input type="email" name="email" placeholder="Email"><br>
                    <input type="password" name="password" placeholder="Password"><br>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
