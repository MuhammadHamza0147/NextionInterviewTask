@extends('Dashboard.layout.index')
@section('head')
    <title>{{__('trans.dashboard')}}</title>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">{{__('trans.dashboard')}}</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">{{__('trans.home')}}</a></li>
        </ol>
    </div>
    @include('Dashboard.component.alert')
    <div class="row">
        <div class="col-xl-6">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row separate-row mb-2">
                                <div class="col-sm-6">  
                                    <div class="job-icon pb-4 d-flex justify-content-between">
                                        <div>
                                            <div class="d-flex align-items-center mb-1">
                                                <h2 class="mb-0">{{number_format($totalBrands)}}</h2>
                                                <span class="text-success ms-3">+0.5 %</span>
                                            </div>
                                            <span class="fs-14 d-block mb-2">{{__('trans.total')}} {{__('trans.active')}} {{__('trans.brand')}}</span>
                                        </div>
                                        <div id="NewCustomers"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="job-icon pb-4 pt-4 pt-sm-0 d-flex justify-content-between">
                                        <div>
                                            <div class="d-flex align-items-center mb-1">
                                                <h2 class="mb-0">{{number_format($totalDevices)}}</h2>
                                            </div>
                                            <span class="fs-14 d-block mb-2">{{__('trans.total')}} {{__('trans.devices')}}</span>
                                        </div>
                                        <div id="NewCustomers1"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="job-icon pt-4 pb-sm-0 pb-4 pe-3 d-flex justify-content-between">
                                        <div>
                                            <div class="d-flex align-items-center mb-1">
                                                <h2 class="mb-0">{{number_format($totalDefects)}}</h2>
                                                <span class="text-danger ms-3">-2 % </span>
                                            </div>
                                            <span class="fs-14 d-block mb-2">{{__('trans.total')}} {{__('trans.defects')}}</span>
                                        </div>
                                        <div id="NewCustomers2"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="job-icon pt-4  d-flex justify-content-between">
                                        <div>
                                            <div class="d-flex align-items-center mb-1">
                                                <h2 class="mb-0">{{number_format($totalUser)}}</h2>
                                            </div>
                                            <span class="fs-14 d-block mb-2">{{__('trans.total')}} {{__('trans.active')}} {{__('trans.users')}}</span>
                                        </div>
                                        <div id="NewCustomers3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row ">                                
                                <div class="col-xl-12 col-xxl-12 col-sm-7">
                                    <div class="update-profile d-flex">
                                        @if(isset($userData))
                                        <img src="{{asset('uploads/'.$userData->image)}}" alt="">
                                        @else
                                            <img src="{{asset('assets/images/avatar/1.png')}}" alt="">
                                        @endif
                                        <div class="ms-4">
                                            <h3 class="fs-24 font-w600 mb-0">{{Auth::user()->name}}</h3>
                                            <span class="text-primary d-block mb-4">{{$userData->job_title ?? 'N\A'}}</span>
                                            <span><i class="fas fa-map-marker-alt me-1"></i>{{$userData->address ?? 'N\A'}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                if(isset($userData)){
                                    $skills = explode(',', $userData->skill);
                                }else{
                                     $skills = ['No Skill available'];
                                }
                            @endphp
                            <div class="row align-items-center">
                                <div class="row mt-2 mb-2">
                                    <div class="col-md-8">
                                        <h4 class="fs-20 mb-3">{{__('trans.skills')}}</h4>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <a href="{{route('user.profile')}}" class="btn btn-primary">{{__('trans.profile')}}</a>
                                    </div>
                                </div>
                                <div class="profile-skills mb-2">
                                    @foreach ($skills as $item)
                                        <a href="javascript:void(0);" class="btn btn-primary light btn-xs mb-1 text-uppercase">{{$item}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('trans.all')}} {{__('trans.devices')}}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example4" class="display table table-sm" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>{{__('trans.sr#')}}</th>
                                    <th>{{__('trans.brand')}} {{__('trans.name')}}</th>
                                    <th>{{__('trans.devices')}} {{__('trans.name')}}</th>
                                    <th>{{__('trans.status')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;?>
                                @foreach ($Devices as $val)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td class="text-uppercase">{{$val->Brand->name ?? 'N\A'}}</td>
                                    <td class="text-uppercase">{{$val->device_name ?? 'N\A'}}</td>
                                    <td class="text-uppercase">
                                        @if (isset($val->Brand->status) && $val->Brand->status == 'active')
                                            <span class="badge light badge-success">{{__('trans.active')}}</span>   
                                        @else
                                            <span class="badge light badge-danger">{{__('trans.in_active')}}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection