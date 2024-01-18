<!DOCTYPE html>
<html lang="en">

<head>
    @include('Dashboard.component.head')
    <title>{{__('trans.sign_up')}}</title>
</head>

<body class="vh-100">
    @include('Dashboard.component.auth_header')
    <div class="authincation h-100" style="height: auto !important;">
        <div class="container h-100" style="margin-top: 6rem !important">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-7">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="{{route('home')}}">
                                            <h2 class="fw-bold">{{__('trans.mr')}}<span style="color: #F93A0B">{{__('trans.haroon')}}</span></h2>
                                        </a>
                                    </div>
                                    <h4 class="text-center mb-4">{{__('trans.sign_in_account')}}</h4>
                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>{{__('trans.username')}}</strong></label>
                                            <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="{{__('trans.username')}}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>{{__('trans.email_address')}}</strong></label>
                                            <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="{{__('trans.email_address')}}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="mb-1"><strong>{{__('trans.password')}}</strong></label>
                                                <input type="password" class="form-control" name="password" placeholder="{{__('trans.enter_password')}}">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="mb-1"><strong>{{__('trans.confirm_password')}}</strong></label>
                                                <input type="password" class="form-control" name="password_confirmation" placeholder="{{__('trans.confirm_password')}}">
                                                @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">{{__('trans.sign_up_me')}}</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>{{__('trans.already_have_account')}} <a class="text-primary" href="{{route('login')}}">{{__('trans.login')}}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Dashboard.component.script')
</body>

</html>