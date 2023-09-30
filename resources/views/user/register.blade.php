@extends('layouts.app')

@section('title', 'Student Register')

@section('content')
<main class="page">
    <section class="clean-block clean-form dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">Student Signup</h2>
            </div>
            <form method="POST" action="{{ Route('student_register.post') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" class="form-control" placeholder="EX: John Smith" id="name" value="{{ old('name') }}" name="name">
                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Email address</label>
                    <input type="email" class="form-control" placeholder="name@example.com" id="email" value="{{ old('email') }}" name="email">
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                    <span class="text-danger">@error('password') {{$message}} @enderror</span>
                </div>
               
                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
            </form>
        </div>
    </section>
</main>
@endsection