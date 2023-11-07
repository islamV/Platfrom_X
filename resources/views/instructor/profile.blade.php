@extends('layouts.app')

@section('title', 'Instructor Profile')

@section('content')
    <main class="page">
        <section class="clean-block clean-catalog dark">
            <div class="container">
                <div class="content">
                    <div class="row_cus">
                        <div class="block-heading">
                            <h3 class="text-info"><dt>{{ Auth::guard('instructor')->user()->name}}</dt></h3>
                            <img src="{{ asset('ProfilePics/instructors/' . Auth::guard('instructor')->user()->photo) }}" alt="profile" class="img-thumbnail" style="width: 200px; height: 200px;">
                        </div>
                        <div class="row justify-content-md-center" >
                            <div class="col-md-6">
                                <div class="clean-product-item">
                                    <label class="form-label" for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" value= "{{ Auth::guard('instructor')->user()->email }}"disabled>
                                </div>
                            </div>
                        </div>
        
                        <div class="row justify-content-md-center" >
                            <div class="col-md-6">
                                <div class="clean-product-item">
                                    <a href="{{ Route('instructor_profile.edit') }}" class="btn btn-primary">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

<style>
    .row_cus{
        min-height: 80vh;
    }
</style>

