@extends('layouts.app')

@section('title', 'Student Login')

@section('content')
    <main class="page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Student Signin</h2>
                </div>
                <form method="POST" action="{{ Route('student_login.post') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="email">Email address</label>
                        <input type="email" class="form-control" placeholder="name@example.com" id="email" name="email">
                        <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                        <span class="text-danger">@error('password') {{$message}} @enderror</span>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                </form>
            </div>
        </section>
    </main>
@endsection
