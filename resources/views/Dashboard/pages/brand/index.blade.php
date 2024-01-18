@extends('Dashboard.layout.index')
@section('head')
    <title>{{__('trans.brand')}}</title>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{route('home')}}">{{__('trans.dashboard')}}</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">{{__('trans.brand')}}</a></li>
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
                                <h4 class="card-title">{{__('trans.brand')}} {{__('trans.list')}}</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#createBrand"> <i class="fa fa-plus-circle"></i> {{__('trans.create')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example4" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>{{__('trans.sr#')}}</th>
                                    <th>{{__('trans.brand')}} {{__('trans.name')}}</th>
                                    <th>{{__('trans.status')}}</th>
                                    <th>{{__('trans.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @if(isset($brands))
                                    @foreach ($brands as $item)
                                        <tr>
                                            <td data-toggle="tooltip" data-placement="top"  style="cursor: pointer" title="{{__('trans.click_here_to_edit_record')}}" onclick='getEditData({{$item->id}},"{{$item->name}}") , openModal()'>{{$i++}}</td>
                                            <td data-toggle="tooltip" data-placement="top"  style="cursor: pointer" title="{{__('trans.click_here_to_edit_record')}}" onclick='getEditData({{$item->id}},"{{$item->name}}") , openModal()'>{{$item->name}}</td>
                                            <td data-toggle="tooltip" data-placement="top"  style="cursor: pointer" title="{{__('trans.click_here_to_edit_record')}}" onclick='getEditData({{$item->id}},"{{$item->name}}") , openModal()'>
                                                @if ($item->status == 'active')
                                                    <span class="badge light badge-success">{{__('trans.active')}}</span>   
                                                @else
                                                    <span class="badge light badge-danger">{{__('trans.in_active')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                 <button type="button" onclick='getDeleteId({{$item->id}})' class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteBrand"><i class="fa fa-trash"></i></button>
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

    <!--Add Brand Modal -->
    <div class="modal fade" id="createBrand">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('trans.add')}} {{__('trans.new')}} {{__('trans.brand')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{route('brands.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        
                            <div class="form-group">
                                <label class="form-label fw-bold">{{__('trans.brand')}}  {{__('trans.name')}}</label>
                                <input type="text" name="name" placeholder="{{__('trans.brand')}} {{__('trans.name')}}" class="form-control" value="{{old('name')}}">
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">{{__('trans.close')}}</button>
                        <button type="submit" class="btn btn-primary"> {{__('trans.save')}}</button>
                    </div>
                 </form>

            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary mb-2" style="visibility: hidden" id="editBtn" data-bs-toggle="modal" data-bs-target="#editBrand">{{__('trans.edit')}}</button>
    
    <!--Edit Brand Modal -->
    <div class="modal fade" id="editBrand">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('trans.edit')}} {{__('trans.brand')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{route('brands.update')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        
                            <div class="form-group">
                                <label class="form-label fw-bold">{{__('trans.brand')}} {{__('trans.name')}}</label>
                                <input type="hidden" readonly name="id" id="srId">
                                <input type="text" name="name" placeholder="Brand Name" id="name" class="form-control" value="{{old('name')}}">
                                @error('name')
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

    <!--Delete Brand Modal -->
    <div class="modal fade" id="deleteBrand">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('trans.delete')}} {{__('trans.brand')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{route('brands.destroy')}}" method="POST">
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
        });
    </script>
@endsection