@extends('Dashboard.layout.index')
@section('head')
<title>User Profile</title>
<style>
    textarea {
        height: 10rem !important;
    }

    .nice-select.wide {
        line-height: 34px !important;
    }

    .form-control {
        border: 0.0625rem solid #cfcfcf !important;
    }

    .btn {
        padding: 0.938rem 1.5rem !important;
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Profile</a></li>
        </ol>
    </div>
    @include('Dashboard.component.alert')
    <div class="row">
        <div class="col-lg-12">
            <div class="profile card card-body px-3 pt-3 pb-0">
                <div class="profile-head">
                    <div class="photo-content">
                        <div class="cover-photo rounded"></div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-photo">
                            @if (isset($profileData) && $profileData->image != '')
                                <img src="{{asset('uploads/'. $profileData->image)}}" class="img-fluid rounded-circle" alt=""> 
                            @else
                                <img src="{{asset('assets/images/avatar/1.png')}}" class="img-fluid rounded-circle" alt="">
                            @endif
                        </div>
                        <div class="profile-details">
                            <div class="profile-name px-3 pt-2">
                                <h4 class="text-primary mb-0">{{$profileData->user->name ?? 'N\A'}}</h4>
                                <p>{{$profileData->job_title ?? 'N\A'}}</p>
                            </div>
                            <div class="profile-email px-2 pt-2">
                                <h4 class="text-muted mb-0">{{$profileData->user->email ?? 'N\A'}}</h4>
                                <p>Email Address</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#about-me" data-bs-toggle="tab" class="nav-link">About
                                        Me</a>
                                </li>
                                <li class="nav-item"><a href="#profile-settings" data-bs-toggle="tab"
                                        class="nav-link">Profile</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="about-me" class="tab-pane fade  show active">
                                    <div class="profile-about-me">
                                        <div class="pt-4 border-bottom-1 pb-3">
                                            <h4 class="text-primary">About Me</h4>
                                            <p class="mb-2">{{$profileData->about ?? ''}}</p>
                                        </div>
                                    </div>
                                    @php
                                        if(isset($profileData)){
                                            $skills =  explode(",", $profileData->skill);                                       
                                        }else {
                                            $skills = ['No Skill available'];
                                        }
                                    @endphp
                                    <div class="profile-skills mb-5">
                                        <h4 class="text-primary mb-2">Skills</h4>
                                        @foreach ($skills as $item)
                                            <a href="javascript:void(0);" class="btn btn-primary light btn-xs mb-1 text-uppercase">{{$item}}</a>
                                        @endforeach
                                    </div>
                                    <div class="profile-personal-info">
                                        <h4 class="text-primary mb-4">Personal Information</h4>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Name <span class="pull-end">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{$profileData->user->name ?? 'N\A'}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Email <span class="pull-end">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{$profileData->user->email ?? 'N\A'}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Contact Number <span class="pull-end">:</span></h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{$profileData->phone ?? 'N\A'}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Gender <span class="pull-end">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span class="text-uppercase">{{$profileData->gender ?? 'N\A'}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">CNIC <span class="pull-end">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{$profileData->cnic ?? 'N\A'}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">DOB <span class="pull-end">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{$profileData->dob ?? 'N\A'}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Address <span class="pull-end">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>{{$profileData->address ?? 'N\A'}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="profile-settings" class="tab-pane fade">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            <h4 class="text-primary">Account Setting</h4>
                                            <div class="basic-form mt-3">
                                                <form @if($profileData == '') action="{{route('user.profile.store')}}" @else action="{{route('user.profile.update')}}" @endif method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @if ($profileData != '')
                                                        @method('PUT') 
                                                    @endif
                                                    <div class="row">
                                                        @if($profileData == '')
                                                        <div class="mb-3 col-md-12">
                                                            <label class="form-label">Profile Image <span class="text-danger">*</span></label>
                                                            <input name="image" type="file" class="form-control"  value="{{old('image')}}" />
                                                            @error('image')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                        @else
                                                        <div class="row">
                                                            <div class="mb-3 col-md-9">
                                                                <input type="hidden" readonly name="user_id" value="{{$profileData->id}}">
                                                                <label class="form-label">Upload New Image <span class="text-danger">*</span></label>
                                                                <input name="image" type="file" class="form-control"  value="{{old('image')}}" />
                                                                @error('image')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <span class="text-danger">Already Uploaded Image</span>
                                                                <img src="{{asset('uploads/'. $profileData->image)}}" class="img-thumbnail" alt="Profile Image" style="width:100%; max-width:150px;">
                                                            </div>
                                                        </div>
                                                        
                                                        @endif
                                                        
                                                        <div class="mb-3 col-md-6">
                                                            <label>Job Title <span class="text-danger">*</span></label>
                                                            <input type="text" name="job_title" class="form-control" placeholder="Job Title" @if ($profileData == '') value="{{old('job_title')}}" @else value="{{$profileData->job_title}}" @endif >
                                                            @error('job_title')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label>DOB <span class="text-danger">*</span></label>
                                                            <input name="dob" class="datepicker-default form-control" placeholder="Date of Birth" id="datepicker"  @if ($profileData == '') value="{{old('dob')}}" @else value="{{$profileData->dob}}" @endif >
                                                            @error('dob')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3 col-md-6">
                                                            <label>CNIC <span class="text-danger">*</span></label>
                                                            <input type="tel" name="cnic" class="form-control" placeholder="Enter CNIC# " @if ($profileData == '') value="{{old('cnic')}}" @else value="{{$profileData->cnic}}" @endif >
                                                            @error('cnic')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label>Select Gender <span
                                                                    class="text-danger">*</span></label>
                                                            <select name="gender"
                                                                class="default-select form-control wide">
                                                                <option value="">Choose Gender</option>
                                                                <option @if(isset($profileData) && $profileData->gender == "male") selected @endif value="male">Male</option>
                                                                <option @if(isset($profileData) && $profileData->gender == "female") selected @endif value="female">Female</option>
                                                                <option @if(isset($profileData) && $profileData->gender == "other") selected @endif value="other">Other</option>
                                                            </select>
                                                            @error('gender')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label>Contact Number <span class="text-danger">*</span></label>
                                                            <input type="tel" name="phone" class="form-control" placeholder="Contact No#"  @if ($profileData == '') value="{{old('phone')}}" @else value="{{$profileData->phone}}" @endif >
                                                            @error('phone')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label>Skills <span class="text-danger">*</span></label>
                                                            <input type="text" name="skill" placeholder="Add Skill (each skill separate by ,)" class="form-control"  @if ($profileData == '') value="{{old('skill')}}" @else value="{{$profileData->skill}}" @endif >
                                                            @error('skill')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label>Address <span class="text-danger">*</span></label>
                                                            <textarea type="text" name="address" cols="10" rows="8"
                                                                placeholder="Your Address"
                                                                class="form-control">@if($profileData != ''){{$profileData->address}}@endif</textarea>
                                                            @error('address')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label>About <span class="text-danger">*</span></label>
                                                            <textarea type="text" name="about" cols="10" rows="8"
                                                                placeholder="About Me" class="form-control">@if($profileData != ''){{$profileData->about ?? ''}}@endif</textarea>
                                                            @error('about')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 text-right">
                                                        <button type="submit" class="btn btn-primary">Save</button>
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
            </div>
        </div>
    </div>
</div>
@section('script')

@endsection
@endsection