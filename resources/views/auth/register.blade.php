
@extends('layouts.guest')
@section('title')
    Register
@endsection
@section('content')
    <div class="preloader"></div>

    <div class="main-wrap">

        <div class="nav-header bg-transparent shadow-none border-0">
            <div class="nav-top w-100">
                <a href="{{url('/')}}">
                    <i class="fa-brands fa-facebook display1-size me-2 ms-0"></i>
                    <span
                        class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">{{ config('app.name') }}
                    </span> </a>
                <a href="#" class="mob-menu ms-auto me-2 chat-active-btn"><i
                        class="feather-message-circle text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <a href="default-video.html" class="mob-menu me-2"><i
                        class="feather-video text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <a href="#" class="me-2 menu-search-icon mob-menu"><i
                        class="feather-search text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <button class="nav-menu me-0 ms-2"></button>

                <a href="{{ route('login') }}"
                    class="header-btn d-none d-lg-block bg-dark fw-500 text-white font-xsss p-3 ms-auto w100 text-center lh-20 rounded-xl"
                    data-bs-toggle="modal" data-bs-target="#Modallogin">Login</a>
                <a href="{{ route('register') }}"
                    class="header-btn d-none d-lg-block bg-current fw-500 text-white font-xsss p-3 ms-2 w100 text-center lh-20 rounded-xl"
                    data-bs-toggle="modal" data-bs-target="#Modalregister">Register</a>

            </div>


        </div>

        <div class="row">
            <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat"
                style="background-image: url({{asset('images/login-bg-2.jpg')}});"></div>
            <div class="col-xl-7 vh-100 align-items-center d-flex bg-white rounded-3 overflow-scroll">
                <div class="card shadow-none border-0 ms-auto me-auto login-card">
                    <div class="card-body rounded-0 text-left" style="margin-top:40px;padding-top:40px ">
                        <br>
                        <br>
                        <br>
                        <br>
                        <h2 class="fw-700 display1-size display2-md-size my-4">Create <br>your account</h2>
                        <form method="post" action={{ route('register') }} enctype="multipart/form-data" >
                            @csrf
                            @if ($errors->any()){
                                @foreach ($errors as $error)
                                <x-input-error :messages="$error" class="mt-2" />
                                @endforeach
                            }
                                
                            @endif
                            <div class="form-group icon-input mb-3">
                                <i class="font-sm ti-user text-grey-500 pe-0 fa-regular fa-user"></i>
                                <input type="text" name="first_name" value="{{ old('first_name') }}"
                                    class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                    placeholder="Your First Name">
                                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                            </div>
                            <div class="form-group icon-input mb-3">
                                <i class="font-sm ti-user text-grey-500 pe-0 fa-regular fa-user"></i>
                                <input type="text" name="last_name" value="{{ old('last_name') }}"
                                    class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                    placeholder="Your Last Name">
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                            </div>
                            <div class="form-group icon-input mb-3">
                                <i class="font-sm ti-user text-grey-500 pe-0 fa-regular fa-user"></i>
                                <input type="text" name="username" value="{{ old('username') }}"
                                    class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                    placeholder="Your Username">
                                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                            </div>

                            <nav class="nav mb-2 d-flex gap-4 nav-toggle-email-phone">
                                <li class="nav-item">
                                    <div onclick="toggle_email_and_phone_fields('email','Your Email Address','email')"
                                        class="nav-link btn btn-info">Email</div>
                                </li>
                                <li class="nav-item">
                                    <div onclick="toggle_email_and_phone_fields('tel','Your Phone Number','mobile')"
                                        class="nav-link btn btn-info ">Phone</div>
                                </li>
                            </nav>

                            <div class="form-group icon-input mb-3">
                                <i class="font-sm ti-email text-grey-500 pe-0 fa-solid fa-at"></i>
                                <input type="text" name="email" id="email_or_phone" value="{{ old('email') }}"
                                    class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                    placeholder="Your Email Address">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                <script>
                                    function toggle_email_and_phone_fields(input_type, input_placeholder, input_name) {
                                        $("#email_or_phone").attr('type', input_type)
                                        $("#email_or_phone").attr('placeholder', input_placeholder)
                                        $("#email_or_phone").attr('name', input_name)
                                        $("#email_or_phone").attr('value', `{{ old('${input_name}') }}`)

                                    }
                                </script>
                            </div>


                            <label for="profile" class="custom-file-label">Profile</label>
                            <div class="mb-3 custom-file form-group mb-2">
                                <input type="file" name="profile" id="profile" class="custom-file-input">
                                <x-input-error :messages="$errors->get('profile')" class="mt-2" />
                            </div>
                            <label for="">Gender</label> <br>

                            <div class="form-check form-check-inline mb-2">
                                <input type="radio" name="gender" value="male" id="gender1"
                                    class="form-check-input">
                                <label for="gender1" class="form-check-label">Male</label>
                            </div>
                            <div class="form-check form-check-inline">

                                <input type="radio" name="gender" value="female" id="gender2"
                                    class="form-check-input">
                                <label for="gender2" class="form-check-label">Female</label>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>
                            <div class="form-group icon-input mb-3">
                                <input type="Password" name="password" value="{{ old('password') }}"
                                    class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                                    placeholder="Password">
                                <i class="font-sm ti-lock text-grey-500 pe-0 fa-solid fa-lock"></i>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="form-group icon-input mb-1">
                                <input type="Password" name="password_confirmation" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                                    placeholder="Confirm Password">
                                <i class="font-sm ti-lock text-grey-500 pe-0 fa-solid fa-lock"></i>
                            </div>
                            <div class="form-check text-left mb-3">
                                <input type="checkbox" class="form-check-input mt-2" name="terms" id="exampleCheck2">
                                <label class="form-check-label font-xsss text-grey-500" for="exampleCheck2">Accept Term
                                    and
                                    Conditions</label>
                                    <x-input-error :messages="$errors->get('terms')" class="mt-2" />
                                <!-- <a href="#" class="fw-600 font-xsss text-grey-700 mt-1 float-right">Forgot your Password?</a> -->
                            </div>
                            <div class="form-group mb-1"><button type="submit"
                                    class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0 ">Register</button>
                            </div>
                        </form>

                        <div class="col-sm-12 p-0 text-left">

                            <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">Already have account <a
                                    href="{{ route('login') }}" class="fw-700 ms-1">Login</a></h6>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    


    
@endsection
