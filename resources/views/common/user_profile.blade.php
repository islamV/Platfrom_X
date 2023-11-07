@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
    <main class="page">
        <section class="clean-block clean-catalog dark">
            @if($user)
            <div class="container">
                <div class="content">
                    <div class="row_cus">
                        <div class="block-heading">
                            <h3 class="text-info"><dt>{{$user->name}}</dt></h3>
                            @if($role == 'instructor')
                            <img src="{{ asset('ProfilePics/instructors/' . $user->photo) }}" alt="profile" class="img-thumbnail" style="width: 200px; height: 200px;">
                            @elseif($role == 'student')
                            <img src="{{ asset('ProfilePics/students/' . $user->photo) }}" alt="profile" class="img-thumbnail" style="width: 200px; height: 200px;">
                            @endif
                        </div>
                        <div class="row justify-content-md-center" >
                            <div class="col-md-6">
                                <div class="clean-product-item">
                                    <label class="form-label" for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" value= "{{ $user->email }}"disabled>
                                </div>
                            </div>
                        </div>
                      
                        <div class="row justify-content-md-center" >
                            <div class="col-md-6">
                                <div class="clean-product-item">
                                    <label class="form-label" for="institute">Date joined</label>
                                    <input type="institute" class="form-control" id="institute" name="institute" value= "{{ $user->date_joined }}"disabled>
                                </div>
                            </div>
                        </div>
                        @auth('instructor')
                        <div class="row justify-content-md-center" >
                            <div class="col-md-6">
                                <div class="clean-product-item">
                                    <a href="#" class="btn btn-outline-primary">View grades</a>
                                </div>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
            @endif
        </section>
    </main>
@endsection

<style>
    .row_cus{
        min-height: 80vh;
    }
</style>
