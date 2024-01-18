<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left"></div>

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
                </ul>
            </div>
        </nav>
    </div>
</div>