@extends('Dashboard.layout.index')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{__('trans.defects')}}</title>
    <style>
        .loaders-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        .loaders {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 48px;
            height: 48px;
            border: 5px solid;
            border-color: #cc2c05 transparent;
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{route('home')}}">{{__('trans.dashboard')}}</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">{{__('trans.defects')}}</a></li>
        </ol>
    </div>
    @include('Dashboard.component.alert')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">{{__('trans.defects')}} {{__('trans.list')}}</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" id="SyncAPI" class="btn btn-info mb-2"> <i class="fa fa-download"></i> {{__('trans.sync')}} {{__('trans.defects')}} {{__('trans.api')}}</button>
                                <button type="button" id="HitAPI" class="btn btn-danger mb-2"> <i class="fa fa-globe"></i> {{__('trans.defects')}} {{__('trans.api')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="loaders-container">
                        <div class="loaders"></div>
                    </div>
                    <div class="table-responsive">
                        <table id="example4" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>{{__('trans.sr#')}}</th>
                                    <th>{{__('trans.devices')}} {{__('trans.name')}}</th>
                                    <th>{{__('trans.defects')}} {{__('trans.name')}}</th>
                                    <th>{{__('trans.price')}}</th>
                                    <th>{{__('trans.percentage')}}</th>
                                    <th>{{__('trans.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @if(isset($defects))
                                    @foreach ($defects as $item)
                                        <tr>
                                            <td data-toggle="tooltip" data-placement="top"  style="cursor: pointer" title="{{__('trans.click_here_to_edit_record')}}" onclick='getEditData({{$item->id ?? "1"}},"{{$item->defect_name ?? "N\A"}}") , openModal()'>{{$i++}}</td>
                                            <td data-toggle="tooltip" data-placement="top"  style="cursor: pointer" title="{{__('trans.click_here_to_edit_record')}}" onclick='getEditData({{$item->id ?? "1"}},"{{$item->defect_name ?? "N\A"}}") , openModal()'>{{$item->Device->device_name ?? 'N\A'}}</td>
                                            <td data-toggle="tooltip" data-placement="top"  style="cursor: pointer" title="{{__('trans.click_here_to_edit_record')}}" onclick='getEditData({{$item->id ?? "1"}},"{{$item->defect_name ?? "N\A"}}") , openModal()'>{{$item->defect_name ?? 'N\A'}}</td>
                                            <td data-toggle="tooltip" data-placement="top"  style="cursor: pointer" title="{{__('trans.click_here_to_edit_record')}}" onclick='getEditData({{$item->id ?? "1"}},"{{$item->defect_name ?? "N\A"}}") , openModal()'>${{round($item->original_price ,2) ?? 'N\A'}}</td>
                                            <td data-toggle="tooltip" data-placement="top"  style="cursor: pointer" title="{{__('trans.click_here_to_edit_record')}}" onclick='getEditData({{$item->id ?? "1"}},"{{$item->defect_name ?? "N\A"}}") , openModal()'>{{round($item->defect_precentage , 2) ?? 'N\A'}}%</td>
                                            <td>
                                                 <button type="button" onclick='getDeleteId({{$item->id ?? "1"}})' class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteBrand"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <button type="button" class="btn btn-primary mb-2" style="visibility: hidden" id="editBtn" data-bs-toggle="modal" data-bs-target="#editBrand">{{__('trans.edit')}}</button>
    
    <!--Edit Device Modal -->
    <div class="modal fade" id="editBrand">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('trans.edit')}} {{__('trans.defects')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{route('defects.update')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        
                            <div class="form-group">
                                <label class="form-label fw-bold">{{__('trans.devices')}} {{__('trans.name')}}</label>
                                <input type="hidden" readonly name="id" id="srId">
                                <input type="text" name="defect_name" placeholder="Defect Name" id="name" class="form-control" value="{{old('defect_name')}}">
                                @error('defect_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">{{__('trans.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('trans.update')}}</button>
                    </div>
                 </form>

            </div>
        </div>
    </div>

    <!--Delete Device Modal -->
    <div class="modal fade" id="deleteBrand">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('trans.delete')}} {{__('trans.defects')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{route('defects.destroy')}}" method="POST">
                    @csrf
                    <div class="modal-body text-center">
                        <h3>{{__('trans.are_you_sure')}}!</h3>
                        <p>{{__('trans.you_want_to_delete_this_record')}} !!</p>
                        <div class="form-group">
                            <input type="hidden" readonly name="id" id="srDeleteId">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">{{__('trans.close')}}</button>
                        <button type="submit" class="btn btn-success">{{__('trans.yes_i_want')}}</button>
                    </div>
                 </form>

            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        
        function getEditData(id , name){
            $('#srId').val(id);
            $('#name').val(name);
        }
        
        function openModal(){
            $('#editBtn').click();
        }

        function getDeleteId(id){
            $('#srDeleteId').val(id);
        }
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();

            $('#SyncAPI').on('click', function(e){
                e.preventDefault();
                $(".loaders-container").show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'GET',
                    url:'{{route("defects.sync")}}',
                    success:function(response){
                        if(response.status == 200) {
                            $(".loaders-container").hide();
                            toastr.success(response.message, "@if(app()->getLocale() == 'en') Success! @else کامیابی! @endif", {
                                positionClass: "toast-top-right",
                                timeOut: 5e3,
                                closeButton: !0,
                                debug: !1,
                                newestOnTop: !0,
                                progressBar: !0,
                                preventDuplicates: !0,
                                onclick: null,
                                showDuration: "300",
                                hideDuration: "1000",
                                extendedTimeOut: "1000",
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut",
                                tapToDismiss: !1
                            });
                            document.location.href = "{{route('defects')}}";
                        }else{
                            $(".loaders-container").hide();
                            toastr.error();(response.message, "@if(app()->getLocale() == 'en') Error! @else خرابی! @endif", {
                                positionClass: "toast-top-right",
                                timeOut: 5e3,
                                closeButton: !0,
                                debug: !1,
                                newestOnTop: !0,
                                progressBar: !0,
                                preventDuplicates: !0,
                                onclick: null,
                                showDuration: "300",
                                hideDuration: "1000",
                                extendedTimeOut: "1000",
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut",
                                tapToDismiss: !1
                            });
                            document.location.href = "{{route('defects')}}";
                        }
                    }
                });
            });

            $('#HitAPI').on('click', function(e){
                e.preventDefault();
                $(".loaders-container").show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'GET',
                    url:'{{route("defects.api")}}',
                    success:function(response){
                        if(response.status == 200) {
                            $(".loaders-container").hide();
                            toastr.success(response.message, "@if(app()->getLocale() == 'en') Success! @else کامیابی! @endif", {
                                positionClass: "toast-top-right",
                                timeOut: 5e3,
                                closeButton: !0,
                                debug: !1,
                                newestOnTop: !0,
                                progressBar: !0,
                                preventDuplicates: !0,
                                onclick: null,
                                showDuration: "300",
                                hideDuration: "1000",
                                extendedTimeOut: "1000",
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut",
                                tapToDismiss: !1
                            });
                            document.location.href = "{{route('defects')}}";
                        }else{
                            $(".loaders-container").hide();
                            toastr.error();(response.message, "@if(app()->getLocale() == 'en') Error! @else خرابی! @endif", {
                                positionClass: "toast-top-right",
                                timeOut: 5e3,
                                closeButton: !0,
                                debug: !1,
                                newestOnTop: !0,
                                progressBar: !0,
                                preventDuplicates: !0,
                                onclick: null,
                                showDuration: "300",
                                hideDuration: "1000",
                                extendedTimeOut: "1000",
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut",
                                tapToDismiss: !1
                            });
                            document.location.href = "{{route('defects')}}";
                        }
                    }
                });
            });
        });
    </script>
@endsection