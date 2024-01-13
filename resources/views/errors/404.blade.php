<!DOCTYPE html>
<html lang="en">
<head>
    @include('Dashboard.component.head')
</head>
<body class="vh-100" style="background-color: #003F5E; background-image: linear-gradient(180deg, #003F5E 0%, #4B7687 100%);">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-7">
                    <div class="form-input-content text-center error-page">
                        <h1 class="error-text fw-bold text-white">404</h1>
                        <h4 style="color: white;"><i class="fa fa-exclamation-triangle text-warning"></i> The page you
                            were looking for is not found!</h4>
                        <p style="color: white;">You may have mistyped the address or the page may have moved.</p>
                        <div>
                            <a class="btn btn-primary" href="{{route('home')}}"
                                style="background-color:#ffffff; border: #ffffff; color: #003F5E;">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Dashboard.component.script')
</body>
</html>