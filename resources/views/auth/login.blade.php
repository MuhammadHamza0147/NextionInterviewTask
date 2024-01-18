<!DOCTYPE html>
<html lang="en">
<head>
    @include('Dashboard.component.head')
    <title>{{__('trans.sign_in')}}</title>
</head>
<body class="vh-100">
    @include('Dashboard.component.auth_header')
    <div class="authincation mt-5 h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
                                        <a href="{{route('home')}}">
                                            <h2 class="fw-bold">{{__('trans.mr')}}<span style="color: #F93A0B">{{__('trans.haroon')}}</span></h2>
                                        </a>									</div>
                                    <h4 class="text-center mb-4">{{__('trans.sign_in_account')}}</h4>
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>{{__('trans.email_address')}}</strong></label>
                                            <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="{{__('trans.email_address')}}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>{{__('trans.password')}}</strong></label>
                                            <input type="password" name="password" class="form-control" value="{{old('password')}}" placeholder="{{__('trans.enter_password')}}">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="row d-flex justify-content-between mt-4 mb-2">
                                            <div class="mb-3">
                                               <div class="form-check custom-checkbox ms-1">
													<input type="checkbox" class="form-check-input" id="basic_checkbox_1">
													<label class="form-check-label" for="basic_checkbox_1" style="margin-top: 0.4rem !important">{{__('trans.remember_me')}}</label>
												</div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">{{__('trans.sign_in_me')}}</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>{{__('trans.donot_have_account')}} <a class="text-primary" href="{{route('register')}}">{{__('trans.sign_up')}}</a></p>
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