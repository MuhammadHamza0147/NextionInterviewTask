<div class="nav-header">
    <a href="{{route('home')}}" class="brand-logo">
            <h3 style="font-size: 16px" class="fw-bold">{{__('trans.mr')}}<span style="color: #F93A0B">{{__('trans.haroon')}}</span></h3>
    </a>
    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>

@php
    $userProfileData = App\Models\UserProfile::where('user_id', Auth::user()->id)->first();
@endphp
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                </div>

                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown"> <i class="fa fa-globe mr-2"></i> {{__('trans.language')}}</a>
                        <div class="dropdown-menu dropdown-menu-end">
                            @foreach (config('locale.locales') as $locale)
                            <a href="{{route('localization' , $locale)}}" class="dropdown-item ai-icon">
                                
                                    @if ($locale ==  'en')
                                        @if(app()->getLocale() == 'en')
                                        <span class="ms-2">
                                            <i class="fa fa-toggle-on text-danger mr-1"></i> {{__('trans.english')}}
                                        </span>
                                        @else
                                        <span class="ms-2">
                                            <i class="fa fa-toggle-off text-danger mr-1"></i> {{__('trans.english')}}
                                        </span>
                                        @endif
                                    @else
                                        @if(app()->getLocale() == 'ur')
                                        <span class="ms-2">
                                            <i class="fa fa-toggle-on  text-danger mr-1"></i> {{__('trans.urdu')}}
                                        </span>
                                        @else
                                        <span class="ms-2">
                                            <i class="fa fa-toggle-off text-danger mr-1"></i> {{__('trans.urdu')}}
                                        </span>
                                        @endif
                                    @endif
                            </a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                            
                            @if(isset($userProfileData))
                            <img src="{{asset('uploads/'.$userProfileData->image)}}" width="20" alt="" /> <i class="fas fa-chevron-down text-danger ml-2"></i>
                            @else
                            <img src="{{asset('assets/images/avatar/1.png')}}" width="20" alt="" /> <i class="fas fa-chevron-down text-danger ml-2"></i>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="{{route('user.profile')}}" class="dropdown-item ai-icon">
                                <svg id="icon-user2" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                                    height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span class="ms-2">{{__('trans.profile')}}</span>
                            </a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();" class="dropdown-item ai-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span class="ms-2">{{__('trans.logout')}}</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<div class="dlabnav">
    <div class="dlabnav-scroll">
        <div class="dropdown header-profile2 ">
            <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                <div class="header-info2 d-flex align-items-center">
                    @if (isset($userProfileData))
                    <img src="{{asset('uploads/'.$userProfileData->image)}}" alt="" />
                    @else
                    <img src="{{asset('assets/images/avatar/1.png')}}" alt="" />
                    @endif
                    
                    <div class="d-flex align-items-center sidebar-info">
                        <div>
                            <span class="font-w400 d-block">
                                @if (isset($userProfileData))
                                {{$userProfileData->User->name}}
                                @else
                                {{Auth::user()->name}}
                                @endif
                            </span>
                            <small class="text-end text-primary font-w400 text-uppercase">
                               {{$userProfileData->job_title ?? 'n\a'}}
                            </small>
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </div>

                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="{{route('user.profile')}}" class="dropdown-item ai-icon ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span class="ms-2">{{__('trans.profile')}}</span>
                </a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item ai-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span class="ms-2">{{__('trans.logout')}}</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{route('home')}}" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">{{__('trans.dashboard')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('brands')}}" aria-expanded="false">
                    <i class="flaticon-381-photo"></i>
                    <span class="nav-text">{{__('trans.brand')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('devices')}}" aria-expanded="false">
                    <i class="flaticon-381-newspaper"></i>
                    <span class="nav-text">{{__('trans.devices')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('defects')}}" aria-expanded="false">
                    <i class="flaticon-381-knob"></i>
                    <span class="nav-text">{{__('trans.defects')}}</span>
                </a>
            </li>
            
        </ul>
    </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->

<!--**********************************
            Content body start
        ***********************************-->