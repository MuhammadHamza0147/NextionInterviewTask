@extends('Dashboard.layout.index')
@section('head')
    <title>Brands</title>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Brands</a></li>
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
                                <h4 class="card-title">Brands List</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#createBrand"> <i class="fa fa-plus-circle"></i> Create</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example4" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Brand Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @if(isset($brands))
                                    @foreach ($brands as $item)
                                        <tr>
                                            <td data-toggle="tooltip" data-placement="top"  style="cursor: pointer" title="Click Here To Edit Record" onclick='getEditData({{$item->id}},"{{$item->name}}") , openModal()'>{{$i++}}</td>
                                            <td data-toggle="tooltip" data-placement="top"  style="cursor: pointer" title="Click Here To Edit Record" onclick='getEditData({{$item->id}},"{{$item->name}}") , openModal()'>{{$item->name}}</td>
                                            <td data-toggle="tooltip" data-placement="top"  style="cursor: pointer" title="Click Here To Edit Record" onclick='getEditData({{$item->id}},"{{$item->name}}") , openModal()'>
                                                @if ($item->status == 'active')
                                                    <span class="badge light badge-success">Active</span>   
                                                @else
                                                    <span class="badge light badge-danger">In-active</span>
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
                    <h5 class="modal-title">Add New Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{route('brands.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        
                            <div class="form-group">
                                <label class="form-label fw-bold">Brand Name</label>
                                <input type="text" name="name" placeholder="Brand Name" class="form-control" value="{{old('name')}}">
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                 </form>

            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary mb-2" style="visibility: hidden" id="editBtn" data-bs-toggle="modal" data-bs-target="#editBrand">Edit</button>
    
    <!--Edit Brand Modal -->
    <div class="modal fade" id="editBrand">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{route('brands.update')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        
                            <div class="form-group">
                                <label class="form-label fw-bold">Brand Name</label>
                                <input type="hidden" readonly name="id" id="srId">
                                <input type="text" name="name" placeholder="Brand Name" id="name" class="form-control" value="{{old('name')}}">
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
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
                    <h5 class="modal-title">Delete Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{route('brands.destroy')}}" method="POST">
                    @csrf
                    <div class="modal-body text-center">
                        <h3>Are you Sure!</h3>
                        <p>You want to delete this record !!</p>
                        <div class="form-group">
                            <input type="hidden" readonly name="id" id="srDeleteId">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Yes, I want</button>
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