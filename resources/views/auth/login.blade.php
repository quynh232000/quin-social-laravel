@extends('layouts.guest')
@section('title')
    Login
@endsection
@section('content')



    <div class="main-wrap">

        <div class="nav-header bg-transparent shadow-none border-0">
            <div class="nav-top w-100">
                <a href="{{url('/')}}"><i class="fa-brands fa-facebook display1-size me-2 ms-0"></i><span class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">{{config("app.name")}} </span> </a>
                <a href="#" class="mob-menu ms-auto me-2 chat-active-btn"><i class="feather-message-circle text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <a href="default-video.html" class="mob-menu me-2"><i class="feather-video text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <a href="#" class="me-2 menu-search-icon mob-menu"><i class="feather-search text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <button class="nav-menu me-0 ms-2"></button>

                <a href="{{route('login')}}" class="header-btn d-none d-lg-block bg-dark fw-500 text-white font-xsss p-3 ms-auto w100 text-center lh-20 rounded-xl"  data-bs-toggle="modal" data-bs-target="#Modallogin">Login</a>
                <a href="{{route('register')}}" class="header-btn d-none d-lg-block bg-current fw-500 text-white font-xsss p-3 ms-2 w100 text-center lh-20 rounded-xl"  data-bs-toggle="modal" data-bs-target="#Modalregister">Register</a>

            </div>
            
            
        </div>

        <div class="row">
            <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat" style="background-image: url(images/login-bg.jpg);"></div>
            <div class="col-xl-7 vh-100 align-items-center d-flex bg-white rounded-3 overflow-hidden">
                <div class="card shadow-none border-0 ms-auto me-auto login-card">
                    <div class="card-body rounded-0 text-left">
                        <h2 class="fw-700 display1-size display2-md-size mb-3">Login into <br>your account</h2>
                        
                        <form method="POST" action="{{route('login')}}">
                            @csrf
                            <div class="form-group icon-input mb-3">
                                <i class="font-sm ti-email text-grey-500 pe-0 fa fa-user"></i>
                                <input type="text" name="username" value="{{old('username')}}" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Username">     
                                <x-input-error :messages="$errors->get('username')" class="mt-2" />                   
                            </div>
                            <div class="form-group icon-input mb-1">
                                <input type="password" name="password" value="{{old('password')}}" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3" placeholder="Password">
                                <i class="font-sm ti-lock text-grey-500 pe-0 fa fa-lock"></i>
                                <x-input-error :messages="$errors->get('paswword')" class="mt-2" />
                            </div>
                            <div class="form-check text-left mb-3">
                                <input type="checkbox" name="remember" class="form-check-input mt-2" id="exampleCheck5">
                                <label class="form-check-label font-xsss text-grey-500" for="exampleCheck5">Remember me</label>
                                <a href="forgot.html" class="fw-600 font-xsss text-grey-700 mt-1 float-right">Forgot your Password?</a>
                            </div>
                            <div class="form-group mb-1"><button type="submit" class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0 ">Login</button></div>
                        </form>
                         
                        <div class="col-sm-12 p-0 text-left">
                            
                            <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">Dont have account <a href="{{route(('register'))}}" class="fw-700 ms-1">Register</a></h6>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>

  
@endsection
