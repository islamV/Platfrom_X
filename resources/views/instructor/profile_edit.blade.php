@extends('layouts.app')

@section('title', 'Student Profile')

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
                        <form method="POST" action="{{ Route('instructor_profile.edit.post') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-md-center" >
                                <div class="col-md-6">
                                    <div class="clean-product-item">
                                        <label class="form-label" for="name">Name</label>
                                            <input type="name" class="form-control" id="name" name="name" value= "{{ Auth::guard('instructor')->user()->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-md-center" >
                                <div class="col-md-6">
                                    <div class="clean-product-item">
                                        <label class="form-label" for="email">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email" value= "{{ Auth::guard('instructor')->user()->email }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-md-center" >
                                <div class="col-md-6">
                                    <div class="clean-product-item">
                                        <label class="form-label" for="email">Phone</label>
                                            <input type="phone" class="form-control" id="phone" name="phone" value= "{{ Auth::user()->phone }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-md-center" >
                                <div class="col-md-6">
                                    <div class="clean-product-item">
                                        @if(Auth::user()->gender == "male")
                                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" checked disabled
                                            value="male">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                male
                                            </label>
                                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" disabled value="female">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                female
                                            </label>
                                        @else
                                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" 
                                                value="male">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                male
                                            </label>
                                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" checked disabled value="female">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                female
                                            </label>
                                        @endif
                                    </div>
                                </div>
                            </div>
        
                            <div class="row justify-content-md-center" >
                                <div class="col-md-6">
                                    <div class="clean-product-item">
                                        <label for="image" class="form-label">Choose picture</label>
                                        <input class="form-control" type="file" id="image" name="image">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-md-center" >
                                <div class="col-md-6">
                                    <div class="clean-product-item">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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

