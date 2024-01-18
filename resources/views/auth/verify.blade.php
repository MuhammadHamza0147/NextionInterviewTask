<!DOCTYPE html>
<html lang="en">
<head>
    @include('Dashboard.component.head')
    <title>{{__('trans.verify_email_address')}}</title>
</head>
<body class="vh-100">
    @include('Dashboard.component.auth_header')
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-8">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="{{route('home')}}">
                                            <h2 class="fw-bold">{{__('trans.mr')}}<span style="color: #F93A0B">{{__('trans.haroon')}}</span></h2>
                                        </a>
									</div>
                                    @if (session('resent'))
                                        <div class="alert alert-success" role="alert">
                                            {{ __('trans.A fresh verification link has been sent to your email address.') }}
                                        </div>
                                    @endif
                                    <h4 class="text-center mb-4">{{ __('trans.Before proceeding, please check your email for a verification link.') }}</h4>
                                    <h4 class="text-center mb-4">{{ __('trans.If you did not receive the email') }}</h4>
                                    <form action="{{ route('verification.resend') }}" method="POST">
                                        @csrf
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">{{__('trans.resend_mail')}}</button>
                                        </div>
                                    </form>
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